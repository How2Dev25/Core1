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

    <title>{{$title}} - Missing RFID</title>

    <script>
    const rfidBookings = @json($rfidbookings);
</script>
</head>

<body>
    @include('booking.component.nav');

<section class="container mx-auto px-4 py-8 mt-10">

       @session('success')
    <div id="successToast" class="fixed top-4 right-4 z-50">
        <div class="bg-green-500 text-white px-6 py-4 rounded-lg shadow-2xl flex items-center gap-3 animate-slide-in">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <div>
                <p class="font-semibold">Success!</p>
                <p class="text-sm">{{ $value }}</p>
            </div>
        </div>
    </div>
    <script>
        const successToast = document.getElementById('successToast');
if (successToast) {
    setTimeout(() => {
        successToast.style.opacity = '0';
        successToast.style.transform = 'translateX(100px)';
        successToast.style.transition = 'all 0.4s ease-out';
        setTimeout(() => {
            successToast.remove();
        }, 400);
    }, 5000);
}
    </script>
    @endsession

    
    <!-- HEADER -->
    <div class="text-center mb-8">
        <h1 class="text-2xl md:text-3xl font-bold text-[#001f54] mb-2">RFID Management System</h1>
        <p class="text-sm md:text-base text-gray-600">Report missing or lost RFID cards for your booking</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- LEFT: SEARCH FORM -->
        <div class="bg-white rounded-xl shadow-lg p-4 md:p-6 h-fit">
            <div class="flex items-center gap-3 mb-4">
                <svg class="w-5 h-5 md:w-6 md:h-6 text-[#001f54]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <h2 class="text-base md:text-lg font-bold text-[#001f54]">Report Missing RFID</h2>
            </div>

            <div class="bg-blue-50 border-l-4 border-blue-500 p-3 mb-4 rounded">
                <p class="text-xs md:text-sm text-blue-800">
                    <strong>Note:</strong> Enter your booking ID to retrieve your reservation details and report a missing RFID card.
                </p>
            </div>

            <form id="rfidSearchForm" class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Booking ID <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        id="bookingIDInput"
                        placeholder="e.g., BK001, BK002"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#001f54] focus:border-transparent transition"
                        required
                    >
                </div>

                <button
                    type="submit"
                    id="searchBtn"
                    class="w-full bg-[#001f54] hover:bg-[#001a45] text-white font-semibold py-3 rounded-lg transition duration-200 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <span id="searchBtnText">Search Booking</span>
                </button>
            </form>

            <!-- HELP SECTION -->
            <div class="mt-6 pt-6 border-t border-gray-200">
                <h3 class="text-sm font-semibold text-gray-700 mb-2">Need Help?</h3>
                <p class="text-xs text-gray-600 mb-2">Contact our front desk:</p>
                <p class="text-xs text-gray-800">📞 +63 123 456 7890</p>
                <p class="text-xs text-gray-800">✉️ support@hotel.com</p>
            </div>
        </div>

        <!-- RIGHT: RESULTS AREA -->
        <div class="lg:col-span-2">
            <!-- LOADING STATE -->
            <div id="loadingState" class="hidden bg-white rounded-xl shadow-lg p-8 md:p-12 text-center">
                <div class="loader animate-spin mx-auto mb-4"></div>
                <p class="text-sm md:text-base text-gray-600 font-semibold animate-pulse">Searching for your booking...</p>
                <p class="text-xs md:text-sm text-gray-500 mt-2">Please wait a moment</p>
            </div>

            <!-- BOOKING DETAILS -->
            <div id="bookingResult" class="hidden bg-white rounded-xl shadow-lg p-4 md:p-6 slide-in">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6">
                    <h3 class="text-lg md:text-xl font-bold text-[#001f54]">Booking Information</h3>
                    <span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-xs font-semibold rounded-full w-fit">
                        RFID Missing
                    </span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- ROOM IMAGE -->
                    <div>
                        <div class="relative">
                            <img
                                id="roomImage"
                                src=""
                                alt="Room Image"
                                class="w-full h-48 md:h-64 object-cover rounded-lg border-2 border-gray-200 shadow-md">
                            <div class="absolute top-3 left-3 bg-white px-3 py-1 rounded-full shadow-md">
                                <p class="text-xs font-semibold text-gray-700" id="roomLabel">Room</p>
                            </div>
                        </div>
                    </div>

                    <!-- DETAILS -->
                    <div class="space-y-3 md:space-y-4">
                        <!-- Booking ID -->
                        <div class="bg-gray-50 p-3 md:p-4 rounded-lg">
                            <p class="text-xs text-gray-500 mb-1">Booking ID</p>
                            <p class="text-base md:text-lg font-bold text-[#001f54]" id="detailBookingID"></p>
                        </div>

                        <!-- Room -->
                        <div class="bg-gray-50 p-3 md:p-4 rounded-lg">
                            <p class="text-xs text-gray-500 mb-1">Room Number</p>
                            <p class="text-sm md:text-base font-semibold text-gray-800" id="detailRoom"></p>
                        </div>

                        <!-- RFID Status -->
                        <div class="bg-red-50 p-3 md:p-4 rounded-lg border border-red-200">
                            <p class="text-xs text-gray-500 mb-1">RFID Card Status</p>
                            <p class="text-sm md:text-base font-bold text-red-600" id="detailRFID"></p>
                        </div>

                        <!-- Dates -->
                        <div class="grid grid-cols-2 gap-3">
                            <div class="bg-gray-50 p-3 rounded-lg">
                                <p class="text-xs text-gray-500 mb-1">Check-in</p>
                                <p class="text-xs md:text-sm font-semibold text-gray-800" id="detailCheckin"></p>
                            </div>
                            <div class="bg-gray-50 p-3 rounded-lg">
                                <p class="text-xs text-gray-500 mb-1">Check-out</p>
                                <p class="text-xs md:text-sm font-semibold text-gray-800" id="detailCheckout"></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ACTION SECTION -->
                <div class="mt-6 pt-6 border-t border-gray-200">
    <form id="reportForm" action="/submitMissingRFID" method="POST">
        @csrf
        <input type="hidden" id="doorlockIDInput" name="doorlockID" value="">
        
        <button type="button" onclick="document.getElementById('confirmModal').showModal()" class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-3 md:py-3.5 rounded-lg transition duration-200 flex items-center justify-center gap-2 shadow-md">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
            </svg>
            Submit Missing RFID Report
        </button>
    </form>
</div>
            </div>

            <!-- EMPTY STATE -->
            <div id="noResult" class="hidden bg-white rounded-xl shadow-lg p-8 md:p-12 text-center slide-in">
                <svg class="w-16 h-16 md:w-20 md:h-20 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="text-lg md:text-xl font-bold text-gray-700 mb-2">No Booking Found</h3>
                <p class="text-sm md:text-base text-gray-500 mb-6">We couldn't find a booking with that ID. Please check and try again.</p>
                <button onclick="document.getElementById('bookingIDInput').focus()" class="text-[#001f54] font-semibold hover:underline text-sm md:text-base">
                    Try Another Search →
                </button>
            </div>

            <!-- INITIAL STATE -->
            <div id="initialState" class="bg-white rounded-xl shadow-lg p-8 md:p-12 text-center">
                <svg class="w-20 h-20 md:w-24 md:h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <h3 class="text-lg md:text-xl font-semibold text-gray-700 mb-2">Search for Your Booking</h3>
                <p class="text-sm md:text-base text-gray-500">Enter your booking ID to get started</p>
            </div>
        </div>
    </div>

    <!-- CONFIRMATION MODAL - DaisyUI -->
    <dialog id="confirmModal" class="modal">
        <div class="modal-box max-w-md"> 
            <div class="text-center mb-6">
                <div class="w-16 h-16 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Confirm RFID Report</h3>
                <p class="text-sm text-gray-600">Are you sure you want to report this RFID as missing?</p>
            </div>

            <div class="bg-amber-50 p-4 rounded-lg mb-6">
                <h4 class="text-sm font-semibold text-gray-800 mb-3 flex items-center gap-2">
                    <svg class="w-5 h-5 text-amber-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    What happens next?
                </h4>
                <ul class="text-xs text-gray-700 space-y-2">
                    <li class="flex items-start gap-2">
                        <span class="text-amber-600 font-bold flex-shrink-0">1.</span>
                        <span>Your report will be submitted to the front desk</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-amber-600 font-bold flex-shrink-0">2.</span>
                        <span>A replacement RFID card will be issued</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-amber-600 font-bold flex-shrink-0">3.</span>
                        <span>Lost card will be deactivated for security</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-amber-600 font-bold flex-shrink-0">4.</span>
                        <span>Replacement fee may apply (check with reception)</span>
                    </li>
                </ul>
            </div>

            <div class="modal-action">
                <form method="dialog" class="flex gap-3 w-full">
                    <button class="btn btn-outline flex-1">Cancel</button>
                    <button onclick="submitForm()" id="confirmBtn" type="button" class="btn btn-error flex-1">Confirm & Submit</button>
                </form>
            </div>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>
</section>





<style>
    @keyframes spin {
        to { transform: rotate(360deg); }
    }
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .animate-spin {
        animation: spin 1s linear infinite;
    }
    .animate-pulse {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
    .slide-in {
        animation: slideIn 0.5s ease-out;
    }
    .loader {
        border: 3px solid #f3f4f6;
        border-top: 3px solid #001f54;
        border-radius: 50%;
        width: 40px;
        height: 40px;
    }
    @keyframes modalFadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }
    @keyframes modalSlideIn {
        from {
            opacity: 0;
            transform: scale(0.95) translateY(-20px);
        }
        to {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }
    #confirmModal {
        animation: modalFadeIn 0.3s ease-out;
    }
    #confirmModal .modal-content {
        animation: modalSlideIn 0.3s ease-out;
    }
</style>


    @include('landing.footer')

    <script>
        function submitForm(){
            const form = document.getElementById('reportForm');

            form.submit();
        }
    </script>


@include('javascriptfix.soliera_js')

<script src="{{asset('javascript/photouploadglobal.js')}}"></script>

<script>
document.getElementById('rfidSearchForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const bookingID = document.getElementById('bookingIDInput').value.trim();
    const resultBox = document.getElementById('bookingResult');
    const noResult = document.getElementById('noResult');
    const loadingState = document.getElementById('loadingState');
    const initialState = document.getElementById('initialState');

    // Hide all states
    resultBox.classList.add('hidden');
    noResult.classList.add('hidden');
    initialState.classList.add('hidden');
    
    // Show loading
    loadingState.classList.remove('hidden');

    // Simulate search delay
    setTimeout(() => {
        const booking = rfidBookings.find(item => item.bookingID == bookingID);

        loadingState.classList.add('hidden');

        if (!booking) {
            noResult.classList.remove('hidden');
            return;
        }

        resultBox.classList.remove('hidden');

        // Populate data
        document.getElementById('detailBookingID').textContent = booking.bookingID;
        document.getElementById('detailRoom').textContent = booking.roomID ?? 'N/A';
        document.getElementById('detailRFID').textContent = booking.rfid ?? 'Missing';
        document.getElementById('detailCheckin').textContent = booking.reservation_checkin ?? 'N/A';
        document.getElementById('detailCheckout').textContent = booking.reservation_checkout ?? 'N/A';
        document.getElementById('roomLabel').textContent = 'Room ' + (booking.roomID ?? 'N/A');

        // Room Image
        document.getElementById('roomImage').src = booking.roomphoto ? `${booking.roomphoto}` : '/images/no-image.png';

        // Set doorlockID in hidden input
        document.getElementById('doorlockIDInput').value = booking.doorlockID ?? '';
    }, 1500);
});

// Open modal button
document.getElementById('openModalBtn').addEventListener('click', function() {
    document.getElementById('confirmModal').showModal();
});

// Confirm button - submit the form
document.getElementById('confirmBtn').addEventListener('click', function() {
    document.getElementById('confirmModal').close();
    document.getElementById('reportForm').submit();
});
</script>









</html>