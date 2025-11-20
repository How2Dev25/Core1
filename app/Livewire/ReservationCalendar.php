<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReservationCalendar extends Component
{
    public $currentMonth;
    public $currentYear;
    public $selectedRoomType = '';
    public $selectedDate = null;
    public $showModal = false;
    public $dayReservations = [];

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
        
        // Get all reservations for this specific date
        $this->dayReservations = Reservation::join('core1_room', 'core1_room.roomID', '=', 'core1_reservation.roomID')
            ->whereDate('reservation_checkin', '<=', $date)
            ->whereDate('reservation_checkout', '>=', $date)
            ->when($this->selectedRoomType, fn($query) =>
                $query->where('roomtype', $this->selectedRoomType)
            )
            ->select(
                'core1_reservation.*',
                'core1_room.roomtype',
                'core1_room.roomID',
                'core1_room.roomprice'
            )
            ->get();
        
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedDate = null;
        $this->dayReservations = [];
    }

    public function render()
    {
        // Get room types for filter
        $roomTypes = DB::table('core1_room')
            ->select('roomtype')
            ->distinct()
            ->get();

        // Create calendar data
        $startOfMonth = Carbon::create($this->currentYear, $this->currentMonth, 1);
        $endOfMonth = $startOfMonth->copy()->endOfMonth();
        
        // Start from Sunday of the week containing the 1st
        $calendarStart = $startOfMonth->copy()->startOfWeek(Carbon::SUNDAY);
        $calendarEnd = $endOfMonth->copy()->endOfWeek(Carbon::SATURDAY);

        // Get all reservations for the month
        $reservations = Reservation::join('core1_room', 'core1_room.roomID', '=', 'core1_reservation.roomID')
            ->where(function($query) use ($calendarStart, $calendarEnd) {
                $query->whereBetween('reservation_checkin', [$calendarStart, $calendarEnd])
                      ->orWhereBetween('reservation_checkout', [$calendarStart, $calendarEnd])
                      ->orWhere(function($q) use ($calendarStart, $calendarEnd) {
                          $q->where('reservation_checkin', '<=', $calendarStart)
                            ->where('reservation_checkout', '>=', $calendarEnd);
                      });
            })
            ->when($this->selectedRoomType, fn($query) =>
                $query->where('roomtype', $this->selectedRoomType)
            )
            ->select(
                'core1_reservation.bookingID',
                'core1_reservation.reservation_checkin',
                'core1_reservation.reservation_checkout',
                'core1_reservation.guestname',
                'core1_reservation.reservation_bookingstatus',
                'core1_room.roomtype'
            )
            ->get();

        // Build calendar grid
        $calendar = [];
        $currentDate = $calendarStart->copy();
        
        while ($currentDate <= $calendarEnd) {
            $week = [];
            for ($i = 0; $i < 7; $i++) {
                $dateStr = $currentDate->format('Y-m-d');
                
                // Count reservations for this day
                $dayReservations = $reservations->filter(function($reservation) use ($dateStr) {
                    return $dateStr >= $reservation->reservation_checkin 
                        && $dateStr <= $reservation->reservation_checkout;
                });

                $week[] = [
                    'date' => $currentDate->copy(),
                    'isCurrentMonth' => $currentDate->month == $this->currentMonth,
                    'isToday' => $currentDate->isToday(),
                    'reservationCount' => $dayReservations->count(),
                    'hasCheckIn' => $dayReservations->where('reservation_checkin', $dateStr)->count(),
                    'hasCheckOut' => $dayReservations->where('reservation_checkout', $dateStr)->count(),
                    'statuses' => $dayReservations->pluck('reservation_bookingstatus')->unique()->toArray(),
                ];
                
                $currentDate->addDay();
            }
            $calendar[] = $week;
        }

        return view('livewire.reservation-calendar', [
            'calendar' => $calendar,
            'roomTypes' => $roomTypes,
            'monthName' => $startOfMonth->format('F Y'),
        ]);
    }
}