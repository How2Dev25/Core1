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

  <!-- Left side: Room & Guest Info -->
  <div class="flex-1 space-y-3">
    <!-- Room Header -->
    <div class="flex flex-wrap items-center gap-3">
      <h4 class="font-bold text-xl flex items-center gap-2 text-primary">
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
    <div class="space-y-1">
      <p class="text-black font-semibold flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A9 9 0 1112 21a9 9 0 01-6.879-3.196z" />
        </svg>
        {{ $reserveroom->guestname }}
      </p>
      <p class="text-black font-semibold flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V7l-6-6H7a2 2 0 00-2 2v16a2 2 0 002 2z" />
        </svg>
        Booking ID: {{ $reserveroom->bookingID}}
      </p>
    </div>

    <!-- Reservation Details & Billing -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-2 gap-x-6 text-sm text-gray-600">
      <div class="flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3M3 11h18M5 21h14a2 2 0 002-2V7H3v12a2 2 0 002 2z" />
        </svg>
        <span class="font-medium">Check-in:</span> {{ \Carbon\Carbon::parse($reserveroom->reservation_checkin)->format('M d, Y') }}
      </div>

      <div class="flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3M3 11h18M5 21h14a2 2 0 002-2V7H3v12a2 2 0 002 2z" />
        </svg>
        <span class="font-medium">Check-out:</span> {{ \Carbon\Carbon::parse($reserveroom->reservation_checkout)->format('M d, Y') }}
      </div>

      <div class="flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3C7.03 3 3 7.03 3 12s4.03 9 9 9 9-4.03 9-9-4.03-9-9-9z" />
        </svg>
        <span class="font-medium">Booked via:</span> {{ $reserveroom->bookedvia }}
      </div>

      <div class="flex items-center gap-2">
    <!-- calendar-check icon for booked date -->
    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3M3 11h18M5 21h14a2 2 0 002-2V7H3v12a2 2 0 002 2z" />
    </svg>
    <span class="font-medium">Booked Date:</span> 
    {{ \Carbon\Carbon::parse($reserveroom->created_at)->format('M d, Y') }}
</div>

      <div class="flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 11h18m-2 6H5a2 2 0 01-2-2V7a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2z" />
        </svg>
        <span class="font-medium">Payment Method:</span> {{ $reserveroom->payment_method }}
      </div>

      <!-- Billing -->
      @php
        $nights = \Carbon\Carbon::parse($reserveroom->reservation_checkin)
                    ->diffInDays(\Carbon\Carbon::parse($reserveroom->reservation_checkout));
        $subtotal = $reserveroom->roomprice * $nights;
        $vat = $subtotal * 0.12;
        $serviceFee = $subtotal * 0.02;
        $total = $subtotal + $vat + $serviceFee;
      @endphp

      <div class="flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z" />
        </svg>
        <span class="font-medium">Nights:</span> {{ $nights }}
      </div>

      <div class="flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6M9 11h6m-7 4h8M5 21h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v14a2 2 0 002 2z" />
        </svg>
        <span class="font-medium">Subtotal:</span> ₱{{ number_format($subtotal, 2) }}
      </div>

      <div class="flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 6L6 18M6 6h.01M18 18h.01" />
        </svg>
        <span class="font-medium">Service Fee (2%):</span> ₱{{ number_format($serviceFee, 2) }}
      </div>

      <div class="flex items-center gap-2 font-bold text-primary">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6M9 11h6m-7 4h8M5 21h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v14a2 2 0 002 2z" />
        </svg>
        <span>Total:</span> ₱{{ number_format($total, 2) }}
      </div>
    </div>
  </div>

  <!-- Right side: Actions -->
  <div class="flex flex-col md:items-end gap-2 mt-3 md:mt-0">
    <button onclick="document.getElementById('edit_reservation_{{$reserveroom->reservationID}}').showModal()" class="btn btn-xs btn-primary shadow-sm">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
      </svg>
    </button>

   <button onclick="delete_reservation_{{ $reserveroom->reservationID }}.showModal()" class="btn btn-error btn-xs flex items-center justify-center gap-2">
    <!-- Trash SVG icon -->
    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M1 7h22M10 3h4a1 1 0 011 1v2H9V4a1 1 0 011-1z"/>
    </svg>
</button>

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
