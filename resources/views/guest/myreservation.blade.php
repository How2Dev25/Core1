<!DOCTYPE html>
<html lang="en" data-theme ="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    @vite('resources/css/app.css')
 
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <title>{{$title}} - My Reservation</title>
      @livewireStyles
</head>
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
            <h1 class="text-2xl font-bold bg-white bg-clip-text text-[#191970]">My Reservation</h1>
          </div>
            {{-- Subsystem Name --}}

            <section class="p-5">



     <div class="container mx-auto px-4 py-8">
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    
    <!-- Card 1 -->
    @forelse ($reserverooms as $reserveroom)
<div class="card bg-white border border-gray-200 rounded-2xl hover:shadow-lg transition duration-300 overflow-hidden">
  <!-- Room Image -->
  <figure class="relative h-48">
    <img src="{{$reserveroom->roomphoto}}" alt="Room Photo" class="w-full h-full object-cover">
    <div class="absolute top-4 right-4">
      <span class="badge badge-primary">  {{$reserveroom->roomtype}}</span>
    </div>
  </figure>

  <!-- Card Body -->
  <div class="card-body p-5">
    <!-- Title -->
    <h4 class="card-title text-xl font-semibold mb-2">Room {{$reserveroom->roomID}}</h4>

    <!-- Receipt Number -->
    <div class="flex items-center text-sm text-gray-700 mb-3">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
              d="M9 12h6m2 0a2 2 0 01-2 2H9a2 2 0 
                 01-2-2V6a2 2 0 
                 012-2h6a2 2 0 012 2v6zM9 16h6" />
      </svg>
      Receipt No: <span class="ml-1 font-medium">{{$reserveroom->reservation_receipt}}</span>
    </div>

    <!-- Booking Status -->
    <div class="flex items-center text-sm text-gray-700 mb-3">
     
    Booking Status:  <span class="font-bold"> {{$reserveroom->reservation_bookingstatus}} </span>
      <span class="ml-1 font-semibold 
        @if($reserveroom->reservation_status == 'Confirmed') text-green-600 
        @elseif($reserveroom->reservation_status == 'Pending') text-yellow-600 
        @elseif($reserveroom->reservation_status == 'Cancelled') text-red-600 
        @else text-gray-600 @endif">
        {{$reserveroom->reservation_status}}
      </span>
    </div>

    <!-- Check-in Date -->
    <div class="flex items-center text-sm text-gray-500 mb-2">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 
                 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
      </svg>
      <span class="font-medium">Check-in:</span>
      <span class="ml-1">
        {{ \Carbon\Carbon::parse($reserveroom->reservation_checkin)->format('F j, Y') }}
      </span>
    </div>

    <!-- Check-out Date -->
    <div class="flex items-center text-sm text-gray-500 mb-4">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 
                 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
      </svg>
      <span class="font-medium">Check-out:</span>
      <span class="ml-1">
        {{ \Carbon\Carbon::parse($reserveroom->reservation_checkout)->format('F j, Y') }}
      </span>
    </div>

    <!-- Buttons -->
    <div class="flex flex-wrap justify-end gap-3">
      <button onclick="document.getElementById('edit_reservation_{{$reserveroom->reservationID}}').showModal()"  class="btn btn-sm bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition">
        View Details
      </button>
      <button onclick="cancel_reservation_{{$reserveroom->reservationID}}.showModal()" class="btn btn-sm btn-error">
        Cancel Reservation
      </button>
      <button onclick="confirm_reservation_{{$reserveroom->reservationID}}.showModal()" class="btn-primary btn btn-sm transition">
        Confirm Reservation
      </button>
    </div>
  </div>
</div>

    @empty
        
    @endforelse
  

    <!-- Duplicate cards -->
  

    <!-- Add more cards if needed -->
  </div>
</div>

           


            



  

          {{-- content --}}
</section>


{{-- modals --}}



<!-- Initialize Lucide Icons -->
<script>
  lucide.createIcons();
</script>

        


           
      
 
        </main>
      </div>
    </div>

   
    {{-- modals --}}

 
    @foreach($reserverooms as $reserveroom)
@include('admin.components.frontdesk.viewreserve')
@include('admin.components.frontdesk.delete')
@include('admin.components.frontdesk.confirm')
@include('admin.components.frontdesk.checkin')
@include('admin.components.frontdesk.checkout')
@include('admin.components.frontdesk.cancel')
@endforeach
    
   
   @livewireScripts
  @include('javascriptfix.soliera_js')
  </body>


  <script src="{{asset('javascript/photouploadglobal.js')}}"></script>
  
</html>