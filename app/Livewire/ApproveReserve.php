<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Reservation;

class ApproveReserve extends Component
{   
    use WithPagination;

    public $statusFilter = '';
    public $typeFilter = '';
    public $searchTerm = '';

    // Reset pagination whenever filters/search change
    public function updated($propertyName)
    {
        if (in_array($propertyName, ['statusFilter', 'typeFilter', 'searchTerm'])) {
            $this->resetPage();
        }
    }

    public function render()
    {
        $reserverooms = Reservation::join('core1_room', 'core1_room.roomID', '=', 'core1_reservation.roomID')
            ->when($this->statusFilter, fn($query) =>
                $query->where('reservation_bookingstatus', $this->statusFilter)
            )
            ->when($this->typeFilter, fn($query) =>
                $query->where('roomtype', $this->typeFilter)
            )
            ->when($this->searchTerm, fn($query) =>
                $query->where(function($q) {
                    $q->where('core1_reservation.reservation_receipt', 'like', '%'.$this->searchTerm.'%')
                      ->orWhere('core1_reservation.guestname', 'like', '%'.$this->searchTerm.'%');
                })
            )
            ->select('core1_reservation.*', 'core1_room.roomtype', 'core1_room.roomID') // make sure we fetch columns
            ->latest('core1_reservation.created_at')
            ->paginate(5);

        return view('livewire.approve-reserve', compact('reserverooms'));
    }
}
