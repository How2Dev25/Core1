<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    @vite('resources/css/app.css')
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <title>{{$title}} - POS</title>
    @livewireStyles
</head>
@auth


      <body class="bg-base-100">
          <div class="flex h-screen overflow-hidden">
              <!-- Sidebar -->
              @include('admin.components.dashboard.sidebar')

              <!-- Main content -->
              <div class="flex flex-col flex-1 overflow-hidden">
                  <!-- Navbar -->
                  @include('admin.components.dashboard.navbar')

                  <!-- Dashboard Content -->
                  <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 transition-slow">
    <!-- Subsystem Name -->
    <div class="pb-5 border-b border-base-300 animate-fadeIn">
      <h1 class="text-2xl font-bold bg-white bg-clip-text text-[#191970]">Point Of Sale</h1>
    </div>
    <!-- Subsystem Name -->

    <section class="flex max-md:flex-col gap-6 p-6">
      <!-- Left: Events & Rooms -->
      <div class="flex-1 overflow-y-auto">
        <!-- Events Section -->
              @if(session('success'))
                  <div id="success-alert" class="alert alert-success shadow-lg mb-4 transition-all duration-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2l4 -4m6 2a10 10 0 1 1 -20 0a10 10 0 0 1 20 0" />
                    </svg>
                    <span>{{ session('success') }}</span>
                  </div>

                <script>
                  setTimeout(() => {
                    const alert = document.getElementById('success-alert');
                    if (alert) {
                      alert.classList.add('opacity-0'); // fade out
                      setTimeout(() => {
                        alert.style.display = 'none'; // fully hide
                      }, 500); // wait for fade animation to finish
                    }
                  }, 3000);
                </script>
              @endif

        @include('admin.components.pos.events')

        @include('admin.components.pos.rooms')
      </div>

      <!-- Right: Sticky POS / Booking Summary -->

      <div class="w-1/3 max-md:w-full">


          <div class="sticky top-6">
            <!-- Booking Summary Card -->
            <div class="bg-white/95 backdrop-blur-md rounded-2xl p-6 shadow-xl border border-white/20 max-w-sm mx-auto">

              <!-- Header -->
              <div class="flex items-center gap-3 mb-6">
                <div class="p-2 bg-blue-900  rounded-xl shadow-md">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#FBBF24"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 2v6h6"></path>
                    <path d="M21 12A9 9 0 0 0 6 2.3"></path>
                    <path d="M21 22v-6h-6"></path>
                    <path d="M3 12a9 9 0 0 0 15 6.7"></path>
                  </svg>
                </div>
                <div>
                  <h2 class="text-xl font-bold text-gray-900">
                    Booking Summary
                  </h2>
                  <p class="text-xs text-gray-500">Review your selection</p>
                </div>
              </div>

              <!-- Rooms Section -->
              <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center gap-2">
                  <i class="fa-solid fa-door-open"></i>
                  Rooms
                </h3>
                <div class="w-full h-px bg-gradient-to-r from-transparent via-gray-300 to-transparent mb-4"></div>
                @forelse ($reservationroom as $reserveroom)
                  <div class="space-y-3 mb-4">
                    <div class="relative group">
                      <div
                        class="flex items-center gap-3 p-3 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl border border-blue-100 hover:shadow-sm transition-shadow">
                        <img src="{{ asset($reserveroom->roomphoto) }}" class="w-16 h-16 rounded-lg object-cover shadow-sm"
                          alt="Room">

                        <div class="flex-1">
                          <h3 class="font-semibold text-gray-900 text-sm mb-1">{{ $reserveroom->roomtype }}</h3>
                          <p class="text-xs text-gray-500">{{ $reserveroom->reservation_numguest }} Guests</p>
                        </div>

                        <div class="flex flex-col items-end gap-1">
                          <div class="font-bold text-blue-600 text-base">₱{{ number_format($reserveroom->total, 2) }}</div>
                          <button type="button"
                            class="text-red-500 hover:text-red-700 hover:bg-red-50 p-1 rounded-md transition-all"
                            onclick="document.getElementById('removeroom_{{ $reserveroom->reservationposID }}').showModal()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                              <polyline points="3 6 5 6 21 6"></polyline>
                              <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                              <line x1="10" y1="11" x2="10" y2="17"></line>
                              <line x1="14" y1="11" x2="14" y2="17"></line>
                            </svg>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                @empty
                  <div class="flex flex-col items-center justify-center py-6 text-gray-400">
                    <i class="fas fa-bed text-3xl mb-2"></i>
                    <p class="text-sm">No rooms selected</p>
                  </div>
                @endforelse
              </div>

              <!-- Events Section -->
              <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center gap-2">
                <i class="fa-solid fa-calendar"></i>
                  Events
                </h3>
                <div class="w-full h-px bg-gradient-to-r from-transparent via-gray-300 to-transparent mb-4"></div>
                @forelse ($reservationevent as $reserveevent)
                  <div class="space-y-3 mb-4">
                    <div class="relative group">
                      <div
                        class="flex items-center gap-3 p-3 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl border border-blue-100 hover:shadow-sm transition-shadow">
                        <img src="{{ $reserveevent->eventtype_photo }}" class="w-16 h-16 rounded-lg object-cover shadow-sm"
                          alt="Event">

                        <div class="flex-1">
                          <h3 class="font-semibold text-gray-900 text-sm mb-1">{{ $reserveevent->eventtype_name }}</h3>
                          <p class="text-xs text-gray-500">{{ $reserveevent->event_numguest }} Guests</p>
                        </div>

                        <div class="flex flex-col items-end gap-1">
                          <div class="font-bold text-blue-600 text-base">₱{{ number_format($reserveevent->event_total_price, 2) }}
                          </div>
                          <button type="button"
                            class="text-red-500 hover:text-red-700 hover:bg-red-50 p-1 rounded-md transition-all"
                            onclick="document.getElementById('removeevent_{{ $reserveevent->eventposID }}').showModal()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                              <polyline points="3 6 5 6 21 6"></polyline>
                              <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                              <line x1="10" y1="11" x2="10" y2="17"></line>
                              <line x1="14" y1="11" x2="14" y2="17"></line>
                            </svg>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                @empty
                  <div class="flex flex-col items-center justify-center py-6 text-gray-400">
                    <i class="fas fa-calendar text-3xl mb-2"></i>
                    <p class="text-sm">No events selected</p>
                  </div>
                @endforelse
              </div>

              <!-- Booking Summary Totals -->
              @php
  $subtotal = 0;
  foreach ($reservationroom as $room) {
    $subtotal += $room->total;
  }
  foreach ($reservationevent as $event) {
    $subtotal += $event->event_total_price;
  }
  $total = $subtotal; // Assuming no additional fees
              @endphp
          <div class="space-y-3 mb-6">

            <!-- Subtotal -->
            <div class="flex items-center justify-between 
                        p-3 rounded-lg 
                        bg-blue-900/10 border border-blue-900/20">
              <span class="flex items-center gap-2 text-xs font-medium text-blue-900">
                Subtotal
              </span>
              <span class="font-bold text-blue-900 text-sm">
                ₱{{ number_format($subtotal, 2) }}
              </span>
            </div>

            <!-- Total Amount -->
            <div class="flex items-center justify-between 
                        p-4 rounded-lg 
                        bg-blue-900 text-white shadow-lg">
              <span class="flex items-center gap-2 text-base font-semibold">
                Total Amount
              </span>
              <span class="text-xl font-extrabold text-yellow-400 drop-shadow-sm">
                ₱{{ number_format($total, 2) }}
              </span>
            </div>
          </div>

          <!-- Confirm Button -->
          <div class="mb-4">
            <button onclick="document.getElementById('confirm-booking').showModal()" type="button" class="w-full bg-blue-900 hover:bg-blue-800 text-white px-4 py-3 
                     rounded-lg font-semibold transition-all transform 
                     hover:scale-[1.01] active:scale-[0.99] shadow-md hover:shadow-xl
                     flex items-center justify-center gap-2 text-sm">

              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20 6L9 17l-5-5"></path>
              </svg>

              Proceed
            </button>
          </div>

            </div>
          </div>



      </div>
    </section>



  </main>
              </div>
          </div>

          {{-- modal --}}
          @include('admin.components.bas.confirmation')
          @livewireScripts
          @include('javascriptfix.soliera_js')

          @foreach ($reservationroom as $reserveroom)
              @include('admin.components.pos.removeroom')
          @endforeach

          @foreach ($reservationevent as $reserveevent)
            @include('admin.components.pos.removeevent')
          @endforeach

             <!-- Confirm Booking Modal -->
   @include('admin.components.pos.posconfirm')
      </body>

@endauth



<script>
    // Add this function to open the modal and initialize calculations
        function openEventModal(eventId) {
            const modal = document.getElementById('bookeventtye_' + eventId);
            if (modal) {
                modal.showModal();
                // Initialize calculation after modal opens
                setTimeout(() => {
                    initializeBillingCalculation(eventId);
                }, 100);
            }
        }

        function initializeBillingCalculation(eventId) {
            const checkinInput = document.getElementById("eventCheckin_" + eventId);
            const checkoutInput = document.getElementById("eventCheckout_" + eventId);
            const numGuestsInput = document.getElementById("eventNumGuest_" + eventId);
            const numDaysSpan = document.getElementById("numDays_" + eventId);
            const additionalPersonFeeSpan = document.getElementById("additionalPersonFee_" + eventId);
            const totalAmountSpan = document.getElementById("totalAmount_" + eventId);
            const eventTotalPriceInput = document.getElementById("eventTotalPrice_" + eventId);

            // Check if elements exist
            if (!checkinInput || !checkoutInput || !numGuestsInput) {
                console.error('Required input elements not found for event:', eventId);
                return;
            }

            // Get values from data attributes or parse from text
            const eventPriceElement = document.getElementById("eventPrice_" + eventId);
            if (!eventPriceElement) {
                console.error('Event price element not found');
                return;
            }

            const eventPriceText = eventPriceElement.textContent;
            const eventPrice = parseFloat(eventPriceText.replace('₱', '').replace(/,/g, ''));

            // Get capacity from the input's max attribute
            const capacity = parseInt(numGuestsInput.getAttribute('max')) || 0;

            // Additional person fee rate (adjust this value as needed)
            const additionalPersonFeeRate = 100;

            console.log('Initialized with:', { eventId, eventPrice, capacity, additionalPersonFeeRate });

            function calculateBilling() {
                const checkin = checkinInput.value ? new Date(checkinInput.value) : null;
                const checkout = checkoutInput.value ? new Date(checkoutInput.value) : null;
                const numGuests = parseInt(numGuestsInput.value) || 0;

                let totalAmount = 0;
                let additionalPersonFee = 0;
                let days = 0;

                console.log('Calculating:', { checkin, checkout, numGuests, capacity });

                // Calculate number of days
                if (checkin && checkout && checkout > checkin) {
                    const diffTime = checkout - checkin;
                    days = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                    // Base price for the event
                    const basePrice = days * eventPrice;

                    // Calculate additional person fee
                    if (numGuests > capacity) {
                        const extraGuests = numGuests - capacity;
                        additionalPersonFee = extraGuests * additionalPersonFeeRate;
                    }

                    totalAmount = basePrice + additionalPersonFee;

                    console.log('Results:', { days, basePrice, additionalPersonFee, totalAmount });
                }

                // Update display
                if (numDaysSpan) numDaysSpan.textContent = days;
                if (additionalPersonFeeSpan) {
                    additionalPersonFeeSpan.textContent = `₱${additionalPersonFee.toLocaleString('en-PH', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    })}`;
                }
                if (totalAmountSpan) {
                    totalAmountSpan.textContent = `₱${totalAmount.toLocaleString('en-PH', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    })}`;
                }

                // Update hidden input
                if (eventTotalPriceInput) {
                    eventTotalPriceInput.value = totalAmount.toFixed(2);
                }
            }

            // Remove existing event listeners to prevent duplicates
            const newCheckinInput = checkinInput.cloneNode(true);
            const newCheckoutInput = checkoutInput.cloneNode(true);
            const newNumGuestsInput = numGuestsInput.cloneNode(true);

            checkinInput.parentNode.replaceChild(newCheckinInput, checkinInput);
            checkoutInput.parentNode.replaceChild(newCheckoutInput, checkoutInput);
            numGuestsInput.parentNode.replaceChild(newNumGuestsInput, numGuestsInput);

            // Add event listeners to new elements
            newCheckinInput.addEventListener("change", calculateBilling);
            newCheckoutInput.addEventListener("change", calculateBilling);
            newNumGuestsInput.addEventListener("input", calculateBilling);

            // Initial calculation
            calculateBilling();
        }
</script>

</html>