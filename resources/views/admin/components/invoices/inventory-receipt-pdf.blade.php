<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Item Receipt #{{ $additionalBooking->additionalbookingID }}</title>
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

        .header strong {
            font-size: 14px;
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
        <div class="header">
            <div>
                <h1>Soliera Hotel And Restaurant</h1>
                <p>Savor The Stay, Dine With Elegance</p>
            </div>
            <div><strong>INVENTORY ITEM RECEIPT</strong></div>
        </div>

        <div class="section">
            <h2>Receipt Information</h2>
            <hr>
            <p><strong>Receipt Date:</strong> {{ date('Y-m-d') }}</p>
            <p><strong>Receipt ID:</strong>
                INV-{{ str_pad($additionalBooking->additionalbookingID, 6, '0', STR_PAD_LEFT) }}</p>
            <p><strong>Booking ID:</strong> {{ $reservation->bookingID }}</p>
           
            <p><strong>Status:</strong> {{ $paymentstatus }}</p>
        </div>

        <div class="section">
            <h2>Inventory Item Details</h2>
            <hr>
            <table>
                <thead>
                    <tr>
                        <th>Item Code</th>
                        <th>Item Name</th>
                        <th>Category</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td>{{ $additionalBooking->core1_inventory_code }}</td>
                    <td>{{ $additionalBooking->core1_inventory_name }}</td>
                    <td>{{ $additionalBooking->core1_inventory_category }}</td>
                    <td>
                        {{ $additionalBooking->additional_quantity }}
                        {{ $additionalBooking->core1_inventory_unit ?? 'pcs' }}
                    </td>
                    <td>
                        {{ number_format($additionalBooking->core1_inventory_cost, 2) }}
                    </td>
                    <td>
                        {{ number_format($additionalBooking->additional_total, 2) }}
                    </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="section">
            <h2>Payment Summary</h2>
            <hr>
            <table>
                <tbody>
                    <tr>
                        <td colspan="4" class="text-right">Subtotal</td>
                        <td class="text-right">{{ number_format($additionalBooking->additional_total, 2) }}</td>
                    </tr>
                    <tr class="total">
                        <td colspan="4" class="text-right"><strong>Total Amount</strong></td>
                        <td class="text-right"><strong>{{ number_format($totalAmount, 2) }}</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="section">
            <h2>Additional Information</h2>
            <hr>
            <p><strong>Booked Date:</strong> {{ $bookedDate }}</p>
            <p><strong>Addon Status:</strong> {{ $additionalBooking->addon_status }}</p>
        </div>

        <div class="footer">
            <p>Thank you for choosing Soliera Hotel!</p>
            <p>inventory@solierahotel.com | (123) 456-7890</p>
            <p>This receipt is for inventory items used during your stay.</p>
        </div>
    </div>
</body>

</html>