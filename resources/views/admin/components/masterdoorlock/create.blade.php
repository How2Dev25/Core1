<dialog id="masterRFIDModal" class="modal">
    <div class="modal-box max-w-4xl p-0 overflow-hidden">
        <!-- Modal header with colorful background -->
        <div class="bg-blue-900 px-6 py-5">
            <h3 class="font-bold text-2xl text-white flex items-center gap-2">
                Master RFID
            </h3>
            <p class="text-purple-100 text-sm mt-1 flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Register a new master RFID card for system access
            </p>
        </div>

        <!-- Close button (top right X) -->
        <form method="dialog">
            <button
                class="btn btn-sm btn-circle btn-ghost absolute right-4 top-4 text-white hover:bg-white/20 border-none">✕</button>
        </form>

        <!-- Scrollable content area -->
        <div class="max-h-[70vh] overflow-y-auto p-6 bg-gray-50">
            <form method="POST" action="/masterRFID/createmasterRFID" class="space-y-6">
                @csrf

                <!-- Two-column grid layout for inputs -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Left column - RFID Tag -->
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
                        <input type="text" name="masterRFID_rfid"
                            class="input input-bordered w-full font-mono bg-gray-50 mt-1"
                            placeholder="e.g., RF-9876-5432" required />
                        <div class="flex items-center gap-1 mt-2 text-xs text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Unique identifier for the master RFID card
                        </div>
                    </div>

                    <!-- Right column - RFID Name -->
                    <div
                        class="bg-white p-5 rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition-shadow">
                        <label class="label">
                            <span class="label-text font-semibold text-gray-700 flex items-center gap-2 text-base">
                                <span class="bg-indigo-100 p-1.5 rounded-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l5 5a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-5-5A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                    </svg>
                                </span>
                                RFID Name
                            </span>
                            <span class="badge badge-primary badge-sm">Required</span>
                        </label>
                        <input type="text" name="masterRFID_name" class="input input-bordered w-full bg-gray-50 mt-1"
                            placeholder="e.g., Housekeeping RFID" required />
                        <div class="flex items-center gap-1 mt-2 text-xs text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l5 5a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-5-5A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                            Descriptive name for this RFID (e.g., Housekeeping, Maintenance, Manager)
                        </div>
                    </div>
                </div>

                <!-- Room Selection Section - Simplified -->
                <div
                    class="bg-white p-5 rounded-xl shadow-md border-2 border-blue-100 hover:border-blue-300 transition-colors">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="bg-blue-100 p-1.5 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                        </span>
                        <h4 class="font-semibold text-gray-700">Select Door Lock</h4>
                        <span class="badge badge-primary badge-sm">Required</span>
                    </div>

                    <select name="doorlockID" id="doorlockSelect" class="select select-bordered w-full" required>
                        <option disabled selected>Choose a door lock</option>
                        @foreach ($availableDoorlocks as $doorlock)
                            <option value="{{ $doorlock->doorlockID }}">
                                Room {{ $doorlock->roomID }} (Doorlock ID: {{ $doorlock->doorlockID }})
                            </option>
                        @endforeach
                    </select>

                    <div class="flex items-center gap-1 mt-2 text-xs text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Select the door lock this master RFID will control
                    </div>
                </div>

                <!-- Preview Card Section - Removed assigned door -->
                <div
                    class="bg-white p-5 rounded-xl shadow-md border-2 border-purple-100 hover:border-purple-300 transition-colors">
                    <div class="flex items-center justify-between mb-3">
                        <label class="label">
                            <span class="label-text font-semibold text-gray-700 flex items-center gap-2 text-base">
                                <span class="bg-purple-100 p-1.5 rounded-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                    </svg>
                                </span>
                                Card Preview
                            </span>
                        </label>
                        <div class="badge badge-outline badge-purple">Master RFID</div>
                    </div>

                    <!-- Card Preview Container -->
                    <div
                        class="flex justify-center items-center min-h-[180px] bg-gradient-to-br from-purple-50 to-indigo-50 rounded-xl border-2 border-dashed border-purple-200 p-4">
                        <div id="cardPreview"
                            class="bg-white rounded-xl shadow-lg p-5 w-full max-w-sm border-l-4 border-purple-500">
                            <div class="flex justify-between items-start mb-3">
                                <div class="flex items-center gap-2">
                                    <div class="bg-purple-100 p-2 rounded-lg">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                                        </svg>
                                    </div>
                                    <span class="font-bold text-gray-700">MASTER RFID</span>
                                </div>
                                <div id="previewStatusBadge" class="badge badge-success badge-sm">Active</div>
                            </div>
                            <div class="space-y-2">
                                <div>
                                    <p class="text-xs text-gray-500">RFID Name</p>
                                    <p id="previewName" class="font-mono text-sm font-semibold text-gray-800">---</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">RFID Tag</p>
                                    <p id="previewRFID" class="font-mono text-sm font-semibold text-gray-800 break-all">
                                        ---</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end gap-3 pt-4">
                    <button type="button" class="btn btn-outline btn-error gap-2 px-6"
                        onclick="document.getElementById('masterRFIDModal').close()">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Cancel
                    </button>
                    <button class="btn btn-primary" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Register Master RFID
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

<!-- Simplified JavaScript -->
<script>
    (function () {
        // RFID and Name inputs for preview
        const rfidInput = document.querySelector('input[name="masterRFID_rfid"]');
        const nameInput = document.querySelector('input[name="masterRFID_name"]');
        const previewName = document.getElementById('previewName');
        const previewRFID = document.getElementById('previewRFID');

        // Update card preview
        function updatePreview() {
            if (previewName) {
                previewName.textContent = nameInput?.value.trim() || '---';
            }
            if (previewRFID) {
                previewRFID.textContent = rfidInput?.value.trim() || '---';
            }
        }

        // Add event listeners
        if (rfidInput) {
            rfidInput.addEventListener('input', updatePreview);
        }

        if (nameInput) {
            nameInput.addEventListener('input', updatePreview);
        }

        // Initial update
        updatePreview();
    })();
</script>

<style>
    /* For cursor-flex class if not in DaisyUI */
    .label.cursor-flex {
        cursor: pointer;
        display: flex;
        align-items: center;
    }
</style>