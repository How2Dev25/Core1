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

        return redirect()->back()->with('success', 'feedback has been submitted successfully!');

    }

    public function delete(roomfeedbacks $roomfeedbackID){

        $roomfeedbackID->delete();

          return redirect()->back()->with('success', 'feedback has been removed successfully!');
    }

    public function update(Request $request, roomfeedbacks $roomfeedbackID){
        $form = $request->validate([
            'roomID' => 'required',
            'roomrating' => 'required',
            'roomfeedbackfeedback' => 'required',
        ]);

        $form['guestID'] = Auth::guard('guest')->user()->guestID;
        $form['roomfeedbackstatus'] = 'Open';

        $roomfeedbackID->update($form);
        

        return redirect()->back()->with('success', 'feedback has been modified successfully!');
    }


}
