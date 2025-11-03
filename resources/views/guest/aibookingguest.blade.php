<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  @vite('resources/css/app.css')

  <script src="https://unpkg.com/lucide@latest"></script>

  <title>{{$title}} - Booking And Reservation</title>
  @livewireStyles
</head>
@auth('guest')

  <style>
    @keyframes spin {
      to {
        transform: rotate(360deg);
      }
    }

    @keyframes pulse {

      0%,
      100% {
        opacity: 1;
      }

      50% {
        opacity: .5;
      }
    }

    .animate-spin {
      animation: spin 1s linear infinite;
    }

    .animate-pulse {
      animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }

    .loading-dots::after {
      content: '';
      animation: dots 1.5s steps(5, end) infinite;
    }

    @keyframes dots {

      0%,
      20% {
        content: '';
      }

      40% {
        content: '.';
      }

      60% {
        content: '..';
      }

      80%,
      100% {
        content: '...';
      }
    }
  </style>

  <body class="bg-base-100">
    <div class="flex h-screen overflow-hidden">
      <!-- Sidebar -->
      @include('guest.components.dashboard.sidebar')

      <!-- Main content -->
      <div class="flex flex-col flex-1 overflow-hidden">
        <!-- Navbar -->
        @include('guest.components.dashboard.navbar')

        <!-- Dashboard Content -->
        <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 transition-slow ">
          {{-- Subsystem Name --}}
          <div class="pb-6 border-b border-orange-200 animate-fadeIn mb-8">
            <div class="flex items-center gap-4">
              <div class="p-3 bg-blue-900 rounded-2xl shadow-lg">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M12 2L13.09 8.26L20 9L13.09 9.74L12 16L10.91 9.74L4 9L10.91 8.26L12 2Z" fill="white" />
                  <path d="M12 2L13.09 8.26L20 9L13.09 9.74L12 16L10.91 9.74L4 9L10.91 8.26L12 2Z" fill="url(#gradient)"
                    fill-opacity="0.4" />
                  <defs>
                    <linearGradient id="gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                      <stop offset="0%" style="stop-color:#EA4335" />
                      <stop offset="25%" style="stop-color:#FBBC04" />
                      <stop offset="50%" style="stop-color:#34A853" />
                      <stop offset="75%" style="stop-color:#4285F4" />
                      <stop offset="100%" style="stop-color:#9C27B0" />
                    </linearGradient>
                  </defs>
                </svg>
              </div>
              <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-1">
                  AI Booking Assistant
                </h1>
                <p class="text-sm text-gray-600 flex items-center gap-2">
                  <span>Powered by</span>
                  <span
                    class="inline-flex items-center gap-1 px-2 py-0.5 bg-orange-100 text-orange-700 rounded-full text-xs font-semibold">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M12 2L13.09 8.26L20 9L13.09 9.74L12 16L10.91 9.74L4 9L10.91 8.26L12 2Z"
                        fill="currentColor" />
                    </svg>
                    GEMINI
                  </span>
                </p>
              </div>
            </div>
          </div>
          {{-- Subsystem Name --}}

          <section class="w-full max-w-5xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

              <!-- Main Form Card -->
              <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-xl border border-orange-100 overflow-hidden">
                  <div class="bg-blue-900 p-6">
                    <div class="flex items-center gap-4 text-white">
                      <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none"
                          stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                          <path d="M12 8V4H8" />
                          <rect width="16" height="12" x="4" y="8" rx="2" />
                          <path d="M2 14h2" />
                          <path d="M20 14h2" />
                          <path d="M15 13v2" />
                          <path d="M9 13v2" />
                        </svg>
                      </div>
                      <div>
                        <h2 class="text-2xl font-bold">Find Your Perfect Room</h2>
                        <p class="text-orange-100 text-sm mt-1">Describe your ideal stay in natural language</p>
                      </div>
                    </div>
                  </div>

                  <div class="p-8">
                    <!-- Form -->
                    <form action="/aireserve" method="post" id="aiForm">
                      @csrf
                      <div class="space-y-6">
                        <div>
                          <label class="block text-sm font-semibold text-gray-900 mb-3 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                              <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
                            </svg>
                            Describe your perfect stay
                          </label>
                          <div class="relative">
                            <textarea name="prompt" id="prompt"
                              class="w-full px-4 py-3 border-2 border-orange-200 rounded-xl text-base focus:border-blue-900 focus:ring-4 focus:ring-orange-100 transition-all duration-200 resize-none"
                              rows="6"
                              placeholder="e.g., 'I need a luxury suite for our honeymoon with ocean view and private pool for 5 nights starting next Friday'"></textarea>
                            <div class="absolute bottom-3 right-3 text-xs text-gray-400">
                              <span id="charCount">0</span> characters
                            </div>
                          </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                          class="w-full group relative overflow-hidden bg-gradient-to-r bg-blue-900 text-white font-semibold py-4 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-[1.02] active:scale-[0.98]">
                          <span class="relative z-10 flex items-center justify-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                              class="transition-transform group-hover:scale-110">
                              <path d="M12 2L13.09 8.26L20 9L13.09 9.74L12 16L10.91 9.74L4 9L10.91 8.26L12 2Z" />
                            </svg>
                            Find Perfect Rooms with AI
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                              class="transition-transform group-hover:translate-x-1">
                              <path d="M5 12h14" />
                              <path d="m12 5 7 7-7 7" />
                            </svg>
                          </span>
                          <div
                            class="absolute inset-0 bg-gradient-to-r from-blue-900 to-orange-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                          </div>
                        </button>
                      </div>
                    </form>

                    <!-- Result Container -->
                    <div id="result" class="mt-8 space-y-4"></div>
                  </div>
                </div>
              </div>

              <!-- Sidebar with Tips -->
              <div class="lg:col-span-1 space-y-6">

                <!-- Sample Prompts Card -->
                <div class="bg-blue-900 rounded-2xl shadow-lg border border-orange-200 p-6">
                  <div class="flex items-center gap-3 mb-4">
                    <div class="p-2 bg-blue-900 rounded-lg">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
                      </svg>
                    </div>
                    <h3 class="font-bold text-white text-lg">Sample Prompts</h3>
                  </div>
                  <div class="space-y-3">
                    <button type="button" onclick="document.getElementById('prompt').value = this.innerText"
                      class="w-full text-left p-3 bg-white rounded-lg border border-orange-200 hover:border-orange-500 hover:shadow-md transition-all duration-200 text-sm text-gray-700 hover:text-gray-900 cursor-pointer">
                      Standard room with WiFi for 2 nights from October 10 2025 to October 12 2025
                    </button>
                    <button type="button" onclick="document.getElementById('prompt').value = this.innerText"
                      class="w-full text-left p-3 bg-white rounded-lg border border-orange-200 hover:border-orange-500 hover:shadow-md transition-all duration-200 text-sm text-gray-700 hover:text-gray-900 cursor-pointer">
                      Suite for 4 people from August 5 2025 to August 12 2025 with extra towels
                    </button>
                    <button type="button" onclick="document.getElementById('prompt').value = this.innerText"
                      class="w-full text-left p-3 bg-white rounded-lg border border-orange-200 hover:border-orange-500 hover:shadow-md transition-all duration-200 text-sm text-gray-700 hover:text-gray-900 cursor-pointer">
                      Deluxe room with balcony from September 5 2025 to September 7 2025
                    </button>
                    <button type="button" onclick="document.getElementById('prompt').value = this.innerText"
                      class="w-full text-left p-3 bg-white rounded-lg border border-orange-200 hover:border-orange-500 hover:shadow-md transition-all duration-200 text-sm text-gray-700 hover:text-gray-900 cursor-pointer">
                      Executive room for honeymoon from November 15 2025 to November 22 2025
                    </button>
                  </div>
                </div>

                <!-- Tips Card -->
                <div
                  class="bg-gradient-to-br from-blue-50 to-blue-900/10 rounded-2xl shadow-lg border border-blue-200 p-6">
                  <div class="flex items-center gap-3 mb-4">
                    <div class="p-2 bg-blue-900 rounded-lg">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10" />
                        <path d="M12 16v-4" />
                        <path d="M12 8h.01" />
                      </svg>
                    </div>
                    <h3 class="font-bold text-blue-900 text-lg">Pro Tips</h3>
                  </div>
                  <ul class="space-y-3 text-sm text-blue-900">
                    <li class="flex items-start gap-2">
                      <svg class="w-5 h-5 text-orange-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                          d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                          clip-rule="evenodd" />
                      </svg>
                      <span>Include specific dates for accurate availability</span>
                    </li>
                    <li class="flex items-start gap-2">
                      <svg class="w-5 h-5 text-orange-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                          d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                          clip-rule="evenodd" />
                      </svg>
                      <span>Mention the number of guests staying</span>
                    </li>
                    <li class="flex items-start gap-2">
                      <svg class="w-5 h-5 text-orange-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                          d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                          clip-rule="evenodd" />
                      </svg>
                      <span>Describe desired amenities or features</span>
                    </li>
                    <li class="flex items-start gap-2">
                      <svg class="w-5 h-5 text-orange-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                          d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                          clip-rule="evenodd" />
                      </svg>
                      <span>Specify any special occasions or requirements</span>
                    </li>
                  </ul>
                </div>

              </div>
            </div>
          </section>

          @include('booking.terms')

        </main>

        <script>
          // Character counter
          const textarea = document.getElementById('prompt');
          const charCount = document.getElementById('charCount');

          if (textarea && charCount) {
            textarea.addEventListener('input', function () {
              charCount.textContent = this.value.length;
            });
          }
        </script>

        <style>
          @keyframes fadeIn {
            from {
              opacity: 0;
              transform: translateY(-10px);
            }

            to {
              opacity: 1;
              transform: translateY(0);
            }
          }

          .animate-fadeIn {
            animation: fadeIn 0.5s ease-out;
          }

          .transition-slow {
            transition: all 0.3s ease;
          }
        </style>

        <script>
          // Character counter
          const textarea = document.getElementById('prompt');
          const charCount = document.getElementById('charCount');

          if (textarea && charCount) {
            textarea.addEventListener('input', function () {
              charCount.textContent = this.value.length;
            });
          }
        </script>

        <style>
          @keyframes fadeIn {
            from {
              opacity: 0;
              transform: translateY(-10px);
            }

            to {
              opacity: 1;
              transform: translateY(0);
            }
          }

          .animate-fadeIn {
            animation: fadeIn 0.5s ease-out;
          }

          .transition-slow {
            transition: all 0.3s ease;
          }
        </style>


        <script>
          // Character counter
          const textarea = document.getElementById('prompt');
          const charCount = document.getElementById('charCount');

          if (textarea && charCount) {
            textarea.addEventListener('input', function () {
              charCount.textContent = this.value.length;
            });
          }
        </script>

        <style>
          @keyframes fadeIn {
            from {
              opacity: 0;
              transform: translateY(-10px);
            }

            to {
              opacity: 1;
              transform: translateY(0);
            }
          }

          .animate-fadeIn {
            animation: fadeIn 0.5s ease-out;
          }

          .transition-slow {
            transition: all 0.3s ease;
          }
        </style>
      </div>

    </div>

  </body>

@endauth







<!-- Initialize Lucide Icons -->
<script>
  lucide.createIcons();
</script>







</main>
</div>
</div>





@livewireScripts
@include('javascriptfix.soliera_js')
</body>





</html>