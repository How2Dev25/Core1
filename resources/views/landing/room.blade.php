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

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      <!-- Room Cards -->
      @forelse($rooms as $index => $room)
        <div
          class="group relative rounded-2xl overflow-hidden bg-white shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2"
          data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">

          <!-- Image Container -->
          <div class="relative h-72 overflow-hidden">
            <img src="{{ asset($room->roomphoto) }}" alt="{{ $room->roomtype }}"
              class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">

            <!-- Overlay Gradient -->
            <div
              class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent opacity-60 group-hover:opacity-80 transition-opacity duration-500">
            </div>

            <!-- Floating Badge -->
            <div class="absolute top-4 left-4">
              <span
                class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-[#F7B32B] text-blue-900 text-xs font-bold rounded-full shadow-lg">
                <i class="fas fa-crown"></i>
                Premium
              </span>
            </div>

            <!-- Favorite Icon -->
            <button
              class="absolute top-4 right-4 w-10 h-10 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 hover:bg-white/30">
              <i class="far fa-heart text-white"></i>
            </button>
          </div>

          <!-- Content Section -->
          <div class="p-6">
            <!-- Room Type -->
            <h3 class="text-2xl font-bold text-gray-900 mb-3 group-hover:text-blue-900 transition-colors duration-300">
              {{ $room->roomtype }}
            </h3>

            <!-- Features -->
            <p class="text-sm text-gray-600 mb-4 line-clamp-2 leading-relaxed">
              {{ $room->roomfeatures }}
            </p>

            <!-- Amenities Icons (Optional - if you have amenity data) -->
            <div class="flex items-center gap-3 mb-5 text-gray-500 text-xs">
              <span class="flex items-center gap-1">
                <i class="fas fa-bed"></i>
                <span>King Bed</span>
              </span>
              <span class="flex items-center gap-1">
                <i class="fas fa-user"></i>
                <span>2 Guests</span>
              </span>
              <span class="flex items-center gap-1">
                <i class="fas fa-wifi"></i>
                <span>Free WiFi</span>
              </span>
            </div>

            <!-- Price & CTA -->
            <div class="flex items-center justify-between pt-5 border-t border-gray-100">
              <div>
                <p class="text-xs text-gray-500 mb-1">Starting from</p>
                <p class="text-2xl font-bold text-[#F7B32B]">
                  ₱{{ number_format($room->roomprice, 2) }}
                  <span class="text-sm text-gray-500 font-normal">/night</span>
                </p>
              </div>
              <button
                class="px-6 py-3 bg-blue-900 hover:bg-blue-800 text-white font-semibold rounded-xl transition-all duration-300 transform group-hover:scale-105 shadow-md hover:shadow-lg">
                Book Now
              </button>
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

    <!-- Optional: View All Rooms Button -->
    @if($rooms->count() > 6)
      <div class="text-center mt-12" data-aos="fade-up">
        <button
          class="px-10 py-4 bg-[#F7B32B] hover:bg-[#e5a526] text-blue-900 font-bold rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
          View All Rooms
          <i class="fas fa-arrow-right ml-2"></i>
        </button>
      </div>
    @endif
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

    // Optional: Add favorite functionality
    const favoriteButtons = document.querySelectorAll('.fa-heart');
    favoriteButtons.forEach(button => {
      button.parentElement.addEventListener('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        const icon = this.querySelector('i');
        if (icon.classList.contains('far')) {
          icon.classList.remove('far');
          icon.classList.add('fas');
          icon.style.color = '#F7B32B';
        } else {
          icon.classList.remove('fas');
          icon.classList.add('far');
          icon.style.color = '';
        }
      });
    });
  });
</script>