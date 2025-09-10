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
                        <h1 class="text-2xl font-bold bg-white bg-clip-text text-[#191970]">My Cart Orders
                        </h1>
                    </div>
                    {{-- Subsystem Name --}}
                    <section class="flex gap-6 p-6">
                        <!-- Left: Menu -->
                        <!-- Right: Sticky POS / Order Summary -->
                        <div class="w-full">
                            <div class="sticky top-6">

                                <div class="bg-white/95">
                                    <div
                                        class="bg-white/95 backdrop-blur-md rounded-3xl p-8 shadow-2xl border border-white/20">
                                        <div class="flex items-center gap-4 mb-8">
                                            <div class="p-3 bg-blue-900 rounded-2xl shadow-lg">
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
                                                <h2 class="text-xl font-bold text-black">
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
                                                    class="relative flex items-center gap-6 p-5 rounded-xl bg-gradient-to-r from-primary/5 to-secondary/5 border border-primary/10">
                                                    <!-- Exit Button -->
                                                    <button type="button"
                                                        onclick="document.getElementById('deleteordermodal-{{$carts->cartID}}').showModal()"
                                                        class="absolute top-2 right-2 p-2 rounded-full bg-red-100 hover:bg-red-200 text-red-600 transition">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>

                                                    <!-- Menu Image -->
                                                    <div
                                                        class="w-24 h-24 rounded-xl overflow-hidden flex-shrink-0 border border-gray-200">
                                                        <img src="{{ asset($carts->menu_photo) }}" alt="{{ $carts->menu_name }}"
                                                            class="w-full h-full object-cover">
                                                    </div>

                                                    <!-- Menu Details -->
                                                    <div class="flex-grow">
                                                        <h3 class="font-semibold text-lg text-primary">{{ $carts->menu_name }}
                                                        </h3>
                                                        <p class="text-sm text-gray-600 mt-1">
                                                            {{ $carts->menu_description ?? '' }}</p>
                                                        <div class="flex items-center justify-between mt-3">
                                                            <span class="text-sm font-medium text-gray-700">Qty:
                                                                {{ $carts->order_quantity }}</span>
                                                            <span
                                                                class="text-lg font-bold text-primary">₱{{ number_format($itemTotal, 2) }}</span>
                                                        </div>
                                                    </div>
                                                </div>

                                            @empty
                                                <div
                                                    class="flex flex-col items-center justify-center gap-3 p-10 border-2 border-dashed border-gray-300 rounded-xl text-gray-400">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-14 h-14" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M3 3h18v18H3V3z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M12 8v8M8 12h8" />
                                                    </svg>
                                                    <p class="text-center font-semibold text-gray-500 text-lg">
                                                        {{ $randomMessage }}
                                                    </p>
                                                </div>
                                            @endforelse
                                        </div>

                                        <!-- Order Summary -->
                                        @if($subtotal > 0)
                                            <div class="space-y-4 mb-8">
                                                <div
                                                    class="flex items-center justify-between p-4 rounded-xl bg-gradient-to-r from-primary/5 to-secondary/5 border border-primary/10">
                                                    <span class="flex items-center gap-2 text-base font-medium">
                                                        Subtotal
                                                    </span>
                                                    <span
                                                        class="font-bold text-primary text-lg">₱{{ number_format($subtotal, 2) }}</span>
                                                </div>

                                                <div
                                                    class="flex items-center justify-between p-5 rounded-xl bg-blue-900 text-white">
                                                    <span class="flex items-center gap-2 text-lg font-bold">
                                                        Total Amount
                                                    </span>
                                                    <span
                                                        class="text-2xl text-yellow-400 font-bold">₱{{ number_format($subtotal, 2) }}</span>
                                                </div>
                                            </div>
                                        @endif
                                        <!-- Action Buttons -->
                                        <div class="flex flex-col sm:flex-row gap-4">

                                            <button onclick="document.getElementById('confirmorder').showModal()"
                                                type="button" class="flex btn btn-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M20 6L9 17l-5-5"></path>
                                                </svg>
                                                Confirm Order
                                            </button>
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
                        @include('guest.components.resto.deleteorder')
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