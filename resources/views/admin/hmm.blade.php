<!DOCTYPE html>
<html lang="en" data-theme ="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    @vite('resources/css/app.css')
 
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <title>{{$title}} - Housekeeping And Maintenance</title>
</head>
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
            <h1 class="text-2xl font-bold text-[#191970] bg-clip-text ">Housekeeping And Maintenance </h1>
          </div>
            {{-- Subsystem Name --}}

          {{-- content --}}

          <section class="container mx-auto p-4">
  <!-- Header -->
 

  <!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
  <!-- Total Rooms Card (Blue) -->
  <div class="card bg-gradient-to-br from-blue-50 to-white border border-blue-100
              transition-all duration-300 ease-in-out
              hover:shadow-lg hover:-translate-y-1 hover:border-blue-200
              hover:bg-gradient-to-br hover:from-blue-500 hover:to-white
              group">
    <div class="card-body">
      <div class="flex items-center">
        <div class="p-3 rounded-full bg-blue-100 text-blue-600
                   group-hover:bg-blue-600 group-hover:text-white
                   transition-colors duration-300">
          <i data-lucide="home" class="w-6 h-6"></i>
        </div>
        <div class="ml-4">
          <h3 class="text-sm font-medium text-gray-500 group-hover:text-blue-600">Total Rooms</h3>
          <p class="text-2xl font-semibold group-hover:text-blue-800">{{$totalrooms}}</p>
        </div>
      </div>
      <div class="mt-2 text-sm text-green-600 flex items-center group-hover:text-green-700">
        <i data-lucide="trending-up" class="w-4 h-4 mr-1"></i>
        <span>5% from last month</span>
      </div>
    </div>
  </div>

  <!-- Maintenance Rooms Card (Orange) -->
  <div class="card bg-gradient-to-br from-orange-50 to-white border border-orange-100
              transition-all duration-300 ease-in-out
              hover:shadow-lg hover:-translate-y-1 hover:border-orange-200
              hover:bg-gradient-to-br hover:from-orange-500 hover:to-white
              group">
    <div class="card-body">
      <div class="flex items-center">
        <div class="p-3 rounded-full bg-orange-100 text-orange-600
                   group-hover:bg-orange-600 group-hover:text-white
                   transition-colors duration-300">
          <i data-lucide="tool-case" class="w-6 h-6"></i>
        </div>
        <div class="ml-4">
          <h3 class="text-sm font-medium text-gray-500 group-hover:text-orange-600">Maintenance Rooms</h3>
          <p class="text-2xl font-semibold group-hover:text-orange-800">{{$maintenancerooms}}</p>
        </div>
      </div>
      <div class="mt-2 text-sm text-red-600 flex items-center group-hover:text-red-700">
        <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
        <span>{{$urgentmaintenance}} urgent requests</span>
      </div>
    </div>
  </div>

  <!-- Inventory Card (Green) -->
  <div class="card bg-gradient-to-br from-green-50 to-white border border-green-100
              transition-all duration-300 ease-in-out
              hover:shadow-lg hover:-translate-y-1 hover:border-green-200
              hover:bg-gradient-to-br hover:from-green-500 hover:to-white
              group">
    <div class="card-body">
      <div class="flex items-center">
        <div class="p-3 rounded-full bg-green-100 text-green-600
                   group-hover:bg-green-600 group-hover:text-white
                   transition-colors duration-300">
          <i data-lucide="box" class="w-6 h-6"></i>
        </div>
        <div class="ml-4">
          <h3 class="text-sm font-medium text-gray-500 group-hover:text-green-600">Total Inventory</h3>
          <p class="text-2xl font-semibold group-hover:text-green-800">{{$inventorystocks}}</p>
        </div>
      </div>
      <div class="mt-2 text-sm text-gray-500 flex items-center group-hover:text-gray-600">
        <i data-lucide="info" class="w-4 h-4 mr-1"></i>
        <span>{{$lowstock}} items low in stock</span>
      </div>
    </div>
  </div>
</div>

  <!-- Inventory Table -->
  <div class="overflow-x-auto rounded-box border border-base-300 p-5">
     {{--alerts --}}
      
            {{-- alerts --}}

              <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold">Inventory And Stocks</h2>
      </div>
    <table class="table table-sm">
      @if(session('stockerror'))
              <div role="alert" class="alert alert-error mt-2 mb-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          <span>{{session('stockerror')}}</span>
        </div>
        @elseif(session('stocklimit'))
        <div role="alert" class="alert alert-error mt-2 mb-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          <span>{{session('stocklimit')}}</span>
        </div>
        @elseif(session('stockUpdated'))
        <div role="alert" class="alert alert-success mt-2 mb-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span>{{session('stockUpdated')}}</span>
      </div>
      @endif

      <thead class="bg-base-200">
        <tr>
          <th>Item</th>
          <th>Category</th>
          <th>Stock</th>
          <th>Threshold</th>
          <th>Unit</th>
          <th>Action</th>
        
        </tr>
      </thead>
      <tbody>
        <!-- Row 1 -->
        @forelse ($inventory as $inv)
        <tr>
          <td>
            <div class="flex items-center gap-3">
              <div class="avatar">
                <div class="mask mask-squircle w-10 h-10">
                  <img src="{{asset($inv->core1_inventory_image)}}" alt="Bath Towels" />
                </div>
              </div>
              <div>
                <div class="font-bold">{{$inv->core1_inventory_name}}</div>
                <div class="text-xs opacity-50">{{$inv->core1_inventory_code}}</div>
              </div>
            </div>
          </td>
         <td>
                @php
                    $badgeClasses = [
                    'Linens' => 'badge-info',
                    'Bath Amenities' => 'badge-primary',
                    'Cleaning Supplies' => 'badge-warning',
                    'Room Equipment' => 'badge-success',
                    // Add more categories as needed
                    ];
                    
                    $defaultClass = 'badge-secondary';
                    $badgeClass = $badgeClasses[$inv->core1_inventory_category] ?? $defaultClass;
                @endphp
                
                <span class="badge badge-sm {{ $badgeClass }}">
                    {{ $inv->core1_inventory_category }}
                </span>
                </td>
          <td>
            <span class="font-bold @if($inv->core1_inventory_stocks == 0)
                text-red-500
              @elseif ($inv->core1_inventory_stocks <= $inv->core1_inventory_threshold)
                text-orange-400
              @endif">{{$inv->core1_inventory_stocks}}</span>
          </td>
          <td>{{$inv->core1_inventory_threshold}}</td>
          <td>{{$inv->core1_inventory_unit}}</td>
          <td>
            <button onclick="stock_modal_{{$inv->core1_inventoryID}}.showModal()" class="btn btn-sm btn-primary">
              <i class="w-5 h-5" data-lucide="hand-helping"></i>
              Use Item</button>
          </td>
         
        </tr>
        @empty

        @endforelse
        
      
      
    
      </tbody>
    </table>
  </div>

  <!-- Maintenance Rooms Section -->
   <div class="flex justify-between items-center mb-6 mt-5">
   
    <div class="flex space-x-2 ">
      <button onclick="create_maintenance_modal.showModal()" class="btn btn-primary">
        <i data-lucide="plus" class="w-5 h-5 mr-1"></i>
        New Request
      </button>
     
    </div>
  </div>

  <div class="card bg-base-100 shadow">
    
    <div class="card-body">
            {{-- alerts --}}
                    @if (session('maintenancecreate'))
            <div role="alert" class="alert alert-success">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{session('maintenancecreate')}}</span>
            </div>
            @elseif(session('maintenancemodify'))
            <div role="alert" class="alert alert-success">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{session('maintenancemodify')}}</span>
            </div>
            @elseif(session('maintenancecomplete'))
            <div role="alert" class="alert alert-success">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{session('maintenancecomplete')}}</span>
            </div>
            @elseif(session('maintenancedelete'))
            <div role="alert" class="alert alert-success">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{session('maintenancedelete')}}</span>
            </div>

        @endif



      <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold">Rooms Maintenance And Housekeeping</h2>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
     
     

        <!-- Room Card  -->
      @forelse ($rooms as $room)
    <div class="card bg-base-100 shadow hover:shadow-lg transition-shadow duration-200">
        <figure>
            <img src="{{ asset($room->roomphoto ?? 'placeholder-image.jpg') }}" 
                 alt="Room {{ $room->roomID }}" class="h-48 w-full object-cover">
            <!-- Status badge on image -->
            @if($room->priority)
                <div class="absolute top-2 right-2 badge 
                    @if($room->priority === 'Low') badge-info
                    @elseif($room->priority === 'Medium') badge-warning
                    @elseif($room->priority === 'High') badge-error
                    @elseif($room->priority === 'Urgent') badge-error bg-red-600
                    @endif gap-1">
                    @if($room->priority === 'Low')
                        <i data-lucide="signal-low" class="w-3 h-3"></i>
                    @elseif($room->priority === 'Medium')
                        <i data-lucide="signal-medium" class="w-3 h-3"></i>
                    @else
                        <i data-lucide="signal-high" class="w-3 h-3"></i>
                    @endif
                    {{ $room->priority }}
                </div>
            @endif
        </figure>
        <div class="card-body">
            <div class="flex justify-between items-start">
                <div>
                    <h3 class="card-title">Room {{ $room->roomID }}</h3>
                    <div class="badge 
                        @if($room->maintenancestatus === 'Pending') badge-warning
                        @elseif($room->maintenancestatus === 'In Progress') badge-info
                        @elseif($room->maintenancestatus === 'Completed') badge-success
                        @endif gap-1">
                        @if($room->maintenancestatus === 'Pending')
                            <i data-lucide="clock" class="w-3 h-3"></i>
                        @elseif($room->maintenancestatus === 'In Progress')
                            <i data-lucide="wrench" class="w-3 h-3"></i>
                        @else
                            <i data-lucide="check-circle" class="w-3 h-3"></i>
                        @endif
                        {{ $room->maintenancestatus }}
                    </div>
                    <div class="badge badge-info gap-1 mt-1">
                        <i data-lucide="home" class="w-3 h-3"></i>
                        {{ $room->roomtype }}
                    </div>
                </div>
                <div class="dropdown dropdown-end">
                    <label tabindex="0" class="btn btn-ghost btn-sm">
                        <i data-lucide="more-vertical" class="w-4 h-4"></i>
                    </label>
                    <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52">
                       
                        <li><a onclick="delete_maintenance_{{ $room->roommaintenanceID }}.showModal()">
                            <i data-lucide="trash-2" class="w-4 h-4"></i> Delete
                        </a></li>
                        @if($room->maintenancestatus !== 'Completed')
                        <li><a onclick="complete_maintenance_{{ $room->roommaintenanceID }}.showModal()">
                            <i data-lucide="check" class="w-4 h-4"></i> Mark Complete
                        </a></li>
                        @endif
                    </ul>
                </div>
            </div>
            
            <!-- Assigned Staff -->
            @if($room->maintenanceassigned_To)
            <div class="mt-2 flex items-center gap-2 text-sm">
                <div class="avatar">
                    <div class="w-6 rounded-full">
                        <img src="{{ asset($room->assignedStaff->photo ?? 'images/defaults/staff.png') }}" />
                    </div>
                </div>
                <span>Assigned to: {{ $room->maintenanceassigned_To ?? 'Staff' }}</span>
            </div>
            @endif
            
            <p class="text-sm text-gray-500 mt-2">
                <i data-lucide="calendar" class="w-4 h-4 inline mr-1"></i>
                {{ $room->created_at->format('M d, Y h:i A') }}
            </p>
            <p class="text-sm mt-2">
                <i data-lucide="alert-circle" class="w-4 h-4 inline mr-1 text-warning"></i>
                {{ Str::limit($room->maintenancedescription, 100) }}
            </p>
            
            <div class="card-actions justify-between items-center mt-4">
               
                
                    <button onclick="document.getElementById('assign_maintenance_modal_{{ $room->roommaintenanceID }}').showModal()" 
                            class="btn btn-sm btn-primary">
                        <i data-lucide="user-check" class="w-4 h-4 mr-1"></i>
                        Assign Staff
                    </button>
               
                
                <div class="text-xs text-gray-500">
                    Last updated: {{ $room->updated_at->diffForHumans() }}
                </div>
            </div>
        </div>
    </div>
@empty
    <div class="col-span-full text-center py-12">
        <div class="mx-auto w-24 h-24 text-gray-400 mb-4">
            <i data-lucide="home" class="w-full h-full"></i>
        </div>
        <h3 class="text-lg font-medium text-gray-700">No Rooms Need Maintenance</h3>
        <p class="text-gray-500 mt-2">All rooms are currently in good condition.</p>
        <button onclick="create_maintenance_modal.showModal()" class="btn btn-primary mt-4 gap-2">
            <i data-lucide="plus" class="w-4 h-4"></i>
            Create New Maintenance Request
        </button>
    </div>
@endforelse



      </div>
    </div>
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

    @foreach ( $rooms as $room )
        @include('admin.components.hmm.edit')
        @include('admin.components.hmm.delete')
        @include('admin.components.hmm.complete')
    @endforeach

    @include('admin.components.hmm.create')

    @foreach ($inventory as $inv)
        @include('admin.components.ias.use')
    @endforeach
 
  </body>
  @include('javascriptfix.soliera_js')

  <script src="{{asset('javascript/photouploadglobal.js')}}"></script>
  
</html>