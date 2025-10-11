<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    @vite('resources/css/app.css')

    <script src="https://unpkg.com/lucide@latest"></script>

    <title>{{$title}} - Dashboard</title>
    @livewireStyles
</head>

<style>
    .carousel-container::-webkit-scrollbar {
        display: none;
    }

    .stat-gradient {
        background: linear-gradient(135deg, var(--tw-gradient-from), var(--tw-gradient-to));
    }

    .floating-animation {
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-10px);
        }
    }

    .card-hover {
        transition: all 0.3s ease;
    }

    .card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
</style>

<body>


    @auth('guest')

        <section class="bg-base-100">
            <div class="flex h-screen overflow-hidden">
                <!-- Sidebar -->
                @include('guest.components.dashboard.sidebar')

                <!-- Main content -->
                <div class="flex flex-col flex-1 overflow-hidden">
                    <!-- Navbar -->
                    @include('guest.components.dashboard.navbar')

                    <!-- Dashboard Content -->
                    <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 transition-slow ">
                        {{-- Subsystem Name --}}
                        <div class="pb-5 border-b border-base-300 animate-fadeIn">
                            <h1 class="text-2xl font-bold bg-white bg-clip-text text-[#191970]">My Dashboard</h1>
                        </div>
                        {{-- Subsystem Name --}}


                        <section class=" min-h-screen">
                            <div class="container mx-auto p-4 max-w-7xl">
                                <!-- Welcome Card with Enhanced Design -->
                                @if(session('showwelcome'))
                                                    <div class="card bg-gradient-to-r from-[#001f54] to-[#003366] text-primary-content shadow-2xl mb-8"
                                                        id="welcomeCard" data-aos="fade-up" data-aos-duration="1000">
                                                        <div class="card-body relative">
                                                            <!-- Close (X) Button -->
                                                            <button
                                                                class="absolute top-4 right-4 text-primary-content/70 hover:text-red-400 transition"
                                                                onclick="dismissWelcome()">
                                                                <i data-lucide="x" class="w-6 h-6"></i>
                                                            </button>

                                                            <!-- Grid Layout -->
                                                            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-center">
                                                                <!-- Avatar -->
                                                                <div class="flex justify-center md:justify-center md:col-span-1">
                                                                    <div class="avatar">
                                                                        <div
                                                                            class="w-32 h-32 md:w-40 md:h-40 rounded-full ring ring-primary-content ring-offset-base-100 ring-offset-4">
                                                                            <img src="{{ Auth::guard('guest')->user()->guest_photo }}"
                                                                                alt="Guest Avatar" />
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- Welcome Text -->
                                                                <div class="flex flex-col items-center md:items-start col-span-2">
                                                                    @php
                                                                        $guest = Auth::guard('guest')->user();
                                                                        // Example: consider user "new" if created in last 24 hours
                                                                        $isNew = $guest->created_at->gt(now()->subDay());
                                                                    @endphp

                                                                    <h2 class="text-2xl md:text-3xl font-bold mb-2 text-center md:text-left">
                                                                        @if($isNew)
                                                                            Welcome, {{ $guest->guest_name }}! 🎉
                                                                        @else
                                                                            Welcome back, {{ $guest->guest_name }}!
                                                                        @endif
                                                                    </h2>

                                                                    <p class="text-base md:text-lg opacity-90 text-center md:text-left">
                                                                        @if($isNew)
                                                                            We're glad to have you here for the first time. Enjoy exploring our
                                                                            services!
                                                                        @else
                                                                            We hope you're enjoying your stay.
                                                                        @endif
                                                                    </p>

                                                                    <!-- Badges -->
                                                                    <div
                                                                        class="flex items-center gap-2 mt-3 justify-center md:justify-start flex-wrap">
                                                                        <div class="badge badge-primary">Guest</div>
                                                                        @if(!$isNew)
                                                                            <div class="badge badge-outline badge-primary-content">Returning Member
                                                                            </div>
                                                                        @endif
                                                                    </div>

                                                                    <!-- View My Profile -->
                                                                    <div class="flex justify-center md:justify-start mt-6 w-full">
                                                                        <a href="/profileguest"
                                                            class="btn btn-primary flex items-center gap-2 px-4 py-2 text-sm md:text-base w-full md:w-auto">
                                                            <i data-lucide="user" class="w-5 h-5"></i>
                                                            <span>View My Profile</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif




                <!-- Enhanced Statistics Cards -->

         <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Reservations -->
            <div class="stat-card card bg-base-100 shadow-lg border-2 border-transparent hover:border-blue-400 hover:bg-gradient-to-br hover:from-blue-50 hover:to-blue-100 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl group">
                <div class="card-body items-center text-center p-6">
                    <div class="bg-blue-900 rounded-full p-4 mb-4">
                        <i data-lucide="calendar-days" class="w-8 h-8 text-yellow-400"></i>
                    </div>
                    <h3 class="text-lg font-semibold">Total Reservations</h3>
                    <div class="stat-value text-3xl font-bold text-yellow-400">
                        {{ $guesttotalreservation }}
                    </div>
                    <div class="stat-desc text-blue-900 font-medium">
                        @php
                            $diff = $guesttotalreservation - $previousReservations;
                            $sign = $diff >= 0 ? '+' : '';
                        @endphp
                        {{ $sign . $diff }} vs last month
                    </div>
                </div>
            </div>

            <!-- Upcoming Events -->
            <div class="stat-card card bg-base-100 shadow-lg border-2 border-transparent hover:border-purple-400 hover:bg-gradient-to-br hover:from-purple-50 hover:to-purple-100 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl group">
                <div class="card-body items-center text-center p-6">
                    <div class="bg-blue-900 rounded-full p-4 mb-4">
                        <i data-lucide="calendar-check" class="w-8 h-8 text-yellow-400"></i>
                    </div>
                    <h3 class="text-lg font-semibold">Upcoming Events</h3>
                    <div class="stat-value text-xl font-bold text-yellow-400">
                        {{ $events->count() }}
                    </div>
                    <div class="stat-desc font-medium text-blue-900">
                        Check your upcoming hotel events
                    </div>
                </div>
            </div>

            <!-- Recent Reservation -->
            <div class="stat-card card bg-base-100 shadow-lg border-2 border-transparent hover:border-yellow-400 hover:bg-gradient-to-br hover:from-yellow-50 hover:to-yellow-100 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl group">
                <div class="card-body items-center text-center p-6">
                    <div class="bg-blue-900 rounded-full p-4 mb-4">
                        <i data-lucide="clock" class="w-8 h-8 text-yellow-400"></i>
                    </div>
                    <h3 class="text-lg font-semibold">Recent Stay</h3>
                    <div class="stat-value text-lg font-bold text-yellow-400">
                        @if($recentstay)
                            {{ \Carbon\Carbon::parse($recentstay->reservation_checkin)->format('M d') }} -
                            {{ \Carbon\Carbon::parse($recentstay->reservation_checkout)->format('M d') }}
                        @else
                            N/A
                        @endif
                    </div>
                    <div class="stat-desc font-medium">
                        @if($recentstay)
                            {{ \Carbon\Carbon::parse($recentstay->reservation_checkin)->format('Y') }}
                        @else
                            -
                        @endif
                    </div>
                </div>
            </div>

            <!-- Loyalty Points -->
            <div class="stat-card card bg-base-100 shadow-lg border-2 border-transparent hover:border-green-400 hover:bg-gradient-to-br hover:from-green-50 hover:to-green-100 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl group">
                <div class="card-body items-center text-center p-6">
                    <div class="bg-blue-900 rounded-full p-4 mb-4">
                        <i data-lucide="coins" class="w-8 h-8 text-yellow-400"></i>
                    </div>
                    <h3 class="text-lg font-semibold">Loyalty Points</h3>
                    <div class="stat-value text-3xl font-bold text-yellow-400">
                        {{ Auth::guard('guest')->user()->loyalty_points ?? 0 }}
                    </div>
                    <div class="stat-desc font-medium text-blue-900">Ready to redeem</div>
                </div>
            </div>
        </div>






                <!-- Enhanced Carousel Section -->
        <div class="container mx-auto max-w-7xl">
            <div class="card bg-base-100 shadow-xl mb-8">
                <div class="card-header">
                    <h2 class="text-2xl font-bold p-6 pb-2 flex items-center gap-3">
                        <div class="rounded-xl bg-blue-900 p-2 shadow-lg">
                        <i data-lucide="calendar-heart" class="w-7 h-7 text-yellow-400"></i>
                        </div>
                        Upcoming Hotel Events
                    </h2>
                </div>

                <!-- Carousel Wrapper -->
                <div class="relative w-full overflow-hidden">
                    <div class="flex transition-transform duration-700 ease-in-out" id="eventSlides">
                        @foreach ($events as $event)
                            <div class="w-full flex-shrink-0">
                                <div class="hero h-80 w-full"
                                     style="background-image: url('{{ asset($event->eventphoto) }}'); background-size: cover; background-position: center;">
                                    <div class="hero-content text-center text-neutral-content relative z-10">
                                        <div class="max-w-md">
                                            <div class="flex justify-center mb-4">
                                                <div class="bg-white/20 backdrop-blur-sm rounded-full p-3">
                                                    <i data-lucide="waves" class="w-8 h-8 text-white"></i>
                                                </div>
                                            </div>
                                            <h1 class="mb-5 text-4xl font-bold floating-animation">{{ $event->eventname }}</h1>
                                            <div class="badge badge-accent badge-lg mb-4 shadow-lg">
                                                <i data-lucide="calendar" class="w-4 h-4 mr-1"></i>
                                                {{ $event->eventdate }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Prev / Next -->
                    <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2 z-20">
                        <button onclick="prevEvent()" class="btn btn-circle btn-primary shadow-lg hover:shadow-xl">
                            <i data-lucide="chevron-left" class="w-5 h-5"></i>
                        </button>
                        <button onclick="nextEvent()" class="btn btn-circle btn-primary shadow-lg hover:shadow-xl">
                            <i data-lucide="chevron-right" class="w-5 h-5"></i>
                        </button>
                    </div>
                </div>

                <!-- Indicators -->
                <div class="flex justify-center w-full py-6 gap-3">
                    @foreach ($events as $index => $event)
                        <button onclick="goToEvent({{ $index }})" 
                                class="btn btn-sm btn-circle hover:btn-primary transition-all duration-200">
                            {{ $index + 1 }}
                        </button>
                    @endforeach
                </div>
            </div>
        </div>

        <script>
            let eventIndex = 0;
            const eventSlides = document.getElementById('eventSlides');
            const totalEventSlides = {{ count($events) }};

            function updateEventCarousel() {
                eventSlides.style.transform = `translateX(-${eventIndex * 100}%)`;
            }

            function nextEvent() {
                eventIndex = (eventIndex + 1) % totalEventSlides;
                updateEventCarousel();
            }

            function prevEvent() {
                eventIndex = (eventIndex - 1 + totalEventSlides) % totalEventSlides;
                updateEventCarousel();
            }

            function goToEvent(index) {
                eventIndex = index;
                updateEventCarousel();
            }

            // Auto-slide
            setInterval(nextEvent, 5000);

            // Init
            updateEventCarousel();
        </script>







         <!-- Parent Container with Grid Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-10">

            <!-- Featured Rooms Carousel -->
            <div class="card bg-white shadow-lg rounded-xl border border-gray-100 overflow-hidden">
                <div class="p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center mr-3 bg-blue-900">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" class="text-yellow-400">
                                <path d="M21 10.78V8C21 6.9 20.1 6 19 6H5C3.9 6 3 6.9 3 8V10.78C3.39 10.47 3.86 10.25 4.4 10.17C5.28 10.05 6.2 10.36 6.85 11.01L10 14.16L13.15 11.01C14.45 9.71 16.55 9.71 17.85 11.01C18.39 11.55 18.71 12.27 18.74 13.03H21V10.78Z"/>
                                <path d="M2 19V17H22V19C22 20.1 21.1 21 20 21H4C2.9 21 2 20.1 2 19Z"/>
                            </svg>
                        </div>
                        Featured Rooms
                    </h2>

                    <div class="relative w-full rounded-xl overflow-hidden" id="roomCarousel">
                        @foreach($rooms as $index => $room)
                            <div class="carousel-slide {{ $index === 0 ? 'block' : 'hidden' }}">
                                <img src="{{ $room->roomphoto }}" alt="{{ $room->roomtype }}" class="w-full h-80 object-cover rounded-xl">
                                <div class="absolute inset-0 bg-gradient-to-r from-black/60 to-black/30 rounded-xl"></div>
                                <div class="absolute inset-0 p-8 flex items-center">
                                    <div class="text-white max-w-2xl">
                                        <h3 class="text-3xl font-bold mb-3">{{ $room->roomtype }}</h3>
                                        <p class="text-xl mb-2 opacity-90">{{ $room->roomsize }} sqm • Max {{ $room->roommaxguest }} guests</p>
                                        <div class="flex flex-wrap gap-2">
                                            <span class="badge px-3 py-1 rounded-full text-white border-white border bg-transparent text-sm">₱{{ $room->roomprice }}/night</span>
                                            @if($room->roomfeatures)
                                                @foreach(explode(',', $room->roomfeatures) as $feature)
                                                    <span class="badge px-3 py-1 rounded-full text-yellow-400 border border-yellow-400 bg-transparent text-sm">{{ trim($feature) }}</span>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Promotions Carousel -->
            <div class="card bg-white shadow-lg rounded-xl border border-gray-100 overflow-hidden">
                <div class="p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center mr-3 bg-blue-900">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        Promotions
                    </h2>

                    <div class="relative w-full rounded-xl overflow-hidden" id="promoCarousel">
                        @foreach($promos as $index => $promo)
                            <div class="carousel-slide {{ $index === 0 ? 'block' : 'hidden' }}">
                                <img src="{{ $promo->hotelpromophoto }}" alt="{{ $promo->hotelpromoname }}" class="w-full h-80 object-cover rounded-xl">
                                <div class="absolute inset-0 bg-gradient-to-r from-black/60 to-black/30 rounded-xl"></div>
                                <div class="absolute inset-0 p-8 flex items-center">
                                    <div class="text-white max-w-2xl">
                                        <h3 class="text-3xl font-bold mb-3">{{ $promo->hotelpromoname }}</h3>
                                        <p class="text-xl mb-2 opacity-90">{{ $promo->hotelpromodaterange }}</p>
                                        <p class="text-lg opacity-80 mb-4">{{ $promo->hotelpromodescription }}</p>
                                        @if($promo->hotelpromotag)
                                            <div class="flex flex-wrap gap-2">
                                                <span class="badge px-3 py-1 rounded-full text-yellow-400 border border-yellow-400 bg-transparent text-sm">{{ $promo->hotelpromotag }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>

        <script>
            function initCarousel(carouselId, interval = 5000) {
                const carousel = document.getElementById(carouselId);
                const slides = carousel.querySelectorAll('.carousel-slide');
                let current = 0;

                setInterval(() => {
                    slides[current].classList.add('hidden');
                    slides[current].classList.remove('block');
                    current = (current + 1) % slides.length;
                    slides[current].classList.remove('hidden');
                    slides[current].classList.add('block');
                }, interval);
            }

            document.addEventListener('DOMContentLoaded', () => {
                initCarousel('roomCarousel', 5000);
                initCarousel('promoCarousel', 5000);
            });
        </script>


            </div>



        </section>

        <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
        <script>
            AOS.init({
                duration: 1000,
                once: true
            });
        </script>



         <script>
                function dismissWelcome() {
                    document.getElementById('welcomeCard').style.display = 'none';
                }
            </script>






        <!-- Initialize Lucide Icons -->
        <script>
          lucide.createIcons();
        </script>


                </main>
              </div>
            </div>





           @livewireScripts
          @include('javascriptfix.soliera_js')
          </section>






    @endauth
  
</body>
</html>