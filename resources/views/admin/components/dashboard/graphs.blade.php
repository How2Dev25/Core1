         <!-- revenue Section graph (Last 30 Days) -->
<section class="">
     <h2 class="text-xl font-semibold text-gray-800">Analytics And Graphs</h2>
<div class="flex gap-5 mt-10 max-md:flex-col">
<div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg cursor-pointer"
     onclick="openModal('trendChart', 'Trend (Last 30 Days)', true)">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-sm font-medium text-gray-600">Trend (Last 30 Days)</h3>
        <select id="trendSelector" class="border border-gray-300 rounded px-2 py-1 text-sm" onclick="event.stopPropagation()">
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


 <div class="">
                
 <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <!-- Reservations Trend -->
   <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg cursor-pointer"
     onclick="openModal('reservationsChart', 'Reservations (Last 7 Days)')">
    <div class="flex items-center justify-between mb-2">
        <h3 class="text-sm font-medium text-gray-600">Reservations (Last 7 Days)</h3>
        <i class="fa-solid fa-calendar-check text-blue-900"></i>
    </div>
    <div class="chart-container bg-gray-50 rounded-lg flex items-center justify-center h-32">
        <canvas id="reservationsChart"></canvas>
    </div>
</div>


    <!-- Rooms -->
   <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg cursor-pointer"
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
   <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg cursor-pointer"
     onclick="openModal('employeesGuestsChart', 'Employees vs Guests')">
    <div class="flex items-center justify-between mb-2">
        <h3 class="text-sm font-medium text-gray-600">Employees vs Guests</h3>
        <i class="fa-solid fa-users text-blue-900"></i>
    </div>
    <div class="chart-container bg-gray-50 rounded-lg flex items-center justify-center h-32">
        <canvas id="employeesGuestsChart"></canvas>
    </div>
</div>

    <!-- Marketing -->
    <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg cursor-pointer"
     onclick="openModal('marketingChart', 'Marketing & Channels')">
    <div class="flex items-center justify-between mb-2">
        <h3 class="text-sm font-medium text-gray-600">Marketing & Channels</h3>
        <i class="fa-solid fa-bullhorn text-blue-900"></i>
    </div>
    <div class="chart-container bg-gray-50 rounded-lg flex items-center justify-center h-32">
        <canvas id="marketingChart"></canvas>
    </div>
</div>

    <!-- Loyalty -->
   <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg cursor-pointer"
     onclick="openModal('loyaltyChart', 'Loyalty & Rewards')">
    <div class="flex items-center justify-between mb-2">
        <h3 class="text-sm font-medium text-gray-600">Loyalty & Rewards</h3>
        <i class="fa-solid fa-star text-blue-900"></i>
    </div>
    <div class="chart-container bg-gray-50 rounded-lg flex items-center justify-center h-32">
        <canvas id="loyaltyChart"></canvas>
    </div>
</div>


    <!-- Events -->
   <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg cursor-pointer"
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

<!-- Modal -->
<div id="chartModal" 
     class="hidden fixed inset-0 backdrop-blur-xs bg-opacity-40  flex items-center justify-center z-50">
  <div id="modalContent" 
       class="bg-white rounded-2xl p-6 shadow-2xl w-[90%] md:w-[70%] lg:w-[60%] relative transform transition-all duration-300 scale-75 opacity-0">

      <!-- Close Button -->
      <button onclick="closeModal()" class="absolute top-3 right-3 text-gray-500 hover:text-gray-800">
          <i class="fa-solid fa-xmark text-xl"></i>
      </button>

      <!-- Title + Optional Select -->
      <div class="flex items-center justify-between mb-4">
          <h3 id="modalTitle" class="text-lg font-semibold text-gray-700"></h3>
          <select id="modalTrendSelector" class="hidden border border-gray-300 rounded px-2 py-1 text-sm">
              <option value="revenue">Revenue</option>
              <option value="adr">Avg Daily Rate</option>
              <option value="revpar">RevPAR</option>
              <option value="occupancy">Occupancy Rate</option>
          </select>
      </div>

      <!-- Expanded Chart -->
      <div class="flex items-center justify-center">
          <canvas id="expandedChart" class="w-full h-[400px]"></canvas>
      </div>
  </div>
</div>
<script>
  let activeChart = null;

  function openModal(chartId, title) {
      const modal = document.getElementById('chartModal');
      const modalContent = document.getElementById('modalContent');
      const modalTitle = document.getElementById('modalTitle');

      modalTitle.textContent = title;
      modal.classList.remove('hidden');

      setTimeout(() => {
          modalContent.classList.remove("scale-75", "opacity-0");
          modalContent.classList.add("scale-100", "opacity-100");
      }, 10);

      if (activeChart) activeChart.destroy();

      const chartCanvas = document.getElementById(chartId);
      const chartInstance = Chart.getChart(chartCanvas);

      if (chartInstance) {
          const ctx = document.getElementById('expandedChart').getContext('2d');
          activeChart = new Chart(ctx, {
              type: chartInstance.config.type,
              data: JSON.parse(JSON.stringify(chartInstance.config.data)),
              options: JSON.parse(JSON.stringify(chartInstance.config.options)),
          });
      }
  }

  function closeModal() {
      const modal = document.getElementById('chartModal');
      const modalContent = document.getElementById('modalContent');

      modalContent.classList.remove("scale-100", "opacity-100");
      modalContent.classList.add("scale-75", "opacity-0");

      setTimeout(() => {
          modal.classList.add('hidden');
          if (activeChart) { activeChart.destroy(); activeChart = null; }
      }, 300);
  }
</script>
            </div>
</div>
</section>