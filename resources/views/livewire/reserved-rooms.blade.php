<div wire:poll.5s="fetchreservedrooms" class="mt-5">
  <!-- Filters -->
  <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-6">
    <!-- Search -->
    <input type="text" wire:model.debounce.500ms="search" placeholder="Search by guest or room no."
      class="input input-bordered w-full md:w-1/3" />

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

  <h3 class="text-xl font-bold text-gray-800 mb-4">Reserved and Occupied Rooms</h3>

  <!-- Table View -->
  <div class="overflow-x-auto bg-white rounded-lg shadow border border-gray-200">
    <table class="table table-auto w-full">
      <thead>
        <tr class="bg-blue-900 text-white text-sm">
          <th class="py-3 px-4 text-left">Room & Guest</th>
          <th class="py-3 px-4 text-left">Booking Details</th>
          <th class="py-3 px-4 text-left">Status</th>
          <th class="py-3 px-4 text-left">Payment</th>
          <th class="py-3 px-4 text-center">Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($reserverooms as $reserveroom)
          @php
            $nights = \Carbon\Carbon::parse($reserveroom->reservation_checkin)
              ->diffInDays(\Carbon\Carbon::parse($reserveroom->reservation_checkout));
            $subtotal = $reserveroom->subtotal;
            $vat = $reserveroom->vat;
            $serviceFee = $reserveroom->serviceFee;
            $total = $reserveroom->total;

          @endphp

          <tr class="border-t border-gray-100 hover:bg-gray-50">
            <!-- Room & Guest Info -->
            <td class="py-4 px-4">
              <div class="flex items-center gap-3">
                <div class="bg-primary/10 p-2 rounded-lg">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                  </svg>
                </div>
                <div>
                  <div class="font-semibold">Room #{{ $reserveroom->roomID }}</div>
                  <div class="text-sm text-gray-600">{{ $reserveroom->guestname }}</div>
                  <div class="text-xs text-gray-500 mt-1">{{ $reserveroom->roomtype }}</div>
                </div>
              </div>
            </td>

            <!-- Booking Details -->
            <td class="py-4 px-4">
              <div class="text-sm space-y-1">
                <div class="flex items-center gap-1">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-primary" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M8 7V3m8 4V3M3 11h18M5 21h14a2 2 0 002-2V7H3v12a2 2 0 002 2极速赛车开奖直播" />
                  </svg>
                  <span>{{ \Carbon\Carbon::parse($reserveroom->reservation_checkin)->format('M d, Y') }}</span>
                  <span class="mx-1">-</span>
                  <span>{{ \Carbon\Carbon::parse($reserveroom->reservation_checkout)->format('M d, Y') }}</span>
                </div>
                <div class="text-xs text-gray-500">
                  ID: {{ $reserveroom->bookingID }} • {{ $nights }} nights
                </div>
                <div class="text-xs text-gray-500">
                  {{ $reserveroom->bookedvia }} • {{ \Carbon\Carbon::parse($reserveroom->created_at)->format('M d, Y') }}
                </div>
                <div class="font-medium text-primary mt-1">
                  ₱{{ number_format($total, 2) }}
                </div>
              </div>
            </td>

            <!-- Status -->
            <td class="py-4 px-4">
              <span class="badge py-1.5 px-3
                                                          @if(strtolower($reserveroom->reservation_bookingstatus) == 'pending') badge-neutral
                                                          @elseif(strtolower($reserveroom->reservation_bookingstatus) == 'confirmed') badge-success
                                                          @elseif(strtolower($reserveroom->reservation_bookingstatus) == 'checked in') badge-primary
                                                          @elseif(strtolower($reserveroom->reservation_bookingstatus) == 'checked out') badge-warning
                                                          @elseif(strtolower($reserveroom->reservation_bookingstatus) == 'cancelled') badge-error
                                                          @endif
                                                      ">
                {{ ucfirst($reserveroom->reservation_bookingstatus) }}
              </span>
            </td>

            <!-- Payment -->
            <td class="py-4 px-4">
              <div class="text-sm">
                <span class="
                                                              @if(strtolower($reserveroom->payment_status) == 'pending') text-yellow-600 font-semibold
                                                              @elseif(strtolower($reserveroom->payment_status) == 'paid') text-green-600 font-semibold
                                                              @elseif(strtolower($reserveroom->payment_status) == 'failed') text-red-600 font-semibold
                                                              @else text-gray-600
                                                              @endif
                                                          ">
                  {{ ucfirst($reserveroom->payment_status) }}
                </span>
                <div class="text-xs text-gray-500 mt-1">
                  {{ $reserveroom->payment_method }}
                </div>
              </div>
            </td>

            <!-- Actions -->
            <td class="py-4 px-4">
              <div class="flex justify-center items-center gap-2">
                <!-- Edit Button -->
                <button onclick="document.getElementById('edit_reservation_{{$reserveroom->reservationID}}').showModal()"
                  class="btn btn-sm btn-ghost" title="Edit Reservation">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 11l6.232-6.232a2.121 
                                             2.121 0 113 3L12 14H9v-3z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 19H5a2 2 0 01-2-2V7a2 2 0 
                                             012-2h7" />
                  </svg>
                </button>

                <!-- Delete Button -->
                <button onclick="delete_reservation_{{ $reserveroom->reservationID }}.showModal()"
                  class="btn btn-sm btn-ghost text-error" title="Delete Reservation">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M1 7h22M10 3h4a1 1 0 011 1v2H9V4a1 1 0 011-1z" />
                  </svg>
                </button>

                <!-- View Details Button -->
                <button onclick="details_modal_{{$reserveroom->reservationID}}.showModal()" class="btn btn-sm btn-ghost"
                  title="View Details">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                </button>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="5" class="py-8 text-center">
              <div class="text-gray-400 mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1极速赛车开奖直播h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
              </div>
              <p class="text-gray-500">No reservations found.</p>
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <!-- Pagination -->
  <div class="mt-6">
    {{ $reserverooms->links() }}
  </div>
</div>