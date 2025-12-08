<dialog id="removerfid_{{ $doorlock->doorlockID }}" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg">Delete RFID{{ $doorlock->rfid}}</h3>
        <p class="py-4">Are you sure you want to delete this RFID?</p>

        <form method="POST" action="/removedoorLock/{{ $doorlock->doorlockID }}">
            @csrf
            @method('DELETE')
            <div class="modal-action">
                <button type="button" onclick="document.getElementById('removerfid_{{ $doorlock->doorlockID }} }}').close()"
                    class="btn">
                    Cancel
                </button>
                <button type="submit" class="btn btn-error">
                    Delete
                </button>
            </div>
        </form>
    </div>

    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>