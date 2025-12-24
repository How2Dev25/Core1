<dialog id="suspend_modal_{{ $guests->guestID }}" class="modal">
    <div class="modal-box">
        <div class="flex items-center justify-center w-16 h-16 mx-auto bg-warning/10 rounded-full mb-4">
            <svg class="w-8 h-8 text-warning" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
        </div>

        <h3 class="font-bold text-xl text-center mb-2">Suspend Guest Account</h3>
        <p class="text-center text-gray-600 mb-6">Are you sure you want to suspend <span
                class="font-semibold text-gray-900">{{ $guests->guest_name }}</span>? They won't be able to access their
            account.</p>

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

        <form action="/suspendGuest/{{ $guests->guestID}}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-action">
                <button type="button" onclick="suspend_modal_{{ $guests->guestID }}.close()" class="btn btn-ghost">
                    Cancel
                </button>
                <button type="submit" class="btn btn-warning">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                    </svg>
                    Suspend Account
                </button>
            </div>
        </form>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>