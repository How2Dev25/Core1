<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite('resources/css/app.css')
    <script src="https://unpkg.com/lucide@latest"></script>
  

    <link rel="stylesheet" href="{{ asset('mobilevalid/intlTelInput.min.css') }}">
    <script src="{{ asset('mobilevalid/intlTelInput.min.js') }}"></script>
    <script src="{{ asset('mobilevalid/utils.js') }}"></script>
    <title>{{$title}} - Room Booking</title>
    @livewireStyles
</head>

<body class="bg-base-100">

    @include('booking.component.nav')
    <section class="p-6 bg-gradient-to-br from-gray-50 via-blue-50 to-indigo-50 min-h-screen mt-20">
        <form autocomplete="off" action="/guestcreatereservationlanding" method="POST" id="reservationForm" enctype="multipart/form-data"
            class="flex flex-col lg:flex-row gap-8 max-w-7xl mx-auto">
            @csrf
            <input value="{{$room->roomID}}" type="hidden" name="roomID" id="selectedRoomID" />

            <!-- LEFT SIDE -->
            <div class="flex-1 space-y-8">

                @if ($errors->any())
                    <div class="bg-white border-l-4 border-red-500 p-4 rounded-lg shadow mb-4">
                        <div class="flex items-start">
                            <!-- Icon wrapper -->
                            <div class="flex items-center justify-center w-10 h-10 rounded-full bg-blue-900 mr-3">
                                <i class="fas fa-exclamation-triangle text-yellow-400 text-xl"></i>
                            </div>

                            <!-- Error text -->
                            <div>
                                <h3 class="font-bold text-red-600 text-lg">Error</h3>
                                <ul class="mt-2 list-disc list-inside text-gray-700 text-sm space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Room Selection Card -->
                <div class="bg-white/95 backdrop-blur-md rounded-3xl p-8 shadow-2xl border border-white/20">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="p-3 bg-gradient-to-br from-[#001f54] to-[#1a3470] rounded-2xl shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="#F7B32B" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                            </svg>
                        </div>
                        <div>
                            <h2
                                class="text-2xl font-bold bg-gradient-to-r from-[#001f54] to-[#1a3470] bg-clip-text text-transparent">
                                Room {{$room->roomID}} - {{$room->roomtype}}
                            </h2>
                            <p class="text-gray-600">Selected accommodation</p>
                        </div>
                    </div>

                    <div class="relative rounded-2xl overflow-hidden shadow-lg group">
                        <img class="w-full h-64 object-cover transition-transform duration-700 group-hover:scale-105"
                            src="{{asset($room->roomphoto)}}" alt="Room Image">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent">
                        </div>
                    </div>
                </div>

                <!-- Reservation Details Card -->
                <div class="bg-white/95  rounded-3xl p-8 shadow-2xl border border-white/20">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="p-3 bg-gradient-to-br from-[#001f54] to-[#1a3470] rounded-2xl shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="#F7B32B" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
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
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M8 2v4"></path>
                                        <path d="M16 2v4"></path>
                                        <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                                        <path d="M3 10h18"></path>
                                    </svg>
                                    Check-In Date
                                    <span class="text-red-500">*</span>
                                </span>
                            </label>
                            <input type="date" min="{{ now()->toDateString() }}" name="reservation_checkin"
                                class="input input-bordered w-full rounded-xl border-2 border-gray-200 focus:border-[#001f54] focus:outline-none transition-colors"
                                required />
                        </div>

                        <div class="form-control">
                            <label class="label font-semibold text-[#001f54] mb-2">
                                <span class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M8 2v4"></path>
                                        <path d="M16 2v4"></path>
                                        <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                                        <path d="M3 10h18"></path>
                                    </svg>
                                    Check-Out Date
                                    <span class="text-red-500">*</span>
                                </span>
                            </label>
                            <input type="date" min="{{ now()->toDateString() }}" name="reservation_checkout"
                                class="input input-bordered w-full rounded-xl border-2 border-gray-200 focus:border-[#001f54] focus:outline-none transition-colors"
                                required />
                        </div>
                        <div class="form-control">
                            <label class="label font-semibold text-[#001f54] mb-2">
                                <span class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="9" cy="7" r="4"></circle>
                                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                    </svg>
                                    Guests (Max {{ $room->roommaxguest }})
                                    <span class="text-red-500">*</span>
                                </span>
                            </label>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="label text-sm text-gray-600">Adults</label>
                                    <input type="number" name="reservation_adults" id="adultsInput" 
                                        min="1" value="1"
                                        class="input input-bordered w-full rounded-xl border-2 border-gray-200 focus:border-[#001f54] focus:outline-none transition-colors">
                                </div>
                                <div>
                                    <label class="label text-sm text-gray-600">Children</label>
                                    <input type="number" name="reservation_children" id="childrenInput"
                                        min="0" value="0"
                                        class="input input-bordered w-full rounded-xl border-2 border-gray-200 focus:border-[#001f54] focus:outline-none transition-colors">
                                </div>
                            </div>

                            <input type="hidden" name="reservation_numguest" id="totalGuests" value="1" />
                            <p class="text-sm text-gray-600 mb-1">
                                <i class="fas fa-info-circle"></i> 
                                Room Capacity: <strong>Max {{ $room->roommaxguest }} guests</strong> (Adults + Children)
                            </p>
                            <p id="guestNote" class="text-sm text-gray-600 mt-2">Total guests: 1</p>
                            <p id="extraGuestNote" class="text-sm text-orange-600 mt-1 hidden"></p>
                        </div>
<div class="form-control md:col-span-2">
    <label class="label font-semibold text-[#001f54] mb-3">
        <span class="flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                <polyline points="7 10 12 15 17 10"></polyline>
                <line x1="12" y1="15" x2="12" y2="3"></line>
            </svg>
            <span class="text-base">Special Requests</span>
            <span class="text-red-500">*</span>
        </span>
    </label>

    <!-- Dynamic Special Requests -->
    <div class="space-y-4">
        <div id="specialRequestsList" class="flex flex-wrap gap-3">
            <!-- Default requests -->
            <div class="special-request-bubble inline-flex items-center bg-white shadow-sm hover:shadow-md transition-shadow"
                data-request="Early check-in">
                <input type="checkbox" name="special_requests[]" value="Early check-in" class="peer hidden"
                    id="req_early_checkin" onchange="toggleTimeInput('earlyCheckin', this.checked); updateEarlyCheckinFee(this.checked)">
                <label for="req_early_checkin"
                    class="cursor-pointer px-4 py-2.5 border-2 border-gray-200 transition-all duration-200 hover:border-[#001f54]/50 peer-checked:border-[#001f54] peer-checked:bg-[#001f54] peer-checked:text-white select-none">
                    <span class="text-sm font-medium whitespace-nowrap">Early check-in (+₱500.00)</span>
                </label>
                <button type="button" onclick="removeSpecialRequest(this)"
                    class="w-8 h-8 bg-red-500 hover:bg-red-600 text-white flex items-center justify-center transition-colors flex-shrink-0 border-2 border-l-0 border-red-500"
                    title="Remove request">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </svg>
                </button>
            </div>
            
            <!-- Early Check-in Time Input (Hidden by default) -->
            <div id="earlyCheckinTime" class="hidden inline-flex items-center">
                <select name="early_checkin_time" class="select select-bordered select-sm rounded-full border-2 border-gray-300 focus:border-[#001f54] focus:outline-none ml-2">
                    <option value="">Select time</option>
                    <option value="10:00 AM">10:00 AM</option>
                    <option value="11:00 AM">11:00 AM</option>
                    <option value="12:00 PM">12:00 PM</option>
                    <option value="1:00 PM">1:00 PM</option>
                </select>
            </div>
            
            <div class="special-request-bubble inline-flex items-center bg-white shadow-sm hover:shadow-md transition-shadow"
                data-request="Late check-out">
                <input type="checkbox" name="special_requests[]" value="Late check-out" class="peer hidden"
                    id="req_late_checkout" onchange="toggleTimeInput('lateCheckout', this.checked)">
                <label for="req_late_checkout"
                    class="cursor-pointer px-4 py-2.5 border-2 border-gray-200 transition-all duration-200 hover:border-[#001f54]/50 peer-checked:border-[#001f54] peer-checked:bg-[#001f54] peer-checked:text-white select-none">
                    <span class="text-sm font-medium whitespace-nowrap">Late check-out</span>
                </label>
                <button type="button" onclick="removeSpecialRequest(this)"
                    class="w-8 h-8 bg-red-500 hover:bg-red-600 text-white flex items-center justify-center transition-colors flex-shrink-0 border-2 border-l-0 border-red-500"
                    title="Remove request">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </svg>
                </button>
            </div>
            
            <!-- Late Check-out Time Input (Hidden by default) -->
            <div id="lateCheckoutTime" class="hidden inline-flex items-center">
                <select name="late_checkout_time" class="select select-bordered select-sm rounded-full border-2 border-gray-300 focus:border-[#001f54] focus:outline-none ml-2">
                    <option value="">Select time</option>
                    <option value="1:00 PM">1:00 PM</option>
                    <option value="2:00 PM">2:00 PM</option>
                    <option value="3:00 PM">3:00 PM</option>
                    <option value="4:00 PM">4:00 PM</option>
                </select>
            </div>

            <div class="special-request-bubble inline-flex items-center bg-white shadow-sm hover:shadow-md transition-shadow"
                data-request="Extra pillows">
                <input type="checkbox" name="special_requests[]" value="Extra pillows" class="peer hidden"
                    id="req_extra_pillows">
                <label for="req_extra_pillows"
                    class="cursor-pointer px-4 py-2.5 border-2 border-gray-200 transition-all duration-200 hover:border-[#001f54]/50 peer-checked:border-[#001f54] peer-checked:bg-[#001f54] peer-checked:text-white select-none">
                    <span class="text-sm font-medium whitespace-nowrap">Extra pillows</span>
                </label>
                <button type="button" onclick="removeSpecialRequest(this)"
                    class="w-8 h-8 bg-red-500 hover:bg-red-600 text-white flex items-center justify-center transition-colors flex-shrink-0 border-2 border-l-0 border-red-500"
                    title="Remove request">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </svg>
                </button>
            </div>

            <div class="special-request-bubble inline-flex items-center bg-white shadow-sm hover:shadow-md transition-shadow"
                data-request="Extra towels">
                <input type="checkbox" name="special_requests[]" value="Extra towels" class="peer hidden"
                    id="req_extra_towels">
                <label for="req_extra_towels"
                    class="cursor-pointer px-4 py-2.5 border-2 border-gray-200 transition-all duration-200 hover:border-[#001f54]/50 peer-checked:border-[#001f54] peer-checked:bg-[#001f54] peer-checked:text-white select-none">
                    <span class="text-sm font-medium whitespace-nowrap">Extra towels</span>
                </label>
                <button type="button" onclick="removeSpecialRequest(this)"
                    class="w-8 h-8 bg-red-500 hover:bg-red-600 text-white flex items-center justify-center transition-colors flex-shrink-0 border-2 border-l-0 border-red-500"
                    title="Remove request">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Standard Time Info -->
        <div class="text-xs text-gray-500 bg-gray-50 p-3 rounded-lg">
            <p><strong>Standard Check-in:</strong> 2:00 PM - 4:00 PM</p>
            <p><strong>Standard Check-out:</strong> 10:00 AM - 12:00 PM</p>
        </div>

        <!-- Add Custom Request Button -->
        <div>
            <button type="button" onclick="showAddRequestDialog()"
                class="inline-flex items-center gap-2 px-4 py-2.5 border-2 border-dashed border-gray-300 text-sm font-medium text-gray-600 hover:border-[#001f54] hover:text-[#001f54] hover:bg-gray-50 transition-all duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span>Add custom request</span>
            </button>
        </div>
    </div>
</div>

<!-- Modal dialog for adding custom requests -->
<div id="addRequestDialog"
    class="hidden fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm flex items-center justify-center z-50 p-4">
    <div class="bg-white shadow-2xl p-6 w-full max-w-md transform transition-all">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-[#001f54]">Add Custom Request</h3>
            <button type="button" onclick="hideAddRequestDialog()"
                class="text-gray-400 hover:text-gray-600 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>

        <input type="text" id="customRequestInput" placeholder="Enter your custom request..."
            class="w-full px-4 py-3 border-2 border-gray-200 focus:outline-none focus:border-[#001f54] focus:ring-2 focus:ring-[#001f54]/20 transition-all"
            maxlength="50">

        <div class="flex justify-end gap-3 mt-6">
            <button type="button" onclick="hideAddRequestDialog()"
                class="px-5 py-2.5 text-gray-700 font-medium hover:bg-gray-100 transition-colors">
                Cancel
            </button>
            <button type="button" onclick="addCustomRequest()"
                class="px-5 py-2.5 bg-[#001f54] text-white font-medium hover:bg-[#001f54]/90 shadow-md hover:shadow-lg transition-all">
                Add Request
            </button>
        </div>
    </div>
</div>
                    </div>
                </div>

                <!-- Guest Information Card -->
                <div class="bg-white/95  rounded-3xl p-8 shadow-2xl border border-white/20">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="p-3 bg-gradient-to-br from-[#001f54] to-[#1a3470] rounded-2xl shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="#F7B32B" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
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
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                    Full Name
                                    <span class="text-red-500">*</span>
                                </span>
                            </label>
                            <input value="" type="text" name="guestname"
                                class="input input-bordered w-full rounded-xl border-2 border-gray-200 focus:border-[#001f54] focus:outline-none transition-colors"
                                required />
                        </div>

                        <div class="form-control">
                            <label class="label font-semibold text-[#001f54] mb-2">
                                <span class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                    </svg>
                                    Birthday
                                    <span class="text-red-500">*</span>
                                </span>
                            </label>
                            <input value="" id="guestbirthday" type="date" name="guestbirthday"
                                class="input input-bordered w-full rounded-xl border-2 border-gray-200 focus:border-[#001f54] focus:outline-none transition-colors"
                                required />
                            <span id="ageError" class="text-red-500 text-sm mt-1 hidden">Age must be 18 or above.</span>
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
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path
                                            d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                        </path>
                                        <polyline points="22,6 12,13 2,6"></polyline>
                                    </svg>
                                    Email Address
                                    <span class="text-red-500">*</span>
                                </span>
                            </label>
                            <input value="" type="email" name="guestemailaddress"
                                class="input input-bordered w-full rounded-xl border-2 border-gray-200 focus:border-[#001f54] focus:outline-none transition-colors"
                                required />
                        </div>

                        <div class="form-control md:col-span-2">
                            <label class="label font-semibold text-[#001f54] mb-2">
                                <span class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"></path>
                                        <circle cx="12" cy="10" r="3"></circle>
                                    </svg>
                                    Address
                                    <span class="text-red-500">*</span>
                                </span>
                            </label>
                            <textarea name="guestaddress"
                                class="textarea textarea-bordered w-full rounded-xl border-2 border-gray-200 focus:border-[#001f54] focus:outline-none transition-colors"
                                rows="2" required></textarea>
                        </div>

                        <div class="form-control">
                            <label class="label font-semibold text-[#001f54] mb-2">
                                <span class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="9" cy="7" r="4"></circle>
                                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                    </svg>
                                    Contact Person
                                    <span class="text-red-500">*</span>
                                </span>
                            </label>
                            <input type="text" name="guestcontactperson"
                                class="input input-bordered w-full rounded-xl border-2 border-gray-200 focus:border-[#001f54] focus:outline-none transition-colors"
                                required />
                        </div>


                    <div class="form-control">
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


            <div class="bg-white/95  rounded-3xl p-8 shadow-2xl border border-white/20">
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
                    document.getElementById('validIdInput').addEventListener('change', function (e) {
                        const previewContainer = document.getElementById('imagePreviewContainer');
                        const file = e.target.files[0];

                        if (file) {
                            if (file.size > 5 * 1024 * 1024) { // 5MB limit
                                alert('File size exceeds 5MB limit');
                                e.target.value = '';
                                return;
                            }

                            const reader = new FileReader();
                            reader.onload = function (event) {
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

            <!-- RIGHT SIDE (Enhanced Billing Summary) -->
            <div class="w-full lg:w-1/3">

                <!-- Session Messages -->
           

                <!-- Billing Summary Card -->
                <div
                    class="bg-white/95 backdrop-blur-md rounded-3xl p-8 shadow-2xl border border-white/20 lg:sticky lg:top-6 ">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="p-3 bg-gradient-to-br from-[#001f54] to-[#1a3470] rounded-2xl shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="#F7B32B" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
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
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
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
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
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
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
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

                        <!-- Additional Guest Fees (shown dynamically) -->
                        <div id="additionalGuestFeeRow" class="hidden">
                            <div
                                class="flex items-center justify-between p-3 rounded-xl bg-gradient-to-r from-purple-500/5 to-pink-500/5 border border-purple-500/20">
                                <span class="flex items-center gap-2 text-sm font-medium">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="9" cy="7" r="4"></circle>
                                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                    </svg>
                                    Additional Guest Fees
                                </span>
                                <span id="additionalGuestFeeDisplay" class="font-bold text-purple-600">₱0.00</span>
                            </div>
                        </div>

                        <div
                            class="flex items-center justify-between p-3 rounded-xl bg-gradient-to-r from-orange-500/5 to-amber-500/5 border border-orange-500/20">
                            <span class="flex items-center gap-2 text-sm font-medium">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
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
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
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
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                    fill="none" stroke="#F7B32B" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
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

                    <!-- Payment Methods -->
                    <div class="mb-8">
                        <h3 class="text-lg font-bold text-[#001f54] mb-4 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
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
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                        fill="none" stroke="white" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
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
                                <input type="radio" name="payment_method" value="online" class="radio radio-primary">
                                <div class="p-2 bg-green-500 rounded-xl">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                        fill="none" stroke="white" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <rect x="1" y="3" width="15" height="13"></rect>
                                        <path d="m16 8 2-2 2 2"></path>
                                        <path d="M21 14V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h11"></path>
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

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        <button type="reset" class="btn btn-ghosts rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M3 6h18l-2 13H5L3 6Z"></path>
                                <path d="m19 6-3-3H8l-3 3"></path>
                            </svg>
                            Cancel
                        </button>

                    <button type="button" id="confirmReservationBtn"
                        onclick="if(FormValidator.validateAllFields()) { confirm_modal_bas.showModal(); }"
                        class="btn btn-disabled opacity-50 cursor-not-allowed rounded-md btn-sm" disabled>
                        <!-- Initial disabled state content -->
                    </button>

                    </div>

                    <p class="text-xs text-gray-500 text-center mt-4">
                        By submitting, you agree to our terms and conditions
                    </p>
                </div>
            </div>
        </form>

        <style>
            .input:focus,
            .textarea:focus {
                box-shadow: 0 0 0 3px rgba(0, 31, 84, 0.1);
            }

            .radio:checked {
                background-color: #001f54;
                border-color: #001f54;
            }

            .glass-card {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.2);
            }
        </style>
    </section>

    @include('landing.footer')


    {{-- modal --}}
    @include('admin.components.bas.confirmation')
    @livewireScripts
    @include('javascriptfix.soliera_js')

    <script src="{{ asset('mobilevalid/utilize.js') }}"></script>

    <script src="{{ asset('javascript/roombookingvalidation2.js') }}"></script>

    <script>
        lucide.createIcons();

        // Initialize with backend data
        let selectedRoomPrice = {{ $room->roomprice ?? 0 }};
        const taxRate = {{ $taxrate }};
        const serviceFeeRate = {{ $servicefee }};
        const additionalFee = {{ $additionalpersonfee }};
        const maxGuests = {{ $room->roommaxguest }};

        function calculateSubtotal() {
            const checkin = document.querySelector('[name="reservation_checkin"]').value;
            const checkout = document.querySelector('[name="reservation_checkout"]').value;
            const numGuests = parseInt(document.querySelector('[name="reservation_numguest"]').value) || 1;
            const noteElement = document.getElementById('extraGuestNote');
            const additionalFeeRow = document.getElementById('additionalGuestFeeRow');
            const additionalFeeDisplay = document.getElementById('additionalGuestFeeDisplay');

            if (!checkin || !checkout || selectedRoomPrice === 0) return;

            const checkinDate = new Date(checkin);
            const checkoutDate = new Date(checkout);
            const diffTime = checkoutDate - checkinDate;
            const numNights = Math.max(diffTime / (1000 * 60 * 60 * 24), 0);
            document.getElementById('numNights').innerText = numNights;

            // Base room price (for 1 guest included)
            let subtotal = numNights * selectedRoomPrice;

            // Additional fee applies ONLY when guests exceed max capacity
            const additionalGuests = Math.max(0, numGuests - maxGuests);
            const additionalFeeTotal = additionalGuests * additionalFee * numNights;
            subtotal += additionalFeeTotal;

            // Add early check-in fee
            subtotal += earlyCheckinFee;

            // Show/hide additional guest fee row
            if (additionalGuests > 0) {
                additionalFeeRow.classList.remove('hidden');
                additionalFeeDisplay.innerText = `₱${additionalFeeTotal.toFixed(2)}`;
            } else {
                additionalFeeRow.classList.add('hidden');
            }

            // Update guest fee display
            if (additionalGuests > 0) {
                noteElement.innerText = `⚠️ Exceeds capacity by ${additionalGuests} guest${additionalGuests > 1 ? 's' : ''}. ₱${additionalFee.toFixed(2)} fee per extra guest per night (${additionalGuests} × ${numNights} night${numNights > 1 ? 's' : ''} = ₱${additionalFeeTotal.toFixed(2)})`;
                noteElement.classList.add('text-red-600');
                noteElement.classList.remove('text-orange-600');
                noteElement.classList.remove('hidden');
            } else {
                noteElement.classList.add('hidden');
                noteElement.innerText = '';
            }

            const vat = subtotal * (taxRate / 100);
            const serviceFee = subtotal * (serviceFeeRate / 100);
            const total = subtotal + vat + serviceFee;

            // update visible summary
            document.getElementById('subtotal').innerText = `₱${subtotal.toFixed(2)}`;
            document.getElementById('vatAmount').innerText = `₱${vat.toFixed(2)}`;
            document.getElementById('serviceFee').innerText = `₱${serviceFee.toFixed(2)}`;
            document.getElementById('totalAmount').innerText = `₱${total.toFixed(2)}`;

            // update hidden inputs if any
            document.getElementById('hiddenSubtotal').value = subtotal.toFixed(2);
            document.getElementById('hiddenVat').value = vat.toFixed(2);
            document.getElementById('hiddenServiceFee').value = serviceFee.toFixed(2);
            document.getElementById('hiddenTotal').value = total.toFixed(2);
        }

        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('roomPrice').innerText = selectedRoomPrice.toFixed(2);

            const checkinInput = document.querySelector('[name="reservation_checkin"]');
            const checkoutInput = document.querySelector('[name="reservation_checkout"]');
            const guestInput = document.querySelector('[name="reservation_numguest"]');
            const adultsInput = document.getElementById('adultsInput');
            const childrenInput = document.getElementById('childrenInput');
            const totalGuestsInput = document.getElementById('totalGuests');
            const guestNote = document.getElementById('guestNote');
            const extraGuestNote = document.getElementById('extraGuestNote');
            const maxGuests = {{ $room->roommaxguest }};

            // Update total guests when adults/children change
            function updateGuestCount() {
                let adults = parseInt(adultsInput.value);
                let children = parseInt(childrenInput.value);

                if (isNaN(adults) || adults < 1) adults = 1;
                if (isNaN(children) || children < 0) children = 0;

                adultsInput.value = adults;
                childrenInput.value = children;

                const total = adults + children;

                totalGuestsInput.value = total;
                guestNote.textContent = `Total guests: ${total}`;
                
                // Only show message when exceeding room limit (this is when additional fee applies)
                if (total > maxGuests) {
                    extraGuestNote.textContent = `⚠️ Room capacity is ${maxGuests} guests. You have ${total} guests (${total - maxGuests} over capacity).`;
                    extraGuestNote.classList.remove('hidden');
                    extraGuestNote.classList.add('text-red-600');
                    extraGuestNote.classList.remove('text-orange-600');
                } else {
                    extraGuestNote.classList.add('hidden');
                }

                calculateSubtotal();
            }

            // Add event listeners for guest input changes
            adultsInput.addEventListener('input', updateGuestCount);
            childrenInput.addEventListener('input', updateGuestCount);

            // Set minimum checkout date based on check-in date
            checkinInput.addEventListener('change', () => {
                const checkinDate = new Date(checkinInput.value);
                const nextDay = new Date(checkinDate);
                nextDay.setDate(nextDay.getDate() + 1);
                checkoutInput.min = nextDay.toISOString().split('T')[0];
                
                // Clear checkout if it's before the new minimum
                if (checkoutInput.value && new Date(checkoutInput.value) <= checkinDate) {
                    checkoutInput.value = '';
                }
            });

            // Recalculate when user changes inputs
            checkinInput.addEventListener('change', calculateSubtotal);
            checkoutInput.addEventListener('change', calculateSubtotal);
            adultsInput.addEventListener('input', calculateSubtotal);
            childrenInput.addEventListener('input', calculateSubtotal);

            calculateSubtotal(); // initial run
            updateGuestCount(); // initial guest count

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

        // Dynamic Special Request Functions
        let customRequestCounter = 0;
        let earlyCheckinFee = 0;

        function toggleTimeInput(type, show) {
            const timeInput = document.getElementById(type + 'Time');
            if (show) {
                timeInput.classList.remove('hidden');
            } else {
                timeInput.classList.add('hidden');
                // Clear the selection when unchecked
                const select = timeInput.querySelector('select');
                if (select) select.value = '';
            }
        }

        function updateEarlyCheckinFee(isChecked) {
            earlyCheckinFee = isChecked ? 500.00 : 0;
            calculateSubtotal();
        }

        function showAddRequestDialog() {
            document.getElementById('addRequestDialog').classList.remove('hidden');
            document.getElementById('customRequestInput').value = '';
            document.getElementById('customRequestInput').focus();
        }

        function hideAddRequestDialog() {
            document.getElementById('addRequestDialog').classList.add('hidden');
        }

        function addCustomRequest() {
            const input = document.getElementById('customRequestInput');
            const requestText = input.value.trim();
            
            if (requestText === '') {
                return;
            }

            customRequestCounter++;
            const requestId = `custom_${customRequestCounter}`;
            
            const requestBubble = document.createElement('div');
            requestBubble.className = 'special-request-bubble flex items-center gap-2';
            requestBubble.setAttribute('data-request', requestText);
            requestBubble.innerHTML = `
                <input type="checkbox" name="special_requests[]" value="${requestText}" class="peer hidden" id="${requestId}" checked>
                <label for="${requestId}" class="cursor-pointer px-4 py-2 rounded-full border-2 border-gray-200 transition-all duration-200 hover:border-[#001f54]/50 peer-checked:border-[#001f54] peer-checked:bg-[#001f54] peer-checked:text-white">
                    <span class="text-sm font-medium">${requestText}</span>
                </label>
                <button type="button" onclick="removeSpecialRequest(this)" class="w-6 h-6 bg-red-500 hover:bg-red-600 text-white rounded-none flex items-center justify-center transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            `;
            
            document.getElementById('specialRequestsList').appendChild(requestBubble);
            hideAddRequestDialog();
        }

        function removeSpecialRequest(button) {
            const bubble = button.closest('.special-request-bubble');
            bubble.remove();
        }

        // Handle Enter key in custom request dialog
        document.addEventListener('DOMContentLoaded', function() {
            const customInput = document.getElementById('customRequestInput');
            if (customInput) {
                customInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        addCustomRequest();
                    }
                });
            }
        });
    </script>

  


</body>

</html>