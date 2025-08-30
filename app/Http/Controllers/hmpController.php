<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hmp;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\AuditTrails;

class hmpController extends Controller
{
    public function createhmp(Request $request){
        $form = $request->validate([
        'hotelpromoname' => 'required',
        'hotelpromotag' => 'required',
        'hotelpromodaterange' => 'required',
        'hotelpromostatus' => 'required',
        'hotelpromodescription' => 'required',
        'hotelpromophoto' => 'nullable',
        ]);

        $filename = time(). '_' . $request->file('hotelpromophoto')->getClientOriginalName();
        $filepath = 'images/hmp/' .$filename;
        $request->file('hotelpromophoto')->move(public_path('images/hmp/'), $filename);

        $form['hotelpromophoto'] = $filepath;

        Hmp::create($form);

          AuditTrails::create([
            'dept_id' => Auth::user()->Dept_id,
            'dept_name' => Auth::user()->dept_name,
            'modules_cover' => 'Hotel Marketing And Promotion',
            'action' => 'Create Marketing Promo',
            'activity' => 'Create Marketing Promo',
            'employee_name' => Auth::user()->employee_name,
            'employee_id' => Auth::user()->employee_id,
            'role' => Auth::user()->role,
            'date' => Carbon::now()->toDateTimeString(),
        ]);


        session()->flash('promoupload', 'Promo ' .$form['hotelpromoname']. ' Has been Added');

        return redirect()->back();
    }

    public function edithmp(Request $request, Hmp $promoID){

        $form = $request->validate([
            'hotelpromoname' => 'nullable',
            'hotelpromotag' => 'nullable',
            'hotelpromodaterange' => 'nullable',
            'hotelpromostatus' => 'nullable',
            'hotelpromodescription' => 'nullable',
            'hotelpromophoto' => 'nullable',
        ]);

        if($request->hasFile('hotelpromophoto')){
            $filename = time(). '_' . $request->file('hotelpromophoto')->getClientOriginalName();
            $filepath = 'images/hmp/' .$filename;
            $request->file('hotelpromophoto')->move(public_path('images/hmp/'), $filename);
            $form['hotelpromophoto'] = $filepath;
        }
        else{
            $form['hotelpromophoto'] = $promoID->hotelpromophoto;
        }

        $promoID->update($form);

          AuditTrails::create([
            'dept_id' => Auth::user()->Dept_id,
            'dept_name' => Auth::user()->dept_name,
            'modules_cover' => 'Hotel Marketing And Promotion',
            'action' => 'Update Marketing Promo',
            'activity' => 'Modify Promo' . $promoID->promoID,
            'employee_name' => Auth::user()->employee_name,
            'employee_id' => Auth::user()->employee_id,
            'role' => Auth::user()->role,
            'date' => Carbon::now()->toDateTimeString(),
        ]);

        session()->flash('promoupdate', $form['hotelpromoname']. ' Has Been Updated');

        return redirect()->back();
    }

    public function deletehmp(Hmp $promoID){
        $promoID->delete();

         AuditTrails::create([
            'dept_id' => Auth::user()->Dept_id,
            'dept_name' => Auth::user()->dept_name,
            'modules_cover' => 'Hotel Marketing And Promotion',
            'action' => 'Remove Marketing Promo',
            'activity' => 'Remove Promo' . $promoID->promoID,
            'employee_name' => Auth::user()->employee_name,
            'employee_id' => Auth::user()->employee_id,
            'role' => Auth::user()->role,
            'date' => Carbon::now()->toDateTimeString(),
        ]);

        session()->flash('promodelete', $promoID->hotelpromoname. ' Has Been Removed');

        return redirect()->back();
    }
   
}
