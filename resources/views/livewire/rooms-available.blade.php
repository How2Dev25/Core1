<div class="mb-6" wire:poll.5s> <!-- Refresh every 500ms -->
  <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-4">
    <h3 class="text-xl font-bold text-gray-800">View All Rooms</h3>
    <div class="flex flex-col md:flex-row gap-3 w-full md:w-auto">
      <!-- Status Filter (live updates) -->
      <select wire:model.live="statusFilter" class="select select-bordered select-sm w-full md:w-auto">
        <option value="">All Statuses</option>
        <option value="Available">Available</option>
        <option value="Occupied">Occupied</option>
        <option value="Reserved">Reserved</option>
        <option value="Maintenance">Maintenance</option>
      </select>
      
      <!-- Room Type Filter (live updates) -->
      <select wire:model.live="typeFilter" class="select select-bordered select-sm w-full md:w-auto">
        <option value="">All Types</option>
        <option value="Standard">Standard</option>
        <option value="Deluxe">Deluxe</option>
        <option value="Suite">Suite</option>
        <option value="Executive">Executive</option>
      </select>
      
      <!-- Search Input (debounced live updates) -->
      <div class="relative w-full md:w-64">
        <input 
          type="text" 
          wire:model.live.debounce.300ms="searchTerm"
          placeholder="Search rooms..." 
          class="input input-bordered input-sm w-full pl-8" 
        >
        <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-3 top-1/2 transform -translate-y-1/2 h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
      </div>
    </div>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
    @forelse ($rooms as $room)
      <a href="/gotoroom/{{$room->roomID}}" class="card bg-base-100 shadow-sm hover:shadow-lg border-2 border-transparent hover:border-primary transition-all cursor-pointer relative group">
        <figure class="relative h-40 overflow-hidden rounded-t-box">
          <img src="{{ asset($room->roomphoto) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" alt="Room">
          <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-3">
            <h3 class="text-white font-medium text-sm">Room #{{$room->roomID}} - {{$room->roomtype}}</h3>
          </div>
        </figure>
        <div class="card-body p-4 space-y-1">
          <div class="flex justify-between items-center">
            <span class="badge 
              @if($room->roomstatus == 'Available') badge-success
              @elseif($room->roomstatus == 'Maintenance') badge-warning
              @elseif($room->roomstatus == 'Reserved') badge-info
              @elseif($room->roomstatus == 'Occupied') badge-error
              @endif
              badge-sm">
              {{$room->roomstatus}}
            </span>
            <span class="badge badge-outline badge-sm">₱{{number_format($room->roomprice, 2)}} /night</span>
          </div>
          <div class="flex items-center flex-wrap text-xs text-base-content/60 gap-2 pt-2">
            <i data-lucide="square" class="w-3 h-3"></i> {{$room->roomsize}} sq.ft
            <i data-lucide="users" class="w-3 h-3 ml-2"></i> {{$room->roommaxguest}} Guests
            <i data-lucide="wifi" class="w-3 h-3 ml-2"></i> {{$room->roomfeatures}}
          </div>
        </div>
      </a>
    @empty
      <div class="col-span-2 text-center py-12 text-base-content/70">
        <div class="p-4 rounded-full bg-base-300 inline-block mb-4">
          <i data-lucide="door-closed" class="w-10 h-10"></i>
        </div>
        <p class="font-medium">No rooms match your filters.</p>
      </div>
    @endforelse
  </div>
</div>