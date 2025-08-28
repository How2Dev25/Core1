  <div class="mb-8">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold text-gray-800">Revenue Metrics</h2>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6 mb-6">

        <!-- Current Revenue -->
        <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Current Revenue</h3>
                    <p class="text-3xl font-bold text-gray-800 mt-2">₱{{ number_format($revenueCurrent, 2) }}</p>
                    <div class="flex items-center mt-3">
                        @php
                            $revenueArrowClass = $revenueChange >= 0 ? 'fa-arrow-up text-green-500' : 'fa-arrow-down text-red-500';
                        @endphp
                        <span class="text-sm font-medium flex items-center {{ $revenueChange >= 0 ? 'text-green-500' : 'text-red-500' }}">
                            <i class="fa-solid {{ $revenueArrowClass }} mr-1"></i>
                            {{ number_format(abs($revenueChange), 2) }}%
                        </span>
                        <span class="text-sm text-gray-500 ml-2">vs last month</span>
                    </div>
                </div>
                <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
                    <i class="fa-solid fa-peso-sign text-yellow-400 text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Average Daily Rate -->
        <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Avg Daily Rate</h3>
                    <p class="text-3xl font-bold text-gray-800 mt-2">₱{{ number_format($avgDailyRateCurrent, 2) }}</p>
                    <div class="flex items-center mt-3">
                        @php
                            $adrArrowClass = $avgDailyRateChange >= 0 ? 'fa-arrow-up text-green-500' : 'fa-arrow-down text-red-500';
                        @endphp
                        <span class="text-sm font-medium flex items-center {{ $avgDailyRateChange >= 0 ? 'text-green-500' : 'text-red-500' }}">
                            <i class="fa-solid {{ $adrArrowClass }} mr-1"></i>
                            {{ number_format(abs($avgDailyRateChange), 2) }}%
                        </span>
                        <span class="text-sm text-gray-500 ml-2">vs last month</span>
                    </div>
                </div>
                <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
                    <i class="fa-solid fa-chart-line text-yellow-400 text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- RevPAR -->
        <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">RevPAR</h3>
                    <p class="text-3xl font-bold text-gray-800 mt-2">₱{{ number_format($revPARCurrent, 2) }}</p>
                    <div class="flex items-center mt-3">
                        @php
                            $revPARArrowClass = $revPARChange >= 0 ? 'fa-arrow-up text-green-500' : 'fa-arrow-down text-red-500';
                        @endphp
                        <span class="text-sm font-medium flex items-center {{ $revPARChange >= 0 ? 'text-green-500' : 'text-red-500' }}">
                            <i class="fa-solid {{ $revPARArrowClass }} mr-1"></i>
                            {{ number_format(abs($revPARChange), 2) }}%
                        </span>
                        <span class="text-sm text-gray-500 ml-2">vs last month</span>
                    </div>
                </div>
                <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
                    <i class="fa-solid fa-house-chimney text-yellow-400 text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Occupancy Rate -->
        <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Occupancy Rate</h3>
                    <p class="text-3xl font-bold text-gray-800 mt-2">{{ number_format($occupancyCurrent, 1) }}%</p>
                    <div class="flex items-center mt-3">
                        @php
                            $occupancyArrowClass = $occupancyChange >= 0 ? 'fa-arrow-up text-green-500' : 'fa-arrow-down text-red-500';
                        @endphp
                        <span class="text-sm font-medium flex items-center {{ $occupancyChange >= 0 ? 'text-green-500' : 'text-red-500' }}">
                            <i class="fa-solid {{ $occupancyArrowClass }} mr-1"></i>
                            {{ number_format(abs($occupancyChange), 2) }}%
                        </span>
                        <span class="text-sm text-gray-500 ml-2">vs last month</span>
                    </div>
                </div>
                <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
                    <i class="fa-solid fa-bed text-yellow-400 text-2xl"></i>
                </div>
            </div>
        </div>

    </div>
            </div>



            <!-- Main Stats Grid -->
            <div class="mb-8">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-800">Operational Metrics</h2>
                   
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    <!-- Total Reservations -->
                    <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Total Reservations</h3>
                                <p class="text-3xl font-bold text-gray-800 mt-2">   {{ number_format($totalreservation) }}</p>
                                <div class="flex items-center mt-3">
                                    <span class="text-green-500 text-sm font-medium flex items-center">
                                        <i class="fa-solid fa-arrow-up mr-1"></i>
                                       {{ number_format($reservationGrowthMonth, 1) }}%
                                    </span>
                                    <span class="text-sm text-gray-500 ml-2">vs last month</span>
                                </div>
                            </div>
                            <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
                                <i class="fa-solid fa-calendar-check text-yellow-400 text-2xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Reservations This Week -->
                    <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">This Week</h3>
                                <p class="text-3xl font-bold text-gray-800 mt-2"> {{ number_format($reservationThisWeek) }}</p>
                                <div class="flex items-center mt-3">
                                    <span class="text-green-500 text-sm font-medium flex items-center">
                                        <i class="fa-solid fa-arrow-up mr-1"></i>
                                        {{ number_format($reservationGrowthWeek, 1) }}%
                                    </span>
                                    <span class="text-sm text-gray-500 ml-2">vs last week</span>
                                </div>
                            </div>
                            <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
                                <i class="fa-solid fa-chart-line text-yellow-400 text-2xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Total Rooms -->
                    <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Total Rooms</h3>
                                <p class="text-3xl font-bold text-gray-800 mt-2">  {{ number_format($totalrooms) }}</p>
                                <div class="flex items-center mt-3">
                                    <span class="text-blue-500 text-sm font-medium">   {{ number_format($occupancyRate, 1) }}%</span>
                                    <span class="text-sm text-gray-500 ml-2">occupancy</span>
                                </div>
                            </div>
                            <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
                                <i class="fa-solid fa-bed text-yellow-400 text-2xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Rooms Needing Maintenance -->
                    <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Need Maintenance</h3>
                                <p class="text-3xl font-bold text-gray-800 mt-2">  {{ number_format($needmaintenance) }}</p>
                                <div class="flex items-center mt-3">
                                    <span class="text-amber-500 text-sm font-medium">{{ number_format($maintenanceRate, 1) }}%</span>
                                    <span class="text-sm text-gray-500 ml-2">of total</span>
                                </div>
                            </div>
                            <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
                                <i class="fa-solid fa-screwdriver-wrench text-yellow-400 text-2xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Secondary Stats Grid -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Additional Metrics</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    <!-- Total Employees -->
                    <div class="bg-white rounded-xl border border-gray-100 p-5 shadow-md card-hover stat-card">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Total Employees</h3>
                                <p class="text-2xl font-bold text-gray-800 mt-2">{{ number_format($totalemployees) }}</p>
                            </div>
                            <div class="w-14 h-14 rounded-lg flex items-center justify-center bg-blue-900">
                                <i class="fa-solid fa-users text-yellow-400 text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Guest Accounts -->
                    <div class="bg-white rounded-xl border border-gray-100 p-5 shadow-md card-hover stat-card">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Guest Accounts</h3>
                                <p class="text-2xl font-bold text-gray-800 mt-2">{{ number_format($guestacccount) }}</p>
                            </div>
                            <div class="w-14 h-14 rounded-lg flex items-center justify-center bg-blue-900">
                                <i class="fa-solid fa-user text-yellow-400 text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Room Markets -->
                    <div class="bg-white rounded-xl border border-gray-100 p-5 shadow-md card-hover stat-card">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Room Markets</h3>
                                <p class="text-2xl font-bold text-gray-800 mt-2">{{ number_format($roommarkets) }}</p>
                            </div>
                            <div class="w-14 h-14 rounded-lg flex items-center justify-center bg-blue-900">
                                <i class="fa-solid fa-globe text-yellow-400 text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Channel Listings -->
                    <div class="bg-white rounded-xl border border-gray-100 p-5 shadow-md card-hover stat-card">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Channel Listings</h3>
                                <p class="text-2xl font-bold text-gray-800 mt-2">{{ number_format($channellisting) }}</p>
                            </div>
                            <div class="w-14 h-14 rounded-lg flex items-center justify-center bg-blue-900">
                                <i class="fa-solid fa-tv text-yellow-400 text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Marketing & Loyalty Stats -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Marketing & Events</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Active Campaigns -->
                    <div class="bg-white rounded-xl border border-gray-100 p-5 shadow-md card-hover stat-card">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Active Campaigns</h3>
                                <p class="text-2xl font-bold text-gray-800 mt-2">{{ number_format($activecampaigns) }}</p>
                            </div>
                            <div class="w-14 h-14 rounded-lg flex items-center justify-center bg-blue-900">
                                <i class="fa-solid fa-bullhorn text-yellow-400 text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Loyalty Programs -->
                    <div class="bg-white rounded-xl border border-gray-100 p-5 shadow-md card-hover stat-card">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Loyalty & Rewards</h3>
                                <p class="text-2xl font-bold text-gray-800 mt-2">{{ number_format($loyaltyandrewards) }}</p>
                                <p class="text-xs text-gray-500 mt-1">Room & Food packages</p>
                            </div>
                            <div class="w-14 h-14 rounded-lg flex items-center justify-center bg-blue-900">
                                <i class="fa-solid fa-star text-yellow-400 text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Total Events -->
                    <div class="bg-white rounded-xl border border-gray-100 p-5 shadow-md card-hover stat-card">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Total Events</h3>
                                <p class="text-2xl font-bold text-gray-800 mt-2">{{ number_format($totalevents) }}</p>
                            </div>
                            <div class="w-14 h-14 rounded-lg flex items-center justify-center bg-blue-900">
                                <i class="fa-solid fa-calendar-days text-yellow-400 text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>