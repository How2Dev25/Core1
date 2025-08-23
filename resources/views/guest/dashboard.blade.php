<!DOCTYPE html>
<html lang="en" data-theme ="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    @vite('resources/css/app.css')
 
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <title>{{$title}} - Booking And Reservation</title>
      @livewireStyles
</head>

<style>
        .carousel-container {
            scroll-behavior: smooth;
        }
        .stat-card {
            transition: transform 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-5px);
        }
    </style>

@auth('guest')

<body class="bg-base-100">
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
            <h1 class="text-2xl font-bold bg-white bg-clip-text text-[#191970]">Dashboard</h1>
          </div>
            {{-- Subsystem Name --}}

    
            <section class="w-full p-4 md:p-6 max-w-7xl mx-auto">
        <!-- Welcome Card -->
        <div class="card bg-base-100 shadow-xl mb-6 relative" id="welcomeCard">
            <div class="card-body flex flex-col md:flex-row items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="avatar">
                        <div class="w-16 rounded-full">
                            <img src="{{asset(Auth::guard('guest')->user()->guest_photo)}}" />
                        </div>
                    </div>
                    <div>
                        <h2 class="card-title">Welcome back, {{Auth::guard('guest')->user()->guest_name}}!</h2>
                        <p>We hope you're enjoying your stay</p>
                    </div>
                </div>
                <div class="flex items-center space-x-4 mt-4 md:mt-0">
                   
                    <button class="btn btn-primary" onclick="dismissWelcome()">Close</button>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <!-- Total Reservations -->
            <div class="stat-card bg-white rounded-lg shadow p-4 flex items-center">
                <div class="rounded-full bg-blue-100 p-3 mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold">Total Reservations</h3>
                    <p class="text-2xl font-bold">12</p>
                </div>
            </div>

            <!-- Total Loyalty Points -->
            <div class="stat-card bg-white rounded-lg shadow p-4 flex items-center">
                <div class="rounded-full bg-green-100 p-3 mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold">Loyalty Points</h3>
                    <p class="text-2xl font-bold">4,250</p>
                </div>
            </div>

            <!-- Favorite Room -->
            <div class="stat-card bg-white rounded-lg shadow p-4 flex items-center">
                <div class="rounded-full bg-purple-100 p-3 mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold">Favorite Room</h3>
                    <p class="text-xl font-bold">Ocean View Suite</p>
                </div>
            </div>

            <!-- Recent Reservation -->
            <div class="stat-card bg-white rounded-lg shadow p-4 flex items-center">
                <div class="rounded-full bg-yellow-100 p-3 mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold">Recent Reservation</h3>
                    <p class="text-xl font-bold">Jun 15 - Jun 20, 2023</p>
                </div>
            </div>
        </div>

        <!-- Carousel Section -->
        <div class="mb-6 bg-white rounded-lg shadow overflow-hidden">
            <h2 class="text-xl font-bold p-4 border-b">Hotel Events</h2>
            <div class="carousel-container flex overflow-x-auto snap-x snap-mandatory" style="scrollbar-width: none;">
                <div class="carousel-item w-full flex-shrink-0 snap-start">
                    <div class="hero h-64" style="background-image: url('data:image/svg+xml,%3Csvg xmlns=\"http://www.w3.org/2000/svg\" width=\"800\" height=\"300\" viewBox=\"0 0 800 300\"%3E%3Crect width=\"800\" height=\"300\" fill=\"%233B82F6\"/%3E%3Ctext x=\"400\" y=\"150\" font-family=\"Arial\" font-size=\"30\" fill=\"white\" text-anchor=\"middle\"%3ESummer Pool Party - June 25%3C/text%3E%3C/svg%3E');">
                        <div class="hero-overlay bg-opacity-60"></div>
                        <div class="hero-content text-center text-neutral-content">
                            <div class="max-w-md">
                                <h1 class="mb-5 text-5xl font-bold">Summer Pool Party</h1>
                                <p class="mb-5">Join us for our annual summer celebration with live music and special cocktails</p>
                                <button class="btn btn-primary">Learn More</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item w-full flex-shrink-0 snap-start">
                    <div class="hero h-64" style="background-image: url('data:image/svg+xml,%3Csvg xmlns=\"http://www.w3.org/2000/svg\" width=\"800\" height=\"300\" viewBox=\"0 0 800 300\"%3E%3Crect width=\"800\" height=\"300\" fill=\"%2310B981\"/%3E%3Ctext x=\"400\" y=\"150\" font-family=\"Arial\" font-size=\"30\" fill=\"white\" text-anchor=\"middle\"%3EWine Tasting Event - July 12%3C/text%3E%3C/svg%3E');">
                        <div class="hero-overlay bg-opacity-60"></div>
                        <div class="hero-content text-center text-neutral-content">
                            <div class="max-w-md">
                                <h1 class="mb-5 text-5xl font-bold">Wine Tasting</h1>
                                <p class="mb-5">Sample exquisite wines from local vineyards with our expert sommelier</p>
                                <button class="btn btn-primary">Learn More</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item w-full flex-shrink-0 snap-start">
                    <div class="hero h-64" style="background-image: url('data:image/svg+xml,%3Csvg xmlns=\"http://www.w3.org/2000/svg\" width=\"800\" height=\"300\" viewBox=\"0 0 800 300\"%3E%3Crect width=\"800\" height=\"300\" fill=\"%238B5CF6\"/%3E%3Ctext x=\"400\" y=\"150\" font-family=\"Arial\" font-size=\"30\" fill=\"white\" text-anchor=\"middle\"%3EYoga Retreat - August 5-7%3C/text%3E%3C/svg%3E');">
                        <div class="hero-overlay bg-opacity-60"></div>
                        <div class="hero-content text-center text-neutral-content">
                            <div class="max-w-md">
                                <h1 class="mb-5 text-5xl font-bold">Weekend Yoga Retreat</h1>
                                <p class="mb-5">Rejuvenate your mind and body with our expert instructors</p>
                                <button class="btn btn-primary">Learn More</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-center space-x-2 p-4">
                <button class="btn btn-xs" onclick="scrollCarousel(-1)">❮</button>
                <button class="btn btn-xs" onclick="scrollCarousel(1)">❯</button>
            </div>
        </div>

        <!-- Room Showcase -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <h2 class="text-xl font-bold p-4 border-b">Available Rooms</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 p-4">
                <!-- Room 1 -->
                <div class="card bg-base-100 shadow-md">
                    <figure>
                        <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='200' viewBox='0 0 300 200'%3E%3Crect width='300' height='200' fill='%23e5e7eb'/%3E%3Cpath d='M150,100 L200,50 L250,100 L250,175 L150,175 Z' fill='%23f3f4f6' stroke='%239ca3af' stroke-width='2'/%3E%3Ccircle cx='180' cy='130' r='10' fill='%233B82F6'/%3E%3Crect x='210' y='120' width='30' height='20' fill='%239ca3af'/%3E%3C/svg%3E" alt="Standard Room" class="h-48 w-full object-cover" />
                    </figure>
                    <div class="card-body p-4">
                        <h2 class="card-title">Standard Room</h2>
                        <p>Comfortable and affordable accommodation with all basic amenities.</p>
                        <div class="flex justify-between items-center mt-2">
                            <div class="text-2xl font-bold">$129<sub class="text-sm font-normal">/night</sub></div>
                            <button class="btn btn-primary">Book Now</button>
                        </div>
                    </div>
                </div>

                <!-- Room 2 -->
                <div class="card bg-base-100 shadow-md">
                    <figure>
                        <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='200' viewBox='0 0 300 200'%3E%3Crect width='300' height='200' fill='%23e5e7eb'/%3E%3Cpath d='M100,50 L200,50 L250,100 L250,175 L100,175 Z' fill='%23f3f4f6' stroke='%239ca3af' stroke-width='2'/%3E%3Ccircle cx='140' cy='130' r='10' fill='%233B82F6'/%3E%3Crect x='170' y='120' width='30' height='20' fill='%239ca3af'/%3E%3Crect x='50' y='75' width='40' height='25' fill='%239ca3af'/%3E%3C/svg%3E" alt="Deluxe Room" class="h-48 w-full object-cover" />
                    </figure>
                    <div class="card-body p-4">
                        <h2 class="card-title">Deluxe Room</h2>
                        <p>Spacious room with premium amenities and beautiful views.</p>
                        <div class="flex justify-between items-center mt-2">
                            <div class="text-2xl font-bold">$199<sub class="text-sm font-normal">/night</sub></div>
                            <button class="btn btn-primary">Book Now</button>
                        </div>
                    </div>
                </div>

                <!-- Room 3 -->
                <div class="card bg-base-100 shadow-md">
                    <figure>
                        <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='200' viewBox='0 0 300 200'%3E%3Crect width='300' height='200' fill='%23e5e7eb'/%3E%3Cpath d='M50,50 L250,50 L250,175 L50,175 Z' fill='%23f3f4f6' stroke='%239ca3af' stroke-width='2'/%3E%3Ccircle cx='90' cy='130' r='10' fill='%233B82F6'/%3E%3Crect x='120' y='120' width='30' height='20' fill='%239ca3af'/%3E%3Crect x='180' y='75' width='40' height='25' fill='%239ca3af'/%3E%3Crect x='50' y='75' width='40' height='25' fill='%239ca3af'/%3E%3C/svg%3E" alt="Ocean View Suite" class="h-48 w-full object-cover" />
                    </figure>
                    <div class="card-body p-4">
                        <h2 class="card-title">Ocean View Suite</h2>
                        <p>Luxurious suite with stunning ocean views and premium amenities.</p>
                        <div class="flex justify-between items-center mt-2">
                            <div class="text-2xl font-bold">$299<sub class="text-sm font-normal">/night</sub></div>
                            <button class="btn btn-primary">Book Now</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



  <script>
        // Welcome card dismiss function
        function dismissWelcome() {
            document.getElementById('welcomeCard').style.display = 'none';
        }

        // Carousel functionality
        let currentCarouselItem = 0;
        const carouselItems = document.querySelectorAll('.carousel-item');
        
        function scrollCarousel(direction) {
            currentCarouselItem += direction;
            
            if (currentCarouselItem < 0) {
                currentCarouselItem = carouselItems.length - 1;
            } else if (currentCarouselItem >= carouselItems.length) {
                currentCarouselItem = 0;
            }
            
            const container = document.querySelector('.carousel-container');
            container.scrollTo({
                left: currentCarouselItem * container.offsetWidth,
                behavior: 'smooth'
            });
        }

        // Auto-advance carousel every 5 seconds
        setInterval(() => {
            scrollCarousel(1);
        }, 5000);
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
  </body>


  @else
  <div class="">
    Not in Session
  </div>


    
@endauth
  
</html>