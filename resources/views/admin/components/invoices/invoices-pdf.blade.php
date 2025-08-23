<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Invoice #{{ $booking->reservationID }}</title>

<!-- Tailwind CDN -->
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 font-sans">
    <div class="max-w-3xl mx-auto my-6 bg-white shadow-lg rounded-lg overflow-hidden">
        
        <!-- Header -->
        <div class="flex justify-between items-center bg-blue-900 text-white px-6 py-4">
            <div class="flex items-center space-x-4">
                <img src="{{ $logoPath }}" alt="Hotel Logo" class="h-28 w-28 object-contain">
                <div>
                    <h1 class="text-2xl font-bold tracking-wide text-white">Soliera Hotel And Restaurant</h1>
                    <p class="text-sm text-yellow-400 italic">Savor The Stay, Dine With Elegance</p>
                </div>
            </div>
            <div class="text-right flex flex-col gap-2">
                <p class="text-yellow-400 font-bold text-lg">INVOICE</p>
            </div>
        </div>

        <!-- Invoice Info -->
        <div class="bg-gray-50 px-6 py-3 flex justify-between text-sm">
            <div>
                <p class="text-gray-500">Invoice Date</p>
                <p class="font-medium">{{ date('Y-m-d') }}</p>
            </div>
            <div class="text-center">
                <p class="text-gray-500">Receipt & Booking</p>
                <p class="font-medium text-gray-800">{{ $booking->reservation_receipt }}</p>
                <p class="text-xs text-gray-600">Booking ID: {{ $booking->bookingID }}</p>
            </div>
            <div class="text-right">
                <p class="text-gray-500">Status</p>
                <p class="font-semibold text-green-600">Paid</p>
            </div>
        </div>

        <!-- Guest Info -->
        <div class="px-6 py-4">
            <h2 class="text-blue-900 font-bold mb-2">Guest Information</h2>
            <hr class="border-yellow-400 mb-4">
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div>
                    <p class="text-gray-500">Full Name</p>
                    <p class="font-medium">{{ $booking->guestname }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Email</p>
                    <p class="font-medium">{{ $booking->guestemailaddress }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Phone</p>
                    <p class="font-medium">{{ $booking->guestphonenumber }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Address</p>
                    <p class="font-medium">{{ $booking->guestaddress }}</p>
                </div>
            </div>
        </div>

        <!-- Booking Details -->
        <div class="px-6 py-4">
            <h2 class="text-blue-900 font-bold mb-2">Booking Details</h2>
            <hr class="border-yellow-400 mb-4">
           @php
    use Carbon\Carbon;
    $checkIn = Carbon::parse($booking->reservation_checkin);
    $checkOut = Carbon::parse($booking->reservation_checkout);
    $totalNights = $checkIn->diffInDays($checkOut);
    $subtotal = $booking->roomprice * $totalNights;
    $taxRate = 0.12;
    $taxAmount = $subtotal * $taxRate;
    $serviceFeeRate = 0.02; // 2% service fee
    $serviceFee = $subtotal * $serviceFeeRate;
    $totalAmount = $subtotal + $taxAmount + $serviceFee;
@endphp
         <div class="overflow-x-auto">
    <table class="w-full text-sm border border-gray-200">
        <thead>
            <tr class="bg-blue-900 text-white">
                <th class="px-3 py-2 text-left">Room</th>
                <th class="px-3 py-2 text-left">Check-in</th>
                <th class="px-3 py-2 text-left">Check-out</th>
                <th class="px-3 py-2 text-left">Nights</th>
                <th class="px-3 py-2 text-right">Price</th>
            </tr>
        </thead>
        <tbody>
            <tr class="border-b">
                <td class="px-3 py-2">{{ $booking->roomID }} - {{ $booking->roomtype }}</td>
                <td class="px-3 py-2">{{ $checkIn->format('M d, Y') }}</td>
                <td class="px-3 py-2">{{ $checkOut->format('M d, Y') }}</td>
                <td class="px-3 py-2">{{ $totalNights }}</td>
                <td class="px-3 py-2 text-right">₱{{ number_format($booking->roomprice, 2) }}</td>
            </tr>
            <tr>
                <td colspan="4" class="text-right font-semibold px-3 py-2">Subtotal</td>
                <td class="px-3 py-2 text-right">₱{{ number_format($subtotal, 2) }}</td>
            </tr>
            <tr>
                <td colspan="4" class="text-right font-semibold px-3 py-2">Tax (12%)</td>
                <td class="px-3 py-2 text-right">₱{{ number_format($taxAmount, 2) }}</td>
            </tr>
            <tr>
                <td colspan="4" class="text-right font-semibold px-3 py-2">Service Fee (2%)</td>
                <td class="px-3 py-2 text-right">₱{{ number_format($serviceFee, 2) }}</td>
            </tr>
            <tr class="bg-yellow-400 text-blue-900 font-bold">
                <td colspan="4" class="text-right px-3 py-2">Total Amount</td>
                <td class="px-3 py-2 text-right">₱{{ number_format($totalAmount, 2) }}</td>
            </tr>
        </tbody>
    </table>
</div>
        </div>

        <!-- Payment Info -->
        <div class="px-6 py-4">
            <h2 class="text-blue-900 font-bold mb-2">Payment Information</h2>
            <hr class="border-yellow-400 mb-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="p-3 bg-gray-50 rounded-md text-sm">
                    <strong>Booked Via:</strong> {{ $booking->bookedvia }}
                </div>
                <div class="p-3 bg-gray-50 rounded-md text-sm">
                    <strong>Payment Method:</strong> {{ $booking->payment_method ?? 'N/A' }}
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="bg-gray-100 px-6 py-4 text-center text-xs text-gray-600">
            <p class="mb-1">Thank you for choosing Soliera Hotel!</p>
            <p>reservations@solierahotel.com | (123) 456-7890</p>
        </div>
    </div>
</body>
</html>
