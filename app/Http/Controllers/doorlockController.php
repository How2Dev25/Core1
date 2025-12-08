<?php

namespace App\Http\Controllers;

use App\Models\doorlock;
use App\Models\doorlockFrontdesk;
use App\Models\Reservation;
use Illuminate\Http\Request;

class doorlockController extends Controller
{
    
    public function storedoorLock(Request $request){
        $form = $request->validate([
            'rfid' => 'required|unique:doorlock,rfid',
            'roomID' => 'required',
        ]);

        doorlock::create($form);

        return redirect()->back()->with('success', 'RFID door lock has been integrated to room ' .$form['roomID']);
    }

    public function modifydoorLock(Request $request, doorlock $doorlockID){

        $form = $request->validate([
            'rfid' => 'required',
            'roomID' => 'required',
        ]);

        $doorlockID->update($form);

        return redirect()->back()->with('success', 'Door Lock ID has been Modified');


    }

    public function removedoorLock(doorlock $doorlockID){
        $doorlockID->delete();
         return redirect()->back()->with('success', 'Door Lock ID has been Removed');
    }


public function assignkeycard($reservationID)
{
    try {
        // Fetch reservation
        $reservation = Reservation::findOrFail($reservationID);
        $roomID = $reservation->roomID;

        // Fetch doorlock for the room (throws if not found)
        $doorlock = doorlock::where('roomID', $roomID)->firstOrFail();

        // Optional: prevent duplicate keycard assignments
        $exists = doorlockFrontdesk::where('bookingID', $reservation->bookingID)
            ->where('doorlockID', $doorlock->doorlockID)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'This booking already has a keycard assigned.');
        }

        // Create doorlockFrontdesk record
        doorlockFrontdesk::create([
            'guestID' => $reservation->guestID ?? null,
            'doorlockID' => $doorlock->doorlockID,
            'guestName' => $reservation->guestName,
            'bookingID' => $reservation->bookingID,
        ]);

        // Update doorlock status
        $doorlock->update([
            'doorlock_status' => 'Active',
        ]);

        return redirect()->back()->with('success', 'RFID has been assigned to the booking');

    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        // Either reservation or doorlock not found
        return redirect()->back()->with('error', ' doorlock is not integrated with the room.');
    } catch (\Exception $e) {
        // Any other errors
        return redirect()->back()->with('error', 'An unexpected error occurred: ' . $e->getMessage());
    }
}


    
    public function removeassigneddoorLock(){

    }
}
