<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://unpkg.com/lucide@latest"></script>
    <title>Membership Tiers</title>
    @livewireStyles
</head>

<body class="bg-base-100">
    @auth
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
                          
                            Membership Tiers Management
                        </h1>
                    </div>

                    <!-- Stats Overview -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                        <!-- Total Members -->
                        <div
                            class="bg-white rounded-xl border border-transparent p-6 shadow-lg transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-blue-500 group">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3
                                        class="text-sm font-semibold text-gray-600 uppercase tracking-wide group-hover:text-blue-700 transition-colors">
                                        Total Members</h3>
                                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalMembers ?? 0 }}</p>
                                    <span class="text-sm text-gray-500 group-hover:text-blue-600 transition-colors">All
                                        Tiers</span>
                                </div>
                                <div
                                    class="w-16 h-16 flex items-center justify-center bg-blue-900 rounded-xl group-hover:bg-blue-500 transition-colors duration-300">
                                    <i class="fas fa-users text-yellow-400 text-3xl group-hover:text-white"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Tier Count -->
                        <div
                            class="bg-white rounded-xl border border-transparent p-6 shadow-lg transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-green-400 group">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3
                                        class="text-sm font-semibold text-gray-600 uppercase tracking-wide group-hover:text-blue-700">
                                        Total Tiers</h3>
                                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ count($tiers) }}</p>
                                    <span class="text-sm text-gray-500 group-hover:text-blue-600">Active Levels</span>
                                </div>
                                <div
                                    class="w-16 h-16 flex items-center justify-center bg-blue-900 rounded-xl group-hover:bg-blue-500 transition-colors duration-300">
                                    <i class="fas fa-layer-group text-yellow-400 text-3xl group-hover:text-white"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Top Tier Members -->
                        <div
                            class="bg-white rounded-xl border border-transparent p-6 shadow-lg transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-purple-400 group">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3
                                        class="text-sm font-semibold text-gray-600 uppercase tracking-wide group-hover:text-blue-700">
                                        Elite Members</h3>
                                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $eliteMembers ?? 0 }}</p>
                                    <span class="text-sm text-gray-500 group-hover:text-blue-600">Highest Tier</span>
                                </div>
                                <div
                                    class="w-16 h-16 flex items-center justify-center bg-blue-900 rounded-xl group-hover:bg-blue-500 transition-colors duration-300">
                                    <i class="fas fa-crown text-yellow-400 text-3xl group-hover:text-white"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Points Distributed -->
                        <div
                            class="bg-white rounded-xl border border-transparent p-6 shadow-lg transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-yellow-400 group">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3
                                        class="text-sm font-semibold text-gray-600 uppercase tracking-wide group-hover:text-blue-700">
                                        Points Value</h3>
                                    <p class="text-3xl font-bold text-gray-900 mt-2">
                                        {{ number_format($totalPointsValue ?? 0) }}</p>
                                    <span class="text-sm text-gray-500 group-hover:text-blue-600">Total Points</span>
                                </div>
                                <div
                                    class="w-16 h-16 flex items-center justify-center bg-blue-900 rounded-xl group-hover:bg-blue-500 transition-colors duration-300">
                                    <i class="fas fa-coins text-yellow-400 text-3xl group-hover:text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Main Tiers Card -->
                    <div class="bg-white rounded-xl border border-gray-200 shadow-lg overflow-hidden">
                        <!-- Header -->
                        <div class="bg-blue-900 text-white px-6 py-4">
                            <div class="flex justify-between items-center">
                                <h2 class="text-lg font-semibold">
                                    <i class="fas fa-crown me-2"></i>
                                    Membership Tiers
                                </h2>
                                <button class="btn btn-primary btn-sm" onclick="openCreateTierModal()">
                                    <i class="fas fa-plus me-1"></i> Add New Tier
                                </button>
                            </div>
                        </div>

                        <!-- Tiers Grid -->
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                                @foreach($tiers as $tier)
                                    <div class="bg-gradient-to-br from-white to-gray-50 rounded-xl border-2 p-6 shadow-lg transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl group"
                                        style="border-color: {{ $tier->badge_color }};">
                                        <!-- Tier Header -->
                                        <div class="mb-4 pb-3 border-b border-gray-200">
                                            <div class="flex items-center justify-between mb-2">
                                                <div class="flex items-center gap-3">
                                                    <div class="w-12 h-12 rounded-xl flex items-center justify-center"
                                                        style="background-color: {{ $tier->badge_color }}20;">
                                                        <i class="fas fa-crown text-xl"
                                                            style="color: {{ $tier->badge_color }};"></i>
                                                    </div>
                                                    <div>
                                                        <h3 class="font-bold text-lg" style="color: {{ $tier->badge_color }};">
                                                            {{ $tier->tier_name }}
                                                        </h3>
                                                        @if($tier->members_count ?? false)
                                                            <p class="text-sm text-gray-500">{{ $tier->members_count }} members</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Requirements -->
                                        <div class="mb-4">
                                            <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                                                <i class="fas fa-flag me-1"></i> Requirements
                                            </h4>
                                            <div class="space-y-2">
                                                <div class="flex items-center justify-between">
                                                    <div class="flex items-center gap-2">
                                                        <i class="fas fa-coins text-yellow-500"></i>
                                                        <span class="text-sm text-gray-600">Min Points</span>
                                                    </div>
                                                    <span
                                                        class="font-bold text-gray-900">{{ number_format($tier->min_points) }}</span>
                                                </div>
                                                <div class="flex items-center justify-between">
                                                    <div class="flex items-center gap-2">
                                                        <i class="fas fa-money-bill-wave text-green-500"></i>
                                                        <span class="text-sm text-gray-600">Min Spent</span>
                                                    </div>
                                                    <span
                                                        class="font-bold text-gray-900">₱{{ number_format($tier->min_spent, 2) }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Benefits -->
                                        <div class="mb-4">
                                            <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                                                <i class="fas fa-gift me-1"></i> Benefits
                                            </h4>
                                            <div class="space-y-2">
                                                <div class="flex items-center justify-between">
                                                    <div class="flex items-center gap-2">
                                                        <i class="fas fa-utensils text-red-500"></i>
                                                        <span class="text-sm text-gray-600">Food Discount</span>
                                                    </div>
                                                    <span class="font-bold text-gray-900">{{ $tier->food_discount }}%</span>
                                                </div>
                                                <div class="flex items-center justify-between">
                                                    <div class="flex items-center gap-2">
                                                        <i class="fas fa-bed text-blue-500"></i>
                                                        <span class="text-sm text-gray-600">Room Discount</span>
                                                    </div>
                                                    <span class="font-bold text-gray-900">{{ $tier->room_discount }}%</span>
                                                </div>
                                                <div class="flex items-center justify-between">
                                                    <div class="flex items-center gap-2">
                                                        <i class="fas fa-rocket text-purple-500"></i>
                                                        <span class="text-sm text-gray-600">Points Multiplier</span>
                                                    </div>
                                                    <span class="font-bold text-gray-900">{{ $tier->points_multiplier }}x</span>
                                                </div>
                                                <div class="flex items-center justify-between">
                                                    <div class="flex items-center gap-2">
                                                        <i class="fas fa-star text-yellow-500"></i>
                                                        <span class="text-sm text-gray-600">Bonus Points</span>
                                                    </div>
                                                    <span class="font-bold text-gray-900">+{{ $tier->bonus_points }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Additional Benefits -->
                                        @if($tier->benefits && count($tier->benefits) > 0)
                                            <div class="mb-4">
                                                <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                                                    <i class="fas fa-sparkles me-1"></i> Premium Benefits
                                                </h4>
                                                <ul class="space-y-1">
                                                    @foreach($tier->benefits as $benefit)
                                                        <li class="flex items-start gap-2">
                                                            <i class="fas fa-check text-green-500 mt-1"></i>
                                                            <span class="text-sm text-gray-600">{{ $benefit }}</span>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        <!-- Action Buttons -->
                                        <div class="pt-4 border-t border-gray-200">
                                            <div class="flex justify-between gap-2">
                                                <button class="btn btn-primary btn-sm flex-1"
                                                    onclick="openEditTierModal('{{ $tier->tier_name }}', {{ json_encode($tier) }})">
                                                    <i class="fas fa-edit me-1"></i> Edit
                                                </button>
                                               
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Empty State -->
                            @if(count($tiers) === 0)
                                <div class="py-10 text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center space-y-2">
                                        <i class="fas fa-layer-group text-4xl text-gray-400"></i>
                                        <p class="text-lg font-medium">No membership tiers found</p>
                                        <p class="text-sm text-gray-400">Create your first tier to get started.</p>
                                        <button class="btn btn-primary mt-4" onclick="openCreateTierModal()">
                                            <i class="fas fa-plus me-1"></i> Create First Tier
                                        </button>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Tier Progression -->
                        @if(count($tiers) > 1)
                            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                                <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wider mb-4">
                                    <i class="fas fa-chart-line me-1"></i> Tier Progression Path
                                </h3>
                                <div class="relative">
                                    <!-- Progression Line -->
                                    <div class="absolute top-1/2 left-0 right-0 h-0.5 bg-gray-300 -translate-y-1/2"></div>

                                    <!-- Tiers on Progression Line -->
                                    <div class="relative flex justify-between">
                                        @foreach($tiers as $index => $tier)
                                            <div class="flex flex-col items-center">
                                                <!-- Tier Dot -->
                                                <div class="w-10 h-10 rounded-full border-4 border-white shadow-lg flex items-center justify-center z-10 mb-2"
                                                    style="background-color: {{ $tier->badge_color }};">
                                                    <span class="text-white font-bold text-sm">{{ $index + 1 }}</span>
                                                </div>

                                                <!-- Tier Name -->
                                                <span class="text-sm font-medium" style="color: {{ $tier->badge_color }};">
                                                    {{ $tier->tier_name }}
                                                </span>

                                                <!-- Points Requirement -->
                                                <span class="text-xs text-gray-500 mt-1">
                                                    {{ number_format($tier->min_points) }} pts
                                                </span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </main>
            </div>
        </div>

        <!-- Create Tier Modal -->
        <dialog id="createTierModal" class="modal">
            <div class="modal-box w-11/12 max-w-2xl">
                <form method="dialog">
                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                </form>
                <h3 class="font-bold text-lg">Create New Membership Tier</h3>
                <form id="createTierForm" onsubmit="createTier(event)">
                    @csrf
                    <div class="py-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Tier Name *</span>
                                </label>
                                <input type="text" id="create_tier_name" name="tier_name" class="input input-bordered"
                                    placeholder="e.g., Gold, Platinum" required>
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Badge Color *</span>
                                </label>
                                <input type="color" id="create_badge_color" name="badge_color" class="input input-bordered"
                                    value="#FFD700" required>
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Food Discount (%)</span>
                                </label>
                                <input type="number" id="create_food_discount" name="food_discount"
                                    class="input input-bordered" min="0" max="100" step="0.01" value="0">
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Room Discount (%)</span>
                                </label>
                                <input type="number" id="create_room_discount" name="room_discount"
                                    class="input input-bordered" min="0" max="100" step="0.01" value="0">
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Points Multiplier</span>
                                </label>
                                <input type="number" id="create_points_multiplier" name="points_multiplier"
                                    class="input input-bordered" min="0.1" max="10" step="0.1" value="1">
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Bonus Points</span>
                                </label>
                                <input type="number" id="create_bonus_points" name="bonus_points"
                                    class="input input-bordered" min="0" value="0">
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Minimum Points Required *</span>
                                </label>
                                <input type="number" id="create_min_points" name="min_points" class="input input-bordered"
                                    min="0" required>
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Minimum Spending Required (₱) *</span>
                                </label>
                                <input type="number" id="create_min_spent" name="min_spent" class="input input-bordered"
                                    min="0" step="0.01" required>
                            </div>
                        </div>

                        <div class="form-control mt-4">
                            <label class="label">
                                <span class="label-text">Additional Benefits</span>
                            </label>
                            <div id="create_benefits-container">
                                <div class="input-group mb-2">
                                    <input type="text" class="input input-bordered" name="benefits[]"
                                        placeholder="Enter benefit">
                                    <button type="button" class="btn btn-error" onclick="this.parentElement.remove()">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <button type="button" class="btn btn-outline btn-sm mt-2" onclick="addCreateBenefit()">
                                <i class="fas fa-plus me-1"></i> Add Benefit
                            </button>
                        </div>
                    </div>

                    <div class="modal-action">
                        <button type="button" class="btn btn-ghost"
                            onclick="document.getElementById('createTierModal').close()">Cancel</button>
                        <button type="submit" class="btn btn-primary">Create Tier</button>
                    </div>
                </form>
            </div>
            <form method="dialog" class="modal-backdrop">
                <button>close</button>
            </form>
        </dialog>

        <!-- Edit Tier Modal -->
        <dialog id="editTierModal" class="modal">
            <div class="modal-box w-11/12 max-w-2xl">
                <form method="dialog">
                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                </form>
                <h3 class="font-bold text-lg">Edit Membership Tier</h3>
                <form id="editTierForm" onsubmit="saveTier(event)">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="tierName" name="tier_name">

                    <div class="py-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Food Discount (%)</span>
                                </label>
                                <input type="number" id="food_discount" name="food_discount" class="input input-bordered"
                                    min="0" max="100" step="0.01" required>
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Room Discount (%)</span>
                                </label>
                                <input type="number" id="room_discount" name="room_discount" class="input input-bordered"
                                    min="0" max="100" step="0.01" required>
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Points Multiplier</span>
                                </label>
                                <input type="number" id="points_multiplier" name="points_multiplier"
                                    class="input input-bordered" min="0.1" max="10" step="0.1" required>
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Bonus Points</span>
                                </label>
                                <input type="number" id="bonus_points" name="bonus_points" class="input input-bordered"
                                    min="0" required>
                            </div>
                        </div>

                        <div class="form-control mt-4">
                            <label class="label">
                                <span class="label-text">Additional Benefits</span>
                            </label>
                            <div id="benefits-container">
                                <!-- Benefits will be loaded here -->
                            </div>
                            <button type="button" class="btn btn-outline btn-sm mt-2" onclick="addBenefit()">
                                <i class="fas fa-plus me-1"></i> Add Benefit
                            </button>
                        </div>

                        <!-- Read-only requirements -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Minimum Points Required</span>
                                </label>
                                <input type="text" id="min_points" class="input input-bordered" readonly>
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Minimum Spending Required</span>
                                </label>
                                <input type="text" id="min_spent" class="input input-bordered" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="modal-action">
                        <button type="button" class="btn btn-ghost"
                            onclick="document.getElementById('editTierModal').close()">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
            <form method="dialog" class="modal-backdrop">
                <button>close</button>
            </form>
        </dialog>

        <script>
            // Store tier data
            let tierData = {};

            // Open create tier modal
            function openCreateTierModal() {
                console.log('Opening create tier modal');

                // Reset form
                document.getElementById('createTierForm').reset();

                // Clear benefits container and add one empty field
                const container = document.getElementById('create_benefits-container');
                container.innerHTML = `
                    <div class="input-group mb-2">
                        <input type="text" class="input input-bordered" name="benefits[]" placeholder="Enter benefit">
                        <button type="button" class="btn btn-error" onclick="this.parentElement.remove()">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                `;

                // Show modal using DaisyUI dialog
                const modal = document.getElementById('createTierModal');
                modal.showModal();
            }

            // Add benefit to create form
            function addCreateBenefit() {
                const container = document.getElementById('create_benefits-container');
                const div = document.createElement('div');
                div.className = 'input-group mb-2';
                div.innerHTML = `
                    <input type="text" class="input input-bordered" name="benefits[]" placeholder="Enter benefit">
                    <button type="button" class="btn btn-error" onclick="this.parentElement.remove()">
                        <i class="fas fa-minus"></i>
                    </button>
                `;
                container.appendChild(div);
            }

            // Create new tier
            async function createTier(event) {
                event.preventDefault();

                const formData = new FormData(document.getElementById('createTierForm'));

                console.log('Creating new tier');

                // Convert FormData to object
                const data = {};
                formData.forEach((value, key) => {
                    if (key === 'benefits[]') {
                        if (!data.benefits) data.benefits = [];
                        if (value.trim() !== '') {
                            data.benefits.push(value);
                        }
                    } else {
                        data[key] = value;
                    }
                });

                // Ensure benefits is always an array
                if (!data.benefits) {
                    data.benefits = [];
                }

                console.log('Data to send:', data);

                try {
                    const response = await fetch('/admin/loyalty/tiers', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify(data)
                    });

                    const responseData = await response.json();

                    if (responseData.success) {
                        document.getElementById('createTierModal').close();
                        window.location.reload();
                    } else {
                        alert('Error creating tier: ' + (responseData.message || 'Unknown error'));
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Error creating tier: ' + error.message);
                }
            }

            // Open edit modal with tier data
            function openEditTierModal(tierName, tier) {
                console.log('Opening modal for:', tierName, tier);

                if (tier) {
                    tierData = tier;

                    // Fill form with tier data
                    document.getElementById('tierName').value = tier.tier_name;
                    document.getElementById('food_discount').value = tier.food_discount;
                    document.getElementById('room_discount').value = tier.room_discount;
                    document.getElementById('points_multiplier').value = tier.points_multiplier;
                    document.getElementById('bonus_points').value = tier.bonus_points;
                    document.getElementById('min_points').value = tier.min_points;
                    document.getElementById('min_spent').value = '₱' + parseFloat(tier.min_spent).toFixed(2);

                    // Load benefits
                    loadBenefits(tier.benefits || []);

                    // Show modal
                    document.getElementById('editTierModal').showModal();
                }
            }

            // Load benefits into the container
            function loadBenefits(benefits) {
                const container = document.getElementById('benefits-container');
                container.innerHTML = '';

                if (benefits.length === 0) {
                    addBenefit();
                } else {
                    benefits.forEach((benefit, index) => {
                        const div = document.createElement('div');
                        div.className = 'input-group mb-2';
                        div.innerHTML = `
                            <input type="text" class="input input-bordered" name="benefits[]" value="${benefit}" placeholder="Enter benefit">
                            <button type="button" class="btn btn-error" onclick="this.parentElement.remove()">
                                <i class="fas fa-minus"></i>
                            </button>
                        `;
                        container.appendChild(div);
                    });
                }
            }

            // Add new benefit field
            function addBenefit() {
                const container = document.getElementById('benefits-container');
                const div = document.createElement('div');
                div.className = 'input-group mb-2';
                div.innerHTML = `
                    <input type="text" class="input input-bordered" name="benefits[]" placeholder="Enter benefit">
                    <button type="button" class="btn btn-error" onclick="this.parentElement.remove()">
                        <i class="fas fa-minus"></i>
                    </button>
                `;
                container.appendChild(div);
            }

            // Save tier via AJAX
            async function saveTier(event) {
                event.preventDefault();

                const formData = new FormData(document.getElementById('editTierForm'));
                const tierName = formData.get('tier_name');

                console.log('Saving tier:', tierName);

                // Convert FormData to object
                const data = {};
                formData.forEach((value, key) => {
                    if (key === 'benefits[]') {
                        if (!data.benefits) data.benefits = [];
                        if (value.trim() !== '') {
                            data.benefits.push(value);
                        }
                    } else {
                        data[key] = value;
                    }
                });

                // Ensure benefits is always an array
                if (!data.benefits) {
                    data.benefits = [];
                }

                console.log('Data to send:', data);

                try {
                    const response = await fetch(`/admin/loyalty/tiers/${encodeURIComponent(tierName)}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify(data)
                    });

                    const responseData = await response.json();

                    if (responseData.success) {
                        document.getElementById('editTierModal').close();
                        window.location.reload();
                    } else {
                        alert('Error saving tier: ' + (responseData.message || 'Unknown error'));
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Error saving tier: ' + error.message);
                }
            }

            // Initialize modals on page load
            document.addEventListener('DOMContentLoaded', function () {
                console.log('DOM loaded, modals initialized');

                // Add global click handler for modal backdrops
                document.addEventListener('click', function (event) {
                    const createModal = document.getElementById('createTierModal');
                    const editModal = document.getElementById('editTierModal');

                    if (event.target === createModal) {
                        createModal.close();
                    }
                    if (event.target === editModal) {
                        editModal.close();
                    }
                });
            });
        </script>

        @livewireScripts
        @include('javascriptfix.soliera_js')
    @endauth
</body>

</html>