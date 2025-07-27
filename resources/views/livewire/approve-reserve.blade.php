<div wire:poll.5s="approvereserve" class="bg-white rounded-lg shadow-sm border border-gray-200 mt-5 p-5">
    <!-- Header with Filters -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
        <h3 class="text-xl font-bold text-gray-800">View Reservation And Occupied Rooms</h3>
        
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
                    placeholder="Search..." 
                    class="input input-bordered input-sm pl-8" 
                >
                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
        @forelse($reserverooms as $reserveroom)
        <div class="border border-gray-200 rounded-lg overflow-hidden hover:shadow-md transition-shadow">
            <!-- Room Image and Basic Info -->
            <div class="relative">
                <div class="h-40 bg-gray-200 flex items-center justify-center">
                    <img src="{{asset($reserveroom->roomphoto)}}" alt="">
                </div>
                <div class="absolute top-3 left-3 flex gap-2">
                    <span class="badge badge-primary badge-xs">{{ $reserveroom->roomtype }}</span>
                    <span class="badge 
                        @if(strtolower($reserveroom->reservation_bookingstatus) == 'pending') badge-neutral
                        @elseif(strtolower($reserveroom->reservation_bookingstatus) == 'confirmed') badge-success
                        @elseif(strtolower($reserveroom->reservation_bookingstatus) == 'checked in') badge-primary
                         @elseif(strtolower($reserveroom->reservation_bookingstatus) == 'checked out') badge-warning
                        @elseif(strtolower($reserveroom->reservation_bookingstatus) == 'cancelled') badge-error
                        @endif
                    ">
                        {{ $reserveroom->reservation_bookingstatus }}
                    </span>
                </div>
            </div>
            
            <!-- Room Details -->
            <div class="p-4">
                <h4 class="font-bold text-lg mb-1">Room #{{ $reserveroom->roomID }}</h4>
                <p class="text-black font-bold mb-2">{{ $reserveroom->guestname }}</p>
                
                <div class="flex justify-between text-sm mb-3">
                    <span>Check-in: {{ $reserveroom->reservation_checkin }}</span>
                    <span>Check-out: {{ $reserveroom->reservation_checkout }}</span>
                </div>
                
                <div class="flex justify-between items-center">
                    <span class="text-sm">Booked via: <span class="font-bold">{{ $reserveroom->bookedvia }}</span></span>
                  <!-- Inside your card component, replace the buttons div with this: -->
<div class="flex justify-end mt-3">

   <button onclick="edit_reservation_{{$reserveroom->reservationID}}.showModal()" 
          class="btn btn-xs btn-primary shadow-md">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
    </svg>
  </button>
  <!-- Trigger button -->
  <button onclick="document.getElementById('actions-drawer-{{$reserveroom->reservationID}}').classList.toggle('translate-x-full')"
          class="btn btn-xs btn-ghost">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
    </svg>
  </button>
  
  <!-- Actions Drawer -->
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
    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
    </svg>
    Confirm Reservation
</button>

      @if($reserveroom->reservation_bookingstatus === 'Confirmed')
      <button onclick="checkin_reservation_{{$reserveroom->reservationID}}.showModal()"
              class="btn btn-sm btn-block btn-primary justify-start gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        Check-In Guest
      </button>
      @endif
      
      @if($reserveroom->reservation_bookingstatus === 'Checked in')
      <button onclick="checkout_reservation_{{$reserveroom->reservationID}}.showModal()"
              class="btn btn-sm btn-block btn-warning btn-info justify-start gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
        </svg>
        Check-Out Guest
      </button>
      @endif


      @if($reserveroom->reservation_bookingstatus != 'Confirmed')
      <button onclick="cancel_reservation_{{$reserveroom->reservationID}}.showModal()"
              class="btn btn-sm btn-block btn-info justify-start gap-2 @if(in_array($reserveroom->reservation_bookingstatus, ['Confirmed', 'Checked in', 'Checked out'])) hidden @endif">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
        Cancel Reservation
      </button>
      @endif
      
      <button  onclick="delete_reservation_{{$reserveroom->reservationID}}.showModal()"
              class="btn btn-sm btn-block btn-error justify-start gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
        </svg>
        Delete Reservation
      </button>
    </div>
  </div>
</div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-3 text-center py-10">
            <div class="text-gray-400 mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
            </div>
            <p class="text-gray-500">No reservations found matching your criteria</p>
        </div>
        @endforelse
    </div>
</div>