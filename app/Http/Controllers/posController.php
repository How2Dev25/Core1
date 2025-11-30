<?php

namespace App\Http\Controllers;

use App\Models\eventPOS;
use App\Models\Inventory;
use App\Models\inventoryPOS;
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

public function submitEvent(Request $request){
    $form = $request->validate([
    'eventtype_ID'         => 'required',
    'eventorganizer_email' => 'required',
    'eventorganizer_name'  => 'required',
    'eventorganizer_phone' => 'required',
    'event_name'           => 'required',
    'event_specialrequest' => 'required', // optional
    'event_equipment'      => 'required', // optional
    'event_paymentmethod'  => 'required',
    'event_checkin'        => 'required|date',
    'event_checkout'       => 'required|date',
    'event_numguest'       => 'required|integer',
    'event_total_price'    => 'required|numeric',
    ]);

    $form['employeeID'] = Auth::user()->Dept_no;

    eventPOS::create($form);

    return redirect()->back()->with('success', 'Event Has been Saved to POS');

}

public function removeEvent(eventPOS $eventposID){
    $eventposID->delete();

    return redirect()->back()->with('success', 'Event Has been Removed From POS');
}

public function submitInventory(Request $request)
{
    // Validate inputs
    $form = $request->validate([
        'reservationposID' => 'required',
        'core1_inventoryID' => 'required',
        'inventorypos_total' => 'required|numeric',
        'inventorypos_quantity' => 'required|integer|min:1',
    ]);

    $form['employeeID'] = Auth::user()->Dept_no;

    inventoryPOS::create($form);

    // Get inventory
    $inventory = Inventory::find($form['core1_inventoryID']);
    if (!$inventory) {
        return back()->with('error', 'Inventory item not found.');
    }

    // Check stock
    if ($inventory->core1_inventory_stocks < $form['inventorypos_quantity']) {
        return back()->with('error', 'Not enough stock available.');
    }

    // Format inventory entry (e.g., "Towel (2x)")
    $newEntry = $inventory->core1_inventory_name . ' (' . $form['inventorypos_quantity'] . 'x)';

    // Get current special request
    $reservation = ReservationPOS::find($form['reservationposID']);
    if (!$reservation) {
        return back()->with('error', 'Reservation not found.');
    }

    // Append to special request
    $currentSpecial = $reservation->reservation_specialrequest;
    $updatedSpecial = $currentSpecial ? $currentSpecial . ', ' . $newEntry : $newEntry;

    // Update total
    $newTotal = $reservation->total + ($form['inventorypos_total']);

    // Update reservation
    $reservation->update([
        'reservation_specialrequest' => $updatedSpecial,
        'total' => $newTotal,
    ]);

    // Decrease inventory stock
    $inventory->decrement('core1_inventory_stocks', $form['inventorypos_quantity']);

    return back()->with('success', 'Item added and stock/total updated.');
}


// Remove inventory from reservation
public function removeInventory($inventoryposID)
{
    // Find the inventory POS entry
    $posEntry = inventoryPOS::find($inventoryposID);
    if (!$posEntry) {
        return back()->with('error', 'Inventory entry not found.');
    }

    // Get the associated inventory
    $inventory = Inventory::find($posEntry->core1_inventoryID);

    // Restore the stock
    if ($inventory) {
        $inventory->increment('core1_inventory_stocks', $posEntry->inventorypos_quantity);
    }

    // Get the reservation
    $reservation = ReservationPOS::find($posEntry->reservationposID);
    if ($reservation) {
        // Format the entry we added previously
        $entryToRemove = $inventory->core1_inventory_name . ' (' . $posEntry->inventorypos_quantity . 'x)';

        // Remove the entry from the special request string
        $reservation->reservation_specialrequest = trim(preg_replace(
            '/(^|,\s*)' . preg_quote($entryToRemove, '/') . '(\s*,|$)/',
            '$1',
            $reservation->reservation_specialrequest
        ), ', ');

        // Subtract the total of this additional
        $reservation->total = $reservation->total - $posEntry->inventorypos_total;

        $reservation->save();
    }

    // Delete the POS entry
    $posEntry->delete();

    return back()->with('success', 'Additional removed and changes undone.');
}
// Undo removal


    
}
