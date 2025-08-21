<div class="mb-10 mt-5">
  <!-- Filters -->
  <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-6 gap-3">
    <h3 class="text-2xl font-bold text-gray-800">Rooms</h3>
    <div class="flex flex-wrap gap-3">

      <!-- Category Filter -->
      <select wire:model="category" class="select select-bordered select-sm">
        <option value="">All Categories</option>
        <option value="Standard">Standard</option>
        <option value="Deluxe">Deluxe</option>
        <option value="Suite">Suite</option>
        <option value="Executive">Executive</option>
      </select>

      <!-- Search -->
      <div class="relative">
        <input 
          type="text" 
          wire:model.debounce.500ms="search" 
          placeholder="🔍 Search rooms..." 
          class="input input-bordered input-sm pr-8"
        >
        <svg xmlns="http://www.w3.org/2000/svg" 
             class="h-4 w-4 absolute right-2 top-1/2 -translate-y-1/2 text-gray-400" 
             fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
      </div>
    </div>
  </div>

  <!-- Room Cards -->
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($rooms as $room)
      <a href="/roomdetails/{{$room->roomID}}" 
         class="card bg-white border border-gray-200 rounded-2xl hover:shadow-lg transition duration-300 overflow-hidden group">

        <!-- Room Image -->
        <figure class="relative h-48">
          <img src="{{ asset($room->roomphoto) }}" 
               alt="Room Photo" 
               class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
          <div class="absolute top-3 right-3 space-x-1">
            <span class="badge 
              @if($room->roomtype == 'Standard') badge-info
              @elseif($room->roomtype == 'Deluxe') badge-primary
              @elseif($room->roomtype == 'Suite') badge-secondary
              @elseif($room->roomtype == 'Executive') badge-accent
              @endif">
              {{ $room->roomtype }}
            </span>
            <span class="badge
              @if($room->roomstatus == 'Available') badge-success
              @elseif($room->roomstatus == 'Maintenance') badge-warning
              @elseif($room->roomstatus == 'Reserved') badge-info
              @elseif($room->roomstatus == 'Occupied') badge-error
              @else badge-neutral
              @endif">
              {{ $room->roomstatus }}
            </span>
          </div>
        </figure>

        <!-- Card Body -->
        <div class="card-body p-5">
          <div class="flex justify-between items-start">
            <p class="text-black font-bold text-lg">Room #{{ $room->roomID }}</p>
            <div class="text-right">
              <p class="text-sm text-gray-500">From</p>
              <p class="text-xl font-bold text-primary">₱{{ number_format($room->roomprice, 2) }}/night</p>
            </div>
          </div>
          
          <div class="flex items-center gap-4 mt-3 text-sm text-gray-600">
            <div class="flex items-center">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" 
                   viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3" />
              </svg>
              {{ $room->roomsize ?? '-' }} sqft
            </div>
            <div class="flex items-center">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" 
                   viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1z" />
              </svg>
              {{ $room->roommaxguest }} Guests
            </div>
          </div>

          
          
          <div class="mt-4">
            <p class="text-sm text-blue-600 line-clamp-2">{{ $room->roomfeatures }}</p>
          </div>
        </div>
      </a>
    @empty
      <div class="w-full text-center py-10 px-4 bg-gray-50 rounded-xl border border-dashed border-gray-300">
        <img src="{{ asset('images/defaults/default.jpg') }}" alt="No rooms" class="mx-auto mb-4 w-40 opacity-70">
        <h2 class="text-xl font-semibold text-gray-700 mb-2">No Rooms Found</h2>
        <p class="text-gray-500">Try adjusting your filters or search keyword.</p>
      </div>
    @endforelse
  </div>

  <!-- Pagination -->
  @if($rooms->hasPages())
    <div class="mt-8 flex justify-center">
      {{ $rooms->links() }}
    </div>
  @endif
</div>
