<!DOCTYPE html>
<html lang="en" data-theme="light">

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
          <section class="w-full min-h-screen p-5 ">
            {{-- greetings --}}
            @include('admin.components.dashboard.welcome')

            {{-- cards --}}
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 max-w-6xl mx-auto">

            <!-- Card 1: Active Promotions -->
            <div class="card border-2 border-blue-900/20 bg-white
                transition-all duration-300 ease-in-out
                hover:shadow-xl hover:-translate-y-2 hover:border-yellow-400
                hover:bg-gradient-to-br hover:from-yellow-50 hover:to-white
                group">
              <div class="card-body p-4">
                <div class="flex items-center gap-3 mb-3">
                  <div class="p-3 rounded-xl bg-blue-900 text-yellow-400
                     group-hover:bg-yellow-400 group-hover:text-blue-900
                     transition-all duration-300 shadow-lg">
                    <i class='bx bx-badge-check text-2xl'></i>
                  </div>
                  <div>
                    <h3 class="text-base font-bold text-blue-900">Active Promotions</h3>
                    <p class="text-xs text-blue-900/60">Ongoing campaigns</p>
                  </div>
                </div>
                <p class="text-3xl font-bold text-blue-900 mb-2">{{$totalpromotions ?? 0}}</p>
                
              </div>
            </div>

            <!-- Card 2: Total Bookings -->
            <div class="card border-2 border-blue-900/20 bg-white
                transition-all duration-300 ease-in-out
                hover:shadow-xl hover:-translate-y-2 hover:border-yellow-400
                hover:bg-gradient-to-br hover:from-yellow-50 hover:to-white
                group">
              <div class="card-body p-4">
                <div class="flex items-center gap-3 mb-3">
                  <div class="p-3 rounded-xl bg-blue-900 text-yellow-400
                     group-hover:bg-yellow-400 group-hover:text-blue-900 transition-all duration-300 shadow-lg">
                    <i class='bx bx-calendar-check text-2xl'></i>
                  </div>
                  <div>
                    <h3 class="text-base font-bold text-blue-900">Total Bookings</h3>
                   
                  </div>
                </div>
                <p class="text-3xl font-bold text-blue-900 mb-2">{{$totalreservations ?? 0}}</p>
                
              </div>
            </div>

            <!-- Card 3: Customer Engagement -->
           

            <!-- Card 4: Total Revenue (Rooms) -->
            <div class="card border-2 border-blue-900/20 bg-white
                transition-all duration-300 ease-in-out
                hover:shadow-xl hover:-translate-y-2 hover:border-yellow-400
                hover:bg-gradient-to-br hover:from-yellow-50 hover:to-white
                group">
              <div class="card-body p-4">
                <div class="flex items-center gap-3 mb-3">
                  <div class="p-3 rounded-xl bg-blue-900 text-yellow-400
                     group-hover:bg-yellow-400 group-hover:text-blue-900 shadow-lg transition-all">
                    <i class='bx bx-hotel text-2xl'></i>
                  </div>
                  <div>
                    <h3 class="text-base font-bold text-blue-900">Total Revenue</h3>
                    <p class="text-xs text-blue-900/60">Total earnings</p>
                  </div>
                </div>
                <p class="text-3xl font-bold text-blue-900 mb-2">₱ {{$totalRevenue ?? 0}}</p>
             
              </div>
            </div>

      

          </div>



                @include('admin.components.hmp.carousel')




            <div class="mt-10 w-full">
              {{-- table section --}}
              <div class="lg:col-span-2 bg-white p-6 rounded-xl  ">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                  <h2 class="text-2xl font-bold text-blue-900">Marketing And Promotions Management</h2>
                  <div class="flex gap-3 w-full sm:w-auto">
                    <div class="relative flex-grow sm:flex-grow-0 sm:w-64">
                      <label
                        class="input input-bordered border-2 border-blue-900/20 focus-within:border-yellow-400 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                          class="w-4 h-4 text-blue-900/60">
                          <path fill-rule="evenodd"
                            d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                            clip-rule="evenodd" />
                        </svg>
                        {{-- search --}}
                        <form action="/searchhmp" method="GET">
                          @csrf
                          <input name="searchhmp" type="text" class="grow" placeholder="Search promotions" />
                        </form>
                      </label>
                    </div>
                    <button onclick="createhmp.showModal()"
                      class="btn bg-yellow-400 text-blue-900 border-none hover:bg-yellow-500 hover:scale-105 transition-all font-bold shadow-md">
                      <i class='bx bx-plus text-xl'></i>
                      Add
                    </button>
                  </div>
                </div>

                {{-- create modal --}}
                @include('admin.components.hmp.createhmp')
                {{-- --}}

                <div class="overflow-x-auto">
                  <table class="table">
                    @include('admin.components.hmp.alerts')

                    <thead>
                      <tr class="bg-blue-900 text-yellow-400">
                        <th class="font-bold">#</th>
                        <th class="font-bold">Promo Name</th>
                        <th class="font-bold">Description</th>
                        <th class="font-bold">Status</th>
                        <th class="font-bold text-right">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <!-- row 1 -->
                      @forelse ($hmpdata as $hmp)
                        <tr class="hover:bg-yellow-50 transition-colors border-b border-blue-900/10">
                          <td class="font-semibold text-blue-900">{{$hmp->promoID}}</td>
                          <td>
                            <div class="font-bold text-blue-900">{{$hmp->hotelpromoname}}</div>
                            <div class="text-sm text-blue-900/60">{{$hmp->hotelpromotag}}</div>
                          </td>
                          <td class="max-w-xs truncate text-blue-900/80">{{$hmp->hotelpromodescription}}</td>
                          <td>
                            @if ($hmp->hotelpromostatus == 'Active')
                              <span
                                class="px-3 py-1 rounded-full bg-yellow-400 text-blue-900 text-xs font-bold inline-flex items-center gap-1">
                                <i class='bx bx-check-circle'></i> Active
                              </span>
                            @else
                              <span
                                class="px-3 py-1 rounded-full bg-blue-900 text-yellow-400 text-xs font-bold inline-flex items-center gap-1">
                                <i class='bx bx-x-circle'></i> Expired
                              </span>
                            @endif
                          </td>
                          <td>
                            <div class="flex justify-end gap-2">
                              <button onclick="edit_modal_{{$hmp->promoID}}.showModal()"
                                class="btn btn-sm bg-blue-900 text-yellow-400 border-none hover:bg-blue-800 hover:scale-105 transition-all">
                                <i class='bx bx-edit'></i>
                              </button>
                              <button onclick="delete_modal_{{ $hmp->promoID }}.showModal()"
                                class="btn btn-sm bg-yellow-400 text-blue-900 border-none hover:bg-yellow-500 hover:scale-105 transition-all">
                                <i class='bx bx-trash'></i>
                              </button>
                            </div>
                          </td>
                        </tr>

                      @empty
                        <tr>
                          <td colspan="6" class="text-center py-8">
                            <div class="flex flex-col items-center justify-center text-blue-900/40">
                              <div class="bg-yellow-400/20 p-6 rounded-full mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24"
                                  fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round" class="text-blue-900">
                                  <polyline points="22 12 16 12 14 15 10 15 8 12 2 12"></polyline>
                                  <path
                                    d="M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z">
                                  </path>
                                </svg>
                              </div>
                              <span class="mt-2 text-sm font-bold text-blue-900">No Data found</span>
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

              {{-- end recent promotions sidebar --}}
            </div>

            <div class="mt-10 mb-4 max-w-6xl mx-auto">
              <h1 class="font-bold text-3xl text-blue-900">Available Rooms</h1>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-5 max-w-6xl mx-auto">
              <!-- Room Cards -->
              @forelse($rooms as $room)
                <div
                  class="card bg-white border-2 border-blue-900/20 hover:shadow-xl hover:-translate-y-2 transition-all duration-300 overflow-hidden group">
                  <figure class="relative h-48">
                    <img src="{{asset($room->roomphoto)}}" alt="Room"
                      class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                    <div class="absolute top-4 right-4">
                      <span class="px-3 py-1.5 rounded-full text-xs font-bold shadow-lg
                            @if($room->roomtype == 'Standard') bg-blue-900 text-yellow-400
                            @elseif($room->roomtype == 'Deluxe') bg-yellow-400 text-blue-900
                            @elseif($room->roomtype == 'Suite') bg-blue-900 text-yellow-400
                            @elseif($room->roomtype == 'Executive') bg-yellow-400 text-blue-900
                            @endif">
                        {{ $room->roomtype }}
                      </span>
                    </div>
                  </figure>
                  <div class="card-body p-5">
                    <div class="flex justify-between items-start">
                      <div>
                        <p class="text-blue-900 font-bold text-xl">Room #{{$room->roomID}}</p>
                      </div>
                      <div class="text-right">
                        <p class="text-sm text-blue-900/60">From</p>
                        <p class="text-2xl font-bold text-yellow-400">₱{{$room->roomprice}}<span
                            class="text-sm text-blue-900">/night</span></p>
                      </div>
                    </div>

                    <div class="flex items-center gap-4 mt-3">
                      <div class="flex items-center text-sm text-blue-900/70">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                          stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        {{$room->roomprice}} sqft
                      </div>
                      <div class="flex items-center text-sm text-blue-900/70">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                          stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        {{$room->roommaxguest}} Guests
                      </div>
                    </div>

                    <div class="mt-4 flex justify-between items-center pt-3 border-t-2 border-blue-900/10">
                      <p class="text-sm text-blue-900 font-semibold">
                        {{$room->roomfeatures}}
                      </p>
                      <div class="flex gap-2">
                        <a href="/gotoroom/{{$room->roomID}}"
                          class="btn btn-sm btn-circle bg-yellow-400 text-blue-900 border-none hover:bg-yellow-500 hover:scale-110 transition-all">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                          </svg>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              @empty
                <div
                  class="col-span-full flex flex-col items-center justify-center py-16 bg-gradient-to-br from-blue-900/5 to-yellow-400/5 rounded-xl border-2 border-dashed border-blue-900/30">
                  <div class="bg-yellow-400/20 p-6 rounded-full mb-4">
                    <img src="{{ asset('images/defaults/default.jpg') }}" alt="No rooms"
                      class="w-32 h-32 object-cover rounded-full">
                  </div>
                  <h2 class="text-2xl font-bold text-blue-900 mb-2">No Rooms Yet!</h2>
                  <p class="text-blue-900/60">Start adding rooms to manage your inventory</p>
                </div>
              @endforelse
            </div>
          </section>



        </main>
      </div>
    </div>

    {{-- modals --}}
    @foreach ($hmpdata as $hmp)
      @include('admin.components.hmp.edithmp')
      @include('admin.components.hmp.deletehmp')
    @endforeach



  </body>

@endauth
@include('javascriptfix.soliera_js')

<script src="{{asset('javascript/photouploadglobal.js')}}"></script>

</html>