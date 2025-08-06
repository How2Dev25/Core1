<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lar;
use App\Models\Glar;

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

   public function addtoguest(Request $request, $loyaltyID)
{
    $request->validate([
        'guestID' => 'nullable|integer',
        'guestemail' => 'nullable|email',
    ]);

    Glar::create([
        'guestID' => $request->guestID, // use correct casing
        'guestemail' => $request->guestemail,
        'loyaltyID' => $loyaltyID,
    ]);

    return redirect()->back();
}

    public function removeloyaltyguest(Lar $loyaltyID){
        
       
    }

    public function expired(Lar $loyaltyID){
        $loyaltyID->update([
            'loyalty_status' => 'Expired',
        ]);

        session()->flash('Expired', 'Loyalty Status Has Been Set to Expired');

        return redirect()->back();
    }
}
