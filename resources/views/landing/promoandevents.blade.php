<section id="promos-events" class="py-20 bg-[#f8f9fa]" data-aos="fade-up">
  <div class="max-w-7xl mx-auto px-4">
    <!-- Title -->
    <h2 class="text-3xl md:text-4xl font-bold text-center mb-6 text-[#001f54]" data-aos="fade-down"
      data-aos-delay="100">
      <span class="text-[#F7B32B]">Events</span>
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
              <a href="#"
                class="group block relative rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 h-full">
                <!-- Image -->
                <div class="relative h-80 overflow-hidden">
                  <img
                    src="{{ asset(is_array($event->eventtype_photo) ? $event->eventtype_photo[0] : $event->eventtype_photo) }}"
                    alt="{{ $event->eventtype_name }}"
                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />

                  <!-- Gradient Overlay -->
                  <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent">
                  </div>

                  <!-- Content Overlay -->
                  <div class="absolute bottom-0 left-0 right-0 p-6">
                    <div class="flex items-start justify-between mb-3">
                      <div class="flex-1">
                        <span
                          class="inline-block px-3 py-1 bg-yellow-400 text-blue-900 rounded-full text-xs font-bold mb-3">
                          FEATURED EVENT
                        </span>
                        <h4 class="text-2xl font-bold text-white mb-2 group-hover:text-yellow-400 transition-colors">
                          {{ $event->eventtype_name }}
                        </h4>
                        @if(isset($event->eventtype_description))
                          <p class="text-white/90 text-sm mb-3 line-clamp-2">
                            {{ Str::limit($event->eventtype_description, 100) }}
                          </p>
                        @endif
                      </div>
                    </div>

                    <!-- Event Details -->
                    <div class="flex flex-wrap gap-2 mb-4">
                      @if(isset($event->eventtype_capacity))
                        <span
                          class="flex items-center gap-1 px-3 py-1.5 bg-white/20 backdrop-blur-sm text-white rounded-lg text-xs">
                          <i class="fas fa-users"></i>
                          <span>{{ $event->eventtype_capacity }} Guests</span>
                        </span>
                      @endif
                      @if(isset($event->eventtype_price))
                        <span
                          class="flex items-center gap-1 px-3 py-1.5 bg-white/20 backdrop-blur-sm text-white rounded-lg text-xs">
                          <i class="fas fa-tag"></i>
                          <span>₱{{ number_format($event->eventtype_price, 2) }}</span>
                        </span>
                      @endif
                    </div>

                    <!-- CTA Button -->
                    <button
                      class="w-full py-3 bg-yellow-400 hover:bg-yellow-500 text-blue-900 font-bold rounded-xl transition-all duration-300 flex items-center justify-center gap-2 group-hover:scale-105">
                      <i class="fas fa-calendar-check"></i>
                      <span>View Details</span>
                    </button>
                  </div>
                </div>
              </a>
            </div>
          @endforeach
        </div>

        <!-- View All Button (Optional) -->
        @if($events->count() > 6)
          <div class="text-center mt-12" data-aos="fade-up">
            <button
              class="px-8 py-3 bg-blue-900 hover:bg-blue-800 text-yellow-400 font-bold rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl">
              View All Events
              <i class="fas fa-arrow-right ml-2"></i>
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

<script>
  // Initialize AOS
  AOS.init({
    duration: 800,
    once: true,
    offset: 100
  });
</script>