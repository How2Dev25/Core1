<?php

namespace App\Http\Controllers;

use App\Models\room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
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

    // Fetch room details
   $room = room::where('roomID', $request->roomID)
    ->select('roomtype', 'roomphoto')
    ->first();

$form['roomphoto'] = $room->roomphoto;
$form['roomtype'] = $room->roomtype;

    // Store everything in session
    Session::put('reservation_data', $form);

   return redirect()->back()->with('success', 'Reservation saved successfully!');
}
    
}
