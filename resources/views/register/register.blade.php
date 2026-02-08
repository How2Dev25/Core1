 <!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Soliera Hotel - Registration</title>

    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('mobilevalid/intlTelInput.min.css') }}">
    <script src="{{ asset('mobilevalid/intlTelInput.min.js') }}"></script>
    <script src="{{ asset('mobilevalid/utils.js') }}"></script>
    @vite('resources/css/app.css')
</head>

<body>

    <section class="relative w-full min-h-screen">

        <!-- Background image with overlay -->
        <div class="absolute inset-0 bg-cover bg-center z-0"
            style="background-image: url('{{ asset('images/defaults/hotel3.jpg') }}');"></div>
        <div class="absolute inset-0 bg-black/40 z-10"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-black/70 z-10"></div>

        <!-- Content container -->
        <div class="relative z-10 w-full min-h-screen flex justify-center items-center  p-4">
           

           <div class="w-full flex justify-center items-center max-md:w-full">
  <div class="max-w-4xl w-full bg-white/10 backdrop-blur-lg rounded-xl shadow-2xl border border-white/20 overflow-hidden">

    <div class="grid md:grid-cols-2 gap-0">
      <!-- Left Side - Registration Form -->
      <div class="p-6">
        <!-- Card Header -->
        <div class="mb-4 text-center">
          <h2 class="text-xl font-bold text-white">Complete Your Registration</h2>
          <p class="text-white/80 text-sm mt-1">Fill in your personal details</p>
        </div>

        <!-- Progress Steps -->
        <ul class="steps steps-horizontal w-full mb-4">
          <li class="step step-primary text-white text-xs">Terms</li>
          <li class="step step-primary text-white text-xs">Registration</li>
          <li class="step text-white text-xs">Photo Setup</li>
        </ul>

        <!-- Card Body -->
        <div>
          <form autocomplete="off" action="/registerguest" method="POST">
            @csrf

            <!-- Full Name -->
            <div class="mb-3">
              <label class="block text-white/90 text-xs font-medium mb-1.5" for="guest_name">Full Name</label>
              <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-2.5 flex items-center pointer-events-none">
                  <i class="fas fa-user text-white/50 text-sm"></i>
                </div>
                <input id="guest_name" type="text" placeholder="John Doe" required name="guest_name"
                  class="w-full pl-9 pr-3 py-2 text-sm bg-white/5 border border-white/20 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-transparent placeholder-white/50">
              </div>
            </div>

            <!-- Birthday -->
            <div class="mb-3">
              <label class="block text-white/90 text-xs font-medium mb-1.5" for="guest_birthday">Birthday</label>
              <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-2.5 flex items-center pointer-events-none">
                  <i class="fas fa-birthday-cake text-white/50 text-sm"></i>
                </div>
                <input id="guest_birthday" type="date" required name="guest_birthday"
                  class="w-full pl-9 pr-3 py-2 text-sm bg-white/5 border border-white/20 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-transparent placeholder-white/50">
              </div>
            </div>

            <!-- Mobile Number -->
            <div class="mb-3">
              <label class="block text-white/90 text-xs font-medium mb-1.5">Mobile Number</label>
              <input type="tel" id="contactPhone"
                class="w-full px-3 py-2 text-sm bg-white/5 border border-white/20 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-transparent"
                required />
              <p id="phoneExample" class="text-xs text-white/50 mt-1"></p>
              <p id="phoneError" class="text-xs text-red-400 mt-1 hidden">Please enter a valid mobile number</p>
              <input type="hidden" id="guest_mobile" name="guest_mobile">
            </div>

            <!-- Email -->
            <div class="mb-3">
              <label class="block text-white/90 text-xs font-medium mb-1.5" for="guest_email">Email Address</label>
              <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-2.5 flex items-center pointer-events-none">
                  <i class="fas fa-envelope text-white/50 text-sm"></i>
                </div>
                <input id="guest_email" type="email" placeholder="your@email.com" required name="guest_email"
                  class="w-full pl-9 pr-3 py-2 text-sm bg-white/5 border border-white/20 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-transparent placeholder-white/50">
              </div>
            </div>

            <!-- Password and Confirm Password in Grid -->
            <div class="grid grid-cols-2 gap-3 mb-3">
              <!-- Password -->
              <div>
                <label class="block text-white/90 text-xs font-medium mb-1.5" for="guest_password">Password</label>
                <div class="relative">
                  <div class="absolute inset-y-0 left-0 pl-2.5 flex items-center pointer-events-none">
                    <i class="fas fa-lock text-white/50 text-sm"></i>
                  </div>
                  <input id="guest_password" type="password" required name="guest_password"
                    class="w-full pl-9 pr-9 py-2 text-sm bg-white/5 border border-white/20 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-transparent placeholder-white/50">
                  <span class="absolute inset-y-0 right-2.5 flex items-center cursor-pointer"
                    onclick="togglePassword('guest_password','eye1')">
                    <i id="eye1" class="fas fa-eye text-white/50 text-sm"></i>
                  </span>
                </div>
              </div>

              <!-- Confirm Password -->
              <div>
                <label class="block text-white/90 text-xs font-medium mb-1.5" for="confirm_password">Confirm Password</label>
                <div class="relative">
                  <div class="absolute inset-y-0 left-0 pl-2.5 flex items-center pointer-events-none">
                    <i class="fas fa-lock text-white/50 text-sm"></i>
                  </div>
                  <input id="confirm_password" type="password" required name="guest_password_confirmation"
                    class="w-full pl-9 pr-9 py-2 text-sm bg-white/5 border border-white/20 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-transparent placeholder-white/50">
                  <span class="absolute inset-y-0 right-2.5 flex items-center cursor-pointer"
                    onclick="togglePassword('confirm_password','eye2')">
                    <i id="eye2" class="fas fa-eye text-white/50 text-sm"></i>
                  </span>
                </div>
                <span id="password_error" class="text-red-400 text-xs mt-1 hidden">Passwords do not match</span>
              </div>
            </div>

            <!-- Password Strength Indicator -->
            <div class="mb-3">
              <div class="flex justify-between items-center mb-1">
                <span class="text-white/50 text-xs">Must be 8+ chars, uppercase, numbers & symbols</span>
                <span id="password_strength" class="text-xs font-medium"></span>
              </div>
              <div class="w-full bg-white/20 h-1 rounded">
                <div id="password_strength_bar" class="h-1 rounded transition-all duration-300 w-0"></div>
              </div>
            </div>

            <!-- Address -->
            <div class="mb-4">
              <label class="block text-white/90 text-xs font-medium mb-1.5" for="guest_address">Address</label>
              <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-2.5 flex items-center pointer-events-none">
                  <i class="fas fa-home text-white/50 text-sm"></i>
                </div>
                <input id="guest_address" type="text" placeholder="123 Main St, City, Country" required name="guest_address"
                  class="w-full pl-9 pr-3 py-2 text-sm bg-white/5 border border-white/20 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-transparent placeholder-white/50">
              </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full btn-primary btn py-2 text-sm" id="submitBtn" disabled>
              Continue <i class="fas fa-arrow-right ml-2"></i>
            </button>
          </form>

          <!-- Back link -->
          <div class="mt-3 text-center">
            <a href="/terms" class="font-medium text-blue-400 hover:text-blue-300 text-xs flex items-center justify-center">
              <i class="fas fa-arrow-left mr-2"></i>
              Back to previous step
            </a>
          </div>
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
          <p class="text-white/70 text-xs">Join Our Community</p>
        </div>

        <!-- Divider -->
        <div class="relative mb-4">
          <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-white/20"></div>
          </div>
          <div class="relative flex justify-center text-xs">
            <span class="px-2 bg-white/5 text-white/50">
              Registration Benefits
            </span>
          </div>
        </div>

        <!-- Benefits Cards -->
        <div class="space-y-3">
          <div class="bg-white/10 rounded-lg p-3 border border-white/20">
            <div class="flex items-start space-x-3">
              <svg class="h-5 w-5 text-blue-400 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
              </svg>
              <div>
                <h4 class="text-white font-semibold text-sm mb-1">Quick Booking</h4>
                <p class="text-white/70 text-xs leading-relaxed">
                  Book rooms instantly with saved preferences and payment methods.
                </p>
              </div>
            </div>
          </div>

          <div class="bg-white/10 rounded-lg p-3 border border-white/20">
            <div class="flex items-start space-x-3">
              <svg class="h-5 w-5 text-amber-400 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
              </svg>
              <div>
                <h4 class="text-white font-semibold text-sm mb-1">Exclusive Rewards</h4>
                <p class="text-white/70 text-xs leading-relaxed">
                  Earn points on every stay and enjoy member-only discounts and perks.
                </p>
              </div>
            </div>
          </div>

          <div class="bg-white/10 rounded-lg p-3 border border-white/20">
            <div class="flex items-start space-x-3">
              <svg class="h-5 w-5 text-green-400 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
              </svg>
              <div>
                <h4 class="text-white font-semibold text-sm mb-1">Booking History</h4>
                <p class="text-white/70 text-xs leading-relaxed">
                  Access your complete reservation history and manage upcoming stays.
                </p>
              </div>
            </div>
          </div>

          <div class="bg-white/10 rounded-lg p-3 border border-white/20">
            <div class="flex items-start space-x-3">
              <svg class="h-5 w-5 text-purple-400 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
              </svg>
              <div>
                <h4 class="text-white font-semibold text-sm mb-1">Secure Account</h4>
                <p class="text-white/70 text-xs leading-relaxed">
                  Your data is encrypted and protected with industry-standard security.
                </p>
              </div>
            </div>
          </div>
        </div>

        <!-- Additional Info -->
        <div class="text-center text-white/50 text-xs mt-4">
          <p>Already have an account? <a href="/guestlogin" class="text-blue-400 hover:text-blue-300">Sign in</a></p>
        </div>
      </div>

    </div>
  </div>
</div>



        </div>


    </section>


    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <script src="{{ asset('mobilevalid/registrationvalid.js') }}"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true
        });
    </script>

    <script>
        function togglePassword(inputId, eyeId) {
            const input = document.getElementById(inputId);
            const eye = document.getElementById(eyeId);

            if (input.type === "password") {
                input.type = "text";
                eye.classList.remove("fa-eye");
                eye.classList.add("fa-eye-slash");
            } else {
                input.type = "password";
                eye.classList.remove("fa-eye-slash");
                eye.classList.add("fa-eye");
            }
        }

        const passwordInput = document.getElementById("guest_password");
        const confirmInput = document.getElementById("confirm_password");
        const errorText = document.getElementById("password_error");
        const submitBtn = document.getElementById("submitBtn");
        const strengthText = document.getElementById("password_strength");
        const strengthBar = document.getElementById("password_strength_bar");

        passwordInput.addEventListener("input", validatePassword);
        confirmInput.addEventListener("input", validatePassword);

        function validatePassword() {
            const password = passwordInput.value;
            const confirm = confirmInput.value;
            const strength = getStrength(password);

            strengthText.textContent = strength.label;
            strengthText.className = "text-xs font-medium " + strength.textColor;

            strengthBar.className = "h-1 rounded transition-all duration-300 " + strength.bgColor;
            strengthBar.style.width = strength.width;

            if (confirm !== "" && password !== confirm) {
                errorText.classList.remove("hidden");
                submitBtn.disabled = true;
            } else {
                errorText.classList.add("hidden");
            }

            submitBtn.disabled = !(strength.score >= 2 && password === confirm);
        }

        function getStrength(password) {
            let score = 0;

            if (password.length >= 8) score++;
            if (/[A-Z]/.test(password)) score++;
            if (/[0-9]/.test(password)) score++;
            if (/[^A-Za-z0-9]/.test(password)) score++;

            if (score <= 1) {
                return { label: "Weak Password ", bgColor: "bg-red-500", textColor: "text-red-500", width: "25%", score };
            } else if (score === 2) {
                return { label: "Fair Strength ", bgColor: "bg-yellow-500", textColor: "text-yellow-500", width: "50%", score };
            } else if (score === 3) {
                return { label: "Good Strength ", bgColor: "bg-blue-500", textColor: "text-blue-500", width: "75%", score };
            } else {
                return { label: "Strong Password ", bgColor: "bg-green-500", textColor: "text-green-500", width: "100%", score };
            }
        }
    </script>


</body>

</html>