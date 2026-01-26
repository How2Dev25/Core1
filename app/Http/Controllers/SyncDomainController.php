<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Carbon\Carbon;

class SyncDomainController extends Controller
{
    /**
     * Display the domain sync management dashboard
     */
    public function index()
    {
        $title = 'Sync Domain Management';
        return view('admin.sync_domain_management', compact('title'));
    }

    /**
     * Get sync statistics for domain
     */
    public function getDomainStats()
    {
        try {
            // Create sync_data table if it doesn't exist
            $this->ensureSyncDataTable();

            $stats = [
                'pending' => DB::table('sync_data')->where('status', 'pending')->count(),
                'accepted_today' => DB::table('sync_data')
                    ->where('status', 'accepted')
                    ->whereDate('processed_at', today())
                    ->count(),
                'rejected_today' => DB::table('sync_data')
                    ->where('status', 'rejected')
                    ->whereDate('processed_at', today())
                    ->count(),
                'total_processed' => DB::table('sync_data')
                    ->whereIn('status', ['accepted', 'rejected'])
                    ->count(),
            ];

            return response()->json($stats);
        } catch (\Exception $e) {
            Log::error('Error getting domain stats', ['error' => $e->getMessage()]);
            return response()->json([
                'pending' => 0,
                'accepted_today' => 0,
                'rejected_today' => 0,
                'total_processed' => 0
            ], 500);
        }
    }

    /**
     * Get sync data with pagination
     */
    public function getDomainData(Request $request)
    {
        try {
            $this->ensureSyncDataTable();

            $page = $request->get('page', 1);
            $limit = $request->get('limit', 20);
            $offset = ($page - 1) * $limit;

            $query = DB::table('sync_data')
                ->orderBy('created_at', 'desc');

            $total = $query->count();
            $data = $query->offset($offset)->limit($limit)->get();

            return response()->json([
                'data' => $data,
                'total' => $total,
                'page' => $page,
                'limit' => $limit
            ]);
        } catch (\Exception $e) {
            Log::error('Error getting domain data', ['error' => $e->getMessage()]);
            return response()->json(['data' => [], 'total' => 0], 500);
        }
    }

    /**
     * Accept a sync record
     */
    public function acceptRecord($id)
    {
        try {
            $record = DB::table('sync_data')->where('id', $id)->first();
            
            if (!$record) {
                return response()->json(['success' => false, 'message' => 'Record not found'], 404);
            }

            if ($record->status !== 'pending') {
                return response()->json(['success' => false, 'message' => 'Record already processed'], 400);
            }

            // Process the sync operation
            $success = $this->processSyncOperation($record);

            if ($success) {
                DB::table('sync_data')
                    ->where('id', $id)
                    ->update([
                        'status' => 'accepted',
                        'processed_at' => now(),
                        'error_message' => null
                    ]);

                Log::info('Sync record accepted', ['id' => $id, 'model' => $record->model_name]);
                return response()->json(['success' => true, 'message' => 'Record accepted successfully']);
            } else {
                DB::table('sync_data')
                    ->where('id', $id)
                    ->update([
                        'status' => 'rejected',
                        'processed_at' => now(),
                        'error_message' => 'Failed to process sync operation'
                    ]);

                return response()->json(['success' => false, 'message' => 'Failed to process sync operation']);
            }
        } catch (\Exception $e) {
            Log::error('Error accepting record', ['id' => $id, 'error' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => 'Server error'], 500);
        }
    }

    /**
     * Reject a sync record
     */
    public function rejectRecord($id)
    {
        try {
            $record = DB::table('sync_data')->where('id', $id)->first();
            
            if (!$record) {
                return response()->json(['success' => false, 'message' => 'Record not found'], 404);
            }

            if ($record->status !== 'pending') {
                return response()->json(['success' => false, 'message' => 'Record already processed'], 400);
            }

            DB::table('sync_data')
                ->where('id', $id)
                ->update([
                    'status' => 'rejected',
                    'processed_at' => now(),
                    'error_message' => 'Rejected by administrator'
                ]);

            Log::info('Sync record rejected', ['id' => $id, 'model' => $record->model_name]);
            return response()->json(['success' => true, 'message' => 'Record rejected successfully']);
        } catch (\Exception $e) {
            Log::error('Error rejecting record', ['id' => $id, 'error' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => 'Server error'], 500);
        }
    }

    /**
     * Batch action on multiple records
     */
    public function batchAction(Request $request)
    {
        try {
            $request->validate([
                'action' => 'required|in:accept,reject',
                'record_ids' => 'required|array',
                'record_ids.*' => 'integer'
            ]);

            $action = $request->action;
            $recordIds = $request->record_ids;
            $processed = 0;
            $errors = 0;

            foreach ($recordIds as $id) {
                try {
                    if ($action === 'accept') {
                        $result = $this->acceptRecord($id);
                        if ($result->getStatusCode() === 200) $processed++;
                        else $errors++;
                    } else {
                        $result = $this->rejectRecord($id);
                        if ($result->getStatusCode() === 200) $processed++;
                        else $errors++;
                    }
                } catch (\Exception $e) {
                    $errors++;
                    Log::error('Batch action error', ['id' => $id, 'error' => $e->getMessage()]);
                }
            }

            Log::info("Batch {$action} completed", ['processed' => $processed, 'errors' => $errors]);
            return response()->json([
                'success' => true,
                'message' => "Batch {$action} completed: {$processed} processed, {$errors} errors"
            ]);
        } catch (\Exception $e) {
            Log::error('Batch action error', ['error' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => 'Server error'], 500);
        }
    }

    /**
     * Clear processed records
     */
    public function clearProcessed()
    {
        try {
            $deleted = DB::table('sync_data')
                ->whereIn('status', ['accepted', 'rejected'])
                ->delete();

            Log::info('Processed records cleared', ['count' => $deleted]);
            return response()->json(['success' => true, 'message' => "Cleared {$deleted} processed records"]);
        } catch (\Exception $e) {
            Log::error('Error clearing processed records', ['error' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => 'Server error'], 500);
        }
    }

    /**
     * Enhanced receiveData method that stores in sync_data table
     */
    public function receiveDataEnhanced(Request $request)
    {
        try {
            $request->validate([
                'model_name' => 'required|string',
                'action'     => 'required|in:insert,update,delete',
                'payload'    => 'required|array',
            ]);

            $token = $request->header('Authorization');
            if ($token !== 'Bearer ' . env('HOTEL_API_TOKEN')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized. Invalid API token.'
                ], 401);
            }

            $this->ensureSyncDataTable();

            // Store incoming data for review
            $syncId = DB::table('sync_data')->insertGetId([
                'model_name' => $request->model_name,
                'action' => $request->action,
                'record_id' => $this->extractRecordId($request->payload, $request->model_name),
                'payload' => json_encode($request->payload),
                'source_ip' => $request->ip(),
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now()
            ]);

            Log::info('Sync data received and stored for review', [
                'sync_id' => $syncId,
                'model' => $request->model_name,
                'action' => $request->action
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data received and pending review',
                'sync_id' => $syncId
            ]);
        } catch (\Exception $e) {
            Log::error('Error receiving sync data', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Server error while processing data'
            ], 500);
        }
    }

    /**
     * Process the actual sync operation
     */
    private function processSyncOperation($record)
    {
        try {
            $payload = json_decode($record->payload, true);
            $modelName = $record->model_name;
            $action = $record->action;

            // Use the same logic as your original receiveData method
            // but with the enhanced error handling and table mapping
            return $this->executeSyncOperation($modelName, $action, $payload);
        } catch (\Exception $e) {
            Log::error('Error processing sync operation', [
                'sync_id' => $record->id,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    private function resolveTableForModel(string $modelName, ?string $mappedTable): array
    {
        $candidates = [];
        if (is_string($mappedTable) && $mappedTable !== '') {
            $candidates[] = $mappedTable;
        }

        if ($modelName === 'Reservation') {
            $candidates[] = 'core1_reservation';
            $candidates[] = 'reservations';
            $candidates[] = 'reservation';
        }

        if ($modelName === 'ReservationPOS') {
            $candidates[] = 'core1_reservation_pos';
            $candidates[] = 'reservation_pos';
            $candidates[] = 'reservationpos';
        }

        $snake = Str::snake($modelName);
        $candidates[] = $snake;
        $candidates[] = Str::plural($snake);
        $candidates[] = Str::singular($snake);

        $expanded = [];
        foreach ($candidates as $c) {
            if (!is_string($c) || $c === '') {
                continue;
            }
            $expanded[] = $c;
            if (Str::startsWith($c, 'core1_')) {
                $expanded[] = Str::after($c, 'core1_');
            } else {
                $expanded[] = 'core1_' . $c;
            }
        }

        $unique = array_values(array_unique($expanded));
        foreach ($unique as $table) {
            if (Schema::hasTable($table)) {
                return [$table, $unique];
            }
        }

        return [null, $unique];
    }

    private function primaryKeyCandidates(string $modelName, string $mappedPrimaryKey): array
    {
        $keys = [$mappedPrimaryKey, 'id'];

        if ($modelName === 'Reservation') {
            $keys[] = 'reservationID';
            $keys[] = 'reservation_id';
        }

        if ($modelName === 'ReservationPOS') {
            $keys[] = 'reservationposID';
            $keys[] = 'reservationpos_id';
        }

        return array_values(array_unique($keys));
    }

    private function findFirstPayloadKey(array $payload, array $keys): ?array
    {
        foreach ($keys as $k) {
            if (array_key_exists($k, $payload) && $payload[$k] !== null && $payload[$k] !== '') {
                return [$k, $payload[$k]];
            }
        }
        return null;
    }

    /**
     * Execute the actual database operation
     */
    private function executeSyncOperation($modelName, $action, $payload)
    {
        // Static table mapping (same as your FIXED_SYNC_METHOD)
        $tableMapping = [
            'Reservation' => 'core1_reservation',
            'ReservationPOS' => 'core1_reservation_pos',
            'AuditTrails' => 'dept_audit_trail_transaction',
            'employeenotification' => 'employeenotification',
            // Add more mappings as needed
        ];

        $primaryKeyMapping = [
            'Reservation' => 'reservationID',
            'ReservationPOS' => 'reservationposID',
            'AuditTrails' => 'at_id',
            'employeenotification' => 'notificationempID',
            // Add more mappings as needed
        ];

        $mappedTable = $tableMapping[$modelName] ?? null;
        [$table, $triedTables] = $this->resolveTableForModel($modelName, $mappedTable);

        if (!$table) {
            Log::error("No matching table found on DB for model", ['model' => $modelName, 'tried' => $triedTables]);
            return false;
        }

        $primaryKeyCandidates = $this->primaryKeyCandidates($modelName, $primaryKeyMapping[$modelName] ?? 'id');
        $primaryKey = $primaryKeyCandidates[0] ?? 'id';

        DB::beginTransaction();

        try {
            switch ($action) {
                case 'insert':
                    // Handle duplicate check for AuditTrails
                    if ($modelName === 'AuditTrails' && isset($payload['at_id'])) {
                        $exists = DB::table($table)->where('at_id', $payload['at_id'])->exists();
                        if ($exists) {
                            Log::info("AuditTrails record already exists, skipping", ['at_id' => $payload['at_id']]);
                            DB::commit();
                            return true; // Not an error, just skip
                        }
                    }
                    $insertData = $payload;
                    foreach ($primaryKeyCandidates as $pk) {
                        if (array_key_exists($pk, $insertData) && ($insertData[$pk] === null || $insertData[$pk] === '')) {
                            unset($insertData[$pk]);
                        }
                    }
                    DB::table($table)->insert($insertData);
                    break;

                case 'update':
                    $match = $this->findFirstPayloadKey($payload, $primaryKeyCandidates);
                    if (!$match) {
                        throw new \Exception("No valid record ID found for update. Tried: " . implode(', ', $primaryKeyCandidates));
                    }
                    [$whereKey, $whereVal] = $match;
                    DB::table($table)->where($whereKey, $whereVal)->update($payload);
                    break;

                case 'delete':
                    $match = $this->findFirstPayloadKey($payload, $primaryKeyCandidates);
                    if (!$match) {
                        throw new \Exception("No valid record ID found for delete. Tried: " . implode(', ', $primaryKeyCandidates));
                    }
                    [$whereKey, $whereVal] = $match;
                    DB::table($table)->where($whereKey, $whereVal)->delete();
                    break;
            }

            DB::commit();
            Log::info("Sync operation successful", [
                'model' => $modelName,
                'action' => $action,
                'table' => $table,
                'primary_key' => $primaryKey
            ]);
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Sync operation failed", [
                'model' => $modelName,
                'action' => $action,
                'table' => $table,
                'primary_key' => $primaryKey,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    /**
     * Extract record ID from payload
     */
    private function extractRecordId($payload, $modelName)
    {
        $primaryKeyMapping = [
            'Reservation' => 'reservationID',
            'ReservationPOS' => 'reservationposID',
            'AuditTrails' => 'at_id',
            'employeenotification' => 'notificationempID',
        ];

        $candidates = $this->primaryKeyCandidates($modelName, $primaryKeyMapping[$modelName] ?? 'id');
        $match = $this->findFirstPayloadKey($payload, $candidates);
        return $match ? $match[1] : null;
    }

    /**
     * Get record ID from payload with fallbacks
     */
    private function getRecordId($payload, $primaryKey)
    {
        return $payload[$primaryKey] ?? $payload['id'] ?? null;
    }

    /**
     * Ensure sync_data table exists
     */
    private function ensureSyncDataTable()
    {
        if (!DB::getSchemaBuilder()->hasTable('sync_data')) {
            DB::statement("
                CREATE TABLE sync_data (
                    id BIGINT PRIMARY KEY AUTO_INCREMENT,
                    model_name VARCHAR(255) NOT NULL,
                    action ENUM('insert', 'update', 'delete') NOT NULL,
                    record_id VARCHAR(255),
                    payload JSON NOT NULL,
                    source_ip VARCHAR(45),
                    status ENUM('pending', 'accepted', 'rejected') DEFAULT 'pending',
                    error_message TEXT,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                    processed_at TIMESTAMP NULL
                )
            ");

            // Add indexes for better performance
            DB::statement("CREATE INDEX idx_sync_data_status ON sync_data(status)");
            DB::statement("CREATE INDEX idx_sync_data_model ON sync_data(model_name)");
            DB::statement("CREATE INDEX idx_sync_data_created ON sync_data(created_at)");
        }
    }
}
