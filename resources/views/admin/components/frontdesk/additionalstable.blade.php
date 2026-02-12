<!-- Additional Items Report OTP Verification Modal -->
<dialog id="additionalReportOTPModal" class="modal">
    <div class="modal-box max-w-4xl w-11/12 bg-base-100 p-0 overflow-hidden rounded-xl flex flex-col max-h-[90vh]">
        <!-- Header with Exit Button -->
        <div class="bg-blue-900 px-6 py-4 flex justify-between items-center flex-shrink-0">
            <h3 class="text-xl font-bold text-white flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
                Additional Items Report Access
            </h3>
            <button onclick="document.getElementById('additionalReportOTPModal').close()" class="text-white/80 hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Account Information
                            </h4>
                            <div class="space-y-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600 text-sm">Name:</span>
                                    <span class="font-semibold text-gray-900">{{ Auth::user()->employee_name ?? Auth::user()->name ?? 'N/A' }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600 text-sm">Email:</span>
                                    <span class="font-mono text-sm bg-white px-3 py-1 rounded-full border border-blue-200">
                                        {{ Auth::user()->email ?? 'N/A' }}
                                    </span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600 text-sm">Department:</span>
                                    <span class="font-medium">{{ Auth::user()->dept_name ?? Auth::user()->department ?? 'N/A' }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600 text-sm">Role:</span>
                                    <span class="badge badge-primary badge-outline">{{ Auth::user()->role ?? 'Staff' }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600 text-sm">Employee ID:</span>
                                    <span class="font-mono">{{ Auth::user()->employee_id ?? Auth::user()->Dept_id ?? 'N/A' }}</span>
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
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                </div>
                                <div>
                                    <h5 class="font-semibold text-amber-800 text-sm">Security Notice</h5>
                                    <p class="text-xs text-amber-700 mt-1">Verification required to access additional items report.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column - OTP Verification -->
                    <div class="space-y-4">
                        <div class="bg-gray-50 p-5 rounded-lg border border-gray-200">
                            <h4 class="text-sm font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                                Verification Code
                            </h4>

                            <!-- OTP Input Boxes -->
                            <div class="flex justify-center gap-2 mb-4">
                                @for ($i = 0; $i < 6; $i++)
                                    <input type="text" maxlength="1"
                                        class="additional-otp-box w-10 h-12 md:w-12 md:h-14 text-center text-xl md:text-2xl font-bold border-2 rounded-lg focus:border-blue-600 outline-none"
                                        data-index="{{ $i }}">
                                @endfor
                            </div>
                            <input type="hidden" id="additionalFullOtp" value="">

                            <!-- Timer & Resend -->
                            <div class="flex justify-between items-center bg-white p-3 rounded-lg border border-gray-200">
                                <div class="flex items-center gap-2 text-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-900" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="text-gray-600">Expires in:</span>
                                    <span id="additionalTimer" class="font-mono font-bold text-blue-900">10:00</span>
                                </div>
                                <button id="additionalResendBtn"
                                    class="text-xs font-semibold text-blue-900 bg-blue-50 px-3 py-1.5 rounded-lg hover:bg-blue-100 disabled:opacity-50"
                                    disabled>
                                    Resend Code
                                </button>
                            </div>

                            <!-- Message Banner -->
                            <div id="additionalMessageBanner" class="hidden mt-3 p-3 rounded-lg text-sm"></div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex gap-3">
                            <button onclick="document.getElementById('additionalReportOTPModal').close()"
                                class="flex-1 px-4 py-3 border-2 border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-50">
                                Cancel
                            </button>
                            <button id="additionalVerifyBtn"
                                class="flex-1 px-4 py-3 bg-blue-900 text-white font-medium rounded-lg hover:bg-blue-800 disabled:opacity-50 flex items-center justify-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-5m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Verify & Continue
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="bg-gray-50 px-6 py-3 border-t border-gray-200 text-xs text-gray-500 flex justify-between items-center flex-shrink-0">
            <span>© 2026 Soliera Hotel Management System</span>
            <span class="flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
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

<style>
    .additional-otp-box {
        background: white;
        transition: all 0.2s ease;
        font-family: 'Courier New', monospace;
        border-color: #d1d5db;
        color: #001f54;
    }
    
    .additional-otp-box:focus {
        border-color: #001f54 !important;
        box-shadow: 0 0 0 3px rgba(0,31,84,0.1);
        transform: scale(1.02);
    }
    
    .additional-otp-box.filled {
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
    class AdditionalReportOTP {
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
            const inputs = document.querySelectorAll('.additional-otp-box');
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
            const inputs = document.querySelectorAll('.additional-otp-box');
            paste.split('').forEach((char, i) => {
                if (i < 6) {
                    inputs[i].value = char;
                    inputs[i].classList.add('filled');
                }
            });
            this.updateFullOTP();
        }

        attachEvents() {
            document.getElementById('additionalVerifyBtn')?.addEventListener('click', () => this.verifyOTP());
            document.getElementById('additionalResendBtn')?.addEventListener('click', () => this.resendOTP());
        }

        updateFullOTP() {
            const inputs = document.querySelectorAll('.additional-otp-box');
            let otp = '';
            inputs.forEach(i => otp += i.value);
            document.getElementById('additionalFullOtp').value = otp;
        }

        async sendOTP() {
            this.showMessage('Sending verification code...', 'info');
            try {
                const res = await fetch('{{ route("additional.report.send.otp") }}', {
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
            const otp = document.getElementById('additionalFullOtp').value;
            if (otp.length !== 6) {
                this.shakeInputs();
                this.showMessage('Enter complete 6-digit code', 'error');
                return;
            }

            const btn = document.getElementById('additionalVerifyBtn');
            btn.disabled = true;
            btn.innerHTML = '<span class="loading loading-spinner loading-sm"></span> Verifying...';

            try {
                const res = await fetch('{{ route("additional.report.verify.otp") }}', {
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
                        document.getElementById('additionalReportOTPModal').close();
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
            const btn = document.getElementById('additionalResendBtn');
            btn.disabled = true;
            btn.innerHTML = 'Sending...';

            try {
                const res = await fetch('{{ route("additional.report.resend.otp") }}', {
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
                    document.getElementById('additionalTimer').innerHTML = 'Expired';
                    document.getElementById('additionalTimer').classList.add('timer-warning');
                    document.getElementById('additionalResendBtn').disabled = false;
                    this.showMessage('Code expired. Request new one.', 'error');
                }
            }, 1000);
        }

        updateTimerDisplay() {
            const mins = Math.floor(this.timeLeft / 60);
            const secs = this.timeLeft % 60;
            document.getElementById('additionalTimer').innerHTML = `${mins.toString().padStart(2,'0')}:${secs.toString().padStart(2,'0')}`;
        }

        resetTimer() {
            clearInterval(this.timer);
            document.getElementById('additionalTimer').classList.remove('timer-warning');
        }

        enableResendAfter(seconds) {
            const btn = document.getElementById('additionalResendBtn');
            btn.disabled = true;
            setTimeout(() => {
                btn.disabled = false;
                btn.innerHTML = 'Resend Code';
            }, seconds * 1000);
        }

        showMessage(msg, type) {
            const banner = document.getElementById('additionalMessageBanner');
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
            document.querySelectorAll('.additional-otp-box').forEach(i => {
                i.classList.add('shake');
                setTimeout(() => i.classList.remove('shake'), 500);
            });
        }

        clearOTPInputs() {
            document.querySelectorAll('.additional-otp-box').forEach(i => {
                i.value = '';
                i.classList.remove('filled');
            });
            document.getElementById('additionalFullOtp').value = '';
            document.querySelector('.additional-otp-box')?.focus();
        }

        openReportModal() {
            // Open your existing additional items report modal
            // Change this ID to match your actual additional items report modal ID
            document.getElementById('additionalReportModal').showModal();
        }

        open() {
            const modal = document.getElementById('additionalReportOTPModal');
            this.clearOTPInputs();
            this.sendOTP();
            modal.showModal();
        }
    }

    // Initialize and expose globally
    const additionalReportOTP = new AdditionalReportOTP();
    window.openAdditionalReportWithOTP = () => additionalReportOTP.open();
</script>

<!-- Button to trigger Additional Items Report OTP verification -->
