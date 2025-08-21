<!DOCTYPE html>
<html lang="en" data-theme ="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    @vite('resources/css/app.css')
 
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <title>{{$title}} - Room Management</title>
</head>
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
            <h1 class="text-2xl font-bold text-[#191970] bg-clip-text ">Room Management</h1>
          </div>
            {{-- Subsystem Name --}}

          {{-- content --}}
        
<section class="container mx-auto px-4 py-10">
    <!-- Header with icon -->
    <div class="flex justify-between items-center mb-10">
        <div class="flex items-center space-x-3">
            <svg xmlns="http://www.w3.org/2000/svg" 
                 width="24" height="24" 
                 viewBox="0 0 24 24" 
                 fill="none" 
                 stroke="currentColor" 
                 stroke-width="2" 
                 stroke-linecap="round" 
                 stroke-linejoin="round" 
                 class="text-blue-600">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                <polyline points="9 22 9 12 15 12 15 22"></polyline>
            </svg>
            <h1 class="text-3xl font-bold text-gray-800">Room Details</h1>
        </div>

        <span class="px-4 py-2 rounded-full bg-green-100 text-green-800 text-sm font-semibold flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" 
                 width="16" height="16" 
                 viewBox="0 0 24 24" 
                 fill="none" 
                 stroke="currentColor" 
                 stroke-width="2" 
                 stroke-linecap="round" 
                 stroke-linejoin="round" 
                 class="mr-1">
                <circle cx="12" cy="12" r="10"></circle>
            </svg>
            {{ $room->roomstatus }}
        </span>
    </div>

    <div class="mb-1 p-2">
        <h2 class="font-semibold text-2xl">Room #{{ $room->roomID }}</h2>
      
    </div>

    <!-- Layout Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Section -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Main Photo Card -->
            <div class="bg-white rounded-2xl shadow-md overflow-hidden border border-gray-100">
                <div class="relative group">
                    <img src="{{ asset($room->roomphoto) }}" 
                         alt="Room Image" 
                         class="w-full h-96 object-cover transition-transform duration-300 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent"></div>
                </div>
            </div>

            <!-- Additional Photos Grid -->
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" 
                         width="20" height="20" 
                         viewBox="0 0 24 24" 
                         fill="none" 
                         stroke="currentColor" 
                         stroke-width="2" 
                         stroke-linecap="round" 
                         stroke-linejoin="round" 
                         class="mr-2">
                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                        <circle cx="8.5" cy="8.5" r="1.5"></circle>
                        <polyline points="21 15 16 10 5 21"></polyline>
                    </svg>
                    Gallery
                </h3>

                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                    @forelse ($roomphotos as $roomphoto)
                        <div class="relative group rounded-xl overflow-hidden shadow-md hover:shadow-lg transition-all duration-300 border border-gray-100">
                            <img class="w-full h-40 object-cover transition-transform duration-300 group-hover:scale-105" 
                                 src="{{ asset($roomphoto->additionalroomphoto) }}" 
                                 alt="Room image">

                                  <div class="absolute bottom-3 right-3 flex space-x-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
            <button onclick="view_room_{{$roomphoto->roomphotoID}}.showModal()" class="p-2 bg-white/90 backdrop-blur-sm rounded-full shadow-sm hover:bg-white transition-colors">
                <i data-lucide="eye" class="w-4 h-4"></i>
            </button>
          
        </div>
                        </div>
                    @empty
                        <div class="col-span-full flex flex-col items-center justify-center p-8 border-2 border-dashed border-gray-200 rounded-xl text-center">
                            <div class="w-16 h-16 mb-4 text-gray-400">
                                <i data-lucide="image-off" class="w-full h-full"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-700 mb-1">No Room Photos</h3>
                            <p class="text-sm text-gray-500">No additional photos available</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Right Section - Room Information -->
        <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100">
            <div class="flex items-center mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" 
                     width="24" height="24" 
                     viewBox="0 0 24 24" 
                     fill="none" 
                     stroke="currentColor" 
                     stroke-width="2" 
                     stroke-linecap="round" 
                     stroke-linejoin="round" 
                     class="text-blue-600 mr-2">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                    <line x1="16" y1="13" x2="8" y2="13"></line>
                    <line x1="16" y1="17" x2="8" y2="17"></line>
                </svg>
                <h2 class="text-xl font-semibold text-gray-800">Room Information</h2>
            </div>

            

            <div class="space-y-5">
                <p><span class="font-semibold">Type:</span> {{ $room->roomtype }}</p>
                <p><span class="font-semibold">Size:</span> {{ $room->roomsize }} sqft</p>
                <p><span class="font-semibold">Max Guests:</span> {{ $room->roommaxguest }}</p>
                <p><span class="font-semibold">Price per night:</span> ₱{{ number_format($room->roomprice, 2) }}</p>
                <p><span class="font-semibold">Features:</span></p>
                <p class="text-gray-700">{{ $room->roomfeatures }}</p>
                <p><span class="font-semibold">Description:</span></p>
                <p class="text-gray-700">{{ $room->roomdescription }}</p>
            </div>

            <!-- Book Button -->
            <div class="pt-6">
                <a href="/reservethisroom/{{ $room->roomID }}" 
                   class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" 
                         width="18" height="18" 
                         viewBox="0 0 24 24" 
                         fill="none" 
                         stroke="currentColor" 
                         stroke-width="2" 
                         stroke-linecap="round" 
                         stroke-linejoin="round" 
                         class="mr-2">
                        <path d="M20 6L9 17l-5-5"></path>
                    </svg>
                    Book This Room
                </a>
            </div>
        </div>
    </div>
</section>

          

{{-- modals --}}
@include('admin.components.roommanagement.editconfirmation')
@include('admin.components.roommanagement.addionalroom')

@foreach ($roomphotos as $roomphoto)
        @include('admin.components.roommanagement.viewroom')
     @include('admin.components.roommanagement.deleteadditionalroom')
@endforeach
          
          
          <!-- Lucide Icons -->
          <script type="module">
            import lucide from 'https://unpkg.com/lucide@latest/dist/esm/lucide.js';
            lucide.createIcons();
          </script>
  
           
      
 
        </main>
      </div>
    </div>

    {{-- modals --}}

   
 
  
 
  </body>
  @endauth
  @include('javascriptfix.soliera_js')

  <script src="{{asset('javascript/photouploadglobal.js')}}"></script>
  
</html>