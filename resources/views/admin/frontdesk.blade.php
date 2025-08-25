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
            <h1 class="text-2xl font-bold bg-white bg-clip-text text-[#191970]">Front Desk And Reception</h1>
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


             <livewire:approve-reserve />


            



  

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

  @endauth


  <script src="{{asset('javascript/photouploadglobal.js')}}"></script>
  
</html>