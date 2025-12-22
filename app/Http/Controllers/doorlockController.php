<?php

namespace App\Http\Controllers;

use App\Models\doorlock;
use App\Models\doorlockFrontdesk;
use App\Models\Reservation;
use App\Models\rfidHistory;
use Illuminate\Http\Request;
use Carbon\Carbon;

class doorlockController extends Controller
{
    
    public function storedoorLock(Request $request){
        $form = $request->validate([
            'rfid' => 'required|unique:doorlock,rfid',
            'roomID' => 'required',
        ]);

        doorlock::create($form);

        return redirect()->back()->with('success', 'RFID door lock has been integrated to room ' .$form['roomID']);
    }

    public function modifydoorLock(Request $request, doorlock $doorlockID){

        $form = $request->validate([
            'rfid' => 'required',
            'roomID' => 'required',
        ]);

        $doorlockID->update($form);

        return redirect()->back()->with('success', 'Door Lock ID has been Modified');


    }

    public function removedoorLock(doorlock $doorlockID){
        $doorlockID->delete();
         return redirect()->back()->with('success', 'Door Lock ID has been Removed');
    }


public function assignkeycard($reservationID)
{
    try {
        // Fetch reservation
        $reservation = Reservation::findOrFail($reservationID);
        $roomID = $reservation->roomID;

        // Fetch doorlock for the room (throws if not found)
        $doorlock = doorlock::where('roomID', $roomID)->firstOrFail();

        // Optional: prevent duplicate keycard assignments
        $exists = doorlockFrontdesk::where('bookingID', $reservation->bookingID)
            ->where('doorlockID', $doorlock->doorlockID)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'This booking already has a keycard assigned.');
        }

        // Create doorlockFrontdesk record
        doorlockFrontdesk::create([
            'guestID' => $reservation->guestID ?? null,
            'doorlockID' => $doorlock->doorlockID,
            'guestname' => $reservation->guestname,
            'bookingID' => $reservation->bookingID,
        ]);

        // Update doorlock status
        $doorlock->update([
            'doorlock_status' => 'Active',
        ]);

        return redirect()->back()->with('success', 'RFID has been assigned to the booking');

    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        // Either reservation or doorlock not found
        return redirect()->back()->with('error', ' doorlock is not integrated with the room.');
    } catch (\Exception $e) {
        // Any other errors
        return redirect()->back()->with('error', 'An unexpected error occurred: ' . $e->getMessage());
    }
}


    
public function removeAssignment($doorlockfrontdeskID)
{
    $assignment = DoorlockFrontdesk::findOrFail($doorlockfrontdeskID);

    // Optional: Update doorlock status
    Doorlock::where('doorlockID', $assignment->doorlockID)
        ->update(['doorlock_status' => 'Inactive']);

    // Remove all RFID history for this doorlock
    rfidHistory::where('doorlockID', $assignment->doorlockID)->delete();

    // Remove the assignment
    $assignment->delete();

    return redirect()->back()->with('success', 'Assignment removed successfully!');
}


public function monitor($doorlockID){
    // rfid logs
$doorlock = rfidHistory::join('doorlockfrontdesk as df1', 'df1.doorlockID', '=', 'rfid_history.doorlockID')
    ->join('doorlock as d', 'd.doorlockID', '=', 'df1.doorlockID')
    ->where('rfid_history.doorlockID', $doorlockID)
    ->select(
        'rfid_history.*',
        'df1.*',
        'rfid_history.created_at as rfiddate',
        'd.*'
    )
    ->orderBy('rfid_history.created_at', 'desc')
    ->paginate(5); // <-- Change 10 to how many rows per page you want


    //    booking details
    $doorlockfrontdesk = doorlockFrontdesk::join('core1_reservation', 'core1_reservation.bookingID', '=', 'doorlockfrontdesk.bookingID')
    ->join('core1_room', 'core1_room.roomID', '=', 'core1_reservation.roomID')
    ->join('doorlock', 'doorlock.doorlockID', 'doorlockfrontdesk.doorlockID')
    ->where('doorlockfrontdesk.doorlockID', $doorlockID )
    ->first();



  $doorlockHistory = rfidHistory::where('doorlockID', $doorlockID)
    ->orderBy('created_at')
    ->get();

// Access Pattern (24h)
$accessPattern = $doorlockHistory->filter(function ($h) {
    return $h->created_at >= Carbon::now()->subDay();
})->map(function ($h) {
    return [
        'time' => $h->created_at->format('H:i'), // hour:minute
        'state' => $h->door_state
    ];
});

// Activity Distribution
$activityDistribution = $doorlockHistory->groupBy('door_state')->map->count();

// Weekly Summary (last 7 days)
$weeklySummary = $doorlockHistory->groupBy(function ($h) {
    return $h->created_at->format('l'); // Day name
})->map->count();



 $lastActivity = $doorlockHistory->last();
    $lastActivityTime = $lastActivity ? $lastActivity->created_at->diffForHumans() : 'No activity';

    // Overall Status
    $overallStatus = 'NORMAL';

    // Check for rapid repeated access (<10 seconds between taps)
    $rapidAccess = false;
    $doorlockHistoryArray = $doorlockHistory->values();
    for ($i = 1; $i < $doorlockHistoryArray->count(); $i++) {
        $diff = $doorlockHistoryArray[$i]->created_at->diffInSeconds($doorlockHistoryArray[$i - 1]->created_at);
        if ($diff < 10) {
            $rapidAccess = true;
            break;
        }
    }

    if ($rapidAccess) {
        $overallStatus = 'SUSPICIOUS';
    }

    // Check last access time outside expected hours (11 PM - 6 AM)
    if ($lastActivity && ($lastActivity->created_at->hour < 6 || $lastActivity->created_at->hour > 23)) {
        $overallStatus = 'SUSPICIOUS';
    }

    // Rapid taps today
    $rapidAttemptsToday = 0;
    $todayHistory = $doorlockHistory->where('created_at', '>=', Carbon::now()->startOfDay())->values();
    for ($i = 1; $i < $todayHistory->count(); $i++) {
        $diff = $todayHistory[$i]->created_at->diffInSeconds($todayHistory[$i - 1]->created_at);
        if ($diff < 10) {
            $rapidAttemptsToday++;
        }
    }


      $totalLogs = $doorlockHistory->count();

    // Open Events
    $openEvents = $doorlockHistory->where('door_state', 'Unlocked')->count();

    // Closed Events
    $closedEvents = $doorlockHistory->where('door_state', 'Locked')->count();

    // Suspicious Events
    $suspiciousEvents = 0;
    $historyArray = $doorlockHistory->sortBy('created_at')->values();

    // Detect rapid repeated access (<10 seconds apart)
    for ($i = 1; $i < $historyArray->count(); $i++) {
        $diff = $historyArray[$i]->created_at->diffInSeconds($historyArray[$i - 1]->created_at);
        if ($diff < 10) {
            $suspiciousEvents++;
        }
    }

    // Optional: count access outside allowed hours
    foreach ($historyArray as $history) {
        $hour = $history->created_at->hour;
        if ($hour < 6 || $hour > 23) {
            $suspiciousEvents++;
        }
    }

// Pass to Blade
return view('admin.doorlockmonitor', compact('doorlockHistory', 'accessPattern', 
'activityDistribution', 'weeklySummary', 'doorlockfrontdesk','doorlock',  'overallStatus',
        'lastActivityTime',
        'rapidAttemptsToday',
     'totalLogs',
        'openEvents',
        'closedEvents',
        'suspiciousEvents'));
}
}
