<dialog id="delete_event_{{$reservation->eventbookingID}}" class="modal">
    <div class="modal-box max-w-md">
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">
                <i class="fa-solid fa-xmark w-4 h-4"></i>
            </button>
        </form>

        <h3 class="text-lg font-bold text-red-600 mb-4 flex items-center gap-2">
            <i class="fa-solid fa-trash w-5 h-5"></i>
            Confirm Deletion
        </h3>

        <p class="mb-6 text-sm text-gray-700">
            Are you sure you want to remove reservation for
            <span class="font-bold">{{$reservation->event_bookingreceiptID}} for
                {{$reservation->eventorganizer_name}}</span>?
            This action cannot be undone.
        </p>

        <form method="POST" action="/deletebookingevent/{{$reservation->eventbookingID}}">
            @csrf
            @method('DELETE')
            <div class="modal-action">
                <button type="button" onclick="delete_event_{{$reservation->eventbookingID}}.close()"
                    class="btn btn-ghost">
                    Cancel
                </button>
                <button type="submit" class="btn btn-error">
                    <i class="fa-solid fa-trash w-4 h-4 mr-1"></i>
                    Delete
                </button>
            </div>
        </form>
    </div>

    <!-- Click outside to close -->
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>