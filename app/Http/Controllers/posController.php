<?php

namespace App\Http\Controllers;

use App\Models\additionalBooking;
use App\Models\additionalBookingCart;
use App\Models\additionalsBooking;
use App\Models\eventPOS;
use App\Models\Inventory;
use App\Models\inventoryPOS;
use App\Models\Reservation;
use App\Models\room;
use Carbon\Carbon;
use App\Models\AuditTrails;
use App\Models\Ecm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\ReservationPOS;
use App\Models\dynamicBilling;
use Illuminate\Support\Facades\Log;
use App\Models\guestnotification;
use App\Models\hotelBilling;
use App\Models\employeenotification;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Models\ecmtype;
class posController extends Controller
{


    public function employeenotif($guestname, $roomID)
{
    employeenotification::create([
        'module' => 'Front Desk',
        'message' => ($guestname ? $guestname . ' reserved room ' . $roomID : 'A guest reserved room ' . $roomID),
        'topic' => 'Reservation',
        'status' => 'new',
        'guestname' => !empty($guestname) ? $guestname : null,
    ]);
}

public function notifyguestandemployee ($guestID, $guestname, $event_bookingreceiptID){
        if($guestID){
        guestnotification::create([
        'guestID' => $guestID,
        'module' => 'Event And Conference',
        'guestname' => $guestname,
        'topic' => 'Reservation',
        'message' => "You Have Booked An Event $event_bookingreceiptID ",
        'status' => 'new',
    ]);   
}

  employeenotification::create([
        'module' => 'Event And Conference',
        'message' => "$guestname Has Booked an event reference ID: $event_bookingreceiptID",
        'topic' => 'Reservation',
        'status' => 'new',
        'guestname' => !empty($guestname) ? $guestname : null,
    ]);
}


public function sendEventReservationEmail($eventData)
{   
    $eventtype = ecmtype::where('eventtype_ID', $eventData['eventtype_ID'])->value('eventtype_name');
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = env('MAIL_HOST');
        $mail->SMTPAuth   = true;
        $mail->Username   = env('MAIL_USERNAME');
        $mail->Password   = env('MAIL_PASSWORD');
        $mail->SMTPSecure = env('MAIL_ENCRYPTION');
        $mail->Port       = env('MAIL_PORT');

        $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
        $mail->addAddress($eventData['eventorganizer_email'], $eventData['eventorganizer_name']);
        $mail->addEmbeddedImage(public_path('images/logo/sonly.png'), 'hotelLogo');
        $mail->isHTML(true);
        $mail->Subject = "Event Reservation  - {$eventData['event_name']}";

        $checkinDate = date('F j, Y', strtotime($eventData['event_checkin']));
        $checkoutDate = date('F j, Y', strtotime($eventData['event_checkout']));
        
        $equipmentList = '';
        if (!empty($eventData['event_equipment'])) {
            $equipmentItems = is_array($eventData['event_equipment']) ? $eventData['event_equipment'] : explode(',', $eventData['event_equipment']);
            foreach ($equipmentItems as $item) {
                $equipmentList .= '<li style="color:#666; margin-bottom:5px;">• ' . trim($item) . '</li>';
            }
        }

        $mailBody = '<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Event Reservation - Soliera Hotel</title>
</head>
<body style="margin:0; padding:0; font-family: Arial, sans-serif; background-color:#f4f4f4;">
<div style="max-width:600px; margin:0 auto; background-color:#ffffff; border-radius:8px; overflow:hidden; box-shadow:0 2px 10px rgba(0,0,0,0.1);">

<div style="background-color:#001f54; padding:30px 20px; text-align:center;">
    <img src="cid:hotelLogo" alt="Soliera Hotel Logo" style="width:80px; height:80px; border-radius:50%; margin-bottom:15px;">
    <h1 style="color:#F7B32B; margin:0; font-size:28px; font-weight:bold;">SOLIERA HOTEL</h1>
    <p style="color:#ffffff; margin:10px 0 0 0; font-size:16px;">Savor The Stay, Dine With Elegance</p>
</div>

<div style="padding:20px; text-align:center; background-color:#f8f9fa;">
    <div style="display:inline-block; background-color:#F7B32B; color:#001f54; padding:8px 20px; border-radius:20px; font-weight:bold; font-size:14px; margin-bottom:10px;">
        🎉 EVENT RESERVATION 
    </div>
</div>

<div style="padding:30px 20px;">
    <h2 style="color:#001f54; margin:0 0 20px 0; font-size:24px; text-align:center;">Event Reservation '. ($eventData['eventstatus'] ?? 'N/A') .' </h2>
    
    <div style="text-align:center; margin-bottom:20px;">
        <p style="color:#666; font-size:16px; margin:0;">
           Reservation ID: <span style="color:#001f54; font-weight:bold;">' . ($eventData['event_bookingreceiptID'] ?? 'N/A') . '</span>
        </p>
    </div>
    
    <div style="text-align:center; padding:20px; background-color:#001f54; border-radius:8px; margin-bottom:25px;">
        <h3 style="color:#F7B32B; margin:0 0 10px 0; font-size:20px;">Thank You for Choosing Soliera Hotel!</h3>
        <p style="color:#ffffff; margin:0; line-height:1.6;">
            We are delighted to host your event.<br>
            Our team is committed to making your occasion memorable and successful.
        </p>
    </div>

    <div style="background-color:#f8f9fa; border-radius:8px; padding:20px; margin-bottom:20px;">
        <h3 style="color:#001f54; margin:0 0 15px 0; font-size:18px; border-bottom:2px solid #F7B32B; padding-bottom:10px;">📋 Event Details</h3>
        
        <table style="width:100%; border-collapse:collapse;">
            <tr>
                <td style="padding:10px 0; color:#666; font-size:14px; width:40%;">Event Name:</td>
                <td style="padding:10px 0; color:#001f54; font-weight:bold; font-size:14px;">' . $eventData['event_name'] . '</td>
            </tr>
            <tr>
                <td style="padding:10px 0; color:#666; font-size:14px;">Event Type:</td>
                <td style="padding:10px 0; color:#001f54; font-weight:bold; font-size:14px;">' . $eventtype . '</td>
            </tr>
            <tr>
                <td style="padding:10px 0; color:#666; font-size:14px;">Check-in Date:</td>
                <td style="padding:10px 0; color:#001f54; font-weight:bold; font-size:14px;">' . $checkinDate . '</td>
            </tr>
            <tr>
                <td style="padding:10px 0; color:#666; font-size:14px;">Check-out Date:</td>
                <td style="padding:10px 0; color:#001f54; font-weight:bold; font-size:14px;">' . $checkoutDate . '</td>
            </tr>
            <tr>
                <td style="padding:10px 0; color:#666; font-size:14px;">Number of Guests:</td>
                <td style="padding:10px 0; color:#001f54; font-weight:bold; font-size:14px;">' . $eventData['event_numguest'] . ' Guests</td>
            </tr>
            <tr>
                <td style="padding:10px 0; color:#666; font-size:14px;">Total Price:</td>
                <td style="padding:10px 0; color:#001f54; font-weight:bold; font-size:14px;">₱ ' . number_format($eventData['event_total_price'], 2) . '</td>
            </tr>
            <tr>
                <td style="padding:10px 0; color:#666; font-size:14px;">Payment Method:</td>
                <td style="padding:10px 0; color:#001f54; font-weight:bold; font-size:14px;">' . $eventData['event_paymentmethod'] . '</td>
            </tr>
        </table>
    </div>

    <div style="background-color:#f8f9fa; border-radius:8px; padding:20px; margin-bottom:20px;">
        <h3 style="color:#001f54; margin:0 0 15px 0; font-size:18px; border-bottom:2px solid #F7B32B; padding-bottom:10px;">👤 Organizer Information</h3>
        
        <table style="width:100%; border-collapse:collapse;">
            <tr>
                <td style="padding:10px 0; color:#666; font-size:14px; width:40%;">Organizer Name:</td>
                <td style="padding:10px 0; color:#001f54; font-weight:bold; font-size:14px;">' . $eventData['eventorganizer_name'] . '</td>
            </tr>
            <tr>
                <td style="padding:10px 0; color:#666; font-size:14px;">Email Address:</td>
                <td style="padding:10px 0; color:#001f54; font-weight:bold; font-size:14px;">' . $eventData['eventorganizer_email'] . '</td>
            </tr>
            <tr>
                <td style="padding:10px 0; color:#666; font-size:14px;">Contact Number:</td>
                <td style="padding:10px 0; color:#001f54; font-weight:bold; font-size:14px;">' . $eventData['eventorganizer_phone'] . '</td>
            </tr>
        </table>
    </div>

    <div style="background-color:#f8f9fa; border-radius:8px; padding:20px; margin-bottom:20px;">
        <h3 style="color:#001f54; margin:0 0 15px 0; font-size:18px; border-bottom:2px solid #F7B32B; padding-bottom:10px;">🎯 Additional Services</h3>
        
        ' . ($equipmentList ? '<div style="margin-bottom:15px;"><p style="color:#666; font-size:14px; margin:0 0 10px 0;">Equipment Requested:</p><ul style="list-style:none; padding:0; margin:0;">' . $equipmentList . '</ul></div>' : '') . '

        ' . (!empty($eventData['event_specialrequest']) ? '<div><p style="color:#666; font-size:14px; margin:0 0 5px 0;">Special Requests:</p><p style="color:#001f54; font-size:14px; margin:0; line-height:1.6;">' . nl2br($eventData['event_specialrequest']) . '</p></div>' : '') . '
    </div>

    <div style="background-color:#fff3cd; border-left:4px solid #F7B32B; padding:15px; border-radius:4px; margin-bottom:20px;">
        <p style="color:#856404; margin:0; font-size:14px; line-height:1.6;">
            <strong>📌 Important:</strong> Please arrive 30 minutes before your scheduled event time for setup coordination. 
            If you need to make any changes to your reservation, please contact us at least 48 hours in advance.
        </p>
    </div>

    <div style="text-align:center; padding:20px 0;">
        <p style="color:#666; font-size:14px; margin:0 0 10px 0;">For inquiries or modifications, please contact us:</p>
        <p style="color:#001f54; font-weight:bold; margin:0; font-size:14px;">📧 ' . env('MAIL_FROM_ADDRESS') . '</p>
    </div>
</div>

<div style="background-color:#001f54; padding:20px; text-align:center;">
    <p style="color:#F7B32B; margin:0 0 5px 0; font-size:14px; font-weight:bold;">We look forward to hosting your event!</p>
    <p style="color:#ffffff; margin:0; font-size:12px;">© 2025 Soliera Hotel. All rights reserved.</p>
</div>
</div>
</body>
</html>';

        $mail->Body = $mailBody;
        $mail->send();
        
        return true;

    } catch (Exception $e) {
        Log::error("Event reservation email could not be sent: {$mail->ErrorInfo}");
        return false;
    }
}

   public function submitRoom(Request $request)
{
    $form = $request->validate([
        'roomID' => 'required',
        'reservation_checkin' => 'required',
        'reservation_checkout' => 'required',
        'reservation_specialrequest' => 'required',
        'reservation_numguest' => 'required',
        'subtotal' => 'required',
        'vat' => 'required',
        'serviceFee' => 'required',
        'total' => 'required',
        'reservation_validID' => 'required',
    ]);

    $form['guestname'] = 'POS_Guest_' . rand(1000, 9999);

    // Other fields can also be filled with default/dummy values
    $form['guestphonenumber'] = '0000000000';
    $form['guestemailaddress'] = 'pos_guest' . rand(1000,9999) . '@soliera.com';
    $form['guestbirthday'] = now()->subYears(30)->format('Y-m-d'); // default
    $form['guestaddress'] = 'POS Address';
    $form['guestcontactperson'] = 'POS Contact';
    $form['guestcontactpersonnumber'] = '0000000000';


    $filename =  time() . '_' .$request->file('reservation_validID')->getClientOriginalName();
    $filepath = 'images/reservations/'.$filename;
    $request->file('reservation_validID')->move(public_path('images/reservations/'), $filename);
    $form['reservation_validID'] = $filepath;

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


    public function additionalBooking(Request $request){
        $form = $request->validate([
            'reservationID' => 'required',
            'core1_inventoryID' => 'required',
            'additional_total' => 'required',
            'additional_quantity' => 'required',
        ]);

          $form['employeeID'] = Auth::user()->Dept_no;

          
    $inventory = Inventory::find($form['core1_inventoryID']);
    if (!$inventory) {
        return back()->with('error', 'Inventory item not found.');
    }

    // Check stock
    if ($inventory->core1_inventory_stocks < $form['additional_quantity']) {
        return back()->with('error', 'Not enough stock available.');
    }

     $inventory->decrement('core1_inventory_stocks', $form['additional_quantity']);



        additionalBookingCart::create($form);

        return redirect()->back()->with('success', 'Additional Has been Added');
    }


    public function deleteAdditionalBooking($additionalsID)
{
    // Find the additional booking record
    $additionalBooking = additionalBookingCart::find($additionalsID);

    if (!$additionalBooking) {
        return back()->with('error', 'Additional booking not found.');
    }

    // Restore the stock to the inventory
    $inventory = Inventory::find($additionalBooking->core1_inventoryID);
    if ($inventory) {
        $inventory->increment('core1_inventory_stocks', $additionalBooking->additional_quantity);
    }

    // Delete the additional booking record
    $additionalBooking->delete();

    return redirect()->back()->with('success', 'Additional booking has been removed and stock restored.');
}



public function POSButton(){

    $roombookings = ReservationPOS::where('employeeID', Auth::user()->Dept_no)->get();
    


   if ($roombookings->isNotEmpty()) {
    foreach ($roombookings as $booking) {
      $data = [
    'roomID' => $booking->roomID,
    'reservation_checkin' => $booking->reservation_checkin,
    'reservation_checkout' => $booking->reservation_checkout,
    'reservation_specialrequest' => $booking->reservation_specialrequest,
    'reservation_numguest' => $booking->reservation_numguest,
    'guestname' => $booking->guestname,
    'guestphonenumber' => $booking->guestphonenumber,
    'guestemailaddress' => $booking->guestemailaddress,
    'guestbirthday' => $booking->guestbirthday,
    'guestaddress' => $booking->guestaddress,
    'guestcontactperson' => $booking->guestcontactperson,
    'guestcontactpersonnumber' => $booking->guestcontactpersonnumber,
    'subtotal' => $booking->subtotal,
    'vat' => $booking->vat,
    'serviceFee' => $booking->serviceFee,
    'total' => $booking->total,
    'reservation_validID' => $booking->reservation_validID,

    // extra fields you want fixed
    'payment_method' => 'Pay On Site',
    'reservation_bookingstatus' => 'Pending',
    'bookedvia' => 'Soliera',
    'payment_status' => 'Pending',
];

        $reservation = Reservation::create($data);

         $receiptNo = 'SOL-' . date('Ymd') . '-' . str_pad($reservation->reservationID, 6, '0', STR_PAD_LEFT);

    // Generate Booking ID
    $bookingID = 'BKG-' . date('ymd') . '-' . str_pad($reservation->reservationID, 4, '0', STR_PAD_LEFT);

    // Update reservation with receipt number & booking ID
    $reservation->update([
        'reservation_receipt' => $receiptNo,
        'bookingID' => $bookingID,
    ]);


      Room::where('roomID', $data['roomID'])->update([
        'roomstatus' => 'Reserved',
    ]);

    
            $nights = (strtotime($data['reservation_checkout']) - strtotime($data['reservation_checkin'])) / (60*60*24);

            // Calculate amounts for the entire stay
            $subtotal = $reservation->subtotal;
            $serviceFee = $reservation->serviceFee;
            $vat = $reservation->vat;
            $total = $reservation->total;


            $subtotalFormatted = number_format($subtotal, 2);
            $serviceFeeFormatted = number_format($serviceFee, 2);
            $vatFormatted = number_format($vat, 2);
            $totalFormatted = number_format($total, 2);

            $bookedDate = date('F d, Y');


            $checkin = date('F j, Y', strtotime($data['reservation_checkin']));
            $checkout = date('F j, Y', strtotime($data['reservation_checkout']));

            $servicefee2 = dynamicBilling::where('dynamic_name', 'Service Fee')->value('dynamic_price');
            $taxrate2 = dynamicBilling::where('dynamic_name', 'Tax Rate')->value('dynamic_price');

            $serviceFeedynamic = rtrim(rtrim(number_format($servicefee2, 2), '0'), '.') . '%';
            $taxRatedynamic = rtrim(rtrim(number_format($taxrate2, 2), '0'), '.') . '%';

             $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = env('MAIL_HOST');
        $mail->SMTPAuth   = true;
        $mail->Username   = env('MAIL_USERNAME');
        $mail->Password   = env('MAIL_PASSWORD');
        $mail->SMTPSecure = env('MAIL_ENCRYPTION'); // tls or ssl
        $mail->Port       = env('MAIL_PORT');

        $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
        $mail->addAddress($data['guestemailaddress'], $data['guestname']);
         $mail->addEmbeddedImage(public_path('images/logo/sonly.png'), 'hotelLogo'); // Make sure file exists
        $mail->isHTML(true);
        $mail->Subject = "Booking Details - $bookingID";

        // Email HTML body
        $mailBody = <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Booking Details - Soliera Hotel</title>
</head>
<body style="margin:0; padding:0; font-family: Arial, sans-serif; background-color:#f4f4f4;">
<div style="max-width:600px; margin:0 auto; background-color:#ffffff; border-radius:8px; overflow:hidden; box-shadow:0 2px 10px rgba(0,0,0,0.1);">

<!-- Header -->
<div style="background-color:#001f54; padding:30px 20px; text-align:center;">
    <img src="cid:hotelLogo" alt="Soliera Hotel Logo" style="width:80px; height:80px; border-radius:50%; margin-bottom:15px;">
    <h1 style="color:#F7B32B; margin:0; font-size:28px; font-weight:bold;">SOLIERA HOTEL</h1>
    <p style="color:#ffffff; margin:10px 0 0 0; font-size:16px;">Savor The Stay, Dine With Elegance</p>
</div>

<!-- Booking Status -->
<div style="padding:20px; text-align:center; background-color:#f8f9fa;">
    <div style="display:inline-block; background-color:#F7B32B; color:#001f54; padding:8px 20px; border-radius:20px; font-weight:bold; font-size:14px; margin-bottom:10px;">
        📋 BOOKING STATUS: PENDING
    </div>
</div>

<!-- Main Content -->
<div style="padding:30px 20px;">
    <h2 style="color:#001f54; margin:0 0 20px 0; font-size:24px; text-align:center;">Your Booking Details</h2>
    
    <!-- Booking Details -->
    <div style="background-color:#f8f9fa; border-radius:8px; padding:20px; margin-bottom:20px; border-left:4px solid #F7B32B;">
        <h3 style="color:#001f54; margin:0 0 15px 0; font-size:18px;">Booking Information</h3>
        <table style="width:100%; border-collapse:collapse;">
            <tr><td style="padding:8px 0; color:#666; font-weight:bold;">Booking ID:</td><td style="padding:8px 0; color:#001f54; font-weight:bold;">$bookingID</td></tr>
            <tr><td style="padding:8px 0; color:#666; font-weight:bold;">Room:</td><td style="padding:8px 0; color:#001f54;">{$data['roomID']}</td></tr>
            <tr><td style="padding:8px 0; color:#666; font-weight:bold;">Guest Name:</td><td style="padding:8px 0; color:#001f54;">{$data['guestname']}</td></tr>
            <tr><td style="padding:8px 0; color:#666; font-weight:bold;">Check-in:</td><td style="padding:8px 0; color:#001f54;">$checkin</td></tr>
            <tr><td style="padding:8px 0; color:#666; font-weight:bold;">Check-out:</td><td style="padding:8px 0; color:#001f54;">$checkout</td></tr>
            <tr><td style="padding:8px 0; color:#666; font-weight:bold;">Nights:</td><td style="padding:8px 0; color:#001f54;">$nights</td></tr>
             <tr>
                <td style="padding:8px 0;color:#666;font-weight:bold;">Booked Date:</td>
                <td style="padding:8px 0;color:#001f54;">$bookedDate</td>
            </tr>
              <tr>
                <td style="padding:8px 0;color:#666;font-weight:bold;">Payment Method:</td>
                <td style="padding:8px 0;color:#001f54;">{$data['payment_method']}</td>
            </tr>
        </table>
    </div>

    <!-- Payment Summary -->
    <div style="background-color:#f8f9fa; border-radius:8px; padding:20px; margin-bottom:20px; border-left:4px solid #F7B32B;">
        <h3 style="color:#001f54; margin:0 0 15px 0; font-size:18px;">Payment Summary</h3>
        <table style="width:100%; border-collapse:collapse;">
            <tr><td style="padding:8px 0; color:#666;">Subtotal:</td><td style="padding:8px 0; color:#001f54; text-align:right;">₱$subtotalFormatted</td></tr>
            <tr><td style="padding:8px 0; color:#666;">Service Fee ($serviceFeedynamic):</td><td style="padding:8px 0; color:#001f54; text-align:right;">₱$serviceFeeFormatted</td></tr>
            <tr><td style="padding:8px 0; color:#666;">VAT ($taxRatedynamic):</td><td style="padding:8px 0; color:#001f54; text-align:right;">₱$vatFormatted</td></tr>
            <tr style="border-top:2px solid #F7B32B;">
                <td style="padding:12px 0 8px 0; color:#001f54; font-weight:bold; font-size:18px;">Total Amount:</td>
                <td style="padding:12px 0 8px 0; color:#001f54; font-weight:bold; font-size:18px; text-align:right;">₱$totalFormatted</td>
            </tr>
        </table>
    </div>

    <!-- Thank You -->
    <div style="text-align:center; padding:20px; background-color:#001f54; border-radius:8px; margin-bottom:20px;">
        <h3 style="color:#F7B32B; margin:0 0 10px 0; font-size:20px;">Thank You for Your Booking!</h3>
        <p style="color:#ffffff; margin:0; line-height:1.6;">We are delighted to welcome you to Soliera Hotel. Your booking is currently being processed and you will receive a confirmation once approved.</p>
    </div>
</div>

<!-- Footer -->
<div style="background-color:#001f54; padding:20px; text-align:center;">
    <p style="color:#F7B32B; margin:0; font-size:14px;">© 2025 Soliera Hotel. All rights reserved.</p>
</div>
</div>
</body>
</html>
HTML;

        $mail->Body = $mailBody;
        $mail->send();

    } catch (Exception $e) {
        Log::error("Booking email could not be sent: {$mail->ErrorInfo}");
    }
    }

    AuditTrails::create([
            'dept_id' => Auth::user()->Dept_id,
            'dept_name' => Auth::user()->dept_name,
            'modules_cover' => 'Booking And Reservation',
            'action' => 'Create Booking',
            'activity' => 'Create Booking For ' .$data['guestname'],
            'employee_name' => Auth::user()->employee_name,
            'employee_id' => Auth::user()->employee_id,
            'role' => Auth::user()->role,
            'date' => Carbon::now()->toDateTimeString(),
        ]);

          $guestname = $data['guestname'];
            $roomID = $data['roomID'];

        $this->employeenotif($guestname, $roomID);
    }

    $eventbookings = EventPOS::where('employeeID', Auth::user()->Dept_no)->get();
    if($eventbookings->isNotEmpty()){
        foreach($eventbookings as $event){
          $eventdata = [
        'eventtype_ID'         => $event->eventtype_ID,
        'eventorganizer_email' => $event->eventorganizer_email,
        'eventorganizer_name'  => $event->eventorganizer_name,
        'eventorganizer_phone' => $event->eventorganizer_phone,
        'event_name'           => $event->event_name,
        'event_specialrequest' => $event->event_specialrequest,
        'event_equipment'      => $event->event_equipment,
        'event_paymentmethod'  => $event->event_paymentmethod,
        'event_checkin'        => $event->event_checkin,
        'event_checkout'       => $event->event_checkout,
        'event_numguest'       => $event->event_numguest,
        'event_total_price'    => $event->event_total_price,

        'eventstatus'             => 'Pending',
        'event_bookedate'         => Carbon::now()->toDateString(),
        'event_eventreceipt'      => null,
        'event_bookingreceiptID'  => strtoupper(uniqid("ECM-")),
        'event_paymentstatus'     => 'Unpaid',

        'guestID' => Auth::guard('guest')->check()
            ? Auth::guard('guest')->user()->guestID
            : null,
    ];

          $ecm = Ecm::create($eventdata);

    // ✅ Audit Trail (for logged-in employees/admin)
    if (Auth::check()) {
        AuditTrails::create([
            'dept_id'       => Auth::user()->Dept_id,
            'dept_name'     => Auth::user()->dept_name,
            'modules_cover' => 'Event And Conference',
            'action'        => 'Create ECM Booking',
            'activity'      => 'Created ECM for ' . $ecm->event_name,
            'employee_name' => Auth::user()->employee_name,
            'employee_id'   => Auth::user()->employee_id,
            'role'          => Auth::user()->role,
            'date'          => Carbon::now()->toDateTimeString(),
        ]);
    }


      $this->sendEventReservationEmail($eventdata);
     $this->notifyguestandemployee(
        $eventdata['guestID'],
        $eventdata['eventorganizer_name'],
        $eventdata['event_bookingreceiptID']
    );

        }
         
    }

    $additionalItems = additionalBookingCart::where('employeeID', Auth::user()->Dept_no)->get();

    if($additionalItems->isNotEmpty()){
        foreach($additionalItems as $addons){
            $addonsData = [
                'reservationID' => $addons->reservationID,
                'core1_inventoryID' => $addons->core1_inventoryID,
                'additional_total' => $addons->additional_total,
                'additional_quantity' => $addons->additional_quantity,
            ];

            additionalBooking::create($addonsData);
        }
    }


     $eventbookings = EventPOS::where('employeeID', Auth::user()->Dept_no)->delete();
     $roombookings = ReservationPOS::where('employeeID', Auth::user()->Dept_no)->delete();
     $additionalItems = additionalBookingCart::where('employeeID', Auth::user()->Dept_no)->delete();
     return redirect()->back()->with('success', 'The POS transaction has been processed successfully');
      
    }
}
