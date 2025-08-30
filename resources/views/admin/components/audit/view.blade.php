<!-- View Audit Trail Modal -->
<dialog id="viewAuditModal_{{ $audit->at_id }}" class="modal">
  <div class="modal-box max-w-3xl">
    <h3 class="text-lg font-bold text-blue-900 flex items-center gap-2">
      <i class="fa-solid fa-eye"></i>
      Audit Trail Details
    </h3>
    <div class="divider my-3"></div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
      <div>
        <label class="label"><span class="label-text">Audit ID</span></label>
        <input type="text" value="{{ $audit->at_id }}" class="input input-bordered w-full" readonly>
      </div>
      <div>
        <label class="label"><span class="label-text">Department ID</span></label>
        <input type="text" value="{{ $audit->dept_id }}" class="input input-bordered w-full" readonly>
      </div>
      <div>
        <label class="label"><span class="label-text">Department Name</span></label>
        <input type="text" value="{{ $audit->dept_name }}" class="input input-bordered w-full" readonly>
      </div>
      <div>
        <label class="label"><span class="label-text">Modules Cover</span></label>
        <input type="text" value="{{ $audit->modules_cover }}" class="input input-bordered w-full" readonly>
      </div>
      <div>
        <label class="label"><span class="label-text">Action</span></label>
        <input type="text" value="{{ $audit->action }}" class="input input-bordered w-full" readonly>
      </div>
      <div class="md:col-span-2">
        <label class="label"><span class="label-text">Activity</span></label>
        <textarea class="textarea textarea-bordered w-full" readonly>{{ $audit->activity }}</textarea>
      </div>
      <div>
        <label class="label"><span class="label-text">Employee Name</span></label>
        <input type="text" value="{{ $audit->employee_name }}" class="input input-bordered w-full" readonly>
      </div>
      <div>
        <label class="label"><span class="label-text">Employee ID</span></label>
        <input type="text" value="{{ $audit->employee_id }}" class="input input-bordered w-full" readonly>
      </div>
      <div>
        <label class="label"><span class="label-text">Role</span></label>
        <input type="text" value="{{ $audit->role }}" class="input input-bordered w-full" readonly>
      </div>
      <div>
        <label class="label"><span class="label-text">Date</span></label>
        <input type="text" 
               value="{{ \Carbon\Carbon::parse($audit->date)->format('Y-m-d H:i') }} ({{ \Carbon\Carbon::parse($audit->date)->diffForHumans() }})" 
               class="input input-bordered w-full" 
               readonly>
      </div>
    </div>

    <div class="modal-action">
      <form method="dialog">
        <button class="btn btn-sm">Close</button>
      </form>
    </div>
  </div>
</dialog>
