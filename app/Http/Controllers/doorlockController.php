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


public function monitor($doorlockID)
{
    // Main view load
    $doorlockfrontdesk = doorlockFrontdesk::join('core1_reservation', 'core1_reservation.bookingID', '=', 'doorlockfrontdesk.bookingID')
        ->join('core1_room', 'core1_room.roomID', '=', 'core1_reservation.roomID')
        ->join('doorlock', 'doorlock.doorlockID', 'doorlockfrontdesk.doorlockID')
        ->where('doorlockfrontdesk.doorlockID', $doorlockID)
        ->first();

    return view('admin.doorlockmonitor', compact('doorlockfrontdesk', 'doorlockID'));
}

public function getMonitorData($doorlockID)
{
    // RFID logs with pagination
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
        ->paginate(5);

    // Get all history for analytics
    $doorlockHistory = rfidHistory::where('doorlockID', $doorlockID)
        ->orderBy('created_at', 'desc')
        ->get();

    // Access Pattern (24h) - hourly grouping for cleaner visualization
    $accessPattern = $doorlockHistory
        ->filter(fn($h) => $h->created_at >= Carbon::now()->subDay())
        ->groupBy(fn($h) => $h->created_at->format('H:00'))
        ->map(fn($group) => [
            'unlocked' => $group->where('door_state', 'Unlocked')->count(),
            'locked' => $group->where('door_state', 'Locked')->count()
        ]);

    // Activity Distribution
    $activityDistribution = $doorlockHistory->groupBy('door_state')->map->count();

    // Weekly Summary (last 7 days)
    $weeklySummary = collect();
    for ($i = 6; $i >= 0; $i--) {
        $date = Carbon::now()->subDays($i);
        $dayName = $date->format('l');
        $count = $doorlockHistory->filter(fn($h) => $h->created_at->isSameDay($date))->count();
        $weeklySummary->put($dayName, $count);
    }

    // Security Analysis
    $securityAnalysis = $this->analyzeSecurityStatus($doorlockHistory);

    // Metrics
    $totalLogs = $doorlockHistory->count();
    $openEvents = $doorlockHistory->where('door_state', 'Unlocked')->count();
    $closedEvents = $doorlockHistory->where('door_state', 'Locked')->count();

    return response()->json([
        'doorlock' => $doorlock,
        'accessPattern' => $accessPattern,
        'activityDistribution' => $activityDistribution,
        'weeklySummary' => $weeklySummary,
        'overallStatus' => $securityAnalysis['status'],
        'statusReason' => $securityAnalysis['reason'],
        'lastActivityTime' => $securityAnalysis['lastActivityTime'],
        'rapidAttemptsToday' => $securityAnalysis['rapidAttemptsToday'],
        'totalLogs' => $totalLogs,
        'openEvents' => $openEvents,
        'closedEvents' => $closedEvents,
        'suspiciousEvents' => $securityAnalysis['suspiciousEvents'],
        'suspiciousDetails' => $securityAnalysis['details']
    ]);
}

private function analyzeSecurityStatus($doorlockHistory)
{
    $lastActivity = $doorlockHistory->first(); // Already sorted desc
    $lastActivityTime = $lastActivity ? $lastActivity->created_at->diffForHumans() : 'No activity';
    
    $status = 'NORMAL';
    $reason = 'All activity appears normal';
    $suspiciousEvents = 0;
    $details = [];
    
    // 1. Check for excessive rapid access (3+ times within 30 seconds = suspicious)
    $rapidAttemptsToday = 0;
    $todayHistory = $doorlockHistory
        ->where('created_at', '>=', Carbon::now()->startOfDay())
        ->sortBy('created_at')
        ->values();
    
    $rapidSequences = 0;
    for ($i = 2; $i < $todayHistory->count(); $i++) {
        $time1 = $todayHistory[$i - 2]->created_at;
        $time2 = $todayHistory[$i - 1]->created_at;
        $time3 = $todayHistory[$i]->created_at;
        
        // 3 accesses within 30 seconds
        if ($time3->diffInSeconds($time1) <= 30) {
            $rapidSequences++;
            $rapidAttemptsToday++;
        }
    }
    
    if ($rapidSequences >= 2) {
        $status = 'SUSPICIOUS';
        $suspiciousEvents += $rapidSequences;
        $details[] = "Multiple rapid access sequences detected ({$rapidSequences} times)";
    }
    
    // 2. Check for very late night access (2 AM - 5 AM = potentially suspicious)
    $lateNightAccess = $doorlockHistory->filter(function($h) {
        $hour = $h->created_at->hour;
        return $hour >= 2 && $hour < 5;
    });
    
    if ($lateNightAccess->count() >= 3) {
        $status = 'SUSPICIOUS';
        $suspiciousEvents += $lateNightAccess->count();
        $details[] = "{$lateNightAccess->count()} access attempts during late night hours (2-5 AM)";
    }
    
    // 3. Check for unusual access patterns (more than 20 accesses in an hour)
    $hourlyAccess = $doorlockHistory
        ->filter(fn($h) => $h->created_at >= Carbon::now()->subHour())
        ->count();
    
    if ($hourlyAccess > 20) {
        $status = 'SUSPICIOUS';
        $suspiciousEvents += floor($hourlyAccess / 10);
        $details[] = "Unusually high access frequency ({$hourlyAccess} times in the last hour)";
    }
    
    // 4. Check for failed pattern (rapid lock/unlock cycles)
    $historyArray = $doorlockHistory->take(10)->values();
    $lockUnlockCycles = 0;
    for ($i = 1; $i < $historyArray->count(); $i++) {
        if ($historyArray[$i]->door_state !== $historyArray[$i - 1]->door_state) {
            $diff = $historyArray[$i]->created_at->diffInSeconds($historyArray[$i - 1]->created_at);
            if ($diff < 5) { // State change within 5 seconds
                $lockUnlockCycles++;
            }
        }
    }
    
    if ($lockUnlockCycles >= 3) {
        $status = 'SUSPICIOUS';
        $suspiciousEvents += $lockUnlockCycles;
        $details[] = "Rapid lock/unlock cycles detected ({$lockUnlockCycles} times)";
    }
    
    // Set reason based on findings
    if ($status === 'SUSPICIOUS') {
        $reason = implode('; ', $details);
    }
    
    return [
        'status' => $status,
        'reason' => $reason,
        'lastActivityTime' => $lastActivityTime,
        'rapidAttemptsToday' => $rapidAttemptsToday,
        'suspiciousEvents' => $suspiciousEvents,
        'details' => $details
    ];
}
}
