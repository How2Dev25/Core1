{{-- this default --}}

<section id="about" class="hero min-h-screen p-5  flex items-center justify-center text-white relative overflow-hidden">
    <!-- Enhanced Background Layers -->
    <div class="absolute inset-0 bg-black/50 z-10"></div>
    <div class="absolute inset-0 bg-gradient-to-br from-black/80 via-black/40 to-black/80 z-10"></div>

    <!-- Animated Parallax Background -->
    <div class="parallax-bg absolute inset-0 bg-cover bg-center transition-transform duration-700 ease-out"
        style="background-image: url('{{ asset('images/defaults/hotel3.jpg') }}');">
    </div>

    <!-- Floating Decorative Elements -->
    <div class="absolute inset-0 z-10 pointer-events-none overflow-hidden">
        <div
            class="floating-element absolute top-1/4 left-10 w-24 h-24 bg-amber-500/10 rounded-full blur-3xl animate-float-slow">
        </div>
        <div
            class="floating-element absolute top-1/2 right-20 w-32 h-32 bg-amber-400/10 rounded-full blur-3xl animate-float-delayed">
        </div>
        <div
            class="floating-element absolute bottom-1/3 left-1/3 w-20 h-20 bg-white/5 rounded-full blur-2xl animate-float">
        </div>
    </div>

    <!-- Main Content Container -->
    <div class="z-20 relative w-full max-w-7xl mx-auto lg:mt-20 px-4 sm:px-6 lg:px-8 py-12 lg:py-0">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center min-h-[calc(100vh-6rem)]">

            <!-- Left Column - Main Content -->
            <div class="col-span-1 lg:col-span-7 xl:col-span-6 space-y-6 lg:space-y-8">

                <!-- Star Rating Section with Animation -->
                <div class="opacity-0 animate-slide-in-left" style="animation-delay: 0.1s;">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="flex gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-amber-400 animate-star-pulse"
                                style="animation-delay: 0s;" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M12 .587l3.668 7.571 8.332 1.151-6.064 5.879 1.48 8.295L12 18.896l-7.416 4.587 1.48-8.295L.0 9.309l8.332-1.151z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-amber-400 animate-star-pulse"
                                style="animation-delay: 0.1s;" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M12 .587l3.668 7.571 8.332 1.151-6.064 5.879 1.48 8.295L12 18.896l-7.416 4.587 1.48-8.295L.0 9.309l8.332-1.151z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-amber-400 animate-star-pulse"
                                style="animation-delay: 0.2s;" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M12 .587l3.668 7.571 8.332 1.151-6.064 5.879 1.48 8.295L12 18.896l-7.416 4.587 1.48-8.295L.0 9.309l8.332-1.151z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-amber-400 animate-star-pulse"
                                style="animation-delay: 0.3s;" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M12 .587l3.668 7.571 8.332 1.151-6.064 5.879 1.48 8.295L12 18.896l-7.416 4.587 1.48-8.295L.0 9.309l8.332-1.151z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-amber-400 animate-star-pulse"
                                style="animation-delay: 0.4s;" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M12 .587l3.668 7.571 8.332 1.151-6.064 5.879 1.48 8.295L12 18.896l-7.416 4.587 1.48-8.295L.0 9.309l8.332-1.151z" />
                            </svg>
                        </div>
                        <span class="text-amber-400 text-sm font-semibold tracking-wide">5-STAR LUXURY HOTEL</span>
                    </div>
                    <div class="h-0.5 w-20 bg-gradient-to-r from-amber-400 to-transparent animate-expand-line"></div>
                </div>

                <!-- Hotel Name Section with Stagger Animation -->
                <div class="space-y-3 opacity-0 animate-slide-in-left" style="animation-delay: 0.3s;">
                    <h1 class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl font-bold leading-none">
                        <span
                            class="text-[#F7B32B] inline-block animate-text-shimmer bg-gradient-to-r from-amber-400 via-amber-300 to-amber-400 bg-clip-text text-transparent bg-[length:200%_100%]">
                            SOLIERA
                        </span>
                    </h1>
                    <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-white tracking-tight">
                        HOTEL & RESTAURANT
                    </h2>
                    <div
                        class="h-px w-full max-w-md bg-gradient-to-r from-amber-400 via-amber-400/50 to-transparent animate-expand-full">
                    </div>
                </div>

                <!-- Tagline Section -->
                <div class="opacity-0 animate-slide-in-left" style="animation-delay: 0.5s;">
                    <h3 class="text-xl sm:text-2xl md:text-3xl font-light text-white/95 tracking-wide italic">
                        Savor The Stay, Dine With Elegance
                    </h3>
                </div>

                <!-- Description Section -->
                <div class="opacity-0 animate-fade-in-up" style="animation-delay: 0.7s;">
                    <p
                        class="text-base sm:text-lg md:text-xl text-gray-200 max-w-2xl leading-relaxed min-h-[4rem] sm:min-h-[5rem]">
                        <span id="typewriter"></span>
                        <span class="inline-block w-0.5 h-5 sm:h-6 bg-amber-400 ml-1 animate-pulse" id="cursor"></span>
                    </p>
                </div>

                <!-- CTA Buttons Section with Hover Effects -->
                <div class="flex flex-col sm:flex-row gap-4 opacity-0 animate-fade-in-up"
                    style="animation-delay: 0.9s;">
                    <a href="#rooms"
                        class="group relative bg-amber-500 hover:bg-amber-600 text-black font-bold px-8 py-4 rounded-xl transform hover:scale-105 hover:shadow-2xl hover:shadow-amber-500/30 transition-all duration-300 text-center overflow-hidden">
                        <span class="relative z-10 flex items-center justify-center gap-2">
                            Explore Rooms
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform duration-300" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </span>
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-amber-400 to-amber-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>
                    </a>
                    <button onclick="view_room.showModal()"
                        class="group relative border-2 border-white text-white hover:bg-white hover:text-black font-bold px-8 py-4 rounded-xl transform hover:scale-105 transition-all duration-300 text-center backdrop-blur-sm hover:shadow-2xl hover:shadow-white/20">
                        <span class="flex items-center justify-center gap-2">
                            Book Now
                            <svg class="w-5 h-5 group-hover:rotate-12 transition-transform duration-300" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </span>
                    </button>
                </div>

                <!-- Trust Indicators -->
                <div class="flex flex-wrap items-center gap-6 pt-4 opacity-0 animate-fade-in-up"
                    style="animation-delay: 1.1s;">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm text-gray-300">Monitor Loyalty Points</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm text-gray-300">Best Price Guarantee</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm text-gray-300">24/7 Support</span>
                    </div>
                </div>
            </div>

            <!-- Right Column - Enhanced Features Grid -->
            <div class="col-span-1 lg:col-span-5 xl:col-span-6 lg:pl-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 xl:grid-cols-2 gap-4 lg:gap-6">

                    <!-- Feature Card 1 - Book Rooms -->
                    <div class="group relative bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl overflow-hidden hover:bg-white/15 transition-all duration-500 cursor-pointer opacity-0 animate-fade-in-up hover:scale-105 hover:shadow-2xl hover:shadow-amber-500/20"
                        style="animation-delay: 0.2s;">
                        <div class="h-40 bg-cover bg-center relative overflow-hidden"
                            style="background-image: url('{{asset('images/defaults/rooms/1 standard/room1.png')}}');">
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent group-hover:from-black/60 transition-all duration-500">
                            </div>
                            <div
                                class="absolute inset-0 bg-amber-500/0 group-hover:bg-amber-500/10 transition-all duration-500">
                            </div>
                            <div
                                class="absolute top-4 left-4 transform group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                                <div
                                    class="w-10 h-10 bg-gradient-to-br from-amber-400 to-amber-600 rounded-xl flex items-center justify-center shadow-lg">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="p-5 relative">
                            <h4
                                class="font-bold text-lg mb-2 text-amber-400 group-hover:text-amber-300 transition-colors duration-300">
                                Book Rooms</h4>
                            <p
                                class="text-gray-200 text-sm leading-relaxed group-hover:text-white transition-colors duration-300">
                                Reserve your perfect stay with our luxury suites and premium accommodations.
                            </p>
                            <div
                                class="absolute bottom-0 left-0 w-0 h-1 bg-gradient-to-r from-amber-400 to-amber-600 group-hover:w-full transition-all duration-500">
                            </div>
                        </div>
                    </div>

                    <!-- Feature Card 2 - Personalized Accounts -->
                    <div class="group relative bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl overflow-hidden hover:bg-white/15 transition-all duration-500 cursor-pointer opacity-0 animate-fade-in-up hover:scale-105 hover:shadow-2xl hover:shadow-amber-500/20"
                        style="animation-delay: 0.4s;">
                        <div class="h-40 bg-cover bg-center relative overflow-hidden"
                            style="background-image: url('{{asset('images/defaults/personalacc.png')}}');">
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent group-hover:from-black/60 transition-all duration-500">
                            </div>
                            <div
                                class="absolute inset-0 bg-amber-500/0 group-hover:bg-amber-500/10 transition-all duration-500">
                            </div>
                            <div
                                class="absolute top-4 left-4 transform group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                                <div
                                    class="w-10 h-10 bg-gradient-to-br from-amber-400 to-amber-600 rounded-xl flex items-center justify-center shadow-lg">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="p-5 relative">
                            <h4
                                class="font-bold text-lg mb-2 text-amber-400 group-hover:text-amber-300 transition-colors duration-300">
                                Personalized Accounts</h4>
                            <p
                                class="text-gray-200 text-sm leading-relaxed group-hover:text-white transition-colors duration-300">
                                Enjoy tailored experiences with your personal preferences and loyalty rewards.
                            </p>
                            <div
                                class="absolute bottom-0 left-0 w-0 h-1 bg-gradient-to-r from-amber-400 to-amber-600 group-hover:w-full transition-all duration-500">
                            </div>
                        </div>
                    </div>

                    <!-- Feature Card 3 - Book Events -->
                    <div class="group relative bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl overflow-hidden hover:bg-white/15 transition-all duration-500 cursor-pointer opacity-0 animate-fade-in-up hover:scale-105 hover:shadow-2xl hover:shadow-amber-500/20"
                        style="animation-delay: 0.6s;">
                        <div class="h-40 bg-cover bg-center relative overflow-hidden"
                            style="background-image: url('{{asset('images/defaults/events/christmas.png')}}');">
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent group-hover:from-black/60 transition-all duration-500">
                            </div>
                            <div
                                class="absolute inset-0 bg-amber-500/0 group-hover:bg-amber-500/10 transition-all duration-500">
                            </div>
                            <div
                                class="absolute top-4 left-4 transform group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                                <div
                                    class="w-10 h-10 bg-gradient-to-br from-amber-400 to-amber-600 rounded-xl flex items-center justify-center shadow-lg">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="p-5 relative">
                            <h4
                                class="font-bold text-lg mb-2 text-amber-400 group-hover:text-amber-300 transition-colors duration-300">
                                Book Events</h4>
                            <p
                                class="text-gray-200 text-sm leading-relaxed group-hover:text-white transition-colors duration-300">
                                Host unforgettable weddings, conferences, and celebrations in our elegant venues.
                            </p>
                            <div
                                class="absolute bottom-0 left-0 w-0 h-1 bg-gradient-to-r from-amber-400 to-amber-600 group-hover:w-full transition-all duration-500">
                            </div>
                        </div>
                    </div>

                    <!-- Feature Card 4 - Facilities -->
                    <div class="group relative bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl overflow-hidden hover:bg-white/15 transition-all duration-500 cursor-pointer opacity-0 animate-fade-in-up hover:scale-105 hover:shadow-2xl hover:shadow-amber-500/20"
                        style="animation-delay: 0.8s;">
                        <div class="h-40 bg-cover bg-center relative overflow-hidden"
                            style="background-image: url('{{asset('images/defaults/facilities/confe.jfif')}}');">
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent group-hover:from-black/60 transition-all duration-500">
                            </div>
                            <div
                                class="absolute inset-0 bg-amber-500/0 group-hover:bg-amber-500/10 transition-all duration-500">
                            </div>
                            <div
                                class="absolute top-4 left-4 transform group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                                <div
                                    class="w-10 h-10 bg-gradient-to-br from-amber-400 to-amber-600 rounded-xl flex items-center justify-center shadow-lg">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="p-5 relative">
                            <h4
                                class="font-bold text-lg mb-2 text-amber-400 group-hover:text-amber-300 transition-colors duration-300">
                                Premium Facilities</h4>
                            <p
                                class="text-gray-200 text-sm leading-relaxed group-hover:text-white transition-colors duration-300">
                                World-class spa, fitness center, pool, and business facilities at your service.
                            </p>
                            <div
                                class="absolute bottom-0 left-0 w-0 h-1 bg-gradient-to-r from-amber-400 to-amber-600 group-hover:w-full transition-all duration-500">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <style>
        /* Enhanced Animations */
        @keyframes slide-in-left {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fade-in-up {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes star-pulse {

            0%,
            100% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: 0.7;
                transform: scale(0.95);
            }
        }

        @keyframes expand-line {
            from {
                width: 0;
            }

            to {
                width: 5rem;
            }
        }

        @keyframes expand-full {
            from {
                width: 0;
            }

            to {
                width: 100%;
            }
        }

        @keyframes text-shimmer {
            0% {
                background-position: 200% center;
            }

            100% {
                background-position: -200% center;
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0) translateX(0);
            }

            50% {
                transform: translateY(-20px) translateX(10px);
            }
        }

        @keyframes float-slow {

            0%,
            100% {
                transform: translateY(0) translateX(0) scale(1);
            }

            50% {
                transform: translateY(-30px) translateX(-15px) scale(1.1);
            }
        }

        @keyframes float-delayed {

            0%,
            100% {
                transform: translateY(0) translateX(0) rotate(0deg);
            }

            50% {
                transform: translateY(-25px) translateX(15px) rotate(5deg);
            }
        }

        @keyframes scroll-indicator {
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

        .animate-slide-in-left {
            animation: slide-in-left 0.8s ease-out forwards;
        }

        .animate-fade-in-up {
            animation: fade-in-up 0.8s ease-out forwards;
        }

        .animate-star-pulse {
            animation: star-pulse 2s ease-in-out infinite;
        }

        .animate-expand-line {
            animation: expand-line 1s ease-out forwards;
            animation-delay: 0.3s;
        }

        .animate-expand-full {
            animation: expand-full 1s ease-out forwards;
            animation-delay: 0.5s;
        }

        .animate-text-shimmer {
            animation: text-shimmer 3s linear infinite;
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        .animate-float-slow {
            animation: float-slow 8s ease-in-out infinite;
        }

        .animate-float-delayed {
            animation: float-delayed 7s ease-in-out infinite;
            animation-delay: 1s;
        }

        .animate-scroll-indicator {
            animation: scroll-indicator 2s ease-in-out infinite;
        }

        /* Parallax Effect */
        .parallax-bg {
            will-change: transform;
        }

        /* Responsive Typography */
        @media (max-width: 640px) {
            h1 {
                font-size: 3rem;
            }
        }

        /* Smooth Scroll */
        html {
            scroll-behavior: smooth;
        }
    </style>

    <script>
        // Typewriter Effect with Multiple Phrases
        const phrases = [
            'Welcome to <span class="text-amber-400 font-semibold">Soliera</span> — where luxury meets comfort. Experience world-class hospitality and unforgettable stays.',
            'Discover <span class="text-amber-400 font-semibold">elegance reimagined</span>. Indulge in exquisite dining, premium accommodations, and exceptional service.',
            'Your <span class="text-amber-400 font-semibold">perfect escape</span> awaits. From sunrise to sunset, every moment is crafted for your ultimate comfort.',
            'Experience <span class="text-amber-400 font-semibold">unparalleled luxury</span>. Where modern amenities meet timeless sophistication in the heart of the city.',
            'At <span class="text-amber-400 font-semibold">Soliera</span>, we don\'t just offer rooms — we create memories that last a lifetime.'
        ];

        let phraseIndex = 0;
        let charIndex = 0;
        let isDeleting = false;
        let typeSpeed = 50;
        const deleteSpeed = 30;
        const pauseDelay = 3000;
        const deleteDelay = 1500;

        function typeWriter() {
            const typewriterEl = document.getElementById('typewriter');
            const cursor = document.getElementById('cursor');

            if (!typewriterEl || !cursor) return;

            const currentPhrase = phrases[phraseIndex];

            if (!isDeleting && charIndex <= currentPhrase.length) {
                // Typing
                typewriterEl.innerHTML = currentPhrase.substring(0, charIndex);
                charIndex++;
                typeSpeed = 50;

                if (charIndex === currentPhrase.length + 1) {
                    // Finished typing, pause before deleting
                    setTimeout(() => {
                        isDeleting = true;
                        typeWriter();
                    }, pauseDelay);
                    return;
                }
            } else if (isDeleting && charIndex > 0) {
                // Deleting
                const tempDiv = document.createElement('div');
                tempDiv.innerHTML = currentPhrase;
                const textContent = tempDiv.textContent || tempDiv.innerText;

                let currentText = currentPhrase.substring(0, charIndex);
                typewriterEl.innerHTML = currentText;
                charIndex--;
                typeSpeed = deleteSpeed;

                if (charIndex === 0) {
                    // Finished deleting
                    isDeleting = false;
                    phraseIndex = (phraseIndex + 1) % phrases.length;
                    setTimeout(() => {
                        typeWriter();
                    }, 500);
                    return;
                }
            }

            setTimeout(typeWriter, typeSpeed);
        }

        // Start typewriter effect after initial animation
        setTimeout(() => {
            typeWriter();
        }, 1500);

        // Enhanced Parallax Effect
        let lastScrollY = window.scrollY;
        let ticking = false;

        function updateParallax() {
            const parallaxBg = document.querySelector('.parallax-bg');
            if (parallaxBg) {
                const scrolled = window.scrollY;
                parallaxBg.style.transform = `translateY(${scrolled * 0.5}px) scale(1.1)`;
            }
            ticking = false;
        }

        window.addEventListener('scroll', () => {
            lastScrollY = window.scrollY;
            if (!ticking) {
                window.requestAnimationFrame(updateParallax);
                ticking = true;
            }
        });

        // Add hover effect for feature cards
        document.querySelectorAll('.group').forEach(card => {
            card.addEventListener('mouseenter', function () {
                this.style.transform = 'translateY(-8px) scale(1.02)';
            });
            card.addEventListener('mouseleave', function () {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });
    </script>
</section>