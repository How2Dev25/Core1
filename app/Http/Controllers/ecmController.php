<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ecm;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\AuditTrails;
use App\Models\ecmtype;



class ecmController extends Controller
{
  public function store(Request $request)
{
    dd($request->all());
    // ✅ Validate & store into $form
    $form = $request->validate([
        'eventtype_ID'        => 'required',
        'eventorganizer_email'=> 'required',
        'eventorganizer_name' => 'required',
        'eventorganizer_phone'=> 'required',
        'event_name'          => 'required',
        'event_specialrequest'=> 'nullable',
        'event_equipment'     => 'nullable',
        'event_paymentstatus' => 'required',
        'event_paymentmethod' => 'required',
        'event_checkin'       => 'required',
        'event_checkout'      => 'required',
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


    // ✅ Flash success message
    session()->flash('success', 'ECM booking has been successfully created.');

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


     public function bookevent($eventtype_ID){


 $eventtype = ecmtype::join('core1_facility', 'core1_facility.facilityID', '=', 'core1_eventtype.facilityID')
    ->where('core1_eventtype.eventtype_ID', $eventtype_ID)
    ->first();

    return view('admin.components.ecm.bookingpage', compact('eventtype'));
     
     
     }

}
