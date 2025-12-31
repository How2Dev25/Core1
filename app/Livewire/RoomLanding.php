<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Room;
use App\Models\roomtypes;

class RoomLanding extends Component
{
    use WithPagination;

    public $statusFilter = ''; // Default to show all
    public $typeFilter = '';
    public $searchTerm = '';

    protected $paginationTheme = 'tailwind'; // Optional, for Tailwind pagination

    public function clearFilters()
    {
        $this->statusFilter = '';
        $this->typeFilter = '';
        $this->searchTerm = '';
    }

    public function updating($property)
    {
        // Reset pagination when filters or search change
        if (in_array($property, ['statusFilter', 'typeFilter', 'searchTerm'])) {
            $this->resetPage();
        }
    }

    public function render()
    {
        $allowedRoomTypes = roomtypes::pluck('roomtype_name')->toArray();

        $rooms = Room::query()
            // Filter by status if set
            ->when($this->statusFilter, function ($query) {
                return $query->where('roomstatus', $this->statusFilter);
            })
            // Filter by type if set and valid
            ->when($this->typeFilter && in_array($this->typeFilter, $allowedRoomTypes), function ($query) {
                return $query->where('roomtype', $this->typeFilter);
            })
            // Search by roomID, type, or features
            ->when($this->searchTerm, function ($query) {
                $search = $this->searchTerm;
                $query->where(function ($q) use ($search) {
                    $q->where('roomID', 'like', "%{$search}%")
                      ->orWhere('roomtype', 'like', "%{$search}%")
                      ->orWhere('roomfeatures', 'like', "%{$search}%");
                });
            })
            // Only include rooms that are allowed types
            ->whereIn('roomtype', $allowedRoomTypes)
            ->latest()
            ->paginate(9);

        return view('livewire.room-landing', [
            'rooms' => $rooms,
            'allowedRoomTypes' => $allowedRoomTypes,
        ]);
    }
}
