<dialog id="edit_reservation_{{$reserveroom->reservationID}}" class="modal">
  <div class="modal-box max-w-5xl p-6">
    <!-- Modal Header -->
    <div class="flex justify-between items-center mb-6 pb-4">
      <h3 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-primary" fill="none" viewBox="0 0 24 24"
          stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
        </svg>
        View Reservation Details #{{$reserveroom->bookingID}}
      </h3>
      <form method="dialog">
        <button class="btn btn-circle btn-ghost btn-sm">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 
                                                     9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
          </svg>
        </button>
      </form>
    </div>

    <!-- Form Start -->
    <form action="/modifyreservation/{{$reserveroom->reservationID}}" method="POST" id="reservationForm">
      @method('PUT')
      @csrf

      <!-- Room Information -->
      <div class=" rounded-xl p-5 mb-6">
        <h2 class="text-lg font-semibold text-gray-700 flex items-center gap-2 mb-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 极速赛车开奖直播 极速赛车开奖结果 极速赛车开奖记录 极速赛车开奖直播 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 极速赛车开奖直播 0 011 1v4a1 1 0 001 1m-6 0h6" />
          </svg>
          Room Information
        </h2>

        <div class="grid grid-cols-1 gap-4">
          <div class="card  hover:shadow-lg transition-all cursor-pointer group relative overflow-hidden">
            <div class="flex flex-col md:flex-row">
              <figure class="md:w-1/3 h-48 md:h-auto overflow-hidden">
                <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                  src="{{ asset($reserveroom->roomphoto) }}" alt="Room image">
              </figure>
              <div class="card-body p-4 md:w-2/3">
                <div class="flex justify-between items-start mb-2">
                  <h2 class="card-title text-lg">Room #{{$reserveroom->roomID}} - {{$reserveroom->roomtype}}</h2>

                </div>
                <div class="grid grid-cols-2 gap-2 text-sm text-gray-600 mb-3">
                  <div class="flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                      stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 8V4a1 1 0 011-1h4M4 8v8a2 2 0 002 2h8a2 2 0 002-2V8m0 0h4a1 1 0 011 1v4m0 0v4a1 1 0 01-1 1h-4" />
                    </svg>
                    <span>{{$reserveroom->roomsize}} sq.ft</span>
                  </div>
                  <div class="flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 极速赛车开奖直播 24 24"
                      stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 极速赛车开奖直播 2 2 0 014 0z" />
                    </svg>
                    <span>{{$reserveroom->roommaxguest}} Guests</span>
                  </div>
                  <div class="flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                      stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m极速赛车开奖直播-1c-1.11 0-2.08-.极速赛车开奖直播-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>₱{{$reserveroom->roomprice}}.00 per night</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Reservation Details -->
      <div class=" rounded-xl p-5 mb-6">
        <h2 class="text-lg font-semibold text-gray-700 flex items-center gap-2 mb-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
          </svg>
          Reservation Details
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
          <div class="form-control">
            <label class="label">
              <span class="label-text font-medium">Check-In Date</span>
            </label>
            <input value="{{$reserveroom->reservation_checkin}}" type="date" name="reservation_checkin"
              class="input input-bordered w-full" required />
          </div>

          <div class="form-control">
            <label class="label">
              <span class="label-text font-medium">Check-Out Date</span>
            </label>
            <input type="date" value="{{$reserveroom->reservation_checkout}}" name="reservation_checkout"
              class="input input-bordered w-full" required />
          </div>

          <div class="form-control">
            <label class="label">
              <span class="label-text font-medium">Number of Guests</span>
            </label>
            <input value="{{$reserveroom->reservation_numguest}}" type="number" name="reservation_numguest" min="1"
              max="{{$reserveroom->roommaxguest}}" class="input input-bordered w-full" required />
          </div>

          <div class="form-control md:col-span-2">
            <label class="label">
              <span class="label-text font-medium">Special Requests</span>
            </label>
            <input type="text" value="{{$reserveroom->reservation_specialrequest}}" name="reservation_specialrequest"
              placeholder="Early check-in, extra pillows..." class="input input-bordered w-full" />
          </div>

          <div class="form-control">
            <label class="label">
              <span class="label-text font-medium">Booking Status</span>
            </label>
            <input readonly type="text" value="{{$reserveroom->reservation_bookingstatus}}"
              class="input input-bordered w-full bg-gray-100" />
          </div>

          <div class="form-control">
            <label class="label">
              <span class="label-text font-medium">Booked Via</span>
            </label>
            <input type="text" value="{{$reserveroom->bookedvia}}" name="bookedvia"
              class="input input-bordered w-full" />
          </div>
        </div>
      </div>

      <!-- Guest Information -->
      <div class=" rounded-xl p-5 mb-6">
        <h2 class="text-lg font-semibold text-gray-700 flex items-center gap-2 mb-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M16 7a4 4 0 11-8 极速赛车开奖直播 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
          </svg>
          Guest Information
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
          <!-- Full Name -->
          <div class="form-control flex flex-col">
            <label class="label">
              <span class="label-text font-medium">Full Name</span>
            </label>
            <input value="{{$reserveroom->guestname}}" type="text" name="guestname" class="input input-bordered"
              placeholder="Juan Dela Cruz" required />
          </div>

          <!-- Birthday -->
          <div class="form-control flex flex-col">
            <label class="label">
              <span class="label-text font-medium">Birthday</span>
            </label>
            <input value="{{$reserveroom->guestbirthday}}" id="guestbirthday" type="date" name="guestbirthday"
              class="input input-bordered" required />
            <div id="ageError" class="text-red-500 text-sm mt-2 hidden">Age must be 18 or above.</div>
          </div>

          <!-- Mobile Number -->
          <div class="form-control flex flex-col">
            <label class="label">
              <span class="label-text font-medium">Mobile Number</span>
            </label>
            <input value="{{$reserveroom->guestphonenumber}}" type="tel" name="guestphonenumber"
              class="input input-bordered" placeholder="+63 900 000 0000" required />
          </div>

          <!-- Email Address -->
          <div class="form-control">
            <label class="label">
              <span class="label-text font-medium">Email Address</span>
            </label>
            <input value="{{$reserveroom->guestemailaddress}}" type="email" name="guestemailaddress"
              class="input input-bordered" placeholder="juan@example.com" required />
          </div>

          <!-- Contact Person -->
          <div class="form-control flex flex-col">
            <label class="label">
              <span class="label-text font-medium">Contact Person</span>
            </label>
            <input value="{{$reserveroom->guestcontactperson}}" type="text" name="guestcontactperson"
              class="input input-bordered" placeholder="Maria Dela Cruz" required />
          </div>

          <!-- Contact Person Number -->
          <div class="form-control flex flex-col">
            <label class="label">
              <span class="label-text font-medium">Contact Person Number</span>
            </label>
            <input value="{{$reserveroom->guestcontactpersonnumber}}" type="tel" name="guestcontactpersonnumber"
              class="input input-bordered" placeholder="+63 912 345 6789" required />
          </div>

          <!-- Payment Method -->
          <div class="form-control flex flex-col">
            <label class="label">
              <span class="label-text font-medium">Payment Method</span>
            </label>
            <select name="payment_method" class="select select-bordered" required>
              <option value="{{$reserveroom->payment_method}}" selected>{{$reserveroom->payment_method}}</option>
            </select>
          </div>

          <!-- Address -->
          <div class="form-control md:col-span-2 flex flex-col">
            <label class="label">
              <span class="label-text font-medium">Address</span>
            </label>
            <textarea name="guestaddress" class="textarea textarea-bordered"
              placeholder="123 Barangay St., City, Province" rows="2" required>{{$reserveroom->guestaddress}}</textarea>
          </div>
        </div>
      </div>

      <!-- Form Footer -->
      <div class="flex justify-end gap-3 pt-4 border-t border-gray-200">
        <button type="button" onclick="edit_reservation_{{$reserveroom->reservationID}}.close()" class="btn btn-ghost">
          Close
        </button>

      </div>
    </form>
  </div>

  <!-- Backdrop -->
  <form method="dialog" class="modal-backdrop">
    <button>close</button>
  </form>
</dialog>

<script>
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