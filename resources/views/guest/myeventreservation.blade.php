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

    <title>{{$title}} - My Reseravtion</title>
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
                        <h1 class="text-2xl font-bold bg-white bg-clip-text text-[#191970]">My Event And Conference
                            Reservations
                        </h1>
                    </div>
                    {{-- Subsystem Name --}}


                    <section class="container mx-auto px-4 py-12">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

                            <!-- Total Reservations -->
                            <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Total
                                            Reservations</h3>
                                        <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totaleventreservation }}</p>

                                    </div>
                                    <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
                                        <i class="fa-solid fa-bed text-yellow-400 text-2xl"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Confirmed -->
                            <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Confirmed</h3>
                                        <p class="text-3xl font-bold text-gray-800 mt-2">{{ $confirmedeventreservation }}</p>

                                    </div>
                                    <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
                                        <i class="fa-solid fa-circle-check text-yellow-400 text-2xl"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Pending -->
                            <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Pending</h3>
                                        <p class="text-3xl font-bold text-gray-800 mt-2">{{  $pendingeventreservation }}</p>

                                    </div>
                                    <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
                                        <i class="fa-solid fa-clock text-yellow-400 text-2xl"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Cancelled -->
                            <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Cancelled</h3>
                                        <p class="text-3xl font-bold text-gray-800 mt-2">{{  $cancelledeventreservation }}</p>

                                    </div>
                                    <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
                                        <i class="fa-solid fa-circle-xmark text-yellow-400 text-2xl"></i>
                                    </div>
                                </div>
                            </div>

                        </div>





                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @forelse ($reservations as $reservation)
                                            <div
                                                class="bg-white rounded-3xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-500 border border-gray-200 hover:border-indigo-400 group transform hover:-translate-y-1">

                                                <!-- Event Image with Overlay -->
                                                <div class="relative h-64 overflow-hidden">
                                                    <img src="{{ asset($reservation->eventtype_photo) }}"
                                                        alt="{{ $reservation->event_name }}"
                                                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">

                                                    <!-- Gradient Overlay -->
                                                    <div
                                                        class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent">
                                                    </div>

                                                    <!-- Status Badge - Top Left -->
                                                    <div class="absolute top-5 left-5">
                                                        <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-xs font-bold shadow-xl backdrop-blur-sm
                                                                                                                                                                                                    {{ $reservation->eventstatus == 'Approved' ? 'bg-emerald-500 text-white' :
            ($reservation->eventstatus == 'Pending' ? 'bg-amber-500 text-white' :
                'bg-rose-500 text-white') }}">
                                                            <span class="w-2 h-2 rounded-full bg-white animate-pulse"></span>
                                                            {{ $reservation->eventstatus }}
                                                        </span>
                                                    </div>

                                                    <!-- Price Tag - Top Right -->
                                                    <div
                                                        class="absolute top-5 right-5 backdrop-blur-xl bg-white/90 px-5 py-3 rounded-2xl shadow-2xl border border-white/50">
                                                        <div class="text-center">
                                                            <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total</p>
                                                            <p class="text-sm font-black text-indigo-600 mt-0.5">
                                                                ₱{{ number_format($reservation->event_total_price, 2) }}</p>
                                                        </div>
                                                    </div>

                                                    <!-- Event Name on Image -->
                                                    <div class="absolute bottom-0 left-0 right-0 p-6">
                                                        <h3
                                                            class="text-2xl font-black text-white drop-shadow-2xl group-hover:text-indigo-200 transition-colors duration-300">
                                                            {{ $reservation->event_name }}
                                                        </h3>
                                                        <p class="text-sm font-semibold text-white/90 mt-1 flex items-center gap-2">
                                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                                <path
                                                                    d="M10 2a8 8 0 100 16 8 8 0 000-16zM9 9a1 1 0 112 0v4a1 1 0 11-2 0V9zm1-4a1 1 0 100 2 1 1 0 000-2z" />
                                                            </svg>
                                                            {{ $reservation->eventtype_name }}
                                                        </p>
                                                    </div>
                                                </div>

                                                <!-- Card Content -->
                                                <div class="p-6 space-y-5">

                                                    <!-- Organizer Info Section -->
                                                    <div
                                                        class="bg-gradient-to-br from-indigo-50 to-purple-50 rounded-2xl p-4 space-y-2.5 border border-indigo-100">
                                                        <div class="flex items-start gap-3">
                                                            <div
                                                                class="w-10 h-10 rounded-full bg-indigo-500 flex items-center justify-center flex-shrink-0 shadow-md">
                                                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                                    <path fill-rule="evenodd"
                                                                        d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                                        clip-rule="evenodd" />
                                                                </svg>
                                                            </div>
                                                            <div class="flex-1 min-w-0">
                                                                <p class="text-xs font-semibold text-indigo-600 uppercase tracking-wide">
                                                                    Organizer</p>
                                                                <p class="text-sm font-bold text-gray-900 truncate">
                                                                    {{ $reservation->eventorganizer_name }}
                                                                </p>
                                                            </div>
                                                        </div>

                                                        <div class="grid grid-cols-1 gap-2 pl-13">
                                                            <div class="flex items-center gap-2 text-xs text-gray-700">
                                                                <svg class="w-4 h-4 text-indigo-500 flex-shrink-0" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                                </svg>
                                                                <span class="truncate">{{ $reservation->eventorganizer_email }}</span>
                                                            </div>
                                                            <div class="flex items-center gap-2 text-xs text-gray-700">
                                                                <svg class="w-4 h-4 text-indigo-500 flex-shrink-0" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                                                </svg>
                                                                <span>{{ $reservation->eventorganizer_phone }}</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Event Details Grid -->
                                                    <div class="grid grid-cols-2 gap-4">
                                                        <div class="bg-gray-50 rounded-xl p-3 border border-gray-200">
                                                            <div class="flex items-center gap-2 mb-1">
                                                                <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor"
                                                                    viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                                                </svg>
                                                                <p class="text-xs font-semibold text-gray-500 uppercase">Guests</p>
                                                            </div>
                                                            <p class="text-xl font-black text-gray-900">{{ $reservation->event_numguest }}
                                                            </p>
                                                        </div>

                                                        <div class="bg-gray-50 rounded-xl p-3 border border-gray-200">
                                                            <div class="flex items-center gap-2 mb-1">
                                                                <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor"
                                                                    viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                </svg>
                                                                <p class="text-xs font-semibold text-gray-500 uppercase">Payment</p>
                                                            </div>
                                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-xs font-bold rounded-lg mt-1
                                                                                                                                                                                                        {{ $reservation->event_paymentstatus == 'Paid' ? 'bg-emerald-100 text-emerald-700' :
            'bg-amber-100 text-amber-700' }}">
                                                                {{ $reservation->event_paymentstatus }}
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <!-- Dates Section -->
                                                    <div
                                                        class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-4 border border-blue-100">
                                                        <div class="grid grid-cols-2 gap-4">
                                                            <div>
                                                                <div class="flex items-center gap-2 mb-2">
                                                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor"
                                                                        viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                                            stroke-width="2"
                                                                            d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                                                    </svg>
                                                                    <p class="text-xs font-bold text-blue-700 uppercase">Check-in</p>
                                                                </div>
                                                                <p class="text-sm font-black text-gray-900">
                                                                    {{ \Carbon\Carbon::parse($reservation->event_checkin)->format('M d, Y') }}
                                                                </p>
                                                            </div>
                                                            <div>
                                                                <div class="flex items-center gap-2 mb-2">
                                                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor"
                                                                        viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                                            stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                                                    </svg>
                                                                    <p class="text-xs font-bold text-blue-700 uppercase">Checkout</p>
                                                                </div>
                                                                <p class="text-sm font-black text-gray-900">
                                                                    {{ \Carbon\Carbon::parse($reservation->event_checkout)->format('M d, Y') }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Action Buttons -->
                                                    <div class="flex items-center justify-between gap-3 pt-2">
                                                        <!-- View Receipt Button -->
                                                        <button type="button"
                                                            onclick="details_modal_{{$reservation->eventbookingID}}.showModal()"
                                                            class="flex-1 inline-flex items-center justify-center gap-2 px-5 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-sm font-bold rounded-xl hover:from-indigo-700 hover:to-purple-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                            </svg>
                                                            View
                                                        </button>

                                                        <!-- Cancel Button -->
                                                        @if (!in_array($reservation->eventstatus, ['Cancelled', 'Done', 'Confirmed']))
                                                            <button onclick="cancel_event_{{$reservation->eventbookingID}}.showModal()"
                                                                type="submit"
                                                                class="inline-flex items-center justify-center gap-2 px-5 py-3 bg-rose-600 text-white text-sm font-bold rounded-xl hover:bg-rose-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                        d="M6 18L18 6M6 6l12 12" />
                                                                </svg>
                                                                Cancel
                                                            </button>
                                                        @else
                                                            <div class="px-5 py-3 bg-gray-200 text-gray-500 text-sm font-bold rounded-xl">
                                                                {{ $reservation->eventstatus }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                            @empty
                                <div
                                    class="col-span-3 flex flex-col items-center justify-center text-center p-20 bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 border-2 border-dashed border-indigo-300 rounded-3xl">
                                    <div class="relative">
                                        <div class="absolute inset-0 bg-indigo-400 blur-3xl opacity-20 rounded-full"></div>
                                        <div
                                            class="relative bg-white p-8 rounded-full shadow-2xl mb-8 border-4 border-indigo-100">
                                            <svg class="w-20 h-20 text-indigo-500" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <h3
                                        class="text-3xl font-black text-gray-900 mb-4 bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                                        No Reservations Found
                                    </h3>
                                    <p class="text-gray-600 text-lg max-w-md leading-relaxed mb-6">
                                        You haven't booked any event or conference yet. Browse our available event packages to
                                        get started.
                                    </p>
                                    <a href="/bookeventguest"
                                        class="inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold rounded-xl hover:from-indigo-700 hover:to-purple-700 transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:scale-105">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v16m8-8H4" />
                                        </svg>
                                        Browse Events
                                    </a>
                                </div>
                            @endforelse
                        </div>
                    </section>







                    <!-- Initialize Lucide Icons -->
                    <script>
                        lucide.createIcons();
                    </script>







                </main>
            </div>
        </div>


        {{-- modals --}}

        @foreach($reservations as $reservation)
            @include('admin.components.ecm.viewdetails')
            @include('admin.components.ecm.cancelreservation')
        @endforeach



        @livewireScripts
        @include('javascriptfix.soliera_js')




@endauth
</body>




</html>