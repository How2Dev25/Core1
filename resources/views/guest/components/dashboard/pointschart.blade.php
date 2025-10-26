<div class="bg-white rounded-2xl shadow-lg p-6">
    <div class="flex items-center gap-3 mb-4">
        <div class="p-2 bg-blue-900 rounded-xl">
            <i class="fas fa-chart-pie text-yellow-400 text-xl"></i>
        </div>
        <div>
            <h3 class="text-lg font-bold text-gray-900">Points Activity</h3>
            <p class="text-sm text-gray-500">Your rewards</p>
        </div>
    </div>
    <div class="h-48">
        <canvas id="pointsChart"></canvas>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const pointsCtx = document.getElementById('pointsChart').getContext('2d');
    new Chart(pointsCtx, {
        type: 'doughnut',
        data: {
            labels: ['Available', 'Redeemed', 'Expired'],
            datasets: [{
                data: [{{ Auth::guard('guest')->user()->loyalty_points ?? 0 }}, 150, 50],
                backgroundColor: ['#10b981', '#fbbf24', '#ef4444'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 15,
                        usePointStyle: true,
                        font: {
                            size: 11
                        }
                    }
                },
                tooltip: {
                    backgroundColor: '#1e3a8a',
                    padding: 12,
                    cornerRadius: 8,
                    titleColor: '#fbbf24',
                    bodyColor: '#fff'
                }
            }
        }
    });
</script>