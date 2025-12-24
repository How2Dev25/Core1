<?php

namespace App\Http\Controllers;

use App\Models\kotresto;
use App\Models\ordersfromresto;
use App\Models\Reservation;
use App\Models\restoCart;
use App\Models\restointegration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
    $guestID = Auth::guard('guest')->user()->guestID;

    $myorders = restoCart::where('guestID', $guestID)->get();

    if ($myorders->isEmpty()) {
        return redirect()->back()->with('error', 'Your cart is empty.');
    }

    DB::transaction(function () use ($myorders) {

        foreach ($myorders as $order) {

            $getroom = Reservation::where('bookingID', $order->bookingID)
                ->value('roomID');

            $foodname = restointegration::where('menuID', $order->menuID)
                ->value('menu_name');

            $ordersfromresto = ordersfromresto::create([
                'menuID'             => $order->menuID,
                'bookingID'          => $order->bookingID,
                'order_quantity'     => $order->order_quantity,
                'order_status'       => $order->order_status,
                'guestID'            => $order->guestID,
                'orderguest_name'    => $order->orderguest_name,
                'orderguest_email'   => $order->orderguest_email,
                'orderguest_contact' => $order->orderguest_contact,
            ]);

            kotresto::create([
                'table_number' => 'Room# ' . $getroom,
                'order_id'     => $ordersfromresto->orderID,
                'item_name'    => $foodname,
                'quantity'     => $order->order_quantity,
                'status'       => 'Pending',
                'menu_id'      => $order->menuID
            ]);
        }

        // Clear cart AFTER everything succeeds
        restoCart::where('guestID', Auth::guard('guest')->user()->guestID)->delete();
    });

    return redirect()->back()->with('success', 'Success! We received your order.');
}
public function cancelorder($orderID){
   
    ordersfromresto::where('orderID', $orderID)->delete();
    kotresto::where('order_id', $orderID)->delete();


    return redirect()->back()->with('success', 'Order Has Been Cancelled');
}

public function delivered($orderID){
     ordersfromresto::where('orderID', $orderID)->update([
        'order_status' => 'Delivered',
     ]);

    kotresto::where('order_id', $orderID)->update([
        'status' => 'Delivered',
    ]);


    return redirect()->back()->with('success', 'Order Has Been Delivered');
}


}
