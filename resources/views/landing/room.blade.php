<section id="rooms" class="py-20 px-4 bg-gray-50">
  <div class="max-w-7xl mx-auto">
    <!-- Section Header -->
    <div class="text-center mb-16" data-aos="fade-up">
      <h2 class="text-4xl md:text-5xl font-bold mb-4">
        Our <span class="text-[#F7B32B]">Rooms & Suites</span>
      </h2>
      <p class="text-gray-600 text-lg max-w-2xl mx-auto">
        Experience luxury and comfort in our thoughtfully designed accommodations
      </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
      <!-- Room Type Cards -->
      @forelse($rooms as $index => $roomType)
        <div wire:click="window.location.href='/roomselectionlanding'" 
             class="group cursor-pointer transform transition-all duration-300 hover:scale-105"
             data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
          <div class="card bg-white rounded-2xl shadow-lg hover:shadow-2xl border-0 overflow-hidden h-full">
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

              <!-- Floating Badge -->
              
            </div>

            <!-- Card Body -->
            <div class="card-body p-5 space-y-4">
              <!-- Price -->
              @if($roomType->sample_price)
                <div class="text-center">
                  <div class="text-2xl font-bold text-[#F7B32B]">
                    ₱{{ number_format($roomType->sample_price, 2) }}
                    <span class="text-sm font-normal text-gray-500">/night</span>
                  </div>
                </div>
              @endif

              <!-- Features -->
              @if($roomType->sample_features)
                <p class="text-sm text-gray-600 line-clamp-2 leading-relaxed">
                  {{ $roomType->sample_features }}
                </p>
              @endif

              <!-- Room Details -->
              @if($roomType->sample_size && $roomType->sample_maxguest)
                <div class="flex items-center gap-3 text-gray-500 text-xs">
                  <span class="flex items-center gap-1">
                    <i class="fas fa-expand-arrows-alt"></i>
                    <span>{{ $roomType->sample_size }} sq.ft</span>
                  </span>
                  <span class="flex items-center gap-1">
                    <i class="fas fa-user"></i>
                    <span>{{ $roomType->sample_maxguest }} Guests</span>
                  </span>
                  <span class="flex items-center gap-1">
                    <i class="fas fa-wifi"></i>
                    <span>Free WiFi</span>
                  </span>
                </div>
              @endif

              <!-- Select Button -->
              <div class="pt-2">
                <a href="/roomselectionlanding"
                  class="w-full btn btn-primary">
                  <i class="fas fa-arrow-right mr-2"></i>
                  Explore {{ $roomType->roomtype }}
                  <i class="fas fa-bed ml-2"></i>
                </a>
              </div>
            </div>
          </div>

          <!-- Decorative Corner Element -->
          <div
            class="absolute -bottom-10 -right-10 w-32 h-32 bg-[#F7B32B]/20 rounded-full blur-3xl group-hover:bg-[#F7B32B]/30 transition-all duration-700">
          </div>
        </div>
      @empty
        <!-- Empty State -->
        <div class="col-span-full text-center py-20 px-4">
          <div class="inline-flex items-center justify-center w-24 h-24 bg-blue-50 rounded-full mb-6">
            <i class="fas fa-door-open text-5xl text-blue-900"></i>
          </div>
          <h3 class="text-2xl font-bold text-gray-900 mb-3">No Rooms Available</h3>
          <p class="text-gray-500 text-lg mb-6 max-w-md mx-auto">
            We're currently fully booked or updating our room inventory. Please check back later or contact us directly.
          </p>
          <button
            class="px-8 py-3 bg-blue-900 hover:bg-blue-800 text-white font-semibold rounded-xl transition-all duration-300 shadow-lg">
            Contact Us
          </button>
        </div>
      @endforelse
    </div>

    <!-- View All Rooms Button -->
    <div class="text-center mt-12" data-aos="fade-up">
      <a href="/roomselectionlanding"
        class="px-10 py-4 bg-[#F7B32B] hover:bg-[#e5a526] text-blue-900 font-bold rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
        View All Rooms
        <i class="fas fa-arrow-right ml-2"></i>
      </a>
    </div>
  </div>
</section>

<style>
  /* Line clamp utility */
  .line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }

  /* Smooth transitions for all interactive elements */
  button {
    transition: all 0.3s ease;
  }

  /* Enhanced shadow on hover */
  .group:hover .shadow-lg {
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Initialize AOS if available
    if (typeof AOS !== 'undefined') {
      AOS.init({
        duration: 800,
        once: true,
        offset: 100,
        easing: 'ease-out'
      });
    }
  });
</script>