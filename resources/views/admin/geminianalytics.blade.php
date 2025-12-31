<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="{{ asset('javascript/chart.js') }}">

    </script>

    <script src="https://unpkg.com/lucide@latest"></script>

    <title>{{$title}} - Gemini Analytics</title>
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
                            <h1 class="text-2xl font-bold bg-white bg-clip-text text-[#191970]">Gemini Analytics</h1>
                        </div>
                        {{-- Subsystem Name --}}



     <section class="w-full max-w-7xl mx-auto px-4 py-6">
    
    <!-- Metric Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        
        <!-- Total Searches -->
        <div class="card shadow-md transition-all duration-300 ease-in-out hover:shadow-2xl hover:-translate-y-1 group rounded-2xl">
            <div class="card-body p-5">
                <div class="flex items-center gap-4">
                    <div class="p-3 rounded-xl bg-blue-900 text-yellow-400 group-hover:text-white transition-colors duration-300 shadow-md">
                        <i class="fa-solid fa-search text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Total Searches</h3>
                        <p class="text-3xl font-bold text-blue-900 mt-1">{{ $aiPrompts->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Average Stay Duration -->
        <div class="card shadow-md transition-all duration-300 ease-in-out hover:shadow-2xl hover:-translate-y-1 group rounded-2xl">
            <div class="card-body p-5">
                <div class="flex items-center gap-4">
                    <div class="p-3 rounded-xl bg-blue-900 text-yellow-400 group-hover:text-white transition-colors duration-300 shadow-md">
                        <i class="fa-solid fa-calendar-days text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Avg. Stay</h3>
                        <p class="text-3xl font-bold text-blue-900 mt-1">
                            @if($avgDays)
                                {{ number_format($avgDays, 1) }} <span class="text-lg">days</span>
                            @else
                                <span class="text-lg text-gray-400">N/A</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Most Preferred Room -->
        <div class="card shadow-md transition-all duration-300 ease-in-out hover:shadow-2xl hover:-translate-y-1 group rounded-2xl">
            <div class="card-body p-5">
                <div class="flex items-center gap-4">
                    <div class="p-3 rounded-xl bg-blue-900 text-yellow-400 group-hover:text-white transition-colors duration-300 shadow-md">
                        <i class="fa-solid fa-bed text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Top Room Type</h3>
                        <p class="text-2xl font-bold text-blue-900 mt-1">
                            {{ $roomTypeStats->keys()->first() ?? 'N/A' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Most Requested Feature -->
        <div class="card shadow-md transition-all duration-300 ease-in-out hover:shadow-2xl hover:-translate-y-1 group rounded-2xl">
            <div class="card-body p-5">
                <div class="flex items-center gap-4">
                    <div class="p-3 rounded-xl bg-blue-900 text-yellow-400 group-hover:text-white transition-colors duration-300 shadow-md">
                        <i class="fa-solid fa-star text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Top Feature</h3>
                        <p class="text-2xl font-bold text-blue-900 mt-1">
                            {{ $featureCounts->keys()->first() ?? 'N/A' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Main Analytics Area -->
        <div class="lg:col-span-2 space-y-6">

            <!-- Search Trends Over Time -->
            <div class="bg-white rounded-2xl shadow-md p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="p-2 rounded-lg bg-blue-100">
                        <i class="fa-solid fa-chart-line text-blue-900"></i>
                    </div>
                    <h3 class="font-bold text-lg text-gray-800">Search Trends</h3>
                </div>
                @if($aiPrompts->isNotEmpty())
                    <div class="w-full h-72">
                        <canvas id="trendsChart"></canvas>
                    </div>
                @else
                    <p class="text-gray-500 italic text-center py-8">No search data available.</p>
                @endif
            </div>

            <!-- Room Type Popularity -->
            <div class="bg-white rounded-2xl shadow-md p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="p-2 rounded-lg bg-blue-100">
                        <i class="fa-solid fa-chart-pie text-blue-900"></i>
                    </div>
                    <h3 class="font-bold text-lg text-gray-800">Room Type Distribution</h3>
                </div>
                @if($roomTypeStats->isNotEmpty())
                    <div class="w-full h-72">
                        <canvas id="roomTypeChart"></canvas>
                    </div>
                @else
                    <p class="text-gray-500 italic text-center py-8">No room type data available.</p>
                @endif
            </div>

            <!-- Top Room Features -->
            <div class="bg-white rounded-2xl shadow-md p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="p-2 rounded-lg bg-blue-100">
                        <i class="fa-solid fa-chart-bar text-blue-900"></i>
                    </div>
                    <h3 class="font-bold text-lg text-gray-800">Most Requested Features</h3>
                </div>
                @if($featureCounts->isNotEmpty())
                    <div class="w-full h-80">
                        <canvas id="featuresChart"></canvas>
                    </div>
                @else
                    <p class="text-gray-500 italic text-center py-8">No feature data available.</p>
                @endif
            </div>

        </div>

        <!-- Sidebar Analytics -->
        <div class="lg:col-span-1 space-y-6">
            
            <!-- Reservation Days Breakdown -->
            <div class="bg-white rounded-2xl shadow-md p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="p-2 rounded-lg bg-orange-100">
                        <i class="fa-solid fa-clock text-orange-600"></i>
                    </div>
                    <h3 class="font-bold text-lg text-gray-800">Stay Duration</h3>
                </div>
                @if($aiPrompts->isNotEmpty())
                    <div class="space-y-3">
                        @php
        $daysGrouped = $aiPrompts->groupBy('reservation_days')->map->count()->sortDesc()->take(5);
                        @endphp
                        @foreach($daysGrouped as $days => $count)
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">{{ $days }} {{ $days == 1 ? 'day' : 'days' }}</span>
                                <div class="flex items-center gap-2">
                                    <div class="w-24 h-2 bg-gray-200 rounded-full overflow-hidden">
                                        <div class="h-full bg-orange-500 rounded-full" 
                                             style="width: {{ ($count / $aiPrompts->count()) * 100 }}%"></div>
                                    </div>
                                    <span class="text-sm font-semibold text-gray-800 w-8">{{ $count }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 italic text-sm">No data available</p>
                @endif
            </div>

            <!-- Recent Search Activity -->
            <div class="bg-white rounded-2xl shadow-md p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="p-2 rounded-lg bg-green-100">
                        <i class="fa-solid fa-history text-green-600"></i>
                    </div>
                    <h3 class="font-bold text-lg text-gray-800">Recent Activity</h3>
                </div>
                @if($aiPrompts->isNotEmpty())
                    <div class="space-y-3 max-h-64 overflow-y-auto">
                        @foreach($aiPrompts->sortByDesc('created_at')->take(5) as $prompt)
                            <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                                <div class="p-2 rounded-lg bg-blue-900 text-yellow-400 flex-shrink-0">
                                    <i class="fa-solid fa-bed text-sm"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-gray-800 truncate">{{ $prompt->roomtype ?? 'N/A' }}</p>
                                    <p class="text-xs text-gray-500">{{ $prompt->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 italic text-sm">No recent activity</p>
                @endif
            </div>

            <!-- Quick Insights -->
            <div class="bg-gradient-to-br from-blue-900 to-blue-800 rounded-2xl shadow-lg p-6">
                <div class="flex items-center gap-2 mb-4">
                    <i class="fa-solid fa-lightbulb text-yellow-400 text-xl"></i>
                    <h3 class="font-bold text-white text-lg">Quick Insights</h3>
                </div>
                <ul class="space-y-3 text-sm text-blue-50">
                    @if($aiPrompts->isNotEmpty())
                        <li class="flex items-start gap-2">
                            <i class="fa-solid fa-check-circle text-yellow-400 flex-shrink-0 mt-0.5"></i>
                            <span>You've made <strong>{{ $aiPrompts->count() }}</strong> search queries</span>
                        </li>
                        @if($avgDays)
                        <li class="flex items-start gap-2">
                            <i class="fa-solid fa-check-circle text-yellow-400 flex-shrink-0 mt-0.5"></i>
                            <span>Your average stay is <strong>{{ number_format($avgDays, 1) }} days</strong></span>
                        </li>
                        @endif
                        @if($roomTypeStats->isNotEmpty())
                        <li class="flex items-start gap-2">
                            <i class="fa-solid fa-check-circle text-yellow-400 flex-shrink-0 mt-0.5"></i>
                            <span>You prefer <strong>{{ $roomTypeStats->keys()->first() }}</strong> rooms</span>
                        </li>
                        @endif
                    @else
                        <li class="flex items-start gap-2">
                            <i class="fa-solid fa-info-circle text-yellow-400 flex-shrink-0 mt-0.5"></i>
                            <span>Start searching to see your insights</span>
                        </li>
                    @endif
                </ul>
            </div>

        </div>

    </div>

    <!-- AI-Powered Suggestions Section -->
    <div class="mt-8" id="suggestions-section">
        <div class="bg-white rounded-2xl shadow-md p-6">
            <div class="flex items-center gap-3 mb-6">
                <div class="p-3 rounded-xl bg-gradient-to-br from-purple-600 to-purple-800 text-white shadow-md">
                    <i class="fa-solid fa-robot text-2xl"></i>
                </div>
                <div>
                    <h3 class="font-bold text-xl text-gray-800">AI-Powered Suggestions</h3>
                    <p class="text-sm text-gray-600">Based on your search history and preferences</p>
                </div>
            </div>

            <!-- Loading State -->
            <div id="suggestions-loading" class="hidden">
                <div class="flex flex-col items-center justify-center py-12">
                    <!-- Animated Robot Icon -->
                    <div class="relative mb-6">
                        <div class="absolute inset-0 bg-purple-200 rounded-full animate-ping"></div>
                        <div class="relative p-6 rounded-full bg-gradient-to-br from-purple-600 to-purple-800 text-white">
                            <i class="fa-solid fa-robot text-4xl animate-bounce"></i>
                        </div>
                    </div>
                    
                    <!-- Loading Text with Typing Effect -->
                    <div class="text-center space-y-2">
                        <h4 class="text-xl font-bold text-gray-800">
                            <span class="inline-block animate-pulse">Analyzing your preferences</span>
                            <span class="inline-block animate-bounce" style="animation-delay: 0.1s">.</span>
                            <span class="inline-block animate-bounce" style="animation-delay: 0.2s">.</span>
                            <span class="inline-block animate-bounce" style="animation-delay: 0.3s">.</span>
                        </h4>
                        <p class="text-gray-600">AI is crafting personalized suggestions just for you</p>
                    </div>

                    <!-- Progress Bar -->
                    <div class="w-full max-w-md mt-6">
                        <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-purple-600 via-pink-500 to-purple-600 rounded-full animate-progress"></div>
                        </div>
                    </div>

                    <!-- Loading Cards Skeleton -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 w-full mt-8">
                        @for($i = 0; $i < 6; $i++)
                            <div class="bg-gradient-to-br from-gray-100 to-gray-200 rounded-xl p-6 animate-pulse">
                                <div class="flex items-start justify-between mb-4">
                                    <div class="w-12 h-12 bg-gray-300 rounded-lg"></div>
                                    <div class="w-12 h-6 bg-gray-300 rounded-full"></div>
                                </div>
                                <div class="space-y-3">
                                    <div class="h-6 bg-gray-300 rounded w-3/4"></div>
                                    <div class="h-4 bg-gray-300 rounded w-full"></div>
                                    <div class="h-4 bg-gray-300 rounded w-5/6"></div>
                                    <div class="h-10 bg-gray-300 rounded mt-4"></div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>

            <!-- Suggestions Content -->
            <div id="suggestions-content">
                @if($aiPrompts->isNotEmpty())
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        
                        @php
        // Use existing AI suggestions from controller
        $suggestions = $aiSuggestions ?? [];
                        @endphp

                        @foreach($suggestions as $suggestion)
                            <div class="group relative bg-gradient-to-br {{ $suggestion['color'] }} rounded-xl p-6 text-white 
                                        transition-all duration-300 hover:shadow-2xl hover:-translate-y-2 cursor-pointer overflow-hidden">
                                
                                <!-- Background pattern -->
                                <div class="absolute inset-0 opacity-10">
                                    <div class="absolute transform rotate-45 -right-10 -top-10 w-32 h-32 bg-white rounded-full"></div>
                                    <div class="absolute transform -rotate-45 -left-10 -bottom-10 w-24 h-24 bg-white rounded-full"></div>
                                </div>

                                <div class="relative z-10">
                                    <div class="flex items-start justify-between mb-4">
                                        <div class="p-3 rounded-lg bg-white/20 backdrop-blur-sm">
                                            <i class="fa-solid {{ $suggestion['icon'] }} text-2xl"></i>
                                        </div>
                                        <span class="px-2 py-1 rounded-full bg-white/20 backdrop-blur-sm text-xs font-semibold">
                                            New
                                        </span>
                                    </div>
                                    
                                    <h4 class="font-bold text-lg mb-2">{{ $suggestion['title'] }}</h4>
                                    <p class="text-sm text-white/90 mb-4 leading-relaxed">
                                        {{ $suggestion['description'] }}
                                    </p>
                                    
                                    <button class="w-full py-2 px-4 bg-white/20 hover:bg-white/30 backdrop-blur-sm 
                                                 rounded-lg font-semibold text-sm transition-all duration-300
                                                 group-hover:bg-white group-hover:text-gray-800">
                                        {{ $suggestion['cta'] }} <i class="fa-solid fa-arrow-right ml-2"></i>
                                    </button>
                                </div>
                            </div>
                        @endforeach

                    </div>

                <!-- Pro Tips Section -->
                <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <!-- Search Optimization Tips -->
                    <div class="bg-gradient-to-br from-amber-50 to-orange-50 rounded-xl p-6 border-2 border-orange-200">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="p-2 rounded-lg bg-orange-500 text-white">
                                <i class="fa-solid fa-lightbulb text-xl"></i>
                            </div>
                            <h4 class="font-bold text-lg text-gray-800">Search Optimization Tips</h4>
                        </div>
                        <ul class="space-y-3">
                            <li class="flex items-start gap-3">
                                <i class="fa-solid fa-check-circle text-orange-500 mt-1 flex-shrink-0"></i>
                                <span class="text-sm text-gray-700">
                                    <strong>Be Specific:</strong> Include exact dates and number of guests for better recommendations
                                </span>
                            </li>
                            <li class="flex items-start gap-3">
                                <i class="fa-solid fa-check-circle text-orange-500 mt-1 flex-shrink-0"></i>
                                <span class="text-sm text-gray-700">
                                    <strong>Mention Preferences:</strong> Tell us about desired amenities, view types, or floor preferences
                                </span>
                            </li>
                            <li class="flex items-start gap-3">
                                <i class="fa-solid fa-check-circle text-orange-500 mt-1 flex-shrink-0"></i>
                                <span class="text-sm text-gray-700">
                                    <strong>Special Occasions:</strong> Let us know if it's a celebration - we can suggest special packages
                                </span>
                            </li>
                        </ul>
                    </div>

                    <!-- Booking Benefits -->
                    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-6 border-2 border-blue-200">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="p-2 rounded-lg bg-blue-900 text-yellow-400">
                                <i class="fa-solid fa-trophy text-xl"></i>
                            </div>
                            <h4 class="font-bold text-lg text-gray-800">Your Booking Benefits</h4>
                        </div>
                        <ul class="space-y-3">
                            <li class="flex items-start gap-3">
                                <i class="fa-solid fa-star text-yellow-500 mt-1 flex-shrink-0"></i>
                                <span class="text-sm text-gray-700">
                                    <strong>Price Match:</strong> We guarantee the best rates for your preferred room types
                                </span>
                            </li>
                            <li class="flex items-start gap-3">
                                <i class="fa-solid fa-star text-yellow-500 mt-1 flex-shrink-0"></i>
                                <span class="text-sm text-gray-700">
                                    <strong>Free Cancellation:</strong> Cancel up to 48 hours before check-in at no charge
                                </span>
                            </li>
                            <li class="flex items-start gap-3">
                                <i class="fa-solid fa-star text-yellow-500 mt-1 flex-shrink-0"></i>
                                <span class="text-sm text-gray-700">
                                    <strong>AI Assistant:</strong> Get instant answers and personalized recommendations 24/7
                                </span>
                            </li>
                        </ul>
                    </div>

                </div>

            @else
                <!-- Empty State -->
                <div class="text-center py-12">
                    <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-purple-100 mb-4">
                        <i class="fa-solid fa-magic-wand-sparkles text-purple-600 text-3xl"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-800 mb-2">Start Your Search Journey</h4>
                    <p class="text-gray-600 mb-6 max-w-md mx-auto">
                        Make your first AI-powered search to unlock personalized recommendations and exclusive deals tailored just for you.
                    </p>
                    <button class="px-6 py-3 bg-blue-900 text-white rounded-lg font-semibold 
                                 hover:bg-blue-800 transition-colors duration-300 shadow-lg hover:shadow-xl">
                        <i class="fa-solid fa-search mr-2"></i>Start Searching
                    </button>
                </div>
            @endif

        </div>
    </div>

</section>


<script>
    // Search Trends Over Time
    @if($aiPrompts->isNotEmpty())
    const trendsData = {!! json_encode($aiPrompts->groupBy(function ($item) {
            return $item->created_at->format('M d');
        })->map->count()) !!};
    
    const trendsCtx = document.getElementById('trendsChart');
    new Chart(trendsCtx, {
        type: 'line',
        data: {
            labels: Object.keys(trendsData),
            datasets: [{
                label: 'Searches',
                data: Object.values(trendsData),
                borderColor: '#1E3A8A',
                backgroundColor: 'rgba(30, 58, 138, 0.1)',
                tension: 0.4,
                fill: true,
                borderWidth: 3,
                pointRadius: 4,
                pointHoverRadius: 6,
                pointBackgroundColor: '#1E3A8A',
                pointBorderColor: '#fff',
                pointBorderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#1E3A8A',
                    padding: 12,
                    borderColor: '#F59E0B',
                    borderWidth: 2
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 },
                    grid: { color: 'rgba(0, 0, 0, 0.05)' }
                },
                x: {
                    grid: { display: false }
                }
            }
        }
    });
    @endif

    // Room Type Chart
    @if($roomTypeStats->isNotEmpty())
    const roomTypeCtx = document.getElementById('roomTypeChart');
    new Chart(roomTypeCtx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($roomTypeStats->keys()) !!},
            datasets: [{
                data: {!! json_encode($roomTypeStats->values()) !!},
                backgroundColor: [
                    '#1E3A8A', '#F59E0B', '#10B981', '#8B5CF6', '#EF4444', '#06B6D4'
                ],
                borderWidth: 3,
                borderColor: '#ffffff',
                hoverOffset: 10
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        font: { size: 13, weight: '500' },
                        usePointStyle: true,
                        pointStyle: 'circle'
                    }
                },
                tooltip: {
                    backgroundColor: '#1E3A8A',
                    padding: 12,
                    borderColor: '#F59E0B',
                    borderWidth: 2
                }
            }
        }
    });
    @endif

    // Features Chart
    @if($featureCounts->isNotEmpty())
    const featuresCtx = document.getElementById('featuresChart');
    new Chart(featuresCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($featureCounts->keys()->take(8)) !!},
            datasets: [{
                label: 'Times Requested',
                data: {!! json_encode($featureCounts->values()->take(8)) !!},
                backgroundColor: '#F59E0B',
                borderRadius: 8,
                borderWidth: 0,
                hoverBackgroundColor: '#D97706'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#1E3A8A',
                    padding: 12,
                    borderColor: '#F59E0B',
                    borderWidth: 2
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 },
                    grid: { color: 'rgba(0, 0, 0, 0.05)' }
                },
                x: {
                    grid: { display: false }
                }
            }
        }
    });
    @endif
</script>

<style>
    @keyframes progress {
        0% {
            transform: translateX(-100%);
        }
        100% {
            transform: translateX(100%);
        }
    }

    .animate-progress {
        animation: progress 1.5s ease-in-out infinite;
    }

    /* Smooth fade-in for suggestions */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .suggestion-card {
        animation: fadeInUp 0.5s ease-out forwards;
    }

    .suggestion-card:nth-child(1) { animation-delay: 0.1s; }
    .suggestion-card:nth-child(2) { animation-delay: 0.2s; }
    .suggestion-card:nth-child(3) { animation-delay: 0.3s; }
    .suggestion-card:nth-child(4) { animation-delay: 0.4s; }
    .suggestion-card:nth-child(5) { animation-delay: 0.5s; }
    .suggestion-card:nth-child(6) { animation-delay: 0.6s; }
</style>

<script>
    // Show loading animation on page load if suggestions are being generated
    document.addEventListener('DOMContentLoaded', function() {
        // Check if we have suggestions data
        const hasSuggestions = {{ !empty($aiSuggestions) ? 'true' : 'false' }};
        const hasPrompts = {{ $aiPrompts->isNotEmpty() ? 'true' : 'false' }};
        
        if (hasPrompts && !hasSuggestions) {
            // Show loading state if we have prompts but no suggestions yet
            showLoadingState();
            
            // Simulate loading (in real scenario, this would be handled by AJAX)
            setTimeout(() => {
                hideLoadingState();
            }, 3000);
        }
    });

    function showLoadingState() {
        const loadingEl = document.getElementById('suggestions-loading');
        const contentEl = document.getElementById('suggestions-content');
        
        if (loadingEl && contentEl) {
            loadingEl.classList.remove('hidden');
            contentEl.classList.add('hidden');
        }
    }

    function hideLoadingState() {
        const loadingEl = document.getElementById('suggestions-loading');
        const contentEl = document.getElementById('suggestions-content');
        
        if (loadingEl && contentEl) {
            loadingEl.classList.add('hidden');
            contentEl.classList.remove('hidden');
        }
    }

    // Optional: Add refresh suggestions button functionality
    function refreshSuggestions() {
        showLoadingState();
        
        // Make AJAX call to refresh suggestions
        fetch(window.location.href, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.text())
        .then(html => {
            // Parse and update suggestions section
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const newContent = doc.getElementById('suggestions-content');
            
            if (newContent) {
                document.getElementById('suggestions-content').innerHTML = newContent.innerHTML;
            }
            
            hideLoadingState();
        })
        .catch(error => {
            console.error('Failed to refresh suggestions:', error);
            hideLoadingState();
        });
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
                @include('javascriptfix.soliera_js')
        </body>
@endauth



</html>