<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    @vite('resources/css/app.css')
    <script src="https://unpkg.com/lucide@latest"></script>
    <title>{{$title}} - Room Booking</title>
    @livewireStyles
</head>
@auth('guest')
<body class="bg-base-100">
<div class="flex h-screen overflow-hidden">
    <!-- Sidebar -->
    @include('guest.components.dashboard.sidebar')

    <!-- Main content -->
    <div class="flex flex-col flex-1 overflow-hidden">
        <!-- Navbar -->
        @include('guest.components.dashboard.navbar')

        <!-- Dashboard Content -->
        <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 transition-slow">
            <div class="pb-5 border-b border-base-300 animate-fadeIn">
                <h1 class="text-2xl font-bold bg-white bg-clip-text text-[#191970]">
                    
                </h1>
            </div>

      <section class="p-5">

          
    <form  autocomplete="off" action="/guestcreatereservation" method="POST" id="reservationForm" class="flex flex-col lg:flex-row gap-6">
        @csrf
        <input value="{{$room->roomID}}" type="hidden" name="roomID" id="selectedRoomID" />

        <!-- LEFT SIDE -->
        <div class="flex-1 space-y-6">
            <!-- Select Room -->
            <div class="rounded-box p-6 shadow bg-base-100">
                <h2 class="text-xl font-semibold flex items-center gap-2 mb-4 text-primary">
                    <i data-lucide="home" class="w-5 h-5"></i>
                   Room {{$room->roomID}} - {{$room->roomtype}}
                </h2>
              <div class="w-full flex justify-center items-center">
                 <img class="rounded-md shadow-md" src="{{asset($room->roomphoto)}}" alt="">
              </div>
            </div>

            <!-- Reservation Details -->
            <div class="rounded-box p-6 shadow bg-base-100">
                <h2 class="text-xl font-semibold flex items-center gap-2 mb-4 text-primary">
                    <i data-lucide="calendar" class="w-5 h-5"></i>
                    Reservation Details
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="form-control">
                        <label class="label font-medium">Check-In Date</label>
                        <input type="date" name="reservation_checkin" class="input input-bordered w-full" required />
                    </div>
                    <div class="form-control">
                        <label class="label font-medium">Check-Out Date</label>
                        <input type="date" name="reservation_checkout" class="input input-bordered w-full" required />
                    </div>
                    <div class="form-control">
                        <label class="label font-medium">Number of Guests</label>
                        <input type="number" name="reservation_numguest" min="1" class="input input-bordered w-full" required />
                    </div>
                    <div class="form-control md:col-span-2">
                        <label class="label font-medium">Special Requests</label>
                        <input type="text" name="reservation_specialrequest" placeholder="Early check-in, extra pillows..." class="input input-bordered w-full" />
                    </div>
                </div>
            </div>

            <!-- Guest Info -->
            <div class="rounded-box p-6 shadow bg-base-100">
                <h2 class="text-xl font-semibold flex items-center gap-2 mb-4 text-primary">
                    <i data-lucide="user-round" class="w-5 h-5"></i>
                    Guest Information
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="form-control">
                        <label class="label font-medium">Full Name</label>
                        <input value="{{Auth::guard('guest')->user()->guest_name}}" type="text" name="guestname" class="input input-bordered w-full" required />
                    </div>
                    <div class="form-control">
                        <label class="label font-medium">Birthday</label>
                        <input  value="{{Auth::guard('guest')->user()->guest_birthday}}" id="guestbirthday" type="date" name="guestbirthday" class="input input-bordered w-full" required />
                        <span id="ageError" class="text-red-500 text-sm mt-1 hidden">Age must be 18 or above.</span>
                    </div>
                    <div class="form-control">
                        <label class="label font-medium">Mobile Number</label>
                        <input value="{{Auth::guard('guest')->user()->guest_mobile}}" type="tel" name="guestphonenumber" class="input input-bordered w-full" required />
                    </div>
                    <div class="form-control">
                        <label class="label font-medium">Email Address</label>
                        <input value="{{Auth::guard('guest')->user()->guest_email}}" type="email" name="guestemailaddress" class="input input-bordered w-full" required />
                    </div>
                    <div class="form-control md:col-span-2">
                        <label class="label font-medium">Address</label>
                        <textarea name="guestaddress" class="textarea textarea-bordered w-full" rows="2" required>{{Auth::guard('guest')->user()->guest_address}}</textarea>
                    </div>
                    <div class="form-control">
                        <label class="label font-medium">Contact Person</label>
                        <input type="text" name="guestcontactperson" class="input input-bordered w-full" required />
                    </div>
                    <div class="form-control">
                        <label class="label font-medium">Contact Person Number</label>
                        <input type="tel" name="guestcontactpersonnumber" class="input input-bordered w-full" required />
                    </div>
                </div>
            </div>
        </div>

        <!-- RIGHT SIDE (POS Summary) -->
    <div class="w-full lg:w-1/3">

  @if(session('success'))
    <div role="alert" class="alert alert-success mt-2 mb-2">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
      <span>{{session('success')}}</span>
    </div>
  @elseif(session('modified'))
    <div role="alert" class="alert alert-success mt-2 mb-2">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
      <span>{{session('modified')}}</span>
    </div>
  @elseif(session('removed'))
    <div role="alert" class="alert alert-success mt-2 mb-2">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
      <span>{{session('removed')}}</span>
    </div>
  @endif

  <div class="rounded-box p-6 shadow bg-base-100 lg:sticky lg:top-6">
    <h2 class="text-xl font-semibold flex items-center gap-2 mb-4 text-primary">
      <i data-lucide="file-text" class="w-5 h-5"></i>
      Billing Summary
    </h2>
    <div class="space-y-3 text-sm">
      <p class="flex items-center justify-between">
        <span class="flex items-center gap-2">
          <i data-lucide="tag" class="w-4 h-4 text-primary"></i> Room Price (per night)
        </span> ₱<span id="roomPrice">0.00</span>
      </p>
      <p class="flex items-center justify-between">
        <span class="flex items-center gap-2">
          <i data-lucide="moon" class="w-4 h-4 text-primary"></i> Nights
        </span> <span id="numNights">0</span>
      </p>
      <p class="flex items-center justify-between">
        <span class="flex items-center gap-2">
          <i data-lucide="list" class="w-4 h-4 text-primary"></i> Subtotal
        </span> ₱<span id="subtotal">0.00</span>
      </p>
      <p class="flex items-center justify-between">
        <span class="flex items-center gap-2">
          <i data-lucide="percent" class="w-4 h-4 text-primary"></i> VAT (12%)
        </span> ₱<span id="vatAmount">0.00</span>
      </p>
      <p class="flex items-center justify-between font-bold text-lg text-primary border-t pt-3">
        <span class="flex items-center gap-2">
          <i data-lucide="credit-card" class="w-5 h-5"></i> Total
        </span> ₱<span id="totalAmount">0.00</span>
      </p>
    </div>

    <!-- Payment Methods -->
    <div class="mt-6">
      <h3 class="text-md font-semibold mb-3 flex items-center gap-2">
        <i data-lucide="wallet" class="w-5 h-5 text-primary"></i> Payment Method
      </h3>
      <div class="space-y-3">
        <!-- Pay at Hotel -->
        <label class="flex items-center gap-3 p-3 border rounded-lg cursor-pointer hover:bg-base-200 transition">
          <input type="radio" name="payment_method" value="Pay at Hotel" class="radio radio-primary" checked>
          <i class="fas fa-hotel text-primary text-lg"></i>
          <span class="text-sm font-medium">Pay at Hotel</span>
        </label>

        <!-- Online Payment -->
        <label class="flex items-center gap-3 p-3 border rounded-lg cursor-pointer hover:bg-base-200 transition">
          <input type="radio" name="payment_method" value="online" class="radio radio-primary">
          <i class="fas fa-credit-card text-primary text-lg"></i>
          <span class="text-sm font-medium">Online Payment</span>
        </label>
      </div>
    </div>

    <div class="mt-6 flex justify-end gap-3">
      <button type="reset" class="btn btn-ghost">Cancel</button>
      <button type="button" onclick="confirm_modal_bas.showModal()" class="btn btn-primary gap-2">
        <i data-lucide="check-circle" class="w-5 h-5"></i>
        Confirm
      </button>
    </div>
  </div>
</div>
    </form>
</section>

        </main>
    </div>
</div>

{{-- modal --}}
@include('admin.components.bas.confirmation')
@livewireScripts
@include('javascriptfix.soliera_js')

<script>
    lucide.createIcons();

    // initialize with backend room price
    let selectedRoomPrice = {{$room->roomprice ?? 0}};

    function calculateSubtotal() {
        const checkin = document.querySelector('[name="reservation_checkin"]').value;
        const checkout = document.querySelector('[name="reservation_checkout"]').value;

        if (!checkin || !checkout || selectedRoomPrice === 0) return;

        const checkinDate = new Date(checkin);
        const checkoutDate = new Date(checkout);
        const diffTime = checkoutDate - checkinDate;
        const numNights = Math.max(diffTime / (1000 * 60 * 60 * 24), 0);

        document.getElementById('numNights').innerText = numNights;

        const subtotal = numNights * selectedRoomPrice;
        const vat = subtotal * 0.12;
        const total = subtotal + vat;

        document.getElementById('subtotal').innerText = subtotal.toFixed(2);
        document.getElementById('vatAmount').innerText = vat.toFixed(2);
        document.getElementById('totalAmount').innerText = total.toFixed(2);
    }

    document.addEventListener('DOMContentLoaded', () => {
        // set default room price in POS summary
        document.getElementById('roomPrice').innerText = selectedRoomPrice.toFixed(2);

        const checkinInput = document.querySelector('[name="reservation_checkin"]');
        const checkoutInput = document.querySelector('[name="reservation_checkout"]');

        checkinInput.addEventListener('change', calculateSubtotal);
        checkoutInput.addEventListener('change', calculateSubtotal);

        // run subtotal calculation once on page load
        calculateSubtotal();

        // Age validation
        const birthdayInput = document.getElementById('guestbirthday');
        const ageError = document.getElementById('ageError');
        const submitBtn = document.querySelector('#reservationForm button[type="submit"]');

        birthdayInput.addEventListener('input', () => {
            const birthDate = new Date(birthdayInput.value);
            const today = new Date();
            let age = today.getFullYear() - birthDate.getFullYear();
            const m = today.getMonth() - birthDate.getMonth();

            if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }

            if (isNaN(age)) {
                ageError.classList.add('hidden');
                submitBtn.disabled = false;
                return;
            }

            if (age < 18) {
                ageError.classList.remove('hidden');
                submitBtn.disabled = true;
            } else {
                ageError.classList.add('hidden');
                submitBtn.disabled = false;
            }
        });
    });
</script>

@endauth

</body>
</html>
