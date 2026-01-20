<dialog id="confirm_reservation_{{$reserveroom->reservationID}}" class="modal">
  <div class="modal-box max-w-md p-6">

    <!-- Close -->
    <form method="dialog">
      <button class="btn btn-sm btn-circle btn-ghost absolute right-3 top-3 z-10">
        <i class="fas fa-times"></i>
      </button>
    </form>

    <!-- Header -->
    <div class="flex items-start gap-3 mb-6">
      <div class="bg-[#F7B32B]/10 p-2 rounded-lg">
        <i class="fas fa-check-circle text-[#F7B32B] text-xl"></i>
      </div>
      <div>
        <h3 class="text-xl font-bold text-gray-900">Confirm Reservation</h3>
        <p class="text-sm text-gray-500 mt-1">Please select confirmation type below</p>
      </div>
    </div>

    <!-- Reservation Details Card -->
    <div class="bg-gray-50 rounded-xl p-4 mb-6 border border-gray-200">
      <div class="grid grid-cols-1 gap-3">
        <div class="flex items-center gap-3">
          <i class="fas fa-tag text-gray-400 text-sm"></i>
          <div class="flex-1">
            <span class="text-sm text-gray-600">Reservation ID</span>
            <span class="block font-bold text-gray-900">{{$reserveroom->bookingID}}</span>
          </div>
        </div>
        <div class="flex items-center gap-3">
          <i class="fas fa-user text-gray-400 text-sm"></i>
          <div class="flex-1">
            <span class="text-sm text-gray-600">Guest Name</span>
            <span class="block font-bold text-gray-900">{{$reserveroom->guestname}}</span>
          </div>
        </div>
      </div>
    </div>

    <!-- Payment Selection -->
    <div class="mb-8">
      <h4 class="text-sm font-semibold text-gray-700 mb-3 uppercase tracking-wide">
        <i class="fas fa-credit-card mr-2"></i>Confirmation Type
      </h4>
      <div class="space-y-3">
        <label
          class="flex items-center gap-4 p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:bg-amber-50 hover:border-[#F7B32B]/30 transition-all duration-200 has-[:checked]:border-[#F7B32B] has-[:checked]:bg-amber-50/50">
          <input type="radio" name="payment_status" value="Partial" form="confirmForm{{$reserveroom->reservationID}}"
            class="radio radio-warning checked:bg-[#F7B32B]" checked>
          <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-full bg-amber-100 flex items-center justify-center">
              <i class="fas fa-money-bill-wave text-amber-600"></i>
            </div>
            <div class="flex-1">
              <span class="font-medium text-gray-900">Confirm with Deposit</span>
              <p class="text-xs text-gray-500 mt-1">Guest will pay partial amount now</p>
            </div>
          </div>
          <i
            class="fas fa-check-circle text-[#F7B32B] text-lg opacity-0 group-has-[:checked]:opacity-100 transition-opacity"></i>
        </label>

        <label
          class="flex items-center gap-4 p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:bg-emerald-50 hover:border-emerald-200 transition-all duration-200 has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-50/50">
          <input type="radio" name="payment_status" value="Fully Paid" form="confirmForm{{$reserveroom->reservationID}}"
            class="radio radio-success checked:bg-emerald-500">
          <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center">
              <i class="fas fa-wallet text-emerald-600"></i>
            </div>
            <div class="flex-1">
              <span class="font-medium text-gray-900">Confirm as Fully Paid</span>
              <p class="text-xs text-gray-500 mt-1">Complete payment received</p>
            </div>
          </div>
          <i
            class="fas fa-check-circle text-emerald-500 text-lg opacity-0 group-has-[:checked]:opacity-100 transition-opacity"></i>
        </label>
      </div>
    </div>

    <!-- Actions -->
    <form id="confirmForm{{$reserveroom->reservationID}}" method="POST"
      action="/reservationconfirm/{{$reserveroom->reservationID}}" class="mt-8 pt-6 border-t border-gray-200">
      @csrf
      @method('PUT')

      <div class="flex gap-3 justify-end">
        <button type="button" onclick="confirm_reservation_{{$reserveroom->reservationID}}.close()"
          class="btn btn-outline btn-sm px-6 hover:bg-gray-100">
          <i class="fas fa-times mr-2"></i>
          Cancel
        </button>

        <button type="submit"
          class="btn btn-primary bg-[#F7B32B] border-[#F7B32B] hover:bg-[#e6a229] hover:border-[#e6a229] text-white px-8 btn-sm shadow-sm">
          <i class="fas fa-check-circle mr-2"></i>
          Confirm Reservation
        </button>
      </div>
    </form>

  </div>

  <!-- Backdrop -->
  <form method="dialog" class="modal-backdrop bg-black/50 backdrop-blur-sm">
    <button>close</button>
  </form>
</dialog>