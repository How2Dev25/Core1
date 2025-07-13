<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;

class inventoryController extends Controller
{
     public function store(Request $request)
    {
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

        session()->flash('inventorymodified',  $core1_inventoryID->core1_inventory_code. ' Has Been Modified');

        return redirect()->back();

    }

    public function delete(Inventory $core1_inventoryID){
        $core1_inventoryID->delete();

        session()->flash('inventorydeleted',  'Inventory Has Been Removed');

        return redirect()->back();
    }
}
