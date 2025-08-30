<?php

namespace App\Http\Controllers;

use App\Models\DeptAccount;
use App\Models\Ecm;
use App\Models\Reservation;
use App\Models\room;
use App\Models\stockRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
                'success' => 'true',
                'message' => 'Rooms retrieve uccessfully',
                'data' => $getroom,
             ],200);
        }
        catch (\Exception $e){
            return response()->json([
                'success' => 'false',
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
        $getEvents = Ecm::where('eventstatus', 'Approved')->get();

        return response()->json([
            'success' => 'true',
            'message' => 'Events Successfully Retrieved',
            'data' => $getEvents,
        ], 200);
    }
    catch(\Exception $e){
        return response()->json([
            'success' => 'false',
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
                'success' => 'true',
                'message' => 'Data Retrieved Successfully',
                'data' => $hotelaccounts,
            ], 200);
        }
        catch(\Exception $e){
            return response([
                'success' => 'false',
                'message' => 'Failed to retrieve data',
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
        $reservations = Reservation::join('core1_room', 'core1_room.roomID', '=', 'core1_reservation.roomID')
            ->where('payment_status', 'Paid')
            ->select('core1_reservation.*', 'core1_room.roomprice', 'core1_room.roomtype')
            ->get();

        $data = $reservations->map(function ($res) {
            $checkin  = Carbon::parse($res->reservation_checkin);
            $checkout = Carbon::parse($res->reservation_checkout);
            $nights   = max(1, $checkin->diffInDays($checkout));

            $subtotal   = $res->roomprice * $nights;
            $vat        = $subtotal * 0.12;
            $serviceFee = $subtotal * 0.02;
            $total      = $subtotal + $vat + $serviceFee;

            return [
                'reservationID'   => $res->reservationID,
                'bookingID'       => $res->bookingID,
                'receiptID'       => $res->reservation_receipt,
                'payment_method'  => $res->payment_method,
                'guestname'       => $res->guestname,
                'roomtype'        => $res->roomtype,
                'nights'          => $nights,
                'roomprice'       => $res->roomprice,
                'subtotal'        => $subtotal,
                'vat_12'          => $vat,
                'service_fee_2'   => $serviceFee,
                'total'           => $total,
            ];
        });

        return response()->json([
            'success' => true,
            'message' => 'Hotel Income Successfully Retrieved',
            'data'    => $data,
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
                'success' => 'true',
                'message' => 'Data Successfully Retrived',
                'data' => $stockrequest,
            ], 200);
        }
        catch(\Exception $e){
            return response()->json([
                'success' => 'true',
                'message' => 'Failed to Retrieve Data',
                'data' => $e->getMessage(),
            ], 500);
        }
    }



}
