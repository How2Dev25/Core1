<?php

namespace App\Http\Controllers;

use App\Models\doorlock;
use App\Models\missingRFID;
use Illuminate\Http\Request;
use Svg\Tag\Rect;
use App\Models\doorlockFrontdesk;
use App\Models\rfidHistory;

class missingRFIDController extends Controller
{
    public function store(Request $request){
        $form = $request->validate([
            'doorlockID' => 'required',
        ]);

        missingRFID::create($form);

        return redirect()->back()->with('success', 'Missing RFID has been reported');
    }

   public function removeAssignment($doorlockfrontdeskID)
{
    $assignment = DoorlockFrontdesk::findOrFail($doorlockfrontdeskID);

    // Optional: Update doorlock status
    doorlock::where('doorlockID', $assignment->doorlockID)
        ->update(['doorlock_status' => 'Inactive']);

    // Remove all RFID history for this doorlock
    rfidHistory::where('doorlockID', $assignment->doorlockID)->delete();

     MissingRFID::where('doorlockID', $assignment->doorlockID)
        ->update(['missing_rfid_status' => 'Resolved']);

    // Remove the assignment
    $assignment->delete();

    return redirect()->back()->with('success', 'RFID removed successfully!');
}

}
