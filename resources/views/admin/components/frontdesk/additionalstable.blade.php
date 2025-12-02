<!-- Table -->
<div class="overflow-x-auto mt-5">
    <table class="table table-auto w-full">
        <thead>
            <tr class="bg-blue-900 text-white text-sm">
                <th class="py-3 px-4 text-left">Inventory</th>
                <th class="py-3 px-4 text-left">Booking ID</th>
                <th class="py-3 px-4 text-left">Quantity</th>
                <th class="py-3 px-4 text-left">Price</th>
                <th class="py-3 px-4 text-left">Status</th>
                <th class="py-3 px-4 text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($additionalBooking as $booking)
                <tr class="border-t border-gray-100 hover:bg-gray-50">
                    <td class="py-4 px-4 flex items-center gap-3">
                        <img src="{{ asset($booking->core1_inventory_image)}}"
                            class="w-12 h-12 object-cover rounded-lg">
                        <span class="font-medium">{{ $booking->core1_inventory_name}}</span>
                    </td>
                    <td class="py-4 px-4">{{ $booking->bookingID }}</td>
                    <td class="py-4 px-4">{{ $booking->additional_quantity}}</td>
                    <td class="py-4 px-4">₱{{ number_format($booking->additional_total, 2) }}</td>
                    <td class="py-4 px-4">
                        @if($booking->addon_status == 'Paid')
                            <span class="badge badge-success">Paid
                        @elseif($booking->addon_status == 'Unpaid')
                            <span class="badge badge-warning">Unpaid</span>
                        @else
                            <span class="badge badge-error">Cancelled</span>
                        @endif
                    </td>
                <td class="py-4 px-4 text-right">
                    <div class="flex gap-2 justify-end">
                        @if($booking->addon_status !== 'Paid')
                            <button class="btn btn-sm btn-success p-2" title="Mark As Paid"
                                onclick="document.getElementById('markAsPaidModal_{{ $booking->additionalbookingID }}').showModal()">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </button>
                        @endif

                        <button class="btn btn-sm btn-error p-2" title="Delete"
                            onclick="document.getElementById('deleteAddon_{{ $booking->additionalbookingID }}').showModal()">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4a1 1 0 011 1v1H9V4a1 1 0 011-1z" />
                            </svg>
                        </button>

                        <button class="btn btn-sm btn-primary p-2" title="Generate Receipt" onclick="openReceiptModal({
                                bookingId: '{{ $booking->bookingID }}',
                                inventoryName: '{{ $booking->core1_inventory_name }}',
                                inventoryImage: '{{ asset($booking->core1_inventory_image) }}',
                                quantity: '{{ $booking->additional_quantity }}',
                                total: '{{ $booking->additional_total }}',
                                status: '{{ $booking->addon_status }}',
                                receiptId: 'RCP-{{ $booking->bookingID }}',
                                date: '{{ date('M d, Y') }}'
                            })">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 4H7a2 2 0 01-2-2V6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v12a2 2 0 01-2 2z" />
                            </svg>
                        </button>
                    </div>
                </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-4">No additional bookings found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Mark As Paid Modal -->


<!-- Delete Modal -->


<!-- Generate Receipt Modal with Preview -->
<dialog id="receiptModal" class="modal">
    <div class="modal-box max-w-4xl h-[90vh] flex flex-col">
        <div class="flex justify-between items-center mb-4">
            <h3 class="font-bold text-lg">Receipt Preview</h3>
            <button type="button" class="btn btn-sm btn-circle btn-ghost" onclick="receiptModal.close()">✕</button>
        </div>

        <!-- Scrollable Preview Area -->
        <div class="flex-1 overflow-y-auto border border-gray-200 rounded-lg bg-gray-50 p-4">
            <div id="receiptContent" class="bg-white mx-auto" style="max-width: 700px;">
                <!-- Receipt will be generated here -->
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="modal-action mt-4">
            <button type="button" class="btn btn-ghost" onclick="receiptModal.close()">Close</button>
            <button type="button" class="btn btn-primary" onclick="printReceipt()">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                Generate Receipt
            </button>
            
        </div>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>

<!-- Include html2pdf library -->
<script src="{{ asset('javascript/html2pdf.bundle.min.js') }}"></script>



<style>
    .receipt-template {
        font-family: Arial, sans-serif;
        font-size: 11px;
        color: #333;
        background-color: #fff;
        /* CHANGED */
        padding: 0;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        overflow: hidden;
    }

    .receipt-header {
        background-color: #1e3a8a;
        /* CHANGED */
        color: #fff;
        padding: 16px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .receipt-header h1 {
        margin: 0;
        font-size: 18px;
        font-weight: bold;
    }

    .receipt-header p {
        margin: 2px 0 0 0;
        color: #fbbf24;
        font-style: italic;
        font-size: 11px;
    }

    .receipt-header-right {
        text-align: right;
        font-weight: bold;
        font-size: 13px;
    }

    .receipt-body {
        padding: 20px;
        background-color: #fff;
        /* ADDED */
    }

    .receipt-section {
        padding: 12px 0;
    }

    .receipt-section h2 {
        margin: 0 0 8px 0;
        color: #1e3a8a;
        font-size: 14px;
        font-weight: bold;
    }

    .receipt-section hr {
        border: none;
        border-top: 2px solid #fbbf24;
        margin: 8px 0 12px 0;
    }

    .receipt-info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 8px;
        font-size: 11px;
    }

    .receipt-info-row {
        display: flex;
        gap: 8px;
    }

    .receipt-info-label {
        font-weight: bold;
        min-width: 100px;
    }

    .receipt-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
        font-size: 11px;
    }

    .receipt-table th,
    .receipt-table td {
        padding: 10px 12px;
        border: 1px solid #ddd;
        text-align: left;
    }

    .receipt-table th {
        background-color: #1e3a8a;
        /* CHANGED */
        color: #fff;
        font-weight: bold;
    }

    .receipt-table .text-right {
        text-align: right;
    }

    .receipt-total {
        background-color: #fbbf24;
        /* CHANGED */
        color: #1e3a8a;
        font-weight: bold;
    }

    .receipt-footer {
        text-align: center;
        font-size: 10px;
        color: #666;
        padding: 16px 20px;
        background-color: #f4f4f4;
        /* CHANGED */
        border-top: 1px solid #e5e7eb;
    }

    .receipt-footer p {
        margin: 4px 0;
    }

    .inventory-section {
        display: flex;
        align-items: flex-start;
        gap: 20px;
        padding: 15px;
        background-color: #f9fafb;
        /* CHANGED */
        border-radius: 8px;
        margin-top: 10px;
    }

    .inventory-image {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 8px;
        border: 2px solid #e5e7eb;
        flex-shrink: 0;
    }

    .inventory-details {
        flex: 1;
    }

    .inventory-details p {
        margin: 6px 0;
        font-size: 11px;
    }

    .status-badge {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 12px;
        font-size: 10px;
        font-weight: bold;
    }

    .status-paid {
        background-color: #d1fae5;
        /* CHANGED */
        color: #065f46;
    }

    .status-unpaid {
        background-color: #fef3c7;
        /* CHANGED */
        color: #92400e;
    }

    .status-cancelled {
        background-color: #fee2e2;
        /* CHANGED */
        color: #991b1b;
    }

    @media print {
        body * {
            visibility: hidden;
        }

        #printableReceipt,
        #printableReceipt * {
            visibility: visible;
        }

        #printableReceipt {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            background-color: white !important;
        }

        .receipt-template {
            box-shadow: none;
            page-break-inside: avoid;
            background-color: white !important;
        }

        /* Add explicit background colors for print */
        .receipt-header {
            background-color: #1e3a8a !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .receipt-table th {
            background-color: #1e3a8a !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
    }
</style>
<script>
    let currentReceiptData = null;
    let receiptModal = document.getElementById('receiptModal');
   

  

    function openReceiptModal(data) {
        if (!receiptModal) receiptModal = document.getElementById('receiptModal');
        currentReceiptData = data;

        const statusClass = data.status === 'Paid' ? 'status-paid' : (data.status === 'Unpaid' ? 'status-unpaid' : 'status-cancelled');

        const receiptHTML = `
        <div class="receipt-template" id="printableReceipt">
            <!-- Header -->
            <div class="receipt-header">
                <div>
                    <h1>Soliera Hotel And Restaurant</h1>
                    <p>Savor The Stay, Dine With Elegance</p>
                </div>
                <div class="receipt-header-right">ADDITIONAL RECEIPT</div>
            </div>

            <div class="receipt-body">
                <!-- Receipt Info -->
                <div class="receipt-section">
                    <h2>Receipt Information</h2>
                    <hr>
                    <div class="receipt-info-grid">
                        <div class="receipt-info-row">
                            <span class="receipt-info-label">Receipt Date:</span>
                            <span>${data.date}</span>
                        </div>
                        <div class="receipt-info-row">
                            <span class="receipt-info-label">Receipt ID:</span>
                            <span>${data.receiptId}</span>
                        </div>
                        <div class="receipt-info-row">
                            <span class="receipt-info-label">Booking ID:</span>
                            <span>${data.bookingId}</span>
                        </div>
                        <div class="receipt-info-row">
                            <span class="receipt-info-label">Status:</span>
                            <span class="status-badge ${statusClass}">${data.status}</span>
                        </div>
                    </div>
                </div>

                <!-- Inventory Details -->
                <div class="receipt-section">
                    <h2>Item Details</h2>
                    <hr>
                    <div class="inventory-section">
                        <img src="${data.inventoryImage}" alt="${data.inventoryName}" class="inventory-image" crossorigin="anonymous" onerror="this.style.display='none'">
                        <div class="inventory-details">
                            <p><strong>Item Name:</strong> ${data.inventoryName}</p>
                            <p><strong>Quantity Ordered:</strong> ${data.quantity} unit(s)</p>
                            <p><strong>Unit Price:</strong> ₱${(parseFloat(data.total) / parseInt(data.quantity)).toLocaleString('en-US', { minimumFractionDigits: 2 })}</p>
                        </div>
                    </div>
                </div>

                <!-- Pricing -->
                <div class="receipt-section">
                    <h2>Payment Summary</h2>
                    <hr>
                    <table class="receipt-table">
                        <thead>
                            <tr>
                                <th>Description</th>
                                <th class="text-right">Quantity</th>
                                <th class="text-right">Unit Price</th>
                                <th class="text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>${data.inventoryName}</td>
                                <td class="text-right">${data.quantity}</td>
                                <td class="text-right">₱${(parseFloat(data.total) / parseInt(data.quantity)).toLocaleString('en-US', { minimumFractionDigits: 2 })}</td>
                                <td class="text-right">₱${parseFloat(data.total).toLocaleString('en-US', { minimumFractionDigits: 2 })}</td>
                            </tr>
                            <tr class="receipt-total">
                                <td colspan="3" class="text-right"><strong>Total Amount</strong></td>
                                <td class="text-right"><strong>₱${parseFloat(data.total).toLocaleString('en-US', { minimumFractionDigits: 2 })}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Footer -->
            <div class="receipt-footer">
                <p><strong>Thank you for choosing Soliera Hotel And Restaurant!</strong></p>
                <p>contact@solierahotel.com | (123) 456-7890</p>
                <p>For any inquiries about your booking, please contact our front desk.</p>
            </div>
        </div>
    `;

        document.getElementById('receiptContent').innerHTML = receiptHTML;
        receiptModal.showModal();
    }

    function printReceipt() {
        console.log('Printing receipt...');
        window.print();
    }

    function downloadPDF() {
        console.log('Download PDF called');

        if (!currentReceiptData) {
            console.error('No current receipt data');
            alert('No receipt data available. Please generate a receipt first.');
            return;
        }

        const element = document.getElementById('printableReceipt');

        if (!element) {
            console.error('Printable receipt element not found');
            alert('Receipt not found. Please try again.');
            return;
        }

        // Create a clean copy
        const elementCopy = element.cloneNode(true);

        // Remove inline styles that might cause issues
        elementCopy.querySelectorAll('[style]').forEach(el => {
            el.removeAttribute('style');
        });

        const opt = {
            margin: 10,
            filename: `Receipt_${currentReceiptData.bookingId}_${Date.now()}.pdf`,
            image: {
                type: 'jpeg',
                quality: 0.95
            },
            html2canvas: {
                scale: 2,
                useCORS: false,
                logging: true, // Enable for debugging
                backgroundColor: '#ffffff'
            },
            jsPDF: {
                unit: 'mm',
                format: 'a4',
                orientation: 'portrait'
            }
        };

        console.log('Starting PDF generation...');

        // Show loading state
        const downloadBtn = document.querySelector('#receiptModal .btn-secondary');
        if (downloadBtn) {
            const originalText = downloadBtn.innerHTML;
            downloadBtn.innerHTML = '<span class="loading loading-spinner loading-sm mr-2"></span> Generating...';
            downloadBtn.disabled = true;

            // Generate PDF
            html2pdf()
                .set(opt)
                .from(elementCopy)
                .save()
                .then(() => {
                    console.log('PDF generated successfully');
                })
                .catch((error) => {
                    console.error('PDF generation error:', error);

                    // Try simpler approach
                    try {
                        const simpleOpt = {
                            margin: 10,
                            filename: `Receipt_${currentReceiptData.bookingId}.pdf`,
                            html2canvas: {
                                scale: 1,
                                useCORS: false,
                                backgroundColor: '#ffffff'
                            },
                            jsPDF: {
                                unit: 'mm',
                                format: 'a4',
                                orientation: 'portrait'
                            }
                        };

                        html2pdf()
                            .set(simpleOpt)
                            .from(element)
                            .save();
                    } catch (e) {
                        console.error('Fallback also failed:', e);
                        alert('PDF generation failed. Please use the Print button instead.');
                    }
                })
                .finally(() => {
                    // Restore button
                    if (downloadBtn) {
                        downloadBtn.innerHTML = originalText;
                        downloadBtn.disabled = false;
                    }
                });
        } else {
            // Button not found, try without UI feedback
            html2pdf()
                .set(opt)
                .from(elementCopy)
                .save()
                .catch(error => {
                    console.error('Error:', error);
                    alert('PDF generation failed: ' + error.message);
                });
        }
    }

    // Debug: Check if function is accessible
    console.log('downloadPDF function loaded:', typeof downloadPDF);
</script>