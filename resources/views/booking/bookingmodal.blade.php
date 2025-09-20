<style>
  .grayscale-hover {
    filter: grayscale(100%);
    transition: all 0.4s ease;
  }

  .grayscale-hover:hover {
    filter: grayscale(0%);
    transform: translateY(-5px);
  }
</style>

<dialog id="view_room" class="modal">
  <div class="modal-box max-w-4xl bg-white">
    <!-- Header -->
    <div class="flex items-center gap-3 mb-6">
      <div class="w-12 h-12 bg-blue-900 rounded-full flex items-center justify-center">
        <i class="fas fa-calendar-check text-yellow-400 text-xl"></i>
      </div>
      <h3 class="text-2xl font-bold text-blue-900">Reserve A Room Or Event</h3>
    </div>

    <!-- Selection Grid -->
    <div class="grid md:grid-cols-2 gap-6 mb-8">

      <!-- Room Booking Card -->
      <div class="relative group cursor-pointer grayscale-hover rounded-2xl overflow-hidden shadow-lg">
        <!-- Background Image -->
        <div class="relative h-80 bg-cover bg-center"
          style="background-image: url('{{asset('images/defaults/rooms/5 luxury/luxu.jpg')}}');">

          <!-- Overlay -->
          <div class="absolute inset-0 overlay-gradient opacity-70 group-hover:opacity-90 transition-all duration-400">
          </div>

          <!-- Content -->
          <div class="absolute inset-0 flex flex-col items-center justify-center text-white p-6">
            <a href="/roomselectionlanding"
              class="text-center transform group-hover:scale-110 transition-all duration-400">
              <div
                class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mb-4 mx-auto backdrop-blur-sm">
                <i class="fas fa-bed text-4xl text-yellow-400"></i>
              </div>
              <h4 class="text-2xl font-bold mb-3">Hotel Rooms</h4>
              <p class="text-white/90 mb-6 max-w-sm">
                Book comfortable and luxurious rooms for your perfect stay experience
              </p>
              <div
                class="bg-yellow-400 text-blue-900 px-6 py-3 rounded-full font-bold text-lg shadow-lg transform group-hover:bg-yellow-300 transition-all duration-300">
                <i class="fas fa-calendar-plus mr-2"></i>
                Book Room
              </div>
            </a>
          </div>

          <!-- Corner Icon -->
          <div
            class="absolute top-4 right-4 w-12 h-12 bg-white/20 rounded-full flex items-center justify-center backdrop-blur-sm">
            <i class="fas fa-door-open text-yellow-400 text-xl"></i>
          </div>
        </div>
      </div>

      <!-- Event Booking Card -->
      <div class="relative group cursor-pointer grayscale-hover rounded-2xl overflow-hidden shadow-lg">
        <!-- Background Image -->
        <div class="relative h-80 bg-cover bg-center"
          style="background-image: url('{{asset('images/defaults/facilities/confe.jfif')}}');">

          <!-- Overlay -->
          <div
            class="absolute inset-0 overlay-gradient-event opacity-70 group-hover:opacity-90 transition-all duration-400">
          </div>

          <!-- Content -->
          <div class="absolute inset-0 flex flex-col items-center justify-center text-white p-6">
            <div class="text-center transform group-hover:scale-110 transition-all duration-400">
              <div
                class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mb-4 mx-auto backdrop-blur-sm">
                <i class="fas fa-glass-cheers text-4xl text-blue-900"></i>
              </div>
              <h4 class="text-2xl font-bold mb-3">Events & Functions</h4>
              <p class="text-white/90 mb-6 max-w-sm">
                Host memorable events in our elegant venues and celebration spaces
              </p>
              <div
                class="bg-blue-900 text-yellow-400 px-6 py-3 rounded-full font-bold text-lg shadow-lg transform group-hover:bg-blue-800 transition-all duration-300">
                <i class="fas fa-calendar-star mr-2"></i>
                Book Event
              </div>
            </div>
          </div>

          <!-- Corner Icon -->
          <div
            class="absolute top-4 right-4 w-12 h-12 bg-white/20 rounded-full flex items-center justify-center backdrop-blur-sm">
            <i class="fas fa-champagne-glasses text-blue-900 text-xl"></i>
          </div>
        </div>
      </div>
    </div>

    <!-- Additional Info -->
    <div class="bg-blue-50 border border-blue-100 rounded-xl p-6 mb-6">
      <div class="flex items-center gap-3 mb-3">
        <i class="fas fa-info-circle text-blue-900 text-xl"></i>
        <h5 class="font-bold text-blue-900">Quick Information</h5>
      </div>
      <div class="grid md:grid-cols-2 gap-4 text-sm text-gray-700">
        <div class="flex items-center gap-2">
          <i class="fas fa-check text-yellow-400"></i>
          <span>24/7 Room Service Available</span>
        </div>
        <div class="flex items-center gap-2">
          <i class="fas fa-check text-yellow-400"></i>
          <span>Professional Event Planning</span>
        </div>
        <div class="flex items-center gap-2">
          <i class="fas fa-check text-yellow-400"></i>
          <span>Free WiFi & Parking</span>
        </div>

      </div>
    </div>

    <!-- Modal Actions -->
    <div class="modal-action justify-between">
      <div class="flex items-center gap-2 text-sm text-gray-600">
        <i class="fas fa-phone text-blue-900"></i>
        <span>Need help? Call us at (123) 456-7890</span>
      </div>
      <form method="dialog">
        <button class="btn btn-outline">
          <i class="fas fa-times mr-2"></i>
          Close
        </button>
      </form>
    </div>
  </div>
</dialog>