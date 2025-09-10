<?php

namespace App\Http\Controllers;

use App\Models\restoCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class orderController extends Controller
{
    public function addtocart(Request $request){
        $form = $request->validate([
            'menuID' => 'required',
            'bookingID' => 'required',
            'order_quantity' => 'required',
            'orderguest_name' => 'required',
            'orderguest_email' => 'required',
            'orderguest_contact' => 'required',
        ]);

        $form['guestID'] = Auth::guard('guest')->user()->guestID;

        restoCart::create($form);

        return redirect()->back()->with('success', 'Order Added');
    }

    public function deletefromcart(restoCart $cartID){

        $cartID->delete();

        return redirect()->back()->with('success', 'Order Removed');
    }
}
