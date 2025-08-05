<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lar;

class larController extends Controller
{
    public function store(Request $request){
        $form = $request->validate([
            'roomID' => 'required',
            'loyalty_description' => 'required',
            'loyalty_value' => 'required',
        ]);
        $form['loyalty_status'] = 'Active';

        Lar::create($form);

        session()->flash('Added', 'Loyalty And Reward Has been Added');

        return redirect()->back();
    }

    public function modify (Request $request, Lar $loyaltyID){
         $form = $request->validate([
            'roomID' => 'required',
            'loyalty_description' => 'required',
            'loyalty_value' => 'required',
        ]);

        $loyaltyID->update($form);

         session()->flash('Updated', 'Loyalty And Reward Has been Updated');

         return redirect()->back();

    }

    public function delete(Lar $loyaltyID){

        $loyaltyID->delete();

        session()->flash('Deleted', 'Loyalty And Reward Has been Removed');

        return redirect()->back();

    }

    public function addtoguest(Request $request, Lar $loyaltyID){
       
        
    }

    public function removeloyaltyguest(Lar $loyaltyID){
        
       
    }

    public function expired(Lar $loyaltyID){
        $loyaltyID->update([
            'loyalty_status' => 'Expired',
        ]);

        session()->flash('Expired', 'Loyalty Status Has Been Expired');

        return redirect()->back();
    }
}
