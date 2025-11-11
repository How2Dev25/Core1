<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Receipt #{{ $event->eventbookingID }}</title>
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
            <div><strong>EVENT RECEIPT</strong></div>
        </div>

        <!-- Receipt Info -->
        <div class="section">
            <h2>Receipt Information</h2>
            <hr>
            <p><strong>Receipt Date:</strong> {{ date('Y-m-d') }}</p>
            <p><strong>Receipt ID:</strong> {{ $event->event_eventreceipt }}</p>
            <p><strong>Event Booking ID:</strong> {{ $event->event_bookingreceiptID}}</p>
            <p><strong>Status:</strong> {{ $paymentstatus }}</p>
        </div>

        <!-- Organizer Information -->
        <div class="section">
            <h2>Organizer Information</h2>
            <hr>
            <p><strong>Full Name:</strong> {{ $event->eventorganizer_name }}</p>
            <p><strong>Email:</strong> {{ $event->eventorganizer_email }}</p>
            <p><strong>Phone:</strong> {{ $event->eventorganizer_phone }}</p>
        </div>

        <!-- Event Details -->
        <div class="section">
            <h2>Event Details</h2>
            <hr>
            <table>
                <thead>
                    <tr>
                        <th>Event Name</th>
                        <th>Event Type</th>
                        <th>Number of Guests</th>
                        <th>Check-in</th>
                        <th>Check-out</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $event->event_name }}</td>
                        <td>{{ $eventType }}</td>
                        <td>{{ $event->event_numguest }}</td>
                        <td>{{ date('M d, Y', strtotime($event->event_checkin)) }}</td>
                        <td>{{ date('M d, Y', strtotime($event->event_checkout)) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Special Requests & Equipment -->
        @if($event->event_specialrequest || $event->event_equipment)
            <div class="section">
                <h2>Additional Details</h2>
                <hr>
                @if($event->event_specialrequest)
                    <p><strong>Special Requests:</strong> {{ $event->event_specialrequest }}</p>
                @endif
                @if($event->event_equipment)
                    <p><strong>Equipment:</strong> {{ $event->event_equipment }}</p>
                @endif
            </div>
        @endif

        <!-- Pricing -->
        <div class="section">
            <h2>Payment Summary</h2>
            <hr>
            <table>
                <tbody>
                    <tr class="total">
                        <td colspan="3" class="text-right">Total Amount</td>
                        <td class="text-right">{{ number_format($eventTotal, 2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Payment Information -->
        <div class="section">
            <h2>Payment Information</h2>
            <hr>
            <p><strong>Payment Method:</strong> {{ $event->event_paymentmethod ?? 'N/A' }}</p>
            <p><strong>Payment Status:</strong> {{ $event->event_paymentstatus }}</p>
            <p><strong>Booked Date:</strong> {{ $bookedDate }}</p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Thank you for choosing Soliera Hotel for your event!</p>
            <p>events@solierahotel.com | (123) 456-7890</p>
            <p>For any inquiries about your event, please contact our events team.</p>
        </div>

    </div>
</body>

</html>