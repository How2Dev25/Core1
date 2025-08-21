<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Room;

class RoomDisplay extends Component
{
    use WithPagination;

    public $category = '';
    public $search = '';

    protected $paginationTheme = 'tailwind';

    // Reset pagination when filters change
    public function updatingCategory() { $this->resetPage(); }
    public function updatingSearch() { $this->resetPage(); }

    public function render()
    {
        $rooms = Room::query()
            ->where('roomstatus', 'Available') // ✅ only fetch available rooms
            ->when($this->category, fn($q, $category) => 
                $q->where('roomtype', $category)
            )
            ->when($this->search, function ($q, $search) {
                $q->where(function ($query) use ($search) {
                    $query->where('roomID', 'like', "%{$search}%")
                          ->orWhere('roomfeatures', 'like', "%{$search}%");
                });
            })
            ->orderBy('roomID', 'asc')
            ->paginate(6);

        return view('livewire.room-display', compact('rooms'));
    }
}
