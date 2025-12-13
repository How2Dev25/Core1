<!-- View Manpower Requisition Modal -->
<dialog id="viewmanpower_{{ $request->requestempID }}" class="modal">
    <div class="modal-box w-11/12 max-w-3xl">

        <button type="button" class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2"
            onclick="document.getElementById('viewmanpower_{{ $request->requestempID }}').close()">✕</button>

        <h3 class="font-bold text-lg text-primary mb-4">View Manpower Requisition</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <div class="form-control">
                <label class="label"><span class="label-text">Request ID</span></label>
                <input type="text" class="input input-bordered" value="{{ $request->request_id }}" readonly />
            </div>

            <div class="form-control">
                <label class="label"><span class="label-text">Requested By</span></label>
                <input type="text" class="input input-bordered" value="{{ $request->requested_by }}" readonly />
            </div>

            <div class="form-control">
                <label class="label"><span class="label-text">Position Requested</span></label>
                <input type="text" class="input input-bordered" value="{{ $request->position }}" readonly />
            </div>

            <div class="form-control">
                <label class="label"><span class="label-text">Number of Personnel</span></label>
                <input type="number" class="input input-bordered" value="{{ $request->quantity }}" readonly />
            </div>

            <div class="form-control">
                <label class="label"><span class="label-text">Employment Type</span></label>
                <input type="text" class="input input-bordered" value="{{ $request->employment_type }}" readonly />
            </div>

            <div class="form-control">
                <label class="label"><span class="label-text">Preferred Shift</span></label>
                <input type="text" class="input input-bordered" value="{{ $request->shift }}" readonly />
            </div>

            <div class="form-control md:col-span-2">
                <label class="label"><span class="label-text">Reason for Request</span></label>
                <input type="text" class="input input-bordered" value="{{ $request->reason }}" readonly />
            </div>

        </div>

        <div class="modal-action mt-4">
            <button type="button" class="btn btn-outline"
                onclick="document.getElementById('viewmanpower_{{ $request->requestempID }}').close()">Close</button>
        </div>

    </div>
</dialog>