<?php

namespace App\Http\Controllers;

use App\Models\requestEmployee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class employeerequestController extends Controller
{
  public function requestEmployee(Request $request)
{
    // Resolve reason (Other vs Select)
    $reason = $request->reason_select === 'Other'
        ? $request->reason_other
        : $request->reason_select;

    // Merge final reason before validation
    $form = $request->merge([
        'reason' => $reason
    ])->validate([
        'position' => 'required|string',
        'quantity' => 'required|integer|min:1',
        'employment_type' => 'required|string',
        'shift' => 'required|string',
        'reason' => 'required|string',
    ]);

    // Auto fields
    $form['department'] = 'Hotel';
    $form['requested_by'] = Auth::user()->employee_name . ' / ' . Auth::user()->role;
    $form['request_id'] = requestEmployee::generateRequestId();
    $form['status'] = 'Pending';

    // Save
    requestEmployee::create($form);

    return back()->with('success', 'Manpower request submitted successfully');
}
    public function removerequestEmployee(requestEmployee $requestempID){
        
        $requestempID->delete();
        return redirect()->back()->with('success', 'Request Has Been Removed');
    }

    
}
