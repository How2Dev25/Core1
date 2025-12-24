<dialog id="view_profile_modal_{{ $guests->guestID }}" class="modal">
    <div class="modal-box max-w-2xl">
        <!-- Header with gradient -->
        <div class="relative bg-blue-900 -mx-6 -mt-6 px-6 py-8 mb-6  overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-yellow-400 rounded-full opacity-20 blur-2xl"></div>
            <div class="relative z-10 flex items-center gap-4">
                <img class="rounded-full w-20 h-20 ring-4 ring-white shadow-xl" src="{{ asset($guests->guest_photo) }}"
                    alt="{{ $guests->guest_name }}">
                <div>
                    <h3 class="font-bold text-2xl text-white">{{ $guests->guest_name }}</h3>
                    <p class="text-blue-100 text-sm">Guest Profile</p>
                </div>
            </div>
        </div>

        <!-- Profile Details -->
        <div class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Email -->
                <div>
                    <label class="text-sm font-semibold text-gray-600 flex items-center gap-2 mb-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        Email Address
                    </label>
                    <p class="text-gray-900 font-medium">{{ $guests->guest_email }}</p>
                </div>

                <!-- Status -->
                <div>
                    <label class="text-sm font-semibold text-gray-600 flex items-center gap-2 mb-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Account Status
                    </label>
                    <span
                        class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-white text-sm {{ $guests->guest_status === 'Suspended' ? 'bg-red-500' : 'bg-green-500' }}">
                        <span class="w-2 h-2 bg-white rounded-full"></span>
                        {{ $guests->guest_status ?? 'Active' }}
                    </span>
                </div>

                <!-- Guest ID -->
                <div>
                    <label class="text-sm font-semibold text-gray-600 flex items-center gap-2 mb-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                        Guest ID
                    </label>
                    <p class="text-gray-900 font-medium">#{{ $guests->guestID }}</p>
                </div>

                <!-- Role -->
                <div>
                    <label class="text-sm font-semibold text-gray-600 flex items-center gap-2 mb-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Role
                    </label>
                    <p class="text-gray-900 font-medium">Guest</p>
                </div>
            </div>
        </div>

        <!-- Modal Actions -->
        <div class="modal-action">
            <form method="dialog">
                <button class="btn btn-ghost">Close</button>
            </form>
        </div>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>