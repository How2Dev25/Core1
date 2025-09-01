<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Invoice #{{ $booking->reservationID }}</title>
<style>
    body { font-family: Arial, sans-serif; font-size:12px; color:#333; background:#f4f4f4; margin:0; padding:0; }
    .container { max-width:700px; margin:20px auto; background:#fff; border-radius:8px; overflow:hidden; }
    .header { background:#1e40af; color:#fff; padding:20px; display:flex; justify-content:space-between; align-items:center; }
    .header h1 { margin:0; font-size:20px; }
    .header p { margin:0; color:#facc15; font-style:italic; }
    .section { padding:15px; }
    .section h2 { margin:0 0 5px 0; color:#1e40af; font-size:16px; }
    .section hr { border:none; border-top:2px solid #facc15; margin-bottom:10px; }
    table { width:100%; border-collapse:collapse; margin-top:10px; }
    th, td { padding:8px; border:1px solid #ddd; }
    th { background:#1e40af; color:#fff; text-align:left; }
    .text-right { text-align:right; }
    .total { background:#facc15; color:#1e40af; font-weight:bold; }
    .footer { text-align:center; font-size:10px; color:#666; padding:10px; background:#f4f4f4; }
</style>
</head>
<body>
    <div class="container">

        <!-- Header -->
        <div class="header">
            <div>
                <h1>Soliera Hotel And Restaurant</h1>
                <p>Savor The Stay, Dine With Elegance</p>
            </div>
            <div><strong>INVOICE</strong></div>
        </div>

        <!-- Invoice Info -->
        <div class="section">
            <h2>Invoice Info</h2>
            <hr>
            <p><strong>Invoice Date:</strong> {{ date('Y-m-d') }}</p>
            <p><strong>Receipt:</strong> {{ $booking->reservation_receipt }}</p>
            <p><strong>Booking ID:</strong> {{ $booking->bookingID }}</p>
            <p><strong>Status:</strong> {{$paymentstatus}}</p>
        </div>

        <!-- Guest Info -->
        <div class="section">
            <h2>Guest Information</h2>
            <hr>
            <p><strong>Full Name:</strong> {{ $booking->guestname }}</p>
            <p><strong>Email:</strong> {{ $booking->guestemailaddress }}</p>
            <p><strong>Phone:</strong> {{ $booking->guestphonenumber }}</p>
            <p><strong>Address:</strong> {{ $booking->guestaddress }}</p>
        </div>

        <!-- Booking Details -->
        @php
            use Carbon\Carbon;
            $checkIn = Carbon::parse($booking->reservation_checkin);
            $checkOut = Carbon::parse($booking->reservation_checkout);
            $totalNights = $checkIn->diffInDays($checkOut);
            $subtotal = $booking->roomprice * $totalNights;
            $taxRate = 0.12;
            $taxAmount = $subtotal * $taxRate;
            $serviceFeeRate = 0.02;
            $serviceFee = $subtotal * $serviceFeeRate;
            $totalAmount = $subtotal + $taxAmount + $serviceFee;
        @endphp
        <div class="section">
            <h2>Booking Details</h2>
            <hr>
            <table>
                <thead>
                    <tr>
                        <th>Room</th>
                        <th>Check-in</th>
                        <th>Check-out</th>
                        <th>Nights</th>
                        <th class="text-right">Price</th>
                    </tr>
                </thead>
               <tbody>
    <tr>
        <td>{{ $booking->roomID }} - {{ $booking->roomtype }}</td>
        <td>{{ $checkIn->format('M d, Y') }}</td>
        <td>{{ $checkOut->format('M d, Y') }}</td>
        <td>{{ $totalNights }}</td>
        <td class="text-right">{{ number_format($booking->roomprice, 2) }}</td>
    </tr>
    <tr>
        <td colspan="4" class="text-right">Booked Date</td>
        <td class="text-right">{{ date('M d, Y', strtotime($booking->created_at)) }}</td>
    </tr>
    <tr>
        <td colspan="4" class="text-right">Subtotal</td>
        <td class="text-right">{{ number_format($subtotal, 2) }}</td>
    </tr>
    <tr>
        <td colspan="4" class="text-right">Tax (12%)</td>
        <td class="text-right">{{ number_format($taxAmount, 2) }}</td>
    </tr>
    <tr>
        <td colspan="4" class="text-right">Service Fee (2%)</td>
        <td class="text-right">{{ number_format($serviceFee, 2) }}</td>
    </tr>
    <tr class="total">
        <td colspan="4" class="text-right">Total Amount</td>
        <td class="text-right">{{ number_format($totalAmount, 2) }}</td>
    </tr>
</tbody>
            </table>
        </div>

        <!-- Payment Info -->
        <div class="section">
            <h2>Payment Information</h2>
            <hr>
            <p><strong>Booked Via:</strong> {{ $booking->bookedvia }}</p>
            <p><strong>Payment Method:</strong> {{ $booking->payment_method ?? 'N/A' }}</p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Thank you for choosing Soliera Hotel!</p>
            <p>reservations@solierahotel.com | (123) 456-7890</p>
        </div>

    </div>
</body>
</html>
