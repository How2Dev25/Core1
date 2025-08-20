<div class="bg-white rounded-lg shadow-sm border border-gray-200 mt-5 p-5">
    <!-- Header with Filters -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
        <h3 class="text-xl font-bold text-gray-800">Reservation Listings</h3>
        
        <div class="flex flex-col md:flex-row gap-3 w-full md:w-auto">
            <!-- Status Filter -->
            <select wire:model.live="statusFilter" class="select select-bordered select-sm">
                <option value="">All Statuses</option>
                <option value="Pending">Pending</option>
                <option value="Confirmed">Confirmed</option>
                <option value="Checked In">Checked In</option>
                <option value="Cancelled">Cancelled</option>
            </select>
            
            <!-- Room Type Filter -->
            <select wire:model.live="typeFilter" class="select select-bordered select-sm">
                <option value="">All Types</option>
                <option value="Standard">Standard</option>
                <option value="Deluxe">Deluxe</option>
                <option value="Suite">Suite</option>
                <option value="Executive">Executive</option>
            </select>
            
            <!-- Search -->
            <div class="relative">
                <input 
                    type="text" 
                    wire:model.live.debounce.300ms="searchTerm"
                    placeholder="Search by room or guest..." 
                    class="input input-bordered input-sm pl-8" 
                >
                <!-- search icon -->
                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>

               <!-- Manual Reload Button -->
            <a onclick="window.location.reload(true)" class="btn btn-sm btn-outline flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v6h6M20 20v-6h-6M5 19a9 9 0 1014-14l-1.5 1.5" />
                </svg>
                Reload
            </a>
        </div>
    </div>

    <!-- Listing View -->
    <div class="divide-y divide-gray-200">
        @forelse($reserverooms as $reserveroom)
        <div class="py-4 flex flex-col md:flex-row justify-between">
            <!-- Left side: Reservation info -->
           <div class="flex-1">
    <!-- Room Header -->
    <div class="flex flex-wrap items-center gap-3 mb-3">
        <h4 class="font-bold text-xl flex items-center gap-2 text-primary">
            <!-- home icon -->
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l9-9 9 9M4 10v10a1 1 0 001 1h14a1 1 0 001-1V10" />
            </svg>
            Room #{{ $reserveroom->roomID }}
        </h4>
        <span class="badge badge-outline">{{ $reserveroom->roomtype }}</span>
        <span class="badge 
            @if(strtolower($reserveroom->reservation_bookingstatus) == 'pending') badge-neutral
            @elseif(strtolower($reserveroom->reservation_bookingstatus) == 'confirmed') badge-success
            @elseif(strtolower($reserveroom->reservation_bookingstatus) == 'checked in') badge-primary
            @elseif(strtolower($reserveroom->reservation_bookingstatus) == 'checked out') badge-warning
            @elseif(strtolower($reserveroom->reservation_bookingstatus) == 'cancelled') badge-error
            @endif
        ">
            {{ ucfirst($reserveroom->reservation_bookingstatus) }}
        </span>
    </div>

    <!-- Guest Info -->
    <div class="mb-3 space-y-1">
        <p class="text-black font-semibold flex items-center gap-2">
            <!-- user icon -->
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A9 9 0 1112 21a9 9 0 01-6.879-3.196z" />
            </svg>
            {{ $reserveroom->guestname }}
        </p>
        <p class="text-black font-semibold flex items-center gap-2">
            <!-- file-text icon -->
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V7l-6-6H7a2 2 0 00-2 2v16a2 2 0 002 2z" />
            </svg>
            Receipt #: {{ $reserveroom->reservation_receipt }}
        </p>
    </div>

    <!-- Reservation Details -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-2 gap-x-6 text-sm text-gray-600">
        <div class="flex items-center gap-2">
            <!-- calendar icon -->
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3M3 11h18M5 21h14a2 2 0 002-2V7H3v12a2 2 0 002 2z" />
            </svg>
            <span class="font-medium">Check-in:</span> 
            {{ \Carbon\Carbon::parse($reserveroom->reservation_checkin)->format('M d, Y') }}
        </div>
        <div class="flex items-center gap-2">
            <!-- calendar-days icon -->
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3M3 11h18M5 21h14a2 2 0 002-2V7H3v12a2 2 0 002 2z" />
            </svg>
            <span class="font-medium">Check-out:</span> 
            {{ \Carbon\Carbon::parse($reserveroom->reservation_checkout)->format('M d, Y') }}
        </div>
        <div class="flex items-center gap-2">
            <!-- globe icon -->
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3C7.03 3 3 7.03 3 12s4.03 9 9 9 9-4.03 9-9-4.03-9-9-9z" />
            </svg>
            <span class="font-medium">Booked via:</span> {{ $reserveroom->bookedvia }}
        </div>
    </div>
            </div>

            <!-- Right side: Action buttons -->
            <div class="flex items-start gap-2 mt-3 md:mt-0">
             
              <!-- Edit button -->
<button onclick="document.getElementById('edit_reservation_{{$reserveroom->reservationID}}').showModal()" 
        class="btn btn-xs btn-primary shadow-sm">
    <!-- pencil icon -->
    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
    </svg>
</button>
                
                <!-- Options button to open drawer -->
                <button onclick="document.getElementById('actions-drawer-{{$reserveroom->reservationID}}').classList.toggle('translate-x-full')"
                        class="btn btn-xs btn-ghost">
                    <!-- dots icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Actions Drawer (unchanged) -->
        <div id="actions-drawer-{{$reserveroom->reservationID}}" 
             class="fixed top-0 right-0 h-full w-64 bg-white shadow-lg transform translate-x-full transition-transform duration-300 ease-in-out z-50">
            <div class="p-4 border-b">
                <h4 class="font-bold">Actions for Room #{{$reserveroom->roomID}}</h4>
                <button onclick="document.getElementById('actions-drawer-{{$reserveroom->reservationID}}').classList.add('translate-x-full')"
                        class="absolute top-3 right-3 btn btn-xs btn-circle btn-ghost">
                    ✕
                </button>
            </div>
            
            <div class="p-4 space-y-2 ">
                <button onclick="confirm_reservation_{{$reserveroom->reservationID}}.showModal()"
                    class="btn btn-sm btn-block btn-success justify-start gap-2 @if(in_array($reserveroom->reservation_bookingstatus, ['Confirmed', 'Checked in', 'Checked out'])) hidden @endif">
                    ✅ Confirm Reservation
                </button>

                @if($reserveroom->reservation_bookingstatus === 'Confirmed')
                <button onclick="checkin_reservation_{{$reserveroom->reservationID}}.showModal()"
                        class="btn btn-sm btn-block btn-primary justify-start gap-2">
                    🛎 Check-In Guest
                </button>
                @endif
                
                @if($reserveroom->reservation_bookingstatus === 'Checked in')
                <button onclick="checkout_reservation_{{$reserveroom->reservationID}}.showModal()"
                        class="btn btn-sm btn-block btn-warning btn-info justify-start gap-2">
                    🚪 Check-Out Guest
                </button>
                @endif

                @if($reserveroom->reservation_bookingstatus != 'Confirmed')
                <button onclick="cancel_reservation_{{$reserveroom->reservationID}}.showModal()"
                        class="btn btn-sm btn-block btn-info justify-start gap-2 @if(in_array($reserveroom->reservation_bookingstatus, ['Confirmed', 'Checked in', 'Checked out'])) hidden @endif">
                    ❌ Cancel Reservation
                </button>
                @endif
                
                <button onclick="delete_reservation_{{$reserveroom->reservationID}}.showModal()"
                        class="btn btn-sm btn-block btn-error justify-start gap-2">
                    🗑 Delete Reservation
                </button>

                <a href="/printreceipt/{{$reserveroom->reservationID}}" class="btn btn-sm btn-block justify-start gap-2" style="background-color: #001f54; color: white;">
                    🧾 Generate Receipt
                </a>
            </div>
        </div>
        @empty
        <div class="text-center py-10">
            <div class="text-gray-400 mb-3">
                <!-- empty state icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
            </div>
            <p class="text-gray-500">No reservations found matching your criteria</p>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $reserverooms->links() }}
    </div>
</div>
