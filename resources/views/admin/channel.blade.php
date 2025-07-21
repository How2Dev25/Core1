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
    <!-- Channel A Card -->
    <div class="card bg-base-200 shadow-sm">
      <div class="card-body">
        <div class="flex items-center gap-3 mb-3">
          <div class="avatar placeholder">
                <img class="w-40 h-40 rounded-md shadow-md" src="{{asset('images/rbnb/tarastay.png')}}" alt="">
          </div>
          <h3 class="card-title">TaraStay </h3>
          <div class="badge badge-success gap-1 ml-auto">
            <i class="w-3 h-3" data-lucide="check"></i>
            Connected
          </div>
        </div>
        <p class="text-sm opacity-75 mb-4">Last sync: 15 minutes ago</p>
        <div class="card-actions justify-between">
          <div class="stats stats-horizontal shadow bg-base-100">
            <div class="stat">
              <div class="stat-title">Listings</div>
              <div class="stat-value text-sm">24</div>
            </div>
            <div class="stat">
              <div class="stat-title">Bookings</div>
              <div class="stat-value text-sm">12</div>
            </div>
          </div>
          <button class="btn btn-ghost btn-sm">
            <i class="w-4 h-4" data-lucide="chevron-right"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Channel B Card -->
    <div class="card bg-base-200 shadow-sm">
      <div class="card-body">
        <div class="flex items-center gap-3 mb-3">
          <div class="avatar placeholder">
            <img class="w-40 h-40 rounded-md shadow-md" src="{{asset('images/rbnb/habistay.png')}}" alt="">
          </div>
          <h3 class="card-title">HabiStay</h3>
          <div class="badge badge-success gap-1 ml-auto">
            <i class="w-3 h-3" data-lucide="check"></i>
            Connected
          </div>
        </div>
        <p class="text-sm opacity-75 mb-4">Last sync: 1 hour ago</p>
        <div class="card-actions justify-between">
          <div class="stats stats-horizontal shadow bg-base-100">
            <div class="stat">
              <div class="stat-title">Listings</div>
              <div class="stat-value text-sm">24</div>
            </div>
            <div class="stat">
              <div class="stat-title">Bookings</div>
              <div class="stat-value text-sm">8</div>
            </div>
          </div>
          <button class="btn btn-ghost btn-sm">
            <i class="w-4 h-4" data-lucide="chevron-right"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Channel C Card -->
    <div class="card bg-base-200 shadow-sm">
      <div class="card-body">
        <div class="flex items-center gap-3 mb-3">
          <div class="avatar placeholder">
           <img class="w-40 h-40 rounded-md shadow-md" src="{{asset('images/rbnb/nestscape.png')}}" alt="">
          </div>
          <h3 class="card-title">nestscape</h3>
            <div class="badge badge-success gap-1 ml-auto">
            <i class="w-3 h-3" data-lucide="check"></i>
            Connected
          </div>
        </div>
        <p class="text-sm opacity-75 mb-4">Last sync: 3 days ago</p>
        <div class="card-actions justify-between">
          <div class="stats stats-horizontal shadow bg-base-100">
            <div class="stat">
              <div class="stat-title">Listings</div>
              <div class="stat-value text-sm">18</div>
            </div>
            <div class="stat">
              <div class="stat-title">Bookings</div>
              <div class="stat-value text-sm">0</div>
            </div>
          </div>
          <button class="btn btn-ghost btn-sm">
            <i class="w-4 h-4" data-lucide="chevron-right"></i>
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Add New Channel Section -->
 

  <!-- Channel Sync Status Section -->
  <div class="bg-base-200 rounded-box p-6">
    <h3 class="text-lg font-semibold mb-4 flex items-center gap-2">
      <i class="w-5 h-5" data-lucide="activity"></i>
      Sync Status
    </h3>
    
    <div class="overflow-x-auto">
      <table class="table">
        <thead>
          <tr>
            <th>Channel</th>
            <th>Status</th>
            <th>Last Sync</th>
            <th>Listings</th>
            <th>Bookings</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <div class="flex items-center gap-2">
                <div class="avatar placeholder">
                  <div class="w-6 rounded bg-primary text-primary-content">
                    <span class="text-xs">A</span>
                  </div>
                </div>
                Channel A
              </div>
            </td>
            <td>
              <div class="badge badge-success gap-1">
                <i class="w-3 h-3" data-lucide="check"></i>
                Active
              </div>
            </td>
            <td>15 min ago</td>
            <td>24</td>
            <td>12</td>
            <td>
              <button class="btn btn-ghost btn-xs">
                <i class="w-4 h-4" data-lucide="sync"></i>
              </button>
            </td>
          </tr>
          <tr>
            <td>
              <div class="flex items-center gap-2">
                <div class="avatar placeholder">
                  <div class="w-6 rounded bg-secondary text-secondary-content">
                    <span class="text-xs">B</span>
                  </div>
                </div>
                Channel B
              </div>
            </td>
            <td>
              <div class="badge badge-success gap-1">
                <i class="w-3 h-3" data-lucide="check"></i>
                Active
              </div>
            </td>
            <td>1 hour ago</td>
            <td>24</td>
            <td>8</td>
            <td>
              <button class="btn btn-ghost btn-xs">
                <i class="w-4 h-4" data-lucide="sync"></i>
              </button>
            </td>
          </tr>
          <tr>
            <td>
              <div class="flex items-center gap-2">
                <div class="avatar placeholder">
                  <div class="w-6 rounded bg-accent text-accent-content">
                    <span class="text-xs">C</span>
                  </div>
                </div>
                Channel C
              </div>
            </td>
            <td>
              <div class="badge badge-error gap-1">
                <i class="w-3 h-3" data-lucide="alert-circle"></i>
                Disconnected
              </div>
            </td>
            <td>3 days ago</td>
            <td>18</td>
            <td>0</td>
            <td>
              <button class="btn btn-ghost btn-xs">
                <i class="w-4 h-4" data-lucide="refresh-cw"></i>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</section>

<!-- Initialize Lucide Icons -->
<script>
  lucide.createIcons();
</script>

        


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
 
   
  
 
  </body>
  @include('javascriptfix.soliera_js')

  <script src="{{asset('javascript/photouploadglobal.js')}}"></script>
  
</html>