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
    <title>Loyalty Transactions - History</title>
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
                            <div class="bg-gradient-to-r from-green-900 to-green-700 rounded-2xl p-8 text-white mb-8">
                                <h1 class="text-3xl font-bold mb-2">Transaction History</h1>
                                <p class="text-green-100">Track your points earned, redeemed, and bonus rewards</p>
                            </div>

                            <!-- Back to Dashboard -->
                            <div class="mb-6">
                                <a href="{{ route('loyalty.dashboard') }}" class="inline-flex items-center text-green-600 hover:text-green-800">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                    </svg>
                                    Back to Loyalty Dashboard
                                </a>
                            </div>

                            <!-- Transactions Table -->
                            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                                <div class="p-6 border-b">
                                    <h2 class="text-xl font-semibold text-gray-900">All Transactions</h2>
                                    <p class="text-gray-600 text-sm mt-1">Complete history of your loyalty points activity</p>
                                </div>

                                @if($transactions->count() > 0)
                                    <div class="overflow-x-auto">
                                        <table class="w-full">
                                            <thead>
                                                <tr class="bg-gray-50 border-b">
                                                    <th class="text-left py-3 px-6 text-sm font-medium text-gray-900">Date</th>
                                                    <th class="text-left py-3 px-6 text-sm font-medium text-gray-900">Description</th>
                                                    <th class="text-left py-3 px-6 text-sm font-medium text-gray-900">Type</th>
                                                    <th class="text-right py-3 px-6 text-sm font-medium text-gray-900">Points</th>
                                                    <th class="text-right py-3 px-6 text-sm font-medium text-gray-900">Balance</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($transactions as $transaction)
                                                    <tr class="border-b hover:bg-gray-50">
                                                        <td class="py-4 px-6">
                                                            <div class="text-sm text-gray-900">
                                                                {{ $transaction->transaction_date->format('M d, Y') }}
                                                            </div>
                                                            <div class="text-xs text-gray-500">
                                                                {{ $transaction->transaction_date->format('h:i A') }}
                                                            </div>
                                                        </td>
                                                        <td class="py-4 px-6">
                                                            <div class="text-sm text-gray-900">{{ $transaction->description }}</div>
                                                            @if($transaction->reference_type)
                                                                <div class="text-xs text-gray-500">
                                                                    {{ class_basename($transaction->reference_type) }} #{{ $transaction->reference_id }}
                                                                </div>
                                                            @endif
                                                        </td>
                                                        <td class="py-4 px-6">
                                                            @switch($transaction->transaction_type)
                                                                @case('earned')
                                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                                                        </svg>
                                                                        Earned
                                                                    </span>
                                                                    @break
                                                                @case('redeemed')
                                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                                                        </svg>
                                                                        Redeemed
                                                                    </span>
                                                                    @break
                                                                @case('bonus')
                                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                                        </svg>
                                                                        Bonus
                                                                    </span>
                                                                    @break
                                                                @default
                                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                                        {{ $transaction->transaction_type }}
                                                                    </span>
                                                            @endswitch
                                                        </td>
                                                        <td class="py-4 px-6 text-right">
                                                            <span class="text-sm font-semibold {{ $transaction->points_change > 0 ? 'text-green-600' : 'text-red-600' }}">
                                                                {{ $transaction->points_change > 0 ? '+' : '' }}{{ number_format($transaction->points_change) }}
                                                            </span>
                                                        </td>
                                                        <td class="py-4 px-6 text-right">
                                                            <span class="text-sm font-medium text-gray-900">
                                                                {{ number_format($transaction->points_balance_after) }}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- Pagination -->
                                    <div class="p-6 border-t">
                                        {{ $transactions->links() }}
                                    </div>
                                @else
                                    <div class="text-center py-12">
                                        <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                        <h3 class="text-lg font-medium text-gray-900 mb-2">No transactions yet</h3>
                                        <p class="text-gray-500 mb-6">Start earning points by making purchases and bookings!</p>
                                        <a href="{{ route('loyalty.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                            </svg>
                                            Start Earning Points
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </main>
                </div>
            </div>
            @livewireScripts
            @include('javascriptfix.soliera_js')
        </section>
    @endauth

    <meta name="csrf-token" content="{{ csrf_token() }}">
</body>

</html>
