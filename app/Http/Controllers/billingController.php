<?php

namespace App\Http\Controllers;

use App\Models\dynamicBilling;
use Illuminate\Http\Request;

class billingController extends Controller
{
    public function store(Request $request){
           $form = $request->validate([
            'dynamic_name' => 'required',
            'dynamic_price' => 'required',
            'dynamic_billing_description' => 'required',
        ]);

        dynamicBilling::create($form);

        return redirect()->back()->with('success', $form['dynamic_name']. ' Has Been Added');


    }

    public function modify(Request $request, dynamicBilling $dynamic_billingID){
            $form = $request->validate([
            'dynamic_name' => 'required',
            'dynamic_price' => 'required',
            'dynamic_billing_description' => 'required',
        ]);

        $dynamic_billingID->update($form);

        return redirect()->back()->with('success', $form['dynamic_name']. ' Has Been Modified');
    }

}
