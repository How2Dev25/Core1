<div class=" p-6">
    <div class="flex items-center gap-3 mb-6">
        <div class="p-2 bg-blue-900 rounded-xl">
            <i class="fas fa-concierge-bell text-yellow-400 text-xl"></i>
        </div>
        <div>
            <h3 class="text-xl font-bold text-gray-900">Hotel Facilities</h3>
            <p class="text-sm text-gray-500">Explore our amenities</p>
        </div>
    </div>

    <!-- Desktop Left/Right Arrows -->
    <div class="hidden md:flex justify-between items-center mb-3 px-2">
        <button onclick="slideFacilities(-1)"
            class="p-3 bg-white shadow rounded-full hover:bg-gray-100 transition border">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </button>

        <button onclick="slideFacilities(1)"
            class="p-3 bg-white shadow rounded-full hover:bg-gray-100 transition border">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </button>
    </div>

    <!-- Facilities Slider -->
    <div id="facilitiesSlider" class="flex gap-4 overflow-x-auto snap-x snap-mandatory scroll-smooth pb-4 cursor-grab active:cursor-grabbing
               scrollbar-hide md:scrollbar-none" style="scrollbar-width: none; -ms-overflow-style: none;">

        @forelse ($facility as $facilities)
            <div class="group cursor-pointer flex-shrink-0 w-48 snap-start">
                <div class="relative overflow-hidden rounded-xl bg-gray-50 hover:shadow-xl transition-all duration-300">
                    <img src="{{ asset($facilities->facility_photo) }}" alt="{{ $facilities->facility_name }}"
                        class="w-full h-32 object-cover rounded-t-xl group-hover:scale-105 transition duration-300">

                    <div class="p-3">
                        <h4 class="font-semibold text-gray-900 text-sm line-clamp-1">
                            {{ $facilities->facility_name }}
                        </h4>
                    </div>

                    <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition">
                        <span class="text-xs bg-blue-900 text-white px-2 py-1 rounded-full">View</span>
                    </div>
                </div>
            </div>
        @empty
            <div class="w-full text-center py-10">
                <i class="fas fa-info-circle text-blue-900 text-3xl mb-3"></i>
                <p class="text-gray-500 text-sm">No facilities available at the moment.</p>
            </div>
        @endforelse

    </div>
</div>




<script>
    document.addEventListener('DOMContentLoaded', function () {

        // SWIPE FUNCTIONALITY (mobile & desktop drag)
        const facilitySlider = document.getElementById('facilitiesSlider');
        let isDownF = false;
        let startXF;
        let scrollLeftF;

        facilitySlider.addEventListener('mousedown', (e) => {
            isDownF = true;
            facilitySlider.classList.add('active');
            startXF = e.pageX - facilitySlider.offsetLeft;
            scrollLeftF = facilitySlider.scrollLeft;
        });

        facilitySlider.addEventListener('mouseleave', () => {
            isDownF = false;
            facilitySlider.classList.remove('active');
        });

        facilitySlider.addEventListener('mouseup', () => {
            isDownF = false;
            facilitySlider.classList.remove('active');
        });

        facilitySlider.addEventListener('mousemove', (e) => {
            if (!isDownF) return;
            e.preventDefault();
            const x = e.pageX - facilitySlider.offsetLeft;
            const walk = (x - startXF) * 1.5;
            facilitySlider.scrollLeft = scrollLeftF - walk;
        });

    });

    // DESKTOP ARROW BUTTONS
    function slideFacilities(direction) {
        const slider = document.getElementById("facilitiesSlider");
        const cardWidth = 220; // width of facility card + gap
        slider.scrollBy({
            left: direction * cardWidth,
            behavior: "smooth"
        });
    }
</script>