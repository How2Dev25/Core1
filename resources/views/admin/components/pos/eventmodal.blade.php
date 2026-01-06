<!-- Order Modal -->
<dialog id="bookeventtye_{{ $eventtype->eventtype_ID}}" class="modal">
    <div class="modal-box max-w-4xl bg-white rounded-2xl shadow-xl">
        <!-- Header -->
     
        <form autocomplete="off" action="/submitEvent" method="POST"
            id="eventBookingForm_{{ $eventtype->eventtype_ID }}" class="flex flex-col gap-8 max-w-7xl mx-auto">
            @csrf
            <input value="{{$eventtype->eventtype_ID}}" type="hidden" name="eventtype_ID"
                id="selectedEventTypeID_{{ $eventtype->eventtype_ID }}" />

            <!-- Hidden input for total price -->
            <input type="hidden" name="event_total_price" id="eventTotalPrice_{{ $eventtype->eventtype_ID }}" value="0">

            <!-- LEFT SIDE -->
            <div class="flex-1 space-y-8">
                <!-- Event Selection Card -->
                <div class="bg-white/95 backdrop-blur-md rounded-3xl p-8 shadow-2xl border border-white/20">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="p-3 bg-blue-900 rounded-2xl shadow-lg">
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
                            <h2 class="text-2xl font-bold text-black">{{ $eventtype->eventtype_name }}</h2>
                            <p class="text-gray-600">Selected event type</p>
                        </div>
                    </div>

                    <div class="relative rounded-2xl overflow-hidden shadow-lg group">
                        <img class="w-full h-64 object-cover transition-transform duration-700 group-hover:scale-105"
                            src="{{ asset($eventtype->eventtype_photo) }}" alt="{{ $eventtype->eventtype_name }}">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent">
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
                                ₱{{ number_format($eventtype->eventtype_price, 2) }} / day</p>
                        </div>
                        <div
                            class="bg-gradient-to-r from-[#001f54]/5 to-[#1a3470]/5 p-4 rounded-2xl text-center border border-[#001f54]/10">
                            <p class="text-sm text-gray-500">Capacity</p>
                            <p id="eventCapacity_{{ $eventtype->eventtype_ID }}" class="text-lg font-semibold text-[#001f54]">{{ $eventtype->eventtype_capacity }} guests
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
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
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

                <!-- Event Details Card -->
                @php
$today = \Carbon\Carbon::today()->format('Y-m-d');
                @endphp
                <div class="bg-white/95 backdrop-blur-md rounded-3xl p-8 shadow-2xl border border-white/20">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="p-3 bg-blue-900 rounded-2xl shadow-lg">
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
                            <h2 class="text-2xl font-bold text-black">Event Details</h2>
                            <p class="text-gray-600">Select your event dates and preferences</p>
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
                                    Event Start
                                </span>
                            </label>
                            <input type="date" name="event_checkin" id="eventCheckin_{{ $eventtype->eventtype_ID }}"
                                min="{{ $today }}"
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
                                    Event End
                                </span>
                            </label>
                            <input type="date" name="event_checkout" id="eventCheckout_{{ $eventtype->eventtype_ID }}"
                                min="{{ $today }}"
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
                                    Number of Guests
                                </span>
                            </label>
                            <input type="number" name="event_numguest" id="eventNumGuest_{{ $eventtype->eventtype_ID }}"
                                min="1" max=""
                                class="input input-bordered w-full rounded-xl border-2 border-gray-200 focus:border-[#001f54] focus:outline-none transition-colors"
                                required />
                        </div>

                        <div class="form-control">
                            <label class="label font-semibold text-[#001f54] mb-2">
                                <span class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
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
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
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
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                        <polyline points="7 10 12 15 17 10"></polyline>
                                        <line x1="12" y1="15" x2="12" y2="3"></line>
                                    </svg>
                                    Equipment Needed
                                </span>
                            </label>
                            <textarea name="event_equipment" placeholder="Audio system, projectors, tables, etc."
                                class="textarea textarea-bordered w-full rounded-xl border-2 border-gray-200 focus:border-[#001f54] focus:outline-none transition-colors"
                                rows="2"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Organizer Information Card -->
                <div class="bg-white/95 backdrop-blur-md rounded-3xl p-8 shadow-2xl border border-white/20">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="p-3 bg-blue-900 rounded-2xl shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="#F7B32B" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-black">Organizer Information</h2>
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
                                </span>
                            </label>
                            <input type="text" name="eventorganizer_name"
                                class="input input-bordered w-full rounded-xl border-2 border-gray-200 focus:border-[#001f54] focus:outline-none transition-colors"
                                required />
                        </div>

                        <div class="form-control">
                            <label class="label font-semibold text-[#001f54] mb-2">
                                <span class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path
                                            d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                                        </path>
                                    </svg>
                                    Mobile Number
                                </span>
                            </label>
                            <input type="tel" name="eventorganizer_phone"
                                class="input input-bordered w-full rounded-xl border-2 border-gray-200 focus:border-[#001f54] focus:outline-none transition-colors"
                                placeholder="e.g. 09123456789"
                                required />
                        </div>

                        <div class="form-control md:col-span-2">
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
                                </span>
                            </label>
                            <input type="email" name="eventorganizer_email"
                                class="input input-bordered w-full rounded-xl border-2 border-gray-200 focus:border-[#001f54] focus:outline-none transition-colors"
                                required />
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT SIDE (Enhanced Billing Summary) -->
            <div class="w-full">
                <!-- Billing Summary Card -->
                <div
                    class="bg-white/95 backdrop-blur-md rounded-3xl p-8 shadow-2xl border border-white/20 lg:sticky lg:top-6">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="p-3 bg-blue-900 rounded-2xl shadow-lg">
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
                            <h2 class="text-xl font-bold text-black">Billing Summary</h2>
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
                                Event Price (per day)
                            </span>
                            <span id="eventPrice_{{ $eventtype->eventtype_ID }}"
                                class="font-bold text-[#001f54]">₱{{ number_format($eventtype->eventtype_price, 2) }}</span>
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
                                Days
                            </span>
                            <span id="numDays_{{ $eventtype->eventtype_ID }}" class="font-bold text-[#001f54]">0</span>
                        </div>

                        <!-- Additional Person Fee Section -->
                        <div
                            class="flex items-center justify-between p-3 rounded-xl bg-gradient-to-r from-[#001f54]/5 to-[#1a3470]/5 border border-[#001f54]/10">
                            <span class="flex items-center gap-2 text-sm font-medium">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                                Additional Person Fee
                            </span>
                            <span id="additionalPersonFee_{{ $eventtype->eventtype_ID }}"
                                class="font-bold text-[#001f54]">₱0.00</span>
                        </div>

                        <div
                            class="flex items-center justify-between p-4 rounded-xl bg-gradient-to-r from-[#001f54] to-[#1a3470] text-white border-t-4 border-t-white/20">
                            <span class="flex items-center text-white gap-2 text-lg font-bold">
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
                            <span id="totalAmount_{{ $eventtype->eventtype_ID }}"
                                class="text-2xl text-[#F7B32B] font-bold">₱0.00</span>
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
                            <!-- Pay at Venue -->
                            <label
                                class="flex items-center gap-4 p-4 border-2 border-gray-200 rounded-2xl cursor-pointer hover:border-[#001f54] hover:bg-[#001f54]/5 transition-all duration-300">
                                <input type="radio" name="event_paymentmethod" value="Pay at Venue"
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
                                    <span class="font-semibold text-[#001f54]">Pay at Venue</span>
                                    <p class="text-sm text-gray-600">Pay when you arrive</p>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        <button type="button"
                            onclick="document.getElementById('bookeventtye_{{ $eventtype->eventtype_ID }}').close()"
                            class="btn btn-ghost rounded-xl">Close</button>
                        <button type="submit"
                            class="px-6 py-2 rounded-xl bg-[#001f54] text-white font-semibold hover:bg-[#1a3470] transition">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</dialog>



<script>
    function calculateSimpleBilling(eventId) {
        console.log('Calculating for event:', eventId);

        const checkin = document.getElementById('eventCheckin_' + eventId)?.value;
        const checkout = document.getElementById('eventCheckout_' + eventId)?.value;
        

        const eventPriceText = document.getElementById('eventPrice_' + eventId)?.textContent || '₱0';
        const eventPrice = parseFloat(eventPriceText.replace('₱', '').replace(/,/g, '')) || 0;

        const capacityText = document.getElementById('eventCapacity_' + eventId)?.textContent || '0';
        const capacity = parseInt(capacityText.replace(/\D/g, '')) || 0;

        const numGuestsInput = document.getElementById('eventNumGuest_' + eventId);
        const numGuests = numGuestsInput ? parseInt(numGuestsInput.value) || 0 : 0;

        // Calculate number of days (inclusive)
        let days = 0;
        if (checkin && checkout) {
            const start = new Date(checkin + 'T00:00:00');
            const end = new Date(checkout + 'T00:00:00');
            if (end >= start) {
                const diffTime = end - start;
                days = Math.floor(diffTime / (1000 * 60 * 60 * 24)) + 1;
            }
        }

        const additionalPersonFee = {{ $additionalpersonfee }}; // e.g., 100 per extra guest
        const basePrice = days * eventPrice;

        // Calculate additional fee ONLY if numGuests exceeds capacity
        let extraGuests = 0;
        let additionalFee = 0;
        if (numGuests > capacity) {
            extraGuests = numGuests - capacity;
            additionalFee = extraGuests * additionalPersonFee;
        }

        const total = basePrice + additionalFee;

        // Update DOM
        const numDaysSpan = document.getElementById('numDays_' + eventId);
        const additionalFeeSpan = document.getElementById('additionalPersonFee_' + eventId);
        const totalSpan = document.getElementById('totalAmount_' + eventId);
        const hiddenInput = document.getElementById('eventTotalPrice_' + eventId);

        if (numDaysSpan) numDaysSpan.textContent = days;
        if (additionalFeeSpan) additionalFeeSpan.textContent = `₱${additionalFee.toFixed(2)}`;
        if (totalSpan) totalSpan.textContent = `₱${total.toFixed(2)}`;
        if (hiddenInput) hiddenInput.value = total.toFixed(2);

        console.log('Result:', { days, basePrice, extraGuests, additionalFee, total });
    }

    // Event listeners for input changes
    document.addEventListener('input', function (e) {
        const target = e.target;
        if (target.id && (target.id.includes('eventCheckin_') || target.id.includes('eventCheckout_') || target.id.includes('eventNumGuest_'))) {
            const eventId = target.id.split('_')[1];
            calculateSimpleBilling(eventId);
        }
    });

    document.addEventListener('change', function (e) {
        const target = e.target;
        if (target.id && (target.id.includes('eventCheckin_') || target.id.includes('eventCheckout_') || target.id.includes('eventNumGuest_'))) {
            const eventId = target.id.split('_')[1];
            calculateSimpleBilling(eventId);
        }
    });

    // Trigger calculation when modal opens
    document.addEventListener('DOMContentLoaded', function () {
        const dialogs = document.querySelectorAll('dialog[id^="bookeventtye_"]');
        dialogs.forEach(dialog => {
            const observer = new MutationObserver(function (mutations) {
                mutations.forEach(function (mutation) {
                    if (mutation.type === 'attributes' && mutation.attributeName === 'open' && dialog.open) {
                        const eventId = dialog.id.split('_')[1];
                        calculateSimpleBilling(eventId);
                    }
                });
            });
            observer.observe(dialog, { attributes: true });
        });
    });
</script>

