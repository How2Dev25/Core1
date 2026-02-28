<!-- Edit Modal for Master RFID (Enhanced Design) -->
<dialog id="editMasterRFID_{{ $rfidmaster->masterRFID_ID }}" class="modal">
    <div class="modal-box max-w-4xl p-0 overflow-hidden">
        <!-- Modal header with colorful background -->
        <div class="bg-blue-900 px-6 py-5">
            <h3 class="font-bold text-2xl text-white flex items-center gap-2">
                Edit Master RFID
            </h3>
            <p class="text-purple-100 text-sm mt-1 flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Update master RFID card information
            </p>
        </div>

        <!-- Close button (top right X) -->
        <button class="btn btn-sm btn-circle btn-ghost absolute right-4 top-4 text-white hover:bg-white/20 border-none"
            type="button"
            onclick="document.getElementById('editMasterRFID_{{ $rfidmaster->masterRFID_ID }}').close()">✕</button>

        <!-- Scrollable content area -->
        <div class="max-h-[70vh] overflow-y-auto p-6 bg-gray-50">
            <form method="POST" action="/masterRFID/updatemasterRFID/{{ $rfidmaster->masterRFID_ID }}"
                class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Two-column grid layout for inputs -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Left column - RFID Name -->
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
                        <input type="text" name="masterRFID_name" value="{{ $rfidmaster->masterRFID_name }}"
                            class="input input-bordered w-full bg-gray-50 mt-1" placeholder="e.g., Housekeeping RFID"
                            required />
                        <div class="flex items-center gap-1 mt-2 text-xs text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Descriptive name for this RFID
                        </div>
                    </div>

                    <!-- Right column - RFID Tag -->
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
                        <input type="text" name="masterRFID_rfid" value="{{ $rfidmaster->masterRFID_rfid }}"
                            class="input input-bordered w-full font-mono bg-gray-50 mt-1"
                            placeholder="e.g., RF-9876-5432" required />
                        <div class="flex items-center gap-1 mt-2 text-xs text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            Unique identifier for the master RFID card
                        </div>
                    </div>
                </div>

                <!-- Door Lock Selection Section -->
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
                        <h4 class="font-semibold text-gray-700">Assigned Door Lock</h4>
                        <span class="badge badge-primary badge-sm">Required</span>
                    </div>

                    <select name="doorlockID" id="editDoorlockSelect_{{ $rfidmaster->masterRFID_ID }}"
                        class="select select-bordered w-full" required>
                        <option value="" disabled>Choose a door lock</option>
                        @foreach ($availableDoorlocks as $doorlock)
                            <option value="{{ $doorlock->doorlockID }}" {{ $rfidmaster->doorlockID == $doorlock->doorlockID ? 'selected' : '' }}>
                                Room {{ $doorlock->roomID }} (Doorlock ID: {{ $doorlock->doorlockID }})
                            </option>
                        @endforeach
                        <!-- Include current doorlock even if not in available list -->
                        @if($rfidmaster->doorlockID && !$availableDoorlocks->contains('doorlockID', $rfidmaster->doorlockID))
                            @php
                                $currentDoorlock = \App\Models\doorlock::find($rfidmaster->doorlockID);
                            @endphp
                            @if($currentDoorlock)
                                <option value="{{ $currentDoorlock->doorlockID }}" selected>
                                    Room {{ $currentDoorlock->roomID }} (Doorlock ID: {{ $currentDoorlock->doorlockID }}) -
                                    Current
                                </option>
                            @endif
                        @endif
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

                <!-- Status Selection Section -->
                <div
                    class="bg-white p-5 rounded-xl shadow-md border-2 border-purple-100 hover:border-purple-300 transition-colors">
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
                                Card Status
                            </span>
                        </label>
                        <span class="badge badge-ghost badge-sm">Set card status</span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-control">
                            <label
                                class="label cursor-flex justify-start gap-3 p-3 border rounded-lg hover:bg-gray-50 transition-colors">
                                <input type="radio" name="masterRFID_status" class="radio radio-success" value="Active"
                                    {{ $rfidmaster->masterRFID_status == 'Active' ? 'checked' : '' }} />
                                <div class="flex items-center gap-2">
                                    <div class="bg-success/20 p-1 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-success" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                    <div>
                                        <span class="font-medium">Active</span>
                                        <p class="text-xs text-gray-500">Card can be used immediately</p>
                                    </div>
                                </div>
                            </label>
                        </div>

                        <div class="form-control">
                            <label
                                class="label cursor-flex justify-start gap-3 p-3 border rounded-lg hover:bg-gray-50 transition-colors">
                                <input type="radio" name="masterRFID_status" class="radio radio-warning"
                                    value="Inactive" {{ $rfidmaster->masterRFID_status == 'Inactive' ? 'checked' : '' }} />
                                <div class="flex items-center gap-2">
                                    <div class="bg-warning/20 p-1 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-warning" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <span class="font-medium">Inactive</span>
                                        <p class="text-xs text-gray-500">Card will be disabled</p>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="flex items-center gap-1 mt-3 text-xs text-gray-500 bg-gray-50 p-2 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Active cards can be used for system access. Inactive cards are temporarily
                            disabled.</span>
                    </div>
                </div>

                <!-- Current Info & Preview Section -->
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
                        <div class="badge badge-outline text-purple-600 border-purple-300">Master RFID
                            #{{ $rfidmaster->masterRFID_ID }}</div>
                    </div>

                    <!-- Card Preview Container -->
                    <div
                        class="flex justify-center items-center min-h-[180px] bg-gradient-to-br from-purple-50 to-indigo-50 rounded-xl border-2 border-dashed border-purple-200 p-4">
                        <div id="editCardPreview"
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
                                <div id="editPreviewStatusBadge"
                                    class="badge {{ $rfidmaster->masterRFID_status == 'Active' ? 'badge-success' : 'badge-warning' }} badge-sm">
                                    {{ $rfidmaster->masterRFID_status }}
                                </div>
                            </div>
                            <div class="space-y-2">
                                <div>
                                    <p class="text-xs text-gray-500">RFID Name</p>
                                    <p id="editPreviewName" class="font-mono text-sm font-semibold text-gray-800">
                                        {{ $rfidmaster->masterRFID_name }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">RFID Tag</p>
                                    <p id="editPreviewRFID"
                                        class="font-mono text-sm font-semibold text-gray-800 break-all">
                                        {{ $rfidmaster->masterRFID_rfid }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Door Lock ID</p>
                                    <p id="editPreviewDoorlock" class="font-mono text-sm font-semibold text-gray-800">
                                        {{ $rfidmaster->doorlockID ?? 'Not assigned' }}
                                        @if($rfidmaster->doorlockID)
                                            (Room
                                            {{ \App\Models\doorlock::find($rfidmaster->doorlockID)?->roomID ?? 'Unknown' }})
                                        @endif
                                    </p>
                                </div>
                                <div class="pt-1 text-xs text-purple-600 italic">
                                    <span>Last updated:
                                        {{ $rfidmaster->updated_at ? $rfidmaster->updated_at->format('M d, Y') : 'N/A' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Live Preview Script -->
                    <script>
                        (function () {
                            const editModal = document.getElementById('editMasterRFID_{{ $rfidmaster->masterRFID_ID }}');

                            if (editModal) {
                                editModal.addEventListener('click', function (e) {
                                    if (e.target === editModal) {
                                        editModal.close();
                                    }
                                });
                            }

                            // Preview update function
                            function updateEditPreview() {
                                const nameInput = document.querySelector('#editMasterRFID_{{ $rfidmaster->masterRFID_ID }} input[name="masterRFID_name"]');
                                const rfidInput = document.querySelector('#editMasterRFID_{{ $rfidmaster->masterRFID_ID }} input[name="masterRFID_rfid"]');
                                const doorlockSelect = document.querySelector('#editDoorlockSelect_{{ $rfidmaster->masterRFID_ID }}');
                                const statusRadios = document.querySelectorAll('#editMasterRFID_{{ $rfidmaster->masterRFID_ID }} input[name="masterRFID_status"]');
                                const previewName = document.getElementById('editPreviewName');
                                const previewRFID = document.getElementById('editPreviewRFID');
                                const previewDoorlock = document.getElementById('editPreviewDoorlock');
                                const previewStatusBadge = document.getElementById('editPreviewStatusBadge');

                                if (nameInput && rfidInput && previewName && previewRFID && previewStatusBadge) {
                                    // Update name
                                    previewName.textContent = nameInput.value.trim() || '---';

                                    // Update RFID
                                    previewRFID.textContent = rfidInput.value.trim() || '---';

                                    // Update doorlock
                                    if (doorlockSelect && previewDoorlock) {
                                        const selectedOption = doorlockSelect.options[doorlockSelect.selectedIndex];
                                        if (selectedOption && selectedOption.value) {
                                            const roomMatch = selectedOption.text.match(/Room (\d+)/);
                                            const roomId = roomMatch ? roomMatch[1] : 'Unknown';
                                            previewDoorlock.textContent = `${selectedOption.value} (Room ${roomId})`;
                                        } else {
                                            previewDoorlock.textContent = 'Not assigned';
                                        }
                                    }

                                    // Update status
                                    statusRadios.forEach(radio => {
                                        if (radio.checked) {
                                            previewStatusBadge.textContent = radio.value;
                                            previewStatusBadge.className = `badge ${radio.value === 'Active' ? 'badge-success' : 'badge-warning'} badge-sm`;
                                        }
                                    });
                                }
                            }

                            // Add event listeners after modal is opened
                            const observer = new MutationObserver(function (mutations) {
                                mutations.forEach(function (mutation) {
                                    if (mutation.type === 'attributes' && mutation.attributeName === 'open') {
                                        if (document.getElementById('editMasterRFID_{{ $rfidmaster->masterRFID_ID }}').open) {
                                            const nameInput = document.querySelector('#editMasterRFID_{{ $rfidmaster->masterRFID_ID }} input[name="masterRFID_name"]');
                                            const rfidInput = document.querySelector('#editMasterRFID_{{ $rfidmaster->masterRFID_ID }} input[name="masterRFID_rfid"]');
                                            const doorlockSelect = document.querySelector('#editDoorlockSelect_{{ $rfidmaster->masterRFID_ID }}');
                                            const statusRadios = document.querySelectorAll('#editMasterRFID_{{ $rfidmaster->masterRFID_ID }} input[name="masterRFID_status"]');

                                            if (nameInput && rfidInput) {
                                                nameInput.addEventListener('input', updateEditPreview);
                                                rfidInput.addEventListener('input', updateEditPreview);
                                                if (doorlockSelect) {
                                                    doorlockSelect.addEventListener('change', updateEditPreview);
                                                }
                                                statusRadios.forEach(radio => {
                                                    radio.addEventListener('change', updateEditPreview);
                                                });
                                            }
                                        }
                                    }
                                });
                            });

                            observer.observe(document.getElementById('editMasterRFID_{{ $rfidmaster->masterRFID_ID }}'), { attributes: true });
                        })();
                    </script>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end gap-3 pt-4">
                    <button type="button" class="btn btn-outline btn-error gap-2 px-6"
                        onclick="document.getElementById('editMasterRFID_{{ $rfidmaster->masterRFID_ID }}').close()">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        Update Master RFID
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

<!-- Add these styles to your existing styles -->
<style>
    /* For cursor-flex class if not in DaisyUI */
    .label.cursor-flex {
        cursor: pointer;
        display: flex;
        align-items: center;
    }

    /* Modal animations */
    .modal-box {
        animation: modalPop 0.3s ease-out;
    }

    @keyframes modalPop {
        from {
            opacity: 0;
            transform: scale(0.95);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }
</style>