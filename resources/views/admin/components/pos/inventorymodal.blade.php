<dialog id="selectinventory_{{ $inventory->core1_inventoryID }}" class="modal">
    <div
        class="modal-box bg-gradient-to-br from-white to-gray-50 shadow-2xl border border-gray-200 rounded-3xl max-w-lg mx-auto p-6">

        <!-- Header -->
        <div class="flex items-center gap-4 mb-6 pb-4 border-b border-gray-200">
            <div
                class="w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center shadow-lg ring-4 ring-blue-100">
                <img src="{{ asset($inventory->core1_inventory_image) }}" alt="{{ $inventory->core1_inventory_name }}"
                    class="w-16 h-16 rounded-xl object-cover">
            </div>
            <div>
                <h3 class="font-bold text-2xl text-gray-800">{{ $inventory->core1_inventory_name }}</h3>
                <p class="text-sm text-gray-500 mt-1">{{ $inventory->core1_inventory_code }}</p>
            </div>
        </div>

        <!-- TABS -->
        <div role="tablist" class="tabs tabs-boxed bg-gray-100 p-1 rounded-xl mb-6">
            <a role="tab" class="tab tab-active rounded-lg transition-all duration-200"
                id="tabWalkin_{{ $inventory->core1_inventoryID }}"
                onclick="switchTab('{{ $inventory->core1_inventoryID }}', 'walkin')">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
                Walk-in
            </a>

            <a role="tab" class="tab rounded-lg transition-all duration-200"
                id="tabBooked_{{ $inventory->core1_inventoryID }}"
                onclick="switchTab('{{ $inventory->core1_inventoryID }}', 'booked')">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                Reservations
            </a>
        </div>

        <!-- WALK-IN TAB -->
        <div id="walkinTab_{{ $inventory->core1_inventoryID }}" class="tabContent">

            <div class="mb-6 bg-white rounded-2xl shadow-sm p-4 border border-gray-100">
                <img src="{{ asset($inventory->core1_inventory_image) }}" alt="{{ $inventory->core1_inventory_name }}"
                    class="w-full h-56 object-cover rounded-xl shadow-md mb-4">

                <div class="grid grid-cols-2 gap-3">
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-3 rounded-xl">
                        <p class="text-xs text-gray-600 mb-1">Unit Cost</p>
                        <p class="text-lg font-bold text-blue-700">
                            ₱{{ number_format($inventory->core1_inventory_cost, 2) }}</p>
                    </div>
                    <div class="bg-gradient-to-br from-green-50 to-green-100 p-3 rounded-xl">
                        <p class="text-xs text-gray-600 mb-1">Available</p>
                        <p class="text-lg font-bold text-green-700">{{ $inventory->core1_inventory_stocks }}
                            {{ $inventory->core1_inventory_unit }}</p>
                    </div>
                </div>
            </div>

            <form method="POST" action="/submitInventory" class="space-y-5"
                onsubmit="return validateWalkinForm('{{ $inventory->core1_inventoryID }}')">
                @csrf

                <!-- Quantity -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                        </svg>
                        Quantity
                    </label>
                    <input type="number" id="quantity_{{ $inventory->core1_inventoryID }}_walkin" name="inventorypos_quantity"
                        class="input input-bordered w-full bg-white focus:ring-2 focus:ring-blue-500 transition-all rounded-xl"
                        min="1" value="1" data-unit-price="{{ $inventory->core1_inventory_cost }}"
                        data-max="{{ $inventory->core1_inventory_stocks }}"
                        oninput="calculateTotal('{{ $inventory->core1_inventoryID }}', 'walkin')" required>
                    <p class="text-xs text-gray-500 mt-1">Maximum: {{ $inventory->core1_inventory_stocks }} available
                    </p>
                </div>

                <!-- Hidden Total + Inventory ID -->
                <input type="hidden" id="total_price_input_{{ $inventory->core1_inventoryID }}"
                    name="inventorypos_total" value="{{ $inventory->core1_inventory_cost }}">
                <input type="hidden" name="core1_inventoryID" value="{{ $inventory->core1_inventoryID }}">

                <!-- Select POS Room -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        POS Room Booking
                    </label>
                    <select id="room_select_{{ $inventory->core1_inventoryID }}" name="reservationposID"
                        class="select select-bordered w-full bg-white focus:ring-2 focus:ring-blue-500 transition-all rounded-xl"
                        onchange="showRoomImage('{{ $inventory->core1_inventoryID }}', 'walkin')">
                        <option value="">No Room Selected</option>
                        @forelse ($reservationroom as $reserveroom)
                            <option value="{{ $reserveroom->reservationposID }}"
                                data-image="{{ asset($reserveroom->roomphoto) }}">
                                Room #{{ $reserveroom->roomID }} - {{ $reserveroom->roomtype }}
                            </option>
                        @empty
                            <option disabled>No Rooms Available</option>
                        @endforelse
                    </select>
                </div>

                <!-- Room Image Preview -->
                <div id="room_image_container_{{ $inventory->core1_inventoryID }}" class="hidden">
                    <img id="room_image_{{ $inventory->core1_inventoryID }}" src=""
                        class="w-full h-40 object-cover rounded-xl shadow-lg border-2 border-blue-200">
                </div>

                <!-- Grand Total -->
                <div class="bg-blue-900 p-4 rounded-2xl shadow-lg">
                    <div class="flex justify-between items-center text-white">
                        <span class="text-sm font-semibold tracking-wide">GRAND TOTAL</span>
                        <span class="text-2xl font-bold" id="grand_total_{{ $inventory->core1_inventoryID }}">
                            ₱{{ number_format($inventory->core1_inventory_cost, 2) }}
                        </span>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex gap-3 mt-6">
                    <button type="button" class="btn btn-outline flex-1 rounded-xl hover:bg-gray-100 transition-all"
                        onclick="document.getElementById('selectinventory_{{ $inventory->core1_inventoryID }}').close()">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Cancel
                    </button>
                    <button type="submit"
                        class="btn bg-blue-900 text-white flex-1 rounded-xl shadow-lg transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Add to POS
                    </button>
                </div>
            </form>

        </div>

        <!-- BOOKED TAB -->
        <div id="bookedTab_{{ $inventory->core1_inventoryID }}" class="tabContent hidden">
            <form action="/submitadditionalbooked" method="POST" class="space-y-5">
                @csrf

                <input type="hidden" name="core1_inventoryID" value="{{ $inventory->core1_inventoryID }}">

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        Select Booked Reservation
                    </label>
                    <select id="booked_room_select_{{ $inventory->core1_inventoryID }}" name="reservationID"
                        class="select select-bordered w-full bg-white focus:ring-2 focus:ring-blue-500 transition-all rounded-xl"
                        onchange="showRoomImage('{{ $inventory->core1_inventoryID }}', 'booked')" required>
                        <option value="">No Reservation Selected</option>
                        @forelse ($bookedreservations as $booked)
                            <option value="{{ $booked->reservationID }}" data-image="{{ asset($booked->roomphoto) }}">
                                {{ $booked->bookingID }}  - Room {{ $booked->roomID }} -
                                {{ $booked->roomtype }}
                            </option>
                        @empty
                            <option value="" disabled>No Booked Room</option>
                        @endforelse
                    </select>
                </div>

                <!-- Room Image -->
                <div id="booked_room_image_container_{{ $inventory->core1_inventoryID }}" class="hidden">
                    <img id="booked_room_image_{{ $inventory->core1_inventoryID }}" src=""
                        class="w-full h-40 object-cover rounded-xl shadow-lg border-2 border-blue-200">
                </div>

                <!-- Quantity -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                        </svg>
                        Quantity
                    </label>
                    <input type="number" name="additional_quantity" id="quantity_{{ $inventory->core1_inventoryID }}_booked"
                        class="input input-bordered w-full bg-white focus:ring-2 focus:ring-blue-500 transition-all rounded-xl"
                        min="1" value="1" data-unit-price="{{ $inventory->core1_inventory_cost }}"
                        data-max="{{ $inventory->core1_inventory_stocks }}"
                        oninput="calculateTotal('{{ $inventory->core1_inventoryID }}', 'booked')" required>
                    <p class="text-xs text-gray-500 mt-1">Maximum: {{ $inventory->core1_inventory_stocks }} available
                    </p>
                </div>

                <!-- Total (Hidden Input) -->
                <input type="hidden" name="additional_total"
                    id="booked_total_price_input_{{ $inventory->core1_inventoryID }}"
                    value="{{ $inventory->core1_inventory_cost }}">

                <!-- Grand Total Display -->
                <div class="bg-blue-900 p-4 rounded-2xl shadow-lg">
                    <div class="flex justify-between items-center text-white">
                        <span class="text-sm font-semibold tracking-wide">GRAND TOTAL</span>
                        <span class="text-2xl font-bold" id="booked_grand_total_{{ $inventory->core1_inventoryID }}">
                            ₱{{ number_format($inventory->core1_inventory_cost, 2) }}
                        </span>
                    </div>
                </div>

                <div class="p-4 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl border border-blue-200">
                    <div class="flex items-start gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 mt-0.5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-sm text-gray-700">This additional charge will be added to the guest's folio.</p>
                    </div>
                </div>

                <button type="submit"
                    class="btn bg-blue-900 text-white w-full rounded-xl shadow-lg transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Add to POS
                </button>
            </form>
        </div>

    </div>

    <!-- Modal backdrop -->
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>

<script>
    function calculateTotal(inventoryId, tab) {
        const quantityInput = document.getElementById(`quantity_${inventoryId}_${tab}`);
        const totalPriceInput = document.getElementById(`${tab === 'walkin' ? 'total_price_input' : 'booked_total_price_input'}_${inventoryId}`);
        const grandTotal = document.getElementById(`${tab === 'walkin' ? 'grand_total' : 'booked_grand_total'}_${inventoryId}`);

        if (!quantityInput || !totalPriceInput || !grandTotal) {
            console.error('Missing elements for calculation');
            return;
        }

        // Parse values
        let quantity = parseInt(quantityInput.value);
        const unitPrice = parseFloat(quantityInput.dataset.unitPrice);
        const maxQuantity = quantityInput.dataset.max ? parseInt(quantityInput.dataset.max) : null;

        // Validate quantity
        if (isNaN(quantity) || quantity < 1) {
            quantity = 1;
        }

        if (maxQuantity && quantity > maxQuantity) {
            quantity = maxQuantity;
            alert(`Maximum quantity available is ${maxQuantity}`);
        }

        // Update input value
        quantityInput.value = quantity;

        // Calculate total
        const total = quantity * unitPrice;

        // Update hidden input (no formatting, raw number)
        totalPriceInput.value = total.toFixed(2);

        // Update display (with formatting)
        grandTotal.textContent = `₱${total.toLocaleString('en-PH', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
    }

    function showRoomImage(inventoryId, tab) {
        const select = document.getElementById(`${tab === 'walkin' ? 'room_select' : 'booked_room_select'}_${inventoryId}`);
        const container = document.getElementById(`${tab === 'walkin' ? 'room_image_container' : 'booked_room_image_container'}_${inventoryId}`);
        const img = document.getElementById(`${tab === 'walkin' ? 'room_image' : 'booked_room_image'}_${inventoryId}`);

        if (!select || !container || !img) {
            console.error('Missing elements for room image display');
            return;
        }

        const selected = select.options[select.selectedIndex];

        if (selected && selected.value && selected.dataset.image) {
            img.src = selected.dataset.image;
            container.classList.remove('hidden');
        } else {
            container.classList.add('hidden');
            img.src = '';
        }
    }

    function switchTab(id, tab) {
        const walkinTab = document.getElementById(`walkinTab_${id}`);
        const bookedTab = document.getElementById(`bookedTab_${id}`);
        const tabWalkin = document.getElementById(`tabWalkin_${id}`);
        const tabBooked = document.getElementById(`tabBooked_${id}`);

        if (!walkinTab || !bookedTab || !tabWalkin || !tabBooked) {
            console.error('Missing tab elements');
            return;
        }

        if (tab === 'walkin') {
            walkinTab.classList.remove('hidden');
            bookedTab.classList.add('hidden');
            tabWalkin.classList.add('tab-active');
            tabBooked.classList.remove('tab-active');
        } else {
            bookedTab.classList.remove('hidden');
            walkinTab.classList.add('hidden');
            tabBooked.classList.add('tab-active');
            tabWalkin.classList.remove('tab-active');

            // Initialize booked tab calculations
            calculateTotal(id, 'booked');
            showRoomImage(id, 'booked');
        }
    }

    // Initialize calculations on page load
    document.addEventListener('DOMContentLoaded', function () {
        // Get all quantity inputs and trigger initial calculation
        const quantityInputs = document.querySelectorAll('[id^="quantity_"]');
        quantityInputs.forEach(input => {
            const matches = input.id.match(/quantity_(.+)_(walkin|booked)/);
            if (matches) {
                calculateTotal(matches[1], matches[2]);
            }
        });
    });
</script>