<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Soliera Hotel - Terms & Conditions</title>
  
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  @vite('resources/css/app.css')
</head>
<body>
    
<section class="relative w-full min-h-screen">

  <!-- Background -->
  <div class="absolute inset-0 bg-cover bg-center z-0" style="background-image: url('{{ asset('images/defaults/hotel3.jpg') }}');"></div>
  <div class="absolute inset-0 bg-black/40 z-10"></div>
  <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-black/70 z-10"></div>
  
  <!-- Content container -->
  <div class="relative z-10 w-full min-h-screen flex justify-center items-center p-4 flex-col md:flex-row">

    <!-- Left side branding -->
    <div class="w-full md:w-1/2 flex justify-center items-center p-8">
      <div class="max-w-md space-y-10">
        <!-- Logo -->
        <div data-aos="zoom-in" data-aos-delay="100">
          <a href="/">
            <img class="w-full max-h-52 hover:scale-105 transition-transform" 
                 src="{{asset('images/logo/logofinal.png')}}" 
                 alt="Soliera Hotel & Restaurant">
          </a>
        </div>

        <!-- Benefits Section -->
        <div class="space-y-6">
          <div class="space-y-4">
            <!-- Benefit Example -->
            <div class="flex items-start gap-3" data-aos="fade-up" data-aos-delay="300">
              <div class="p-2 bg-amber-400/10 rounded-lg">
                <i class="fas fa-bolt text-amber-400"></i>
              </div>
              <div>
                <h4 class="font-medium text-white">Faster Bookings</h4>
                <p class="text-sm text-white/70">One-click reservations with saved preferences</p>
              </div>
            </div>

            <div class="flex items-start gap-3" data-aos="fade-up" data-aos-delay="350">
              <div class="p-2 bg-amber-400/10 rounded-lg">
                <i class="fas fa-star text-amber-400"></i>
              </div>
              <div>
                <h4 class="font-medium text-white">Reward Points</h4>
                <p class="text-sm text-white/70">Earn points for every stay that you can redeem</p>
              </div>
            </div>

            <div class="flex items-start gap-3" data-aos="fade-up" data-aos-delay="400">
              <div class="p-2 bg-amber-400/10 rounded-lg">
                <i class="fas fa-bell text-amber-400"></i>
              </div>
              <div>
                <h4 class="font-medium text-white">Personalized Alerts</h4>
                <p class="text-sm text-white/70">Get notified about special events and promotions</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Right side Terms & Conditions -->
    <div class="w-full md:w-1/2 flex justify-center items-center">
      <div class="max-w-md w-full bg-white/10 backdrop-blur-lg p-6 rounded-xl shadow-2xl border border-white/20">
        
        <!-- Header -->
        <div class="mb-6 text-center flex justify-center items-center flex-col">
          <h2 class="text-2xl font-bold text-white">Terms & Conditions</h2>
          <p class="text-white/80 mt-1">Please review carefully before continuing</p>
        </div>

          <ul class="steps steps-horizontal lg:steps-horizontal w-full mb-5">
                <li class="step step-primary text-white">Terms</li>
                <li class="step  text-white">Registration</li>
                <li class="step text-white">Photo Setup</li>
            </ul>
        <!-- Scrollable T&C -->
        <div class="h-80 overflow-y-auto p-4 rounded-lg bg-white/5 border border-white/10 space-y-4 text-white/90 text-sm">
          
          <h3 class="text-lg font-semibold text-amber-400">1. General Policy</h3>
         <p class="text-white/80 leading-relaxed">
  Guests are required to <span class="font-bold text-amber-300">confirm their reservation on or before 6:00 PM</span> 
  on the day of arrival. Failure to confirm by this time may result in the automatic cancellation of the booking. 
  Guests will be <span class="italic">notified prior to any cancellation</span> for proper acknowledgment.
</p>

          <h3 class="text-lg font-semibold text-amber-400">2. Booking & Cancellation</h3>
          <p class="text-white/80">
            Cancellations must be made at least 24 hours prior to arrival to avoid charges. 
            No-shows will be charged the first night’s stay.
          </p>

          <h3 class="text-lg font-semibold text-amber-400">3. Data Privacy Act of 2012</h3>
          <p class="text-white/80 leading-relaxed">
            In compliance with the <span class="font-bold text-amber-300">Data Privacy Act of 2012 (Republic Act No. 10173)</span>, 
            Soliera Hotel & Restaurant is committed to protecting the personal information of our guests. 
            All personal data provided will be <span class="italic">collected, processed, and stored securely</span> 
            and will only be used for legitimate purposes such as reservations, billing, and customer service. 
            Your information will not be shared with third parties without your consent, except when required by law.
          </p>

          <h3 class="text-lg font-semibold text-amber-400">4. Guest Responsibilities</h3>
          <p class="text-white/80">
            Guests are expected to conduct themselves respectfully and follow hotel rules. 
            Damages caused will be charged accordingly.
          </p>

        </div>

        <!-- Checkbox & Button -->
        <div class="mt-6">
          <label class="flex items-center gap-2 text-white/80">
            <input type="checkbox" id="agree" class="w-4 h-4 accent-amber-400">
            <span>I have read and agree to the Terms & Conditions</span>
          </label>

          <button 
            onclick="redirect()"
            id="continueBtn"
            disabled
            class="btn btn-primary w-full mt-2"
          >
            Continue <i class="fas fa-arrow-right ml-2"></i>
          </button>
        </div>
      </div>
    </div>

  </div>

</section>

<!-- AOS Animation -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
<script>
  AOS.init({
    duration: 1000,
    once: true
  });
</script>

<!-- Checkbox toggle -->
<script>
  const checkbox = document.getElementById('agree');
  const btn = document.getElementById('continueBtn');

  checkbox.addEventListener('change', () => {
    if (checkbox.checked) {
      btn.disabled = false;
      btn.classList.remove('bg-gray-400', 'cursor-not-allowed');
      btn.classList.add('bg-amber-500', 'hover:bg-amber-600');
    } else {
      btn.disabled = true;
      btn.classList.add('bg-gray-400', 'cursor-not-allowed');
      btn.classList.remove('bg-amber-500', 'hover:bg-amber-600');
    }
  });

  function redirect(){
    window.location.href = "/register";
  }
</script>

</body>
</html>
