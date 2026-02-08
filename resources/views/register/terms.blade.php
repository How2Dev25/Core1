<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Soliera Hotel - Terms & Conditions</title>

  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  @vite('resources/css/app.css')
</head>

<body>

  <section class="relative w-full min-h-screen">

    <!-- Background -->
    <div class="absolute inset-0 bg-cover bg-center z-0"
      style="background-image: url('{{ asset('images/defaults/hotel3.jpg') }}');"></div>
    <div class="absolute inset-0 bg-black/40 z-10"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-black/70 z-10"></div>

    <!-- Content container -->
    <div class="relative z-10 w-full min-h-screen flex justify-center items-center p-4 flex-col md:flex-row">

      <!-- Left side branding -->
   

      <!-- Right side Terms & Conditions -->
    <div class="w-full flex justify-center items-center">
      <div
        class="max-w-4xl w-full bg-white/10 backdrop-blur-lg rounded-xl shadow-2xl border border-white/20 overflow-hidden">
    
        <div class="grid md:grid-cols-2 gap-0">
          <!-- Left Side - Terms & Conditions -->
          <div class="p-6">
            <!-- Header -->
            <div class="mb-4 text-center">
              <h2 class="text-xl font-bold text-white">Terms & Conditions</h2>
              <p class="text-white/80 text-sm mt-1">Please review carefully before continuing</p>
            </div>
    
            <!-- Progress Steps -->
            <ul class="steps steps-horizontal w-full mb-4">
              <li class="step step-primary text-white text-xs">Terms</li>
              <li class="step text-white text-xs">Registration</li>
              <li class="step text-white text-xs">Photo Setup</li>
            </ul>
    
            <!-- Scrollable T&C -->
            <div
              class="h-64 overflow-y-auto p-3 rounded-lg bg-white/5 border border-white/10 space-y-3 text-white/90 text-xs">
    
              <h3 class="text-sm font-semibold text-amber-400">1. General Policy</h3>
              <p class="text-white/80 leading-relaxed">
                Guests are required to <span class="font-bold text-amber-300">confirm their reservation on or before 6:00
                  PM</span>
                on the day of arrival. Failure to confirm by this time may result in the automatic cancellation of the
                booking.
                Guests will be <span class="italic">notified prior to any cancellation</span> for proper acknowledgment.
              </p>
    
              <h3 class="text-sm font-semibold text-amber-400">2. Booking & Cancellation</h3>
              <p class="text-white/80">
                Cancellations must be made at least 24 hours prior to arrival to avoid charges.
                No-shows will be charged the first night's stay.
              </p>
    
              <h3 class="text-sm font-semibold text-amber-400">3. Data Privacy Act of 2012</h3>
              <p class="text-white/80 leading-relaxed">
                In compliance with the <span class="font-bold text-amber-300">Data Privacy Act of 2012 (Republic Act No.
                  10173)</span>,
                Soliera Hotel & Restaurant is committed to protecting the personal information of our guests.
                All personal data provided will be <span class="italic">collected, processed, and stored securely</span>
                and will only be used for legitimate purposes such as reservations, billing, and customer service.
                Your information will not be shared with third parties without your consent, except when required by law.
              </p>
    
              <h3 class="text-sm font-semibold text-amber-400">4. Consumer Protection</h3>
              <p class="text-white/80 leading-relaxed">
                In line with the <span class="font-bold text-amber-300">Consumer Act of the Philippines (Republic Act No.
                  7394)</span>,
                Soliera Hotel & Restaurant upholds fair trade practices and ensures the safety and quality of its services.
                Guests have the right to accurate information, fair pricing, and protection against deceptive, unfair, or
                unconscionable sales practices.
              </p>
    
              <h3 class="text-sm font-semibold text-amber-400">5. Electronic Commerce</h3>
              <p class="text-white/80 leading-relaxed">
                In accordance with the <span class="font-bold text-amber-300">Electronic Commerce Act of 2000 (Republic Act
                  No. 8792)</span>,
                Soliera Hotel & Restaurant recognizes the validity and enforceability of electronic transactions.
                Online reservations, payments, and communications conducted through our platform are considered legally
                binding and secure.
              </p>
    
              <h3 class="text-sm font-semibold text-amber-400">6. Guest Responsibilities</h3>
              <p class="text-white/80">
                Guests are expected to conduct themselves respectfully and follow hotel rules.
                Damages caused will be charged accordingly.
              </p>
    
            </div>
    
            <!-- Checkbox & Button -->
            <div class="mt-4">
              <label class="flex items-center gap-2 text-white/80 text-xs">
                <input type="checkbox" id="agree" class="w-4 h-4 accent-amber-400">
                <span>I have read and agree to the Terms & Conditions</span>
              </label>
    
              <button onclick="redirect()" id="continueBtn" disabled class="btn btn-primary w-full mt-3 py-2 text-sm">
                Continue <i class="fas fa-arrow-right ml-2"></i>
              </button>
            </div>
          </div>
    
          <!-- Right Side - Logo and Information -->
          <div class="bg-white/5 p-6 flex flex-col justify-center border-l border-white/10">
            <!-- Logo and Hotel Name -->
            <div class="mb-6 text-center">
              <div class="flex justify-center mb-3">
                <!-- Circular white background wrapper for logo -->
                <div class="bg-white rounded-full p-4 shadow-lg">
                  <img src="{{ asset('images/logo/sonly.png') }}" alt="Soliera Hotel Logo" class="h-24 w-24 object-contain">
                </div>
              </div>
              <h3 class="text-xl font-bold text-white mb-1">Soliera Hotel And Restaurant</h3>
              
            </div>
    
            <!-- Divider -->
            <div class="relative mb-4">
              <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-white/20"></div>
              </div>
              <div class="relative flex justify-center text-xs">
                <span class="px-2 bg-white/5 text-white/50">
                  Legal Compliance
                </span>
              </div>
            </div>
    
            <!-- Information Cards -->
            <div class="space-y-3">
              <div class="bg-white/10 rounded-lg p-3 border border-white/20">
                <div class="flex items-start space-x-3">
                  <svg class="h-5 w-5 text-amber-400 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                      d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                      clip-rule="evenodd" />
                  </svg>
                  <div>
                    <h4 class="text-white font-semibold text-sm mb-1">Your Privacy Matters</h4>
                    <p class="text-white/70 text-xs leading-relaxed">
                      We comply with the Data Privacy Act of 2012 to protect your personal information.
                    </p>
                  </div>
                </div>
              </div>
    
              <div class="bg-white/10 rounded-lg p-3 border border-white/20">
                <div class="flex items-start space-x-3">
                  <svg class="h-5 w-5 text-blue-400 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                      d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                      clip-rule="evenodd" />
                  </svg>
                  <div>
                    <h4 class="text-white font-semibold text-sm mb-1">Fair & Transparent</h4>
                    <p class="text-white/70 text-xs leading-relaxed">
                      Our services comply with consumer protection laws ensuring fair practices.
                    </p>
                  </div>
                </div>
              </div>
    
              <div class="bg-white/10 rounded-lg p-3 border border-white/20">
                <div class="flex items-start space-x-3">
                  <svg class="h-5 w-5 text-green-400 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                      d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                      clip-rule="evenodd" />
                  </svg>
                  <div>
                    <h4 class="text-white font-semibold text-sm mb-1">Secure Transactions</h4>
                    <p class="text-white/70 text-xs leading-relaxed">
                      All online bookings are protected under the Electronic Commerce Act.
                    </p>
                  </div>
                </div>
              </div>
            </div>
    
            <!-- Additional Info -->
            <div class="text-center text-white/50 text-xs mt-4">
              <p>Questions? Contact us at support@soliera.com</p>
            </div>
          </div>
    
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

    function redirect() {
      window.location.href = "/register";
    }
  </script>

</body>

</html>