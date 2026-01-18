<!-- Assign Maintenance Modal -->
<dialog id="assign_maintenance_modal_{{ $room->roommaintenanceID }}" class="modal">
  <div class="modal-box w-full max-w-2xl">
    <form action="/updatemaintenance/{{ $room->roommaintenanceID }}" method="POST">
      @csrf
      @method('PUT')

      <!-- Header with icon -->
      <div class="flex items-center gap-2 mb-6">
        <i data-lucide="clipboard-list" class="w-6 h-6 text-primary"></i>
        <h3 class="font-bold text-lg">Assign Maintenance Task</h3>
      </div>
      
      <!-- Room Information -->
      <div class="flex items-center gap-3 mb-6 p-3 bg-base-200 rounded-lg">
        <div class="p-2 bg-primary/10 text-primary rounded-full">
          <i data-lucide="home" class="w-5 h-5"></i>
        </div>
        <div>
          <h4 class="font-medium">Room {{ $room->roomID }}</h4>
          <p class="text-sm text-gray-500">Maintenance ID: {{ $room->roommaintenanceID }}</p>
        </div>
      </div>

      <!-- Maintenance Description -->
      <div class="form-control mb-4 flex flex-col">
        <label class="label">
          <span class="label-text flex items-center gap-1">
            <i data-lucide="align-left" class="w-4 h-4"></i>
            Maintenance Description
          </span>
        </label>
        <textarea name="maintenancedescription" class="textarea textarea-bordered h-24" placeholder="Describe the maintenance issue..." required>{{ $room->maintenancedescription }}</textarea>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <!-- Maintenance Status -->
        <div class="form-control">
          <label class="label">
            <span class="label-text flex items-center gap-1">
              <i data-lucide="alert-circle" class="w-4 h-4"></i>
              Status
            </span>
          </label>
          <select disabled name="maintenancestatus" class="select select-bordered w-full" >
            <option value="Pending" @selected($room->maintenancestatus === 'Pending')>
              <span class="flex items-center gap-2">
                <i data-lucide="clock" class="w-4 h-4 text-warning"></i>
                Pending
              </span>
            </option>
            <option value="In Progress" @selected($room->maintenancestatus === 'In Progress')>
              <span class="flex items-center gap-2">
                <i data-lucide="wrench" class="w-4 h-4 text-info"></i>
                In Progress
              </span>
            </option>
            <option value="Completed" @selected($room->maintenancestatus === 'Completed')>
              <span class="flex items-center gap-2">
                <i data-lucide="check-circle" class="w-4 h-4 text-success"></i>
                Completed
              </span>
            </option>
          </select>

          <input hidden name="maintenancestatus" type="text" value="{{ $room->maintenancestatus }}">
        </div>

        <!-- Priority Level -->
        <div class="form-control">
          <label class="label">
            <span class="label-text flex items-center gap-1">
              <i data-lucide="signal" class="w-4 h-4"></i>
              Priority
            </span>
          </label>
          <select name="maintenance_priority" class="select select-bordered w-full">
            <option value="Low" @selected($room->maintenance_priority === 'Low')>
              <span class="flex items-center gap-2">
                <i data-lucide="signal-low" class="w-4 h-4 text-info"></i>
                Low
              </span>
            </option>
            <option value="Medium" @selected($room->maintenance_priority === 'Medium')>
              <span class="flex items-center gap-2">
                <i data-lucide="signal-medium" class="w-4 h-4 text-warning"></i>
                Medium
              </span>
            </option>
            <option value="High" @selected($room->maintenance_priority === 'High')>
              <span class="flex items-center gap-2">
                <i data-lucide="signal-high" class="w-4 h-4 text-error"></i>
                High
              </span>
            </option>
            <option value="Urgent" @selected($room->maintenance_priority === 'Urgent')>
              <span class="flex items-center gap-2">
                <i data-lucide="alert-octagon" class="w-4 h-4 text-error"></i>
                Urgent
              </span>
            </option>
          </select>
        </div>
      </div>

      
         
  <!-- Assign To -->
  <div class="form-control mb-4">
  
  
    @if(Auth::user()->role == "Hotel Admin")
      <!-- Admin can select staff -->
      <div class="form-control mb-6">
        <label class="label">
          <span class="label-text flex items-center gap-1">
            <i data-lucide="user" class="w-4 h-4"></i>
            Assign To
          </span>
        </label>
        <div class="relative">
          <i data-lucide="users" class="absolute left-3 top-3 w-4 h-4 text-gray-400"></i>
          <select name="maintenanceassigned_To" class="select select-bordered w-full pl-10" required>
            <option disabled selected>Select Maintenance Staff</option>
            @forelse ($maintenancestaffs as $staffs)
              <option value="{{ $staffs->Dept_no }}" @selected($staffs->Dept_no == $room->maintenanceassigned_To)>
                {{ $staffs->employee_name }} ({{ $staffs->role }})
              </option>
            @empty
              <option disabled selected>No Staff Available</option>
            @endforelse
          </select>
        </div>
      </div>

    @else
      <!-- Non-admins see readonly assigned staff -->
      <input readonly type="text" name="maintenanceassigned_To" class="input input-bordered"
        value="{{ $room->maintenanceassigned_To }}">
    @endif
  </div>


    

      <!-- Actions -->
      <div class="modal-action">
           @if(Auth::user()->role == "Hotel Admin")
        <button type="submit" class="btn btn-primary gap-2">
          <i data-lucide="save" class="w-4 h-4"></i>
          Save Changes
        </button>
        @endif
        <button type="button" onclick="document.getElementById('assign_maintenance_modal_{{ $room->roommaintenanceID }}').close()" class="btn gap-2">
          <i data-lucide="x" class="w-4 h-4"></i>
          Close
        </button>
      </div>
    </form>
  </div>
  
  <!-- Modal backdrop -->
  <form method="dialog" class="modal-backdrop">
    <button>close</button>
  </form>
</dialog>

