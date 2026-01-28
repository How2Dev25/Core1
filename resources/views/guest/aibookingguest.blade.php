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
                            <!-- Typing Suggestions Dropdown -->
                            <div id="suggestionsDropdown" class="absolute top-full left-0 right-0 mt-1 bg-white rounded-lg shadow-lg border border-gray-200 hidden z-10">
                              <div class="max-h-48 overflow-y-auto">
                                <div id="suggestionsList" class="p-2 space-y-1"></div>
                              </div>
                            </div>
                            <!-- Smart Date Suggestions -->
                            <div id="dateSuggestions" class="absolute top-full left-0 right-0 mt-1 bg-white rounded-lg shadow-lg border border-gray-200 hidden z-10">
                              <div class="p-3">
                                <p class="text-sm font-semibold text-gray-700 mb-2">📅 Quick Date Options:</p>
                                <div id="dateOptions" class="space-y-1"></div>
                              </div>
                            </div>
                            <div class="absolute bottom-3 right-3 text-xs text-gray-400 flex items-center gap-2">
                              <span id="charCount">0</span> characters
                              <span id="typingIndicator" class="hidden text-blue-500">
                                <svg class="animate-spin h-3 w-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                              </span>
                            </div>
                          </div>
                        </div>

                        <!-- Submit Button with Loading State -->
                        <button type="submit" id="submitBtn"
                          class="w-full group relative overflow-hidden bg-gradient-to-r bg-blue-900 text-white font-semibold py-4 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-[1.02] active:scale-[0.98] disabled:opacity-50 disabled:cursor-not-allowed">
                          <span class="relative z-10 flex items-center justify-center gap-3" id="submitBtnText">
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
                          <!-- Loading State -->
                          <span class="relative z-10 flex items-center justify-center gap-3 hidden" id="submitBtnLoading">
                            <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            AI is searching for perfect rooms...
                          </span>
                          <div
                            class="absolute inset-0 bg-gradient-to-r from-blue-900 to-orange-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                          </div>
                        </button>
                      </div>
                    </form>

                    <!-- Enhanced Result Container with Loading -->
                    <div id="result" class="mt-8 space-y-4">
                      <!-- Loading State -->
                      <div id="loadingState" class="hidden">
                        <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-200">
                          <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                              <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                <svg class="animate-spin h-5 w-5 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                              </div>
                            </div>
                            <div class="flex-1">
                              <p class="text-sm font-medium text-gray-900">AI is analyzing your request...</p>
                              <p class="text-sm text-gray-500">Finding the perfect rooms for your stay</p>
                              <div class="mt-2 w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-blue-600 h-2 rounded-full animate-pulse" style="width: 60%"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Sidebar with Tips -->
              <div class="lg:col-span-1 space-y-6">

                <!-- Sample Prompts Card -->
            <div class="bg-blue-900 rounded-2xl shadow-lg border border-orange-200 p-6">
              <div class="flex flex-col h-full">
                <!-- Sample Prompts Section -->
                <div class="mb-6">
                  <div class="flex items-center gap-3 mb-4">
                    <div class="p-2 bg-blue-900 rounded-lg">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
                      </svg>
                    </div>
                    <h3 class="font-bold text-white text-lg">Sample Prompts</h3>
                  </div>
                  <div class="space-y-3 overflow-y-auto max-h-48 pr-2">
                    <button type="button" onclick="document.getElementById('prompt').value = this.innerText"
                      class="w-full text-left p-3 bg-white rounded-lg border border-orange-200 hover:border-orange-500 hover:shadow-md transition-all duration-200 text-sm text-gray-700 hover:text-gray-900 cursor-pointer">
                      Standard room with WiFi for 2 adults, 1 child from October 10 2025 to October 12 2025
                    </button>
                    <button type="button" onclick="document.getElementById('prompt').value = this.innerText"
                      class="w-full text-left p-3 bg-white rounded-lg border border-orange-200 hover:border-orange-500 hover:shadow-md transition-all duration-200 text-sm text-gray-700 hover:text-gray-900 cursor-pointer">
                      Suite for 2 adults, 2 children from August 5 2025 to August 12 2025 with extra towels
                    </button>
                    <button type="button" onclick="document.getElementById('prompt').value = this.innerText"
                      class="w-full text-left p-3 bg-white rounded-lg border border-orange-200 hover:border-orange-500 hover:shadow-md transition-all duration-200 text-sm text-gray-700 hover:text-gray-900 cursor-pointer">
                      Deluxe room for 3 adults from September 5 2025 to September 7 2025
                    </button>
                    <button type="button" onclick="document.getElementById('prompt').value = this.innerText"
                      class="w-full text-left p-3 bg-white rounded-lg border border-orange-200 hover:border-orange-500 hover:shadow-md transition-all duration-200 text-sm text-gray-700 hover:text-gray-900 cursor-pointer">
                      Executive room for 2 adults honeymoon from November 15 2025 to November 22 2025
                    </button>
                  </div>
                </div>

                <!-- Divider -->
                <div class="border-t border-orange-200/30 my-4"></div>

                <!-- Pro Tips Section -->
                <div class="flex-1">
                  <div class="flex items-center gap-3 mb-4">
                    <div class="p-2 bg-blue-900 rounded-lg">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10" />
                        <path d="M12 16v-4" />
                        <path d="M12 8h.01" />
                      </svg>
                    </div>
                    <h3 class="font-bold text-white text-lg">Pro Tips</h3>
                  </div>
                  <ul class="space-y-3 text-sm text-white overflow-y-auto max-h-48 pr-2">
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

              </div>
            </div>
          </section>

          @include('booking.terms')

        </main>

        <script>
          // Enhanced AI Booking JavaScript
          const textarea = document.getElementById('prompt');
          const charCount = document.getElementById('charCount');
          const typingIndicator = document.getElementById('typingIndicator');
          const suggestionsDropdown = document.getElementById('suggestionsDropdown');
          const suggestionsList = document.getElementById('suggestionsList');
          const dateSuggestions = document.getElementById('dateSuggestions');
          const dateOptions = document.getElementById('dateOptions');
          const submitBtn = document.getElementById('submitBtn');
          const submitBtnText = document.getElementById('submitBtnText');
          const submitBtnLoading = document.getElementById('submitBtnLoading');
          const loadingState = document.getElementById('loadingState');
          const aiForm = document.getElementById('aiForm');

          // Smart suggestions data
          const suggestions = [
            'luxury suite with ocean view',
            'deluxe room with city view',
            'standard room with garden view',
            'honeymoon package',
            'family room for kids',
            'business suite with workspace',
            'early check-in at 10 AM',
            'late check-out at 3 PM',
            'extra pillows and blankets',
            'room with balcony',
            'connecting rooms',
            'pet-friendly accommodation',
            'accessible room',
            'spa access included',
            'breakfast included',
            'airport transfer',
            'high-speed WiFi',
            'kitchen facilities',
            'jacuzzi bathtub',
            'king size bed',
            'twin beds',
            'rollaway bed',
            '2 adults 1 child',
            '1 adult 2 children',
            '3 adults',
            '2 adults',
            'family of 4',
            'couple getaway',
            'solo traveler',
            'business trip',
            'vacation with kids'
          ];

          // Date suggestions
          function generateDateSuggestions() {
            const today = new Date();
            const options = [];
            
            // Weekend suggestions
            const nextWeekend = new Date(today);
            nextWeekend.setDate(today.getDate() + (7 - today.getDay()));
            options.push({
              text: `This weekend (${nextWeekend.toLocaleDateString()})`,
              value: `${nextWeekend.toLocaleDateString()} to ${new Date(nextWeekend.getTime() + 86400000 * 2).toLocaleDateString()}`
            });
            
            // Next week
            const nextWeek = new Date(today);
            nextWeek.setDate(today.getDate() + 7);
            options.push({
              text: `Next week (${nextWeek.toLocaleDateString()})`,
              value: `${nextWeek.toLocaleDateString()} to ${new Date(nextWeek.getTime() + 86400000 * 7).toLocaleDateString()}`
            });
            
            // Month end
            const monthEnd = new Date(today.getFullYear(), today.getMonth() + 1, 0);
            if (monthEnd > today) {
              options.push({
                text: `End of month (${monthEnd.toLocaleDateString()})`,
                value: `${monthEnd.toLocaleDateString()} to ${new Date(monthEnd.getTime() + 86400000 * 3).toLocaleDateString()}`
              });
            }
            
            // Special dates (holidays, etc.)
            options.push({
              text: 'Christmas holiday (December 24-26)',
              value: 'December 24, 2025 to December 26, 2025'
            });
            
            options.push({
              text: 'New Year celebration (December 31 - January 2)',
              value: 'December 31, 2025 to January 2, 2026'
            });
            
            return options;
          }

          // Typing indicator
          let typingTimer;
          textarea.addEventListener('input', function () {
            charCount.textContent = this.value.length;
            
            // Show typing indicator
            typingIndicator.classList.remove('hidden');
            
            // Clear existing timer
            clearTimeout(typingTimer);
            
            // Hide typing indicator after 1 second of inactivity
            typingTimer = setTimeout(() => {
              typingIndicator.classList.add('hidden');
            }, 1000);
            
            // Show suggestions based on current input
            const currentText = this.value.toLowerCase();
            if (currentText.length > 0) {
              showSuggestions(currentText);
            } else {
              hideSuggestions();
            }
            
            // Check for date-related keywords
            if (currentText.includes('date') || currentText.includes('from') || currentText.includes('starting')) {
              showDateSuggestions();
            } else {
              hideDateSuggestions();
            }
          });

          // Show typing suggestions
          function showSuggestions(currentText) {
            const filteredSuggestions = suggestions.filter(s => 
              s.toLowerCase().includes(currentText)
            ).slice(0, 5);
            
            if (filteredSuggestions.length > 0) {
              suggestionsList.innerHTML = filteredSuggestions.map(suggestion => `
                <button type="button" onclick="applySuggestion('${suggestion}')" 
                  class="w-full text-left px-3 py-2 hover:bg-gray-100 rounded text-sm text-gray-700 hover:text-gray-900 transition-colors">
                  ${suggestion}
                </button>
              `).join('');
              suggestionsDropdown.classList.remove('hidden');
            } else {
              hideSuggestions();
            }
          }

          // Show date suggestions
          function showDateSuggestions() {
            const dateOptionsList = generateDateSuggestions();
            dateOptions.innerHTML = dateOptionsList.map(option => `
              <button type="button" onclick="applyDateSuggestion('${option.value}')" 
                class="w-full text-left px-3 py-2 hover:bg-blue-50 rounded text-sm text-gray-700 hover:text-blue-700 transition-colors border border-gray-200 hover:border-blue-300">
                ${option.text}
              </button>
            `).join('');
            dateSuggestions.classList.remove('hidden');
          }

          // Hide suggestions
          function hideSuggestions() {
            suggestionsDropdown.classList.add('hidden');
          }

          function hideDateSuggestions() {
            dateSuggestions.classList.add('hidden');
          }

          // Apply suggestion
          function applySuggestion(suggestion) {
            const cursorPos = textarea.selectionStart;
            const textBefore = textarea.value.substring(0, cursorPos);
            const textAfter = textarea.value.substring(cursorPos);
            textarea.value = textBefore + suggestion + ' ' + textAfter;
            textarea.focus();
            textarea.setSelectionRange(cursorPos + suggestion.length + 1, cursorPos + suggestion.length + 1);
            hideSuggestions();
            
            // Trigger input event to update character count
            textarea.dispatchEvent(new Event('input'));
          }

          // Apply date suggestion
          function applyDateSuggestion(dateValue) {
            textarea.value += ' ' + dateValue;
            hideDateSuggestions();
            textarea.focus();
            
            // Trigger input event to update character count
            textarea.dispatchEvent(new Event('input'));
          }

          // Hide suggestions when clicking outside
          document.addEventListener('click', function(e) {
            if (!textarea.contains(e.target) && !suggestionsDropdown.contains(e.target) && !dateSuggestions.contains(e.target)) {
              hideSuggestions();
              hideDateSuggestions();
            }
          });

          // Form submission with loading states
          aiForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Show loading states
            submitBtn.disabled = true;
            submitBtnText.classList.add('hidden');
            submitBtnLoading.classList.remove('hidden');
            loadingState.classList.remove('hidden');
            
            // Simulate AI processing (in real implementation, this would be an AJAX call)
            setTimeout(() => {
              // Hide loading states
              submitBtn.disabled = false;
              submitBtnText.classList.remove('hidden');
              submitBtnLoading.classList.add('hidden');
              loadingState.classList.add('hidden');
              
              // Submit the form normally for now (in real implementation, handle AJAX response)
              aiForm.submit();
            }, 2000);
          });

          // Keyboard shortcuts
          textarea.addEventListener('keydown', function(e) {
            // Escape to hide suggestions
            if (e.key === 'Escape') {
              hideSuggestions();
              hideDateSuggestions();
            }
            
            // Arrow keys to navigate suggestions
            if (e.key === 'ArrowDown' && !suggestionsDropdown.classList.contains('hidden')) {
              e.preventDefault();
              const buttons = suggestionsList.querySelectorAll('button');
              if (buttons.length > 0) {
                buttons[0].focus();
              }
            }
          });

          // Initialize
          if (textarea && charCount) {
            charCount.textContent = textarea.value.length;
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