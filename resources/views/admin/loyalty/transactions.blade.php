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
    <title>Loyalty Transactions</title>
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
                <!-- Page Header -->
                <div class="pb-5 border-b border-base-300 animate-fadeIn mb-6">
                    <h1 class="text-2xl font-bold bg-white bg-clip-text text-[#191970]">
                       
                        Loyalty Transactions
                    </h1>
                </div>

                <!-- Stats Overview -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    <!-- Total Transactions -->
                    <div class="bg-white rounded-xl border border-transparent p-6 shadow-lg transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-blue-500 group">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wide group-hover:text-blue-700 transition-colors">
                                    Total Transactions</h3>
                                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $transactions->total() ?? 0 }}</p>
                                <span class="text-sm text-gray-500 group-hover:text-blue-600 transition-colors">All Time</span>
                            </div>
                            <div class="w-16 h-16 flex items-center justify-center bg-blue-900 rounded-xl group-hover:bg-orange-500 transition-colors duration-300">
                                <i class="fas fa-exchange-alt text-yellow-400 text-3xl group-hover:text-white"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Points Earned -->
                    <div class="bg-white rounded-xl border border-transparent p-6 shadow-lg transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-green-400 group">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wide group-hover:text-green-700">
                                    Points Earned</h3>
                                @php
                                    $pointsEarned = $transactions->where('points_change', '>', 0)->sum('points_change');
                                @endphp
                                <p class="text-3xl font-bold text-gray-900 mt-2">{{ number_format($pointsEarned) }}</p>
                                <span class="text-sm text-gray-500 group-hover:text-blue-600">All Time</span>
                            </div>
                            <div class="w-16 h-16 flex items-center justify-center bg-blue-900 rounded-xl group-hover:bg-blue-500 transition-colors duration-300">
                                <i class="fas fa-plus-circle text-yellow-400 text-3xl group-hover:text-white"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Points Redeemed -->
                    <div class="bg-white rounded-xl border border-transparent p-6 shadow-lg transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-red-400 group">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wide group-hover:text-red-700">
                                    Points Redeemed</h3>
                                @php
                                    $pointsRedeemed = abs($transactions->where('points_change', '<', 0)->sum('points_change'));
                                @endphp
                                <p class="text-3xl font-bold text-gray-900 mt-2">{{ number_format($pointsRedeemed) }}</p>
                                <span class="text-sm text-gray-500 group-hover:text-blue-600">All Time</span>
                            </div>
                            <div class="w-16 h-16 flex items-center justify-center bg-blue-900 rounded-xl group-hover:bg-blue-500 transition-colors duration-300">
                                <i class="fas fa-minus-circle text-yellow-400 text-3xl group-hover:text-white"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Net Points -->
                    <div class="bg-white rounded-xl border border-transparent p-6 shadow-lg transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-purple-400 group">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wide group-hover:text-blue-700">
                                    Net Points</h3>
                                <p class="text-3xl font-bold text-gray-900 mt-2">{{ number_format($pointsEarned - $pointsRedeemed) }}</p>
                                <span class="text-sm text-gray-500 group-hover:text-blue-600">Current Balance</span>
                            </div>
                            <div class="w-16 h-16 flex items-center justify-center bg-blue-900 rounded-xl group-hover:bg-blue-500 transition-colors duration-300">
                                <i class="fas fa-balance-scale text-yellow-400 text-3xl group-hover:text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Transactions Card -->
                <div class="bg-white rounded-xl border border-gray-200 shadow-lg overflow-hidden">
                    <!-- Header -->
                    <div class="bg-blue-900 text-white px-6 py-4">
                        <div class="flex justify-between items-center">
                            <h2 class="text-lg font-semibold">
                                <i class="fas fa-history me-2"></i>
                                Transaction History
                            </h2>
                         
                        </div>
                    </div>

                    <!-- Filters --> 
                    <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                        <form method="GET" action="{{ route('admin.loyalty.transactions') }}" class="flex flex-wrap items-center gap-3">
                            <!-- Type Filter -->
                            <div class="relative">
                                <i class="fas fa-filter absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                                <select name="type" class="select select-bordered select-sm pl-9 w-44" onchange="this.form.submit()">
                                    <option value="">All Types</option>
                                    <option value="earned" {{ request('type') == 'earned' ? 'selected' : '' }}>Earned</option>
                                    <option value="redeemed" {{ request('type') == 'redeemed' ? 'selected' : '' }}>Redeemed</option>
                                    <option value="bonus" {{ request('type') == 'bonus' ? 'selected' : '' }}>Bonus</option>
                                </select>
                            </div>

                            <!-- Date Range -->
                            <div class="relative">
                                <i class="fas fa-calendar absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                                <input type="date" name="date_from" class="input input-bordered input-sm pl-9 w-40"
                                       value="{{ request('date_from') }}">
                            </div>
                            <div class="text-gray-400">to</div>
                            <div class="relative">
                                <i class="fas fa-calendar absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                                <input type="date" name="date_to" class="input input-bordered input-sm pl-9 w-40"
                                       value="{{ request('date_to') }}">
                            </div>

                            <!-- Search -->
                            <div class="relative">
                                <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                                <input type="text" name="search" value="{{ request('search') }}"
                                    placeholder="Search guest..."
                                    class="input input-bordered input-sm pl-9 w-64" />
                            </div>

                            <!-- Buttons -->
                            <div class="flex gap-2 ml-auto">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fas fa-filter me-1"></i> Apply Filters
                                </button>

                                @if(request('search') || request('type') || request('date_from') || request('date_to'))
                                    <a href="{{ route('admin.loyalty.transactions') }}" class="btn btn-ghost btn-sm">
                                        <i class="fas fa-rotate-left me-1"></i> Clear
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>

                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="table w-full text-sm">
                            <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                                <tr>
                                    <th class="px-4 py-3 text-left">Date & Time</th>
                                    <th class="px-4 py-3 text-left">Guest</th>
                                    <th class="px-4 py-3 text-left">Type</th>
                                    <th class="px-4 py-3 text-left">Description</th>
                                    <th class="px-4 py-3 text-left">Points Change</th>
                                    <th class="px-4 py-3 text-left">Balance</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse($transactions as $transaction)
                                    <tr class="hover:bg-gray-50 transition">
                                        <!-- Date & Time -->
                                        <td class="px-4 py-3">
                                            <div class="flex flex-col">
                                                <span class="font-medium text-gray-900">
                                                    {{ $transaction->transaction_date->format('M d, Y') }}
                                                </span>
                                                <span class="text-xs text-gray-500">
                                                    {{ $transaction->transaction_date->format('h:i A') }}
                                                </span>
                                                <span class="text-xs text-gray-400">
                                                    {{ $transaction->transaction_date->diffForHumans() }}
                                                </span>
                                            </div>
                                        </td>

                                        <!-- Guest Info -->
                                        <td class="px-4 py-3">
                                            @if($transaction->guest)
                                                <div class="flex items-center gap-3">
                                                    <!-- Avatar -->
                                                    <div class="relative">
                                                        @if($transaction->guest->guest_photo)
                                                            <img src="{{ asset($transaction->guest->guest_photo) }}" 
                                                                 alt="{{ $transaction->guest->guest_name }}" 
                                                                 class="w-10 h-10 rounded-full object-cover border-2 border-white shadow-sm">
                                                        @else
                                                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center shadow-sm">
                                                                <span class="text-white font-bold text-xs">
                                                                    {{ strtoupper(substr($transaction->guest->guest_name, 0, 2)) }}
                                                                </span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    
                                                    <!-- Guest Details -->
                                                    <div>
                                                        <div class="font-semibold text-gray-800">{{ $transaction->guest->guest_name }}</div>
                                                        <div class="text-xs text-gray-500">{{ $transaction->guest->guest_email }}</div>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="flex items-center gap-2 text-gray-400">
                                                    <i class="fas fa-user-slash"></i>
                                                    <span>Guest not found</span>
                                                </div>
                                            @endif
                                        </td>

                                        <!-- Transaction Type -->
                                        <td class="px-4 py-3">
                                            @switch($transaction->transaction_type)
                                                @case('earned')
                                                    <div class="flex items-center gap-2">
                                                        <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center">
                                                            <i class="fas fa-plus text-green-600 text-xs"></i>
                                                        </div>
                                                        <span class="px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                            Earned
                                                        </span>
                                                    </div>
                                                    @break
                                                @case('redeemed')
                                                    <div class="flex items-center gap-2">
                                                        <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center">
                                                            <i class="fas fa-minus text-red-600 text-xs"></i>
                                                        </div>
                                                        <span class="px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                            Redeemed
                                                        </span>
                                                    </div>
                                                    @break
                                                @case('bonus')
                                                    <div class="flex items-center gap-2">
                                                        <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center">
                                                            <i class="fas fa-gift text-blue-600 text-xs"></i>
                                                        </div>
                                                        <span class="px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                            Bonus
                                                        </span>
                                                    </div>
                                                    @break
                                                @default
                                                    <span class="px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                        {{ $transaction->transaction_type }}
                                                    </span>
                                            @endswitch
                                        </td>

                                        <!-- Description -->
                                        <td class="px-4 py-3">
                                            <div class="font-medium text-gray-800">{{ $transaction->description }}</div>
                                            @if($transaction->reference_type)
                                                <div class="flex items-center gap-1 mt-1">
                                                    <span class="text-xs px-2 py-1 rounded bg-gray-100 text-gray-600">
                                                        {{ class_basename($transaction->reference_type) }} #{{ $transaction->reference_id }}
                                                    </span>
                                                </div>
                                            @endif
                                        </td>

                                        <!-- Points Change -->
                                        <td class="px-4 py-3">
                                            <div class="flex items-center gap-2">
                                                @if($transaction->points_change > 0)
                                                    <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center">
                                                        <i class="fas fa-arrow-up text-green-600"></i>
                                                    </div>
                                                    <div>
                                                        <div class="font-bold text-green-600">
                                                            +{{ number_format($transaction->points_change) }}
                                                        </div>
                                                        <div class="text-xs text-gray-500">points added</div>
                                                    </div>
                                                @else
                                                    <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center">
                                                        <i class="fas fa-arrow-down text-red-600"></i>
                                                    </div>
                                                    <div>
                                                        <div class="font-bold text-red-600">
                                                            {{ number_format($transaction->points_change) }}
                                                        </div>
                                                        <div class="text-xs text-gray-500">points redeemed</div>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>

                                        <!-- Balance After -->
                                        <td class="px-4 py-3">
                                            <div class="flex items-center gap-2">
                                                <i class="fas fa-wallet text-purple-500"></i>
                                                <div>
                                                    <div class="font-bold text-gray-900">
                                                        {{ number_format($transaction->points_balance_after) }}
                                                    </div>
                                                    <div class="text-xs text-gray-500">balance after</div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="py-10 text-center text-gray-500">
                                            <div class="flex flex-col items-center justify-center space-y-2">
                                                <i class="fas fa-exchange-alt text-4xl text-gray-400"></i>
                                                <p class="text-lg font-medium">No transactions found</p>
                                                <p class="text-sm text-gray-400">
                                                    {{ request('type') ? 'No ' . request('type') . ' transactions' : 'Transactions will appear here' }}
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination & Info -->
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                        <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                            <div class="text-sm text-gray-600">
                                Showing <span class="font-semibold">{{ $transactions->firstItem() }}</span> to 
                                <span class="font-semibold">{{ $transactions->lastItem() }}</span> of 
                                <span class="font-semibold">{{ $transactions->total() }}</span> transactions
                            </div>
                            <div class="flex items-center">
                                {{ $transactions->links('pagination::tailwind') }}
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    @livewireScripts
    @include('javascriptfix.soliera_js')
</body>
@endauth

</html>
