<!DOCTYPE html>
<html lang="en" data-theme ="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    @vite('resources/css/app.css')
 
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <title>{{$title}} - Inventory And Stock</title>
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
            <h1 class="text-2xl font-bold bg-white bg-clip-text text-[#191970]">Inventory And Stocks</h1>
          </div>
            {{-- Subsystem Name --}}

          {{-- content --}}
       <section class="p-4 bg-base-100 rounded-box space-y-6">
           {{-- greetings --}}
           @include('admin.components.dashboard.welcome')
  <!-- Header Section -->
  <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-3">
    <div>
      <h1 class="text-2xl font-bold flex items-center gap-2">
        <i data-lucide="warehouse" class="w-6 h-6 text-primary"></i>
        Hotel Inventory
      </h1>
      <p class="text-sm text-gray-500">Manage your hotel stock levels</p>

     
    </div>

    
    
    <div class="flex gap-2">
      <button onclick="inventory_modal.showModal()" class="btn btn-primary btn-sm">
        <i data-lucide="plus" class="w-4 h-4"></i>
        Add Item
      </button>
     
    </div>
  </div>

  <!-- Stats Cards -->
   <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
            <!-- Total Items - Blue Theme -->
            <div
                class="stats bg-white shadow-md hover:shadow-md transition-all duration-300 ease-in-out group hover:-translate-y-1">
                <div class="stat p-3">
                    <div class="flex items-center gap-2">
                        <div
                            class="p-2 rounded-lg bg-blue-900 text-yellow-400 group-hover:text-white transition-colors duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-package">
                                <path d="m7.5 4.27 9 5.15" />
                                <path
                                    d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z" />
                                <path d="m3.3 7 8.7 5 8.7-5" />
                                <path d="M12 22V12" />
                            </svg>
                        </div>
                        <div class="stat-title text-gray-600 group-hover:text-blue-800">Total Items</div>
                    </div>
                    <div class="stat-value text-blue-600 text-lg group-hover:text-blue-800">{{$totalItems}}</div>
                </div>
            </div>
        
            <!-- In Stock - Green Theme -->
            <div
                class="stats bg-white shadow-md hover:shadow-md transition-all duration-300 ease-in-out group hover:-translate-y-1">
                <div class="stat p-3">
                    <div class="flex items-center gap-2">
                        <div
                            class="p-2 rounded-lg bg-blue-900 text-yellow-400 group-hover:text-white transition-colors duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-check-circle">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                                <path d="m9 11 3 3L22 4" />
                            </svg>
                        </div>
                        <div class="stat-title text-gray-600 group-hover:text-green-800">In Stock</div>
                    </div>
                    <div class="stat-value text-green-600 text-lg group-hover:text-green-800">{{$instock}}</div>
                </div>
            </div>
        
            <!-- Low Stock - Amber Theme -->
            <div
                class="stats bg-white shadow-md hover:shadow-md transition-all duration-300 ease-in-out group hover:-translate-y-1">
                <div class="stat p-3">
                    <div class="flex items-center gap-2">
                        <div
                            class="p-2 rounded-lg bg-blue-900 text-yellow-400 group-hover:text-white transition-colors duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-alert-triangle">
                                <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z" />
                                <path d="M12 9v4" />
                                <path d="M12 17h.01" />
                            </svg>
                        </div>
                        <div class="stat-title text-gray-600 group-hover:text-amber-800">Low Stock</div>
                    </div>
                    <div class="stat-value text-amber-600 text-lg group-hover:text-amber-800">{{$lowstock}}</div>
                </div>
            </div>
        
            <!-- Out of Stock - Red Theme -->
            <div
                class="stats bg-white shadow-md hover:shadow-md transition-all duration-300 ease-in-out group hover:-translate-y-1">
                <div class="stat p-3">
                    <div class="flex items-center gap-2">
                        <div
                            class="p-2 rounded-lg bg-blue-900 text-yellow-400 group-hover:text-white transition-colors duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-x-circle">
                                <circle cx="12" cy="12" r="10" />
                                <path d="m15 9-6 6" />
                                <path d="m9 9 6 6" />
                            </svg>
                        </div>
                        <div class="stat-title text-gray-600 group-hover:text-red-800">Out of Stock</div>
                    </div>
                    <div class="stat-value text-red-600 text-lg group-hover:text-red-800">{{$nostock}}</div>
                </div>
            </div>
        </div>
 
 
  <!-- Inventory Table -->
  <div class="overflow-x-auto rounded-box border border-base-300 p-5">
     {{--alerts --}}
            @if(session('inventorycreated'))
          <div role="alert" class="alert alert-success mb-2 mt-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{session('inventorycreated')}}</span>
            </div>

            @elseif(session('inventorymodified'))
              <div role="alert" class="alert alert-success mb-2 mt-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{session('inventorymodified')}}</span>
            </div>
            @elseif(session('inventorydeleted'))
             <div role="alert" class="alert alert-success mb-2 mt-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{session('inventorydeleted')}}</span>
            </div>
             @endif
            
            {{-- alerts --}}
    <table class="table table-sm">
      <thead class="bg-blue-900 text-white">
        <tr>
          <th>Item</th>
          <th>Category</th>
          <th>Stock</th>
          <th>Threshold</th>
          <th>Unit</th>
          <th>Actions</th>
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
            <button onclick="inventory_modal_{{$inv->core1_inventoryID}}.showModal()"  class="btn btn-ghost btn-xs">
              <i data-lucide="edit" class="w-4 h-4"></i>
            </button>
            <button onclick="delete_inventory_{{$inv->core1_inventoryID}}.showModal()" class="btn btn-ghost btn-xs">
              <i data-lucide="trash" class="w-4 h-4"></i>
            </button>
          </td>
        </tr>
        @empty
        @endforelse
        
      
      
    
      </tbody>
    </table>
  </div>

  <!-- Stock Requests Section -->
  <div class="mt-6">
    <h2 class="text-lg font-bold flex items-center gap-2 mb-3">
      <i data-lucide="clipboard-list" class="w-5 h-5 text-secondary"></i>
      Recent Stock Requests
    </h2>

    <div class="">
       <button onclick="request_modal.showModal()" class="btn btn-primary btn-sm mt-2 mb-2">
        <i data-lucide="plus" class="w-4 h-4"></i>
        Request Stock
      </button>
    </div>
    
  <div class="overflow-x-auto bg-white rounded-lg shadow">
    @if(session('success'))
            <div role="alert" class="alert alert-success mt-2 mb-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          <span>{{session('success')}}</span>
        </div>
        @elseif(session('stockupdated'))
         <div role="alert" class="alert alert-success mt-2 mb-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          <span>{{session('stockupdated')}}</span>
        </div>
        @elseif(session('stockdeleted'))
         <div role="alert" class="alert alert-success mt-2 mb-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          <span>{{session('stockdeleted')}}</span>
        </div>
        @endif
 <table class="table">
  <thead>
    <tr class="bg-blue-900 text-white">
      <th>Request ID</th>
      <th>Category</th>
      <th>Item Name</th>
      <th>Status</th>
      <th>Priority</th>
      <th>Stocks Needed</th>
      <th>Created</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    @forelse ($stock as $stocks)
      <tr>
        <td>{{ $stocks->core1_requestID }}</td>
        <td>
          <span class="badge badge-outline flex items-center gap-1">
            @switch($stocks->core1_request_category)
              @case('Linen')
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bed">
                  <path d="M2 4v16"/>
                  <path d="M2 8h18a2 2 0 0 1 2 2v10"/>
                  <path d="M2 17h20"/>
                  <path d="M6 8v9"/>
                </svg>
                Linen & Bedding
                @break
              @case('Toiletries')
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-spray-can">
                  <path d="M3 3h.01"/>
                  <path d="M7 5h.01"/>
                  <path d="M11 7h.01"/>
                  <path d="M3 7h.01"/>
                  <path d="M7 9h.01"/>
                  <path d="M11 11h.01"/>
                  <path d="M3 11h.01"/>
                  <path d="M7 13h.01"/>
                  <path d="M11 15h.01"/>
                  <path d="M3 15h.01"/>
                  <rect width="4" height="4" x="15" y="5"/>
                  <path d="m19 9 2 2v10c0 .6-.4 1-1 1h-6c-.6 0-1-.4-1-1V11l2-2"/>
                  <path d="m13 14 8-2"/>
                  <path d="m13 19 8-2"/>
                </svg>
                Toiletries
                @break
              @case('Cleaning')
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-broom">
                  <path d="m9.06 11.9 8.07-8.06a2.85 2.85 0 1 1 4.03 4.03l-8.06 8.08"/>
                  <path d="M7.07 14.94c-1.66 0-3 1.35-3 3.02 0 1.33-2.5 1.52-2 2.02 1.08 1.1 2.49 2.02 4 2.02 2.2 0 4-1.8 4-4.04a3.01 3.01 0 0 0-3-3.02z"/>
                </svg>
                Cleaning Supplies
                @break
              @case('Amenities')
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-gift">
                  <polyline points="20 12 20 22 4 22 4 12"/>
                  <rect width="20" height="5" x="2" y="7"/>
                  <line x1="12" x2="12" y1="22" y2="7"/>
                  <path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"/>
                  <path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"/>
                </svg>
                Guest Amenities
                @break
              @case('Maintenance')
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-tool">
                  <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/>
                </svg>
                Maintenance
                @break
              @default
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package">
                  <path d="m7.5 4.27 9 5.15"/>
                  <path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/>
                  <path d="m3.3 7 8.7 5 8.7-5"/>
                  <path d="M12 22V12"/>
                </svg>
                {{ $stocks->core1_request_category ?? 'Other' }}
            @endswitch
          </span>
        </td>
        <td>
          {{$stocks->core1_request_items	}}
        </td>
        <td>
          <span class="badge gap-1 {{ 
            $stocks->core1_request_status === 'Pending' ? 'badge-warning' : 
            ($stocks->core1_request_status === 'Approved' ? 'badge-info' : 
            ($stocks->core1_request_status === 'Rejected' ? 'badge-error' : 'badge-success'))
          }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-{{
              $stocks->core1_request_status === 'Pending' ? 'clock' : 
              ($stocks->core1_request_status === 'Approved' ? 'check-circle' : 
              ($stocks->core1_request_status === 'Rejected' ? 'x-circle' : 'package-check'))
            }}">
              @if($stocks->core1_request_status === 'Pending')
                <circle cx="12" cy="12" r="10"/>
                <polyline points="12 6 12 12 16 14"/>
              @elseif($stocks->core1_request_status === 'Approved')
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                <path d="m9 11 3 3L22 4"/>
              @elseif($stocks->core1_request_status === 'Rejected')
                <circle cx="12" cy="12" r="10"/>
                <path d="m15 9-6 6"/>
                <path d="m9 9 6 6"/>
              @else
                <path d="m16 16 2 2 4-4"/>
                <path d="M21 10V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l2-1.14"/>
                <path d="m7.5 4.27 9 5.15"/>
              @endif
            </svg>
            {{ ucfirst($stocks->core1_request_status) }}
          </span>
        </td>
        <td>
          <span class="badge gap-1 {{
            $stocks->core1_request_priority === 'Low' ? 'badge-neutral' :
            ($stocks->core1_request_priority === 'Medium' ? 'badge-warning' :
            ($stocks->core1_request_priority === 'High' ? 'badge-error' : 'badge-error'))
          }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-{{
              $stocks->core1_request_priority === 'Low' ? 'chevrons-down' :
              ($stocks->core1_request_priority === 'Medium' ? 'chevron-down' :
              ($stocks->core1_request_priority === 'High' ? 'chevron-up' : 'chevrons-up'))
            }}">
              @if($stocks->core1_request_priority === 'Low')
                <path d="m7 6 5 5 5-5"/>
                <path d="m7 13 5 5 5-5"/>
              @elseif($stocks->core1_request_priority === 'Medium')
                <path d="m6 9 6 6 6-6"/>
              @elseif($stocks->core1_request_priority === 'High')
                <path d="m18 15-6-6-6 6"/>
              @else
                <path d="m7 18 5-5 5 5"/>
                <path d="m7 11 5-5 5 5"/>
              @endif
            </svg>
            {{ ucfirst($stocks->core1_request_priority) }}
          </span>
        </td>
        <td>
          <span class="flex items-center gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar-clock">
              <path d="M21 7.5V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h3.5"/>
              <path d="M16 2v4"/>
              <path d="M8 2v4"/>
              <path d="M3 10h5"/>
              <path d="M17.5 17.5 16 16.25V14"/>
              <path d="M22 16a6 6 0 1 1-12 0 6 6 0 0 1 12 0Z"/>
            </svg>
            {{ $stocks->core1_request_needed }} 
          </span>
        </td>
       <td>
    {{ $stocks->created_at->format('Y-m-d H:i') }} 
    ({{ $stocks->created_at->diffForHumans() }})
</td>
        <td>
          <div class="flex gap-2 flex-col">
          
            <!-- Edit Button (existing) -->
<button class="btn btn-xs btn-ghost" onclick="edit_request_modal_{{$stocks->core1_stockID}}.showModal()" data-id="{{ $stocks->id }}">
  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pencil">
    <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/>
    <path d="m15 5 4 4"/>
  </svg>
  Modify/View
</button>

<!-- Delete Button (existing) -->
<button class="btn btn-xs btn-ghost text-error" onclick="delete_request_modal_{{$stocks->core1_stockID}}.showModal()">
  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2">
    <path d="M3 6h18"/>
    <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
    <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
    <line x1="10" x2="10" y1="11" y2="17"/>
    <line x1="14" x2="14" y1="11" y2="17"/>
  </svg>
Remove
</button>

<!-- Approve Button -->
@if(Auth::user()->role === 'Hotel Admin')

    {{-- PENDING: can Approve or Reject --}}
    @if($stocks->core1_request_status === 'Pending')

        <!-- Approve -->
        <button class="btn btn-xs btn-success text-white"
            onclick="approve_request_modal_{{$stocks->core1_stockID}}.showModal()">
            Approve
        </button>

        <!-- Reject -->
        <button class="btn btn-xs btn-error text-white"
            onclick="reject_request_modal_{{$stocks->core1_stockID}}.showModal()">
            Reject
        </button>

    {{-- APPROVED: can only Deliver --}}
    @elseif($stocks->core1_request_status === 'Approved')

        <!-- Delivered -->
        <button class="btn btn-xs btn-info text-white"
            onclick="delivered_request_modal_{{$stocks->core1_stockID}}.showModal()">
            Delivered
        </button>

    {{-- REJECTED or DELIVERED: no actions --}}
   

    @endif

@endif



<!-- APPROVE REQUEST MODAL -->
<dialog id="approve_request_modal_{{$stocks->core1_stockID}}" class="modal">
  <div class="modal-box">
    <form method="dialog">
      <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
    </form>
    <h3 class="font-bold text-lg">Approve Request</h3>
    <p class="py-4">Are you sure you want to approve this request?</p>
    
    <form action="/approvestockrequest/{{$stocks->core1_stockID}}" method="POST">
      @csrf
      @method('PUT')
      <div class="modal-action">
        <button type="button" class="btn" onclick="approve_request_modal_{{$stocks->core1_stockID}}.close()">Cancel</button>
        <button type="submit" class="btn btn-success">Confirm Approval</button>
      </div>
    </form>
  </div>
  <div class="modal-backdrop" onclick="approve_request_modal_{{$stocks->core1_stockID}}.close()"></div>
</dialog>

<!-- REJECT REQUEST MODAL -->
<dialog id="reject_request_modal_{{$stocks->core1_stockID}}" class="modal">
  <div class="modal-box">
    <form method="dialog">
      <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
    </form>
    <h3 class="font-bold text-lg">Reject Request</h3>
    <p class="py-4">Please provide a reason for rejecting this request.</p>
    
    <form action="/rejectstockrequest/{{$stocks->core1_stockID}}"  method="POST">
      @csrf
      @method('PUT')
     
      
      <div class="modal-action">
        <button type="button" class="btn" onclick="reject_request_modal_{{$stocks->core1_stockID}}.close()">Cancel</button>
        <button type="submit" class="btn btn-error">Confirm Rejection</button>
      </div>
    </form>
  </div>
  <div class="modal-backdrop" onclick="reject_request_modal_{{$stocks->core1_stockID}}.close()"></div>
</dialog>

<!-- DELIVERED REQUEST MODAL -->
<dialog id="delivered_request_modal_{{$stocks->core1_stockID}}" class="modal">
  <div class="modal-box">
    <form method="dialog">
      <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
    </form>
    <h3 class="font-bold text-lg">Mark as Delivered</h3>
    <p class="py-4">Confirm delivery details for this request.</p>
    
    <form action="/deliveredstockrequest/{{$stocks->core1_stockID}}" method="POST">
      @csrf
      @method('PUT')
      
    
      
      
      
      <div class="modal-action">
        <button type="button" class="btn" onclick="delivered_request_modal_{{$stocks->core1_stockID}}.close()">Cancel</button>
        <button type="submit" class="btn btn-info">Mark as Delivered</button>
      </div>
    </form>
  </div>
  <div class="modal-backdrop" onclick="delivered_request_modal_{{$stocks->core1_stockID}}.close()"></div>
</dialog>
          </div>
        </td>
      </tr>
    @empty
      <tr>
        <td colspan="9">
          <div class="flex flex-col items-center justify-center py-12 gap-4 text-gray-500">
            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package-x">
              <path d="M21 10V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l2-1.14"/>
              <path d="m7.5 4.27 9 5.15"/>
              <polyline points="3.29 7 12 12 20.71 7"/>
              <line x1="12" x2="12" y1="22" y2="12"/>
              <path d="m17 13 5 5m-5 0 5-5"/>
            </svg>
            <h3 class="text-lg font-medium">No stock requests found</h3>
            <p class="text-sm">Create your first stock request to get started</p>
            <button class="btn btn-primary mt-4" onclick="request_modal.showModal()">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus">
                <path d="M5 12h14"/>
                <path d="M12 5v14"/>
              </svg>
              Create Request
            </button>
          </div>
        </td>
      </tr>
    @endforelse
  </tbody>
</table>
</div>
  </div>
</section>

<!-- Initialize Lucide Icons -->
<script src="https://unpkg.com/lucide@latest"></script>
<script>
  lucide.createIcons();
</script>
<!-- Initialize Lucide Icons -->
<script src="https://unpkg.com/lucide@latest"></script>
<script>
  lucide.createIcons();
</script>
  
           
      
 
        </main>
      </div>
    </div>

    {{-- modals --}}
 
    @include('admin.components.ias.create')
    @include('admin.components.ias.createrequest')
    @foreach ($inventory as $inv)
        @include('admin.components.ias.update')
        @include('admin.components.ias.delete')
    @endforeach
    @foreach ($stock as $stocks)
        @include('admin.components.ias.editrequest')
        @include('admin.components.ias.deleterequest')
    @endforeach
  
 
  </body>

  @endauth
  @include('javascriptfix.soliera_js')

  <script src="{{asset('javascript/photouploadglobal.js')}}"></script>
  
</html>