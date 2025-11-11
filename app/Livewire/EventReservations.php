<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Ecm;
use App\Models\dynamicBilling;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EventReservations extends Component
{   
    use WithPagination;

    public $statusFilter = '';
    public $typeFilter = '';
    public $searchTerm = '';

    // Reset pagination whenever filters/search change
    public function updated($propertyName)
    {
        if (in_array($propertyName, ['statusFilter', 'typeFilter', 'searchTerm'])) {
            $this->resetPage();
        }
    }



    public function render()
    {
        // Fetch Event Reservations
        $reservations = Ecm::join('core1_eventtype', 'core1_eventtype.eventtype_ID', '=', 'core1_ecm.eventtype_ID')
            ->when($this->statusFilter, function($query) {
                return $query->where('core1_ecm.eventstatus', $this->statusFilter);
            })
            ->when($this->typeFilter, function($query) {
                return $query->where('core1_eventtype.eventtype_name', $this->typeFilter);
            })
            ->when($this->searchTerm, function($query) {
                return $query->where(function($q) {
                    $q->where('core1_ecm.event_name', 'like', '%'.$this->searchTerm.'%')
                      ->orWhere('core1_ecm.eventorganizer_name', 'like', '%'.$this->searchTerm.'%')
                      ->orWhere('core1_ecm.event_bookingreceiptID', 'like', '%'.$this->searchTerm.'%');
                });
            })
            ->select(
                'core1_ecm.*',
                'core1_eventtype.eventtype_name',
                'core1_eventtype.eventtype_photo',
                'core1_eventtype.eventtype_price'
            )
            ->latest('core1_ecm.created_at')
            ->paginate(10);

        // Get dynamic billing rates if needed for future enhancements
        $servicefee2 = dynamicBilling::where('dynamic_name', 'Service Fee')->value('dynamic_price');
        $taxrate2 = dynamicBilling::where('dynamic_name', 'Tax Rate')->value('dynamic_price');

        $serviceFeedynamic = rtrim(rtrim(number_format($servicefee2, 2), '0'), '.') . '%';
        $taxRatedynamic = rtrim(rtrim(number_format($taxrate2, 2), '0'), '.') . '%';

        return view('livewire.event-reservations', [
            'reservations' => $reservations,
            'serviceFeedynamic' => $serviceFeedynamic,
            'taxRatedynamic' => $taxRatedynamic,
        ]);
    }
}