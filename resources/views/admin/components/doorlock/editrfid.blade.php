<dialog id="editrfid_{{ $doorlock->doorlockID }}" class="modal">
    <div class="modal-box max-w-4xl p-0 overflow-hidden">
        <!-- Modal header with colorful background -->
        <div class="bg-blue-900 px-6 py-5">
            <h3 class="font-bold text-2xl text-white flex items-center gap-2">
               
                Edit Door Lock
            </h3>
            <p class="text-amber-100 text-sm mt-1 flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Update RFID tag information for this door lock
            </p>
        </div>

        <!-- Close button (top right X) -->
        <button class="btn btn-sm btn-circle btn-ghost absolute right-4 top-4 text-white hover:bg-white/20 border-none"
            type="button" onclick="document.getElementById('editrfid_{{ $doorlock->doorlockID }}').close()">✕</button>

        <!-- Scrollable content area -->
        <div class="max-h-[70vh] overflow-y-auto p-6 bg-gray-50">
            <form method="POST" action="/modifydoorLock/{{$doorlock->doorlockID}}" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Two-column grid layout -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Left column - Room ID (read-only) -->
                    <div
                        class="bg-white p-5 rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition-shadow">
                        <label class="label">
                            <span class="label-text font-semibold text-gray-700 flex items-center gap-2 text-base">
                                <span class="bg-blue-100 p-1.5 rounded-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                </span>
                                Room ID
                            </span>
                            <span class="badge badge-ghost badge-sm">Read Only</span>
                        </label>
                        <div class="mt-1 flex items-center gap-2">
                            <div class="bg-gray-100 p-3 rounded-lg border border-gray-300 flex-1">
                                <span class="font-mono text-lg font-bold text-gray-800">{{ $doorlock->roomID }}</span>
                            </div>
                            <div class="tooltip" data-tip="Room cannot be changed">
                                <div class="bg-gray-200 p-3 rounded-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="roomID" value="{{ $doorlock->roomID }}">
                        <div class="flex items-center gap-1 mt-2 text-xs text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Room information cannot be modified
                        </div>
                    </div>

                    <!-- Right column - RFID input -->
                    <div
                        class="bg-white p-5 rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition-shadow">
                        <label class="label">
                            <span class="label-text font-semibold text-gray-700 flex items-center gap-2 text-base">
                                <span class="bg-purple-100 p-1.5 rounded-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                                    </svg>
                                </span>
                                RFID Tag
                            </span>
                            <span class="badge badge-primary badge-sm">Required</span>
                        </label>
                        <input type="text" name="rfid" value="{{ $doorlock->rfid }}"
                            class="input input-bordered w-full font-mono bg-gray-50 mt-1 text-lg"
                            placeholder="Enter RFID tag" required />
                        <div class="flex items-center gap-1 mt-2 text-xs text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            Update the RFID tag for this door lock
                        </div>
                    </div>
                </div>

                <!-- Current Status Section -->
                <div
                    class="bg-white p-5 rounded-xl shadow-md border-2 border-amber-100 hover:border-amber-300 transition-colors">
                    <div class="flex items-center justify-between mb-3">
                        <label class="label">
                            <span class="label-text font-semibold text-gray-700 flex items-center gap-2 text-base">
                                <span class="bg-amber-100 p-1.5 rounded-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </span>
                                Current Status
                            </span>
                        </label>
                        <div
                            class="badge {{ $doorlock->doorlock_status == 'Active' ? 'badge-success' : 'badge-error' }} badge-lg gap-2">
                            <span class="w-2 h-2 rounded-full bg-white animate-pulse"></span>
                            {{ ucfirst($doorlock->doorlock_status) }}
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                        @if(!empty($doorlock->guestname))
                            <div class="flex items-center gap-2 bg-gray-50 p-3 rounded-lg">
                                <div class="bg-emerald-100 p-2 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-emerald-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Assigned To</p>
                                    <p class="font-semibold text-gray-800">{{ $doorlock->guestname }}</p>
                                </div>
                            </div>
                        @endif

                        @if(!empty($doorlock->bookingID))
                            <div class="flex items-center gap-2 bg-gray-50 p-3 rounded-lg">
                                <div class="bg-blue-100 p-2 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Booking ID</p>
                                    <p class="font-mono font-semibold text-gray-800">{{ $doorlock->bookingID }}</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    @if(empty($doorlock->guestname) && empty($doorlock->bookingID))
                        <div class="text-center py-4 text-gray-500 italic">
                            No guest assigned to this door lock
                        </div>
                    @endif
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end gap-3 pt-4 border-t border-gray-200">
                    <button type="button" class="btn btn-outline btn-error gap-2 px-6"
                        onclick="document.getElementById('editrfid_{{ $doorlock->doorlockID }}').close()">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Cancel
                    </button>
                    <button type="submit"
                        class="btn btn-primary ">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        Update Door Lock
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Click outside to close -->
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>

<!-- Add tooltip styling if not already present -->
<style>
    /* Tooltip styling */
    [data-tip] {
        position: relative;
        cursor: help;
    }

    [data-tip]:before {
        content: attr(data-tip);
        position: absolute;
        bottom: 100%;
        left: 50%;
        transform: translateX(-50%);
        padding: 4px 8px;
        background: #1f2937;
        color: white;
        font-size: 12px;
        border-radius: 4px;
        white-space: nowrap;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.2s;
        margin-bottom: 8px;
        z-index: 50;
    }

    [data-tip]:hover:before {
        opacity: 1;
    }

    /* Custom scrollbar styling */
    

    /* Pulse animation */
    @keyframes pulse {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0.5;
        }
    }

    .animate-pulse {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
</style>