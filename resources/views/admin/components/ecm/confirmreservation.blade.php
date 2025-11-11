<dialog id="confirm_event_{{$reservation->eventbookingID}}" class="modal">
    <div class="modal-box max-w-md">
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">
                <i class="fa-solid fa-xmark w-4 h-4"></i>
            </button>
        </form>

        <h3 class="text-lg font-bold text-[#F7B32B] mb-4 flex items-center gap-2">
            <i class="fa-solid fa-check w-5 h-5"></i>
            Confirm Reservation
        </h3>

        <p class="mb-6 text-sm text-gray-700">
            Are you sure you want to confirm reservation for
            <span class="font-bold">
                {{$reservation->event_bookingreceiptID}} for {{$reservation->eventorganizer_name}}
            </span>? This action cannot be undone.
        </p>

        <form method="POST" action="/confirmeventbooking/{{$reservation->eventbookingID}}">
            @csrf
            @method('PUT')
            <div class="modal-action">
                <button type="button" onclick="confirm_event_{{$reservation->eventbookingID}}.close()"
                    class="btn btn-ghost">
                    Cancel
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-check w-4 h-4 mr-1"></i>
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