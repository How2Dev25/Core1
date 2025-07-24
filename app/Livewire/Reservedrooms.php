<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Reservation;


class Reservedrooms extends Component
{

    public $reserverooms = [];

    public function mount(){
        $this->fetchreservedrooms();
    }

    public function fetchreservedrooms(){
        $this->reserverooms = Reservation::join('core1_room', 'core1_room.roomID', '=', 'core1_reservation.roomID')
        ->latest('core1_reservation.created_at')
        ->get();
    }
    public function render()
    {
        return view('livewire.reserved-rooms');
    }
}
