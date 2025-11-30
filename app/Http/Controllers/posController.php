<?php

namespace App\Http\Controllers;

use App\Models\room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\ReservationPOS;
class posController extends Controller
{
   public function submitRoom(Request $request)
{
    $form = $request->validate([
        'roomID' => 'required',
        'reservation_checkin' => 'required',
        'reservation_checkout' => 'required',
        'reservation_specialrequest' => 'required',
        'reservation_numguest' => 'required',
        'guestname' => 'required',
        'guestphonenumber' => 'required',
        'guestemailaddress' => 'required',
        'guestbirthday' => 'required',
        'guestaddress' => 'required',
        'guestcontactperson' => 'required',
        'guestcontactpersonnumber' => 'required',
        'subtotal' => 'required',
        'vat' => 'required',
        'serviceFee' => 'required',
        'total' => 'required',
    ]);

    $form['employeeID'] = Auth::user()->Dept_no;

    ReservationPOS::create($form);

    

   return redirect()->back()->with('success', 'Reservation saved successfully!');
}


public function removeroom(ReservationPOS $reservationposID){
    $reservationposID->delete();

     return redirect()->back()->with('success', 'Reservation removed successfully!');
}
    
}
