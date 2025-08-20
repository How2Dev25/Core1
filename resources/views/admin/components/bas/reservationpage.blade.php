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
            <div class="pb-5 border-b border-base-300 animate-fadeIn">
                <h1 class="text-2xl font-bold bg-white bg-clip-text text-[#191970]">
                    Booking And Reservation (Point Of Sale)
                </h1>
            </div>

      <section class="p-5">

          
    <form  autocomplete="off" action="/createreservation" method="POST" id="reservationForm" class="flex flex-col lg:flex-row gap-6">
        @csrf
        <input type="hidden" name="roomID" id="selectedRoomID" />

        <!-- LEFT SIDE -->
        <div class="flex-1 space-y-6">
            <!-- Select Room -->
            <div class="rounded-box p-6 shadow bg-base-100">
                <h2 class="text-xl font-semibold flex items-center gap-2 mb-4 text-primary">
                    <i data-lucide="home" class="w-5 h-5"></i>
                    Select a Room
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @forelse ($rooms as $room)
                        <div class="card bg-base-100 shadow-md hover:shadow-xl border-2 border-transparent hover:border-primary transition-all cursor-pointer relative group"
                             onclick="selectRoom(this, {{$room->roomID}}, {{$room->roomprice}})">
                            <figure class="relative h-40 overflow-hidden rounded-t-box">
                                <img src="{{ asset($room->roomphoto) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" alt="Room">
                                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-3">
                                    <h3 class="text-white font-medium text-sm">Room #{{$room->roomID}} - {{$room->roomtype}}</h3>
                                </div>
                            </figure>
                            <div class="card-body p-4 space-y-2">
                                <div class="flex justify-between items-center">
                                    <span class="badge badge-primary">{{$room->roomstatus}}</span>
                                    <span class="badge badge-outline">₱{{number_format($room->roomprice, 2)}} /night</span>
                                </div>
                                <div class="flex items-center flex-wrap text-xs text-base-content/70 gap-3 pt-2">
                                    <span class="flex items-center gap-1"><i data-lucide="square" class="w-3 h-3"></i> {{$room->roomsize}} sq.ft</span>
                                    <span class="flex items-center gap-1"><i data-lucide="users" class="w-3 h-3"></i> {{$room->roommaxguest}} Guests</span>
                                    <span class="flex items-center gap-1"><i data-lucide="wifi" class="w-3 h-3"></i> {{$room->roomfeatures}}</span>
                                </div>
                            </div>
                            <div class="absolute top-2 right-2 hidden bg-primary text-white rounded-full p-1 shadow-md selection-indicator z-10">
                                <i data-lucide="check" class="w-4 h-4"></i>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-2 text-center py-12 text-base-content/70">
                            <div class="p-4 rounded-full bg-base-300 inline-block mb-4">
                                <i data-lucide="door-closed" class="w-10 h-10"></i>
                            </div>
                            <p class="font-medium">No rooms available for booking.</p>
                        </div>
                    @endforelse
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
                        <input type="text" name="guestname" class="input input-bordered w-full" required />
                    </div>
                    <div class="form-control">
                        <label class="label font-medium">Birthday</label>
                        <input id="guestbirthday" type="date" name="guestbirthday" class="input input-bordered w-full" required />
                        <span id="ageError" class="text-red-500 text-sm mt-1 hidden">Age must be 18 or above.</span>
                    </div>
                    <div class="form-control">
                        <label class="label font-medium">Mobile Number</label>
                        <input type="tel" name="guestphonenumber" class="input input-bordered w-full" required />
                    </div>
                    <div class="form-control">
                        <label class="label font-medium">Email Address</label>
                        <input type="email" name="guestemailaddress" class="input input-bordered w-full" required />
                    </div>
                    <div class="form-control md:col-span-2">
                        <label class="label font-medium">Address</label>
                        <textarea name="guestaddress" class="textarea textarea-bordered w-full" rows="2" required></textarea>
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
                    <p class="flex items-center justify-between"><span class="flex items-center gap-2"><i data-lucide="tag" class="w-4 h-4 text-primary"></i> Room Price (per night)</span> ₱<span id="roomPrice">0.00</span></p>
                    <p class="flex items-center justify-between"><span class="flex items-center gap-2"><i data-lucide="moon" class="w-4 h-4 text-primary"></i> Nights</span> <span id="numNights">0</span></p>
                    <p class="flex items-center justify-between"><span class="flex items-center gap-2"><i data-lucide="list" class="w-4 h-4 text-primary"></i> Subtotal</span> ₱<span id="subtotal">0.00</span></p>
                    <p class="flex items-center justify-between"><span class="flex items-center gap-2"><i data-lucide="percent" class="w-4 h-4 text-primary"></i> VAT (12%)</span> ₱<span id="vatAmount">0.00</span></p>
                    <p class="flex items-center justify-between font-bold text-lg text-primary border-t pt-3"><span class="flex items-center gap-2"><i data-lucide="credit-card" class="w-5 h-5"></i> Total</span> ₱<span id="totalAmount">0.00</span></p>
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

    let selectedRoomPrice = 0;

    function selectRoom(cardElement, roomID, roomPrice) {
        document.querySelectorAll('.card').forEach(card => {
            card.classList.remove('border-primary', 'bg-primary/10');
            const indicator = card.querySelector('.selection-indicator');
            if (indicator) indicator.classList.add('hidden');
        });

        cardElement.classList.add('border-primary', 'bg-primary/10');
        const selectedIndicator = cardElement.querySelector('.selection-indicator');
        if (selectedIndicator) selectedIndicator.classList.remove('hidden');

        document.getElementById('selectedRoomID').value = roomID;
        selectedRoomPrice = roomPrice;

        document.getElementById('roomPrice').innerText = roomPrice.toFixed(2);
        calculateSubtotal();
    }

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
        const checkinInput = document.querySelector('[name="reservation_checkin"]');
        const checkoutInput = document.querySelector('[name="reservation_checkout"]');

        checkinInput.addEventListener('change', calculateSubtotal);
        checkoutInput.addEventListener('change', calculateSubtotal);

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
</body>
</html>
