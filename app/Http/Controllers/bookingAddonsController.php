<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\additionalBooking;
use App\Models\AuditTrails;
use App\Models\Guest;
use Carbon\Carbon;
use App\Models\hotelBilling;
use App\Models\Inventory;
use App\Models\Reservation;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;



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


public function printReceipt($additionalbookingID)
{
    // Fetch additional booking + inventory (JOIN)
    $additionalBooking = additionalBooking::leftJoin(
            'core1_inventory',
            'additional_booking.core1_inventoryID',
            '=',
            'core1_inventory.core1_inventoryID'
        )
        ->where('additional_booking.additionalbookingID', $additionalbookingID)
        ->select(
            'additional_booking.*',
            'core1_inventory.core1_inventory_name',
            'core1_inventory.core1_inventory_code',
            'core1_inventory.core1_inventory_category',
            'core1_inventory.core1_inventory_subcategory',
            'core1_inventory.core1_inventory_unit',
            'core1_inventory.core1_inventory_location',
            'core1_inventory.core1_inventory_shelf',
            'core1_inventory.core1_inventory_cost',
            'core1_inventory.core1_inventory_image',
            'core1_inventory.core1_inventory_description'
        )
        ->firstOrFail();

    // Reservation
    $reservation = Reservation::where(
        'reservationID',
        $additionalBooking->reservationID
    )->firstOrFail();

    // Guest


    // Computed values
    $bookedDate    = date('M d, Y', strtotime($additionalBooking->created_at));
    $paymentstatus = 'Paid';
    $totalAmount   = $additionalBooking->additional_total;

    // Render PDF view
    $html = view('admin.components.invoices.inventory-receipt-pdf', [
        'additionalBooking' => $additionalBooking,
        'reservation'       => $reservation,
        'bookedDate'        => $bookedDate,
        'paymentstatus'     => $paymentstatus,
        'totalAmount'       => $totalAmount,
    ])->render();

    // PDF path
    $pdfPath = public_path(
        "images/invoices/inventory_receipt_{$additionalbookingID}.pdf"
    );

    if (!file_exists(dirname($pdfPath))) {
        mkdir(dirname($pdfPath), 0755, true);
    }

    Pdf::loadHTML($html)
        ->setPaper('A4')
        ->save($pdfPath);

    // ====================================================================
    // ✅ SEND TO BILLING & INVOICING API
    // ====================================================================
    try {
        $this->sendInventoryToBillingAPI($additionalBooking, $reservation, $pdfPath, $totalAmount);
    } catch (Exception $e) {
        Log::error("Failed to send inventory receipt to Billing API: {$e->getMessage()}");
        // Continue execution even if API call fails
    }

    // Audit Trail
    if (Auth::check()) {
        $user = Auth::user();
        AuditTrails::create([
            'dept_id'       => $user->Dept_id,
            'dept_name'     => $user->dept_name,
            'modules_cover' => 'Reservation Management',
            'action'        => 'Generate Inventory Receipt',
            'activity'      => 'Inventory Receipt #' . $additionalbookingID,
            'employee_name' => $user->employee_name,
            'employee_id'   => $user->employee_id,
            'role'          => $user->role,
            'date'          => now(),
        ]);
    }

    return redirect(
        asset("images/invoices/inventory_receipt_{$additionalbookingID}.pdf")
    );
}

/**
 * Send inventory receipt data to Billing & Invoicing API
 */
private function sendInventoryToBillingAPI($additionalBooking, $reservation, $pdfPath, $totalAmount)
{
    // API Configuration
    $apiUrl = env('BILLING_API_URL', 'https://financials.soliera-hotel-restaurant.com/api/receivable-billing-invoicing');
    $apiToken = env('BILLING_API_TOKEN', 'uX8B1QqYJt7XqTf0sM3tKAh5nCjEjR1Xlqk4F8ZdD1mHq5V9y7oUj1QhUzPg5s');

    // ✅ Always set as PAID with full amount since receipt generation means payment is complete
    $apiPayStatus = 'PAID';
    $amountPaid = $totalAmount;

    // Build item description for remarks
    $itemDescription = $additionalBooking->core1_inventory_name 
        ? "{$additionalBooking->core1_inventory_name} (Code: {$additionalBooking->core1_inventory_code})"
        : "Additional Item";
    
    $quantity = $additionalBooking->additional_quantity ?? 1;
    $itemDetails = "Qty: {$quantity} - Category: {$additionalBooking->core1_inventory_category}";

    // Prepare JSON payload for inventory/additional booking
    $payload = [
        'ref'            => $additionalBooking->additional_receiptID ?? "INV-ADD-{$additionalBooking->additionalbookingID}",
        'tid'            => "ADD-{$additionalBooking->additionalbookingID}",
        'guest_id'       => $guest->guestID ?? "GUEST-{$reservation->guestID}",
        'guest_name'     => $guest->guestname ?? $reservation->guestname ?? 'Guest',
        'payment_date'   => $additionalBooking->created_at ? Carbon::parse($additionalBooking->created_at)->format('Y-m-d') : Carbon::now()->format('Y-m-d'),
        'amount_paid'    => (float) $amountPaid,
        'total_due'      => (float) $totalAmount,
        'payment_method' => strtoupper($additionalBooking->additional_paymentmethod ?? $reservation->payment_method ?? 'CASH'),
        'pay_status'     => $apiPayStatus,
        'status'         => 'PENDING',
        'remarks'        => "Additional/Inventory Booking - {$itemDescription} - {$itemDetails} - Reservation: {$reservation->bookingID}",
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
    Log::info("Billing API Response - Inventory Receipt", [
        'status_code' => $statusCode,
        'response' => $responseData,
        'additional_booking_id' => $additionalBooking->additionalbookingID,
        'reservation_id' => $reservation->reservationID,
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
}   
