<div class="events-slider-container relative select-none mt-5">
    <div class="flex items-center justify-between mb-8">
        <h2 class="text-3xl font-bold text-gray-800 flex items-center gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#001f54"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M8 2v3M16 2v3M3 10h18M5 10v10a1 1 0 001 1h12a1 1 0 001-1V10M7 14h.01M12 14h.01M17 14h.01" />
            </svg>
            Events
        </h2>
        <p class="text-gray-600 text-sm">Book your ideal event</p>
    </div>

    <div id="eventSlider" class="events-slider flex gap-4 overflow-x-auto scroll-smooth snap-x snap-mandatory px-2 pb-2"
        style="scrollbar-width: none; -ms-overflow-style: none;">

        @forelse ($ecmtype as $eventtype)
            <div class="group flex-shrink-0 w-72 snap-start">
                <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden">

                    <div class="relative h-44 overflow-hidden">
                        <img src="{{ asset($eventtype->eventtype_photo) }}" class="w-full h-full object-cover">
                        <div
                            class="absolute top-3 right-3 bg-purple-600 text-white px-3 py-1 rounded-full text-xs font-semibold">
                            ₱{{ number_format($eventtype->eventtype_price, 2) }}
                        </div>
                    </div>

                    <div class="p-4">
                        <h3 class="text-lg font-bold line-clamp-1">{{ $eventtype->eventtype_name }}</h3>
                        <p class="text-sm text-gray-600 line-clamp-2 h-10">{{ $eventtype->eventtype_description }}</p>

                        <div class="flex items-center gap-2 text-xs text-gray-600 mb-4">
                           
                            <span class="font-medium">{{ $eventtype->eventtype_capacity }} guests</span>
                        </div>

                    <button type="button" onclick="openEventModal({{ $eventtype->eventtype_ID }})"
                        class="w-full btn btn-primary text-white px-4 py-2 rounded-lg text-sm font-semibold">
                        Book Event
                    </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="w-full text-center py-10 font-medium">No events available</div>
        @endforelse

    </div>
</div>
<style>
    .events-slider::-webkit-scrollbar {
        display: none;
    }

    .events-slider.dragging {
        scroll-snap-type: none;
    }
      
</style>




@foreach  ($ecmtype as $eventtype)
    @include('admin.components.pos.eventmodal')
@endforeach

<script>
    // Optimized drag handler with throttling
        class EventSlider {
            constructor(sliderId) {
                this.slider = document.getElementById(sliderId);
                this.isDown = false;
                this.startX = 0;
                this.scrollLeft = 0;
                this.moved = false;

                this.init();
            }

            init() {
                // Single event listener using delegation
                this.slider.addEventListener('mousedown', this.handleMouseDown.bind(this));
                this.slider.addEventListener('touchstart', this.handleTouchStart.bind(this));

                // Use passive listeners for better performance
                document.addEventListener('mousemove', this.handleMouseMove.bind(this), { passive: false });
                document.addEventListener('mouseup', this.handleMouseUp.bind(this));
                document.addEventListener('touchmove', this.handleTouchMove.bind(this), { passive: false });
                document.addEventListener('touchend', this.handleTouchEnd.bind(this));
            }

            handleMouseDown(e) {
                this.isDown = true;
                this.slider.classList.add('dragging');
                this.startX = e.pageX - this.slider.offsetLeft;
                this.scrollLeft = this.slider.scrollLeft;
            }

            handleMouseMove(e) {
                if (!this.isDown) return;

                e.preventDefault();
                this.moved = true;

                const x = e.pageX - this.slider.offsetLeft;
                const walk = (x - this.startX) * 1.2;
                this.slider.scrollLeft = this.scrollLeft - walk;
            }

            handleMouseUp() {
                this.isDown = false;
                this.slider.classList.remove('dragging');
                setTimeout(() => this.moved = false, 50);
            }

            handleTouchStart(e) {
                this.isDown = true;
                this.startX = e.touches[0].clientX;
                this.scrollLeft = this.slider.scrollLeft;
            }

            handleTouchMove(e) {
                if (!this.isDown) return;

                this.moved = true;
                const x = e.touches[0].clientX;
                const walk = (x - this.startX) * 1.2;
                this.slider.scrollLeft = this.scrollLeft - walk;
            }

            handleTouchEnd() {
                this.isDown = false;
                setTimeout(() => this.moved = false, 50);
            }
        }

        // Initialize slider
        document.addEventListener('DOMContentLoaded', () => {
            new EventSlider('eventSlider');
        });
</script>