<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lar;
use App\Models\Glar;
use App\Models\AuditTrails;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
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

           AuditTrails::create([
            'dept_id' => Auth::user()->Dept_id,
            'dept_name' => Auth::user()->dept_name,
            'modules_cover' => 'Loyalty And Rewards',
            'action' => 'Added Rewards',
            'activity' => 'Added Rewards',
            'employee_name' => Auth::user()->employee_name,
            'employee_id' => Auth::user()->employee_id,
            'role' => Auth::user()->role,
            'date' => Carbon::now()->toDateTimeString(),
        ]);


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

        AuditTrails::create([
            'dept_id' => Auth::user()->Dept_id,
            'dept_name' => Auth::user()->dept_name,
            'modules_cover' => 'Loyalty And Rewards',
            'action' => 'Modify Rewards',
            'activity' => ' Modify Loyalty Rewards ' .$loyaltyID->loyaltyID,
            'employee_name' => Auth::user()->employee_name,
            'employee_id' => Auth::user()->employee_id,
            'role' => Auth::user()->role,
            'date' => Carbon::now()->toDateTimeString(),
        ]);

         session()->flash('Updated', 'Loyalty And Reward Has been Updated');

         return redirect()->back();

    }

    public function delete(Lar $loyaltyID){

        $loyaltyID->delete();

        AuditTrails::create([
            'dept_id' => Auth::user()->Dept_id,
            'dept_name' => Auth::user()->dept_name,
            'modules_cover' => 'Loyalty And Rewards',
            'action' => 'Remove Reward',
            'activity' => 'Remove Loyalty Rewards ' .$loyaltyID->loyaltyID,
            'employee_name' => Auth::user()->employee_name,
            'employee_id' => Auth::user()->employee_id,
            'role' => Auth::user()->role,
            'date' => Carbon::now()->toDateTimeString(),
        ]);


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

          AuditTrails::create([
            'dept_id' => Auth::user()->Dept_id,
            'dept_name' => Auth::user()->dept_name,
            'modules_cover' => 'Loyalty And Rewards',
            'action' => 'Expire Reward',
            'activity' => 'Expire Loyalty Rewards ' .$loyaltyID->loyaltyID,
            'employee_name' => Auth::user()->employee_name,
            'employee_id' => Auth::user()->employee_id,
            'role' => Auth::user()->role,
            'date' => Carbon::now()->toDateTimeString(),
        ]);

        session()->flash('Expired', 'Loyalty Status Has Been Set to Expired');

        return redirect()->back();
    }
}
