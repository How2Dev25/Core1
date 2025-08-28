<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\room;
use App\Models\additionalRoom;
use App\Models\Reservation;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

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
    if ($form['payment_method'] === 'Pay at Hotel') {
        $form['payment_status'] = "Pending";
    }

    // Create reservation
    $reservation = Reservation::create($form);

    // Generate receipt number and booking ID
    $receiptNo = 'SOL-' . date('Ymd') . '-' . str_pad($reservation->reservationID, 6, '0', STR_PAD_LEFT);
    $bookingID = 'BKG-' . date('ymd') . '-' . str_pad($reservation->reservationID, 4, '0', STR_PAD_LEFT);

    $reservation->update([
        'reservation_receipt' => $receiptNo,
        'bookingID' => $bookingID,
    ]);

    // Update room status
    Room::where('roomID', $form['roomID'])->update([
        'roomstatus' => 'Reserved',
    ]);

    // Get room price
    $roomprice = Room::where('roomID', $form['roomID'])->value('roomprice');


     // Calculate nights
   $nights = (strtotime($form['reservation_checkout']) - strtotime($form['reservation_checkin'])) / (60*60*24);

// Calculate amounts for the entire stay
$subtotal = $roomprice * $nights;
$serviceFee = round($subtotal * 0.02, 2);
$vat = round($subtotal * 0.12, 2);
$total = $subtotal + $serviceFee + $vat;

// Format numbers for email
$subtotalFormatted = number_format($subtotal, 2);
$serviceFeeFormatted = number_format($serviceFee, 2);
$vatFormatted = number_format($vat, 2);
$totalFormatted = number_format($total, 2);

  $bookedDate = date('F d, Y');

    // Convert check-in and check-out to human-readable format
    $checkin = date('F j, Y', strtotime($form['reservation_checkin']));
    $checkout = date('F j, Y', strtotime($form['reservation_checkout']));

   

    // PHPMailer Integration
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
        $mail->addAddress($form['guestemailaddress'], $form['guestname']);
         $mail->addEmbeddedImage(public_path('images/logo/sonly.png'), 'hotelLogo'); // Make sure file exists
        $mail->isHTML(true);
        $mail->Subject = "Booking Confirmation - $bookingID";

        // Email HTML body
        $mailBody = <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Booking Confirmation - Soliera Hotel</title>
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
    <h2 style="color:#001f54; margin:0 0 20px 0; font-size:24px; text-align:center;">Booking Confirmation</h2>
    
    <!-- Booking Details -->
    <div style="background-color:#f8f9fa; border-radius:8px; padding:20px; margin-bottom:20px; border-left:4px solid #F7B32B;">
        <h3 style="color:#001f54; margin:0 0 15px 0; font-size:18px;">Booking Information</h3>
        <table style="width:100%; border-collapse:collapse;">
            <tr><td style="padding:8px 0; color:#666; font-weight:bold;">Booking ID:</td><td style="padding:8px 0; color:#001f54; font-weight:bold;">$bookingID</td></tr>
            <tr><td style="padding:8px 0; color:#666; font-weight:bold;">Room:</td><td style="padding:8px 0; color:#001f54;">{$form['roomID']}</td></tr>
            <tr><td style="padding:8px 0; color:#666; font-weight:bold;">Guest Name:</td><td style="padding:8px 0; color:#001f54;">{$form['guestname']}</td></tr>
            <tr><td style="padding:8px 0; color:#666; font-weight:bold;">Check-in:</td><td style="padding:8px 0; color:#001f54;">$checkin</td></tr>
            <tr><td style="padding:8px 0; color:#666; font-weight:bold;">Check-out:</td><td style="padding:8px 0; color:#001f54;">$checkout</td></tr>
            <tr><td style="padding:8px 0; color:#666; font-weight:bold;">Nights:</td><td style="padding:8px 0; color:#001f54;">$nights</td></tr>
             <tr>
                <td style="padding:8px 0;color:#666;font-weight:bold;">Booked Date:</td>
                <td style="padding:8px 0;color:#001f54;">$bookedDate</td>
            </tr>
              <tr>
                <td style="padding:8px 0;color:#666;font-weight:bold;">Payment Method:</td>
                <td style="padding:8px 0;color:#001f54;">{$form['payment_method']}</td>
            </tr>
        </table>
    </div>

    <!-- Payment Summary -->
    <div style="background-color:#f8f9fa; border-radius:8px; padding:20px; margin-bottom:20px; border-left:4px solid #F7B32B;">
        <h3 style="color:#001f54; margin:0 0 15px 0; font-size:18px;">Payment Summary</h3>
        <table style="width:100%; border-collapse:collapse;">
            <tr><td style="padding:8px 0; color:#666;">Subtotal:</td><td style="padding:8px 0; color:#001f54; text-align:right;">₱$subtotalFormatted</td></tr>
            <tr><td style="padding:8px 0; color:#666;">Service Fee (2%):</td><td style="padding:8px 0; color:#001f54; text-align:right;">₱$serviceFeeFormatted</td></tr>
            <tr><td style="padding:8px 0; color:#666;">VAT (12%):</td><td style="padding:8px 0; color:#001f54; text-align:right;">₱$vatFormatted</td></tr>
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

    return redirect()->route('booking.success', $reservation->reservationID);
}



}
