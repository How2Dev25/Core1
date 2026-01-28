<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
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
            <h1 class="text-2xl font-bold bg-white bg-clip-text text-[#191970]">Order From Soliera Restaurant</h1>
          </div>
          {{-- Subsystem Name --}}
          <section class="flex gap-6 p-6">
            <!-- Left: Menu -->
            <div class="flex-1 overflow-y-auto">
              <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-semibold text-gray-800">Our Menu</h2>
              </div>

              <div
                class="w-full max-w-3xl mx-auto mt-6 px-6 py-4 mb-5 bg-blue-50 border-l-4 border-blue-400 rounded-xl shadow-sm flex items-start gap-3">
                <!-- Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-500 flex-shrink-0 mt-1" fill="none"
                  viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M13 16h-1v-4h-1m1-4h.01M12 18.5a6.5 6.5 0 1 1 0-13 6.5 6.5 0 0 1 0 13z" />
                </svg>

                <!-- Message -->
                <p class="text-blue-800 font-medium text-sm sm:text-base">
                  Note: You must be <span class="font-bold">checked in our rooms</span> to be able to order via <span
                    class="underline">delivery to room</span>.
                </p>
              </div>

              @if(session('success'))
                <div role="alert"
                  class="alert mb-6 rounded-2xl shadow-lg bg-gradient-to-r from-green-500 to-emerald-500 text-white border-0 p-4 flex items-center gap-3">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  <span>{{session('success')}}</span>
                </div>
              @endif

              <!-- Menu Cards Grid -->
              <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6">
                @forelse ($menus as $menu)
                  <div
                    class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-xl transition">
                    <!-- Photo -->
                    <div class="h-48 w-full overflow-hidden">
                      <img src="{{ asset($menu->menu_photo) }}" alt="{{ $menu->menu_name }}"
                        class="h-full w-full object-cover">
                    </div>

                    <!-- Content -->
                    <div class="p-5 flex flex-col h-full">
                      <h3 class="text-lg font-bold text-gray-900 truncate">{{ $menu->menu_name }}</h3>
                      <p class="text-sm text-gray-600 mt-2 line-clamp-2">{{ $menu->menu_description }}</p>

                      <div class="mt-4 flex items-center justify-between">
                        <span class="text-xl font-semibold text-blue-900">₱{{ number_format($menu->menu_price, 2) }}</span>
                        <div>
                          <button onclick="document.getElementById('order_modal_{{$menu->menuID}}').showModal()"
                            type="button" class="btn-primary btn">
                            <i data-lucide="utensils-crossed" class="w-4 h-4"></i> Add To Order
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                @empty
                  <div class="col-span-full flex flex-col items-center justify-center py-12 text-center">
                    <div class="w-16 h-16 rounded-full bg-blue-50 flex items-center justify-center mb-4">
                      <i data-lucide="utensils" class="w-8 h-8 text-blue-600"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-700">No menu items available</h3>
                    <p class="text-sm text-gray-500 mt-1">Please check back later.</p>
                  </div>
                @endforelse
              </div>

              <div class="mt-8 flex justify-center">
                <div class="flex justify-center items-center mb-8 w-full">
                  <div
                    class="inline-flex items-center gap-3 bg-blue-900  px-6 py-4 w-full rounded-2xl border-2 border-yellow-400/20 backdrop-blur-sm fade-in">

                    {{-- Previous Page Link --}}
                    @if ($menus->onFirstPage())
                      <span
                        class="flex items-center gap-2 px-4 py-2 text-gray-400 text-sm rounded-xl bg-gray-600/30 cursor-not-allowed">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor"
                          stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                          <path d="M15 18l-6-6 6-6"></path>
                        </svg>
                        <span class="hidden sm:inline">Previous</span>
                        <span class="sm:hidden">Prev</span>
                      </span>
                    @else
                      <a href="{{ $menus->previousPageUrl() }}"
                        class="flex items-center gap-2 px-4 py-2 text-yellow-400 text-sm rounded-xl bg-yellow-400/10 hover:bg-yellow-400/20 border border-yellow-400/30 hover:border-yellow-400/50 group transition">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor"
                          stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                          class="group-hover:-translate-x-1 transition">
                          <path d="M15 18l-6-6 6-6"></path>
                        </svg>
                        <span class="hidden sm:inline font-medium">Previous</span>
                        <span class="sm:hidden font-medium">Prev</span>
                      </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($menus->links()->elements[0] ?? [] as $page => $url)
                      @if ($page == $menus->currentPage())
                        <span
                          class="flex items-center justify-center w-10 h-10 text-blue-900 text-sm rounded-xl bg-yellow-400 shadow-lg border-2 border-yellow-300 font-bold transform scale-110">
                          {{ $page }}
                        </span>
                      @else
                        <a href="{{ $url }}"
                          class="flex items-center justify-center w-10 h-10 text-yellow-400 text-sm rounded-xl bg-yellow-400/10 hover:bg-yellow-400/20 border border-yellow-400/30 hover:border-yellow-400/50 font-semibold transition hover:text-yellow-300">
                          {{ $page }}
                        </a>
                      @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($menus->hasMorePages())
                      <a href="{{ $menus->nextPageUrl() }}"
                        class="flex items-center gap-2 px-4 py-2 text-yellow-400 text-sm rounded-xl bg-yellow-400/10 hover:bg-yellow-400/20 border border-yellow-400/30 hover:border-yellow-400/50 group transition">
                        <span class="hidden sm:inline font-medium">Next</span>
                        <span class="sm:hidden font-medium">Next</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor"
                          stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                          class="group-hover:translate-x-1 transition">
                          <path d="M9 18l6-6-6-6"></path>
                        </svg>
                      </a>
                    @else
                      <span
                        class="flex items-center gap-2 px-4 py-2 text-gray-400 text-sm rounded-xl bg-gray-600/30 cursor-not-allowed">
                        <span class="hidden sm:inline">Next</span>
                        <span class="sm:hidden">Next</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor"
                          stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                          <path d="M9 18l6-6-6-6"></path>
                        </svg>
                      </span>
                    @endif

                  </div>
                </div>
              </div>
            </div>

            <!-- Right: Sticky POS / Order Summary -->
            <div class="w-1/3 max-md:hidden">
              <div class="sticky top-6">





                <!-- Order Summary Card -->
                <div class="bg-white/95">
                  <div class="bg-white/95 backdrop-blur-md rounded-3xl p-8 shadow-2xl border border-white/20">
                    <div class="flex items-center gap-4 mb-8">
                      <div class="p-3 bg-blue-900 rounded-2xl shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                          stroke="#F7B32B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
                    <div class="space-y-4 mb-8">
                      <!-- Item 1: Grilled Salmon -->

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
                          class="relative flex items-center gap-4 p-4 rounded-xl bg-gradient-to-r from-primary/5 to-secondary/5 border border-primary/10">
                          <!-- Exit Button --> <button type="button"
                            onclick="document.getElementById('deleteordermodal-{{$carts->cartID}}').showModal()"
                            class="absolute top-2 right-2 p-1 rounded-full bg-red-100 hover:bg-red-200 text-red-600 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                              stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                            </svg> </button>
                          <div class="w-16 h-16 rounded-xl overflow-hidden flex-shrink-0"> <img
                              src="{{asset($carts->menu_photo)}}" alt="Grilled Salmon" class="w-full h-full object-cover">
                          </div>
                          <div class="flex-grow">
                            <h3 class="font-semibold text-primary text-sm">{{$carts->menu_name}}</h3>
                            <div class="flex items-center justify-between mt-1"> <span class="text-xs text-gray-600">Qty:
                                {{$carts->order_quantity }}</span> <span class="font-bold text-primary">
                                ₱{{ $carts->menu_price * $carts->order_quantity }} </span> </div>
                          </div>
                        </div>

                      @empty
                        <div
                          class="flex flex-col items-center justify-center gap-2 p-8 border-2 border-dashed border-gray-300 rounded-xl text-gray-400">
                          <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h18v18H3V3z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v8M8 12h8" />
                          </svg>
                          <p class="text-center font-semibold text-gray-500">
                            {{ $randomMessage }}
                          </p>
                        </div>
                      @endforelse

                      <!-- Order Summary -->
                      @if($subtotal > 0)
                        <div class="space-y-3 mb-8">
                          <div
                            class="flex items-center justify-between p-3 rounded-xl bg-gradient-to-r from-primary/5 to-secondary/5 border border-primary/10">
                            <span class="flex items-center gap-2 text-sm font-medium">
                              Subtotal
                            </span>
                            <span class="font-bold text-primary">₱{{ number_format($subtotal, 2) }}</span>
                          </div>

                          <div class="flex items-center justify-between p-4 rounded-xl bg-blue-900 text-white">
                            <span class="flex items-center gap-2 text-lg font-bold">
                              Total Amount
                            </span>
                            <span class="text-2xl text-yellow-400 font-bold">₱{{ number_format($subtotal, 2) }}</span>
                          </div>
                        </div>
                      @endif
                      <!-- Action Buttons -->
                      <div class="flex flex-col sm:flex-row gap-4">

                        <button onclick="document.getElementById('confirmorder').showModal()" type="button"
                          class="flex btn btn-primary">
                          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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

          @foreach ($menus as $menu)
            @include('guest.components.resto.ordernow')
          @endforeach

          @foreach ($mycart as $carts)
            @include('guest.components.resto.deleteorder')
          @endforeach


          <!-- Initialize Lucide Icons -->
          <script>
            lucide.createIcons();
            
            // Store order data for the modal
            window.orderData = {
                items: [
                    @foreach($mycart as $item)
                    {
                        menuID: {{ $item->menuID }},
                        name: '{{ $item->menu_name }}',
                        quantity: {{ $item->order_quantity }},
                        price: {{ $item->menu_price }},
                        total: {{ $item->order_quantity * $item->menu_price }},
                        photo: '{{ asset($item->menu_photo) }}'
                    },
                    @endforeach
                ],
                subtotal: {{ $subtotal ?? 0 }},
                guestID: {{ Auth::guard('guest')->user()->guestID }},
                guestName: '{{ Auth::guard('guest')->user()->guestname }}',
                guestEmail: '{{ Auth::guard('guest')->user()->guestemailaddress }}',
                guestContact: '{{ Auth::guard('guest')->user()->guestcontact }}'
            };
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