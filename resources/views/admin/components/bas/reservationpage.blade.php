<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    @vite('resources/css/app.css')
    <script src="https://unpkg.com/lucide@latest"></script>
    <title>{{$title}} - Booking And Reservation</title>
    @livewireStyles
</head>
<body class="bg-base-100">
<div class="flex h-screen overflow-hidden">
    <!-- Sidebar -->
    @include('admin.components.dashboard.sidebar')

    <!-- Main content -->
    <div class="flex flex-col flex-1 overflow-hidden">
        <!-- Navbar -->
        @include('admin.components.dashboard.navbar')

        <!-- Dashboard Content -->
        <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 transition-slow">
            <div class="pb-5 border-b border-base-300 animate-fadeIn">
                <h1 class="text-2xl font-bold bg-white bg-clip-text text-[#191970]">
                    Booking And Reservation (Point Of Sale)
                </h1>
            </div>

      <section class="p-5">

          
    <form  autocomplete="off" action="/createreservation" method="POST" id="reservationForm" class="flex flex-col lg:flex-row gap-6">
        @csrf
        <input type="hidden" name="roomID" id="selectedRoomID" />

        <!-- LEFT SIDE -->
        <div class="flex-1 space-y-6">
            <!-- Select Room -->
            <div class="bg-white/95 backdrop-blur-md rounded-3xl p-8 shadow-2xl border border-white/20">
              <div class="flex items-center gap-4 mb-6">
        <div class="p-3 bg-gradient-to-br from-[#001f54] to-[#1a3470] rounded-2xl shadow-lg">
            <svg xmlns="http://www.w3.org/2000/svg" 
                 width="24" height="24" 
                 viewBox="0 0 24 24" 
                 fill="none" stroke="#F7B32B" 
                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 9.5V22h18V9.5L12 2Z"></path>
                <path d="M9 22V12h6v10"></path>
            </svg>
        </div>
        <div>
            <h2 class="text-2xl font-bold bg-gradient-to-r from-[#001f54] to-[#1a3470] bg-clip-text text-transparent">
                Select a Room
            </h2>
            <p class="text-gray-600">Choose A Room</p>
        </div>
    </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @forelse ($rooms as $room)
                        <div class="card bg-base-100 shadow-md hover:shadow-xl border-2 border-transparent hover:border-primary transition-all cursor-pointer relative group"
                             onclick="selectRoom(this, {{$room->roomID}}, {{$room->roomprice}})">
                            <figure class="relative h-40 overflow-hidden rounded-t-box">
                                <img src="{{ asset($room->roomphoto) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" alt="Room">
                                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-3">
                                    <h3 class="text-white font-medium text-sm">Room #{{$room->roomID}} - {{$room->roomtype}}</h3>
                                </div>
                            </figure>
                            <div class="card-body p-4 space-y-2">
                                <div class="flex justify-between items-center">
                                    <span class="badge badge-primary">{{$room->roomstatus}}</span>
                                    <span class="badge badge-outline">₱{{number_format($room->roomprice, 2)}} /night</span>
                                </div>
                                <div class="flex items-center flex-wrap text-xs text-base-content/70 gap-3 pt-2">
                                    <span class="flex items-center gap-1"><i data-lucide="square" class="w-3 h-3"></i> {{$room->roomsize}} sq.ft</span>
                                    <span class="flex items-center gap-1"><i data-lucide="users" class="w-3 h-3"></i> {{$room->roommaxguest}} Guests</span>
                                    <span class="flex items-center gap-1"><i data-lucide="wifi" class="w-3 h-3"></i> {{$room->roomfeatures}}</span>
                                </div>
                            </div>
                            <div class="absolute top-2 right-2 hidden bg-primary text-white rounded-full p-1 shadow-md selection-indicator z-10">
                                <i data-lucide="check" class="w-4 h-4"></i>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-2 text-center py-12 text-base-content/70">
                            <div class="p-4 rounded-full bg-base-300 inline-block mb-4">
                                <i data-lucide="door-closed" class="w-10 h-10"></i>
                            </div>
                            <p class="font-medium">No rooms available for booking.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Reservation Details -->
             <div class="bg-white/95 backdrop-blur-md rounded-3xl p-8 shadow-2xl border border-white/20">
                <div class="flex items-center gap-4 mb-6">
                    <div class="p-3 bg-gradient-to-br from-[#001f54] to-[#1a3470] rounded-2xl shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#F7B32B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold bg-gradient-to-r from-[#001f54] to-[#1a3470] bg-clip-text text-transparent">
                            Reservation Details
                        </h2>
                        <p class="text-gray-600">Select your dates and preferences</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="form-control">
                        <label class="label font-semibold text-[#001f54] mb-2">
                            <span class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M8 2v4"></path>
                                    <path d="M16 2v4"></path>
                                    <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                                    <path d="M3 10h18"></path>
                                </svg>
                                Check-In Date
                            </span>
                        </label>
                        <input type="date" name="reservation_checkin" class="input input-bordered w-full rounded-xl border-2 border-gray-200 focus:border-[#001f54] focus:outline-none transition-colors" required />
                    </div>

                    <div class="form-control">
                        <label class="label font-semibold text-[#001f54] mb-2">
                            <span class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M8 2v4"></path>
                                    <path d="M16 2v4"></path>
                                    <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                                    <path d="M3 10h18"></path>
                                </svg>
                                Check-Out Date
                            </span>
                        </label>
                        <input type="date" name="reservation_checkout" class="input input-bordered w-full rounded-xl border-2 border-gray-200 focus:border-[#001f54] focus:outline-none transition-colors" required />
                    </div>

                    <div class="form-control">
                        <label class="label font-semibold text-[#001f54] mb-2">
                            <span class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                                Number of Guests
                            </span>
                        </label>
                        <input type="number" name="reservation_numguest" min="1" class="input input-bordered w-full rounded-xl border-2 border-gray-200 focus:border-[#001f54] focus:outline-none transition-colors" required />
                    </div>

                    <div class="form-control md:col-span-2">
                        <label class="label font-semibold text-[#001f54] mb-2">
                            <span class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                Special Requests
                            </span>
                        </label>
                        <input type="text" name="reservation_specialrequest" placeholder="Early check-in, extra pillows..." class="input input-bordered w-full rounded-xl border-2 border-gray-200 focus:border-[#001f54] focus:outline-none transition-colors" />
                    </div>
                </div>
            </div>

            <!-- Guest Information Card -->
            <div class="bg-white/95 backdrop-blur-md rounded-3xl p-8 shadow-2xl border border-white/20">
                <div class="flex items-center gap-4 mb-6">
                    <div class="p-3 bg-gradient-to-br from-[#001f54] to-[#1a3470] rounded-2xl shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#F7B32B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold bg-gradient-to-r from-[#001f54] to-[#1a3470] bg-clip-text text-transparent">
                            Guest Information
                        </h2>
                        <p class="text-gray-600">Please provide your details</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="form-control">
                        <label class="label font-semibold text-[#001f54] mb-2">
                            <span class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                Full Name
                            </span>
                        </label>
                        <input value="" type="text" name="guestname" class="input input-bordered w-full rounded-xl border-2 border-gray-200 focus:border-[#001f54] focus:outline-none transition-colors" required />
                    </div>

                    <div class="form-control">
                        <label class="label font-semibold text-[#001f54] mb-2">
                            <span class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                                Birthday
                            </span>
                        </label>
                        <input value="" id="guestbirthday" type="date" name="guestbirthday" class="input input-bordered w-full rounded-xl border-2 border-gray-200 focus:border-[#001f54] focus:outline-none transition-colors" required />
                        <span id="ageError" class="text-red-500 text-sm mt-1 hidden">Age must be 18 or above.</span>
                    </div>

                    <div class="form-control">
                        <label class="label font-semibold text-[#001f54] mb-2">
                            <span class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                </svg>
                                Mobile Number
                            </span>
                        </label>
                        <input value="" type="tel" name="guestphonenumber" class="input input-bordered w-full rounded-xl border-2 border-gray-200 focus:border-[#001f54] focus:outline-none transition-colors" required />
                    </div>

                    <div class="form-control">
                        <label class="label font-semibold text-[#001f54] mb-2">
                            <span class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                    <polyline points="22,6 12,13 2,6"></polyline>
                                </svg>
                                Email Address
                            </span>
                        </label>
                        <input value="" type="email" name="guestemailaddress" class="input input-bordered w-full rounded-xl border-2 border-gray-200 focus:border-[#001f54] focus:outline-none transition-colors" required />
                    </div>

                    <div class="form-control md:col-span-2">
                        <label class="label font-semibold text-[#001f54] mb-2">
                            <span class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"></path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg>
                                Address
                            </span>
                        </label>
                        <textarea name="guestaddress" class="textarea textarea-bordered w-full rounded-xl border-2 border-gray-200 focus:border-[#001f54] focus:outline-none transition-colors" rows="2" required></textarea>
                    </div>

                    <div class="form-control">
                        <label class="label font-semibold text-[#001f54] mb-2">
                            <span class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                                Contact Person
                            </span>
                        </label>
                        <input type="text" name="guestcontactperson" class="input input-bordered w-full rounded-xl border-2 border-gray-200 focus:border-[#001f54] focus:outline-none transition-colors" required />
                    </div>

                    <div class="form-control">
                        <label class="label font-semibold text-[#001f54] mb-2">
                            <span class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                </svg>
                                Contact Person Number
                            </span>
                        </label>
                        <input type="tel" name="guestcontactpersonnumber" class="input input-bordered w-full rounded-xl border-2 border-gray-200 focus:border-[#001f54] focus:outline-none transition-colors" required />
                    </div>
                </div>
            </div>
        </div>

        <!-- RIGHT SIDE (POS Summary) -->
        <div class="w-full lg:w-1/3">
            
            <!-- Session Messages -->
            @if(session('success'))
                <div role="alert" class="alert alert-success mb-6 rounded-2xl shadow-lg bg-gradient-to-r from-green-500 to-emerald-500 text-white border-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{session('success')}}</span>
                </div>
            @elseif(session('modified'))
                <div role="alert" class="alert alert-success mb-6 rounded-2xl shadow-lg bg-gradient-to-r from-green-500 to-emerald-500 text-white border-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{session('modified')}}</span>
                </div>
            @elseif(session('removed'))
                <div role="alert" class="alert alert-success mb-6 rounded-2xl shadow-lg bg-gradient-to-r from-green-500 to-emerald-500 text-white border-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{session('removed')}}</span>
                </div>
            @endif

            <!-- Billing Summary Card -->
            <div class="bg-white/95 backdrop-blur-md rounded-3xl p-8 shadow-2xl border border-white/20 lg:sticky lg:top-6 ">
                <div class="flex items-center gap-4 mb-8">
                    <div class="p-3 bg-gradient-to-br from-[#001f54] to-[#1a3470] rounded-2xl shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#F7B32B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold bg-gradient-to-r from-[#001f54] to-[#1a3470] bg-clip-text text-transparent">
                            Billing Summary
                        </h2>
                        <p class="text-gray-600 text-sm">Review your charges</p>
                    </div>
                </div>

                <div class="space-y-4 mb-8">
                    <div class="flex items-center justify-between p-3 rounded-xl bg-gradient-to-r from-[#001f54]/5 to-[#1a3470]/5 border border-[#001f54]/10">
                        <span class="flex items-center gap-2 text-sm font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m9 9 5 12 1.8-5.2L21 14Z"></path>
                                <path d="M7.2 2.2 8 5.1"></path>
                                <path d="m5.1 8-2.9-.8"></path>
                                <path d="M14 4.1 12 6"></path>
                                <path d="m6 12-1.9 2"></path>
                            </svg>
                            Room Price (per night)
                        </span>
                        <span id="roomPrice" class="font-bold text-[#001f54]">₱0.00</span>
                    </div>

                    <div class="flex items-center justify-between p-3 rounded-xl bg-gradient-to-r from-[#001f54]/5 to-[#1a3470]/5 border border-[#001f54]/10">
                        <span class="flex items-center gap-2 text-sm font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="6"></circle>
                                <polyline points="12 2 12 6"></polyline>
                                <polyline points="12 18 12 22"></polyline>
                            </svg>
                            Nights
                        </span>
                        <span id="numNights" class="font-bold text-[#001f54]">0</span>
                    </div>

                    <div class="flex items-center justify-between p-3 rounded-xl bg-gradient-to-r from-[#001f54]/5 to-[#1a3470]/5 border border-[#001f54]/10">
                        <span class="flex items-center gap-2 text-sm font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="8" y1="6" x2="21" y2="6"></line>
                                <line x1="8" y1="12" x2="21" y2="12"></line>
                                <line x1="8" y1="18" x2="21" y2="18"></line>
                                <line x1="3" y1="6" x2="3.01" y2="6"></line>
                                <line x1="3" y1="12" x2="3.01" y2="12"></line>
                                <line x1="3" y1="18" x2="3.01" y2="18"></line>
                            </svg>
                            Subtotal
                        </span>
                        <span id="subtotal" class="font-bold text-[#001f54]">₱0.00</span>
                    </div>

                    <div class="flex items-center justify-between p-3 rounded-xl bg-gradient-to-r from-orange-500/5 to-amber-500/5 border border-orange-500/20">
                        <span class="flex items-center gap-2 text-sm font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="19" y1="5" x2="5" y2="19"></line>
                                <circle cx="6.5" cy="6.5" r="2.5"></circle>
                                <circle cx="17.5" cy="17.5" r="2.5"></circle>
                            </svg>
                            VAT (12%)
                        </span>
                        <span id="vatAmount" class="font-bold text-orange-600">₱0.00</span>
                    </div>

                    <div class="flex items-center justify-between p-3 rounded-xl bg-gradient-to-r from-blue-500/5 to-cyan-500/5 border border-blue-500/20">
                      <span class="flex items-center gap-2 text-sm font-medium">
    <svg xmlns="http://www.w3.org/2000/svg" 
         width="16" height="16" 
         viewBox="0 0 24 24" 
         fill="none" stroke="currentColor" 
         stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M6 20V4h7a5 5 0 0 1 0 10H6" />
        <line x1="6" y1="10" x2="13" y2="10" />
        <line x1="6" y1="14" x2="12" y2="14" />
    </svg>
    Service Fee (2%)
</span>
                        <span id="serviceFee" class="font-bold text-blue-600">₱0.00</span>
                    </div>

                    <div class="flex items-center justify-between p-4 rounded-xl bg-gradient-to-r from-[#001f54] to-[#1a3470] text-white border-t-4 border-t-white/20">
                        <span class="flex items-center gap-2 text-lg font-bold">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#F7B32B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="1" y="3" width="15" height="13"></rect>
                                <path d="m16 8 2-2 2 2"></path>
                                <path d="M21 14V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h11"></path>
                                <path d="M5 12V7a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v5"></path>
                            </svg>
                            Total Amount
                        </span>
                        <span id="totalAmount" class="text-2xl text-[#F7B32B] font-bold">₱0.00</span>
                    </div>
                </div>

              
                

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4">
                    <button type="reset" class="btn btn-ghosts rounded-md btn-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 6h18l-2 13H5L3 6Z"></path>
                            <path d="m19 6-3-3H8l-3 3"></path>
                        </svg>
                        Cancel
                    </button>
                    
                    <button type="button" onclick="confirm_modal_bas.showModal()" class="btn btn-primary rounded-md btn-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 6L9 17l-5-5"></path>
                        </svg>
                        Confirm Reservation
                    </button>
                </div>
                
               
            </div>
        </div>
    </form>
</section>

        </main>
    </div>
</div>

{{-- modal --}}
@include('admin.components.bas.confirmation')
@livewireScripts
@include('javascriptfix.soliera_js')

<script>
    lucide.createIcons();

    let selectedRoomPrice = 0;

    function selectRoom(cardElement, roomID, roomPrice) {
        document.querySelectorAll('.card').forEach(card => {
            card.classList.remove('border-primary', 'bg-primary/10');
            const indicator = card.querySelector('.selection-indicator');
            if (indicator) indicator.classList.add('hidden');
        });

        cardElement.classList.add('border-primary', 'bg-primary/10');
        const selectedIndicator = cardElement.querySelector('.selection-indicator');
        if (selectedIndicator) selectedIndicator.classList.remove('hidden');

        document.getElementById('selectedRoomID').value = roomID;
        selectedRoomPrice = roomPrice;

        document.getElementById('roomPrice').innerText = roomPrice.toFixed(2);
        calculateSubtotal();
    }

    function calculateSubtotal() {
    const checkin = document.querySelector('[name="reservation_checkin"]').value;
    const checkout = document.querySelector('[name="reservation_checkout"]').value;

    if (!checkin || !checkout || selectedRoomPrice === 0) return;

    const checkinDate = new Date(checkin);
    const checkoutDate = new Date(checkout);
    const diffTime = checkoutDate - checkinDate;
    const numNights = Math.max(diffTime / (1000 * 60 * 60 * 24), 0);

    document.getElementById('numNights').innerText = numNights;

    const subtotal = numNights * selectedRoomPrice;
    const vat = subtotal * 0.12;
    const serviceFee = subtotal * 0.02; // 2% service fee
    const total = subtotal + vat + serviceFee;

    document.getElementById('subtotal').innerText = subtotal.toFixed(2);
    document.getElementById('vatAmount').innerText = vat.toFixed(2);
    document.getElementById('serviceFee').innerText = serviceFee.toFixed(2); // make sure you added this span in HTML
    document.getElementById('totalAmount').innerText = total.toFixed(2);
}

    document.addEventListener('DOMContentLoaded', () => {
        const checkinInput = document.querySelector('[name="reservation_checkin"]');
        const checkoutInput = document.querySelector('[name="reservation_checkout"]');

        checkinInput.addEventListener('change', calculateSubtotal);
        checkoutInput.addEventListener('change', calculateSubtotal);

        // Age validation
        const birthdayInput = document.getElementById('guestbirthday');
        const ageError = document.getElementById('ageError');
        const submitBtn = document.querySelector('#reservationForm button[type="submit"]');

        birthdayInput.addEventListener('input', () => {
            const birthDate = new Date(birthdayInput.value);
            const today = new Date();
            let age = today.getFullYear() - birthDate.getFullYear();
            const m = today.getMonth() - birthDate.getMonth();

            if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }

            if (isNaN(age)) {
                ageError.classList.add('hidden');
                submitBtn.disabled = false;
                return;
            }

            if (age < 18) {
                ageError.classList.remove('hidden');
                submitBtn.disabled = true;
            } else {
                ageError.classList.add('hidden');
                submitBtn.disabled = false;
            }
        });
    });
</script>
</body>
</html>
