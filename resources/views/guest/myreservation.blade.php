<!DOCTYPE html>
<html lang="en" data-theme ="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite('resources/css/app.css')
 
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <title>{{$title}} - My Reservation</title>
      @livewireStyles
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
            <h1 class="text-2xl font-bold bg-white bg-clip-text text-[#191970]">My Reservation</h1>
          </div>
            {{-- Subsystem Name --}}

            <section class="p-5">


               <div class="container mx-auto px-4 py-8">

    <!-- === Reservation Stats Cards (Static) === -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

  <!-- Total Reservations -->
  <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
    <div class="flex items-center justify-between">
      <div>
        <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Total Reservations</h3>
        <p class="text-3xl font-bold text-gray-800 mt-2">{{$totalreservation}}</p>
       
      </div>
      <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
        <i class="fa-solid fa-bed text-yellow-400 text-2xl"></i>
      </div>
    </div>
  </div>

  <!-- Confirmed -->
  <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
    <div class="flex items-center justify-between">
      <div>
        <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Confirmed</h3>
        <p class="text-3xl font-bold text-gray-800 mt-2">{{$approvereservation}}</p>
        
      </div>
      <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
        <i class="fa-solid fa-circle-check text-yellow-400 text-2xl"></i>
      </div>
    </div>
  </div>

  <!-- Pending -->
  <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
    <div class="flex items-center justify-between">
      <div>
        <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Pending</h3>
        <p class="text-3xl font-bold text-gray-800 mt-2">{{$pendingreservation}}</p>
        
      </div>
      <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
        <i class="fa-solid fa-clock text-yellow-400 text-2xl"></i>
      </div>
    </div>
  </div>

  <!-- Cancelled -->
  <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
    <div class="flex items-center justify-between">
      <div>
        <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Cancelled</h3>
        <p class="text-3xl font-bold text-gray-800 mt-2">{{$cancelledreservation}}</p>
       
      </div>
      <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
        <i class="fa-solid fa-circle-xmark text-yellow-400 text-2xl"></i>
      </div>
    </div>
  </div>

</div>




     <div class="container mx-auto px-4 py-8">
<div class="grid grid-cols-1 xl:grid-cols-2 2xl:grid-cols-3 gap-8">

    @forelse ($reserverooms as $reserveroom)
    <div class="bg-white border border-gray-100 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden group">
      <!-- Room Image Header -->
      <div class="relative h-48 overflow-hidden bg-gradient-to-br from-[#001f54] to-[#003875]">
        <img src="{{$reserveroom->roomphoto}}" alt="Room Photo" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110 opacity-90">
        <div class="absolute inset-0 bg-gradient-to-t from-[#001f54]/60 via-transparent to-transparent"></div>
        <div class="absolute top-4 right-4">
          <div class="bg-[#F7B32B] text-[#001f54] px-4 py-2 rounded-full text-sm font-bold shadow-lg">
            {{$reserveroom->roomtype}}
          </div>
        </div>
        <div class="absolute bottom-4 left-4">
          <h3 class="text-white text-2xl font-bold">Room {{$reserveroom->roomID}}</h3>
          <p class="text-gray-200 text-sm">#{{$reserveroom->bookingID}}</p>
        </div>
      </div>

      <!-- Card Body -->
      <div class="p-6">
        <!-- Status Section -->
        <div class="flex items-center justify-between mb-6">
          <div class="flex items-center space-x-2">
            <span class="text-sm font-medium text-gray-600">Status:</span>
            <span class="px-3 py-1 rounded-full text-sm font-semibold
              {{$reserveroom->reservation_bookingstatus == 'Confirmed' ? 'bg-green-100 text-green-700 border border-green-200' : ''}}
              {{$reserveroom->reservation_bookingstatus == 'Pending' ? 'bg-yellow-100 text-yellow-700 border border-yellow-200' : ''}}
              {{$reserveroom->reservation_bookingstatus == 'Cancelled' ? 'bg-red-100 text-red-700 border border-red-200' : ''}}">
              {{$reserveroom->reservation_bookingstatus}}
            </span>
          </div>
        </div>
        
        <!-- Dates Grid -->
        <div class="grid grid-cols-2 gap-4 mb-6">
          <div class="bg-gray-50 rounded-xl p-4">
            <div class="flex items-center mb-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-[#001f54]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
              </svg>
              <span class="text-xs font-medium text-gray-600 uppercase tracking-wide">Check-in</span>
            </div>
            <p class="text-[#001f54] font-bold text-lg">
              {{ \Carbon\Carbon::parse($reserveroom->reservation_checkin)->format('M j, Y') }}
            </p>
          </div>

          <div class="bg-gray-50 rounded-xl p-4">
            <div class="flex items-center mb-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-[#001f54]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
              </svg>
              <span class="text-xs font-medium text-gray-600 uppercase tracking-wide">Check-out</span>
            </div>
            <p class="text-[#001f54] font-bold text-lg">
              {{ \Carbon\Carbon::parse($reserveroom->reservation_checkout)->format('M j, Y') }}
            </p>
          </div>
        </div>

        <!-- Payment and Pricing Section -->
        <div class="bg-gradient-to-r from-[#001f54] to-[#003875] rounded-xl p-5 mb-6 text-white">
          <!-- Payment Method -->
          <div class="flex items-center mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-[#F7B32B]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
            </svg>
            <span class="text-sm font-medium opacity-90">Payment Method:</span>
            <span class="ml-2 font-semibold">{{$reserveroom->payment_method}}</span>
          </div>

          <!-- Pricing Grid -->
          @php
            $nights = \Carbon\Carbon::parse($reserveroom->reservation_checkin)->diffInDays(\Carbon\Carbon::parse($reserveroom->reservation_checkout));
            $subtotal = $reserveroom->roomprice * $nights;
            $vat = $subtotal * 0.12;
            $serviceFee = $subtotal * 0.02;
            $total = $subtotal + $vat + $serviceFee;
            $bookedDate = date('M d, Y', strtotime($reserveroom->reservation_created_at));
          @endphp

          <div class="space-y-3">
            <div class="flex justify-between items-center">
              <span class="text-sm opacity-90">Room Price (per night):</span>
              <span class="font-bold text-[#F7B32B]">₱{{ number_format($reserveroom->roomprice, 2) }}</span>
            </div>

            <div class="flex justify-between items-center">
              <span class="text-sm opacity-90">Nights:</span>
              <span class="font-semibold">{{ $nights }}</span>
            </div>

            <div class="border-t border-white/20 pt-3 space-y-2">
              <div class="flex justify-between items-center text-sm">
                <span class="opacity-90">Subtotal:</span>
                <span class="font-semibold">₱{{ number_format($subtotal, 2) }}</span>
              </div>

              <div class="flex justify-between items-center text-sm">
                <span class="opacity-90">VAT (12%):</span>
                <span class="font-semibold">₱{{ number_format($vat, 2) }}</span>
              </div>

              <div class="flex justify-between items-center text-sm">
                <span class="opacity-90">Service Fee (2%):</span>
                <span class="font-semibold">₱{{ number_format($serviceFee, 2) }}</span>
              </div>
            </div>

            <div class="border-t border-[#F7B32B]/30 pt-3">
              <div class="flex justify-between items-center">
                <span class="font-semibold text-lg">Total:</span>
                <span class="font-bold text-xl text-[#F7B32B]">₱{{ number_format($total, 2) }}</span>
              </div>
            </div>

            <div class="flex justify-between items-center text-sm pt-2 border-t border-white/10">
              <span class="opacity-90">Date Booked:</span>
              <span class="font-medium">{{ $bookedDate }}</span>
            </div>
          </div>
        </div>

        <!-- Action Buttons -->
        <!-- Action Buttons -->
<div class="flex flex-wrap gap-3">
  <!-- Details: always visible -->
  <button onclick="document.getElementById('edit_reservation_{{$reserveroom->reservationID}}').showModal()" 
    class="flex-1 bg-gray-100 hover:bg-gray-200 text-[#001f54] px-4 py-2.5 rounded-xl font-medium transition-colors duration-200 flex items-center justify-center gap-2">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
    </svg>
    Details
  </button>

  <!-- Cancel: only if Pending -->
  @if($reserveroom->reservation_bookingstatus == 'Pending')
    <button onclick="cancel_reservation_{{$reserveroom->reservationID}}.showModal()" 
      class="flex-1 bg-red-50 hover:bg-red-100 text-red-700 px-4 py-2.5 rounded-xl font-medium transition-colors duration-200 flex items-center justify-center gap-2 border border-red-200">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
      </svg>
      Cancel
    </button>
  @endif

  <!-- Confirm: only if Pending -->
  @if($reserveroom->reservation_bookingstatus == 'Pending')
    <button onclick="confirm_reservation_{{$reserveroom->reservationID}}.showModal()" 
      class="flex-1 bg-[#F7B32B] hover:bg-[#e6a429] text-[#001f54] px-3 py-2 rounded-lg text-sm font-bold transition-colors duration-200 flex items-center justify-center gap-1 shadow-md">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
      </svg>
      Confirm
    </button>
  @endif
</div>
      </div>
    </div>
    @empty
      <div class="col-span-full">
        <div class="p-12 bg-gradient-to-br from-gray-50 to-gray-100 border-2 border-dashed border-gray-300 rounded-2xl text-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto mb-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
          </svg>
          <h3 class="text-xl font-semibold text-gray-700 mb-2">No Reservations Found</h3>
          <p class="text-gray-500">There are currently no reservations to display.</p>
        </div>
      </div>
    @endforelse

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




  @endauth
  </body>


 
  
</html>