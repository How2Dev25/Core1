<!-- Order Modal -->
<dialog id="bookroom_{{ $room->roomID }}" class="modal">
    <div class="modal-box max-w-4xl bg-white rounded-2xl shadow-xl">
        <!-- Header -->
        <form method="dialog" class="absolute right-4 top-4 z-10">
            <button class="btn btn-sm btn-circle btn-ghost">✕</button>
        </form>


   <form autocomplete="off" action="submitroompos" method="POST" id="reservationForm"
            class="flex flex-col gap-8 max-w-7xl mx-auto">
            @csrf
            <input value="{{$room->roomID}}" type="hidden" name="roomID" data-price="{{$room->roomprice}}" />

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
                <div class="bg-white/95 backdrop-blur-md rounded-3xl p-8 shadow-2xl border border-white/20">
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
                                    Number of Guests (Max {{ $room->roommaxguest }})
                                    <span class="text-red-500">*</span>
                                </span>
                            </label>

                            <input type="number" name="reservation_numguest" min="1"
                                class="input input-bordered w-full rounded-xl border-2 border-gray-200 focus:border-[#001f54] focus:outline-none transition-colors"
                                required />

                            <!-- Add this below for the dynamic note -->
                            <p id="extraGuestNote" class="text-sm text-gray-600 mt-1 hidden"></p>
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
                                    <span class="text-red-500">*</span>
                                </span>
                            </label>
                            <input type="text" name="reservation_specialrequest"
                                placeholder="Early check-in, extra pillows..."
                                class="input input-bordered w-full rounded-xl border-2 border-gray-200 focus:border-[#001f54] focus:outline-none transition-colors" />
                        </div>
                    </div>
                </div>

                <!-- Guest Information Card -->
                <div class="bg-white/95 backdrop-blur-md rounded-3xl p-8 shadow-2xl border border-white/20">
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
                                <span class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path
                                            d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                                        </path>
                                    </svg>
                                    Mobile Number
                                    <span class="text-red-500">*</span>
                                </span>
                            </label>
                        <input type="tel" name="guestphonenumber" class="input input-bordered w-full rounded-xl border-2 border-gray-200 
                                   focus:border-[#001f54] focus:outline-none transition-colors" minlength="11" maxlength="11"
                            pattern="[0-9]{11}" placeholder="e.g. 09123456789" required />
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
                                <span class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path
                                            d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                                        </path>
                                    </svg>
                                    Contact Person Number
                                    <span class="text-red-500">*</span>
                                </span>
                            </label>
                            <input type="tel" name="guestcontactpersonnumber"
                                class="input input-bordered w-full rounded-xl border-2 border-gray-200 focus:border-[#001f54] focus:outline-none transition-colors"
                               minlength="11" maxlength="11"
                            pattern="[0-9]{11}" placeholder="e.g. 09123456789" required />
                        </div>

                        <input type="hidden" name="subtotal" id="hiddenSubtotal">
                        <input type="hidden" name="vat" id="hiddenVat">
                        <input type="hidden" name="serviceFee" id="hiddenServiceFee">
                        <input type="hidden" name="total" id="hiddenTotal">
                    </div>
                </div>
            </div>

            <!-- RIGHT SIDE (Enhanced Billing Summary) -->
            <div class="w-full ">

                <!-- Session Messages -->
                @if(session('success'))
                    <div role="alert"
                        class="alert alert-success mb-6 rounded-2xl shadow-lg bg-gradient-to-r from-green-500 to-emerald-500 text-white border-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{session('success')}}</span>
                    </div>
                @elseif(session('modified'))
                    <div role="alert"
                        class="alert alert-success mb-6 rounded-2xl shadow-lg bg-gradient-to-r from-green-500 to-emerald-500 text-white border-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{session('modified')}}</span>
                    </div>
                @elseif(session('removed'))
                    <div role="alert"
                        class="alert alert-success mb-6 rounded-2xl shadow-lg bg-gradient-to-r from-green-500 to-emerald-500 text-white border-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                            viewBox="0 0 24 24">
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

                        <button type="button" onclick="confirm_modal_bas.showModal()"
                            class="btn btn-primary rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M20 6L9 17l-5-5"></path>
                            </svg>
                            Submit
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


        
    </div>
</dialog>


<script>
    // Global variables
    let taxRate = {{ $taxrate }};
    let serviceFeeRate = {{ $servicefee }};
    let additionalFee = {{ $additionalpersonfee }};

    // Function to initialize modal calculations
    function initializeModalCalculations(modal) {
        const roomPrice = parseFloat(modal.querySelector('[name="roomID"]')?.dataset.price || 0);
        const maxGuests = parseInt(modal.querySelector('[name="reservation_numguest"]')?.max || 1);

        // Set room price in a data attribute for this modal
        modal.dataset.roomPrice = roomPrice;
        modal.dataset.maxGuests = maxGuests;

        // Get all input elements for this modal
        const checkinInput = modal.querySelector('[name="reservation_checkin"]');
        const checkoutInput = modal.querySelector('[name="reservation_checkout"]');
        const guestsInput = modal.querySelector('[name="reservation_numguest"]');

        // Function to calculate billing for this specific modal
        function calculateBilling() {
            const checkin = checkinInput?.value;
            const checkout = checkoutInput?.value;
            const numGuests = parseInt(guestsInput?.value) || 1;
            const selectedRoomPrice = parseFloat(modal.dataset.roomPrice);
            const maxGuests = parseInt(modal.dataset.maxGuests);

            // Calculate nights
            let numNights = 0;
            if (checkin && checkout) {
                const start = new Date(checkin + 'T00:00:00');
                const end = new Date(checkout + 'T00:00:00');
                if (end >= start) {
                    const diffTime = end - start;
                    numNights = Math.floor(diffTime / (1000 * 60 * 60 * 24)) + 1;
                }
            }

            // Base subtotal
            let subtotal = numNights * selectedRoomPrice;

            // Extra guest fee
            const extraGuests = Math.max(0, numGuests - maxGuests);
            const extraFeeTotal = extraGuests * additionalFee;
            subtotal += extraFeeTotal;

            // VAT and Service Fee
            const vat = subtotal * (taxRate / 100);
            const serviceFee = subtotal * (serviceFeeRate / 100);
            const total = subtotal + vat + serviceFee;

            // Update extra guest note for this modal
            const noteElement = modal.querySelector('#extraGuestNote');
            if (noteElement) {
                if (extraGuests > 0) {
                    noteElement.innerText = `₱${additionalFee.toFixed(2)} additional fee per extra guest (${extraGuests} extra).`;
                    noteElement.classList.remove('hidden');
                    noteElement.classList.add('text-red-500');
                } else {
                    noteElement.classList.add('hidden');
                    noteElement.innerText = '';
                }
            }

            // Update display for this modal
            const roomPriceSpan = modal.querySelector('#roomPrice');
            const numNightsSpan = modal.querySelector('#numNights');
            const subtotalSpan = modal.querySelector('#subtotal');
            const vatSpan = modal.querySelector('#vatAmount');
            const serviceFeeSpan = modal.querySelector('#serviceFee');
            const totalSpan = modal.querySelector('#totalAmount');

            if (roomPriceSpan) roomPriceSpan.textContent = `₱${selectedRoomPrice.toFixed(2)}`;
            if (numNightsSpan) numNightsSpan.textContent = numNights;
            if (subtotalSpan) subtotalSpan.textContent = `₱${subtotal.toFixed(2)}`;
            if (vatSpan) vatSpan.textContent = `₱${vat.toFixed(2)}`;
            if (serviceFeeSpan) serviceFeeSpan.textContent = `₱${serviceFee.toFixed(2)}`;
            if (totalSpan) totalSpan.textContent = `₱${total.toFixed(2)}`;

            // Update hidden inputs for this modal
            const hiddenSubtotal = modal.querySelector('#hiddenSubtotal');
            const hiddenVat = modal.querySelector('#hiddenVat');
            const hiddenServiceFee = modal.querySelector('#hiddenServiceFee');
            const hiddenTotal = modal.querySelector('#hiddenTotal');

            if (hiddenSubtotal) hiddenSubtotal.value = subtotal.toFixed(2);
            if (hiddenVat) hiddenVat.value = vat.toFixed(2);
            if (hiddenServiceFee) hiddenServiceFee.value = serviceFee.toFixed(2);
            if (hiddenTotal) hiddenTotal.value = total.toFixed(2);
        }

        // Add event listeners for this modal's inputs
        if (checkinInput) checkinInput.addEventListener('input', calculateBilling);
        if (checkoutInput) checkoutInput.addEventListener('change', calculateBilling);
        if (guestsInput) guestsInput.addEventListener('input', calculateBilling);

        // Initialize calculation when modal opens
        modal.addEventListener('show', calculateBilling);

        // Also calculate immediately in case there are pre-filled values
        calculateBilling();
    }

    // Function to initialize age validation for a modal
    function initializeAgeValidation(modal) {
        const birthdayInput = modal.querySelector('#guestbirthday');
        const ageError = modal.querySelector('#ageError');
        const submitBtn = modal.querySelector('button[type="button"]');

        if (birthdayInput && ageError && submitBtn) {
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
        }
    }

    // Initialize all modals when DOM is loaded
    document.addEventListener('DOMContentLoaded', function () {
        const modals = document.querySelectorAll('dialog[id^="bookroom_"]');

        modals.forEach(modal => {
            // Store room price in the modal element
            const roomId = modal.id.replace('bookroom_', '');
            const roomPriceElement = modal.querySelector('#roomPrice');

            // You might need to pass the room price differently
            // For now, we'll extract it from the roomPrice span if it exists
            let roomPrice = 0;
            if (roomPriceElement) {
                const priceText = roomPriceElement.textContent.replace('₱', '').trim();
                roomPrice = parseFloat(priceText) || 0;
            }

            modal.dataset.roomPrice = roomPrice;

            // Initialize calculations and validation for this modal
            initializeModalCalculations(modal);
            initializeAgeValidation(modal);
        });

        // Also initialize when any modal opens (as a fallback)
        document.addEventListener('click', function (e) {
            if (e.target.closest('button') && e.target.closest('button').onclick) {
                setTimeout(() => {
                    const openModal = document.querySelector('dialog[open]');
                    if (openModal && openModal.id.startsWith('bookroom_')) {
                        initializeModalCalculations(openModal);
                    }
                }, 100);
            }
        });
    });
</script>
