     <div class="mb-8">
                            <h2 class="text-xl font-semibold text-gray-800 mb-4">Revenue Metrics</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                                <!-- Current Revenue -->
                                <div
                                    class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg hover:shadow-xl transition-shadow">
                                    <div class="flex items-center justify-between">
                                        <div class="flex-1">
                                            <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Current
                                                Revenue</h3>
                                            <p class="text-2xl font-bold text-gray-800 mt-2">
                                                ₱<span class="counter" data-target="{{ number_format($revenueCurrent, 2, '.', '') }}">{{ number_format($revenueCurrent, 2) }}</span></p>
                                            <div class="flex items-center mt-3">
                                                @php
$revenueArrowClass = $revenueChange >= 0 ? 'fa-arrow-up text-green-500' : 'fa-arrow-down text-red-500';
                                                @endphp
                                                <span
                                                    class="text-sm font-medium flex items-center {{ $revenueChange >= 0 ? 'text-green-500' : 'text-red-500' }}">
                                                    <i class="fa-solid {{ $revenueArrowClass }} mr-1"></i>
                                                    {{ number_format(abs($revenueChange), 2) }}%
                                                </span>
                                                <span class="text-sm text-gray-500 ml-2">vs last month</span>
                                            </div>
                                        </div>
                                        <div
                                            class="w-12 h-12 rounded-xl flex items-center justify-center bg-blue-900 flex-shrink-0 ml-4">
                                            <i class="fa-solid fa-peso-sign text-yellow-400 text-2xl"></i>
                                        </div>
                                    </div>
                                </div>

                                <!-- Average Daily Rate -->
                                <div
                                    class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg hover:shadow-xl transition-shadow">
                                    <div class="flex items-center justify-between">
                                        <div class="flex-1">
                                            <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Avg Daily
                                                Rate</h3>
                                            <p class="text-2xl font-bold text-gray-800 mt-2">
                                                ₱<span class="counter" data-target="{{ number_format($avgDailyRateCurrent, 2, '.', '') }}">{{ number_format($avgDailyRateCurrent, 2) }}</span></p>
                                            <div class="flex items-center mt-3">
                                                @php
$adrArrowClass = $avgDailyRateChange >= 0 ? 'fa-arrow-up text-green-500' : 'fa-arrow-down text-red-500';
                                                @endphp
                                                <span
                                                    class="text-sm font-medium flex items-center {{ $avgDailyRateChange >= 0 ? 'text-green-500' : 'text-red-500' }}">
                                                    <i class="fa-solid {{ $adrArrowClass }} mr-1"></i>
                                                    {{ number_format(abs($avgDailyRateChange), 2) }}%
                                                </span>
                                                <span class="text-sm text-gray-500 ml-2">vs last month</span>
                                            </div>
                                        </div>
                                        <div
                                            class="w-12 h-12 rounded-xl flex items-center justify-center bg-blue-900 flex-shrink-0 ml-4">
                                            <i class="fa-solid fa-chart-line text-yellow-400 text-2xl"></i>
                                        </div>
                                    </div>
                                </div>

                                <!-- RevPAR -->
                                <div
                                    class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg hover:shadow-xl transition-shadow">
                                    <div class="flex items-center justify-between">
                                        <div class="flex-1">
                                            <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">RevPAR
                                            </h3>
                                            <p class="text-2xl font-bold text-gray-800 mt-2">
                                                ₱<span class="counter" data-target="{{ number_format($revPARCurrent, 2, '.', '') }}">{{ number_format($revPARCurrent, 2) }}</span></p>
                                            <div class="flex items-center mt-3">
                                                @php
$revPARArrowClass = $revPARChange >= 0 ? 'fa-arrow-up text-green-500' : 'fa-arrow-down text-red-500';
                                                @endphp
                                                <span
                                                    class="text-sm font-medium flex items-center {{ $revPARChange >= 0 ? 'text-green-500' : 'text-red-500' }}">
                                                    <i class="fa-solid {{ $revPARArrowClass }} mr-1"></i>
                                                    {{ number_format(abs($revPARChange), 2) }}%
                                                </span>
                                                <span class="text-sm text-gray-500 ml-2">vs last month</span>
                                            </div>
                                        </div>
                                        <div
                                            class="w-12 h-12 rounded-xl flex items-center justify-center bg-blue-900 flex-shrink-0 ml-4">
                                            <i class="fa-solid fa-house-chimney text-yellow-400 text-2xl"></i>
                                        </div>
                                    </div>
                                </div>

                                <!-- Occupancy Rate -->
                                <div
                                    class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg hover:shadow-xl transition-shadow">
                                    <div class="flex items-center justify-between">
                                        <div class="flex-1">
                                            <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Occupancy
                                                Rate</h3>
                                            <p class="text-2xl font-bold text-gray-800 mt-2">
                                                {{ number_format($occupancyCurrent, 1) }}%
                                            </p>
                                            <div class="flex items-center mt-3">
                                                @php
$occupancyArrowClass = $occupancyChange >= 0 ? 'fa-arrow-up text-green-500' : 'fa-arrow-down text-red-500';
                                                @endphp
                                                <span
                                                    class="text-sm font-medium flex items-center {{ $occupancyChange >= 0 ? 'text-green-500' : 'text-red-500' }}">
                                                    <i class="fa-solid {{ $occupancyArrowClass }} mr-1"></i>
                                                    {{ number_format(abs($occupancyChange), 2) }}%
                                                </span>
                                                <span class="text-sm text-gray-500 ml-2">vs last month</span>
                                            </div>
                                        </div>
                                        <div
                                            class="w-12 h-12 rounded-xl flex items-center justify-center bg-blue-900 flex-shrink-0 ml-4">
                                            <i class="fa-solid fa-bed text-yellow-400 text-2xl"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                  