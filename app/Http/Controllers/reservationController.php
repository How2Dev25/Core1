<?php

namespace App\Http\Controllers;

use App\Models\aiPrompt;
use App\Models\guestnotification;
use App\Models\Inventory;
use App\Models\Reservation;
use App\Models\restobillingandpayments;
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
use App\Models\AuditTrails;
use App\Models\dynamicBilling;
use App\Models\employeenotification;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
use App\Models\guestloyaltypoints;
use App\Models\Lar;
use App\Models\loyaltyrules;
use App\Models\hotelBilling;
use App\Models\room_maintenance;
use App\Models\roomtypes;

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

    // Call Gemini to get JSON
    $aiRaw = $this->gemini->interpretPrompt($prompt);
    $parsed = json_decode($aiRaw, true);

    if (json_last_error() !== JSON_ERROR_NONE || !is_array($parsed)) {
        return response()->json([
            'message' => 'Invalid JSON response from Gemini.',
            'raw' => $aiRaw
        ], 400);
    }

    $roomtype = $parsed['roomtype'] ?? null;

    // Allowed room types
   $roomtypes = roomtypes::pluck('roomtype_name')->toArray(); 

    // Step 1: Try to get rooms based on requested type
$rooms = Room::leftJoin(
        'core1_loyaltyandrewards',
        'core1_loyaltyandrewards.roomID',
        '=',
        'core1_room.roomID'
    )
    ->whereIn('core1_room.roomtype', $roomtypes)
    ->when($roomtype, fn ($q) =>
        $q->where('core1_room.roomtype', $roomtype)
    )
    ->where('core1_room.roomstatus', 'Available')
    ->select(
        'core1_room.*',
        DB::raw('COALESCE(core1_loyaltyandrewards.loyalty_value, 0) as loyalty_value'),
        'core1_loyaltyandrewards.roomID as loyaltyroomID'
    )
    ->get();

    // Step 2: If no rooms found, get all available rooms and flash a message
    if ($rooms->isEmpty()) {

    session()->flash(
        'info',
        "Sorry, no {$roomtype} rooms are available. Here are other available rooms you might like:"
    );

    $rooms = Room::leftJoin(
            'core1_loyaltyandrewards',
            'core1_loyaltyandrewards.roomID',
            '=',
            'core1_room.roomID'
        )
        ->whereIn('core1_room.roomtype', $roomtypes)   // ✅ valid array
        ->where('core1_room.roomtype', '!=', $roomtype) // ✅ exclude requested type
        ->where('core1_room.roomstatus', 'Available')
        ->select(
            'core1_room.*',
            DB::raw('COALESCE(core1_loyaltyandrewards.loyalty_value, 0) as loyalty_value'),
            'core1_loyaltyandrewards.roomID as loyaltyroomID'
        )
        ->get();
}

$servicefee = dynamicBilling::where('dynamic_name', 'Service Fee')->value('dynamic_price');
$taxrate = dynamicBilling::where('dynamic_name', 'Tax Rate')->value('dynamic_price');
$additionalpersonfee = dynamicBilling::where('dynamic_name', 'Additional Person Fee')->value('dynamic_price');

 $myloyaltypoints = guestloyaltypoints::where('guestID', Auth::guard('guest')->user()->guestID)
            ->value('points_balance');

     $loyaltyrules = loyaltyrules::all();


     aiPrompt::create([
    'guestID' => Auth::guard('guest')->id(),
    'prompt_text' => $prompt,
    'roomtype' => $parsed['roomtype'] ?? null,
    'roommaxguest' => $parsed['roommaxguest'] ?? null,
    'roomfeatures' => isset($parsed['roomfeatures']) ? json_encode($parsed['roomfeatures']) : null,
    'reservation_days' => $parsed['reservation_days'] ?? null,
    'checkin_date' => $parsed['checkin_date'] ?? null,
    'checkout_date' => $parsed['checkout_date'] ?? null,
    'special_request' => $parsed['special_request'] ?? null,
    'raw_json' => $aiRaw
]);


    return view('guest.components.bas.withsuggestion', [
        'rooms' => $rooms,
        'criteria' => $parsed,
        'checkin' => $parsed['checkin_date'] ?? now()->toDateString(),
        'checkout' => $parsed['checkout_date'] ?? now()->addDays(1)->toDateString(),
        'specialRequest' => $parsed['special_request'] ?? '',
        'aiRaw' => $aiRaw,
        'servicefee' => $servicefee,
        'taxrate' => $taxrate,
        'additionalpersonfee' => $additionalpersonfee,
        'myloyaltypoints' => $myloyaltypoints,
        'loyaltyrules' => $loyaltyrules,
    ]);
}


public function guestnotif($guestname, $guestID, $roomID){
    guestnotification::create([
        'guestID' => $guestID,
        'module' => 'Front Desk',
        'guestname' => $guestname,
        'topic' => 'Reservation',
        'message' => "Your Reservation For Room $roomID is Pending",
        'status' => 'new',
    ]);
}
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

public function confirmnotif($guestname, $roomID, $guestID){
    if($guestID){
        guestnotification::create([
        'guestID' => $guestID,
        'module' => 'Front Desk',
        'guestname' => $guestname,
        'topic' => 'Reservation',
        'message' => "Your Reservation For Room $roomID Has Been Confirmed",
        'status' => 'new',
    ]);
    }
 
}

public function cancelnotif($guestname, $roomID, $guestID){
    if($guestID){
        guestnotification::create([
        'guestID' => $guestID,
        'module' => 'Front Desk',
        'guestname' => $guestname,
        'topic' => 'Reservation',
        'message' => "Your Reservation For Room $roomID Has Been Cancelled",
        'status' => 'new',
    ]);
    }
    
     employeenotification::create([
        'module' => 'Front Desk',
        'message' => ($guestname ? $guestname . ' Cancelled Reservation for Room ' . $roomID : 'A guest cancelled reservation for room ' . $roomID),
        'topic' => 'Reservation',
        'status' => 'new',
        'guestname' => !empty($guestname) ? $guestname : null,
    ]);
}

public function checkinnotif($guestname, $roomID, $guestID){
    if($guestID){
        guestnotification::create([
        'guestID' => $guestID,
        'module' => 'Front Desk',
        'guestname' => $guestname,
        'topic' => 'Reservation',
        'message' => "You Have Check in on room $roomID",
        'status' => 'new',
    ]);


    }
        
     employeenotification::create([
        'module' => 'Front Desk',
        'message' => ($guestname ? $guestname . ' Check In  ' . $roomID : 'A guest Check in on room ' . $roomID),
        'topic' => 'Reservation',
        'status' => 'new',
        'guestname' => !empty($guestname) ? $guestname : null,
    ]);
}

public function deletenotif($guestname, $roomID, $guestID){
    if($guestID){
          guestnotification::create([
        'guestID' => $guestID,
        'module' => 'Front Desk',
        'guestname' => $guestname,
        'topic' => 'Reservation',
        'message' => "Your reservation for room $roomID are removed",
        'status' => 'new',
    ]);

    }
      
}


public function checkoutnotif($guestname, $roomID, $guestID){
    if($guestID){
            guestnotification::create([
        'guestID' => $guestID,
        'module' => 'Front Desk',
        'guestname' => $guestname,
        'topic' => 'Reservation',
        'message' => "You Have Check out on room $roomID",
        'status' => 'new',
    ]);
    }
    
     employeenotification::create([
        'module' => 'Front Desk',
        'message' => ($guestname ? $guestname . ' Check Out on  ' . $roomID : 'A guest Check out on room ' . $roomID),
        'topic' => 'Reservation',
        'status' => 'new',
        'guestname' => !empty($guestname) ? $guestname : null,
    ]);
}


public function receiptnotif($guestname, $roomID, $guestID){
   
     employeenotification::create([
        'module' => 'Front Desk',
        'message' => "Invoice Has been sent to $guestname email address",
        'topic' => 'Payment',
        'status' => 'new',
        'guestname' => !empty($guestname) ? $guestname : null,
    ]);

    if($guestID){
        guestnotification::create([
        'guestID' => $guestID,
        'module' => 'Front Desk',
        'guestname' => $guestname,
        'topic' => 'Payment',
        'message' => "Your Receipt for Reservation Room $roomID is Email to your Email Address",
        'status' => 'new',
    ]);

    }
       
}

public function addloyaltypoints($guestID, $roomID, $guestname)
{
    if ($guestID) {
        // Get the loyalty value from the room
        $pointsValue = Lar::where('roomID', $roomID)->value('loyalty_value');

        // If the room has no defined loyalty points, default to 0
        $pointsToAdd = $pointsValue ?? 0;

        if ($pointsToAdd > 0) {
            $loyalty = GuestLoyaltyPoints::firstOrCreate(
                ['guestID' => $guestID],
                ['points_balance' => 0, 'points_reserved' => 0]
            );

            // Add new points
            $loyalty->points_balance += $pointsToAdd;
            $loyalty->save();

            guestnotification::create([
                'guestID' => $guestID,
                'module' => 'Front Desk',
                'topic' => 'Reservation',
                'guestname' => $guestname,
                'message' => "You have earned $pointsToAdd loyalty points from your recent booking.",
                'status' => 'new',
            ]);
        }
    }
}
public function deductLoyaltyPoints($loyaltyPointsUsed, $guestID, $guestname)
{
    if ($guestID && $loyaltyPointsUsed > 0) {
        // Find the guest's loyalty record
        $loyalty = GuestLoyaltyPoints::firstOrCreate(
            ['guestID' => $guestID],
            ['points_balance' => 0, 'points_reserved' => 0]
        );

        // Make sure the guest has enough points
        if ($loyalty->points_balance >= $loyaltyPointsUsed) {
            // Deduct points
            $loyalty->points_balance -= $loyaltyPointsUsed;
            $loyalty->save();

            // Notify the guest
            guestnotification::create([
                'guestID' => $guestID,
                'module' => 'Front Desk',
                'topic' => 'Loyalty Points',
                'guestname' => $guestname,
                'message' => "You have used $loyaltyPointsUsed loyalty points for your booking.",
                'status' => 'new',
            ]);

        } else {
            // Optional: if not enough points
            throw new \Exception("Insufficient loyalty points.");
        }
    }
}

public function billingHistory ($bookingID, $guestID, $guestname, $amount_paid, $payment_method){
  hotelBilling::firstOrCreate(
    ['transaction_reference' => $bookingID],
    [
        'guestID' => $guestID ?? null,
        'guestname' => $guestname,
        'payment_date' => Carbon::now(),
        'amount_paid' => $amount_paid,
        'payment_method' => $payment_method,
        'remarks' => 'Room Booking',
    ]
);
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
    'subtotal' => 'required',
    'vat' => 'required',
    'serviceFee' => 'required',
    'total' => 'required',
    'reservation_validID' => 'required'
], [
    'roomID.required' => 'Please select a room.',
    'reservation_checkin.required' => 'Check-in date is missing.',
    'reservation_checkout.required' => 'Check-out date is missing.',
    'reservation_specialrequest.required' => 'Special request cannot be empty.',
    'reservation_numguest.required' => 'Please specify the number of guests.',
    'guestname.required' => 'We need your full name.',
    'guestphonenumber.required' => 'A phone number is required.',
    'guestemailaddress.required' => 'An email address is required.',
    'guestbirthday.required' => 'Please enter your birth date.',
    'guestaddress.required' => 'Address cannot be empty.',
    'guestcontactperson.required' => 'Emergency contact person is required.',
    'guestcontactpersonnumber.required' => 'Emergency contact number is required.',
    'reservation_validID.required' => 'Valid ID is required',
]);

    $form['payment_method'] = "Pay at Hotel";
    $form['reservation_bookingstatus'] = 'Pending';
    $form['bookedvia'] = 'Soliera';
    $form['payment_status'] = "Pending";


    // photo valid ID
    $filename =  time() . '_' .$request->file('reservation_validID')->getClientOriginalName();
    $filepath = 'images/reservations/'.$filename;
    $request->file('reservation_validID')->move(public_path('images/reservations/'), $filename);
    $form['reservation_validID'] = $filepath;
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
            $subtotal = $reservation->subtotal;
            $serviceFee = $reservation->serviceFee;
            $vat = $reservation->vat;
            $total = $reservation->total;

            // Format numbers for email
            $subtotalFormatted = number_format($subtotal, 2);
            $serviceFeeFormatted = number_format($serviceFee, 2);
            $vatFormatted = number_format($vat, 2);
            $totalFormatted = number_format($total, 2);

             $bookedDate = date('F d, Y');

    // Convert check-in and check-out to human-readable format
    $checkin = date('F j, Y', strtotime($form['reservation_checkin']));
    $checkout = date('F j, Y', strtotime($form['reservation_checkout']));

    
            $servicefee2 = dynamicBilling::where('dynamic_name', 'Service Fee')->value('dynamic_price');
            $taxrate2 = dynamicBilling::where('dynamic_name', 'Tax Rate')->value('dynamic_price');

            $serviceFeedynamic = rtrim(rtrim(number_format($servicefee2, 2), '0'), '.') . '%';
            $taxRatedynamic = rtrim(rtrim(number_format($taxrate2, 2), '0'), '.') . '%';

    // Calculate nights
   


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


     AuditTrails::create([
            'dept_id' => Auth::user()->Dept_id,
            'dept_name' => Auth::user()->dept_name,
            'modules_cover' => 'Booking And Reservation',
            'action' => 'Create Booking',
            'activity' => 'Create Booking For ' .$form['guestname'],
            'employee_name' => Auth::user()->employee_name,
            'employee_id' => Auth::user()->employee_id,
            'role' => Auth::user()->role,
            'date' => Carbon::now()->toDateTimeString(),
        ]);


        // for notifications
        $guestname = $form['guestname'];
        $roomID = $form['roomID'];

        $this->employeenotif($guestname, $roomID);
        // 



    session()->flash('success', 'Reservation Success. Receipt #: ' . $receiptNo . ' | Booking ID: ' . $bookingID);

    return redirect('/bas');
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

          AuditTrails::create([
            'dept_id' => Auth::user()->Dept_id,
            'dept_name' => Auth::user()->dept_name,
            'modules_cover' => 'Booking And Reservation',
            'action' => 'Modify Booking',
            'activity' => 'Modify Booking ' .$reservationID->bookingID,
            'employee_name' => Auth::user()->employee_name,
            'employee_id' => Auth::user()->employee_id,
            'role' => Auth::user()->role,
            'date' => Carbon::now()->toDateTimeString(),
        ]);


        session()->flash('modified', 'Reservation Has Been Modified');

        return redirect()->back();
    }

        public function delete(Reservation $reservationID)
        {
            $roomIDUpdate = $reservationID->roomID;

            // Update room status back to Available
            Room::where('roomID', $roomIDUpdate)->update([
                'roomstatus' => 'Available',
            ]);

            // Delete reservation
            $reservationID->delete();

            // Only log audit trail if default Auth user is logged in
            if (Auth::check()) {
                $user = Auth::user();

                AuditTrails::create([
                    'dept_id'       => $user->Dept_id,
                    'dept_name'     => $user->dept_name,
                    'modules_cover' => 'Booking And Reservation',
                    'action'        => 'Remove Booking',
                    'activity'      => 'Remove Booking ' . $reservationID->bookingID,
                    'employee_name' => $user->employee_name,
                    'employee_id'   => $user->employee_id,
                    'role'          => $user->role,
                    'date'          => Carbon::now()->toDateTimeString(),
                ]);
            }

            $guestname = $reservationID->guestname;
            $roomID = $reservationID->roomID;
           $guestID = $reservationID->guestID ?? null;

            $this->deletenotif($guestname, $roomID, $guestID);

            session()->flash('removed', 'Reservation has been removed');

            

            return redirect()->back();
        }


  public function confirm(Request $request, Reservation $reservationID)
{
    // Update booking status
    $reservationID->update([
        'reservation_bookingstatus' => 'Confirmed'
    ]);

    // Determine payment confirmation type from modal
if ($request->payment_status == "Partial") {

    $deposit = $reservationID->total / 2;
    $balance = $reservationID->total - $deposit;

    $reservationID->update([
        'reservation_bookingstatus' => 'Confirmed',
        'payment_status' => 'Partial',
        'deposit_amount' => $deposit,
        'balance_remaining' => $balance
    ]);

} else {

    $reservationID->update([
        'reservation_bookingstatus' => 'Confirmed',
        'payment_status' => 'Paid',
        'deposit_amount' => $reservationID->total,
        'balance_remaining' => 0
    ]);
}

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
        $subtotal =  $reservationID->subtotal;
        $vat =  $reservationID->vat;
        $serviceFee =  $reservationID->serviceFee;
        $total =  $reservationID->total;

         $servicefee2 = dynamicBilling::where('dynamic_name', 'Service Fee')->value('dynamic_price');
            $taxrate2 = dynamicBilling::where('dynamic_name', 'Tax Rate')->value('dynamic_price');

            $serviceFeedynamic = rtrim(rtrim(number_format($servicefee2, 2), '0'), '.') . '%';
            $taxRatedynamic = rtrim(rtrim(number_format($taxrate2, 2), '0'), '.') . '%';

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

<tr>
<td style="padding:8px 0; color:#666;">Subtotal:</td>
<td style="padding:8px 0; color:#001f54; text-align:right;">₱$subtotalFormatted</td>
</tr>

<tr>
<td style="padding:8px 0; color:#666;">Service Fee ($serviceFeedynamic):</td>
<td style="padding:8px 0; color:#001f54; text-align:right;">₱$serviceFeeFormatted</td>
</tr>

<tr>
<td style="padding:8px 0; color:#666;">VAT ($taxRatedynamic):</td>
<td style="padding:8px 0; color:#001f54; text-align:right;">₱$vatFormatted</td>
</tr>

<tr style="border-top:2px solid #F7B32B;">
<td style="padding:8px 0; font-weight:bold;">Total Amount:</td>
<td style="padding:8px 0; font-weight:bold; text-align:right;">₱$totalFormatted</td>
</tr>

<tr>
<td style="padding:8px 0; color:#28a745; font-weight:bold;">Deposit Paid:</td>
<td style="padding:8px 0; color:#28a745; text-align:right;">₱{$reservationID->deposit_amount}</td>
</tr>

<tr>
<td style="padding:8px 0; color:#dc3545; font-weight:bold;">Remaining Balance:</td>
<td style="padding:8px 0; color:#dc3545; text-align:right;">₱{$reservationID->balance_remaining}</td>
</tr>

</table>

<p style="font-size:12px; color:#777; margin-top:10px;">
Please settle the remaining balance upon check-in. Deposit is non-refundable once reservation is confirmed.
</p>
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

     if (Auth::check()) {
                $user = Auth::user();

                AuditTrails::create([
                    'dept_id'       => $user->Dept_id,
                    'dept_name'     => $user->dept_name,
                    'modules_cover' => 'Front Desk And Reception',
                    'action'        => 'Confirm Booking',
                    'activity'      => 'Confirm Booking ID ' . $reservationID->bookingID,
                    'employee_name' => $user->employee_name,
                    'employee_id'   => $user->employee_id,
                    'role'          => $user->role,
                    'date'          => Carbon::now()->toDateTimeString(),
                ]);
            }

              $guestID = $reservationID->guestID ?? null;

            $this->confirmnotif($guestname, $roomID, $guestID);

            $this->addloyaltypoints($guestID, $roomID, $guestname);

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

        
     if (Auth::check()) {
                $user = Auth::user();

                AuditTrails::create([
                    'dept_id'       => $user->Dept_id,
                    'dept_name'     => $user->dept_name,
                    'modules_cover' => 'Front Desk And Reception',
                    'action'        => 'Check In Booking',
                    'activity'      => 'Check In Booking ID ' . $reservationID->bookingID,
                    'employee_name' => $user->employee_name,
                    'employee_id'   => $user->employee_id,
                    'role'          => $user->role,
                    'date'          => Carbon::now()->toDateTimeString(),
                ]);
            }

            
              $guestID = $reservationID->guestID ?? null;
              $guestname = $reservationID->guestname;

            $this->confirmnotif($guestname, $roomID, $guestID);

        session()->flash('checkin', 'Guest Has Checked In');

        return redirect()->back();
    }

   public function checkout(Reservation $reservationID)
{
    // Calculate payment info
    $deposit = $reservationID->deposit_amount ?? 0;
    $balanceRemaining = $reservationID->balance_remaining ?? 0;

    // Mark booking as checked out and fully paid
    $reservationID->update([
        'reservation_bookingstatus' => 'Checked out',
        'payment_status' => 'Paid',
        'balance_remaining' => 0, // settled
    ]);

    $roomID = $reservationID->roomID;
    $bookingID = $reservationID->bookingID;

    // Set room to Maintenance
    room::where('roomID', $roomID)->update([
        'roomstatus' => 'Maintenance',
    ]);

    // Create maintenance task
    room_maintenance::create([
        'maintenance_priority' => 'High',
        'maintenancedescription' => 'Room Cleaning',
        'roomID' => $roomID,
        'maintenancestatus' => 'Pending',
    ]);

    // Send checkout email
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
        $mail->addAddress($reservationID->guestemailaddress, $reservationID->guestname);
        $mail->addEmbeddedImage(public_path('images/logo/sonly.png'), 'hotelLogo');
        $mail->isHTML(true);
        $mail->Subject = "Booking Checkout - $bookingID";

        // Prepare payment info in the email
        $paymentInfoHtml = <<<HTML
        <tr>
            <td style="padding:8px 0; color:#666;">Deposit Paid:</td>
            <td style="padding:8px 0; color:#001f54; text-align:right;">₱{$deposit}</td>
        </tr>
        <tr>
            <td style="padding:8px 0; color:#666;">Balance Remaining:</td>
            <td style="padding:8px 0; color:#28a745; font-weight:bold; text-align:right;">₱0.00 (Settled)</td>
        </tr>
HTML;

        // Email HTML body
        $mailBody = <<<HTML
        <!DOCTYPE html>
        <html lang="en">
        <head>
        <meta charset="UTF-8">
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

                <!-- Payment Info Table -->
                <div style="padding:20px; background-color:#f8f9fa; border-radius:8px; margin-bottom:20px;">
                    <h3 style="color:#001f54; margin-bottom:10px;">Payment Summary</h3>
                    <table style="width:100%; border-collapse:collapse;">
                        $paymentInfoHtml
                        <tr>
                            <td style="padding:8px 0; color:#666; font-weight:bold;">Total Paid:</td>
                            <td style="padding:8px 0; color:#001f54; font-weight:bold; text-align:right;">₱{$reservationID->total}</td>
                        </tr>
                    </table>
                </div>

                <!-- Thank You Message -->
                <div style="text-align:center; padding:20px; background-color:#001f54; border-radius:8px; margin-bottom:20px;">
                    <h3 style="color:#F7B32B; margin:0 0 10px 0; font-size:20px;">Thank You for Staying with Soliera Hotel!</h3>
                    <p style="color:#ffffff; margin:0; line-height:1.6;">
                        We hope you enjoyed a comfortable and memorable experience with us.<br>
                        Your balance has been fully settled.
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
        Log::error("Booking checkout email could not be sent: {$mail->ErrorInfo}");
    }

    // Audit Trail
    if (Auth::check()) {
        $user = Auth::user();
        AuditTrails::create([
            'dept_id'       => $user->Dept_id,
            'dept_name'     => $user->dept_name,
            'modules_cover' => 'Front Desk And Reception',
            'action'        => 'Check Out Booking',
            'activity'      => 'Check Out Booking ID ' . $reservationID->bookingID,
            'employee_name' => $user->employee_name,
            'employee_id'   => $user->employee_id,
            'role'          => $user->role,
            'date'          => now(),
        ]);
    }

    // Billing & Notification
    $guestID = $reservationID->guestID ?? null;
    $guestname = $reservationID->guestname;
    $amount_paid = $reservationID->total;
    $payment_method = $reservationID->payment_method;

    $this->billingHistory($bookingID, $guestID, $guestname, $amount_paid, $payment_method);
    $this->checkoutnotif($guestname, $roomID, $guestID);

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


                 if (Auth::check()) {
                $user = Auth::user();

                AuditTrails::create([
                    'dept_id'       => $user->Dept_id,
                    'dept_name'     => $user->dept_name,
                    'modules_cover' => 'Front Desk And Reception',
                    'action'        => 'Cancel Booking',
                    'activity'      => 'Cancel Booking ' . $reservationID->bookingID,
                    'employee_name' => $user->employee_name,
                    'employee_id'   => $user->employee_id,
                    'role'          => $user->role,
                    'date'          => Carbon::now()->toDateTimeString(),
                ]);
            }

                     $guestID = $reservationID->guestID ?? null;
                    $guestname = $reservationID->guestname;

                    $this->cancelnotif($guestname, $roomID, $guestID);

         

        return redirect()->back();
    }


public function generateInvoice($reservationID)
{
    // Fetch reservation with room info
    $booking = Reservation::join('core1_room', 'core1_room.roomID', '=', 'core1_reservation.roomID')
        ->where('core1_reservation.reservationID', $reservationID)
        ->select(
            'core1_reservation.*',
            'core1_room.roomtype',
            'core1_room.roomprice',
            'core1_reservation.subtotal',
            'core1_reservation.vat',
            'core1_reservation.serviceFee',
            'core1_reservation.total',
            'core1_reservation.roomID',
            'core1_reservation.guestID',
            'core1_reservation.payment_status',
        )
        ->firstOrFail();

    $bookedDate    = date('M d, Y', strtotime($booking->created_at));
    $paymentstatus = $booking->payment_status;

    // ✅ Fetch restaurant orders for this booking (only Delivered)
    $orders = DB::table('orderfromresto')
        ->join('resto_integration', 'resto_integration.menuID', '=', 'orderfromresto.menuID')
        ->select(
            'orderfromresto.*',
            'resto_integration.menu_name',
            'resto_integration.menu_description',
            'resto_integration.menu_photo',
            'resto_integration.menu_price'
        )
        ->where('orderfromresto.bookingID', $booking->bookingID)
        ->where('orderfromresto.order_status', 'Delivered')
        ->get();

    // ✅ Compute totals (Hotel + Restaurant)
    $nights = Carbon::parse($booking->reservation_checkin)
        ->diffInDays(Carbon::parse($booking->reservation_checkout));

    $roomSubtotal = $booking->subtotal;
    $vat          = $booking->vat;
    $serviceFee   = $booking->serviceFee;
    $hotelTotal   = $booking->total;

    $servicefee2 = dynamicBilling::where('dynamic_name', 'Service Fee')->value('dynamic_price');
    $taxrate2 = dynamicBilling::where('dynamic_name', 'Tax Rate')->value('dynamic_price');

    $serviceFeedynamic = rtrim(rtrim(number_format($servicefee2, 2), '0'), '.') . '%';
    $taxRatedynamic = rtrim(rtrim(number_format($taxrate2, 2), '0'), '.') . '%';

    $restaurantTotal = $orders->sum(function($order) {
        return $order->menu_price * $order->order_quantity;
    });

    // Calculate grand total
    $grandTotal = $hotelTotal + $restaurantTotal;

    // ✅ Render Blade template for PDF (pass all data)
    $html = view('admin.components.invoices.invoices-pdf', [
        'booking'         => $booking,
        'bookedDate'      => $bookedDate,
        'paymentstatus'   => $paymentstatus,
        'orders'          => $orders,
        'hotelTotal'      => $hotelTotal,
        'restaurantTotal' => $restaurantTotal,
        'vat' => $vat,
        'roomserviceFee' => $serviceFee,
        'roomSubtotal' => $roomSubtotal,
        'serviceFeedynamic' => $serviceFeedynamic,
        'taxRatedynamic' => $taxRatedynamic,
    ])->render();

    // PDF save path
    $pdfPath = public_path("images/invoices/invoice_{$booking->reservationID}.pdf");

    if (!file_exists(dirname($pdfPath))) {
        mkdir(dirname($pdfPath), 0755, true);
    }

    // Generate PDF
    Pdf::loadHTML($html)
        ->setPaper('A4')
        ->save($pdfPath);

    // ====================================================================
    // ✅ SEND TO BILLING & INVOICING API
    // ====================================================================
    try {
        $this->sendToBillingAPI($booking, $pdfPath, $grandTotal, $paymentstatus);
    } catch (Exception $e) {
        Log::error("Failed to send invoice to Billing API: {$e->getMessage()}");
        // Continue execution even if API call fails
    }

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
        $mail->SMTPSecure = env('MAIL_ENCRYPTION');
        $mail->Port       = env('MAIL_PORT');

        $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
        $mail->addAddress($booking->guestemailaddress, $booking->guestname);

        if (file_exists($pdfPath)) {
            $mail->addAttachment($pdfPath, "Invoice_{$booking->bookingID}.pdf");
        }

        $mail->isHTML(true);
        $mail->Subject = "Booking Invoice - {$booking->bookingID}";

        $invoiceMessage = <<<HTML
<div style="text-align:center; padding:20px; background-color:#001f54; border-radius:8px; margin:20px;">
    <h3 style="color:#F7B32B; margin:0 0 10px 0; font-size:20px;">Your Invoice is Attached</h3>
    <p style="color:#ffffff; margin:0; line-height:1.6;">
        Please find the invoice for your booking attached to this email.<br>
        We look forward to welcoming you again soon!
    </p>
</div>
HTML;

// If partial payment, replace with balance notice
if (strtolower($booking->payment_status) === 'partial') {
    $invoiceMessage = <<<HTML
<div style="text-align:center; padding:20px; background-color:#001f54; border-radius:8px; margin:20px;">
    <h3 style="color:#F7B32B; margin:0 0 10px 0; font-size:20px;">Your Invoice is Attached</h3>
    <p style="color:#ffffff; margin:0; line-height:1.6;">
        Your deposit has been received, but your remaining balance is <strong>₱{$booking->balance_remaining}</strong>.<br>
        Please settle the remaining amount prior to check-in.
    </p>
</div>
HTML;
}

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
              {$invoiceMessage}

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

    // ✅ Audit Trail
    if (Auth::check()) {
        $user = Auth::user();
        AuditTrails::create([
            'dept_id'       => $user->Dept_id,
            'dept_name'     => $user->dept_name,
            'modules_cover' => 'Front Desk And Reception',
            'action'        => 'Generate Invoice',
            'activity'      => 'Generate Invoice ' . $booking->bookingID,
            'employee_name' => $user->employee_name,
            'employee_id'   => $user->employee_id,
            'role'          => $user->role,
            'date'          => Carbon::now()->toDateTimeString(),
        ]);

        if ($orders->isNotEmpty()) {
            foreach ($orders as $order) {
                restobillingandpayments::create([
                    'client_name'    => $booking->guestname,
                    'client_email'   => $booking->guestemailaddress,
                    'client_contact' => $booking->guestphonenumber,
                    'invoice_number' => $booking->reservation_receipt,
                    'invoice_date'   => Carbon::now()->format('Y-m-d'),
                    'due_date'       => Carbon::parse($booking->reservation_checkout)->format('Y-m-d'),
                    'status'         => $paymentstatus,
                    'description'    => $order->menu_name,
                    'quantity'       => $order->order_quantity,
                    'unit_price'     => $order->menu_price,
                    'total_amount'   => $order->menu_price * $order->order_quantity,
                    'payment_date'   => $booking->updated_at ?? null,
                    'payment_amount' => $order->menu_price * $order->order_quantity,
                    'MOP'            => $booking->payment_method ?? 'Cash',
                    'trans_ref'      => $booking->reservation_receipt ?? null,
                ]);
            }
        }
    }

    $guestname = $booking->guestname;
    $roomID = $booking->roomID;
    $guestID = $booking->guestID ?? null;
    $this->receiptnotif($guestname, $roomID, $guestID);

    return redirect(asset("images/invoices/invoice_{$booking->reservationID}.pdf"));
}

/**
 * Send invoice data to Billing & Invoicing API
 * FIXED: Using correct column name 'gid' instead of 'guest_id'
 */
private function sendToBillingAPI($booking, $pdfPath, $totalAmount, $paymentStatus)
{
    // API Configuration
    $apiUrl = env('BILLING_API_URL', 'https://financials.soliera-hotel-restaurant.com/api/receivable-billing-invoicing');
    $apiToken = env('BILLING_API_TOKEN', 'uX8B1QqYJt7XqTf0sM3tKAh5nCjEjR1Xlqk4F8ZdD1mHq5V9y7oUj1QhUzPg5s');

    // Determine payment status for API
    $apiPayStatus = 'Pending';
    $amountPaid = $totalAmount;

   if (strtoupper($paymentStatus) === 'PAID') {
    $apiPayStatus = 'Paid';
    $amountPaid = $totalAmount;
} elseif (strtoupper($paymentStatus) === 'PARTIAL') {
    $apiPayStatus = 'Partial';
    $amountPaid = $booking->amount_paid ?? 0;
}

    // ✅ FIXED: Prepare JSON payload - API expects 'guest_id' which it maps to 'gid' in database
    $payload = [
        'ref'            => $booking->reservation_receipt ?? "INV-{$booking->reservationID}",
        'tid'            => $booking->bookingID ?? "TID-{$booking->reservationID}",
        'guest_id'       => $booking->guestID ?? "GUEST-{$booking->reservationID}", // ✅ API expects 'guest_id'
        'guest_name'     => $booking->guestname,
        'payment_date'   => $booking->updated_at ? Carbon::parse($booking->updated_at)->format('Y-m-d') : Carbon::now()->format('Y-m-d'),
        'amount_paid'    => (float) $amountPaid,
        'total_due'      => (float) $totalAmount,
        'payment_method' => strtoupper($booking->payment_method ?? 'CASH'),
        'pay_status'     => $apiPayStatus,
        'status'         => $apiPayStatus === 'PAID' ? 'COMPLETED' : 'PENDING',
        'remarks'        => "Hotel invoice for booking {$booking->bookingID} - {$booking->guestname}",
    ];

    // Check if PDF file exists
    if (!file_exists($pdfPath)) {
        throw new Exception("PDF file not found at: {$pdfPath}");
    }

    // Read the PDF file content
    $fileContent = file_get_contents($pdfPath);
    if ($fileContent === false) {
        throw new Exception("Failed to read PDF file at: {$pdfPath}");
    }

    $fileName = basename($pdfPath);

    // Create multipart form data with file upload
    $boundary = '----WebKitFormBoundary' . uniqid();
    
    // Build multipart body
    $postData = '';
    
    // Add JSON payload as 'payload' field
    $postData .= '--' . $boundary . "\r\n";
    $postData .= 'Content-Disposition: form-data; name="payload"' . "\r\n";
    $postData .= 'Content-Type: application/json' . "\r\n\r\n";
    $postData .= json_encode($payload) . "\r\n";
    
    // Add PDF file as 'file_upload' field
    $postData .= '--' . $boundary . "\r\n";
    $postData .= 'Content-Disposition: form-data; name="file_upload"; filename="' . $fileName . '"' . "\r\n";
    $postData .= 'Content-Type: application/pdf' . "\r\n\r\n";
    $postData .= $fileContent . "\r\n";
    
    // End boundary
    $postData .= '--' . $boundary . '--' . "\r\n";

    // Initialize cURL
    $ch = curl_init($apiUrl);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_SSL_VERIFYPEER => true,
        CURLOPT_SSL_VERIFYHOST => 2,
        CURLOPT_HTTPHEADER => [
            'Accept: application/json',
            'Authorization: Bearer ' . $apiToken,
            'Content-Type: multipart/form-data; boundary=' . $boundary,
        ],
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $postData,
        CURLOPT_TIMEOUT => 30,
    ]);

    $response = curl_exec($ch);
    $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);
    curl_close($ch);

    // Handle cURL errors
    if ($response === false) {
        throw new Exception("cURL error: {$curlError}");
    }

    // Parse response
    $responseData = json_decode($response, true);

    // Log the API response with payload for debugging
    Log::info("Billing API Response", [
        'status_code' => $statusCode,
        'response' => $responseData,
        'booking_id' => $booking->bookingID,
        'payload_sent' => $payload,
        'file_name' => $fileName ?? 'N/A',
        'file_size' => isset($fileContent) ? strlen($fileContent) : 0,
    ]);

    // Check for errors
    if ($statusCode < 200 || $statusCode >= 300) {
        throw new Exception("API returned error status {$statusCode}: " . ($responseData['message'] ?? $response));
    }

    return $responseData;
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
         'subtotal' => 'required',
            'vat' => 'required',
            'serviceFee' => 'required',
            'total' => 'required',
            'loyalty_points_used' => 'required',
            'loyalty_discount' => 'required',
            'reservation_validID' => 'required',
    ],[
        'roomID.required' => 'Please select a room.',
        'reservation_checkin.required' => 'Check-in date is missing.',
        'reservation_checkout.required' => 'Check-out date is missing.',
        'reservation_specialrequest.required' => 'Special request cannot be empty.',
        'reservation_numguest.required' => 'Please specify the number of guests.',
        'guestname.required' => 'We need your full name.',
        'guestphonenumber.required' => 'A phone number is required.',
        'guestemailaddress.required' => 'An email address is required.',
        'guestbirthday.required' => 'Please enter your birth date.',
        'guestaddress.required' => 'Address cannot be empty.',
        'guestcontactperson.required' => 'Emergency contact person is required.',
        'guestcontactpersonnumber.required' => 'Emergency contact number is required.',
        'payment_method' => 'Payment Method is required',
        'reservation_validID.required' => 'Valid ID is required',
    ]);

    $form['guestID'] = Auth::guard('guest')->user()->guestID;
    $form['reservation_bookingstatus'] = 'Pending';
    $form['bookedvia'] = 'Soliera';

    $filename =  time() . '_' .$request->file('reservation_validID')->getClientOriginalName();
    $filepath = 'images/reservations/'.$filename;
    $request->file('reservation_validID')->move(public_path('images/reservations/'), $filename);
    $form['reservation_validID'] = $filepath;


    
            $servicefee2 = dynamicBilling::where('dynamic_name', 'Service Fee')->value('dynamic_price');
            $taxrate2 = dynamicBilling::where('dynamic_name', 'Tax Rate')->value('dynamic_price');

            $serviceFeedynamic = rtrim(rtrim(number_format($servicefee2, 2), '0'), '.') . '%';
            $taxRatedynamic = rtrim(rtrim(number_format($taxrate2, 2), '0'), '.') . '%';

    if ($form['payment_method'] === 'online') {

    \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

    // ✅ Get room details
    $room = Room::where('roomID', $form['roomID'])->first();

    // 💰 Compute totals dynamically
    $subtotal = $form['subtotal']; // base room total
    $vat = $form['vat']; // dynamic VAT
    $serviceFee = $form['serviceFee']; // dynamic service fee
    $grandTotal = $form['total']; // final total (including VAT & service fee)

    // 🏨 Room Image Endpoint (from .env)
    $roomImageEndpoint = env('ROOM_IMAGE_ENDPOINT');
    $roomImage = $roomImageEndpoint . $room->roomphoto;
    
    session(['reservation_form' => $form]);
    // 🧾 Create Stripe Checkout Session
    $checkout_session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [
            // Breakdown items
            [
                'price_data' => [
                    'currency' => 'php',
                    'product_data' => [
                        'name' => 'Room: ' . $room->roomID,
                        'description' => 'Base room price before fees',
                        'images' => [$roomImage],
                    ],
                    'unit_amount' => intval($subtotal * 100),
                ],
                'quantity' => 1,
            ],
            [
                'price_data' => [
                    'currency' => 'php',
                    'product_data' => [
                        'name' => "VAT ({$taxRatedynamic})",
                        'description' => 'Value Added Tax',
                    ],
                    'unit_amount' => intval($vat * 100),
                ],
                'quantity' => 1,
            ],
            [
                'price_data' => [
                    'currency' => 'php',
                    'product_data' => [
                        'name' => "Service Fee ({$serviceFeedynamic})",
                        'description' => 'Hotel service and transaction fee',
                    ],
                    'unit_amount' => intval($serviceFee * 100),
                ],
                'quantity' => 1,
            ],
        ],
        // ✅ Only charge the actual total (sum of above items)
        'mode' => 'payment',
        'success_url' => route('payment.success') . '?session_id={CHECKOUT_SESSION_ID}',
        'cancel_url' => route('payment.cancel'),
    ]);

    return redirect($checkout_session->url);
}

    
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

            $subtotal = $reservation->subtotal;
            $serviceFee = $reservation->serviceFee;
            $vat = $reservation->vat;
            $total = $reservation->total;

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

        $guestname = $form['guestname'];
        $roomID = $form['roomID'];
        $guestID = $form['guestID'];
        $loyaltyPointsUsed = $form['loyalty_points_used'];

        $this->employeenotif($guestname, $roomID);
        $this->guestnotif($guestname, $guestID, $roomID);
        $this->deductLoyaltyPoints($loyaltyPointsUsed, $guestID, $guestname );



     session()->flash('success', ' Booking ID: ' . $bookingID);

    return redirect('/myreservation');
}



public function aisubmit(Request $request)
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
        'subtotal' => 'required',
            'vat' => 'required',
            'serviceFee' => 'required',
            'total' => 'required',
              'loyalty_points_used' => 'required',
            'loyalty_discount' => 'required',
            'reservation_validID' => 'required',
    ]);


    $filename =  time() . '_' .$request->file('reservation_validID')->getClientOriginalName();
    $filepath = 'images/reservations/'.$filename;
    $request->file('reservation_validID')->move(public_path('images/reservations/'), $filename);
    $form['reservation_validID'] = $filepath;


    $form['guestID'] = Auth::guard('guest')->user()->guestID;
    $form['reservation_bookingstatus'] = 'Pending';
    $form['bookedvia'] = 'Soliera';

            $servicefee2 = dynamicBilling::where('dynamic_name', 'Service Fee')->value('dynamic_price');
            $taxrate2 = dynamicBilling::where('dynamic_name', 'Tax Rate')->value('dynamic_price');

            $serviceFeedynamic = rtrim(rtrim(number_format($servicefee2, 2), '0'), '.') . '%';
            $taxRatedynamic = rtrim(rtrim(number_format($taxrate2, 2), '0'), '.') . '%';

  if ($form['payment_method'] === 'online') {

    \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

    $room = Room::where('roomID', $form['roomID'])->first();
    $subtotal = $form['subtotal'];
    $vat = $form['vat'];
    $serviceFee = $form['serviceFee'];
    $grandTotal = $form['total'];
    $roomImageEndpoint = env('ROOM_IMAGE_ENDPOINT');
    $roomImage = $roomImageEndpoint . $room->roomphoto;

    session(['reservation_form' => $form]);

    $checkout_session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [
            [
                'price_data' => [
                    'currency' => 'php',
                    'product_data' => [
                        'name' => 'Room: ' . $room->roomID,
                        'description' => 'Base room price before fees',
                        'images' => [$roomImage],
                    ],
                    'unit_amount' => intval($subtotal * 100),
                ],
                'quantity' => 1,
            ],
            [
                'price_data' => [
                    'currency' => 'php',
                    'product_data' => [
                        'name' => "VAT ({$taxRatedynamic})",
                        'description' => 'Value Added Tax',
                    ],
                    'unit_amount' => intval($vat * 100),
                ],
                'quantity' => 1,
            ],
            [
                'price_data' => [
                    'currency' => 'php',
                    'product_data' => [
                        'name' => "Service Fee ({$serviceFeedynamic})",
                        'description' => 'Hotel service and transaction fee',
                    ],
                    'unit_amount' => intval($serviceFee * 100),
                ],
                'quantity' => 1,
            ],
        ],
        'mode' => 'payment',
        'success_url' => route('payment.success.ai') . '?session_id={CHECKOUT_SESSION_ID}',
        'cancel_url' => route('payment.cancel'),
    ]);

    // ✅ Check if JSON requested
    if ($request->expectsJson()) {
        return response()->json([
            'success' => true,
            'checkout_url' => $checkout_session->url,
        ]);
    } else {
        return redirect($checkout_session->url);
    }
}

    
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
               $subtotal = $reservation->subtotal;
            $serviceFee = $reservation->serviceFee;
            $vat = $reservation->vat;
            $total = $reservation->total;

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

        $guestname = $form['guestname'];
        $roomID = $form['roomID'];
        $guestID = $form['guestID'];
        $loyaltyPointsUsed = $form['loyalty_points_used'];

        $this->employeenotif($guestname, $roomID);
        $this->guestnotif($guestname, $guestID, $roomID);
        $this->deductLoyaltyPoints($loyaltyPointsUsed, $guestID, $guestname );



     session()->flash('success', ' Booking ID: ' . $bookingID);

   if ($request->expectsJson()) {
    return response()->json([
        'success' => true,
        'bookingID' => $bookingID,
        'redirect' => '/myreservation'
    ]);
}

return redirect('/myreservation');
}


public function sendBookingConfirmationEmail($data)
{
    $mail = new PHPMailer(true);

    try {
        // Setup SMTP
        $mail->isSMTP();
        $mail->Host       = env('MAIL_HOST');
        $mail->SMTPAuth   = true;
        $mail->Username   = env('MAIL_USERNAME');
        $mail->Password   = env('MAIL_PASSWORD');
        $mail->SMTPSecure = env('MAIL_ENCRYPTION');
        $mail->Port       = env('MAIL_PORT');
        $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));

        // Get dynamic billing rates
        $servicefee2 = dynamicBilling::where('dynamic_name', 'Service Fee')->value('dynamic_price');
        $taxrate2 = dynamicBilling::where('dynamic_name', 'Tax Rate')->value('dynamic_price');
        $serviceFeedynamic = rtrim(rtrim(number_format($servicefee2, 2), '0'), '.') . '%';
        $taxRatedynamic = rtrim(rtrim(number_format($taxrate2, 2), '0'), '.') . '%';

        // Format amounts
        $subtotalFormatted = number_format($data['subtotal'], 2);
        $serviceFeeFormatted = number_format($data['serviceFee'], 2);
        $vatFormatted = number_format($data['vat'], 2);
        $totalFormatted = number_format($data['total'], 2);

        // Format dates
        $checkin = date('F j, Y', strtotime($data['checkin']));
        $checkout = date('F j, Y', strtotime($data['checkout']));
        $bookedDate = isset($data['bookedDate']) ? date('F d, Y', strtotime($data['bookedDate'])) : date('F d, Y');

        // Calculate nights
        $nights = (strtotime($data['checkout']) - strtotime($data['checkin'])) / (60*60*24);

        // Set email details
        $mail->addAddress($data['email'], $data['guestname']);
        $mail->addEmbeddedImage(public_path('images/logo/sonly.png'), 'hotelLogo');
        $mail->isHTML(true);
        $mail->Subject = "Booking Confirmed - {$data['bookingID']}";

        // Determine deposit and balance display
        $depositPaid = isset($data['deposit_amount']) ? number_format($data['deposit_amount'], 2) : number_format($data['total'], 2);
        $balanceRemaining = isset($data['balance_remaining']) ? number_format($data['balance_remaining'], 2) : '0.00';

        // Email HTML body
        $mailBody = <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Booking Confirmed - Soliera Hotel</title>
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
    <div style="display:inline-block; background-color:#28a745; color:#ffffff; padding:8px 20px; border-radius:20px; font-weight:bold; font-size:14px; margin-bottom:10px;">
        ✓ BOOKING STATUS: CONFIRMED
    </div>
</div>

<!-- Main Content -->
<div style="padding:30px 20px;">
    <h2 style="color:#001f54; margin:0 0 20px 0; font-size:24px; text-align:center;">Your Reservation is Confirmed!</h2>
    
    <!-- Booking Details -->
    <div style="background-color:#f8f9fa; border-radius:8px; padding:20px; margin-bottom:20px; border-left:4px solid #F7B32B;">
        <h3 style="color:#001f54; margin:0 0 15px 0; font-size:18px;">Booking Information</h3>
        <table style="width:100%; border-collapse:collapse;">
            <tr><td style="padding:8px 0; color:#666; font-weight:bold;">Booking ID:</td><td style="padding:8px 0; color:#001f54; font-weight:bold;">{$data['bookingID']}</td></tr>
            <tr><td style="padding:8px 0; color:#666; font-weight:bold;">Room:</td><td style="padding:8px 0; color:#001f54;">{$data['roomID']}</td></tr>
            <tr><td style="padding:8px 0; color:#666; font-weight:bold;">Guest Name:</td><td style="padding:8px 0; color:#001f54;">{$data['guestname']}</td></tr>
            <tr><td style="padding:8px 0; color:#666; font-weight:bold;">Check-in:</td><td style="padding:8px 0; color:#001f54;">$checkin</td></tr>
            <tr><td style="padding:8px 0; color:#666; font-weight:bold;">Check-out:</td><td style="padding:8px 0; color:#001f54;">$checkout</td></tr>
            <tr><td style="padding:8px 0; color:#666; font-weight:bold;">Nights:</td><td style="padding:8px 0; color:#001f54;">$nights</td></tr>
            <tr><td style="padding:8px 0; color:#666; font-weight:bold;">Booked Date:</td><td style="padding:8px 0; color:#001f54;">$bookedDate</td></tr>
            <tr><td style="padding:8px 0; color:#666; font-weight:bold;">Payment Method:</td><td style="padding:8px 0; color:#001f54;">{$data['payment_method']}</td></tr>
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
            <tr>
                <td style="padding:8px 0; color:#28a745; font-weight:bold;">Deposit Paid:</td>
                <td style="padding:8px 0; color:#28a745; text-align:right;">₱$depositPaid</td>
            </tr>
            <tr>
                <td style="padding:8px 0; color:#dc3545; font-weight:bold;">Remaining Balance:</td>
                <td style="padding:8px 0; color:#dc3545; text-align:right;">₱$balanceRemaining</td>
            </tr>
        </table>
    </div>

    <!-- Thank You -->
    <div style="text-align:center; padding:20px; background-color:#001f54; border-radius:8px; margin-bottom:20px;">
        <h3 style="color:#F7B32B; margin:0 0 10px 0; font-size:20px;">Thank You for Your Booking!</h3>
        <p style="color:#ffffff; margin:0; line-height:1.6;">We are delighted to confirm your reservation at Soliera Hotel. We look forward to welcoming you!</p>
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
        
        return true;

    } catch (Exception $e) {
        Log::error("Booking email could not be sent: {$mail->ErrorInfo}");
        return false;
    }
}



public function paymentSuccessLanding(Request $request)
{
    Stripe::setApiKey(env('STRIPE_SECRET'));
    $form = session('reservation_form');
    
    // Get payment session to retrieve card details
    $sessionId = $request->get('session_id');
    $session = \Stripe\Checkout\Session::retrieve($sessionId);
    $paymentIntent = \Stripe\PaymentIntent::retrieve($session->payment_intent);
    
    // Get card brand (Visa, Mastercard, etc.)
    $cardBrand = $paymentIntent->charges->data[0]->payment_method_details->card->brand ?? 'Unknown';
    $cardBrand = ucfirst($cardBrand); // Capitalize first letter

    // Set to Confirmed instead of Pending
    $form['payment_status'] = 'Paid';
    $form['reservation_bookingstatus'] = 'Confirmed';
    
    
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

    // Send confirmation email
    $this->sendBookingConfirmationEmail([
        'bookingID' => $bookingID,
        'roomID' => $form['roomID'],
        'guestname' => $form['guestname'],
        'email' => $form['guestemailaddress'],
        'checkin' => $form['reservation_checkin'],
        'checkout' => $form['reservation_checkout'],
        'payment_method' => $form['payment_method'],
        'subtotal' => $reservation->subtotal,
        'serviceFee' => $reservation->serviceFee,
        'vat' => $reservation->vat,
        'total' => $reservation->total,
        'deposit_amount' => $reservation->total,
        'balance_remaining' => 0,
        'bookedDate' => $reservation->created_at,
    ]);

    $guestID = $reservation->guestID ?? null;
    $amount_paid = $reservation->total;
    $payment_method = $reservation->payment_method;

    $this->billingHistory($bookingID, $guestID, $form['guestname'], $amount_paid, $payment_method);

    session()->forget('reservation_form'); 
    return redirect()->route('booking.success', $reservation->reservationID)
        ->with('success', 'Payment successful! Your booking has been confirmed.');
}


public function paymentCancel()
{   
    session()->forget('reservation_form');
    return redirect()->back()->with('error', 'Payment was cancelled.');
}

public function paymentSuccess(Request $request){
        Stripe::setApiKey(env('STRIPE_SECRET'));
   
      $form = session('reservation_form');

    // Only insert after successful payment
    $form['payment_status'] = 'Paid';
    $form['reservation_bookingstatus'] = 'Confirmed';
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
$subtotal = $reservation->subtotal;
$serviceFee = $reservation->serviceFee;
$vat = $reservation->vat;
$total = $reservation->total;

// Format numbers for email
$subtotalFormatted = number_format($subtotal, 2);
$serviceFeeFormatted = number_format($serviceFee, 2);
$vatFormatted = number_format($vat, 2);
$totalFormatted = number_format($total, 2);

  $bookedDate = date('F d, Y');

    // Convert check-in and check-out to human-readable format
    $checkin = date('F j, Y', strtotime($form['reservation_checkin']));
    $checkout = date('F j, Y', strtotime($form['reservation_checkout']));

            $servicefee2 = dynamicBilling::where('dynamic_name', 'Service Fee')->value('dynamic_price');
            $taxrate2 = dynamicBilling::where('dynamic_name', 'Tax Rate')->value('dynamic_price');

            $serviceFeedynamic = rtrim(rtrim(number_format($servicefee2, 2), '0'), '.') . '%';
            $taxRatedynamic = rtrim(rtrim(number_format($taxrate2, 2), '0'), '.') . '%';
            
    // PHPMailer Integration

        $guestname = $form['guestname'];
        $roomID = $form['roomID'];
        $guestID = $form['guestID'];
        $loyaltyPointsUsed = $form['loyalty_points_used'];

         $amount_paid = 
         Reservation::where('reservationID', $reservation->reservationID)
         ->value('total');

        $payment_method = Reservation::where('reservationID', $reservation->reservationID)
        ->value('payment_method');

          $this->sendBookingConfirmationEmail([
        'bookingID' => $bookingID,
        'roomID' => $form['roomID'],
        'guestname' => $form['guestname'],
        'email' => $form['guestemailaddress'],
        'checkin' => $form['reservation_checkin'],
        'checkout' => $form['reservation_checkout'],
        'payment_method' => $form['payment_method'],
        'subtotal' => $reservation->subtotal,
        'serviceFee' => $reservation->serviceFee,
        'vat' => $reservation->vat,
        'total' => $reservation->total,
        'deposit_amount' => $reservation->total,
        'balance_remaining' => 0,
        'bookedDate' => $reservation->created_at,
    ]);

         $this->billingHistory($bookingID, $guestID, $guestname, $amount_paid, $payment_method);

        $this->employeenotif($guestname, $roomID);
        $this->guestnotif($guestname, $guestID, $roomID);
        $this->deductLoyaltyPoints($loyaltyPointsUsed, $guestID, $guestname );

    session()->forget('reservation_form'); 
    return redirect('/myreservation')->with('success', 'Booking ID: ' . $bookingID);
    
}

public function paymentSuccessAI(Request $request){
    Stripe::setApiKey(env('STRIPE_SECRET'));
   
      $form = session('reservation_form');

    // Only insert after successful payment
    $form['payment_status'] = 'Paid';
    $form['reservation_bookingstatus'] = 'Confirmed';
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
$subtotal = $reservation->subtotal;
$serviceFee = $reservation->serviceFee;
$vat = $reservation->vat;
$total = $reservation->total;

// Format numbers for email
$subtotalFormatted = number_format($subtotal, 2);
$serviceFeeFormatted = number_format($serviceFee, 2);
$vatFormatted = number_format($vat, 2);
$totalFormatted = number_format($total, 2);

  $bookedDate = date('F d, Y');

    // Convert check-in and check-out to human-readable format
    $checkin = date('F j, Y', strtotime($form['reservation_checkin']));
    $checkout = date('F j, Y', strtotime($form['reservation_checkout']));

            $servicefee2 = dynamicBilling::where('dynamic_name', 'Service Fee')->value('dynamic_price');
            $taxrate2 = dynamicBilling::where('dynamic_name', 'Tax Rate')->value('dynamic_price');

            $serviceFeedynamic = rtrim(rtrim(number_format($servicefee2, 2), '0'), '.') . '%';
            $taxRatedynamic = rtrim(rtrim(number_format($taxrate2, 2), '0'), '.') . '%';
            
    // PHPMailer Integration
   $this->sendBookingConfirmationEmail([
        'bookingID' => $bookingID,
        'roomID' => $form['roomID'],
        'guestname' => $form['guestname'],
        'email' => $form['guestemailaddress'],
        'checkin' => $form['reservation_checkin'],
        'checkout' => $form['reservation_checkout'],
        'payment_method' => $form['payment_method'],
        'subtotal' => $reservation->subtotal,
        'serviceFee' => $reservation->serviceFee,
        'vat' => $reservation->vat,
        'total' => $reservation->total,
        'deposit_amount' => $reservation->total,
        'balance_remaining' => 0,
        'bookedDate' => $reservation->created_at,
    ]);

     $guestname = $form['guestname'];
        $roomID = $form['roomID'];
        $guestID = $form['guestID'];
        $loyaltyPointsUsed = $form['loyalty_points_used'];


         $amount_paid = 
         Reservation::where('reservationID', $reservation->reservationID)
         ->value('total');

        $payment_method = Reservation::where('reservationID', $reservation->reservationID)
        ->value('payment_method');

         $this->billingHistory($bookingID, $guestID, $guestname, $amount_paid, $payment_method);

        $this->employeenotif($guestname, $roomID);
        $this->guestnotif($guestname, $guestID, $roomID);
        $this->deductLoyaltyPoints($loyaltyPointsUsed, $guestID, $guestname );

    session()->forget('reservation_form'); 

   session()->flash('success', ' Booking ID: ' . $bookingID);

   return redirect('/myreservation');
  
}


}


