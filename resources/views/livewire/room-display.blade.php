<div class="w-full">
  <!-- Header Section -->
  <div
    class="bg-gradient-to-br from-blue-900 via-blue-800 to-blue-900 rounded-2xl shadow-2xl p-8 mb-8 text-white relative overflow-hidden">
    <!-- Decorative Background Pattern -->
    <div class="absolute inset-0 opacity-10">
      <div
        class="absolute top-0 right-0 w-64 h-64 bg-yellow-400 rounded-full blur-3xl transform translate-x-32 -translate-y-32">
      </div>
      <div
        class="absolute bottom-0 left-0 w-64 h-64 bg-blue-600 rounded-full blur-3xl transform -translate-x-32 translate-y-32">
      </div>
    </div>

    <div class="relative flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">
      <!-- Title -->
      <div class="flex items-center gap-4">
        <div
          class="w-16 h-16 bg-yellow-400 rounded-2xl flex items-center justify-center shadow-2xl transform hover:rotate-6 transition-transform duration-300">
          <i class="fas fa-bed text-blue-900 text-3xl"></i>
        </div>
        <div>
          <h1 class="text-4xl font-bold mb-2 text-white">Available Rooms</h1>
          <p class="text-yellow-400 text-base font-medium">Choose your perfect accommodation from our available room
            types</p>
        </div>
      </div>

      <!-- Flash Messages -->
      @if(session()->has('error'))
        <div
          class="alert alert-error bg-red-600/30 backdrop-blur-sm border-2 border-red-400 text-white px-6 py-4 rounded-xl shadow-xl">
          <i class="fas fa-exclamation-triangle mr-2 text-yellow-400"></i>
          <span>{{ session('error') }}</span>
        </div>
      @endif
    </div>
  </div>

  <!-- Room Types Grid -->
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 gap-6">
    @forelse ($roomTypesWithCounts as $roomType)
      <div wire:click="selectRoomType('{{ $roomType->roomtype }}')"
        class="group cursor-pointer transform transition-all duration-300 hover:scale-[1.02] hover:-translate-y-1">
        <div
          class="card bg-white rounded-2xl shadow-xl hover:shadow-2xl border-2 border-gray-100 hover:border-yellow-400 overflow-hidden h-full transition-all duration-300">
          
          <!-- Room Image - Large and Prominent -->
          <div class="relative h-80 overflow-hidden">
            @if($roomType->sample_photo)
              <img src="{{ asset($roomType->sample_photo) }}"
                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out"
                alt="{{ $roomType->roomtype }} Room">
            @else
              <div
                class="w-full h-full bg-gradient-to-br from-blue-800 via-blue-900 to-blue-950 flex items-center justify-center">
                <i class="fas fa-door-open text-yellow-400 text-6xl opacity-50"></i>
              </div>
            @endif

            <!-- Only availability badge on image -->
            <div class="absolute top-4 right-4">
              <div class="bg-yellow-400 text-blue-900 px-4 py-2 rounded-full text-sm font-bold shadow-2xl backdrop-blur-sm">
                {{ $roomType->available_count }} Available
              </div>
            </div>
          </div>

          <!-- Card Body - All text content below image -->
          <div class="p-6 space-y-4">
            <!-- Room Type Name -->
            <div class="flex items-center justify-between">
              <h3 class="text-2xl font-bold text-blue-900">{{ $roomType->roomtype }}</h3>
              <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-yellow-400 text-blue-900 text-xs font-bold rounded-full">
                <i class="fas fa-crown text-xs"></i>
                Premium
              </span>
            </div>

            <!-- Price -->
            @if($roomType->sample_price)
              <div class="flex items-baseline gap-2">
                <span class="text-3xl font-bold text-yellow-400">₱{{ number_format($roomType->sample_price, 2) }}</span>
                <span class="text-sm text-blue-900/60 font-medium">/night</span>
              </div>
            @endif

            <!-- Features -->
            @if($roomType->sample_features)
              <p class="text-sm text-blue-900/70 leading-relaxed">
                {{ $roomType->sample_features }}
              </p>
            @endif

            <!-- Room Details -->
            @if($roomType->sample_size && $roomType->sample_maxguest)
              <div class="flex items-center gap-6 text-blue-900/80 text-sm pt-2 border-t border-blue-900/10">
                <span class="flex items-center gap-2">
                  <i class="fas fa-expand-arrows-alt text-yellow-400"></i>
                  <span class="font-medium">{{ $roomType->sample_size }} sq.ft</span>
                </span>
                <span class="flex items-center gap-2">
                  <i class="fas fa-user text-yellow-400"></i>
                  <span class="font-medium">{{ $roomType->sample_maxguest }} Guests</span>
                </span>
                <span class="flex items-center gap-2">
                  <i class="fas fa-wifi text-yellow-400"></i>
                  <span class="font-medium">WiFi</span>
                </span>
              </div>
            @endif

            <!-- Select Button -->
            <div class="pt-3">
              <button
                class="w-full bg-gradient-to-r from-blue-900 via-blue-800 to-blue-900 hover:from-blue-800 hover:via-blue-700 hover:to-blue-800 text-yellow-400 py-4 px-4 rounded-xl font-bold text-center transition-all duration-300 shadow-lg hover:shadow-2xl transform hover:-translate-y-1 text-base border-2 border-yellow-400/20 hover:border-yellow-400/40">
                <i class="fas fa-arrow-right mr-2 text-sm"></i>
                Select This Room
              </button>
            </div>
          </div>
        </div>
      </div>
    @empty
      <div class="col-span-full">
        <div
          class="text-center py-20 bg-gradient-to-br from-blue-50 to-white rounded-2xl border-4 border-dashed border-blue-900/20 shadow-xl">
          <div
            class="w-24 h-24 bg-gradient-to-br from-blue-900 to-blue-800 rounded-full flex items-center justify-center mx-auto mb-6 shadow-2xl">
            <i class="fas fa-bed text-4xl text-yellow-400"></i>
          </div>
          <h3 class="text-2xl font-bold text-blue-900 mb-3">No Rooms Available</h3>
          <p class="text-blue-900/70 text-base mb-6 max-w-md mx-auto">There are currently no available rooms. Please check
            back later or contact our support team.</p>
          <button
            class="btn bg-blue-900 hover:bg-blue-800 text-yellow-400 border-2 border-yellow-400/20 hover:border-yellow-400/40 px-6 py-3 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all duration-300"
            onclick="window.location.reload()">
            <i class="fas fa-refresh mr-2"></i>
            Refresh Page
          </button>
        </div>
      </div>
    @endforelse
  </div>
</div>