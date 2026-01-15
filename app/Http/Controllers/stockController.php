<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\stockRequest;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\AuditTrails;

class stockController extends Controller
{
    public function store(Request $request){
        $form = $request->validate([
            'core1_request_items' => 'required',
            'core1_request_category' => 'required',
            'core1_request_priority' => 'required',
            'core1_request_needed' => 'required',
            
        ]);

        $form['core1_request_status'] = 'Pending';

        $stockcreated =  stockRequest::create($form);

        $stockcreated->update([
            'core1_requestID' => 'REQ-'.str_pad($stockcreated->core1_stockID, 2, '0', STR_PAD_LEFT)
        ]);

        $stockcreated->save();

         AuditTrails::create([
            'dept_id' => Auth::user()->Dept_id,
            'dept_name' => Auth::user()->dept_name,
            'modules_cover' => 'Inventory And Stocks',
            'action' => 'Request Stocks',
            'activity' => 'Request Stocks',
            'employee_name' => Auth::user()->employee_name,
            'employee_id' => Auth::user()->employee_id,
            'role' => Auth::user()->role,
            'date' => Carbon::now()->toDateTimeString(),
        ]);

        session()->flash('stockcreated', 'Stock Request Has Been Added');

        return redirect()->back();
    }
    
    public function modify(Request $request, stockRequest $core1_stockID){
             $form = $request->validate([
            'core1_request_items' => 'nullable',
            'core1_request_status' => 'nullable',
            'core1_request_category' => 'nullable',
            'core1_request_priority' => 'nullable',
            'core1_request_needed' => 'nullable',
           
        ]);

        $core1_stockID->update($form);

        AuditTrails::create([
            'dept_id' => Auth::user()->Dept_id,
            'dept_name' => Auth::user()->dept_name,
            'modules_cover' => 'Inventory And Stocks',
            'action' => 'Modify Request ',
            'activity' => 'Modify Request ' . $core1_stockID->core1_requestID,
            'employee_name' => Auth::user()->employee_name,
            'employee_id' => Auth::user()->employee_id,
            'role' => Auth::user()->role,
            'date' => Carbon::now()->toDateTimeString(),
        ]);

         session()->flash('stockupdated', 'Stock Request Has Been Updated');

         return redirect()->back();
    }

    public function delete(stockRequest $core1_stockID){

        $core1_stockID->delete();


         AuditTrails::create([
            'dept_id' => Auth::user()->Dept_id,
            'dept_name' => Auth::user()->dept_name,
            'modules_cover' => 'Inventory And Stocks',
            'action' => 'Remove Request ',
            'activity' => 'Remove Request ' . $core1_stockID->core1_requestID,
            'employee_name' => Auth::user()->employee_name,
            'employee_id' => Auth::user()->employee_id,
            'role' => Auth::user()->role,
            'date' => Carbon::now()->toDateTimeString(),
        ]);

        session()->flash('stockdeleted', 'Stock Request Has Been Removed');

        return redirect()->back();
    }


        public function approve(stockRequest $core1_stockID){
       
        $core1_stockID->update([
            'core1_request_status' => 'Approved',
        ]);

        return redirect()->back()->with('success', 'Stock Request Has Been Approved');

     
    }


     public function deliver(stockRequest $core1_stockID){
       

        $core1_stockID->update([
            'core1_request_status' => 'Delivered',
        ]);

        return redirect()->back()->with('success', 'Stock Request Has Been Delivered');
    }


     public function reject(stockRequest $core1_stockID){
       

        $core1_stockID->update([
            'core1_request_status' => 'Rejected',
        ]);

        return redirect()->back()->with('success', 'Stock Request Has Been Delivered');
    }

}
