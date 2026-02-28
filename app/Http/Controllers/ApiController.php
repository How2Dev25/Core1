<?php

namespace App\Http\Controllers;

use App\Models\AuditTrails;
use App\Models\Channel;
use App\Models\DeptAccount;
use App\Models\DeptLogs;
use App\Models\doorlock;
use App\Models\doorlockFrontdesk;
use App\Models\Ecm;
use App\Models\EmployeeReport;
use App\Models\facility;
use App\Models\hotelBilling;
use App\Models\kotresto;
use App\Models\ordersfromresto;
use App\Models\requestEmployee;
use App\Models\Reservation;
use App\Models\restobillingandpayments;
use App\Models\rfidHistory;
use App\Models\room;
use App\Models\stockRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as MailException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use App\Models\ecmtype;
use App\Models\Guest;
use App\Models\masterRFID;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class ApiController extends Controller
{

    // maillers

public function sendApprovalEmail($eventData){
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
        $mail->Subject = "Event Booking Approved - {$eventData['event_name']}";

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
<title>Event Approval - Soliera Hotel</title>
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
        ✓ ADMINISTRATIVELY APPROVED
    </div>
</div>

<div style="padding:30px 20px;">
    <h2 style="color:#001f54; margin:0 0 20px 0; font-size:24px; text-align:center;">Hotel Administrative Has Approved Your Event Booking</h2>
    
    <div style="text-align:center; margin-bottom:20px;">
        <p style="color:#666; font-size:16px; margin:0;">
           Reservation ID: <span style="color:#001f54; font-weight:bold;">' . ($eventData['event_bookingreceiptID'] ?? 'N/A') . '</span>
        </p>
    </div>
    
    <div style="text-align:center; padding:20px; background-color:#d4edda; border-radius:8px; margin-bottom:25px;">
        <h3 style="color:#155724; margin:0 0 10px 0; font-size:20px;">✓ Administrative Approval Received</h3>
        <p style="color:#155724; margin:0; line-height:1.6;">
            Great news! Your event booking has been approved by our administrative team.<br>
            <strong>Please wait for front desk confirmation to complete your reservation.</strong>
        </p>
    </div>

    <div style="background-color:#fff3cd; border-left:4px solid #F7B32B; padding:15px; border-radius:4px; margin-bottom:20px;">
        <p style="color:#856404; margin:0; font-size:14px; line-height:1.6;">
            <strong>⏳ Next Step:</strong> Your booking is currently pending front desk confirmation. 
            You will receive another email once the front desk team confirms your event reservation. 
            This typically takes 1-2 business days.
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

    <div style="background-color:#e7f3ff; border-left:4px solid #0066cc; padding:15px; border-radius:4px; margin-bottom:20px;">
        <p style="color:#004085; margin:0; font-size:14px; line-height:1.6;">
            <strong>📌 Important:</strong> Your reservation is not yet final. Please wait for the front desk confirmation email 
            before making any payments or final arrangements for your event.
        </p>
    </div>

    <div style="text-align:center; padding:20px 0;">
        <p style="color:#666; font-size:14px; margin:0 0 10px 0;">For inquiries or questions about your booking, please contact us:</p>
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

  } catch (MailException $e) {
    Log::error("Event approval email could not be sent: " . $e->getMessage());
    return false;
} catch (\Exception $e) {
    Log::error("System error while sending email: " . $e->getMessage());
    return false;
}
}




public function sendRejectionEmail($eventData){
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
        $mail->Subject = "Event Booking Declined - {$eventData['event_name']}";

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
<title>Event Rejection - Soliera Hotel</title>
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
        BOOKING DECLINED
    </div>
</div>

<div style="padding:30px 20px;">
    <h2 style="color:#001f54; margin:0 0 20px 0; font-size:24px; text-align:center;">Event Booking Could Not Be Approved</h2>
    
    <div style="text-align:center; margin-bottom:20px;">
        <p style="color:#666; font-size:16px; margin:0;">
           Reservation ID: <span style="color:#001f54; font-weight:bold;">' . ($eventData['event_bookingreceiptID'] ?? 'N/A') . '</span>
        </p>
    </div>
    
    <div style="text-align:center; padding:20px; background-color:#f8d7da; border-radius:8px; margin-bottom:25px;">
        <h3 style="color:#721c24; margin:0 0 10px 0; font-size:20px;">We are Sorry</h3>
        <p style="color:#721c24; margin:0; line-height:1.6;">
            Unfortunately, we are unable to accommodate your event booking at this time.<br>
            We apologize for any inconvenience this may cause.
        </p>
    </div>

    <div style="background-color:#f8f9fa; border-radius:8px; padding:20px; margin-bottom:20px;">
        <h3 style="color:#001f54; margin:0 0 15px 0; font-size:18px; border-bottom:2px solid #F7B32B; padding-bottom:10px;">Declined Event Details</h3>
        
        <table style="width:100%; border-collapse:collapse;">
            <tr>
                <td style="padding:10px 0; color:#666; font-size:14px; width:40%;">Event Name:</td>
                <td style="padding:10px 0; color:#001f54; font-weight:bold; font-size:14px;">' . htmlspecialchars($eventData['event_name']) . '</td>
            </tr>
            <tr>
                <td style="padding:10px 0; color:#666; font-size:14px;">Event Type:</td>
                <td style="padding:10px 0; color:#001f54; font-weight:bold; font-size:14px;">' . htmlspecialchars($eventtype) . '</td>
            </tr>
            <tr>
                <td style="padding:10px 0; color:#666; font-size:14px;">Requested Check-in:</td>
                <td style="padding:10px 0; color:#001f54; font-weight:bold; font-size:14px;">' . $checkinDate . '</td>
            </tr>
            <tr>
                <td style="padding:10px 0; color:#666; font-size:14px;">Requested Check-out:</td>
                <td style="padding:10px 0; color:#001f54; font-weight:bold; font-size:14px;">' . $checkoutDate . '</td>
            </tr>
            <tr>
                <td style="padding:10px 0; color:#666; font-size:14px;">Number of Guests:</td>
                <td style="padding:10px 0; color:#001f54; font-weight:bold; font-size:14px;">' . htmlspecialchars($eventData['event_numguest']) . ' Guests</td>
            </tr>
        </table>
    </div>

    <div style="background-color:#f8f9fa; border-radius:8px; padding:20px; margin-bottom:20px;">
        <h3 style="color:#001f54; margin:0 0 15px 0; font-size:18px; border-bottom:2px solid #F7B32B; padding-bottom:10px;">Organizer Information</h3>
        
        <table style="width:100%; border-collapse:collapse;">
            <tr>
                <td style="padding:10px 0; color:#666; font-size:14px; width:40%;">Organizer Name:</td>
                <td style="padding:10px 0; color:#001f54; font-weight:bold; font-size:14px;">' . htmlspecialchars($eventData['eventorganizer_name']) . '</td>
            </tr>
            <tr>
                <td style="padding:10px 0; color:#666; font-size:14px;">Email Address:</td>
                <td style="padding:10px 0; color:#001f54; font-weight:bold; font-size:14px;">' . htmlspecialchars($eventData['eventorganizer_email']) . '</td>
            </tr>
            <tr>
                <td style="padding:10px 0; color:#666; font-size:14px;">Contact Number:</td>
                <td style="padding:10px 0; color:#001f54; font-weight:bold; font-size:14px;">' . htmlspecialchars($eventData['eventorganizer_phone']) . '</td>
            </tr>
        </table>
    </div>

    <div style="background-color:#e7f3ff; border-left:4px solid #0066cc; padding:15px; border-radius:4px; margin-bottom:20px;">
        <p style="color:#004085; margin:0; font-size:14px; line-height:1.6;">
            <strong>Alternative Options:</strong> We would still love to host your event! 
            Please contact us to discuss alternative dates, venues, or event packages that may better suit your needs. 
            Our team is ready to help you find the perfect solution.
        </p>
    </div>

    <div style="background-color:#d1ecf1; border-left:4px solid #17a2b8; padding:15px; border-radius:4px; margin-bottom:20px;">
        <p style="color:#0c5460; margin:0; font-size:14px; line-height:1.6;">
            <strong>Refund Information:</strong> If you have already made any payment or deposit, 
            it will be fully refunded within 5-7 business days. You will receive a separate confirmation email once the refund has been processed.
        </p>
    </div>

    <div style="text-align:center; padding:20px 0;">
        <p style="color:#666; font-size:14px; margin:0 0 10px 0;">For more information or to discuss alternatives, please contact us:</p>
        <p style="color:#001f54; font-weight:bold; margin:0; font-size:14px;">' . htmlspecialchars(env('MAIL_FROM_ADDRESS')) . '</p>
    </div>
</div>

<div style="background-color:#001f54; padding:20px; text-align:center;">
    <p style="color:#F7B32B; margin:0 0 5px 0; font-size:14px; font-weight:bold;">We hope to serve you in the future!</p>
    <p style="color:#ffffff; margin:0; font-size:12px;">&copy; 2025 Soliera Hotel. All rights reserved.</p>
</div>
</div>
</body>
</html>';

        $mail->Body = $mailBody;
        $mail->send();
        
        return true;

    } catch (MailException $e) {
        Log::error("Event rejection email could not be sent: " . $e->getMessage());
        return false;
    } catch (\Exception $e) {
        Log::error("System error while sending email: " . $e->getMessage());
        return false;
    }
}


    // for admin

    
    public function rooms(Request $request){

      $token = $request->header('Authorization');

       
     if ($token !== 'Bearer ' . env('HOTEL_API_TOKEN')) {
        return response()->json([
            'success' => false,
            'message' => 'Unauthorized. Invalid API token.'
        ], 401);
    }

        try{
             $getroom = room::all();

             return response()->json([
                'success' => true,
                'message' => 'Rooms retrieve uccessfully',
                'data' => $getroom,
             ],200);
        }
        catch (\Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve rooms',
                'data' => $e->getMessage()
            ], 500);
        }
    }

    public function events(Request $request){


    $token = $request->header('Authorization');

       
     if ($token !== 'Bearer ' . env('HOTEL_API_TOKEN')) {
        return response()->json([
            'success' => false,
            'message' => 'Unauthorized. Invalid API token.'
        ], 401);
    }

    try{
        $getEvents = Ecm::join('core1_eventtype', 'core1_eventtype.eventtype_ID', '=', 'core1_ecm.eventtype_ID')
        ->join('core1_facility', 'core1_facility.facilityID', '=', 'core1_eventtype.facilityID')
        ->latest('core1_ecm.created_at')
        ->get();

        return response()->json([
            'success' => true,
            'message' => 'Events Successfully Retrieved',
            'data' => $getEvents,
        ], 200);
    }
    catch(\Exception $e){
        return response()->json([
            'success' => false,
            'message' => 'Failed to get events',
            'data' => $e->getMessage(),
        ], 500);
    }

    }


public function eventapproved(Request $request, $eventbookingID){
   $token = $request->header('Authorization');

     if ($token !== 'Bearer ' . env('HOTEL_API_TOKEN')) {
        return response()->json([
            'success' => false,
            'message' => 'Unauthorized. Invalid API token.'
        ], 401);
    }

    $geteventsbookings = Ecm::findOrFail($eventbookingID);

    if(!$geteventsbookings){
        return response()->json([
            'success' => false,
            'message' => 'Request not found'
        ], 400);
    }

    $geteventsbookings->eventstatus = 'Approved';
    $geteventsbookings->save();

     ecmtype::where('eventtype_ID', $geteventsbookings->eventtype_ID)
    ->update([
        'eventtype_status' => 'Inactive'
    ]);

    $geteventypefacilityID = ecmtype::where('eventtype_ID', $geteventsbookings->eventtype_ID)
    ->value('facilityID');

    facility::where('facilityID', $geteventypefacilityID)->update([
        'facility_status' => 'Unavailable'
    ]);



    // Prepare event data for email
    $eventData = [
        'event_name' => $geteventsbookings->event_name,
        'eventtype_ID' => $geteventsbookings->eventtype_ID,
        'event_checkin' => $geteventsbookings->event_checkin,
        'event_checkout' => $geteventsbookings->event_checkout,
        'event_numguest' => $geteventsbookings->event_numguest,
        'event_total_price' => $geteventsbookings->event_total_price,
        'event_bookingreceiptID' => $geteventsbookings->event_bookingreceiptID,
        'event_equipment' => $geteventsbookings->event_equipment,
        'eventorganizer_name' => $geteventsbookings->eventorganizer_name,
        'eventorganizer_email' => $geteventsbookings->eventorganizer_email,
        'eventorganizer_phone' => $geteventsbookings->eventorganizer_phone,
    ];

    // Send approval email
    $this->sendApprovalEmail($eventData);

    return response()->json([
        'success' => true,
        'message' => 'Event Approved and notification sent'
    ], 200);
}

public function rejectevent(Request $request, $eventbookingID){
    $token = $request->header('Authorization');

    if ($token !== 'Bearer ' . env('HOTEL_API_TOKEN')) {
        return response()->json([
            'success' => false,
            'message' => 'Unauthorized. Invalid API token.'
        ], 401);
    }

    $geteventsbookings = Ecm::findOrFail($eventbookingID);

    if(!$geteventsbookings){
        return response()->json([
            'success' => false,
            'message' => 'Request not found'
        ], 400);
    }

    $geteventsbookings->eventstatus = 'Rejected';
    $geteventsbookings->save();

        ecmtype::where('eventtype_ID', $geteventsbookings->eventtype_ID)
    ->update([
        'eventtype_status' => 'Active'
    ]);

    $geteventypefacilityID = ecmtype::where('eventtype_ID', $geteventsbookings->eventtype_ID)
    ->value('facilityID');

    facility::where('facilityID', $geteventypefacilityID)->update([
        'facility_status' => 'Available'
    ]);


    // Prepare event data for email
    $eventData = [
        'event_name' => $geteventsbookings->event_name,
        'eventtype_ID' => $geteventsbookings->eventtype_ID,
        'event_checkin' => $geteventsbookings->event_checkin,
        'event_checkout' => $geteventsbookings->event_checkout,
        'event_numguest' => $geteventsbookings->event_numguest,
        'event_total_price' => $geteventsbookings->event_total_price,
        'event_bookingreceiptID' => $geteventsbookings->event_bookingreceiptID,
        'event_equipment' => $geteventsbookings->event_equipment,
        'eventorganizer_name' => $geteventsbookings->eventorganizer_name,
        'eventorganizer_email' => $geteventsbookings->eventorganizer_email,
        'eventorganizer_phone' => $geteventsbookings->eventorganizer_phone,
    ];

    // Send rejection email
    $this->sendRejectionEmail($eventData);

    return response()->json([
        'success' => true,
        'message' => 'Event Rejected and notification sent'
    ], 200);
}

    public function hotelaccounts(Request $request){
    $token = $request->header('Authorization');

       
     if ($token !== 'Bearer ' . env('HOTEL_API_TOKEN')) {
        return response()->json([
            'success' => false,
            'message' => 'Unauthorized. Invalid API token.'
        ], 401);
    }

        try{
            $hotelaccounts = DeptAccount::select(
            'Dept_no', 'Dept_id', 
            'dept_name', 'employee_name', 'employee_id',
            'role', 'email', 'status',
            )->get();

            return response([
                'success' => true,
                'message' => 'Data Retrieved Successfully',
                'data' => $hotelaccounts,
            ], 200);
        }
        catch(\Exception $e){
            return response([
                'success' => false,
                'message' => 'Failed to retrieve data',
                'data' => $e->getMessage(),
            ], 500);
        }
    }

    public function hoteldeptLogs(Request $request){
        $token = $request->header('Authorization');

       
     if ($token !== 'Bearer ' . env('HOTEL_API_TOKEN')) {
        return response()->json([
            'success' => false,
            'message' => 'Unauthorized. Invalid API token.'
        ], 401);
    }

    try{
        $departmentloghotel = DeptLogs::all();

        return response()->json([
            'success' => true,
            'message' => 'Department Logs Successfully Retrieved',
            'data' => $departmentloghotel,
        ], 200);
    }
    catch(\Exception $e){
        return response()->json([
            'success' => false,
            'message' => 'Department Logs Failed to Fetch',
            'data' => $e->getMessage(),
        ], 500);
    }
    }

    public function hotelaudit(Request $request){
         $token = $request->header('Authorization');

       
     if ($token !== 'Bearer ' . env('HOTEL_API_TOKEN')) {
        return response()->json([
            'success' => false,
            'message' => 'Unauthorized. Invalid API token.'
        ], 401);
    }

    try{
        $gethotelaudit = AuditTrails::all();

        return response()->json([
            'success' => true,
            'message' => 'Successfully Fetched Hotel Audit Trails And Transactions',
            'data' => $gethotelaudit,
        ], 200);
    }
    catch(\Exception $e){
        return response()->json([
            'success' => false,
            'message' => 'Failed to Fetch Hotel Audit Trails And Transactions',
            'data' => $e->getMessage(),
        ], 500);
    }
    }


    // for financials 


public function hotelincome(Request $request)
{
    $token = $request->header('Authorization');

    if ($token !== 'Bearer ' . env('HOTEL_API_TOKEN')) {
        return response()->json([
            'success' => false,
            'message' => 'Unauthorized. Invalid API token.'
        ], 401);
    }

    try {
        $reservations = hotelBilling::all();


        return response()->json([
            'success' => true,
            'message' => 'Hotel Income Successfully Retrieved',
            'data'    => $reservations,
        ], 200);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Failed to retrieve data',
            'error'   => $e->getMessage(),
        ], 500);
    }
}

// for logistics 
    public function stockrequest(Request $request){
    $token = $request->header('Authorization');

        if ($token !== 'Bearer ' . env('HOTEL_API_TOKEN')) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Invalid API token.'
            ], 401);
        }


        try{
            $stockrequest = stockRequest::all();

            return response()->json([
                'success' => true,
                'message' => 'Data Successfully Retrived',
                'data' => $stockrequest,
            ], 200);
        }
        catch(\Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'Failed to Retrieve Data',
                'data' => $e->getMessage(),
            ], 500);
        }
    }

    public function approvedStockRequest(Request $request, stockRequest $core1_stockID){
        $token = $request->header('Authorization');

        if ($token !== 'Bearer ' . env('HOTEL_API_TOKEN')) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Invalid API token.'
            ], 401);
        }

        $core1_stockID->update([
            'core1_request_status' => 'Approved',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Status Approved'
        ]);
    }


     public function deliveredStockRequest(Request $request, stockRequest $core1_stockID){
        $token = $request->header('Authorization');

        if ($token !== 'Bearer ' . env('HOTEL_API_TOKEN')) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Invalid API token.'
            ], 401);
        }

        $core1_stockID->update([
            'core1_request_status' => 'Delivered',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Status Delivered'
        ]);
    }


    

    // integration wtih restaurant

    public function fetchrestobillingandpayments(Request $request){
         $token = $request->header('Authorization');

        if ($token !== 'Bearer ' . env('HOTEL_API_TOKEN')) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Invalid API token.'
            ], 401);
        }

        try{
            $billingandpaymentsresto = restobillingandpayments::all();

            return response()->json([
                'success' => true,
                'message' => 'Data Successfully Fetched',
                'data' => $billingandpaymentsresto,
            ], 200);
        }
        catch(\Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'Cant fetch data',
                'data' => $e->getMessage(),
            ], 500);
        }
    }

    
    public function fetchKOT(Request $request){
        $token = $request->header('Authorization');

        if ($token !== 'Bearer ' . env('HOTEL_API_TOKEN')) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Invalid API token.'
            ], 401);
        }

        try {
            $fetchKot = kotresto::join('orderfromresto', 'orderfromresto.orderID', '=', 'kot_orders.order_id')
            ->latest('kot_orders.created_at')
            ->get();

            return response()->json([
                'success' => true,
                'message' => 'Success',
                'data' => $fetchKot,
            ], 200);
        }

        catch(\Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'Failed',
                'data' => $e->getMessage(),
            ], 401);
        }
    }

    public function cookKOT(Request $request, $order_id){
        $token = $request->header('Authorization');

        if ($token !== 'Bearer ' . env('HOTEL_API_TOKEN')) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Invalid API token.'
            ], 401);
        }

        kotresto::where('order_id', $order_id)->update([
            'status' => 'cook',
        ]);

      ordersfromresto::where('orderID', $order_id)->update([
    'order_status' => 'Cooking',
        ]);

   return response()->json([
    'success' => true,
    'order_id' => $order_id,
    'status' => 'Cooking',
    'message' => "Order {$order_id} is now cooking"
]);

    }


    public function preparingKOT(Request $request, $order_id){

     $token = $request->header('Authorization');

        if ($token !== 'Bearer ' . env('HOTEL_API_TOKEN')) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Invalid API token.'
            ], 401);
        }

        kotresto::where('order_id', $order_id)->update([
            'status' => 'Preparing',
        ]);

      ordersfromresto::where('orderID', $order_id)->update([
    'order_status' => 'Preparing',
        ]);

   return response()->json([
    'success' => true,
    'order_id' => $order_id,
    'status' => 'Preparing',
    'message' => "Order {$order_id} is now preparing"
]);
}

public function readytoserve(Request $request, $order_id){

 $token = $request->header('Authorization');

        if ($token !== 'Bearer ' . env('HOTEL_API_TOKEN')) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Invalid API token.'
            ], 401);
        }

        kotresto::where('order_id', $order_id)->update([
            'status' => 'Ready to Serve',
        ]);

      ordersfromresto::where('orderID', $order_id)->update([
    'order_status' => 'Ready to Serve',
        ]);

   return response()->json([
    'success' => true,
    'order_id' => $order_id,
    'status' => 'Ready To Serve',
    'message' => "Order {$order_id} is now Ready To Serve"
]);

}

public function completedKOT(Request $request, $order_id){
    
 $token = $request->header('Authorization');

        if ($token !== 'Bearer ' . env('HOTEL_API_TOKEN')) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Invalid API token.'
            ], 401);
        }

        kotresto::where('order_id', $order_id)->update([
            'status' => 'Completed',
        ]);

      ordersfromresto::where('orderID', $order_id)->update([
    'order_status' => 'Completed',
        ]);

   return response()->json([
    'success' => true,
    'order_id' => $order_id,
    'status' => 'Completed',
    'message' => "Order {$order_id} is now Completed"
]);
    
}


public function voidedKOT(Request $request, $order_id){
    $token = $request->header('Authorization');

        if ($token !== 'Bearer ' . env('HOTEL_API_TOKEN')) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Invalid API token.'
            ], 401);
        }

        kotresto::where('order_id', $order_id)->update([
            'status' => 'Voided',
        ]);

      ordersfromresto::where('orderID', $order_id)->update([
    'order_status' => 'Voided',
        ]);

   return response()->json([
    'success' => true,
    'order_id' => $order_id,
    'status' => 'Voided',
    'message' => "Order {$order_id} is now Voided"
]);

}

    // facilities
    public function facility(Request $request){
          $token = $request->header('Authorization');

        if ($token !== 'Bearer ' . env('HOTEL_API_TOKEN')) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Invalid API token.'
            ], 401);
        }

        try {
            $facilities = facility::all();

            return response()->json([
                'success' => true,
                'message' => 'Facilities fetched Successfully',
                'data' => $facilities,
            ], 200);

        }
        catch (\Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'Cant fetch data',
                'data' => $e->getMessage(),
            ], 401);
        }

        
    }

    // door lock 

public function scanRfid(Request $request)
{
    try {
        // Check API token
        $token = $request->header('Authorization');
        if ($token !== 'Bearer ' . env('HOTEL_API_TOKEN')) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Invalid API token.'
            ], 401);
        }

        // Validate input
        $request->validate([
            'rfid' => 'required|string',
        ]);

        $rfid = $request->rfid;

        // FIRST: Check if this is a Master RFID
        $masterRFID = masterRFID::where('masterRFID_rfid', $rfid)->first();

        if ($masterRFID) {
            // Master RFID found - check if active
            if ($masterRFID->masterRFID_status !== 'Active') {
                // Inactive master RFID - deny access
                rfidHistory::create([
                    'rfid_used' => $rfid,
                    'access_type' => $masterRFID->masterRFID_name,
                    'access_result' => 'denied',
                    'denial_reason' => 'Master RFID is inactive',
                    'door_state' => 'Access Denied',
                    'doorlockID' => $masterRFID->doorlockID // Use master's assigned doorlock
                ]);

                return response()->json([
                    'success' => false,
                    'is_master' => true,
                    'message' => 'Master RFID is inactive.',
                    'master_name' => $masterRFID->masterRFID_name,
                    'status' => 0
                ], 403);
            }

            // Check if master has an assigned doorlock
            if ($masterRFID->doorlockID) {
                // Find the assigned doorlock
                $doorlock = doorlock::find($masterRFID->doorlockID);
                
                if (!$doorlock) {
                    return response()->json([
                        'success' => false,
                        'is_master' => true,
                        'message' => 'Assigned doorlock not found.',
                        'master_name' => $masterRFID->masterRFID_name
                    ], 404);
                }

                // Find or create frontdesk record for this door
                $doorlockFrontdesk = doorlockFrontdesk::firstOrCreate(
                    ['doorlockID' => $doorlock->doorlockID],
                    [
                        'guestname' => 'Master Access',
                        'doorlockfrontdesk_status' => 0
                    ]
                );

                // Toggle the door status
                $doorlockFrontdesk->doorlockfrontdesk_status =
                    $doorlockFrontdesk->doorlockfrontdesk_status ? 0 : 1;
                $doorlockFrontdesk->save();

                $doorStateText = $doorlockFrontdesk->doorlockfrontdesk_status
                    ? 'Unlocked'
                    : 'Locked';

                // Log the master toggle action
                rfidHistory::create([
                    'doorlockID' => $doorlock->doorlockID,
                    'rfid_used' => $rfid,
                    'access_type' => $masterRFID->masterRFID_name,
                    'access_result' => 'granted',
                    'door_state' => $doorStateText . ' (Master Access)',
                    'denial_reason' => null
                ]);

                return response()->json([
                    'success' => true,
                    'is_master' => true,
                    'message' => 'Master RFID toggled assigned door successfully.',
                    'master_name' => $masterRFID->masterRFID_name,
                    'master_id' => $masterRFID->masterRFID_ID,
                    'status' => $doorlockFrontdesk->doorlockfrontdesk_status,
                    'door_state' => $doorStateText,
                    'doorlock_id' => $doorlock->doorlockID,
                    'room_id' => $doorlock->roomID
                ]);
            }

            // Master has no assigned doorlock - bypass mode
            rfidHistory::create([
                'rfid_used' => $rfid,
                'access_type' => $masterRFID->masterRFID_name,
                'access_result' => 'granted',
                'door_state' => 'Unlocked (Master Bypass)',
                'doorlockID' => null,
                'denial_reason' => null
            ]);

            return response()->json([
                'success' => true,
                'is_master' => true,
                'action' => 'bypass',
                'message' => 'Master RFID detected. Master bypass access granted.',
                'master_name' => $masterRFID->masterRFID_name,
                'master_id' => $masterRFID->masterRFID_ID,
                'status' => 1,
                'door_state' => 'Unlocked (Master Bypass)'
            ]);
        }

        // If not a Master RFID, check regular doorlock (guest access)
        $doorlock = doorlock::where('rfid', $rfid)->first();
        
        if (!$doorlock) {
            // RFID not found in system
            rfidHistory::create([
                'rfid_used' => $rfid,
                'access_type' => 'guest',
                'access_result' => 'denied',
                'denial_reason' => 'RFID not found in system',
                'door_state' => 'Access Denied',
                'doorlockID' => null
            ]);

            return response()->json([
                'success' => false,
                'message' => 'RFID not found.'
            ], 404);
        }

        // Check if doorlock is active
        if ($doorlock->doorlock_status !== 'Active') {
            rfidHistory::create([
                'doorlockID' => $doorlock->doorlockID,
                'rfid_used' => $rfid,
                'access_type' => 'guest',
                'access_result' => 'denied',
                'denial_reason' => 'Doorlock is inactive',
                'door_state' => 'Access Denied'
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Doorlock is inactive.',
                'status' => 0
            ], 403);
        }

        // Find corresponding doorlockFrontdesk record
        $doorlockFrontdesk = doorlockFrontdesk::where('doorlockID', $doorlock->doorlockID)->first();
        
        if (!$doorlockFrontdesk) {
            rfidHistory::create([
                'doorlockID' => $doorlock->doorlockID,
                'rfid_used' => $rfid,
                'access_type' => 'guest',
                'access_result' => 'denied',
                'denial_reason' => 'No frontdesk record found',
                'door_state' => 'Access Denied'
            ]);

            return response()->json([
                'success' => false,
                'message' => 'No frontdesk record found for this doorlock.'
            ], 404);
        }

        // Check if the guest RFID matches the assigned guest
        if ($doorlockFrontdesk->rfid && $doorlockFrontdesk->rfid !== $rfid) {
            rfidHistory::create([
                'doorlockID' => $doorlock->doorlockID,
                'rfid_used' => $rfid,
                'access_type' => 'guest',
                'access_result' => 'denied',
                'denial_reason' => 'RFID does not match assigned guest',
                'door_state' => 'Access Denied'
            ]);

            return response()->json([
                'success' => false,
                'message' => 'RFID does not match assigned guest.'
            ], 403);
        }

        // Toggle status: if 1 → 0, if 0 → 1
        $doorlockFrontdesk->doorlockfrontdesk_status =
            $doorlockFrontdesk->doorlockfrontdesk_status ? 0 : 1;

        $doorlockFrontdesk->save();

        $doorStateText = $doorlockFrontdesk->doorlockfrontdesk_status
            ? 'Unlocked'
            : 'Locked';

        // Save successful guest access to history
        rfidHistory::create([
            'doorlockID' => $doorlock->doorlockID,
            'rfid_used' => $rfid,
            'access_type' => 'guest',
            'access_result' => 'granted',
            'door_state' => $doorStateText,
            'denial_reason' => null
        ]);

        return response()->json([
            'success' => true,
            'is_master' => false,
            'message' => 'Doorlock frontdesk status toggled successfully.',
            'status' => $doorlockFrontdesk->doorlockfrontdesk_status,
            'door_state' => $doorStateText,
            'doorlock_id' => $doorlock->doorlockID,
            'room_id' => $doorlock->roomID,
            'data' => $doorlockFrontdesk
        ]);

    } catch (\Exception $e) {
        Log::error('Scan RFID error: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'Internal server error'
        ], 500);
    }
}
    public function checkDoorlockStatus($doorlockID)
{
    $doorlockFrontdesk = doorlockFrontdesk::where('doorlockID', $doorlockID)->first();

    if (!$doorlockFrontdesk) {
        return response()->json(['success' => false, 'message' => 'Doorlock not found'], 404);
    }

    return response()->json([
        'success' => true,
        'status' => $doorlockFrontdesk->doorlockfrontdesk_status
    ]);
}


// Core Human Integration

    public function requestEmployee(Request $request){
      $token = $request->header('Authorization');

        if ($token !== 'Bearer ' . env('HOTEL_API_TOKEN')) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Invalid API token.'
            ], 401);
        }

        try{
            $requestEmployee = requestEmployee::all();

            return response()->json([
                'success' => true,
                'message' => 'Data Fetched Succesfully',
                'data' =>  $requestEmployee,
            ],200);
        }
        catch(\Exception $e){
             return response()->json([
                'success' => false,
                'message' => 'Cant fetch data',
                'data' => $e->getMessage(),
            ], 401);
        }
    }


    public function approveEmployeeRequest(Request $request, $requestempID){
         $token = $request->header('Authorization');

        if ($token !== 'Bearer ' . env('HOTEL_API_TOKEN')) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Invalid API token.'
            ], 401);
        }


    $requestEmployee = requestEmployee::find($requestempID);
    if (!$requestEmployee) {
        return response()->json([
            'success' => false,
            'message' => 'Request not found.'
        ], 404);
    }
    $requestEmployee->status = 'Approved';
    $requestEmployee->save();

    return response()->json([
        'success' => true,
        'message' => 'Request approved successfully.',
        'data' => $requestEmployee
    ], 200);
       

    }


     public function rejectEmployeeRequest(Request $request, $requestempID){
         $token = $request->header('Authorization');

        if ($token !== 'Bearer ' . env('HOTEL_API_TOKEN')) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Invalid API token.'
            ], 401);
        }


    $requestEmployee = requestEmployee::find($requestempID);
    if (!$requestEmployee) {
        return response()->json([
            'success' => false,
            'message' => 'Request not found.'
        ], 404);
    }
    $requestEmployee->status = 'Rejected';
    $requestEmployee->save();

    return response()->json([
        'success' => true,
        'message' => 'Request approved successfully.',
        'data' => $requestEmployee
    ], 200);
       

    }




     public function reportEmployee(Request $request){
      $token = $request->header('Authorization');

        if ($token !== 'Bearer ' . env('HOTEL_API_TOKEN')) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Invalid API token.'
            ], 401);
        }

        try{
            $reportEmployee = EmployeeReport::all();

            return response()->json([
                'success' => true,
                'message' => 'Data Fetched Succesfully',
                'data' =>  $reportEmployee,
            ],200);
        }
        catch(\Exception $e){
             return response()->json([
                'success' => false,
                'message' => 'Cant fetch data',
                'data' => $e->getMessage(),
            ], 401);
        }
    }


    public function resolvedEmployee(Request $request, $reportID){
         $token = $request->header('Authorization');

        if ($token !== 'Bearer ' . env('HOTEL_API_TOKEN')) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Invalid API token.'
            ], 401);
        }

        $resolveemployee = EmployeeReport::findOrFail($reportID);

        if(!$resolveemployee){
            return response()->json([
                'success' => false,
                'message' => 'Request Not Found',
            ], 400);
        }

        $resolveemployee->status = 'Resolved';
        $resolveemployee->save();

        return response()->json([

            'success' => true,
            'message' => 'Status Has been set to Resolved',
            'data' => $resolveemployee,
        ], 200);
    }


    public function bookedRooms(Request $request){
            $token = $request->header('Authorization');

        if ($token !== 'Bearer ' . env('HOTEL_API_TOKEN')) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Invalid API token.'
            ], 401);
        }


        try{
            $bookedrooms = Reservation::join('core1_room', 'core1_room.roomID', '=', 'core1_reservation.roomID')
            ->where('core1_reservation.reservation_bookingstatus', 'Checked in')
            ->latest('core1_reservation.created_at')
            ->get();

            return response()->json([
                'success' => true,
                'message' => 'Booked Reservation Successfully Fetched',
                'data' => $bookedrooms,
            ], 200);
        }
        catch(\Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch data',
                'data' => $e->getMessage(),
            ], 400);
        }
    }


    public function guestaccounts(Request $request){
           $token = $request->header('Authorization');

        if ($token !== 'Bearer ' . env('HOTEL_API_TOKEN')) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Invalid API token.'
            ], 401);
        }

        try{
            $guestaccount = Guest::all();

            return response()->json([
                'success' => true,
                'message' => 'Accounts Fetched',
                'data' => $guestaccount,
            ], 200);
        }
        catch(\Exception $e){
             return response()->json([
                'success' => false,
                'message' => 'Failed To Fetch Accounts',
                'data' => $e->getMessage(),
            ], 400);
        }
    }


    // for offline and online sync
     public function receiveData(Request $request)
    {
        $request->validate([
            'model_name' => 'required|string',
            'action'     => 'required|in:insert,update,delete',
            'payload'    => 'required|array',
        ]);

        $token = $request->header('Authorization');

        if ($token !== 'Bearer ' . env('HOTEL_API_TOKEN')) {
            Log::error('Unauthorized sync attempt', ['token' => $token]);
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Invalid API token.'
            ], 401);
        }

        $modelName = $request->model_name;
        $action    = $request->action;
        $payload   = $request->payload;

        // Full model path - try different case variations
        $fullModel = "App\\Models\\$modelName";
        
        // Try exact match first
        if (!class_exists($fullModel)) {
            // Try lowercase first letter
            $lowerModel = "App\\Models\\" . lcfirst($modelName);
            if (class_exists($lowerModel)) {
                $fullModel = $lowerModel;
            } else {
                // Try all lowercase
                $allLowerModel = "App\\Models\\" . strtolower($modelName);
                if (class_exists($allLowerModel)) {
                    $fullModel = $allLowerModel;
                } else {
                    Log::error("Model not found during sync", [
                        'model' => $modelName,
                        'tried' => [$fullModel, $lowerModel, $allLowerModel]
                    ]);
                    return response()->json([
                        'status'  => 'error',
                        'message' => "Model $modelName not found on domain. Tried: " . implode(', ', [$fullModel, $lowerModel, $allLowerModel])
                    ], 400);
                }
            }
        }

        $modelInstance = new $fullModel;
        $table = $modelInstance->getTable();
        $primaryKey = $modelInstance->getKeyName();

        try {
            \Illuminate\Support\Facades\DB::beginTransaction();
            
            switch ($action) {
                case 'insert':
                    // Remove primary key if present to avoid conflicts
                    $insertData = $payload;
                    if (isset($insertData[$primaryKey]) && empty($insertData[$primaryKey])) {
                        unset($insertData[$primaryKey]);
                    }
                    \Illuminate\Support\Facades\DB::table($table)->insert($insertData);
                    Log::info("Data inserted successfully", ['table' => $table, 'data' => $insertData]);
                    break;

                case 'update':
                    if (!isset($payload[$primaryKey])) {
                        throw new \Exception("Primary key $primaryKey not found in payload for update");
                    }
                    \Illuminate\Support\Facades\DB::table($table)
                        ->where($primaryKey, $payload[$primaryKey])
                        ->update($payload);
                    Log::info("Data updated successfully", ['table' => $table, 'id' => $payload[$primaryKey], 'data' => $payload]);
                    break;

                case 'delete':
                    if (!isset($payload[$primaryKey])) {
                        throw new \Exception("Primary key $primaryKey not found in payload for delete");
                    }
                    \Illuminate\Support\Facades\DB::table($table)
                        ->where($primaryKey, $payload[$primaryKey])
                        ->delete();
                    Log::info("Data deleted successfully", ['table' => $table, 'id' => $payload[$primaryKey]]);
                    break;
            }
            
            \Illuminate\Support\Facades\DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => "Sync operation {$action} completed successfully"
            ]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\DB::rollBack();
            Log::error("Sync operation failed", [
                'action' => $action,
                'model' => $modelName,
                'table' => $table,
                'payload' => $payload,
                'error' => $e->getMessage()
            ]);
            return response()->json([
                'status'  => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }


    // for dummy 

    public function gethabistaydata(Request $request){
        $token = $request->header('Authorization');

        if ($token !== 'Bearer ' . env('HOTEL_API_TOKEN')) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Invalid API token.'
            ], 401);
        }

        
        try {
            $data = Channel::join('core1_room', 'core1_room.roomID', '=', 'channel_table.roomID')
            ->latest('channel_table.created_at')
            ->get();
        }
        catch(\Exception $e){
            return response()->json([
                'success' => true,
                'message' => 'Data Fetched',
                'data' => $data,
            ], 200);
        }


    }
 
}
