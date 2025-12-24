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
        'Your cart is on a diet. Let’s fix that! 🥗'
    ];
    $randomMessage = $emptyMessages[array_rand($emptyMessages)];
                                            @endphp

                                            @forelse ($mycart as $carts)
                                                @php
        $itemTotal = $carts->menu_price * $carts->order_quantity;
        $subtotal += $itemTotal;
                                                @endphp
                                                <div
                                                    class="relative flex flex-col sm:flex-row items-start gap-6 p-5 rounded-xl bg-gray-50 border border-gray-200">
                                                    <!-- Exit Button -->
                                                    <button type="button"
                                                        onclick="document.getElementById('deleteordermodal-{{$carts->orderID}}').showModal()"
                                                        class="absolute top-3 right-3 p-1 rounded-full bg-red-100 hover:bg-red-200 text-red-600 transition">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>

                                                    <!-- Menu Image -->
                                                    <div
                                                        class="w-20 h-20 rounded-lg overflow-hidden flex-shrink-0 border border-gray-200">
                                                        <img src="{{ asset($carts->menu_photo) }}" alt="{{ $carts->menu_name }}"
                                                            class="w-full h-full object-cover">
                                                    </div>

                                                    <!-- Menu Details -->
                                                    <div class="flex-grow">
                                                        <!-- Status and Booking ID Display -->
                                                        <div class="flex flex-wrap items-center gap-2 mb-3">
                                                            <!-- Order Status Badge -->
                                                            <span
                                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                                                                                                                                                                @if($carts->order_status == 'pending') bg-yellow-100 text-yellow-800
                                                                                                                                                                                @elseif($carts->order_status == 'Cooking') bg-blue-100 text-blue-800
                                                                                                                                                                                @elseif($carts->order_status == 'Ready') bg-green-100 text-green-800
                                                                                                                                                                                @elseif($carts->order_status == 'Delivered') bg-purple-100 text-purple-800
                                                                                                                                                                                @elseif($carts->order_status == 'Cancelled') bg-red-100 text-red-800
                                                                                                                                                                                @else bg-gray-100 text-gray-800 @endif">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1"
                                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    @if($carts->order_status == 'pending')
                                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                                            stroke-width="2"
                                                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                    @elseif($carts->order_status == 'preparing')
                                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                                            stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                                    @elseif($carts->order_status == 'ready')
                                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                                            stroke-width="2" d="M5 13l4 4L19 7" />
                                                                    @elseif($carts->order_status == 'delivered')
                                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                                            stroke-width="2"
                                                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                    @elseif($carts->order_status == 'cancelled')
                                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                                    @else
                                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                                            stroke-width="2"
                                                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                    @endif
                                                                </svg>
                                                                {{ ucfirst($carts->order_status ?? 'pending') }}
                                                            </span>

                                                            <!-- Booking ID Badge -->
                                                            <span
                                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-900 text-white">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1"
                                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                                                </svg>
                                                                Booking ID: {{ $carts->bookingID ?? 'N/A' }}
                                                            </span>
                                                        </div>

                                                        <h3 class="font-semibold text-lg text-gray-800">{{ $carts->menu_name }}
                                                        </h3>
                                                        <p class="text-sm text-gray-600 mt-1">
                                                            {{ $carts->menu_description ?? '' }}
                                                        </p>
                                                        <div
                                                            class="flex flex-col sm:flex-row sm:items-center sm:justify-between mt-3 gap-2">
                                                            <span class="text-sm font-medium text-gray-700">Qty:
                                                                {{ $carts->order_quantity }}</span>
                                                            <span
                                                                class="text-lg font-bold text-blue-800">₱{{ number_format($itemTotal, 2) }}</span>
                                                        </div>

                                                        <!-- Action Buttons for each item -->
                                                        <div class="flex flex-wrap gap-2 mt-4 pt-3 border-t border-gray-200">
                                                            @if($carts->order_status != 'Delivered' && $carts->order_status != 'Cancelled')
                                                                <button
                                                                    onclick="document.getElementById('deliverordermodal-{{$carts->orderID}}').showModal()"
                                                                    class="px-3 py-1.5 bg-blue-900 hover:bg-blue-800 text-white text-sm rounded-lg flex items-center gap-1 transition shadow-sm">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                                            stroke-width="2" d="M5 13l4 4L19 7" />
                                                                    </svg>
                                                                    Mark as Delivered
                                                                </button>
                                                            @endif



                                                        </div>
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

                                        <!-- Order Summary -->
                                        @if($subtotal > 0)
                                            <div class="space-y-4 mb-8">
                                                <div
                                                    class="flex items-center justify-between p-4 rounded-xl bg-gray-50 border border-gray-200">
                                                    <span class="flex items-center gap-2 text-base font-medium text-gray-700">
                                                        Subtotal
                                                    </span>
                                                    <span
                                                        class="font-bold text-blue-800 text-lg">₱{{ number_format($subtotal, 2) }}</span>
                                                </div>

                                                <div
                                                    class="flex items-center justify-between p-5 rounded-xl bg-blue-900 text-white">
                                                    <span class="flex items-center gap-2 text-lg font-bold">
                                                        Total Amount
                                                    </span>
                                                    <span
                                                        class="text-2xl text-yellow-300 font-bold">₱{{ number_format($subtotal, 2) }}</span>
                                                </div>
                                            </div>
                                        @endif

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