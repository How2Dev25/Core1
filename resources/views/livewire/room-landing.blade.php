<div wire:poll.5s class="mb-6"> <!-- Single root element for Livewire -->
  <!-- Enhanced Header Section -->
  <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6">
    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">
      <!-- Title Section -->
      <div class="flex items-center gap-4">
        <div
          class="w-14 h-14 bg-gradient-to-br from-blue-900 to-blue-700 rounded-xl flex items-center justify-center shadow-lg">
          <i class="fas fa-bed text-yellow-400 text-2xl"></i>
        </div>
        <div>
          <h3 class="text-3xl font-bold text-gray-900">Book A Room</h3>
          <p class="text-gray-600 text-sm">Find your perfect accommodation</p>
        </div>
      </div>

      <!-- Enhanced Filters Section -->
      <div class="flex flex-col md:flex-row gap-4 w-full lg:w-auto">
        <!-- Status Filter -->
        <div class="relative">
          <select wire:model.live="statusFilter"
            class="select select-bordered select-md w-full md:w-48 bg-white shadow-sm hover:shadow-md transition-shadow">
            <option value="Available">✅ Available</option>
          </select>
          <i
            class="fas fa-check-circle absolute left-3 top-1/2 transform -translate-y-1/2 text-green-500 pointer-events-none"></i>
        </div>

        <!-- Room Type Filter -->
        <div class="relative">
          <select wire:model.live="typeFilter"
            class="select select-bordered select-md w-full md:w-48 bg-white shadow-sm hover:shadow-md transition-shadow">
            <option value="">🏠 All Types</option>
            <option value="Standard">🛏️ Standard</option>
            <option value="Deluxe">✨ Deluxe</option>
            <option value="Suite">👑 Suite</option>
            <option value="Executive">💼 Executive</option>
          </select>
          <i
            class="fas fa-building absolute left-3 top-1/2 transform -translate-y-1/2 text-blue-500 pointer-events-none"></i>
        </div>

        <!-- Enhanced Search Input -->
        <div class="relative w-full md:w-72">
          <input type="text" wire:model.live.debounce.300ms="searchTerm" placeholder="Search rooms by number or type..."
            class="input input-bordered input-md w-full pl-12 pr-4 bg-white shadow-sm hover:shadow-md focus:shadow-lg transition-shadow">
          <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
          <div class="absolute right-3 top-1/2 transform -translate-y-1/2">
            <div wire:loading wire:target="searchTerm" class="loading loading-spinner loading-sm text-blue-500"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Enhanced Room Grid -->
  <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-8">
    @forelse ($rooms as $room)
      <a href="/selectedroom/{{$room->roomID}}" class="group">
        <div
          class="card bg-white shadow-lg hover:shadow-2xl border border-gray-100 hover:border-blue-200 transition-all duration-300 cursor-pointer overflow-hidden">
          <!-- Enlarged Image Section -->
          <figure class="relative h-64 overflow-hidden">
            <img src="{{ asset($room->roomphoto) }}"
              class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500 ease-out"
              alt="Room {{$room->roomID}}">

            <!-- Image Overlay -->
            <div
              class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent opacity-80 group-hover:opacity-90 transition-opacity">
            </div>

            <!-- Floating Status Badge -->
            <div class="absolute top-4 left-4">
              <span class="badge 
                    @if($room->roomstatus == 'Available') badge-success
                    @elseif($room->roomstatus == 'Maintenance') badge-warning
                    @elseif($room->roomstatus == 'Reserved') badge-info
                    @elseif($room->roomstatus == 'Occupied') badge-error
                    @endif
                    shadow-lg backdrop-blur-sm bg-white/90 text-gray-800 font-medium px-3 py-2 text-sm">
                @if($room->roomstatus == 'Available')
                  <i class="fas fa-check-circle mr-1"></i>
                @elseif($room->roomstatus == 'Maintenance')
                  <i class="fas fa-tools mr-1"></i>
                @elseif($room->roomstatus == 'Reserved')
                  <i class="fas fa-clock mr-1"></i>
                @elseif($room->roomstatus == 'Occupied')
                  <i class="fas fa-user mr-1"></i>
                @endif
                {{$room->roomstatus}}
              </span>
            </div>

            <!-- Price Tag -->
            <div class="absolute top-4 right-4">
              <div
                class="bg-gradient-to-r from-yellow-400 to-yellow-500 text-gray-900 px-4 py-2 rounded-full shadow-lg font-bold text-sm">
                ₱{{number_format($room->roomprice, 2)}}
                <span class="text-xs opacity-80">/night</span>
              </div>
            </div>

            <!-- Room Title Overlay -->
            <div class="absolute bottom-0 left-0 right-0 p-6">
              <h3 class="text-white font-bold text-xl mb-1 drop-shadow-lg">
                Room #{{$room->roomID}}
              </h3>
              <p class="text-yellow-400 font-semibold text-lg drop-shadow-lg">
                {{$room->roomtype}}
              </p>
            </div>
          </figure>

          <!-- Enhanced Card Body -->
          <div class="card-body p-6 space-y-4">
            <!-- Room Features Grid -->
            <div class="grid grid-cols-2 gap-4">
              <div class="flex items-center gap-2 text-gray-600">
                <div class="w-8 h-8 bg-blue-50 rounded-lg flex items-center justify-center">
                  <i class="fas fa-expand-arrows-alt text-blue-500 text-sm"></i>
                </div>
                <div>
                  <p class="text-xs text-gray-500 leading-none">Size</p>
                  <p class="font-semibold text-sm">{{$room->roomsize}} sq.ft</p>
                </div>
              </div>

              <div class="flex items-center gap-2 text-gray-600">
                <div class="w-8 h-8 bg-green-50 rounded-lg flex items-center justify-center">
                  <i class="fas fa-users text-green-500 text-sm"></i>
                </div>
                <div>
                  <p class="text-xs text-gray-500 leading-none">Capacity</p>
                  <p class="font-semibold text-sm">{{$room->roommaxguest}} Guests</p>
                </div>
              </div>
            </div>

            <!-- Room Features -->
            <div class="border-t pt-4">
              <div class="flex items-center gap-2 mb-2">
                <i class="fas fa-star text-yellow-400"></i>
                <span class="text-sm font-medium text-gray-700">Features</span>
              </div>
              <div class="flex flex-wrap gap-2">
                @foreach(explode(',', $room->roomfeatures) as $feature)
                  <span class="badge badge-outline badge-sm">
                    <i class="fas fa-wifi text-xs mr-1"></i>
                    {{trim($feature)}}
                  </span>
                @endforeach
              </div>
            </div>

            <!-- Book Now Button -->
            <div class="pt-2">
              <div
                class="w-full bg-gradient-to-r from-blue-900 to-blue-700 hover:from-blue-800 hover:to-blue-600 text-white py-3 px-4 rounded-xl font-semibold text-center transition-all duration-300 group-hover:shadow-lg">
                <i class="fas fa-calendar-check mr-2"></i>
                Book Now
                <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
              </div>
            </div>
          </div>
        </div>
      </a>
    @empty
      <!-- Enhanced Empty State -->
      <div class="col-span-full">
        <div class="text-center py-16 bg-white rounded-2xl border-2 border-dashed border-gray-200">
          <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
            <i class="fas fa-bed text-3xl text-gray-400"></i>
          </div>
          <h3 class="text-xl font-semibold text-gray-900 mb-2">No rooms available</h3>
          <p class="text-gray-600 mb-6">No rooms match your current filters. Try adjusting your search criteria.</p>
          <button class="btn btn-outline btn-sm" onclick="clearFilters()">
            <i class="fas fa-refresh mr-2"></i>
            Clear Filters
          </button>
        </div>
      </div>
    @endforelse
  </div>

  <!-- Loading State -->
  <div wire:loading.flex wire:target="statusFilter,typeFilter,searchTerm"
    class="fixed inset-0 bg-black/20 backdrop-blur-sm z-50 items-center justify-center">
    <div class="bg-white rounded-2xl p-8 shadow-2xl">
      <div class="flex items-center gap-4">
        <div class="loading loading-spinner loading-lg text-blue-500"></div>
        <div>
          <p class="font-semibold text-gray-900">Updating rooms...</p>
          <p class="text-sm text-gray-600">Please wait a moment</p>
        </div>
      </div>
    </div>
  </div>
</div>