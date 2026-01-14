<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('mobilevalid/intlTelInput.min.css') }}">
    <script src="{{ asset('mobilevalid/intlTelInput.min.js') }}"></script>
    <script src="{{ asset('mobilevalid/utils.js') }}"></script>
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


                    <section class="p-6  min-h-screen ">
                        <form autocomplete="off" action="/bookthisevent" method="POST" id="eventBookingForm"
                            class="flex flex-col lg:flex-row gap-8 max-w-7xl mx-auto">
                            @csrf
                            <input value="{{$eventtype->eventtype_ID}}" type="hidden" name="eventtype_ID"
                                id="selectedEventTypeID" />

                            <!-- Hidden input for total price -->
                            <input type="hidden" name="event_total_price" id="eventTotalPrice" value="0">

                            <!-- LEFT SIDE -->
                            <div class="flex-1 space-y-8">

                                <!-- Event Selection Card -->
                                <div class="bg-white/95 backdrop-blur-md rounded-3xl p-8 shadow-2xl border border-white/20">
                                    <div class="flex items-center gap-4 mb-6">
                                        <div class="p-3 bg-blue-900 rounded-2xl shadow-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="#F7B32B" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z">
                                                </path>
                                                <polyline points="14 2 14 8 20 8"></polyline>
                                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                                <line x1="16" y1="17" x2="8" y2="17"></line>
                                            </svg>
                                        </div>
                                        <div>
                                            <h2 class="text-2xl font-bold text-black">
                                                {{ $eventtype->eventtype_name }}
                                            </h2>
                                            <p class="text-gray-600">Selected event type</p>
                                        </div>
                                    </div>

                                    <div class="relative rounded-2xl overflow-hidden shadow-lg group">
                                        <img class="w-full h-64 object-cover transition-transform duration-700 group-hover:scale-105"
                                            src="{{ asset($eventtype->eventtype_photo) }}"
                                            alt="{{ $eventtype->eventtype_name }}">
                                        <div
                                            class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent">
                                        </div>
                                    </div>

                                    <div class="mt-6">
                                        <p class="text-gray-600">{{ $eventtype->eventtype_description }}</p>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                                        <div
                                            class="bg-gradient-to-r from-[#001f54]/5 to-[#1a3470]/5 p-4 rounded-2xl text-center border border-[#001f54]/10">
                                            <p class="text-sm text-gray-500">Price</p>
                                            <p class="text-lg font-semibold text-[#001f54]">
                                                ₱{{ number_format($eventtype->eventtype_price, 2) }} / day
                                            </p>
                                        </div>
                                        <div
                                            class="bg-gradient-to-r from-[#001f54]/5 to-[#1a3470]/5 p-4 rounded-2xl text-center border border-[#001f54]/10">
                                            <p class="text-sm text-gray-500">Capacity</p>
                                            <p class="text-lg font-semibold text-[#001f54]">
                                                {{ $eventtype->eventtype_capacity }} guests
                                            </p>
                                        </div>
                                        <div
                                            class="bg-gradient-to-r from-[#001f54]/5 to-[#1a3470]/5 p-4 rounded-2xl text-center border border-[#001f54]/10">
                                            <p class="text-sm text-gray-500">Status</p>
                                            <p
                                                class="text-lg font-semibold {{ $eventtype->eventtype_status == 'Active' ? 'text-green-600' : 'text-red-600' }}">
                                                {{ $eventtype->eventtype_status }}
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Amenities -->
                                    @if(!empty($eventtype->eventtype_amenities))
                                        <div class="mt-6">
                                            <h3 class="text-lg font-semibold mb-4 text-[#001f54] flex items-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                                </svg>
                                                Amenities
                                            </h3>
                                            <ul class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                                @foreach($eventtype->eventtype_amenities as $amenity)
                                                    <li class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl">
                                                        <span class="w-3 h-3 bg-[#001f54] rounded-full"></span>
                                                        <span class="text-gray-700">{{ $amenity }}</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>


                                <div class="bg-white/95 backdrop-blur-md rounded-3xl p-8 shadow-2xl border border-white/20">
                                    <div class="flex items-center gap-4 mb-6">
                                        <div class="p-3 bg-blue-900 rounded-2xl shadow-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="#F7B32B" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <rect x="2" y="4" width="20" height="16" rx="2" ry="2"></rect>
                                                <line x1="2" y1="10" x2="22" y2="10"></line>
                                            </svg>
                                        </div>
                                        <div>
                                            <h2 class="text-2xl font-bold text-black">
                                                {{ $eventtype->facility_name }}
                                            </h2>
                                            <p class="text-gray-600">Facility Information</p>
                                        </div>
                                    </div>

                                    <!-- Facility Image -->
                                    <div class="relative rounded-2xl overflow-hidden shadow-lg group">
                                        <img class="w-full h-64 object-cover transition-transform duration-700 group-hover:scale-105"
                                            src="{{ asset($eventtype->facility_photo) }}"
                                            alt="{{ $eventtype->facility_name }}">
                                        <div
                                            class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent">
                                        </div>
                                    </div>

                                    <!-- Facility Description -->
                                    <div class="mt-6">
                                        <p class="text-gray-600">{{ $eventtype->facility_description }}</p>
                                    </div>

                                    <!-- Facility Details -->
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">

                                        <div
                                            class="bg-gradient-to-r from-[#001f54]/5 to-[#1a3470]/5 p-4 rounded-2xl text-center border border-[#001f54]/10">
                                            <p class="text-sm text-gray-500">Status</p>
                                            <p
                                                class="text-lg font-semibold {{ $eventtype->facility_status == 'Available' ? 'text-green-600' : 'text-red-600' }}">
                                                {{ $eventtype->facility_status }}
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Facility Amenities -->
                                    @php
    $amenities = json_decode($eventtype->facility_amenities, true);
                                    @endphp

                                    @if(!empty($amenities))
                                        <div class="mt-6">
                                            <p class="font-semibold text-[#001f54] mb-2">Amenities</p>
                                            <ul class="list-disc list-inside text-gray-600 text-sm">
                                                @foreach($amenities as $amenity)
                                                    <li>{{ $amenity }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>


                                <!-- Event Details Card -->
                                <div @php
    $today = \Carbon\Carbon::today()->format('Y-m-d');
                                @endphp
                                    class="bg-white/95 backdrop-blur-md rounded-3xl p-8 shadow-2xl border border-white/20">
                                    <div class="flex items-center gap-4 mb-6">
                                        <div class="p-3 bg-blue-900 rounded-2xl shadow-lg">
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
                                            <h2 class="text-2xl font-bold text-black">
                                                Event Details
                                            </h2>
                                            <p class="text-gray-600">Select your event dates and preferences</p>
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
                                                    Event Start
                                                </span>
                                            </label>
                                            <input type="date" name="event_checkin" id="eventCheckin" min="{{ $today }}"
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
                                                    Event End
                                                </span>
                                            </label>
                                            <input type="date" name="event_checkout" id="eventCheckout" min="{{ $today }}"
                                                class="input input-bordered w-full rounded-xl border-2 border-gray-200 focus:border-[#001f54] focus:outline-none transition-colors"
                                                required />
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
                                                    Number of Guests
                                                </span>
                                            </label>
                                            <input type="number" name="event_numguest" id="eventNumGuest" min="1"
                                                max="{{ $eventtype->eventtype_capacity }}"
                                                class="input input-bordered w-full rounded-xl border-2 border-gray-200 focus:border-[#001f54] focus:outline-none transition-colors"
                                                required />
                                        </div>

                                        <div class="form-control">
                                            <label class="label font-semibold text-[#001f54] mb-2">
                                                <span class="flex items-center gap-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                                        <polyline points="7 10 12 15 17 10"></polyline>
                                                        <line x1="12" y1="15" x2="12" y2="3"></line>
                                                    </svg>
                                                    Event Name
                                                </span>
                                            </label>
                                            <input type="text" name="event_name" placeholder="e.g., Company Annual Party"
                                                class="input input-bordered w-full rounded-xl border-2 border-gray-200 focus:border-[#001f54] focus:outline-none transition-colors"
                                                required />
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
                                            <textarea name="event_specialrequest"
                                                placeholder="Special decorations, catering requirements, etc."
                                                class="textarea textarea-bordered w-full rounded-xl border-2 border-gray-200 focus:border-[#001f54] focus:outline-none transition-colors"
                                                rows="2"></textarea>
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
                                                    Equipment Needed
                                                </span>
                                            </label>
                                            <textarea name="event_equipment"
                                                placeholder="Audio system, projectors, tables, etc."
                                                class="textarea textarea-bordered w-full rounded-xl border-2 border-gray-200 focus:border-[#001f54] focus:outline-none transition-colors"
                                                rows="2"></textarea>
                                        </div>
                                    </div>
                                </div>


                                <!-- Organizer Information Card -->
                                <div class="bg-white/95 backdrop-blur-md rounded-3xl p-8 shadow-2xl border border-white/20">
                                    <div class="flex items-center gap-4 mb-6">
                                        <div class="p-3 bg-blue-900 rounded-2xl shadow-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="#F7B32B" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                <circle cx="12" cy="7" r="4"></circle>
                                            </svg>
                                        </div>
                                        <div>
                                            <h2 class="text-2xl font-bold text-black">
                                                Organizer Information
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
                                            <input value="{{ Auth::guard('guest')->user()->guest_name }}" type="text"
                                                name="eventorganizer_name"
                                                class="input input-bordered w-full rounded-xl border-2 border-gray-200 
                                                                       focus:border-[#001f54] focus:outline-none transition-colors" required />
                                        </div>

                                           <div class="form-control">
    <label class="label font-semibold text-[#001f54] mb-2">
        <span class="flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round">
                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
            </svg>
            Mobile Number
        </span>
        <span class="text-red-500">*</span>
    </label>

    <input type="tel" id="organizerPhone"
        class="input input-bordered w-full rounded-xl border-2 border-gray-200 focus:border-[#001f54] focus:outline-none transition-colors" 
        required />

    <!-- Hidden field for backend -->
    <input type="hidden" name="eventorganizer_phone" id="organizerPhoneHidden">
                    </div>

                                        <div class="form-control md:col-span-2">
                                            <label class="label font-semibold text-[#001f54] mb-2">
                                                <span class="flex items-center gap-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 
                                                                                         1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 
                                                                                         2-2z"></path>
                                                        <polyline points="22,6 12,13 2,6"></polyline>
                                                    </svg>
                                                    Email Address
                                                </span>
                                            </label>
                                            <input value="{{ Auth::guard('guest')->user()->guest_email }}" type="email"
                                                name="eventorganizer_email"
                                                class="input input-bordered w-full rounded-xl border-2 border-gray-200 
                                                                       focus:border-[#001f54] focus:outline-none transition-colors" required />
                                        </div>
                                    </div>
                                </div>

                                <!-- Facilities Section -->
                                <!-- Facilities Section -->


                            </div>

                            <!-- RIGHT SIDE (Enhanced Billing Summary) -->
                            <div class="w-full lg:w-1/3">

                                <!-- Session Messages -->
                                @if(session('success'))
                                    <div role="alert"
                                        class="alert alert-success mb-6 rounded-2xl shadow-lg bg-gradient-to-r from-green-500 to-emerald-500 text-white border-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current"
                                            fill="none" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 01118 0z" />
                                        </svg>
                                        <span>{{session('success')}}</span>
                                    </div>
                                @endif

                                  @if(session('error'))
    <div role="alert"
        class="alert alert-error mb-6 rounded-2xl shadow-lg bg-gradient-to-r from-red-500 to-rose-500 text-white border-0">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M6 18L18 6M6 6l12 12" />
        </svg>
        <span>{{ session('error') }}</span>
    </div>
@endif
                                <!-- Billing Summary Card -->
                                <div
                                    class="bg-white/95 backdrop-blur-md rounded-3xl p-8 shadow-2xl border border-white/20 lg:sticky lg:top-6 ">
                                    <div class="flex items-center gap-4 mb-8">
                                        <div class="p-3 bg-blue-900 rounded-2xl shadow-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="#F7B32B" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z">
                                                </path>
                                                <polyline points="14 2 14 8 20 8"></polyline>
                                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                                <line x1="16" y1="17" x2="8" y2="17"></line>
                                            </svg>
                                        </div>
                                        <div>
                                            <h2 class="text-xl font-bold text-black">
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
                                                Event Price (per day)
                                            </span>
                                            <span id="eventPrice"
                                                class="font-bold text-[#001f54]">₱{{ number_format($eventtype->eventtype_price, 2) }}</span>
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
                                                Days
                                            </span>
                                            <span id="numDays" class="font-bold text-[#001f54]">0</span>
                                        </div>

                                        <!-- Additional Person Fee Section -->
                                        <div
                                            class="flex items-center justify-between p-3 rounded-xl bg-gradient-to-r from-[#001f54]/5 to-[#1a3470]/5 border border-[#001f54]/10">
                                            <span class="flex items-center gap-2 text-sm font-medium">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                                    <circle cx="9" cy="7" r="4"></circle>
                                                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                                </svg>
                                                Additional Person Fee
                                            </span>
                                            <span id="additionalPersonFee" class="font-bold text-[#001f54]">₱0.00</span>
                                        </div>

                                        <div
                                            class="flex items-center justify-between p-4 rounded-xl bg-gradient-to-r from-[#001f54] to-[#1a3470] text-white border-t-4 border-t-white/20">
                                            <span class="flex items-center text-white gap-2 text-lg font-bold">
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
                                            <!-- Pay at Venue -->
                                            <label
                                                class="flex items-center gap-4 p-4 border-2 border-gray-200 rounded-2xl cursor-pointer hover:border-[#001f54] hover:bg-[#001f54]/5 transition-all duration-300">
                                                <input type="radio" name="event_paymentmethod" value="Pay at Venue"
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
                                                    <span class="font-semibold text-[#001f54]">Pay at Venue</span>
                                                    <p class="text-sm text-gray-600">Pay when you arrive</p>
                                                </div>
                                            </label>

                                            <!-- Online Payment -->
                                            <label
                                                class="flex items-center gap-4 p-4 border-2 border-gray-200 rounded-2xl cursor-pointer hover:border-[#001f54] hover:bg-[#001f54]/5 transition-all duration-300">
                                                <input type="radio" name="event_paymentmethod" value="Online Payment"
                                                    class="radio radio-primary">
                                                <div class="p-2 bg-green-500 rounded-xl">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                        viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round">
                                                        <rect x="1" y="3" width="15" height="13"></rect>
                                                        <path d="m16 8 2-2 2 2"></path>
                                                        <path d="M21 14V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h11">
                                                        </path>
                                                        <path d="M5 12V极速赛车开奖直播 历史记录 澳洲幸运10开奖结果 飞飞加拿大预测2.8 幸运飞行艇开奖结果"
                                                            class="hidden"></path>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <span class="font-semibold text-[#001f54]">Online Payment</span>
                                                    <p class="text-sm text-gray-600">Secure online payment</p>
                                                </div>
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="flex flex-col sm:flex-row gap-4">
                                        <button type="reset" class="btn btn-ghost rounded-xl">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M3 6h18l-2 13H5L3 6Z"></path>
                                                <path d="m19 6-3-3H8l-3 3"></path>
                                            </svg>
                                            Cancel
                                        </button>

                                        <button onclick="document.getElementById('confirm_modal_bas').showModal()"
                                            type="button"
                                            class="px-6 py-2 rounded-xl bg-[#001f54] text-white font-semibold hover:bg-[#1a3470] transition">
                                            Submit
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </section>








                    <!-- Initialize Lucide Icons -->
                    <script>
                        lucide.createIcons();
                    </script>







                </main>
            </div>
        </div>




        {{-- modals --}}
        @include('admin.components.ecm.bookingconfirmation')



        @livewireScripts
        @include('javascriptfix.soliera_js')




@endauth
</body>

<script src="{{ asset('javascript/eventvalid.js')}}"></script>


<script>
    document.addEventListener("DOMContentLoaded", () => {
        const checkinInput = document.getElementById("eventCheckin");
        const checkoutInput = document.getElementById("eventCheckout");
        const numGuestsInput = document.getElementById("eventNumGuest");
        const numDaysSpan = document.getElementById("numDays");
        const additionalPersonFeeSpan = document.getElementById("additionalPersonFee");
        const totalAmountSpan = document.getElementById("totalAmount");
        const eventTotalPriceInput = document.getElementById("eventTotalPrice");

        const eventPrice = parseFloat("{{ $eventtype->eventtype_price }}");
        const additionalPersonFeeRate = parseFloat("{{ $additionalpersonfee }}");
        const capacity = parseInt("{{ $eventtype->eventtype_capacity }}");

        function calculateBilling() {
            const checkin = new Date(checkinInput.value);
            const checkout = new Date(checkoutInput.value);
            const numGuests = parseInt(numGuestsInput.value) || 0;

            let totalAmount = 0;
            let additionalPersonFee = 0;
            let days = 0;

            // Calculate number of days
            if (checkin && checkout && checkout > checkin) {
                const diffTime = checkout - checkin;
                days = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                // Base price for the event
                const basePrice = days * eventPrice;

                // Calculate additional person fee
                if (numGuests > capacity) {
                    const extraGuests = numGuests - capacity;
                    additionalPersonFee = extraGuests * additionalPersonFeeRate;
                }

                totalAmount = basePrice + additionalPersonFee;
            }

            // Update display
            numDaysSpan.textContent = days;
            additionalPersonFeeSpan.textContent = `₱${additionalPersonFee.toLocaleString(undefined, { minimumFractionDigits: 2 })}`;
            totalAmountSpan.textContent = `₱${totalAmount.toLocaleString(undefined, { minimumFractionDigits: 2 })}`;

            // Update hidden input
            eventTotalPriceInput.value = totalAmount.toFixed(2);
        }

        // Event listeners
        checkinInput.addEventListener("change", calculateBilling);
        checkoutInput.addEventListener("change", calculateBilling);
        numGuestsInput.addEventListener("input", calculateBilling);

        // Initial calculation
        calculateBilling();
    });
</script>



</html>