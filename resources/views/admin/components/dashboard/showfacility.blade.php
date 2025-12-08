<div class=" ">
    <div class="flex items-center gap-3 mb-6">
    <h2 class="text-xl font-semibold text-gray-800 mb-4">Hotel Facilities</h2>
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
            <div onclick="document.getElementById('facilitymodal_{{ $facilities->facilityID }}').showModal()" class="group cursor-pointer flex-shrink-0 w-48 snap-start">
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

@foreach ($facility as $facilities)
    <dialog id="facilitymodal_{{ $facilities->facilityID }}"
        class="rounded-3xl max-w-4xl w-full bg-white shadow-2xl backdrop:bg-black/60 backdrop:backdrop-blur-sm p-0 max-h-[90vh] overflow-hidden
           fixed inset-0 m-auto">

        <!-- Close when clicking outside -->
        <form method="dialog" class="hidden"></form>

        <!-- Scrollable Container -->
        <div class="overflow-y-auto max-h-[90vh] ">
            <div class="relative">
                <!-- Image -->
                <img src="{{ asset($facilities->facility_photo) }}" class="w-full h-64 md:h-96 object-cover">

                <!-- Close Button -->
                <button type="button"
                    onclick="document.getElementById('facilitymodal_{{ $facilities->facilityID }}').close()"
                    class="absolute top-4 right-4 w-10 h-10 bg-white/90 hover:bg-white rounded-full flex items-center justify-center shadow-lg transition-all duration-300 hover:scale-110 z-10">
                    <i class="fas fa-times text-blue-900"></i>
                </button>

                <!-- Title Overlay -->
                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-6">
                    <h3 class="text-3xl font-bold text-white">{{ $facilities->facility_name }}</h3>
                </div>
            </div>

            <!-- Modal Body -->
            <div class="p-6 md:p-8">
                <!-- Description -->
                @if(isset($facilities->facility_description))
                    <div class="mb-6">
                        <h4 class="text-xl font-bold text-blue-900 mb-3 flex items-center gap-2">
                            <i class="fas fa-info-circle text-yellow-400"></i>
                            Description
                        </h4>
                        <p class="text-gray-700 leading-relaxed">
                            {{ $facilities->facility_description }}
                        </p>
                    </div>
                @endif

                <!-- Features -->
                @if(isset($facilities->features))
                    <div class="mb-6">
                        <h4 class="text-xl font-bold text-blue-900 mb-3 flex items-center gap-2">
                            <i class="fas fa-check-circle text-yellow-400"></i>
                            Features
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            @foreach(explode(',', $facilities->features) as $feature)
                                <div class="flex items-center gap-2 text-gray-700">
                                    <i class="fas fa-check text-green-500"></i>
                                    <span>{{ trim($feature) }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Hours -->
                @if(isset($facilities->operating_hours))
                    <div class="mb-6">
                        <h4 class="text-xl font-bold text-blue-900 mb-3 flex items-center gap-2">
                            <i class="fas fa-clock text-yellow-400"></i>
                            Operating Hours
                        </h4>
                        <p class="text-gray-700">{{ $facilities->operating_hours }}</p>
                    </div>
                @endif

                <!-- Location -->
                <div class="bg-blue-50 rounded-2xl p-6 mb-6">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-blue-900 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-location-dot text-yellow-400 text-xl"></i>
                        </div>
                        <div>
                            <h5 class="font-bold text-blue-900 mb-1">Location</h5>
                            <p class="text-gray-700 text-sm">Available at Soliera Hotel</p>
                            @if(isset($facilities->location))
                                <p class="text-gray-600 text-sm">{{ $facilities->location }}</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Actions -->

            </div>
        </div>
    </dialog>
@endforeach







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