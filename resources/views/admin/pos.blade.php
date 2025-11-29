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
        <h1 class="text-2xl font-bold bg-white bg-clip-text text-[#191970]">Events & Rooms</h1>
      </div>
      <!-- Subsystem Name -->

      <section class="flex gap-6 p-6">
        <!-- Left: Events & Rooms -->
        <div class="flex-1 overflow-y-auto">
          <!-- Events Section -->
          @include('admin.components.pos.events')

          @include('admin.components.pos.rooms')
        </div>

        <!-- Right: Sticky POS / Booking Summary -->
        <div class="w-1/3 max-md:hidden">
          <div class="sticky top-6">
            <!-- Booking Summary Card -->
            <div class="bg-white/95">
              <div class="bg-white/95 backdrop-blur-md rounded-3xl p-8 shadow-2xl border border-white/20">
                <div class="flex items-center gap-4 mb-8">
                  <div class="p-3 bg-blue-900 rounded-2xl shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                      stroke="#F7B32B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M3 2v6h6"></path>
                      <path d="M21 12A9 9 0 0 0 6 2.3"></path>
                      <path d="M21 22v-6h-6"></path>
                      <path d="M3 12a9 9 0 0 0 15 6.7"></path>
                    </svg>
                  </div>
                  <div>
                    <h2 class="text-xl font-bold text-black">
                      Booking Summary
                    </h2>
                  </div>
                </div>

                <!-- Booking Items -->
                <div class="space-y-4 mb-8" id="booking-items">
                  <!-- Items will be added dynamically -->
                  <div id="empty-cart" class="flex flex-col items-center justify-center gap-2 p-8 border-2 border-dashed border-gray-300 rounded-xl text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12" fill="none" viewBox="0 0 24 24"
                      stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h18v18H3V3z" />
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v8M8 12h8" />
                    </svg>
                    <p class="text-center font-semibold text-gray-500">
                      Your cart is empty. Add some rooms to get started!
                    </p>
                  </div>
                </div>

                <!-- Booking Summary -->
                <div class="space-y-3 mb-8 hidden" id="booking-summary">
                  <div
                    class="flex items-center justify-between p-3 rounded-xl bg-gradient-to-r from-primary/5 to-secondary/5 border border-primary/10">
                    <span class="flex items-center gap-2 text-sm font-medium">
                      Subtotal
                    </span>
                    <span class="font-bold text-primary" id="subtotal">₱0.00</span>
                  </div>

                  <div class="flex items-center justify-between p-4 rounded-xl bg-blue-900 text-white">
                    <span class="flex items-center gap-2 text-lg font-bold">
                      Total Amount
                    </span>
                    <span class="text-2xl text-yellow-400 font-bold" id="total">₱0.00</span>
                  </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4">
                  <button onclick="document.getElementById('confirm-booking').showModal()" type="button"
                    class="flex bg-blue-600 hover:bg-blue-700 text-white px-4 py-3 rounded-xl font-medium transition w-full justify-center items-center hidden" id="confirm-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M20 6L9 17l-5-5"></path>
                    </svg>

                  </button>
                </div>

                <p class="text-xs text-gray-500 text-center mt-4">
                  Free cancellation up to 48 hours before check-in
                </p>
              </div>
            </div>
          </div>
        </div>
      </section>

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

    </main>
                </div>
            </div>

            {{-- modal --}}
            @include('admin.components.bas.confirmation')
            @livewireScripts
            @include('javascriptfix.soliera_js')

           


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