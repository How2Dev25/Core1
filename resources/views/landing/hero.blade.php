<section id="about" class="hero min-h-screen flex items-center justify-center text-white relative overflow-hidden">
    <!-- Parallax Background Layers (keeping original) -->
    <div class="absolute inset-0 bg-black/40 z-10"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-black/70 z-10"></div>
    <div class="parallax-bg absolute inset-0 bg-cover bg-center"
        style="background-image: url('{{ asset('images/defaults/hotel3.jpg') }}');">
    </div>

    <!-- Professional Grid Layout -->
    <div class="z-20 relative w-full max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-12 gap-6 min-h-screen items-center">

            <!-- Left Column - Main Content -->
            <div class="col-span-12 lg:col-span-7 xl:col-span-6">

                <!-- Star Rating Section -->
                <div class="mb-8" data-aos="fade-right" data-aos-delay="100">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="flex gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-amber-400" viewBox="0 0 24 24"
                                fill="currentColor">
                                <path
                                    d="M12 .587l3.668 7.571 8.332 1.151-6.064 5.879 1.48 8.295L12 18.896l-7.416 4.587 1.48-8.295L.0 9.309l8.332-1.151z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-amber-400" viewBox="0 0 24 24"
                                fill="currentColor">
                                <path
                                    d="M12 .587l3.668 7.571 8.332 1.151-6.064 5.879 1.48 8.295L12 18.896l-7.416 4.587 1.48-8.295L.0 9.309l8.332-1.151z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-amber-400" viewBox="0 0 24 24"
                                fill="currentColor">
                                <path
                                    d="M12 .587l3.668 7.571 8.332 1.151-6.064 5.879 1.48 8.295L12 18.896l-7.416 4.587 1.48-8.295L.0 9.309l8.332-1.151z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-amber-400" viewBox="0 0 24 24"
                                fill="currentColor">
                                <path
                                    d="M12 .587l3.668 7.571 8.332 1.151-6.064 5.879 1.48 8.295L12 18.896l-7.416 4.587 1.48-8.295L.0 9.309l8.332-1.151z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-amber-400" viewBox="0 0 24 24"
                                fill="currentColor">
                                <path
                                    d="M12 .587l3.668 7.571 8.332 1.151-6.064 5.879 1.48 8.295L12 18.896l-7.416 4.587 1.48-8.295L.0 9.309l8.332-1.151z" />
                            </svg>
                        </div>
                        <span class="text-amber-400 text-sm font-medium">5-Star Hotel</span>
                    </div>
                    <div class="h-0.5 w-16 bg-amber-400"></div>
                </div>

                <!-- Hotel Name Section -->
                <div class="mb-6" data-aos="fade-right" data-aos-delay="200">
                    <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold mb-2">
                        <span class="text-[#F7B32B]">SOLIERA</span>
                    </h1>
                    <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-white mb-3">
                        HOTEL & RESTAURANT
                    </h2>
                    <div class="h-px w-full bg-gradient-to-r from-amber-400 via-amber-400/50 to-transparent"></div>
                </div>

                <!-- Tagline Section -->
                <div class="mb-8" data-aos="fade-right" data-aos-delay="300">
                    <h3 class="text-xl md:text-2xl font-semibold text-white tracking-wide italic">
                        Savor The Stay, Dine With Elegance
                    </h3>
                </div>

                <!-- Description Section -->
                <div class="mb-10" data-aos="fade-right" data-aos-delay="400">
                    <p class="text-lg md:text-xl text-gray-200 max-w-2xl leading-relaxed">
                        Welcome to Soliera — where luxury meets comfort.
                        Experience world-class hospitality, exquisite dining, and unforgettable stays in the heart of
                        the city.
                    </p>
                </div>

                <!-- CTA Buttons Section -->
                <div class="flex flex-col sm:flex-row gap-4" data-aos="fade-right" data-aos-delay="500">
                    <a href="#rooms"
                        class="bg-amber-500 hover:bg-amber-600 text-black font-semibold px-8 py-4 rounded-lg transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl text-center">
                        Explore Rooms
                    </a>
                    <button onclick="view_room.showModal()"
                        class="border-2 border-white text-white hover:bg-white hover:text-black font-semibold px-8 py-4 rounded-lg transform hover:scale-105 transition-all duration-300 text-center">
                        Book Now
                    </button>
                </div>
            </div>

            <!-- Right Column - Features Grid -->
            <div class="col-span-12 lg:col-span-5 xl:col-span-6 lg:pl-8 mt-20 max-md:mt-0 mb-5">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-1 xl:grid-cols-2 gap-6">

                    <!-- Feature Card 1 - Book Rooms -->
                    <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-lg overflow-hidden hover:bg-white/15 transition-all duration-300 group cursor-pointer"
                        data-aos="fade-left" data-aos-delay="200">
                        <div class="h-32 bg-cover bg-center relative"
                            style="background-image: url('{{asset('images/defaults/rooms/1 standard/room1.png')}}');">
                            <div
                                class="absolute inset-0 bg-black/40 group-hover:bg-black/30 transition-colors duration-300">
                            </div>
                            <div class="absolute top-3 left-3">
                                <div class="w-8 h-8 bg-amber-500/90 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="p-4">
                            <h4 class="font-semibold text-lg mb-2 text-amber-400">Book Rooms</h4>
                            <p class="text-gray-200 text-sm leading-relaxed">
                                Reserve your perfect stay with our luxury suites and premium accommodations.
                            </p>
                        </div>
                    </div>

                    <!-- Feature Card 2 - Personalized Accounts -->
                    <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-lg overflow-hidden hover:bg-white/15 transition-all duration-300 group cursor-pointer"
                        data-aos="fade-left" data-aos-delay="300">
                        <div class="h-32 bg-cover bg-center relative"
                            style="background-image: url('{{asset('images/defaults/personalacc.png')}}');">
                            <div
                                class="absolute inset-0 bg-black/40 group-hover:bg-black/30 transition-colors duration-300">
                            </div>
                            <div class="absolute top-3 left-3">
                                <div class="w-8 h-8 bg-amber-500/90 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="p-4">
                            <h4 class="font-semibold text-lg mb-2 text-amber-400">Personalized Accounts</h4>
                            <p class="text-gray-200 text-sm leading-relaxed">
                                Enjoy tailored experiences with your personal preferences and loyalty rewards.
                            </p>
                        </div>
                    </div>

                    <!-- Feature Card 3 - Book Events -->
                    <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-lg overflow-hidden hover:bg-white/15 transition-all duration-300 group cursor-pointer"
                        data-aos="fade-left" data-aos-delay="400">
                        <div class="h-32 bg-cover bg-center relative"
                            style="background-image: url('{{asset('images/defaults/events/christmas.png')}}');">
                            <div
                                class="absolute inset-0 bg-black/40 group-hover:bg-black/30 transition-colors duration-300">
                            </div>
                            <div class="absolute top-3 left-3">
                                <div class="w-8 h-8 bg-amber-500/90 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="p-4">
                            <h4 class="font-semibold text-lg mb-2 text-amber-400">Book Events</h4>
                            <p class="text-gray-200 text-sm leading-relaxed">
                                Host unforgettable weddings, conferences, and celebrations in our elegant venues.
                            </p>
                        </div>
                    </div>

                    <!-- Feature Card 4 - Facilities -->
                    <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-lg overflow-hidden hover:bg-white/15 transition-all duration-300 group cursor-pointer"
                        data-aos="fade-left" data-aos-delay="500">
                        <div class="h-32 bg-cover bg-center relative"
                            style="background-image: url('{{asset('images/defaults/facilities/confe.jfif')}}');">
                            <div
                                class="absolute inset-0 bg-black/40 group-hover:bg-black/30 transition-colors duration-300">
                            </div>
                            <div class="absolute top-3 left-3">
                                <div class="w-8 h-8 bg-amber-500/90 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="p-4">
                            <h4 class="font-semibold text-lg mb-2 text-amber-400">Premium Facilities</h4>
                            <p class="text-gray-200 text-sm leading-relaxed">
                                World-class spa, fitness center, pool, and business facilities at your service.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll Indicator (keeping original) -->


    <style>
        /* Keeping your original animations */
        .animate-fade-in {
            animation: fadeIn 1s ease-in forwards;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }


        @keyframes scrollIndicator {
            0% {
                transform: translateY(0);
                opacity: 0;
            }

            50% {
                opacity: 1;
            }

            100% {
                transform: translateY(12px);
                opacity: 0;
            }
        }
    </style>

    <script>
        // Initialize AOS
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100
        });

        // Keeping your original parallax effect

    </script>
</section>