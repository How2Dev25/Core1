<?php

namespace App\Http\Controllers;

use App\Models\AuditTrails;
use App\Models\DeptAccount;
use App\Models\DeptLogs;
use App\Models\doorlock;
use App\Models\doorlockFrontdesk;
use App\Models\Ecm;
use App\Models\EmployeeReport;
use App\Models\facility;
use App\Models\hotelBilling;
use App\Models\kotresto;
use App\Models\ordersfromresto;
use App\Models\requestEmployee;
use App\Models\Reservation;
use App\Models\restobillingandpayments;
use App\Models\rfidHistory;
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

    
    public function fetchKOT(Request $request){
        $token = $request->header('Authorization');

        if ($token !== 'Bearer ' . env('HOTEL_API_TOKEN')) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Invalid API token.'
            ], 401);
        }

        try {
            $fetchKot = kotresto::all();

            return response()->json([
                'success' => true,
                'message' => 'Success',
                'data' => $fetchKot,
            ], 200);
        }

        catch(\Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'Failed',
                'data' => $e->getMessage(),
            ], 401);
        }
    }

    public function cookKOT(Request $request, $order_id){
        $token = $request->header('Authorization');

        if ($token !== 'Bearer ' . env('HOTEL_API_TOKEN')) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Invalid API token.'
            ], 401);
        }

        kotresto::where('order_id', $order_id)->update([
            'status' => 'cook',
        ]);

      ordersfromresto::where('orderID', $order_id)->update([
    'order_status' => 'Cooking',
        ]);

   return response()->json([
    'success' => true,
    'order_id' => $order_id,
    'status' => 'Cooking',
    'message' => "Order {$order_id} is now cooking"
]);

    }

    // facilities
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


       $doorStateText = $doorlockFrontdesk->doorlockfrontdesk_status
        ? 'Unlocked'
        : 'Locked';

    // 📝 Save to history_logs
    rfidHistory::create([
        'doorlockID' => $doorlock->doorlockID,
        'door_state' => $doorStateText,
    ]);

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


// Core Human Integration

    public function requestEmployee(Request $request){
      $token = $request->header('Authorization');

        if ($token !== 'Bearer ' . env('HOTEL_API_TOKEN')) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Invalid API token.'
            ], 401);
        }

        try{
            $requestEmployee = requestEmployee::all();

            return response()->json([
                'success' => true,
                'message' => 'Data Fetched Succesfully',
                'data' =>  $requestEmployee,
            ],200);
        }
        catch(\Exception $e){
             return response()->json([
                'success' => false,
                'message' => 'Cant fetch data',
                'data' => $e->getMessage(),
            ], 401);
        }
    }


    public function approveEmployeeRequest(Request $request, $requestempID){
         $token = $request->header('Authorization');

        if ($token !== 'Bearer ' . env('HOTEL_API_TOKEN')) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Invalid API token.'
            ], 401);
        }


    $requestEmployee = requestEmployee::find($requestempID);
    if (!$requestEmployee) {
        return response()->json([
            'success' => false,
            'message' => 'Request not found.'
        ], 404);
    }
    $requestEmployee->status = 'Approved';
    $requestEmployee->save();

    return response()->json([
        'success' => true,
        'message' => 'Request approved successfully.',
        'data' => $requestEmployee
    ], 200);
       

    }


     public function rejectEmployeeRequest(Request $request, $requestempID){
         $token = $request->header('Authorization');

        if ($token !== 'Bearer ' . env('HOTEL_API_TOKEN')) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Invalid API token.'
            ], 401);
        }


    $requestEmployee = requestEmployee::find($requestempID);
    if (!$requestEmployee) {
        return response()->json([
            'success' => false,
            'message' => 'Request not found.'
        ], 404);
    }
    $requestEmployee->status = 'Rejected';
    $requestEmployee->save();

    return response()->json([
        'success' => true,
        'message' => 'Request approved successfully.',
        'data' => $requestEmployee
    ], 200);
       

    }




     public function reportEmployee(Request $request){
      $token = $request->header('Authorization');

        if ($token !== 'Bearer ' . env('HOTEL_API_TOKEN')) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Invalid API token.'
            ], 401);
        }

        try{
            $reportEmployee = EmployeeReport::all();

            return response()->json([
                'success' => true,
                'message' => 'Data Fetched Succesfully',
                'data' =>  $reportEmployee,
            ],200);
        }
        catch(\Exception $e){
             return response()->json([
                'success' => false,
                'message' => 'Cant fetch data',
                'data' => $e->getMessage(),
            ], 401);
        }
    }


    public function resolvedEmployee(Request $request, $reportID){
         $token = $request->header('Authorization');

        if ($token !== 'Bearer ' . env('HOTEL_API_TOKEN')) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Invalid API token.'
            ], 401);
        }

        $resolveemployee = EmployeeReport::findOrFail($reportID);

        if(!$resolveemployee){
            return response()->json([
                'success' => false,
                'message' => 'Request Not Found',
            ], 400);
        }

        $resolveemployee->status = 'Resolved';
        $resolveemployee->save();

        return response()->json([

            'success' => true,
            'message' => 'Status Has been set to Resolved',
            'data' => $resolveemployee,
        ], 200);
    }





   


}
