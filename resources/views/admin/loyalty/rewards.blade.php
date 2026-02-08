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
    <title>Manage Rewards</title>
    @livewireStyles
</head>

<body class="bg-base-100">
    @auth
        <!-- Main Container -->
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
                        <div class="flex justify-between items-center">
                            <h1 class="text-2xl font-bold bg-white bg-clip-text text-[#191970]">
                            
                                Manage Rewards
                            </h1>
                            <a href="{{ route('admin.loyalty.rewards.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-1"></i> Add New Reward
                            </a>
                        </div>
                    </div>

                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-4 gap-6 mb-6">
                        <!-- Total Rewards -->
                        <div class="bg-white rounded-xl border border-transparent p-6 shadow-lg transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-blue-500 group">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wide group-hover:text-blue-700 transition-colors">
                                        Total Rewards</h3>
                                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $rewards->total() }}</p>
                                    <span class="text-sm text-gray-500 group-hover:text-blue-600 transition-colors">All Categories</span>
                                </div>
                                <div class="w-16 h-16 flex items-center justify-center bg-blue-900 rounded-xl group-hover:bg-orange-500 transition-colors duration-300">
                                    <i class="fas fa-gift text-yellow-400 text-3xl group-hover:text-white"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Active Rewards -->
                        <div class="bg-white rounded-xl border border-transparent p-6 shadow-lg transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-green-400 group">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wide group-hover:text-green-700">
                                        Active Rewards</h3>
                                    <p class="text-3xl font-bold text-gray-900 mt-2">
                                        {{ $rewards->where('is_active', true)->count() }}
                                    </p>
                                    <span class="text-sm text-gray-500 group-hover:text-blue-600">Available Now</span>
                                </div>
                                <div class="w-16 h-16 flex items-center justify-center bg-blue-900 rounded-xl group-hover:bg-blue-500 transition-colors duration-300">
                                    <i class="fas fa-bolt text-yellow-400 text-3xl group-hover:text-white"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Low Stock -->
                        <div class="bg-white rounded-xl border border-transparent p-6 shadow-lg transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-yellow-400 group">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wide group-hover:text-yellow-700">
                                        Low Stock</h3>
                                    @php
    $lowStock = $rewards->filter(function ($reward) {
        return $reward->stock_quantity > 0 && $reward->stock_quantity <= 10 && $reward->stock_quantity !== -1;
    })->count();
                                    @endphp
                                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $lowStock }}</p>
                                    <span class="text-sm text-gray-500 group-hover:text-blue-600">Need Restocking</span>
                                </div>
                                <div class="w-16 h-16 flex items-center justify-center bg-blue-900 rounded-xl group-hover:bg-blue-500 transition-colors duration-300">
                                    <i class="fas fa-exclamation-triangle text-yellow-400 text-3xl group-hover:text-white"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Total Redemptions -->
                        <div class="bg-white rounded-xl border border-transparent p-6 shadow-lg transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-purple-400 group">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wide group-hover:text-purple-700">
                                        Total Redemptions</h3>
                                    <p class="text-3xl font-bold text-gray-900 mt-2">
                                        {{ $rewards->sum('redemption_count') }}
                                    </p>
                                    <span class="text-sm text-gray-500 group-hover:text-blue-600">All Time</span>
                                </div>
                                <div class="w-16 h-16 flex items-center justify-center bg-blue-900 rounded-xl group-blue:bg-orange-500 transition-colors duration-300">
                                    <i class="fas fa-trophy text-yellow-400 text-3xl group-hover:text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Main Table Section -->
                    <div class="bg-white rounded-xl border border-gray-200 shadow-lg overflow-hidden">
                        <!-- Header -->
                        <div class="bg-blue-900 text-white px-6 py-4">
                            <h2 class="text-lg font-semibold">
                                <i class="fas fa-list me-2"></i>
                                Rewards List
                            </h2>
                        </div>

                        <!-- Filters -->
                        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                            <form method="GET" action="{{ route('admin.loyalty.rewards') }}" class="flex flex-wrap items-center gap-3">
                                <!-- Category Filter -->
                                <div class="relative">
                                    <i class="fas fa-filter absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                                    <select name="category" class="select select-bordered select-sm pl-9 w-52">
                                        <option value="">All Categories</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                                                {{ ucfirst($category) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Status Filter -->
                                <div class="relative">
                                    <i class="fas fa-circle absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                                    <select name="status" class="select select-bordered select-sm pl-9 w-52">
                                        <option value="">All Status</option>
                                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                        <option value="expired" {{ request('status') == 'expired' ? 'selected' : '' }}>Expired</option>
                                    </select>
                                </div>

                                <!-- Search -->
                                <div class="relative">
                                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                                    <input type="text" name="search" value="{{ request('search') }}"
                                        placeholder="Search rewards..."
                                        class="input input-bordered input-sm pl-9 w-64" />
                                </div>

                                <!-- Buttons -->
                                <div class="flex gap-2 ml-auto">
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fas fa-filter me-1"></i> Apply Filters
                                    </button>

                                    @if(request('search') || request('category') || request('status'))
                                        <a href="{{ route('admin.loyalty.rewards') }}" class="btn btn-ghost btn-sm">
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
                                        <th class="px-4 py-3 text-left">Reward Name</th>
                                        <th class="px-4 py-3 text-left">Category</th>
                                        <th class="px-4 py-3 text-left">Points Required</th>
                                        <th class="px-4 py-3 text-left">Stock</th>
                                        <th class="px-4 py-3 text-left">Status</th>
                                        <th class="px-4 py-3 text-left">Redemptions</th>
                                        <th class="px-4 py-3 text-left">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @forelse($rewards as $reward)
                                        <tr class="hover:bg-gray-50 transition">
                                            <!-- Reward Name -->
                                            <td class="px-4 py-3">
                                                <div class="flex items-center gap-3">
                                                    <div class="w-10 h-10 rounded-lg bg-blue-900 flex items-center justify-center">
                                                        <i class="fas fa-gift text-yellow-400"></i>
                                                    </div>
                                                    <div>
                                                        <div class="font-semibold text-gray-800">{{ $reward->name }}</div>
                                                        <div class="text-xs text-gray-500 mt-1">
                                                            {{ Str::limit($reward->description, 50) }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <!-- Category -->
                                            <td class="px-4 py-3">
                                                @php
        $categoryColors = [
            'room_upgrade' => 'bg-blue-100 text-blue-800',
            'food_beverage' => 'bg-green-100 text-green-800',
            'spa_wellness' => 'bg-pink-100 text-pink-800',
            'experience' => 'bg-purple-100 text-purple-800',
            'discount' => 'bg-yellow-100 text-yellow-800',
        ];
        $color = $categoryColors[$reward->category] ?? 'bg-gray-100 text-gray-800';
                                                @endphp
                                                <span class="px-3 py-1 rounded-full text-xs font-medium {{ $color }}">
                                                    {{ ucfirst(str_replace('_', ' ', $reward->category)) }}
                                                </span>
                                            </td>

                                            <!-- Points Required -->
                                            <td class="px-4 py-3">
                                                <div class="flex items-center gap-2">
                                                    <i class="fas fa-coins text-yellow-500"></i>
                                                    <span class="font-bold text-gray-900">
                                                        {{ number_format($reward->points_required) }}
                                                    </span>
                                                    <span class="text-xs text-gray-500">points</span>
                                                </div>
                                            </td>

                                            <!-- Stock -->
                                            <td class="px-4 py-3">
                                                @if($reward->stock_quantity === -1)
                                                    <span class="px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        <i class="fas fa-infinity me-1"></i> Unlimited
                                                    </span>
                                                @elseif($reward->stock_quantity > 10)
                                                    <span class="px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                        <i class="fas fa-boxes me-1"></i> {{ $reward->stock_quantity }}
                                                    </span>
                                                @elseif($reward->stock_quantity > 0)
                                                    <span class="px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                        <i class="fas fa-exclamation-circle me-1"></i> {{ $reward->stock_quantity }}
                                                    </span>
                                                @else
                                                    <span class="px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                        <i class="fas fa-times-circle me-1"></i> Out of Stock
                                                    </span>
                                                @endif
                                            </td>

                                            <!-- Status -->
                                            <td class="px-4 py-3">
                                                <div class="flex flex-col gap-1">
                                                    <span class="px-3 py-1 rounded-full text-xs font-medium {{ $reward->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                        {{ $reward->is_active ? 'Active' : 'Inactive' }}
                                                    </span>
                                                    @if($reward->expires_at && $reward->expires_at->isPast())
                                                        <span class="px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                            <i class="fas fa-clock me-1"></i> Expired
                                                        </span>
                                                    @endif
                                                </div>
                                            </td>

                                            <!-- Redemptions -->
                                            <td class="px-4 py-3">
                                                <div class="flex items-center gap-2">
                                                    <i class="fas fa-trophy text-purple-500"></i>
                                                    <span class="font-bold text-gray-900">{{ $reward->redemption_count }}</span>
                                                    @if($reward->redemption_count > 0)
                                                        <div class="w-16 bg-gray-200 rounded-full h-1.5">
                                                            @php
            $maxRedemptions = $rewards->max('redemption_count') ?: 1;
            $percentage = ($reward->redemption_count / $maxRedemptions) * 100;
                                                            @endphp
                                                            <div class="bg-purple-600 h-1.5 rounded-full" style="width: {{ min($percentage, 100) }}%"></div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </td>

                                            <!-- Actions -->
                                            <td class="px-4 py-3">
                                                <div class="flex items-center gap-2">
                                                    <!-- Edit -->
                                                    <a href="{{ route('admin.loyalty.rewards.edit', $reward) }}" 
                                                       class="btn btn-primary btn-xs" 
                                                       title="Edit Reward">
                                                        <i class="fas fa-edit"></i>
                                                    </a>

                                                    <!-- Toggle Status -->
                                                    <form action="{{ route('admin.loyalty.rewards.toggle', $reward) }}" method="POST" class="inline">
                                                        @csrf
                                                        <button type="submit" 
                                                                class="btn {{ $reward->is_active ? 'btn-warning' : 'btn-success' }} btn-xs"
                                                                title="{{ $reward->is_active ? 'Deactivate' : 'Activate' }}">
                                                            <i class="fas fa-{{ $reward->is_active ? 'pause' : 'play' }}"></i>
                                                        </button>
                                                    </form>

                                                    <!-- Delete -->
                                                    <form action="{{ route('admin.loyalty.rewards.delete', $reward) }}" 
                                                          method="POST" 
                                                          class="inline"
                                                          onsubmit="return confirm('Are you sure you want to delete this reward?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-error btn-xs" title="Delete">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="py-10 text-center text-gray-500">
                                                <div class="flex flex-col items-center justify-center space-y-2">
                                                    <i class="fas fa-gift text-4xl text-gray-400"></i>
                                                    <p class="text-lg font-medium">No rewards found</p>
                                                    <p class="text-sm text-gray-400">Add your first reward to get started.</p>
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
                                    Showing <span class="font-semibold">{{ $rewards->firstItem() }}</span> to 
                                    <span class="font-semibold">{{ $rewards->lastItem() }}</span> of 
                                    <span class="font-semibold">{{ $rewards->total() }}</span> rewards
                                </div>
                                <div class="flex items-center">
                                    {{ $rewards->links('pagination::tailwind') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    @endauth

    @livewireScripts
    @include('javascriptfix.soliera_js')
</body>

</html>
