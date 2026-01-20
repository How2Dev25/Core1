<dialog id="checkout_reservation_{{$reserveroom->reservationID}}" class="modal">
  <div class="modal-box max-w-md p-6">

    <!-- Close -->
    <form method="dialog">
      <button class="btn btn-sm btn-circle btn-ghost absolute right-3 top-3 z-10">
        <i class="fas fa-times"></i>
      </button>
    </form>

    <!-- Header -->
    <div class="flex items-start gap-3 mb-6">
      <div class="bg-warning/10 p-2 rounded-lg">
        <i class="fas fa-sign-out-alt text-warning text-xl"></i>
      </div>
      <div>
        <h3 class="text-xl font-bold text-gray-900">Check Out Reservation</h3>
        <p class="text-sm text-gray-500 mt-1">Finalize guest stay and complete payment</p>
      </div>
    </div>

    <!-- Reservation Details -->
    <div class="mb-6">
      <div class="bg-gray-50 rounded-xl p-4 mb-4 border border-gray-200">
        <div class="grid grid-cols-1 gap-3">
          <div class="flex items-center gap-3">
            <i class="fas fa-hashtag text-gray-400 text-sm"></i>
            <div class="flex-1">
              <span class="text-sm text-gray-600">Booking ID</span>
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

      <!-- Payment Summary -->
      <div class="space-y-4">
        <div class="border-l-4 border-warning pl-4 py-2">
          <h4 class="text-sm font-semibold text-gray-700 mb-2">Payment Summary</h4>

          <div class="space-y-2">
            <div class="flex justify-between items-center">
              <span class="text-sm text-gray-600">Total Amount</span>
              <span class="font-bold text-gray-900">₱{{ number_format($reserveroom->total, 2) }}</span>
            </div>

            <div class="flex justify-between items-center">
              <span class="text-sm text-gray-600">
                <i class="fas fa-money-bill-wave text-amber-500 mr-1"></i>
                Deposit Paid
              </span>
              <span class="font-bold text-amber-600">₱{{ number_format($reserveroom->deposit_amount, 2) }}</span>
            </div>

            <div class="flex justify-between items-center border-t border-gray-200 pt-2">
              <span class="text-sm font-semibold text-gray-700">
                <i class="fas fa-scale-balanced text-blue-500 mr-1"></i>
                Balance Remaining
              </span>
              <span class="font-bold text-blue-600">₱{{ number_format($reserveroom->balance_remaining, 2) }}</span>
            </div>
          </div>
        </div>

        <!-- Checkout Warning -->
        <div class="bg-amber-50 border border-amber-200 rounded-lg p-4">
          <div class="flex items-start gap-2">
            <i class="fas fa-exclamation-triangle text-amber-500 mt-0.5"></i>
            <div class="flex-1">
              <h5 class="text-sm font-semibold text-amber-800 mb-1">Important Note</h5>
              <p class="text-xs text-amber-700">
                Upon checkout, the remaining balance of <span
                  class="font-bold">₱{{ number_format($reserveroom->balance_remaining, 2) }}</span>
                will be marked as paid and the payment status will be updated to <span class="font-bold">"Fully
                  Paid"</span>.
              </p>
            </div>
          </div>
        </div>

        <!-- Final Warning -->
        <div class="bg-red-50 border border-red-200 rounded-lg p-4">
          <div class="flex items-start gap-2">
            <i class="fas fa-shield-exclamation text-red-500 mt-0.5"></i>
            <div class="flex-1">
              <h5 class="text-sm font-semibold text-red-800 mb-1">Final Confirmation</h5>
              <p class="text-xs text-red-700">
                Are you sure you want to check out this reservation? This action cannot be undone and will:
              </p>
              <ul class="text-xs text-red-700 mt-1 space-y-1 list-disc pl-4">
                <li>Mark the reservation as checked out</li>
                <li>Update payment status to "Fully Paid"</li>
                <li>Close the balance of ₱{{ number_format($reserveroom->balance_remaining, 2) }}</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Actions -->
    <form method="POST" action="/reservationcheckout/{{$reserveroom->reservationID}}"
      class="mt-6 pt-6 border-t border-gray-200">
      @csrf
      @method('PUT')

      <div class="flex gap-3 justify-end">
        <button type="button" onclick="checkout_reservation_{{$reserveroom->reservationID}}.close()"
          class="btn btn-outline btn-sm px-6 hover:bg-gray-100">
          <i class="fas fa-times mr-2"></i>
          Cancel
        </button>

        <button type="submit"
          class="btn btn-warning bg-warning border-warning hover:bg-amber-500 hover:border-amber-500 text-white px-8 btn-sm shadow-sm">
          <i class="fas fa-sign-out-alt mr-2"></i>
          Confirm Check Out
        </button>
      </div>
    </form>

  </div>

  <!-- Backdrop -->
  <form method="dialog" class="modal-backdrop bg-black/50 backdrop-blur-sm">
    <button>close</button>
  </form>
</dialog>