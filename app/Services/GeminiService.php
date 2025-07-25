<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Carbon\Carbon;

class GeminiService
{
    protected $apiKey;
    protected $endpoint = 'https://generativelanguage.googleapis.com/v1/models/gemini-2.5-pro:generateContent';

    public function __construct()
    {
        $this->apiKey = config('services.gemini.key');
    }

    public function interpretPrompt(string $prompt): string
    {
        if (app()->environment('local')) {
            Log::debug('🤖 Mocked Gemini response (local env)');
            return $this->mockResponse($prompt);
        }

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
            $response = Http::timeout(10)->post($this->endpoint . '?key=' . $this->apiKey, [
                'contents' => [[
                    'parts' => [[ 'text' => $query ]]
                ]]
            ]);

            $body = $response->json();

            if (isset($body['error'])) {
                Log::error('⚠️ Gemini Error:', $body);
                return $this->mockResponse($prompt);
            }

            $parts = $body['candidates'][0]['content']['parts'] ?? [];
            $text = collect($parts)->pluck('text')->implode("\n");

            Log::debug('🧠 Gemini Raw Response:', ['text' => $text]);
            return $text;
        } catch (\Exception $e) {
            Log::error('❌ Gemini API failed:', ['error' => $e->getMessage()]);
            return $this->mockResponse($prompt);
        }
    }

    protected function mockResponse(string $prompt): string
    {
        Log::debug('🤖 Returning fallback response for prompt:', ['prompt' => $prompt]);

        $guestCount = match (true) {
            Str::contains($prompt, ['1', 'one']) => 1,
            Str::contains($prompt, ['2', 'two']) => 2,
            Str::contains($prompt, ['3', 'three']) => 3,
            default => 2
        };

        $roomType = match (true) {
            Str::contains($prompt, ['deluxe']) => 'Deluxe',
            Str::contains($prompt, ['family']) => 'Family',
            Str::contains($prompt, ['suite']) => 'Suite',
            default => 'Standard'
        };

        $features = [];
        if (Str::contains($prompt, ['wifi', 'internet'])) $features[] = 'wifi';
        if (Str::contains($prompt, ['aircon', 'air conditioning'])) $features[] = 'aircon';
        if (Str::contains($prompt, ['tv'])) $features[] = 'tv';

        $specialRequest = Str::contains($prompt, ['pillow']) ? 'extra pillow' : '';

        return json_encode([
            "roomtype" => $roomType,
            "roommaxguest" => $guestCount,
            "roomfeatures" => $features,
            "reservation_days" => 2,
            "checkin_date" => Carbon::now()->addDays(1)->toDateString(),
            "checkout_date" => Carbon::now()->addDays(3)->toDateString(),
            "special_request" => $specialRequest
        ]);
    }
}
