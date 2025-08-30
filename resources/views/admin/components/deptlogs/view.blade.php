<dialog id="logModal_{{$deptlog->dept_logs_id}}" class="modal">
  <div class="modal-box max-w-2xl">
    <h3 class="font-bold text-xl mb-6 text-blue-900">📋 Log Details</h3>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
      <!-- Log ID -->
      <label class="form-control">
        <div class="label">
          <span class="label-text font-semibold">Log ID</span>
        </div>
        <input type="text" value="#{{ $deptlog->dept_logs_id }}" class="input input-bordered w-full" readonly />
      </label>

      <!-- Department -->
      <label class="form-control">
        <div class="label">
          <span class="label-text font-semibold">Department</span>
        </div>
        <input type="text" value="{{ $deptlog->dept_id }}" class="input input-bordered w-full" readonly />
      </label>

      <!-- Employee ID -->
      <label class="form-control">
        <div class="label">
          <span class="label-text font-semibold">Employee ID</span>
        </div>
        <input type="text" value="{{ $deptlog->employee_id }}" class="input input-bordered w-full" readonly />
      </label>

      <!-- Employee Name -->
      <label class="form-control">
        <div class="label">
          <span class="label-text font-semibold">Employee Name</span>
        </div>
        <input type="text" value="{{ $deptlog->employee_name }}" class="input input-bordered w-full" readonly />
      </label>

      <!-- Role -->
      <label class="form-control">
        <div class="label">
          <span class="label-text font-semibold">Role</span>
        </div>
        <input type="text" value="{{ $deptlog->role }}" class="input input-bordered w-full" readonly />
      </label>

      <!-- Log Type -->
      <label class="form-control">
        <div class="label">
          <span class="label-text font-semibold">Log Type</span>
        </div>
        <input type="text" value="{{ $deptlog->log_type }}" class="input input-bordered w-full" readonly />
      </label>

      <!-- Status -->
      <label class="form-control">
        <div class="label">
          <span class="label-text font-semibold">Log Status</span>
        </div>
        <input type="text" 
               value="{{ $deptlog->log_status }}" 
               class="input input-bordered w-full font-bold 
                      @if($deptlog->log_status === 'Success') text-green-600 
                      @elseif($deptlog->log_status === 'Failed') text-red-600 
                      @else text-yellow-600 @endif" 
               readonly />
      </label>

      <!-- Attempts -->
      <label class="form-control">
        <div class="label">
          <span class="label-text font-semibold">Attempt Count</span>
        </div>
        <input type="text" value="{{ $deptlog->attempt_count ?? 0 }}" class="input input-bordered w-full" readonly />
      </label>

      <!-- Failure Reason -->
      <label class="form-control sm:col-span-2">
        <div class="label">
          <span class="label-text font-semibold">Failure Reason</span>
        </div>
        <input type="text" value="{{ $deptlog->failure_reason ?? 'None' }}" class="input input-bordered w-full" readonly />
      </label>

      <!-- Cooldown -->
      <label class="form-control">
        <div class="label">
          <span class="label-text font-semibold">Cooldown</span>
        </div>
        <input type="text" value="{{ $deptlog->cooldown ?? 'None' }}" class="input input-bordered w-full" readonly />
      </label>

      <!-- Date -->
      <label class="form-control">
        <div class="label">
          <span class="label-text font-semibold">Date</span>
        </div>
        <input type="text" value="{{ \Carbon\Carbon::parse($deptlog->date)->format('Y-m-d H:i') }} ({{ \Carbon\Carbon::parse($deptlog->date)->diffForHumans() }})" class="input input-bordered w-full" readonly />
      </label>
    </div>

    <!-- Footer -->
    <div class="modal-action mt-6">
      <form method="dialog">
        <button class="btn btn-primary">Close</button>
      </form>
    </div>
  </div>
</dialog>
