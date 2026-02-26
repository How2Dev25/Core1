<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


    <script src="https://unpkg.com/lucide@latest"></script>

    <title>{{$title}} - Billing And Payments</title>
    @livewireStyles
</head>
@auth


    <body class="bg-base-100">
        <div class="flex h-screen overflow-hidden">
            <!-- Sidebar -->
            @include('admin.components.dashboard.sidebar')






            <!-- Main content -->
            <div class="flex flex-col flex-1 overflow-hidden">
                <!-- Navbar -->
                @include('admin.components.dashboard.navbar')








                <!-- Dashboard Content -->
                <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 transition-slow ">
                    {{-- Subsystem Name --}}
                    <div class="pb-5 border-b border-base-300 animate-fadeIn">
                        <h1 class="text-2xl font-bold bg-white bg-clip-text text-[#191970]">Billing History</h1>
                    </div>
                    {{-- Subsystem Name --}}

                    <section class="flex-1 p-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                            <!-- Total Revenue -->
                            <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Total Revenue
                                        </h3>
                                        <p class="text-1xl max-md:text-3xl font-bold text-gray-800 mt-2">
                                            ₱{{ number_format($totalRevenue, 2) }}</p>
                                        <div class="flex items-center mt-3">
                                            <span class="text-sm font-medium text-gray-500">All Payments</span>
                                        </div>
                                    </div>
                                    <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
                                        <i class="fa-solid fa-money-bill-wave text-yellow-400 text-2xl"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Total Transactions -->
                            <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Total
                                            Transactions</h3>
                                        <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalTransaction }}</p>
                                        <div class="flex items-center mt-3">
                                            <span class="text-sm font-medium text-gray-500">All Bookings</span>
                                        </div>
                                    </div>
                                    <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
                                        <i class="fa-solid fa-receipt text-yellow-400 text-2xl"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Transactions With Account -->
                            <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">With Account
                                        </h3>
                                        <p class="text-3xl font-bold text-gray-800 mt-2">{{ $historyWithAccount }}</p>
                                        <div class="flex items-center mt-3">
                                            <span class="text-sm font-medium text-gray-500">Registered Guests</span>
                                        </div>
                                    </div>
                                    <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
                                        <i class="fa-solid fa-user-check text-yellow-400 text-2xl"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Transactions Without Account -->
                            <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Without
                                            Account</h3>
                                        <p class="text-3xl font-bold text-gray-800 mt-2">{{ $historyWithoutAccount }}</p>
                                        <div class="flex items-center mt-3">
                                            <span class="text-sm font-medium text-gray-500">Walk-in Guests</span>
                                        </div>
                                    </div>
                                    <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
                                        <i class="fa-solid fa-user-slash text-yellow-400 text-2xl"></i>
                                    </div>
                                </div>
                            </div>

                        </div>  

                    <div class="mt-5">
                        <button onclick="openBillingReportWithOTP()"
                            class="btn btn-primary ">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <span>Generate Report</span>
                        </button>
                    </div>

                        <!-- Transactions Table -->
                        <!-- Filter -->
                        <form method="GET" class="mb-4 flex gap-4 items-center mt-5">
                            <select name="filter" class="border px-2 py-1 rounded">
                                <option value="">All</option>
                                <option value="week" {{ request('filter') == 'week' ? 'selected' : '' }}>Past Week</option>
                                <option value="month" {{ request('filter') == 'month' ? 'selected' : '' }}>Past Month</option>
                            </select>
                            <button type="submit" class="bg-blue-900 text-white px-3 py-1 rounded">Filter</button>
                        </form>

                        <div class="overflow-x-auto mt-2 rounded-xl border border-gray-100 shadow-lg">
                            <div class="bg-blue-900 text-white px-6 py-4 rounded-t-xl">
                                <h2 class="text-lg font-semibold">Transaction History</h2>
                            </div>

                            <table class="table w-full">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th>Transaction ID</th>
                                        <th>Booking ID / Reference</th>
                                        <th>Guest</th>
                                        <th>Payment Date</th>
                                        <th>Amount Paid</th>
                                        <th>Payment Method</th>
                                        <th>Status</th>
                                        <th>Remarks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($billingHistory as $billing)
                                        <tr class="hover:bg-gray-50 transition">
                                            <td>{{ $billing->transactionID }}</td>
                                            <td>{{ $billing->transaction_reference }}</td>
                                            <td>{{ $billing->guestname ?? 'Guest ID: ' . $billing->guestID }}</td>
                                            <td>{{ \Carbon\Carbon::parse($billing->payment_date)->format('M d, Y h:i A') }}</td>
                                            <td>₱{{ number_format($billing->amount_paid, 2) }}</td>
                                            <td>{{ $billing->payment_method }}</td>
                                            <td>
                                                <span
                                                    class="px-2 py-1 rounded-full text-white text-xs {{ $billing->payment_status == 'Paid' ? 'bg-green-500' : 'bg-red-500' }}">
                                                    {{ $billing->payment_status }}
                                                </span>
                                            </td>
                                            <td>{{ $billing->remarks ?? '-' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center py-6 text-gray-500">
                                                <i class="fa-solid fa-folder-open text-2xl mb-2"></i><br>
                                                No transactions found.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="mt-4">
                            {{ $billingHistory->withQueryString()->links() }}
                        </div>

                    </section>



                    <!-- Graph Section -->




            </div>




            <!-- Initialize Lucide Icons -->
            <script>
                lucide.createIcons();
            </script>







            </main>
        </div>
        </div>


        {{-- modals --}}

        @include('admin.components.billing.generatereport')


        @livewireScripts
        @include('javascriptfix.soliera_js')
    </body>
@endauth



</html>