<section id="promos-events" class="py-20 bg-[#f8f9fa]" data-aos="fade-up">
  <div class="max-w-7xl mx-auto px-4">

    <!-- Title -->
    <h2 class="text-3xl md:text-4xl font-bold text-center mb-6 text-[#001f54]" data-aos="fade-down" data-aos-delay="100">
      <span class="text-[#F7B32B]">Events And Conference</span>
    </h2>

    <p class="text-center text-gray-600 mb-12 md:mb-16 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="200">
      Discover amazing deals and exciting events happening at our place. Don't miss out on these special opportunities!
    </p>

    <div class="px-6">
      @if($events->isNotEmpty())
        <!-- Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          @foreach($events as $index => $event)
            <div data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
              <div
                onclick="document.getElementById('eventModal_{{ $event->eventtype_ID }}').showModal()"
                class="cursor-pointer group block relative rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 h-full">

                <!-- Image -->
                <div class="relative h-80 overflow-hidden">
                  <img
                    src="{{ asset(is_array($event->eventtype_photo) ? $event->eventtype_photo[0] : $event->eventtype_photo) }}"
                    alt="{{ $event->eventtype_name }}"
                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />

                  <!-- Gradient Overlay -->
                  <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>

                  <!-- Content Overlay -->
                  <div class="absolute bottom-0 left-0 right-0 p-6">

                    <h4 class="text-2xl font-bold text-white mb-2 group-hover:text-yellow-400 transition-colors">
                      {{ $event->eventtype_name }}
                    </h4>

                    

                    <!-- Event Details -->
                   

                    <!-- CTA Button -->
                    <button class="w-full py-3 btn btn-primary font-bold rounded-xl transition-all duration-300 group-hover:scale-105">
                      <i class="fas fa-calendar-check"></i> View Details
                    </button>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>

        <!-- View All Button -->
        @if($events->count() > 6)
          <div class="text-center mt-12" data-aos="fade-up">
            <button class="px-8 py-3 btn btn-primary font-bold rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl">
              View All Events <i class="fas fa-arrow-right ml-2"></i>
            </button>
          </div>
        @endif
      @else
        <div class="text-center py-12">
          <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-4">
            <i class="fas fa-calendar-times text-4xl text-gray-400"></i>
          </div>
          <h4 class="text-lg font-semibold text-gray-700 mb-2">No Events Available</h4>
          <p class="text-gray-500 text-sm">Check back soon for upcoming events</p>
        </div>
      @endif
    </div>
  </div>
</section>

<!-- ============ EVENT DETAILS MODALS ============ -->
@foreach ($events as $event)
  <dialog id="eventModal_{{ $event->eventtype_ID }}" class="modal">
    <div class="modal-box max-w-3xl bg-white rounded-2xl p-6 relative">

      <!-- Close Button -->
      <form method="dialog">
        <button class="btn btn-sm btn-circle absolute right-4 top-4 bg-gray-200 hover:bg-gray-300">✕</button>
      </form>

      <!-- Image -->
      <div class="w-full h-72 rounded-xl overflow-hidden mb-6">
        <img src="{{ asset(is_array($event->eventtype_photo) ? $event->eventtype_photo[0] : $event->eventtype_photo) }}"
          alt="{{ $event->eventtype_name }}" class="w-full h-full object-cover">
      </div>

      <!-- Title -->
      <h3 class="text-3xl font-bold text-[#001f54] mb-3">
        {{ $event->eventtype_name }}
      </h3>

      <!-- Description -->
      @if(isset($event->eventtype_description))
        <p class="text-gray-700 leading-relaxed mb-6">
          {{ $event->eventtype_description }}
        </p>
      @endif

      <!-- Details Grid -->
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">

        @if(isset($event->eventtype_capacity))
          <div class="p-4 bg-gray-100 rounded-xl">
            <h4 class="text-sm text-gray-500">Capacity</h4>
            <p class="text-lg font-semibold text-[#001f54]">
              {{ $event->eventtype_capacity }} Guests
            </p>
          </div>
        @endif

        @if(isset($event->eventtype_price))
          <div class="p-4 bg-gray-100 rounded-xl">
            <h4 class="text-sm text-gray-500">Price Starts At</h4>
            <p class="text-lg font-semibold text-[#001f54]">
              ₱{{ number_format($event->eventtype_price, 2) }}
            </p>
          </div>
        @endif

      </div>

      <!-- Modal Buttons -->
      <div class="flex justify-end gap-3 mt-4">
        <form method="dialog">
          <button class="px-5 py-2 bg-gray-300 hover:bg-gray-400 text-gray-700 font-semibold rounded-xl">
            Close
          </button>
        </form>

        <a href="/eventbookinglanding/{{ $event->eventtype_ID }}" class="px-5 py-2 bg-yellow-400 hover:bg-yellow-500 text-blue-900 font-bold rounded-xl">
          Book Now
        </a>
      </div>

    </div>

    <!-- Backdrop -->
    <form method="dialog" class="modal-backdrop bg-black/60"></form>
  </dialog>
@endforeach

<script>
  AOS.init({
    duration: 800,
    once: true,
    offset: 100
  });
</script>
