<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    @vite('resources/css/app.css')
    <script src="{{ asset('javascript/chart.js') }}"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <title>Loyalty Rewards - Redeem Points</title>
    @livewireStyles
</head>

<body>
    @auth('guest')
        <section class="bg-base-100">
            <div class="flex h-screen overflow-hidden">
                <!-- Sidebar -->
                @include('guest.components.dashboard.sidebar')

                <!-- Main content -->
                <div class="flex flex-col flex-1 overflow-hidden">
                    <!-- Navbar -->
                    @include('guest.components.dashboard.navbar')

                    <!-- Dashboard Content -->
                    <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 ">
                        <div class="container mx-auto px-4 py-8">
                            <!-- Header -->
                            <div class="bg-gradient-to-r from-purple-900 to-purple-700 rounded-2xl p-8 text-white mb-8">
                                <h1 class="text-3xl font-bold mb-2">Redeem Your Points</h1>
                                <p class="text-purple-100">Turn your loyalty points into exclusive rewards and experiences</p>
                            </div>

                            <!-- Points Balance Card -->
                            <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900">Available Points</h3>
                                        <p class="text-sm text-gray-600">Use your points to redeem rewards below</p>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-3xl font-bold text-purple-600">{{ number_format((int) $loyaltySummary['current_tier']['points']) }}</div>
                                        <div class="text-sm text-gray-600">Points Balance</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Rewards Grid -->
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach($availableRewards as $reward)
                                    <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                                        @if($reward['category'] == 'dining')
                                            <div class="bg-orange-100 p-4">
                                                <svg class="w-12 h-12 text-orange-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                                </svg>
                                            </div>
                                        @elseif($reward['category'] == 'accommodation')
                                            <div class="bg-blue-100 p-4">
                                                <svg class="w-12 h-12 text-blue-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                                </svg>
                                            </div>
                                        @elseif($reward['category'] == 'wellness')
                                            <div class="bg-green-100 p-4">
                                                <svg class="w-12 h-12 text-green-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                                </svg>
                                            </div>
                                        @endif

                                        <div class="p-6">
                                            <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $reward['name'] }}</h3>
                                            <p class="text-gray-600 text-sm mb-4">{{ $reward['description'] }}</p>
                                            
                                            <div class="flex items-center justify-between mb-4">
                                                <div class="flex items-center">
                                                    <svg class="w-5 h-5 text-yellow-500 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                    </svg>
                                                    <span class="text-2xl font-bold text-purple-600">{{ number_format($reward['points_required']) }}</span>
                                                    <span class="text-sm text-gray-600 ml-1">points</span>
                                                </div>
                                                <span class="text-xs bg-purple-100 text-purple-800 px-2 py-1 rounded-full">
                                                    {{ ucfirst($reward['category']) }}
                                                </span>
                                            </div>

                                            <button 
                                                onclick="redeemReward('{{ $reward['id'] }}', {{ $reward['points_required'] }}, '{{ $reward['name'] }}')"
                                                class="w-full bg-purple-600 text-white py-2 px-4 rounded-lg hover:bg-purple-700 transition-colors disabled:bg-gray-300 disabled:cursor-not-allowed"
                                                {{ $loyaltySummary['current_tier']['points'] < $reward['points_required'] ? 'disabled' : '' }}>
                                                {{ $loyaltySummary['current_tier']['points'] < $reward['points_required'] ? 'Insufficient Points' : 'Redeem Now' }}
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Back to Dashboard -->
                            <div class="mt-8 text-center">
                                <a href="{{ route('loyalty.dashboard') }}" class="inline-flex items-center text-purple-600 hover:text-purple-800">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                    </svg>
                                    Back to Loyalty Dashboard
                                </a>
                            </div>
                        </div>

                        <!-- Success Modal -->
                        <div id="successModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                            <div class="bg-white rounded-xl max-w-md w-full mx-4 p-6">
                                <div class="text-center">
                                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-900 mb-2">Reward Redeemed!</h3>
                                    <p class="text-gray-600 mb-4" id="successMessage">You have successfully redeemed this reward.</p>
                                    <button onclick="closeSuccessModal()" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition-colors">
                                        Awesome!
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Error Modal -->
                        <div id="errorModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                            <div class="bg-white rounded-xl max-w-md w-full mx-4 p-6">
                                <div class="text-center">
                                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-900 mb-2">Redemption Failed</h3>
                                    <p class="text-gray-600 mb-4" id="errorMessage">Something went wrong. Please try again.</p>
                                    <button onclick="closeErrorModal()" class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition-colors">
                                        Close
                                    </button>
                                </div>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
            @livewireScripts
            @include('javascriptfix.soliera_js')
        </section>
    @endauth

    <script>
        function redeemReward(rewardId, pointsRequired, rewardName) {
            if (confirm(`Are you sure you want to redeem "${rewardName}" for ${pointsRequired} points?`)) {
                fetch('/loyalty/redeem', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        reward_id: rewardId,
                        points: pointsRequired
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('successMessage').textContent = 
                            `You have successfully redeemed "${rewardName}" for ${pointsRequired} points!`;
                        document.getElementById('successModal').classList.remove('hidden');
                        
                        // Refresh page after 2 seconds to show updated points
                        setTimeout(() => {
                            window.location.reload();
                        }, 2000);
                    } else {
                        document.getElementById('errorMessage').textContent = data.message || 'Redemption failed';
                        document.getElementById('errorModal').classList.remove('hidden');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('errorMessage').textContent = 'An error occurred. Please try again.';
                    document.getElementById('errorModal').classList.remove('hidden');
                });
            }
        }

        function closeSuccessModal() {
            document.getElementById('successModal').classList.add('hidden');
        }

        function closeErrorModal() {
            document.getElementById('errorModal').classList.add('hidden');
        }
    </script>
</body>

</html>
