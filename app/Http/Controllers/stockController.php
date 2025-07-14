<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\stockRequest;

class stockController extends Controller
{
    public function store(Request $request){
        $form = $request->validate([
            'core1_request_items' => 'required',
            'core1_request_status' => 'required',
            'core1_request_category' => 'required',
            'core1_request_priority' => 'required',
            'core1_request_needed' => 'required',
            
        ]);

        $stockcreated =  stockRequest::create($form);

        $stockcreated->update([
            'core1_requestID' => 'REQ-'.str_pad($stockcreated->core1_stockID, 2, '0', STR_PAD_LEFT)
        ]);

        $stockcreated->save();

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

        return $form; 
    }

    public function delete(stockRequest $core1_stockID){

        $core1_stockID->delete();

        return redirect()->back();
    }
}
