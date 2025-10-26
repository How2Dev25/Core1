<div class="bg-white rounded-2xl shadow-lg p-6">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h3 class="text-xl font-bold text-gray-900">Reservation Trends</h3>
            <p class="text-sm text-gray-500">Your booking activity over time</p>
        </div>
        <div class="flex gap-2">
            <button class="px-3 py-1.5 text-sm font-medium bg-blue-100 text-blue-700 rounded-lg">6M</button>
            <button class="px-3 py-1.5 text-sm font-medium text-gray-600 hover:bg-gray-100 rounded-lg">1Y</button>
        </div>
    </div>
    <div class="h-64">
        <canvas id="reservationChart"></canvas>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const monthlyData = @json(array_values($monthlyReservations));
    const monthlyLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

    const reservationCtx = document.getElementById('reservationChart').getContext('2d');
    new Chart(reservationCtx, {
        type: 'line',
        data: {
            labels: monthlyLabels.slice(0, monthlyData.length),
            datasets: [{
                label: 'Reservations',
                data: monthlyData,
                borderColor: '#1e3a8a',
                backgroundColor: 'rgba(30, 58, 138, 0.1)',
                tension: 0.4,
                fill: true,
                pointRadius: 5,
                pointHoverRadius: 7,
                pointBackgroundColor: '#fbbf24',
                pointBorderColor: '#1e3a8a',
                pointBorderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#1e3a8a',
                    padding: 12,
                    cornerRadius: 8,
                    titleColor: '#fbbf24',
                    bodyColor: '#fff'
                }
            },
            scales: {
                y: { beginAtZero: true, ticks: { color: '#6b7280' }, grid: { color: '#f3f4f6' } },
                x: { ticks: { color: '#6b7280' }, grid: { display: false } }
            }
        }
    });
</script>