<!-- Event Report OTP Verification Modal -->
<dialog id="eventReportOTPModal" class="modal">
    <div class="modal-box max-w-4xl w-11/12 bg-base-100 p-0 overflow-hidden rounded-xl flex flex-col max-h-[90vh]">
        <!-- Header with Exit Button - FIXED -->
        <div class="bg-blue-900 px-6 py-4 flex justify-between items-center flex-shrink-0">
            <h3 class="text-xl font-bold text-white flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 5v2m0 4v6m0 0l-3-3m3 3l3-3M5 5a2 2 0 00-2 2v10a2 2 0 002 2h14a2 2 0 002-2V7a2 2 0 00-2-2H5z" />
                </svg>
                Event Report Access
            </h3>
            <button onclick="document.getElementById('eventReportOTPModal').close()"
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
                                        class="font-semibold text-gray-900">{{ Auth::user()->employee_name ?? Auth::user()->name ?? 'N/A' }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600 text-sm">Email:</span>
                                    <span
                                        class="font-mono text-sm bg-white px-3 py-1 rounded-full border border-blue-200">
                                        {{ Auth::user()->email ?? 'N/A' }}
                                    </span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600 text-sm">Department:</span>
                                    <span
                                        class="font-medium">{{ Auth::user()->dept_name ?? Auth::user()->department ?? 'N/A' }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600 text-sm">Role:</span>
                                    <span
                                        class="badge badge-primary badge-outline">{{ Auth::user()->role ?? 'Staff' }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600 text-sm">Employee ID:</span>
                                    <span
                                        class="font-mono">{{ Auth::user()->employee_id ?? Auth::user()->Dept_id ?? 'N/A' }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600 text-sm">Account Status:</span>
                                    @php
                                        $deptAccount = App\Models\DeptAccount::where('email', Auth::user()->email ?? '')->first();
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
                                    <p class="text-xs text-amber-700 mt-1">Verification required to access event
                                        reports.</p>
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
                                        class="event-otp-box w-10 h-12 md:w-12 md:h-14 text-center text-xl md:text-2xl font-bold border-2 rounded-lg focus:border-blue-600 outline-none"
                                        data-index="{{ $i }}">
                                @endfor
                            </div>
                            <input type="hidden" id="eventFullOtp" value="">

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
                                    <span id="eventTimer" class="font-mono font-bold text-blue-900">10:00</span>
                                </div>
                                <button id="eventResendBtn"
                                    class="text-xs font-semibold text-blue-900 bg-blue-50 px-3 py-1.5 rounded-lg hover:bg-blue-100 disabled:opacity-50"
                                    disabled>
                                    Resend Code
                                </button>
                            </div>

                            <!-- Message Banner -->
                            <div id="eventMessageBanner" class="hidden mt-3 p-3 rounded-lg text-sm"></div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex gap-3">
                            <button onclick="document.getElementById('eventReportOTPModal').close()"
                                class="flex-1 px-4 py-3 border-2 border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-50">
                                Cancel
                            </button>
                            <button id="eventVerifyBtn"
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

        <!-- Footer - FIXED -->
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

<!-- Event Report Modal (Your existing modal) -->
<dialog id="eventReportModal" class="modal">
    <div class="modal-box" style="max-width: 95%; width: 1400px; max-height: 90vh;">
        <div class="flex justify-between items-center mb-4 no-print">
            <h3 class="font-bold text-lg" style="color: #001f54;">Event Report Preview</h3>
            <div class="flex gap-2">
                <button onclick="printEventReport()" class="btn btn-sm"
                    style="background-color: #001f54; color: white;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                    Print
                </button>
                <button onclick="document.getElementById('eventReportModal').close()" class="btn btn-sm btn-ghost">
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
            <div id="eventReportContent" class="report-container">
                <div class="report-header">
                    <h1>Event Booking Report</h1>
                    <p>Comprehensive Event Reservations Overview</p>
                    <div class="report-meta">
                        <span>Generated: <span id="eventReportDate"></span></span>
                        <span>Total Events: {{ count($reservations ?? []) }}</span>
                    </div>
                </div>

                <div class="report-body">
                    <!-- Summary Cards -->
                    <div class="summary-section">
                        <div class="summary-card">
                            <h3>Total Events</h3>
                            <p>{{ count($reservations ?? []) }}</p>
                        </div>
                        <div class="summary-card">
                            <h3>Approved</h3>
                            <p>{{ isset($reservations) ? collect($reservations)->where('eventstatus', 'approved')->count() : 0 }}
                            </p>
                        </div>
                        <div class="summary-card">
                            <h3>Pending</h3>
                            <p>{{ isset($reservations) ? collect($reservations)->where('eventstatus', 'pending')->count() : 0 }}
                            </p>
                        </div>
                        <div class="summary-card">
                            <h3>Paid</h3>
                            <p>{{ isset($reservations) ? collect($reservations)->where('event_paymentstatus', 'paid')->count() : 0 }}
                            </p>
                        </div>
                    </div>

                    <!-- Events Table -->
                    <table class="report-table">
                        <thead>
                            <tr>
                                <th>Booking ID</th>
                                <th>Event Name</th>
                                <th>Organizer</th>
                                <th>Type</th>
                                <th>Check-in</th>
                                <th>Check-out</th>
                                <th>Status</th>
                                <th>Payment</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($reservations ?? [] as $reservation)
                                <tr>
                                    <td>{{ $reservation->event_bookingreceiptID }}</td>
                                    <td>{{ $reservation->event_name }}</td>
                                    <td>{{ $reservation->eventorganizer_name }}</td>
                                    <td>{{ $reservation->eventtype_name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($reservation->event_checkin)->format('M d, Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($reservation->event_checkout)->format('M d, Y') }}</td>
                                    <td>
                                        <span class="badge 
                                                @if(strtolower($reservation->eventstatus) == 'approved' || strtolower($reservation->eventstatus) == 'done') badge-confirmed
                                                @elseif(strtolower($reservation->eventstatus) == 'pending') badge-pending
                                                @elseif(strtolower($reservation->eventstatus) == 'cancelled') badge-cancelled
                                                @endif">
                                            {{ ucfirst($reservation->eventstatus) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="payment-badge
                                                @if(strtolower($reservation->event_paymentstatus) == 'paid') payment-paid
                                                @elseif(strtolower($reservation->event_paymentstatus) == 'pending') payment-pending
                                                @elseif(strtolower($reservation->event_paymentstatus) == 'failed') payment-failed
                                                @endif">
                                            {{ ucfirst($reservation->event_paymentstatus) }}
                                        </span>
                                    </td>
                                    <td>₱{{ number_format($reservation->event_total_price, 2) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" style="text-align: center; padding: 40px; color: #6b7280;">
                                        No event reservations found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="report-footer">
                    <p><strong>Soliera Hotel And Restaurant Management System</strong></p>
                    <p>This is a computer-generated report. No signature required.</p>
                    <p>Generated on <span id="eventReportFooterDate"></span></p>
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
    .event-otp-box {
        background: white;
        transition: all 0.2s ease;
        font-family: 'Courier New', monospace;
        border-color: #d1d5db;
        color: #001f54;
    }
    
    .event-otp-box:focus {
        border-color: #001f54 !important;
        box-shadow: 0 0 0 3px rgba(0,31,84,0.1);
        transform: scale(1.02);
    }
    
    .event-otp-box.filled {
        border-color: #001f54;
        background: rgba(0,31,84,0.02);
    }
    
    @keyframes shake {
        0%,100% { transform: translateX(0); }
        10%,30%,50%,70%,90% { transform: translateX(-3px); }
        20%,40%,60%,80% { transform: translateX(3px); }
    }
    
    .shake { animation: shake 0.5s ease-in-out; }
    .timer-warning { color: #dc2626 !important; }
</style>

<script>
    class EventReportOTP {
        constructor() {
            this.email = '{{ Auth::user()->email ?? "" }}';
            this.timeLeft = 600;
            this.timer = null;
            this.init();
        }

        init() {
            this.setupOTPInputs();
            this.attachEvents();
        }

        setupOTPInputs() {
            const inputs = document.querySelectorAll('.event-otp-box');
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
            const inputs = document.querySelectorAll('.event-otp-box');
            paste.split('').forEach((char, i) => {
                if (i < 6) {
                    inputs[i].value = char;
                    inputs[i].classList.add('filled');
                }
            });
            this.updateFullOTP();
        }

        attachEvents() {
            document.getElementById('eventVerifyBtn')?.addEventListener('click', () => this.verifyOTP());
            document.getElementById('eventResendBtn')?.addEventListener('click', () => this.resendOTP());
        }

        updateFullOTP() {
            const inputs = document.querySelectorAll('.event-otp-box');
            let otp = '';
            inputs.forEach(i => otp += i.value);
            document.getElementById('eventFullOtp').value = otp;
        }

        async sendOTP() {
            this.showMessage('Sending verification code...', 'info');
            try {
                const res = await fetch('{{ route("event.report.send.otp") }}', {
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
            const otp = document.getElementById('eventFullOtp').value;
            if (otp.length !== 6) {
                this.shakeInputs();
                this.showMessage('Enter complete 6-digit code', 'error');
                return;
            }

            const btn = document.getElementById('eventVerifyBtn');
            btn.disabled = true;
            btn.innerHTML = '<span class="loading loading-spinner loading-sm"></span> Verifying...';

            try {
                const res = await fetch('{{ route("event.report.verify.otp") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ 
                        otp: otp, 
                        email: this.email 
                    })
                });
                const data = await res.json();
                
                if (data.success) {
                    this.showMessage('✓ Verification successful!', 'success');
                    setTimeout(() => {
                        document.getElementById('eventReportOTPModal').close();
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
            const btn = document.getElementById('eventResendBtn');
            btn.disabled = true;
            btn.innerHTML = 'Sending...';

            try {
                const res = await fetch('{{ route("event.report.resend.otp") }}', {
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
                    document.getElementById('eventTimer').innerHTML = 'Expired';
                    document.getElementById('eventTimer').classList.add('timer-warning');
                    document.getElementById('eventResendBtn').disabled = false;
                    this.showMessage('Code expired. Request new one.', 'error');
                }
            }, 1000);
        }

        updateTimerDisplay() {
            const mins = Math.floor(this.timeLeft / 60);
            const secs = this.timeLeft % 60;
            document.getElementById('eventTimer').innerHTML = `${mins.toString().padStart(2,'0')}:${secs.toString().padStart(2,'0')}`;
        }

        resetTimer() {
            clearInterval(this.timer);
            document.getElementById('eventTimer').classList.remove('timer-warning');
        }

        enableResendAfter(seconds) {
            const btn = document.getElementById('eventResendBtn');
            btn.disabled = true;
            setTimeout(() => {
                btn.disabled = false;
                btn.innerHTML = 'Resend Code';
            }, seconds * 1000);
        }

        showMessage(msg, type) {
            const banner = document.getElementById('eventMessageBanner');
            banner.innerHTML = msg;
            banner.className = `mt-3 p-3 rounded-lg text-sm ${
                type === 'success' ? 'bg-green-100 text-green-700 border border-green-200' :
                type === 'error' ? 'bg-red-100 text-red-700 border border-red-200' :
                'bg-blue-100 text-blue-700 border border-blue-200'
            }`;
            banner.classList.remove('hidden');
            if (type === 'success') setTimeout(() => banner.classList.add('hidden'), 3000);
        }

        shakeInputs() {
            document.querySelectorAll('.event-otp-box').forEach(i => {
                i.classList.add('shake');
                setTimeout(() => i.classList.remove('shake'), 500);
            });
        }

        clearOTPInputs() {
            document.querySelectorAll('.event-otp-box').forEach(i => {
                i.value = '';
                i.classList.remove('filled');
            });
            document.getElementById('eventFullOtp').value = '';
        }

        openReportModal() {
            const now = new Date();
            const formatted = now.toLocaleDateString('en-US', { 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric', 
                hour: '2-digit', 
                minute: '2-digit' 
            });
            document.getElementById('eventReportDate').textContent = formatted;
            document.getElementById('eventReportFooterDate').textContent = formatted;
            document.getElementById('eventReportModal').showModal();
        }

        open() {
            const modal = document.getElementById('eventReportOTPModal');
            this.clearOTPInputs();
            this.sendOTP();
            modal.showModal();
        }
    }

    // Initialize and expose globally
    const eventReportOTP = new EventReportOTP();
    window.openEventReportWithOTP = () => eventReportOTP.open();

    // Keep your existing print function
    function printEventReport() {
        const content = document.getElementById('eventReportContent').cloneNode(true);
        const win = window.open('', '_blank');
        win.document.write(`
            <!DOCTYPE html>
            <html>
            <head>
                <title>Event Booking Report - Soliera Hotel</title>
                <style>
                    /* Copy your existing print styles here */
                    body { margin: 20px; font-family: Arial, sans-serif; }
                    .report-container { max-width: 1000px; margin: 0 auto; }
                    .report-header { background: #001f54; color: white; padding: 20px; text-align: center; }
                    .report-header h1 { color: #F7B32B; margin: 0; }
                    .report-table { width: 100%; border-collapse: collapse; }
                    .report-table th { background: #001f54; color: white; padding: 8px; }
                    .report-table td { border: 1px solid #ddd; padding: 8px; }
                    .badge { padding: 2px 8px; border-radius: 10px; font-size: 11px; }
                    .badge-pending { background: #fef3c7; color: #92400e; }
                    .badge-confirmed { background: #d1fae5; color: #065f46; }
                    .badge-cancelled { background: #fee2e2; color: #991b1b; }
                </style>
            </head>
            <body>
                ${content.innerHTML}
                <script>
                    window.onload = () => {
                        window.print();
                        setTimeout(() => window.close(), 100);
                    }
                <\/script>
            </body>
            </html>
        `);
        win.document.close();
    }
</script>

<!-- Button to trigger Event Report OTP verification -->
