<dialog id="editrfid_{{ $doorlock->doorlockID }}" class="modal">
    <div class="modal-box">
        <!-- Modal title -->
        <h3 class="font-bold text-lg mb-4">Door Lock Integration</h3>

        <!-- Edit Form -->
        <form method="POST" action="/modifydoorLock/{{$doorlock->doorlockID}}" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Room ID input (read-only) -->
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Room ID</span>
                </label>
                <input type="text" name="roomID" value="{{ $doorlock->roomID }}"
                    class="input input-bordered w-full bg-gray-100 cursor-not-allowed" readonly />
                <input type="hidden" name="roomID" value="{{ $doorlock->roomID }}">
            </div>

            
          
            <!-- RFID input -->
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">RFID</span>
                </label>
                <input type="text" name="rfid" value="{{ $doorlock->rfid }}" class="input input-bordered w-full"
                    required />
            </div>

            <!-- Buttons -->
            <div class="modal-action">
                <button type="button" class="btn"
                    onclick="document.getElementById('editrfid_{{ $doorlock->doorlockID }}').close()">Cancel</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>

        <!-- Close button (top right X) -->
        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2" type="button"
            onclick="document.getElementById('editrfid_{{ $doorlock->doorlockID }}').close()">✕</button>
    </div>
</dialog>