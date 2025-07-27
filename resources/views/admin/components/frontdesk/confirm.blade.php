<dialog id="confirm_reservation_{{$reserveroom->reservationID}}" class="modal">
  <div class="modal-box max-w-md">
    <form method="dialog">
      <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">
        <i data-lucide="x" class="w-4 h-4"></i>
      </button>
    </form>

    <h3 class="text-lg font-bold text-green-600 mb-4 flex items-center gap-2">
      <i data-lucide="check" class="w-5 h-5"></i>
      Confirm Reservation
    </h3>

    <p class="mb-6 text-sm text-gray-700">Are you sure you want to Confirm reservation for <span class="font-bold">{{$reserveroom->reservationID}} of {{$reserveroom->guestname}}</span> This action cannot be undone.</p>

    <form  method="POST" action="/reservationconfirm/{{$reserveroom->reservationID}}">
      @csrf
      @method('PUT')
      <div class="modal-action">
        <button  type="button" onclick="confirm_reservation_{{$reserveroom->reservationID}}.close()" class="btn btn-ghost">Cancel</button>
        <button  type="submit" class="btn btn-success">
          <i data-lucide="check" class="w-4 h-4 mr-1"></i>
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
