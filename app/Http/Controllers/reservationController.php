<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Reservation;
use App\Models\room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Carbon\Carbon;
use App\Services\GeminiService;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Spatie\Browsershot\Browsershot;
use Illuminate\Support\Facades\View;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



class reservationController extends Controller
{


  protected $gemini;

    public function __construct(GeminiService $gemini)
    {
        $this->gemini = $gemini;
    }



public function searchRooms(Request $request)
{
     $prompt = $request->input('prompt', '');

       if (empty(trim($prompt))) {
        return response()->json([
            'message' => 'No booking prompt was provided.'
        ], 400);
    }


    // Step 1: Call Gemini and get raw JSON response
      $aiRaw = $this->gemini->interpretPrompt($prompt);
    Log::debug('🧠 Gemini Raw Text:', ['raw' => $aiRaw]);

    // Step 2: Decode response
    $parsed = json_decode($aiRaw, true);

    if (!$parsed || !is_array($parsed)) {
        return response()->json([
            'message' => 'Invalid JSON response from Gemini.',
            'raw' => $aiRaw
        ], 400);
    }


    // Step 2: Decode raw JSON directly (skip extractJsonFromText)
    $parsed = json_decode($aiRaw, true);

    if (!$parsed || !is_array($parsed)) {
        return response()->json([
            'message' => 'Invalid JSON response from Gemini.',
            'raw' => $aiRaw
        ], 400);
    }

    Log::debug('✅ Parsed Gemini JSON:', ['parsed' => $parsed]);

    // Step 3: Extract fields
    $roomtype = $parsed['roomtype'] ?? null;
    $roommaxguest = $parsed['roommaxguest'] ?? 1;
    $features = $parsed['roomfeatures'] ?? [];
    $checkin = isset($parsed['checkin_date']) && $parsed['checkin_date']
        ? Carbon::parse($parsed['checkin_date'])
        : now();

    $checkout = isset($parsed['checkout_date']) && $parsed['checkout_date']
        ? Carbon::parse($parsed['checkout_date'])
        : $checkin->copy()->addDays($parsed['reservation_days'] ?? 1);

    $specialRequest = $parsed['special_request'] ?? '';

    // Step 4: Search for matching rooms
    $rooms = Room::query()
        ->when($roomtype, fn($q) => $q->where('roomtype', 'like', "%$roomtype%"))
        ->where('roommaxguest', '>=', $roommaxguest)
        ->where('roomstatus', 'like', '%avai%')
        ->get()
        ->filter(function ($room) use ($features, $checkin, $checkout) {
            $roomFeatures = array_map('trim', explode(',', strtolower($room->roomfeatures)));

            foreach ($features as $feature) {
                if (!in_array(strtolower($feature), $roomFeatures)) {
                    return false;
                }
            }

            $hasConflict = Reservation::where('roomID', $room->roomID)
                ->where(function ($query) use ($checkin, $checkout) {
                    $query->whereBetween('reservation_checkin', [$checkin, $checkout])
                          ->orWhereBetween('reservation_checkout', [$checkin, $checkout])
                          ->orWhere(function ($q) use ($checkin, $checkout) {
                              $q->where('reservation_checkin', '<=', $checkin)
                                ->where('reservation_checkout', '>=', $checkout);
                          });
                })
                ->whereIn('reservation_bookingstatus', ['booked', 'checkedin'])
                ->exists();

            return !$hasConflict;
        })
        ->values();

    // Step 5: If exactly one room found, go to booking form
    if ($rooms->count() === 1) {
        return view('admin.components.bas.aiform', [
            'room' => $rooms->first(),
            'checkin' => $checkin->toDateString(),
            'checkout' => $checkout->toDateString(),
            'criteria' => $parsed,
            'prefilledRequest' => $specialRequest,
        ]);
    }

    // Step 6: Otherwise, suggest top 5 available rooms
    $suggestions = Room::where('roomstatus', 'like', '%avai%')
        ->limit(5)
        ->get();

    return view('admin.components.bas.withsuggestion', [
        'suggestions' => $suggestions,
        'checkin' => $checkin->toDateString(),
        'checkout' => $checkout->toDateString(),
        'criteria' => $parsed,
        'prefilledRequest' => $specialRequest,
        'aiRaw' => $aiRaw
    ]);
}



   public function store(Request $request)
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
    $form['payment_status'] = "Pending";

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


      $roomprice = Room::where('roomID', $form['roomID'])->value('roomprice');

     

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

    // Calculate nights
   


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



    session()->flash('success', 'Reservation Success. Receipt #: ' . $receiptNo . ' | Booking ID: ' . $bookingID);

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
            'payment_method' => 'nullable',
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


  public function confirm(Reservation $reservationID)
{
    // Update booking status
    $reservationID->update([
        'reservation_bookingstatus' => 'Confirmed'
    ]);

    // Prepare data
    $bookingID = $reservationID->bookingID;
    $guestname = $reservationID->guestname;
    $guestemail = $reservationID->guestemailaddress;
    $roomID = $reservationID->roomID;
    $checkin = date('M d, Y', strtotime($reservationID->reservation_checkin));
    $checkout = date('M d, Y', strtotime($reservationID->reservation_checkout));
    $bookedDate = date('M d, Y', strtotime($reservationID->created_at));

    $roomprice = Room::where('roomID', $reservationID->roomID)->value('roomprice');
    // Calculate nights
    $nights = (strtotime($reservationID->reservation_checkout) - strtotime($reservationID->reservation_checkin)) / (60*60*24);

    // Payment calculations
    $subtotal = $roomprice * $nights;
    $serviceFee = round($subtotal * 0.02, 2);
    $vat = round($subtotal * 0.12, 2);
    $total = $subtotal + $serviceFee + $vat;

    // Format numbers
    $subtotalFormatted = number_format($subtotal, 2);
    $serviceFeeFormatted = number_format($serviceFee, 2);
    $vatFormatted = number_format($vat, 2);
    $totalFormatted = number_format($total, 2);

    // Send email
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
        $mail->addAddress($guestemail, $guestname);
        $mail->addEmbeddedImage(public_path('images/logo/sonly.png'), 'hotelLogo');
        $mail->isHTML(true);
        $mail->Subject = "Reservation Confirmed - $bookingID";

        $mailBody = <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Reservation Confirmed - Soliera Hotel</title>
</head>
<body style="margin:0; font-family:Arial, sans-serif; background-color:#f4f4f4;">
<div style="max-width:600px; margin:0 auto; background:#fff; border-radius:8px; overflow:hidden; box-shadow:0 2px 10px rgba(0,0,0,0.1);">

<!-- Header -->
<div style="background:#001f54; padding:30px 20px; text-align:center;">
    <img src="cid:hotelLogo" alt="Soliera Hotel Logo" style="width:80px;height:80px;border-radius:50%;margin-bottom:15px;">
    <h1 style="color:#F7B32B; font-size:28px; margin:0;">SOLIERA HOTEL</h1>
</div>

<!-- Confirmation -->
<div style="padding:30px 20px; text-align:center;">
    <h2 style="color:#001f54; font-size:24px; margin:0 0 15px 0;">Your Reservation is Confirmed!</h2>
    <p style="color:#333; margin:0;">We are delighted to confirm your reservation. Have a wonderful stay at Soliera Hotel!</p>
</div>

<!-- Reservation Details -->
<div style="padding:20px; background:#f8f9fa; border-radius:8px; margin:0 20px 20px; border-left:4px solid #F7B32B;">
<table style="width:100%; border-collapse:collapse;">
<tr><td style="padding:8px 0; color:#666; font-weight:bold;">Booking ID:</td><td style="padding:8px 0; color:#001f54;">$bookingID</td></tr>
<tr><td style="padding:8px 0; color:#666; font-weight:bold;">Room:</td><td style="padding:8px 0; color:#001f54;">$roomID</td></tr>
<tr><td style="padding:8px 0; color:#666; font-weight:bold;">Check-in:</td><td style="padding:8px 0; color:#001f54;">$checkin</td></tr>
<tr><td style="padding:8px 0; color:#666; font-weight:bold;">Check-out:</td><td style="padding:8px 0; color:#001f54;">$checkout</td></tr>
<tr><td style="padding:8px 0; color:#666; font-weight:bold;">Nights:</td><td style="padding:8px 0; color:#001f54;">$nights</td></tr>
<tr><td style="padding:8px 0; color:#666; font-weight:bold;">Booked Date:</td><td style="padding:8px 0; color:#001f54;">$bookedDate</td></tr>
</table>
</div>

<!-- Payment Summary -->
<div style="padding:20px; background:#f8f9fa; border-radius:8px; margin:0 20px 20px; border-left:4px solid #F7B32B;">
<h3 style="color:#001f54; font-size:18px; margin-bottom:10px;">Payment Summary</h3>
<table style="width:100%; border-collapse:collapse;">
<tr><td style="padding:8px 0; color:#666;">Subtotal:</td><td style="padding:8px 0; color:#001f54; text-align:right;">₱$subtotalFormatted</td></tr>
<tr><td style="padding:8px 0; color:#666;">Service Fee (2%):</td><td style="padding:8px 0; color:#001f54; text-align:right;">₱$serviceFeeFormatted</td></tr>
<tr><td style="padding:8px 0; color:#666;">VAT (12%):</td><td style="padding:8px 0; color:#001f54; text-align:right;">₱$vatFormatted</td></tr>
<tr style="border-top:2px solid #F7B32B;"><td style="padding:8px 0; font-weight:bold;">Total:</td><td style="padding:8px 0; font-weight:bold; text-align:right;">₱$totalFormatted</td></tr>
</table>
</div>

<!-- Footer -->
<div style="text-align:center; padding:20px; background:#001f54; color:#F7B32B; border-radius:0 0 8px 8px;">
<p style="margin:0; font-size:14px;">© 2025 Soliera Hotel. All rights reserved.</p>
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

    session()->flash('confirm', 'Reservation Status Has Been Confirmed');
    return redirect()->back();
}


    public function checkin(Reservation $reservationID){
          $reservationID->update([
            'reservation_bookingstatus' => 'Checked in'
        ]);

        $roomID = $reservationID->roomID;

        room::where('roomID', $roomID)->update([
            'roomstatus' => 'Occupied',
        ]);

        session()->flash('checkin', 'Guest Has Checked In');

        return redirect()->back();
    }

    public function checkout(Reservation $reservationID){
          $reservationID->update([
            'reservation_bookingstatus' => 'Checked out'
        ]);

        $roomID = $reservationID->roomID;
          $bookingID = $reservationID->bookingID;

         room::where('roomID', $roomID)->update([
            'roomstatus' => 'Available',
        ]);

        $reservationID->update([
            'payment_status' => 'Paid',
        ]);


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
                    $mail->addAddress($reservationID->guestemailaddress, $reservationID->guestname);
                    $mail->addEmbeddedImage(public_path('images/logo/sonly.png'), 'hotelLogo'); // Make sure file exists
                    $mail->isHTML(true);
                    $mail->Subject = "Booking Checkout - $reservationID->bookingID";

                    // Email HTML body
                    $mailBody = <<<HTML
            <!DOCTYPE html>
            <html lang="en">
            <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Booking Checkout - Soliera Hotel</title>
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
                    📋 BOOKING STATUS: CHECKED - OUT
                </div>
            </div>

            <!-- Main Content -->
            <div style="padding:30px 20px;">
                <h2 style="color:#001f54; margin:0 0 20px 0; font-size:24px; text-align:center;">Booking Checked Out</h2>
                
                <!-- Booking Reference -->
                <div style="text-align:center; margin-bottom:20px;">
                    <p style="color:#666; font-size:16px; margin:0;">
                        Booking ID: <span style="color:#001f54; font-weight:bold;">$bookingID</span>
                    </p>
                </div>

                <!-- Thank You -->
                <div style="text-align:center; padding:20px; background-color:#001f54; border-radius:8px; margin-bottom:20px;">
                    <h3 style="color:#F7B32B; margin:0 0 10px 0; font-size:20px;">Thank You for Staying with Soliera Hotel!</h3>
                    <p style="color:#ffffff; margin:0; line-height:1.6;">
                        We sincerely appreciate you choosing Soliera Hotel for your recent stay.<br>
                        We hope you enjoyed a comfortable and memorable experience with us.<br>
                        Your feedback means a lot — and we look forward to welcoming you back soon!
                    </p>
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




                    session()->flash('checkout', 'Guest Has Been Checked Out');

                    return redirect()->back();
                }

     public function cancel(Reservation $reservationID){
          $reservationID->update([
            'reservation_bookingstatus' => 'Cancelled'
        ]);

        $roomID = $reservationID->roomID;

         room::where('roomID', $roomID)->update([
            'roomstatus' => 'Available',
        ]);

        $bookingID = $reservationID->bookingID;

         session()->flash('cancel', 'Reservation Has Been Cancelled');

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
                    $mail->addAddress($reservationID->guestemailaddress, $reservationID->guestname);
                    $mail->addEmbeddedImage(public_path('images/logo/sonly.png'), 'hotelLogo'); // Make sure file exists
                    $mail->isHTML(true);
                    $mail->Subject = "Booking Cancelled - $reservationID->bookingID";

                    // Email HTML body
                    $mailBody = <<<HTML
            <!DOCTYPE html>
            <html lang="en">
            <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Booking Checkout - Soliera Hotel</title>
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
                    📋 BOOKING STATUS: CANCELLED
                </div>
            </div>

            <!-- Main Content -->
            <div style="padding:30px 20px;">
                <h2 style="color:#001f54; margin:0 0 20px 0; font-size:24px; text-align:center;">Booking Cancelled</h2>
                
                <!-- Booking Reference -->
                <div style="text-align:center; margin-bottom:20px;">
                    <p style="color:#666; font-size:16px; margin:0;">
                        Booking ID: <span style="color:#001f54; font-weight:bold;">$bookingID</span>
                    </p>
                </div>

                <!-- Thank You -->
                     <div style="text-align:center; padding:20px; background-color:#7f1d1d; border-radius:8px; margin-bottom:20px;">
                        <h3 style="color:#F7B32B; margin:0 0 10px 0; font-size:20px;">Your Booking Has Been Cancelled</h3>
                        <p style="color:#ffffff; margin:0; line-height:1.6;">
                            We’re sorry to see your booking cancelled.<br>
                            Your reservation with Booking ID: <span style="font-weight:bold; color:#F7B32B;">$bookingID</span>  
                            has been successfully cancelled in our system.<br><br>
                            If you change your mind, we’d be delighted to welcome you back at Soliera Hotel.<br>
                            Please don’t hesitate to book with us again anytime!
                        </p>
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



         

        return redirect()->back();
    }


public function generateInvoice($reservationID)
{
    // Fetch reservation with room info
    $booking = Reservation::join('core1_room', 'core1_room.roomID', '=', 'core1_reservation.roomID')
        ->where('core1_reservation.reservationID', $reservationID)
        ->firstOrFail();

    // Absolute path to logo
    $logoPath = public_path('images/logo/sonly.png');
    $bookedDate = date('M d, Y', strtotime($booking->created_at));
    $paymentstatus = $booking->payment_status; // safer than Reservation::value()

    // Render Blade template for PDF
    $html = view('admin.components.invoices.invoices-pdf', [
        'booking'      => $booking,
        'logoPath'     => $logoPath,
        'bookedDate'   => $bookedDate,
        'paymentstatus'=> $paymentstatus,
    ])->render();

    // PDF save path
    $pdfPath = public_path("images/invoices/invoice_{$booking->reservationID}.pdf");

    // Ensure directory exists
    if (!file_exists(dirname($pdfPath))) {
        mkdir(dirname($pdfPath), 0755, true);
    }

    // Generate PDF using Browsershot
    Browsershot::html($html)
        ->showBackground()
        ->format('A4')
        ->margins(10, 10, 10, 10)
        ->waitUntilNetworkIdle()
        ->timeout(120)
        ->save($pdfPath);

    // -------------------------
    // Send Email with PHPMailer
    // -------------------------
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
        $mail->addAddress($booking->guestemailaddress, $booking->guestname);

        // Embed logo
        $mail->addEmbeddedImage($logoPath, 'hotelLogo');

        // Attach invoice PDF
        if (file_exists($pdfPath)) {
            $mail->addAttachment($pdfPath, "Invoice_{$booking->bookingID}.pdf");
        }

        $mail->isHTML(true);
        $mail->Subject = "Booking Invoice - {$booking->bookingID}";

        // HTML email body
        $mailBody = <<<HTML
        <!DOCTYPE html>
        <html lang="en">
        <head>
        <meta charset="UTF-8">
        <title>Booking Invoice</title>
        </head>
        <body style="margin:0; padding:0; font-family: Arial, sans-serif; background-color:#f4f4f4;">
        <div style="max-width:600px; margin:0 auto; background-color:#ffffff; border-radius:8px; overflow:hidden; box-shadow:0 2px 10px rgba(0,0,0,0.1);">

            <!-- Header -->
            <div style="background-color:#001f54; padding:30px 20px; text-align:center;">
                <img src="cid:hotelLogo" alt="Soliera Hotel Logo" style="width:80px; height:80px; border-radius:50%; margin-bottom:15px;">
                <h1 style="color:#F7B32B; margin:0; font-size:28px; font-weight:bold;">SOLIERA HOTEL</h1>
                <p style="color:#ffffff; margin:10px 0 0 0; font-size:16px;">Savor The Stay, Dine With Elegance</p>
            </div>

            <!-- Booking Info -->
            <div style="padding:20px; text-align:center; background-color:#f8f9fa;">
                <p style="margin:0; font-size:16px; color:#333;">
                    Thank you <strong>{$booking->guestname}</strong> for choosing Soliera Hotel.
                </p>
                <p style="margin:5px 0 0 0; font-size:14px; color:#555;">
                    Booking ID: <strong>{$booking->bookingID}</strong><br>
                    Booked Date: {$bookedDate}<br>
                    Payment Status: <strong>{$paymentstatus}</strong>
                </p>
            </div>

            <!-- Thank You -->
            <div style="text-align:center; padding:20px; background-color:#001f54; border-radius:8px; margin:20px;">
                <h3 style="color:#F7B32B; margin:0 0 10px 0; font-size:20px;">Your Invoice is Attached</h3>
                <p style="color:#ffffff; margin:0; line-height:1.6;">
                    Please find the invoice for your booking attached to this email.<br>
                    We look forward to welcoming you again soon!
                </p>
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
        Log::error("Invoice email could not be sent: {$mail->ErrorInfo}");
    }

    // Return PDF URL (optional, if you still want to open/download it)
    $pdfUrl = asset("images/invoices/invoice_{$booking->reservationID}.pdf");
    return redirect($pdfUrl);
}
// guest

public function gueststore(Request $request)
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
        'payment_method' => 'required',
    ]);

    $form['guestID'] = Auth::guard('guest')->user()->guestID;
    $form['reservation_bookingstatus'] = 'Pending';
    $form['bookedvia'] = 'Soliera';
    
            if ($form['payment_method'] === 'Pay at Hotel') {
                $form['payment_status'] = "Pending";
            }

    // Create reservation first to get the ID
    $reservation = Reservation::create($form);

    // Generate receipt number algorithm
    $receiptNo = 'SOL-' . date('Ymd') . '-' . str_pad($reservation->reservationID, 6, '0', STR_PAD_LEFT);

     $bookingID = 'BKG-' . date('ymd') . '-' . str_pad($reservation->reservationID, 4, '0', STR_PAD_LEFT);

    // Update reservation with receipt number
    $reservation->update([
        'reservation_receipt' => $receiptNo,
         'bookingID' => $bookingID,
    ]);

    // Update room status
    Room::where('roomID', $form['roomID'])->update([
        'roomstatus' => 'Reserved',
    ]);


     $roomprice = Room::where('roomID', $form['roomID'])->value('roomprice');

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

    // Calculate nights

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





     session()->flash('success', ' Booking ID: ' . $bookingID);

    return redirect()->back();
}



}
