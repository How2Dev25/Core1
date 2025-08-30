<!DOCTYPE html>
<html lang="en" data-theme ="light">
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

  <section class="p-6 bg-base-100 rounded-box">
  <!-- Header Section -->
 

  <!-- Channel Cards Grid -->
 <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
  <!-- TaraStay Card -->
  <div class="card bg-gradient-to-br from-blue-50 to-white border border-blue-100
              transition-all duration-300 ease-in-out
              hover:shadow-lg hover:-translate-y-1 hover:border-blue-200
              hover:bg-gradient-to-br hover:from-blue-500 hover:to-white
              group">
    <div class="card-body">
      <div class="flex items-center gap-3 mb-3">
        <div class="avatar placeholder">
          <img class="w-10 h-10 rounded-md shadow-md group-hover:shadow-lg transition-shadow" src="{{asset('images/rbnb/tarastay.png')}}" alt="TaraStay">
        </div>
        <h3 class="card-title group-hover:text-blue-700 transition-colors">
          <i data-lucide="home" class="w-5 h-5 inline mr-1 text-blue-600"></i>
          TaraStay
        </h3>
        <div class="badge badge-success gap-1 ml-auto group-hover:bg-blue-600 transition-colors">
          <i class="w-3 h-3" data-lucide="check"></i>
          Connected
        </div>
      </div>
      <p class="text-sm text-gray-500 mb-4 group-hover:text-blue-600 transition-colors">
        <i data-lucide="clock" class="w-4 h-4 inline mr-1"></i>
        Last sync: 15 minutes ago
      </p>
      <div class="card-actions justify-between">
        <div class="stats stats-horizontal shadow bg-white group-hover:bg-blue-50 transition-colors">
          <div class="stat">
            <div class="stat-title flex items-center gap-1">
              <i data-lucide="list" class="w-3 h-3"></i>
              Listings
            </div>
            <div class="stat-value text-sm">{{$tarastaylisting}}</div>
          </div>
          <div class="stat">
            <div class="stat-title flex items-center gap-1">
              <i data-lucide="calendar-check" class="w-3 h-3"></i>
              Bookings
            </div>
            <div class="stat-value text-sm">12</div>
          </div>
        </div>
        <button class="btn btn-ghost btn-sm group-hover:bg-blue-100 transition-colors">
          <i class="w-4 h-4" data-lucide="chevron-right"></i>
        </button>
      </div>
    </div>
  </div>

  <!-- HabiStay Card -->
  <div class="card bg-gradient-to-br from-green-50 to-white border border-green-100
              transition-all duration-300 ease-in-out
              hover:shadow-lg hover:-translate-y-1 hover:border-green-200
              hover:bg-gradient-to-br hover:from-green-500 hover:to-white
              group">
    <div class="card-body">
      <div class="flex items-center gap-3 mb-3">
        <div class="avatar placeholder">
          <img class="w-10 h-10 rounded-md shadow-md group-hover:shadow-lg transition-shadow" src="{{asset('images/rbnb/habistay.png')}}" alt="HabiStay">
        </div>
        <h3 class="card-title group-hover:text-green-700 transition-colors">
          <i data-lucide="building-2" class="w-5 h-5 inline mr-1 text-green-600"></i>
          HabiStay
        </h3>
        <div class="badge badge-success gap-1 ml-auto group-hover:bg-green-600 transition-colors">
          <i class="w-3 h-3" data-lucide="check"></i>
          Connected
        </div>
      </div>
      <p class="text-sm text-gray-500 mb-4 group-hover:text-green-600 transition-colors">
        <i data-lucide="clock" class="w-4 h-4 inline mr-1"></i>
        Last sync: 1 hour ago
      </p>
      <div class="card-actions justify-between">
        <div class="stats stats-horizontal shadow bg-white group-hover:bg-green-50 transition-colors">
          <div class="stat">
            <div class="stat-title flex items-center gap-1">
              <i data-lucide="list" class="w-3 h-3"></i>
              Listings
            </div>
            <div class="stat-value text-sm">{{$habistaylisting}}</div>
          </div>
          <div class="stat">
            <div class="stat-title flex items-center gap-1">
              <i data-lucide="calendar-check" class="w-3 h-3"></i>
              Bookings
            </div>
            <div class="stat-value text-sm">8</div>
          </div>
        </div>
        <button class="btn btn-ghost btn-sm group-hover:bg-green-100 transition-colors">
          <i class="w-4 h-4" data-lucide="chevron-right"></i>
        </button>
      </div>
    </div>
  </div>

  <!-- nestscape Card -->
  <div class="card bg-gradient-to-br from-purple-50 to-white border border-purple-100
              transition-all duration-300 ease-in-out
              hover:shadow-lg hover:-translate-y-1 hover:border-purple-200
              hover:bg-gradient-to-br hover:from-purple-500 hover:to-white
              group">
    <div class="card-body">
      <div class="flex items-center gap-3 mb-3">
        <div class="avatar placeholder">
          <img class="w-10 h-10 rounded-md shadow-md group-hover:shadow-lg transition-shadow" src="{{asset('images/rbnb/nestscape.png')}}" alt="nestscape">
        </div>
        <h3 class="card-title group-hover:text-purple-700 transition-colors">
          <i data-lucide="tree-pine" class="w-5 h-5 inline mr-1 text-purple-600"></i>
          nestscape
        </h3>
        <div class="badge badge-success gap-1 ml-auto group-hover:bg-purple-600 transition-colors">
          <i class="w-3 h-3" data-lucide="check"></i>
          Connected
        </div>
      </div>
      <p class="text-sm text-gray-500 mb-4 group-hover:text-purple-600 transition-colors">
        <i data-lucide="clock" class="w-4 h-4 inline mr-1"></i>
        Last sync: 3 days ago
      </p>
      <div class="card-actions justify-between">
        <div class="stats stats-horizontal shadow bg-white group-hover:bg-purple-50 transition-colors">
          <div class="stat">
            <div class="stat-title flex items-center gap-1">
              <i data-lucide="list" class="w-3 h-3"></i>
              Listings
            </div>
            <div class="stat-value text-sm">{{$nestscapelisting}}</div>
          </div>
          <div class="stat">
            <div class="stat-title flex items-center gap-1">
              <i data-lucide="calendar-check" class="w-3 h-3"></i>
              Bookings
            </div>
            <div class="stat-value text-sm">0</div>
          </div>
        </div>
        <button class="btn btn-ghost btn-sm group-hover:bg-purple-100 transition-colors">
          <i class="w-4 h-4" data-lucide="chevron-right"></i>
        </button>
      </div>
    </div>
  </div>
</div>

  <!-- Add New Channel Section -->
 <div class="mt-2 mb-2">
  
  <button onclick="add_listing.showModal()" class="btn btn-primary">
    <i data-lucide="circle-plus"></i>
    Add Room Listing</button>
 </div>

  <!-- Channel Sync Status Section -->
  <div class="overflow-x-auto">
    {{-- alerts --}}
    @if(session('RoomAdded'))
    <div role="alert" class="alert alert-success">
  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
  </svg>
  <span>{{session('RoomAdded')}}</span>
  </div>
  @elseif(session('RoomModify'))
   <div role="alert" class="alert alert-success">
  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
  </svg>
  <span>{{session('RoomModify')}}</span>
  </div>
  @elseif(session('RoomDelete'))

    <div role="alert" class="alert alert-success">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
    </svg>
    <span>{{session('RoomDelete')}}</span>
    </div>
    @endif
  
  <table class="table">
    <!-- head -->
    <thead class="bg-blue-900 text-white">
      <tr>
        
        <th>Listing ID</th>
        <th>Channel Name</th>
        <th>Room Name</th>
        <th>Listing Status</th>
        <th>Date Added</th>
         <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <!-- row 1 -->
      @forelse ($channels as $channel)

      <tr>
         <td>{{$channel->channelID}}</td>
           <td>
          <div class="flex items-center gap-3">
            <div class="avatar">
              <div class="mask mask-squircle w-10 h-10">
                <img
                  src="@if($channel->channelName == 'Tarastay') {{asset('images/rbnb/tarastay.png')}} 
                  @elseif($channel->channelName == 'Habistay') {{asset('images/rbnb/habistay.png')}}
                  @else {{asset('images/rbnb/nestscape.png')}} @endif"
                  alt="Avatar Tailwind CSS Component" />
              </div>
            </div>
            <div>
              <div class="font-bold">{{$channel->channelName}}</div>
              <div class="text-sm opacity-50">Philippines</div>
            </div>
          </div>
        </td>
       
        <td class="font-bold">
          Room {{$channel->roomID}}
           <span class="badge badge-ghost badge-sm">{{$channel->roomtype}}</span>
        </td>

                <td>
            @if($channel->channelStatus === 'Approved')
              <span class="badge badge-success">Approved</span>
            @elseif($channel->channelStatus === 'Pending')
              <span class="badge badge-warning">Pending</span>
            @else
              <span class="badge badge-error">{{ $channel->channelStatus }}</span>
            @endif
          </td>
        <td>{{ \Carbon\Carbon::parse($channel->createdchannel)->format('F j, Y') }} ({{ \Carbon\Carbon::parse($channel->createdchannel)->diffForHumans() }})
</td>
        <th>
          <button onclick="update_listing_{{$channel->channelID}}.showModal()" class="btn btn-primary btn-sm ">
            <i class="w-5 h-5" data-lucide="pencil"></i>
            Modify
          </button>
            <button onclick="delete_listing_{{$channel->channelID}}.showModal()" class="btn btn-error btn-sm">
              <i data-lucide="trash" class="w-5 h-5 "></i>
              Delete
            </button>
        </th>
      </tr>
          
      @empty
          
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