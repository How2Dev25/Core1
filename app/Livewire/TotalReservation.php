<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Reservation;

class TotalReservation extends Component
{

    public $totalreservation;

    public function mount(){
        $this->counttotalreservation();
    }

    public function counttotalreservation(){
        $this->totalreservation = Reservation::count();
    }

    public function render()
    {
        return view('livewire.total-reservation');
    }
}
