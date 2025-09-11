<?php

namespace App\Http\Controllers;

use App\Models\ordersfromresto;
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

   public function confirmorder()
{
    $myorders = restoCart::where('guestID', Auth::guard('guest')->user()->guestID)->get();

    foreach ($myorders as $orders) {
        ordersfromresto::create([
            'menuID'            => $orders->menuID,
            'bookingID'         => $orders->bookingID,
            'order_quantity'    => $orders->order_quantity,
            'order_status'      => $orders->order_status,
            'guestID'           => $orders->guestID,
            'orderguest_name'   => $orders->orderguest_name,
            'orderguest_email'  => $orders->orderguest_email,
            'orderguest_contact'=> $orders->orderguest_contact,
        ]);
    }

    // After creating orders, delete them from the cart
    foreach ($myorders as $orders) {
        $orders->delete();
    }

    return redirect()->back()->with('success', 'Success we received your order.');
}


}
