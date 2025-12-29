<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  @vite('resources/css/app.css')
<script src="{{ asset('javascript/chart.js') }}">

</script>
  <script src="https://unpkg.com/lucide@latest"></script>

  <title>{{$title}} - Monitor Door Lock</title>
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
                        <h1 class="text-2xl font-bold text-[#191970] bg-clip-text ">Monitor Room #{{ $doorlockfrontdesk->roomID }}</h1>
                      </div>
                      {{-- Subsystem Name --}}


                      <!-- content -->
       <section class="p-4 md:p-8 max-w-7xl mx-auto">
    <!-- Grid Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column - Room Info and Metrics -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Room Card -->
            <div class="bg-white rounded-lg shadow-xl p-6">
                <div class="relative mb-4 rounded-lg overflow-hidden">
                    <img src="{{ asset($doorlockfrontdesk->roomphoto) }}" alt="Room" class="w-full h-48 object-cover">
                </div>

                <div class="space-y-3">
                    <div class="flex items-center gap-3">
                        <div class="bg-blue-900 p-2 rounded-lg">
                            <i class="fas fa-door-closed text-yellow-400 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase">Room Name</p>
                            <p class="text-lg font-bold text-gray-800">Room #{{ $doorlockfrontdesk->roomID }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="bg-blue-900 p-2 rounded-lg">
                            <i class="fas fa-bed text-yellow-400 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase">Room Type</p>
                            <p class="text-lg font-bold text-gray-800">{{ $doorlockfrontdesk->roomtype }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="bg-blue-900 p-2 rounded-lg">
                            <i class="fas fa-receipt text-yellow-400 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase">Booking ID</p>
                            <p class="text-lg font-bold font-mono text-gray-800">{{ $doorlockfrontdesk->bookingID }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="bg-blue-900 p-2 rounded-lg">
                            <i class="fas fa-user text-yellow-400 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase">Guest Name</p>
                            <p class="text-lg font-bold text-gray-800">{{ $doorlockfrontdesk->guestname }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="bg-blue-900 p-2 rounded-lg">
                            <i class="fas fa-id-card text-yellow-400 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase">RFID Tag</p>
                            <p class="text-sm font-mono bg-blue-100 text-blue-900 px-3 py-1 rounded inline-block">
                                {{ $doorlockfrontdesk->rfid }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Metrics Cards -->
            <div class="grid grid-cols-2 gap-4" id="metricsContainer">
                <div class="bg-white rounded-lg shadow-lg p-4">
                    <div class="flex items-center justify-between mb-2">
                        <i class="fas fa-list text-yellow-400 text-2xl"></i>
                        <span class="text-3xl font-bold text-gray-800" id="totalLogs">0</span>
                    </div>
                    <p class="text-gray-600 text-sm">Total Logs</p>
                </div>

                <div class="bg-white rounded-lg shadow-lg p-4">
                    <div class="flex items-center justify-between mb-2">
                        <i class="fas fa-lock-open text-yellow-400 text-2xl"></i>
                        <span class="text-3xl font-bold text-gray-800" id="openEvents">0</span>
                    </div>
                    <p class="text-gray-600 text-sm">Open Events</p>
                </div>

                <div class="bg-white rounded-lg shadow-lg p-4">
                    <div class="flex items-center justify-between mb-2">
                        <i class="fas fa-lock text-yellow-400 text-2xl"></i>
                        <span class="text-3xl font-bold text-gray-800" id="closedEvents">0</span>
                    </div>
                    <p class="text-gray-600 text-sm">Closed Events</p>
                </div>

                <div class="bg-white rounded-lg shadow-lg p-4">
                    <div class="flex items-center justify-between mb-2">
                        <i class="fas fa-exclamation-triangle text-yellow-400 text-2xl"></i>
                        <span class="text-3xl font-bold text-gray-800" id="suspiciousEvents">0</span>
                    </div>
                    <p class="text-gray-600 text-sm">Suspicious</p>
                </div>
            </div>

            <!-- Status Suggestion -->
            <div class="bg-white rounded-lg shadow-lg p-5">
                <div class="flex items-center gap-3 mb-3">
                    <i class="fas fa-shield-alt text-yellow-400 text-2xl"></i>
                    <h3 class="text-lg font-bold text-gray-800">Security Status</h3>
                </div>
                <div class="space-y-2">
                    <!-- Overall Status -->
                    <div class="flex items-center justify-between bg-gray-100 p-3 rounded">
                        <span class="text-sm text-gray-700">Overall Status</span>
                        <span id="overallStatus" class="bg-green-500 text-white px-3 py-1 rounded-full text-xs font-bold">
                            NORMAL
                        </span>
                    </div>

                    <!-- Status Reason -->
                    <div class="bg-gray-100 p-3 rounded" id="statusReasonContainer">
                        <span class="text-xs text-gray-600" id="statusReason">All activity appears normal</span>
                    </div>

                    <!-- Last Activity -->
                    <div class="flex items-center justify-between bg-gray-100 p-3 rounded">
                        <span class="text-sm text-gray-700">Last Activity</span>
                        <span class="text-xs text-gray-600" id="lastActivityTime">No activity</span>
                    </div>

                    <!-- Rapid Attempts Today -->
                    <div class="flex items-center justify-between bg-gray-100 p-3 rounded">
                        <span class="text-sm text-gray-700">Rapid Repeated Access</span>
                        <span class="bg-yellow-500 text-blue-900 px-3 py-1 rounded-full text-xs font-bold" id="rapidAttemptsToday">
                            0 Today
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column - Logs and Analytics -->
        <div class="lg:col-span-2 space-y-6">
            <!-- RFID History Logs Table -->
            <div class="bg-white rounded-lg shadow-xl p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-history text-yellow-400 text-2xl"></i>
                        <h3 class="text-xl font-bold text-gray-800">RFID Access History</h3>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-xs text-gray-500">Auto-refresh every 5s</span>
                        <div class="animate-pulse w-2 h-2 bg-green-500 rounded-full" id="liveIndicator"></div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="table w-full text-gray-800">
                        <thead>
                            <tr class="border-b-2 border-blue-900">
                                <th class="text-blue-900 text-left">Time</th>
                                <th class="text-blue-900 text-left">Action</th>
                            </tr>
                        </thead>
                        <tbody id="logsTableBody">
                            <tr>
                                <td colspan="2" class="text-center text-gray-500 py-4">
                                    <i class="fas fa-spinner fa-spin mr-2"></i>Loading...
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="mt-4" id="paginationContainer"></div>
                </div>
            </div>

            <!-- Analytics Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Access Pattern Chart -->
                <div class="bg-white rounded-lg shadow-xl p-6">
                    <div class="flex items-center gap-3 mb-4">
                        <i class="fas fa-chart-line text-yellow-400 text-xl"></i>
                        <h3 class="text-lg font-bold text-gray-800">Access Pattern (24h)</h3>
                    </div>
                    <canvas id="accessChart"></canvas>
                </div>

                <!-- Activity Distribution -->
                <div class="bg-white rounded-lg shadow-xl p-6">
                    <div class="flex items-center gap-3 mb-4">
                        <i class="fas fa-chart-pie text-yellow-400 text-xl"></i>
                        <h3 class="text-lg font-bold text-gray-800">Activity Distribution</h3>
                    </div>
                    <canvas id="pieChart"></canvas>
                </div>

                <!-- Weekly Summary -->
                <div class="bg-white rounded-lg shadow-xl p-6 md:col-span-2">
                    <div class="flex items-center gap-3 mb-4">
                        <i class="fas fa-chart-bar text-yellow-400 text-xl"></i>
                        <h3 class="text-lg font-bold text-gray-800">Weekly Activity Summary</h3>
                    </div>
                    <canvas id="weeklyChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    const doorlockID = {{ $doorlockID }};
    let accessChart, pieChart, weeklyChart;
    let currentPage = 1;

    // Initialize charts
    function initCharts() {
        const ctxAccess = document.getElementById('accessChart').getContext('2d');
        accessChart = new Chart(ctxAccess, {
            type: 'line',
            data: {
                labels: [],
                datasets: [{
                    label: 'Unlocked',
                    data: [],
                    borderColor: '#10b981',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    tension: 0.3
                }, {
                    label: 'Locked',
                    data: [],
                    borderColor: '#ef4444',
                    backgroundColor: 'rgba(239, 68, 68, 0.1)',
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });

        const ctxPie = document.getElementById('pieChart').getContext('2d');
        pieChart = new Chart(ctxPie, {
            type: 'doughnut',
            data: {
                labels: [],
                datasets: [{
                    data: [],
                    backgroundColor: ['#10b981', '#ef4444']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true
            }
        });

        const ctxWeekly = document.getElementById('weeklyChart').getContext('2d');
        weeklyChart = new Chart(ctxWeekly, {
            type: 'bar',
            data: {
                labels: [],
                datasets: [{
                    label: 'Total Access',
                    data: [],
                    backgroundColor: '#fbbf24'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    }

    // Fetch and update data
    function fetchMonitorData(page = 1) {
        fetch(`/admin/doorlock/monitor-data/${doorlockID}?page=${page}`)
            .then(response => response.json())
            .then(data => {
                updateMetrics(data);
                updateSecurityStatus(data);
                updateLogsTable(data.doorlock);
                updateCharts(data);
            })
            .catch(error => {
                console.error('Error fetching monitor data:', error);
            });
    }

    // Update metrics
    function updateMetrics(data) {
        document.getElementById('totalLogs').textContent = data.totalLogs;
        document.getElementById('openEvents').textContent = data.openEvents;
        document.getElementById('closedEvents').textContent = data.closedEvents;
        document.getElementById('suspiciousEvents').textContent = data.suspiciousEvents;
    }

    // Update security status
    function updateSecurityStatus(data) {
        const statusElement = document.getElementById('overallStatus');
        statusElement.textContent = data.overallStatus;
        statusElement.className = data.overallStatus === 'NORMAL' 
            ? 'bg-green-500 text-white px-3 py-1 rounded-full text-xs font-bold'
            : 'bg-red-600 text-white px-3 py-1 rounded-full text-xs font-bold';

        document.getElementById('statusReason').textContent = data.statusReason;
        document.getElementById('lastActivityTime').textContent = data.lastActivityTime;
        document.getElementById('rapidAttemptsToday').textContent = `${data.rapidAttemptsToday} Today`;
    }

    // Update logs table
    function updateLogsTable(doorlock) {
        const tbody = document.getElementById('logsTableBody');
        
        if (!doorlock.data || doorlock.data.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="2" class="text-center text-gray-500 py-4">
                        No RFID history found.
                    </td>
                </tr>
            `;
            return;
        }

        tbody.innerHTML = doorlock.data.map(history => {
            const date = new Date(history.rfiddate);
            const actionClass = history.door_state === 'Unlocked' 
                ? 'bg-green-500 text-white' 
                : 'bg-red-500 text-white';
            const icon = history.door_state === 'Unlocked' ? 'fa-lock-open' : 'fa-lock';
            const actionText = history.door_state === 'Unlocked' ? 'OPENED' : 'CLOSED';

            return `
                <tr class="border-b border-gray-200 hover:bg-gray-50">
                    <td>
                        <div class="text-sm">
                            <p class="font-bold text-gray-800">
                                ${date.toLocaleString('en-US', { 
                                    weekday: 'long', 
                                    year: 'numeric', 
                                    month: 'long', 
                                    day: 'numeric', 
                                    hour: 'numeric', 
                                    minute: 'numeric' 
                                })}
                            </p>
                            <p class="text-xs text-gray-500">
                                ${history.relative_time || 'Just now'}
                            </p>
                        </div>
                    </td>
                    <td>
                        <span class="${actionClass} px-3 py-1 rounded-full text-xs font-bold flex items-center gap-2 w-fit">
                            <i class="fas ${icon}"></i> ${actionText}
                        </span>
                    </td>
                </tr>
            `;
        }).join('');

        // Update pagination
        updatePagination(doorlock);
    }

    // Update pagination
    function updatePagination(doorlock) {
        const container = document.getElementById('paginationContainer');
        if (!doorlock.links) return;

        const links = doorlock.links.map(link => {
            if (link.url === null) {
                return `<span class="px-3 py-1 text-gray-400">${link.label}</span>`;
            }
            const active = link.active ? 'bg-blue-900 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300';
            const page = new URL(link.url).searchParams.get('page') || 1;
            return `
                <button onclick="fetchMonitorData(${page})" class="${active} px-3 py-1 rounded">
                    ${link.label}
                </button>
            `;
        }).join('');

        container.innerHTML = `<div class="flex gap-2 justify-center">${links}</div>`;
    }

    // Update charts
    function updateCharts(data) {
        // Access Pattern Chart
        const accessLabels = Object.keys(data.accessPattern);
        const unlockedData = accessLabels.map(label => data.accessPattern[label].unlocked);
        const lockedData = accessLabels.map(label => data.accessPattern[label].locked);

        accessChart.data.labels = accessLabels;
        accessChart.data.datasets[0].data = unlockedData;
        accessChart.data.datasets[1].data = lockedData;
        accessChart.update();

        // Activity Distribution Pie Chart
        pieChart.data.labels = Object.keys(data.activityDistribution);
        pieChart.data.datasets[0].data = Object.values(data.activityDistribution);
        pieChart.update();

        // Weekly Summary Bar Chart
        weeklyChart.data.labels = Object.keys(data.weeklySummary);
        weeklyChart.data.datasets[0].data = Object.values(data.weeklySummary);
        weeklyChart.update();
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        initCharts();
        fetchMonitorData();
        
        // Auto-refresh every 5 seconds
        setInterval(() => {
            fetchMonitorData(currentPage);
        }, 5000);
    });
</script>
      

  




                      <!-- Lucide Icons -->



                    </main>
                  </div>
                </div>

                {{-- modals --}}


              </body>

@endauth


@include('javascriptfix.soliera_js')




  <script src="{{asset('javascript/photouploadglobal.js')}}"></script>

</html>