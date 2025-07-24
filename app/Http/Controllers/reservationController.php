<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Reservation;
use App\Models\room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class reservationController extends Controller
{
    public function store(Request $request){

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
        $form['reservation_bookingstatus'] = 'Pending';
        $form['bookedvia'] = 'Soliera';

        
        
       Reservation::create($form);

       room::where('roomID', $form['roomID'])->update([
        'roomstatus' => 'Reserved',
       ]);

       session()->flash('success', 'Reservation Success');

       return redirect()->back();



    }

    public function modify (Request $request, Reservation $reservationID){

            $form = $request->validate([
            'reservation_checkin' => 'nullable',
            'reservation_checkout' => 'nullable',
            'reservation_specialrequest' => 'nullable',
            'reservation_numguest' => 'nullable',
            'guestname' => 'nullable',
            'guestphonenumber' => 'nullable',
            'guestemailaddress' => 'nullable',
            'guestbirthday' => 'nullable',
            'guestaddress' => 'nullable',
            'guestcontactperson' => 'nullable',
            'guestcontactpersonnumber' => 'nullable',
            'reservation_bookingstatus' => 'nullable',
            'bookevia' => 'nullable',
        ]);

        $reservationID->update($form);

        session()->flash('modified', 'Reservation Has Been Modified');

        return redirect()->back();
    }

    public function delete( Reservation $reservationID){
        $roomIDUpdate = $reservationID->roomID;

        room::where('roomID', $roomIDUpdate)->update([
            'roomstatus' => 'Available',
        ]);

        $reservationID->delete();
        
        session()->flash('removed', 'Reservation Has been removed');

        return redirect()->back();
    }
}
