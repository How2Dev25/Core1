<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    @vite('resources/css/app.css')
    <script src="{{ asset('javascript/chart.js') }}"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <title>Loyalty Program - Dashboard</title>
    @livewireStyles
</head>

<body>
    @auth('guest')
        <section class="bg-base-100">
            <div class="flex h-screen overflow-hidden">
                <!-- Sidebar -->
                @include('guest.components.dashboard.sidebar')

                <!-- Main content -->
                <div class="flex flex-col flex-1 overflow-hidden">
                    <!-- Navbar -->
                    @include('guest.components.dashboard.navbar')

                    <!-- Dashboard Content -->
                    <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 ">
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-900 to-blue-700 rounded-2xl p-8 text-white mb-8">
        <h1 class="text-3xl font-bold mb-2">Soliera Loyalty Program</h1>
        <p class="text-blue-100">Earn points, enjoy exclusive benefits, and experience luxury like never before</p>
    </div>

    <!-- Current Membership Status -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Current Tier Card -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Current Membership</h2>
                    <p class="text-gray-600">Your exclusive benefits</p>
                </div>
                <div class="text-right">
                    <div class="inline-flex items-center px-4 py-2 rounded-full text-lg font-bold"
                         style="background-color: {{ $loyaltySummary['current_tier']['badge_color'] }}20; color: {{ $loyaltySummary['current_tier']['badge_color'] }}">
                        {{ $loyaltySummary['current_tier']['name'] }}
                    </div>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="text-3xl font-bold text-gray-900">{{ number_format((int) $loyaltySummary['current_tier']['points']) }}</div>
                    <div class="text-sm text-gray-600">Loyalty Points</div>
                </div>
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="text-3xl font-bold text-gray-900">₱{{ number_format((float) $loyaltySummary['current_tier']['total_spent'], 2) }}</div>
                    <div class="text-sm text-gray-600">Total Spent</div>
                </div>
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="text-3xl font-bold text-gray-900">{{ count($loyaltySummary['current_tier']['benefits']) }}</div>
                    <div class="text-sm text-gray-600">Active Benefits</div>
                </div>
            </div>

            <!-- Benefits List -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-3">Your Benefits</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    @foreach($loyaltySummary['current_tier']['benefits'] as $benefit)
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-700">{{ $benefit }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
            <div class="space-y-3">
                <a href="{{ route('loyalty.rewards') }}" class="block w-full bg-blue-900 text-white text-center py-3 px-4 rounded-lg hover:bg-blue-800 transition">
                    Redeem Rewards
                </a>
                <a href="{{ route('loyalty.transactions') }}" class="block w-full bg-gray-100 text-gray-900 text-center py-3 px-4 rounded-lg hover:bg-gray-200 transition">
                    View Transactions
                </a>
                <button onclick="showTierComparison()" class="block w-full bg-green-600 text-white text-center py-3 px-4 rounded-lg hover:bg-green-700 transition">
                    Compare Tiers
                </button>
            </div>
        </div>
    </div>

    <!-- Progress to Next Tier -->
    @if($loyaltySummary['next_tier'])
    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-semibold text-gray-900">Progress to {{ $loyaltySummary['next_tier']['tier_name'] }}</h3>
            <span class="text-sm text-gray-600">{{ number_format((float) $loyaltySummary['next_tier']['points_progress'], 1) }}% Complete</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Points Progress -->
            <div>
                <div class="flex justify-between text-sm mb-2">
                    <span class="text-gray-600">Points Progress</span>
                    <span class="font-semibold">{{ number_format((int) $loyaltySummary['current_tier']['points']) }} / {{ $loyaltySummary['next_tier']['tier_name'] == 'Silver' ? '2,500' : ($loyaltySummary['next_tier']['tier_name'] == 'Gold' ? '7,500' : '15,000') }}</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-3">
                    <div class="bg-blue-600 h-3 rounded-full transition-all duration-500" style="width: {{ $loyaltySummary['next_tier']['points_progress'] }}%"></div>
                </div>
                @if($loyaltySummary['next_tier']['points_needed'] > 0)
                    <p class="text-sm text-gray-600 mt-2">{{ number_format((int) $loyaltySummary['next_tier']['points_needed']) }} more points needed</p>
                @endif
            </div>

            <!-- Spending Progress -->
            <div>
                <div class="flex justify-between text-sm mb-2">
                    <span class="text-gray-600">Spending Progress</span>
                    <span class="font-semibold">₱{{ number_format((float) $loyaltySummary['current_tier']['total_spent'], 2) }} / ₱{{ number_format((float) ($loyaltySummary['next_tier']['tier_name'] == 'Silver' ? 10000 : ($loyaltySummary['next_tier']['tier_name'] == 'Gold' ? 30000 : 75000)), 2) }}</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-3">
                    <div class="bg-green-600 h-3 rounded-full transition-all duration-500" style="width: {{ $loyaltySummary['next_tier']['spending_progress'] }}%"></div>
                </div>
                @if($loyaltySummary['next_tier']['spending_needed'] > 0)
                    <p class="text-sm text-gray-600 mt-2">₱{{ number_format((float) $loyaltySummary['next_tier']['spending_needed'], 2) }} more spending needed</p>
                @endif
            </div>
        </div>
    </div>
    @endif

    <!-- Recent Transactions -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-semibold text-gray-900">Recent Transactions</h3>
            <a href="{{ route('loyalty.transactions') }}" class="text-blue-600 hover:text-blue-800 text-sm">View All</a>
        </div>

        @if($loyaltySummary['recent_transactions']->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b">
                            <th class="text-left py-2 text-sm font-medium text-gray-600">Date</th>
                            <th class="text-left py-2 text-sm font-medium text-gray-600">Description</th>
                            <th class="text-right py-2 text-sm font-medium text-gray-600">Points</th>
                            <th class="text-right py-2 text-sm font-medium text-gray-600">Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($loyaltySummary['recent_transactions'] as $transaction)
                            <tr class="border-b">
                                <td class="py-3 text-sm">{{ $transaction->transaction_date->format('M d, Y') }}</td>
                                <td class="py-3 text-sm">{{ $transaction->description }}</td>
                                <td class="py-3 text-sm text-right">
                                    <span class="font-semibold {{ $transaction->points_change > 0 ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $transaction->points_change > 0 ? '+' : '' }}{{ $transaction->points_change }}
                                    </span>
                                </td>
                                <td class="py-3 text-sm text-right font-medium">{{ $transaction->points_balance_after }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-8 text-gray-500">
                <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <p>No transactions yet. Start earning points!</p>
            </div>
        @endif
    </div>
</div>

<!-- Tier Comparison Modal -->
<div id="tierModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-xl max-w-4xl w-full mx-4 max-h-[90vh] overflow-y-auto">
        <div class="p-6 border-b">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-bold text-gray-900">Membership Tiers Comparison</h3>
                <button onclick="closeTierModal()" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach($allTiers as $tier)
                    <div class="border rounded-lg p-4 {{ $tier->tier_name === $loyaltySummary['current_tier']['name'] ? 'border-blue-500 bg-blue-50' : '' }}">
                        <div class="text-center mb-3">
                            <div class="inline-block px-3 py-1 rounded-full text-sm font-bold mb-2"
                                 style="background-color: {{ $tier->badge_color }}20; color: {{ $tier->badge_color }}">
                                {{ $tier->tier_name }}
                            </div>
                            @if($tier->tier_name === $loyaltySummary['current_tier']['name'])
                                <span class="text-xs bg-blue-600 text-white px-2 py-1 rounded-full">Current</span>
                            @endif
                        </div>
                        <div class="space-y-2 text-sm">
                            <div><strong>{{ $tier->food_discount }}%</strong> Food Discount</div>
                            <div><strong>{{ $tier->room_discount }}%</strong> Room Discount</div>
                            <div><strong>{{ $tier->points_multiplier }}x</strong> Points Multiplier</div>
                            <div><strong>+{{ $tier->bonus_points }}</strong> Bonus Points</div>
                            <div class="text-xs text-gray-600 mt-2">
                                Min: {{ $tier->min_points }} pts or ₱{{ number_format((float) $tier->min_spent, 2) }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script>
function showTierComparison() {
    document.getElementById('tierModal').classList.remove('hidden');
}

function closeTierModal() {
    document.getElementById('tierModal').classList.add('hidden');
}
</script>
                    </main>
                </div>
            </div>
            @livewireScripts
            @include('javascriptfix.soliera_js')
        </section>
    @endauth

</body>

</html>
