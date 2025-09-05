<?php

namespace App\Http\Controllers;

use App\Models\roomfeedbacks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\AuditTrails;

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

         if (Auth::check()) {
                $user = Auth::user();

                AuditTrails::create([
                    'dept_id'       => $user->Dept_id,
                    'dept_name'     => $user->dept_name,
                    'modules_cover' => 'Guest Relationship Management',
                    'action'        => 'Delete Feedback',
                    'activity'      => 'Delete Feedback #' .$roomfeedbackID->$roomfeedbackID,
                    'employee_name' => $user->employee_name,
                    'employee_id'   => $user->employee_id,
                    'role'          => $user->role,
                    'date'          => Carbon::now()->toDateTimeString(),
                ]);
            }

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

    public function respond(Request $request, roomfeedbacks $roomfeedbackID){
        $form = $request->validate([
            'roomfeedbackresponse' => 'required',
        ]);
        

         $form['roomfeedbackstatus'] = 'Closed';

           if (Auth::check()) {
                $user = Auth::user();

                AuditTrails::create([
                    'dept_id'       => $user->Dept_id,
                    'dept_name'     => $user->dept_name,
                    'modules_cover' => 'Guest Relationship Management',
                    'action'        => 'Respond Feedback',
                    'activity'      => 'Respond Feedback #' .$roomfeedbackID->$roomfeedbackID,
                    'employee_name' => $user->employee_name,
                    'employee_id'   => $user->employee_id,
                    'role'          => $user->role,
                    'date'          => Carbon::now()->toDateTimeString(),
                ]);
            }

        $roomfeedbackID->update($form);

        return redirect()->back()->with('success', 'Your Response Has Been Successfully Created!');
    }


}
