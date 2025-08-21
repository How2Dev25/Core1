<dialog id="checkout_reservation_{{$reserveroom->reservationID}}" class="modal">
  <div class="modal-box max-w-md">
    <form method="dialog">
      <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">
        <i data-lucide="x" class="w-4 h-4"></i>
      </button>
    </form>

    <h3 class="text-lg font-bold text-warning mb-4 flex items-center gap-2">
      <i data-lucide="circle-arrow-out-up-left" class="w-5 h-5"></i>
      Check Out Reservation
    </h3>

    <p class="mb-6 text-sm text-gray-700">Are you sure you want to Check - Out reservation for <span class="font-bold">{{$reserveroom->reservation_receipt}} for {{$reserveroom->guestname}}</span> This action cannot be undone.</p>

    <form  method="POST" action="/reservationcheckout/{{$reserveroom->reservationID}}">
      @csrf
      @method('PUT')
      <div class="modal-action">
        <button  type="button" onclick="checkout_reservation_{{$reserveroom->reservationID}}.close()" class="btn btn-ghost">Cancel</button>
        <button  type="submit" class="btn btn-warning">
          <i data-lucide="circle-arrow-out-up-left" class="w-4 h-4 mr-1"></i>
          Confirm
        </button>
      </div>
    </form>
  </div>

  <!-- Click outside to close -->
  <form method="dialog" class="modal-backdrop">
    <button>close</button>
  </form>
</dialog>
