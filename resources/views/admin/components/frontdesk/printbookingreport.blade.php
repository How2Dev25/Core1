<dialog id="bookingReportOTPModal" class="modal">
    <div class="modal-box max-w-4xl w-11/12 bg-base-100 p-0 overflow-hidden rounded-xl flex flex-col max-h-[90vh]">
        <!-- Header with Exit Button - FIXED -->
        <div class="bg-blue-900 px-6 py-4 flex justify-between items-center flex-shrink-0">
            <h3 class="text-xl font-bold text-white flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Booking Report Access
            </h3>
            <button onclick="document.getElementById('bookingReportOTPModal').close()"
                class="text-white/80 hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Scrollable Content Area -->
        <div class="overflow-y-auto flex-1 px-6">
            <div class="py-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Left Column - User Info -->
                    <div class="space-y-4">
                        <div class="bg-blue-50 p-5 rounded-lg border border-blue-100">
                            <h4 class="text-sm font-semibold text-blue-900 mb-3 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Account Information
                            </h4>
                            <div class="space-y-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600 text-sm">Name:</span>
                                    <span
                                        class="font-semibold text-gray-900">{{ auth()->user()->employee_name ?? auth()->user()->name ?? 'N/A' }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600 text-sm">Email:</span>
                                    <span
                                        class="font-mono text-sm bg-white px-3 py-1 rounded-full border border-blue-200">
                                        {{ auth()->user()->email ?? 'N/A' }}
                                    </span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600 text-sm">Department:</span>
                                    <span
                                        class="font-medium">{{ auth()->user()->dept_name ?? auth()->user()->department ?? 'N/A' }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600 text-sm">Role:</span>
                                    <span
                                        class="badge badge-primary badge-outline">{{ auth()->user()->role ?? 'Staff' }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600 text-sm">Employee ID:</span>
                                    <span
                                        class="font-mono">{{ auth()->user()->employee_id ?? auth()->user()->Dept_id ?? 'N/A' }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600 text-sm">Account Status:</span>
                                    @php
                                        $deptAccount = App\Models\DeptAccount::where('email', auth()->user()->email ?? '')->first();
                                    @endphp
                                    @if($deptAccount && $deptAccount->is_locked)
                                        <span class="badge badge-error">Locked</span>
                                    @else
                                        <span class="badge badge-success">Active</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="bg-amber-50 p-5 rounded-lg border border-amber-200">
                            <div class="flex items-start gap-3">
                                <div class="bg-amber-200 p-2 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-700" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                </div>
                                <div>
                                    <h5 class="font-semibold text-amber-800 text-sm">Security Notice</h5>
                                    <p class="text-xs text-amber-700 mt-1">Verification required to access booking
                                        reports.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column - OTP Verification -->
                    <div class="space-y-4">
                        <div class="bg-gray-50 p-5 rounded-lg border border-gray-200">
                            <h4 class="text-sm font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                                Verification Code
                            </h4>

                            <!-- OTP Input Boxes -->
                            <div class="flex justify-center gap-2 mb-4">
                                @for ($i = 0; $i < 6; $i++)
                                    <input type="text" maxlength="1"
                                        class="otp-box w-10 h-12 md:w-12 md:h-14 text-center text-xl md:text-2xl font-bold border-2 rounded-lg focus:border-blue-600 outline-none"
                                        data-index="{{ $i }}">
                                @endfor
                            </div>
                            <input type="hidden" id="fullOtp" value="">

                            <!-- Timer & Resend -->
                            <div
                                class="flex justify-between items-center bg-white p-3 rounded-lg border border-gray-200">
                                <div class="flex items-center gap-2 text-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-900" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="text-gray-600">Expires in:</span>
                                    <span id="timer" class="font-mono font-bold text-blue-900">10:00</span>
                                </div>
                                <button id="resendBtn"
                                    class="text-xs font-semibold text-blue-900 bg-blue-50 px-3 py-1.5 rounded-lg hover:bg-blue-100 disabled:opacity-50"
                                    disabled>
                                    Resend Code
                                </button>
                            </div>

                            <!-- Message Banner -->
                            <div id="messageBanner" class="hidden mt-3 p-3 rounded-lg text-sm"></div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex gap-3">
                            <button onclick="document.getElementById('bookingReportOTPModal').close()"
                                class="flex-1 px-4 py-3 border-2 border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-50">
                                Cancel
                            </button>
                            <button id="verifyBtn"
                                class="flex-1 px-4 py-3 bg-blue-900 text-white font-medium rounded-lg hover:bg-blue-800 disabled:opacity-50 flex items-center justify-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-5m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Verify & Continue
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div
            class="bg-gray-50 px-6 py-3 border-t border-gray-200 text-xs text-gray-500 flex justify-between items-center flex-shrink-0">
            <span>© 2026 Soliera Hotel Management System</span>
            <span class="flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
                Secure Verification
            </span>
        </div>
    </div>

    <!-- Backdrop close -->
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>
<!-- Booking Report Modal -->
<dialog id="bookingReportModal" class="modal">
    <div class="modal-box" style="max-width: 95%; width: 1400px; max-height: 90vh;">
        <div class="flex justify-between items-center mb-4 no-print">
            <h3 class="font-bold text-lg" style="color: #001f54;">Booking Report Preview</h3>
            <div class="flex gap-2">
                <button onclick="printReport()" class="btn btn-sm" style="background-color: #001f54; color: white;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                    Print
                </button>
                <button onclick="document.getElementById('bookingReportModal').close()" class="btn btn-sm btn-ghost">
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
            <div id="reportContent" class="report-container">
                <div class="report-header">
                    <h1>Booking Report</h1>
                    <p>Comprehensive Reservation Overview</p>
                    <div class="report-meta">
                        <span>Generated: <span id="reportDate"></span></span>
                        <span>Total Bookings: {{ count($reserverooms ?? []) }}</span>
                    </div>
                </div>

                <div class="report-body">
                    <!-- Summary Cards -->
                    <div class="summary-section">
                        <div class="summary-card">
                            <h3>Total Bookings</h3>
                            <p>{{ count($reserverooms ?? []) }}</p>
                        </div>
                        <div class="summary-card">
                            <h3>Confirmed</h3>
                            <p>{{ isset($reserverooms) ? collect($reserverooms)->where('reservation_bookingstatus', 'confirmed')->count() : 0 }}
                            </p>
                        </div>
                        <div class="summary-card">
                            <h3>Checked In</h3>
                            <p>{{ isset($reserverooms) ? collect($reserverooms)->where('reservation_bookingstatus', 'checked in')->count() : 0 }}
                            </p>
                        </div>
                        <div class="summary-card">
                            <h3>Paid</h3>
                            <p>{{ isset($reserverooms) ? collect($reserverooms)->where('payment_status', 'Paid')->count() : 0 }}
                            </p>
                        </div>
                    </div>

                    <!-- Bookings Table -->
                    <table class="report-table">
                        <thead>
                            <tr>
                                <th>Booking ID</th>
                                <th>Guest Name</th>
                                <th>Room</th>
                                <th>Type</th>
                                <th>Check-in</th>
                                <th>Check-out</th>
                                <th>Status</th>
                                <th>Payment</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($reserverooms ?? [] as $reservation)
                                <tr>
                                    <td>{{ $reservation->bookingID }}</td>
                                    <td>{{ $reservation->guestname }}</td>
                                    <td>#{{ $reservation->roomID }}</td>
                                    <td>{{ $reservation->roomtype }}</td>
                                    <td>{{ \Carbon\Carbon::parse($reservation->reservation_checkin)->format('M d, Y') }}
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($reservation->reservation_checkout)->format('M d, Y') }}
                                    </td>
                                    <td>
                                        <span class="badge 
                                                @if(strtolower($reservation->reservation_bookingstatus) == 'pending') badge-pending
                                                @elseif(strtolower($reservation->reservation_bookingstatus) == 'confirmed') badge-confirmed
                                                @elseif(strtolower($reservation->reservation_bookingstatus) == 'checked in') badge-checkedin
                                                @elseif(strtolower($reservation->reservation_bookingstatus) == 'checked out') badge-checkedout
                                                @elseif(strtolower($reservation->reservation_bookingstatus) == 'cancelled') badge-cancelled
                                                @endif">
                                            {{ ucfirst($reservation->reservation_bookingstatus) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="payment-badge
                                                @if(strtolower($reservation->payment_status) == 'pending') payment-pending
                                                @elseif(strtolower($reservation->payment_status) == 'paid') payment-paid
                                                @elseif(strtolower($reservation->payment_status) == 'failed') payment-failed
                                                @endif">
                                            {{ ucfirst($reservation->payment_status) }}
                                        </span>
                                    </td>
                                    <td>₱{{ number_format($reservation->total, 2) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" style="text-align: center; padding: 40px; color: #6b7280;">
                                        No reservations found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="report-footer">
                    <p><strong>Soliera Hotel And Restaurant Management System</strong></p>
                    <p>This is a computer-generated report. No signature required.</p>
                    <p>Generated on <span id="reportFooterDate"></span></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Click outside to close -->
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>

<style>
    .otp-box {
        background: white;
        transition: all 0.2s ease;
        font-family: 'Courier New', monospace;
        border-color: #d1d5db;
        color: #001f54;
    }

    .otp-box:focus {
        border-color: #001f54 !important;
        box-shadow: 0 0 0 3px rgba(0, 31, 84, 0.1);
        transform: scale(1.02);
    }

    .otp-box.filled {
        border-color: #001f54;
        background: rgba(0, 31, 84, 0.02);
    }

    @keyframes shake {

        0%,
        100% {
            transform: translateX(0);
        }

        10%,
        30%,
        50%,
        70%,
        90% {
            transform: translateX(-3px);
        }

        20%,
        40%,
        60%,
        80% {
            transform: translateX(3px);
        }
    }

    .shake {
        animation: shake 0.5s ease-in-out;
    }

    .timer-warning {
        color: #dc2626 !important;
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

    .badge-checkedin {
        background-color: #dbeafe;
        color: #1e40af;
    }

    .badge-checkedout {
        background-color: #fed7aa;
        color: #92400e;
    }

    .badge-cancelled {
        background-color: #fee2e2;
        color: #991b1b;
    }

    .payment-badge {
        font-weight: bold;
        font-size: 10px;
    }

    .payment-paid {
        color: #065f46;
    }

    .payment-pending {
        color: #92400e;
    }

    .payment-failed {
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

        #reportContent {
            visibility: visible !important;
            position: fixed !important;
            left: 0 !important;
            top: 0 !important;
            width: 100% !important;
            box-shadow: none !important;
        }

        .report-header,
        .report-table th,
        .summary-card,
        .badge,
        .report-footer {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
    }
</style>

<script>
    class BookingReportOTP {
        constructor() {
            this.email = '{{ auth()->user()->email ?? "" }}';
            this.timeLeft = 600;
            this.timer = null;
            this.init();
        }

        init() {
            this.setupOTPInputs();
            this.attachEvents();
        }

        setupOTPInputs() {
            const inputs = document.querySelectorAll('.otp-box');
            inputs.forEach((input, index) => {
                input.addEventListener('input', (e) => {
                    input.value = input.value.replace(/[^0-9]/g, '');
                    if (input.value.length === 1) {
                        input.classList.add('filled');
                        if (index < 5) inputs[index + 1]?.focus();
                    }
                    this.updateFullOTP();
                });
                input.addEventListener('keydown', (e) => {
                    if (e.key === 'Backspace' && !input.value && index > 0) {
                        inputs[index - 1].focus();
                        inputs[index - 1].classList.remove('filled');
                    }
                });
                input.addEventListener('paste', (e) => this.handlePaste(e));
            });
        }

        handlePaste(e) {
            e.preventDefault();
            const paste = e.clipboardData.getData('text').replace(/[^0-9]/g, '');
            const inputs = document.querySelectorAll('.otp-box');
            paste.split('').forEach((char, i) => {
                if (i < 6) {
                    inputs[i].value = char;
                    inputs[i].classList.add('filled');
                }
            });
            this.updateFullOTP();
        }

        attachEvents() {
            document.getElementById('verifyBtn')?.addEventListener('click', () => this.verifyOTP());
            document.getElementById('resendBtn')?.addEventListener('click', () => this.resendOTP());
        }

        updateFullOTP() {
            const inputs = document.querySelectorAll('.otp-box');
            let otp = '';
            inputs.forEach(i => otp += i.value);
            document.getElementById('fullOtp').value = otp;
        }

        async sendOTP() {
            this.showMessage('Sending verification code...', 'info');
            try {
                const res = await fetch('{{ route("booking.report.send.otp") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ email: this.email })
                });
                const data = await res.json();
                if (data.success) {
                    this.showMessage('✓ Code sent to your email', 'success');
                    this.startTimer(data.expires_in || 600);
                    this.enableResendAfter(30);
                } else {
                    this.showMessage(data.message, 'error');
                }
            } catch (error) {
                this.showMessage('Failed to send code', 'error');
            }
        }

        async verifyOTP() {
            const otp = document.getElementById('fullOtp').value;
            if (otp.length !== 6) {
                this.shakeInputs();
                this.showMessage('Enter complete 6-digit code', 'error');
                return;
            }

            const btn = document.getElementById('verifyBtn');
            btn.disabled = true;
            btn.innerHTML = '<span class="loading loading-spinner loading-sm"></span> Verifying...';

            try {
                const res = await fetch('{{ route("booking.report.verify.otp") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ otp, email: this.email })
                });
                const data = await res.json();

                if (data.success) {
                    this.showMessage('✓ Verification successful!', 'success');
                    setTimeout(() => {
                        document.getElementById('bookingReportOTPModal').close();
                        this.openReportModal();
                    }, 1000);
                } else {
                    this.shakeInputs();
                    this.showMessage(data.message, 'error');
                    this.clearOTPInputs();
                    btn.disabled = false;
                    btn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-5m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>Verify & Continue';
                }
            } catch (error) {
                this.showMessage('Verification failed', 'error');
                btn.disabled = false;
                btn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-5m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>Verify & Continue';
            }
        }

        async resendOTP() {
            const btn = document.getElementById('resendBtn');
            btn.disabled = true;
            btn.innerHTML = 'Sending...';

            try {
                const res = await fetch('{{ route("booking.report.resend.otp") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ email: this.email })
                });
                const data = await res.json();

                if (data.success) {
                    this.showMessage('✓ New code sent!', 'success');
                    this.resetTimer();
                    this.startTimer(data.expires_in || 600);
                    this.enableResendAfter(30);
                    this.clearOTPInputs();
                } else {
                    this.showMessage(data.message, 'error');
                    btn.disabled = false;
                    btn.innerHTML = 'Resend Code';
                }
            } catch (error) {
                this.showMessage('Failed to resend', 'error');
                btn.disabled = false;
                btn.innerHTML = 'Resend Code';
            }
        }

        startTimer(seconds) {
            this.timeLeft = seconds;
            this.updateTimerDisplay();
            this.timer = setInterval(() => {
                this.timeLeft--;
                this.updateTimerDisplay();
                if (this.timeLeft <= 0) {
                    clearInterval(this.timer);
                    document.getElementById('timer').innerHTML = 'Expired';
                    document.getElementById('timer').classList.add('timer-warning');
                    document.getElementById('resendBtn').disabled = false;
                    this.showMessage('Code expired. Request new one.', 'error');
                }
            }, 1000);
        }

        updateTimerDisplay() {
            const mins = Math.floor(this.timeLeft / 60);
            const secs = this.timeLeft % 60;
            document.getElementById('timer').innerHTML = `${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
        }

        resetTimer() {
            clearInterval(this.timer);
            document.getElementById('timer').classList.remove('timer-warning');
        }

        enableResendAfter(seconds) {
            const btn = document.getElementById('resendBtn');
            btn.disabled = true;
            setTimeout(() => {
                btn.disabled = false;
                btn.innerHTML = 'Resend Code';
            }, seconds * 1000);
        }

        showMessage(msg, type) {
            const banner = document.getElementById('messageBanner');
            banner.innerHTML = msg;
            banner.className = `mt-3 p-3 rounded-lg text-sm ${type === 'success' ? 'bg-green-100 text-green-700 border border-green-200' :
                    type === 'error' ? 'bg-red-100 text-red-700 border border-red-200' :
                        'bg-blue-100 text-blue-700 border border-blue-200'
                }`;
            banner.classList.remove('hidden');
            if (type === 'success') setTimeout(() => banner.classList.add('hidden'), 3000);
        }

        shakeInputs() {
            document.querySelectorAll('.otp-box').forEach(i => {
                i.classList.add('shake');
                setTimeout(() => i.classList.remove('shake'), 500);
            });
        }

        clearOTPInputs() {
            document.querySelectorAll('.otp-box').forEach(i => {
                i.value = '';
                i.classList.remove('filled');
            });
            document.getElementById('fullOtp').value = '';
        }

        openReportModal() {
            const now = new Date();
            const formatted = now.toLocaleDateString('en-US', {
                year: 'numeric', month: 'long', day: 'numeric',
                hour: '2-digit', minute: '2-digit'
            });
            document.getElementById('reportDate').textContent = formatted;
            document.getElementById('reportFooterDate').textContent = formatted;
            document.getElementById('bookingReportModal').showModal();
        }

        open() {
            const modal = document.getElementById('bookingReportOTPModal');
            this.clearOTPInputs();
            this.sendOTP();
            modal.showModal();
        }
    }

    // Initialize and expose globally
    const bookingReportOTP = new BookingReportOTP();
    window.openBookingReportWithOTP = () => bookingReportOTP.open();

    function printReport() {
        const content = document.getElementById('reportContent').cloneNode(true);
        const win = window.open('', '_blank');
        win.document.write(`
            <html><head><title>Booking Report</title>
            <style>body { margin:20px; font-family:Arial; }</style>
            </head><body>${content.innerHTML}
            <script>window.onload = () => { window.print(); setTimeout(() => window.close(), 100); }<\/script>
            </body></html>
        `);
        win.document.close();
    }
</script>