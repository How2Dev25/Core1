<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  @vite('resources/css/app.css')

  <script src="https://unpkg.com/lucide@latest"></script>

  <title>{{$title}} - Channel Management</title>
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
            <h1 class="text-2xl font-bold bg-white bg-clip-text text-[#191970]">Channel Management Module</h1>
          </div>
          {{-- Subsystem Name --}}

          {{-- content --}}

          <section class="p-6  ">
            <!-- Header Section -->

            <!-- Channel Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
              <!-- TaraStay Card -->
              <div class="card bg-white border-2 border-blue-900/20
                      transition-all duration-300 ease-in-out
                      hover:shadow-2xl hover:-translate-y-2 hover:border-yellow-400
                      hover:bg-gradient-to-br hover:from-yellow-50 hover:to-white
                      group">
                <div class="card-body p-6">
                  <div class="flex items-center gap-3 mb-4">
                    <div class="avatar placeholder">
                      <img
                        class="w-12 h-12 rounded-lg shadow-md group-hover:shadow-xl transition-all border-2 border-blue-900/20"
                        src="{{asset('images/rbnb/tarastay.png')}}" alt="TaraStay">
                    </div>
                    <h3
                      class="card-title text-blue-900 font-bold group-hover:text-blue-900 transition-colors flex items-center gap-2">
                      <i data-lucide="home" class="w-5 h-5 text-blue-900"></i>
                      TaraStay
                    </h3>
                    <div class="ml-auto">
                      <span
                        class="px-3 py-1 rounded-full bg-yellow-400 text-blue-900 text-xs font-bold inline-flex items-center gap-1">
                        <i class="w-3 h-3" data-lucide="check"></i>
                        Connected
                      </span>
                    </div>
                  </div>
                  <p
                    class="text-sm text-blue-900/60 mb-4 group-hover:text-blue-900/80 transition-colors flex items-center gap-2">
                    <i data-lucide="clock" class="w-4 h-4"></i>
                    Last sync: 15 minutes ago
                  </p>
                  <div class="card-actions justify-between items-center">
                    <div class="flex gap-4">
                      <div class="bg-blue-900/5 group-hover:bg-yellow-400/20 transition-colors rounded-lg p-3">
                        <div class="text-xs text-blue-900/60 font-semibold flex items-center gap-1 mb-1">
                          <i data-lucide="list" class="w-3 h-3"></i>
                          Listings
                        </div>
                        <div class="text-xl font-bold text-blue-900">{{$tarastaylisting}}</div>
                      </div>
                      <div class="bg-blue-900/5 group-hover:bg-yellow-400/20 transition-colors rounded-lg p-3">
                        <div class="text-xs text-blue-900/60 font-semibold flex items-center gap-1 mb-1">
                          <i data-lucide="calendar-check" class="w-3 h-3"></i>
                          Bookings
                        </div>
                        <div class="text-xl font-bold text-blue-900">12</div>
                      </div>
                    </div>
                    <button
                      class="btn btn-sm btn-circle bg-blue-900 text-yellow-400 border-none hover:bg-yellow-400 hover:text-blue-900 transition-all hover:scale-110">
                      <i class="w-4 h-4" data-lucide="chevron-right"></i>
                    </button>
                  </div>
                </div>
              </div>

              <!-- HabiStay Card -->
              <div class="card bg-white border-2 border-blue-900/20
                      transition-all duration-300 ease-in-out
                      hover:shadow-2xl hover:-translate-y-2 hover:border-yellow-400
                      hover:bg-gradient-to-br hover:from-yellow-50 hover:to-white
                      group">
                <div class="card-body p-6">
                  <div class="flex items-center gap-3 mb-4">
                    <div class="avatar placeholder">
                      <img
                        class="w-12 h-12 rounded-lg shadow-md group-hover:shadow-xl transition-all border-2 border-blue-900/20"
                        src="{{asset('images/rbnb/habistay.png')}}" alt="HabiStay">
                    </div>
                    <h3
                      class="card-title text-blue-900 font-bold group-hover:text-blue-900 transition-colors flex items-center gap-2">
                      <i data-lucide="building-2" class="w-5 h-5 text-blue-900"></i>
                      HabiStay
                    </h3>
                    <div class="ml-auto">
                      <span
                        class="px-3 py-1 rounded-full bg-yellow-400 text-blue-900 text-xs font-bold inline-flex items-center gap-1">
                        <i class="w-3 h-3" data-lucide="check"></i>
                        Connected
                      </span>
                    </div>
                  </div>
                  <p
                    class="text-sm text-blue-900/60 mb-4 group-hover:text-blue-900/80 transition-colors flex items-center gap-2">
                    <i data-lucide="clock" class="w-4 h-4"></i>
                    Last sync: 1 hour ago
                  </p>
                  <div class="card-actions justify-between items-center">
                    <div class="flex gap-4">
                      <div class="bg-blue-900/5 group-hover:bg-yellow-400/20 transition-colors rounded-lg p-3">
                        <div class="text-xs text-blue-900/60 font-semibold flex items-center gap-1 mb-1">
                          <i data-lucide="list" class="w-3 h-3"></i>
                          Listings
                        </div>
                        <div class="text-xl font-bold text-blue-900">{{$habistaylisting}}</div>
                      </div>
                      <div class="bg-blue-900/5 group-hover:bg-yellow-400/20 transition-colors rounded-lg p-3">
                        <div class="text-xs text-blue-900/60 font-semibold flex items-center gap-1 mb-1">
                          <i data-lucide="calendar-check" class="w-3 h-3"></i>
                          Bookings
                        </div>
                        <div class="text-xl font-bold text-blue-900">8</div>
                      </div>
                    </div>
                    <button
                      class="btn btn-sm btn-circle bg-blue-900 text-yellow-400 border-none hover:bg-yellow-400 hover:text-blue-900 transition-all hover:scale-110">
                      <i class="w-4 h-4" data-lucide="chevron-right"></i>
                    </button>
                  </div>
                </div>
              </div>

              <!-- nestscape Card -->
              <div class="card bg-white border-2 border-blue-900/20
                      transition-all duration-300 ease-in-out
                      hover:shadow-2xl hover:-translate-y-2 hover:border-yellow-400
                      hover:bg-gradient-to-br hover:from-yellow-50 hover:to-white
                      group">
                <div class="card-body p-6">
                  <div class="flex items-center gap-3 mb-4">
                    <div class="avatar placeholder">
                      <img
                        class="w-12 h-12 rounded-lg shadow-md group-hover:shadow-xl transition-all border-2 border-blue-900/20"
                        src="{{asset('images/rbnb/nestscape.png')}}" alt="nestscape">
                    </div>
                    <h3
                      class="card-title text-blue-900 font-bold group-hover:text-blue-900 transition-colors flex items-center gap-2">
                      <i data-lucide="tree-pine" class="w-5 h-5 text-blue-900"></i>
                      nestscape
                    </h3>
                    <div class="ml-auto">
                      <span
                        class="px-3 py-1 rounded-full bg-yellow-400 text-blue-900 text-xs font-bold inline-flex items-center gap-1">
                        <i class="w-3 h-3" data-lucide="check"></i>
                        Connected
                      </span>
                    </div>
                  </div>
                  <p
                    class="text-sm text-blue-900/60 mb-4 group-hover:text-blue-900/80 transition-colors flex items-center gap-2">
                    <i data-lucide="clock" class="w-4 h-4"></i>
                    Last sync: 3 days ago
                  </p>
                  <div class="card-actions justify-between items-center">
                    <div class="flex gap-4">
                      <div class="bg-blue-900/5 group-hover:bg-yellow-400/20 transition-colors rounded-lg p-3">
                        <div class="text-xs text-blue-900/60 font-semibold flex items-center gap-1 mb-1">
                          <i data-lucide="list" class="w-3 h-3"></i>
                          Listings
                        </div>
                        <div class="text-xl font-bold text-blue-900">{{$nestscapelisting}}</div>
                      </div>
                      <div class="bg-blue-900/5 group-hover:bg-yellow-400/20 transition-colors rounded-lg p-3">
                        <div class="text-xs text-blue-900/60 font-semibold flex items-center gap-1 mb-1">
                          <i data-lucide="calendar-check" class="w-3 h-3"></i>
                          Bookings
                        </div>
                        <div class="text-xl font-bold text-blue-900">0</div>
                      </div>
                    </div>
                    <button
                      class="btn btn-sm btn-circle bg-blue-900 text-yellow-400 border-none hover:bg-yellow-400 hover:text-blue-900 transition-all hover:scale-110">
                      <i class="w-4 h-4" data-lucide="chevron-right"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Add New Channel Section -->
            <div class="mt-6 mb-6">
              <button onclick="add_listing.showModal()"
                class="btn bg-yellow-400 text-blue-900 border-none hover:bg-yellow-500 hover:scale-105 transition-all font-bold shadow-lg">
                <i data-lucide="circle-plus"></i>
                Add Room Listing
              </button>
            </div>

            <!-- Channel Sync Status Section -->
            <div class="overflow-x-auto bg-white rounded-xl shadow-lg border-2 border-blue-900/20 p-6">
              {{-- alerts --}}
              @if(session('RoomAdded'))
                <div role="alert" class="alert mb-4 bg-yellow-400 text-blue-900 border-none shadow-md">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  <span class="font-bold">{{session('RoomAdded')}}</span>
                </div>
              @elseif(session('RoomModify'))
                <div role="alert" class="alert mb-4 bg-yellow-400 text-blue-900 border-none shadow-md">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  <span class="font-bold">{{session('RoomModify')}}</span>
                </div>
              @elseif(session('RoomDelete'))
                <div role="alert" class="alert mb-4 bg-yellow-400 text-blue-900 border-none shadow-md">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  <span class="font-bold">{{session('RoomDelete')}}</span>
                </div>
              @endif

              <table class="table">
                <!-- head -->
                <thead class="bg-blue-900 text-yellow-400">
                  <tr>
                    <th class="font-bold">Listing ID</th>
                    <th class="font-bold">Channel Name</th>
                    <th class="font-bold">Room Name</th>
                    <th class="font-bold">Listing Status</th>
                    <th class="font-bold">Date Added</th>
                    <th class="font-bold">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- row 1 -->
                  @forelse ($channels as $channel)
                    <tr class="hover:bg-yellow-50 transition-colors border-b border-blue-900/10">
                      <td class="font-bold text-blue-900">{{$channel->channelID}}</td>
                      <td>
                        <div class="flex items-center gap-3">
                          <div class="avatar">
                            <div class="mask mask-squircle w-12 h-12 border-2 border-blue-900/20">
                              <img src="@if($channel->channelName == 'Tarastay') {{asset('images/rbnb/tarastay.png')}} 
                              @elseif($channel->channelName == 'Habistay') {{asset('images/rbnb/habistay.png')}}
                                  @else {{asset('images/rbnb/nestscape.png')}} @endif" alt="Channel Logo" />
                            </div>
                          </div>
                          <div>
                            <div class="font-bold text-blue-900">{{$channel->channelName}}</div>
                            <div class="text-sm text-blue-900/60">Philippines</div>
                          </div>
                        </div>
                      </td>

                      <td class="font-bold text-blue-900">
                        Room {{$channel->roomID}}
                        <span
                          class="px-2 py-1 rounded-full bg-blue-900/10 text-blue-900 text-xs font-semibold ml-2">{{$channel->roomtype}}</span>
                      </td>

                      <td>
                        @if($channel->channelStatus === 'Approved')
                          <span class="px-3 py-1 rounded-full bg-yellow-400 text-blue-900 text-xs font-bold">Approved</span>
                        @elseif($channel->channelStatus === 'Pending')
                          <span class="px-3 py-1 rounded-full bg-blue-900/20 text-blue-900 text-xs font-bold">Pending</span>
                        @else
                          <span
                            class="px-3 py-1 rounded-full bg-blue-900 text-yellow-400 text-xs font-bold">{{ $channel->channelStatus }}</span>
                        @endif
                      </td>
                      <td class="text-blue-900/80">
                        <div class="font-semibold">{{ \Carbon\Carbon::parse($channel->createdchannel)->format('F j, Y') }}
                        </div>
                        <div class="text-xs text-blue-900/60">
                          ({{ \Carbon\Carbon::parse($channel->createdchannel)->diffForHumans() }})</div>
                      </td>
                      <th>
                        <div class="flex gap-2">
                          <button onclick="update_listing_{{$channel->channelID}}.showModal()"
                            class="btn btn-sm bg-blue-900 text-yellow-400 border-none hover:bg-blue-800 hover:scale-105 transition-all">
                            <i class="w-4 h-4" data-lucide="pencil"></i>
                            Modify
                          </button>
                          <button onclick="delete_listing_{{$channel->channelID}}.showModal()"
                            class="btn btn-sm bg-yellow-400 text-blue-900 border-none hover:bg-yellow-500 hover:scale-105 transition-all">
                            <i data-lucide="trash" class="w-4 h-4"></i>
                            Delete
                          </button>
                        </div>
                      </th>
                    </tr>

                  @empty
                    <tr>
                      <td colspan="6" class="text-center py-12">
                        <div class="flex flex-col items-center justify-center">
                          <div class="bg-yellow-400/20 p-6 rounded-full mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none"
                              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                              class="text-blue-900">
                              <polyline points="22 12 16 12 14 15 10 15 8 12 2 12"></polyline>
                              <path
                                d="M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z">
                              </path>
                            </svg>
                          </div>
                          <span class="text-lg font-bold text-blue-900">No Listings Found</span>
                          <span class="text-sm text-blue-900/60 mt-1">Add your first room listing to get started</span>
                        </div>
                      </td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </section>

          <!-- Initialize Lucide Icons -->
          <script>
            lucide.createIcons();
          </script>







        </main>
      </div>
    </div>

    {{-- modals --}}
    @include('admin.components.channel.create')

    @foreach ($channels as $channel)
      @include('admin.components.channel.delete')
      @include('admin.components.channel.update')
    @endforeach



    @include('javascriptfix.soliera_js')
  </body>
@endauth

<script src="{{asset('javascript/photouploadglobal.js')}}"></script>

</html>