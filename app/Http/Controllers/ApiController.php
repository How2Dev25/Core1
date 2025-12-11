<?php

namespace App\Http\Controllers;

use App\Models\AuditTrails;
use App\Models\DeptAccount;
use App\Models\DeptLogs;
use App\Models\doorlock;
use App\Models\doorlockFrontdesk;
use App\Models\Ecm;
use App\Models\facility;
use App\Models\hotelBilling;
use App\Models\Reservation;
use App\Models\restobillingandpayments;
use App\Models\room;
use App\Models\stockRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Exception;

class ApiController extends Controller
{

    // for admin
    
    public function rooms(Request $request){

      $token = $request->header('Authorization');

       
     if ($token !== 'Bearer ' . env('HOTEL_API_TOKEN')) {
        return response()->json([
            'success' => false,
            'message' => 'Unauthorized. Invalid API token.'
        ], 401);
    }

        try{
             $getroom = room::all();

             return response()->json([
                'success' => true,
                'message' => 'Rooms retrieve uccessfully',
                'data' => $getroom,
             ],200);
        }
        catch (\Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve rooms',
                'data' => $e->getMessage()
            ], 500);
        }
    }

    public function events(Request $request){


    $token = $request->header('Authorization');

       
     if ($token !== 'Bearer ' . env('HOTEL_API_TOKEN')) {
        return response()->json([
            'success' => false,
            'message' => 'Unauthorized. Invalid API token.'
        ], 401);
    }

    try{
        $getEvents = Ecm::where('eventstatus', 'Confirmed')->get();

        return response()->json([
            'success' => true,
            'message' => 'Events Successfully Retrieved',
            'data' => $getEvents,
        ], 200);
    }
    catch(\Exception $e){
        return response()->json([
            'success' => false,
            'message' => 'Failed to get events',
            'data' => $e->getMessage(),
        ], 500);
    }

    }


    public function hotelaccounts(Request $request){
    $token = $request->header('Authorization');

       
     if ($token !== 'Bearer ' . env('HOTEL_API_TOKEN')) {
        return response()->json([
            'success' => false,
            'message' => 'Unauthorized. Invalid API token.'
        ], 401);
    }

        try{
            $hotelaccounts = DeptAccount::select(
            'Dept_no', 'Dept_id', 
            'dept_name', 'employee_name', 'employee_id',
            'role', 'email', 'status',
            )->get();

            return response([
                'success' => true,
                'message' => 'Data Retrieved Successfully',
                'data' => $hotelaccounts,
            ], 200);
        }
        catch(\Exception $e){
            return response([
                'success' => false,
                'message' => 'Failed to retrieve data',
                'data' => $e->getMessage(),
            ], 500);
        }
    }

    public function hoteldeptLogs(Request $request){
        $token = $request->header('Authorization');

       
     if ($token !== 'Bearer ' . env('HOTEL_API_TOKEN')) {
        return response()->json([
            'success' => false,
            'message' => 'Unauthorized. Invalid API token.'
        ], 401);
    }

    try{
        $departmentloghotel = DeptLogs::all();

        return response()->json([
            'success' => true,
            'message' => 'Department Logs Successfully Retrieved',
            'data' => $departmentloghotel,
        ], 200);
    }
    catch(\Exception $e){
        return response()->json([
            'success' => false,
            'message' => 'Department Logs Failed to Fetch',
            'data' => $e->getMessage(),
        ], 500);
    }
    }

    public function hotelaudit(Request $request){
         $token = $request->header('Authorization');

       
     if ($token !== 'Bearer ' . env('HOTEL_API_TOKEN')) {
        return response()->json([
            'success' => false,
            'message' => 'Unauthorized. Invalid API token.'
        ], 401);
    }

    try{
        $gethotelaudit = AuditTrails::all();

        return response()->json([
            'success' => true,
            'message' => 'Successfully Fetched Hotel Audit Trails And Transactions',
            'data' => $gethotelaudit,
        ], 200);
    }
    catch(\Exception $e){
        return response()->json([
            'success' => false,
            'message' => 'Failed to Fetch Hotel Audit Trails And Transactions',
            'data' => $e->getMessage(),
        ], 500);
    }
    }


    // for financials 


public function hotelincome(Request $request)
{
    $token = $request->header('Authorization');

    if ($token !== 'Bearer ' . env('HOTEL_API_TOKEN')) {
        return response()->json([
            'success' => false,
            'message' => 'Unauthorized. Invalid API token.'
        ], 401);
    }

    try {
        $reservations = hotelBilling::all();


        return response()->json([
            'success' => true,
            'message' => 'Hotel Income Successfully Retrieved',
            'data'    => $reservations,
        ], 200);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Failed to retrieve data',
            'error'   => $e->getMessage(),
        ], 500);
    }
}

// for logistics 
    public function stockrequest(Request $request){
    $token = $request->header('Authorization');

        if ($token !== 'Bearer ' . env('HOTEL_API_TOKEN')) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Invalid API token.'
            ], 401);
        }


        try{
            $stockrequest = stockRequest::where('core1_request_status', 'Approved')->get();

            return response()->json([
                'success' => true,
                'message' => 'Data Successfully Retrived',
                'data' => $stockrequest,
            ], 200);
        }
        catch(\Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'Failed to Retrieve Data',
                'data' => $e->getMessage(),
            ], 500);
        }
    }

    // integration wtih restaurant

    public function fetchrestobillingandpayments(Request $request){
         $token = $request->header('Authorization');

        if ($token !== 'Bearer ' . env('HOTEL_API_TOKEN')) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Invalid API token.'
            ], 401);
        }

        try{
            $billingandpaymentsresto = restobillingandpayments::all();

            return response()->json([
                'success' => true,
                'message' => 'Data Successfully Fetched',
                'data' => $billingandpaymentsresto,
            ], 200);
        }
        catch(\Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'Cant fetch data',
                'data' => $e->getMessage(),
            ], 500);
        }
    }


    public function facility(Request $request){
          $token = $request->header('Authorization');

        if ($token !== 'Bearer ' . env('HOTEL_API_TOKEN')) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Invalid API token.'
            ], 401);
        }

        try {
            $facilities = facility::all();

            return response()->json([
                'success' => true,
                'message' => 'Events fetched Successfully',
                'data' => $facilities,
            ], 200);

        }
        catch (\Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'Cant fetch data',
                'data' => $e->getMessage(),
            ], 401);
        }

        
    }

    // door lock 

   public function scanRfid(Request $request)
{
    // Check API token
    $token = $request->header('Authorization');
    if ($token !== 'Bearer ' . env('HOTEL_API_TOKEN')) {
        return response()->json([
            'success' => false,
            'message' => 'Unauthorized. Invalid API token.'
        ], 401);
    }

    // Validate input
    $request->validate([
        'rfid' => 'required|string',
    ]);

    // Find the doorlock with the given RFID
    $doorlock = doorlock::where('rfid', $request->rfid)->first();
    if (!$doorlock) {
        return response()->json([
            'success' => false,
            'message' => 'RFID not found.'
        ], 404);
    }

    // Find corresponding doorlockFrontdesk record
    $doorlockFrontdesk = doorlockFrontdesk::where('doorlockID', $doorlock->doorlockID)->first();
    if (!$doorlockFrontdesk) {
        return response()->json([
            'success' => false,
            'message' => 'No frontdesk record found for this doorlock.'
        ], 404);
    }

    // Toggle status: if 1 → 0, if 0 → 1
    $doorlockFrontdesk->doorlockfrontdesk_status =
        $doorlockFrontdesk->doorlockfrontdesk_status ? 0 : 1;

    $doorlockFrontdesk->save();

    return response()->json([
        'success' => true,
        'message' => 'Doorlock frontdesk status toggled successfully.',
        'status' => $doorlockFrontdesk->doorlockfrontdesk_status, // <-- ESP32 reads this
        'data' => $doorlockFrontdesk
    ]);
}

    public function checkDoorlockStatus($doorlockID)
{
    $doorlockFrontdesk = doorlockFrontdesk::where('doorlockID', $doorlockID)->first();

    if (!$doorlockFrontdesk) {
        return response()->json(['success' => false, 'message' => 'Doorlock not found'], 404);
    }

    return response()->json([
        'success' => true,
        'status' => $doorlockFrontdesk->doorlockfrontdesk_status
    ]);
}


}
