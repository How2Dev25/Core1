<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\room;

class OccupiedRooms extends Component
{

    public $occupiedrooms;

    public function mount(){
        $this->countoccupiedrooms();
    }

    public function countoccupiedrooms(){
        $this->occupiedrooms = room::where('roomstatus', 'Occupied')->count();
    }
    public function render()
    {
        return view('livewire.occupied-rooms');
    }
}
