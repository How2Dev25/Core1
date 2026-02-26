<?php

namespace App\Http\Controllers;

use App\Models\masterOTP;
use App\Models\masterRFID;
use Illuminate\Http\Request;

class masterOTPController extends Controller
{
    public function store(Request $request){
          $form = $request->validate([
            'masterRFID_rfid' => 'required',
            'masterRFID_name' => 'required',
            'masterRFID_status' => 'required'
        ]);

        masterRFID::create($form);

        return redirect()->back()->with('success', 'Master OTP Has been Added');
    }

     public function Modify(Request $request, masterRFID $masterRFID_ID){
        $form = $request->validate([
            'masterRFID_rfid' => 'required',
            'masterRFID_name' => 'required',
            'masterRFID_status' => 'required'
        ]);

        $masterRFID_ID->update($form);

       
        return redirect()->back()->with('success', 'Master OTP Has been Modified');
    }

    public function remove(masterRFID $masterRFID_ID){
        $masterRFID_ID->delete();

         return redirect()->back()->with('success', 'Master OTP Has been Removed');
    }
    
}
