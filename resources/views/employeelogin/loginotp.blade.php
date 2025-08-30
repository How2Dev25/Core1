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
      <div class="bg-white/10 p-3 rounded-full mb-3 sm:mb-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 sm:h-8 sm:w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
        </svg>
      </div>
      <h2 class="text-xl sm:text-2xl font-bold text-white">OTP Verification</h2>
      <p class="text-sm sm:text-base text-white/80 mt-1 sm:mt-2">Enter the 6-digit code sent to your device</p>
    </div>
    
    <!-- OTP Form -->
    <div>
     <form id="otpForm" method="POST" action="/verifyotpemployee">
    @csrf
    
    <!-- Error Message Display -->
    @if(session('loginError'))
        <div class="mb-4 p-4 bg-red-500/20 text-red-100 rounded-lg">
            {{ session('loginError') }}
        </div>
    @endif

    <!-- OTP Input Boxes -->
    <div class="flex justify-between mb-6 sm:mb-8 gap-2 sm:gap-3">
        @for ($i = 1; $i <= 6; $i++)
            <input 
                type="text" 
                name="otp{{ $i }}" 
                maxlength="1"
                class="w-10 h-10 sm:w-12 sm:h-12 text-xl sm:text-2xl text-center bg-white/5 border-2 border-white/20 text-white rounded-lg focus:outline-none focus:border-blue-400 focus:ring-1 focus:ring-blue-400 otp-input" 
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
  <p id="countdown" class="text-sm sm:text-base text-white/80">Resend OTP in 02:00</p>
  <button id="resendBtn" 
          type="button" 
          class="ml-2 text-sm sm:text-base font-medium text-blue-400 hover:text-blue-300 hidden flex items-center gap-2"
          onclick="resendOTP()">
      <span id="resendText">Resend</span>
      <svg id="resendSpinner" class="w-4 h-4 animate-spin hidden text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
      </svg>
  </button>
</div>

    @include('logincomponents.loginerror')

    <!-- Verify Button -->
    <button type="submit" class="w-full btn-primary btn">
        Verify
    </button>
</form>
      
      <!-- Back to Login -->
      <div class="mt-4 sm:mt-6 text-center">
        <a href="/employeelogin" class="text-sm sm:text-base font-medium text-blue-400 hover:text-blue-300 flex items-center justify-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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

  fetch("{{ route('resend.otp') }}", {
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