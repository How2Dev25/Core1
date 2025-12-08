<dialog id="roomModal" class="modal">
    <div class="modal-box">
        <!-- Modal title -->
        <h3 class="font-bold text-lg mb-4">Door Lock Integration</h3>

        <!-- Form with two input fields -->
     <form method="POST" action="/storedoorLock" class="space-y-4">
    @csrf

    <!-- Room ID input -->
    <div class="form-control w-full">
        <label class="label">
            <span class="label-text">Room ID</span>
        </label>
        <select id="roomSelect" name="roomID" class="select select-bordered select-primary w-full">
            <option disabled selected>Select a room</option>

            @forelse ($rooms as $room)
                <option 
                    value="{{ $room->roomID }}"
                    data-image="{{ $room->roomphoto }}">
                    Room {{ $room->roomID }} - {{ $room->roomtype }}
                </option>
            @empty
                <option disabled>No Room Available</option>
            @endforelse
        </select>
    </div>

    <!-- Preview -->
    <div class="w-full flex justify-center items-center">
        <img id="roomPreview" 
             src="" 
             class="rounded-lg mt-3 hidden w-full max-w-xs object-cover border shadow" />
    </div>

    <!-- RFID input -->
    <div class="form-control w-full">
        <label class="label">
            <span class="label-text">RFID</span>
        </label>
        <input type="text" name="rfid" class="input input-bordered w-full" />
    </div>

    <!-- Buttons -->
    <div class="modal-action">
        <button type="button" class="btn" onclick="document.getElementById('roomModal').close()">Cancel</button>
        <button class="btn btn-primary" type="submit">Submit</button>
    </div>
</form>

<script>
    const roomSelect = document.getElementById('roomSelect');
    const preview = document.getElementById('roomPreview');

    roomSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const imageURL = selectedOption.dataset.image;

        if (imageURL) {
            preview.src = imageURL;
            preview.classList.remove('hidden');
        }
    });
</script>

<script>
    const roomSelect = document.getElementById('roomSelect');
    const preview = document.getElementById('roomPreview');

    roomSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const imageURL = selectedOption.dataset.image;

        if (imageURL) {
            preview.src = imageURL;
            preview.classList.remove('hidden');
        }
    });
</script>

        <!-- Close button (top right X) -->
        <form method="dialog" class="modal-backdrop">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
    </div>

    <!-- Click outside to close -->
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>