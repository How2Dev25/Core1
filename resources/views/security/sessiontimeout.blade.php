<div id="warning" class="hidden fixed top-20 right-5 max-w-md w-full z-50 animate-slide-in">
    <!-- Card Container -->
    <div class="bg-white rounded-2xl shadow-2xl border-l-8 border-yellow-400 overflow-hidden">

        <!-- Hotel Brand Badge -->
        <div
            class="absolute -top-3 right-6 bg-blue-950 text-yellow-400 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider shadow-lg">
            Soliera
        </div>

        <!-- Content Wrapper -->
        <div class="p-6">

            <!-- Header Section -->
            <div class="flex items-start gap-4 mb-5">
                <!-- Icon -->
                <div class="flex-shrink-0 bg-gradient-to-br from-yellow-400 to-yellow-500 p-3 rounded-xl shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-950" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>

                <!-- Text Content -->
                <div class="flex-1">
                    <h3 class="text-lg font-bold text-blue-950 mb-2 tracking-tight">
                        Session Timeout Warning
                    </h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        You've been inactive for a while. Your session will expire in
                        <span id="countdown"
                            class="inline-block bg-gradient-to-r from-yellow-400 to-yellow-500 text-blue-950 font-extrabold px-2 py-0.5 rounded-md">30</span>
                        seconds, after which you will be logged out automatically.
                    </p>
                </div>
            </div>

            <!-- Progress Section -->
            <div class="mb-5">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-xs font-semibold text-blue-950 uppercase tracking-wide">Time Remaining</span>
                </div>

                <!-- Progress Bar Track -->
                <div class="w-full h-2 bg-gray-200 rounded-full overflow-hidden shadow-inner">
                    <div id="progressBar"
                        class="h-full bg-gradient-to-r from-blue-950 via-blue-800 to-blue-950 rounded-full transition-all duration-1000 ease-linear"
                        style="width: 100%;"></div>
                </div>
            </div>




        </div>

        <!-- Bottom Accent -->
        <div class="h-1.5 bg-gradient-to-r from-blue-950 via-yellow-400 to-blue-950"></div>
    </div>
</div>

<script>
    const idleTime = 300000; // 5 minutes before warning (5 * 60 * 1000 ms)

    const countdownSeconds = 30; // countdown before logout

    let warningTimeout;
    let logoutTimeout;
    let countdownInterval;
    let remaining = countdownSeconds;

    const warningEl = document.getElementById('warning');
    const countdownEl = document.getElementById('countdown');
    const progressBarEl = document.getElementById('progressBar');

    function startCountdown() {
        remaining = countdownSeconds;
        countdownEl.textContent = remaining;
        progressBarEl.style.width = "100%";

        countdownInterval = setInterval(() => {
            remaining--;
            countdownEl.textContent = remaining;
            progressBarEl.style.width = `${(remaining / countdownSeconds) * 100}%`;

            if (remaining <= 0) {
                clearInterval(countdownInterval);
                logoutUser();
            }
        }, 1000);
    }

    function showWarning() {
        warningEl.classList.remove('hidden');
        startCountdown();
    }

    function logoutUser() {
        window.location.href = "/employeelogout"; // Replace with your logout URL
    }

    function resetTimer() {
        clearTimeout(warningTimeout);
        clearTimeout(logoutTimeout);
        clearInterval(countdownInterval);
        warningEl.classList.add('hidden');
        warningTimeout = setTimeout(showWarning, idleTime);
        
        // Also reset the navbar session timer
        if (typeof window.resetSessionTimer === 'function') {
            window.resetSessionTimer();
        }
    }

    function extendSession() {
        resetTimer();
    }

    function logout() {
        logoutUser();
    }

    // Reset on user activity
    ['mousemove', 'keydown', 'scroll', 'click'].forEach(event => {
        window.addEventListener(event, resetTimer);
    });

    // Start timer on page load
    warningTimeout = setTimeout(showWarning, idleTime);
</script>

<style>
    @keyframes slide-in {
        from {
            transform: translateX(400px);
            opacity: 0;
        }

        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    .animate-slide-in {
        animation: slide-in 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }
</style>