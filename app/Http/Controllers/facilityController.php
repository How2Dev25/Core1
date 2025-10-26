<?php

namespace App\Http\Controllers;

use App\Models\facility; // <-- your model naming
use App\Models\AuditTrails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class FacilityController extends Controller
{
    /**
     * Store a newly created facility.
     */
    public function store(Request $request)
    {
        $form = $request->validate([
            'facility_name' => 'required|string|max:255',
            'facility_capacity' => 'nullable|integer',
            'facility_type' => 'required',
            'facility_photo' => 'required',
            'facility_description' => 'nullable|string',
            'facility_amenities' => 'nullable|array',
            'facility_amenities.*' => 'nullable|string|max:255',
        ]);

        // Handle photo upload
        if ($request->hasFile('facility_photo')) {
            $filename = time() . '_' . $request->file('facility_photo')->getClientOriginalName();
            $filepath = 'images/facilityphotos/' . $filename;
            $request->file('facility_photo')->move(public_path('images/facilityphotos/'), $filename);
            $form['facility_photo'] = $filepath;
        }

        // Handle amenities (store as JSON)
        if ($request->filled('facility_amenities')) {
                $form['facility_amenities'] = $request->facility_amenities;
            }

        $facility = facility::create($form);

        // Audit trail
        AuditTrails::create([
            'dept_id' => Auth::user()->Dept_id,
            'dept_name' => Auth::user()->dept_name,
            'modules_cover' => 'Event And Conference',
            'action' => 'Create Facility',
            'activity' => 'Created Facility ' . $facility->facility_name,
            'employee_name' => Auth::user()->employee_name,
            'employee_id' => Auth::user()->employee_id,
            'role' => Auth::user()->role,
            'date' => Carbon::now()->toDateTimeString(),
        ]);

        return redirect()->back()->with('success', 'Facility has been created successfully.');
    }

    /**
     * Update an existing facility.
     */
  public function modify(Request $request, facility $facilityID)
{
    $form = $request->validate([
        'facility_name' => 'nullable|string|max:255',
        'facility_capacity' => 'nullable|integer',
        'facility_type' => 'nullable',
        'facility_photo' => 'nullable|image',
        'facility_description' => 'nullable|string',
        'facility_amenities' => 'nullable|array',
        'facility_amenities.*' => 'nullable|string|max:255',
    ]);

    // Photo handling
    if ($request->hasFile('facility_photo')) {
        $filename = time() . '_' . $request->file('facility_photo')->getClientOriginalName();
        $filepath = 'images/facilityphotos/' . $filename;
        $request->file('facility_photo')->move(public_path('images/facilityphotos/'), $filename);
        $form['facility_photo'] = $filepath;
    } else {
        $form['facility_photo'] = $facilityID->facility_photo;
    }

    // Amenities handling (always update, even if empty)
    $form['facility_amenities'] = $request->facility_amenities ?? [];

    $facilityID->update($form);

    // Audit trail
    AuditTrails::create([
        'dept_id' => Auth::user()->Dept_id,
        'dept_name' => Auth::user()->dept_name,
        'modules_cover' => 'Event And Conference',
        'action' => 'Modify Facility',
        'activity' => 'Modified Facility ' . $facilityID->facility_name,
        'employee_name' => Auth::user()->employee_name,
        'employee_id' => Auth::user()->employee_id,
        'role' => Auth::user()->role,
        'date' => Carbon::now()->toDateTimeString(),
    ]);

    return redirect()->back()->with('success', 'Facility has been updated successfully.');
}

    /**
     * Delete a facility.
     */
    public function delete(facility $facilityID)
    {
        $name = $facilityID->facility_name;

        $facilityID->delete();

        // Audit trail
        AuditTrails::create([
            'dept_id' => Auth::user()->Dept_id,
            'dept_name' => Auth::user()->dept_name,
            'modules_cover' => 'Event And Conference',
            'action' => 'Delete Facility',
            'activity' => 'Deleted Facility ' . $name,
            'employee_name' => Auth::user()->employee_name,
            'employee_id' => Auth::user()->employee_id,
            'role' => Auth::user()->role,
            'date' => Carbon::now()->toDateTimeString(),
        ]);

        return redirect()->back()->with('success', 'Facility has been deleted successfully.');
    }
}
