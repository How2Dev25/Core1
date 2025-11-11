<dialog id="details_modal_{{$reservation->eventbookingID}}" class="modal">
    <div class="modal-box max-w-4xl">
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
        <h3 class="font-bold text-lg mb-4">Event Details - {{ $reservation->event_name }}</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Event Information -->
            <div>
                <h4 class="font-semibold text-gray-700 mb-3 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    Event Information
                </h4>
                <div class="space-y-2">
                    <p><span class="font-medium">Event Type:</span> {{ $reservation->eventtype_name }}</p>
                    <p><span class="font-medium">Booking ID:</span> {{ $reservation->event_bookingreceiptID }}</p>
                    <p><span class="font-medium">Booked Date:</span>
                        {{ \Carbon\Carbon::parse($reservation->event_bookedate)->format('M d, Y') }}</p>
                    <p><span class="font-medium">Number of Guests:</span> {{ $reservation->event_numguest }}</p>
                </div>
            </div>

            <!-- Organizer Information -->
            <div>
                <h4 class="font-semibold text-gray-700 mb-3 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Organizer Information
                </h4>
                <div class="space-y-2">
                    <p><span class="font-medium">Name:</span> {{ $reservation->eventorganizer_name }}</p>
                    <p><span class="font-medium">Email:</span> {{ $reservation->eventorganizer_email }}</p>
                    <p><span class="font-medium">Phone:</span> {{ $reservation->eventorganizer_phone }}</p>
                </div>
            </div>
        </div>

        <!-- Event Dates -->
        <div class="mt-6">
            <h4 class="font-semibold text-gray-700 mb-3 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                Event Dates
            </h4>
            <div class="bg-gray-50 p-4 rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="font-medium text-sm text-gray-500">Check-in</p>
                        <p class="font-bold">
                            {{ \Carbon\Carbon::parse($reservation->event_checkin)->format('M d, Y') }}
                        </p>
                    </div>
                    <div>
                        <p class="font-medium text-sm text-gray-500">Check-out</p>
                        <p class="font-bold">
                            {{ \Carbon\Carbon::parse($reservation->event_checkout)->format('M d, Y') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pricing Breakdown -->
        <div class="mt-6">
            <h4 class="font-semibold text-gray-700 mb-3 flex items-center gap-2">
                <i class="fa-solid fa-peso-sign text-primary"></i>
                Pricing Breakdown
            </h4>

            <div class="bg-gray-50 p-4 rounded-lg">
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span>Event Total:</span>
                        <span class="font-bold text-lg">₱{{ number_format($reservation->event_total_price, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span>Payment Status:</span>
                        <span class="
                                                @if(strtolower($reservation->event_paymentstatus) == 'paid') text-green-600 font-semibold
                                                @elseif(strtolower($reservation->event_paymentstatus) == 'pending') text-yellow-600 font-semibold
                                                @else text-gray-600
                                                @endif
                                            ">
                            {{ ucfirst($reservation->event_paymentstatus) }}
                        </span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span>Payment Method:</span>
                        <span>{{ $reservation->event_paymentmethod ?? 'Not specified' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Special Requests -->
        @if($reservation->event_specialrequest)
            <div class="mt-6">
                <h4 class="font-semibold text-gray-700 mb-3 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                    </svg>
                    Special Requests
                </h4>
                <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
                    <p class="text-sm">{{ $reservation->event_specialrequest }}</p>
                </div>
            </div>
        @endif
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>