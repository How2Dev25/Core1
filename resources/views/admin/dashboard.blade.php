<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


    <script src="https://unpkg.com/lucide@latest"></script>

    <title>{{$title}} - Dashboard</title>
    @livewireStyles
</head>

<style>
    /* Scroll Animation Classes */
    .scroll-animate {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.6s ease-out;
    }

    .scroll-animate.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .scroll-animate-left {
        opacity: 0;
        transform: translateX(-30px);
        transition: all 0.6s ease-out;
    }

    .scroll-animate-left.visible {
        opacity: 1;
        transform: translateX(0);
    }

    .scroll-animate-right {
        opacity: 0;
        transform: translateX(30px);
        transition: all 0.6s ease-out;
    }

    .scroll-animate-right.visible {
        opacity: 1;
        transform: translateX(0);
    }

    .scroll-animate-scale {
        opacity: 0;
        transform: scale(0.8);
        transition: all 0.6s ease-out;
    }

    .scroll-animate-scale.visible {
        opacity: 1;
        transform: scale(1);
    }

    /* Counter Animation */
    .counter {
        font-variant-numeric: tabular-nums;
    }
</style>

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
                    <div class="pb-5 border-b border-base-300 scroll-animate">
                        <h1 class="text-2xl font-bold bg-white bg-clip-text text-[#191970]">Hotel Admin Dashboard</h1>
                    </div>
                    {{-- Subsystem Name --}}

                    <section class="flex-1 p-6 ">
                        <!-- Header with Greeting -->
                        <div class="scroll-animate">
                            @include('admin.components.dashboard.welcome')
                        </div>

                        <!-- Rooms & Events Showcase -->
                        <div class="scroll-animate-left">
                            @include('admin.components.dashboard.roomsandevents')
                        </div>

                        {{-- facilities and events and promotioes --}}
                        <div class="scroll-animate-right">
                            @include('admin.components.dashboard.showfacility')
                        </div>


                        <div class="grid grid-cols-2 gap-5 max-md:grid-cols-1">
                            <div class="scroll-animate-left">
                                @include('admin.components.dashboard.showmarketing')
                            </div>
                            <div class="scroll-animate-right">
                                @include('admin.components.dashboard.showevents')
                            </div>

                        </div>

                        <div class="grid grid-cols-2 max-md:grid-cols-1">
                                <div class="scroll-animate-left">
                                    @include('admin.components.dashboard.recentactivities')
                                </div>
                                <div class="scroll-animate-right">
                                    @include('admin.components.dashboard.community')
                                </div>

                        </div>

                        <!-- Revenue Metrics Section -->
                        <div class="flex gap-5 max-md:flex-col">
                            <div class="w-full scroll-animate-scale">
                                @include('admin.components.dashboard.cards')
                            </div>
                            <!-- Recent Activities -->

                        </div>

                        <div class="scroll-animate-left">
                            @include('admin.components.dashboard.operationalmetrics')
                        </div>


                        <!-- Revenue Chart & Bookings Overview -->
                        <div class="scroll-animate-right">
                            @include('admin.components.dashboard.revenueandbooking')
                        </div>

                        <!-- Additional Metrics Section -->
                        <div class="scroll-animate-scale">
                            @include('admin.components.dashboard.additionalmetrics')
                        </div>

                        <!-- Marketing & Events and loyalty Section -->
                        <div class="scroll-animate-left">
                            @include('admin.components.dashboard.marketingeventsandloyalty')
                        </div>



                        <!-- Analytics And Graphs Section -->
                        <div class="scroll-animate-right">
                            @include('admin.components.dashboard.analyticsandgraphcs')
                        </div>
                        <!-- Chart Modal -->
                        <div id="chartModal"
                            class="hidden fixed inset-0 backdrop-blur-xs  bg-opacity-40 flex items-center justify-center z-50">
                            <div id="modalContent"
                                class="bg-white rounded-2xl p-6 shadow-2xl w-[90%] md:w-[70%] lg:w-[60%] relative transform transition-all duration-300 scale-75 opacity-0">

                                <!-- Close Button -->
                                <button onclick="closeModal()"
                                    class="absolute top-3 right-3 text-gray-500 hover:text-gray-800">
                                    <i class="fa-solid fa-xmark text-xl"></i>
                                </button>

                                <!-- Title + Optional Select -->
                                <div class="flex items-center justify-between mb-4">
                                    <h3 id="modalTitle" class="text-lg font-semibold text-gray-700"></h3>
                                    <select id="modalTrendSelector"
                                        class="hidden border border-gray-300 rounded px-2 py-1 text-sm">
                                        <option value="revenue">Revenue</option>
                                        <option value="adr">Avg Daily Rate</option>
                                        <option value="revpar">RevPAR</option>
                                        <option value="occupancy">Occupancy Rate</option>
                                    </select>
                                </div>

                                <!-- Expanded Chart -->
                                <div class="flex items-center justify-center">
                                    <canvas id="expandedChart" class="w-full h-[400px]"></canvas>
                                </div>
                            </div>
                        </div>

                        <script>
                            let activeChart = null;

                            function openModal(chartId, title) {
                                const modal = document.getElementById('chartModal');
                                const modalContent = document.getElementById('modalContent');
                                const modalTitle = document.getElementById('modalTitle');

                                modalTitle.textContent = title;
                                modal.classList.remove('hidden');

                                setTimeout(() => {
                                    modalContent.classList.remove("scale-75", "opacity-0");
                                    modalContent.classList.add("scale-100", "opacity-100");
                                }, 10);

                                if (activeChart) activeChart.destroy();

                                const chartCanvas = document.getElementById(chartId);
                                const chartInstance = Chart.getChart(chartCanvas);

                                if (chartInstance) {
                                    const ctx = document.getElementById('expandedChart').getContext('2d');
                                    activeChart = new Chart(ctx, {
                                        type: chartInstance.config.type,
                                        data: JSON.parse(JSON.stringify(chartInstance.config.data)),
                                        options: JSON.parse(JSON.stringify(chartInstance.config.options)),
                                    });
                                }
                            }

                            function closeModal() {
                                const modal = document.getElementById('chartModal');
                                const modalContent = document.getElementById('modalContent');

                                modalContent.classList.remove("scale-100", "opacity-100");
                                modalContent.classList.add("scale-75", "opacity-0");

                                setTimeout(() => {
                                    modal.classList.add('hidden');
                                    if (activeChart) { activeChart.destroy(); activeChart = null; }
                                }, 300);
                            }
                        </script>
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


                    <script src="{{ asset('javascript/chart.js') }}">

                    </script>

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
                                    labels: ['Available', 'Maintenance', 'Reserved'],
                                    datasets: [{
                                        data: [
                                                                                                                                                                                                            {{ $totalrooms - $needmaintenance - $totalreservation }}, // Available
                                                                                                                                                                                                            {{ $needmaintenance }}, // Maintenance
                                            {{ $totalreservation }}  // Reserved
                                        ],
                                        backgroundColor: [
                                            '#22c55e', // Green - Available
                                            '#f59e0b', // Yellow - Maintenance
                                            '#3b82f6'  // Blue - Reserved
                                        ]
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    plugins: {
                                        legend: {
                                            position: 'bottom'
                                        }
                                    }
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
                                                label: function (ctx) {
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






            </div>




            <!-- Initialize Lucide Icons -->
            <script>
                lucide.createIcons();
            </script>

            <!-- Scroll Animation and Counter -->
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const observerOptions = {
                        threshold: 0.1,
                        rootMargin: '0px 0px -50px 0px'
                    };

                    // Track which counters have been animated
                    const animatedCounters = new Set();

                    const observer = new IntersectionObserver(function(entries) {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                entry.target.classList.add('visible');

                                // Start counter animation for elements with counter class
                                const counters = entry.target.querySelectorAll('.counter');
                                counters.forEach(counter => {
                                    const counterId = counter.getAttribute('data-target') + '-' + counter.textContent;
                                    if (!animatedCounters.has(counterId)) {
                                        animatedCounters.add(counterId);
                                        animateCounter(counter);
                                    }
                                });
                            }
                        });
                    }, observerOptions);

                    // Observe all scroll-animate elements
                    document.querySelectorAll('.scroll-animate, .scroll-animate-left, .scroll-animate-right, .scroll-animate-scale').forEach(el => {
                        observer.observe(el);
                    });

                    // Also check for counters that are already visible on page load
                    const initialCounters = document.querySelectorAll('.counter');
                    initialCounters.forEach(counter => {
                        const rect = counter.getBoundingClientRect();
                        const isVisible = rect.top < window.innerHeight && rect.bottom > 0;
                        if (isVisible) {
                            const counterId = counter.getAttribute('data-target') + '-' + counter.textContent;
                            if (!animatedCounters.has(counterId)) {
                                animatedCounters.add(counterId);
                                animateCounter(counter);
                            }
                        }
                    });
                });

                // Counter Animation Function
                function animateCounter(element) {
                    const target = parseInt(element.getAttribute('data-target'));
                    const duration = 2000; // 2 seconds
                    const step = target / (duration / 16); // 60fps
                    let current = 0;

                    const timer = setInterval(() => {
                        current += step;
                        if (current >= target) {
                            current = target;
                            clearInterval(timer);
                        }
                        element.textContent = Math.floor(current).toLocaleString();
                    }, 16);
                }
            </script>







            </main>
        </div>
        </div>


        {{-- modals --}}




        @livewireScripts
        @include('javascriptfix.soliera_js')
    </body>
@endauth



</html>