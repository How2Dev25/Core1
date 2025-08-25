<!DOCTYPE html>
<html lang="en" data-theme ="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

 
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <title>{{$title}} - Front Desk And Reception</title>
      @livewireStyles
</head>
@auth
    

<body class="bg-base-100">
    <div class="flex h-screen overflow-hidden">
      <!-- Sidebar -->
     @include('admin.components.dashboard.sidebar')
  




     
      <!-- Main content -->
      <div class="flex flex-col flex-1 overflow-hidden">
        <!-- Navbar -->
         @include('admin.components.dashboard.navbar')
  







        <!-- Dashboard Content -->
        <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 transition-slow ">
            {{-- Subsystem Name --}}
          <div class="pb-5 border-b border-base-300 animate-fadeIn">
            <h1 class="text-2xl font-bold bg-white bg-clip-text text-[#191970]">Hotel Admin Dashboard</h1>
          </div>
            {{-- Subsystem Name --}}

<section class="p-6  min-h-screen">
    <!-- Header -->


    <!-- Main Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
       
      <!-- Total Reservations -->
    <div class="card bg-white shadow-lg rounded-xl border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
        <div class="p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Total Reservations</h3>
                    <p class="text-3xl font-bold text-gray-800 mt-2">1,247</p>
                    <div class="flex items-center mt-3">
                        <span class="text-green-500 text-sm font-medium flex items-center">
                            <i class="fa-solid fa-arrow-up mr-1"></i>
                            12%
                        </span>
                        <span class="text-sm text-gray-500 ml-2">vs last month</span>
                    </div>
                </div>
                <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900 transition-transform duration-300 group-hover:scale-110">
                    <i class="fa-solid fa-calendar-check text-yellow-400 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

         <!-- Reservations This Week -->
    <div class="card bg-white shadow-lg rounded-xl border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
        <div class="p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Reservations This Week</h3>
                    <p class="text-3xl font-bold text-gray-800 mt-2">142</p>
                    <div class="flex items-center mt-3">
                        <span class="text-green-500 text-sm font-medium flex items-center">
                            <i class="fa-solid fa-arrow-up mr-1"></i>
                            8%
                        </span>
                        <span class="text-sm text-gray-500 ml-2">vs last week</span>
                    </div>
                </div>
                <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900 transition-transform duration-300 group-hover:scale-110">
                    <i class="fa-solid fa-chart-line text-yellow-400 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>


         <!-- Total Rooms -->
    <div class="card bg-white shadow-lg rounded-xl border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
        <div class="p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Total Rooms</h3>
                    <p class="text-3xl font-bold text-gray-800 mt-2">350</p>
                    <div class="flex items-center mt-3">
                        <span class="text-blue-500 text-sm font-medium">85%</span>
                        <span class="text-sm text-gray-500 ml-2">occupancy rate</span>
                    </div>
                </div>
                <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900 transition-transform duration-300 group-hover:scale-110">
                    <i class="fa-solid fa-bed text-yellow-400 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>


        <!-- Rooms Needing Maintenance -->
    <div class="card bg-white shadow-lg rounded-xl border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
        <div class="p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Need Maintenance</h3>
                    <p class="text-3xl font-bold text-gray-800 mt-2">12</p>
                    <div class="flex items-center mt-3">
                        <span class="text-amber-500 text-sm font-medium">3.4%</span>
                        <span class="text-sm text-gray-500 ml-2">of total rooms</span>
                    </div>
                </div>
                <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900 transition-transform duration-300 group-hover:scale-110">
                    <i class="fa-solid fa-screwdriver-wrench text-yellow-400 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>
</div>

   <!-- Secondary Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
    <!-- Total Employees -->
    <div class="card bg-white shadow-md rounded-xl border border-gray-100 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
        <div class="p-5">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Total Employees</h3>
                    <p class="text-2xl font-bold text-gray-800 mt-2">156</p>
                </div>
                <div class="w-14 h-14 rounded-lg flex items-center justify-center bg-blue-900 transition-transform duration-300 group-hover:scale-110">
                    <i class="fa-solid fa-users text-yellow-400 text-xl"></i>
                </div>
            </div>
        </div>
    </div>


          <!-- Total Guest Accounts -->
    <div class="card bg-white shadow-md rounded-xl border border-gray-100 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
        <div class="p-5">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Guest Accounts</h3>
                    <p class="text-2xl font-bold text-gray-800 mt-2">8,943</p>
                </div>
                <div class="w-14 h-14 rounded-lg flex items-center justify-center bg-blue-900 transition-transform duration-300 group-hover:scale-110">
                    <i class="fa-solid fa-user text-yellow-400 text-xl"></i>
                </div>
            </div>
        </div>
    </div>


  <!-- Total Room Markets -->
    <div class="card bg-white shadow-md rounded-xl border border-gray-100 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
        <div class="p-5">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Room Markets</h3>
                    <p class="text-2xl font-bold text-gray-800 mt-2">24</p>
                </div>
                <div class="w-14 h-14 rounded-lg flex items-center justify-center bg-blue-900 transition-transform duration-300 group-hover:scale-110">
                    <i class="fa-solid fa-globe text-yellow-400 text-xl"></i>
                </div>
            </div>
        </div>
    </div>


         <!-- Channel Listings -->
    <div class="card bg-white shadow-md rounded-xl border border-gray-100 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
        <div class="p-5">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Channel Listings</h3>
                    <p class="text-2xl font-bold text-gray-800 mt-2">320</p>
                </div>
                <div class="w-14 h-14 rounded-lg flex items-center justify-center bg-blue-900 transition-transform duration-300 group-hover:scale-110">
                    <i class="fa-solid fa-tv text-yellow-400 text-xl"></i>
                </div>
            </div>
        </div>
    </div>
</div>

   <!-- Marketing & Loyalty Stats -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
    <!-- Total Marketing -->
    <div class="card bg-white shadow-md rounded-xl border border-gray-100 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
        <div class="p-5">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Active Campaigns</h3>
                    <p class="text-2xl font-bold text-gray-800 mt-2">18</p>
                </div>
                <div class="w-14 h-14 rounded-lg flex items-center justify-center bg-blue-900 transition-transform duration-300 group-hover:scale-110">
                    <i class="fa-solid fa-bullhorn text-yellow-400 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

         <!-- Loyalty Programs -->
    <div class="card bg-white shadow-md rounded-xl border border-gray-100 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
        <div class="p-5">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Loyalty & Rewards</h3>
                    <p class="text-2xl font-bold text-gray-800 mt-2">89</p>
                    <p class="text-xs text-gray-500 mt-1">Room & Food packages</p>
                </div>
                <div class="w-14 h-14 rounded-lg flex items-center justify-center bg-blue-900 transition-transform duration-300 group-hover:scale-110">
                    <i class="fa-solid fa-star text-yellow-400 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

        <!-- Total Events -->
    <div class="card bg-white shadow-md rounded-xl border border-gray-100 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
        <div class="p-5">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Total Events</h3>
                    <p class="text-2xl font-bold text-gray-800 mt-2">32</p>
                </div>
                <div class="w-14 h-14 rounded-lg flex items-center justify-center bg-blue-900 transition-transform duration-300 group-hover:scale-110">
                    <i class="fa-solid fa-calendar-days text-yellow-400 text-xl"></i>
                </div>
            </div>
        </div>
    </div>
    </div>

 <!-- Parent Container with Grid Layout -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-10">
    
    <!-- Events Carousel -->
    <div class="card bg-white shadow-lg rounded-xl border border-gray-100 overflow-hidden">
        <div class="p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                <div class="w-10 h-10 rounded-lg flex items-center justify-center mr-3 bg-blue-900">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" class="text-yellow-400">
                        <path d="M19 3H18V1H16V3H8V1H6V3H5C3.89 3 3 3.9 3 5V19C3 20.1 3.89 21 5 21H19C20.1 21 21 20.1 21 19V5C21 3.9 20.1 3 19 3ZM19 19H5V8H19V19Z"/>
                    </svg>
                </div>
                Upcoming Events
            </h2>
            <div class="carousel w-full rounded-xl overflow-hidden">
                <div id="slide1" class="carousel-item relative w-full h-80">
                    <div class="w-full relative">
                        <img src="https://images.unsplash.com/photo-1519167758481-83f550bb49b3?w=800&h=320&fit=crop&crop=center" alt="Elegant Gala Event" class="w-full h-80 object-cover">
                        <div class="absolute inset-0 bg-gradient-to-r from-black/60 to-black/30"></div>
                        <div class="absolute inset-0 p-8 flex items-center">
                            <div class="text-white max-w-2xl">
                                <h3 class="text-3xl font-bold mb-3">Summer Gala Night</h3>
                                <p class="text-xl mb-2 opacity-90">August 30, 2025 • Grand Ballroom</p>
                                <p class="text-lg opacity-80 mb-4">An elegant evening of dining and entertainment with live music and dancing</p>
                                <div class="flex flex-wrap gap-2">
                                    <span class="badge px-3 py-1 rounded-full text-white border-white border bg-transparent text-sm">250 Guests</span>
                                    <span class="badge px-3 py-1 rounded-full text-yellow-400 border border-yellow-400 bg-transparent text-sm">VIP Event</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
                        <a href="#slide3" class="btn btn-circle bg-white/20 border-none text-white hover:bg-white/40 backdrop-blur-sm transition-all duration-300">❮</a>
                        <a href="#slide2" class="btn btn-circle bg-white/20 border-none text-white hover:bg-white/40 backdrop-blur-sm transition-all duration-300">❯</a>
                    </div>
                </div>
                <div id="slide2" class="carousel-item relative w-full h-80">
                    <div class="w-full relative">
                        <img src="https://images.unsplash.com/photo-1511578314322-379afb476865?w=800&h=320&fit=crop&crop=center" alt="Corporate Conference" class="w-full h-80 object-cover">
                        <div class="absolute inset-0 bg-gradient-to-r from-black/60 to-black/30"></div>
                        <div class="absolute inset-0 p-8 flex items-center">
                            <div class="text-white max-w-2xl">
                                <h3 class="text-3xl font-bold mb-3">Corporate Conference</h3>
                                <p class="text-xl mb-2 opacity-90">September 5-7, 2025 • Conference Center</p>
                                <p class="text-lg opacity-80 mb-4">International business summit with networking sessions and keynote speakers</p>
                                <div class="flex flex-wrap gap-2">
                                    <span class="badge px-3 py-1 rounded-full text-white border-white border bg-transparent text-sm">500 Attendees</span>
                                    <span class="badge px-3 py-1 rounded-full text-yellow-400 border border-yellow-400 bg-transparent text-sm">3 Days</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
                        <a href="#slide1" class="btn btn-circle bg-white/20 border-none text-white hover:bg-white/40 backdrop-blur-sm transition-all duration-300">❮</a>
                        <a href="#slide3" class="btn btn-circle bg-white/20 border-none text-white hover:bg-white/40 backdrop-blur-sm transition-all duration-300">❯</a>
                    </div>
                </div>
                <div id="slide3" class="carousel-item relative w-full h-80">
                    <div class="w-full relative">
                        <img src="https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&h=320&fit=crop&crop=center" alt="Wedding Celebration" class="w-full h-80 object-cover">
                        <div class="absolute inset-0 bg-gradient-to-r from-black/60 to-black/30"></div>
                        <div class="absolute inset-0 p-8 flex items-center">
                            <div class="text-white max-w-2xl">
                                <h3 class="text-3xl font-bold mb-3">Wedding Celebration</h3>
                                <p class="text-xl mb-2 opacity-90">September 12, 2025 • Garden Pavilion</p>
                                <p class="text-lg opacity-80 mb-4">Beautiful outdoor wedding ceremony and reception with garden views</p>
                                <div class="flex flex-wrap gap-2">
                                    <span class="badge px-3 py-1 rounded-full text-white border-white border bg-transparent text-sm">180 Guests</span>
                                    <span class="badge px-3 py-1 rounded-full text-yellow-400 border border-yellow-400 bg-transparent text-sm">Premium</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
                        <a href="#slide2" class="btn btn-circle bg-white/20 border-none text-white hover:bg-white/40 backdrop-blur-sm transition-all duration-300">❮</a>
                        <a href="#slide1" class="btn btn-circle bg-white/20 border-none text-white hover:bg-white/40 backdrop-blur-sm transition-all duration-300">❯</a>
                    </div>
                </div>
            </div>
            <div class="flex justify-center w-full py-4 gap-3 mt-4">
                <a href="#slide1" class="btn btn-sm rounded-full bg-yellow-400 border-yellow-400 text-white transition-all duration-300 hover:bg-yellow-500">●</a>
                <a href="#slide2" class="btn btn-sm btn-outline rounded-full bg-gray-200 border-gray-300 hover:bg-gray-300 transition-all duration-300">●</a>
                <a href="#slide3" class="btn btn-sm btn-outline rounded-full bg-gray-200 border-gray-300 hover:bg-gray-300 transition-all duration-300">●</a>
            </div>
        </div>
    </div>

    <!-- Room Carousel -->
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
            <div class="carousel w-full rounded-xl overflow-hidden">
                <div id="roomSlide1" class="carousel-item relative w-full h-80">
                    <div class="w-full relative">
                        <img src="https://images.unsplash.com/photo-1611892440504-42a792e24d32?w=800&h=320&fit=crop&crop=center" alt="Luxury Suite" class="w-full h-80 object-cover">
                        <div class="absolute inset-0 bg-gradient-to-r from-black/60 to-black/30"></div>
                        <div class="absolute inset-0 p-8 flex items-center">
                            <div class="text-white max-w-2xl">
                                <h3 class="text-3xl font-bold mb-3">Presidential Suite</h3>
                                <p class="text-xl mb-2 opacity-90">120 sqm • Ocean View</p>
                                <p class="text-lg opacity-80 mb-4">Luxurious suite with private balcony, jacuzzi, and premium amenities</p>
                                <div class="flex flex-wrap gap-2">
                                    <span class="badge px-3 py-1 rounded-full text-white border-white border bg-transparent text-sm">$899/night</span>
                                    <span class="badge px-3 py-1 rounded-full text-yellow-400 border border-yellow-400 bg-transparent text-sm">Popular</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
                        <a href="#roomSlide3" class="btn btn-circle bg-white/20 border-none text-white hover:bg-white/40 backdrop-blur-sm transition-all duration-300">❮</a>
                        <a href="#roomSlide2" class="btn btn-circle bg-white/20 border-none text-white hover:bg-white/40 backdrop-blur-sm transition-all duration-300">❯</a>
                    </div>
                </div>
                <div id="roomSlide2" class="carousel-item relative w-full h-80">
                    <div class="w-full relative">
                        <img src="https://images.unsplash.com/photo-1582582621959-48d27397dc69?w=800&h=320&fit=crop&crop=center" alt="Executive Room" class="w-full h-80 object-cover">
                        <div class="absolute inset-0 bg-gradient-to-r from-black/60 to-black/30"></div>
                        <div class="absolute inset-0 p-8 flex items-center">
                            <div class="text-white max-w-2xl">
                                <h3 class="text-3xl font-bold mb-3">Executive King Room</h3>
                                <p class="text-xl mb-2 opacity-90">45 sqm • City View</p>
                                <p class="text-lg opacity-80 mb-4">Spacious room with work desk, premium bedding, and executive lounge access</p>
                                <div class="flex flex-wrap gap-2">
                                    <span class="badge px-3 py-1 rounded-full text-white border-white border bg-transparent text-sm">$349/night</span>
                                    <span class="badge px-3 py-1 rounded-full text-yellow-400 border border-yellow-400 bg-transparent text-sm">Business</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
                        <a href="#roomSlide1" class="btn btn-circle bg-white/20 border-none text-white hover:bg-white/40 backdrop-blur-sm transition-all duration-300">❮</a>
                        <a href="#roomSlide3" class="btn btn-circle bg-white/20 border-none text-white hover:bg-white/40 backdrop-blur-sm transition-all duration-300">❯</a>
                    </div>
                </div>
                <div id="roomSlide3" class="carousel-item relative w-full h-80">
                    <div class="w-full relative">
                        <img src="https://images.unsplash.com/photo-1566665797739-1674de7a421a?w=800&h=320&fit=crop&crop=center" alt="Family Room" class="w-full h-80 object-cover">
                        <div class="absolute inset-0 bg-gradient-to-r from-black/60 to-black/30"></div>
                        <div class="absolute inset-0 p-8 flex items-center">
                            <div class="text-white max-w-2xl">
                                <h3 class="text-3xl font-bold mb-3">Family Deluxe Room</h3>
                                <p class="text-xl mb-2 opacity-90">60 sqm • Garden View</p>
                                <p class="text-lg opacity-80 mb-4">Perfect for families with connecting rooms, kid-friendly amenities, and play area</p>
                                <div class="flex flex-wrap gap-2">
                                    <span class="badge px-3 py-1 rounded-full text-white border-white border bg-transparent text-sm">$459/night</span>
                                    <span class="badge px-3 py-1 rounded-full text-yellow-400 border border-yellow-400 bg-transparent text-sm">Family</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
                        <a href="#roomSlide2" class="btn btn-circle bg-white/20 border-none text-white hover:bg-white/40 backdrop-blur-sm transition-all duration-300">❮</a>
                        <a href="#roomSlide1" class="btn btn-circle bg-white/20 border-none text-white hover:bg-white/40 backdrop-blur-sm transition-all duration-300">❯</a>
                    </div>
                </div>
            </div>
            <div class="flex justify-center w-full py-4 gap-3 mt-4">
                <a href="#roomSlide1" class="btn btn-sm rounded-full bg-yellow-400 border-yellow-400 text-white transition-all duration-300 hover:bg-yellow-500">●</a>
                <a href="#roomSlide2" class="btn btn-sm btn-outline rounded-full bg-gray-200 border-gray-300 hover:bg-gray-300 transition-all duration-300">●</a>
                <a href="#roomSlide3" class="btn btn-sm btn-outline rounded-full bg-gray-200 border-gray-300 hover:bg-gray-300 transition-all duration-300">●</a>
            </div>
        </div>
    </div>
</div>
   
</section>


 

<!-- Initialize Lucide Icons -->
<script>
  lucide.createIcons();
</script>

        


           
      
 
        </main>
      </div>
    </div>

   
    {{-- modals --}}

    @include('admin.components.frontdesk.viewroom')
    
   
   @livewireScripts
  @include('javascriptfix.soliera_js')
  </body>
@endauth


  
</html>