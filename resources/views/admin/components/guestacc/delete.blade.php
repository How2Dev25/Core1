<dialog id="remove_modal_{{ $guests->guestID }}" class="modal">
    <div class="modal-box">
        <div class="flex items-center justify-center w-16 h-16 mx-auto bg-error/10 rounded-full mb-4">
            <svg class="w-8 h-8 text-error" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
        </div>

        <h3 class="font-bold text-xl text-center mb-2">Remove Guest Account</h3>
        <p class="text-center text-gray-600 mb-2">Are you sure you want to permanently remove <span
                class="font-semibold text-gray-900">{{ $guests->guest_name }}</span>?</p>
        <p class="text-center text-error text-sm font-semibold mb-6">⚠️ This action cannot be undone!</p>

        <!-- Guest Info Card -->
        <div class="bg-error/5 border border-error/20 rounded-lg p-4 mb-6">
            <div class="flex items-center gap-3">
                <img class="rounded-full w-12 h-12" src="{{ asset($guests->guest_photo) }}"
                    alt="{{ $guests->guest_name }}">
                <div>
                    <div class="font-semibold text-gray-900">{{ $guests->guest_name }}</div>
                    <div class="text-sm text-gray-500">{{ $guests->guest_email }}</div>
                </div>
            </div>
        </div>

        <form action="/removeGuest/{{ $guests->guestID}}" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-action">
                <button type="button" onclick="remove_modal_{{ $guests->guestID}}.close()" class="btn btn-ghost">
                    Cancel
                </button>
                <button type="submit" class="btn btn-error">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    Delete Permanently
                </button>
            </div>
        </form>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>