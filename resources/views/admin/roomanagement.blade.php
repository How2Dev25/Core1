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
            <h1 class="text-2xl font-bold text-[#191970] bg-clip-text ">Room Management</h1>
          </div>
            {{-- Subsystem Name --}}

          {{-- content --}}
       
         <section class="p-6  rounded-2xl   max-w-screen-xl mx-auto ">
  <!-- Header Section -->
  <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
    <div>
      <p class="text-gray-500 mt-1">Manage all hotel rooms, availability, and pricing</p>
      {{-- aleerts --}}
      @if(session('roomcreated'))
    <div role="alert" class="alert alert-success mt-2 mb-2">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
      <span>{{session('roomcreated')}}</span>
    </div>
    @elseif(session('roomdeleted'))
     <div role="alert" class="alert alert-success mt-2 mb-2">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
      <span>{{session('roomdeleted')}}</span>
    </div>
    @endif
    </div>
    {{-- alerts --}}
    
    <button onclick="room_modal.showModal()" class="btn btn-primary gap-2">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
      </svg>
      Add New Room
    </button>
  </div>

  <!-- Stats Cards -->
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
    <!-- Total Rooms -->
    <div class="card bg-gradient-to-br from-blue-50 to-white border border-blue-100">
      <div class="card-body p-5">
        <div class="flex items-center gap-4">
          <div class="p-3 rounded-lg bg-blue-100 text-blue-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
          </div>
          <div>
            <h3 class="text-lg font-semibold">Total Rooms</h3>
            <p class="text-sm text-gray-500">All room types</p>
          </div>
        </div>
        <p class="text-3xl font-bold mt-3 text-gray-800">{{$totalrooms}}</p>
      </div>
    </div>

    <!-- Occupied -->
    <div class="card bg-gradient-to-br from-red-50 to-white border border-red-100">
      <div class="card-body p-5">
        <div class="flex items-center gap-4">
          <div class="p-3 rounded-lg bg-red-100 text-red-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
          </div>
          <div>
            <h3 class="text-lg font-semibold">Occupied</h3>
            <p class="text-sm text-gray-500">Currently booked</p>
          </div>
        </div>
        <p class="text-3xl font-bold mt-3 text-gray-800">{{$occupiedrooms}}</p>
      </div>
    </div>

    <!-- Available -->
    <div class="card bg-gradient-to-br from-green-50 to-white border border-green-100">
      <div class="card-body p-5">
        <div class="flex items-center gap-4">
          <div class="p-3 rounded-lg bg-green-100 text-green-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
            </svg>
          </div>
          <div>
            <h3 class="text-lg font-semibold">Available</h3>
            <p class="text-sm text-gray-500">Ready for booking</p>
          </div>
        </div>
        <p class="text-3xl font-bold mt-3 text-gray-800">{{$availablerooms}}</p>
      </div>
    </div>

    <!-- Maintenance -->
    <div class="card bg-gradient-to-br from-amber-50 to-white border border-amber-100">
      <div class="card-body p-5">
        <div class="flex items-center gap-4">
          <div class="p-3 rounded-lg bg-amber-100 text-amber-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
            </svg>
          </div>
          <div>
            <h3 class="text-lg font-semibold">Maintenance</h3>
            <p class="text-sm text-gray-500">Under repair</p>
          </div>
        </div>
        <p class="text-3xl font-bold mt-3 text-gray-800">{{$maintenancerooms}}</p>
      </div>
    </div>
  </div>

  <!-- Room Types Grid -->
  <div class="mb-10">
    <div class="flex justify-between items-center mb-4">
      <h3 class="text-xl font-bold text-gray-800">Rooms</h3>
      <div class="flex gap-2">
        <select class="select select-bordered select-sm">
          <option>All Categories</option>
          <option>Standard</option>
          <option>Deluxe</option>
          <option>Suite</option>
        </select>
        <input type="text" placeholder="Search rooms..." class="input input-bordered input-sm">
      </div>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
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
              {{$room->roomguest}} Guests
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
              <button  onclick="delete_room_{{ $room->roomID }}.showModal()" class="btn btn-circle btn-sm btn-ghost text-error">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
              </button>
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
  </div>

  <!-- Room Status Table -->
  <div class="card bg-white border border-gray-200">
    <div class="card-body p-0">
      <div class="flex flex-col md:flex-row justify-between items-start md:items-center p-5 pb-0">
        <h3 class="text-xl font-bold text-gray-800">Room Status</h3>
        <div class="flex gap-2 mt-3 md:mt-0">
          <select class="select select-bordered select-sm">
            <option>All Status</option>
            <option>Available</option>
            <option>Occupied</option>
            <option>Maintenance</option>
          </select>
          <input type="text" placeholder="Search room numbers..." class="input input-bordered input-sm">
        </div>
      </div>
      
      <div class="overflow-x-auto">
        <table class="table">
          <thead>
            <tr>
              <th class="bg-gray-50">Room No.</th>
              <th class="bg-gray-50">Type</th>
              <th class="bg-gray-50">Status</th>
              <th class="bg-gray-50">Guest</th>
              <th class="bg-gray-50">Check-In</th>
              <th class="bg-gray-50">Check-Out</th>
              <th class="bg-gray-50 text-right">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr class="hover:bg-gray-50">
              <td>305</td>
              <td>
                <div class="flex items-center gap-2">
                  <div class="badge badge-primary badge-xs"></div>
                  Deluxe
                </div>
              </td>
              <td><span class="badge badge-success">Occupied</span></td>
              <td>John Smith</td>
              <td>Jun 15, 2025</td>
              <td>Jun 18, 2025</td>
              <td class="text-right">
                <button class="btn btn-ghost btn-xs text-info">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                  </svg>
                </button>
              </td>
            </tr>
            <tr class="hover:bg-gray-50">
              <td>402</td>
              <td>
                <div class="flex items-center gap-2">
                  <div class="badge badge-secondary badge-xs"></div>
                  Suite
                </div>
              </td>
              <td><span class="badge badge-success">Occupied</span></td>
              <td>Sarah Johnson</td>
              <td>Jun 12, 2025</td>
              <td>Jun 20, 2025</td>
              <td class="text-right">
                <button class="btn btn-ghost btn-xs text-info">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                  </svg>
                </button>
              </td>
            </tr>
            <tr class="hover:bg-gray-50">
              <td>112</td>
              <td>
                <div class="flex items-center gap-2">
                  <div class="badge badge-accent badge-xs"></div>
                  Standard
                </div>
              </td>
              <td><span class="badge badge-warning">Maintenance</span></td>
              <td>-</td>
              <td>-</td>
              <td>-</td>
              <td class="text-right">
                <button class="btn btn-ghost btn-xs text-info">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                  </svg>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      
      <!-- Pagination -->
      <div class="flex justify-center p-4">
        <div class="join">
          <button class="join-item btn btn-sm">«</button>
          <button class="join-item btn btn-sm btn-active">1</button>
          <button class="join-item btn btn-sm">2</button>
          <button class="join-item btn btn-sm">3</button>
          <button class="join-item btn btn-sm">»</button>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Add Room Modal -->
@include('admin.components.roommanagement.createroom')




@foreach($rooms as $room)
  @include('admin.components.roommanagement.deleteroom')

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
  @include('javascriptfix.soliera_js')

  <script src="{{asset('javascript/photouploadglobal.js')}}"></script>
  
</html>