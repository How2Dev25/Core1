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


class reservationController extends Controller
{


  protected $gemini;

    public function __construct(GeminiService $gemini)
    {
        $this->gemini = $gemini;
    }

   public function extractJsonFromText($text)
{
    $start = strpos($text, '{');
    $end = strrpos($text, '}');

    if ($start === false || $end === false || $end <= $start) {
        return null;
    }

    $json = substr($text, $start, $end - $start + 1);

    // If JSON is double-encoded (stringified), decode it first
    if (is_string($json) && str_starts_with(trim($json), '"{')) {
        $decoded = json_decode($json, true);
        if (is_array($decoded)) {
            return json_encode($decoded); // make it usable in decode()
        }
    }

    return $json;
}

public function searchRooms(Request $request)
{
    $prompt = $request->input('prompt');

    // Step 1: Get AI response
    $aiRaw = $this->gemini->interpretPrompt($prompt);
    Log::debug('🧠 Gemini raw output:', ['raw' => $aiRaw]);

    // Step 2: Extract JSON
    $json = $this->extractJsonFromText($aiRaw);
    Log::debug('🧠 Extracted JSON:', ['json' => $json]);

    if (!$json) {
        return response()->json([
            'message' => 'AI failed to understand your request.',
            'ai_response' => $aiRaw
        ], 400);
    }

    // Step 3: Parse JSON
    $parsed = json_decode($json, true);
    Log::debug('✅ Parsed AI JSON:', ['parsed' => $parsed]);

    if (!$parsed) {
        return response()->json([
            'message' => 'Invalid AI response format.',
            'ai_response' => $json
        ], 400);
    }

    // Step 4: Extract fields
    $roomtype = $parsed['roomtype'] ?? null;
    $roommaxguest = $parsed['roommaxguest'] ?? 1;
    $features = $parsed['roomfeatures'] ?? [];
    $checkin = isset($parsed['checkin_date']) ? Carbon::parse($parsed['checkin_date']) : now();
    $checkout = isset($parsed['checkout_date']) ? Carbon::parse($parsed['checkout_date']) : $checkin->copy()->addDays($parsed['reservation_days'] ?? 1);
    $specialRequest = $parsed['special_request'] ?? '';

    // Step 5: Search rooms
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

            $hasConflict = reservation::where('roomID', $room->roomID)
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

    // Step 6: If one match found, redirect to booking form
    if ($rooms->count() === 1) {
        return view('admin.components.bas.aiform', [
            'room' => $rooms->first(),
            'checkin' => $checkin->toDateString(),
            'checkout' => $checkout->toDateString(),
            'criteria' => $parsed,
            'prefilledRequest' => $specialRequest,
        ]);
    }

    // Step 7: Otherwise, show suggestions
    $suggestions = room::where('roomstatus', 'like', '%avai%')
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


    public function store(Request $request){

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
        $form['reservation_bookingstatus'] = 'Pending';
        $form['bookedvia'] = 'Soliera';

        
        
       Reservation::create($form);

       room::where('roomID', $form['roomID'])->update([
        'roomstatus' => 'Reserved',
       ]);

       session()->flash('success', 'Reservation Success');

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


}
