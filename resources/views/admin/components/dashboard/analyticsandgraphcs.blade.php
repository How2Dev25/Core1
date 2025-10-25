<section class="mb-8">
    <h2 class="text-xl font-semibold text-gray-800 mb-6">Analytics And Graphs</h2>


    <div class="w-full md:flex-1 bg-white rounded-xl border border-gray-100 p-4 sm:p-6 shadow-lg cursor-pointer hover:shadow-xl transition-shadow"
        onclick="openModal('trendChart', 'Trend (Last 30 Days)', true)">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 gap-2">
            <h3 class="text-sm font-medium text-gray-600 text-center sm:text-left">Trend (Last 30 Days)</h3>

            <select id="trendSelector"
                class="border border-gray-300 rounded-lg px-2 py-1 text-sm focus:ring focus:ring-blue-200"
                onclick="event.stopPropagation()">
                <option value="revenue">Revenue</option>
                <option value="adr">Avg Daily Rate</option>
                <option value="revpar">RevPAR</option>
                <option value="occupancy">Occupancy Rate</option>
            </select>
        </div>

        <!-- Chart Container -->
        <div class="chart-container bg-gray-50 rounded-lg p-2 sm:p-4 w-full h-48 sm:h-64 md:h-72 lg:h-80 relative">
            <canvas id="trendChart" class="w-full h-full"></canvas>
        </div>
    </div>

    <!-- Smaller Charts Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
        <!-- Reservations Trend -->
        <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg cursor-pointer hover:shadow-xl transition-shadow"
            onclick="openModal('reservationsChart', 'Reservations (Last 7 Days)')">
            <div class="flex items-center justify-between mb-2">
                <h3 class="text-sm font-medium text-gray-600">Reservations (Last 7 Days)</h3>
                <i class="fa-solid fa-calendar-check text-blue-900"></i>
            </div>
            <div class="chart-container bg-gray-50 rounded-lg flex items-center justify-center h-32">
                <canvas id="reservationsChart"></canvas>
            </div>
        </div>

        <!-- Rooms Overview -->
        <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg cursor-pointer hover:shadow-xl transition-shadow"
            onclick="openModal('roomsChart', 'Rooms Overview')">
            <div class="flex items-center justify-between mb-2">
                <h3 class="text-sm font-medium text-gray-600">Rooms Overview</h3>
                <i class="fa-solid fa-bed text-blue-900"></i>
            </div>
            <div class="chart-container bg-gray-50 rounded-lg flex items-center justify-center h-32">
                <canvas id="roomsChart"></canvas>
            </div>
        </div>

        <!-- Employees vs Guests -->
        <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg cursor-pointer hover:shadow-xl transition-shadow"
            onclick="openModal('employeesGuestsChart', 'Employees vs Guests')">
            <div class="flex items-center justify-between mb-2">
                <h3 class="text-sm font-medium text-gray-600">Employees vs Guests</h3>
                <i class="fa-solid fa-users text-blue-900"></i>
            </div>
            <div class="chart-container bg-gray-50 rounded-lg flex items-center justify-center h-32">
                <canvas id="employeesGuestsChart"></canvas>
            </div>
        </div>

        <!-- Marketing & Channels -->
        <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg cursor-pointer hover:shadow-xl transition-shadow"
            onclick="openModal('marketingChart', 'Marketing & Channels')">
            <div class="flex items-center justify-between mb-2">
                <h3 class="text-sm font-medium text-gray-600">Marketing & Channels</h3>
                <i class="fa-solid fa-bullhorn text-blue-900"></i>
            </div>
            <div class="chart-container bg-gray-50 rounded-lg flex items-center justify-center h-32">
                <canvas id="marketingChart"></canvas>
            </div>
        </div>

        <!-- Loyalty & Rewards -->
        <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg cursor-pointer hover:shadow-xl transition-shadow"
            onclick="openModal('loyaltyChart', 'Loyalty & Rewards')">
            <div class="flex items-center justify-between mb-2">
                <h3 class="text-sm font-medium text-gray-600">Loyalty & Rewards</h3>
                <i class="fa-solid fa-star text-blue-900"></i>
            </div>
            <div class="chart-container bg-gray-50 rounded-lg flex items-center justify-center h-32">
                <canvas id="loyaltyChart"></canvas>
            </div>
        </div>

        <!-- Events (Monthly) -->
        <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg cursor-pointer hover:shadow-xl transition-shadow"
            onclick="openModal('eventsChart', 'Events (Monthly)')">
            <div class="flex items-center justify-between mb-2">
                <h3 class="text-sm font-medium text-gray-600">Events (Monthly)</h3>
                <i class="fa-solid fa-calendar-days text-blue-900"></i>
            </div>
            <div class="chart-container bg-gray-50 rounded-lg flex items-center justify-center h-32">
                <canvas id="eventsChart"></canvas>
            </div>
        </div>
    </div>
</section>