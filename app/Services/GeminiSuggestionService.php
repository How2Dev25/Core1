<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class GeminiSuggestionService
{
    protected $apiKey;
  protected $endpoint = 'https://generativelanguage.googleapis.com/v1/models/gemini-2.5-flash-lite:generateContent';

    public function __construct()
    {
        $this->apiKey = config('services.gemini.key');
    }

    /**
     * Generate admin-focused business intelligence suggestions
     * OPTIMIZED: Smart caching to minimize API calls
     * 
     * @param array $analyticsData System-wide analytics data
     * @return array Array of business insight objects
     */
    public function generateAdminInsights(array $analyticsData): array
    {
        // OPTIMIZATION: Create cache key based on data (same data = same cache)
        $cacheKey = 'gemini_insights_' . md5(json_encode([
            'searches' => $analyticsData['total_searches'],
            'top_room' => $analyticsData['top_room_type'],
            'top_feature' => $analyticsData['top_feature'],
            'avg_days' => round($analyticsData['avg_days'] ?? 2, 1)
        ]));

        // OPTIMIZATION: Check cache first (30 minutes)
        $cached = Cache::get($cacheKey);
        if ($cached !== null) {
            Log::info('✅ Using cached admin insights (no API call)');
            return $cached;
        }

        // OPTIMIZATION: Rate limiting check
        $apiCallsToday = Cache::get('gemini_api_calls_' . date('Y-m-d'), 0);
        $maxCallsPerDay = 1500; // Set your Gemini API limit
        
        if ($apiCallsToday >= $maxCallsPerDay) {
            Log::warning('⚠️ Gemini API daily limit reached, using fallback');
            return $this->getFallbackInsights($analyticsData);
        }

        $query = $this->buildAdminPrompt($analyticsData);

        try {
            // Track API call
            Cache::increment('gemini_api_calls_' . date('Y-m-d'));
            
            $response = Http::timeout(15)
                ->retry(2, 100)
                ->post($this->endpoint . '?key=' . $this->apiKey, [
                    'contents' => [[
                        'parts' => [['text' => $query]]
                    ]]
                ]);

            // Check if request failed
            if ($response->failed()) {
                Log::warning('⚠️ Gemini API request failed for admin insights', [
                    'status' => $response->status()
                ]);
                return $this->getFallbackInsights($analyticsData);
            }

            $body = $response->json();

            // Check for API errors
            if (isset($body['error'])) {
                Log::error('⚠️ Gemini API error for admin insights:', [
                    'error' => $body['error']
                ]);
                return $this->getFallbackInsights($analyticsData);
            }

            // Extract response text
            $parts = $body['candidates'][0]['content']['parts'] ?? [];
            if (empty($parts)) {
                Log::warning('⚠️ Gemini returned empty response for admin insights');
                return $this->getFallbackInsights($analyticsData);
            }

            $text = collect($parts)->pluck('text')->implode("\n");

            // Clean Markdown wrappers
            $text = str_replace(['```json', '```'], '', $text);
            $text = trim($text);

            Log::debug('🎯 Gemini Admin Insights JSON:', ['json' => substr($text, 0, 200)]);

            // Decode JSON
            $insights = json_decode($text, true);
            
            if (json_last_error() !== JSON_ERROR_NONE) {
                Log::error('❌ Failed to decode admin insights JSON', [
                    'error' => json_last_error_msg(),
                    'raw' => substr($text, 0, 200)
                ]);
                return $this->getFallbackInsights($analyticsData);
            }

            // Validate structure
            $insightsArray = $insights['suggestions'] ?? [];
            
            if (empty($insightsArray) || !is_array($insightsArray)) {
                Log::warning('⚠️ Invalid insights structure from AI');
                return $this->getFallbackInsights($analyticsData);
            }

            // Validate each insight has required fields
            $validInsights = array_filter($insightsArray, function($insight) {
                return isset($insight['icon']) 
                    && isset($insight['color']) 
                    && isset($insight['title']) 
                    && isset($insight['description']) 
                    && isset($insight['cta']);
            });

            if (count($validInsights) < 3) {
                Log::warning('⚠️ Too few valid insights from AI', [
                    'count' => count($validInsights)
                ]);
                return $this->getFallbackInsights($analyticsData);
            }

            Log::info('✅ Successfully generated admin insights', [
                'count' => count($validInsights),
                'api_calls_today' => $apiCallsToday + 1
            ]);

            $result = array_values($validInsights);
            
            // OPTIMIZATION: Cache successful result (30 minutes)
            Cache::put($cacheKey, $result, 1800);
            
            return $result;

        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('❌ Gemini API connection failed:', [
                'error' => $e->getMessage(),
                'type' => 'connection'
            ]);
            return $this->getFallbackInsights($analyticsData);
        } catch (\Illuminate\Http\Client\RequestException $e) {
            Log::error('❌ Gemini API request exception:', [
                'error' => $e->getMessage(),
                'type' => 'request'
            ]);
            return $this->getFallbackInsights($analyticsData);
        } catch (\Exception $e) {
            Log::error('❌ Gemini admin insights failed with unexpected error:', [
                'error' => $e->getMessage(),
                'type' => get_class($e)
            ]);
            return $this->getFallbackInsights($analyticsData);
        }
    }

    /**
     * Build AI prompt for admin business intelligence
     * OPTIMIZED: Minimal tokens, maximum value
     */
    protected function buildAdminPrompt(array $analyticsData): string
    {
        $totalSearches = $analyticsData['total_searches'] ?? 0;
        $topRoomType = $analyticsData['top_room_type'] ?? 'Standard';
        $topFeature = $analyticsData['top_feature'] ?? 'wifi';
        $avgDays = round($analyticsData['avg_days'] ?? 2, 1);
        
        // OPTIMIZATION: Only send top 5 instead of all
        $topRoomTypes = array_slice($analyticsData['all_room_types'] ?? [], 0, 5);
        $topFeatures = array_slice($analyticsData['all_features'] ?? [], 0, 5);
        
        $roomTypesList = implode(', ', $topRoomTypes);
        $featuresList = implode(', ', $topFeatures);

        // OPTIMIZATION: Shorter, more concise prompt
        return <<<TEXT
Hotel analytics AI. Generate 6 business insights as JSON.

Data:
- Searches: $totalSearches
- Top room: $topRoomType
- Top 5 rooms: $roomTypesList
- Top feature: $topFeature  
- Top 5 features: $featuresList
- Avg stay: $avgDays days

JSON format (6 items):
{
  "suggestions": [
    {
      "icon": "fa-chart-line",
      "color": "from-blue-500 to-blue-700",
      "title": "3-5 word title",
      "description": "2 sentences with data",
      "cta": "2 words"
    }
  ]
}

Focus: inventory, revenue, demand, pricing, trends.
Use professional colors: blue, slate, emerald, amber, purple, indigo.
Raw JSON only.
TEXT;
    }

    /**
     * Fallback business insights when AI fails
     */
    protected function getFallbackInsights(array $analyticsData): array
    {
        Log::debug('🤖 Returning fallback admin business insights');

        $topRoomType = $analyticsData['top_room_type'] ?? 'Standard';
        $topFeature = $analyticsData['top_feature'] ?? 'wifi';
        $avgDays = round($analyticsData['avg_days'] ?? 2);
        $totalSearches = $analyticsData['total_searches'] ?? 0;
        $allRoomTypes = $analyticsData['all_room_types'] ?? [];
        $roomTypeCount = count($allRoomTypes);

        // Calculate some basic metrics
        $topRoomPercentage = $totalSearches > 0 
            ? round(($analyticsData['top_room_count'] ?? 0) / $totalSearches * 100, 1) 
            : 0;

        return [
            [
                'icon' => 'fa-chart-line',
                'color' => 'from-blue-500 to-blue-700',
                'title' => 'Demand Pattern Analysis',
                'description' => "System processed {$totalSearches} total searches with {$topRoomType} rooms accounting for {$topRoomPercentage}% of demand. Implement dynamic pricing strategies during peak search periods to maximize revenue potential.",
                'cta' => 'View Analytics'
            ],
            [
                'icon' => 'fa-warehouse',
                'color' => 'from-slate-500 to-slate-700',
                'title' => 'Inventory Optimization',
                'description' => "{$topRoomType} rooms consistently receive highest search volume. Review current room allocation and consider converting lower-demand categories to meet {$topRoomType} demand patterns.",
                'cta' => 'Review Inventory'
            ],
            [
                'icon' => 'fa-star',
                'color' => 'from-amber-500 to-amber-700',
                'title' => 'Amenity ROI Priority',
                'description' => "{$topFeature} ranks as the most requested amenity across all searches. Prioritize this feature in room upgrades and renovation budgets to align with guest expectations and increase booking conversion.",
                'cta' => 'Amenity Report'
            ],
            [
                'icon' => 'fa-calendar-days',
                'color' => 'from-emerald-500 to-emerald-700',
                'title' => 'Stay Duration Trends',
                'description' => "Average booking duration is {$avgDays} days system-wide. Create targeted {$avgDays}-day package deals with bundled services to capture this market segment and improve average transaction value.",
                'cta' => 'Package Strategy'
            ],
            [
                'icon' => 'fa-bullseye',
                'color' => 'from-purple-500 to-purple-700',
                'title' => 'Market Segmentation',
                'description' => "Analysis reveals {$roomTypeCount} distinct room category preferences. Develop segment-specific marketing campaigns and pricing tiers to effectively target each customer demographic.",
                'cta' => 'Segment Report'
            ],
            [
                'icon' => 'fa-brain',
                'color' => 'from-indigo-500 to-indigo-700',
                'title' => 'AI System Performance',
                'description' => "Search interpretation AI successfully processed {$totalSearches} queries. Monitor conversion rates from AI-assisted searches versus manual searches to optimize the booking funnel and improve ROI.",
                'cta' => 'System Metrics'
            ]
        ];
    }
}