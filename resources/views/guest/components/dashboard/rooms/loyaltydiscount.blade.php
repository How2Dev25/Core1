<div class="mb-5">
    <div
        class="flex items-center justify-between p-3 rounded-xl bg-gradient-to-r from-blue-900/10 to-blue-800/10 border border-blue-900/30 hover:border-orange-400/50 transition-all duration-300 ">
        <span class="flex items-center gap-2 text-sm font-medium text-blue-900">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="text-orange-400">
                <path d="M12 2l2 7h7l-5.5 4 2 7-5.5-4L7 20l2-7L3.5 9H10z"></path>
            </svg>
            Loyalty Discount
        </span>
        <span id="loyaltyDiscount" class="font-bold text-orange-500">₱0.00</span>
    </div>

    <!-- Add Button -->
    <div class="flex justify-end mt-2">
        <button type="button" class="btn btn-sm btn-outline btn-success"
            onclick="document.getElementById('loyaltyModal').showModal()">
            Use Loyalty Points
        </button>
    </div>
</div>

<input type="hidden" name="loyalty_discount" id="hiddenLoyaltyDiscount" value="0">
<input type="hidden" name="loyalty_points_used" id="hiddenPointsUsed" value="0">

<dialog id="loyaltyModal" class="modal">
    <div class="modal-box bg-white rounded-2xl p-6 border-2 border-blue-900/10">
        <h3 class="font-bold text-xl text-blue-900 mb-2 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="text-orange-400">
                <path d="M12 2l2 7h7l-5.5 4 2 7-5.5-4L7 20l2-7L3.5 9H10z"></path>
            </svg>
            Use Your Loyalty Points
        </h3>

        <div class="bg-gradient-to-r from-blue-900/5 to-orange-400/5 rounded-xl p-4 mb-4 border border-blue-900/10">
            <p class="text-sm text-gray-600">
                Available Points:
            </p>
            <p class="text-2xl font-bold text-blue-900" id="availablePoints">
                {{ $myloyaltypoints ?? 0 }}
            </p>
        </div>

        <form id="loyaltyForm" class="space-y-3 mb-4">
            @foreach($loyaltyrules as $rule)
                @php
                    $userPoints = $myloyaltypoints ?? 0;
                    $isDisabled = $userPoints < $rule->points_required;
                @endphp
                <label
                    class="flex items-center justify-between p-4 rounded-xl border-2 transition-all duration-300
                                                                                    {{ $isDisabled ? 'border-gray-200 bg-gray-50 opacity-60 cursor-not-allowed' : 'border-blue-900/20 bg-gradient-to-r from-blue-900/5 to-transparent hover:border-orange-400 hover:shadow-md cursor-pointer' }}">
                    <div class="flex flex-col gap-1 ">
                        <span class="font-bold text-blue-900 flex items-center gap-2">
                            {{ $rule->points_required }} Points
                            @if($isDisabled)
                                <span class="text-xs font-normal text-red-500 bg-red-50 px-2 py-1 rounded-full">
                                    Insufficient Points
                                </span>
                            @endif
                        </span>
                        <span class="text-sm font-medium text-orange-500">
                            {{ number_format($rule->discount_percent, 2) }}% discount
                        </span>
                    </div>
                    <input type="radio" name="selectedRule" value="{{ $rule->points_required }}"
                        data-discount="{{ $rule->discount_percent }}"
                        class="radio radio-warning border-orange-400 checked:bg-orange-400" {{ $isDisabled ? 'disabled' : '' }} />
                </label>
            @endforeach
        </form>

        <div class="modal-action gap-2">
            <button type="button" class="btn btn-ghost text-blue-900 hover:bg-blue-900/10"
                onclick="document.getElementById('loyaltyModal').close()">Cancel</button>
            <button type="button"
                class="btn bg-gradient-to-r from-blue-900 to-blue-800 text-white hover:from-blue-800 hover:to-blue-700 border-none"
                id="applyLoyaltyBtn">
                Apply Discount
            </button>
        </div>
    </div>
</dialog>

<script>
    let loyaltyDiscountValue = 0;
    let pointsUsed = 0;

    document.getElementById('applyLoyaltyBtn').addEventListener('click', () => {
        const selected = document.querySelector('input[name="selectedRule"]:checked');
        const availablePoints = parseInt(document.getElementById('availablePoints').innerText) || 0;

        if (!selected) {
            alert('Please select a loyalty rule.');
            return;
        }

        const requiredPoints = parseInt(selected.value);
        const discountPercent = parseFloat(selected.dataset.discount);

        if (availablePoints < requiredPoints) {
            alert('Not enough points to use this reward.');

            // Reset the selection
            selected.checked = false;
            return;
        }

        // Get subtotal
        const subtotal = parseFloat(document.getElementById('hiddenSubtotal').value) || 0;
        loyaltyDiscountValue = subtotal * (discountPercent / 100);
        pointsUsed = requiredPoints;

        // Update discount display
        document.getElementById('loyaltyDiscount').innerText = `-₱${loyaltyDiscountValue.toFixed(2)}`;

        // Update total after discount
        const vat = parseFloat(document.getElementById('hiddenVat').value);
        const serviceFee = parseFloat(document.getElementById('hiddenServiceFee').value);
        const total = subtotal + vat + serviceFee - loyaltyDiscountValue;

        document.getElementById('totalAmount').innerText = `₱${total.toFixed(2)}`;
        document.getElementById('hiddenTotal').value = total.toFixed(2);

        // Close modal
        document.getElementById('loyaltyModal').close();

        document.getElementById('hiddenLoyaltyDiscount').value = loyaltyDiscountValue.toFixed(2);
        document.getElementById('hiddenPointsUsed').value = pointsUsed;
    });
</script>