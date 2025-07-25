<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class GeminiService
{
    protected $apiKey;
    protected $endpoint = 'https://generativelanguage.googleapis.com/v1/models/gemini-2.5-pro:generateContent';

    public function __construct()
    {
        $this->apiKey = config('services.gemini.key');
    }

 public function interpretPrompt($prompt)
{
    $query = <<<TEXT
You are a hotel booking assistant. Extract and return ONLY this exact JSON from the following prompt:

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

Do NOT explain or comment — return the JSON only. Do not wrap it in quotes or escape it.
TEXT;

    $response = Http::post($this->endpoint . '?key=' . $this->apiKey, [
        'contents' => [[
            'parts' => [[ 'text' => $query ]]
        ]]
    ]);

    Log::debug('🧠 Gemini FULL RESPONSE:', $response->json());

    $parts = $response->json()['candidates'][0]['content']['parts'] ?? [];

    // Join all parts (no escaping expected)
    $text = collect($parts)->pluck('text')->implode("\n");

    return $text;
}  
}
