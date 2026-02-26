<dialog id="additionalReportModal" class="modal">
    <div class="modal-box" style="max-width: 95%; width: 1400px; max-height: 90vh;">
        <div class="flex justify-between items-center mb-4 no-print">
            <h3 class="font-bold text-lg" style="color: #001f54;">Additional Report Preview</h3>
            <div class="flex gap-2">
                <button onclick="exportAdditionalToExcel()" class="btn btn-sm" style="background-color: #001f54; color: white;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Export to Excel
                </button>
                <button onclick="document.getElementById('additionalReportModal').close()" class="btn btn-sm btn-ghost">
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
            <div id="additionalReportContent" class="report-container">
                <div class="report-header">
                    <h1>Additional Bookings Report</h1>
                    <p>Comprehensive Additional Services Overview</p>
                    <div class="report-meta">
                        <span>Generated: <span id="additionalReportDate"></span></span>
                        <span>Total Additional Bookings: {{ count($additionalBooking ?? []) }}</span>
                    </div>
                </div>

                <div class="report-body">
                    <!-- Summary Cards -->
                    <div class="summary-section">
                        <div class="summary-card">
                            <h3>Total Bookings</h3>
                            <p>{{ count($additionalBooking ?? []) }}</p>
                        </div>
                        <div class="summary-card">
                            <h3>Paid</h3>
                            <p>{{ isset($additionalBooking) ? collect($additionalBooking)->where('addon_status', 'Paid')->count() : 0 }}
                            </p>
                        </div>
                        <div class="summary-card">
                            <h3>Unpaid</h3>
                            <p>{{ isset($additionalBooking) ? collect($additionalBooking)->where('addon_status', 'Unpaid')->count() : 0 }}
                            </p>
                        </div>
                        <div class="summary-card">
                            <h3>Total Revenue</h3>
                            <p>₱{{ isset($additionalBooking) ? number_format(collect($additionalBooking)->sum('additional_total'), 2) : '0.00' }}
                            </p>
                        </div>
                    </div>

                    <!-- Additional Bookings Table -->
                    <table id="additionalBookingsTable" class="report-table">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Booking ID</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($additionalBooking ?? [] as $booking)
                                <tr>
                                    <td>{{ $booking->core1_inventory_name }}</td>
                                    <td>{{ $booking->bookingID }}</td>
                                    <td>{{ $booking->additional_quantity }}</td>
                                    <td>₱{{ number_format($booking->additional_total, 2) }}</td>
                                    <td>
                                        <span class="badge 
                                                @if($booking->addon_status == 'Paid') badge-confirmed
                                                @elseif($booking->addon_status == 'Unpaid') badge-pending
                                                @else badge-cancelled
                                                @endif">
                                            {{ $booking->addon_status }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" style="text-align: center; padding: 40px; color: #6b7280;">
                                        No additional bookings found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="report-footer">
                    <p><strong>Additional Services Management System</strong></p>
                    <p>This is a computer-generated report. No signature required.</p>
                    <p>Generated on <span id="additionalReportFooterDate"></span></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Click outside to close -->
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>

<!-- Use the EXACT SAME CSS as the room and event booking reports -->
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

    .badge-pending {
        background-color: #fef3c7;
        color: #92400e;
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
</style>

<!-- EXACT SAME JavaScript pattern with Excel export -->
<script>
    function openAdditionalReportModal() {
        // Update dates
        const now = new Date();
        const options = { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' };
        const formattedDate = now.toLocaleDateString('en-US', options);

        document.getElementById('additionalReportDate').textContent = formattedDate;
        document.getElementById('additionalReportFooterDate').textContent = formattedDate;

        // Open modal
        document.getElementById('additionalReportModal').showModal();
    }

    // Excel Export Function for Additional Bookings
    function exportAdditionalToExcel() {
        // Get the table data
        const table = document.getElementById('additionalBookingsTable');
        const rows = table.querySelectorAll('tr');
        
        // Create CSV content
        let csvContent = [];
        
        // Add header row (th)
        const headerRow = [];
        const headers = rows[0].querySelectorAll('th');
        headers.forEach(header => {
            headerRow.push('"' + header.innerText.replace(/"/g, '""') + '"');
        });
        csvContent.push(headerRow.join(','));
        
        // Add data rows (td)
        for (let i = 1; i < rows.length; i++) {
            const row = [];
            const cols = rows[i].querySelectorAll('td');
            
            // Skip the "No additional bookings found" row if present
            if (cols.length === 1 && cols[0].colSpan === 5) {
                continue;
            }
            
            cols.forEach(col => {
                // Clean the data (remove badges, spans, etc.)
                let cellText = col.innerText.trim();
                // Remove currency symbol and format numbers properly
                cellText = cellText.replace('₱', '').trim();
                row.push('"' + cellText.replace(/"/g, '""') + '"');
            });
            
            csvContent.push(row.join(','));
        }
        
        // Add summary section
        csvContent.push('');
        csvContent.push('"ADDITIONAL SERVICES SUMMARY"');
        
        // Get summary data from cards
        const summaryCards = document.querySelectorAll('.summary-card');
        summaryCards.forEach(card => {
            const title = card.querySelector('h3').innerText;
            const value = card.querySelector('p').innerText;
            // Remove ₱ from total revenue for Excel
            const cleanValue = value.replace('₱', '').trim();
            csvContent.push(`"${title}","${cleanValue}"`);
        });
        
        // Add generation info
        csvContent.push('');
        const generatedDate = document.getElementById('additionalReportDate').innerText;
        csvContent.push(`"Generated on:","${generatedDate}"`);
        csvContent.push('"Additional Services Management System"');
        
        // Create blob and download
        const blob = new Blob([csvContent.join('\n')], { type: 'text/csv;charset=utf-8;' });
        const link = document.createElement('a');
        const url = URL.createObjectURL(blob);
        
        // Format filename with date
        const now = new Date();
        const dateStr = now.toISOString().slice(0,10);
        const filename = `additional_services_report_${dateStr}.csv`;
        
        link.setAttribute('href', url);
        link.setAttribute('download', filename);
        link.style.visibility = 'hidden';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }

    // Optional: Keep print function if needed elsewhere, otherwise remove
    // function printAdditionalReport() { ... }
</script>