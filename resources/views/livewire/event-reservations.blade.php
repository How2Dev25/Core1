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
                <option value="Rejected">Rejected</option>
                    <option value="Confirmed">Confirmed</option>
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
                            <span
                                class="badge py-1.5 px-3
                                                                                                                                                @if(strtolower($reservation->eventstatus) == 'approved') badge-success
                                                                                                                                                @elseif(strtolower($reservation->eventstatus) == 'done') badge-success
                                                                                                                                                @elseif(strtolower($reservation->eventstatus) == 'pending') badge-accent
                                                                                                                                                @elseif(strtolower($reservation->eventstatus) == 'cancelled') badge-error
                                                                                                                                                @endif
                                                                                                                                            ">
                                {{ ucfirst($reservation->eventstatus) }}
                            </span>
                        </td>
                        <td class="py-4 px-4">
                            <div class="flex flex-col gap-1">
                                <span
                                    class="
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
                                    <button onclick="print_receipt_{{$reservation->eventbookingID}}.showModal()"
                                        class="btn btn-sm btn-ghost" title="View Receipt">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </button>
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
<div id="actions-drawer-{{$reservation->eventbookingID}}"
    class="fixed top-0 right-0 h-full w-72 bg-white shadow-xl transform translate-x-full transition-transform duration-300 ease-in-out z-50 border-l border-gray-200">

    {{-- Header --}}
    <div class="p-4 border-b border-gray-200 relative bg-blue-900 text-white">
        <h4 class="font-bold text-lg">
            Actions for Event #{{$reservation->event_bookingreceiptID}}
        </h4>
        <button
            onclick="document.getElementById('actions-drawer-{{$reservation->eventbookingID}}').classList.add('translate-x-full')"
            class="absolute top-3 right-3 btn btn-xs btn-circle btn-ghost hover:bg-white/20">
            ✕
        </button>
    </div>

    {{-- Body --}}
    <div class="p-4 space-y-3">

        {{-- PENDING --}}
        @if($reservation->eventstatus === 'Pending')
            <div class="flex flex-col items-center justify-center text-center p-6 border border-dashed rounded-lg bg-gray-50">
                <i class="fa-solid fa-clock text-3xl text-gray-400 mb-3"></i>
                <p class="text-sm font-medium text-gray-600">
                    Waiting for Administrative Action
                </p>
                <p class="text-xs text-gray-500 mt-1">
                    Your event is currently under review.
                </p>
            </div>

        {{-- APPROVED --}}
        @elseif($reservation->eventstatus === 'Approved')
            {{-- Show buttons --}}
            <button onclick="confirm_event_{{$reservation->eventbookingID}}.showModal()"
                class="btn btn-sm btn-block bg-blue-900 text-white gap-2 shadow-md">
                <i class="fa-solid fa-check text-yellow-400"></i>
                Confirm Event
            </button>

            <button onclick="cancel_event_{{$reservation->eventbookingID}}.showModal()"
                class="btn btn-sm btn-block bg-red-600 text-white gap-2 shadow-md">
                <i class="fa-solid fa-circle-xmark"></i>
                Cancel Event
            </button>

        {{-- CONFIRMED --}}
        @elseif($reservation->eventstatus === 'Confirmed')
            <button onclick="complete_event_{{$reservation->eventbookingID}}.showModal()"
                class="btn btn-sm btn-block bg-green-700 text-white gap-2 shadow-md">
                <i class="fa-solid fa-circle-check text-yellow-400"></i>
                Mark as Done
            </button>

            <button onclick="cancel_event_{{$reservation->eventbookingID}}.showModal()"
                class="btn btn-sm btn-block bg-red-600 text-white gap-2 shadow-md">
                <i class="fa-solid fa-circle-xmark"></i>
                Cancel Event
            </button>

        {{-- REJECTED --}}
        @elseif($reservation->eventstatus === 'Rejected')
            <div class="bg-red-50 border border-red-200 rounded-lg p-3 text-sm text-red-700">
                 This event was rejected by administration.
            </div>

            <button onclick="delete_event_{{$reservation->eventbookingID}}.showModal()"
                class="btn btn-sm btn-block bg-gray-700 text-white gap-2 shadow-md">
                <i class="fa-solid fa-trash"></i>
                Delete Event
            </button>

        {{-- DONE --}}
        @elseif($reservation->eventstatus === 'Done')
            <div class="flex flex-col items-center justify-center text-center p-6 bg-green-50 border border-green-200 rounded-lg">
                <i class="fa-solid fa-circle-check text-3xl text-green-600 mb-2"></i>
                <p class="font-semibold text-green-700">
                    Event Completed
                </p>
                <p class="text-xs text-green-600 mt-1">
                    This event has been successfully completed.
                </p>
            </div>

            

        {{-- ANY OTHER STATUS --}}
        @else
            <div class="flex flex-col items-center justify-center text-center p-6 border border-dashed rounded-lg bg-gray-50">
                <i class="fa-solid fa-clock text-3xl text-gray-400 mb-3"></i>
                <p class="text-sm font-medium text-gray-600">
                    Waiting for Administrative Action
                </p>
                <p class="text-xs text-gray-500 mt-1">
                    This event is currently under review.
                </p>
            </div>
        @endif

    </div>
</div>
@endforeach

    <!-- Details Modals (existing code remains the same) -->
    @foreach($reservations as $reservation)
        @include('admin.components.ecm.viewdetails')
        @include('admin.components.ecm.confirmreservation')
        @include('admin.components.ecm.cancelreservation')
        @include('admin.components.ecm.deletereservation')
        @include('admin.components.ecm.markasdone')
        @include('admin.components.ecm.printreceipt')
    @endforeach
</div>