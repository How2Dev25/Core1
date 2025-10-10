<dialog id="editFeeModal_{{$fee->dynamic_billingID}}" class="modal">
    <div class="modal-box w-96">
        <h3 class="font-bold text-lg mb-4">Edit Fee</h3>
        <form action="updatefee/{{$fee->dynamic_billingID}}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-control mb-3">
                <label class="label text-sm font-medium">Fee Name</label>
                <input name="dynamic_name" type="text" value="{{ $fee->dynamic_name }}"
                    class="input input-bordered w-full" required />
            </div>

            <div class="form-control mb-3">
                <label class="label text-sm font-medium">Rate / Amount</label>
                <input name="dynamic_price" type="number" step="0.01" value="{{ $fee->dynamic_price }}"
                    class="input input-bordered w-full" required />
            </div>

            <div class="form-control mb-4">
                <label class="label text-sm font-medium">Description</label>
                <textarea name="dynamic_billing_description" class="textarea textarea-bordered w-full"
                    required>{{ $fee->dynamic_billing_description }}</textarea>
            </div>

            <div class="modal-action">
                <button type="submit" class="btn btn-primary btn-sm">Save Changes</button>
                <button type="button" class="btn btn-ghost btn-sm"
                    onclick="document.getElementById('editFeeModal_{{$fee->dynamic_billingID}}').close()">Cancel</button>
            </div>
        </form>
    </div>
</dialog>