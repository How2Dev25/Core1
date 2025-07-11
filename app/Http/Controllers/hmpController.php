<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hmp;

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

        session()->flash('promoupdate', $form['hotelpromoname']. ' Has Been Updated');

        return redirect()->back();
    }

    public function deletehmp(Hmp $promoID){
        $promoID->delete();

        session()->flash('promodelete', $promoID->hotelpromoname. ' Has Been Removed');

        return redirect()->back();
    }
   
}
