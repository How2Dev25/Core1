<section id="promos-events" class="py-20 bg-[#f8f9fa]" data-aos="fade-up">
    <div class="max-w-6xl mx-auto px-4">
        <!-- Title -->
        <h2 class="text-3xl md:text-4xl font-bold text-center mb-6 text-[#001f54]" data-aos="fade-down"
            data-aos-delay="100">
            Hotel & <span class="text-[#F7B32B]">Facilities</span>
        </h2>
        <p class="text-center text-gray-600 mb-12 md:mb-16 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="200">
            At Soliera Hotel, every facility is designed to enhance your stay, turning a simple visit into a truly
            memorable experience. We've meticulously curated our amenities to provide both ultimate relaxation and effortless
            productivity.
        </p>

        <!-- Facilities Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($facility as $facilities)
                <div class="group relative overflow-hidden rounded-2xl bg-white shadow-md hover:shadow-2xl transition-all duration-500 cursor-pointer"
                    data-aos="fade-up"
                    onclick="document.getElementById('facilitymodal_{{ $facilities->facilityID }}').showModal()">
                    <!-- Image Container -->
                    <div class="relative overflow-hidden h-72">
                        <img src="{{ asset($facilities->facility_photo) }}" alt="{{ $facilities->facility_name }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">

                        <!-- Dark Overlay on Hover -->
                        <div class="absolute inset-0 bg-gradient-to-t from-blue-900/80 via-blue-900/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        </div>

                        <!-- Hover Content -->
                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-500 transform translate-y-4 group-hover:translate-y-0">
                            <div class="text-center">
                                <div class="inline-flex items-center gap-2 px-6 py-3 bg-yellow-400 text-blue-900 font-bold rounded-full shadow-lg transform scale-90 group-hover:scale-100 transition-transform duration-300">
                                    <i class="fas fa-eye"></i>
                                    <span>View Details</span>
                                </div>
                            </div>
                        </div>

                        <!-- Top Badge -->
                        <div class="absolute top-4 right-4">
                            <span class="inline-flex items-center gap-1 px-3 py-1.5 bg-blue-900/90 backdrop-blur-sm text-white text-xs font-semibold rounded-full shadow-lg">
                                <i class="fas fa-star text-yellow-400"></i>
                                Featured
                            </span>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-6">
                        <div class="flex items-start justify-between gap-3 mb-3">
                            <h4 class="font-bold text-xl text-gray-900 group-hover:text-blue-900 transition-colors duration-300 leading-tight">
                                {{ $facilities->facility_name }}
                            </h4>
                            <div class="flex-shrink-0 w-10 h-10 bg-blue-50 rounded-full flex items-center justify-center group-hover:bg-blue-900 transition-colors duration-300">
                                <i class="fas fa-arrow-right text-blue-900 group-hover:text-yellow-400 transition-colors duration-300"></i>
                            </div>
                        </div>

                        <!-- Bottom Info Bar -->
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <span class="text-xs text-gray-500 font-medium">
                                <i class="fas fa-location-dot mr-1"></i>
                                Available Now
                            </span>
                            <span class="text-xs text-blue-900 font-semibold group-hover:text-yellow-400 transition-colors">
                                Learn More →
                            </span>
                        </div>
                    </div>

                    <!-- Decorative Element -->
                    <div class="absolute -bottom-20 -right-20 w-40 h-40 bg-yellow-400/10 rounded-full blur-3xl group-hover:bg-yellow-400/20 transition-all duration-700">
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-16 px-4">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-blue-50 rounded-full mb-6">
                        <i class="fas fa-building text-4xl text-blue-900"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-2">No Facilities Available</h4>
                    <p class="text-gray-500 text-sm max-w-md mx-auto">
                        We're currently updating our facilities. Check back soon for exciting new additions!
                    </p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Modals -->
@foreach ($facility as $facilities)
    <dialog id="facilitymodal_{{ $facilities->facilityID }}"
        class="rounded-3xl max-w-4xl w-full bg-white shadow-2xl backdrop:bg-black/60 backdrop:backdrop-blur-sm p-0 max-h-[90vh] overflow-hidden">

        <!-- Close when clicking outside -->
        <form method="dialog" class="hidden"></form>

        <!-- Scrollable Container -->
        <div class="overflow-y-auto max-h-[90vh] custom-scrollbar">
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

<style>
    /* Center dialog on screen */
    dialog {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        margin: 0;
    }

    /* Style the backdrop */
    dialog::backdrop {
        background: rgba(0, 0, 0, 0.6);
        backdrop-filter: blur(4px);
    }

    /* Custom scrollbar */
    .custom-scrollbar::-webkit-scrollbar {
        width: 8px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #001f54;
        border-radius: 10px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #F7B32B;
    }

    /* Smooth scrolling */
    .custom-scrollbar {
        scroll-behavior: smooth;
    }

    /* Ensure dialog is centered when opened */
    dialog[open] {
        display: flex;
        flex-direction: column;
    }

    /* Animation when opening */
    dialog[open] {
        animation: fadeIn 0.3s ease-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translate(-50%, -50%) scale(0.95);
        }

        to {
            opacity: 1;
            transform: translate(-50%, -50%) scale(1);
        }
    }

    /* Make buttons sticky at bottom when scrolling */
    .sticky {
        position: sticky;
    }
</style>

<script>
    // Close dialog when clicking on backdrop
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('dialog').forEach(dialog => {
            dialog.addEventListener('click', function (e) {
                const rect = this.getBoundingClientRect();
                if (
                    e.clientX < rect.left ||
                    e.clientX > rect.right ||
                    e.clientY < rect.top ||
                    e.clientY > rect.bottom
                ) {
                    this.close();
                }
            });
        });
    });
</script>

<script>
    // Initialize AOS
    AOS.init({
        duration: 800,
        once: true
    });

    // Modal functions
    
   

    // Close modal when clicking outside
  

    // Close modal with Escape key
  
</script>

<style>
    /* Add smooth scrolling for modal */
    .overflow-y-auto::-webkit-scrollbar {
        width: 8px;
    }

    .overflow-y-auto::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    .overflow-y-auto::-webkit-scrollbar-thumb {
        background: #001f54;
        border-radius: 10px;
    }

    .overflow-y-auto::-webkit-scrollbar-thumb:hover {
        background: #F7B32B;
    }
</style>    