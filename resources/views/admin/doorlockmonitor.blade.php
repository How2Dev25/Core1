<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  @vite('resources/css/app.css')

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
        <section class="p-4 md:p-8  max-w-7xl mx-auto">
            <!-- Header -->

            <!-- Grid Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <!-- Left Column - Room Info and Metrics -->
                <div class="lg:col-span-1 space-y-6">

                    <!-- Room Card -->
                    <div class="bg-white rounded-lg shadow-xl p-6 ">
                        <!-- Room Image -->
                        <div class="relative mb-4 rounded-lg overflow-hidden">
                            <img src="{{ asset($doorlockfrontdesk->roomphoto) }}"
                                alt="Room" class="w-full h-48 object-cover">

                        </div>

                        <!-- Room Details -->
                        <div class="space-y-3">
                            <div class="flex items-center gap-3">
                                <div class="bg-blue-900 p-2 rounded-lg">
                                    <i class="fas fa-door-closed text-yellow-400 text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase">Room Name</p>
                                    <p class="text-lg font-bold text-gray-800">Room #{{  $doorlockfrontdesk->roomID }}</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-3">
                                <div class="bg-blue-900 p-2 rounded-lg">
                                    <i class="fas fa-bed text-yellow-400 #10b981text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase">Room Type</p>
                                    <p class="text-lg font-bold text-gray-800">{{ $doorlockfrontdesk->roomtype}}</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-3">
                                <div class="bg-blue-900 p-2 rounded-lg">
                                    <i class="fas fa-receipt text-yellow-400 text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase">Booking ID</p>
                                    <p class="text-lg font-bold font-mono text-gray-800">{{ $doorlockfrontdesk->bookingID}}</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-3">
                                <div class="bg-blue-900 p-2 rounded-lg">
                                    <i class="fas fa-user text-yellow-400 text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase">Guest Name</p>
                                    <p class="text-lg font-bold text-gray-800">{{  $doorlockfrontdesk->guestname }}</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-3">
                                <div class="bg-blue-900 p-2 rounded-lg">
                                    <i class="fas fa-id-card text-yellow-400 text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase">RFID Tag</p>
                                    <p class="text-sm font-mono bg-blue-100 text-blue-900 px-3 py-1 rounded inline-block">
                                        {{ $doorlockfrontdesk->rfid}}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Metrics Cards -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-white rounded-lg shadow-lg p-4">
                        <div class="flex items-center justify-between mb-2">
                            <i class="fas fa-list text-yellow-400 text-2xl"></i>
                            <span class="text-3xl font-bold text-gray-800">{{ $totalLogs }}</span>
                        </div>
                        <p class="text-gray-600 text-sm">Total Logs</p>
                    </div>

                    <div class="bg-white rounded-lg shadow-lg p-4">
                        <div class="flex items-center justify-between mb-2">
                            <i class="fas fa-lock-open text-yellow-400 text-2xl"></i>
                            <span class="text-3xl font-bold text-gray-800">{{ $openEvents }}</span>
                        </div>
                        <p class="text-gray-600 text-sm">Open Events</p>
                    </div>

                    <div class="bg-white rounded-lg shadow-lg p-4">
                        <div class="flex items-center justify-between mb-2">
                            <i class="fas fa-lock text-yellow-400 text-2xl"></i>
                            <span class="text-3xl font-bold text-gray-800">{{ $closedEvents }}</span>
                        </div>
                        <p class="text-gray-600 text-sm">Closed Events</p>
                    </div>

                    <div class="bg-white rounded-lg shadow-lg p-4">
                        <div class="flex items-center justify-between mb-2">
                            <i class="fas fa-exclamation-triangle text-yellow-400 text-2xl"></i>
                            <span class="text-3xl font-bold text-gray-800">{{ $suspiciousEvents }}</span>
                        </div>
                        <p class="text-gray-600 text-sm">Suspicious</p>
                    </div>
                </div>


                    <!-- Status Suggestion -->
            <div class="bg-white rounded-lg shadow-lg p-5 ">
                <div class="flex items-center gap-3 mb-3">
                    <i class="fas fa-shield-alt text-yellow-400 text-2xl"></i>
                    <h3 class="text-lg font-bold text-gray-800">Security Status</h3>
                </div>
                <div class="space-y-2">
                    <!-- Overall Status -->
                    <div class="flex items-center justify-between bg-gray-100 p-3 rounded">
                        <span class="text-sm text-gray-700">Overall Status</span>
                        <span
                            class="{{ $overallStatus === 'NORMAL' ? 'bg-green-500' : 'bg-red-600' }} text-white px-3 py-1 rounded-full text-xs font-bold">
                            {{ $overallStatus }}
                        </span>
                    </div>

                    <!-- Last Activity -->
                    <div class="flex items-center justify-between bg-gray-100 p-3 rounded">
                        <span class="text-sm text-gray-700">Last Activity</span>
                        <span class="text-xs text-gray-600">{{ $lastActivityTime }}</span>
                    </div>

                    <!-- Rapid Attempts Today -->
                    <div class="flex items-center justify-between bg-gray-100 p-3 rounded">
                        <span class="text-sm text-gray-700">Rapid Repeated Access</span>
                        <span class="bg-yellow-500 text-blue-900 px-3 py-1 rounded-full text-xs font-bold">
                            {{ $rapidAttemptsToday }} Today
                        </span>
                    </div>
                </div>
            </div>
                </div>

                <!-- Right Column - Logs and Analytics -->
                <div class="lg:col-span-2 space-y-6">

                    <!-- RFID History Logs Table -->
                <div class="bg-white rounded-lg shadow-xl p-6 ">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-history text-yellow-400 text-2xl"></i>
                            <h3 class="text-xl font-bold text-gray-800">RFID Access History</h3>
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
                        <tbody>
                            @forelse($doorlock as $history)
                                <tr class="border-b border-gray-200 hover:bg-gray-50">
                                    <td>
                                    <div class="text-sm">
                                        <!-- Full date and day of the week with time -->
                                        <p class="font-bold text-gray-800">
                                            {{ \Carbon\Carbon::parse($history->rfiddate)->format('l, F j, Y, h:i A') }}
                                        </p>
                                        <!-- Relative time -->
                                        <p class="text-xs text-gray-500">
                                            {{ \Carbon\Carbon::parse($history->rfiddate)->diffForHumans() }}
                                        </p>
                                    </div>

                                    </td>
                                    <td>
                                        @if($history->door_state === 'Unlocked')
                                            <span
                                                class="bg-green-500 text-white px-3 py-1 rounded-full text-xs font-bold flex items-center gap-2 w-fit">
                                                <i class="fas fa-lock-open"></i> OPENED
                                            </span>
                                        @else
                                            <span
                                                class="bg-red-500 text-white px-3 py-1 rounded-full text-xs font-bold flex items-center gap-2 w-fit">
                                                <i class="fas fa-lock"></i> CLOSED
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center text-gray-500 py-4">
                                        No RFID history found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Pagination Links -->
                    <div class="mt-4">
                        {{ $doorlock->links() }}
                    </div>
                </div>
                </div>


                    <!-- Analytics Section -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- Access Pattern Chart -->
                        <div class="bg-white rounded-lg shadow-xl p-6 ">
                            <div class="flex items-center gap-3 mb-4">
                                <i class="fas fa-chart-line text-yellow-400 text-xl"></i>
                                <h3 class="text-lg font-bold text-gray-800">Access Pattern (24h)</h3>
                            </div>
                            <canvas id="accessChart"></canvas>
                        </div>

                        <!-- Activity Distribution -->
                        <div class="bg-white rounded-lg shadow-xl p-6 ">
                            <div class="flex items-center gap-3 mb-4">
                                <i class="fas fa-chart-pie text-yellow-400 text-xl"></i>
                                <h3 class="text-lg font-bold text-gray-800">Activity Distribution</h3>
                            </div>
                            <canvas id="pieChart"></canvas>
                        </div>

                        <!-- Weekly Summary -->
                        <div class="bg-white rounded-lg shadow-xl p-6 md:col-span-2 ">
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

       <script src="{{ asset('javascript/chart.js') }}">

       </script>

          <script>
        // Access Pattern (24h)
        const accessPatternLabels = @json($accessPattern->pluck('time'));
        const accessPatternData = @json($accessPattern->map(fn($h) => $h['state'] === 'Unlocked' ? 1 : 0));

        // Activity Distribution
        const activityLabels = @json($activityDistribution->keys());
        const activityData = @json($activityDistribution->values());

        // Weekly Summary
        const weeklyLabels = @json($weeklySummary->keys());
        const weeklyData = @json($weeklySummary->values());
    </script>

    <script>
        // Access Pattern Line Chart
        const ctxAccess = document.getElementById('accessChart').getContext('2d');
        new Chart(ctxAccess, {
            type: 'line',
            data: {
                labels: accessPatternLabels,
                datasets: [{
                    label: 'Door State (1=Unlocked, 0=Locked)',
                    data: accessPatternData,
                    borderColor: '#facc15',
                    backgroundColor: 'rgba(250, 204, 21, 0.3)',
                    tension: 0.3
                }]
            },
            options: { responsive: true, scales: { y: { min: 0, max: 1 } } }
        });

        // Activity Distribution Pie Chart
        const ctxPie = document.getElementById('pieChart').getContext('2d');
        new Chart(ctxPie, {
            type: 'pie',
            data: {
                labels: activityLabels,
                datasets: [{
                    data: activityData,
                    backgroundColor: ['#10b981', '#ef4444']
                }]
            },
            options: { responsive: true }
        });

        // Weekly Activity Summary Bar Chart
        const ctxWeekly = document.getElementById('weeklyChart').getContext('2d');
        new Chart(ctxWeekly, {
            type: 'bar',
            data: {
                labels: weeklyLabels,
                datasets: [{
                    label: 'Total Access',
                    data: weeklyData,
                    backgroundColor: '#fbbf24'
                }]
            },
            options: { responsive: true }
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