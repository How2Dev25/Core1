<dialog id="billingReportModal" class="modal">
    <div class="modal-box" style="max-width: 95%; width: 1400px; max-height: 90vh;">
        <div class="flex justify-between items-center mb-4 no-print">
            <h3 class="font-bold text-lg" style="color: #001f54;">Billing Report Preview</h3>
            <div class="flex gap-2">
                <button onclick="printBillingReport()" class="btn btn-sm" style="background-color: #001f54; color: white;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                    Print
                </button>
                <button onclick="document.getElementById('billingReportModal').close()" class="btn btn-sm btn-ghost">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="divider mt-0 no-print"></div>

        <!-- Report Content -->
        <div style="max-height: calc(90vh - 150px); overflow-y: auto; background-color: #f3f4f6; padding: 20px;"
            class="preview-wrapper">
            <div id="billingReportContent" class="report-container">
                <div class="report-header">
                    <h1>Billing History Report</h1>
                    <p>Comprehensive Transaction History Overview</p>
                    <div class="report-meta">
                        <span>Generated: <span id="billingReportDate"></span></span>
                        <span>Total Transactions: {{ count($billingHistory ?? []) }}</span>
                    </div>
                </div>

                <div class="report-body">
                    <!-- Summary Cards -->
                    <div class="summary-section">
                        <div class="summary-card">
                            <h3>Total Transactions</h3>
                            <p>{{ count($billingHistory ?? []) }}</p>
                        </div>
                        <div class="summary-card">
                            <h3>Paid</h3>
                            <p>{{ isset($billingHistory) ? collect($billingHistory)->where('payment_status', 'Paid')->count() : 0 }}</p>
                        </div>
                        <div class="summary-card">
                            <h3>Total Amount</h3>
                            <p>₱{{ isset($billingHistory) ? number_format(collect($billingHistory)->sum('amount_paid'), 2) : '0.00' }}</p>
                        </div>
                        <div class="summary-card">
                            <h3>Avg. Amount</h3>
                            <p>₱{{ isset($billingHistory) && count($billingHistory) > 0 ? number_format(collect($billingHistory)->avg('amount_paid'), 2) : '0.00' }}</p>
                        </div>
                    </div>

                    <!-- Billing History Table -->
                    <table class="report-table">
                        <thead>
                            <tr>
                                <th>Transaction ID</th>
                                <th>Reference</th>
                                <th>Guest</th>
                                <th>Payment Date</th>
                                <th>Amount</th>
                                <th>Method</th>
                                <th>Status</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($billingHistory ?? [] as $billing)
                                <tr>
                                    <td>{{ $billing->transactionID }}</td>
                                    <td>{{ $billing->transaction_reference }}</td>
                                    <td>{{ $billing->guestname ?? 'Guest ID: ' . $billing->guestID }}</td>
                                    <td>{{ \Carbon\Carbon::parse($billing->payment_date)->format('M d, Y h:i A') }}</td>
                                    <td>₱{{ number_format($billing->amount_paid, 2) }}</td>
                                    <td>{{ $billing->payment_method }}</td>
                                    <td>
                                        <span class="badge 
                                            @if($billing->payment_status == 'Paid') badge-confirmed
                                            @else badge-cancelled
                                            @endif">
                                            {{ $billing->payment_status }}
                                        </span>
                                    </td>
                                    <td>{{ $billing->remarks ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" style="text-align: center; padding: 40px; color: #6b7280;">
                                        No transactions found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="report-footer">
                    <p><strong>Soliera Hotel And Restaurant Management System</strong></p>
                    <p>This is a computer-generated report. No signature required.</p>
                    <p>Generated on <span id="billingReportFooterDate"></span></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Click outside to close -->
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>

<!-- Use the EXACT SAME CSS -->
<style>
    .report-container {
        background-color: #ffffff;
        border-radius: 0;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        max-width: 1000px;
        margin: 0 auto;
    }

    .report-header {
        background-color: #1e3a8a;
        color: #ffffff;
        padding: 25px 30px;
        text-align: center;
    }

    .report-header h1 {
        margin: 0 0 8px 0;
        font-size: 24px;
        font-weight: bold;
        color: #ffffff;
    }

    .report-header p {
        margin: 4px 0;
        color: #fbbf24;
        font-size: 13px;
        font-style: italic;
    }

    .report-meta {
        display: flex;
        justify-content: space-between;
        margin-top: 12px;
        font-size: 12px;
        color: #e5e7eb;
    }

    .report-body {
        padding: 25px 30px;
        background-color: #ffffff;
    }

    .summary-section {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 15px;
        margin-bottom: 25px;
    }

    .summary-card {
        background-color: #f9fafb;
        padding: 15px;
        border-radius: 6px;
        border-left: 4px solid #1e3a8a;
    }

    .summary-card h3 {
        color: #6b7280;
        font-size: 11px;
        margin: 0 0 8px 0;
        text-transform: uppercase;
        font-weight: 600;
    }

    .summary-card p {
        color: #1e3a8a;
        font-size: 22px;
        font-weight: bold;
        margin: 0;
    }

    .report-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
        font-size: 11px;
    }

    .report-table th,
    .report-table td {
        padding: 10px 8px;
        border: 1px solid #d1d5db;
        text-align: left;
    }

    .report-table th {
        background-color: #1e3a8a;
        color: #ffffff;
        font-weight: bold;
        font-size: 10px;
        text-transform: uppercase;
    }

    .report-table tbody tr:nth-child(even) {
        background-color: #f9fafb;
    }

    .badge {
        display: inline-block;
        padding: 3px 10px;
        border-radius: 10px;
        font-size: 9px;
        font-weight: bold;
        white-space: nowrap;
    }

    .badge-confirmed {
        background-color: #d1fae5;
        color: #065f46;
    }

    .badge-cancelled {
        background-color: #fee2e2;
        color: #991b1b;
    }

    .report-footer {
        text-align: center;
        padding: 18px 30px;
        background-color: #f9fafb;
        border-top: 2px solid #fbbf24;
        font-size: 10px;
        color: #6b7280;
    }

    .report-footer p {
        margin: 3px 0;
    }

    .report-footer strong {
        color: #1e3a8a;
    }

    /* Print Styles - EXACTLY THE SAME */
    @media print {
        @page {
            size: landscape;
            margin: 15mm;
        }

        body * {
            visibility: hidden !important;
        }

        .no-print {
            display: none !important;
        }

        .preview-wrapper {
            max-height: none !important;
            overflow: visible !important;
            background-color: white !important;
            padding: 0 !important;
            visibility: visible !important;
        }

        #billingReportContent {
            visibility: visible !important;
            position: fixed !important;
            left: 0 !important;
            top: 0 !important;
            width: 100% !important;
            box-shadow: none !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        #billingReportContent * {
            visibility: visible !important;
        }

        .modal-box {
            visibility: visible !important;
            max-width: 100% !important;
            width: 100% !important;
        }

        .report-container {
            box-shadow: none;
            page-break-inside: avoid;
            max-width: 100%;
        }

        /* Force colors to print */
        .report-header {
            background-color: #1e3a8a !important;
            color: #ffffff !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .report-header h1 {
            color: #ffffff !important;
        }

        .report-header p {
            color: #fbbf24 !important;
        }

        .report-table th {
            background-color: #1e3a8a !important;
            color: #ffffff !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .report-table tbody tr:nth-child(even) {
            background-color: #f9fafb !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .summary-card {
            background-color: #f9fafb !important;
            border-left: 4px solid #1e3a8a !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .badge-confirmed {
            background-color: #d1fae5 !important;
            color: #065f46 !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .badge-cancelled {
            background-color: #fee2e2 !important;
            color: #991b1b !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .report-footer {
            background-color: #f9fafb !important;
            border-top: 2px solid #fbbf24 !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
    }
</style>

<!-- EXACT SAME JavaScript pattern -->
<script>
    function openBillingReportModal() {
        // Update dates
        const now = new Date();
        const options = { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' };
        const formattedDate = now.toLocaleDateString('en-US', options);

        document.getElementById('billingReportDate').textContent = formattedDate;
        document.getElementById('billingReportFooterDate').textContent = formattedDate;

        // Calculate totals from table data
        calculateBillingTotals();

        // Open modal
        document.getElementById('billingReportModal').showModal();
    }

    function calculateBillingTotals() {
        // Get all table rows
        const rows = document.querySelectorAll('#billingReportContent tbody tr');
        let totalAmount = 0;
        let paidCount = 0;
        let totalTransactions = rows.length;

        // If there's data in the table
        if (totalTransactions > 0) {
            rows.forEach(row => {
                // Get amount from 5th column (index 4)
                const amountCell = row.cells[4];
                if (amountCell) {
                    const amountText = amountCell.textContent.trim();
                    // Extract number from "₱X,XXX.XX"
                    const amount = parseFloat(amountText.replace('₱', '').replace(',', ''));
                    if (!isNaN(amount)) {
                        totalAmount += amount;
                    }
                }

                // Get status from 7th column (index 6)
                const statusCell = row.cells[6];
                if (statusCell) {
                    const statusText = statusCell.textContent.trim();
                    if (statusText === 'Paid') {
                        paidCount++;
                    }
                }
            });

            const avgAmount = totalTransactions > 0 ? totalAmount / totalTransactions : 0;

            // Update summary cards
            document.querySelector('#billingReportContent .summary-card:nth-child(1) p').textContent = totalTransactions;
            document.querySelector('#billingReportContent .summary-card:nth-child(2) p').textContent = paidCount;
            document.querySelector('#billingReportContent .summary-card:nth-child(3) p').textContent = '₱' + totalAmount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
            document.querySelector('#billingReportContent .summary-card:nth-child(4) p').textContent = '₱' + avgAmount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
        } else {
            // No data found
            document.querySelector('#billingReportContent .summary-card:nth-child(1) p').textContent = '0';
            document.querySelector('#billingReportContent .summary-card:nth-child(2) p').textContent = '0';
            document.querySelector('#billingReportContent .summary-card:nth-child(3) p').textContent = '₱0.00';
            document.querySelector('#billingReportContent .summary-card:nth-child(4) p').textContent = '₱0.00';
        }
    }

    function printBillingReport() {
        // Recalculate totals before printing
        calculateBillingTotals();

        // Clone the report content
        const reportContent = document.getElementById('billingReportContent').cloneNode(true);

        // Create a new window for printing
        const printWindow = window.open('', '_blank');
        printWindow.document.write(`
            <!DOCTYPE html>
            <html>
            <head>
                <title>Billing History Report</title>
                <style>
                    /* Billing History Report CSS Styles */
                    body {
                        margin: 0;
                        padding: 20px;
                        font-family: Arial, sans-serif;
                        color: #333;
                    }
                    
                    .report-container {
                        background-color: #ffffff;
                        border-radius: 0;
                        overflow: hidden;
                        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
                        max-width: 1000px;
                        margin: 0 auto;
                    }

                    .report-header {
                        background-color: #1e3a8a !important;
                        color: #ffffff !important;
                        padding: 25px 30px;
                        text-align: center;
                        -webkit-print-color-adjust: exact;
                        print-color-adjust: exact;
                    }

                    .report-header h1 {
                        margin: 0 0 8px 0;
                        font-size: 24px;
                        font-weight: bold;
                        color: #ffffff !important;
                    }

                    .report-header p {
                        margin: 4px 0;
                        color: #fbbf24 !important;
                        font-size: 13px;
                        font-style: italic;
                    }

                    .report-meta {
                        display: flex;
                        justify-content: space-between;
                        margin-top: 12px;
                        font-size: 12px;
                        color: #e5e7eb;
                    }

                    .report-body {
                        padding: 25px 30px;
                        background-color: #ffffff;
                    }

                    .summary-section {
                        display: grid;
                        grid-template-columns: repeat(4, 1fr);
                        gap: 15px;
                        margin-bottom: 25px;
                    }

                    .summary-card {
                        background-color: #f9fafb !important;
                        padding: 15px;
                        border-radius: 6px;
                        border-left: 4px solid #1e3a8a !important;
                        -webkit-print-color-adjust: exact;
                        print-color-adjust: exact;
                    }

                    .summary-card h3 {
                        color: #6b7280;
                        font-size: 11px;
                        margin: 0 0 8px 0;
                        text-transform: uppercase;
                        font-weight: 600;
                    }

                    .summary-card p {
                        color: #1e3a8a;
                        font-size: 22px;
                        font-weight: bold;
                        margin: 0;
                    }

                    .report-table {
                        width: 100%;
                        border-collapse: collapse;
                        margin-top: 15px;
                        font-size: 11px;
                    }

                    .report-table th,
                    .report-table td {
                        padding: 10px 8px;
                        border: 1px solid #d1d5db;
                        text-align: left;
                    }

                    .report-table th {
                        background-color: #1e3a8a !important;
                        color: #ffffff !important;
                        font-weight: bold;
                        font-size: 10px;
                        text-transform: uppercase;
                        -webkit-print-color-adjust: exact;
                        print-color-adjust: exact;
                    }

                    .report-table tbody tr:nth-child(even) {
                        background-color: #f9fafb !important;
                        -webkit-print-color-adjust: exact;
                        print-color-adjust: exact;
                    }

                    .badge {
                        display: inline-block;
                        padding: 3px 10px;
                        border-radius: 10px;
                        font-size: 9px;
                        font-weight: bold;
                        white-space: nowrap;
                    }

                    .badge-confirmed {
                        background-color: #d1fae5 !important;
                        color: #065f46 !important;
                        -webkit-print-color-adjust: exact;
                        print-color-adjust: exact;
                    }

                    .badge-cancelled {
                        background-color: #fee2e2 !important;
                        color: #991b1b !important;
                        -webkit-print-color-adjust: exact;
                        print-color-adjust: exact;
                    }

                    .report-footer {
                        text-align: center;
                        padding: 18px 30px;
                        background-color: #f9fafb !important;
                        border-top: 2px solid #fbbf24 !important;
                        font-size: 10px;
                        color: #6b7280;
                        -webkit-print-color-adjust: exact;
                        print-color-adjust: exact;
                    }

                    .report-footer p {
                        margin: 3px 0;
                    }

                    .report-footer strong {
                        color: #1e3a8a;
                    }

                    @media print {
                        @page {
                            size: landscape;
                            margin: 15mm;
                        }
                        
                        body {
                            margin: 0;
                            padding: 0;
                        }
                    }
                </style>
            </head>
            <body>
                ${reportContent.innerHTML}
                <script>
                    // Auto print and close
                    window.onload = function() {
                        window.print();
                        setTimeout(function() {
                            window.close();
                        }, 100);
                    };
                <\/script>
            </body>
            </html>
        `);

        printWindow.document.close();
    }
</script>