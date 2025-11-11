<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ecm;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\AuditTrails;
use App\Models\ecmtype;
use App\Models\dynamicBilling;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\Log;
use App\Models\guestnotification;
use App\Models\employeenotification;
use App\Models\hotelBilling;
use Barryvdh\DomPDF\Facade\Pdf;



class ecmController extends Controller
{

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


public function notifyConfirmed($guestID, $guestname, $event_bookingreceiptID, $eventData){
    if($guestID){
        guestnotification::create([
            'guestID' => $guestID,
            'module' => 'Event And Conference',
            'guestname' => $guestname,
            'topic' => 'Reservation',
            'message' => "Your Event Reservation: $event_bookingreceiptID Has Been Confirmed ",
            'status' => 'new',
        ]);   
    }
    
    // Send confirmation email
    $this->sendConfirmationEmail($eventData);
}

public function sendConfirmationEmail($eventData){
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
        $mail->Subject = "Event Reservation Confirmed - {$eventData['event_name']}";

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
<title>Event Confirmation - Soliera Hotel</title>
</head>
<body style="margin:0; padding:0; font-family: Arial, sans-serif; background-color:#f4f4f4;">
<div style="max-width:600px; margin:0 auto; background-color:#ffffff; border-radius:8px; overflow:hidden; box-shadow:0 2px 10px rgba(0,0,0,0.1);">

<div style="background-color:#001f54; padding:30px 20px; text-align:center;">
    <img src="cid:hotelLogo" alt="Soliera Hotel Logo" style="width:80px; height:80px; border-radius:50%; margin-bottom:15px;">
    <h1 style="color:#F7B32B; margin:0; font-size:28px; font-weight:bold;">SOLIERA HOTEL</h1>
    <p style="color:#ffffff; margin:10px 0 0 0; font-size:16px;">Savor The Stay, Dine With Elegance</p>
</div>

<div style="padding:20px; text-align:center; background-color:#f8f9fa;">
    <div style="display:inline-block; background-color:#28a745; color:#ffffff; padding:8px 20px; border-radius:20px; font-weight:bold; font-size:14px; margin-bottom:10px;">
        ✅ EVENT CONFIRMED
    </div>
</div>

<div style="padding:30px 20px;">
    <h2 style="color:#001f54; margin:0 0 20px 0; font-size:24px; text-align:center;">Your Event Has Been Confirmed!</h2>
    
    <div style="text-align:center; margin-bottom:20px;">
        <p style="color:#666; font-size:16px; margin:0;">
           Reservation ID: <span style="color:#001f54; font-weight:bold;">' . ($eventData['event_bookingreceiptID'] ?? 'N/A') . '</span>
        </p>
    </div>
    
    <div style="text-align:center; padding:20px; background-color:#28a745; border-radius:8px; margin-bottom:25px;">
        <h3 style="color:#ffffff; margin:0 0 10px 0; font-size:20px;">🎉 Congratulations!</h3>
        <p style="color:#ffffff; margin:0; line-height:1.6;">
            Your event reservation has been confirmed.<br>
            We are excited to host your event and ensure everything runs smoothly!
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

    <div style="background-color:#d1ecf1; border-left:4px solid #0c5460; padding:15px; border-radius:4px; margin-bottom:20px;">
        <p style="color:#0c5460; margin:0; font-size:14px; line-height:1.6;">
            <strong>📌 Next Steps:</strong> Please arrive 30 minutes before your scheduled event time for setup coordination. 
            Our event coordinator will contact you 48 hours before the event to finalize all arrangements.
        </p>
    </div>

    <div style="text-align:center; padding:20px 0;">
        <p style="color:#666; font-size:14px; margin:0 0 10px 0;">For inquiries or modifications, please contact us:</p>
        <p style="color:#001f54; font-weight:bold; margin:0; font-size:14px;">📧 ' . env('MAIL_FROM_ADDRESS') . '</p>
    </div>
</div>

<div style="background-color:#001f54; padding:20px; text-align:center;">
    <p style="color:#F7B32B; margin:0 0 5px 0; font-size:14px; font-weight:bold;">Thank you for choosing Soliera Hotel!</p>
    <p style="color:#ffffff; margin:0; font-size:12px;">© 2025 Soliera Hotel. All rights reserved.</p>
</div>
</div>
</body>
</html>';

        $mail->Body = $mailBody;
        $mail->send();
        
        return true;

    } catch (Exception $e) {
        Log::error("Event confirmation email could not be sent: {$mail->ErrorInfo}");
        return false;
    }
}

public function notifyCancelled($guestID, $guestname, $event_bookingreceiptID, $eventData){
    if($guestID){
        guestnotification::create([
            'guestID' => $guestID,
            'module' => 'Event And Conference',
            'guestname' => $guestname,
            'topic' => 'Reservation',
            'message' => "Your Event Reservation: $event_bookingreceiptID Has Been Cancelled ",
            'status' => 'new',
        ]);   
    }

    employeenotification::create([
        'module' => 'Event And Conference',
        'message' => "$guestname Has Cancelled an event reference ID: $event_bookingreceiptID",
        'topic' => 'Reservation',
        'status' => 'new',
        'guestname' => !empty($guestname) ? $guestname : null,
    ]);

    // Send cancellation email
    $this->sendCancellationEmail($eventData);
}

public function sendCancellationEmail($eventData){
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
        $mail->Subject = "Event Reservation Cancelled - {$eventData['event_name']}";

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
<title>Event Cancellation - Soliera Hotel</title>
</head>
<body style="margin:0; padding:0; font-family: Arial, sans-serif; background-color:#f4f4f4;">
<div style="max-width:600px; margin:0 auto; background-color:#ffffff; border-radius:8px; overflow:hidden; box-shadow:0 2px 10px rgba(0,0,0,0.1);">

<div style="background-color:#001f54; padding:30px 20px; text-align:center;">
    <img src="cid:hotelLogo" alt="Soliera Hotel Logo" style="width:80px; height:80px; border-radius:50%; margin-bottom:15px;">
    <h1 style="color:#F7B32B; margin:0; font-size:28px; font-weight:bold;">SOLIERA HOTEL</h1>
    <p style="color:#ffffff; margin:10px 0 0 0; font-size:16px;">Savor The Stay, Dine With Elegance</p>
</div>

<div style="padding:20px; text-align:center; background-color:#f8f9fa;">
    <div style="display:inline-block; background-color:#dc3545; color:#ffffff; padding:8px 20px; border-radius:20px; font-weight:bold; font-size:14px; margin-bottom:10px;">
        ❌ EVENT CANCELLED
    </div>
</div>

<div style="padding:30px 20px;">
    <h2 style="color:#001f54; margin:0 0 20px 0; font-size:24px; text-align:center;">Event Reservation Cancelled</h2>
    
    <div style="text-align:center; margin-bottom:20px;">
        <p style="color:#666; font-size:16px; margin:0;">
           Reservation ID: <span style="color:#001f54; font-weight:bold;">' . ($eventData['event_bookingreceiptID'] ?? 'N/A') . '</span>
        </p>
    </div>
    
    <div style="text-align:center; padding:20px; background-color:#f8d7da; border-radius:8px; margin-bottom:25px;">
        <h3 style="color:#721c24; margin:0 0 10px 0; font-size:20px;">Cancellation Confirmed</h3>
        <p style="color:#721c24; margin:0; line-height:1.6;">
            Your event reservation has been successfully cancelled.<br>
            We hope to have the opportunity to serve you in the future.
        </p>
    </div>

    <div style="background-color:#f8f9fa; border-radius:8px; padding:20px; margin-bottom:20px;">
        <h3 style="color:#001f54; margin:0 0 15px 0; font-size:18px; border-bottom:2px solid #F7B32B; padding-bottom:10px;">📋 Cancelled Event Details</h3>
        
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

    <div style="background-color:#fff3cd; border-left:4px solid #F7B32B; padding:15px; border-radius:4px; margin-bottom:20px;">
        <p style="color:#856404; margin:0; font-size:14px; line-height:1.6;">
            <strong>💰 Refund Policy:</strong> If you have already made a payment, our team will process your refund according to our cancellation policy. 
            You will receive a separate email regarding the refund status within 3-5 business days.
        </p>
    </div>

    <div style="background-color:#e7f3ff; border-left:4px solid #0066cc; padding:15px; border-radius:4px; margin-bottom:20px;">
        <p style="color:#004085; margin:0; font-size:14px; line-height:1.6;">
            <strong>📅 Book Again:</strong> We would love to host your event in the future! 
            Please feel free to contact us anytime to make a new reservation.
        </p>
    </div>

    <div style="text-align:center; padding:20px 0;">
        <p style="color:#666; font-size:14px; margin:0 0 10px 0;">For inquiries or to make a new reservation, please contact us:</p>
        <p style="color:#001f54; font-weight:bold; margin:0; font-size:14px;">📧 ' . env('MAIL_FROM_ADDRESS') . '</p>
    </div>
</div>

<div style="background-color:#001f54; padding:20px; text-align:center;">
    <p style="color:#F7B32B; margin:0 0 5px 0; font-size:14px; font-weight:bold;">We hope to serve you again soon!</p>
    <p style="color:#ffffff; margin:0; font-size:12px;">© 2025 Soliera Hotel. All rights reserved.</p>
</div>
</div>
</body>
</html>';

        $mail->Body = $mailBody;
        $mail->send();
        
        return true;

    } catch (Exception $e) {
        Log::error("Event cancellation email could not be sent: {$mail->ErrorInfo}");
        return false;
    }
}
public function printReceipt($eventbookingID)
{
    // Fetch event booking with related data
    $event = Ecm::where('eventbookingID', $eventbookingID)
        ->select('*')
        ->firstOrFail();

    $bookedDate = date('M d, Y', strtotime($event->event_bookedate));
    $paymentstatus = $event->event_paymentstatus;

    $eventtype_ID = $event->eventtype_ID;
    $eventype = ecmtype::where('eventtype_ID', $eventtype_ID)->value('eventtype_name');
   
    $eventTotal = $event->event_total_price;

   

    // Render Blade template for PDF
    $html = view('admin.components.invoices.event-receipt-pdf', [
        'event' => $event,
        'bookedDate' => $bookedDate,
        'paymentstatus' => $paymentstatus,
        'eventTotal' => $eventTotal,
        'eventType' => $eventype,
       
    ])->render();

    // PDF save path
    $pdfPath = public_path("images/invoices/event_receipt_{$event->eventbookingID}.pdf");

    if (!file_exists(dirname($pdfPath))) {
        mkdir(dirname($pdfPath), 0755, true);
    }

    // Generate PDF
    Pdf::loadHTML($html)
        ->setPaper('A4')
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
        $mail->SMTPSecure = env('MAIL_ENCRYPTION');
        $mail->Port       = env('MAIL_PORT');

        $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
        $mail->addAddress($event->eventorganizer_email, $event->eventorganizer_name);

        if (file_exists($pdfPath)) {
            $mail->addAttachment($pdfPath, "Event_Receipt_{$event->eventbookingID}.pdf");
        }

        $mail->isHTML(true);
        $mail->Subject = "Event Booking Receipt - {$event->event_bookingreceiptID}";

        $mailBody = <<<HTML
        <!DOCTYPE html>
        <html lang="en">
        <head>
        <meta charset="UTF-8">
        <title>Event Booking Receipt</title>
        </head>
        <body style="margin:0; padding:0; font-family: Arial, sans-serif; background-color:#f4f4f4;">
        <div style="max-width:600px; margin:0 auto; background-color:#ffffff; border-radius:8px; overflow:hidden; box-shadow:0 2px 10px rgba(0,0,0,0.1);">

            <!-- Header -->
            <div style="background-color:#001f54; padding:30px 20px; text-align:center;">
                <h1 style="color:#F7B32B; margin:0; font-size:28px; font-weight:bold;">SOLIERA HOTEL</h1>
                <p style="color:#ffffff; margin:10px 0 0 0; font-size:16px;">Savor The Stay, Dine With Elegance</p>
            </div>

            <!-- Event Info -->
            <div style="padding:20px; text-align:center; background-color:#f8f9fa;">
                <p style="margin:0; font-size:16px; color:#333;">
                    Thank you <strong>{$event->eventorganizer_name}</strong> for choosing Soliera Hotel for your event.
                </p>
                <p style="margin:5px 0 0 0; font-size:14px; color:#555;">
                    Event Booking ID: <strong>{$event->event_bookingreceiptID}</strong><br>
                    Event: <strong>{$event->event_name}</strong><br>
                    Booked Date: {$bookedDate}<br>
                    Payment Status: <strong>{$paymentstatus}</strong>
                </p>
            </div>

            <!-- Thank You -->
            <div style="text-align:center; padding:20px; background-color:#001f54; border-radius:8px; margin:20px;">
                <h3 style="color:#F7B32B; margin:0 0 10px 0; font-size:20px;">Your Event Receipt is Attached</h3>
                <p style="color:#ffffff; margin:0; line-height:1.6;">
                    Please find the receipt for your event booking attached to this email.<br>
                    We look forward to hosting your event!
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
        Log::error("Event receipt email could not be sent: {$mail->ErrorInfo}");
    }

    // ✅ Audit Trail
    if (Auth::check()) {
        $user = Auth::user();
        AuditTrails::create([
            'dept_id'       => $user->Dept_id,
            'dept_name'     => $user->dept_name,
            'modules_cover' => 'Event Management',
            'action'        => 'Generate Event Receipt',
            'activity'      => 'Generate Event Receipt ' . $event->eventbookingID,
            'employee_name' => $user->employee_name,
            'employee_id'   => $user->employee_id,
            'role'          => $user->role,
            'date'          => Carbon::now()->toDateTimeString(),
        ]);
    }

    return redirect(asset("images/invoices/event_receipt_{$event->eventbookingID}.pdf"));
}

public function notifyDone($guestID, $guestname, $event_bookingreceiptID, $eventData){

    if($guestID){
        guestnotification::create([
            'guestID' => $guestID,
            'module' => 'Event And Conference',
            'guestname' => $guestname,
            'topic' => 'Reservation',
            'message' => "Your Event Reservation: $event_bookingreceiptID is Done Thank You For Booking Event in Soliera. ",
            'status' => 'new',
        ]);   
    }

    // Send thank you email
    $this->sendThankYouEmail($eventData);
}

public  function sendThankYouEmail($eventData){
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
        $mail->Subject = "Thank You for Choosing Soliera Hotel - {$eventData['event_name']}";

        $checkinDate = date('F j, Y', strtotime($eventData['event_checkin']));

        $mailBody = '<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Thank You - Soliera Hotel</title>
</head>
<body style="margin:0; padding:0; font-family: Arial, sans-serif; background-color:#f4f4f4;">
<div style="max-width:600px; margin:0 auto; background-color:#ffffff; border-radius:8px; overflow:hidden; box-shadow:0 2px 10px rgba(0,0,0,0.1);">

<div style="background-color:#001f54; padding:30px 20px; text-align:center;">
    <img src="cid:hotelLogo" alt="Soliera Hotel Logo" style="width:80px; height:80px; border-radius:50%; margin-bottom:15px;">
    <h1 style="color:#F7B32B; margin:0; font-size:28px; font-weight:bold;">SOLIERA HOTEL</h1>
    <p style="color:#ffffff; margin:10px 0 0 0; font-size:16px;">Savor The Stay, Dine With Elegance</p>
</div>

<div style="padding:20px; text-align:center; background-color:#f8f9fa;">
    <div style="display:inline-block; background-color:#6f42c1; color:#ffffff; padding:8px 20px; border-radius:20px; font-weight:bold; font-size:14px; margin-bottom:10px;">
        🎊 EVENT COMPLETED
    </div>
</div>

<div style="padding:30px 20px;">
    <h2 style="color:#001f54; margin:0 0 20px 0; font-size:24px; text-align:center;">Thank You!</h2>
    
    <div style="text-align:center; margin-bottom:20px;">
        <p style="color:#666; font-size:16px; margin:0;">
           Reservation ID: <span style="color:#001f54; font-weight:bold;">' . ($eventData['event_bookingreceiptID'] ?? 'N/A') . '</span>
        </p>
    </div>
    
    <div style="text-align:center; padding:25px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius:8px; margin-bottom:25px;">
        <h3 style="color:#ffffff; margin:0 0 15px 0; font-size:20px;">We Appreciate You!</h3>
        <p style="color:#ffffff; margin:0; line-height:1.8; font-size:15px;">
            Thank you for choosing Soliera Hotel for your event.<br>
            It was our pleasure to host <strong>' . $eventData['event_name'] . '</strong><br>
            We hope everything was perfect and look forward to serving you again!
        </p>
    </div>

    <div style="background-color:#f8f9fa; border-radius:8px; padding:20px; margin-bottom:20px;">
        <h3 style="color:#001f54; margin:0 0 15px 0; font-size:18px; border-bottom:2px solid #F7B32B; padding-bottom:10px;">📋 Event Summary</h3>
        
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
                <td style="padding:10px 0; color:#666; font-size:14px;">Event Date:</td>
                <td style="padding:10px 0; color:#001f54; font-weight:bold; font-size:14px;">' . $checkinDate . '</td>
            </tr>
            <tr>
                <td style="padding:10px 0; color:#666; font-size:14px;">Number of Guests:</td>
                <td style="padding:10px 0; color:#001f54; font-weight:bold; font-size:14px;">' . $eventData['event_numguest'] . ' Guests</td>
            </tr>
        </table>
    </div>

    <div style="text-align:center; padding:20px 0;">
        <p style="color:#666; font-size:14px; margin:0 0 10px 0;">For future bookings or inquiries:</p>
        <p style="color:#001f54; font-weight:bold; margin:0; font-size:14px;">📧 ' . env('MAIL_FROM_ADDRESS') . '</p>
    </div>
</div>

<div style="background-color:#001f54; padding:20px; text-align:center;">
    <p style="color:#F7B32B; margin:0 0 5px 0; font-size:14px; font-weight:bold;">Thank you for making your event memorable with us!</p>
    <p style="color:#ffffff; margin:0; font-size:12px;">© 2025 Soliera Hotel. All rights reserved.</p>
</div>
</div>
</body>
</html>';

        $mail->Body = $mailBody;
        $mail->send();
        
        return true;

    } catch (Exception $e) {
        Log::error("Event thank you email could not be sent: {$mail->ErrorInfo}");
        return false;
    }
}

public function notifyDelete($guestID, $guestname, $event_bookingreceiptID){
    if($guestID){
        guestnotification::create([
            'guestID' => $guestID,
            'module' => 'Event And Conference',
            'guestname' => $guestname,
            'topic' => 'Reservation',
            'message' => "Your Event Reservation: $event_bookingreceiptID Has Been Removed ",
            'status' => 'new',
        ]);   
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
    ]
);
}

    public function store(Request $request)
{
   
    // ✅ Validate & store into $form
    $form = $request->validate([
        'eventtype_ID'        => 'required',
        'eventorganizer_email'=> 'required',
        'eventorganizer_name' => 'required',
        'eventorganizer_phone'=> 'required',
        'event_name'          => 'required',
        'event_specialrequest'=> 'nullable',
        'event_equipment'     => 'nullable',
        'event_paymentmethod' => 'required',
        'event_checkin'       => 'required',
        'event_checkout'      => 'required',
        'event_numguest' => 'required',
        'event_total_price' => 'required',
    ]);

    // ✅ Add extra fields not from form
    $form['eventstatus']            = 'Pending';
    $form['event_bookedate']        = Carbon::now()->toDateString();
            if (Auth::guard('guest')->check()) {
            $form['guestID'] = Auth::guard('guest')->user()->guestID;
        } else {
    $form['guestID'] = null;
        }
    $form['event_eventreceipt']     = null;
    $form['event_bookingreceiptID'] = strtoupper(uniqid("ECM-"));
    $form['event_paymentstatus'] = 'Unpaid';

    // ✅ Create ECM record
    $ecm = Ecm::create($form);

    // ✅ Audit trail
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
   


     $this->sendEventReservationEmail($form);
     $this->notifyguestandemployee($form['guestID'], $form['eventorganizer_name'],  $form['event_bookingreceiptID']);



    // ✅ Flash success message
if (Auth::check() || Auth::guard('guest')->check()) {
    // Either admin/user OR guest is logged in
    session()->flash('success', 'ECM booking has been successfully created.');
    return redirect()->back();
} else {
    // No one is logged in (from landing page)
    return redirect()->route('eventbooking.success', $ecm->eventbookingID);
}
   
}

  
     public function bookevent($eventtype_ID){


 $eventtype = ecmtype::join('core1_facility', 'core1_facility.facilityID', '=', 'core1_eventtype.facilityID')
    ->where('core1_eventtype.eventtype_ID', $eventtype_ID)
    ->first();

     $additionalpersonfee = dynamicBilling::where('dynamic_name', 'Additional Person Fee')->value('dynamic_price');

    return view('admin.components.ecm.bookingpage', 
    compact('eventtype', 'additionalpersonfee'));
     
     
     }

     public function eventbookinglanding($eventtype_ID){
         $eventtype = ecmtype::join('core1_facility', 'core1_facility.facilityID', '=', 'core1_eventtype.facilityID')
    ->where('core1_eventtype.eventtype_ID', $eventtype_ID)
    ->first();

     $additionalpersonfee = dynamicBilling::where('dynamic_name', 'Additional Person Fee')->value('dynamic_price');

     return view('events.eventselected', compact('eventtype', 'additionalpersonfee'));
     }

     public function eventbookingguest($eventtype_ID){
         $eventtype = ecmtype::join('core1_facility', 'core1_facility.facilityID', '=', 'core1_eventtype.facilityID')
    ->where('core1_eventtype.eventtype_ID', $eventtype_ID)
    ->first();

     $additionalpersonfee = dynamicBilling::where('dynamic_name', 'Additional Person Fee')->value('dynamic_price');

     return view('guest.components.events.eventselected', compact('eventtype', 'additionalpersonfee'));
     }
        

     public function confirmReservation(Ecm $eventbookingID){
      $bookingreceiptadd = $eventbookingID->event_bookingreceiptID . '-R' . date('ymd') . rand(100, 999);
        $eventbookingID->update([
            'event_eventreceipt' => $bookingreceiptadd,
            'event_paymentstatus' => 'Paid',
            'eventstatus' => 'Confirmed',
        ]);

        $this->billingHistory($eventbookingID->event_bookingreceiptID,
        $eventbookingID->guestID,
        $eventbookingID->eventorganizer_name,
        $eventbookingID->event_total_price,
        $eventbookingID->event_paymentmethod);

        $this->notifyConfirmed($eventbookingID->guestID, $eventbookingID->eventorganizer_name, $eventbookingID->event_bookingreceiptID, $eventbookingID);

        return redirect()->back()->with('success', 'Reservation Has Been Confirmed');
     }

    public function deleteReservation(Ecm $eventbookingID){
        $eventbookingID->delete();

        $this->notifyDelete($eventbookingID->guestID, $eventbookingID->eventorganizer_name, $eventbookingID->event_bookingreceiptID);
        return redirect()->back()->with('success', 'Reservation Has Been Removed');
        
    }

        public function cancelReservation(Ecm $eventbookingID){
        $eventbookingID->update([
            'eventstatus' => 'Cancelled',
        ]);

        
        $this->notifyCancelled($eventbookingID->guestID, 
        $eventbookingID->eventorganizer_name, 
        $eventbookingID->event_bookingreceiptID, 
        $eventbookingID);

         return redirect()->back()->with('success', 'Reservation Has Been Cancelled');
    }

    public function doneReservation(Ecm $eventbookingID){
         
       $eventbookingID->update([
            'eventstatus' => 'Done',
        ]);

 

        $this->notifyDone($eventbookingID->guestID, 
        $eventbookingID->eventorganizer_name, 
        $eventbookingID->event_bookingreceiptID, 
        $eventbookingID);

         return redirect()->back()->with('success', 'Reservation Has Been Marked As Done');
    }

}

