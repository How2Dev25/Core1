  <!-- Order Modal -->
<dialog id="bookroom_{{ $room->roomID }}" class="modal">
    <div class="modal-box max-w-4xl bg-white rounded-2xl shadow-xl">
        <!-- Header -->
        <form method="dialog" class="absolute right-4 top-4 z-10">
            <button class="btn btn-sm btn-circle btn-ghost">✕</button>
        </form>


   <form autocomplete="off" action="submitroompos" method="POST" id="reservationForm" enctype="multipart/form-data"
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

                                <p id="roomMaxGuest" class="hidden">{{ $room->roommaxguest }}</p>
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

                    <div class="bg-white/95 backdrop-blur-md rounded-3xl p-8 shadow-2xl border border-white/20">
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
                            <input type="file" name="reservation_validID" id="validIdInput_{{ $room->roomID }}"
                                class="file-input file-input-bordered w-full rounded-xl border-2 border-gray-200 focus:border-[#001f54] focus:outline-none transition-colors"
                                accept="image/*" required />

                                <p class="text-sm text-gray-500 mt-2">Accepted: JPG, PNG, PDF (Max 5MB)</p>
                            </div>
                    
                            <!-- Image Preview Section -->
                            <div id="imagePreviewContainer_{{ $room->roomID }}" class="form-control">
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
                    </div>
                    
                    <!-- JavaScript for image preview -->
                  <script>
// Image Preview Handler for Multiple Modals
const ModalImagePreview = {
    // Initialize image preview for all modals
    init() {
        // Set up event listeners for file inputs in all modals
        document.querySelectorAll('dialog[id^="bookroom_"]').forEach(modal => {
            this.setupImagePreviewForModal(modal);
        });
        
        // Also set up for dynamically opened modals
        this.setupModalObserver();
    },
    
    // Set up image preview for a specific modal
    setupImagePreviewForModal(modal) {
        const fileInput = modal.querySelector('input[name="reservation_validID"]');
        const previewContainer = modal.querySelector('#imagePreviewContainer');
        
        if (!fileInput || !previewContainer) return;
        
        // Store references on the input for cleanup
        fileInput._previewHandler = (e) => this.handleImagePreview(e, modal);
        fileInput.addEventListener('change', fileInput._previewHandler);
        
        // Store modal reference
        modal._fileInput = fileInput;
    },
    
    // Handle image preview for a specific modal
    handleImagePreview(e, modal) {
        const fileInput = e.target;
        const previewContainer = modal.querySelector('#imagePreviewContainer');
        const file = fileInput.files[0];

        if (file) {
            if (file.size > 5 * 1024 * 1024) { // 5MB limit
                alert('File size exceeds 5MB limit');
                fileInput.value = '';
                this.resetPreview(previewContainer);
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
            this.resetPreview(previewContainer);
        }
    },
    
    // Reset preview to default state
    resetPreview(previewContainer) {
        if (!previewContainer) return;
        
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
    },
    
    // Set up observer for dynamically created modals
    setupModalObserver() {
        // Watch for modal open events
        document.addEventListener('show', (e) => {
            const modal = e.target;
            if (modal.tagName === 'DIALOG' && modal.id.startsWith('bookroom_')) {
                this.setupImagePreviewForModal(modal);
            }
        });
        
        // Clean up when modal closes
        document.addEventListener('close', (e) => {
            const modal = e.target;
            if (modal.tagName === 'DIALOG' && modal._fileInput) {
                // Remove event listener
                if (modal._fileInput._previewHandler) {
                    modal._fileInput.removeEventListener('change', modal._fileInput._previewHandler);
                    delete modal._fileInput._previewHandler;
                }
                delete modal._fileInput;
                
                // Reset preview
                const previewContainer = modal.querySelector('#imagePreviewContainer');
                this.resetPreview(previewContainer);
            }
        });
    },
    
    // Clean up all event listeners
    cleanup() {
        document.querySelectorAll('dialog[id^="bookroom_"]').forEach(modal => {
            const fileInput = modal.querySelector('input[name="reservation_validID"]');
            if (fileInput && fileInput._previewHandler) {
                fileInput.removeEventListener('change', fileInput._previewHandler);
                delete fileInput._previewHandler;
            }
        });
    }
};

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    ModalImagePreview.init();
});

// Also re-initialize if modals are added dynamically
if (typeof MutationObserver !== 'undefined') {
    const observer = new MutationObserver((mutations) => {
        mutations.forEach((mutation) => {
            if (mutation.type === 'childList') {
                mutation.addedNodes.forEach((node) => {
                    if (node.nodeType === 1 && node.tagName === 'DIALOG' && node.id.startsWith('bookroom_')) {
                        ModalImagePreview.setupImagePreviewForModal(node);
                    }
                });
            }
        });
    });
    
    observer.observe(document.body, { childList: true, subtree: true });
}
</script>

            </div>

            <!-- RIGHT SIDE (Enhanced Billing Summary) -->
            <div class="w-full ">

          
         

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
                        <button onclick="document.getElementById('bookroom_{{ $room->roomID }}').close()" type="button" class="btn btn-ghosts rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M3 6h18l-2 13H5L3 6Z"></path>
                                <path d="m19 6-3-3H8l-3 3"></path>
                            </svg>
                            Cancel
                        </button>

                        <button type="submit" 
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
             .border-red-500 {
        border-color: #ef4444 !important;
    }
    
    .focus\:border-red-500:focus {
        border-color: #ef4444 !important;
        box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1) !important;
    }
    
    .field-error {
        animation: fadeIn 0.2s ease-in;
    }
       @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-2px); }
        to { opacity: 1; transform: translateY(0); }
    }
        </style>


        
    </div>
</dialog>

<script>
    // Validation Module for Modal POS Booking Form
    const ModalFormValidator = {
        // Store validators per modal
        modalValidators: new Map(),

        // Validation rules for each field
        rules: {
            reservation_checkin: {
                required: true,
                validate: (value, form) => {
                    const today = new Date();
                    today.setHours(0, 0, 0, 0);
                    const checkin = new Date(value);
                    return checkin >= today;
                },
                message: "Check-in date cannot be in the past"
            },
            reservation_checkout: {
                required: true,
                validate: (value, form) => {
                    const checkin = form.querySelector('[name="reservation_checkin"]')?.value;
                    if (!checkin) return false;
                    const checkinDate = new Date(checkin);
                    const checkoutDate = new Date(value);
                    return checkoutDate > checkinDate;
                },
                message: "Check-out date must be after check-in date"
            },
            reservation_numguest: {
                required: true,
                validate: (value) => {
                    const guestCount = parseInt(value);
                    // Just check it's a number and >= 1
                    return !isNaN(guestCount) && guestCount >= 1;
                },
                message: (value) => {
                    const guestCount = parseInt(value);
                    if (!value) return "Please enter number of guests";
                    if (isNaN(guestCount) || guestCount < 1) return "Enter a valid number of guests";
                    return "";
                }
            },
            guestname: {
                required: true,
                validate: (value) => value.trim().length >= 2,
                message: "Full name must be at least 2 characters"
            },
            guestbirthday: {
                required: true,
                validate: (value) => {
                    const birthDate = new Date(value);
                    const today = new Date();
                    let age = today.getFullYear() - birthDate.getFullYear();
                    const m = today.getMonth() - birthDate.getMonth();
                    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) age--;
                    return age >= 18;
                },
                message: "You must be at least 18 years old"
            },
            guestphonenumber: {
                required: true,
                validate: (value) => {
                    // Accept formats: 09XXXXXXXXX (11 digits starting with 09)
                    const cleaned = value.replace(/\D/g, '');
                    return cleaned.length === 11 && cleaned.startsWith('09');
                },
                message: "Enter valid PH mobile (09XXXXXXXXX - 11 digits)"
            },
            guestemailaddress: {
                required: true,
                validate: (value) => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value),
                message: "Enter a valid email address"
            },
            guestaddress: {
                required: true,
                validate: (value) => value.trim().length >= 5,
                message: "Address must be at least 5 characters"
            },
            guestcontactperson: {
                required: true,
                validate: (value) => value.trim().length >= 2,
                message: "Contact person name is required"
            },
            guestcontactpersonnumber: {
                required: true,
                validate: (value) => {
                    const cleaned = value.replace(/\D/g, '');
                    return cleaned.length === 11 && cleaned.startsWith('09');
                },
                message: "Enter valid PH mobile (09XXXXXXXXX - 11 digits)"
            },
            reservation_validID: {
                required: true,
                validate: (input) => {
                    if (!input.files || input.files.length === 0) return false;
                    const file = input.files[0];
                    const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'application/pdf'];
                    const maxSize = 5 * 1024 * 1024; // 5MB
                    return validTypes.includes(file.type) && file.size <= maxSize;
                },
                message: (input) => {
                    if (!input.files || input.files.length === 0) return "Valid ID is required";
                    const file = input.files[0];
                    const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'application/pdf'];
                    const maxSize = 5 * 1024 * 1024;

                    if (!validTypes.includes(file.type)) return "Only JPG, PNG, PDF files allowed";
                    if (file.size > maxSize) return "File size must be less than 5MB";
                    return "";
                }
            },
            reservation_specialrequest: {
                required: false,
                validate: () => true,
                message: ""
            }
        },

        // Initialize validation for a specific modal
        initForModal(modal) {
            const form = modal.querySelector('#reservationForm');
            if (!form) return;

            // Check if already initialized
            if (this.modalValidators.has(modal.id)) {
                return this.modalValidators.get(modal.id);
            }

            // Create validator instance for this modal
            const validator = {
                modal: modal,
                form: form,
                initialized: false
            };

            // Store the validator
            this.modalValidators.set(modal.id, validator);

            // Set up event listeners for this modal's form
            this.setupEventListeners(validator);

            // Set up mobile number formatting
            this.setupMobileNumberFormatting(validator);

            // Initial validation
            this.validateAllFields(validator);
            this.updateSubmitButton(validator);

            validator.initialized = true;

            return validator;
        },

        // Set up event listeners for validation
        setupEventListeners(validator) {
            if (!validator.form) return;

            // Listen to all input changes in this form
            validator.form.querySelectorAll('input, textarea, select').forEach(field => {
                // Skip hidden inputs
                if (field.type === 'hidden') return;

                const handleValidation = () => {
                    this.validateField(field, validator);
                    this.updateSubmitButton(validator);
                };

                field.addEventListener('input', handleValidation);
                field.addEventListener('change', handleValidation);
                field.addEventListener('blur', () => {
                    field.dataset.touched = "true";   // <-- Mark field as touched
                    this.validateField(field, validator);
                    this.updateSubmitButton(validator);
                });

                // Store reference for cleanup
                field._validationHandler = handleValidation;
            });

            // Add form submit handler
            validator.form.addEventListener('submit', (e) => {
                if (!this.isValid(validator)) {
                    e.preventDefault();
                    e.stopPropagation();

                    // Scroll to first error
                    const firstError = validator.form.querySelector('.field-error:not(.hidden)');
                    if (firstError) {
                        firstError.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center',
                            inline: 'nearest'
                        });
                    }

                    return false;
                }
            }, { capture: true });
        },

        // Set up mobile number formatting
        setupMobileNumberFormatting(validator) {
            if (!validator.form) return;

            // Format mobile number inputs on blur
            const formatMobileNumber = (field) => {
                let value = field.value.replace(/\D/g, '');

                // If starts with 9 and has 10 digits, add 0
                if (value.startsWith('9') && value.length === 10) {
                    field.value = '0' + value;
                }
                // If starts with 63 and has 11 digits, convert to 09
                else if (value.startsWith('63') && value.length === 11) {
                    field.value = '0' + value.substring(2);
                }
                // If starts with +63, remove + and convert to 09
                else if (value.startsWith('63') && value.length === 12) {
                    field.value = '0' + value.substring(2);
                }

                // Trim to 11 characters max
                if (field.value.length > 11) {
                    field.value = field.value.substring(0, 11);
                }
            };

            // Apply formatting to mobile number fields in this form
            validator.form.querySelectorAll('[name="guestphonenumber"], [name="guestcontactpersonnumber"]').forEach(field => {
                field.addEventListener('blur', () => {
                    formatMobileNumber(field);
                    this.validateField(field, validator);
                    this.updateSubmitButton(validator);
                });

                // Real-time validation while typing
                field.addEventListener('input', () => {
                    // Only allow numbers
                    field.value = field.value.replace(/\D/g, '');

                    // Limit to 11 characters
                    if (field.value.length > 11) {
                        field.value = field.value.substring(0, 11);
                    }

                    this.validateField(field, validator);
                    this.updateSubmitButton(validator);
                });
            });
        },

        // Validate a single field
        validateField(field, validator) {
            const rule = this.rules[field.name];
            if (!rule) return true;

            let isValid = true;
            let message = "";

            // Check if field is required and empty
            if (rule.required && !field.value.trim() && field.type !== 'file') {
                isValid = false;
                message = "This field is required";
            } else if (field.type === 'file') {
                // Special handling for file inputs
                isValid = rule.validate(field);
                message = typeof rule.message === 'function' ? rule.message(field) : rule.message;
            } else {
                // Validate based on rule
                isValid = rule.validate(field.value, validator.form);
                message = typeof rule.message === 'function' ? rule.message(field.value, validator.form) : rule.message;
            }

            // Show/hide error
            this.showError(field, isValid, message);

            return isValid;
        },

        // Show or hide error message
        showError(field, isValid, message) {
            if (!field || !field.parentNode) return;

            // Find or create error element
            let errorElement = field.parentNode.querySelector('.field-error');

            if (!errorElement) {
                errorElement = document.createElement('div');
                errorElement.className = 'field-error text-red-500 text-sm mt-1 flex items-center gap-1';
                field.parentNode.appendChild(errorElement);
            }

            // Update error element
            if (!isValid && message) {
                errorElement.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>
                <span>${message}</span>
            `;
                errorElement.classList.remove('hidden');
                field.classList.remove('border-gray-200', 'focus:border-[#001f54]');
            } else {
                errorElement.classList.add('hidden');
                field.classList.remove('border-red-500', 'focus:border-red-500');
                field.classList.add('border-gray-200', 'focus:border-[#001f54]');
            }
        },

        // Validate all fields in the current form
        validateAllFields(validator) {
            if (!validator.form) return false;

            let allValid = true;

            // Validate each field
            Object.keys(this.rules).forEach(fieldName => {
                const field = validator.form.querySelector(`[name="${fieldName}"]`);
                if (field) {
                    const isValid = this.validateField(field, validator);
                    if (!isValid) allValid = false;
                }
            });

            return allValid;
        },

        // Update submit button state
        updateSubmitButton(validator) {
            if (!validator.form) return;

            const submitButton = validator.form.querySelector('button[type="submit"]');
            const isValid = this.validateAllFields(validator);

            if (submitButton) {
                if (isValid) {
                    // Enable button
                    submitButton.disabled = false;
                    submitButton.classList.remove('btn-disabled', 'opacity-50', 'cursor-not-allowed');
                    submitButton.classList.add('btn-primary');
                    submitButton.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 6L9 17l-5-5"></path>
                    </svg>
                    Submit
                `;
                } else {
                    // Disable button
                    submitButton.disabled = true;
                    submitButton.classList.add('btn-disabled', 'opacity-50', 'cursor-not-allowed');
                    submitButton.classList.remove('btn-primary');
                    submitButton.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                    Complete All Required Fields
                `;
                }
            }
        },

        // Get form validation status
        isValid(validator) {
            return this.validateAllFields(validator);
        },

        // Clear all validation errors for the current form
        clearAllErrors(validator) {
            if (!validator.form) return;

            validator.form.querySelectorAll('.field-error').forEach(error => {
                error.classList.add('hidden');
            });

            validator.form.querySelectorAll('input, textarea').forEach(field => {
                field.classList.remove('border-red-500', 'focus:border-red-500');
                field.classList.add('border-gray-200', 'focus:border-[#001f54]');
            });
        },

        // Reset the form (for when modal closes)
        resetForm(modalId) {
            const validator = this.modalValidators.get(modalId);
            if (!validator || !validator.form) return;

            // Clear all errors
            this.clearAllErrors(validator);

            // Reset submit button to disabled state
            const submitButton = validator.form.querySelector('button[type="submit"]');
            if (submitButton) {
                submitButton.disabled = true;
                submitButton.classList.add('btn-disabled', 'opacity-50', 'cursor-not-allowed');
                submitButton.classList.remove('btn-primary');
                submitButton.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>
                Complete All Required Fields
            `;
            }

            // Reset form values
            validator.form.reset();

            // Reset file input and preview
            const fileInput = validator.form.querySelector('input[name="reservation_validID"]');
            const previewContainer = validator.modal.querySelector('#imagePreviewContainer');
            if (fileInput) fileInput.value = '';
            if (previewContainer) {
                previewContainer.innerHTML = `
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
            `;
            }
        },

        // Clean up event listeners
        cleanup(modalId) {
            const validator = this.modalValidators.get(modalId);
            if (!validator || !validator.form) return;

            // Clear event listeners to prevent memory leaks
            validator.form.querySelectorAll('input, textarea, select').forEach(field => {
                if (field._validationHandler) {
                    field.removeEventListener('input', field._validationHandler);
                    field.removeEventListener('change', field._validationHandler);
                    field.removeEventListener('blur', field._validationHandler);
                    delete field._validationHandler;
                }
            });

            // Remove from map
            this.modalValidators.delete(modalId);
        }
    };

    // Initialize when DOM is loaded
    document.addEventListener('DOMContentLoaded', () => {
        // Initialize all modals that are already in the DOM
        document.querySelectorAll('dialog[id^="bookroom_"]').forEach(modal => {
            ModalFormValidator.initForModal(modal);
        });

        // Watch for modal openings (using MutationObserver for <dialog> elements)
        const observer = new MutationObserver((mutations) => {
            mutations.forEach((mutation) => {
                if (mutation.type === 'attributes' && mutation.attributeName === 'open') {
                    const modal = mutation.target;
                    if (modal.open && modal.id.startsWith('bookroom_')) {
                        // Initialize validation for this modal
                        setTimeout(() => {
                            ModalFormValidator.initForModal(modal);
                        }, 50);
                    }
                }
            });
        });

        // Observe all modal dialogs
        document.querySelectorAll('dialog[id^="bookroom_"]').forEach(modal => {
            observer.observe(modal, { attributes: true });
        });

        // Handle modal close via cancel button
        document.addEventListener('click', (e) => {
            // Check if it's a cancel button (closes modal)
            const cancelButton = e.target.closest('button[onclick*="close"]');
            if (cancelButton) {
                const modalIdMatch = cancelButton.getAttribute('onclick')?.match(/bookroom_(\d+)/);
                if (modalIdMatch) {
                    const modalId = `bookroom_${modalIdMatch[1]}`;
                    ModalFormValidator.resetForm(modalId);
                }
            }

            // Check if it's a modal open button
            const openButton = e.target.closest('button[onclick*="showModal"]');
            if (openButton) {
                const modalIdMatch = openButton.getAttribute('onclick')?.match(/bookroom_(\d+)/);
                if (modalIdMatch) {
                    const modalId = `bookroom_${modalIdMatch[1]}`;
                    const modal = document.getElementById(modalId);
                    if (modal) {
                        // Initialize validation when modal opens
                        setTimeout(() => {
                            ModalFormValidator.initForModal(modal);
                        }, 100);
                    }
                }
            }
        });

        // Also handle form reset when modal closes via backdrop click or ESC
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                const openModal = document.querySelector('dialog[open][id^="bookroom_"]');
                if (openModal) {
                    ModalFormValidator.resetForm(openModal.id);
                }
            }
        });
    });
</script>
<script>
    // Global variables
    let taxRate = {{ $taxrate }};
    let serviceFeeRate = {{ $servicefee }};
    let additionalFee = {{ $additionalpersonfee }};

    // Function to initialize modal calculations
    function initializeModalCalculations(modal) {
        const roomPrice = parseFloat(modal.querySelector('[name="roomID"]')?.dataset.price || 0);
       const capacityText = modal.querySelector('#roomMaxGuest')?.textContent || '0';
        const maxGuests = parseInt(capacityText.replace(/\D/g, '')) || 1;

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


