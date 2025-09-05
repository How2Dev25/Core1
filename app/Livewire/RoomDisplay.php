<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\room;
use Illuminate\Support\Facades\DB;

class RoomDisplay extends Component
{
    use WithPagination;

    public $category = '';
    public $search = '';
    public $sortBy = 'roomID';
    public $sortDirection = 'asc';
    public $priceRange = '';
    public $maxGuests = '';
    public $showSuggested = false;

    protected $paginationTheme = 'tailwind';

    // Reset pagination when filters change
    public function updatingCategory() { $this->resetPage(); }
    public function updatingSearch() { $this->resetPage(); }
    public function updatingSortBy() { $this->resetPage(); }
    public function updatingPriceRange() { $this->resetPage(); }
    public function updatingMaxGuests() { $this->resetPage(); }

    public function toggleSort($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->category = '';
        $this->search = '';
        $this->priceRange = '';
        $this->maxGuests = '';
        $this->sortBy = 'roomID';
        $this->sortDirection = 'asc';
        $this->resetPage();
    }

    public function toggleSuggested()
    {
        $this->showSuggested = !$this->showSuggested;
    }

    public function render()
    {
        $query = room::query()->where('roomstatus', 'Available');

        // Category filter
        if ($this->category) {
            $query->where('roomtype', $this->category);
        }

        // Search filter
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('roomID', 'like', "%{$this->search}%")
                  ->orWhere('roomfeatures', 'like', "%{$this->search}%")
                  ->orWhere('roomtype', 'like', "%{$this->search}%");
            });
        }

        // Price range filter
        if ($this->priceRange) {
            switch ($this->priceRange) {
                case 'under-2000':
                    $query->where('roomprice', '<', 2000);
                    break;
                case '2000-5000':
                    $query->whereBetween('roomprice', [2000, 5000]);
                    break;
                case '5000-10000':
                    $query->whereBetween('roomprice', [5000, 10000]);
                    break;
                case 'over-10000':
                    $query->where('roomprice', '>', 10000);
                    break;
            }
        }

        // Max guests filter
        if ($this->maxGuests) {
            $query->where('roommaxguest', '>=', $this->maxGuests);
        }

        // Sorting
        $query->orderBy($this->sortBy, $this->sortDirection);

        $rooms = $query->paginate(6);

        // Get suggested rooms (random selection)
        $suggestedRooms = room::where('roomstatus', 'Available')
            ->inRandomOrder()
            ->take(3)
            ->get();

        // Get filter stats
        $stats = [
            'total_available' => room::where('roomstatus', 'Available')->count(),
            'categories' => room::where('roomstatus', 'Available')
                ->select('roomtype', DB::raw('count(*) as count'))
                ->groupBy('roomtype')
                ->get(),
            'price_range' => [
                'min' => room::where('roomstatus', 'Available')->min('roomprice'),
                'max' => room::where('roomstatus', 'Available')->max('roomprice')
            ]
        ];

        return view('livewire.room-display', compact('rooms', 'suggestedRooms', 'stats'));
    }
}