<!DOCTYPE html>
<html lang="en" data-theme ="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    @vite('resources/css/app.css')
 
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <title>{{$title}} - Events And Conference</title>
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
            <h1 class="text-2xl font-bold text-[#191970] bg-clip-text ">Event And Conference Management</h1>
          </div>
            {{-- Subsystem Name --}}

          {{-- content --}}
   <!-- content -->
<section class="p-8 mt-5 max-w-screen-xl mx-auto">
  <!-- Enhanced Header Section -->
 

  <!-- Stats Cards -->
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 mb-10">
    <!-- Card 1 -->
    <div
      class="card border border-blue-100 bg-gradient-to-br from-blue-50 to-white transition-all duration-300 ease-in-out hover:shadow-lg hover:-translate-y-1 hover:border-blue-200 group rounded-xl"
    >
      <div class="card-body p-5">
        <div class="flex items-center gap-4">
          <div
            class="p-3 rounded-lg bg-blue-100 text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300"
          >
            📅
          </div>
          <div>
            <h3 class="text-base font-semibold">Total Events</h3>
            <p class="text-sm text-gray-500">All events</p>
          </div>
        </div>
        <p class="text-2xl font-bold mt-3 text-gray-800">12</p>
      </div>
    </div>

    <!-- Card 2 -->
    <div
      class="card border border-green-100 bg-gradient-to-br from-green-50 to-white transition-all duration-300 ease-in-out hover:shadow-lg hover:-translate-y-1 hover:border-green-200 group rounded-xl"
    >
      <div class="card-body p-5">
        <div class="flex items-center gap-4">
          <div
            class="p-3 rounded-lg bg-green-100 text-green-600 group-hover:bg-green-600 group-hover:text-white transition-colors duration-300"
          >
            ✅
          </div>
          <div>
            <h3 class="text-base font-semibold">Approved Events</h3>
            <p class="text-sm text-gray-500">Confirmed bookings</p>
          </div>
        </div>
        <p class="text-2xl font-bold mt-3 text-gray-800">7</p>
      </div>
    </div>

    <!-- Card 3 -->
    <div
      class="card border border-amber-100 bg-gradient-to-br from-amber-50 to-white transition-all duration-300 ease-in-out hover:shadow-lg hover:-translate-y-1 hover:border-amber-200 group rounded-xl"
    >
      <div class="card-body p-5">
        <div class="flex items-center gap-4">
          <div
            class="p-3 rounded-lg bg-amber-100 text-amber-600 group-hover:bg-amber-600 group-hover:text-white transition-colors duration-300"
          >
            ⚠️
          </div>
          <div>
            <h3 class="text-base font-semibold">Cancelled Events</h3>
            <p class="text-sm text-gray-500">Cancelled bookings</p>
          </div>
        </div>
        <p class="text-2xl font-bold mt-3 text-gray-800">3</p>
      </div>
    </div>
  </div>
  


@if(session('success'))
  <div class="alert alert-success shadow-lg rounded-xl mb-4 mt-4">
    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
            d="M9 12l2 2l4-4m6 2a9 9 0 11-18 0a9 9 0 0118 0z" />
    </svg>
    <span>{{ session('success') }}</span>
  </div>
@endif
  <!-- Event Types Section -->
  <div class="mb-10">
      
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
      <div class="bg-gradient-to-r from-blue-900 to-blue-800 px-6 py-5 flex justify-between items-center">
        <h3 class="text-xl font-bold text-white">Event Types</h3>
           <button
            onclick="document.getElementById('create_eventtype_modal').showModal()"
            class="btn btn-primary"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="h-5 w-5"
              viewBox="0 0 20 20"
              fill="currentColor"
            >
              <path
                fill-rule="evenodd"
                d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                clip-rule="evenodd"
              />
            </svg>
            Add Event Type
          </button>
      </div>

      <div class="p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
        <!-- Event Type Card -->
      @forelse($eventtypes as $eventtype)
  <div class="max-w-sm bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 group border border-gray-100 hover:border-yellow-400">
    <!-- Enhanced Image Container with Overlay Effects -->
    <div class="relative h-64 w-full overflow-hidden">
        <!-- Dynamic event image -->
        <img src="{{ asset($eventtype->eventtype_photo) }}" 
             alt="{{ $eventtype->eventtype_name }}" 
             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
        
        <!-- Gradient Overlay for better text readability -->
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        
        <!-- Price Badge - Floating on image -->
        <div class="absolute top-4 right-4 bg-yellow-500 text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg transform group-hover:scale-105 transition-transform duration-300">
            ₱{{ number_format($eventtype->eventtype_price, 2) }}
        </div>
        
        <!-- Shimmer effect overlay -->
        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-1000 ease-out"></div>
    </div>

    <!-- Enhanced Card Content -->
    <div class="p-6 flex-1 flex flex-col justify-between">
        <div>
            <!-- Title with better typography -->
            <h4 class="text-xl font-bold text-gray-800 mb-3 line-clamp-2 group-hover:text-yellow-600 transition-colors duration-300">
                {{ $eventtype->eventtype_name }}
            </h4>
            
            <!-- Description with improved styling -->
            <p class="text-gray-600 text-sm mb-4 line-clamp-3 leading-relaxed">
                {{ $eventtype->eventtype_description }}
            </p>
            
            <!-- Additional info section -->
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-full">Event Package</span>
                <div class="flex items-center text-yellow-500">
                    <!-- Star rating visual -->
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                        <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                    </svg>
                    <span class="text-xs text-gray-600 ml-1">Premium</span>
                </div>
            </div>
        </div>

        <!-- Enhanced Action Buttons -->
<div class="flex justify-end gap-3 mt-6 pt-4 border-t border-gray-100">
    <!-- Edit Button -->
    <button class="group/btn flex items-center gap-2 px-4 py-2 text-blue-600 hover:text-white hover:bg-blue-600 rounded-lg transition-all duration-300 border border-blue-200 hover:border-blue-600 hover:shadow-lg hover:shadow-blue-200" 
            onclick="document.getElementById('modify_eventtype_modal_{{ $eventtype->eventtype_ID }}').showModal()">
        <!-- Lucide Pencil Icon -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform group-hover/btn:rotate-12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path d="M12 20h9"/>
            <path d="M16.5 3.5a2.121 2.121 0 1 1 3 3L7 19l-4 1 1-4 12.5-12.5z"/>
        </svg>
        
    </button>

    <!-- Delete Button -->
    <button type="button" class="group/btn flex items-center gap-2 px-4 py-2 text-red-600 hover:text-white hover:bg-red-600 rounded-lg transition-all duration-300 border border-red-200 hover:border-red-600 hover:shadow-lg hover:shadow-red-200"
            onclick="document.getElementById('delete_modal_{{ $eventtype->eventtype_ID }}').showModal()">
        <!-- Lucide Trash Icon -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform group-hover/btn:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path d="M3 6h18"/>
            <path d="M19 6l-1 14H6L5 6"/>
            <path d="M10 11v6"/>
            <path d="M14 11v6"/>
            <path d="M9 6V4h6v2"/>
        </svg>
       
    </button>

    <!-- Booking Button -->
    <button type="button" class="group/btn flex items-center gap-2 px-4 py-2 text-green-600 hover:text-white hover:bg-green-600 rounded-lg transition-all duration-300 border border-green-200 hover:border-green-600 hover:shadow-lg hover:shadow-green-200"
            onclick="document.getElementById('booking_modal_{{ $eventtype->eventtype_ID }}').showModal()">
        <!-- Lucide Calendar Icon -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform group-hover/btn:rotate-12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
            <line x1="16" y1="2" x2="16" y2="6"/>
            <line x1="8" y1="2" x2="8" y2="6"/>
            <line x1="3" y1="10" x2="21" y2="10"/>
        </svg>
       
    </button>
</div>

    </div>
</div>
@empty
  <div class="flex flex-col items-center justify-center text-center p-10 bg-gray-50 border border-dashed border-gray-300 rounded-xl">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
            d="M9 17v-2h6v2m-7 4h8a2 2 0 002-2v-5a2 2 0 00-2-2h-2l-1-2h-2l-1 2H9a2 2 0 00-2 2v5a2 2 0 002 2z" />
    </svg>
    <h3 class="text-lg font-semibold text-gray-700 mb-1">No Event Types Yet</h3>
    <p class="text-gray-500 text-sm mb-4">Start by creating your first event type.</p>
    <button onclick="create_eventtype_modal.showModal()" 
            class="btn bg-yellow-400 hover:bg-yellow-300 text-blue-900 font-bold rounded-xl">
      + Create Event Type
    </button>
  </div>
@endforelse
      </div>
    </div>
  </div>

  <!-- Event Reservations Listing -->
  <div class="mb-10">
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
      <div class="bg-gradient-to-r from-blue-900 to-blue-800 px-6 py-5 flex justify-between items-center">
        <h3 class="text-xl font-bold text-white">Event Reservations</h3>
        <a href="#" class="bg-yellow-400 hover:bg-yellow-300 text-blue-900 px-4 py-2 rounded-lg font-semibold text-sm">View All</a>
      </div>

      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Event</th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Organizer</th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm font-medium text-gray-900">#E001 Corporate Meeting</div>
                <div class="text-sm text-gray-500">Grand Ballroom</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Conference</span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">John Smith</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2025-09-15</td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Approved</span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                <a href="#" class="text-blue-900 hover:text-blue-700 mr-3">Edit</a>
                <a href="#" class="text-red-600 hover:text-red-900">Cancel</a>
              </td>
            </tr>
            <tr>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm font-medium text-gray-900">#E002 Wedding Reception</div>
                <div class="text-sm text-gray-500">Garden Pavilion</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Wedding</span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Maria Garcia</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2025-10-02</td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                <a href="#" class="text-blue-900 hover:text-blue-700 mr-3">Edit</a>
                <a href="#" class="text-red-600 hover:text-red-900">Cancel</a>
              </td>
            </tr>
            <tr>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm font-medium text-gray-900">#E003 Birthday Celebration</div>
                <div class="text-sm text-gray-500">Private Dining Room</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-amber-100 text-amber-800">Celebration</span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Alex Lee</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2025-11-12</td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Cancelled</span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                <a href="#" class="text-blue-900 hover:text-blue-700 mr-3">Edit</a>
                <a href="#" class="text-red-600 hover:text-red-900">Delete</a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      
      <!-- Pagination -->
      <div class="bg-white px-6 py-4 border-t border-gray-200">
        <div class="flex items-center justify-between">
          <div class="text-sm text-gray-700">
            Showing <span class="font-medium">1</span> to <span class="font-medium">3</span> of <span class="font-medium">12</span> results
          </div>
          <div class="flex space-x-2">
            <button class="px-3 py-1 rounded border border-gray-300 text-gray-700 bg-white text-sm font-medium">Previous</button>
            <button class="px-3 py-1 rounded border border-blue-900 bg-blue-900 text-white text-sm font-medium">1</button>
            <button class="px-3 py-1 rounded border border-gray-300 text-gray-700 bg-white text-sm font-medium">2</button>
            <button class="px-3 py-1 rounded border border-gray-300 text-gray-700 bg-white text-sm font-medium">3</button>
            <button class="px-3 py-1 rounded border border-gray-300 text-gray-700 bg-white text-sm font-medium">Next</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


          <!-- Lucide Icons -->
          <script type="module">
            import lucide from 'https://unpkg.com/lucide@latest/dist/esm/lucide.js';
            lucide.createIcons();
          </script>
  
           
      
 
        </main>
      </div>
    </div>

    {{-- modals --}}
    @include('admin.components.ecm.createtype')
   
    @foreach ($eventtypes as $eventtype)
          @include('admin.components.ecm.deletetype')
          @include('admin.components.ecm.modifytype')
    @endforeach
  
 
  </body>

  @endauth

  
  @include('javascriptfix.soliera_js')

 <script>


  <script src="{{asset('javascript/photouploadglobal.js')}}"></script>
  
</html>