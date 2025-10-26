<section id="promos-events" class="py-20 bg-[#f8f9fa]" data-aos="fade-up">
    <div class="max-w-6xl mx-auto px-4">
        <!-- Title -->
        <h2 class="text-3xl md:text-4xl font-bold text-center mb-6 text-[#001f54]" data-aos="fade-down"
            data-aos-delay="100">
            Hotel & <span class="text-[#F7B32B]">Facilties</span>
        </h2>
        <p class="text-center text-gray-600 mb-12 md:mb-16 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="200">
            At Soliera Hotel, every facility is designed to enhance your stay, turning a simple visit into a truly
            memorable
            experience. We,ve meticulously curated our amenities to provide both ultimate relaxation and effortless
            productivity.
        </p>

        <!-- Promos + Events Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($facility as $facilities)
                <div class="group relative overflow-hidden rounded-2xl bg-white shadow-md hover:shadow-2xl transition-all duration-500 cursor-pointer"
                    data-aos="fade-up">
                    <!-- Image Container -->
                    <div class="relative overflow-hidden h-72">
                        <img src="{{ asset($facilities->facility_photo) }}" alt="{{ $facilities->facility_name }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">

                        <!-- Dark Overlay on Hover -->
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-blue-900/80 via-blue-900/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        </div>

                        <!-- Hover Content -->
                        <div
                            class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-500 transform translate-y-4 group-hover:translate-y-0">
                            <div class="text-center">
                                <div
                                    class="inline-flex items-center gap-2 px-6 py-3 bg-yellow-400 text-blue-900 font-bold rounded-full shadow-lg transform scale-90 group-hover:scale-100 transition-transform duration-300">
                                    <i class="fas fa-eye"></i>
                                    <span>View Details</span>
                                </div>
                            </div>
                        </div>

                        <!-- Top Badge -->
                        <div class="absolute top-4 right-4">
                            <span
                                class="inline-flex items-center gap-1 px-3 py-1.5 bg-blue-900/90 backdrop-blur-sm text-white text-xs font-semibold rounded-full shadow-lg">
                                <i class="fas fa-star text-yellow-400"></i>
                                Featured
                            </span>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-6">
                        <div class="flex items-start justify-between gap-3 mb-3">
                            <h4
                                class="font-bold text-xl text-gray-900 group-hover:text-blue-900 transition-colors duration-300 leading-tight">
                                {{ $facilities->facility_name }}
                            </h4>
                            <div
                                class="flex-shrink-0 w-10 h-10 bg-blue-50 rounded-full flex items-center justify-center group-hover:bg-blue-900 transition-colors duration-300">
                                <i
                                    class="fas fa-arrow-right text-blue-900 group-hover:text-yellow-400 transition-colors duration-300"></i>
                            </div>
                        </div>

                        <!-- Optional: Add description or features -->
                        @if(isset($facilities->facility_description))
                            <p class="text-gray-600 text-sm line-clamp-2 mb-4">
                                {{ $facilities->facility_description }}
                            </p>
                        @endif

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
                    <div
                        class="absolute -bottom-20 -right-20 w-40 h-40 bg-yellow-400/10 rounded-full blur-3xl group-hover:bg-yellow-400/20 transition-all duration-700">
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

        <style>
            /* Add smooth line-clamp support */
            .line-clamp-2 {
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }

            /* Optional: Add subtle animation on load if using AOS */
            [data-aos="fade-up"] {
                transition-property: transform, opacity;
            }
        </style>





    </div>
</section>


<script>
    // Initialize AOS
    AOS.init({
        duration: 800,
        once: true
    });

    // Carousel functionality

</script>