<div class="space-y-6 mb-8">
    <!-- Featured Rooms Slider -->
    <h2 class="text-2xl font-bold text-gray-900 mb-6 tracking-tight">Featured Rooms</h2>
    <div class="rooms-slider-container relative overflow-hidden">
        <!-- Gradient fade edges for visual polish -->


        <div class="rooms-slider flex gap-6 overflow-x-auto scroll-smooth snap-x snap-mandatory px-2 pb-4 cursor-grab active:cursor-grabbing"
            style="scrollbar-width: none; -ms-overflow-style: none;" onmousedown="this.classList.add('dragging')"
            onmouseup="this.classList.remove('dragging')" onmouseleave="this.classList.remove('dragging')">
            @forelse($rooms as $room)
                <div class="group cursor-pointer flex-shrink-0 w-64 snap-start transition-all duration-300">
                    <a target="_blank" href="/roomdetails/{{ $room->roomID }}">
                        <div
                            class="relative rounded-xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                            <!-- Image container with overlay -->
                            <div class="aspect-video bg-gradient-to-br from-blue-50 to-indigo-100 relative overflow-hidden">
                                <img src="{{ asset($room->roomphoto) }}" alt="{{ $room->roomtype ?? 'Room' }}"
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">

                                <!-- Subtle overlay gradient -->
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                </div>

                                <!-- Price badge -->
                                <div
                                    class="absolute top-3 right-3 bg-white/95 backdrop-blur-sm px-3 py-1.5 rounded-full shadow-lg">
                                    <span
                                        class="text-sm font-bold text-gray-900">₱{{ number_format($room->roomprice ?? 0, 0) }}</span>
                                    <span class="text-xs text-gray-600">/night</span>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- Room info card -->
                    <div class="mt-3 px-1">
                        <div class="text-base font-bold text-gray-900 mb-1 line-clamp-1">
                            {{ $room->roomtype ?? 'Room Name' }}
                        </div>
                        <div class="flex items-center justify-between">
                            <div
                                class="flex items-center gap-1.5 bg-amber-50 px-2.5 py-1 rounded-full border border-amber-200">
                                <svg class="w-3.5 h-3.5 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <span class="text-xs font-bold text-amber-700">{{ $room->loyalty_value ?? 0 }}</span>
                                <span class="text-xs text-amber-600">pts</span>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="w-full py-12 text-center">
                    <svg class="w-16 h-16 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    <p class="text-gray-400 text-sm font-medium">No rooms available at the moment</p>
                </div>
            @endforelse
        </div>
    </div>
    <!-- Upcoming Events Slider -->

</div>

<style>
    .rooms-slider::-webkit-scrollbar {
        display: none;
    }

    .rooms-slider.active {
        cursor: grabbing;
        user-select: none;
    }

    .line-clamp-1 {
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
    }
</style>

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