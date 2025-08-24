<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\room;

class RoomLanding extends Component
{
       public $statusFilter = 'Available'; // Default to showing available rooms
    public $typeFilter = '';
    public $searchTerm = '';

    public function render()
    {
        $rooms = Room::query()
            ->when($this->statusFilter, function($query) {
                return $query->where('roomstatus', $this->statusFilter);
            })
            ->when($this->typeFilter, function($query) {
                return $query->where('roomtype', $this->typeFilter);
            })
            ->when($this->searchTerm, function($query) {
                return $query->where(function($q) {
                    $q->where('roomID', 'like', '%'.$this->searchTerm.'%')
                      ->orWhere('roomfeatures', 'like', '%'.$this->searchTerm.'%');
                });
            })
            ->latest()
            ->get();

        return view('livewire.room-landing', [
            'rooms' => $rooms
        ]);
    }
}
