<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $booking->reservationID }}</title>
    <style>
        body { font-family: 'Arial', sans-serif; margin: 0; padding: 0; color: #333; }
        .container { max-width: 800px; margin: 10px auto; background: white; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .header { background: #001f54; color: white; padding: 15px 20px; display: flex; justify-content: space-between; }
        .hotel-name { font-size: 20px; font-weight: bold; }
        .invoice-title { color: #F7B32B; text-align: right; }
        .divider { height: 2px; background: #F7B32B; margin: 5px 0; }
        .section { padding: 15px 20px; }
        .section-title { color: #001f54; font-weight: bold; margin-bottom: 10px; }
        .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; }
        .label { font-size: 12px; color: #666; margin-bottom: 3px; }
        .value { font-weight: 500; }
        table { width: 100%; border-collapse: collapse; margin: 10px 0; }
        th { background: #001f54; color: white; text-align: left; padding: 8px 10px; }
        td { padding: 8px 10px; border-bottom: 1px solid #eee; }
        .total-row { background: #F7B32B; color: #001f54; font-weight: bold; }
        .footer { background: #f5f5f5; padding: 10px 20px; text-align: center; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div>
                <div class="hotel-name">SOLIERA HOTEL</div>
              
            </div>
            <div class="invoice-title">
                <div style="font-size: 18px;">INVOICE</div>
                <div>{{ $booking->reservation_receipt }}</div>
            </div>
        </div>

        <!-- Invoice Info -->
        <div class="section" style="background: #f9f9f9; padding: 10px 20px;">
            <div class="grid-2">
                <div>
                    <div class="label">INVOICE DATE</div>
                    <div class="value">{{ date('Y-m-d') }}</div>
                </div>
                <div style="text-align: right;">
                    <div class="label">STATUS</div>
                    <div class="value" style="color: #28a745;">Paid</div>
                </div>
            </div>
        </div>

        <!-- Guest Information -->
        <div class="section">
            <div class="section-title">GUEST INFORMATION</div>
            <div class="divider"></div>
            <div class="grid-2">
                <div>
                    <div class="label">FULL NAME</div>
                    <div class="value">{{ $booking->guestname }}</div>
                </div>
                <div>
                    <div class="label">EMAIL</div>
                    <div class="value">{{ $booking->guestemailaddress }}</div>
                </div>
                <div>
                    <div class="label">PHONE</div>
                    <div class="value">{{ $booking->guestphonenumber }}</div>
                </div>
                <div>
                    <div class="label">ADDRESS</div>
                    <div class="value">{{ $booking->guestaddress }}</div>
                </div>
            </div>
        </div>

        <!-- Booking Details -->
        <div class="section">
            <div class="section-title">BOOKING DETAILS</div>
            <div class="divider"></div>
            <table>
                <thead>
                    <tr>
                        <th>Room</th>
                        <th>Check-in</th>
                        <th>Check-out</th>
                        <th>Nights</th>
                        <th style="text-align: right;">Price</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        use Carbon\Carbon;
                        $checkIn = Carbon::parse($booking->reservation_checkin);
                        $checkOut = Carbon::parse($booking->reservation_checkout);
                        $totalNights = $checkIn->diffInDays($checkOut);
                        $subtotal = $booking->roomprice * $totalNights;
                        $taxRate = 0.12;
                        $taxAmount = $subtotal * $taxRate;
                        $totalAmount = $subtotal + $taxAmount;
                    @endphp
                    <tr>
                        <td>{{ $booking->roomID }} - {{ $booking->roomtype }}</td>
                        <td>{{ $checkIn->format('M d, Y') }}</td>
                        <td>{{ $checkOut->format('M d, Y') }}</td>
                        <td>{{ $totalNights }}</td>
                        <td style="text-align: right;">{{ number_format($booking->roomprice, 2) }}</td>
                    </tr>
                    <tr>
                        <td colspan="4" style="text-align: right; font-weight: bold;">Subtotal</td>
                        <td style="text-align: right;">{{ number_format($subtotal, 2) }}</td>
                    </tr>
                    <tr>
                        <td colspan="4" style="text-align: right; font-weight: bold;">Tax (12%)</td>
                        <td style="text-align: right;">{{ number_format($taxAmount, 2) }}</td>
                    </tr>
                    <tr class="total-row">
                        <td colspan="4" style="text-align: right;">TOTAL AMOUNT</td>
                        <td style="text-align: right;">{{ number_format($totalAmount, 2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Payment Method -->
        <div class="section">
            <div class="section-title">PAYMENT METHOD</div>
            <div class="divider"></div>
            <div style="padding: 10px; background: #f9f9f9; border-radius: 4px;">
                {{ $booking->bookedvia }}
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div style="margin-bottom: 5px;">Thank you for choosing Soliera Hotel</div>
            <div>reservations@solierahotel.com | (123) 456-7890</div>
        </div>
    </div>
</body>
</html>