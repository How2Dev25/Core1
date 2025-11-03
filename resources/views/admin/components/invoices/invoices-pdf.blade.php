<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $booking->reservationID }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            color: #333;
            background: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 700px;
            margin: 10px auto;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            padding: 10px;
        }

        .header {
            background: #1e40af;
            color: #fff;
            padding: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            margin: 0;
            font-size: 16px;
        }

        .header p {
            margin: 0;
            color: #facc15;
            font-style: italic;
            font-size: 10px;
        }

        .section {
            padding: 8px 0;
        }

        .section h2 {
            margin: 0 0 5px 0;
            color: #1e40af;
            font-size: 14px;
        }

        .section hr {
            border: none;
            border-top: 1px solid #facc15;
            margin: 5px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
            font-size: 10px;
        }

        th,
        td {
            padding: 5px;
            border: 1px solid #ddd;
        }

        th {
            background: #1e40af;
            color: #fff;
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        .total {
            background: #facc15;
            color: #1e40af;
            font-weight: bold;
        }

        .footer {
            text-align: center;
            font-size: 9px;
            color: #666;
            padding: 8px;
            background: #f4f4f4;
        }

        /* --- Print & PDF Settings --- */
        @page {
            size: A4;
            margin: 10mm;
        }

        @media print {
            body {
                margin: 0;
                background: #fff;
            }

            .container {
                page-break-before: avoid;
                page-break-after: avoid;
                page-break-inside: avoid;
            }

            table,
            tr,
            td,
            th {
                page-break-inside: avoid !important;
            }
        }
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

// Room totals
$subtotal = $roomSubtotal;
$taxAmount = $vat;
$serviceFee = $roomserviceFee;
$roomTotal = $hotelTotal;

// Restaurant totals
$orderTotal = 0;
if (isset($orders[$booking->bookingID])) {
    foreach ($orders[$booking->bookingID] as $order) {
        $orderTotal += $order->menu_price * $order->order_quantity;
    }
}

// Grand total
$grandTotal = $roomTotal + $orderTotal;
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
                        <td class="text-right">{{ date('Y-m-d') }}</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-right">Subtotal</td>
                        <td class="text-right">{{ number_format($subtotal, 2) }}</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-right">Tax ({{$taxRatedynamic}})</td>
                        <td class="text-right">{{ number_format($taxAmount, 2) }}</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-right">Service Fee ({{$serviceFeedynamic}})</td>
                        <td class="text-right">{{ number_format($serviceFee, 2) }}</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-right">Loyalty Discount </td>
                        <td class="text-right">{{$booking->loyalty_discount}}</td>
                    </tr>
                    <tr class="total">
                        <td colspan="4" class="text-right">Room Total</td>
                        <td class="text-right">{{ number_format($roomTotal, 2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Restaurant Orders -->
        @if($orders->isNotEmpty())
            <div class="section">
                <h2>Restaurant Orders</h2>
                <hr>
                <table>
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th class="text-right">Price</th>
                            <th class="text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            @php
        $lineTotal = $order->menu_price * $order->order_quantity;
                            @endphp
                            <tr>
                                <td>{{ $order->menu_name }}</td>
                                <td>{{ $order->order_quantity }}</td>
                                <td class="text-right">{{ number_format($order->menu_price, 2) }}</td>
                                <td class="text-right">{{ number_format($lineTotal, 2) }}</td>
                            </tr>
                        @endforeach
                        <tr class="total">
                            <td colspan="3" class="text-right">Restaurant Total</td>
                            <td class="text-right">{{ number_format($restaurantTotal, 2) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endif
        <!-- Grand Total -->
        <div class="section">
            <h2>Grand Total</h2>
            <hr>
            <table>
                <tbody>
                    <tr>
                        <td colspan="4" class="text-right">Room Total</td>
                        <td class="text-right">{{ number_format($hotelTotal, 2) }}</td>
                    </tr>
                    @if($orders->isNotEmpty())
                        <tr>
                            <td colspan="4" class="text-right">Restaurant Total</td>
                            <td class="text-right">{{ number_format($restaurantTotal, 2) }}</td>
                        </tr>
                    @endif
                    <tr class="total">
                        <td class="text-right" colspan="4">Grand Total</td>
                        <td class="text-right">{{ number_format($hotelTotal + $restaurantTotal, 2) }}</td>
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