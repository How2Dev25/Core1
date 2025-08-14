<dialog id="add_booking" class="modal">
  <div class="modal-box max-w-4xl p-6">
    <!-- Modal Header -->
    <div class="flex justify-between items-center mb-6">
      <h3 class="text-2xl font-semibold flex items-center gap-2">
        <i data-lucide="plus-circle" class="w-6 h-6 text-primary"></i>
        Hotel POS
      </h3>
      <form method="dialog">
        <button class="btn btn-circle btn-ghost btn-sm">
          <i data-lucide="x" class="w-5 h-5"></i>
        </button>
      </form>
    </div>

    <!-- Form Start -->
    <form action="/createreservation" method="POST" id="reservationForm">
      @csrf
      <input type="hidden" name="roomID" id="selectedRoomID" />

      <!-- Select Room -->
      <div class="bg-base-200 rounded-box p-5 mb-6">
        <h2 class="text-lg font-semibold flex items-center gap-2 mb-4">
          <i data-lucide="home" class="w-5 h-5"></i>
          Select a Room
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
          @forelse ($rooms as $room)
            <div class="card bg-base-100 shadow-sm hover:shadow-lg border-2 border-transparent hover:border-primary transition-all cursor-pointer relative group"
              onclick="selectRoom(this, {{$room->roomID}})">
              <figure class="relative h-40 overflow-hidden rounded-t-box">
                <img src="{{ asset($room->roomphoto) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" alt="Room">
                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-3">
                  <h3 class="text-white font-medium text-sm">Room #{{$room->roomID}} - {{$room->roomtype}}</h3>
                </div>
              </figure>
              <div class="card-body p-4 space-y-1">
                <div class="flex justify-between items-center">
                  <span class="badge badge-primary badge-sm">{{$room->roomstatus}}</span>
                  <span class="badge badge-outline badge-sm">₱{{number_format($room->roomprice, 2)}} /night</span>
                </div>
                <div class="flex items-center flex-wrap text-xs text-base-content/60 gap-2 pt-2">
                  <i data-lucide="square" class="w-3 h-3"></i> {{$room->roomsize}} sq.ft
                  <i data-lucide="users" class="w-3 h-3 ml-2"></i> {{$room->roommaxguest}} Guests
                  <i data-lucide="wifi" class="w-3 h-3 ml-2"></i> {{$room->roomfeatures}}
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
      <div class="bg-base-200 rounded-box p-5 mb-6">
        <h2 class="text-lg font-semibold flex items-center gap-2 mb-4">
          <i data-lucide="calendar" class="w-5 h-5"></i>
          Reservation Details
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div class="form-control">
            <label class="label">
              <span class="label-text">Check-In Date</span>
            </label>
            <input type="date" name="reservation_checkin" class="input input-bordered" required />
          </div>
          <div class="form-control">
            <label class="label">
              <span class="label-text">Check-Out Date</span>
            </label>
            <input type="date" name="reservation_checkout" class="input input-bordered" required />
          </div>
          <div class="form-control">
            <label class="label">
              <span class="label-text">Number of Guests</span>
            </label>
            <input type="number" name="reservation_numguest" min="1" class="input input-bordered" required />
          </div>
          <div class="form-control">
            <label class="label">
              <span class="label-text">Special Requests</span>
            </label>
            <input type="text" name="reservation_specialrequest" placeholder="Early check-in, extra pillows..." class="input input-bordered" />
          </div>
        </div>
      </div>

      <!-- Guest Information -->
    <!-- Guest Information Section -->
<div class="bg-base-200 rounded-box p-5 mb-6">
  <div class="flex justify-between items-center mb-4">
    <h1 class="text-lg font-bold flex items-center gap-2">
      <i data-lucide="user-round" class="w-5 h-5 text-primary"></i>
      Guest Information
    </h1>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
    <!-- Full Name -->
    <div class="form-control">
      <label class="label">
        <span class="label-text font-medium flex items-center gap-1">
          <i data-lucide="user" class="w-4 h-4 text-primary"></i>
          Full Name
        </span>
      </label>
      <input type="text" name="guestname" class="input input-bordered" placeholder="Juan Dela Cruz" required />
    </div>

    <!-- Birthday -->
    <div class="form-control">
      <label class="label">
        <span class="label-text font-medium flex items-center gap-1">
          <i data-lucide="calendar" class="w-4 h-4 text-primary"></i>
          Birthday
        </span>
      </label>
      <input id="guestbirthday" type="date" name="guestbirthday" class="input input-bordered" required />
      <br>
       <span id="ageError" class="text-red-500 text-sm mt-2 hidden">Age must be 18 or above.</span>
    </div>

    <!-- Mobile Number -->
    <div class="form-control">
      <label class="label">
        <span class="label-text font-medium flex items-center gap-1">
          <i data-lucide="phone" class="w-4 h-4 text-primary"></i>
          Mobile Number
        </span>
      </label>
      <input type="tel" name="guestphonenumber" class="input input-bordered" placeholder="+63 900 000 0000" required />
    </div>

    <!-- Email Address -->
    <div class="form-control">
      <label class="label">
        <span class="label-text font-medium flex items-center gap-1">
          <i data-lucide="mail" class="w-4 h-4 text-primary"></i>
          Email Address
        </span>
      </label>
      <input type="email" name="guestemailaddress" class="input input-bordered" placeholder="juan@example.com" required />
    </div>

    <!-- Address -->
    <div class="form-control md:col-span-2 flex flex-col">
      <label class="label">
        <span class="label-text font-medium flex items-center gap-1">
          <i data-lucide="map-pin" class="w-4 h-4 text-primary"></i>
          Address
        </span>
      </label>
      <textarea name="guestaddress" class="textarea textarea-bordered" placeholder="123 Barangay St., City, Province" rows="2" required></textarea>
    </div>

    <!-- Contact Person -->
    <div class="form-control">
      <label class="label">
        <span class="label-text font-medium flex items-center gap-1">
          <i data-lucide="user-check" class="w-4 h-4 text-primary"></i>
          Contact Person
        </span>
      </label>
      <input type="text" name="guestcontactperson" class="input input-bordered" placeholder="Maria Dela Cruz" required />
    </div>

    <!-- Contact Person Number -->
    <div class="form-control">
      <label class="label">
        <span class="label-text font-medium flex items-center gap-1">
          <i data-lucide="phone-forwarded" class="w-4 h-4 text-primary"></i>
          Contact Person Number
        </span>
      </label>
      <input type="tel" name="guestcontactpersonnumber" class="input input-bordered" placeholder="+63 912 345 6789" required />
    </div>
  </div>
</div>

      <!-- Form Footer -->
      <div class="modal-action">
        <button type="button" onclick="add_booking.close()" class="btn btn-ghost">
          Cancel
        </button>
        <button type="submit" class="btn btn-primary gap-2">
          <i data-lucide="check-circle" class="w-5 h-5"></i>
          Confirm Reservation
        </button>
      </div>
    </form>
  </div>

  <!-- Backdrop -->
  <form method="dialog" class="modal-backdrop">
    <button>close</button>
  </form>
</dialog>

<!-- Lucide Init -->
<script>
  lucide.createIcons();

  function selectRoom(cardElement, roomID) {
    document.querySelectorAll('#add_booking .card').forEach(card => {
      card.classList.remove('border-primary', 'bg-primary/10');
      const indicator = card.querySelector('.selection-indicator');
      if (indicator) indicator.classList.add('hidden');
    });

    cardElement.classList.add('border-primary', 'bg-primary/10');
    const selectedIndicator = cardElement.querySelector('.selection-indicator');
    if (selectedIndicator) selectedIndicator.classList.remove('hidden');

    document.getElementById('selectedRoomID').value = roomID;
  }

   document.addEventListener('DOMContentLoaded', () => {
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
        // No date picked yet
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
