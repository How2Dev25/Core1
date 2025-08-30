<!DOCTYPE html>
<html lang="en" data-theme ="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    @vite('resources/css/app.css')
 
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <title>{{$title}} - Hotel Marketing And Promotion</title>
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
            <h1 class="text-2xl font-bold bg-white bg-clip-text text-[#191970]">Hotel Marketing And Promotion</h1>
          </div>
            {{-- Subsystem Name --}}

          {{-- content --}}
          <section class="w-full min-h-screen p-5">
            
            {{-- cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto">
  <!-- Card 1: Active Promotions (Blue) -->
  <div class="card border border-blue-100 bg-gradient-to-br from-blue-50 to-white
              transition-all duration-300 ease-in-out
              hover:shadow-lg hover:-translate-y-1 hover:border-blue-500
              hover:bg-gradient-to-br hover:from-blue-100 hover:to-white
              group">
    <div class="card-body p-6">
      <div class="flex items-center gap-4 mb-4">
        <div class="p-3 rounded-box bg-blue-100 text-blue-600
                   group-hover:bg-blue-600 group-hover:text-white
                   transition-colors duration-300">
          <i class='bx bx-badge-check text-2xl'></i>
        </div>
        <div>
          <h3 class="text-lg font-semibold text-gray-700 group-hover:text-blue-800 transition-colors">Active Promotions</h3>
          <p class="text-sm text-gray-500 group-hover:text-blue-600 transition-colors">Ongoing campaigns</p>
        </div>
      </div>
      <p class="text-3xl font-bold text-gray-800 mb-2 group-hover:text-blue-900 transition-colors">12</p>
      <div class="mt-2">
        <span class="badge badge-sm badge-success gap-1 group-hover:bg-blue-600 transition-colors">
          <i class='bx bx-up-arrow-alt'></i> 5 new this week
        </span>
      </div>
    </div>
  </div>

  <!-- Card 2: Total Bookings (Green) -->
  <div class="card border border-green-100 bg-gradient-to-br from-green-50 to-white
              transition-all duration-300 ease-in-out
              hover:shadow-lg hover:-translate-y-1 hover:border-green-200
              hover:bg-gradient-to-br hover:from-green-500 hover:to-white
              group">
    <div class="card-body p-6">
      <div class="flex items-center gap-4 mb-4">
        <div class="p-3 rounded-box bg-green-100 text-green-600
                   group-hover:bg-green-600 group-hover:text-white
                   transition-colors duration-300">
          <i class='bx bx-calendar-check text-2xl'></i>
        </div>
        <div>
          <h3 class="text-lg font-semibold text-gray-700 group-hover:text-green-800 transition-colors">Total Bookings</h3>
          <p class="text-sm text-gray-500 group-hover:text-green-600 transition-colors">This month</p>
        </div>
      </div>
      <p class="text-3xl font-bold text-gray-800 mb-2 group-hover:text-green-900 transition-colors">342</p>
      <div class="radial-progress text-green-500 group-hover:text-green-600 transition-colors" style="--value:75; --size:2.5rem; --thickness:4px;">75%</div>
    </div>
  </div>


  

  <!-- Card 4: Customer Engagement (Amber) -->
  <div class="card border border-amber-100 bg-gradient-to-br from-amber-50 to-white
              transition-all duration-300 ease-in-out
              hover:shadow-lg hover:-translate-y-1 hover:border-amber-200
              hover:bg-gradient-to-br hover:from-amber-500 hover:to-white
              group">
    <div class="card-body p-6">
      <div class="flex items-center gap-4 mb-4">
        <div class="p-3 rounded-box bg-amber-100 text-amber-600
                   group-hover:bg-amber-600 group-hover:text-white
                   transition-colors duration-300">
          <i class='bx bx-chat text-2xl'></i>
        </div>
        <div>
          <h3 class="text-lg font-semibold text-gray-700 group-hover:text-amber-800 transition-colors">Engagement Rate</h3>
          <p class="text-sm text-gray-500 group-hover:text-amber-600 transition-colors">Promo interactions</p>
        </div>
      </div>
      <p class="text-3xl font-bold text-gray-800 mb-2 group-hover:text-amber-900 transition-colors">78%</p>
      <progress class="progress progress-warning w-full group-hover:bg-amber-200 transition-colors" value="78" max="100"></progress>
    </div>
  </div>
</div>
            {{-- cards --}}
        
            <div class="mt-10 max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-6">
                {{-- table section --}}
                <div class="lg:col-span-2 bg-white p-6 rounded-box shadow-sm border border-gray-200">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">Marketing And Promotions Management</h2>
                        <div class="flex gap-3 w-full sm:w-auto">
                            <div class="relative flex-grow sm:flex-grow-0 sm:w-64">
                                <label class="input input-bordered flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 opacity-70">
                                        <path fill-rule="evenodd" d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z" clip-rule="evenodd" />
                                    </svg>
                                    {{-- search --}}
                                    <form action="/searchhmp" method="GET">
                                        @csrf
                                    <input name="searchhmp" type="text" class="grow" placeholder="Search promotions" />
                                    </form>
                                </label>
                            </div>
                            <button onclick = "createhmp.showModal()" class="btn btn-primary">
                                <i class='bx bx-plus'></i>
                                Add 
                            </button>
                        </div>
                    </div>
        
                    {{-- create modal --}}
                    @include('admin.components.hmp.createhmp')
                    {{--  --}}
        
                    <div class="overflow-x-auto">
                        <table class="table">
                         @include('admin.components.hmp.alerts')
                           
                            <thead>
                                <tr class="bg-gray-100 text-gray-700">
                                    <th class="font-semibold">#</th>
                                    <th class="font-semibold">Promo Name</th>
                                    <th class="font-semibold">Description</th>
                                    <th class="font-semibold">Status</th>
                                    <th class="font-semibold text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- row 1 -->
                                @forelse ($hmpdata as $hmp)
                                <tr class="hover:bg-gray-50">
                                    <td>{{$hmp->promoID}}</td>
                                    <td>
                                        <div class="font-medium">{{$hmp->hotelpromoname}}</div>
                                        <div class="text-sm text-gray-500">{{$hmp->hotelpromotag}}</div>
                                    </td>
                                    <td class="max-w-xs truncate">{{$hmp->hotelpromodescription}}</td>
                                    <td>
                                        @if ($hmp->hotelpromostatus == 'Active')
                                        <span class="badge badge-success badge-sm gap-1">
                                            <i class='bx bx-check-circle'></i> Active
                                        </span>
                                        @else
                                        <span class="badge badge-error badge-sm gap-1">
                                            <i class='bx  bx-x-circle'  ></i>  Expired
                                        </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="flex justify-end gap-2">
                                            <button  onclick="edit_modal_{{$hmp->promoID}}.showModal()" class="btn btn-sm btn-outline btn-info">
                                                <i class='bx bx-edit'></i>
                                              </button>
                                            <button onclick="delete_modal_{{ $hmp->promoID }}.showModal()" class="btn btn-sm btn-outline btn-error">
                                                <i class='bx bx-trash'></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                              
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-8">
                                        <div class="flex flex-col items-center justify-center text-gray-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-inbox">
                                                <polyline points="22 12 16 12 14 15 10 15 8 12 2 12"></polyline>
                                                <path d="M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"></path>
                                            </svg>
                                            <span class="mt-2 text-sm font-medium">No Data found</span>
                                        </div>
                                    </td>
                                </tr>
                                
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- table section --}}
                
        
                {{-- recent promotions sidebar --}}
               @include('admin.components.hmp.carousel')
                {{-- end recent promotions sidebar --}}
            </div>

               <div class="mt-2 mb-2">
                   <h1 class="font-bold text-2xl">Available Rooms</h1>
                </div>

             <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-5">

             
      <!-- Room 1 -->
      @forelse($rooms as $room)
      <div class="card bg-white border border-gray-200 hover:shadow-md transition-all duration-300 overflow-hidden">
        <figure class="relative h-48">
          <img src="{{asset($room->roomphoto)}}" alt="Deluxe Room" class="w-full h-full object-cover">
                  <div class="absolute top-4 right-4">
            <span class="badge 
              @if($room->roomtype == 'Standard') badge-info
              @elseif($room->roomtype == 'Deluxe') badge-primary
              @elseif($room->roomtype == 'Suite') badge-secondary
              @elseif($room->roomtype == 'Executive') badge-accent
              @endif
            ">
              {{ $room->roomtype }}
            </span>
          </div>
        </figure>
        <div class="card-body p-5">
          <div class="flex justify-between items-start">
            <div>
             
              <p class="text-black font-bold text-lg">Room #{{$room->roomID}}</p>
            </div>
            <div class="text-right">
              <p class="text-sm text-gray-500">From</p>
              <p class="text-xl font-bold text-primary">₱{{$room->roomprice}}/night</p>
            </div>
          </div>
          
          <div class="flex items-center gap-2 mt-3">
            <div class="flex items-center text-sm text-gray-500">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="r ound" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
              </svg>
              {{$room->roomprice}} sqft
            </div>
            <div class="flex items-center text-sm text-gray-500">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
              </svg>
              {{$room->roommaxguest}} Guests
            </div>
          </div>
          
          <div class="mt-4 flex justify-between items-center">
            <p class="text-sm text-blue-600">
              {{$room->roomfeatures}}
            </p>
            <div class="flex gap-2">
              <a href="/gotoroom/{{$room->roomID}}" class="btn btn-circle btn-sm btn-ghost text-info">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
              </a>
             
            </div>
          </div>
        </div>
      </div>
      @empty
      <div class="w-full text-center py-10 px-4 bg-base-100 rounded-md shadow-sm border border-dashed border-gray-300">
  <img src="{{ asset('images/defaults/default.jpg') }}" alt="No rooms" class="mx-auto mb-4 w-40 ">
  
  <h2 class="text-xl font-semibold text-gray-700 mb-2">No Rooms Yet!</h2>
  

  
  
</div>
    
      @endforelse
    </div>

    <div class="mt-2 mb-2">
        <h1 class="font-bold text-2xl">Approved Events</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 ">
        @forelse ($events as $event)
    <div class="card bg-base-100 shadow-sm hover:shadow-md transition-shadow">
        <div class="card-body p-4">
            <div class="flex items-start gap-4">
                <!-- Event Image -->
                <div class="avatar">
                    <div class="mask mask-squircle w-12 h-12">
                        <img src="{{asset($event->eventphoto)}}" alt="{{$event->eventname}}">
                    </div>
                </div>
                
                <!-- Event Details -->
                <div class="flex-1">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="font-bold">{{$event->eventtype}}</h3>
                            <p class="text-sm text-gray-500">#{{$event->eventID}} • {{$event->eventname}}</p>
                        </div>
                        
                        <!-- Status Badge -->
                        <div>
                            @if ($event->eventstatus == "Approved")
                                <span class="badge badge-success">Approved</span>
                            @elseif ($event->eventstatus == "Pending")
                                <span class="badge badge-warning">Pending</span>
                            @elseif ($event->eventstatus == "Cancelled")
                                <span class="badge badge-error">Cancelled</span>
                            @else
                                <span class="badge badge-neutral">Unknown</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="mt-2 text-sm">
                        <p><span class="font-medium">Organizer:</span> {{$event->eventorganizername}}</p>
                        <div class="flex gap-4 mt-1">
                            <p><span class="font-medium">Date:</span> {{$event->eventdate}}</p>
                            <p><span class="font-medium">Duration:</span> {{$event->eventdays}} days</p>
                        </div>
                    </div>
                    
                 
                
                </div>
            </div>
        </div>
    </div>
@empty
    <div class="col-span-full py-12 text-center">
        <div class="flex flex-col items-center justify-center text-gray-400">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-inbox">
                <polyline points="22 12 16 12 14 15 10 15 8 12 2 12"></polyline>
                <path d="M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"></path>
            </svg>
            <span class="mt-2 text-sm font-medium">No Data found</span>
        </div>
    </div>
@endforelse
    
     </div>


        </section>
  
           
      
 
        </main>
      </div>
    </div>

    {{-- modals --}}
   @foreach ($hmpdata as $hmp )
   @include('admin.components.hmp.edithmp')
   @include('admin.components.hmp.deletehmp')
   @endforeach
      
  
 
  </body>

  @endauth
  @include('javascriptfix.soliera_js')

  <script src="{{asset('javascript/photouploadglobal.js')}}"></script>
  
</html>