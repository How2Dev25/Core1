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
  <section class="relative w-full min-h-screen">

    <!-- Background image with overlay -->
    <div class="absolute inset-0 bg-cover bg-center z-0"
      style="background-image: url('{{ asset('images/defaults/hotel3.jpg') }}');"></div>
    <div class="absolute inset-0 bg-black/40 z-10"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-black/70 z-10"></div>

    <!-- Content container -->
    <div class="relative z-10 w-full h-full flex justify-center items-center p-2 sm:p-4">

      <div class="w-full flex justify-center items-center">
        <div
          class="max-w-4xl w-full bg-white/10 backdrop-blur-lg rounded-xl shadow-2xl border border-white/20 overflow-hidden">

          <div class="grid md:grid-cols-2 gap-0 min-h-[500px] md:min-h-[600px]">
            <!-- Left Side - Form Section -->
            <div class="p-4 sm:p-6 order-2 md:order-1 flex flex-col justify-center">
              <!-- Card Header -->
              <div class="mb-4 text-center">
                <h2 class="text-lg sm:text-xl font-bold text-white">Sign in to your account</h2>
                <p class="text-white/80 text-xs sm:text-sm mt-1">Enter your credentials to continue</p>
              </div>

              <!-- Card Body -->
              <div class="w-full max-w-sm mx-auto sm:max-w-none">
                <form autocomplete="off" action="/guestloginform" method="POST">
                  @csrf
                  <!-- Email Input -->
                  <div class="mb-3">
                    <label class="block text-white/90 text-xs font-medium mb-1.5" for="email">
                      Email
                    </label>
                    <div class="relative">
                      <div class="absolute inset-y-0 left-0 pl-2.5 flex items-center pointer-events-none">
                        <svg class="h-4 w-4 text-white/50" fill="currentColor" viewBox="0 0 20 20">
                          <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                          <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                        </svg>
                      </div>
                      <input id="email" type="text"
                        class="w-full pl-9 pr-3 py-2.5 text-sm bg-white/5 border border-white/20 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-transparent placeholder-white/50"
                        placeholder="user@gmail.com" required name="guest_email">
                    </div>
                  </div>

                  <!-- Password Input with Toggle -->
                  <div class="mb-4">
                    <label class="block text-white/90 text-xs font-medium mb-1.5" for="password">
                      Password
                    </label>
                    <div class="relative">
                      <div class="absolute inset-y-0 left-0 pl-2.5 flex items-center pointer-events-none">
                        <svg class="h-4 w-4 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                      </div>
                      <input id="password" type="password"
                        class="w-full pl-9 pr-9 py-2.5 text-sm bg-white/5 border border-white/20 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-transparent placeholder-white/50"
                        placeholder="•••••••" required name="guest_password">
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

                  @include('logincomponents.captcha')

                  <!-- Forgot Password -->
                  <div class="flex items-center justify-end mb-4">
                    <div class="text-xs">
                      <a href="#" class="font-medium text-blue-400 hover:text-blue-300">
                        Forgot password?
                      </a>
                    </div>
                  </div>

                  @include('logincomponents.loginerror')

                  @error('guest_email')
                    <div
                      class="flex items-start space-x-2 mt-2 mb-2 p-2 bg-red-950/20 border border-red-500/30 rounded-lg">
                      <svg class="w-4 h-4 mt-0.5 flex-shrink-0" style="color: #F7B32B;" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                          d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 00-1 1v4a1 1 0 102 0V7a1 1 0 00-1-1zM9 13a1 1 0 112 0 1 1 0 01-2 0z"
                          clip-rule="evenodd" />
                      </svg>
                      <p class="text-red-300 text-xs font-medium leading-relaxed">
                        {{ $message }}
                      </p>
                    </div>
                  @enderror

                  @error('guest_status')
                    <div
                      class="flex items-start space-x-2 mt-2 mb-2 p-2 bg-red-950/20 border border-red-500/30 rounded-lg">
                      <svg class="w-4 h-4 mt-0.5 flex-shrink-0" style="color: #F7B32B;" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                          d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 00-1 1v4a1 1 0 102 0V7a1 1 0 00-1-1zM9 13a1 1 0 112 0 1 1 0 01-2 0z"
                          clip-rule="evenodd" />
                      </svg>
                      <p class="text-red-300 text-xs font-medium leading-relaxed">
                        {{ $message }}
                      </p>
                    </div>
                  @enderror

                  @if ($errors->has('g-recaptcha-response'))
                    <div
                      class="flex items-start space-x-2 mt-2 mb-2 p-2 bg-red-950/20 border border-red-500/30 rounded-lg">
                      <svg class="w-4 h-4 mt-0.5 flex-shrink-0" style="color: #F7B32B;" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                          d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 00-1 1v4a1 1 0 102 0V7a1 1 0 00-1-1zM9 13a1 1 0 112 0 1 1 0 01-2 0z"
                          clip-rule="evenodd" />
                      </svg>
                      <p class="text-red-300 text-xs font-medium leading-relaxed">
                        {{ $errors->first('g-recaptcha-response') }}
                      </p>
                    </div>
                  @endif

                  <!-- Sign In Button -->
                  <button id="login-btn" type="submit" class="w-full btn-primary btn py-2.5 text-sm font-medium">
                    Sign in
                  </button>
                </form>

                <!-- Register Link -->
                <div class="text-center mt-4">
                  <span class="text-white/70 text-xs">Don't have an account?</span>
                  <a href="/terms" class="ml-1 font-medium text-blue-400 hover:text-blue-300 text-xs">
                    Create new account
                  </a>
                </div>
              </div>
            </div>

            <!-- Right Side - Logo and Alternative Login Options -->
            <div
              class="bg-white/5 p-4 sm:p-6 flex flex-col justify-center border-t md:border-t-0 md:border-l border-white/10 order-1 md:order-2">
              <!-- Logo and Hotel Name -->
              <div class="mb-4 sm:mb-6 text-center">
                <div class="flex justify-center mb-2 sm:mb-3">
                  <!-- Circular white background wrapper for logo -->
                  <a href="/">
                    <div class="bg-white rounded-full p-3 sm:p-4 shadow-lg hover:scale-105 transition-all">
                      <img src="{{ asset('images/logo/sonly.png') }}" alt="Soliera Hotel Logo"
                        class="h-16 w-16 sm:h-24 sm:w-24 object-contain">
                    </div>
                  </a>
                </div>
                <h3 class="text-lg sm:text-xl font-bold text-white mb-1">Soliera Hotel And Restaurant</h3>
                <p class="text-white/70 text-xs">Welcome Back</p>
              </div>

              <!-- Divider -->
              <div class="relative mb-3 sm:mb-4">
                <div class="absolute inset-0 flex items-center">
                  <div class="w-full border-t border-white/20"></div>
                </div>
                <div class="relative flex justify-center text-xs">
                  <span class="px-2 bg-white/5 text-white/50">
                    Quick Access
                  </span>
                </div>
              </div>

              <div class="space-y-2 sm:space-y-3">
                <!-- Google Login -->
                <a href="/auth/google"
                  class="flex items-center justify-center py-2.5 px-3 sm:px-4 bg-white text-gray-800 rounded-lg shadow-md hover:bg-gray-100 hover:shadow-lg transition duration-200 group">
                  <div class="flex items-center space-x-2">
                    <img src="{{ asset('images/defaults/google.png') }}"
                      class="h-4 w-4 sm:h-5 sm:w-5 transition-transform duration-200 group-hover:scale-110"
                      alt="Google">
                    <span
                      class="font-medium text-xs sm:text-sm text-gray-800 group-hover:text-blue-600 transition-colors duration-200">
                      Continue with Google
                    </span>
                  </div>
                </a>

                <!-- Employee Login -->
                <a href="/employeelogin"
                  class="flex items-center justify-center py-2.5 px-3 sm:px-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg shadow-md hover:from-blue-700 hover:to-blue-800 hover:shadow-lg transition duration-200 group">
                  <div class="flex items-center space-x-2">
                    <svg class="h-4 w-4 sm:h-5 sm:w-5 transition-transform duration-200 group-hover:scale-110"
                      fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd"
                        d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z"
                        clip-rule="evenodd" />
                      <path
                        d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z" />
                    </svg>
                    <span class="font-medium text-xs sm:text-sm">
                      Employee Login
                    </span>
                  </div>
                </a>
              </div>

              <!-- Additional Info -->
              <div class="text-center text-white/50 text-xs mt-3 sm:mt-4">
                <p>Secure & encrypted authentication</p>
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