<!DOCTYPE html>
<html lang="en" data-theme ="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    @vite('resources/css/app.css')
 
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <title>{{$title}} - Front Desk And Reception</title>
      @livewireStyles
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
            <h1 class="text-2xl font-bold bg-white bg-clip-text text-[#191970]">Point Of Sale</h1>
          </div>
            {{-- Subsystem Name --}}

            <section class="p-5">
 <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10 mt-5">

            
  <!-- Card 1 - Total Reservation -->
  <div class="card border border-blue-100 bg-gradient-to-br from-blue-50 to-white
              transition-all duration-300 ease-in-out
              hover:shadow-lg hover:-translate-y-1 hover:border-blue-500
              hover:bg-gradient-to-br hover:from-blue-100 hover:to-white
              group">
    <div class="card-body p-5">
      <div class="flex items-center gap-4">
        <div class="p-3 rounded-lg bg-blue-100 text-blue-600
                   group-hover:bg-blue-600 group-hover:text-white
                   transition-colors duration-300">
          <i data-lucide="book-check"></i>
        </div>
        <div>
          <h3 class="text-lg font-semibold group-hover:text-blue-800 transition-colors">Total Reservation</h3>
        </div>
      </div>
      <livewire:total-reservation />
    </div>
  </div>

  <!-- Card 2 - Available Rooms -->
  <div class="card border border-green-100 bg-gradient-to-br from-green-50 to-white
              transition-all duration-300 ease-in-out
              hover:shadow-lg hover:-translate-y-1 hover:border-green-500
              hover:bg-gradient-to-br hover:from-green-100 hover:to-white
              group">
    <div class="card-body p-5">
      <div class="flex items-center gap-4">
        <div class="p-3 rounded-lg bg-green-100 text-green-600
                   group-hover:bg-green-600 group-hover:text-white
                   transition-colors duration-300">
          <i data-lucide="hotel"></i>
        </div>
        <div>
          <h3 class="text-lg font-semibold group-hover:text-green-800 transition-colors">Available Rooms</h3>
        </div>
      </div>
      <livewire:available-rooms />
    </div>
  </div>

  <!-- Card 3 - Occupied Rooms -->
  <div class="card border border-purple-100 bg-gradient-to-br from-purple-50 to-white
              transition-all duration-300 ease-in-out
              hover:shadow-lg hover:-translate-y-1 hover:border-purple-500
              hover:bg-gradient-to-br hover:from-purple-100 hover:to-white
              group">
    <div class="card-body p-5">
      <div class="flex items-center gap-4">
        <div class="p-3 rounded-lg bg-purple-100 text-purple-600
                   group-hover:bg-purple-600 group-hover:text-white
                   transition-colors duration-300">
          <i data-lucide="book-open-check"></i>
        </div>
        <div>
          <h3 class="text-lg font-semibold group-hover:text-purple-800 transition-colors">Occupied Rooms</h3>
        </div>
      </div>
      <livewire:occupied-rooms />
    </div>
  </div>

  <!-- Card 4 - Channels Booking -->
  <div class="card border border-amber-100 bg-gradient-to-br from-amber-50 to-white
              transition-all duration-300 ease-in-out
              hover:shadow-lg hover:-translate-y-1 hover:border-amber-500
              hover:bg-gradient-to-br hover:from-amber-100 hover:to-white
              group">
    <div class="card-body p-5">
      <div class="flex items-center gap-4">
        <div class="p-3 rounded-lg bg-amber-100 text-amber-600
                   group-hover:bg-amber-600 group-hover:text-white
                   transition-colors duration-300">
          <i data-lucide="square-arrow-out-up-right"></i>
        </div>
        <div>
          <h3 class="text-lg font-semibold group-hover:text-amber-800 transition-colors">Channels Booking</h3>
        </div>
      </div>
      <livewire:channels-booking />
    </div>
  </div>
</div>


            <div class="">
                <button onclick="view_room.showModal()" class="btn btn-primary btn-sm">
                  <i data-lucide="plus"></i>
                  View Available Rooms
                </button>
            </div>


@if(session('removed'))
   <div role="alert" class="alert alert-success mt-2">
  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
  </svg>
  <span>{{session('removed')}}</span>
</div>
@elseif(session('cancel'))
 <div role="alert" class="alert alert-success mt-2">
  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
  </svg>
  <span>{{session('cancel')}}</span>
</div>
@elseif(session('checkin'))
<div role="alert" class="alert alert-success mt-2">
  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
  </svg>
  <span>{{session('checkin')}}</span>
</div>
@elseif(session('checkout'))
<div role="alert" class="alert alert-success mt-2">
  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
  </svg>
  <span>{{session('checkout')}}</span>
</div>
@elseif(session('confirm'))
<div role="alert" class="alert alert-success mt-2">
  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
  </svg>
  <span>{{session('confirm')}}</span>
</div>

@endif



        <div class="flex w-full gap-2">
            <div class="w-1/2">
             <livewire:approve-reserve />
            </div>

      <div class="w-1/2">
    <!-- Hotel POS System -->
    <div class="bg-white rounded-lg shadow-md p-6 h-full flex flex-col ">
        <!-- POS Header -->
        <div class="border-b pb-4 mb-4">
            <h2 class="text-2xl font-bold text-gray-800">Hotel POS</h2>
            <div class="flex justify-between items-center mt-2">
                <span class="text-sm text-gray-500">Transaction #: {{ strtoupper(uniqid()) }}</span>
                <span class="text-sm font-medium">{{ now()->format('M d, Y h:i A') }}</span>
            </div>
        </div>

        <!-- Room Selection and Pricing -->
        <div class="mb-6 flex-1 overflow-y-auto">
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Room Type</label>
                    <select class="w-full p-2 border border-gray-300 rounded-md">
                        <option value="">Select Room</option>
                        <option value="deluxe">Deluxe Room (₱3,500)</option>
                        <option value="executive">Executive Suite (₱5,000)</option>
                        <option value="presidential">Presidential Suite (₱8,000)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nights</label>
                    <input type="number" min="1" value="1" class="w-full p-2 border border-gray-300 rounded-md">
                </div>
            </div>

            <!-- Additional Services -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Additional Services</label>
                <div class="space-y-2">
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" class="rounded text-blue-600">
                        <span>Breakfast Buffet (₱350)</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" class="rounded text-blue-600">
                        <span>Airport Transfer (₱800)</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" class="rounded text-blue-600">
                        <span>Spa Package (₱1,200)</span>
                    </label>
                </div>
            </div>

            <!-- Current Order Summary -->
            <div class="border-t pt-4">
                <h3 class="font-medium text-gray-700 mb-2">Order Summary</h3>
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span>Deluxe Room x 2 nights</span>
                        <span>₱7,000.00</span>
                    </div>
                    <div class="flex justify-between text-sm text-gray-600">
                        <span>Breakfast Buffet</span>
                        <span>₱350.00</span>
                    </div>
                    <div class="border-t mt-2 pt-2 font-medium">
                        <div class="flex justify-between">
                            <span>Subtotal</span>
                            <span>₱7,350.00</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span>Tax (12%)</span>
                            <span>₱882.00</span>
                        </div>
                        <div class="flex justify-between text-lg font-bold mt-1">
                            <span>Total</span>
                            <span>₱8,232.00</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Actions -->
        <div class="border-t pt-4">
            <div class="grid grid-cols-2 gap-3">
                <button class="bg-gray-200 hover:bg-gray-300 text-gray-800 py-2 px-4 rounded-md transition">
                    Cancel
                </button>
                <button class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-md transition flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                    </svg>
                    Process Payment
                </button>
            </div>
            <button class="w-full mt-3 bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-md transition flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5 4v3H4a2 2 0 00-2 2v3a2 2 0 002 2h1v2a2 2 0 002 2h6a2 2 0 002-2v-2h1a2 2 0 002-2V9a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H7a2 2 0 00-2 2zm8 0H7v3h6V4zm0 8H7v4h6v-4z" clip-rule="evenodd" />
                </svg>
                Print Receipt
            </button>
        </div>
    </div>
</div>


        </div>

            


            



  

          {{-- content --}}
            </section>


{{-- modals --}}
@foreach($reserverooms as $reserveroom)
@include('admin.components.frontdesk.viewreserve')
@include('admin.components.frontdesk.delete')
@include('admin.components.frontdesk.confirm')
@include('admin.components.frontdesk.checkin')
@include('admin.components.frontdesk.checkout')
@include('admin.components.frontdesk.cancel')
@endforeach
 

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


  <script src="{{asset('javascript/photouploadglobal.js')}}"></script>
  
</html>