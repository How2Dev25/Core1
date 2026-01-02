<section class=" w-full p-5 bg-gray-200">
    <div class="flex gap-10 max-md:flex-col items-center ">

        {{-- right column --}}
        <div class="w-1/2 max-md:w-full gap-8 flex flex-col justify-center items-center text-center px-6 py-8">
            <div class="opacity-0 animate-reveal-left" style="animation-delay: 1.5s;">
                <h3
                    class="text-4xl sm:text-5xl md:text-6xl font-serif text-black/95 tracking-tight italic drop-shadow-lg leading-tight">
                    Savor The <span class="font-bold text-blue-900 not-italic">Stay</span>,<br>
                    <span class="mt-2 block">Dine With <span
                            class="font-bold text-black not-italic underline decoration-blue-900 underline-offset-8">Elegance</span></span>
                </h3>
            </div>

            <div class="opacity-0 animate-fade-in-up mt-4" style="animation-delay: 1.8s;">
                <p
                    class="text-xl sm:text-2xl md:text-3xl text-gray-800 max-w-3xl leading-relaxed min-h-[7rem] drop-shadow-xl font-light">
                    <span id="typewriter"></span>
                    <span class="inline-block w-1 h-8 bg-blue-900 ml-1 animate-pulse" id="cursor"></span>
                </p>
            </div>

            <div class="flex flex-wrap justify-center items-center gap-8 pt-6 w-full opacity-0 animate-reveal-up"
                style="animation-delay: 2s;">
                <div
                    class="flex items-center gap-3 bg-gray-100 px-4 py-2 rounded-full border border-gray-200 hover:border-blue-900/50 transition-colors">
                    <svg class="w-6 h-6 text-blue-900" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="text-base font-medium text-gray-800">Loyalty Points</span>
                </div>
                <div
                    class="flex items-center gap-3 bg-gray-100 px-4 py-2 rounded-full border border-gray-200 hover:border-blue-900/50 transition-colors">
                    <svg class="w-6 h-6 text-blue-900" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="text-base font-medium text-gray-800">Price Guarantee</span>
                </div>
                <div
                    class="flex items-center gap-3 bg-gray-100 px-4 py-2 rounded-full border border-gray-200 hover:border-blue-900/50 transition-colors">
                    <svg class="w-6 h-6 text-blue-900" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="text-base font-medium text-gray-800">24/7 Support</span>
                </div>
            </div>
        </div>

        <div class="w-1/2 max-md:w-full">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 xl:grid-cols-2 gap-6 lg:gap-8">
                <div class="card-3d-wrap group relative bg-gray-50 border border-gray-200 rounded-3xl overflow-hidden opacity-0 animate-reveal-right"
                    style="animation-delay: 0.2s;">
                    <div class="h-48 bg-cover bg-center relative"
                        style="background-image: url('{{asset('images/defaults/rooms/1 standard/room1.png')}}');">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent opacity-80">
                        </div>
                        <div
                            class="absolute top-5 left-5 w-12 h-12 bg-blue-900 rounded-2xl flex items-center justify-center shadow-lg group-hover:rotate-12 transition-transform">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                    </div>
                    <div class="p-6">
                        <h4 class="font-bold text-2xl mb-2 text-blue-900">Book Rooms</h4>
                        <p class="text-gray-700 text-base leading-relaxed">Reserve your perfect stay with
                            our luxury suites and premium accommodations.</p>
                    </div>
                    <div
                        class="absolute inset-0 border-2 border-blue-900/0 group-hover:border-blue-900/50 rounded-3xl transition-all duration-500">
                    </div>
                </div>

                <div class="card-3d-wrap group relative bg-gray-50 border border-gray-200 rounded-3xl overflow-hidden opacity-0 animate-reveal-right"
                    style="animation-delay: 0.4s;">
                    <div class="h-48 bg-cover bg-center relative"
                        style="background-image: url('{{asset('images/defaults/personalacc.png')}}');">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent opacity-80">
                        </div>
                        <div
                            class="absolute top-5 left-5 w-12 h-12 bg-blue-900 rounded-2xl flex items-center justify-center shadow-lg group-hover:rotate-12 transition-transform">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    </div>
                    <div class="p-6">
                        <h4 class="font-bold text-2xl mb-2 text-blue-900">Personalized Accounts</h4>
                        <p class="text-gray-700 text-base leading-relaxed">Enjoy tailored experiences with
                            your personal preferences and loyalty rewards.</p>
                    </div>
                    <div
                        class="absolute inset-0 border-2 border-blue-900/0 group-hover:border-blue-900/50 rounded-3xl transition-all duration-500">
                    </div>
                </div>

                <div class="card-3d-wrap group relative bg-gray-50 border border-gray-200 rounded-3xl overflow-hidden opacity-0 animate-reveal-right"
                    style="animation-delay: 0.6s;">
                    <div class="h-48 bg-cover bg-center relative"
                        style="background-image: url('{{asset('images/defaults/events/christmas.png')}}');">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent opacity-80">
                        </div>
                        <div
                            class="absolute top-5 left-5 w-12 h-12 bg-blue-900 rounded-2xl flex items-center justify-center shadow-lg group-hover:rotate-12 transition-transform">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                    <div class="p-6">
                        <h4 class="font-bold text-2xl mb-2 text-blue-900">Book Events</h4>
                        <p class="text-gray-700 text-base leading-relaxed">Host unforgettable weddings,
                            conferences, and celebrations in our elegant venues.</p>
                    </div>
                    <div
                        class="absolute inset-0 border-2 border-blue-900/0 group-hover:border-blue-900/50 rounded-3xl transition-all duration-500">
                    </div>
                </div>

                <div class="card-3d-wrap group relative bg-gray-50 border border-gray-200 rounded-3xl overflow-hidden opacity-0 animate-reveal-right"
                    style="animation-delay: 0.8s;">
                    <div class="h-48 bg-cover bg-center relative"
                        style="background-image: url('{{asset('images/defaults/facilities/confe.jfif')}}');">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent opacity-80">
                        </div>
                        <div
                            class="absolute top-5 left-5 w-12 h-12 bg-blue-900 rounded-2xl flex items-center justify-center shadow-lg group-hover:rotate-12 transition-transform">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5" />
                            </svg>
                        </div>
                    </div>
                    <div class="p-6">
                        <h4 class="font-bold text-2xl mb-2 text-blue-900">Premium Facilities</h4>
                        <p class="text-gray-700 text-base leading-relaxed">World-class spa, fitness center,
                            pool, and business facilities at your service.</p>
                    </div>
                    <div
                        class="absolute inset-0 border-2 border-blue-900/0 group-hover:border-blue-900/50 rounded-3xl transition-all duration-500">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

