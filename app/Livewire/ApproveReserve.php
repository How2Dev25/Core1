<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Reservation;

class ApproveReserve extends Component
{

   public $reserverooms = [];

   public function mount(){
        $this->approvereserve();
   }

   public function approvereserve(){
      $this->reserverooms = Reservation::join('core1_room', 'core1_room.roomID', '=', 'core1_reservation.roomID')
        ->latest('core1_reservation.created_at')
        ->get();
   }
    
    public function render()
    {
        return view('livewire.approve-reserve');
    }
}
