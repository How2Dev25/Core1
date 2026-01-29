<div wire:poll.5s class="mb-6">
  <!-- Header Section -->
  <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl shadow-xl p-8 mb-8 text-white">
    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">
      <!-- Title -->
      <div class="flex items-center gap-4">
        <div
          class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center shadow-lg">
          <i class="fas fa-bed text-yellow-400 text-3xl"></i>
        </div>
        <div>
          <h1 class="text-4xl font-bold mb-2">Book A Room</h1>
          <p class="text-blue-100 text-lg">Choose your perfect accommodation from our available room types</p>
        </div>
      </div>

      <!-- Flash Messages -->
      @if(session()->has('error'))
        <div class="alert alert-error bg-red-500/20 border-red-400 text-white">
          <i class="fas fa-exclamation-triangle mr-2"></i>
          <span>{{ session('error') }}</span>
        </div>
      @endif
    </div>
  </div>

  <!-- Room Types Grid -->
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
    @forelse ($roomTypesWithCounts as $roomType)
      <div wire:click="selectRoomType('{{ $roomType->roomtype }}')" 
           class="group cursor-pointer transform transition-all duration-300 hover:scale-105">
        <div
          class="card bg-white rounded-2xl shadow-lg hover:shadow-2xl border-0 overflow-hidden h-full">
          <!-- Room Image -->
          <div class="relative h-48 overflow-hidden">
            @if($roomType->sample_photo)
              <img src="{{ asset($roomType->sample_photo) }}"
                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500 ease-out"
                alt="{{ $roomType->roomtype }} Room">
              <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent opacity-80 group-hover:opacity-90 transition-opacity">
              </div>
            @else
              <div class="w-full h-full bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center">
                <i class="fas fa-door-open text-white text-4xl"></i>
              </div>
              <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent">
              </div>
            @endif
            
            <!-- Overlay Content -->
            <div class="absolute bottom-0 left-0 right-0 p-4">
              <div class="flex items-center justify-between">
                <h3 class="text-white font-bold text-xl drop-shadow-lg">{{ $roomType->roomtype }}</h3>
                <div class="bg-blue-900 text-white px-3 py-1 rounded-full text-sm font-semibold">
                  {{ $roomType->available_count }} Available
                </div>
              </div>
            </div>
          </div>

          <!-- Card Body -->
          <div class="card-body p-5 space-y-4">
            <!-- Price -->
            @if($roomType->sample_price)
              <div class="text-center">
                <div class="text-2xl font-bold text-gray-900">
                  ₱{{ number_format($roomType->sample_price, 2) }}
                  <span class="text-sm font-normal text-gray-500">/night</span>
                </div>
              </div>
            @endif

            <!-- Room Details -->
            @if($roomType->sample_size && $roomType->sample_maxguest)
              <div class="grid grid-cols-2 gap-3">
                <div class="flex items-center gap-2 text-gray-600 bg-gray-50 rounded-lg p-2">
                  <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-expand-arrows-alt text-blue-500 text-sm"></i>
                  </div>
                  <div>
                    <p class="text-xs text-gray-500 leading-none">Size</p>
                    <p class="font-semibold text-sm">{{ $roomType->sample_size }} sq.ft</p>
                  </div>
                </div>

                <div class="flex items-center gap-2 text-gray-600 bg-gray-50 rounded-lg p-2">
                  <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-users text-green-500 text-sm"></i>
                  </div>
                  <div>
                    <p class="text-xs text-gray-500 leading-none">Capacity</p>
                    <p class="font-semibold text-sm">{{ $roomType->sample_maxguest }} Guests</p>
                  </div>
                </div>
              </div>
            @endif

            <!-- Select Button -->
            <div class="pt-2">
              <button
                class="w-full btn btn-primary">
                <i class="fas fa-arrow-right mr-2"></i>
                Select {{ $roomType->roomtype }}
                <i class="fas fa-bed ml-2"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
    @empty
      <div class="col-span-full">
        <div class="text-center py-20 bg-white rounded-2xl border-2 border-dashed border-gray-200">
          <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
            <i class="fas fa-bed text-4xl text-gray-400"></i>
          </div>
          <h3 class="text-2xl font-bold text-gray-900 mb-3">No Rooms Available</h3>
          <p class="text-gray-600 text-lg mb-6">There are currently no available rooms. Please check back later.</p>
          <button class="btn btn-primary" onclick="window.location.reload()">
            <i class="fas fa-refresh mr-2"></i>
            Refresh
          </button>
        </div>
      </div>
    @endforelse
  </div>
</div>