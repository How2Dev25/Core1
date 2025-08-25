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
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
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
                  <!-- Close (X) Button on Top Right -->
                  <button class="absolute top-4 right-4 text-primary-content/70 hover:text-red-400 transition"
                          onclick="dismissWelcome()">
                      <i data-lucide="x" class="w-6 h-6"></i>
                  </button>

                  <!-- Grid Layout -->
                  <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-center">
                      <!-- Avatar (Large & Center Left) -->
                      <div class="flex justify-center md:justify-center md:col-span-1">
                          <div class="avatar">
                              <div class="w-32 h-32 md:w-40 md:h-40 rounded-full ring ring-primary-content ring-offset-base-100 ring-offset-4">
                                  <img src="{{ Auth::guard('guest')->user()->guest_photo }}" alt="Guest Avatar" />
                              </div>
                          </div>
                      </div>

                      <!-- Welcome Text + Button -->
                      <div class="flex flex-col items-center md:items-start col-span-2">
                          <h2 class="text-2xl md:text-3xl font-bold mb-2 text-center md:text-left">
                              Welcome back, {{ Auth::guard('guest')->user()->guest_name }}!
                          </h2>
                          <p class="text-base md:text-lg opacity-90 text-center md:text-left">
                              We hope you're enjoying your stay
                          </p>

                          <!-- Badges -->
                          <div class="flex items-center gap-2 mt-3 justify-center md:justify-start flex-wrap">
                              <div class="badge badge-primary">Guest</div>
                              <div class="badge badge-outline badge-primary-content">Member</div>
                          </div>

                          <!-- View My Profile Button -->
                          <div class="flex justify-center md:justify-start mt-6 w-full">
                              <a href="" 
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
            <div class="stat-card card bg-base-100 shadow-xl border-2 border-transparent hover:border-blue-400 hover:bg-gradient-to-br hover:from-blue-50 hover:to-blue-100 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl group">
                <div class="card-body items-center text-center p-6">
                    <div class="bg-gradient-to-br from-blue-400 to-blue-600 rounded-full p-4 mb-4 group-hover:scale-110 transition-transform duration-300 group-hover:shadow-lg">
                        <i data-lucide="calendar-days" class="w-8 h-8 text-white"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-base-content">Total Reservations</h3>
                    <div class="stat-value text-3xl font-bold text-primary group-hover:scale-105 transition-transform duration-300">12</div>
                    <div class="stat-desc text-success font-medium">+2 this month</div>
                </div>
            </div>

            <!-- Loyalty Points -->
            <div class="stat-card card bg-base-100 shadow-xl border-2 border-transparent hover:border-green-400 hover:bg-gradient-to-br hover:from-green-50 hover:to-green-100 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl group">
                <div class="card-body items-center text-center p-6">
                    <div class="bg-gradient-to-br from-green-400 to-green-600 rounded-full p-4 mb-4 group-hover:scale-110 transition-transform duration-300 group-hover:shadow-lg">
                        <i data-lucide="coins" class="w-8 h-8 text-white"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-base-content">Loyalty Points</h3>
                    <div class="stat-value text-3xl font-bold text-secondary group-hover:scale-105 transition-transform duration-300">4,250</div>
                    <div class="stat-desc text-info font-medium">Ready to redeem</div>
                </div>
            </div>

            <!-- Favorite Room -->
            <div class="stat-card card bg-base-100 shadow-xl border-2 border-transparent hover:border-purple-400 hover:bg-gradient-to-br hover:from-purple-50 hover:to-purple-100 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl group">
                <div class="card-body items-center text-center p-6">
                    <div class="bg-gradient-to-br from-purple-400 to-purple-600 rounded-full p-4 mb-4 group-hover:scale-110 transition-transform duration-300 group-hover:shadow-lg">
                        <i data-lucide="heart" class="w-8 h-8 text-white"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-base-content">Favorite Room</h3>
                    <div class="stat-value text-xl font-bold text-accent group-hover:scale-105 transition-transform duration-300">Ocean View</div>
                    <div class="stat-desc font-medium">Suite</div>
                </div>
            </div>

            <!-- Recent Reservation -->
            <div class="stat-card card bg-base-100 shadow-xl border-2 border-transparent hover:border-yellow-400 hover:bg-gradient-to-br hover:from-yellow-50 hover:to-yellow-100 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl group">
                <div class="card-body items-center text-center p-6">
                    <div class="bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-full p-4 mb-4 group-hover:scale-110 transition-transform duration-300 group-hover:shadow-lg">
                        <i data-lucide="clock" class="w-8 h-8 text-white"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-base-content">Recent Stay</h3>
                    <div class="stat-value text-lg font-bold text-warning group-hover:scale-105 transition-transform duration-300">Jun 15-20</div>
                    <div class="stat-desc font-medium">2023</div>
                </div>
            </div>
        </div>

        
     
  

        <!-- Enhanced Carousel Section -->
<div class="container mx-auto max-w-7xl">
    <div class="card bg-base-100 shadow-xl mb-8">
        <div class="card-header">
            <h2 class="text-2xl font-bold p-6 pb-2 flex items-center gap-3">
                <i data-lucide="calendar-heart" class="w-7 h-7 text-primary"></i>
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


<div class="card  shadow-xl">
  <div class="card-body">
    <!-- Carousel Showcase -->
    <div class="relative w-full overflow-hidden" id="showcaseCarousel">
      <div class="flex transition-transform duration-700 ease-in-out" id="showcaseSlides">
        
        <!-- Slide 1 -->
        <div class="w-full flex-shrink-0 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 px-4">
          <!-- Standard Room -->
          <div class="card bg-base-100 shadow-lg border">
            <figure class="px-4 pt-4">
              <img src="https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=400&h=250&fit=crop"
                alt="Standard Room" class="rounded-xl h-48 w-full object-cover" />
            </figure>
            <div class="card-body">
              <h2 class="card-title">Standard Room <div class="badge badge-primary">Popular</div></h2>
              <p class="text-base-content/70">Cozy and affordable with all the essentials.</p>
            </div>
          </div>

          <!-- Deluxe Room -->
          <div class="card bg-base-100 shadow-lg border">
            <figure class="px-4 pt-4">
              <img src="https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=400&h=250&fit=crop"
                alt="Deluxe Room" class="rounded-xl h-48 w-full object-cover" />
            </figure>
            <div class="card-body">
              <h2 class="card-title">Deluxe Room <div class="badge badge-secondary">Premium</div></h2>
              <p class="text-base-content/70">Spacious room with premium amenities and views.</p>
            </div>
          </div>

          <!-- Ocean View Suite -->
          <div class="card bg-base-100 shadow-lg border">
            <figure class="px-4 pt-4">
              <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=400&h=250&fit=crop"
                alt="Ocean View Suite" class="rounded-xl h-48 w-full object-cover" />
            </figure>
            <div class="card-body">
              <h2 class="card-title">Ocean View Suite <div class="badge badge-accent">Luxury</div></h2>
              <p class="text-base-content/70">Breathtaking ocean views with exclusive comfort.</p>
            </div>
          </div>
        </div>


      </div>
    </div>

    <!-- Controls -->
    <div class="flex justify-center w-full py-4 gap-2">
      <button class="btn btn-sm" onclick="prevShowcase()">❮</button>
      <button class="btn btn-sm" onclick="nextShowcase()">❯</button>
    </div>
  </div>
</div>

<script>
  let showcaseIndex = 0;
  const showcaseSlides = document.getElementById('showcaseSlides');
  const totalShowcaseSlides = showcaseSlides.children.length;

  function updateShowcase() {
    showcaseSlides.style.transform = `translateX(-${showcaseIndex * 100}%)`;
  }

  function nextShowcase() {
    showcaseIndex = (showcaseIndex + 1) % totalShowcaseSlides;
    updateShowcase();
  }

  function prevShowcase() {
    showcaseIndex = (showcaseIndex - 1 + totalShowcaseSlides) % totalShowcaseSlides;
    updateShowcase();
  }

  // Auto slide every 6s
  setInterval(nextShowcase, 6000);

  // Init
  updateShowcase();
</script>



   
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