<!DOCTYPE html>
<html lang="en" data-theme = "light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Soliera Hotel</title>
</head>

   <style>
          *{
            scroll-behavior: smooth
          }
       
        .text-outline {
            text-shadow: 1px 1px 3px rgba(0,0,0,0.3);
        }
        
        /* Initial transparent nav */
        .navbar {
            transition: all 0.3s ease;
        }
        
        /* Scrolled state */
        .navbar.scrolled {
            background-color: #001f54 !important;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .navbar.scrolled .btn-ghost {
            color: white !important;
        }
        
        .navbar.scrolled .menu-horizontal a {
            color: white !important;
        }
    </style>

<body>
    <!-- Navigation -->
     <nav class="navbar fixed bg-transparent top-0 z-50" id="mainNav">
        <div class="navbar-start">
            <div class="dropdown">
                <label tabindex="0" class="btn btn-ghost lg:hidden text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" /></svg>
                </label>
                <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                    <li><a>Rooms</a></li>
                    <li><a>Suites</a></li>
                    <li><a>Amenities</a></li>
                    <li><a>Dining</a></li>
                    <li><a>Contact</a></li>
                </ul>
            </div>
              <img class="h-25 w-auto" src="{{asset('images/logo/logofinal.png')}}" alt="Hotel" />
        </div>
        <div class="navbar-center hidden lg:flex">
            <ul class="menu menu-horizontal px-1">
                <li><a class="text-white hover:bg-[#F7B32B] hover:text-white font-bold">Rooms</a></li>
                <li><a class="text-white hover:bg-[#F7B32B] hover:text-white font-bold">Suites</a></li>
                <li><a class="text-white hover:bg-[#F7B32B] hover:text-white font-bold">Amenities</a></li>
                <li><a class="text-white hover:bg-[#F7B32B] hover:text-white font-bold">Dining</a></li>
                <li><a class="text-white hover:bg-[#F7B32B] hover:text-white font-bold">Contact</a></li>
            </ul>
        </div>
        <div class="navbar-end">
            <a class="btn btn-primary">Sign In</a>
        </div>
    </nav>
    <!-- Hero Section -->
   <section class="hero min-h-screen flex items-center justify-center text-white relative overflow-hidden">
    <!-- Parallax Background Layers -->
    <div class="absolute inset-0 bg-black/40 z-10"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-black/70 z-10"></div>
 <div class="parallax-bg absolute inset-0 bg-cover bg-center" 
     style="background-image: url('{{ asset('images/defaults/hotel3.jpg') }}');">
</div>
    
    <!-- Hero Content -->
    <div class="text-center px-4 z-20 relative max-w-6xl mx-auto">
        <!-- Typewriter Effect for First Line -->
        <h1 class="text-4xl md:text-6xl font-bold mb-4 typewriter" data-text="THE BEST LUXURY HOTEL"></h1>
        
       
        
        <!-- Emphasized Hotel Name -->

        <div class="relative inline-block">
    <!-- 5 Star Icons -->
    <div class="flex justify-center mb-5 gap-5 animate-fade-in opacity-0" style="animation-delay: 2s;">
        <!-- Using Heroicons (SVG) -->
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-amber-400" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 .587l3.668 7.571 8.332 1.151-6.064 5.879 1.48 8.295L12 18.896l-7.416 4.587 1.48-8.295L.0 9.309l8.332-1.151z"/>
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-amber-400" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 .587l3.668 7.571 8.332 1.151-6.064 5.879 1.48 8.295L12 18.896l-7.416 4.587 1.48-8.295L.0 9.309l8.332-1.151z"/>
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-amber-400" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 .587l3.668 7.571 8.332 1.151-6.064 5.879 1.48 8.295L12 18.896l-7.416 4.587 1.48-8.295L.0 9.309l8.332-1.151z"/>
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-amber-400" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 .587l3.668 7.571 8.332 1.151-6.064 5.879 1.48 8.295L12 18.896l-7.416 4.587 1.48-8.295L.0 9.309l8.332-1.151z"/>
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-amber-400" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 .587l3.668 7.571 8.332 1.151-6.064 5.879 1.48 8.295L12 18.896l-7.416 4.587 1.48-8.295L.0 9.309l8.332-1.151z"/>
        </svg>
    </div>
        <div class="relative inline-block">
            <h2 class="text-3xl md:text-5xl font-bold animate-fade-in opacity-0" style="animation-delay: 2.4s;">
                <span class="text-[#F7B32B]">SOLIERA</span> 
                <span>HOTEL & RESTAURANT</span>
            </h2>
           <h3 class="text-xl md:text-2xl font-semibold text-white tracking-wide italic drop-shadow-sm">
  Savor The Stay, Dine With Elegance
</h3>
            <div class="absolute -bottom-2 left-0 right-0 h-1 bg-gradient-to-r from-transparent via-amber-400 to-transparent animate-underline" style="animation-delay: 2.8s;"></div>
        </div>
        
        <!-- CTA Buttons -->
        <div class="mt-12 animate-fade-in opacity-0" style="animation-delay: 3.2s;">
            <a href="#rooms" class="btn btn-primary btn-lg mr-4 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                Explore Rooms
            </a>
            <a href="#booking" class="btn btn-outline btn-lg text-white border-white hover:bg-white hover:text-black transform hover:scale-105 transition-all duration-300">
                Book Now
            </a>
        </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-20 animate-bounce opacity-0" style="animation-delay: 4s;">
        <div class="w-8 h-12 border-2 border-white rounded-full flex justify-center">
            <div class="w-1 h-3 bg-white mt-2 rounded-full animate-scroll-indicator"></div>
        </div>
    </div>

    <style>
        /* Typewriter Effect */
        .typewriter {
            overflow: hidden;
            white-space: nowrap;
            border-right: 3px solid white;
            animation: typing 1.5s steps(20, end) forwards, blink-caret 0.75s step-end 3;
        }
        
        @keyframes typing {
            from { width: 0 }
            to { width: 100% }
        }
        
        @keyframes blink-caret {
            from, to { border-color: transparent }
            50% { border-color: white }
        }
        
        /* Fade-in Animation */
        .animate-fade-in {
            animation: fadeIn 1s ease-in forwards;
        }
        
        @keyframes fadeIn {
            to { opacity: 1; }
        }
        
        /* Underline Animation */
        .animate-underline {
            animation: underlineGrow 1s ease-out forwards;
            transform: scaleX(0);
            transform-origin: center;
        }
        
        @keyframes underlineGrow {
            to { transform: scaleX(1); }
        }
        
        /* Scroll Indicator */
        .animate-scroll-indicator {
            animation: scrollIndicator 2s infinite;
        }
        
        @keyframes scrollIndicator {
            0% { transform: translateY(0); opacity: 0; }
            50% { opacity: 1; }
            100% { transform: translateY(12px); opacity: 0; }
        }
        
        /* Parallax Effect */
        .parallax-bg {
            will-change: transform;
            transition: transform 0.4s ease-out;
        }
    </style>

    <script>
        // Parallax Effect
        document.addEventListener('scroll', function() {
            const parallaxBg = document.querySelector('.parallax-bg');
            const scrollPosition = window.pageYOffset;
            parallaxBg.style.transform = `translateY(${scrollPosition * 0.3}px)`;
        });
        
        // Initialize animations when page loads
        document.addEventListener('DOMContentLoaded', function() {
            // This ensures all elements with animate-fade-in class will animate
            const animatedElements = document.querySelectorAll('.animate-fade-in, .animate-underline');
            animatedElements.forEach(el => {
                // Already handled by CSS animations with delays
            });
        });
    </script>
</section>

    <!-- Rooms Section -->
<section id="rooms" class="py-20 px-4 bg-gray-50">
  <div class="max-w-6xl mx-auto">
    <h2 class="text-4xl font-bold text-center mb-16" data-aos="fade-up">
      Our <span class="text-[#F7B32B]"> Rooms & Suites </span>
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

      <!-- Room 1 -->
      <div class="relative w-full h-[420px] overflow-hidden rounded-2xl shadow-lg bg-white"
           data-aos="fade-up" data-aos-delay="100">
        <img src="{{ asset('images/defaults/rooms/1 standard/room1.png') }}" 
             alt="Standard Room"
             class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>
        <div class="absolute bottom-0 left-0 w-full p-6 text-white">
          <h3 class="text-2xl font-bold mb-2">Standard Room</h3>
          <p class="text-sm mb-4">Cozy and elegant with essential amenities for a comfortable stay.</p>
          <div class="flex justify-between items-center">
            <span class="text-lg font-semibold text-amber-400">₱1,500/night</span>
           
          </div>
        </div>
      </div>

      <!-- Room 2 -->
      <div class="relative w-full h-[420px] overflow-hidden rounded-2xl shadow-lg bg-white"
           data-aos="fade-up" data-aos-delay="200">
        <img src="{{ asset('images/defaults/rooms/2 standard/2stand.jpg') }}" 
             alt="Standard Room"
             class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>
        <div class="absolute bottom-0 left-0 w-full p-6 text-white">
          <h3 class="text-2xl font-bold mb-2">Standard Room</h3>
          <p class="text-sm mb-4">Spacious room with premium amenities and beautiful views.</p>
          <div class="flex justify-between items-center">
            <span class="text-lg font-semibold text-amber-400">₱1,800/night</span>
           
          </div>
        </div>
      </div>

      <!-- Room 3 -->
      <div class="relative w-full h-[420px] overflow-hidden rounded-2xl shadow-lg bg-white"
           data-aos="fade-up" data-aos-delay="300">
        <img src="{{ asset('images/defaults/rooms/3 deluxe/3lux.png') }}" 
             alt="Deluxe Room"
             class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>
        <div class="absolute bottom-0 left-0 w-full p-6 text-white">
          <h3 class="text-2xl font-bold mb-2">Deluxe Room</h3>
          <p class="text-sm mb-4">Luxury comfort with modern decor and high-end amenities.</p>
          <div class="flex justify-between items-center">
            <span class="text-lg font-semibold text-amber-400">₱2,500/night</span>
           
          </div>
        </div>
      </div>

      <!-- Room 4 -->
      <div class="relative w-full h-[420px] overflow-hidden rounded-2xl shadow-lg bg-white"
           data-aos="fade-up" data-aos-delay="400">
        <img src="{{ asset('images/defaults/rooms/4 suite/si.jpg') }}" 
             alt="Suite Room"
             class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>
        <div class="absolute bottom-0 left-0 w-full p-6 text-white">
          <h3 class="text-2xl font-bold mb-2">Suite Room</h3>
          <p class="text-sm mb-4">Spacious luxury suite with separate lounge and premium service.</p>
          <div class="flex justify-between items-center">
            <span class="text-lg font-semibold text-amber-400">₱3,500/night</span>
           
          </div>
        </div>
      </div>

      <!-- Room 5 -->
      <div class="relative w-full h-[420px] overflow-hidden rounded-2xl shadow-lg bg-white"
           data-aos="fade-up" data-aos-delay="500">
        <img src="{{ asset('images/defaults/rooms/5 luxury/luci.jpg') }}" 
             alt="Luxury Room"
             class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>
        <div class="absolute bottom-0 left-0 w-full p-6 text-white">
          <h3 class="text-2xl font-bold mb-2">Luxury Room</h3>
          <p class="text-sm mb-4">Top-tier elegance with breathtaking views and VIP amenities.</p>
          <div class="flex justify-between items-center">
            <span class="text-lg font-semibold text-amber-400">₱5,000/night</span>
           
          </div>
        </div>
      </div>


        <!-- Room 6 -->
      <div class="relative w-full h-[420px] overflow-hidden rounded-2xl shadow-lg bg-white"
           data-aos="fade-up" data-aos-delay="600">
        <img src="{{ asset('images/defaults/rooms/6 standard/3standard.png') }}" 
             alt="Luxury Room"
             class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>
        <div class="absolute bottom-0 left-0 w-full p-6 text-white">
          <h3 class="text-2xl font-bold mb-2">Deluxe Room</h3>
          <p class="text-sm mb-4">Spacious luxury suite with separate lounge and premium service.</p>
          <div class="flex justify-between items-center">
            <span class="text-lg font-semibold text-amber-400">₱3,500/night</span>
           
          </div>
        </div>
      </div>

    </div>
  </div>
</section>


<!-- Restaurant Section -->
<section id="restaurant" class="py-20 bg-white relative overflow-hidden">
    <div class="absolute inset-0 bg-black/5 z-0"></div>
    <div class="max-w-7xl mx-auto px-4 relative z-10">
        <!-- Restaurant Intro -->
        <div class="text-center mb-16" data-aos="fade-up" data-aos-delay="100">
            <h2 class="text-4xl md:text-5xl font-bold mb-4">
                <span class="text-[#F7B32B]">Gourmet</span> Dining Experience
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Indulge in culinary excellence at Soliera's award-winning restaurants
            </p>
        </div>

        <!-- Restaurant Image + Details -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Restaurant Image -->
            <div class="relative w-full h-[600px] rounded-xl overflow-hidden shadow-2xl" data-aos="fade-right" data-aos-delay="200">
                <div class="absolute inset-0 bg-cover bg-center"
                     style="background-image: url('{{asset('images/defaults/rooms/resto/resto2.png')}}')">
                </div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                <div class="absolute bottom-0 left-0 p-8 text-white">
                    <h3 class="text-3xl font-bold">Soliera Restaurant</h3>
                    <p class="text-amber-300">Signature Fine Dining</p>
                </div>
            </div>

            <!-- Restaurant Details -->
            <div data-aos="fade-left" data-aos-delay="300">
                <div class="mb-8">
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Culinary Excellence</h3>
                    <p class="text-gray-600 mb-6">
                        Our Michelin-starred chefs create unforgettable dining experiences using locally-sourced ingredients and innovative techniques.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-amber-600 mt-0.5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-700">Breakfast buffet 6:30 AM - 10:30 AM</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-amber-600 mt-0.5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-700">Lunch service 12:00 PM - 3:00 PM</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-amber-600 mt-0.5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-700">Dinner service 6:00 PM - 11:00 PM</span>
                        </li>
                    </ul>
                </div>
                <a href="#contact" class="btn btn-outline border-[#F7B32B] text-black hover:bg-[#F7B32B] hover:text-white px-8 py-3">
                    Make Reservation
                </a>
            </div>
        </div>

        <!-- Sample Foods & Menus -->
        <div class="mt-20" data-aos="fade-up" data-aos-delay="400">
            <h3 class="text-3xl font-bold text-center mb-10">Menu <span class="text-[#F7B32B]">Highlights</span></h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="card bg-base-100 shadow-md" data-aos="zoom-in" data-aos-delay="100">
        <img src="https://images.unsplash.com/photo-1600891964599-f61ba0e24092?auto=format&fit=crop&w=400&q=80" alt="Signature Steak" class="w-full h-40 object-cover rounded-t-lg">
        <div class="card-body items-center text-center">
          <i class="fas fa-utensils text-4xl" style="color: #F7B32B;"></i>
          <h3 class="card-title">Signature Steak</h3>
          <p>Grilled premium steak cooked to perfection.</p>
          <p class="font-semibold text-amber-600 mt-2">₱1,200</p>
        </div>
      </div>

      <!-- Food Card 2 -->
      <div class="card bg-base-100 shadow-md" data-aos="zoom-in" data-aos-delay="150">
        <img src="https://images.unsplash.com/photo-1553621042-f6e147245754?auto=format&fit=crop&w=400&q=80" alt="Seafood Platter" class="w-full h-40 object-cover rounded-t-lg">
        <div class="card-body items-center text-center">
          <i class="fas fa-utensils text-4xl" style="color: #F7B32B;"></i>
          <h3 class="card-title">Seafood Platter</h3>
          <p>Fresh assortment of seafood with local flavors.</p>
          <p class="font-semibold text-amber-600 mt-2">₱1,500</p>
        </div>
      </div>

      <!-- Food Card 3 -->
      <div class="card bg-base-100 shadow-md" data-aos="zoom-in" data-aos-delay="200">
        <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=400&q=80" alt="Vegetarian Delight" class="w-full h-40 object-cover rounded-t-lg">
        <div class="card-body items-center text-center">
          <i class="fas fa-utensils text-4xl" style="color: #F7B32B;"></i>
          <h3 class="card-title">Vegetarian Delight</h3>
          <p>A mix of fresh vegetables and herbs in a savory sauce.</p>
          <p class="font-semibold text-amber-600 mt-2">₱850</p>
        </div>
      </div>

      <!-- Food Card 4 -->
      <div class="card bg-base-100 shadow-md" data-aos="zoom-in" data-aos-delay="250">
        <img src="https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?auto=format&fit=crop&w=400&q=80" alt="Classic Burger" class="w-full h-40 object-cover rounded-t-lg">
        <div class="card-body items-center text-center">
          <i class="fas fa-utensils text-4xl" style="color: #F7B32B;"></i>
          <h3 class="card-title">Classic Burger</h3>
          <p>Juicy beef burger with fresh lettuce and special sauce.</p>
          <p class="font-semibold text-amber-600 mt-2">₱650</p>
        </div>
      </div>

      <!-- Food Card 5 -->
      <div class="card bg-base-100 shadow-md" data-aos="zoom-in" data-aos-delay="300">
        <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=400&q=80" alt="Pasta Primavera" class="w-full h-40 object-cover rounded-t-lg">
        <div class="card-body items-center text-center">
          <i class="fas fa-utensils text-4xl" style="color: #F7B32B;"></i>
          <h3 class="card-title">Pasta Primavera</h3>
          <p>Fresh pasta with seasonal vegetables and herbs.</p>
          <p class="font-semibold text-amber-600 mt-2">₱900</p>
        </div>
      </div>

      <!-- Food Card 6 -->
      <div class="card bg-base-100 shadow-md" data-aos="zoom-in" data-aos-delay="350">
        <img src="https://images.unsplash.com/photo-1525755662778-989d0524087e?auto=format&fit=crop&w=400&q=80" alt="Dessert Platter" class="w-full h-40 object-cover rounded-t-lg">
        <div class="card-body items-center text-center">
          <i class="fas fa-utensils text-4xl" style="color: #F7B32B;"></i>
          <h3 class="card-title">Dessert Platter</h3>
          <p>Assortment of cakes and pastries to end your meal sweetly.</p>
          <p class="font-semibold text-amber-600 mt-2">₱700</p>
        </div>
      </div>
            </div>
        </div>
    </div>
</section>



    <!-- Amenities Section -->
 <section class="py-20 bg-base-200">
  <div class="max-w-6xl mx-auto px-4">
    <h2 class="text-4xl font-bold text-center mb-16" data-aos="fade-up">
      <span class="text-[#F7B32B]">Hotel</span> Amenities
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
      
      <div class="card bg-base-100 shadow-md" data-aos="zoom-in" data-aos-delay="100">
        <div class="card-body items-center text-center">
          <i class="fas fa-bed text-4xl" style="color: #F7B32B;"></i>
          <h3 class="card-title">Rooms</h3>
          <p>Comfortable and elegantly designed rooms to ensure a restful stay.</p>
        </div>
      </div>

      <div class="card bg-base-100 shadow-md" data-aos="zoom-in" data-aos-delay="200">
        <div class="card-body items-center text-center">
          <i class="fas fa-utensils text-4xl" style="color: #F7B32B;"></i>
          <h3 class="card-title">Fine Dining</h3>
          <p>Award-winning restaurants featuring California cuisine with local ingredients.</p>
        </div>
      </div>

      <div class="card bg-base-100 shadow-md" data-aos="zoom-in" data-aos-delay="300">
        <div class="card-body items-center text-center">
          <i class="fas fa-user-cog text-4xl" style="color: #F7B32B;"></i>
          <h3 class="card-title">Account System</h3>
          <p>Seamless online booking and account management for guest convenience.</p>
        </div>
      </div>

      <div class="card bg-base-100 shadow-md" data-aos="zoom-in" data-aos-delay="400">
        <div class="card-body items-center text-center">
          <i class="fas fa-map-marker-alt text-4xl" style="color: #F7B32B;"></i>
          <h3 class="card-title">Local Experience</h3>
          <p>Authentic Filipino cultural experiences and tours to enrich your stay.</p>
        </div>
      </div>

    </div>
  </div>
</section>


    <!-- Testimonials -->
   <section class="py-20 bg-base-200" data-aos="fade-up">
    <div class="max-w-6xl mx-auto px-4">
        <h2 class="text-4xl font-bold text-center mb-16" data-aos="fade-down" data-aos-delay="100">
            Guest <span class="text-[#F7B32B]">Reviews</span>
        </h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Testimonial 1 -->
            <div class="card bg-base-100 shadow-md" data-aos="fade-right" data-aos-delay="200">
                <div class="card-body">
                    <div class="rating mb-4">
                        <input type="radio" name="rating-1" class="mask mask-star" checked />
                        <input type="radio" name="rating-1" class="mask mask-star" checked />
                        <input type="radio" name="rating-1" class="mask mask-star" checked />
                        <input type="radio" name="rating-1" class="mask mask-star" checked />
                        <input type="radio" name="rating-1" class="mask mask-star" checked />
                    </div>
                    <p>"Absolutely stunning hotel with impeccable service. The views from our suite were breathtaking and the staff went above and beyond to make our stay memorable."</p>
                    <div class="flex items-center mt-4">
                        <div class="avatar">
                            <div class="w-12 rounded-full">
                                <img src="https://randomuser.me/api/portraits/women/43.jpg" />
                            </div>
                        </div>
                        <div class="ml-4">
                            <h4 class="font-bold">Sarah Johnson</h4>
                            <p class="text-sm">New York</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Testimonial 2 -->
            <div class="card bg-base-100 shadow-md" data-aos="fade-up" data-aos-delay="300">
                <div class="card-body">
                    <div class="rating mb-4">
                        <input type="radio" name="rating-2" class="mask mask-star" checked />
                        <input type="radio" name="rating-2" class="mask mask-star" checked />
                        <input type="radio" name="rating-2" class="mask mask-star" checked />
                        <input type="radio" name="rating-2" class="mask mask-star" checked />
                        <input type="radio" name="rating-2" class="mask mask-star" checked />
                    </div>
                    <p>"The infinity pool was the highlight of our stay. The entire property exudes luxury and attention to detail. We can't wait to return next year!"</p>
                    <div class="flex items-center mt-4">
                        <div class="avatar">
                            <div class="w-12 rounded-full">
                                <img src="https://randomuser.me/api/portraits/men/32.jpg" />
                            </div>
                        </div>
                        <div class="ml-4">
                            <h4 class="font-bold">Michael Chen</h4>
                            <p class="text-sm">Toronto</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Testimonial 3 -->
            <div class="card bg-base-100 shadow-md" data-aos="fade-up" data-aos-delay="400">
                <div class="card-body">
                    <div class="rating mb-4">
                        <input type="radio" name="rating-3" class="mask mask-star" checked />
                        <input type="radio" name="rating-3" class="mask mask-star" checked />
                        <input type="radio" name="rating-3" class="mask mask-star" checked />
                        <input type="radio" name="rating-3" class="mask mask-star" checked />
                        <input type="radio" name="rating-3" class="mask mask-star" />
                    </div>
                    <p>"Exceptional dining experiences and the most comfortable bed I've ever slept in. The staff anticipated our every need. Truly a world-class hotel."</p>
                    <div class="flex items-center mt-4">
                        <div class="avatar">
                            <div class="w-12 rounded-full">
                                <img src="https://randomuser.me/api/portraits/women/65.jpg" />
                            </div>
                        </div>
                        <div class="ml-4">
                            <h4 class="font-bold">Emma Rodriguez</h4>
                            <p class="text-sm">London</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


 

 <section id="contact" class="py-20 bg-gray-50 relative" data-aos="fade-up">
  <div class="max-w-7xl mx-auto px-4">
    <div class="text-center mb-16" data-aos="fade-down" data-aos-delay="100">
      <h2 class="text-4xl md:text-5xl font-bold mb-4">
        <span class="text-[#F7B32B]">Contact</span> Soliera Hotel
      </h2>
      <p class="text-xl text-gray-600 max-w-3xl mx-auto">
        Our concierge team is available 24/7 to assist with your inquiries
      </p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
      <!-- Contact Form -->
      <div class="bg-white p-8 rounded-xl shadow-lg" data-aos="fade-right" data-aos-delay="200">
        <h3 class="text-2xl font-bold text-gray-800 mb-6">Send Us a Message</h3>
        <form class="space-y-6">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label class="block text-gray-700 mb-2">First Name</label>
              <input type="text" class="input input-bordered w-full" placeholder="Your first name">
            </div>
            <div>
              <label class="block text-gray-700 mb-2">Last Name</label>
              <input type="text" class="input input-bordered w-full" placeholder="Your last name">
            </div>
          </div>
          <div>
            <label class="block text-gray-700 mb-2">Email</label>
            <input type="email" class="input input-bordered w-full" placeholder="your@email.com">
          </div>
          <div>
            <label class="block text-gray-700 mb-2">Subject</label>
            <select class="select select-bordered w-full">
              <option disabled selected>Select inquiry type</option>
              <option>Reservation</option>
              <option>Restaurant</option>
              <option>Spa & Wellness</option>
              <option>Event Inquiry</option>
              <option>Other</option>
            </select>
          </div>
          <div>
            <label class="block text-gray-700 mb-2">Message</label>
            <textarea class="textarea textarea-bordered w-full h-32" placeholder="Your message"></textarea>
          </div>
          <button type="submit" class="btn btn-primary w-full py-3 text-lg">
            Send Message
          </button>
        </form>
      </div>

      <!-- Contact Info -->
  <div data-aos="fade-up" data-aos-delay="300">
  <div class="bg-white p-8 rounded-xl shadow-lg mb-8">
    <h3 class="text-2xl font-bold text-gray-800 mb-6">Contact Information</h3>
    <div class="space-y-5">
      <div class="flex items-start" data-aos="fade-up" data-aos-delay="400">
        <div class="bg-blue-800/30 p-3 rounded-full mr-4">
          <!-- Location Icon -->
          <svg class="h-6 w-6 text-[#F7B32B]" fill="none" viewBox="0 0 24 24" stroke="currentColor" >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
          </svg>
        </div>
        <div>
          <h4 class="font-bold text-gray-800">Address</h4>
          <p class="text-gray-600">123 Oceanview Boulevard, Manila, Philippines 1000</p>
        </div>
      </div>
      <div class="flex items-start" data-aos="fade-up" data-aos-delay="500">
        <div class="bg-blue-800/30 p-3 rounded-full mr-4">
          <!-- Phone Icon -->
          <svg class="h-6 w-6 text-[#F7B32B]" fill="none" viewBox="0 0 24 24" stroke="currentColor" >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
          </svg>
        </div>
        <div>
          <h4 class="font-bold text-gray-800">Phone</h4>
          <p class="text-gray-600">+63 2 8123 4567 (Main)</p>
          <p class="text-gray-600">+63 917 123 4567 (Mobile)</p>
        </div>
      </div>
      <div class="flex items-start" data-aos="fade-up" data-aos-delay="600">
        <div class="bg-blue-800/30 p-3 rounded-full mr-4">
          <!-- Email Icon -->
          <svg class="h-6 w-6 text-[#F7B32B]" fill="none" viewBox="0 0 24 24" stroke="currentColor" >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
          </svg>
        </div>
        <div>
          <h4 class="font-bold text-gray-800">Email</h4>
          <p class="text-gray-600">reservations@solierahotel.com</p>
          <p class="text-gray-600">info@solierahotel.com</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Map -->
  <div class="bg-white p-4 rounded-xl shadow-lg overflow-hidden" data-aos="zoom-in" data-aos-delay="700">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3861.758036547544!2d120.9805133153266!3d14.554534589833028!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397c90264a0ed01%3A0x2b066ed57830cace!2sManila%20Ocean%20Park!5e0!3m2!1sen!2sph!4v1623830287590!5m2!1sen!2sph" 
            width="100%" 
            height="300" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy"
            class="rounded-lg"></iframe>
  </div>
</div>

    </div>
  </div>
</section>

<!-- Add this to your existing script -->
<script>
    // Restaurant parallax effect
    document.addEventListener('scroll', function() {
        const restaurantBg = document.querySelector('.parallax-restaurant');
        const scrollPosition = window.pageYOffset;
        if (restaurantBg) {
            restaurantBg.style.transform = `translateY(${scrollPosition * 0.2}px)`;
        }
    });

    // Initialize animations for new sections
    document.addEventListener('DOMContentLoaded', function() {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = 1;
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.animate-fade-in').forEach(el => {
            observer.observe(el);
        });
    });
</script>

    <!-- Footer -->
   <footer class="footer p-10 bg-[#001f54] text-neutral-content">
  <div class="flex flex-col md:flex-row md:justify-between max-w-6xl mx-auto w-full gap-8">
    <!-- Logo and About -->
    <div class="flex items-center space-x-4 md:space-x-6 flex-1">
      <img src="{{asset('images/logo/logofinal.png')}}" alt="Hotelias Logo" class="w-full h-25" />
      <div>
        <span class="footer-title text-xl font-bold">SOLIERA HOTEL & RESTAURANT</span>
        <p class="mt-2 max-w-xs text-neutral-300 leading-relaxed">
          The Best Luxury Hotel in Philippines<br />
          Bayan Novaliches<br />
        </p>
      </div>
    </div>

    <!-- Contact Info -->
    <div class="flex flex-col flex-1">
      <span class="footer-title text-xl font-bold mb-4">Contact</span>
      <p class="text-neutral-300 leading-relaxed">
        Reservations: <a href="tel:8005551234" class="hover:text-amber-400 transition"> (800) 555-1234</a><br />
        Front Desk: <a href="tel:3105555678" class="hover:text-amber-400 transition">(310) 555-5678</a><br />
        Email: <a href="mailto:reservations@hotelias.com" class="hover:text-amber-400 transition">reservations@soliera.com</a>
      </p>
    </div>

    <!-- Social Links -->
    <div class="flex flex-col flex-1">
      <span class="footer-title text-xl  font-bold mb-4">Social</span>
      <div class="flex space-x-6">
        <a href="https://facebook.com/hotelias" target="_blank" rel="noopener" aria-label="Facebook" class="text-amber-400 hover:scale-105 transition-all text-3xl">
          <i class="fab fa-facebook-f"></i>
        </a>
        <a href="https://twitter.com/hotelias" target="_blank" rel="noopener" aria-label="Twitter" class="text-amber-400 hover:scale-105 transition-all text-3xl">
          <i class="fab fa-twitter"></i>
        </a>
        <a href="https://instagram.com/hotelias" target="_blank" rel="noopener" aria-label="Instagram" class="text-amber-400 hover:scale-105 transition-all text-3xl">
          <i class="fab fa-instagram"></i>
        </a>
      </div>
    </div>
  </div>
</footer>

</body>

    <script>
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('mainNav');
            const heroHeight = document.querySelector('.hero').offsetHeight;
            
            if (window.scrollY > heroHeight * 0.8) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
<script>
    AOS.init({
        duration: 1000,
        once: true
    });
</script>
</html>