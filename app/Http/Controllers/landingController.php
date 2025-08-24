<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\room;
use App\Models\additionalRoom;
use App\Models\Reservation;

class landingController extends Controller
{
   public function selectedroom($roomID){
        $room = room::where('roomID', $roomID)->first();
        $roomphotos = additionalRoom::
        join('core1_room', 'core1_room.roomID', '=', 'core1_roomphotos.roomID')
        ->where('core1_roomphotos.roomID', $roomID)
        ->latest('core1_roomphotos.created_at')
        ->get();

        return view('booking.roomselected', ['room' => $room, 'roomphotos' => $roomphotos]);
    }

        public function bookconfirmlanding($roomID){
          $room = room::where('roomID', $roomID)->first();

          return view('booking.bookingconfirmation', ['room' => $room]);
    }

 public function storereservation(Request $request)
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
    ]);

    $form['payment_method'] = "Pay at Hotel";
    $form['reservation_bookingstatus'] = 'Pending';
    $form['bookedvia'] = 'Soliera';

    // Create reservation first to get the ID
    $reservation = Reservation::create($form);

    // Generate receipt number
    $receiptNo = 'SOL-' . date('Ymd') . '-' . str_pad($reservation->reservationID, 6, '0', STR_PAD_LEFT);

    // Generate Booking ID
    $bookingID = 'BKG-' . date('ymd') . '-' . str_pad($reservation->reservationID, 4, '0', STR_PAD_LEFT);

    // Update reservation with receipt number & booking ID
    $reservation->update([
        'reservation_receipt' => $receiptNo,
        'bookingID' => $bookingID,
    ]);

    // Update room status
    Room::where('roomID', $form['roomID'])->update([
        'roomstatus' => 'Reserved',
    ]);

    $roomprice = room::where('roomID', $form['roomID'])->value('roomprice');
    $roomtype = room::where('roomID', $form['roomID'])->value('roomtype');

     $reservation->refresh();

    
        return view('booking.bookingsuccess', [
            'reservation' => $reservation, 'roomprice' => $roomprice, 'roomtype' => $roomtype
        ]);

    
}






}
