<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class SyncApiController extends Controller
{
    // Simple model to table mapping - just copy this to your domain
    private $modelTableMap = [
        'AuditTrails' => 'dept_audit_trail_transaction',
        'Channel' => 'channels',
        'DeptAccount' => 'dept_account',
        'DeptLogs' => 'dept_logs',
        'Ecm' => 'ecm',
        'EmployeeReport' => 'employee_report',
        'Glar' => 'glar',
        'Guest' => 'guests',
        'Hmp' => 'hmp',
        'Inventory' => 'inventory',
        'Lar' => 'lar',
        'Like' => 'likes',
        'Posts' => 'posts',
        'Reservation' => 'core1_reservation',
        'ReservationPOS' => 'core1_reservation_pos',
        'additionalBooking' => 'additional_booking',
        'additionalBookingCart' => 'additional_booking_cart',
        'additionalRoom' => 'additional_room',
        'additionalinfoadmin' => 'additional_info_admin',
        'aiPrompt' => 'ai_prompt',
        'channelListings' => 'channel_listings',
        'doorlock' => 'doorlock',
        'doorlockFrontdesk' => 'doorlock_frontdesk',
        'dynamicBilling' => 'dynamic_billing',
        'ecmtype' => 'ecm_type',
        'employeenotification' => 'employeenotification',
        'EmployeeReport' => 'employee_report',
        'eventPOS' => 'event_pos',
        'facility' => 'facility',
        'guestRatings' => 'guest_ratings',
        'guestloyaltypoints' => 'guest_loyalty_points',
        'guestnotification' => 'guest_notification',
        'hotelBilling' => 'hotel_billing',
        'inventoryPOS' => 'inventory_pos',
        'kotresto' => 'kot_resto',
        'loyaltyrules' => 'loyalty_rules',
        'missingRFID' => 'missing_rfid',
        'ordersfromresto' => 'orders_from_resto',
        'postComments' => 'post_comments',
        'reportPost' => 'report_post',
        'requestEmployee' => 'request_employee',
        'restoCart' => 'resto_cart',
        'restobillingandpayments' => 'resto_billing_and_payments',
        'restointegration' => 'resto_integration',
        'rfidHistory' => 'rfid_history',
        'room' => 'rooms',
        'room_maintenance' => 'room_maintenance',
        'roomfeedbacks' => 'room_feedbacks',
        'roomtypes' => 'room_types',
        'stockRequest' => 'stock_request',
        'SyncQueue' => 'sync_queue',
    ];

    // Primary key mapping for common models
    private $primaryKeyMap = [
        'AuditTrails' => 'at_id',
        'Guest' => 'guest_id',
        'Reservation' => 'reservationID',
        'ReservationPOS' => 'reservationposID',
        'employeenotification' => 'notificationempID',
        'room' => 'room_id',
        'facility' => 'facility_id',
        // Add more as needed
    ];

    private function resolveTableForModel(string $modelName): array
    {
        $mapped = $this->modelTableMap[$modelName] ?? null;

        $candidates = [];
        if (is_string($mapped) && $mapped !== '') {
            $candidates[] = $mapped;
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

    private function primaryKeyCandidates(string $modelName): array
    {
        $mapped = $this->primaryKeyMap[$modelName] ?? 'id';
        $keys = [$mapped, 'id'];

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

    public function receiveData(Request $request)
    {
        $request->validate([
            'model_name' => 'required|string',
            'action' => 'required|in:insert,update,delete',
            'payload' => 'required|array',
        ]);

        $token = $request->header('Authorization');

        if ($token !== 'Bearer ' . env('HOTEL_API_TOKEN')) {
            Log::error('Unauthorized sync attempt', ['token' => $token]);
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Invalid API token.'
            ], 401);
        }

        $modelName = $request->model_name;
        $action = $request->action;
        $payload = $request->payload;

        [$table, $triedTables] = $this->resolveTableForModel($modelName);
        if (!$table) {
            Log::error("Table not found for model", ['model' => $modelName, 'tried' => $triedTables]);
            return response()->json([
                'status' => 'error',
                'message' => "No matching table found on DB for model: $modelName",
                'tried_tables' => $triedTables
            ], 400);
        }

        $primaryKeyCandidates = $this->primaryKeyCandidates($modelName);
        $primaryKey = $primaryKeyCandidates[0] ?? 'id';

        try {
            DB::beginTransaction();

            switch ($action) {
                case 'insert':
                    // Remove primary key if present to avoid conflicts
                    $insertData = $payload;
                    foreach ($primaryKeyCandidates as $pk) {
                        if (array_key_exists($pk, $insertData) && ($insertData[$pk] === null || $insertData[$pk] === '')) {
                            unset($insertData[$pk]);
                        }
                    }
                    DB::table($table)->insert($insertData);
                    Log::info("Data inserted successfully", ['table' => $table, 'data' => $insertData]);
                    break;

                case 'update':
                    $match = $this->findFirstPayloadKey($payload, $primaryKeyCandidates);
                    if (!$match) {
                        throw new \Exception("No primary key found in payload for update. Tried: " . implode(', ', $primaryKeyCandidates));
                    }
                    [$whereKey, $whereVal] = $match;
                    DB::table($table)
                        ->where($whereKey, $whereVal)
                        ->update($payload);
                    Log::info("Data updated successfully", ['table' => $table, 'id' => $whereVal, 'primary_key' => $whereKey, 'data' => $payload]);
                    break;

                case 'delete':
                    $match = $this->findFirstPayloadKey($payload, $primaryKeyCandidates);
                    if (!$match) {
                        throw new \Exception("No primary key found in payload for delete. Tried: " . implode(', ', $primaryKeyCandidates));
                    }
                    [$whereKey, $whereVal] = $match;
                    DB::table($table)
                        ->where($whereKey, $whereVal)
                        ->delete();
                    Log::info("Data deleted successfully", ['table' => $table, 'id' => $whereVal, 'primary_key' => $whereKey]);
                    break;
            }

            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => "Sync operation {$action} completed successfully"
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Sync operation failed", [
                'action' => $action,
                'model' => $modelName,
                'table' => $table,
                'payload' => $payload,
                'error' => $e->getMessage()
            ]);
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
