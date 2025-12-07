<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  @vite('resources/css/app.css')

   <title>{{$title}} - Booking And Reservation</title>
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
              <h1 class="text-2xl font-bold bg-white bg-clip-text text-[#191970]">Booking And Reservation</h1>
            </div>
            {{-- Subsystem Name --}}

            <section class="p-5">
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


              {{-- 
              <div class="">
                <a href="/reservationpage" class="btn btn-primary btn-sm">
                  <i class="fa-solid fa-plus"></i>
                  Create Booking
                </a>
              </div>
  --}}
              {{-- tables --}}

              {{-- alerts --}}

              @if(session('success'))
                <div role="alert" class="alert alert-success mt-2 mb-2">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  <span>{{session('success')}}</span>
                </div>
              @elseif(session('modified'))
                <div role="alert" class="alert alert-success mt-2 mb-2">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  <span>{{session('modified')}}</span>
                </div>
              @elseif(session('removed'))
                <div role="alert" class="alert alert-success mt-2 mb-2">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  <span>{{session('removed')}}</span>
                </div>
              @endif

              {{-- alerts --}}
              {{-- reservedrooms livewire --}}
              <livewire:reserved-rooms />
              {{-- reservedrooms livewire --}}









              {{-- content --}}
            </section>


            {{-- modals --}}
            @include('admin.components.bas.create')

            @foreach ($reserverooms as $reserveroom)
              @include('admin.components.bas.edit')
              @include('admin.components.bas.delete')
              @include('admin.components.bas.details')
            @endforeach








          </main>
        </div>
      </div>





      @livewireScripts
      @include('javascriptfix.soliera_js')
    </body>

@endauth


<script src="{{asset('javascript/photouploadglobal.js')}}"></>

</html >