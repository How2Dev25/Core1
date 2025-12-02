<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\additionalBooking;
use Carbon\Carbon;
use App\Models\hotelBilling;
use App\Models\Reservation;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


class bookingAddonsController extends Controller
{

   public function billingHistory($bookingID, $guestID, $guestname, $amount_paid, $payment_method)
{
    // Check existing billing records with the same bookingID
    $existingCount = hotelBilling::where('transaction_reference', 'like', "$bookingID%")->count();

    // If there are existing entries, append a number
    $finalBookingID = $existingCount > 0 ? "$bookingID-" . ($existingCount + 1) : $bookingID;

    // Create billing record
    hotelBilling::create([
        'transaction_reference' => $finalBookingID,
        'guestID' => $guestID ?? null,
        'guestname' => $guestname,
        'payment_date' => Carbon::now(),
        'amount_paid' => $amount_paid,
        'payment_method' => $payment_method,
        'remarks' => 'Addons',
    ]);
}


    public function markAsPaid(additionalBooking $additionalbookingID)
{
    // 1. Update the status
    $additionalbookingID->update([
        'addon_status' => 'Paid'
    ]);

    // 2. Get related reservation info if needed
    $reservation = Reservation::
        where('reservationID', $additionalbookingID->reservationID)
        ->first();

    // 3. Record in billingHistory
    $this->billingHistory(
        "addon - $additionalbookingID->reservationID",                   
        $reservation->guestID ?? null,          
        $reservation->guestname ?? 'Unknown',   
        $additionalbookingID->additional_total,            
        'Pay On Site'                    
    );

    return redirect()->back()->with('success', 'Addon Has Been Marked As Paid');
}

public function removeAddon(additionalBooking $additionalbookingID){
    $additionalbookingID->delete();
    return redirect()->back()->with('success', 'Addon Has Been Removed');
}
}   
