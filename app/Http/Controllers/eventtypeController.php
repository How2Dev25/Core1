<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ecmtype;
use App\Models\AuditTrails;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class eventtypeController extends Controller
{
    
public function store(Request $request){
    $form = $request->validate([
        'eventtype_name' => 'required|string|max:255',
        'eventtype_photo' => 'required|image',
        'eventtype_price' => 'required|numeric',
        'eventtype_description' => 'required|string',
        'eventtype_capacity' => 'nullable|integer',
        'facilityID' => 'nullable|integer',
        'eventtype_duration' => 'nullable|string|max:100',
        'eventtype_status' => 'required|in:Active,Inactive',
        'eventtype_amenities' => 'nullable|array',
        'eventtype_catering_options' => 'nullable|array',
        'eventtype_theme_options' => 'nullable|array',
        'eventtype_extra_services' => 'nullable|array',
    ]);

    // Handle photo upload
    if($request->hasFile('eventtype_photo')){
        $filename = time() . '_' . $request->file('eventtype_photo')->getClientOriginalName();
        $filepath = 'images/eventphotos/' . $filename;
        $request->file('eventtype_photo')->move(public_path('images/eventphotos/'), $filename);
        $form['eventtype_photo'] = $filepath;
    }

    // Clean dynamic array inputs (remove empty values)
    $arrayFields = ['eventtype_amenities','eventtype_catering_options','eventtype_theme_options','eventtype_extra_services'];

    foreach($arrayFields as $field){
        if(isset($form[$field]) && is_array($form[$field])){
            $form[$field] = array_values(array_filter(array_map('trim', $form[$field]), fn($val) => $val !== ''));
        } else {
            $form[$field] = [];
        }
    }

    // Create Event Type
    ecmtype::create($form);

    // Audit Trail
    AuditTrails::create([
        'dept_id' => Auth::user()->Dept_id,
        'dept_name' => Auth::user()->dept_name,
        'modules_cover' => 'Event And Conference',
        'action' => 'Create Event Type',
        'activity' => 'Created An Event Type',
        'employee_name' => Auth::user()->employee_name,
        'employee_id' => Auth::user()->employee_id,
        'role' => Auth::user()->role,
        'date' => Carbon::now()->toDateTimeString(),
    ]);

    return redirect()->back()->with('success', 'Event Type Has Been Created');
}

 public function modify(Request $request, ecmtype $eventtype_ID)
{
    $form = $request->validate([
        'eventtype_name' => 'nullable|string|max:255',
        'eventtype_photo' => 'nullable|image',
        'eventtype_price' => 'nullable|numeric',
        'eventtype_description' => 'nullable|string',
        'eventtype_capacity' => 'nullable|integer',
        'facilityID' => 'nullable|integer',
        'eventtype_duration' => 'nullable|string|max:100',
        'eventtype_status' => 'nullable|in:Active,Inactive',
        'eventtype_amenities' => 'nullable|array',
        'eventtype_catering_options' => 'nullable|array',
        'eventtype_theme_options' => 'nullable|array',
        'eventtype_extra_services' => 'nullable|array',
    ]);

    // Handle photo upload
    if($request->hasFile('eventtype_photo')){
        $filename = time() . '_' . $request->file('eventtype_photo')->getClientOriginalName();
        $filepath = 'images/eventphotos/' . $filename;
        $request->file('eventtype_photo')->move(public_path('images/eventphotos/'), $filename);
        $form['eventtype_photo'] = $filepath;
    } else {
        // keep old photo if none uploaded
        $form['eventtype_photo'] = $eventtype_ID->eventtype_photo;
    }

    // Clean dynamic array inputs (remove empty values)
    $arrayFields = ['eventtype_amenities','eventtype_catering_options','eventtype_theme_options','eventtype_extra_services'];

    foreach($arrayFields as $field){
        if(isset($form[$field]) && is_array($form[$field])){
            $form[$field] = array_values(array_filter(array_map('trim', $form[$field]), fn($val) => $val !== ''));
        } else {
            // preserve existing values if not submitted
            $form[$field] = $eventtype_ID->$field ?? [];
        }
    }

    // Update event type
    $eventtype_ID->update($form);

    // Audit Trail
    AuditTrails::create([
        'dept_id' => Auth::user()->Dept_id,
        'dept_name' => Auth::user()->dept_name,
        'modules_cover' => 'Event And Conference',
        'action' => 'Updated Event Type',
        'activity' => 'Modify Event Type ' . $eventtype_ID->eventtype_name,
        'employee_name' => Auth::user()->employee_name,
        'employee_id' => Auth::user()->employee_id,
        'role' => Auth::user()->role,
        'date' => Carbon::now()->toDateTimeString(),
    ]);

    return redirect()->back()->with('success', 'Event Type Has Been Modified');
}



    public function delete(ecmtype $eventtype_ID){

        $eventtype_ID->delete();

           AuditTrails::create([
            'dept_id' => Auth::user()->Dept_id,
            'dept_name' => Auth::user()->dept_name,
            'modules_cover' => 'Event And Conference',
            'action' => 'Remove Event Type',
            'activity' => 'Remove Event Type ' . $eventtype_ID->eventtype_name,
            'employee_name' => Auth::user()->employee_name,
            'employee_id' => Auth::user()->employee_id,
            'role' => Auth::user()->role,
            'date' => Carbon::now()->toDateTimeString(),
        ]);

          return redirect()->back()->with('success', 'Event Type Has Been Removed');

    }
}
