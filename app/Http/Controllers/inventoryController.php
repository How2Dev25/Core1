<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\AuditTrails;

class inventoryController extends Controller
{
     public function store(Request $request)
    {
         $form = $request->validate([
    'core1_inventory_name' => 'required',
    'core1_inventory_description' => 'nullable',
    'core1_inventory_category' => 'required',
    'core1_inventory_subcategory' => 'nullable',
    'core1_inventory_stocks' => 'required',
    'core1_inventory_threshold' => 'required',
    'core1_inventory_unit' => 'required',
    'core1_inventory_location' => 'required',
    'core1_inventory_shelf' => 'nullable',
    'core1_inventory_supplier' => 'nullable',
    'core1_inventory_supplier_contact' => 'nullable',
    'core1_inventory_cost' => 'nullable',
    'core1_inventory_image' => 'nullable',
]);

        // Handle file upload
        $filename = time() . '_' . $request->file('core1_inventory_image')->getClientOriginalName();
        $filepath = 'images/inventory/' .$filename;
        $request->file('core1_inventory_image')->move(public_path('images/inventory/'), $filename);
        $form['core1_inventory_image'] = $filepath;

        // Create the inventory item
     $inventory = Inventory::create($form);

     $inventory->update([
        'core1_inventory_code' => 'SH-'.str_pad($inventory->core1_inventoryID, 2, '0', STR_PAD_LEFT)
    ]);
    $inventory->save();

     AuditTrails::create([
            'dept_id' => Auth::user()->Dept_id,
            'dept_name' => Auth::user()->dept_name,
            'modules_cover' => 'Inventory And Stocks',
            'action' => 'Add Inventory',
            'activity' => 'Add Inventory',
            'employee_name' => Auth::user()->employee_name,
            'employee_id' => Auth::user()->employee_id,
            'role' => Auth::user()->role,
            'date' => Carbon::now()->toDateTimeString(),
        ]);

    session()->flash('inventorycreated', $form['core1_inventory_name']. ' Has been Added To The Inventory');

    return redirect()->back();
    }

    public function modify(Request $request, Inventory $core1_inventoryID){

         $form = $request->validate([
            'core1_inventory_name' => 'required|string|max:255',
            'core1_inventory_description' => 'nullable|string',
            'core1_inventory_category' => 'required|string|max:255',
            'core1_inventory_subcategory' => 'nullable|string|max:255',
            'core1_inventory_stocks' => 'required|integer|min:0',
            'core1_inventory_threshold' => 'required|integer|min:1',
            'core1_inventory_unit' => 'required|string|max:50',
            'core1_inventory_location' => 'required|string|max:255',
            'core1_inventory_shelf' => 'nullable|string|max:255',
            'core1_inventory_supplier' => 'nullable|string|max:255',
            'core1_inventory_supplier_contact' => 'nullable|string|max:255',
            'core1_inventory_cost' => 'nullable|numeric|min:0',
            'core1_inventory_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if($request->file('core1_inventory_image')){
        $filename = time() . '_' . $request->file('core1_inventory_image')->getClientOriginalName();
        $filepath = 'images/inventory/' .$filename;
        $request->file('core1_inventory_image')->move(public_path('images/inventory/'), $filename);
        $form['core1_inventory_image'] = $filepath;
        }
        else{
             $form['core1_inventory_image'] = $core1_inventoryID->core1_inventory_image;
        }

        $core1_inventoryID->update($form);


         AuditTrails::create([
            'dept_id' => Auth::user()->Dept_id,
            'dept_name' => Auth::user()->dept_name,
            'modules_cover' => 'Inventory And Stocks',
            'action' => 'Modify Inventory',
            'activity' => 'Modify ' . $core1_inventoryID->core1_inventory_name,
            'employee_name' => Auth::user()->employee_name,
            'employee_id' => Auth::user()->employee_id,
            'role' => Auth::user()->role,
            'date' => Carbon::now()->toDateTimeString(),
        ]);

        session()->flash('inventorymodified',  $core1_inventoryID->core1_inventory_code. ' Has Been Modified');

        return redirect()->back();

    }

    public function delete(Inventory $core1_inventoryID){
        $core1_inventoryID->delete();

         AuditTrails::create([
            'dept_id' => Auth::user()->Dept_id,
            'dept_name' => Auth::user()->dept_name,
            'modules_cover' => 'Inventory And Stocks',
            'action' => 'Remove Inventory',
            'activity' => 'Remove ' . $core1_inventoryID->core1_inventory_name,
            'employee_name' => Auth::user()->employee_name,
            'employee_id' => Auth::user()->employee_id,
            'role' => Auth::user()->role,
            'date' => Carbon::now()->toDateTimeString(),
        ]);

        session()->flash('inventorydeleted',  'Inventory Has Been Removed');

        return redirect()->back();
    }
}
