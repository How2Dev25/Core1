<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">


    @vite('resources/css/app.css')

    <script src="https://unpkg.com/lucide@latest"></script>

    <title>{{$title}} - Success</title>


</head>



<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f8fafc;
    }

    .confetti {
        position: fixed;
        width: 10px;
        height: 10px;
        opacity: 0;
        z-index: 10;
    }

    .checkmark {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: block;
        stroke-width: 5;
        stroke: #fff;
        stroke-miterlimit: 10;
        box-shadow: 0 0 20px rgba(76, 175, 80, 0.3);
        animation: fill 0.4s ease-in-out 0.4s forwards, scale 0.3s ease-in-out 0.9s both;
    }

    .checkmark-circle {
        stroke-dasharray: 166;
        stroke-dashoffset: 166;
        stroke-width: 5;
        stroke-miterlimit: 10;
        stroke: #4CAF50;
        fill: none;
        animation: stroke 0.6s cubic-bezier(0.650, 0.000, 0.450, 1.000) forwards;
    }

    .checkmark-check {
        transform-origin: 50% 50%;
        stroke-dasharray: 48;
        stroke-dashoffset: 48;
        animation: stroke 0.3s cubic-bezier(0.650, 0.000, 0.450, 1.000) 0.8s forwards;
    }

    @keyframes stroke {
        100% {
            stroke-dashoffset: 0;
        }
    }

    @keyframes scale {

        0%,
        100% {
            transform: none;
        }

        50% {
            transform: scale3d(1.1, 1.1, 1);
        }
    }

    @keyframes fill {
        100% {
            box-shadow: inset 0px 0px 0px 50px #4CAF50;
        }
    }
</style>


<body>


    @include('booking.component.nav')
    <div id="confirmation-section" class="">
        <section class="bg-white min-h-screen flex items-center justify-center p-4 py-8 mt-20">
            <div class="max-w-4xl w-full bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200">

                <!-- Header -->
                <div class="bg-blue-900 p-6 text-center relative">
                    <div class="inline-block mb-2">
                        <div
                            class="bg-white border-2 border-yellow-400 rounded-full w-14 h-14 flex items-center justify-center mx-auto shadow-md p-1">
                            <img src="{{ asset('images/logo/sonly.png') }}" alt="Soliera Hotel Logo"
                                class="w-full h-full object-contain">
                        </div>
                    </div>
                    <h1 class="text-2xl font-bold text-white mb-1">Event Booking Success!</h1>
                    <p class="text-yellow-400 text-sm font-medium">Soliera Hotel And Restaurant</p>
                    <i class="text-gray-200 text-xs mt-1">Savor The Stay, Dine With Elegance</i>
                </div>

                <!-- Grid Content -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 p-4">

                    <!-- Left Column: Event Booking Details -->
                    <div class="space-y-4">
                        <div class="bg-white rounded-lg p-4 border border-gray-200 shadow-sm">
                            <div class="flex items-center gap-2 mb-3">
                                <div
                                    class="bg-blue-900 text-yellow-400 rounded-md w-7 h-7 flex items-center justify-center">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                                <h2 class="text-lg font-bold text-gray-900">Event Booking Details</h2>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <div class="bg-white p-3 rounded-lg border border-gray-200 shadow-sm">
                                    <p class="text-xs text-gray-600 mb-1">Booking ID</p>
                                    <p class="font-bold text-sm text-gray-900">
                                        {{ $reservationevent->event_bookingreceiptID }}
                                    </p>
                                </div>
                                <div class="bg-white p-3 rounded-lg border border-gray-200 shadow-sm">
                                    <p class="text-xs text-gray-600 mb-1">Event Type</p>
                                    <p class="font-bold text-sm text-gray-900">{{ $reservationevent->eventtype_name }}
                                    </p>
                                </div>
                                <div class="bg-white p-3 rounded-lg border border-gray-200 shadow-sm">
                                    <p class="text-xs text-gray-600 mb-1">Event Date</p>
                                    <p class="font-bold text-sm text-green-600">
                                        {{ \Carbon\Carbon::parse($reservationevent->event_checkin)->format('M d, Y') }}
                                    </p>
                                </div>
                                <div class="bg-white p-3 rounded-lg border border-gray-200 shadow-sm">
                                    <p class="text-xs text-gray-600 mb-1">End Date</p>
                                    <p class="font-bold text-sm text-orange-600">
                                        {{ \Carbon\Carbon::parse($reservationevent->event_checkout)->format('M d, Y') }}
                                    </p>
                                </div>
                                <div class="bg-white p-3 rounded-lg border border-gray-200 shadow-sm sm:col-span-2">
                                    <p class="text-xs text-gray-600 mb-1">Event Name</p>
                                    <p class="font-bold text-sm text-gray-900">{{ $reservationevent->event_name }}</p>
                                </div>
                                <div class="bg-white p-3 rounded-lg border border-gray-200 shadow-sm">
                                    <p class="text-xs text-gray-600 mb-1">Number of Guests</p>
                                    <p class="font-bold text-sm text-gray-900">{{ $reservationevent->event_numguest }}
                                    </p>
                                </div>
                                <div class="bg-white p-3 rounded-lg border border-gray-200 shadow-sm">
                                    <p class="text-xs text-gray-600 mb-1">Booked On</p>
                                    <p class="font-bold text-sm text-gray-900">
                                        {{ \Carbon\Carbon::parse($reservationevent->event_bookedate)->format('M d, Y') }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Organizer Information -->
                        <div class="bg-white rounded-lg p-4 border border-gray-200 shadow-sm">
                            <div class="flex items-center gap-2 mb-3">
                                <div
                                    class="bg-blue-900 text-yellow-400 rounded-md w-7 h-7 flex items-center justify-center">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                        </path>
                                    </svg>
                                </div>
                                <h2 class="text-lg font-bold text-gray-900">Organizer Information</h2>
                            </div>
                            <div class="space-y-2">
                                <div class="bg-gray-50 p-2 rounded-md border border-gray-100">
                                    <p class="text-xs text-gray-600">Name</p>
                                    <p class="font-semibold text-sm text-gray-900">
                                        {{ $reservationevent->eventorganizer_name }}
                                    </p>
                                </div>
                                <div class="bg-gray-50 p-2 rounded-md border border-gray-100">
                                    <p class="text-xs text-gray-600">Email</p>
                                    <p class="font-semibold text-sm text-gray-900">
                                        {{ $reservationevent->eventorganizer_email }}
                                    </p>
                                </div>
                                <div class="bg-gray-50 p-2 rounded-md border border-gray-100">
                                    <p class="text-xs text-gray-600">Phone</p>
                                    <p class="font-semibold text-sm text-gray-900">
                                        {{ $reservationevent->eventorganizer_phone }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        @if($reservationevent->event_equipment || $reservationevent->event_specialrequest)
                            <!-- Additional Details -->
                            <div class="bg-white rounded-lg p-4 border border-gray-200 shadow-sm">
                                <div class="flex items-center gap-2 mb-3">
                                    <div
                                        class="bg-blue-900 text-yellow-400 rounded-md w-7 h-7 flex items-center justify-center">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                            </path>
                                        </svg>
                                    </div>
                                    <h2 class="text-lg font-bold text-gray-900">Additional Details</h2>
                                </div>
                                @if($reservationevent->event_equipment)
                                    <div class="mb-3">
                                        <p class="text-xs text-gray-600 mb-1">Equipment Needed</p>
                                        <p class="text-sm text-gray-900 bg-gray-50 p-2 rounded-md border border-gray-100">
                                            {{ $reservationevent->event_equipment }}
                                        </p>
                                    </div>
                                @endif
                                @if($reservationevent->event_specialrequest)
                                    <div>
                                        <p class="text-xs text-gray-600 mb-1">Special Requests</p>
                                        <p class="text-sm text-gray-900 bg-gray-50 p-2 rounded-md border border-gray-100">
                                            {{ $reservationevent->event_specialrequest }}
                                        </p>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>

                    <!-- Right Column: Payment Summary & Info -->
                    <div class="space-y-4">
                        @php
                            $checkin = \Carbon\Carbon::parse($reservationevent->event_checkin);
                            $checkout = \Carbon\Carbon::parse($reservationevent->event_checkout);

                            // Ensure checkout is after check-in
                            if ($checkout->lt($checkin)) {
                                $checkout = $checkin->copy()->addDay();
                            }

                            $days = $checkin->diffInDays($checkout);
                            if ($days == 0) {
                                $days = 1; // Minimum 1 day for same-day events
                            }

                            $total = $reservationevent->event_total_price;
                          @endphp

                        <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-200">
                            <div class="flex items-center gap-2 mb-4">
                                <div
                                    class="bg-blue-900 text-yellow-400 rounded-md w-7 h-7 flex items-center justify-center">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                        </path>
                                    </svg>
                                </div>
                                <h2 class="text-lg font-bold text-gray-900">Payment Summary</h2>
                            </div>
                            <div class="space-y-2 text-xs">
                                <div class="bg-blue-900 rounded-lg p-4">
                                    <div class="flex justify-between items-center mb-2">
                                        <p class="text-white text-sm">Package Price</p>
                                        <p class="text-gray-300 text-xs">({{ $days }} day{{ $days > 1 ? 's' : '' }})</p>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <p class="text-white font-bold text-base">Total Amount</p>
                                        <p class="font-bold text-yellow-400 text-2xl">₱{{ number_format($total, 2) }}
                                        </p>
                                    </div>
                                </div>
                                <p class="text-xs text-gray-500 text-center pt-2">All-inclusive event package</p>
                            </div>
                            <div class="mt-3 pt-3 border-t border-gray-200">
                                <div class="flex justify-between items-center text-xs">
                                    <p class="text-gray-600">Payment Status</p>
                                    <p
                                        class="font-semibold text-sm {{ $reservationevent->event_paymentstatus == 'Paid' ? 'text-green-600' : 'text-orange-600' }}">
                                        {{ $reservationevent->event_paymentstatus }}
                                    </p>
                                </div>
                                <div class="flex justify-between items-center text-xs mt-2">
                                    <p class="text-gray-600">Payment Method</p>
                                    <p class="font-semibold text-sm text-gray-900">
                                        {{ $reservationevent->event_paymentmethod }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- What's Next -->
                        <div class="bg-white rounded-lg p-4 border border-gray-200 shadow-sm">
                            <div class="flex items-center gap-2 mb-3">
                                <div
                                    class="bg-blue-900 text-yellow-400 rounded-md w-7 h-7 flex items-center justify-center">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <h2 class="text-lg font-bold text-gray-900">What's Next?</h2>
                            </div>
                            <ul class="space-y-2 text-xs text-gray-700">
                                <li class="flex items-start gap-2 bg-gray-50 p-2 rounded-md border border-gray-100">
                                    <span class="text-green-600 font-bold flex-shrink-0">✓</span>
                                    <span>A confirmation email has been sent to the organizer's email address</span>
                                </li>
                                <li class="flex items-start gap-2 bg-gray-50 p-2 rounded-md border border-gray-100">
                                    <span class="text-green-600 font-bold flex-shrink-0">✓</span>
                                    <span>Please present your Booking ID when setting up for the event</span>
                                </li>
                                <li class="flex items-start gap-2 bg-gray-50 p-2 rounded-md border border-gray-100">
                                    <span class="text-green-600 font-bold flex-shrink-0">✓</span>
                                    <span>Our events team will contact you 48 hours before the event date</span>
                                </li>
                                <li class="flex items-start gap-2 bg-gray-50 p-2 rounded-md border border-gray-100">
                                    <span class="text-green-600 font-bold flex-shrink-0">✓</span>
                                    <span>Need changes? Contact our support team available 24/7</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Contact Information -->
                        <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-200">
                            <div class="flex items-center gap-2 mb-3">
                                <div
                                    class="bg-blue-900 text-yellow-400 rounded-md w-7 h-7 flex items-center justify-center">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                        </path>
                                    </svg>
                                </div>
                                <h2 class="text-sm font-bold text-gray-900">Need Help?</h2>
                            </div>
                            <p class="text-xs text-gray-600 mb-3">Our events team is here to make your event perfect.
                            </p>
                            <div class="space-y-1 text-xs">
                                <p class="text-gray-700">📞 Phone: <span class="text-gray-600">Available 24/7</span></p>
                                <p class="text-gray-700">✉️ Email: <span class="text-gray-600">events@soliera.com</span>
                                </p>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex flex-col sm:flex-row gap-3">
                            <a href="/"
                                class="bg-blue-900 hover:bg-blue-800 text-white font-semibold py-3 px-6 rounded-lg shadow-sm hover:shadow-md transition-all duration-300 text-center text-sm border border-blue-900">
                                ← Back to Home
                            </a>
                        </div>
                    </div>

                </div>

                <!-- Footer -->
                <div class="bg-blue-900 p-4 text-center border-t border-blue-800">
                    <p class="text-white font-semibold text-sm mb-1">Thank You for Choosing Soliera!</p>
                    <p class="text-gray-200 text-xs">We look forward to making your event memorable</p>
                </div>

            </div>
        </section>
    </div>

    @include('landing.footer')
</body>

<script src="https://cdn.jsdelivr.net/npm/dom-to-image-more@2.6.0/dist/dom-to-image-more.min.js"></script>

<!-- Your script -->


@include('javascriptfix.soliera_js')

<script src="{{asset('javascript/photouploadglobal.js')}}"></script>




</html>