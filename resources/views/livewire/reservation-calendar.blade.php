<div class="w-full p-6">
    <!-- Header with Navigation and Filters -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-4">
            <!-- Month Navigation -->
            <div class="flex items-center gap-4">
                <button wire:click="previousMonth" class="p-2 hover:bg-gray-100 rounded-lg transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                        </path>
                    </svg>
                </button>
                <h2 class="text-2xl font-bold text-gray-800">{{ $monthName }}</h2>
                <button wire:click="nextMonth" class="p-2 hover:bg-gray-100 rounded-lg transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>

            <!-- Room Type Filter -->
            <div class="flex items-center gap-2">
                <label class="text-sm font-medium text-gray-700">Filter by Room Type:</label>
                <select wire:model.live="selectedRoomType" class="border border-gray-300 rounded-lg px-4 py-2">
                    <option value="">All Room Types</option>
                    @foreach($roomTypes as $type)
                        <option value="{{ $type->roomtype }}">{{ $type->roomtype }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Legend -->
        <div class="flex flex-wrap gap-4 text-sm">
            <div class="flex items-center gap-2">
                <div class="w-4 h-4 bg-blue-500 rounded"></div>
                <span>Check-in</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-4 h-4 bg-orange-500 rounded"></div>
                <span>Check-out</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-4 h-4 bg-green-500 rounded"></div>
                <span>Occupied</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-4 h-4 bg-yellow-500 rounded"></div>
                <span>Pending</span>
            </div>
        </div>
    </div>

    <!-- Calendar Grid -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <!-- Day Headers -->
        <div class="grid grid-cols-7 bg-gray-100 border-b">
            @foreach(['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] as $day)
                <div class="p-4 text-center font-semibold text-gray-700">{{ $day }}</div>
            @endforeach
        </div>

        <!-- Calendar Days -->
        @foreach($calendar as $week)
            <div class="grid grid-cols-7 border-b last:border-b-0">
                @foreach($week as $day)
                    <div wire:click="showDayDetails('{{ $day['date']->format('Y-m-d') }}')" class="min-h-[120px] p-2 border-r last:border-r-0 cursor-pointer hover:bg-gray-50 transition
                                    {{ !$day['isCurrentMonth'] ? 'bg-gray-50' : '' }}
                                    {{ $day['isToday'] ? 'bg-blue-50' : '' }}">
                        <div class="flex justify-between items-start mb-2">
                            <span class="text-sm font-medium {{ !$day['isCurrentMonth'] ? 'text-gray-400' : 'text-gray-700' }}
                                        {{ $day['isToday'] ? 'text-blue-600 font-bold' : '' }}">
                                {{ $day['date']->format('j') }}
                            </span>

                            @if($day['reservationCount'] > 0)
                                <span class="bg-blue-500 text-white text-xs rounded-full px-2 py-1">
                                    {{ $day['reservationCount'] }}
                                </span>
                            @endif
                        </div>

                        <!-- Day Indicators -->
                        <div class="space-y-1">
                            @if($day['hasCheckIn'] > 0)
                                <div class="bg-blue-500 text-white text-xs rounded px-2 py-1 text-center">
                                    {{ $day['hasCheckIn'] }} Check-in
                                </div>
                            @endif

                            @if($day['hasCheckOut'] > 0)
                                <div class="bg-orange-500 text-white text-xs rounded px-2 py-1 text-center">
                                    {{ $day['hasCheckOut'] }} Check-out
                                </div>
                            @endif

                            @if($day['reservationCount'] > 0 && !$day['hasCheckIn'] && !$day['hasCheckOut'])
                                @if(in_array('Pending', $day['statuses']))
                                    <div class="bg-yellow-500 text-white text-xs rounded px-2 py-1 text-center">
                                        Occupied
                                    </div>
                                @else
                                    <div class="bg-green-500 text-white text-xs rounded px-2 py-1 text-center">
                                        Occupied
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>

    <!-- Modal for Day Details -->
    @if($showModal)
        <div class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4" wire:click="closeModal">
            <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full max-h-[80vh] overflow-y-auto" wire:click.stop>
                <!-- Modal Header -->
                <div class="sticky top-0 bg-white border-b p-6 flex justify-between items-center">
                    <h3 class="text-2xl font-bold text-gray-800">
                        Reservations for {{ \Carbon\Carbon::parse($selectedDate)->format('F j, Y') }}
                    </h3>
                    <button wire:click="closeModal" class="text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </button>
                </div>

                <!-- Modal Content -->
                <div class="p-6">
                    @if($dayReservations->count() > 0)
                        <div class="space-y-4">
                            @foreach($dayReservations as $reservation)
                                <div class="border rounded-lg p-4 hover:shadow-md transition">
                                    <div class="flex justify-between items-start mb-3">
                                        <div>
                                            <h4 class="text-lg font-semibold text-gray-800">{{ $reservation->guestname }}</h4>
                                            <p class="text-sm text-gray-600">Booking ID: {{ $reservation->bookingID }}</p>
                                        </div>
                                        <span
                                            class="px-3 py-1 rounded-full text-sm font-medium
                                                        {{ $reservation->reservation_bookingstatus == 'Confirmed' ? 'bg-green-100 text-green-800' : '' }}
                                                        {{ $reservation->reservation_bookingstatus == 'Pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                                        {{ $reservation->reservation_bookingstatus == 'Cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                                            {{ $reservation->reservation_bookingstatus }}
                                        </span>
                                    </div>

                                    <div class="grid grid-cols-2 gap-4 text-sm">
                                        <div>
                                            <p class="text-gray-600">Room Type:</p>
                                            <p class="font-medium">{{ $reservation->roomtype }}</p>
                                        </div>
                                        <div>
                                            <p class="text-gray-600">Room Number:</p>
                                            <p class="font-medium">{{ $reservation->roomID }}</p>
                                        </div>
                                        <div>
                                            <p class="text-gray-600">Check-in:</p>
                                            <p class="font-medium">
                                                {{ \Carbon\Carbon::parse($reservation->reservation_checkin)->format('M j, Y') }}</p>
                                        </div>
                                        <div>
                                            <p class="text-gray-600">Check-out:</p>
                                            <p class="font-medium">
                                                {{ \Carbon\Carbon::parse($reservation->reservation_checkout)->format('M j, Y') }}
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-gray-600">Guests:</p>
                                            <p class="font-medium">{{ $reservation->reservation_numguest }}</p>
                                        </div>
                                        <div>
                                            <p class="text-gray-600">Total:</p>
                                            <p class="font-medium">₱{{ number_format($reservation->total, 2) }}</p>
                                        </div>
                                    </div>

                                    @if($reservation->reservation_specialrequest)
                                        <div class="mt-3 pt-3 border-t">
                                            <p class="text-gray-600 text-sm">Special Request:</p>
                                            <p class="text-sm">{{ $reservation->reservation_specialrequest }}</p>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            <p class="mt-2 text-gray-500">No reservations for this date</p>
                        </div>
                    @endif
                </div>

                <!-- Modal Footer -->
                <div class="sticky bottom-0 bg-gray-50 px-6 py-4 border-t">
                    <button wire:click="closeModal"
                        class="w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-lg transition">
                        Close
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>