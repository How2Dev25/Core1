<?php

namespace App\Http\Controllers;

use App\Models\room;
use App\Models\room_maintenance;
use Illuminate\Http\Request;

class roommantenanceController extends Controller
{
   public function store(Request $request){
        $form = $request->validate([
            'roomID' => 'required',
            'maintenancedescription' => 'required',
            'maintenancestatus' => 'required',
            'maintenanceassigned_To' => 'required',
            'maintenance_priority' => 'required',
        ]);

        room_maintenance::create($form);

        room::where('roomID', $form['roomID'])->update([
            'roomstatus' => 'Maintenance',
        ]);

        session()->flash('maintenancecreate', 'Maintenance Status For This Room Is Ongoing');

        return redirect()->back();
   }

   public function modify(Request $request, room_maintenance $roommaintenanceID){
            $form = $request->validate([
            'maintenancedescription' => 'required',
            'maintenancestatus' => 'required',
            'maintenanceassigned_To' => 'required',
            'maintenance_priority' => 'required',
        ]);

        $roomID = $roommaintenanceID->roomID;

       $roommaintenanceID->update($form);

        if($form['maintenancestatus'] === 'Completed'){
            Room::where('roomID', $roomID)->update([
                'roomstatus' => 'Available',
            ]);
        }

        session()->flash('maintenancemodify', 'Maintenance For This Room Has Been Modified');

        return redirect()->back();
   }

   public function delete(room_maintenance $roommaintenanceID){
            $roomID = $roommaintenanceID->roomID;

           Room::where('roomID', $roomID)->update([
                'roomstatus' => 'Avaiable',
            ]);

            $roommaintenanceID->delete();

             session()->flash('maintenancedelete', 'Maintenance Has Been Removed');

            return redirect()->back();
   }

   public function complete(room_maintenance $roommaintenanceID){
        $roommaintenanceID->update([
            'maintenancestatus' => 'Completed',
        ]);

          session()->flash('maintenancecomplete', 'Maintenance Has Been Completed');

        return redirect()->back();
   }
}
