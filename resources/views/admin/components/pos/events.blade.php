<div class="events-slider-container relative select-none">
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
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-purple-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857..." />
                            </svg>
                            <span class="font-medium">{{ $eventtype->eventtype_capacity }} guests</span>
                        </div>

                    <button type="button" onclick="openEventModal({{ $eventtype->eventtype_ID }})"
                        class="w-full bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg text-sm font-semibold">
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

    

    const slider = document.getElementById('eventSlider');

    let isDown = false;
    let startX;
    let scrollLeft;
    let moved = false;

    slider.addEventListener('mousedown', (e) => {
        isDown = true;
        slider.classList.add('dragging');
        startX = e.pageX - slider.offsetLeft;
        scrollLeft = slider.scrollLeft;
    });

    slider.addEventListener('mouseleave', () => {
        isDown = false;
        slider.classList.remove('dragging');
    });

    slider.addEventListener('mouseup', () => {
        isDown = false;
        slider.classList.remove('dragging');
        setTimeout(() => moved = false, 50);
    });

    slider.addEventListener('mousemove', (e) => {
        if (!isDown) return;
        e.preventDefault();
        moved = true;
        const x = e.pageX - slider.offsetLeft;
        const walk = (x - startX) * 1.2; // speed factor
        slider.scrollLeft = scrollLeft - walk;
    });

    // Prevent clicking when dragging
    slider.addEventListener('click', (e) => {
        if (moved) e.preventDefault();
    });

    /* TOUCH SUPPORT */
    slider.addEventListener('touchstart', (e) => {
        isDown = true;
        startX = e.touches[0].clientX;
        scrollLeft = slider.scrollLeft;
    });

    slider.addEventListener('touchmove', (e) => {
        if (!isDown) return;
        moved = true;
        const x = e.touches[0].clientX;
        const walk = (x - startX) * 1.2;
        slider.scrollLeft = scrollLeft - walk;
    });

    slider.addEventListener('touchend', () => {
        isDown = false;
        setTimeout(() => moved = false, 50);
    });
</script>