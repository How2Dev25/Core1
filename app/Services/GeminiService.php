<?php

namespace App\Services;

use App\Models\roomtypes;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Carbon\Carbon;

class GeminiService
{
    protected $apiKey;
protected $endpoint = 'https://generativelanguage.googleapis.com/v1/models/gemini-2.5-flash-lite:generateContent';

    public function __construct()
    {
        $this->apiKey = config('services.gemini.key');
    }

  public function interpretPrompt(string $prompt): string
{
    $query = <<<TEXT
You are a hotel booking assistant. Return ONLY a clean JSON like below based on this booking prompt:

"$prompt"

Format:
{
  "roomtype": "...",
  "roommaxguest": ...,
  "roomfeatures": ["...", "..."],
  "reservation_days": ...,
  "checkin_date": "YYYY-MM-DD",
  "checkout_date": "YYYY-MM-DD",
  "special_request": "..."
}

No extra text. No explanation. Return raw JSON only.
TEXT;

    try {
        $response = Http::timeout(30)->post($this->endpoint . '?key=' . $this->apiKey, [
            'contents' => [[
                'parts' => [['text' => $query]]
            ]]
        ]);

        $body = $response->json();

        if (isset($body['error'])) {
            Log::error('⚠️ Gemini API returned error:', $body);
            return $this->mockResponse($prompt);
        }

        $parts = $body['candidates'][0]['content']['parts'] ?? [];
        $text = collect($parts)->pluck('text')->implode("\n");

        // Clean Markdown wrappers
        $text = str_replace(['```json', '```'], '', $text);
        $text = trim($text);

        Log::debug('🧠 Gemini Cleaned JSON:', ['json' => $text]);

        // Try decoding JSON
        $parsed = json_decode($text, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            Log::error('❌ Failed to decode Gemini JSON, using fallback', ['raw' => $text]);
            return $this->mockResponse($prompt);
        }

        return $text;

    } catch (\Exception $e) {
        Log::error('❌ Gemini API failed:', ['error' => $e->getMessage()]);
        return $this->mockResponse($prompt);
    }
}


protected function mockResponse(string $prompt): string
{
    Log::debug('🤖 Returning fallback response for prompt:', ['prompt' => $prompt]);

    $promptLower = strtolower($prompt);

    // Step 0: Get allowed room types dynamically from DB
    $allowedRoomTypes = roomtypes::pluck('roomtype_name')->toArray();

    // Step 1: Determine room type based on prompt
    $roomType = 'Standard'; // default
    foreach ($allowedRoomTypes as $type) {
        if (str_contains($promptLower, strtolower($type))) {
            $roomType = $type;
            break;
        }
    }

    // Step 2: Determine number of guests
    $guestCount = 2; // default
    if (preg_match('/\b(1|one)\b/', $promptLower)) $guestCount = 1;
    elseif (preg_match('/\b(2|two)\b/', $promptLower)) $guestCount = 2;
    elseif (preg_match('/\b(3|three)\b/', $promptLower)) $guestCount = 3;
    elseif (preg_match('/\b(4|four)\b/', $promptLower)) $guestCount = 4;
    elseif (preg_match('/\b(5|five)\b/', $promptLower)) $guestCount = 5;

    // Step 3: Detect features
    $features = [];
    if (str_contains($promptLower, 'wifi') || str_contains($promptLower, 'internet')) $features[] = 'wifi';
    if (str_contains($promptLower, 'aircon') || str_contains($promptLower, 'air conditioning')) $features[] = 'aircon';
    if (str_contains($promptLower, 'tv') || str_contains($promptLower, 'television')) $features[] = 'tv';
    if (str_contains($promptLower, 'balcony')) $features[] = 'balcony';
    if (str_contains($promptLower, 'sea view') || str_contains($promptLower, 'ocean view')) $features[] = 'sea view';

    // Step 4: Detect special requests
    $specialRequest = '';
    if (str_contains($promptLower, 'pillow')) $specialRequest .= 'extra pillow; ';
    if (str_contains($promptLower, 'late check-out')) $specialRequest .= 'late check-out; ';
    if (str_contains($promptLower, 'early check-in')) $specialRequest .= 'early check-in; ';
    $specialRequest = trim($specialRequest, '; ');

    // Step 5: Dates: try to detect, otherwise default to tomorrow + 2 days
    $checkin = Carbon::now()->addDay();
    $checkout = Carbon::now()->addDays(3);

    if (preg_match('/(\d{4}-\d{2}-\d{2})/', $prompt, $matches)) {
        $checkin = Carbon::parse($matches[0]);
        $checkout = $checkin->copy()->addDays(2);
    }

    return json_encode([
        "roomtype" => $roomType,
        "roommaxguest" => $guestCount,
        "roomfeatures" => $features,
        "reservation_days" => $checkout->diffInDays($checkin),
        "checkin_date" => $checkin->toDateString(),
        "checkout_date" => $checkout->toDateString(),
        "special_request" => $specialRequest
    ]);
}

}
