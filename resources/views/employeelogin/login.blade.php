<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Soliera Hotel - Department Login</title>

  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  @vite('resources/css/app.css')
</head>

<body>
  <section class="relative w-full min-h-screen ">

    <!-- Background image with overlay -->
    <div class="absolute inset-0 bg-cover bg-center z-0"
      style="background-image: url('{{ asset('images/defaults/hotel3.jpg') }}');"></div>
    <div class="absolute inset-0 bg-black/40 z-10"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-black/70 z-10"></div>

    <!-- Content container -->
    <div class="relative z-10 w-full h-full flex justify-center items-center  p-4">
   

     <div class="w-full flex justify-center items-center max-md:w-full">
  <div
    class="max-w-4xl w-full bg-white/10 backdrop-blur-lg rounded-xl shadow-2xl border border-white/20 overflow-hidden">

    <div class="grid md:grid-cols-2 gap-0">
      <!-- Left Side - Form Section -->
      <div class="p-6">
        <!-- Card Header -->
        <div class="mb-4 text-center">
          <h2 class="text-xl font-bold text-white">Employee Login</h2>
          <p class="text-white/80 text-sm mt-1">Enter your credentials to continue</p>
        </div>

        <!-- Card Body -->
        <div>
          <form id="login-form" action="/loginuser" method="POST">
            @csrf
            <input type="hidden" name="login_mode" id="login_mode" value="online">

            <!-- Employee ID -->
            <div class="mb-3">
              <label class="block text-white/90 text-xs font-medium mb-1.5" for="email">Employee ID</label>
              <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-2.5 flex items-center pointer-events-none">
                  <svg class="h-4 w-4 text-white/50" fill="currentColor" viewBox="0 0 20 20">
                    <path
                      d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" />
                  </svg>
                </div>
                <input id="email" type="text" name="employee_id" required
                  class="w-full pl-9 pr-3 py-2 text-sm bg-white/5 border border-white/20 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-transparent placeholder-white/50"
                  placeholder="Your Employee ID">
              </div>
            </div>

            <!-- Password -->
            <div class="mb-4">
              <label class="block text-white/90 text-xs font-medium mb-1.5" for="password">Password</label>
              <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-2.5 flex items-center pointer-events-none">
                  <svg class="h-4 w-4 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                  </svg>
                </div>
                <input id="password" type="password" name="password" required
                  class="w-full pl-9 pr-9 py-2 text-sm bg-white/5 border border-white/20 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-transparent placeholder-white/50"
                  placeholder="••••••••">
                <button type="button"
                  class="absolute inset-y-0 right-0 flex items-center pr-2.5 text-white/50 hover:text-white focus:outline-none"
                  onclick="togglePasswordVisibility()">
                  <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                    <path fill-rule="evenodd"
                      d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                      clip-rule="evenodd" />
                  </svg>
                  <svg id="eye-slash-icon" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 hidden"
                    viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                      d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z"
                      clip-rule="evenodd" />
                    <path
                      d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z" />
                  </svg>
                </button>
              </div>
            </div>

            <!-- Regular Captcha (for online mode) -->
            <div id="captcha-wrapper">
              @include('logincomponents.captcha')
            </div>
            <!-- Offline Algorithm Captcha -->
            @include('logincomponents.offline_captcha')

            <!-- Forgot password -->
            <div class="flex items-center justify-end mb-4">
              <div class="text-xs">
                <a href="#" class="font-medium text-blue-400 hover:text-blue-300">Forgot password?</a>
              </div>
            </div>

            <!-- Login errors -->
            @include('logincomponents.loginerror')

            @error('employee_id')
              <div class="flex items-start space-x-2 mt-2 mb-2 p-2 bg-red-950/20 border border-red-500/30 rounded-lg">
                <svg class="w-4 h-4 mt-0.5 flex-shrink-0" style="color: #F7B32B;" fill="currentColor"
                  viewBox="0 0 20 20">
                  <path fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 00-1 1v4a1 1 0 102 0V7a1 1 0 00-1-1zM9 13a1 1 0 112 0 1 1 0 01-2 0z"
                    clip-rule="evenodd" />
                </svg>
                <p class="text-red-300 text-xs font-medium leading-relaxed">{{ $message }}</p>
              </div>
            @enderror

            @if ($errors->has('g-recaptcha-response'))
              <div class="flex items-start space-x-2 mt-2 mb-2 p-2 bg-red-950/20 border border-red-500/30 rounded-lg">
                <svg class="w-4 h-4 mt-0.5 flex-shrink-0" style="color: #F7B32B;" fill="currentColor"
                  viewBox="0 0 20 20">
                  <path fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 00-1 1v4a1 1 0 102 0V7a1 1 0 00-1-1zM9 13a1 1 0 112 0 1 1 0 01-2 0z"
                    clip-rule="evenodd" />
                </svg>
                <p class="text-red-300 text-xs font-medium leading-relaxed">
                  {{ $errors->first('g-recaptcha-response') }}</p>
              </div>
            @endif

            <!-- Sign In Button -->
            <button id="login-btn" type="submit" class="w-full btn-primary btn py-2 text-sm">Sign in</button>
          </form>

          <script>
            // Auto switch to offline mode if device is offline
            window.addEventListener('DOMContentLoaded', () => {
              const form = document.getElementById('login-form');
              const loginModeInput = document.getElementById('login_mode');

              // Add form validation for all modes
              form.addEventListener('submit', function(e) {
                console.log('Form submitting, login mode:', loginModeInput.value);

                if (loginModeInput.value === 'offline') {
                  console.log('Offline mode detected, checking captcha...');
                  // Only verify captcha if the function exists
                  if (typeof verifyMathCaptcha === 'function') {
                    if (!verifyMathCaptcha()) {
                      console.log('Captcha verification failed, preventing submission');
                      e.preventDefault();
                      return false;
                    }
                    console.log('Captcha verification passed');
                  } else {
                    console.log('verifyMathCaptcha function not found, allowing submission');
                  }
                } else {
                  console.log('Online mode, allowing normal submission');
                }
                // For online mode, let it submit normally
              });

              if (!navigator.onLine) {
                // Update form action and mode
                form.action = '/loginoffline';
                loginModeInput.value = 'offline';

                // Hide regular captcha and show offline captcha
                const captcha = document.getElementById('captcha-wrapper');
                if (captcha) captcha.style.display = 'none';

                // Initialize offline captcha
                if (typeof initOfflineCaptcha === 'function') {
                  initOfflineCaptcha();
                }

                // Create offline notification banner
                const banner = document.createElement('div');
                banner.textContent = 'Offline mode active: Using algorithm captcha for security verification.';
                banner.style.background = 'linear-gradient(135deg, #f39c12 0%, #e67e22 100%)';
                banner.style.color = '#fff';
                banner.style.padding = '12px 20px';
                banner.style.textAlign = 'center';
                banner.style.fontWeight = '600';
                banner.style.fontSize = '14px';
                banner.style.letterSpacing = '0.3px';
                banner.style.boxShadow = '0 2px 4px rgba(0,0,0,0.1)';
                banner.style.borderBottom = '2px solid #d35400';
                banner.style.position = 'sticky';
                banner.style.top = '0';
                banner.style.zIndex = '9999';

                // Insert banner at the beginning of the body
                document.body.prepend(banner);

                // Optional: Add subtle animation
                banner.style.animation = 'fadeInDown 0.5s ease-out';

                // Add CSS for animation if not already present
                if (!document.getElementById('offline-animation-style')) {
                  const style = document.createElement('style');
                  style.id = 'offline-animation-style';
                  style.textContent = `
                            @keyframes fadeInDown {
                                from {
                                    opacity: 0;
                                    transform: translateY(-20px);
                                }
                                to {
                                    opacity: 1;
                                    transform: translateY(0);
                                }
                            }
                        `;
                  document.head.appendChild(style);
                }

                console.log('Form switched to offline login mode with algorithm captcha.');
              }
            });
          </script>

          <!-- Register Link -->
          <div class="text-center mt-4">
            <span class="text-white/70 text-xs">Not an employee?</span>
            <a href="/loginguest" class="ml-1 font-medium text-blue-400 hover:text-blue-300 text-xs">
              Guest Login
            </a>
          </div>
        </div>
      </div>

      <!-- Right Side - Logo and Info -->
      <div class="bg-white/5 p-6 flex flex-col justify-center border-l border-white/10">
        <!-- Logo and Hotel Name -->
        <div class="mb-6 text-center">
          <div class="flex justify-center mb-3">
            <!-- Circular white background wrapper for logo -->
            <a href="/">
            <div class="bg-white rounded-full p-4 shadow-lg hover:scale-105 transition-all">
              <img src="{{ asset('images/logo/sonly.png') }}" alt="Soliera Hotel Logo"
                class="h-24 w-24 object-contain">
            </div>
            </a>
          </div>
          <h3 class="text-xl font-bold text-white mb-1">Soliera Hotel And Restaurant</h3>
          <p class="text-white/70 text-xs">Employee Portal</p>
        </div>

        <!-- Divider -->
        <div class="relative mb-4">
          <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-white/20"></div>
          </div>
          <div class="relative flex justify-center text-xs">
            <span class="px-2 bg-white/5 text-white/50">
              Staff Access Only
            </span>
          </div>
        </div>

        <!-- Employee Info -->
        <div class="space-y-4">
          <div class="bg-white/10 rounded-lg p-4 border border-white/20">
            <div class="flex items-start space-x-3">
              <svg class="h-5 w-5 text-blue-400 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                  d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                  clip-rule="evenodd" />
              </svg>
              <div>
                <h4 class="text-white font-semibold text-sm mb-1">Employee Access</h4>
                <p class="text-white/70 text-xs leading-relaxed">
                  Use your employee ID and password to access the staff portal and management systems.
                </p>
              </div>
            </div>
          </div>

          <div class="bg-white/10 rounded-lg p-4 border border-white/20">
            <div class="flex items-start space-x-3">
              <svg class="h-5 w-5 text-green-400 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                  d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                  clip-rule="evenodd" />
              </svg>
              <div>
                <h4 class="text-white font-semibold text-sm mb-1">Secure Login</h4>
                <p class="text-white/70 text-xs leading-relaxed">
                  Your credentials are encrypted and protected with advanced security measures.
                </p>
              </div>
            </div>
          </div>
        </div>

        <!-- Additional Info -->
        <div class="text-center text-white/50 text-xs mt-4">
          <p>Need help? Contact IT Support</p>
        </div>
      </div>

    </div>
  </div>
</div>


    </div>


  </section>

  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">





  <script>
    AOS.init({
      duration: 1000,
      once: true
    });
  </script>

  <script>
    function togglePasswordVisibility() {
      const passwordInput = document.getElementById('password');
      const eyeIcon = document.getElementById('eye-icon');
      const eyeSlashIcon = document.getElementById('eye-slash-icon');

      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.classList.add('hidden');
        eyeSlashIcon.classList.remove('hidden');
      } else {
        passwordInput.type = 'password';
        eyeIcon.classList.remove('hidden');
        eyeSlashIcon.classList.add('hidden');
      }
    }


  </script>


</body>

</html>