<dialog id="addFeeModal" class="modal">
    <div class="modal-box w-96">
        <h3 class="font-bold text-lg mb-4">Add New Fee</h3>

        <form action="/createfee" method="POST">
            @csrf

            <div class="form-control mb-3">
                <label class="label text-sm font-medium">Fee Name</label>
                <input type="text" name="dynamic_name" class="input input-bordered w-full" required />
            </div>

            <div class="form-control mb-3">
                <label class="label text-sm font-medium">Rate / Amount</label>
                <input type="number" name="dynamic_price" step="0.01" class="input input-bordered w-full" required />
            </div>

            <div class="form-control mb-4">
                <label class="label text-sm font-medium">Description</label>
                <textarea name="dynamic_billing_description" class="textarea textarea-bordered w-full"></textarea>
            </div>

            <div class="modal-action">
                <button type="submit" class="btn btn-primary btn-sm">Save</button>
                <button type="button" class="btn btn-ghost btn-sm"
                    onclick="document.getElementById('addFeeModal').close()">Cancel</button>
            </div>
        </form>
    </div>
</dialog>