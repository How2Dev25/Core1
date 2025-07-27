<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Reservation;

class ApproveReserve extends Component
{   
       public $reserverooms = [];
    public $statusFilter = '';
    public $typeFilter = '';
    public $searchTerm = '';

    public function mount()
    {
        $this->approvereserve();
    }

    public function approvereserve()
    {
        $this->reserverooms = Reservation::join('core1_room', 'core1_room.roomID', '=', 'core1_reservation.roomID')
            ->when($this->statusFilter, function($query) {
                return $query->where('reservation_bookingstatus', $this->statusFilter);
            })
            ->when($this->typeFilter, function($query) {
                return $query->where('roomtype', $this->typeFilter);
            })
            ->when($this->searchTerm, function($query) {
                return $query->where(function($q) {
                    $q->where('roomID', 'like', '%'.$this->searchTerm.'%')
                      ->orWhere('guestname', 'like', '%'.$this->searchTerm.'%');
                });
            })
            ->latest('core1_reservation.created_at')
            ->get();
    }

    public function confirmReservation($reservationId)
    {
        // Add your confirmation logic here
        Reservation::where('reservationID', $reservationId)
            ->update(['reservation_bookingstatus' => 'Confirmed']);
        
        $this->approvereserve(); // Refresh the data
    }

    public function render()
    {
        return view('livewire.approve-reserve');
    }
}