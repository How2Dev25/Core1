         <!-- revenue Section graph (Last 30 Days) -->
                <div class="mt-10 bg-white rounded-xl border border-gray-100 p-6 shadow-lg">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-sm font-medium text-gray-600">Trend (Last 30 Days)</h3>
        <select id="trendSelector" class="border border-gray-300 rounded px-2 py-1 text-sm">
            <option value="revenue">Revenue</option>
            <option value="adr">Avg Daily Rate</option>
            <option value="revpar">RevPAR</option>
            <option value="occupancy">Occupancy Rate</option>
        </select>
    </div>
    <div class="chart-container bg-gray-50 rounded-lg p-2">
        <canvas id="trendChart"></canvas>
    </div>
                    </div>
            <!-- Graph Section -->
            <div class="mt-10">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Reservations Trend (7 days) -->
                    <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-sm font-medium text-gray-600">Reservations (Last 7 Days)</h3>
                            <i class="fa-solid fa-calendar-check text-blue-900"></i>
                        </div>
                        <div class="chart-container bg-gray-50 rounded-lg flex items-center justify-center">
                          <canvas id="reservationsChart"></canvas>
                        </div>
                    </div>

                    <!-- Rooms -->
                    <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-sm font-medium text-gray-600">Rooms Overview</h3>
                            <i class="fa-solid fa-bed text-blue-900"></i>
                        </div>
                        <div class="chart-container bg-gray-50 rounded-lg flex items-center justify-center">
                             <canvas id="roomsChart"></canvas>
                        </div>
                    </div>

                    <!-- Employees vs Guests -->
                    <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-sm font-medium text-gray-600">Employees vs Guests</h3>
                            <i class="fa-solid fa-users text-blue-900"></i>
                        </div>
                        <div class="chart-container bg-gray-50 rounded-lg flex items-center justify-center">
                            <canvas id="employeesGuestsChart"></canvas>
                        </div>
                    </div>

                    <!-- Marketing -->
                    <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-sm font-medium text-gray-600">Marketing & Channels</h3>
                            <i class="fa-solid fa-bullhorn text-blue-900"></i>
                        </div>
                        <div class="chart-container bg-gray-50 rounded-lg flex items-center justify-center">
                              <canvas id="marketingChart"></canvas>
                        </div>
                    </div>

                    <!-- Loyalty -->
                    <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-sm font-medium text-gray-600">Loyalty & Rewards</h3>
                            <i class="fa-solid fa-star text-blue-900"></i>
                        </div>
                        <div class="chart-container bg-gray-50 rounded-lg flex items-center justify-center">
                              <canvas id="loyaltyChart"></canvas>
                        </div>
                    </div>

                    <!-- Events -->
                    <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-sm font-medium text-gray-600">Events (Monthly)</h3>
                            <i class="fa-solid fa-calendar-days text-blue-900"></i>
                        </div>
                        <div class="chart-container bg-gray-50 rounded-lg flex items-center justify-center">
                             <canvas id="eventsChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
