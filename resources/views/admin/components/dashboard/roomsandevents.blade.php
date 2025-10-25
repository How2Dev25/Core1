<div class="space-y-6 mb-8">
    <!-- Featured Rooms Slider -->
    <h2 class="text-xl font-semibold text-gray-800 mb-4">Featured Rooms</h2>
    <div class="rooms-slider-container relative overflow-hidden">
        <div class="rooms-slider flex gap-4 overflow-x-auto scroll-smooth snap-x snap-mandatory px-2 pb-2 cursor-grab active:cursor-grabbing"
            style="scrollbar-width: none; -ms-overflow-style: none;" onmousedown="this.classList.add('dragging')"
            onmouseup="this.classList.remove('dragging')" onmouseleave="this.classList.remove('dragging')">
            @forelse($rooms as $room)
                <div class="group cursor-pointer flex-shrink-0 w-64 snap-start transition-transform ">
                    <div
                        class="duration-300 hover:scale-105 hover:shadow-xl aspect-video bg-gradient-to-br from-blue-100 to-blue-200 rounded-lg overflow-hidden relative">
                        <img src="{{ asset($room->roomphoto) }}" alt="{{ $room->roomtype ?? 'Room' }}"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">

                    </div>
                    <div class="mt-2">
                        <div class="text-sm font-semibold text-gray-900">
                            {{ $room->roomtype ?? 'Room Name' }}
                        </div>
                        <div class="text-xs text-gray-500">
                            ₱{{ number_format($room->roomprice ?? 0, 2) }}/night
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-gray-400 text-sm">No rooms available</p>
            @endforelse
        </div>
    </div>
    <!-- Upcoming Events Slider -->

</div>

<script>
    // Auto-sliding functionality
    document.addEventListener('DOMContentLoaded', function () {
        // Rooms Slider
        const slider = document.querySelector('.rooms-slider');
        let isDown = false;
        let startX;
        let scrollLeft;

        if (slider) {
            slider.addEventListener('mousedown', (e) => {
                isDown = true;
                slider.classList.add('active');
                startX = e.pageX - slider.offsetLeft;
                scrollLeft = slider.scrollLeft;
            });

            slider.addEventListener('mouseleave', () => {
                isDown = false;
                slider.classList.remove('active');
            });

            slider.addEventListener('mouseup', () => {
                isDown = false;
                slider.classList.remove('active');
            });

            slider.addEventListener('mousemove', (e) => {
                if (!isDown) return;
                e.preventDefault();
                const x = e.pageX - slider.offsetLeft;
                const walk = (x - startX) * 1.5; // scroll speed
                slider.scrollLeft = scrollLeft - walk;
            });
        }

    });
</script>