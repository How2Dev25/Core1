<div wire:poll.5s="fetchreservedrooms" class="mt-5 space-y-4">

    <!-- Filters -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-4">
        <!-- Search -->
        <input 
            type="text" 
            wire:model.debounce.500ms="search" 
            placeholder="Search by guest or room no." 
            class="input input-bordered w-full md:w-1/3"
        />

        <!-- Status Filter -->
        <select wire:model="statusFilter" class="select select-bordered w-full md:w-48">
            <option value="">All Status</option>
            <option value="Pending">Pending</option>
            <option value="Confirmed">Confirmed</option>
            <option value="Checked In">Checked In</option>
            <option value="Checked Out">Checked Out</option>
            <option value="Cancelled">Cancelled</option>
        </select>
    </div>

    <h3 class="text-xl font-bold text-gray-800">Reserved and Occupied Rooms</h3>

    @forelse($reserverooms as $reserveroom)
        <div class="p-5 rounded-2xl divide-y divide-gray-200 hover:shadow-md transition bg-white flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            
            <!-- Left side: Room and Guest Info -->
            <div class="flex-1">
                <div class="flex items-center gap-3">
                    <span class="text-lg font-semibold text-indigo-600">Room {{ $reserveroom->roomID }}</span>
                    <span class="text-sm px-3 py-1 rounded-full bg-indigo-100 text-indigo-700">{{ $reserveroom->roomtype }}</span>
                </div>


                   <div class="mt-1 text-gray-700">
                    <p><span class="font-semibold">Receipt No#: </span> {{ $reserveroom->reservation_receipt }}</p>
                </div>
                

                <div class="mt-2 text-gray-700">
                    <p><span class="font-semibold">Guest:</span> {{ $reserveroom->guestname }}</p>
                    <p><span class="font-semibold">Booked Via:</span> {{ $reserveroom->bookedvia }}</p>
                </div>

                <div class="mt-2 text-sm text-gray-500">
                    <p><span class="font-semibold">Check-In:</span> {{ $reserveroom->reservation_checkin }}</p>
                    <p><span class="font-semibold">Check-Out:</span> {{ $reserveroom->reservation_checkout }}</p>
                </div>
            </div>

            <!-- Right side: Status + Actions -->
            <div class="flex flex-col items-end gap-2">
                <span class="badge 
                    @if(strtolower($reserveroom->reservation_bookingstatus) == 'pending') badge-neutral
                    @elseif(strtolower($reserveroom->reservation_bookingstatus) == 'confirmed') badge-success
                    @elseif(strtolower($reserveroom->reservation_bookingstatus) == 'checked in') badge-primary
                    @elseif(strtolower($reserveroom->reservation_bookingstatus) == 'checked out') badge-warning
                    @elseif(strtolower($reserveroom->reservation_bookingstatus) == 'cancelled') badge-error
                    @endif">
                    {{ $reserveroom->reservation_bookingstatus }}
                </span>

                <div class="flex gap-2">
                    <button onclick="edit_reservation_{{ $reserveroom->reservationID }}.showModal()" class="btn btn-primary btn-sm">
                        Edit
                    </button>
                    <button onclick="delete_reservation_{{ $reserveroom->reservationID }}.showModal()" class="btn btn-error btn-sm">
                        Remove
                    </button>
                </div>
            </div>
        </div>
    @empty
        <p class="text-gray-500 text-center py-6">No reservations found.</p>
    @endforelse

    <!-- Pagination -->
    <div class="mt-4">
        {{ $reserverooms->links() }}
    </div>
</div>
