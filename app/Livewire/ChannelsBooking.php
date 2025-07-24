<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Reservation;

class ChannelsBooking extends Component
{

    public $channelsbooking;

     public function mount(){
        $this->countchannelbooking();
     }

     public function countchannelbooking(){
        $this->channelsbooking = Reservation::where('bookedvia', '!=', 'Soliera')->count();
     }
    public function render()
    {
        return view('livewire.channels-booking');
    }
}
