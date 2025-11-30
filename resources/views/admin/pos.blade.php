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
                    document.getElementById('success-alert')?.classList.add('opacity-0');
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
                  <div class="p-2 bg-gradient-to-br from-blue-600 to-blue-800 rounded-xl shadow-md">
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

                <!-- Booking Items -->
                {{-- room --}}
                @foreach ($reservationroom as $reserveroom)
                  <div class="space-y-3 mb-6">
                    <div class="relative group">
                      <div
                        class="flex items-center gap-3 p-3 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl border border-blue-100 hover:shadow-sm transition-shadow">
                        <img src="{{ asset($reserveroom->roomphoto) }}"
                          class="w-16 h-16 rounded-lg object-cover shadow-sm" alt="Deluxe Suite">

                        <div class="flex-1">
                          <h3 class="font-semibold text-gray-900 text-sm mb-1">{{$reserveroom->roomtype}}</h3>
                          <p class="text-xs text-gray-500">{{$reserveroom->reservation_numguest}} Guest • {{$reserveroom->reservation_specialrequest}}</p>
                        </div>

                        <div class="flex flex-col items-end gap-1">
                          <div class="font-bold text-blue-600 text-base">₱{{$reserveroom->total}}</div>
                          <button type="button" class="text-red-500 hover:text-red-700 hover:bg-red-50 p-1 rounded-md transition-all"
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
                @endforeach


                <div class="space-y-3 mb-6">
                  <div class="relative group">
                    <div
                      class="flex items-center gap-3 p-3 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl border border-blue-100 hover:shadow-sm transition-shadow">
                      <img src="https://images.unsplash.com/photo-1611892440504-42a792e24d32?w=200&h=200&fit=crop"
                        class="w-16 h-16 rounded-lg object-cover shadow-sm" alt="Deluxe Suite">

                      <div class="flex-1">
                        <h3 class="font-semibold text-gray-900 text-sm mb-1">Deluxe Suite</h3>
                        <p class="text-xs text-gray-500">2 Guests • King Bed</p>
                      </div>

                      <div class="flex flex-col items-end gap-1">
                        <div class="font-bold text-blue-600 text-base">₱5,500.00</div>
                        <button type="button" class="text-red-500 hover:text-red-700 hover:bg-red-50 p-1 rounded-md transition-all"
                          onclick="this.closest('.relative').remove()">
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

                <!-- Booking Summary Totals -->
                <div class="space-y-2 mb-6">
                  <div
                    class="flex items-center justify-between p-3 rounded-lg bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-100">
                    <span class="flex items-center gap-2 text-xs font-medium text-gray-700">
                      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="1" x2="12" y2="23"></line>
                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                      </svg>
                      Subtotal
                    </span>
                    <span class="font-bold text-blue-600 text-sm">₱5,500.00</span>
                  </div>

                  <div
                    class="flex items-center justify-between p-4 rounded-lg bg-gradient-to-r from-blue-600 to-blue-800 text-white shadow-md">
                    <span class="flex items-center gap-2 text-base font-bold">
                      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <path d="M16 8h-6a2 2 0 1 0 0 4h4a2 2 0 1 1 0 4H8"></path>
                        <path d="M12 18V6"></path>
                      </svg>
                      Total Amount
                    </span>
                    <span class="text-xl text-yellow-400 font-bold">₱5,500.00</span>
                  </div>
                </div>

                <!-- Action Button -->
                <div class="mb-4">
                  <button type="button"
                    class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-4 py-3 rounded-lg font-semibold transition-all transform hover:scale-[1.01] active:scale-[0.99] shadow-md hover:shadow-lg flex items-center justify-center gap-2 text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M20 6L9 17l-5-5"></path>
                    </svg>
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


             <!-- Confirm Booking Modal -->
    <dialog id="confirm-booking" class="modal">
      <div class="modal-box bg-white rounded-2xl p-0 max-w-md">
        <form method="dialog">
          <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
        <div class="p-6">
          <div class="flex items-center gap-3 mb-4">
            <div class="p-2 bg-green-100 rounded-full">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
            <h3 class="text-lg font-bold">Confirm Your Booking</h3>
          </div>
          <p class="py-4 text-gray-600">Are you sure you want to proceed with this booking?</p>
          <div class="modal-action">
            <form method="dialog" class="flex gap-3 w-full">
              <button class="btn btn-outline flex-1">Cancel</button>
              <button class="btn btn-primary flex-1 bg-blue-600 border-blue-600 text-white">Confirm</button>
            </form>
          </div>
        </div>
      </div>
    </dialog>
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