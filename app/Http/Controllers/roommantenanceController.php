<?php

namespace App\Http\Controllers;

use App\Models\room;
use App\Models\room_maintenance;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\AuditTrails;


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

         AuditTrails::create([
            'dept_id' => Auth::user()->Dept_id,
            'dept_name' => Auth::user()->dept_name,
            'modules_cover' => 'Housekeeping And Maintenance',
            'action' => 'Add Maintenance',
            'activity' => 'Added Room ' . $form['roomID'] . ' For Maintenance',
            'employee_name' => Auth::user()->employee_name,
            'employee_id' => Auth::user()->employee_id,
            'role' => Auth::user()->role,
            'date' => Carbon::now()->toDateTimeString(),
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

          AuditTrails::create([
            'dept_id' => Auth::user()->Dept_id,
            'dept_name' => Auth::user()->dept_name,
            'modules_cover' => 'Housekeeping And Maintenance',
            'action' => 'Modify Maintenance',
            'activity' => 'Modify Room Maintenance For Room ' . $roomID,
            'employee_name' => Auth::user()->employee_name,
            'employee_id' => Auth::user()->employee_id,
            'role' => Auth::user()->role,
            'date' => Carbon::now()->toDateTimeString(),
        ]);

        session()->flash('maintenancemodify', 'Maintenance For This Room Has Been Modified');

        return redirect()->back();
   }

   public function delete(room_maintenance $roommaintenanceID){
            $roomID = $roommaintenanceID->roomID;

           Room::where('roomID', $roomID)->update([
                'roomstatus' => 'Available',
            ]);

            $roommaintenanceID->delete();

             session()->flash('maintenancedelete', 'Maintenance Has Been Removed');

            AuditTrails::create([
            'dept_id' => Auth::user()->Dept_id,
            'dept_name' => Auth::user()->dept_name,
            'modules_cover' => 'Housekeeping And Maintenance',
            'action' => 'Remove Maintenance',
            'activity' => 'Remove Maintenance ' .$roommaintenanceID->roommaintenanceID,
            'employee_name' => Auth::user()->employee_name,
            'employee_id' => Auth::user()->employee_id,
            'role' => Auth::user()->role,
            'date' => Carbon::now()->toDateTimeString(),
        ]);

            return redirect()->back();
   }

   public function complete(room_maintenance $roommaintenanceID){
        $roommaintenanceID->update([
            'maintenancestatus' => 'Completed',
        ]);

        AuditTrails::create([
            'dept_id' => Auth::user()->Dept_id,
            'dept_name' => Auth::user()->dept_name,
            'modules_cover' => 'Housekeeping And Maintenance',
            'action' => 'Complete Maintenance',
            'activity' => 'Completed Maintenance For Room ' . $roommaintenanceID->roomID,
            'employee_name' => Auth::user()->employee_name,
            'employee_id' => Auth::user()->employee_id,
            'role' => Auth::user()->role,
            'date' => Carbon::now()->toDateTimeString(),
        ]);

          session()->flash('maintenancecomplete', 'Maintenance Has Been Completed');

        return redirect()->back();
   }

   public function use(Request $request ,Inventory $core1_inventoryID){
        $form = $request->validate([
            'useItem' => 'required',
        ]);

             $usestocks = $form['useItem'];
             $currentstocks =  $core1_inventoryID->core1_inventory_stocks;
             $currentthreshold = $core1_inventoryID->core1_inventory_threshold;
             $updatedstock = $currentstocks - $usestocks;

             if($currentstocks <= 0){
                     AuditTrails::create([
                        'dept_id' => Auth::user()->Dept_id,
                        'dept_name' => Auth::user()->dept_name,
                        'modules_cover' => 'Housekeeping And Maintenance',
                        'action' => 'Out Of Stock',
                        'activity' => 'Out of Stocks For ' . $core1_inventoryID->core1_inventory_name,
                        'employee_name' => Auth::user()->employee_name,
                        'employee_id' => Auth::user()->employee_id,
                        'role' => Auth::user()->role,
                        'date' => Carbon::now()->toDateTimeString(),
                    ]);
                session()->flash('stockerror', 'This Item is Out Of Stocks!');
                return redirect()->back();
             }
            elseif ($usestocks > $currentstocks) {

                  AuditTrails::create([
                        'dept_id' => Auth::user()->Dept_id,
                        'dept_name' => Auth::user()->dept_name,
                        'modules_cover' => 'Housekeeping And Maintenance',
                        'action' => 'Stock Use Failed',
                        'activity' => 'Trying to use more than available stocks For ' . $core1_inventoryID->core1_inventory_name,
                        'employee_name' => Auth::user()->employee_name,
                        'employee_id' => Auth::user()->employee_id,
                        'role' => Auth::user()->role,
                        'date' => Carbon::now()->toDateTimeString(),
                    ]);
                    session()->flash('stocklimit', 'You are trying to use more than available stocks!');
                    return redirect()->back();
                    }
             else{
                 $core1_inventoryID->update([
                    'core1_inventory_stocks'=> $updatedstock,
                 ]);

                 AuditTrails::create([
                        'dept_id' => Auth::user()->Dept_id,
                        'dept_name' => Auth::user()->dept_name,
                        'modules_cover' => 'Housekeeping And Maintenance',
                        'action' => 'Stock Use Success',
                        'activity' => 'Success use For Stock ' . $core1_inventoryID->core1_inventory_name,
                        'employee_name' => Auth::user()->employee_name,
                        'employee_id' => Auth::user()->employee_id,
                        'role' => Auth::user()->role,
                        'date' => Carbon::now()->toDateTimeString(),
                    ]);

                 session()->flash('stockUpdated','Stock Has been Updated');

                 return redirect()->back();
             }

       
   }
}
