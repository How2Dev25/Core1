<dialog id="deleteMasterRFID_{{ $rfidmaster->masterRFID_ID }}" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg text-error flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            Confirm Deletion
        </h3>

        <p class="py-4">Are you sure you want to delete this master RFID?</p>

        <div class="bg-gray-100 p-3 rounded-lg mb-4">
            <p class="font-semibold">{{ $rfidmaster->masterRFID_name }}</p>
            <p class="font-mono text-sm text-gray-600">{{ $rfidmaster->masterRFID_rfid }}</p>
        </div>

        <form method="POST" action="/masterRFID/deletemasterRFID/{{ $rfidmaster->masterRFID_ID }}" class="modal-action">
            @csrf
            @method('DELETE')
            <button type="button" class="btn"
                onclick="document.getElementById('deleteMasterRFID_{{ $rfidmaster->masterRFID_ID }}').close()">Cancel</button>
            <button type="submit" class="btn btn-error">Delete Permanently</button>
        </form>

        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2"
            onclick="document.getElementById('deleteMasterRFID_{{ $rfidmaster->masterRFID_ID }}').close()">✕</button>
    </div>
</dialog>