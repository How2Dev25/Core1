<?php

namespace App\Http\Controllers;

use App\Models\requestEmployee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class employeerequestController extends Controller
{
    public function requestEmployee(Request $request){
        $form = $request->validate([
        'position' => 'required|string',
        'quantity' => 'required|integer|min:1',
        'employment_type' => 'required|string',
        'shift' => 'required|string',
        'reason' => 'required|string',
        
    ]);

    $form['department'] = 'Hotel';

    $form['requested_by'] = Auth::user()->employee_name . ' / ' . Auth::user()->role;

     $form['request_id'] = requestEmployee::generateRequestId();


    requestEmployee::create($form);

    return redirect()->back()->with('success', 'Request For Manpower Has Been Listed');

    }

    public function removerequestEmployee(requestEmployee $requestempID){
        
        $requestempID->delete();
        return redirect()->back()->with('success', 'Request Has Been Removed');
    }

    
}
