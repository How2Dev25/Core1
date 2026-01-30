      <!-- Operational Metrics Section -->
                        <div class="mb-8">
                            <h2 class="text-xl font-semibold text-gray-800 mb-4">Operational Metrics</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                                <!-- Total Reservations -->
                                <div
                                    class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg hover:shadow-xl transition-shadow">
                                    <div class="flex items-center justify-between">
                                        <div class="flex-1">
                                            <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Total
                                                Reservations</h3>
                                            <p class="text-3xl font-bold text-gray-800 mt-2">
                                                <span class="counter" data-target="{{ $totalreservation }}">{{ number_format($totalreservation) }}</span>
                                            </p>
                                            <div class="flex items-center mt-3">
                                                <span class="text-green-500 text-sm font-medium flex items-center">
                                                    <i class="fa-solid fa-arrow-up mr-1"></i>
                                                    {{ number_format($reservationGrowthMonth, 1) }}%
                                                </span>
                                                <span class="text-sm text-gray-500 ml-2">vs last month</span>
                                            </div>
                                        </div>
                                        <div
                                            class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900 flex-shrink-0 ml-4">
                                            <i class="fa-solid fa-calendar-check text-yellow-400 text-2xl"></i>
                                        </div>
                                    </div>
                                </div>

                                <!-- Reservations This Week -->
                                <div
                                    class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg hover:shadow-xl transition-shadow">
                                    <div class="flex items-center justify-between">
                                        <div class="flex-1">
                                            <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">This Week
                                            </h3>
                                            <p class="text-3xl font-bold text-gray-800 mt-2">
                                                <span class="counter" data-target="{{ $reservationThisWeek }}">{{ number_format($reservationThisWeek) }}</span>
                                            </p>
                                            <div class="flex items-center mt-3">
                                                <span class="text-green-500 text-sm font-medium flex items-center">
                                                    <i class="fa-solid fa-arrow-up mr-1"></i>
                                                    {{ number_format($reservationGrowthWeek, 1) }}%
                                                </span>
                                                <span class="text-sm text-gray-500 ml-2">vs last week</span>
                                            </div>
                                        </div>
                                        <div
                                            class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900 flex-shrink-0 ml-4">
                                            <i class="fa-solid fa-chart-line text-yellow-400 text-2xl"></i>
                                        </div>
                                    </div>
                                </div>

                                <!-- Total Rooms -->
                                <div
                                    class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg hover:shadow-xl transition-shadow">
                                    <div class="flex items-center justify-between">
                                        <div class="flex-1">
                                            <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Total
                                                Rooms</h3>
                                            <p class="text-3xl font-bold text-gray-800 mt-2">
                                                <span class="counter" data-target="{{ $totalrooms }}">{{ number_format($totalrooms) }}</span>
                                            </p>
                                            <div class="flex items-center mt-3">
                                                <span
                                                    class="text-blue-500 text-sm font-medium">{{ number_format($occupancyRate, 1) }}%</span>
                                                <span class="text-sm text-gray-500 ml-2">occupancy</span>
                                            </div>
                                        </div>
                                        <div
                                            class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900 flex-shrink-0 ml-4">
                                            <i class="fa-solid fa-bed text-yellow-400 text-2xl"></i>
                                        </div>
                                    </div>
                                </div>

                                <!-- Rooms Needing Maintenance -->
                                <div
                                    class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg hover:shadow-xl transition-shadow">
                                    <div class="flex items-center justify-between">
                                        <div class="flex-1">
                                            <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Need
                                                Maintenance</h3>
                                            <p class="text-3xl font-bold text-gray-800 mt-2">
                                                <span class="counter" data-target="{{ $needmaintenance }}">{{ number_format($needmaintenance) }}</span>
                                            </p>
                                            <div class="flex items-center mt-3">
                                                <span
                                                    class="text-amber-500 text-sm font-medium">{{ number_format($maintenanceRate, 1) }}%</span>
                                                <span class="text-sm text-gray-500 ml-2">of total</span>
                                            </div>
                                        </div>
                                        <div
                                            class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900 flex-shrink-0 ml-4">
                                            <i class="fa-solid fa-screwdriver-wrench text-yellow-400 text-2xl"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>