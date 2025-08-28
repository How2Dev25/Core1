<!DOCTYPE html>
<html lang="en" data-theme ="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

 
    <script src="https://unpkg.com/lucide@latest"></script>
    
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
            <h1 class="text-2xl font-bold bg-white bg-clip-text text-[#191970]">Hotel Admin Dashboard</h1>
          </div>
            {{-- Subsystem Name --}}

     <section class="flex-1 p-6">
            <!-- Header -->
            
            <!-- Revenue Section -->
            <div class="mb-8">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-800">Revenue Metrics</h2>
                    
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    <!-- Total Revenue -->
                    <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Total Revenue</h3>
                                <p class="text-3xl font-bold text-gray-800 mt-2">$245,837</p>
                                <div class="flex items-center mt-3">
                                    <span class="text-green-500 text-sm font-medium flex items-center">
                                        <i class="fa-solid fa-arrow-up mr-1"></i>
                                        18.2%
                                    </span>
                                    <span class="text-sm text-gray-500 ml-2">vs last month</span>
                                </div>
                            </div>
                            <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
                                <i class="fa-solid fa-dollar-sign text-yellow-400 text-2xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Average Daily Rate -->
                    <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Avg Daily Rate</h3>
                                <p class="text-3xl font-bold text-gray-800 mt-2">$189</p>
                                <div class="flex items-center mt-3">
                                    <span class="text-green-500 text-sm font-medium flex items-center">
                                        <i class="fa-solid fa-arrow-up mr-1"></i>
                                        5.3%
                                    </span>
                                    <span class="text-sm text-gray-500 ml-2">vs last month</span>
                                </div>
                            </div>
                            <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
                                <i class="fa-solid fa-chart-line text-yellow-400 text-2xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Revenue Per Available Room -->
                    <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">RevPAR</h3>
                                <p class="text-3xl font-bold text-gray-800 mt-2">$142</p>
                                <div class="flex items-center mt-3">
                                    <span class="text-green-500 text-sm font-medium flex items-center">
                                        <i class="fa-solid fa-arrow-up mr-1"></i>
                                        7.6%
                                    </span>
                                    <span class="text-sm text-gray-500 ml-2">vs last month</span>
                                </div>
                            </div>
                            <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
                                <i class="fa-solid fa-house-chimney text-yellow-400 text-2xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Occupancy Rate -->
                    <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Occupancy Rate</h3>
                                <p class="text-3xl font-bold text-gray-800 mt-2">78.5%</p>
                                <div class="flex items-center mt-3">
                                    <span class="text-green-500 text-sm font-medium flex items-center">
                                        <i class="fa-solid fa-arrow-up mr-1"></i>
                                        2.1%
                                    </span>
                                    <span class="text-sm text-gray-500 ml-2">vs last month</span>
                                </div>
                            </div>
                            <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
                                <i class="fa-solid fa-bed text-yellow-400 text-2xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Stats Grid -->
            <div class="mb-8">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-800">Operational Metrics</h2>
                    <button class="text-blue-600 text-sm font-medium flex items-center">
                        <span>View Details</span>
                        <i class="fas fa-chevron-right ml-1 text-xs"></i>
                    </button>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    <!-- Total Reservations -->
                    <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Total Reservations</h3>
                                <p class="text-3xl font-bold text-gray-800 mt-2">   {{ number_format($totalreservation) }}</p>
                                <div class="flex items-center mt-3">
                                    <span class="text-green-500 text-sm font-medium flex items-center">
                                        <i class="fa-solid fa-arrow-up mr-1"></i>
                                       {{ number_format($reservationGrowthMonth, 1) }}%
                                    </span>
                                    <span class="text-sm text-gray-500 ml-2">vs last month</span>
                                </div>
                            </div>
                            <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
                                <i class="fa-solid fa-calendar-check text-yellow-400 text-2xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Reservations This Week -->
                    <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">This Week</h3>
                                <p class="text-3xl font-bold text-gray-800 mt-2"> {{ number_format($reservationThisWeek) }}</p>
                                <div class="flex items-center mt-3">
                                    <span class="text-green-500 text-sm font-medium flex items-center">
                                        <i class="fa-solid fa-arrow-up mr-1"></i>
                                        {{ number_format($reservationGrowthWeek, 1) }}%
                                    </span>
                                    <span class="text-sm text-gray-500 ml-2">vs last week</span>
                                </div>
                            </div>
                            <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
                                <i class="fa-solid fa-chart-line text-yellow-400 text-2xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Total Rooms -->
                    <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Total Rooms</h3>
                                <p class="text-3xl font-bold text-gray-800 mt-2">  {{ number_format($totalrooms) }}</p>
                                <div class="flex items-center mt-3">
                                    <span class="text-blue-500 text-sm font-medium">   {{ number_format($occupancyRate, 1) }}%</span>
                                    <span class="text-sm text-gray-500 ml-2">occupancy</span>
                                </div>
                            </div>
                            <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
                                <i class="fa-solid fa-bed text-yellow-400 text-2xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Rooms Needing Maintenance -->
                    <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Need Maintenance</h3>
                                <p class="text-3xl font-bold text-gray-800 mt-2">  {{ number_format($needmaintenance) }}</p>
                                <div class="flex items-center mt-3">
                                    <span class="text-amber-500 text-sm font-medium">{{ number_format($maintenanceRate, 1) }}%</span>
                                    <span class="text-sm text-gray-500 ml-2">of total</span>
                                </div>
                            </div>
                            <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
                                <i class="fa-solid fa-screwdriver-wrench text-yellow-400 text-2xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Secondary Stats Grid -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Additional Metrics</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    <!-- Total Employees -->
                    <div class="bg-white rounded-xl border border-gray-100 p-5 shadow-md card-hover stat-card">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Total Employees</h3>
                                <p class="text-2xl font-bold text-gray-800 mt-2">{{ number_format($totalemployees) }}</p>
                            </div>
                            <div class="w-14 h-14 rounded-lg flex items-center justify-center bg-blue-900">
                                <i class="fa-solid fa-users text-yellow-400 text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Guest Accounts -->
                    <div class="bg-white rounded-xl border border-gray-100 p-5 shadow-md card-hover stat-card">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Guest Accounts</h3>
                                <p class="text-2xl font-bold text-gray-800 mt-2">{{ number_format($guestacccount) }}</p>
                            </div>
                            <div class="w-14 h-14 rounded-lg flex items-center justify-center bg-blue-900">
                                <i class="fa-solid fa-user text-yellow-400 text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Room Markets -->
                    <div class="bg-white rounded-xl border border-gray-100 p-5 shadow-md card-hover stat-card">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Room Markets</h3>
                                <p class="text-2xl font-bold text-gray-800 mt-2">{{ number_format($roommarkets) }}</p>
                            </div>
                            <div class="w-14 h-14 rounded-lg flex items-center justify-center bg-blue-900">
                                <i class="fa-solid fa-globe text-yellow-400 text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Channel Listings -->
                    <div class="bg-white rounded-xl border border-gray-100 p-5 shadow-md card-hover stat-card">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Channel Listings</h3>
                                <p class="text-2xl font-bold text-gray-800 mt-2">{{ number_format($channellisting) }}</p>
                            </div>
                            <div class="w-14 h-14 rounded-lg flex items-center justify-center bg-blue-900">
                                <i class="fa-solid fa-tv text-yellow-400 text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Marketing & Loyalty Stats -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Marketing & Events</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Active Campaigns -->
                    <div class="bg-white rounded-xl border border-gray-100 p-5 shadow-md card-hover stat-card">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Active Campaigns</h3>
                                <p class="text-2xl font-bold text-gray-800 mt-2">{{ number_format($activecampaigns) }}</p>
                            </div>
                            <div class="w-14 h-14 rounded-lg flex items-center justify-center bg-blue-900">
                                <i class="fa-solid fa-bullhorn text-yellow-400 text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Loyalty Programs -->
                    <div class="bg-white rounded-xl border border-gray-100 p-5 shadow-md card-hover stat-card">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Loyalty & Rewards</h3>
                                <p class="text-2xl font-bold text-gray-800 mt-2">{{ number_format($loyaltyandrewards) }}</p>
                                <p class="text-xs text-gray-500 mt-1">Room & Food packages</p>
                            </div>
                            <div class="w-14 h-14 rounded-lg flex items-center justify-center bg-blue-900">
                                <i class="fa-solid fa-star text-yellow-400 text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Total Events -->
                    <div class="bg-white rounded-xl border border-gray-100 p-5 shadow-md card-hover stat-card">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Total Events</h3>
                                <p class="text-2xl font-bold text-gray-800 mt-2">{{ number_format($totalevents) }}</p>
                            </div>
                            <div class="w-14 h-14 rounded-lg flex items-center justify-center bg-blue-900">
                                <i class="fa-solid fa-calendar-days text-yellow-400 text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Graph Section -->
            <div class="mt-10">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Reservations Trend (7 days) -->
                    <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-sm font-medium text-gray-600">Reservations (Last 7 Days)</h3>
                            <i class="fa-solid fa-calendar-check text-blue-900"></i>
                        </div>
                        <div class="chart-container bg-gray-50 rounded-lg flex items-center justify-center">
                          <canvas id="reservationsChart"></canvas>
                        </div>
                    </div>

                    <!-- Rooms -->
                    <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-sm font-medium text-gray-600">Rooms Overview</h3>
                            <i class="fa-solid fa-bed text-blue-900"></i>
                        </div>
                        <div class="chart-container bg-gray-50 rounded-lg flex items-center justify-center">
                             <canvas id="roomsChart"></canvas>
                        </div>
                    </div>

                    <!-- Employees vs Guests -->
                    <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-sm font-medium text-gray-600">Employees vs Guests</h3>
                            <i class="fa-solid fa-users text-blue-900"></i>
                        </div>
                        <div class="chart-container bg-gray-50 rounded-lg flex items-center justify-center">
                            <canvas id="employeesGuestsChart"></canvas>
                        </div>
                    </div>

                    <!-- Marketing -->
                    <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-sm font-medium text-gray-600">Marketing & Channels</h3>
                            <i class="fa-solid fa-bullhorn text-blue-900"></i>
                        </div>
                        <div class="chart-container bg-gray-50 rounded-lg flex items-center justify-center">
                              <canvas id="marketingChart"></canvas>
                        </div>
                    </div>

                    <!-- Loyalty -->
                    <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-sm font-medium text-gray-600">Loyalty & Rewards</h3>
                            <i class="fa-solid fa-star text-blue-900"></i>
                        </div>
                        <div class="chart-container bg-gray-50 rounded-lg flex items-center justify-center">
                              <canvas id="loyaltyChart"></canvas>
                        </div>
                    </div>

                    <!-- Events -->
                    <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-sm font-medium text-gray-600">Events (Monthly)</h3>
                            <i class="fa-solid fa-calendar-days text-blue-900"></i>
                        </div>
                        <div class="chart-container bg-gray-50 rounded-lg flex items-center justify-center">
                             <canvas id="eventsChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </section>


    <!-- Graph Section -->


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    // Reservations (Last 7 Days)
    new Chart(document.getElementById('reservationsChart'), {
        type: 'line',
        data: {
            labels: {!! json_encode($reservationsLast7Days->pluck('date')) !!},
            datasets: [{
                label: 'Reservations',
                data: {!! json_encode($reservationsLast7Days->pluck('count')) !!},
                borderColor: '#2563eb',
                backgroundColor: 'rgba(37, 99, 235, 0.2)',
                fill: true,
                tension: 0.3
            }]
        }
    });

    // Rooms
    new Chart(document.getElementById('roomsChart'), {
        type: 'doughnut',
        data: {
            labels: ['Available', 'Maintenance'],
            datasets: [{
                data: [{{ $totalrooms - $needmaintenance }}, {{ $needmaintenance }}],
                backgroundColor: ['#22c55e', '#f59e0b']
            }]
        }
    });

    // Employees vs Guests
    new Chart(document.getElementById('employeesGuestsChart'), {
        type: 'bar',
        data: {
            labels: ['Employees', 'Guests'],
            datasets: [{
                label: 'Count',
                data: [{{ $totalemployees }}, {{ $guestacccount }}],
                backgroundColor: ['#3b82f6', '#f43f5e']
            }]
        }
    });

    // Marketing
    new Chart(document.getElementById('marketingChart'), {
        type: 'bar',
        data: {
            labels: ['Markets', 'Channels', 'Campaigns'],
            datasets: [{
                label: 'Count',
                data: [{{ $roommarkets }}, {{ $channellisting }}, {{ $activecampaigns }}],
                backgroundColor: ['#8b5cf6', '#06b6d4', '#f97316']
            }]
        }
    });

    // Loyalty
    new Chart(document.getElementById('loyaltyChart'), {
        type: 'pie',
        data: {
            labels: ['Rewards'],
            datasets: [{
                data: [{{ $loyaltyandrewards }}],
                backgroundColor: ['#eab308']
            }]
        }
    });

    // Events (Monthly)
    new Chart(document.getElementById('eventsChart'), {
        type: 'line',
        data: {
            labels: {!! json_encode($eventsByMonth->pluck('month')) !!},
            datasets: [{
                label: 'Events',
                data: {!! json_encode($eventsByMonth->pluck('count')) !!},
                borderColor: '#10b981',
                backgroundColor: 'rgba(16,185,129,0.2)',
                fill: true,
                tension: 0.3
            }]
        }
    });
});
</script>


    </div>


 

<!-- Initialize Lucide Icons -->
<script>
  lucide.createIcons();
</script>

        


           
      
 
        </main>
      </div>
    </div>

   
    {{-- modals --}}

    @include('admin.components.frontdesk.viewroom')
    
   
   @livewireScripts
  @include('javascriptfix.soliera_js')
  </body>
@endauth


  
</html>