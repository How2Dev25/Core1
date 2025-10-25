<div class="mb-8">
    <h2 class="text-xl font-semibold text-gray-800 mb-4">Marketing & Events</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Active Campaigns -->
        <div class="bg-white rounded-xl border border-gray-100 p-5 shadow-md hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Active
                        Campaigns</h3>
                    <p class="text-2xl font-bold text-gray-800 mt-2">
                        {{ number_format($activecampaigns) }}
                    </p>
                </div>
                <div class="w-14 h-14 rounded-lg flex items-center justify-center bg-blue-900">
                    <i class="fa-solid fa-bullhorn text-yellow-400 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Loyalty Programs -->
        <div class="bg-white rounded-xl border border-gray-100 p-5 shadow-md hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Loyalty &
                        Rewards</h3>
                    <p class="text-2xl font-bold text-gray-800 mt-2">
                        {{ number_format($loyaltyandrewards) }}
                    </p>
                    <p class="text-xs text-gray-500 mt-1">Room & Food packages</p>
                </div>
                <div class="w-14 h-14 rounded-lg flex items-center justify-center bg-blue-900">
                    <i class="fa-solid fa-star text-yellow-400 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Events -->
        <div class="bg-white rounded-xl border border-gray-100 p-5 shadow-md hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Total
                        Events</h3>
                    <p class="text-2xl font-bold text-gray-800 mt-2">
                        {{ number_format($totalevents) }}
                    </p>
                </div>
                <div class="w-14 h-14 rounded-lg flex items-center justify-center bg-blue-900">
                    <i class="fa-solid fa-calendar-days text-yellow-400 text-xl"></i>
                </div>
            </div>
        </div>
    </div>
</div>