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

            {{-- greetings --}}
            @if(session('showwelcome'))
                <div class="card bg-gradient-to-r from-[#001f54] to-[#003366] text-primary-content shadow-2xl mb-8"
            id="welcomeCard" data-aos="fade-up" data-aos-duration="1000">
            <div class="card-body relative">
                <!-- Close (X) Button on Top Right -->
                <button class="absolute top-4 right-4 text-primary-content/70 hover:text-red-400 transition"
                        onclick="dismissWelcome()">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>

                <!-- Grid Layout -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 items-center">
                    <!-- Avatar (Large & Centered Vertically) -->
                    <div class="flex justify-center md:justify-start md:col-span-1">
                    <div class="avatar relative w-28 h-28 md:w-32 md:h-32 rounded-full overflow-hidden bg-blue-500 shadow-lg flex items-center justify-center">
                            <span class="text-white font-bold text-lg md:text-xl">
                                {{ strtoupper(substr(Auth::user()->employee_name ?? Auth::user()->name, 0, 2)) }}
                            </span>
                        </div>
                    </div>

                    <!-- Welcome Text + Position/Role -->
                    <div class="flex flex-col items-center md:items-start col-span-3">
                        <h2 class="text-2xl md:text-3xl font-bold mb-1 text-center md:text-left">
                            Welcome back, {{ Auth::user()->employee_name }}!
                        </h2>
                        <p class="text-base md:text-lg opacity-90 mt-1 text-center md:text-left">
                            We hope you're enjoying your work today
                        </p>

                        <!-- Badges -->
                        <div class="flex items-center gap-2 mt-3 justify-center md:justify-start flex-wrap">
                        
                                <div class="badge badge-secondary">{{Auth::user()->role}}</div>
                        
                            <div class="badge badge-outline badge-primary-content">{{ Auth::user()->status ?? 'Active' }}</div>
                        </div>

                        <!-- View My Profile Button -->
                        <div class="flex justify-center md:justify-start mt-6 w-full">
                            <a href="" 
                            class="btn btn-primary flex items-center gap-2 px-4 py-2 text-sm md:text-base w-full md:w-auto">
                                <i data-lucide="user" class="w-5 h-5"></i>
                                <span>View My Profile</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
                </div>
            @endif
         {{-- greetings --}}
            <!-- Revenue Section -->
       
            @include('admin.components.dashboard.cards')
            @include('admin.components.dashboard.graphs')

            
        </section>


    <!-- Graph Section -->

    
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
<script>
    AOS.init({
        duration: 1000,
        once: true
    });
</script>



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

<script>
document.addEventListener('DOMContentLoaded', function () {
    const labels = {!! json_encode($last30DaysLabels) !!};

    const datasets = {
        revenue: {!! json_encode($revenueLast30Days) !!},
        adr: {!! json_encode($avgDailyRateLast30Days) !!},
        revpar: {!! json_encode($revPARLast30Days) !!},
        occupancy: {!! json_encode($occupancyLast30Days) !!}
    };

    const colors = {
        revenue: { border: '#2563eb', bg: 'rgba(37,99,235,0.2)' },
        adr: { border: '#f97316', bg: 'rgba(249,115,22,0.2)' },
        revpar: { border: '#10b981', bg: 'rgba(16,185,129,0.2)' },
        occupancy: { border: '#8b5cf6', bg: 'rgba(139,92,246,0.2)' }
    };

    const ctx = document.getElementById('trendChart').getContext('2d');

    const trendChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels,
            datasets: [{
                label: 'Revenue',
                data: datasets.revenue,
                borderColor: colors.revenue.border,
                backgroundColor: colors.revenue.bg,
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: { mode: 'index', intersect: false },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(ctx) {
                            const type = document.getElementById('trendSelector').value;
                            const val = ctx.parsed.y ?? 0;
                            if (type === 'occupancy') return ` ${val.toFixed(2)}%`;
                            return ` ₱${Number(val).toLocaleString()}`;
                        }
                    }
                },
                legend: { display: false }
            },
            scales: { y: { beginAtZero: true } }
        }
    });

    document.getElementById('trendSelector').addEventListener('change', function () {
        const type = this.value;
        trendChart.data.datasets[0].data = datasets[type];
        trendChart.data.datasets[0].label = this.options[this.selectedIndex].text;
        trendChart.data.datasets[0].borderColor = colors[type].border;
        trendChart.data.datasets[0].backgroundColor = colors[type].bg;
        trendChart.update();
    });
});
</script>


 <script>
        function dismissWelcome() {
            document.getElementById('welcomeCard').style.display = 'none';
        }
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