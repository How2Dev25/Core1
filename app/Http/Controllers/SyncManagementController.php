<?php

namespace App\Http\Controllers;

use App\Models\SyncQueue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class SyncManagementController extends Controller
{
    /**
     * Display the sync management dashboard
     */
    public function index()
    {
        $title = 'Sync Management';
        return view('admin.syncmanagement', compact('title'));
    }

    /**
     * Get sync statistics
     */
    public function getSyncStats()
    {
        try {
            $pending = SyncQueue::where('synced', false)->count();
            $syncedToday = SyncQueue::where('synced', true)
                ->whereDate('updated_at', today())
                ->count();
            
            // Get failed count from logs (last 24 hours)
            $failedToday = $this->getFailedSyncCount();
            
            $lastSync = SyncQueue::where('synced', true)
                ->orderBy('updated_at', 'desc')
                ->value('updated_at');

            return response()->json([
                'pending' => $pending,
                'synced_today' => $syncedToday,
                'failed_today' => $failedToday,
                'last_sync' => $lastSync ? $lastSync->diffForHumans() : 'Never'
            ]);
        } catch (\Exception $e) {
            Log::error('Error getting sync stats', ['error' => $e->getMessage()]);
            return response()->json([
                'pending' => 0,
                'synced_today' => 0,
                'failed_today' => 0,
                'last_sync' => 'Error'
            ], 500);
        }
    }

    /**
     * Get pending sync queue items
     */
    public function getSyncQueue()
    {
        try {
            $items = SyncQueue::where('synced', false)
                ->orderBy('created_at', 'desc')
                ->limit(50)
                ->get(['id', 'model_name', 'action', 'record_id', 'created_at']);

            return response()->json($items);
        } catch (\Exception $e) {
            Log::error('Error getting sync queue', ['error' => $e->getMessage()]);
            return response()->json([], 500);
        }
    }

    /**
     * Get sync logs
     */
    public function getSyncLogs()
    {
        try {
            $logs = [];
            
            // Get logs from file (last 50 entries)
            $logFile = storage_path('logs/laravel.log');
            if (file_exists($logFile)) {
                $lines = file($logFile);
                $lines = array_slice($lines, -50); // Get last 50 lines
                
                foreach (array_reverse($lines) as $line) {
                    if (strpos($line, 'Sync') !== false) {
                        $logs[] = [
                            'timestamp' => $this->extractTimestamp($line),
                            'level' => $this->extractLogLevel($line),
                            'message' => $this->cleanLogMessage($line)
                        ];
                    }
                }
            }

            // Add recent sync queue activity
            $recentActivity = SyncQueue::orderBy('updated_at', 'desc')
                ->limit(10)
                ->get(['model_name', 'action', 'synced', 'updated_at']);

            foreach ($recentActivity as $activity) {
                $logs[] = [
                    'timestamp' => $activity->updated_at,
                    'level' => $activity->synced ? 'SUCCESS' : 'PENDING',
                    'message' => "Sync {$activity->action} for {$activity->model_name} - " . ($activity->synced ? 'Completed' : 'Pending')
                ];
            }

            // Sort by timestamp
            usort($logs, function($a, $b) {
                return strtotime($b['timestamp']) - strtotime($a['timestamp']);
            });

            return response()->json(array_slice($logs, 0, 50));
        } catch (\Exception $e) {
            Log::error('Error getting sync logs', ['error' => $e->getMessage()]);
            return response()->json([], 500);
        }
    }

    /**
     * Test sync connection to domain
     */
    public function testSyncConnection()
    {
        try {
            $domainApi = 'https://hotel.soliera-hotel-restaurant.com/api/test-connection';
            
            $response = Http::withToken(env('HOTEL_API_TOKEN'))
                ->timeout(10)
                ->get($domainApi);

            if ($response->successful()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Domain server is reachable and API is working.'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Domain server responded with error: ' . $response->status()
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot reach domain server: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Delete sync queue item
     */
    public function deleteSyncItem($id)
    {
        try {
            $item = SyncQueue::findOrFail($id);
            $item->delete();
            
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error('Error deleting sync item', ['id' => $id, 'error' => $e->getMessage()]);
            return response()->json(['success' => false], 500);
        }
    }

    /**
     * Manual sync trigger
     */
    public function manualSync()
    {
        try {
            $unsynced = SyncQueue::where('synced', false)->get();
            $domainApi = 'https://hotel.soliera-hotel-restaurant.com/api/push-offline-data';
            $successCount = 0;
            $errorCount = 0;
            
            Log::info('Manual sync started', ['unsynced_count' => $unsynced->count()]);

            foreach ($unsynced as $row) {
                try {
                    $payload = is_string($row->payload) ? json_decode($row->payload, true) : $row->payload;
                    
                    if (!$payload) {
                        Log::error('Failed to decode payload', ['sync_queue_id' => $row->id]);
                        $errorCount++;
                        continue;
                    }

                    $response = Http::withToken(env('HOTEL_API_TOKEN'))
                        ->withHeaders([
                            'Content-Type' => 'application/json',
                            'Accept' => 'application/json'
                        ])
                        ->post($domainApi, [
                            'model_name' => $row->model_name,
                            'action' => $row->action,
                            'payload' => $payload,
                        ]);

                    if ($response->successful()) {
                        $row->update(['synced' => true]);
                        $successCount++;
                        Log::info('Manual sync successful', [
                            'sync_queue_id' => $row->id,
                            'model' => $row->model_name,
                            'action' => $row->action
                        ]);
                    } else {
                        $errorCount++;
                        Log::error('Manual sync failed', [
                            'sync_queue_id' => $row->id,
                            'model' => $row->model_name,
                            'action' => $row->action,
                            'status' => $response->status(),
                            'response' => $response->body()
                        ]);
                    }
                } catch (\Exception $e) {
                    $errorCount++;
                    Log::error('Manual sync exception', [
                        'sync_queue_id' => $row->id,
                        'model' => $row->model_name,
                        'error' => $e->getMessage()
                    ]);
                }
            }

            $message = "Manual sync completed: {$successCount} successful, {$errorCount} failed";
            Log::info('Manual sync process completed', ['success' => $successCount, 'errors' => $errorCount]);
            
            return response()->json([
                'status' => 'completed',
                'success_count' => $successCount,
                'error_count' => $errorCount,
                'message' => $message
            ]);
        } catch (\Exception $e) {
            Log::error('Manual sync error', ['error' => $e->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get failed sync count from logs
     */
    private function getFailedSyncCount()
    {
        try {
            $logFile = storage_path('logs/laravel.log');
            if (!file_exists($logFile)) {
                return 0;
            }

            $content = file_get_contents($logFile);
            $yesterday = now()->subDay()->format('Y-m-d');
            
            // Count error logs containing "Sync" from yesterday onwards
            preg_match_all("/\[$yesterday.*?ERROR.*?Sync.*?/", $content, $matches);
            
            return count($matches[0]);
        } catch (\Exception $e) {
            return 0;
        }
    }

    /**
     * Extract timestamp from log line
     */
    private function extractTimestamp($line)
    {
        if (preg_match('/\[(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})/', $line, $matches)) {
            return $matches[1];
        }
        return now()->format('Y-m-d H:i:s');
    }

    /**
     * Extract log level from log line
     */
    private function extractLogLevel($line)
    {
        if (strpos($line, 'ERROR') !== false) return 'ERROR';
        if (strpos($line, 'SUCCESS') !== false) return 'SUCCESS';
        if (strpos($line, 'INFO') !== false) return 'INFO';
        if (strpos($line, 'WARNING') !== false) return 'WARNING';
        return 'INFO';
    }

    /**
     * Clean log message
     */
    private function cleanLogMessage($line)
    {
        // Remove timestamp and level
        $message = preg_replace('/^\[\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}\].*?\] /', '', $line);
        // Remove extra JSON data for cleaner display
        $message = preg_replace('/\{.*?\}$/', '', $message);
        return trim($message);
    }
}
