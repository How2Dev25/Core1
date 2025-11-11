<div class="bg-white rounded-lg shadow-sm border border-gray-200 mt-5 p-5">
    <!-- Header with Filters -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
        <h3 class="text-xl font-bold text-gray-800">Event Reservations</h3>

        <div class="flex flex-col md:flex-row gap-3 w-full md:w-auto">
            <!-- Status Filter -->
            <select wire:model.live="statusFilter" class="select select-bordered select-sm">
                <option value="">All Statuses</option>
                <option value="Pending">Pending</option>
                <option value="Approved">Approved</option>
                <option value="Cancelled">Cancelled</option>
            </select>

            <!-- Event Type Filter -->
            <select wire:model.live="typeFilter" class="select select-bordered select-sm">
                <option value="">All Event Types</option>
                @foreach($reservations->unique('eventtype_name') as $reservation)
                    <option value="{{ $reservation->eventtype_name }}">{{ $reservation->eventtype_name }}</option>
                @endforeach
            </select>

            <!-- Search -->
            <div class="relative">
                <input type="text" wire:model.live.debounce.300ms="searchTerm"
                    placeholder="Search by event or organizer..." class="input input-bordered input-sm pl-8">
                <!-- search icon -->
                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 h-4 w-4 text-gray-400"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>

            <!-- Manual Reload Button -->
            <button wire:click="$refresh" class="btn btn-sm btn-outline flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 4v6h6M20 20v-6h-6M5 19a9 9 0 1014-14l-1.5 1.5" />
                </svg>
                Reload
            </button>
        </div>
    </div>

    <!-- Flash Message -->
    @if (session()->has('message'))
        <div class="alert alert-success mb-4">
            <div class="flex-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-6 h-6 mx-2 stroke-current">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                </svg>
                <label>{{ session('message') }}</label>
            </div>
        </div>
    @endif

    <!-- Table View -->
    <div class="overflow-x-auto">
        <table class="table table-auto w-full">
            <thead>
                <tr class="bg-blue-900 text-white text-sm">
                    <th class="py-3 px-4 text-left">Event & Organizer</th>
                    <th class="py-3 px-4 text-left">Event Details</th>
                    <th class="py-3 px-4 text-left">Status</th>
                    <th class="py-3 px-4 text-left">Payment</th>
                    <th class="py-3 px-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reservations as $reservation)
                    <tr class="border-t border-gray-100 hover:bg-gray-50">
                        <td class="py-4 px-4">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-lg overflow-hidden flex-shrink-0">
                                    <img src="{{ asset($reservation->eventtype_photo) }}"
                                        alt="{{ $reservation->event_name }}" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <div class="font-semibold">{{ $reservation->event_name }}</div>
                                    <div class="text-sm text-gray-600">{{ $reservation->eventorganizer_name }}</div>
                                    <div class="text-xs text-gray-500">{{ $reservation->eventtype_name }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-4">
                            <div class="text-sm">
                                <div class="flex items-center gap-1 mb-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-primary" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span>{{ \Carbon\Carbon::parse($reservation->event_checkin)->format('M d, Y') }}</span>
                                    <span class="mx-1">-</span>
                                    <span>{{ \Carbon\Carbon::parse($reservation->event_checkout)->format('M d, Y') }}</span>
                                </div>
                                <div class="text-xs text-gray-500">
                                    ID: {{ $reservation->event_bookingreceiptID }} • {{ $reservation->event_numguest }}
                                    guests
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-4">
                            <span class="badge py-1.5 px-3
                                                    @if(strtolower($reservation->eventstatus) == 'approved') badge-success
                                                    @elseif(strtolower($reservation->eventstatus) == 'pending') badge-neutral
                                                    @elseif(strtolower($reservation->eventstatus) == 'cancelled') badge-error
                                                    @endif
                                                ">
                                {{ ucfirst($reservation->eventstatus) }}
                            </span>
                        </td>
                        <td class="py-4 px-4">
                            <div class="flex flex-col gap-1">
                                <span class="
                                                        @if(strtolower($reservation->event_paymentstatus) == 'paid') text-green-600 font-semibold
                                                        @elseif(strtolower($reservation->event_paymentstatus) == 'pending') text-yellow-600 font-semibold
                                                        @else text-gray-600
                                                        @endif
                                                    ">
                                    {{ ucfirst($reservation->event_paymentstatus) }}
                                </span>
                                <span class="text-xs font-bold text-gray-800">
                                    ₱{{ number_format($reservation->event_total_price, 2) }}
                                </span>
                            </div>
                        </td>
                        <td class="py-4 px-4">
                            <div class="flex justify-end items-center gap-2">
                                <!-- View Receipt Button -->

                                @if($reservation->event_eventreceipt)
                                    <a href="{{ asset($reservation->event_eventreceipt) }}" target="_blank"
                                        class="btn btn-sm btn-ghost" title="View Receipt">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </a>
                                @endif

                                <!-- View Details Button -->
                                <button onclick="details_modal_{{$reservation->eventbookingID}}.showModal()"
                                    class="btn btn-sm btn-ghost" title="View Details">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </button>

                                <!-- More Actions Button - Opens Drawer -->
                                <button
                                    onclick="document.getElementById('actions-drawer-{{$reservation->eventbookingID}}').classList.toggle('translate-x-full')"
                                    class="btn btn-sm btn-ghost" title="More Actions">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 12h.01M12 12h.01M19 12h.01" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-10 text-center">
                            <div class="text-gray-400 mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <p class="text-gray-500">No event reservations found matching your criteria</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $reservations->links() }}
    </div>

    <!-- Action Drawers for each reservation -->
    @foreach($reservations as $reservation)
        <!-- Actions Drawer -->
        <div id="actions-drawer-{{$reservation->eventbookingID}}"
            class="fixed top-0 right-0 h-full w-72 bg-white shadow-xl transform translate-x-full transition-transform duration-300 ease-in-out z-50 border-l border-gray-200">
            <div class="p-4 border-b border-gray-200 relative bg-blue-900 text-white">
                <h4 class="font-bold text-lg">Actions for Event #{{$reservation->event_bookingreceiptID}}</h4>
                <button
                    onclick="document.getElementById('actions-drawer-{{$reservation->eventbookingID}}').classList.add('translate-x-full')"
                    class="absolute top-3 right-3 btn btn-xs btn-circle btn-ghost hover:bg-white/20">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="p-4 space-y-3">
                <!-- Confirm Event Button -->
                @if($reservation->eventstatus === 'Pending')
                    <button onclick="confirm_event_{{$reservation->eventbookingID}}.showModal()"
                        class="btn btn-sm btn-block bg-green-600 hover:bg-green-700 text-white justify-start gap-2 shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Confirm Event
                    </button>
                @endif

                <!-- Mark as Done Button -->
                @if($reservation->eventstatus === 'Approved')
                    <button onclick="complete_event_{{$reservation->eventbookingID}}.showModal()"
                        class="btn btn-sm btn-block bg-blue-600 hover:bg-blue-700 text-white justify-start gap-2 shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Mark as Done
                    </button>
                @endif

                <!-- Print Receipt Button -->
                @if($reservation->event_eventreceipt && $reservation->event_paymentstatus === 'Paid')
                    <a href="{{ asset($reservation->event_eventreceipt) }}" target="_blank"
                        class="btn btn-sm btn-block bg-purple-600 hover:bg-purple-700 text-white justify-start gap-2 shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m4 4h4a2 2 0 002-2v-4a2 2 0 00-2-2h-4a2 2 0 00-2 2v4a2 2 0 002 2z" />
                        </svg>
                        Print Receipt
                    </a>
                @endif

                <!-- Download Invoice Button -->
                <button onclick="download_invoice_{{$reservation->eventbookingID}}.showModal()"
                    class="btn btn-sm btn-block bg-indigo-600 hover:bg-indigo-700 text-white justify-start gap-2 shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Download Invoice
                </button>

                <!-- Cancel Event Button -->
                @if($reservation->eventstatus !== 'Cancelled' && $reservation->eventstatus !== 'Completed')
                    <button onclick="cancel_event_{{$reservation->eventbookingID}}.showModal()"
                        class="btn btn-sm btn-block bg-yellow-600 hover:bg-yellow-700 text-white justify-start gap-2 shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Cancel Event
                    </button>
                @endif

                <!-- Delete Event Button -->
                <button onclick="delete_event_{{$reservation->eventbookingID}}.showModal()"
                    class="btn btn-sm btn-block bg-red-600 hover:bg-red-700 text-white justify-start gap-2 shadow-md mt-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    Delete Event
                </button>


            </div>
        </div>
    @endforeach

    <!-- Details Modals (existing code remains the same) -->
    @foreach($reservations as $reservation)
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
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-primary" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            Event Information
                        </h4>
                        <div class="space-y-2">
                            <p><span class="font-medium">Event Type:</span> {{ $reservation->eventtype_name }}</p>
                            <p><span class="font-medium">Booking ID:</span> {{ $reservation->eventbookingID }}</p>
                            <p><span class="font-medium">Booked Date:</span>
                                {{ \Carbon\Carbon::parse($reservation->event_bookedate)->format('M d, Y') }}</p>
                            <p><span class="font-medium">Number of Guests:</span> {{ $reservation->event_numguest }}</p>
                        </div>
                    </div>

                    <!-- Organizer Information -->
                    <div>
                        <h4 class="font-semibold text-gray-700 mb-3 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-primary" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
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
                                <span
                                    class="font-bold text-lg">₱{{ number_format($reservation->event_total_price, 2) }}</span>
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
    @endforeach
</div>