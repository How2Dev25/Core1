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
    <title>Loyalty Management Dashboard</title>
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
                <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 transition-slow">
                    {{-- Subsystem Name --}}
                    <div class="pb-5 border-b border-base-300 animate-fadeIn">
                        <h1 class="text-2xl font-bold bg-white bg-clip-text text-[#191970]">
                      
                            Loyalty Management Dashboard
                        </h1>
                    </div>
                    {{-- Subsystem Name --}}

                    <section class="flex-1 p-6">
                        <!-- Stats Cards Grid -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                            <!-- Total Rewards -->
                            <div
                                class="bg-white rounded-xl border border-transparent p-6 shadow-lg transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-blue-500 group">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3
                                            class="text-sm font-semibold text-gray-600 uppercase tracking-wide group-hover:text-blue-700 transition-colors">
                                            Total Rewards</h3>
                                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_rewards'] }}</p>
                                        <span class="text-sm text-gray-500 group-hover:text-blue-600 transition-colors">All
                                            Rewards</span>
                                    </div>
                                    <div
                                        class="w-16 h-16 flex  items-center justify-center bg-blue-900 rounded-xl  transition-colors duration-300">
                                        <i class="fas fa-gift text-yellow-400 text-3xl group-hover:text-yellow-400"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Active Rewards -->
                            <div
                                class="bg-white rounded-xl border border-transparent p-6 shadow-lg transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-green-400 group">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3
                                            class="text-sm font-semibold text-gray-600 uppercase tracking-wide group-hover:text-green-700">
                                            Active Rewards</h3>
                                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['active_rewards'] }}</p>
                                        <span class="text-sm text-gray-500 group-hover:text-green-600">Currently
                                            Available</span>
                                    </div>
                                    <div
                                        class="w-16 h-16 flex items-center justify-center bg-blue-900 rounded-xl group-hover:bg-blue-500 transition-colors duration-300">
                                        <i class="fas fa-bolt text-yellow-400 text-3xl group-hover:text-white"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Total Redemptions -->
                            <div
                                class="bg-white rounded-xl border border-transparent p-6 shadow-lg transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-yellow-400 group">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3
                                            class="text-sm font-semibold text-gray-600 uppercase tracking-wide group-hover:text-yellow-700">
                                            Total Redemptions</h3>
                                        <p class="text-3xl font-bold text-gray-900 mt-2">
                                            {{ number_format($stats['total_redemptions']) }}</p>
                                        <span class="text-sm text-gray-500 group-hover:text-yellow-600">All Time</span>
                                    </div>
                                    <div
                                        class="w-16 h-16 flex items-center justify-center bg-blue-900 rounded-xl group-hover:bg-blue-500 transition-colors duration-300">
                                        <i class="fas fa-trophy text-yellow-400 text-3xl group-hover:text-white"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Total Members -->
                            <div
                                class="bg-white rounded-xl border border-transparent p-6 shadow-lg transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-blue-400 group">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3
                                            class="text-sm font-semibold text-gray-600 uppercase tracking-wide group-hover:text-blue-700">
                                            Total Members</h3>
                                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_members'] }}</p>
                                        <span class="text-sm text-gray-500 group-hover:text-blue-600">Loyalty Program</span>
                                    </div>
                                    <div
                                        class="w-16 h-16 flex items-center justify-center bg-blue-900 rounded-xl group-hover:bg-blue-500 transition-colors duration-300">
                                        <i class="fas fa-users text-yellow-400 text-3xl group-hover:text-white"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Data Tables Section -->
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <!-- Recent Redemptions Card -->
                            <div class="bg-white rounded-xl border border-gray-200 shadow-lg overflow-hidden">
                                <!-- Header -->
                                <div class="bg-blue-900 text-white px-6 py-4">
                                    <h2 class="text-lg font-semibold">
                                        <i class="fas fa-clock-rotate-left mr-2"></i>
                                        Recent Redemptions
                                    </h2>
                                </div>

                                <!-- Table -->
                                <div class="overflow-x-auto">
                                    <table class="table table-striped w-full text-sm">
                                        <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                                            <tr>
                                                <th class="px-4 py-3 text-left">Guest</th>
                                                <th class="px-4 py-3 text-left">Reward</th>
                                                <th class="px-4 py-3 text-left">Points</th>
                                                <th class="px-4 py-3 text-left">Date</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200">
                                            @forelse($recentRedemptions as $redemption)
                                                <tr class="hover:bg-gray-50 transition">
                                                    <td class="px-4 py-3 font-medium">
                                                        <div class="flex items-center gap-3">
                                                            <div class="avatar">
                                                                @php
                                                                    // Generate initials from guest name
                                                                    $initials = strtoupper(substr($redemption->guest->guest_name ?? 'GU', 0, 2));
                                                                @endphp
                                                                <div
                                                                    class="h-8 w-8 rounded-full bg-primary flex items-center justify-center shadow-sm">
                                                                    <span
                                                                        class="text-white font-bold text-xs">{{ $initials }}</span>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <div class="font-semibold text-gray-800">
                                                                    {{ $redemption->guest->guest_name ?? 'N/A' }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-4 py-3">{{ $redemption->description }}</td>
                                                    <td class="px-4 py-3">
                                                        <span class="font-semibold text-yellow-600">
                                                            {{ number_format($redemption->points_change) }}
                                                        </span>
                                                    </td>
                                                    <td class="px-4 py-3">
                                                        {{ $redemption->transaction_date->format('M d, Y') }}
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="py-10 text-center text-gray-500">
                                                        <div class="flex flex-col items-center justify-center space-y-2">
                                                            <i class="fas fa-inbox text-4xl text-gray-400"></i>
                                                            <p class="text-lg font-medium">No recent redemptions</p>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Top Performing Rewards Card -->
                            <div class="bg-white rounded-xl border border-gray-200 shadow-lg overflow-hidden">
                                <!-- Header -->
                                <div class="bg-blue-900 text-white px-6 py-4">
                                    <h2 class="text-lg font-semibold">
                                        <i class="fas fa-chart-line mr-2"></i>
                                        Top Performing Rewards
                                    </h2>
                                </div>

                                <!-- Table -->
                                <div class="overflow-x-auto">
                                    <table class="table table-striped w-full text-sm">
                                        <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                                            <tr>
                                                <th class="px-4 py-3 text-left">Reward Name</th>
                                                <th class="px-4 py-3 text-left">Redemptions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200">
                                            @forelse($topRewards as $reward)
                                                <tr class="hover:bg-gray-50 transition">
                                                    <td class="px-4 py-3">
                                                        <div class="flex items-center gap-3">
                                                            <div
                                                                class="w-8 h-8 rounded-lg bg-blue-900 flex items-center justify-center">
                                                                <span class="text-yellow-400 font-bold text-xs">★</span>
                                                            </div>
                                                            <div>
                                                                <div class="font-semibold text-gray-800">{{ $reward->name }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-4 py-3">
                                                        <span
                                                            class="font-bold text-gray-900">{{ $reward->redemption_count }}</span>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="2" class="py-10 text-center text-gray-500">
                                                        <div class="flex flex-col items-center justify-center space-y-2">
                                                            <i class="fas fa-chart-bar text-4xl text-gray-400"></i>
                                                            <p class="text-lg font-medium">No rewards data</p>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </section>
                </main>
            </div>
        </div>

        @livewireScripts
        @include('javascriptfix.soliera_js')
    </body>

@endauth



</html>
