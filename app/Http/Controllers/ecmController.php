<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ecm;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\AuditTrails;



class ecmController extends Controller
{
    public function store(Request $request){
        $form = $request->validate([
            'eventphoto' => 'required',
            'eventname' => 'required',
            'eventtype' => 'required',
            'eventorganizername' => 'required',
            'eventcontactemail' => 'required',
            'eventcontactnumber' => 'required',
            'eventdate' => 'required',
            'event_time_start' => 'required',
            'event_time_end' => 'required',
            'eventexpectedguest' => 'required',
            'eventneedroombooking' => 'required',
            'eventequipment' => 'required',
            'eventspecialrequest' => 'required',
            'eventstatus' => 'required',
            'eventdays' => 'required',
        ]);

        $filename = time() . '_' . $request->file('eventphoto')->getClientOriginalName();
        $filepath = 'images/ecm/' .$filename;
        $request->file('eventphoto')->move(public_path('images/ecm/'), $filename);
        $form['eventphoto'] = $filepath;

        Ecm::create($form);


          AuditTrails::create([
            'dept_id' => Auth::user()->Dept_id,
            'dept_name' => Auth::user()->dept_name,
            'modules_cover' => 'Event And Conference',
            'action' => 'Add Event',
            'activity' => 'Add An Event',
            'employee_name' => Auth::user()->employee_name,
            'employee_id' => Auth::user()->employee_id,
            'role' => Auth::user()->role,
            'date' => Carbon::now()->toDateTimeString(),
        ]);


        session()->flash('eventcreated', 'Event Has Been Created');

        return redirect()->back();
    }

    public function update(Request $request, Ecm $eventID){
        $form = $request->validate([
            'eventphoto' => 'nullable',
            'eventname' => 'nullable',
            'eventtype' => 'nullable',
            'eventorganizername' => 'nullable',
            'eventcontactemail' => 'nullable',
            'eventcontactnumber' => 'nullable',
            'eventdate' => 'nullable',
            'event_time_start' => 'nullable',
            'event_time_end' => 'nullable',
            'eventexpectedguest' => 'nullable',
            'eventneedroombooking' => 'nullable',
            'eventequipment' => 'nullable',
            'eventspecialrequest' => 'nullable',
            'eventstatus' => 'nullable',
            'eventdays' => 'nullable',
        ]);

        if($request->hasFile('eventphoto')){
            $filename = time() . '_' . $request->file('eventphoto')->getClientOriginalName();
            $filepath = 'images/ecm/' .$filename;
            $request->file('eventphoto')->move(public_path('images/ecm/'), $filename);
            $form['eventphoto'] = $filepath;
    
        }
        else{
            $form['eventphoto'] = $eventID->eventphoto;
        }

        $eventID->update($form);

         AuditTrails::create([
            'dept_id' => Auth::user()->Dept_id,
            'dept_name' => Auth::user()->dept_name,
            'modules_cover' => 'Event And Conference',
            'action' => 'Add Event',
            'activity' => 'Modify Event '. $eventID->eventID,
            'employee_name' => Auth::user()->employee_name,
            'employee_id' => Auth::user()->employee_id,
            'role' => Auth::user()->role,
            'date' => Carbon::now()->toDateTimeString(),
        ]);

        session()->flash('eventmodify', 'Event Has Been Modified');
        return redirect()->back();

    }

    public function delete(Ecm $eventID){
        $eventID->delete();

         AuditTrails::create([
            'dept_id' => Auth::user()->Dept_id,
            'dept_name' => Auth::user()->dept_name,
            'modules_cover' => 'Event And Conference',
            'action' => 'Remove Event',
            'activity' => 'Remove Event '. $eventID->eventID,
            'employee_name' => Auth::user()->employee_name,
            'employee_id' => Auth::user()->employee_id,
            'role' => Auth::user()->role,
            'date' => Carbon::now()->toDateTimeString(),
        ]);
        session()->flash('eventdelete', 'Event Has Been Deleted');
        return redirect()->back();
    }

    public function approved(Ecm $eventID){
       $eventID->update([
        'eventstatus' => 'Approved'
       ]);

        AuditTrails::create([
            'dept_id' => Auth::user()->Dept_id,
            'dept_name' => Auth::user()->dept_name,
            'modules_cover' => 'Event And Conference',
            'action' => 'Approve Event',
            'activity' => 'Approve Event '. $eventID->eventID,
            'employee_name' => Auth::user()->employee_name,
            'employee_id' => Auth::user()->employee_id,
            'role' => Auth::user()->role,
            'date' => Carbon::now()->toDateTimeString(),
        ]);

       session()->flash('eventapprove', 'Event Has Been Approved');
       return redirect()->back();
    }

    public function cancel(Ecm $eventID){
        $eventID->update([
         'eventstatus' => 'Cancelled'
        ]);
        
         AuditTrails::create([
            'dept_id' => Auth::user()->Dept_id,
            'dept_name' => Auth::user()->dept_name,
            'modules_cover' => 'Event And Conference',
            'action' => 'Cancel Event',
            'activity' => 'Approve Event '. $eventID->eventID,
            'employee_name' => Auth::user()->employee_name,
            'employee_id' => Auth::user()->employee_id,
            'role' => Auth::user()->role,
            'date' => Carbon::now()->toDateTimeString(),
        ]);
        session()->flash('eventcancelled', 'Event Has Been Cancelled');
        return redirect()->back();
     }

}
