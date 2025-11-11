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

    <title>{{$title}} - Select Events</title>
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
                        <h1 class="text-2xl font-bold bg-white bg-clip-text text-[#191970]">Soliera Hotel Events And
                            Conference
                        </h1>
                    </div>
                    {{-- Subsystem Name --}}


                    <section class="container mx-auto px-4 py-8 ">

                        <div class="p-6 md:p-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @forelse($eventtypes as $eventtype)
                                <div
                                    class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:border-indigo-300 group">
                                    <!-- Image Container with Professional Overlay -->
                                    <div class="relative h-56 overflow-hidden">
                                        <img src="{{ asset($eventtype->eventtype_photo) }}"
                                            alt="{{ $eventtype->eventtype_name }}"
                                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105 brightness-95">

                                        <!-- Sophisticated Gradient Overlay -->
                                        <div
                                            class="absolute inset-0 bg-gradient-to-b from-indigo-900/40 via-transparent to-gray-900/60">
                                        </div>

                                        <!-- Price Tag - Modern & Elegant -->
                                        <div
                                            class="absolute top-4 right-4 backdrop-blur-md bg-white/95 px-4 py-2 rounded-full shadow-xl border border-indigo-100 transform group-hover:scale-105 transition-all duration-300">
                                            <div class="flex items-baseline gap-1">
                                                <span class="text-xs text-gray-500 font-medium">From</span>
                                                <span
                                                    class="text-lg font-bold text-indigo-600">₱{{ number_format($eventtype->eventtype_price, 2) }}</span>
                                            </div>
                                        </div>

                                        <!-- Professional Badge -->
                                        <div
                                            class="absolute bottom-4 left-4 backdrop-blur-sm bg-white/90 px-3 py-1.5 rounded-lg shadow-lg border border-white/50">
                                            <div class="flex items-center gap-2">
                                                <svg class="w-4 h-4 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                                                    <path fill-rule="evenodd"
                                                        d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                <span class="text-xs font-semibold text-gray-700">Professional Package</span>
                                            </div>
                                        </div>

                                        <!-- Subtle Light Effect -->
                                        <div
                                            class="absolute inset-0 bg-gradient-to-tr from-transparent via-white/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-700">
                                        </div>
                                    </div>

                                    <!-- Card Content -->
                                    <div class="p-6">
                                        <!-- Title -->
                                        <h3
                                            class="text-xl font-bold text-gray-900 mb-3 line-clamp-1 group-hover:text-indigo-600 transition-colors duration-300">
                                            {{ $eventtype->eventtype_name }}
                                        </h3>

                                        <!-- Description -->
                                        <p class="text-gray-600 text-sm mb-5 line-clamp-3 leading-relaxed">
                                            {{ $eventtype->eventtype_description }}
                                        </p>

                                        <!-- Features Icons -->
                                        <div class="flex items-center gap-4 mb-5 text-xs text-gray-500">
                                            <div class="flex items-center gap-1.5">
                                                <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                                </svg>
                                                <span>Group Events</span>
                                            </div>
                                            <div class="flex items-center gap-1.5">
                                                <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <span>Full Service</span>
                                            </div>
                                        </div>




                                        <!-- Action Button -->
                                        <a href="/eventbookingguest/{{ $eventtype->eventtype_ID }}"
                                            class="flex items-center justify-center gap-2 w-full px-4 py-3.5 bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 text-white rounded-xl transition-all duration-300 font-semibold text-sm shadow-lg shadow-indigo-500/30 hover:shadow-xl hover:shadow-indigo-500/40 hover:-translate-y-0.5 group/btn">
                                            <svg class="w-5 h-5 transition-transform group-hover/btn:scale-110" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <span>Book Now!</span>
                                            <svg class="w-4 h-4 transition-transform group-hover/btn:translate-x-1" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            @empty
                                <div
                                    class="col-span-3 flex flex-col items-center justify-center text-center p-16 bg-gradient-to-br from-gray-50 to-indigo-50 border-2 border-dashed border-indigo-200 rounded-2xl">
                                    <div class="bg-white p-5 rounded-full shadow-lg mb-6">
                                        <svg class="w-16 h-16 text-indigo-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-2xl font-bold text-gray-800 mb-3">No Event Packages Available</h3>
                                    <p class="text-gray-600 text-base max-w-md">Sorry, no events and conferences are available
                                        at this
                                        moment. Please
                                        check back later for upcoming packages.</p>
                                </div>
                            @endforelse
                        </div>
                        @include('booking.eventterms')
                    </section>







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