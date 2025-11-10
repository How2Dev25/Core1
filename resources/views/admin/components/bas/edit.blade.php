<dialog id="edit_reservation_{{$reserveroom->reservationID}}" class="modal">
  <div class="modal-box w-11/12 max-w-6xl p-0 max-h-[90vh] overflow-hidden flex flex-col">
    <!-- Modal Header - Fixed -->
    <div class="sticky top-0 z-10 bg-gradient-to-r from-primary to-primary/90 text-white px-4 sm:px-6 py-4 shadow-lg">
      <div class="flex justify-between items-center">
        <h3 class="text-lg sm:text-xl md:text-2xl font-bold flex items-center gap-2">
          <i data-lucide="file-edit" class="w-5 h-5 sm:w-6 sm:h-6"></i>
          <span class="hidden sm:inline">Edit/View Reservation</span>
          <span class="sm:hidden">Reservation</span>
          <span class="text-sm sm:text-base font-normal opacity-90">#{{$reserveroom->bookingID}}</span>
        </h3>
        <form method="dialog">
          <button class="btn btn-circle btn-ghost btn-sm text-white hover:bg-white/20">
            <i data-lucide="x" class="w-5 h-5"></i>
          </button>
        </form>
      </div>
    </div>

    <!-- Scrollable Content -->
    <div class="overflow-y-auto flex-1 px-4 sm:px-6 py-6">
      <!-- Form Start -->
      <form action="/modifyreservation/{{$reserveroom->reservationID}}" method="POST" id="reservationForm">
        @method('PUT')
        @csrf

        <!-- Room Information -->
        <div
          class="bg-gradient-to-br from-base-100 to-base-200 rounded-xl p-4 sm:p-6 mb-6 shadow-md border border-base-300">
          <h2 class="text-base sm:text-lg font-semibold text-gray-700 flex items-center gap-2 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            Room Information
          </h2>

          <div class="card bg-white shadow-xl hover:shadow-2xl transition-all duration-300 overflow-hidden">
            <div class="flex flex-col lg:flex-row">
              <figure class="lg:w-2/5 h-48 sm:h-56 lg:h-auto overflow-hidden">
                <img class="w-full h-full object-cover hover:scale-110 transition-transform duration-500"
                  src="{{ asset($reserveroom->roomphoto) }}" alt="Room image">
              </figure>
              <div class="card-body p-4 sm:p-6 lg:w-3/5">
                <h2 class="card-title text-base sm:text-lg md:text-xl text-primary mb-3">
                  Room #{{$reserveroom->roomID}} - {{$reserveroom->roomtype}}
                </h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-sm sm:text-base">
                  <div class="flex items-center gap-2 bg-base-200 p-3 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-primary flex-shrink-0" fill="none"
                      viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 8V4a1 1 0 011-1h4M4 8v8a2 2 0 002 2h8a2 2 0 002-2V8m0 0h4a1 1 0 011 1v4m0 0v4a1 1 0 01-1 1h-4" />
                    </svg>
                    <span class="font-medium">{{$reserveroom->roomsize}} sq.ft</span>
                  </div>
                  <div class="flex items-center gap-2 bg-base-200 p-3 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-primary flex-shrink-0" fill="none"
                      viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span class="font-medium">{{$reserveroom->roommaxguest}} Guests</span>
                  </div>
                  <div class="flex items-center gap-2 bg-primary/10 p-3 rounded-lg sm:col-span-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-primary flex-shrink-0" fill="none"
                      viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="font-bold text-lg text-primary">₱{{$reserveroom->roomprice}}.00 <span
                        class="text-sm font-normal text-gray-600">per night</span></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Reservation Details -->
        <div
          class="bg-gradient-to-br from-base-100 to-base-200 rounded-xl p-4 sm:p-6 mb-6 shadow-md border border-base-300">
          <h2 class="text-base sm:text-lg font-semibold text-gray-700 flex items-center gap-2 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            Reservation Details
          </h2>

          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="form-control">
              <label class="label">
                <span class="label-text font-semibold text-gray-700">Check-In Date</span>
              </label>
              <input value="{{$reserveroom->reservation_checkin}}" type="date" name="reservation_checkin"
                class="input input-bordered w-full focus:input-primary" required />
            </div>

            <div class="form-control">
              <label class="label">
                <span class="label-text font-semibold text-gray-700">Check-Out Date</span>
              </label>
              <input type="date" value="{{$reserveroom->reservation_checkout}}" name="reservation_checkout"
                class="input input-bordered w-full focus:input-primary" required />
            </div>

            <div class="form-control">
              <label class="label">
                <span class="label-text font-semibold text-gray-700">Number of Guests</span>
              </label>
              <input value="{{$reserveroom->reservation_numguest}}" type="number" name="reservation_numguest" min="1"
                max="" class="input input-bordered w-full focus:input-primary" required />
            </div>

            <div class="form-control sm:col-span-2 lg:col-span-2">
              <label class="label">
                <span class="label-text font-semibold text-gray-700">Special Requests</span>
              </label>
              <input type="text" value="{{$reserveroom->reservation_specialrequest}}" name="reservation_specialrequest"
                placeholder="Early check-in, extra pillows..."
                class="input input-bordered w-full focus:input-primary" />
            </div>

            <div class="form-control">
              <label class="label">
                <span class="label-text font-semibold text-gray-700">Booking Status</span>
              </label>
              <div class="relative">
                <input readonly type="text" value="{{$reserveroom->reservation_bookingstatus}}"
                  class="input input-bordered w-full bg-base-200 font-semibold text-primary cursor-not-allowed" />
                <div class="absolute right-3 top-1/2 -translate-y-1/2">
                  <div class="badge badge-primary badge-sm">Active</div>
                </div>
              </div>
            </div>

            <div class="form-control sm:col-span-2 lg:col-span-1">
              <label class="label">
                <span class="label-text font-semibold text-gray-700">Booked Via</span>
              </label>
              <input type="text" value="{{$reserveroom->bookedvia}}" name="bookedvia"
                class="input input-bordered w-full focus:input-primary" />
            </div>
          </div>
        </div>

        <!-- Guest Information -->
        <div
          class="bg-gradient-to-br from-base-100 to-base-200 rounded-xl p-4 sm:p-6 mb-6 shadow-md border border-base-300">
          <h2 class="text-base sm:text-lg font-semibold text-gray-700 flex items-center gap-2 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            Guest Information
          </h2>

          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <!-- Full Name -->
            <div class="form-control">
              <label class="label">
                <span class="label-text font-semibold text-gray-700">Full Name</span>
              </label>
              <input value="{{$reserveroom->guestname}}" type="text" name="guestname"
                class="input input-bordered focus:input-primary" placeholder="Juan Dela Cruz" required />
            </div>

            <!-- Birthday -->
            <div class="form-control">
              <label class="label">
                <span class="label-text font-semibold text-gray-700">Birthday</span>
              </label>
              <input value="{{$reserveroom->guestbirthday}}" id="guestbirthday" type="date" name="guestbirthday"
                class="input input-bordered focus:input-primary" required />
              <label class="label">
                <span id="ageError" class="label-text-alt text-error font-semibold hidden">Age must be 18 or
                  above</span>
              </label>
            </div>

            <!-- Mobile Number -->
            <div class="form-control">
              <label class="label">
                <span class="label-text font-semibold text-gray-700">Mobile Number</span>
              </label>
              <input value="{{$reserveroom->guestphonenumber}}" type="tel" name="guestphonenumber"
                class="input input-bordered focus:input-primary" placeholder="+63 900 000 0000" required />
            </div>

            <!-- Email Address -->
            <div class="form-control sm:col-span-2 lg:col-span-1">
              <label class="label">
                <span class="label-text font-semibold text-gray-700">Email Address</span>
              </label>
              <input value="{{$reserveroom->guestemailaddress}}" type="email" name="guestemailaddress"
                class="input input-bordered focus:input-primary" placeholder="juan@example.com" required />
            </div>

            <!-- Contact Person -->
            <div class="form-control">
              <label class="label">
                <span class="label-text font-semibold text-gray-700">Contact Person</span>
              </label>
              <input value="{{$reserveroom->guestcontactperson}}" type="text" name="guestcontactperson"
                class="input input-bordered focus:input-primary" placeholder="Maria Dela Cruz" required />
            </div>

            <!-- Contact Person Number -->
            <div class="form-control">
              <label class="label">
                <span class="label-text font-semibold text-gray-700">Contact Person Number</span>
              </label>
              <input value="{{$reserveroom->guestcontactpersonnumber}}" type="tel" name="guestcontactpersonnumber"
                class="input input-bordered focus:input-primary" placeholder="+63 912 345 6789" required />
            </div>

            <!-- Payment Method -->
            <div class="form-control">
              <label class="label">
                <span class="label-text font-semibold text-gray-700">Payment Method</span>
              </label>
              <select name="payment_method" class="select select-bordered focus:select-primary" required>
                <option value="{{$reserveroom->payment_method}}" selected>{{$reserveroom->payment_method}}</option>
              </select>
            </div>

            <!-- Address -->
            <div class="form-control sm:col-span-2 lg:col-span-3">
              <label class="label">
                <span class="label-text font-semibold text-gray-700">Address</span>
              </label>
              <textarea name="guestaddress" class="textarea textarea-bordered focus:textarea-primary"
                placeholder="123 Barangay St., City, Province" rows="2"
                required>{{$reserveroom->guestaddress}}</textarea>
            </div>
          </div>
        </div>

        <!-- Form Footer -->
        <div class="flex flex-col-reverse sm:flex-row justify-end gap-3 pt-4 border-t border-gray-200">
          <button type="button" onclick="edit_reservation_{{$reserveroom->reservationID}}.close()"
            class="btn btn-ghost">
            <i data-lucide="x" class="w-5 h-5"></i>
            Close
          </button>

          <button type="submit" class="btn btn-primary">
            <i data-lucide="save" class="w-5 h-5"></i>
            Save Changes
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- Backdrop -->
  <form method="dialog" class="modal-backdrop">
    <button>close</button>
  </form>
</dialog>

<!-- Lucide Init -->
<script>
  lucide.createIcons();

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