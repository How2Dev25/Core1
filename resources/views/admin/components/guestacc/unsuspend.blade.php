<dialog id="unsuspend_modal_{{ $guests->guestID }}" class="modal">
    <div class="modal-box">
        <div class="flex items-center justify-center w-16 h-16 mx-auto bg-success/10 rounded-full mb-4">
            <svg class="w-8 h-8 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>

        <h3 class="font-bold text-xl text-center mb-2">Unsuspend Guest Account</h3>
        <p class="text-center text-gray-600 mb-6">Are you sure you want to unsuspend <span
                class="font-semibold text-gray-900">{{ $guests->guest_name }}</span>? They will regain access to their
            account.
        </p>

        <!-- Guest Info Card -->
        <div class="bg-gray-50 rounded-lg p-4 mb-6">
            <div class="flex items-center gap-3">
                <img class="rounded-full w-12 h-12" src="{{ asset($guests->guest_photo) }}"
                    alt="{{ $guests->guest_name }}">
                <div>
                    <div class="font-semibold text-gray-900">{{ $guests->guest_name }}</div>
                    <div class="text-sm text-gray-500">{{ $guests->guest_email }}</div>
                </div>
            </div>
        </div>

        <form action="/unsuspendGuest/{{ $guests->guestID}}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-action">
                <button type="button" onclick="unsuspend_modal_{{ $guests->guestID}}.close()" class="btn btn-ghost">
                    Cancel
                </button>
                <button type="submit" class="btn btn-success">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Restore Access
                </button>
            </div>
        </form>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>