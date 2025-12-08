<dialog id="editrfid_{{ $doorlock->doorlockID }}" class="modal">
    <div class="modal-box">
        <!-- Modal title -->
        <h3 class="font-bold text-lg mb-4">Door Lock Integration</h3>

        <!-- Edit Form -->
        <form method="POST" action="/modifydoorLock/{{$doorlock->doorlockID}}" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Room ID input -->
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Room ID</span>
                </label>
                <select id="roomSelect_{{ $doorlock->doorlockID }}" name="roomID" class="select select-bordered select-primary w-full">
                    <option disabled>Select a room</option>

                    @forelse ($rooms as $room)
                        <option 
                            value="{{ $room->roomID }}" 
                            data-image="{{ $room->roomphoto }}"
                            {{ $doorlock->roomID == $room->roomID ? 'selected' : '' }}>
                            Room {{ $room->roomID }} - {{ $room->roomtype }}
                        </option>
                    @empty
                        <option disabled>No Room Available</option>
                    @endforelse
                </select>
            </div>

            <!-- Preview -->
            <div class="w-full flex justify-center items-center">
                <img id="roomPreview_{{ $doorlock->doorlockID }}" 
                     src="{{ $doorlock->roomphoto ?? '' }}" 
                     class="rounded-lg mt-3 w-full max-w-xs object-cover border shadow" />
            </div>

            <!-- RFID input -->
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">RFID</span>
                </label>
                <input type="text" name="rfid" value="{{ $doorlock->rfid }}" class="input input-bordered w-full" required />
            </div>

            <!-- Buttons -->
            <div class="modal-action">
                <button type="button" class="btn" onclick="document.getElementById('editrfid_{{ $doorlock->doorlockID }}').close()">Cancel</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>

        <!-- JS: Update image preview on room change -->
        <script>
            const roomSelect_{{ $doorlock->doorlockID }} = document.getElementById('roomSelect_{{ $doorlock->doorlockID }}');
            const preview_{{ $doorlock->doorlockID }} = document.getElementById('roomPreview_{{ $doorlock->doorlockID }}');

            roomSelect_{{ $doorlock->doorlockID }}.addEventListener('change', function () {
                const selectedOption = this.options[this.selectedIndex];
                const imageURL = selectedOption.dataset.image;
                if (imageURL) {
                    preview_{{ $doorlock->doorlockID }}.src = imageURL;
                }
            });
        </script>

        <!-- Close button (top right X) -->
        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2" type="button" onclick="document.getElementById('editrfid_{{ $doorlock->doorlockID }}').close()">✕</button>
    </div>
</dialog>
