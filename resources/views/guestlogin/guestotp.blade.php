<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Soliera Hotel - OTP Verification</title>
    
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @vite('resources/css/app.css')
</head>

    

<body>
   <section class="relative w-full min-h-screen">

  <!-- Background image with overlay -->
  <div class="absolute inset-0 bg-cover bg-center z-0" style="background-image: url('{{ asset('images/defaults/hotel3.jpg') }}');"></div>
    <div class="absolute inset-0 bg-black/40 z-10"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-black/70 z-10"></div>
  
  <!-- Content container -->
<div class="relative z-10 w-full min-h-screen flex justify-center items-center p-4 sm:p-6">
  <!-- OTP Card -->
<div class="w-full max-w-md bg-white/10 backdrop-blur-lg p-6 sm:p-8 rounded-xl shadow-2xl border border-white/20">
    <!-- Card Header -->
    <div class="mb-6 sm:mb-8 text-center flex justify-center items-center flex-col">
      <div class="bg-gradient-to-br from-amber-400/20 to-yellow-500/20 p-4 rounded-full mb-3 sm:mb-4 ring-2 ring-amber-400/30">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 sm:h-10 sm:w-10" style="color: #F7B32B;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
          <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205 3 1m1.5.5-1.5-.5M6.75 7.364V3h-3v18m3-13.636 10.5-3.819" />
        </svg>
      </div>
      <h2 class="text-xl sm:text-2xl font-bold text-white mb-1">Guest Verification</h2>
      <p class="text-sm sm:text-base text-white/80 mt-1 sm:mt-2">Enter the 6-digit code sent to your device</p>
      <div class="flex items-center justify-center mt-2 text-xs text-white/60">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        Secure Hotel Access
      </div>
    </div>
    
    <!-- OTP Form -->
    <div>
     <form id="otpForm" method="POST" action="/verifyguestotp">
    @csrf
    
    <!-- Error Message Display -->
    @if(session('loginError'))
        <div class="mb-4 p-4 bg-red-500/20 text-red-100 rounded-lg border-l-4 border-red-400">
            <div class="flex items-start space-x-3">
                <svg class="w-5 h-5 mt-0.5" style="color: #F7B32B;" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
                <span class="font-medium">{{ session('loginError') }}</span>
            </div>
        </div>
    @endif

    <!-- OTP Input Boxes -->
    <div class="flex justify-between mb-6 sm:mb-8 gap-2 sm:gap-3">
        @for ($i = 1; $i <= 6; $i++)
            <input 
                type="text" 
                name="otp{{ $i }}" 
                maxlength="1"
                class="w-10 h-10 sm:w-12 sm:h-12 text-xl sm:text-2xl text-center bg-white/5 border-2 border-white/20 text-white rounded-lg focus:outline-none focus:border-amber-400 focus:ring-2 focus:ring-amber-400/50 otp-input transition-all duration-200 hover:border-white/30" 
                oninput="moveToNext(this, 'otp{{ $i + 1 }}')" 
                autocomplete="off"
                required
                inputmode="numeric"
                pattern="[0-9]*"
            >
        @endfor
    </div>

    <!-- Timer and Resend -->
   <div class="flex items-center justify-center mb-6 sm:mb-8">
      <div class="flex items-center text-sm sm:text-base text-white/80">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <p id="countdown">Resend OTP in 02:00</p>
      </div>
      <button id="resendBtn" 
              type="button" 
              class="ml-4 text-sm sm:text-base font-medium text-amber-400 hover:text-amber-300 hidden flex items-center gap-2 px-3 py-1 rounded-md hover:bg-white/5 transition-all duration-200"
              onclick="resendOTP()">
          <span id="resendText">Resend Code</span>
          <svg id="resendSpinner" class="w-4 h-4 animate-spin hidden text-amber-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
          </svg>
      </button>
  </div>

    @include('logincomponents.loginerror')

    <!-- Verify Button -->
    <button type="submit" class="w-full btn-primary btn bg-gradient-to-r from-amber-500 to-yellow-600 hover:from-amber-600 hover:to-yellow-700 text-white font-semibold py-3 px-6 rounded-lg transition-all duration-200 transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-amber-400/50 shadow-lg">
        <div class="flex items-center justify-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          Verify & Continue
        </div>
    </button>
</form>
      
      <!-- Back to Login -->
      <div class="mt-4 sm:mt-6 text-center">
        <a href="/loginguest" class="text-sm sm:text-base font-medium text-amber-400 hover:text-amber-300 flex items-center justify-center group transition-all duration-200">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 mr-2 group-hover:-translate-x-1 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
          </svg>
          Back to Login
        </a>
      </div>
    </div>
  </div>
</div>

</section>

<script>
/* ---------------- OTP Navigation ---------------- */
function moveToNext(current, nextFieldId) {
  if (current.value.length >= current.maxLength) {
    if (nextFieldId) {
      document.getElementsByName(nextFieldId)[0].focus();
    }
  }

  // Auto-submit when last field is filled
  if (current.name === 'otp6' && current.value.length === 1) {
    document.getElementById('otpForm').submit();
  }
}

document.addEventListener('DOMContentLoaded', function () {
  const otpInputs = document.querySelectorAll('.otp-input');

  // Handle paste event
  document.getElementById('otpForm').addEventListener('paste', function (e) {
    e.preventDefault();
    const pasteData = e.clipboardData.getData('text/plain').trim();
    if (/^\d{6}$/.test(pasteData)) {
      otpInputs.forEach((input, i) => (input.value = pasteData[i]));
      otpInputs[5].focus();
    }
  });

  // Handle backspace/delete navigation
  otpInputs.forEach((input, index) => {
    input.addEventListener('keydown', function (e) {
      if (e.key === 'Backspace' && !this.value && index > 0) {
        otpInputs[index - 1].focus();
      }
    });
  });
});

/* ---------------- Countdown Timer ---------------- */
let timeLeft = 120; // 2 minutes
let timer = null;

const countdownEl = document.getElementById('countdown');
const resendBtn = document.getElementById('resendBtn');
const resendText = document.getElementById('resendText');
const resendSpinner = document.getElementById('resendSpinner');

function updateCountdown() {
  const minutes = Math.floor(timeLeft / 60);
  const seconds = timeLeft % 60;
  countdownEl.textContent = `Resend OTP in ${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

  if (timeLeft <= 0) {
    clearInterval(timer);
    countdownEl.classList.add('hidden');
    resendBtn.classList.remove('hidden');
    resendBtn.disabled = false;
    resendText.textContent = "Resend";
    resendSpinner.classList.add("hidden");
  } else {
    timeLeft--;
  }
}

function startCountdown() {
  clearInterval(timer);
  updateCountdown();
  timer = setInterval(updateCountdown, 1000);
}

/* ---------------- Resend OTP ---------------- */
function resendOTP() {
  // disable + show spinner
  resendBtn.disabled = true;
  resendText.textContent = "Sending…";
  resendSpinner.classList.remove("hidden");

  fetch("{{ route('resendguest.otp') }}", {
    method: "POST",
    headers: {
      "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
      "Content-Type": "application/json"
    },
    body: JSON.stringify({})
  })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        // Reset countdown
        timeLeft = 120;
        countdownEl.textContent = `Resend OTP in 02:00`;
        countdownEl.classList.remove('hidden');
        resendBtn.classList.add('hidden');

        startCountdown();

        // Clear OTP fields
        document.querySelectorAll('.otp-input').forEach(input => (input.value = ''));
        document.getElementsByName('otp1')[0].focus();
      } else {
        resendBtn.disabled = false;
        resendText.textContent = "Resend";
        resendSpinner.classList.add("hidden");
        alert(data.message || "Failed to resend OTP.");
      }
    })
    .catch(() => {
      resendBtn.disabled = false;
      resendText.textContent = "Resend";
      resendSpinner.classList.add("hidden");
      alert("Something went wrong. Please try again.");
    });
}

/* ---------------- Init ---------------- */
startCountdown();
</script>

</body>


</html>