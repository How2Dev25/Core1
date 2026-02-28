<?php

namespace App\Http\Controllers;

use App\Models\masterRFID;
use Illuminate\Http\Request;

class masterRFIDController extends Controller
{
    public function store(Request $request){
          $form = $request->validate([
            'masterRFID_rfid' => 'required',
            'masterRFID_name' => 'required',
        ]);

        masterRFID::create($form);

        return redirect()->back()->with('success', 'Master RFID Has been Added');
    }

     public function modify(Request $request, masterRFID $masterRFID_ID){
        $form = $request->validate([
            'masterRFID_rfid' => 'required',
            'masterRFID_name' => 'required',
            'masterRFID_status' => 'required'
        ]);

        $masterRFID_ID->update($form);

       
        return redirect()->back()->with('success', 'Master RFID Has been Modified');
    }

    public function remove(masterRFID $masterRFID_ID){
        $masterRFID_ID->delete();

         return redirect()->back()->with('success', 'Master RFID Has been Removed');
    }
    
}
