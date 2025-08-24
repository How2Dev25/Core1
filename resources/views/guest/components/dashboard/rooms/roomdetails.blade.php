<!DOCTYPE html>
<html lang="en" data-theme ="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <!-- Font Awesome CDN -->


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
            <h1 class="text-2xl font-bold text-[#191970] bg-clip-text ">Booking And Reservation</h1>
          </div>
            {{-- Subsystem Name --}}

          {{-- content --}}
        
 <section class="container mx-auto px-4 py-8 mt-10">
            
                    <!-- Enhanced Header -->
                    <div class="mb-10">
                        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                            <div class="flex items-center space-x-4">
                                <div class="p-3 bg-gradient-to-br from-[#001f54] to-[#1a3470] rounded-2xl shadow-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" 
                                         width="28" height="28" 
                                         viewBox="0 0 24 24" 
                                         fill="none" 
                                         stroke="#F7B32B" 
                                         stroke-width="2" 
                                         stroke-linecap="round" 
                                         stroke-linejoin="round">
                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                    </svg>
                                </div>
                                <div>
                                    <h1 class="text-4xl font-bold bg-gradient-to-r from-[#001f54] to-[#1a3470] bg-clip-text text-transparent">
                                        Room Details
                                    </h1>
                                    <p class="text-gray-600 mt-1">Discover your perfect stay</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-4">
                                <span class="inline-flex items-center px-6 py-3 rounded-full bg-gradient-to-r from-green-500 to-emerald-500 text-white text-sm font-semibold shadow-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" 
                                         width="16" height="16" 
                                         viewBox="0 0 24 24" 
                                         fill="none" 
                                         stroke="currentColor" 
                                         stroke-width="2" 
                                         stroke-linecap="round" 
                                         stroke-linejoin="round" 
                                         class="mr-2">
                                        <circle cx="12" cy="12" r="10"></circle>
                                    </svg>
                                    {{ $room->roomstatus }}
                                </span>
                                <div class="text-right">
                                    <p class="text-sm text-gray-500">Room</p>
                                    <h2 class="text-2xl font-bold text-[#001f54]">#{{ $room->roomID }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Layout Grid -->
                    <div class="grid grid-cols-1 xl:grid-cols-4 gap-8">
                        
                        <!-- Left Section - Images (3/4 width) -->
                        <div class="xl:col-span-3 space-y-8">
                            
                            <!-- Main Photo Card -->
                            <div class="bg-white/95 backdrop-blur-md rounded-3xl shadow-2xl overflow-hidden border border-white/20">
                                <div class="relative group">
                                    <div class="aspect-[16/10] overflow-hidden">
                                        <img src="{{ asset($room->roomphoto) }}" 
                                             alt="Room Image" 
                                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                    </div>
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>
                                    <div class="absolute top-6 right-6 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <button class="btn btn-circle bg-white/20 backdrop-blur-md border-0 hover:bg-white/30 text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="m21 21-6-6m6 6v-4.8m0 4.8h-4.8"></path>
                                                <path d="M3 16.2V21m0 0h4.8M3 21l6-6"></path>
                                                <path d="M21 7.8V3m0 0h-4.8M21 3l-6 6"></path>
                                                <path d="M3 7.8V3m0 0h4.8M3 3l6 6"></path>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="absolute bottom-6 left-6">
                                        <div class="inline-flex items-center px-4 py-2 rounded-full bg-white/20 backdrop-blur-md text-white border border-white/20">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                            </svg>
                                            {{ $room->roomtype }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Gallery -->
                            <div class="bg-white/95 backdrop-blur-md rounded-3xl p-8 shadow-xl border border-white/20">
                                <div class="flex items-center justify-between mb-8">
                                    <div class="flex items-center">
                                        <div class="p-2 bg-gradient-to-br from-[#001f54] to-[#1a3470] rounded-xl mr-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" 
                                                 width="20" height="20" 
                                                 viewBox="0 0 24 24" 
                                                 fill="none" 
                                                 stroke="#F7B32B" 
                                                 stroke-width="2" 
                                                 stroke-linecap="round" 
                                                 stroke-linejoin="round">
                                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                                <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                                <polyline points="21 15 16 10 5 21"></polyline>
                                            </svg>
                                        </div>
                                        <h3 class="text-2xl font-bold text-[#001f54]">Photo Gallery</h3>
                                    </div>
                                    <div class="badge badge-outline border-[#001f54] text-[#001f54] px-3 py-1">
                                        {{ count($roomphotos) }} Photos
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
                                    @forelse ($roomphotos as $roomphoto)
                                        <div class="relative group rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 aspect-square border border-gray-100">
                                            <img class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110" 
                                                 src="{{ asset($roomphoto->additionalroomphoto) }}" 
                                                 alt="Room image">
                                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                                <div class="absolute bottom-3 right-3 flex space-x-2">
                                                    <button onclick="view_room_{{$roomphoto->roomphotoID}}.showModal()" 
                                                            class="btn btn-circle btn-sm bg-white/90 backdrop-blur-sm border-0 hover:bg-white text-gray-700 shadow-lg">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                                                            <circle cx="12" cy="12" r="3"></circle>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-span-full flex flex-col items-center justify-center p-12 border-2 border-dashed border-gray-200 rounded-2xl text-center bg-gray-50/50">
                                            <div class="w-16 h-16 mb-4 text-gray-400">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                    <line x1="2" y1="2" x2="22" y2="22"></line>
                                                    <path d="M10.41 10.41a2 2 0 1 1-2.83-2.83"></path>
                                                    <line x1="13.5" y1="6" x2="6" y2="13.5"></line>
                                                    <line x1="18" y1="12" x2="12" y2="18"></line>
                                                    <path d="M21 15a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2Z"></path>
                                                </svg>
                                            </div>
                                            <h3 class="text-lg font-semibold text-gray-700 mb-2">No Additional Photos</h3>
                                            <p class="text-sm text-gray-500">No gallery images available for this room</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>

                        <!-- Right Section - Room Information (sticky) -->
                        <div class="bg-white/95 backdrop-blur-md rounded-3xl shadow-2xl p-8 border border-white/20 h-fit sticky top-8 xl:col-span-1">
                            <!-- Room Info -->
                            <div class="flex items-center mb-8">
                                <div class="p-2 bg-gradient-to-br from-[#001f54] to-[#1a3470] rounded-xl mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" 
                                         width="20" height="20" 
                                         viewBox="0 0 24 24" 
                                         fill="none" 
                                         stroke="#F7B32B" 
                                         stroke-width="2" 
                                         stroke-linecap="round" 
                                         stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                        <line x1="16" y1="13" x2="8" y2="13"></line>
                                        <line x1="16" y1="17" x2="8" y2="17"></line>
                                    </svg>
                                </div>
                                <h2 class="text-xl font-bold text-[#001f54]">Room Information</h2>
                            </div>

                            <div class="space-y-6">
                                <!-- room details cards -->
                                <div class="flex items-center p-4 rounded-xl bg-gradient-to-r from-[#001f54]/5 to-[#1a3470]/5 border border-[#001f54]/10">
                                    <div class="p-2 bg-[#001f54] rounded-lg mr-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#F7B32B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M7 13h10l4-8H5.4L6 7H3"></path>
                                            <circle cx="18" cy="20" r="1"></circle>
                                            <circle cx="9" cy="20" r="1"></circle>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 font-medium">Room Type</p>
                                        <p class="font-bold text-[#001f54]">{{ $room->roomtype }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center p-4 rounded-xl bg-gradient-to-r from-[#001f54]/5 to-[#1a3470]/5 border border-[#001f54]/10">
                                    <div class="p-2 bg-[#001f54] rounded-lg mr-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#F7B32B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M3 7V5a2 2 0 0 1 2-2h2"></path>
                                            <path d="M17 3h2a2 2 0 0 1 2 2v2"></path>
                                            <path d="M21 17v2a2 2 0 0 1-2 2h-2"></path>
                                            <path d="M7 21H5a2 2 0 0 1-2-2v-2"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 font-medium">Room Size</p>
                                        <p class="font-bold text-[#001f54]">{{ $room->roomsize }} sqft</p>
                                    </div>
                                </div>

                                <div class="flex items-center p-4 rounded-xl bg-gradient-to-r from-[#001f54]/5 to-[#1a3470]/5 border border-[#001f54]/10">
                                    <div class="p-2 bg-[#001f54] rounded-lg mr-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#F7B32B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="9" cy="7" r="4"></circle>
                                            <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 font-medium">Max Guests</p>
                                        <p class="font-bold text-[#001f54]">{{ $room->roommaxguest }} Guests</p>
                                    </div>
                                </div>

                                <div class="flex items-center p-4 rounded-xl bg-gradient-to-r from-green-500/5 to-emerald-500/5 border border-green-500/20">
                                    <div class="p-2 bg-[#001f54] rounded-lg mr-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#F7B32B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <line x1="12" y1="2" x2="12" y2="22"></line>
                                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 font-medium">Price per night</p>
                                        <p class="text-xl font-bold text-[#F7B32B]">₱{{ number_format($room->roomprice, 2) }}</p>
                                    </div>
                                </div>

                                <div class="p-4 rounded-xl bg-gradient-to-r from-[#001f54]/5 to-[#1a3470]/5 border border-[#001f54]/10">
                                    <div class="flex items-center mb-3">
                                        <div class="p-1 bg-[#001f54] rounded-lg mr-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#F7B32B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                            </svg>
                                        </div>
                                        <h4 class="font-semibold text-[#001f54]">Room Description</h4>
                                    </div>
                                    <p class="text-gray-600 leading-relaxed text-sm">{{ $room->roomdescription }}</p>
                                </div>
                            </div>

                            <!-- CTA -->
                            <div class="mt-8">
                                <a href="/reservethisroom/{{ $room->roomID }}" 
                                   class="w-full btn btn-primary">
                                    Book This Room
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Footer -->
                  
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

 
  
</html>