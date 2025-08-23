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


    public function confirm(Reservation $reservationID){
        $reservationID->update([
            'reservation_bookingstatus' => 'Confirmed'
        ]);

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

         room::where('roomID', $roomID)->update([
            'roomstatus' => 'Available',
        ]);

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

         session()->flash('cancel', 'Reservation Has Been Cancelled');

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

    // Render Blade template
    $html = view('admin.components.invoices.invoices-pdf', [
        'booking'  => $booking,
        'logoPath' => $logoPath
    ])->render();

    // PDF save path
    $pdfPath = public_path("images/invoices/invoice_{$booking->reservationID}.pdf");

    // Ensure directory exists
    if (!file_exists(dirname($pdfPath))) {
        mkdir(dirname($pdfPath), 0755, true);
    }

    // Generate PDF
    Browsershot::html($html)
        ->showBackground()
        ->format('A4')
        ->margins(10, 10, 10, 10)
        ->waitUntilNetworkIdle()
        ->timeout(120)
        ->save($pdfPath);

    // Return PDF URL
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

     session()->flash('success', ' Booking ID: ' . $bookingID);

    return redirect()->back();
}



}
