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
    <title>Loyalty Program Members</title>
    @livewireStyles
</head>

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
                      
                        Loyalty Program Members
                    </h1>
                </div>

                <!-- Stats Overview -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    <!-- Total Members -->
                    <div class="bg-white rounded-xl border border-transparent p-6 shadow-lg transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-blue-500 group">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wide group-hover:text-blue-700 transition-colors">
                                    Total Members</h3>
                                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $members->total() ?? 0 }}</p>
                                <span class="text-sm text-gray-500 group-hover:text-blue-600 transition-colors">All Tiers</span>
                            </div>
                            <div class="w-16 h-16 flex items-center justify-center bg-blue-900 rounded-xl group-hover:bg-blue-500 transition-colors duration-300">
                                <i class="fas fa-users text-yellow-400 text-3xl group-hover:text-white"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Total Points -->
                    <div class="bg-white rounded-xl border border-transparent p-6 shadow-lg transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-green-400 group">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wide group-hover:text-blue-700">
                                    Total Points</h3>
                                <p class="text-3xl font-bold text-gray-900 mt-2">
                                    {{ number_format($members->sum('loyalty_points') ?? 0) }}
                                </p>
                                <span class="text-sm text-gray-500 group-hover:text-blue-600">Across All Members</span>
                            </div>
                            <div class="w-16 h-16 flex items-center justify-center bg-blue-900 rounded-xl group-hover:bg-blue-500 transition-colors duration-300">
                                <i class="fas fa-coins text-yellow-400 text-3xl group-hover:text-white"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Total Spending -->
                    <div class="bg-white rounded-xl border border-transparent p-6 shadow-lg transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-purple-400 group">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wide group-hover:text-blue-700">
                                    Total Spending</h3>
                                <p class="text-3xl font-bold text-gray-900 mt-2">
                                    ₱{{ number_format($members->sum('total_spent') ?? 0, 2) }}
                                </p>
                                <span class="text-sm text-gray-500 group-hover:text-blue-600">Lifetime Value</span>
                            </div>
                            <div class="w-16 h-16 flex items-center justify-center bg-blue-900 rounded-xl group-hover:bg-blue-500 transition-colors duration-300">
                                <i class="fas fa-money-bill-wave text-yellow-400 text-3xl group-hover:text-white"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Active Members -->
                    <div class="bg-white rounded-xl border border-transparent p-6 shadow-lg transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-yellow-400 group">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wide group-hover:text-blue-700">
                                    Active Members</h3>
                                @php
                                    $activeMembers = $members->filter(function($member) {
                                        return $member->last_activity && $member->last_activity->diffInDays(now()) <= 30;
                                    })->count();
                                @endphp
                                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $activeMembers }}</p>
                                <span class="text-sm text-gray-500 group-hover:text-blue-600">Last 30 Days</span>
                            </div>
                            <div class="w-16 h-16 flex items-center justify-center bg-blue-900 rounded-xl group-hover:bg-blue-500 transition-colors duration-300">
                                <i class="fas fa-bolt text-yellow-400 text-3xl group-hover:text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Members Card -->
                <div class="bg-white rounded-xl border border-gray-200 shadow-lg overflow-hidden">
                    <!-- Header -->
                    <div class="bg-blue-900 text-white px-6 py-4">
                        <div class="flex justify-between items-center">
                            <h2 class="text-lg font-semibold">
                                <i class="fas fa-user-friends me-2"></i>
                                Members List
                            </h2>
                           
                        </div>
                    </div>

                    <!-- Filters -->
                    <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                        <form method="GET" action="{{ route('admin.loyalty.members') }}" class="flex flex-wrap items-center gap-3">
                            <!-- Tier Filter -->
                            <div class="relative">
                                <i class="fas fa-crown absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                                <select name="tier" class="select select-bordered select-sm pl-9 w-52" onchange="this.form.submit()">
                                    <option value="">All Tiers</option>
                                    @foreach($tiers as $tier)
                                        <option value="{{ $tier }}" {{ request('tier') == $tier ? 'selected' : '' }}>
                                            {{ $tier }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Search -->
                            <div class="relative">
                                <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                                <input type="text" name="search" value="{{ request('search') }}"
                                    placeholder="Search by name or email..."
                                    class="input input-bordered input-sm pl-9 w-64" />
                            </div>

                            <!-- Buttons -->
                            <div class="flex gap-2 ml-auto">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fas fa-filter me-1"></i> Apply Filters
                                </button>

                                @if(request('search') || request('tier'))
                                    <a href="{{ route('admin.loyalty.members') }}" class="btn btn-ghost btn-sm">
                                        <i class="fas fa-rotate-left me-1"></i> Clear
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>

                    <!-- Members Grid using PHP foreach -->
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-6">
                            @forelse($members as $member)
                                <div class="bg-white rounded-lg border border-gray-200 p-4 hover:shadow-lg transition-shadow duration-200">
                                    <!-- Profile Picture and Basic Info -->
                                    <div class="flex items-center mb-4">
                                        <div class="me-3">
                                            @if($member->guest_photo && file_exists(public_path($member->guest_photo)))
                                                <img src="{{ asset($member->guest_photo) }}" alt="{{ $member->guest_name }}" 
                                                     class="rounded-full w-12 h-12 object-cover border-2 border-gray-200">
                                            @else
                                                <div class="rounded-full bg-gray-300 d-flex align-items-center justify-center w-12 h-12 border-2 border-gray-200">
                                                    <i class="fas fa-user text-white text-sm"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex-1">
                                            <h6 class="font-semibold text-gray-900 mb-0">{{ $member->guest_name }}</h6>
                                            <small class="text-gray-500 text-xs">{{ $member->guest_email }}</small>
                                        </div>
                                    </div>

                                    <!-- Membership Tier Badge -->
                                    <div class="mb-3">
                                        @php
                                            $tier = \App\Models\MembershipTier::where('tier_name', $member->membership_tier)->first();
                                        @endphp
                                        @if($tier)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium" 
                                                  style="background-color: {{ $tier->badge_color }}20; color: {{ $tier->badge_color }};">
                                                <i class="fas fa-crown me-1"></i>{{ $member->membership_tier }}
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                {{ $member->membership_tier ?? 'None' }}
                                            </span>
                                        @endif
                                    </div>

                                    <!-- Stats Grid -->
                                    <div class="grid grid-cols-2 gap-3 mb-3">
                                        <div class="text-center p-2 bg-blue-50 rounded">
                                            <div class="text-lg font-bold text-blue-900">{{ number_format($member->loyalty_points) }}</div>
                                            <div class="text-xs text-blue-700">Points</div>
                                        </div>
                                        <div class="text-center p-2 bg-green-50 rounded">
                                            <div class="text-lg font-bold text-green-900">₱{{ number_format($member->total_spent, 0) }}</div>
                                            <div class="text-xs text-green-700">Spent</div>
                                        </div>
                                    </div>

                                    <!-- Additional Info -->
                                    <div class="text-xs text-gray-600 mb-3">
                                        <div class="flex justify-between mb-1">
                                            <span>Member Since:</span>
                                            <span class="font-medium">
                                                @if($member->membership_since)
                                                    {{ $member->membership_since->format('M Y') }}
                                                @else
                                                    N/A
                                                @endif
                                            </span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span>Last Activity:</span>
                                            <span class="font-medium">
                                                @if($member->last_activity)
                                                    {{ $member->last_activity->diffForHumans() }}
                                                @else
                                                    Never
                                                @endif
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Action Button -->
                                    <div class="flex gap-2">
                                        <button onclick="document.getElementById('viewMemberModal_{{ $member->guestID }}').showModal()" 
                                                class="flex-1 btn btn-outline btn-sm text-xs">
                                            <i class="fas fa-eye me-1"></i> View
                                        </button>
                                      
                                    </div>
                                </div>
                            @empty
                                <div class="col-span-full">
                                    <div class="text-center py-12">
                                        <i class="fas fa-users fa-4x text-gray-300 mb-4"></i>
                                        <h5 class="text-xl font-medium text-gray-600 mb-2">No members found</h5>
                                        <p class="text-gray-500">
                                            {{ request('tier') ? 'No members in ' . request('tier') . ' tier' : 'No members match your search criteria' }}
                                        </p>
                                        @if(request('search') || request('tier'))
                                            <a href="{{ route('admin.loyalty.members') }}" class="btn btn-primary mt-4">
                                                <i class="fas fa-rotate-left me-2"></i> Clear Filters
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Pagination & Info -->
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                        <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                            <div class="text-sm text-gray-600">
                                Showing <span class="font-semibold">{{ $members->firstItem() }}</span> to 
                                <span class="font-semibold">{{ $members->lastItem() }}</span> of 
                                <span class="font-semibold">{{ $members->total() }}</span> members
                            </div>
                            <div class="flex items-center">
                                {{ $members->links('pagination::tailwind') }}
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Member Details Modals - PHP foreach -->
    @foreach($members as $member)
        <!-- View Member Details Modal -->
        <dialog id="viewMemberModal_{{ $member->guestID }}" class="modal">
            <div class="modal-box w-11/12 max-w-4xl">
                <form method="dialog">
                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                </form>
                <h3 class="font-bold text-lg mb-6">Member Details</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Profile Section -->
                    <div class="space-y-4">
                        <div class="text-center">
                            @if($member->guest_photo && file_exists(public_path($member->guest_photo)))
                                <img src="{{ asset($member->guest_photo) }}" alt="{{ $member->guest_name }}" 
                                     class="rounded-full w-24 h-24 mx-auto object-cover border-4 border-blue-200">
                            @else
                                <div class="rounded-full bg-gradient-to-br from-blue-500 to-purple-600 w-24 h-24 mx-auto flex items-center justify-center">
                                    <span class="text-white font-bold text-2xl">{{ substr($member->guest_name, 0, 1) }}</span>
                                </div>
                            @endif
                            <h4 class="text-xl font-bold mt-3">{{ $member->guest_name }}</h4>
                            <p class="text-gray-600">{{ $member->guest_email }}</p>
                        </div>

                        <!-- Membership Info -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h5 class="font-semibold mb-3">Membership Information</h5>
                            @php
                                $tier = \App\Models\MembershipTier::where('tier_name', $member->membership_tier)->first();
                            @endphp
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Current Tier:</span>
                                    @if($tier)
                                        <span class="badge" style="background-color: {{ $tier->badge_color }}20; color: {{ $tier->badge_color }};">
                                            <i class="fas fa-crown me-1"></i>{{ $member->membership_tier }}
                                        </span>
                                    @else
                                        <span class="badge bg-gray-200">{{ $member->membership_tier ?? 'None' }}</span>
                                    @endif
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Member Since:</span>
                                    <span class="font-medium">
                                        @if($member->membership_since)
                                            {{ $member->membership_since->format('F d, Y') }}
                                        @else
                                            N/A
                                        @endif
                                    </span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Last Activity:</span>
                                    <span class="font-medium">
                                        @if($member->last_activity)
                                            {{ $member->last_activity->diffForHumans() }}
                                        @else
                                            Never
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Stats Section -->
                    <div class="space-y-4">
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <h5 class="font-semibold mb-3">Loyalty Statistics</h5>
                            <div class="space-y-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Current Points:</span>
                                    <span class="text-2xl font-bold text-blue-900">{{ number_format($member->loyalty_points) }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Total Spent:</span>
                                    <span class="text-xl font-bold text-green-900">₱{{ number_format($member->total_spent, 2) }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Points Earned:</span>
                                    <span class="font-medium">{{ number_format($member->loyalty_points * 0.8) }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Points Redeemed:</span>
                                    <span class="font-medium">{{ number_format($member->loyalty_points * 0.2) }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Actions -->
                      
                    </div>
                </div>
            </div>
            <form method="dialog" class="modal-backdrop">
                <button>close</button>
            </form>
        </dialog>

        <!-- Add Points Modal -->
      
    @endforeach

    <!-- Edit Member Modal -->
   

    <!-- Add Member Modal -->
   
    <script>
    // Store member data
    let membersData = {};

    // View Member Details
    async function viewMemberDetails(memberId, memberData = null) {
        if (memberData) {
            membersData[memberId] = memberData;
            displayMemberDetails(memberData);
        } else {
            try {
                const response = await fetch(`/admin/loyalty/members/${memberId}`);
                const memberData = await response.json();
                displayMemberDetails(memberData);
            } catch (error) {
                console.error('Error fetching member details:', error);
                alert('Error loading member details');
            }
        }
        
        document.getElementById('viewMemberModal').showModal();
    }

    function displayMemberDetails(member) {
        const tier = @json($tiersData ?? [])[member.membership_tier] || null;
        const content = document.getElementById('memberDetailsContent');
        
        content.innerHTML = `
            <div class="space-y-6">
                <!-- Header -->
                <div class="flex items-center justify-between p-4 bg-gradient-to-r from-blue-50 to-purple-50 rounded-xl">
                    <div class="flex items-center gap-4">
                        ${member.guest_photo ? 
                            `<img src="${member.guest_photo}" alt="${member.guest_name}" class="w-16 h-16 rounded-full object-cover border-4 border-white shadow-lg">` : 
                            `<div class="w-16 h-16 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center border-4 border-white shadow-lg">
                                <span class="text-white font-bold text-lg">${member.guest_name.substring(0, 2).toUpperCase()}</span>
                            </div>`
                        }
                        <div>
                            <h4 class="text-xl font-bold text-gray-900">${member.guest_name}</h4>
                            <p class="text-gray-600">${member.guest_email}</p>
                            ${member.guest_phone ? `<p class="text-gray-500 text-sm"><i class="fas fa-phone mr-1"></i>${member.guest_phone}</p>` : ''}
                        </div>
                    </div>
                    
                    ${tier ? 
                        `<div class="text-center">
                            <div class="px-4 py-2 rounded-lg" style="background-color: ${tier.badge_color}20; border: 2px solid ${tier.badge_color};">
                                <i class="fas fa-crown mr-1" style="color: ${tier.badge_color};"></i>
                                <span class="font-bold" style="color: ${tier.badge_color};">${member.membership_tier}</span>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Membership Tier</p>
                        </div>` : 
                        `<div class="text-center">
                            <div class="px-4 py-2 rounded-lg bg-gray-100 border-2 border-gray-300">
                                <span class="font-bold text-gray-600">${member.membership_tier || 'None'}</span>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Membership Tier</p>
                        </div>`
                    }
                </div>

                <!-- Stats Grid -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="bg-white p-4 rounded-xl border shadow-sm">
                        <div class="text-sm text-gray-500">Points Balance</div>
                        <div class="text-2xl font-bold text-gray-900 mt-1">${parseInt(member.loyalty_points).toLocaleString()}</div>
                        <div class="text-xs text-gray-400">Loyalty Points</div>
                    </div>
                    <div class="bg-white p-4 rounded-xl border shadow-sm">
                        <div class="text-sm text-gray-500">Total Spent</div>
                        <div class="text-2xl font-bold text-gray-900 mt-1">₱${parseFloat(member.total_spent).toLocaleString(undefined, {minimumFractionDigits: 2})}</div>
                        <div class="text-xs text-gray-400">Lifetime Value</div>
                    </div>
                    <div class="bg-white p-4 rounded-xl border shadow-sm">
                        <div class="text-sm text-gray-500">Member Since</div>
                        <div class="text-lg font-bold text-gray-900 mt-1">${member.membership_since ? new Date(member.membership_since).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' }) : 'N/A'}</div>
                        <div class="text-xs text-gray-400">${member.membership_since ? `${Math.floor((new Date() - new Date(member.membership_since)) / (1000 * 60 * 60 * 24 * 365))} years` : ''}</div>
                    </div>
                    <div class="bg-white p-4 rounded-xl border shadow-sm">
                        <div class="text-sm text-gray-500">Last Activity</div>
                        <div class="text-lg font-bold text-gray-900 mt-1">${member.last_activity ? new Date(member.last_activity).toLocaleDateString('en-US', { month: 'short', day: 'numeric' }) : 'Never'}</div>
                        <div class="text-xs ${member.last_activity ? 'text-green-500' : 'text-gray-400'}">
                            ${member.last_activity ? `${Math.floor((new Date() - new Date(member.last_activity)) / (1000 * 60 * 60 * 24))} days ago` : 'No activity'}
                        </div>
                    </div>
                </div>

                <!-- Tier Benefits -->
                ${tier ? `
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-4 rounded-xl border">
                    <h5 class="font-semibold text-gray-800 mb-3"><i class="fas fa-gift mr-2"></i>Tier Benefits</h5>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                        <div class="text-center">
                            <div class="text-lg font-bold text-blue-600">${tier.food_discount}%</div>
                            <div class="text-xs text-gray-600">Food Discount</div>
                        </div>
                        <div class="text-center">
                            <div class="text-lg font-bold text-blue-600">${tier.room_discount}%</div>
                            <div class="text-xs text-gray-600">Room Discount</div>
                        </div>
                        <div class="text-center">
                            <div class="text-lg font-bold text-blue-600">${tier.points_multiplier}x</div>
                            <div class="text-xs text-gray-600">Points Multiplier</div>
                        </div>
                        <div class="text-center">
                            <div class="text-lg font-bold text-blue-600">+${tier.bonus_points}</div>
                            <div class="text-xs text-gray-600">Bonus Points</div>
                        </div>
                    </div>
                </div>` : ''}

                <!-- Additional Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-white p-4 rounded-xl border">
                        <h5 class="font-semibold text-gray-800 mb-3"><i class="fas fa-info-circle mr-2"></i>Account Information</h5>
                        <div class="space-y-2 text-sm">
                         
                            <div class="flex justify-between">
                                <span class="text-gray-600">Account Status:</span>
                                <span class="badge badge-success">Active</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Last Updated:</span>
                                <span class="text-gray-900">${member.updated_at ? new Date(member.updated_at).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' }) : 'N/A'}</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-4 rounded-xl border">
                        <h5 class="font-semibold text-gray-800 mb-3"><i class="fas fa-sticky-note mr-2"></i>Notes</h5>
                        <p class="text-sm text-gray-600">${member.admin_notes || 'No notes available.'}</p>
                    </div>
                </div>

           
              
            </div>
        `;
    }

    // Add Points Modal
    function addPointsModal(memberId, memberName) {
        const member = membersData[memberId];
        
        document.getElementById('member_id').value = memberId;
        document.getElementById('memberName').textContent = memberName;
        document.getElementById('memberInitials').textContent = memberName.substring(0, 2).toUpperCase();
        document.getElementById('currentPoints').textContent = member ? parseInt(member.loyalty_points).toLocaleString() : '0';
        
        // Reset form
        document.getElementById('points_amount').value = '';
        document.getElementById('description').value = '';
        
        document.getElementById('addPointsModal').showModal();
    }

    function setPoints(amount) {
        document.getElementById('points_amount').value = amount;
    }

    async function submitAddPoints(event) {
        event.preventDefault();
        
        const formData = new FormData(document.getElementById('addPointsForm'));
        const memberId = formData.get('member_id');
        
        try {
            const response = await fetch(`/admin/loyalty/members/${memberId}/add-points`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(Object.fromEntries(formData))
            });
            
            const result = await response.json();
            
            if (result.success) {
                alert('Points added successfully!');
                document.getElementById('addPointsModal').close();
                window.location.reload();
            } else {
                alert('Error: ' + (result.message || 'Failed to add points'));
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Error adding points');
        }
    }

    // Edit Member Modal
    function editMemberModal(memberId, memberData) {
        const member = membersData[memberId] || memberData;
        
        document.getElementById('edit_member_id').value = memberId;
        document.getElementById('edit_guest_name').value = member.guest_name;
        document.getElementById('edit_guest_email').value = member.guest_email;
        document.getElementById('edit_guest_phone').value = member.guest_phone || '';
        document.getElementById('edit_membership_tier').value = member.membership_tier;
        document.getElementById('edit_loyalty_points').value = member.loyalty_points;
        document.getElementById('edit_total_spent').value = member.total_spent;
        document.getElementById('edit_admin_notes').value = member.admin_notes || '';
        
        document.getElementById('editMemberModal').showModal();
    }

    async function submitEditMember(event) {
        event.preventDefault();
        
        const formData = new FormData(document.getElementById('editMemberForm'));
        const memberId = formData.get('id');
        
        try {
            const response = await fetch(`/admin/loyalty/members/${memberId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(Object.fromEntries(formData))
            });
            
            const result = await response.json();
            
            if (result.success) {
                alert('Member updated successfully!');
                document.getElementById('editMemberModal').close();
                window.location.reload();
            } else {
                alert('Error: ' + (result.message || 'Failed to update member'));
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Error updating member');
        }
    }

    // Add Member Modal
    function openAddMemberModal() {
        document.getElementById('addMemberModal').showModal();
    }

    async function submitAddMember(event) {
        event.preventDefault();
        
        const formData = new FormData(document.getElementById('addMemberForm'));
        
        try {
            const response = await fetch('/admin/loyalty/members', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(Object.fromEntries(formData))
            });
            
            const result = await response.json();
            
            if (result.success) {
                alert('Member added successfully!');
                document.getElementById('addMemberModal').close();
                window.location.reload();
            } else {
                alert('Error: ' + (result.message || 'Failed to add member'));
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Error adding member');
        }
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Loyalty Members page loaded with modals');
        
        // Add global click handler for modal backdrops
        document.addEventListener('click', function(event) {
            const modals = ['viewMemberModal', 'addPointsModal', 'editMemberModal', 'addMemberModal'];
            modals.forEach(modalId => {
                const modal = document.getElementById(modalId);
                if (event.target === modal) {
                    modal.close();
                }
            });
        });
    });
    </script>

    @livewireScripts
    @include('javascriptfix.soliera_js')
</body>
</html>