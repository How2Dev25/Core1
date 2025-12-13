<dialog id="viewreport_{{ $report->reportID }}" class="modal">
    <div class="modal-box w-11/12 max-w-3xl">

        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2"
            onclick="document.getElementById('viewreport_{{ $report->reportID }}').close()">✕</button>

        <h3 class="font-bold text-lg text-primary mb-4">
            Employee Report Details
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <div class="form-control">
                <label class="label">Report ID</label>
                <input class="input input-bordered" value="{{ $report->report_code }}" readonly>
            </div>

            <div class="form-control">
                <label class="label">Employee ID</label>
                <input class="input input-bordered" value="{{ $report->employee_id }}" readonly>
            </div>

            <div class="form-control">
                <label class="label">Employee Name</label>
                <input class="input input-bordered" value="{{ $report->employee_name }}" readonly>
            </div>

            <div class="form-control">
                <label class="label">Department</label>
                <input class="input input-bordered" value="{{ $report->department }}" readonly>
            </div>

            <div class="form-control">
                <label class="label">Position</label>
                <input class="input input-bordered" value="{{ $report->position }}" readonly>
            </div>

            <div class="form-control">
                <label class="label">Last Date Reported</label>
                <input class="input input-bordered" value="{{ $report->last_date }}" readonly>
            </div>

            <div class="form-control">
                <label class="label">Number of Days Absent</label>
                <input class="input input-bordered" value="{{ $report->days_absent }}" readonly>
            </div>

            <div class="form-control">
                <label class="label">Actions Taken</label>
                <input class="input input-bordered" value="{{ $report->actions_taken }}" readonly>
            </div>

            <div class="form-control md:col-span-2">
                <label class="label">Status</label>
                <input class="input input-bordered" value="{{ $report->status }}" readonly>
            </div>

        </div>

        <div class="modal-action">
            <button class="btn btn-outline"
                onclick="document.getElementById('viewreport_{{ $report->reportID }}').close()">Close</button>
        </div>

    </div>
</dialog>