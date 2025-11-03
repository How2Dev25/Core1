<dialog id="edit_rules_{{$rule->loyaltyrulesID}}" class="modal">
    <div class="modal-box w-11/12 max-w-5xl">
        <h3 class="text-lg font-bold">Add Loyalty Rules</h3>

        <form method="POST" action="/modifylarrules/{{$rule->loyaltyrulesID}}" class="mt-6 space-y-4">
            @csrf

            @method('PUT')


            <!-- Description Field -->
            <div class="form-control w-full">
                <label class="label" for="loyalty_description">
                    <span class="label-text">Loyalty Points Required</span>
                </label>
                <input type="number" value="{{ $rule->points_required }}" id="loyalty_description"
                    name="points_required" placeholder="Enter Points Required" class="input input-bordered w-full"
                    required>
            </div>

            <!-- Value Field -->
            <div class="form-control w-full">
                <label class="label" for="loyalty_value">
                    <span class="label-text">Loyalty Points Discount</span>
                </label>
                <input type="number" id="loyalty_value" value="{{ $rule->discount_percent }}" name="discount_percent"
                    placeholder="Enter Discount Percent" class="input input-bordered w-full" required step="0.01"
                    min="0">
            </div>

            <!-- Form Actions -->
            <div class="modal-action">
                <button type="button" onclick="edit_rules_{{$rule->loyaltyrulesID}}.close()" class="btn btn-ghost">
                    Cancel
                </button>
                <button type="submit" class="btn btn-primary">
                    Save Changes
                </button>
            </div>
        </form>
    </div>

    <!-- Click outside to close -->
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>