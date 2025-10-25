<div class="mb-8">
    <h2 class="text-xl font-semibold text-gray-800 mb-4">Additional Metrics</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Employees -->
        <div class="bg-white rounded-xl border border-gray-100 p-5 shadow-md hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Total
                        Employees</h3>
                    <p class="text-2xl font-bold text-gray-800 mt-2">
                        {{ number_format($totalemployees) }}
                    </p>
                </div>
                <div class="w-14 h-14 rounded-lg flex items-center justify-center bg-blue-900">
                    <i class="fa-solid fa-users text-yellow-400 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Guest Accounts -->
        <div class="bg-white rounded-xl border border-gray-100 p-5 shadow-md hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Guest
                        Accounts</h3>
                    <p class="text-2xl font-bold text-gray-800 mt-2">
                        {{ number_format($guestacccount) }}
                    </p>
                </div>
                <div class="w-14 h-14 rounded-lg flex items-center justify-center bg-blue-900">
                    <i class="fa-solid fa-user text-yellow-400 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Room Markets -->
        <div class="bg-white rounded-xl border border-gray-100 p-5 shadow-md hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Room
                        Markets</h3>
                    <p class="text-2xl font-bold text-gray-800 mt-2">
                        {{ number_format($roommarkets) }}
                    </p>
                </div>
                <div class="w-14 h-14 rounded-lg flex items-center justify-center bg-blue-900">
                    <i class="fa-solid fa-globe text-yellow-400 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Channel Listings -->
        <div class="bg-white rounded-xl border border-gray-100 p-5 shadow-md hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Channel
                        Listings</h3>
                    <p class="text-2xl font-bold text-gray-800 mt-2">
                        {{ number_format($channellisting) }}
                    </p>
                </div>
                <div class="w-14 h-14 rounded-lg flex items-center justify-center bg-blue-900">
                    <i class="fa-solid fa-tv text-yellow-400 text-xl"></i>
                </div>
            </div>
        </div>
    </div>
</div>