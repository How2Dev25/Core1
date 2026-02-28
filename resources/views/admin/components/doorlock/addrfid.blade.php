<dialog id="roomModal" class="modal">
    <div class="modal-box max-w-4xl p-0 overflow-hidden">
        <!-- Modal header with colorful background -->
        <div class="bg-blue-900 px-6 py-5">
            <h3 class="font-bold text-2xl text-white flex items-center gap-2">
             
                Door Lock Integration
            </h3>
            <p class="text-blue-100 text-sm mt-1 flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Assign RFID tag to a room and manage access control
            </p>
        </div>

        <!-- Close button (top right X) -->
        <form method="dialog">
            <button
                class="btn btn-sm btn-circle btn-ghost absolute right-4 top-4 text-white hover:bg-white/20 border-none">✕</button>
        </form>

        <!-- Scrollable content area -->
        <div class="max-h-[70vh] overflow-y-auto p-6 bg-gray-50">
            <form method="POST" action="/storedoorLock" class="space-y-6">
                @csrf

                <!-- Two-column grid layout for inputs -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Left column - Room selection -->
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
                                Select Room
                            </span>
                            <span class="badge badge-primary badge-sm">Required</span>
                        </label>
                        <select id="roomSelect" name="roomID" class="select select-bordered select-primary w-full mt-1"
                            required>
                            <option disabled selected>Choose a room from list</option>
                            @forelse ($rooms as $room)
                                <option value="{{ $room->roomID }}" data-image="{{ $room->roomphoto }}">
                                    Room {{ $room->roomID }} - {{ $room->roomtype }}
                                </option>
                            @empty
                                <option disabled>No Room Available</option>
                            @endforelse
                        </select>
                        <div class="flex items-center gap-1 mt-2 text-xs text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Select the room where door lock will be installed
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
                        <input type="text" name="rfid" class="input input-bordered w-full font-mono bg-gray-50 mt-1"
                            placeholder="e.g., RF-1234-5678" required />
                        <div class="flex items-center gap-1 mt-2 text-xs text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            Unique identifier for the door lock
                        </div>
                    </div>
                </div>

                <!-- Room Preview Section - Enlarged and enhanced -->
                <div
                    class="bg-white p-5 rounded-xl shadow-md border-2 border-blue-100 hover:border-blue-300 transition-colors">
                    <div class="flex items-center justify-between mb-3">
                        <label class="label">
                            <span class="label-text font-semibold text-gray-700 flex items-center gap-2 text-base">
                                <span class="bg-green-100 p-1.5 rounded-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </span>
                                Room Preview
                            </span>
                        </label>
                        <div id="selectedRoomName"
                            class="text-sm font-medium text-blue-600 bg-blue-50 px-3 py-1 rounded-full hidden">
                            <!-- Will be filled by JavaScript -->
                        </div>
                    </div>

                    <!-- Enlarged preview container -->
                    <div
                        class="flex justify-center items-center min-h-[280px] bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl border-2 border-dashed border-gray-300 p-4">
                        <img id="roomPreview" src=""
                            class="rounded-lg hidden max-h-[260px] w-auto object-cover shadow-lg" alt="Room preview" />

                        <div id="noPreviewText" class="text-gray-400 flex flex-col items-center gap-3">
                            <div class="bg-gray-200 p-4 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-gray-500" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <span class="text-lg font-medium text-gray-500">No room selected</span>
                            <span class="text-sm text-gray-400">Choose a room from the dropdown above to see
                                preview</span>
                        </div>
                    </div>

                    <!-- Quick room info placeholder (will be shown when room selected) -->
                    <div id="roomInfoCard" class="mt-4 bg-blue-50 p-3 rounded-lg hidden">
                        <div class="flex items-center gap-3">
                            <div class="bg-blue-500 p-2 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-blue-600">Selected Room</p>
                                <p id="roomDetails" class="font-semibold text-gray-800"></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons with improved styling -->
                <div class="flex justify-end gap-3 pt-4">
                    <button type="button" class="btn btn-outline btn-error gap-2 px-6"
                        onclick="document.getElementById('roomModal').close()">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Cancel
                    </button>
                    <button
                        class="btn btn-primary"
                        type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Add Door Lock
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

<!-- Enhanced JavaScript -->
<script>
    (function () {
        const roomSelect = document.getElementById('roomSelect');
        const preview = document.getElementById('roomPreview');
        const noPreviewText = document.getElementById('noPreviewText');
        const selectedRoomName = document.getElementById('selectedRoomName');
        const roomInfoCard = document.getElementById('roomInfoCard');
        const roomDetails = document.getElementById('roomDetails');

        if (roomSelect && preview && noPreviewText) {
            roomSelect.addEventListener('change', function () {
                const selectedOption = this.options[this.selectedIndex];
                const imageURL = selectedOption?.dataset.image;
                const roomText = selectedOption?.textContent?.trim() || '';

                if (imageURL && imageURL.trim() !== '') {
                    // Show preview
                    preview.src = imageURL;
                    preview.classList.remove('hidden');
                    noPreviewText.classList.add('hidden');

                    // Show room info
                    selectedRoomName.textContent = roomText;
                    selectedRoomName.classList.remove('hidden');

                    // Extract room number and type for details
                    const matches = roomText.match(/Room (\d+)\s*-\s*(.+)/);
                    if (matches) {
                        roomDetails.innerHTML = `<span class="font-bold">Room ${matches[1]}</span> - ${matches[2]}`;
                    } else {
                        roomDetails.textContent = roomText;
                    }
                    roomInfoCard.classList.remove('hidden');
                } else {
                    // Hide preview and info
                    preview.classList.add('hidden');
                    noPreviewText.classList.remove('hidden');
                    selectedRoomName.classList.add('hidden');
                    roomInfoCard.classList.add('hidden');
                    preview.src = '';
                }
            });
        }

        // Add smooth entrance animation
        const modal = document.getElementById('roomModal');
        modal.addEventListener('click', function (e) {
            if (e.target === modal) {
                modal.close();
            }
        });
    })();
</script>

