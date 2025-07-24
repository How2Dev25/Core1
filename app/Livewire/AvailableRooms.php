<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\room;

class AvailableRooms extends Component
{

    public $availablerooms;

    public function mount(){
        $this->countavailablerooms();
    }

    public function countavailablerooms(){
        $this->availablerooms = room::where('roomstatus', 'Available')->count();
    }
    public function render()
    {
        return view('livewire.available-rooms');
    }
}
