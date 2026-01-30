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

        <!-- Revenue Chart -->
        <div class="h-64">
            <canvas id="revenueChart"></canvas>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('revenueChart').getContext('2d');
    
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($last30DaysLabels) !!},
            datasets: [{
                label: 'Revenue',
                data: {!! json_encode($revenueLast30Days) !!},
                borderColor: '#10b981',
                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                borderWidth: 2,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#10b981',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    borderColor: '#10b981',
                    borderWidth: 1,
                    padding: 12,
                    displayColors: false,
                    callbacks: {
                        label: function(context) {
                            return 'Revenue: ₱' + Number(context.parsed.y).toLocaleString();
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: '#6b7280',
                        font: {
                            size: 11
                        }
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        color: '#e5e7eb',
                        borderDash: [2, 2]
                    },
                    ticks: {
                        color: '#6b7280',
                        font: {
                            size: 11
                        },
                        callback: function(value) {
                            return '₱' + Number(value).toLocaleString();
                        }
                    }
                }
            },
            interaction: {
                intersect: false,
                mode: 'index'
            }
        }
    });
});
</script>