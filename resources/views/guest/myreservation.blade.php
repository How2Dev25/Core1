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
<div class="card bg-base-100 border border-gray-200 rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden max-w-md mx-auto">
  <!-- Room Image - Made larger -->
  <figure class="relative h-56 overflow-hidden">
    <img src="{{$reserveroom->roomphoto}}" alt="Room Photo" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
    <div class="absolute top-4 right-4">
      <div class="badge badge-primary badge-lg py-2 px-3 text-white font-semibold border-0 shadow-sm">
        {{$reserveroom->roomtype}}
      </div>
    </div>
  </figure>

  <!-- Card Body -->
 <div class="card-body p-5">
    <!-- Title and ID -->
    <div class="flex justify-between items-start mb-3">
      <h3 class="card-title text-lg font-bold text-gray-800">Room {{$reserveroom->roomID}}</h3>
      <span class="text-xs font-medium text-gray-500">#{{$reserveroom->bookingID}}</span>
    </div>

    <!-- Status and Dates -->
    <div class="space-y-3 mb-4">
      <!-- Status Badge -->
      <div class="flex items-center">
        <span class="text-xs font-medium text-gray-600 mr-2">Status:</span>
        <span class="badge badge-sm font-semibold py-1 px-2 
          {{$reserveroom->reservation_bookingstatus == 'Confirmed' ? 'badge-success' : ''}}
          {{$reserveroom->reservation_bookingstatus == 'Pending' ? 'badge-default' : ''}}
          {{$reserveroom->reservation_bookingstatus == 'Cancelled' ? 'badge-error' : ''}}">
          {{$reserveroom->reservation_bookingstatus}}
        </span>
      </div>
      
      <!-- Dates -->
      <div class="grid grid-cols-2 gap-2 text-xs">
        <div class="flex items-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
          </svg>
          <p class="text-gray-800 font-medium">
            {{ \Carbon\Carbon::parse($reserveroom->reservation_checkin)->format('M j, Y') }}
          </p>
        </div>

        <div class="flex items-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
          </svg>
          <p class="text-gray-800 font-medium">
            {{ \Carbon\Carbon::parse($reserveroom->reservation_checkout)->format('M j, Y') }}
          </p>
        </div>
      </div>
    </div>

    <!-- Payment + Price + VAT + Remaining Days -->
  <!-- Payment + Price + VAT + Nights + Total -->
<div class="bg-gray-50 rounded-lg p-3 mb-4 space-y-2">
  <!-- Payment -->
  <div class="flex items-center">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
    </svg>
    <span class="text-xs font-medium text-gray-700">Payment Method: {{$reserveroom->payment_method}}</span>
  </div>

  <!-- Price -->
  <div class="flex items-center justify-between text-xs">
    <span class="text-gray-600">Room Price (per night):</span>
    <span class="font-semibold text-gray-800">₱{{ number_format($reserveroom->roomprice, 2) }}</span>
  </div>

  <!-- Nights -->
  @php
    $nights = \Carbon\Carbon::parse($reserveroom->reservation_checkin)->diffInDays(\Carbon\Carbon::parse($reserveroom->reservation_checkout));
  @endphp
  <div class="flex items-center justify-between text-xs">
    <span class="text-gray-600">Nights:</span>
    <span class="font-semibold text-gray-800">{{ $nights }}</span>
  </div>

  <!-- VAT (12%) -->
  @php
    $subtotal = $reserveroom->roomprice * $nights;
    $vat = $subtotal * 0.12;
    $total = $subtotal + $vat;
  @endphp
  <div class="flex items-center justify-between text-xs">
    <span class="text-gray-600">VAT (12%):</span>
    <span class="font-semibold text-gray-800">₱{{ number_format($vat, 2) }}</span>
  </div>

  <!-- Total -->
  <div class="flex items-center justify-between text-xs border-t pt-2">
    <span class="text-gray-700 font-semibold">Total:</span>
    <span class="font-bold text-gray-900">₱{{ number_format($total, 2) }}</span>
  </div>
</div>

    <!-- Action Buttons -->
    <div class="card-actions justify-end">
      <button onclick="document.getElementById('edit_reservation_{{$reserveroom->reservationID}}').showModal()" 
        class="btn btn-outline btn-xs gap-1">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
        </svg>
        Details
      </button>
      
      <button onclick="cancel_reservation_{{$reserveroom->reservationID}}.showModal()" 
        class="btn btn-outline btn-error btn-xs gap-1">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
        Cancel
      </button>
      
      <button onclick="confirm_reservation_{{$reserveroom->reservationID}}.showModal()" 
        class="btn btn-primary btn-xs gap-1">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        Confirm
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