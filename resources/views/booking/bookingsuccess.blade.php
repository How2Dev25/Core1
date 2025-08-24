<!DOCTYPE html>
<html lang="en" data-theme ="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    @vite('resources/css/app.css')
 
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <title>{{$title}} - Room Management</title>

    
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
            100% { stroke-dashoffset: 0; }
        }
        
        @keyframes scale {
            0%, 100% { transform: none; }
            50% { transform: scale3d(1.1, 1.1, 1); }
        }
        
        @keyframes fill {
            100% { box-shadow: inset 0px 0px 0px 50px #4CAF50; }
        }
    </style>

<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">
    <!-- Confetti animation elements -->
   
    
    <div class="max-w-2xl w-full bg-white rounded-xl shadow-lg overflow-hidden transform transition-all duration-500  ">
        <!-- Header with gradient background -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 p-6 text-white text-center">
            <div class="flex justify-center mb-4">
                <svg class="checkmark w-16 h-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                    <circle class="checkmark-circle" cx="26" cy="26" r="25" fill="none"/>
                    <path class="checkmark-check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
                </svg>
            </div>
            <h1 class="text-2xl font-bold">Booking Confirmed!</h1>
            <p class="opacity-90 mt-2">Thank you for your reservation</p>
        </div>
        
        <!-- Content section -->
        <div class="p-6 space-y-6">
            <!-- Message -->
            <div class="text-center p-4 bg-blue-50 rounded-lg border border-blue-100 animate-fade-in-up">
                <i class="fas fa-envelope-open-text text-blue-500 text-3xl mb-3"></i>
                <h2 class="text-lg font-semibold text-gray-800">Please check your email</h2>
                <p class="text-gray-600">We've sent a confirmation email with all the details of your booking.</p>
            </div>
            
            <!-- Booking details -->
            <div class="bg-gray-50 rounded-xl p-5 border border-gray-200 shadow-sm animate-fade-in-up">
                <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-receipt text-indigo-600 mr-2"></i>
                    Booking Details
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <p class="text-sm text-gray-500">Booking ID</p>
                        <p class="font-semibold text-gray-800">#{{ $reservation->bookingID }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Room Number</p>
                        <p class="font-semibold text-gray-800">#{{ $reservation->roomID }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Check-in Date</p>
                        <p class="font-semibold text-gray-800">{{ \Carbon\Carbon::parse($reservation->checkInDate)->format('M d, Y') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Check-out Date</p>
                        <p class="font-semibold text-gray-800">{{ \Carbon\Carbon::parse($reservation->checkOutDate)->format('M d, Y') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Total Guests</p>
                        <p class="font-semibold text-gray-800">{{ $reservation->totalGuests }}</p>
                    </div>
                </div>

                <!-- Price breakdown -->
                @php
                    $subtotal = $roomprice;
                    $vat = $subtotal * 0.12;
                    $serviceFee = $subtotal * 0.02;
                    $total = $subtotal + $vat + $serviceFee;
                @endphp

                <div class="bg-white shadow-md rounded-lg p-4 space-y-2">
                    <div class="flex justify-between">
                        <p class="text-sm text-gray-500">Subtotal</p>
                        <p class="font-semibold text-gray-800">₱{{ number_format($subtotal, 2) }}</p>
                    </div>
                    <div class="flex justify-between">
                        <p class="text-sm text-gray-500">VAT (12%)</p>
                        <p class="font-semibold text-gray-800">₱{{ number_format($vat, 2) }}</p>
                    </div>
                    <div class="flex justify-between">
                        <p class="text-sm text-gray-500">Service Fee (2%)</p>
                        <p class="font-semibold text-gray-800">₱{{ number_format($serviceFee, 2) }}</p>
                    </div>
                    <hr>
                    <div class="flex justify-between">
                        <p class="text-sm font-bold text-gray-700">Total Amount</p>
                        <p class="text-lg font-bold text-gray-900">₱{{ number_format($total, 2) }}</p>
                    </div>
                </div>
            </div>
            
            <!-- Additional info -->
            <div class="bg-amber-50 rounded-xl p-5 border border-amber-200 animate-fade-in-up">
                <h2 class="text-lg font-semibold text-amber-800 flex items-center">
                    <i class="fas fa-info-circle mr-2"></i>
                    What's Next?
                </h2>
                <ul class="mt-3 space-y-2 text-amber-700">
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-amber-600 mt-1 mr-2"></i>
                        <span>You will receive an email confirmation shortly</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-amber-600 mt-1 mr-2"></i>
                        <span>Present your booking ID at the front desk upon arrival</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-amber-600 mt-1 mr-2"></i>
                        <span>Contact us if you have any questions or special requests</span>
                    </li>
                </ul>
            </div>
            
            <!-- Action buttons -->
            <div class="flex flex-col sm:flex-row gap-3 pt-4 animate-fade-in-up">
                <button class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white py-3 px-4 rounded-lg font-medium transition duration-300 flex items-center justify-center">
                    <i class="fas fa-print mr-2"></i>
                    Print Confirmation
                </button>
                <button class="flex-1 border border-gray-300 hover:bg-gray-50 text-gray-700 py-3 px-4 rounded-lg font-medium transition duration-300 flex items-center justify-center">
                    <i class="fas fa-home mr-2"></i>
                    Back to Home
                </button>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="bg-gray-100 p-4 text-center text-gray-500 text-sm">
            <p>
                Need assistance? Contact us at 
                <a href="mailto:support@hotel.com" class="text-indigo-600 hover:underline">support@hotel.com</a> 
                or call 
                <a href="tel:+1234567890" class="text-indigo-600 hover:underline">+1 (234) 567-890</a>
            </p>
        </div>
    </div>




</body>


  @include('javascriptfix.soliera_js')

  <script src="{{asset('javascript/photouploadglobal.js')}}"></script>
  
</html>