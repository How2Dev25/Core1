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
          <section class="p-8 mt-5   max-w-screen-xl mx-auto">
            <!-- Header Section -->
            <div class="flex  bg-white p-5 rounded-md flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
              <div>
                
                <p class="text-black font-semibold mt-1 text-2xl ">Manage all hotel events, meetings, and conference bookings</p>
              </div>
              <button onclick="create_modal_2.showModal()" class="btn btn-primary gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Create New Event
              </button>
            </div>

            @include('admin.components.ecm.createecm')
          
            <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
  <!-- Card 1 - Total Events (Blue) -->
  <div class="card border border-blue-100 bg-gradient-to-br from-blue-50 to-white
              transition-all duration-300 ease-in-out
              hover:shadow-lg hover:-translate-y-1 hover:border-blue-200
              hover:bg-gradient-to-br hover:from-blue-500 hover:to-white
              group">
    <div class="card-body p-5">
      <div class="flex items-center gap-4">
        <div class="p-3 rounded-lg bg-blue-100 text-blue-600
                   group-hover:bg-blue-600 group-hover:text-white
                   transition-colors duration-300">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
          </svg>
        </div>
        <div>
          <h3 class="text-lg font-semibold group-hover:text-blue-800 transition-colors">Total Events</h3>
          <p class="text-sm text-gray-500 group-hover:text-blue-600 transition-colors">Total Events</p>
        </div>
      </div>
      <p class="text-3xl font-bold mt-3 text-gray-800 group-hover:text-blue-900 transition-colors">{{$totalevents}}</p>
    </div>
  </div>

  <!-- Card 2 - Approved Events (Green) -->
  <div class="card border border-green-100 bg-gradient-to-br from-green-50 to-white
              transition-all duration-300 ease-in-out
              hover:shadow-lg hover:-translate-y-1 hover:border-green-200
              hover:bg-gradient-to-br hover:from-green-500 hover:to-white
              group">
    <div class="card-body p-5">
      <div class="flex items-center gap-4">
        <div class="p-3 rounded-lg bg-green-100 text-green-600
                   group-hover:bg-green-600 group-hover:text-white
                   transition-colors duration-300">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
          </svg>
        </div>
        <div>
          <h3 class="text-lg font-semibold group-hover:text-green-800 transition-colors">Approved Events</h3>
          <p class="text-sm text-gray-500 group-hover:text-green-600 transition-colors">Available spaces</p>
        </div>
      </div>
      <p class="text-3xl font-bold mt-3 text-gray-800 group-hover:text-green-900 transition-colors">{{$approvedevents}}</p>
    </div>
  </div>

  <!-- Card 3 - Monthly Revenue (Purple) -->
  <div class="card border border-purple-100 bg-gradient-to-br from-purple-50 to-white
              transition-all duration-300 ease-in-out
              hover:shadow-lg hover:-translate-y-1 hover:border-purple-200
              hover:bg-gradient-to-br hover:from-purple-500 hover:to-white
              group">
    <div class="card-body p-5">
      <div class="flex items-center gap-4">
        <div class="p-3 rounded-lg bg-purple-100 text-purple-600
                   group-hover:bg-purple-600 group-hover:text-white
                   transition-colors duration-300">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
        </div>
        <div>
          <h3 class="text-lg font-semibold group-hover:text-purple-800 transition-colors">Monthly Revenue</h3>
          <p class="text-sm text-gray-500 group-hover:text-purple-600 transition-colors">From events</p>
        </div>
      </div>
      <p class="text-3xl font-bold mt-3 text-gray-800 group-hover:text-purple-900 transition-colors">₱42,580</p>
    </div>
  </div>

  <!-- Card 4 - Cancelled Events (Amber) -->
  <div class="card border border-amber-100 bg-gradient-to-br from-amber-50 to-white
              transition-all duration-300 ease-in-out
              hover:shadow-lg hover:-translate-y-1 hover:border-amber-200
              hover:bg-gradient-to-br hover:from-amber-500 hover:to-white
              group">
    <div class="card-body p-5">
      <div class="flex items-center gap-4">
        <div class="p-3 rounded-lg bg-amber-100 text-amber-600
                   group-hover:bg-amber-600 group-hover:text-white
                   transition-colors duration-300">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
          </svg>
        </div>
        <div>
          <h3 class="text-lg font-semibold group-hover:text-amber-800 transition-colors">Cancelled Events</h3>
          <p class="text-sm text-gray-500 group-hover:text-amber-600 transition-colors">Event spaces</p>
        </div>
      </div>
      <p class="text-3xl font-bold mt-3 text-gray-800 group-hover:text-amber-900 transition-colors">{{$cancelledevents}}</p>
    </div>
  </div>
</div>
          
            <!-- Featured Events -->
            <div class="mb-10 bg-white p-5 rounded-md">
              <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-gray-800">Featured Events</h3>
                <a href="#" class="text-sm font-medium text-primary hover:underline">View all</a>
              </div>
              
              <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Event 1 -->
                @foreach($events as $event)
                  @if($event->eventstatus == 'Approved')
                <div class="card bg-white border border-gray-200 hover:shadow-md transition-all duration-300 overflow-hidden">
                  <figure class="relative h-48">
                    <img src="{{$event->eventphoto}}" alt="Wedding Event" class="w-full h-full object-cover">
                    <div class="absolute top-4 right-4">
                      <span class="badge badge-primary">{{$event->eventtype}}</span>
                    </div>
                  </figure>
                  <div class="card-body p-5">
                    <h4 class="card-title text-lg font-bold">{{$event->eventname}}</h4>
                    <p class="text-gray-600 mb-3">{{$event->eventdescription}}d</p>
                    <div class="flex justify-between items-center">
                      <div class="flex items-center text-sm text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        {{$event->eventdate}}
                      </div>
                      <button onclick="edit_modal_{{$event->eventID}}.showModal()" class="btn btn-sm btn-ghost text-primary">View Details</button>
                    </div>
                  </div>
                </div>
                  @endif
                @endforeach
          
            
             
              </div>
            </div>
          @include('admin.components.ecm.alerts')
            <!-- Upcoming Events Table -->
            <div class="card bg-white border border-gray-200">
              <div class="card-body p-0">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center p-5 pb-0">
                  <h3 class="text-xl font-bold text-gray-800">Upcoming Events</h3>
                  <div class="flex gap-2 mt-3 md:mt-0">
                    <div class="form-control">
                      <input type="text" placeholder="Search events..." class="input input-bordered input-sm">
                    </div>
                    <select class="select select-bordered select-sm">
                      <option>All Types</option>
                      <option>Wedding</option>
                      <option>Conference</option>
                      <option>Celebration</option>
                    </select>
                  </div>
                </div>
                
                <div class="overflow-x-auto">
                  <table class="table">
                    <thead>
                      <tr>
                        <th class="bg-gray-50">Event</th>
                        <th class="bg-gray-50">Organizer</th>
                        <th class="bg-gray-50">Date</th>
                        <th class="bg-gray-50">Days</th>
                        <th class="bg-gray-50">Status</th>
                        <th class="bg-gray-50 text-right">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse ($events as $event)
                      <tr class="hover:bg-gray-50">
                        <td>
                          <div class="flex items-center gap-3">
                            <div class="avatar">
                              <div class="mask mask-squircle w-10 h-10">
                                <img src="{{asset($event->eventphoto)}}" alt="Business Meeting">
                              </div>
                            </div>
                            <div>
                              <div class="font-medium">{{$event->eventtype}}</div>
                              <div class="text-sm text-gray-500">#{{$event->eventID}}{{$event->eventname}}</div>
                            </div>
                          </div>
                        </td>
                        <td>{{$event->eventorganizername}}</td>
                        <td>{{$event->eventdate}}</td>
                        <td>{{$event->eventdays}}</td>
                        <td>
                          @if ($event->eventstatus == "Approved")
                              <span class="badge badge-success">Approved</span>
                          @elseif ($event->eventstatus == "Pending")
                              <span class="badge badge-warning">Pending</span>
                          @elseif ($event->eventstatus == "Cancelled")
                              <span class="badge badge-error">Cancelled</span>
                          @else
                              <span class="badge badge-neutral">Unknown</span>
                          @endif
                      </td>

                      <td class="text-right space-x-1">

                        {{-- Edit Button --}}
                        <button onclick="edit_modal_{{$event->eventID}}.showModal()" class="btn btn-ghost btn-xs text-info" title="Edit">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </button>
                    
                        {{-- Delete Button --}}
                        <button onclick="delete_modal_{{$event->eventID}}.showModal()" class="btn btn-ghost btn-xs text-error" title="Delete">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    
                        {{-- Approve Button --}}
                        <button onclick="approve_modal_{{$event->eventID}}.showModal()" class="btn btn-ghost btn-xs text-success" title="Approve">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                        </button>
                    
                        {{-- Cancel Button --}}
                        <button onclick="cancel_modal_{{$event->eventID}}.showModal()" class="btn btn-ghost btn-xs text-warning" title="Cancel">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    
                    </td>
                      </tr>
                      @empty
                      <tr>
                        <td colspan="6" class="text-center py-8">
                            <div class="flex flex-col items-center justify-center text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-inbox">
                                    <polyline points="22 12 16 12 14 15 10 15 8 12 2 12"></polyline>
                                    <path d="M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"></path>
                                </svg>
                                <span class="mt-2 text-sm font-medium">No Data found</span>
                            </div>
                        </td>
                    </tr>
                          
                      @endforelse
                  
                     
                    </tbody>
                  </table>
                </div>
                
                <!-- Pagination -->
                <div class="flex justify-center p-4">
                  <div class="join">
                    <button class="join-item btn btn-sm">«</button>
                    <button class="join-item btn btn-sm btn-active">1</button>
                    <button class="join-item btn btn-sm">2</button>
                    <button class="join-item btn btn-sm">3</button>
                    <button class="join-item btn btn-sm">»</button>
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

    @foreach ($events as $event)
        @include('admin.components.ecm.editecm')
        @include('admin.components.ecm.deleteecm')
        @include('admin.components.ecm.approveecm')
        @include('admin.components.ecm.cancelecm')
    @endforeach
 
  
 
  </body>

  @endauth

  
  @include('javascriptfix.soliera_js')

  <script src="{{asset('javascript/photouploadglobal.js')}}"></script>
  
</html>