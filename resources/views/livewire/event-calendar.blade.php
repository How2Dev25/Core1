<div class="w-full p-6 bg-gray-50 min-h-screen">
    <!-- Statistics Dashboard -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Total Events</p>
                    <p class="text-3xl font-bold text-gray-800 mt-1">{{ $totalEvents }}</p>
                </div>
                <div class="bg-blue-900 p-3 rounded-full">
                    <svg class="w-8 h-8 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Confirmed</p>
                    <p class="text-3xl font-bold text-green-600 mt-1">{{ $confirmedEvents }}</p>
                </div>
                <div class="bg-blue-900 p-3 rounded-full">
                    <svg class="w-8 h-8 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Pending</p>
                    <p class="text-3xl font-bold text-yellow-600 mt-1">{{ $pendingEvents }}</p>
                </div>
                <div class="bg-blue-900 p-3 rounded-full">
                    <svg class="w-8 h-8 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Total Guests</p>
                    <p class="text-3xl font-bold text-purple-600 mt-1">{{ $totalGuests }}</p>
                </div>
                <div class="bg-blue-900 p-3 rounded-full">
                    <svg class="w-8 h-8 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                        </path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Calendar Header with Navigation and Filters -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4 mb-4">
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

            <!-- Filters -->
            <div class="flex flex-wrap items-center gap-3">
                <div class="flex items-center gap-2">
                    <label class="text-sm font-medium text-gray-700">Event Type:</label>
                    <select wire:model.live="selectedEventType"
                        class="border border-gray-300 rounded-lg px-3 py-2 text-sm">
                        <option value="">All Types</option>
                        @foreach($eventTypes as $type)
                            <option value="{{ $type->eventtype_ID }}">{{ $type->eventtype_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-center gap-2">
                    <label class="text-sm font-medium text-gray-700">Status:</label>
                    <select wire:model.live="selectedStatus"
                        class="border border-gray-300 rounded-lg px-3 py-2 text-sm">
                        <option value="">All Status</option>
                        @foreach($statuses as $status)
                            <option value="{{ $status }}">{{ $status }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- Legend -->
        <div class="flex flex-wrap gap-4 text-sm">
            <div class="flex items-center gap-2">
                <div class="w-4 h-4 bg-indigo-500 rounded"></div>
                <span>Event Start</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-4 h-4 bg-pink-500 rounded"></div>
                <span>Event End</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-4 h-4 bg-green-500 rounded"></div>
                <span>Confirmed</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-4 h-4 bg-yellow-500 rounded"></div>
                <span>Pending</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-4 h-4 bg-red-500 rounded"></div>
                <span>Cancelled</span>
            </div>
        </div>
    </div>

    <!-- Calendar Grid -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <!-- Day Headers -->
        <div class="grid grid-cols-7 bg-gradient-to-r from-indigo-500 to-purple-600 text-white border-b">
            @foreach(['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'] as $day)
                <div class="p-4 text-center font-semibold">{{ $day }}</div>
            @endforeach
        </div>

        <!-- Calendar Days -->
        @foreach($calendar as $week)
            <div class="grid grid-cols-7 border-b last:border-b-0">
                @foreach($week as $day)
                    <div wire:click="showDayDetails('{{ $day['date']->format('Y-m-d') }}')" class="min-h-[140px] p-3 border-r last:border-r-0 cursor-pointer hover:bg-indigo-50 transition relative
                                    {{ !$day['isCurrentMonth'] ? 'bg-gray-50' : '' }}
                                    {{ $day['isToday'] ? 'bg-indigo-50 ring-2 ring-indigo-400 ring-inset' : '' }}">
                        <div class="flex justify-between items-start mb-2">
                            <span class="text-sm font-medium {{ !$day['isCurrentMonth'] ? 'text-gray-400' : 'text-gray-700' }}
                                        {{ $day['isToday'] ? 'text-indigo-600 font-bold text-lg' : '' }}">
                                {{ $day['date']->format('j') }}
                            </span>

                            @if($day['eventCount'] > 0)
                                <span class="bg-indigo-500 text-white text-xs rounded-full px-2 py-1 font-semibold shadow-sm">
                                    {{ $day['eventCount'] }}
                                </span>
                            @endif
                        </div>

                        <!-- Day Indicators -->
                        <div class="space-y-1">
                            @if($day['hasEventStart'] > 0)
                                <div class="bg-indigo-500 text-white text-xs rounded px-2 py-1 text-center font-medium shadow-sm">
                                    🎉 {{ $day['hasEventStart'] }} Start
                                </div>
                            @endif

                            @if($day['hasEventEnd'] > 0)
                                <div class="bg-pink-500 text-white text-xs rounded px-2 py-1 text-center font-medium shadow-sm">
                                    🏁 {{ $day['hasEventEnd'] }} End
                                </div>
                            @endif

                            @if($day['eventCount'] > 0)
                                @foreach($day['eventNames'] as $eventName)
                                    <div class="bg-purple-100 text-purple-800 text-xs rounded px-2 py-1 truncate"
                                        title="{{ $eventName }}">
                                        📅 {{ $eventName }}
                                    </div>
                                @endforeach

                                @if($day['eventCount'] > 2)
                                    <div class="text-xs text-gray-500 text-center mt-1">
                                        +{{ $day['eventCount'] - 2 }} more
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
        <div class="fixed inset-0 bg-black bg-opacity-60 z-50 flex items-center justify-center p-4" wire:click="closeModal">
            <div class="bg-white rounded-lg shadow-2xl max-w-5xl w-full max-h-[85vh] overflow-y-auto" wire:click.stop>
                <!-- Modal Header -->
                <div
                    class="sticky top-0 bg-gradient-to-r from-indigo-500 to-purple-600 text-white p-6 flex justify-between items-center">
                    <div>
                        <h3 class="text-2xl font-bold">
                            Events for {{ \Carbon\Carbon::parse($selectedDate)->format('l, F j, Y') }}
                        </h3>
                        <p class="text-indigo-100 text-sm mt-1">{{ $dayEvents->count() }} event(s) scheduled</p>
                    </div>
                    <button wire:click="closeModal"
                        class="text-white hover:bg-white hover:bg-opacity-20 rounded-full p-2 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </button>
                </div>

                <!-- Modal Content -->
                <div class="p-6">
                    @if($dayEvents->count() > 0)
                        <div class="space-y-4">
                            @foreach($dayEvents as $event)
                                <div class="border-l-4 rounded-lg p-5 hover:shadow-lg transition
                                                {{ $event->eventstatus == 'Confirmed' ? 'border-green-500 bg-green-50' : '' }}
                                                {{ $event->eventstatus == 'Pending' ? 'border-yellow-500 bg-yellow-50' : '' }}
                                                {{ $event->eventstatus == 'Cancelled' ? 'border-red-500 bg-red-50' : '' }}">

                                    <div class="flex justify-between items-start mb-4">
                                        <div class="flex-1">
                                            <h4 class="text-xl font-bold text-gray-800 mb-1">{{ $event->event_name }}</h4>
                                            <p class="text-sm text-gray-600">Booking ID: <span
                                                    class="font-mono font-semibold">{{ $event->eventbookingID }}</span></p>
                                        </div>
                                        <span class="px-4 py-2 rounded-full text-sm font-bold shadow-sm
                                                        {{ $event->eventstatus == 'Confirmed' ? 'bg-green-500 text-white' : '' }}
                                                        {{ $event->eventstatus == 'Pending' ? 'bg-yellow-500 text-white' : '' }}
                                                        {{ $event->eventstatus == 'Cancelled' ? 'bg-red-500 text-white' : '' }}">
                                            {{ $event->eventstatus }}
                                        </span>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
                                        <div class="bg-white p-3 rounded-lg">
                                            <p class="text-gray-500 text-xs mb-1">Event Type</p>
                                            <p class="font-semibold text-gray-800">{{ $event->eventtype_name ?? 'N/A' }}</p>
                                        </div>
                                        <div class="bg-white p-3 rounded-lg">
                                            <p class="text-gray-500 text-xs mb-1">Organizer</p>
                                            <p class="font-semibold text-gray-800">{{ $event->eventorganizer_name }}</p>
                                        </div>
                                        <div class="bg-white p-3 rounded-lg">
                                            <p class="text-gray-500 text-xs mb-1">Contact</p>
                                            <p class="font-semibold text-gray-800">{{ $event->eventorganizer_phone }}</p>
                                        </div>
                                        <div class="bg-white p-3 rounded-lg">
                                            <p class="text-gray-500 text-xs mb-1">Email</p>
                                            <p class="font-semibold text-gray-800 text-sm truncate"
                                                title="{{ $event->eventorganizer_email }}">{{ $event->eventorganizer_email }}</p>
                                        </div>
                                        <div class="bg-white p-3 rounded-lg">
                                            <p class="text-gray-500 text-xs mb-1">Start Date</p>
                                            <p class="font-semibold text-gray-800">
                                                {{ \Carbon\Carbon::parse($event->event_checkin)->format('M j, Y g:i A') }}</p>
                                        </div>
                                        <div class="bg-white p-3 rounded-lg">
                                            <p class="text-gray-500 text-xs mb-1">End Date</p>
                                            <p class="font-semibold text-gray-800">
                                                {{ \Carbon\Carbon::parse($event->event_checkout)->format('M j, Y g:i A') }}</p>
                                        </div>
                                        <div class="bg-white p-3 rounded-lg">
                                            <p class="text-gray-500 text-xs mb-1">Number of Guests</p>
                                            <p class="font-semibold text-gray-800">{{ $event->event_numguest }} people</p>
                                        </div>
                                        <div class="bg-white p-3 rounded-lg">
                                            <p class="text-gray-500 text-xs mb-1">Payment Status</p>
                                            <p
                                                class="font-semibold {{ $event->event_paymentstatus == 'Paid' ? 'text-green-600' : 'text-orange-600' }}">
                                                {{ $event->event_paymentstatus }}
                                            </p>
                                        </div>
                                        <div class="bg-white p-3 rounded-lg">
                                            <p class="text-gray-500 text-xs mb-1">Total Price</p>
                                            <p class="font-bold text-indigo-600 text-lg">
                                                ₱{{ number_format($event->event_total_price, 2) }}</p>
                                        </div>
                                    </div>

                                    @if($event->event_equipment)
                                        <div class="bg-white p-3 rounded-lg mb-3">
                                            <p class="text-gray-500 text-xs mb-1">Equipment Requested</p>
                                            <p class="text-sm text-gray-800">{{ $event->event_equipment }}</p>
                                        </div>
                                    @endif

                                    @if($event->event_specialrequest)
                                        <div class="bg-white p-3 rounded-lg">
                                            <p class="text-gray-500 text-xs mb-1">Special Requests</p>
                                            <p class="text-sm text-gray-800">{{ $event->event_specialrequest }}</p>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-16">
                            <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            <p class="mt-4 text-lg text-gray-500">No events scheduled for this date</p>
                            <p class="text-sm text-gray-400 mt-1">Click on other dates to view their events</p>
                        </div>
                    @endif
                </div>

                <!-- Modal Footer -->
                <div class="sticky bottom-0 bg-gray-50 px-6 py-4 border-t flex justify-end gap-3">
                    <button wire:click="closeModal"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-6 rounded-lg transition">
                        Close
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>