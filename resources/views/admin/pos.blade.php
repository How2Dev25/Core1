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
            @endif

            @if(session('error'))
              <div id="error-alert" class="alert alert-error shadow-lg mb-4 transition-all duration-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
                <span>{{ session('error') }}</span>
              </div>
            @endif

            <script>
              // Fade out alerts after 3 seconds
              setTimeout(() => {
                const successAlert = document.getElementById('success-alert');
                if (successAlert) {
                  successAlert.classList.add('opacity-0');
                  setTimeout(() => successAlert.style.display = 'none', 500);
                }

                const errorAlert = document.getElementById('error-alert');
                if (errorAlert) {
                  errorAlert.classList.add('opacity-0');
                  setTimeout(() => errorAlert.style.display = 'none', 500);
                }
              }, 3000);
            </script>


        @include('admin.components.pos.rooms')

        @include('admin.components.pos.events')

        @include('admin.components.pos.inventory')


      </div>

      <!-- Right: Sticky POS / Booking Summary -->

    <div class="w-1/3 max-md:w-full">
      <div class="sticky top-6">
        <!-- Booking Summary Card -->
        <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-200">

          <!-- Header -->
          <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-200">
            <div class="p-3 bg-blue-900 rounded-xl shadow-md">
                <i  class="fa-solid fa-arrow-pointer text-yellow-400"></i>
            </div>
            <div>
              <h2 class="text-2xl font-bold text-gray-900">
                Point Of Sale 
              </h2>
              <p class="text-sm text-gray-500">Review your selection</p>
            </div>
          </div>

          <!-- Rooms Section -->
          <div class="mb-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-3 flex items-center gap-2">
              <i class="fa-solid fa-door-open text-yellow-400"></i>
              Rooms
            </h3>
            <div class="w-full h-px bg-gray-200 mb-4"></div>

            @forelse ($reservationroom as $reserve)
              @php
    static $displayedRooms = [];
              @endphp

              @if(!in_array($reserve->reservationposID, $displayedRooms))
                <div class="space-y-3 mb-4 p-4 bg-gray-50 rounded-xl border border-gray-200">

                  <!-- Room Info -->
                  <div class="flex items-center gap-3 mb-3">
                    <div class="relative">
                      <img src="{{ asset($reserve->roomphoto) }}"
                        class="w-16 h-16 rounded-lg object-cover shadow-sm border border-gray-200"
                        alt="{{ $reserve->roomtype }}">
                      <div class="absolute -top-1 -right-1 w-5 h-5 bg-yellow-400 rounded-full flex items-center justify-center shadow-sm">
                        <i class="fas fa-star text-blue-900 text-xs"></i>
                      </div>
                    </div>

                    <div class="flex-1">
                      <h3 class="font-semibold text-gray-900 text-sm mb-1">{{ $reserve->roomtype }}</h3>
                      <p class="text-xs text-gray-500">Room #{{ $reserve->roomID }}</p>
                      <p class="text-xs text-gray-700 mt-1 font-medium">Total: ₱{{ number_format($reserve->total, 2) }}</p>
                    </div>

                    <!-- Delete Room -->
                    <button type="button"
                      class="text-red-500 hover:text-red-600 hover:bg-red-50 p-2 rounded-lg transition-all"
                      onclick="document.getElementById('removeroom_{{ $reserve->reservationposID }}').showModal()">
                      <i class="fas fa-trash-alt"></i>
                    </button>
                  </div>

                  <!-- Additional Inventory Items -->
                  @foreach ($reservationroom as $additional)
                    @if($additional->reservationposID == $reserve->reservationposID && $additional->core1_inventory_name)
                      <div class="flex items-center gap-3 mb-2 p-3 bg-white rounded-lg border border-gray-200">
                        <div class="relative">
                          <img src="{{ asset($additional->core1_inventory_image) }}"
                            class="w-12 h-12 rounded-lg object-cover shadow-sm border border-gray-200"
                            alt="{{ $additional->core1_inventory_name }}">
                          <div class="absolute -top-1 -right-1 w-5 h-5 bg-yellow-400 rounded-full flex items-center justify-center shadow-sm">
                            <i class="fas fa-box text-blue-900 text-xs"></i>
                          </div>
                        </div>

                        <div class="flex-1">
                          <h4 class="font-semibold text-gray-900 text-sm">{{ $additional->core1_inventory_name }}</h4>
                          <div class="flex items-center gap-3 mt-1">
                            <p class="text-xs text-gray-500">Qty: {{ $additional->inventorypos_quantity }}</p>
                            <p class="text-xs text-gray-700 font-medium">₱{{ number_format($additional->inventorypos_total, 2) }}</p>
                          </div>
                        </div>

                        <!-- Delete Additional -->
                        <button type="button"
                          class="text-red-500 hover:text-red-600 hover:bg-red-50 p-1.5 rounded-md transition-all"
                          onclick="document.getElementById('removeinventory_{{ $additional->inventoryposID }}').showModal()">
                          <i class="fas fa-trash-alt text-sm"></i>
                        </button>
                      </div>
                    @endif
                  @endforeach

                </div>

                @php
      $displayedRooms[] = $reserve->reservationposID;
                @endphp
              @endif
            @empty
              <div class="flex flex-col items-center justify-center py-8 text-gray-400">
                <i class="fas fa-door-open text-4xl mb-3"></i>
                <p class="text-sm">No rooms selected</p>
              </div>
            @endforelse
          </div>

          <!-- Events Section -->
          <div class="mb-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-3 flex items-center gap-2">
              <i class="fa-solid fa-calendar text-yellow-400"></i>
              Events
            </h3>
            <div class="w-full h-px bg-gray-200 mb-4"></div>

            @forelse ($reservationevent as $reserveevent)
              <div class="space-y-3 mb-4">
                <div class="relative group">
                  <div
                    class="flex items-center gap-3 p-4 bg-gray-50 rounded-xl border border-gray-200 hover:border-yellow-400 transition-all">
                    <div class="relative">
                      <img src="{{ $reserveevent->eventtype_photo }}"
                        class="w-16 h-16 rounded-lg object-cover shadow-sm border border-gray-200" alt="Event">
                      <div
                        class="absolute -top-1 -right-1 w-5 h-5 bg-yellow-400 rounded-full flex items-center justify-center shadow-sm">
                        <i class="fas fa-calendar-check text-blue-900 text-xs"></i>
                      </div>
                    </div>

                    <div class="flex-1">
                      <h3 class="font-semibold text-gray-900 text-sm mb-1">{{ $reserveevent->eventtype_name }}</h3>
                      <p class="text-xs text-gray-500">{{ $reserveevent->event_numguest }} Guests</p>
                    </div>

                    <div class="flex flex-col items-end gap-2">
                      <div class="font-bold text-gray-900 text-base">
                        ₱{{ number_format($reserveevent->event_total_price, 2) }}</div>
                      <button type="button"
                        class="text-red-500 hover:text-red-600 hover:bg-red-50 p-1.5 rounded-md transition-all"
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
              <div class="flex flex-col items-center justify-center py-8 text-gray-400">
                <i class="fas fa-calendar text-4xl mb-3"></i>
                <p class="text-sm">No events selected</p>
              </div>
            @endforelse
          </div>

          <!-- Booked Reservations Section -->
          <div class="mb-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-3 flex items-center gap-2">
              <i class="fa-solid fa-clipboard-check text-yellow-400"></i>
              Booked Reservations 
            </h3>
            <div class="w-full h-px bg-gray-200 mb-4"></div>

            <!-- Static Booked Reservation Items (Example Data) -->
            <div class="space-y-3">

              <!-- Booked Item 1 -->
              @forelse ($bookedreservationCart as $bookedRooms)
                <div class="p-4 bg-gray-50 rounded-xl border border-gray-200">
                  <div class="flex items-center gap-3 mb-2">
                    <div class="relative">
                      <img src="{{ asset($bookedRooms->core1_inventory_image) }}"
                        class="w-14 h-14 rounded-lg object-cover shadow-sm border border-gray-200" alt="Food Item">
                    <div class="absolute -top-1 -right-1 w-5 h-5 bg-yellow-400 rounded-full flex items-center justify-center shadow-sm">
                      <i class="fas fa-box text-blue-900 text-xs"></i>
                    </div>
                    </div>

                    <div class="flex-1">
                      <h4 class="font-semibold text-gray-900 text-sm mb-1">{{$bookedRooms->core1_inventory_name}}</h4>
                      <p class="text-xs text-gray-500 mb-1">Booking ID: {{ $bookedRooms->bookingID }}</p>
                      <div class="flex items-center gap-3">
                        <span class="text-xs text-gray-500">Qty: {{ $bookedRooms->additional_quantity}}</span>
                        <span class="text-xs font-semibold text-gray-900">₱{{ $bookedRooms->additional_total}}</span>
                      </div>
                    </div>

                    <button onclick="document.getElementById('removeinventorybooking_{{ $bookedRooms->additionalsID }}').showModal()" type="button" class="text-red-500 hover:text-red-600 hover:bg-red-50 p-1.5 rounded-md transition-all">
                      <i class="fas fa-trash-alt text-sm"></i>
                    </button>
                  </div>
                </div>

              @empty
               <div class="flex flex-col items-center justify-center py-8 text-gray-400">
                <i class="fas fa-calendar text-4xl mb-3"></i>
                <p class="text-sm">No Additionals For Booked Rooms</p>
              </div>

              @endforelse



            </div>
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
  // Add static booked reservations total
  foreach ($bookedreservationCart as $bookedItem) {
    $subtotal += $bookedItem->additional_total; // assuming this is numeric
  }
  $total = $subtotal;
          @endphp

          <div class="space-y-3 mb-6">

            <!-- Subtotal -->
            <div class="flex items-center justify-between p-3 rounded-lg bg-gray-50 border border-gray-200">
              <span class="flex items-center gap-2 text-sm font-medium text-gray-700">
                <i class="fas fa-calculator text-yellow-400"></i>
                Subtotal
              </span>
              <span class="font-bold text-gray-900 text-base">
                ₱{{ number_format($subtotal, 2) }}
              </span>
            </div>

            <!-- Total Amount -->
            <div class="flex items-center justify-between p-5 rounded-xl bg-blue-900 shadow-lg">
              <span class="flex items-center gap-2 text-base font-bold text-white">
                <i class="fas fa-money-bill-wave"></i>
                Total Amount
              </span>
              <span class="text-lg font-extrabold text-white">
                ₱{{ number_format($total, 2) }}
              </span>
            </div>
          </div>

          <!-- Confirm Button -->
          <div class="mb-2">
            <button onclick="document.getElementById('confirm-booking').showModal()" type="button" 
                    class="w-full bg-blue-900 hover:bg-blue-800 text-white px-4 py-4 rounded-xl font-bold 
                           transition-all transform hover:scale-[1.02] active:scale-[0.98] shadow-lg hover:shadow-xl
                           flex items-center justify-center gap-3 text-base">

              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20 6L9 17l-5-5"></path>
              </svg>

              Proceed to Checkout
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

          @livewireScripts
          @include('javascriptfix.soliera_js')

          @foreach ($reservationroom as $reserveroom)
              @include('admin.components.pos.removeroom')
          @endforeach

          @foreach ($reservationevent as $reserveevent)
            @include('admin.components.pos.removeevent')
          @endforeach

          @foreach ($inventories as $inventory)
            @include('admin.components.pos.inventorymodal')
          @endforeach

            @foreach ($reservationroom as $additional)
              @include('admin.components.pos.removeadditional')
            @endforeach

            @foreach ($bookedreservationCart as $bookedRooms )
              @include('admin.components.pos.removeadditionalbookings')
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