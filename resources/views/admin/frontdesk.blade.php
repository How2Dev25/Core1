<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  @vite('resources/css/app.css')



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
            {{-- greetings --}}
            @include('admin.components.dashboard.welcome')
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10 mt-5">

              <!-- Card 1 - Total Reservation -->
              <div class="card shadow-md 
                                               transition-all duration-300 ease-in-out
                                           hover:shadow-2xl hover:-translate-y-1
                                                group rounded-2xl">
                <div class="card-body p-5">
                  <div class="flex items-center gap-4">
                    <div class="p-3 rounded-xl bg-blue-900 text-yellow-400 group-hover:text-white
                                            transition-colors duration-300 shadow-md">
                      <i class="fa-solid fa-book text-xl"></i>
                    </div>
                    <div>
                      <h3 class="text-lg font-semibold text-gray-800 ">
                        Total Reservation
                      </h3>
                    </div>
                  </div>
                  <livewire:total-reservation />
                </div>
              </div>

              <!-- Card 2 - Available Rooms -->
              <div class="card shadow-md
                                                transition-all duration-300 ease-in-out
                                                 hover:shadow-2xl hover:-translate-y-1 hover:from-orange-100 hover:to-blue-100
                                                   group rounded-2xl">
                <div class="card-body p-5">
                  <div class="flex items-center gap-4">
                    <div class="p-3 rounded-xl bg-blue-900 text-yellow-400
                                                            group-hover:text-white
                                                            transition-colors duration-300 shadow-md">
                      <i class="fa-solid fa-bed text-xl"></i>
                    </div>
                    <div>
                      <h3 class="text-lg font-semibold text-gray-800 ">
                        Available Rooms
                      </h3>
                    </div>
                  </div>
                  <livewire:available-rooms />
                </div>
              </div>

              <!-- Card 3 - Occupied Rooms -->
              <div class="card shadow-md
                                                      transition-all duration-300 ease-in-out
                                                       hover:shadow-2xl hover:-translate-y-1 hover:from-blue-100 hover:to-orange-100
                                                     group rounded-2xl">
                <div class="card-body p-5">
                  <div class="flex items-center gap-4">
                    <div class="p-3 rounded-xl bg-blue-900 text-yellow-400
                                                              group-hover:text-white
                                                              transition-colors duration-300 shadow-md">
                      <i class="fa-solid fa-door-closed text-xl"></i>
                    </div>
                    <div>
                      <h3 class="text-lg font-semibold text-gray-800 ">
                        Occupied Rooms
                      </h3>
                    </div>
                  </div>
                  <livewire:occupied-rooms />
                </div>
              </div>

              <!-- Card 4 - Channels Booking -->
              <div class="card shadow-md
                                 transition-all duration-300 ease-in-out
                                 hover:shadow-2xl hover:-translate-y-1 hover:from-orange-100 hover:to-blue-100
                               group rounded-2xl">
                <div class="card-body p-5">
                  <div class="flex items-center gap-4">
                    <div class="p-3 rounded-xl bg-blue-900 text-yellow-400
                                    group-hover:text-white
                                   transition-colors duration-300 shadow-md">
                      <i class="fa-solid fa-arrow-up-right-from-square text-xl"></i>
                    </div>
                    <div>
                      <h3 class="text-lg font-semibold text-gray-800 ">
                        Channels Booking
                      </h3>
                    </div>
                  </div>
                  <livewire:channels-booking />
                </div>
              </div>

            </div>


            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8 mt-5">

              <!-- Total Reservations -->
              <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
                <div class="flex items-center justify-between">
                  <div>
                    <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Total Event
                      Reservations</h3>
                    <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totaleventreservation }}</p>

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
                    <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Events Confirmed</h3>
                    <p class="text-3xl font-bold text-gray-800 mt-2">{{ $confirmedeventreservation }}</p>

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
                    <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Events Pending</h3>
                    <p class="text-3xl font-bold text-gray-800 mt-2">{{ $pendingeventreservation }}</p>

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
                    <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Events Cancelled</h3>
                    <p class="text-3xl font-bold text-gray-800 mt-2">{{  $cancelledeventreservation }}</p>

                  </div>
                  <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
                    <i class="fa-solid fa-circle-xmark text-yellow-400 text-2xl"></i>
                  </div>
                </div>
              </div>

            </div>



            <div class="grid grid-cols-4 max-md:grid-cols-2 gap-5 items-center">
              <button onclick="view_room.showModal()"
                class="flex items-center gap-2 px-4 py-2.5 bg-gradient-to-r from-blue-800 to-blue-900 hover:from-blue-900 hover:to-blue-950 text-white rounded-lg shadow-md transition-all duration-200 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-700 focus:ring-opacity-50">
                <i class="fa-solid fa-door-open text-sm"></i>
                <span class="font-medium">Available Rooms</span>
              </button>

              <button onclick="view_bookingcalendar.showModal()"
                class="flex items-center gap-2 px-4 py-2.5 bg-gradient-to-r from-blue-800 to-blue-900 hover:from-blue-900 hover:to-blue-950 text-white rounded-lg shadow-md transition-all duration-200 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-700 focus:ring-opacity-50">
                <i class="fa-solid fa-calendar-alt text-sm"></i>
                <span class="font-medium">Booking Calendar</span>
              </button>

              <button onclick="view_eventbookingcalendar.showModal()"
                class="flex items-center gap-2 px-4 py-2.5 bg-gradient-to-r from-blue-800 to-blue-900 hover:from-blue-900 hover:to-blue-950 text-white rounded-lg shadow-md transition-all duration-200 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-700 focus:ring-opacity-50">
                <i class="fa-solid fa-calendar-alt text-sm"></i>
                <span class="font-medium">Event Calendar</span>
              </button>

              <button onclick="view_inventory.showModal()"
                class="flex items-center gap-2 px-4 py-2.5 bg-gradient-to-r from-blue-800 to-blue-900 hover:from-blue-900 hover:to-blue-950 text-white rounded-lg shadow-md transition-all duration-200 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-700 focus:ring-opacity-50">
              <i class="fa-solid fa-boxes-stacked text-sm"></i>
                <span class="font-medium">Inventory</span>
              </button>
            </div>



            @if(session('removed'))
              <div role="alert" class="alert alert-success mt-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                  viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{session('removed')}}</span>
              </div>
            @elseif(session('cancel'))
              <div role="alert" class="alert alert-success mt-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                  viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{session('cancel')}}</span>
              </div>
            @elseif(session('checkin'))
              <div role="alert" class="alert alert-success mt-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                  viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{session('checkin')}}</span>
              </div>
            @elseif(session('checkout'))
              <div role="alert" class="alert alert-success mt-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                  viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{session('checkout')}}</span>
              </div>
            @elseif(session('confirm'))
              <div role="alert" class="alert alert-success mt-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                  viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{session('confirm')}}</span>
              </div>

            @endif

            <div class="flex flex-col gap-5 w-full">
              <div class="w-full">
                <livewire:approve-reserve />
              </div>
              <div class="w-full">
                  <livewire:event-reservations />
              </div>

              <div class="w-full">
                @include('admin.components.frontdesk.additionalstable')
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

           @include('admin.components.frontdesk.viewroom')
          @include('admin.components.frontdesk.viewinventory')
          @include('admin.components.frontdesk.viewbookingcalendar')
          @include('admin.components.frontdesk.vieweventcalendar')


          @foreach ($additionalBooking as $booking)
              @include('admin.components.frontdesk.addonremove')
              @include('admin.components.frontdesk.addonpaid')
          @endforeach


        </main>
      </div>
    </div>


    {{-- modals --}}




    @livewireScripts
    @include('javascriptfix.soliera_js')
  </body>

@endauth


<script src="{{asset('javascript/photouploadglobal.js')}}"></script>

</html>