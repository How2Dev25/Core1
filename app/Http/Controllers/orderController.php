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
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;

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

public function confirmorder(Request $request)
{
    $guestID = Auth::guard('guest')->user()->guestID;
    $paymentOption = $request->input('payment_option', 'checkout'); // Default to checkout

    $myorders = restoCart::where('guestID', $guestID)->get();

    if ($myorders->isEmpty()) {
        return redirect()->back()->with('error', 'Your cart is empty.');
    }

    // Calculate total amount
    $totalAmount = 0;
    $orderItems = [];
    
    foreach ($myorders as $order) {
        $menu = restointegration::where('menuID', $order->menuID)->first();
        $itemTotal = $order->order_quantity * $menu->menu_price;
        $totalAmount += $itemTotal;
        
        $orderItems[] = [
            'menuID' => $order->menuID,
            'menu_name' => $menu->menu_name,
            'quantity' => $order->order_quantity,
            'price' => $menu->menu_price,
            'total' => $itemTotal
        ];
    }

    // If payment option is "now", redirect to Stripe
    if ($paymentOption === 'now') {
        return $this->createStripeCheckout($orderItems, $totalAmount, $myorders);
    }

    // Otherwise, proceed with normal checkout flow
    return $this->processOrder($myorders, 'Pay at Checkout');
}

/**
 * Create Stripe checkout session for restaurant orders
 */
private function createStripeCheckout($orderItems, $totalAmount, $myorders)
{
    \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

    // Store order data in session for post-payment processing
    session(['restaurant_order_data' => [
        'items' => $orderItems,
        'total_amount' => $totalAmount,
        'orders' => $myorders->toArray()
    ]]);

    // Prepare line items for Stripe
    $lineItems = [];
    foreach ($orderItems as $item) {
        $lineItems[] = [
            'price_data' => [
                'currency' => 'php',
                'product_data' => [
                    'name' => $item['menu_name'],
                    'description' => 'Restaurant order - ' . $item['quantity'] . 'x ' . $item['menu_name'],
                ],
                'unit_amount' => $item['price'] * 100, // Convert to cents
            ],
            'quantity' => $item['quantity'],
        ];
    }

    try {
        $checkout_session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('restaurant.payment.success'),
            'cancel_url' => route('restaurant.payment.cancel'),
            'customer_email' => Auth::guard('guest')->user()->guestemailaddress,
            'metadata' => [
                'guest_id' => Auth::guard('guest')->user()->guestID,
                'order_type' => 'restaurant'
            ]
        ]);

        return redirect($checkout_session->url);
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Payment processing failed: ' . $e->getMessage());
    }
}

/**
 * Process order normally (for checkout payment)
 */
private function processOrder($myorders, $paymentStatus)
{
    DB::transaction(function () use ($myorders, $paymentStatus) {
        foreach ($myorders as $order) {
            // Handle both object and array formats
            $menuID = is_object($order) ? $order->menuID : $order['menuID'];
            $bookingID = is_object($order) ? $order->bookingID : $order['bookingID'];
            $orderQuantity = is_object($order) ? $order->order_quantity : $order['order_quantity'];
            $guestID = is_object($order) ? $order->guestID : $order['guestID'];
            $orderguestName = is_object($order) ? $order->orderguest_name : $order['orderguest_name'];
            $orderguestEmail = is_object($order) ? $order->orderguest_email : $order['orderguest_email'];
            $orderguestContact = is_object($order) ? $order->orderguest_contact : $order['orderguest_contact'];
            
            $getroom = Reservation::where('bookingID', $bookingID)
                ->value('roomID');

            $foodname = restointegration::where('menuID', $menuID)
                ->value('menu_name');

            $ordersfromresto = ordersfromresto::create([
                'menuID'             => $menuID,
                'bookingID'          => $bookingID,
                'order_quantity'     => $orderQuantity,
                'order_status'       => 'Pending', // Will be updated to "Delivered" when ready
                'payment_resto_status' => $paymentStatus === 'Paid' ? 'Paid' : 'Pending',
                'payment_method'     => $paymentStatus === 'Paid' ? 'Online Payment' : 'Pay at Checkout',
                'payment_date'       => $paymentStatus === 'Paid' ? now() : null,
                'transaction_ref'    => $paymentStatus === 'Paid' ? 'REST-' . time() . '-' . $menuID : null,
                'guestID'            => $guestID,
                'orderguest_name'    => $orderguestName,
                'orderguest_email'   => $orderguestEmail,
                'orderguest_contact' => $orderguestContact,
            ]);

            kotresto::create([
                'table_number' => 'Room# ' . $getroom,
                'order_id'     => $ordersfromresto->orderID,
                'item_name'    => $foodname,
                'quantity'     => $orderQuantity,
                'status'       => 'Pending',
                'menu_id'      => $menuID
            ]);
        }

        // Clear cart AFTER everything succeeds
        restoCart::where('guestID', Auth::guard('guest')->user()->guestID)->delete();
    });

    $message = $paymentStatus === 'Paid' ? 
        'Payment successful! Your order has been confirmed.' : 
        'Success! Your order will be charged at checkout.';
    
    return redirect('/recentorders')->with('success', $message);
}
public function cancelorder($orderID){
   
    ordersfromresto::where('orderID', $orderID)->delete();
    kotresto::where('order_id', $orderID)->delete();


    return redirect()->back()->with('success', 'Order Has Been Cancelled');
}

/**
 * Handle successful Stripe payment for restaurant orders
 */
public function paymentSuccess(Request $request)
{
    Stripe::setApiKey(env('STRIPE_SECRET'));
    
    $orderData = session('restaurant_order_data');
    
    if (!$orderData) {
        return redirect()->route('ordercart')->with('error', 'Order data not found.');
    }

    // Process the order with paid status
    $myorders = collect($orderData['orders']);
    $result = $this->processOrder($myorders, 'Paid');

    // Clear session
    session()->forget('restaurant_order_data');

    return redirect('/recentorders')->with('success', 'Payment successful! Your order has been confirmed.');
}

/**
 * Handle cancelled Stripe payment
 */
public function paymentCancel(Request $request)
{
    session()->forget('restaurant_order_data');
    
    return redirect()->route('ordercart')->with('error', 'Payment was cancelled. Your order is still in your cart.');
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

/**
 * Mark restaurant order as paid (manual payment)
 */
public function markAsPaid($orderID)
{
    try {
        // Update the order status to Paid
        $updated = ordersfromresto::where('orderID', $orderID)->update([
            'payment_resto_status' => 'Paid',
            'payment_method' => 'Manual Payment',
            'payment_date' => now(),
            'transaction_ref' => 'MANUAL-' . time() . '-' . $orderID,
            'updated_at' => now()
        ]);

        if ($updated) {
            // Also update KOT status if needed
            kotresto::where('order_id', $orderID)->update([
                'payment_status' => 'Paid',
                'updated_at' => now()
            ]);

            return redirect()->back()->with('success', "Order #{$orderID} marked as paid successfully!");
        } else {
            return redirect()->back()->with('error', "Failed to update order #{$orderID}");
        }
    } catch (\Exception $e) {
        Log::error('Error marking order as paid: ' . $e->getMessage());
        return redirect()->back()->with('error', "Error: " . $e->getMessage());
    }
}


}
