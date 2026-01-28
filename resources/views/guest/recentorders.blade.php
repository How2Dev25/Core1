<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite('resources/css/app.css')

    <script src="https://unpkg.com/lucide@latest"></script>

    <title>{{$title}} - Order From Soliera Restaurant</title>
    @livewireStyles
</head>
@auth('guest')

    <body class="bg-base-100">
        <div class="flex h-screen overflow-hidden">
            <!-- Sidebar -->
            @include('guest.components.dashboard.sidebar')

            <!-- Main content -->
            <div class="flex flex-col flex-1 overflow-hidden">
                <!-- Navbar -->
                @include('guest.components.dashboard.navbar')

                <!-- Dashboard Content -->
                <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 transition-slow ">
                    {{-- Subsystem Name --}}
                    <div class="pb-5 border-b border-base-300 animate-fadeIn">
                        <h1 class="text-2xl font-bold bg-white bg-clip-text text-[#191970]">Recent Orders
                        </h1>
                    </div>
                    {{-- Subsystem Name --}}
                    <section class="flex gap-6 p-6">
                        <!-- Left: Menu -->
                        <!-- Right: Sticky POS / Order Summary -->
                        <div class="w-full">
                            <div class="sticky top-6">
                                <div class="bg-white/95">
                                    <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-100">
                                        <!-- Header Section -->
                                        <div class="flex items-center gap-4 mb-8">
                                            <div class="p-3 bg-blue-900 rounded-2xl shadow-md">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="#F7B32B" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M3 2v6h6"></path>
                                                    <path d="M21 12A9 9 0 0 0 6 2.3"></path>
                                                    <path d="M21 22v-6h-6"></path>
                                                    <path d="M3 12a9 9 0 0 0 15 6.7"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <h2 class="text-xl font-bold text-gray-800">
                                                    Order Summary
                                                </h2>
                                            </div>
                                        </div>

                                        <!-- Order Items -->
                                        <div class="space-y-6 mb-8">
                                            @php
    $subtotal = 0; // initialize subtotal
    $emptyMessages = [
        'Your cart is lonely… 😢 Add some delicious food to make it happy!',
        'Nothing here yet! Time to feast 🍔🍕',
        'Oops! Your cart feels empty. Treat yourself 😋',
        'No items in your cart… maybe your stomach is waiting? 🍽️',
        'Your cart is on a diet. Let s fix that! 🥗'
    ];
    $randomMessage = $emptyMessages[array_rand($emptyMessages)];
    
    // Group orders by booking ID
    $groupedOrders = [];
    foreach ($mycart as $order) {
        $bookingID = $order->bookingID ?? 'no-booking';
        if (!isset($groupedOrders[$bookingID])) {
            $groupedOrders[$bookingID] = [];
        }
        $groupedOrders[$bookingID][] = $order;
    }
                                            @endphp

                                            @forelse ($groupedOrders as $bookingID => $orders)
                                                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300">
                                                    <!-- Booking Header -->
                                                    <div class="bg-blue-900 text-white p-5">
                                                        <div class="flex items-center justify-between">
                                                            <div class="flex items-center gap-4">
                                                                <div class="p-3 bg-blue-800 rounded-xl">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                                                    </svg>
                                                                </div>
                                                                <div>
                                                                    <h4 class="font-bold text-lg">Booking #{{ $bookingID }}</h4>
                                                                    <p class="text-blue-100 text-sm">{{ count($orders) }} item{{ count($orders) > 1 ? 's' : '' }} ordered</p>
                                                                </div>
                                                            </div>
                                                            <div class="text-right">
                                                                @php
                                                                    $bookingTotal = 0;
                                                                    foreach ($orders as $order) {
                                                                        $bookingTotal += $order->menu_price * $order->order_quantity;
                                                                    }
                                                                    $subtotal += $bookingTotal;
                                                                @endphp
                                                                <p class="text-sm text-blue-100">Booking Total</p>
                                                                <p class="text-2xl font-bold text-yellow-300">₱{{ number_format($bookingTotal, 2) }}</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Orders in this booking -->
                                                    <div class="p-5 space-y-3">
                                                        @foreach ($orders as $carts)
                                                            @php
                                        $itemTotal = $carts->menu_price * $carts->order_quantity;
                                                            @endphp
                                                            <div class="flex items-start gap-4 p-4 rounded-xl bg-gray-50 border border-gray-200 hover:border-blue-300 transition-all duration-200">
                                                                <!-- Menu Image -->
                                                                <div class="w-20 h-20 rounded-xl overflow-hidden flex-shrink-0 border-2 border-white shadow-md">
                                                                    <img src="{{ asset($carts->menu_photo) }}" alt="{{ $carts->menu_name }}" class="w-full h-full object-cover hover:scale-110 transition-transform duration-300">
                                                                </div>

                                                                <!-- Menu Details -->
                                                                <div class="flex-grow">
                                                                    <!-- Status and Payment Display -->
                                                                    <div class="flex flex-wrap items-center gap-2 mb-3">
                                                                        <!-- Order Status Badge -->
                                                                        @if($carts->order_status == 'pending')
                                                                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold shadow-sm bg-yellow-400 text-white">
                                                                                {{ ucfirst($carts->order_status ?? 'pending') }}
                                                                            </span>
                                                                        @elseif($carts->order_status == 'Cooking')
                                                                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold shadow-sm bg-blue-400 text-white">
                                                                                {{ ucfirst($carts->order_status) }}
                                                                            </span>
                                                                        @elseif($carts->order_status == 'Ready')
                                                                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold shadow-sm bg-green-400 text-white">
                                                                                {{ ucfirst($carts->order_status) }}
                                                                            </span>
                                                                        @elseif($carts->order_status == 'Delivered')
                                                                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold shadow-sm bg-purple-400 text-white">
                                                                                {{ ucfirst($carts->order_status) }}
                                                                            </span>
                                                                        @elseif($carts->order_status == 'Cancelled')
                                                                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold shadow-sm bg-red-400 text-white">
                                                                                {{ ucfirst($carts->order_status) }}
                                                                            </span>
                                                                        @else
                                                                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold shadow-sm bg-gray-400 text-white">
                                                                                {{ ucfirst($carts->order_status ?? 'pending') }}
                                                                            </span>
                                                                        @endif

                                                                        <!-- Payment Status Badge -->
                                                                        @if($carts->payment_resto_status == 'Paid')
                                                                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold shadow-sm bg-green-400 text-white">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                                </svg>
                                                                                Paid
                                                                            </span>
                                                                        @elseif($carts->payment_resto_status == 'Pending')
                                                                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold shadow-sm bg-orange-400 text-white">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                                </svg>
                                                                                Pending
                                                                            </span>
                                                                        @else
                                                                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold shadow-sm bg-gray-400 text-white">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                                </svg>
                                                                                Pending
                                                                            </span>
                                                                        @endif
                                                                    </div>

                                                                    <h5 class="font-bold text-lg text-gray-800 mb-1">{{ $carts->menu_name }}</h5>
                                                                    <p class="text-sm text-gray-600 mb-3">{{ $carts->menu_description ?? '' }}</p>
                                                                    
                                                                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                                                                        <div class="flex flex-col gap-2">
                                                                            <div class="flex items-center gap-2">
                                                                                <span class="text-sm font-semibold text-gray-700">Qty:</span>
                                                                                <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-lg text-sm font-bold">{{ $carts->order_quantity }}</span>
                                                                            </div>
                                                                            @if($carts->payment_resto_status == 'Paid')
                                                                                <div class="flex items-center gap-1 text-xs text-green-600 bg-green-50 px-2 py-1 rounded-lg">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                                    </svg>
                                                                                    Paid via {{ $carts->payment_method ?? 'Online' }}
                                                                                    @if($carts->payment_date)
                                                                                        on {{ date('M d, Y', strtotime($carts->payment_date)) }}
                                                                                    @endif
                                                                                </div>
                                                                            @else
                                                                                <div class="flex items-center gap-1 text-xs text-orange-600 bg-orange-50 px-2 py-1 rounded-lg">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                                    </svg>
                                                                                    Payment Pending
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                        <div class="text-right">
                                                                            <p class="text-2xl font-bold text-blue-600">₱{{ number_format($itemTotal, 2) }}</p>
                                                                        </div>
                                                                    </div>

                                                                    <!-- Action Buttons -->
                                                                    <div class="flex flex-wrap gap-2 mt-4 pt-3 border-t border-gray-200">
                                                                        @if($carts->order_status != 'Delivered' && $carts->order_status != 'Cancelled')
                                                                            <button onclick="document.getElementById('deliverordermodal-{{$carts->orderID}}').showModal()" class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white text-sm rounded-xl flex items-center gap-2 transition-all duration-200 shadow-md hover:shadow-lg transform hover:scale-105">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                                                </svg>
                                                                                Mark as Delivered
                                                                            </button>
                                                                        @endif
                                                                        @if($carts->order_status != 'Delivered')
                                                                            <button type="button" onclick="document.getElementById('deleteordermodal-{{$carts->orderID}}').showModal()" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white text-sm rounded-xl flex items-center gap-2 transition-all duration-200 shadow-md hover:shadow-lg transform hover:scale-105">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                                                </svg>
                                                                                Cancel
                                                                            </button>
                                                                        @endif
                                                                       
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>

                                        @empty
                                            <div
                                                class="flex flex-col items-center justify-center gap-3 p-10 border-2 border-dashed border-gray-300 rounded-xl text-gray-400">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-14 h-14" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h18v18H3V3z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v8M8 12h8" />
                                                </svg>
                                                <p class="text-center font-semibold text-gray-500 text-lg">
                                                    {{ $randomMessage ?? "🍽️ No orders cooking yet — your plate is still empty!" }}
                                                </p>
                                            </div>
                                        @endforelse
                                        </div>

                                        <p class="text-xs text-gray-500 text-center mt-4">
                                            Estimated preparation time: 25-30 minutes
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </section>



                    {{-- modals --}}

                    @include('guest.components.resto.confirm')



                    @foreach ($mycart as $carts)
                        @include('guest.components.resto.cancelorder')
                        @include('guest.components.resto.delivered')
                    @endforeach


                    <!-- Initialize Lucide Icons -->
                    <script>
                        lucide.createIcons();
                        
                        // Mark order as paid function
                        function markOrderAsPaid(orderID) {
                            if (confirm('Are you sure you want to mark this order as paid?')) {
                                fetch(`/mark-order-paid/${orderID}`, {
                                    method: 'PUT',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                    }
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        location.reload();
                                    } else {
                                        alert('Error: ' + data.message);
                                    }
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    alert('An error occurred while marking the order as paid.');
                                });
                            }
                        }
                    </script>







                </main>
            </div>
        </div>


        {{-- modals --}}




        @livewireScripts
        @include('javascriptfix.soliera_js')




@endauth
</body>




</html>