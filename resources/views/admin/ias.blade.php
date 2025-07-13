<!DOCTYPE html>
<html lang="en" data-theme ="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    @vite('resources/css/app.css')
 
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <title>{{$title}} - Hotel Marketing And Promotion</title>
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
            <h1 class="text-2xl font-bold bg-white bg-clip-text text-[#191970]">Hotel Marketing And Promotion</h1>
          </div>
            {{-- Subsystem Name --}}

          {{-- content --}}
       <section class="p-4 bg-base-100 rounded-box space-y-6">
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
    <div class="stats shadow-sm bg-base-200">
      <div class="stat p-3">
        <div class="stat-title">Total Items</div>
        <div class="stat-value text-primary text-lg">287</div>
      </div>
    </div>
    
    <div class="stats shadow-sm bg-base-200">
      <div class="stat p-3">
        <div class="stat-title">In Stock</div>
        <div class="stat-value text-success text-lg">243</div>
      </div>
    </div>
    
    <div class="stats shadow-sm bg-base-200">
      <div class="stat p-3">
        <div class="stat-title">Low Stock</div>
        <div class="stat-value text-warning text-lg">19</div>
      </div>
    </div>
    
    <div class="stats shadow-sm bg-base-200">
      <div class="stat p-3">
        <div class="stat-title">Out of Stock</div>
        <div class="stat-value text-error text-lg">5</div>
      </div>
    </div>
  </div>

 
  <!-- Inventory Table -->
  <div class="overflow-x-auto rounded-box border border-base-300">
    <table class="table table-sm">
      <thead class="bg-base-200">
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
            <span class="font-bold">{{$inv->core1_inventory_stocks}}</span>
          </td>
          <td>{{$inv->core1_inventory_threshold}}</td>
          <td>{{$inv->core1_inventory_unit}}</td>
          <td>
            <button class="btn btn-ghost btn-xs">
              <i data-lucide="eye" class="w-4 h-4"></i>
            </button>
            <button class="btn btn-ghost btn-xs">
              <i data-lucide="edit" class="w-4 h-4"></i>
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
    
    <div class="overflow-x-auto rounded-box border border-base-300">
      <table class="table table-sm">
        <thead class="bg-base-200">
          <tr>
            <th>Request ID</th>
            <th>Department</th>
            <th>Items</th>
            <th>Status</th>
            <th>Date</th>
          </tr>
        </thead>
        <tbody>
          <!-- Request 1 -->
          <tr>
            <td class="font-bold">REQ-045</td>
            <td>Housekeeping</td>
            <td>Towels, Pillows</td>
            <td>
              <span class="badge badge-sm badge-info">Processing</span>
            </td>
            <td>Today</td>
          </tr>
          
          <!-- Request 2 -->
          <tr>
            <td class="font-bold">REQ-044</td>
            <td>Restaurant</td>
            <td>Coffee, Sugar</td>
            <td>
              <span class="badge badge-sm badge-warning">Pending</span>
            </td>
            <td>Yesterday</td>
          </tr>
          
          <!-- Request 3 -->
          <tr>
            <td class="font-bold">REQ-043</td>
            <td>Maintenance</td>
            <td>Light Bulbs</td>
            <td>
              <span class="badge badge-sm badge-success">Approved</span>
            </td>
            <td>2 days ago</td>
          </tr>
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
  
 
  </body>
  @include('javascriptfix.soliera_js')

  <script src="{{asset('javascript/photouploadglobal.js')}}"></script>
  
</html>