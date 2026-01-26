<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <script src="https://unpkg.com/lucide@latest"></script>
    @vite('resources/css/app.css')

    <script src="https://unpkg.com/lucide@latest"></script>
       <link rel="stylesheet" href="{{ asset('mobilevalid/intlTelInput.min.css') }}">
    <script src="{{ asset('mobilevalid/intlTelInput.min.js') }}"></script>
    <script src="{{ asset('mobilevalid/utils.js') }}"></script>

    <title>{{$title}} - Booking And Reservation</title>
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
                                <h1 class="text-2xl font-bold bg-white bg-clip-text text-[#191970]">Booking And Reservation - Gemini
                                    Assistance</h1>
                            </div>
                            {{-- Subsystem Name --}}

                            <!-- Suggested Rooms Section -->
                            <section class="p-5">
                                <form autocomplete="off" action="/aisubmit" method="POST" id="reservationForm" enctype="multipart/form-data"
                                    class="flex flex-col lg:flex-row gap-6">
                                    @csrf

                                    <input type="hidden" name="roomID" id="selectedRoomID" />

                                    <!-- LEFT SIDE: Rooms + Details -->
                                    <div class="flex-1 flex flex-col gap-6">

                                        <!-- Room Selection -->
                                        <div class="bg-white/95 backdrop-blur-md rounded-3xl p-6 shadow-lg border border-white/20">
                                            <div class="flex items-center gap-4 mb-4">
                                                <div
                                                    class="p-3 bg-gradient-to-br from-[#001f54] to-[#1a3470] rounded-2xl shadow-lg">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                                        stroke="#F7B32B" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path d="M3 9.5V22h18V9.5L12 2Z"></path>
                                                        <path d="M9 22V12h6v10"></path>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <h2
                                                        class="text-2xl font-bold bg-gradient-to-r from-[#001f54] to-[#1a3470] bg-clip-text text-transparent">
                                                        Select a Room</h2>
                                                    <p class="text-gray-600 text-sm">Choose a room that suits your needs</p>



                                                </div>
                                            </div>

                                            @if(session('info'))
                                                <div class="alert alert-info mb-4 flex items-center gap-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 100 20 10 10 0 000-20z" />
                                                    </svg>
                                                    <span>{{ session('info') }}</span>
                                                </div>
                                            @endif

                                            <!-- Room Cards -->
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                                                @forelse ($rooms as $room)
                                                    <div class="card bg-base-100 shadow-md hover:shadow-xl border-2 border-transparent hover:border-primary transition-all cursor-pointer relative group"
                                                        onclick="selectRoom(this, {{$room->roomID}}, {{$room->roomprice}}, {{$room->roommaxguest}})">
                                                        <figure class="relative h-40 overflow-hidden rounded-t-box">
                                                            <img src="{{ asset($room->roomphoto) }}"
                                                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                                                alt="Room">
                                                            <div
                                                                class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-3">
                                                                <h3 class="text-white font-medium text-sm">Room #{{$room->roomID}} -
                                                                    {{$room->roomtype}}
                                                                </h3>
                                                            </div>
                                                        </figure>
                                                        <div class="card-body p-4 space-y-2">
                                                            <div class="flex justify-between items-center">
                                                                <span class="badge badge-primary">{{$room->roomstatus}}</span>
                                                                <span
                                                                    class="badge badge-outline">₱{{number_format($room->roomprice, 2)}}
                                                                    /night</span>
                                                            </div>

                                                            <!-- Loyalty Points Badge -->
                                                            <div class="flex items-center justify-end">
                                                                <div
                                                                    class="inline-flex items-center gap-1.5 bg-amber-50 px-2.5 py-1 rounded-full border border-amber-200">
                                                                    <svg class="w-3.5 h-3.5 text-amber-500" fill="currentColor"
                                                                        viewBox="0 0 20 20">
                                                                        <path
                                                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                                    </svg>
                                                                    <span
                                                                        class="text-xs font-bold text-amber-700">{{ $room->loyalty_value ?? 0 }}</span>
                                                                    <span class="text-xs text-amber-600">pts</span>
                                                                </div>
                                                            </div>

                                                            <div
                                                                class="flex items-center flex-wrap text-xs text-base-content/70 gap-3 pt-2">
                                                                <span class="flex items-center gap-1"><i data-lucide="square"
                                                                        class="w-3 h-3"></i> {{$room->roomsize}}
                                                                    sq.ft</span>
                                                                <span class="flex items-center gap-1"><i data-lucide="users"
                                                                        class="w-3 h-3"></i>
                                                                    {{$room->roommaxguest}} Guests</span>
                                                                <span class="flex items-center gap-1"><i data-lucide="wifi"
                                                                        class="w-3 h-3"></i>
                                                                    {{$room->roomfeatures}}</span>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="absolute top-2 right-2 hidden bg-primary text-white rounded-full p-1 shadow-md selection-indicator z-10">
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
                                        <div class="bg-white/95  rounded-3xl p-8 shadow-2xl border border-white/20">
                                            <div class="flex items-center gap-4 mb-6">
                                                <div
                                                    class="p-3 bg-gradient-to-br from-[#001f54] to-[#1a3470] rounded-2xl shadow-lg">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="#F7B32B" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round">
                                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <h2
                                                        class="text-2xl font-bold bg-gradient-to-r from-[#001f54] to-[#1a3470] bg-clip-text text-transparent">
                                                        Reservation Details
                                                    </h2>
                                                    <p class="text-gray-600">Select your dates and preferences</p>
                                                </div>
                                            </div>

                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                                <div class="form-control">
                                                    <label class="label font-semibold text-[#001f54] mb-2">
                                                        <span class="flex items-center gap-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                                <path d="M8 2v4"></path>
                                                                <path d="M16 2v4"></path>
                                                                <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                                                                <path d="M3 10h18"></path>
                                                            </svg>
                                                            Check-In Date
                                                        </span>
                                                    </label>
                                                    <input type="date" name="reservation_checkin" value="{{ $checkin }}"
                                                        class="input input-bordered w-full rounded-xl border-2 border-gray-200 focus:border-[#001f54] focus:outline-none transition-colors"
                                                        required />
                                                </div>

                                                <div class="form-control">
                                                    <label class="label font-semibold text-[#001f54] mb-2">
                                                        <span class="flex items-center gap-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                                <path d="M8 2v4"></path>
                                                                <path d="M16 2v4"></path>
                                                                <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                                                                <path d="M3 10h18"></path>
                                                            </svg>
                                                            Check-Out Date
                                                        </span>
                                                    </label>
                                                    <input type="date" name="reservation_checkout" value="{{ $checkout }}"
                                                        class="input input-bordered w-full rounded-xl border-2 border-gray-200 focus:border-[#001f54] focus:outline-none transition-colors"
                                                        required />
                                                </div>
                                                <div class="form-control">
                                                    <label class="label font-semibold text-[#001f54] mb-2" id="guestCountLabel">
                                                        <span class="flex items-center gap-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                                                <circle cx="9" cy="7" r="4"></circle>
                                                                <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                                            </svg>
                                                            Number of Guests (Select a room first)
                                                            <span class="text-red-500">*</span>
                                                        </span>
                                                    </label>

                                                    <input type="number" name="reservation_numguest" min="1"
                                                        class="input input-bordered w-full rounded-xl border-2 border-gray-200 focus:border-[#001f54] focus:outline-none transition-colors"
                                                        placeholder="Select a room first" disabled oninput="validateGuestCount()" />

                                                    <!-- Dynamic note for guest count -->
                                                    <p id="extraGuestNote" class="text-sm mt-1 hidden"></p>
                                                </div>

                                                <div class="form-control md:col-span-2">
                                                    <label class="label font-semibold text-[#001f54] mb-2">
                                                        <span class="flex items-center gap-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                                                <polyline points="7 10 12 15 17 10"></polyline>
                                                                <line x1="12" y1="15" x2="12" y2="3"></line>
                                                            </svg>
                                                            Special Requests
                                                        </span>
                                                    </label>
                                                    <input type="text" value="{{ $specialRequest }}"
                                                        name="reservation_specialrequest"
                                                        placeholder="Early check-in, extra pillows..."
                                                        class="input input-bordered w-full rounded-xl border-2 border-gray-200 focus:border-[#001f54] focus:outline-none transition-colors" />
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Guest Info -->
                                        <div class="bg-white/95  rounded-3xl p-8 shadow-2xl border border-white/20">
                                            <div class="flex items-center gap-4 mb-6">
                                                <div
                                                    class="p-3 bg-gradient-to-br from-[#001f54] to-[#1a3470] rounded-2xl shadow-lg">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="#F7B32B" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                        <circle cx="12" cy="7" r="4"></circle>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <h2
                                                        class="text-2xl font-bold bg-gradient-to-r from-[#001f54] to-[#1a3470] bg-clip-text text-transparent">
                                                        Guest Information
                                                    </h2>
                                                    <p class="text-gray-600">Please provide your details</p>
                                                </div>
                                            </div>

                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                                <div class="form-control">
                                                    <label class="label font-semibold text-[#001f54] mb-2">
                                                        <span class="flex items-center gap-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                                <circle cx="12" cy="7" r="4"></circle>
                                                            </svg>
                                                            Full Name
                                                        </span>
                                                    </label>
                                                    <input value="{{Auth::guard('guest')->user()->guest_name}}" type="text"
                                                        name="guestname"
                                                        class="input input-bordered w-full rounded-xl border-2 border-gray-200 focus:border-[#001f54] focus:outline-none transition-colors"
                                                        required />
                                                </div>

                                                <div class="form-control">
                                                    <label class="label font-semibold text-[#001f54] mb-2">
                                                        <span class="flex items-center gap-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                                                <line x1="3" y1="10" x2="21" y2="10"></line>
                                                            </svg>
                                                            Birthday
                                                        </span>
                                                    </label>
                                                    <input value="{{Auth::guard('guest')->user()->guest_birthday}}"
                                                        id="guestbirthday" type="date" name="guestbirthday"
                                                        class="input input-bordered w-full rounded-xl border-2 border-gray-200 focus:border-[#001f54] focus:outline-none transition-colors"
                                                        required />
                                                    <span id="ageError" class="text-red-500 text-sm mt-1 hidden">Age must be 18 or
                                                        above.</span>
                                                </div>

                                                <div class="form-control">
                                                    <label class="label font-semibold text-[#001f54] mb-2">
                                                        Mobile Number <span class="text-red-500">*</span>
                                                    </label>

                                                    <input type="tel" id="guestPhone"
                                                        class="input input-bordered w-full rounded-xl border-2 border-gray-200 focus:border-[#001f54]" required />

                                                    <!-- hidden field for backend -->
                                                    <input type="hidden" name="guestphonenumber" id="guestPhoneHidden">
                                                </div>


                                                <div class="form-control">
                                                    <label class="label font-semibold text-[#001f54] mb-2">
                                                        <span class="flex items-center gap-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                                <path
                                                                    d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                                                </path>
                                                                <polyline points="22,6 12,13 2,6"></polyline>
                                                            </svg>
                                                            Email Address
                                                        </span>
                                                    </label>
                                                    <input value="{{Auth::guard('guest')->user()->guest_email}}" type="email"
                                                        name="guestemailaddress"
                                                        class="input input-bordered w-full rounded-xl border-2 border-gray-200 focus:border-[#001f54] focus:outline-none transition-colors"
                                                        required />
                                                </div>

                                                <div class="form-control md:col-span-2">
                                                    <label class="label font-semibold text-[#001f54] mb-2">
                                                        <span class="flex items-center gap-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                                <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"></path>
                                                                <circle cx="12" cy="10" r="3"></circle>
                                                            </svg>
                                                            Address
                                                        </span>
                                                    </label>
                                                    <textarea name="guestaddress"
                                                        class="textarea textarea-bordered w-full rounded-xl border-2 border-gray-200 focus:border-[#001f54] focus:outline-none transition-colors"
                                                        rows="2" required>{{Auth::guard('guest')->user()->guest_address}}</textarea>
                                                </div>

                                                <div class="form-control">
                                                    <label class="label font-semibold text-[#001f54] mb-2">
                                                        <span class="flex items-center gap-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                                                <circle cx="9" cy="7" r="4"></circle>
                                                                <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                                            </svg>
                                                            Contact Person
                                                        </span>
                                                    </label>
                                                    <input type="text" name="guestcontactperson"
                                                        class="input input-bordered w-full rounded-xl border-2 border-gray-200 focus:border-[#001f54] focus:outline-none transition-colors"

                                                        required />
                                                </div>

                                            <div class="form-control ">
                                                <label class="label font-semibold text-[#001f54] mb-2">
                                                    Contact Person Number <span class="text-red-500">*</span>
                                                </label>

                                                <input type="tel" id="contactPhone"
                                                    class="input input-bordered w-full rounded-xl border-2 border-gray-200 focus:border-[#001f54]" required />

                                                <input type="hidden" name="guestcontactpersonnumber" id="contactPhoneHidden">
                                            </div>
                                                <input type="hidden" name="subtotal" id="hiddenSubtotal">
                                                <input type="hidden" name="vat" id="hiddenVat">
                                                <input type="hidden" name="serviceFee" id="hiddenServiceFee">
                                                <input type="hidden" name="total" id="hiddenTotal">
                                            </div>
                                        </div>

    <div class="bg-white/95 rounded-3xl p-8 shadow-2xl border border-white/20">
        <div class="flex items-center gap-4 mb-6">
            <div class="p-3 bg-gradient-to-br from-[#001f54] to-[#1a3470] rounded-2xl shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="#F7B32B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                    <circle cx="8.5" cy="8.5" r="1.5"></circle>
                    <polyline points="21 15 16 10 5 21"></polyline>
                </svg>
            </div>
            <div>
                <h2 class="text-2xl font-bold bg-gradient-to-r from-[#001f54] to-[#1a3470] bg-clip-text text-transparent">
                    Valid ID Upload
                </h2>
                <p class="text-gray-600">Please upload a clear photo of your valid ID</p>
            </div>
        </div>

        <div class="mb-6">
            <h3 class="font-semibold text-lg text-[#001f54] mb-3">Accepted Valid IDs:</h3>
            <ul class="list-disc pl-5 text-gray-700 space-y-1">
                <li>Driver's License</li>
                <li>Passport</li>
                <li>UMID</li>
                <li>SSS ID</li>
                <li>PhilHealth ID</li>
                <li>PRC ID</li>
                <li>Voter's ID</li>
                <li>Postal ID</li>
                <li>Barangay ID</li>
                <li>TIN ID</li>
                <li>Senior Citizen ID</li>
                <li>School ID (for students)</li>
            </ul>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- File Input Section -->
            <div class="form-control">
                <label class="label font-semibold text-[#001f54] mb-2">
                    <span class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                            <polyline points="17 8 12 3 7 8"></polyline>
                            <line x1="12" y1="3" x2="12" y2="15"></line>
                        </svg>
                        Upload Valid ID
                        <span class="text-red-500">*</span>
                    </span>
                </label>
                <input type="file" name="reservation_validID" id="validIdInput"
                    class="file-input file-input-bordered w-full rounded-xl border-2 border-gray-200 focus:border-[#001f54] focus:outline-none transition-colors"
                    accept="image/*" required />
                <p class="text-sm text-gray-500 mt-2">Accepted: JPG, PNG, PDF (Max 5MB)</p>
            </div>

            <!-- Image Preview Section -->
            <div class="form-control">
                <label class="label font-semibold text-[#001f54] mb-2">
                    <span class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                            <circle cx="8.5" cy="8.5" r="1.5"></circle>
                            <polyline points="21 15 16 10 5 21"></polyline>
                        </svg>
                        ID Preview
                    </span>
                </label>
                <div id="imagePreviewContainer"
                    class="border-2 border-dashed border-gray-300 rounded-xl p-4 h-48 flex items-center justify-center bg-gray-50">
                    <div class="text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none"
                            stroke="#9CA3AF" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"
                            class="mx-auto mb-2">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                            <circle cx="8.5" cy="8.5" r="1.5"></circle>
                            <polyline points="21 15 16 10 5 21"></polyline>
                        </svg>
                        <p class="text-gray-500">Preview will appear here</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8 pt-6 border-t border-gray-200">
            <ul class="space-y-4">
                <li>
                    <h4 class="font-semibold text-lg text-blue-900 mb-2">
                        Data Privacy Act of 2012
                    </h4>
                    <p class="text-gray-700 leading-relaxed">
                        In compliance with the <strong>Data Privacy Act of 2012 (Republic Act No. 10173)</strong>,
                        Soliera Hotel & Restaurant ensures that all personal information collected is processed
                        lawfully, securely, and only for legitimate purposes such as reservations, billing,
                        and customer service.
                    </p>
                </li>
            </ul>
        </div>
    </div>

        <!-- JavaScript for image preview -->
        <script>
        document.getElementById('validIdInput').addEventListener('change', function(e) {
            const previewContainer = document.getElementById('imagePreviewContainer');
            const file = e.target.files[0];

            if (file) {
                if (file.size > 5 * 1024 * 1024) { // 5MB limit
                    alert('File size exceeds 5MB limit');
                    e.target.value = '';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(event) {
                    previewContainer.innerHTML = `
                        <img src="${event.target.result}" 
                             alt="ID Preview" 
                             class="w-full h-full object-contain rounded-lg">
                    `;
                };
                reader.readAsDataURL(file);
            } else {
                previewContainer.innerHTML = `
                    <div class="text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24"
                            fill="none" stroke="#9CA3AF" stroke-width="1" stroke-linecap="round"
                            stroke-linejoin="round" class="mx-auto mb-2">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                            <circle cx="8.5" cy="8.5" r="1.5"></circle>
                            <polyline points="21 15 16 10 5 21"></polyline>
                        </svg>
                        <p class="text-gray-500">Preview will appear here</p>
                    </div>
                `;
            }
        });
        </script>

                                    </div>

                                    <!-- RIGHT SIDE: Billing Summary -->
                                    <div class="w-full lg:w-1/3">

                                        <!-- Session Messages -->
                                        @if(session('success'))
                                            <div role="alert"
                                                class="alert alert-success mb-6 rounded-2xl shadow-lg bg-gradient-to-r from-green-500 to-emerald-500 text-white border-0">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current"
                                                    fill="none" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <span>{{session('success')}}</span>
                                            </div>
                                        @elseif(session('modified'))
                                            <div role="alert"
                                                class="alert alert-success mb-6 rounded-2xl shadow-lg bg-gradient-to-r from-green-500 to-emerald-500 text-white border-0">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current"
                                                    fill="none" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <span>{{session('modified')}}</span>
                                            </div>
                                        @elseif(session('removed'))
                                            <div role="alert"
                                                class="alert alert-success mb-6 rounded-2xl shadow-lg bg-gradient-to-r from-green-500 to-emerald-500 text-white border-0">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current"
                                                    fill="none" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <span>{{session('removed')}}</span>
                                            </div>
                                        @endif

                                        <!-- Billing Summary Card -->
                                        <div
                                            class="bg-white/95 backdrop-blur-md rounded-3xl p-8 shadow-2xl border border-white/20 lg:sticky lg:top-6 ">
                                            <div class="flex items-center gap-4 mb-8">
                                                <div
                                                    class="p-3 bg-gradient-to-br from-[#001f54] to-[#1a3470] rounded-2xl shadow-lg">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="#F7B32B" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                                        <polyline points="14 2 14 8 20 8"></polyline>
                                                        <line x1="16" y1="13" x2="8" y2="13"></line>
                                                        <line x1="16" y1="17" x2="8" y2="17"></line>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <h2
                                                        class="text-xl font-bold bg-gradient-to-r from-[#001f54] to-[#1a3470] bg-clip-text text-transparent">
                                                        Billing Summary
                                                    </h2>
                                                    <p class="text-gray-600 text-sm">Review your charges</p>
                                                </div>
                                            </div>

                                            <div class="space-y-4 mb-8">
                                                <div
                                                    class="flex items-center justify-between p-3 rounded-xl bg-gradient-to-r from-[#001f54]/5 to-[#1a3470]/5 border border-[#001f54]/10">
                                                    <span class="flex items-center gap-2 text-sm font-medium">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round">
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

                                                <div
                                                    class="flex items-center justify-between p-3 rounded-xl bg-gradient-to-r from-[#001f54]/5 to-[#1a3470]/5 border border-[#001f54]/10">
                                                    <span class="flex items-center gap-2 text-sm font-medium">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <circle cx="12" cy="12" r="6"></circle>
                                                            <polyline points="12 2 12 6"></polyline>
                                                            <polyline points="12 18 12 22"></polyline>
                                                        </svg>
                                                        Nights
                                                    </span>
                                                    <span id="numNights" class="font-bold text-[#001f54]">0</span>
                                                </div>

                                                <div
                                                    class="flex items-center justify-between p-3 rounded-xl bg-gradient-to-r from-[#001f54]/5 to-[#1a3470]/5 border border-[#001f54]/10">
                                                    <span class="flex items-center gap-2 text-sm font-medium">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round">
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

                                                <div
                                                    class="flex items-center justify-between p-3 rounded-xl bg-gradient-to-r from-orange-500/5 to-amber-500/5 border border-orange-500/20">
                                                    <span class="flex items-center gap-2 text-sm font-medium">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <line x1="19" y1="5" x2="5" y2="19"></line>
                                                            <circle cx="6.5" cy="6.5" r="2.5"></circle>
                                                            <circle cx="17.5" cy="17.5" r="2.5"></circle>
                                                        </svg>
                                                        VAT ({{ intval($taxrate) }}%)
                                                    </span>
                                                    <span id="vatAmount" class="font-bold text-orange-600">₱0.00</span>
                                                </div>

                                                <div
                                                    class="flex items-center justify-between p-3 rounded-xl bg-gradient-to-r from-blue-500/5 to-cyan-500/5 border border-blue-500/20">
                                                    <span class="flex items-center gap-2 text-sm font-medium">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M6 20V4h7a5 5 0 0 1 0 10H6" />
                                                            <line x1="6" y1="10" x2="13" y2="10" />
                                                            <line x1="6" y1="14" x2="12" y2="14" />
                                                        </svg>
                                                        Service Fee ({{ intval($servicefee) }}%)
                                                    </span>
                                                    <span id="serviceFee" class="font-bold text-blue-600">₱0.00</span>
                                                </div>

                                                <div
                                                    class="flex items-center justify-between p-4 rounded-xl bg-gradient-to-r from-[#001f54] to-[#1a3470] text-white border-t-4 border-t-white/20">
                                                    <span class="flex items-center gap-2 text-lg font-bold">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                            viewBox="0 0 24 24" fill="none" stroke="#F7B32B" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <rect x="1" y="3" width="15" height="13"></rect>
                                                            <path d="m16 8 2-2 2 2"></path>
                                                            <path d="M21 14V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h11">
                                                            </path>
                                                            <path d="M5 12V7a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v5"></path>
                                                        </svg>
                                                        Total Amount
                                                    </span>
                                                    <span id="totalAmount" class="text-2xl text-[#F7B32B] font-bold">₱0.00</span>
                                                </div>
                                            </div>


                                            <!-- Payment Methods -->
                                            <div class="mb-8">
                                                <h3 class="text-lg font-bold text-[#001f54] mb-4 flex items-center gap-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round">
                                                        <path
                                                            d="M19 7V4a1 1 0 0 0-1-1H5a2 2 0 0 0 0 4h15a1 1 0 0 1 1 1v4H6a2 2 0 0 0 0 4h12a1 1 0 0 0 1-1v-2a1 1 0 0 0-1-1">
                                                        </path>
                                                        <path d="M18 9v4"></path>
                                                    </svg>
                                                    Payment Method
                                                </h3>

                                                <div class="space-y-4">
                                                    <!-- Pay at Hotel -->
                                                    <label
                                                        class="flex items-center gap-4 p-4 border-2 border-gray-200 rounded-2xl cursor-pointer hover:border-[#001f54] hover:bg-[#001f54]/5 transition-all duration-300">
                                                        <input type="radio" name="payment_method" value="Pay at Hotel"
                                                            class="radio radio-primary" checked>
                                                        <div class="p-2 bg-[#001f54] rounded-xl">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                                viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round">
                                                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                                            </svg>
                                                        </div>
                                                        <div>
                                                            <span class="font-semibold text-[#001f54]">Pay at Hotel</span>
                                                            <p class="text-sm text-gray-600">Pay when you arrive</p>
                                                        </div>
                                                    </label>

                                                    <!-- Online Payment -->
                                                    <label
                                                        class="flex items-center gap-4 p-4 border-2 border-gray-200 rounded-2xl cursor-pointer hover:border-[#001f54] hover:bg-[#001f54]/5 transition-all duration-300">
                                                        <input type="radio" name="payment_method" value="online"
                                                            class="radio radio-primary">
                                                        <div class="p-2 bg-green-500 rounded-xl">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                                viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round">
                                                                <rect x="1" y="3" width="15" height="13"></rect>
                                                                <path d="m16 8 2-2 2 2"></path>
                                                                <path d="M21 14V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h11">
                                                                </path>
                                                                <path d="M5 12V7a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v5"></path>
                                                            </svg>
                                                        </div>
                                                        <div>
                                                            <span class="font-semibold text-[#001f54]">Online Payment</span>
                                                            <p class="text-sm text-gray-600">Secure online payment</p>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>


                                            @include('guest.components.dashboard.rooms.loyaltydiscount')

                                            <!-- Action Buttons -->
                                        <div class="flex flex-col flex-wrap sm:flex-row gap-4">
                                            <button type="reset" class="btn btn-ghost rounded-md btn-sm" onclick="resetForm()">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M3 6h18l-2 13H5L3 6Z"></path>
                                                    <path d="m19 6-3-3H8l-3 3"></path>
                                                </svg>
                                                Cancel
                                            </button>

                                        <button type="button" id="confirmReservationBtn"
                                            onclick="if(FormValidator.validateAllFields()) { confirm_modal_bas2.showModal(); }"
                                            class="btn btn-disabled opacity-50 cursor-not-allowed rounded-md btn-sm" disabled>
                                            <!-- Initial disabled state content -->
                                        </button>
                                        </div>


                                        </div>
                                    </div>

                                </form>
                            </section>





                            @include('guest.components.bas.confirmation')


                            <script src="{{ asset('mobilevalid/utilize.js') }}"></script>

                            <!-- Initialize Lucide Icons -->
                            <!-- JavaScript to Fill Form on Card Click -->
                            <script>
                                lucide.createIcons();

                                let selectedRoomPrice = 0;
                                let selectedRoomMaxGuest = 0;

                                function selectRoom(cardElement, roomID, roomPrice, roomMaxGuest) {
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
                                    selectedRoomMaxGuest = roomMaxGuest;

                                    document.getElementById('roomPrice').innerText = '₱' + roomPrice.toFixed(2);

                                    // Update the guest input with new max value and placeholder
                                    const guestInput = document.querySelector('[name="reservation_numguest"]');
                                    guestInput.max = roomMaxGuest + 2; // Allow 2 extra guests beyond max capacity
                                    guestInput.placeholder = `1-${roomMaxGuest + 2} guests`;
                                    guestInput.disabled = false; // Enable the input

                                    // Update the label to show current room's max guests
                                    updateGuestLabel(roomMaxGuest);

                                    calculateSubtotal();
                                }

                                function updateGuestLabel(maxGuests) {
                                    const guestLabel = document.querySelector('label[for="reservation_numguest"]');
                                    if (guestLabel) {
                                        guestLabel.innerHTML = `
                                                                                        <span class="flex items-center gap-2">
                                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                                                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                                                                                <circle cx="9" cy="7" r="4"></circle>
                                                                                                <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                                                                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                                                                            </svg>
                                                                                            Number of Guests (Max ${maxGuests} included, ₱${additionalFee} per extra guest)
                                                                                            <span class="text-red-500">*</span>
                                                                                        </span>
                                                                                    `;
                                    }
                                }

                                function validateGuestCount() {
                                    const guestInput = document.querySelector('[name="reservation_numguest"]');
                                    const extraGuestNote = document.getElementById('extraGuestNote');

                                    if (!guestInput.value || !selectedRoomMaxGuest) return;

                                    const guestCount = parseInt(guestInput.value);
                                    const maxGuests = selectedRoomMaxGuest;

                                    if (guestCount > maxGuests) {
                                        const extraGuests = guestCount - maxGuests;
                                        // Show info about extra charges
                                        extraGuestNote.textContent = `${extraGuests} extra guest(s) - ₱${additionalFee * extraGuests} one-time fee added`;
                                        extraGuestNote.classList.remove('hidden');
                                        extraGuestNote.classList.remove('text-orange-600');
                                        extraGuestNote.classList.add('text-blue-600');
                                    } else if (guestCount === maxGuests) {
                                        // Show info message at max capacity
                                        extraGuestNote.textContent = `Room at standard capacity (${maxGuests} guests included)`;
                                        extraGuestNote.classList.remove('hidden');
                                        extraGuestNote.classList.remove('text-orange-600');
                                        extraGuestNote.classList.add('text-green-600');
                                    } else {
                                        // Hide note when within limits
                                        extraGuestNote.classList.add('hidden');
                                    }

                                    calculateSubtotal();
                                }

                                const taxRate = {{ $taxrate }};
                                const serviceFeeRate = {{ $servicefee }};
                                const additionalFee = {{ $additionalpersonfee }};

                                function calculateSubtotal() {
                                    const checkin = document.querySelector('[name="reservation_checkin"]').value;
                                    const checkout = document.querySelector('[name="reservation_checkout"]').value;
                                    const guestCount = parseInt(document.querySelector('[name="reservation_numguest"]').value) || 1;

                                    if (!checkin || !checkout || selectedRoomPrice === 0) return;

                                    const checkinDate = new Date(checkin);
                                    const checkoutDate = new Date(checkout);
                                    const diffTime = checkoutDate - checkinDate;
                                    const numNights = Math.max(diffTime / (1000 * 60 * 60 * 24), 0);

                                    document.getElementById('numNights').innerText = numNights;

                                    let subtotal = numNights * selectedRoomPrice;

                                    // Add one-time extra charges if guests exceed the room's max capacity
                                    if (guestCount > selectedRoomMaxGuest) {
                                        const extraGuests = guestCount - selectedRoomMaxGuest;
                                        subtotal += extraGuests * additionalFee; // One-time fee, not multiplied by nights
                                    }

                                    const vat = subtotal * (taxRate / 100);
                                    const serviceFee = subtotal * (serviceFeeRate / 100);
                                    const total = subtotal + vat + serviceFee;

                                    document.getElementById('subtotal').innerText = '₱' + subtotal.toFixed(2);
                                    document.getElementById('vatAmount').innerText = '₱' + vat.toFixed(2);
                                    document.getElementById('serviceFee').innerText = '₱' + serviceFee.toFixed(2);
                                    document.getElementById('totalAmount').innerText = '₱' + total.toFixed(2);

                                    document.getElementById('hiddenSubtotal').value = subtotal.toFixed(2);
                                    document.getElementById('hiddenVat').value = vat.toFixed(2);
                                    document.getElementById('hiddenServiceFee').value = serviceFee.toFixed(2);
                                    document.getElementById('hiddenTotal').value = total.toFixed(2);
                                }

                                document.addEventListener('DOMContentLoaded', () => {
                                    const checkinInput = document.querySelector('[name="reservation_checkin"]');
                                    const checkoutInput = document.querySelector('[name="reservation_checkout"]');
                                    const guestInput = document.querySelector('[name="reservation_numguest"]');

                                    checkinInput.addEventListener('change', calculateSubtotal);
                                    checkoutInput.addEventListener('change', calculateSubtotal);
                                    guestInput.addEventListener('input', validateGuestCount);

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

                            <script src="{{ asset('javascript/roombookingvalidation.js') }}"></script>

                            <!-- Lucide Init -->
                            <script type="module">
                                import lucide from 'https://unpkg.com/lucide@latest/dist/esm/lucide.js';
                                lucide.createIcons();
                            </script>







                        </main>
                    </div>
                </div>





                @livewireScripts
                @include('javascriptfix.soliera_js')
            </body>


@endauth

</html>