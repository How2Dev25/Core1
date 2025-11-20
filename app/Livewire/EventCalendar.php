<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Ecm;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EventCalendar extends Component
{
    public $currentMonth;
    public $currentYear;
    public $selectedEventType = '';
    public $selectedStatus = '';
    public $selectedDate = null;
    public $showModal = false;
    public $dayEvents = [];
    public $viewMode = 'month';

    public function mount()
    {
        $this->currentMonth = now()->month;
        $this->currentYear = now()->year;
    }

    public function previousMonth()
    {
        $date = Carbon::create($this->currentYear, $this->currentMonth, 1)->subMonth();
        $this->currentMonth = $date->month;
        $this->currentYear = $date->year;
    }

    public function nextMonth()
    {
        $date = Carbon::create($this->currentYear, $this->currentMonth, 1)->addMonth();
        $this->currentMonth = $date->month;
        $this->currentYear = $date->year;
    }

    public function showDayDetails($date)
    {
        $this->selectedDate = $date;
        
        $this->dayEvents = Ecm::leftJoin('core1_eventtype', 'core1_eventtype.eventtype_ID', '=', 'core1_ecm.eventtype_ID')
            ->whereDate('event_checkin', '<=', $date)
            ->whereDate('event_checkout', '>=', $date)
            ->when($this->selectedEventType, fn($query) =>
                $query->where('core1_ecm.eventtype_ID', $this->selectedEventType)
            )
            ->when($this->selectedStatus, fn($query) =>
                $query->where('eventstatus', $this->selectedStatus)
            )
            ->select(
                'core1_ecm.*',
                'core1_eventtype.eventtype_name',
                'core1_eventtype.eventtype_price'
            )
            ->get();
        
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedDate = null;
        $this->dayEvents = [];
    }

    // Computed properties for the statistics
    public function getMonthNameProperty()
    {
        return Carbon::create($this->currentYear, $this->currentMonth, 1)->format('F Y');
    }

    public function getTotalEventsProperty()
    {
        $startOfMonth = Carbon::create($this->currentYear, $this->currentMonth, 1);
        $endOfMonth = $startOfMonth->copy()->endOfMonth();
        
        return Ecm::whereBetween('event_checkin', [$startOfMonth, $endOfMonth])
            ->orWhereBetween('event_checkout', [$startOfMonth, $endOfMonth])
            ->orWhere(function($query) use ($startOfMonth, $endOfMonth) {
                $query->where('event_checkin', '<=', $startOfMonth)
                      ->where('event_checkout', '>=', $endOfMonth);
            })
            ->when($this->selectedEventType, fn($query) =>
                $query->where('eventtype_ID', $this->selectedEventType)
            )
            ->when($this->selectedStatus, fn($query) =>
                $query->where('eventstatus', $this->selectedStatus)
            )
            ->count();
    }

    public function getConfirmedEventsProperty()
    {
        $startOfMonth = Carbon::create($this->currentYear, $this->currentMonth, 1);
        $endOfMonth = $startOfMonth->copy()->endOfMonth();
        
        return Ecm::where('eventstatus', 'Confirmed')
            ->where(function($query) use ($startOfMonth, $endOfMonth) {
                $query->whereBetween('event_checkin', [$startOfMonth, $endOfMonth])
                      ->orWhereBetween('event_checkout', [$startOfMonth, $endOfMonth])
                      ->orWhere(function($q) use ($startOfMonth, $endOfMonth) {
                          $q->where('event_checkin', '<=', $startOfMonth)
                            ->where('event_checkout', '>=', $endOfMonth);
                      });
            })
            ->when($this->selectedEventType, fn($query) =>
                $query->where('eventtype_ID', $this->selectedEventType)
            )
            ->count();
    }

    public function getPendingEventsProperty()
    {
        $startOfMonth = Carbon::create($this->currentYear, $this->currentMonth, 1);
        $endOfMonth = $startOfMonth->copy()->endOfMonth();
        
        return Ecm::where('eventstatus', 'Pending')
            ->where(function($query) use ($startOfMonth, $endOfMonth) {
                $query->whereBetween('event_checkin', [$startOfMonth, $endOfMonth])
                      ->orWhereBetween('event_checkout', [$startOfMonth, $endOfMonth])
                      ->orWhere(function($q) use ($startOfMonth, $endOfMonth) {
                          $q->where('event_checkin', '<=', $startOfMonth)
                            ->where('event_checkout', '>=', $endOfMonth);
                      });
            })
            ->when($this->selectedEventType, fn($query) =>
                $query->where('eventtype_ID', $this->selectedEventType)
            )
            ->count();
    }

    public function getTotalGuestsProperty()
    {
        $startOfMonth = Carbon::create($this->currentYear, $this->currentMonth, 1);
        $endOfMonth = $startOfMonth->copy()->endOfMonth();
        
        return Ecm::where(function($query) use ($startOfMonth, $endOfMonth) {
                $query->whereBetween('event_checkin', [$startOfMonth, $endOfMonth])
                      ->orWhereBetween('event_checkout', [$startOfMonth, $endOfMonth])
                      ->orWhere(function($q) use ($startOfMonth, $endOfMonth) {
                          $q->where('event_checkin', '<=', $startOfMonth)
                            ->where('event_checkout', '>=', $endOfMonth);
                      });
            })
            ->when($this->selectedEventType, fn($query) =>
                $query->where('eventtype_ID', $this->selectedEventType)
            )
            ->when($this->selectedStatus, fn($query) =>
                $query->where('eventstatus', $this->selectedStatus)
            )
            ->sum('event_numguest');
    }

    public function render()
    {
        // Get event types for filter
        $eventTypes = DB::table('core1_eventtype')
            ->select('eventtype_ID', 'eventtype_name')
            ->get();

        // Get unique statuses
        $statuses = Ecm::select('eventstatus')
            ->distinct()
            ->whereNotNull('eventstatus')
            ->pluck('eventstatus');

        // Create calendar data
        $startOfMonth = Carbon::create($this->currentYear, $this->currentMonth, 1);
        $endOfMonth = $startOfMonth->copy()->endOfMonth();
        
        $calendarStart = $startOfMonth->copy()->startOfWeek(Carbon::SUNDAY);
        $calendarEnd = $endOfMonth->copy()->endOfWeek(Carbon::SATURDAY);

        // Get all events for the month - FIXED TABLE NAME
        $events = Ecm::leftJoin('core1_eventtype', 'core1_eventtype.eventtype_ID', '=', 'core1_ecm.eventtype_ID')
            ->where(function($query) use ($calendarStart, $calendarEnd) {
                $query->whereBetween('event_checkin', [$calendarStart, $calendarEnd])
                      ->orWhereBetween('event_checkout', [$calendarStart, $calendarEnd])
                      ->orWhere(function($q) use ($calendarStart, $calendarEnd) {
                          $q->where('event_checkin', '<=', $calendarStart)
                            ->where('event_checkout', '>=', $calendarEnd);
                      });
            })
            ->when($this->selectedEventType, fn($query) =>
                $query->where('core1_ecm.eventtype_ID', $this->selectedEventType)
            )
            ->when($this->selectedStatus, fn($query) =>
                $query->where('eventstatus', $this->selectedStatus)
            )
            ->select(
                'core1_ecm.eventbookingID',
                'core1_ecm.event_checkin',
                'core1_ecm.event_checkout',
                'core1_ecm.event_name',
                'core1_ecm.eventorganizer_name',
                'core1_ecm.eventstatus',
                'core1_ecm.event_numguest',
                'core1_eventtype.eventtype_name' // FIXED: Added table prefix
            )
            ->get();

        // Build calendar grid
        $calendar = [];
        $currentDate = $calendarStart->copy();
        
        while ($currentDate <= $calendarEnd) {
            $week = [];
            for ($i = 0; $i < 7; $i++) {
                $dateStr = $currentDate->format('Y-m-d');
                
                $dayEvents = $events->filter(function($event) use ($dateStr) {
                    return $dateStr >= $event->event_checkin 
                        && $dateStr <= $event->event_checkout;
                });

                $week[] = [
                    'date' => $currentDate->copy(),
                    'isCurrentMonth' => $currentDate->month == $this->currentMonth,
                    'isToday' => $currentDate->isToday(),
                    'eventCount' => $dayEvents->count(),
                    'hasEventStart' => $dayEvents->where('event_checkin', $dateStr)->count(),
                    'hasEventEnd' => $dayEvents->where('event_checkout', $dateStr)->count(),
                    'statuses' => $dayEvents->pluck('eventstatus')->unique()->toArray(),
                    'eventNames' => $dayEvents->take(2)->pluck('event_name')->toArray(),
                ];
                
                $currentDate->addDay();
            }
            $calendar[] = $week;
        }

        return view('livewire.event-calendar', [
            'calendar' => $calendar,
            'eventTypes' => $eventTypes,
            'statuses' => $statuses,
            'monthName' => $this->monthName,
            'totalEvents' => $this->totalEvents,
            'confirmedEvents' => $this->confirmedEvents,
            'pendingEvents' => $this->pendingEvents,
            'totalGuests' => $this->totalGuests,
        ]);
    }
}