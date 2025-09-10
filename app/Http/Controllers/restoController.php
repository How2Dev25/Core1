<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\restointegration;

class restoController extends Controller
{
    // for creation of menu

    public function store(Request $request){
        $form = $request->validate([
            'menu_name' => 'required',
            'menu_description' => 'required',
            'menu_photo' => 'required',
            'menu_price' => 'required',
            
        ]);

        $form['menu_status'] = "Available";

        $filename = time() . '_' . $request->file('menu_photo')->getClientOriginalName();
        $filepath = 'images/resto/' .$filename;
        $request->file('menu_photo')->move(public_path('images/resto/'), $filename);
        $form['menu_photo'] = $filepath;

        restointegration::create($form);

        return redirect()->back()->with('success', 'Menu Has Been Added');
    }


     public function modify(Request $request, restointegration $menuID){
        $form = $request->validate([
            'menu_name' => 'nullable',
            'menu_description' => 'nullable',
            'menu_photo' => 'nullable',
            'menu_price' => 'nullable',
           
        ]);


        if($request->has('menu_photo')){
            $filename = time() . '_' . $request->file('menu_photo')->getClientOriginalName();
            $filepath = 'images/resto/' .$filename;
            $request->file('menu_photo')->move(public_path('images/resto/'), $filename);
            $form['menu_photo'] = $filepath;
        }
        else{
            $form['menu_photo'] = $menuID->menu_photo;
        }
       
        $menuID->update($form);

        return redirect()->back()->with('success', 'Menu Has Been Modified');
    }


    public function delete(restointegration $menuID){

        $menuID->delete();

        return redirect()->back()->with('success', 'Menu Has Been Removed');

    }
}
