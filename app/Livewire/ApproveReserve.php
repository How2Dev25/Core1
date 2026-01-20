<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Reservation;
use App\Models\dynamicBilling;
use Illuminate\Support\Facades\DB;

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
