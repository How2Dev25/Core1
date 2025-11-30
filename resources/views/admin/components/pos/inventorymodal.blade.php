<!-- Inventory Modal -->
<dialog id="selectinventory_{{ $inventory->core1_inventoryID }}" class="modal">
    <div class="modal-box bg-white shadow-2xl border border-gray-200 rounded-2xl max-w-md mx-auto">
        <div class="flex items-center gap-4 mb-6">
            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center shadow-md">
                <img src="{{ asset($inventory->core1_inventory_image) }}" alt="{{ $inventory->core1_inventory_name }}"
                    class="w-12 h-12 rounded-full object-cover">
            </div>
            <h3 class="font-bold text-xl text-blue-600">{{ $inventory->core1_inventory_name }}</h3>
        </div>

        <div class="mb-6">
            <img src="{{ asset($inventory->core1_inventory_image) }}" alt="{{ $inventory->core1_inventory_name }}"
                class="w-full h-48 object-cover rounded-lg shadow-md mb-4">
            <p class="text-sm text-gray-600">Code: {{ $inventory->core1_inventory_code }}</p>
            <p class="text-sm text-gray-600">Unit Cost: ₱<span
                    id="unit_price_{{ $inventory->core1_inventoryID }}">{{ number_format($inventory->core1_inventory_cost, 2) }}</span>
            </p>
            <p class="text-sm text-gray-600">Available Stocks: {{ $inventory->core1_inventory_stocks }}
                {{ $inventory->core1_inventory_unit }}
            </p>
        </div>

        <form method="POST" action="/submitInventory" class="space-y-4">
            @csrf
            <div>
                <label for="quantity_{{ $inventory->core1_inventoryID }}"
                    class="block text-sm font-medium text-gray-700 mb-2">Enter Quantity</label>
                <input type="number" id="quantity_{{ $inventory->core1_inventoryID }}" name="inventorypos_quantity"
                    class="input input-bordered w-full" min="1" max="{{ $inventory->core1_inventory_stocks }}" value="1"
                    required
                    oninput="calculateTotal({{ $inventory->core1_inventoryID }}, {{ $inventory->core1_inventory_cost }}, {{ $inventory->core1_inventory_stocks }})">
            </div>

            <div hidden>
                <label for="total_price_input_{{ $inventory->core1_inventoryID }}"
                    class="block text-sm font-medium text-gray-700 mb-2">Total Price</label>
                <input type="number" id="total_price_input_{{ $inventory->core1_inventoryID }}" name="inventorypos_total"
                    class="input input-bordered w-full" min="0" step="0.01"
                    value="{{ number_format($inventory->core1_inventory_cost, 2) }}" required
                    oninput="updateGrandTotal({{ $inventory->core1_inventoryID }})">

                    <input type="text" name="core1_inventoryID" value="{{ $inventory->core1_inventoryID }}">
            </div>

            <div>
                <label for="room_select_{{ $inventory->core1_inventoryID }}"
                    class="block text-sm font-medium text-gray-700 mb-2">Select POS Room Booking</label>
                <select id="room_select_{{ $inventory->core1_inventoryID }}" name="reservationposID"
                    class="select select-bordered w-full" onchange="showRoomImage({{ $inventory->core1_inventoryID }})">
                    <option value="">No Room Selected</option>
                    @forelse ($reservationroom as $reserveroom)
                        <option value="{{ $reserveroom->reservationposID }}"
                            data-image="{{ asset($reserveroom->roomphoto) }}" data-name="{{ $reserveroom->roomtype }}">
                            Room #{{ $reserveroom->roomID }} - {{ $reserveroom->roomtype }} </option>
                    @empty
                        <option disabled>No Rooms Selected</option>
                    @endforelse
                </select>
            </div>

            <div id="room_image_container_{{ $inventory->core1_inventoryID }}" class="hidden mb-4">
                <img id="room_image_{{ $inventory->core1_inventoryID }}" src="" alt="Selected Room"
                    class="w-full h-32 object-cover rounded-lg shadow-md">
            </div>

            <div class="flex justify-between items-center p-3 bg-blue-50 rounded-lg">
                <span class="text-sm font-medium text-gray-700">Grand Total:</span>
                <span class="text-lg font-bold text-green-600"
                    id="grand_total_{{ $inventory->core1_inventoryID }}">₱{{ number_format($inventory->core1_inventory_cost, 2) }}</span>
            </div>

            <div class="flex gap-4 mt-6">
                <button type="button" class="btn btn-outline btn-neutral flex-1 hover:bg-gray-100 transition-colors"
                    onclick="document.getElementById('selectinventory_{{ $inventory->core1_inventoryID }}').close()">Cancel</button>
                <button type="submit"
                    class="btn bg-blue-600 hover:bg-blue-700 text-white flex-1 shadow-md hover:shadow-lg transition-all">Add
                    to POS</button>
            </div>
        </form>
    </div>

    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>

<script>
    function calculateTotal(inventoryId, unitPrice, maxQuantity) {
        const quantityInput = document.getElementById(`quantity_${inventoryId}`);
        const totalPriceInput = document.getElementById(`total_price_input_${inventoryId}`);

        let quantity = parseInt(quantityInput.value) || 1;

        // Clamp quantity to [1, maxQuantity]
        if (quantity > maxQuantity) quantity = maxQuantity;
        if (quantity < 1) quantity = 1;
        quantityInput.value = quantity;

        const calculatedTotal = quantity * unitPrice;
        totalPriceInput.value = calculatedTotal.toFixed(2);
        updateGrandTotal(inventoryId);
    }

    function updateGrandTotal(inventoryId) {
        const totalPriceInput = document.getElementById(`total_price_input_${inventoryId}`);
        const grandTotalElement = document.getElementById(`grand_total_${inventoryId}`);

        const totalPrice = parseFloat(totalPriceInput.value) || 0;
        grandTotalElement.textContent = `₱${totalPrice.toFixed(2)}`;
    }

    function showRoomImage(inventoryId) {
        const roomSelect = document.getElementById(`room_select_${inventoryId}`);
        const roomImageContainer = document.getElementById(`room_image_container_${inventoryId}`);
        const roomImage = document.getElementById(`room_image_${inventoryId}`);

        const selectedOption = roomSelect.options[roomSelect.selectedIndex];
        if (selectedOption.value) {
            roomImage.src = selectedOption.getAttribute('data-image');
            roomImageContainer.classList.remove('hidden');
        } else {
            roomImageContainer.classList.add('hidden');
        }
    }
</script>