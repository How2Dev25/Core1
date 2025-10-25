<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <!-- Revenue Stat Chart (2 columns) -->
    <div class="lg:col-span-2 bg-white rounded-xl border border-gray-100 p-6 shadow-lg">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold text-gray-900">Revenue Stat</h2>
            <button
                class="flex items-center text-sm text-gray-600 border border-gray-300 rounded-lg px-3 py-1.5 hover:bg-gray-50">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                    </path>
                </svg>
                Monthly
            </button>
        </div>

        <div class="mb-6">
            <div class="text-3xl font-bold text-gray-900">₱{{ number_format($revenueCurrent, 2) }}
            </div>
            <div class="text-sm {{ $revenueChange >= 0 ? 'text-green-600' : 'text-red-600' }} flex items-center mt-1">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18">
                    </path>
                </svg>
                {{ number_format(abs($revenueChange), 2) }}% from last month
            </div>
        </div>

        <!-- Bar Chart Placeholder -->
        <div class="h-64 flex items-end justify-between space-x-2">
            <div class="flex-1 flex flex-col items-center">
                <div class="w-full bg-green-500 rounded-t-lg hover:bg-green-600 transition-colors cursor-pointer"
                    style="height: 55%"></div>
                <div class="text-xs text-gray-500 mt-2">Sat</div>
            </div>
            <div class="flex-1 flex flex-col items-center">
                <div class="w-full bg-green-500 rounded-t-lg hover:bg-green-600 transition-colors cursor-pointer"
                    style="height: 70%"></div>
                <div class="text-xs text-gray-500 mt-2">Sun</div>
            </div>
            <div class="flex-1 flex flex-col items-center">
                <div class="w-full bg-green-500 rounded-t-lg hover:bg-green-600 transition-colors cursor-pointer"
                    style="height: 65%"></div>
                <div class="text-xs text-gray-500 mt-2">Mon</div>
            </div>
            <div class="flex-1 flex flex-col items-center">
                <div class="w-full bg-green-500 rounded-t-lg hover:bg-green-600 transition-colors cursor-pointer"
                    style="height: 85%"></div>
                <div class="text-xs text-gray-500 mt-2">Tue</div>
            </div>
            <div class="flex-1 flex flex-col items-center">
                <div class="w-full bg-green-500 rounded-t-lg hover:bg-green-600 transition-colors cursor-pointer"
                    style="height: 75%"></div>
                <div class="text-xs text-gray-500 mt-2">Wed</div>
            </div>
            <div class="flex-1 flex flex-col items-center">
                <div class="w-full bg-green-500 rounded-t-lg hover:bg-green-600 transition-colors cursor-pointer"
                    style="height: 90%"></div>
                <div class="text-xs text-gray-500 mt-2">Thu</div>
            </div>
            <div class="flex-1 flex flex-col items-center">
                <div class="w-full bg-green-500 rounded-t-lg hover:bg-green-600 transition-colors cursor-pointer"
                    style="height: 80%"></div>
                <div class="text-xs text-gray-500 mt-2">Fri</div>
            </div>
        </div>
    </div>

    <!-- Bookings Panel (1 column) -->
    <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold text-gray-900">Bookings</h2>
            <button
                class="flex items-center text-sm text-gray-600 border border-gray-300 rounded-lg px-3 py-1.5 hover:bg-gray-50">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                    </path>
                </svg>
                Monthly
            </button>
        </div>

        <div class="mb-4">
            <div class="text-3xl font-bold text-gray-900">{{ number_format($totalreservation) }}
            </div>
            <div class="text-sm text-gray-500">Total Bookings</div>
        </div>

        <!-- Progress Bars -->
        <div class="space-y-4">
            <div>
                <div class="flex justify-between text-sm mb-2">
                    <span class="text-gray-600">Completed</span>
                    <span class="font-semibold text-gray-900">{{ number_format($totalreservation * 0.73) }}</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-green-500 h-2 rounded-full" style="width: 73%"></div>
                </div>
            </div>

            <div>
                <div class="flex justify-between text-sm mb-2">
                    <span class="text-gray-600">Cancelled</span>
                    <span class="font-semibold text-gray-900">{{ number_format($totalreservation * 0.27) }}</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-red-400 h-2 rounded-full" style="width: 27%"></div>
                </div>
            </div>
        </div>

    </div>
</div>