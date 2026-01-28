<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Reservation;
use App\Models\dynamicBilling;
use App\Models\restobillingandpayments;
use App\Models\kotresto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ApproveReserve extends Component
{   
    use WithPagination;

    public $statusFilter = '';
    public $typeFilter = '';
    public $searchTerm = '';
    public $paymentFilter = '';

    // Reset pagination whenever filters/search change
    public function updated($propertyName)
    {
      if (in_array($propertyName, ['statusFilter', 'typeFilter', 'searchTerm', 'paymentFilter'])) {
    $this->resetPage();
}
    }

    public function render()
    {
        // Fetch Reservations with Rooms
        $reserverooms = Reservation::join('core1_room', 'core1_room.roomID', '=', 'core1_reservation.roomID')
            ->when($this->statusFilter, fn($query) =>
                $query->where('reservation_bookingstatus', $this->statusFilter)
            )
            ->when($this->typeFilter, fn($query) =>
                $query->where('roomtype', $this->typeFilter)
            )
            ->when($this->searchTerm, fn($query) =>
                $query->where(function($q) {
                    $q->where('core1_reservation.bookingID', 'like', '%'.$this->searchTerm.'%')
                      ->orWhere('core1_reservation.guestname', 'like', '%'.$this->searchTerm.'%');
                })
            )
            ->when($this->paymentFilter, fn($query) =>
                 $query->where('payment_status', $this->paymentFilter)
            )

            ->select('core1_reservation.*', 'core1_room.roomtype', 'core1_room.roomID', 'core1_room.roomprice', 'core1_room.roomphoto')
            ->latest('core1_reservation.created_at')
            ->paginate(5);

        // Attach restaurant billing data to each reservation
        foreach ($reserverooms as $reservation) {
            // Get restaurant orders from orderfromresto table linked by bookingID
            $reservation->restaurant_orders = DB::table('orderfromresto')
                ->join('resto_integration', 'resto_integration.menuID', '=', 'orderfromresto.menuID')
                ->select(
                    'orderfromresto.*',
                    'resto_integration.menu_name as description',
                    'resto_integration.menu_price as unit_price',
                    'resto_integration.menu_photo'
                )
                ->where('orderfromresto.bookingID', $reservation->bookingID)
                ->orderBy('orderfromresto.created_at', 'desc')
                ->get()
                ->map(function($order) {
                    // Debug: Let's see what properties we have
                    $price = $order->unit_price ?? $order->price ?? 0;
                    $quantity = $order->quantity ?? $order->order_quantity ?? 1;
                    
                    // Map to the expected format for the view
                    return (object)[
                        'BP_id' => $order->orderID,
                        'description' => $order->description,
                        'quantity' => $quantity,
                        'unit_price' => $price,
                        'total_amount' => $quantity * $price,
                        'invoice_number' => $order->invoice_number ?? 'BKG-' . $order->bookingID,
                        'payment_resto_status' => $order->payment_resto_status ?? 'Pending', // Use the new field
                        'payment_date' => $order->payment_date ?? null,
                        'menu_photo' => $order->menu_photo
                    ];
                });
        }

        // Fetch Orders from resto + menu for each bookingID
        $orders = DB::table('orderfromresto')
            ->join('resto_integration', 'resto_integration.menuID', '=', 'orderfromresto.menuID')
            ->select(
                'orderfromresto.*',
                'resto_integration.menu_name',
                'resto_integration.menu_description',
                'resto_integration.menu_photo',
                'resto_integration.menu_price'
            )
            ->whereIn('orderfromresto.bookingID', $reserverooms->pluck('bookingID')) // only for those bookings
            ->where('orderfromresto.order_status', 'Delivered')
            ->get()
            ->groupBy('bookingID'); // group so you can easily show per booking

            $servicefee2 = dynamicBilling::where('dynamic_name', 'Service Fee')->value('dynamic_price');
            $taxrate2 = dynamicBilling::where('dynamic_name', 'Tax Rate')->value('dynamic_price');

            $serviceFeedynamic = rtrim(rtrim(number_format($servicefee2, 2), '0'), '.') . '%';
            $taxRatedynamic = rtrim(rtrim(number_format($taxrate2, 2), '0'), '.') . '%';

        return view('livewire.approve-reserve', [
            'reserverooms' => $reserverooms,
            'orders' => $orders,
            'serviceFeedynamic' => $serviceFeedynamic,
            'taxRatedynamic' => $taxRatedynamic,
        ]);
    }

  


}
