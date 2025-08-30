<?php

namespace App\Http\Controllers;

use App\Models\AuditTrails;
use App\Models\Channel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class channelController extends Controller
{
    public function store(Request $request){
        $form = $request->validate([
            'roomID' => 'required',
            'channelName' => 'required',
        ]);

        $form['channelStatus'] = 'Pending';

        Channel::create($form);

        AuditTrails::create([
            'dept_id' => Auth::user()->Dept_id,
            'dept_name' => Auth::user()->dept_name,
            'modules_cover' => 'Channel Management',
            'action' => 'Add Listing',
            'activity' => 'Added Room Listing',
            'employee_name' => Auth::user()->employee_name,
            'employee_id' => Auth::user()->employee_id,
            'role' => Auth::user()->role,
            'date' => Carbon::now()->toDateTimeString(),
        ]);

        session()->flash('RoomAdded',' Listing is added And is waiting for approval');

        return redirect()->back();

    }

    public function modify(Request $request, Channel $channelID){
         $form = $request->validate([
            'roomID' => 'nullable',
            'channelName' => 'nullable',
            
        ]);

        $channelID->update($form);

         AuditTrails::create([
            'dept_id' => Auth::user()->Dept_id,
            'dept_name' => Auth::user()->dept_name,
            'modules_cover' => 'Channel Management',
            'action' => 'Update Listing',
            'activity' => 'Update Room Listing For Channel ID ' . $channelID->channelID,
            'employee_name' => Auth::user()->employee_name,
            'employee_id' => Auth::user()->employee_id,
            'role' => Auth::user()->role,
            'date' => Carbon::now()->toDateTimeString(),
        ]);

        session()->flash('RoomModify','Listing Has Been Modified');

        return redirect()->back();
    }

    public function delete(Channel $channelID){

        $channelID->delete();

          AuditTrails::create([
            'dept_id' => Auth::user()->Dept_id,
            'dept_name' => Auth::user()->dept_name,
            'modules_cover' => 'Channel Management',
            'action' => 'Remove Listing',
            'activity' => 'Delete Room Listing For Channel ID ' . $channelID->channelID,
            'employee_name' => Auth::user()->employee_name,
            'employee_id' => Auth::user()->employee_id,
            'role' => Auth::user()->role,
            'date' => Carbon::now()->toDateTimeString(),
        ]);

         session()->flash('RoomDelete','Listing Has Been Removed');

        return redirect()->back();
    }
}
