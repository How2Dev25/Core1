<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Reservation;

class Reservedrooms extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = '';

    protected $paginationTheme = 'tailwind';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function fetchreservedrooms()
    {
        return Reservation::join('core1_room', 'core1_room.roomID', '=', 'core1_reservation.roomID')
            ->select('core1_reservation.*', 'core1_room.roomtype', 'core1_room.roomprice')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('core1_reservation.guestname', 'like', '%' . $this->search . '%')
                      ->orWhere('core1_room.roomID', 'like', '%' . $this->search . '%')
                      ->orwhere('core1_reservation.bookingID', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->statusFilter, function ($query) {
                $query->where('core1_reservation.reservation_bookingstatus', $this->statusFilter);
            })
            ->latest('core1_reservation.created_at')
            ->paginate(10);
    }

    public function render()
    {
        return view('livewire.reserved-rooms', [
            'reserverooms' => $this->fetchreservedrooms()
        ]);
    }
}
