<!-- ================= EMPLOYEE REPORT MODAL ================= -->
<dialog id="employeeReportModal" class="modal">
    <div class="modal-box w-11/12 max-w-3xl relative">

        <!-- FORM START -->
        <form method="POST" action="/reportemp" class="space-y-4">
            @csrf

            <!-- CLOSE BUTTON -->
            <button type="button" class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2"
                onclick="employeeReportModal.close()">✕</button>

            <h3 class="font-bold text-lg text-error">
                Employee Report Form
               
            </h3>

            <!-- EMPLOYEE SELECT -->
            <div class="form-control">
                <label class="label">
                    <span class="label-text">Select Employee</span>
                </label>
                <select id="employeeSelect" class="select select-bordered" required>
                    <option disabled selected>Select employee</option>
                    @foreach($employees as $emp)
                        <option value="{{ $emp->employee_id }}" data-name="{{ $emp->employee_name }}"
                            data-position="{{ $emp->role }}" data-department="{{ $emp->dept_name }}">
                            {{ $emp->employee_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- AUTO FILLED FIELDS -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <input type="hidden" name="employee_id" id="employee_id">

                <div class="form-control">
                    <label class="label"><span class="label-text">Employee Name</span></label>
                    <input name="employee_name" id="employee_name" class="input input-bordered" readonly>
                </div>

                <div class="form-control">
                    <label class="label"><span class="label-text">Employee ID</span></label>
                    <input id="employee_id_display" class="input input-bordered" readonly>
                </div>

                <div class="form-control">
                    <label class="label"><span class="label-text">Position</span></label>
                    <input name="position" id="position" class="input input-bordered" readonly>
                </div>

                <div class="form-control">
                    <label class="label"><span class="label-text">Department</span></label>
                    <input name="department" id="department" class="input input-bordered" readonly>
                </div>

            </div>

            <!-- REPORT DETAILS -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div class="form-control">
                    <label class="label"><span class="label-text">Last Date Reported</span></label>
                    <input name="last_date" type="date" class="input input-bordered" required>
                </div>

                <div class="form-control">
                    <label class="label"><span class="label-text">Days Absent</span></label>
                    <input name="days_absent" type="number" min="1" class="input input-bordered" required>
                </div>

            </div>

            <div class="form-control">
                <label class="label"><span class="label-text">Actions Taken</span></label>
                <input name="actions_taken" type="text" placeholder="Called, Texted, Email"
                    class="input input-bordered">
            </div>

           

            <!-- ACTION BUTTONS -->
            <div class="modal-action">
                <button type="button" class="btn btn-outline" onclick="employeeReportModal.close()">Cancel</button>
                <button type="submit" class="btn btn-error">Submit Report</button>
            </div>

        </form>
        <!-- FORM END -->

    </div>
</dialog>

<!-- ================= JAVASCRIPT ================= -->
<script>
    document.getElementById('employeeSelect').addEventListener('change', function () {
        const selected = this.options[this.selectedIndex];

        document.getElementById('employee_id').value = selected.value;
        document.getElementById('employee_id_display').value = selected.value;
        document.getElementById('employee_name').value = selected.dataset.name;
        document.getElementById('position').value = selected.dataset.position;
        document.getElementById('department').value = selected.dataset.department;
    });
</script>