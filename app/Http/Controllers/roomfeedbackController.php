<?php

namespace App\Http\Controllers;

use App\Models\roomfeedbacks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class roomfeedbackController extends Controller
{


    public function store(Request $request){
        $form = $request->validate([
            'roomID' => 'required',
            'roomrating' => 'required',
            'roomfeedbackfeedback' => 'required',
        ]);

        $form['guestID'] = Auth::guard('guest')->user()->guestID;
        $form['roomfeedbackstatus'] = 'Open';
        $form['roomfeedbackdate'] = Carbon::now();
            
        roomfeedbacks::create($form);

        return redirect()->back()->with('success', 'Your feedback has been submitted successfully!');

    }


}
