<!-- Assign Maintenance Modal -->
<dialog id="create_maintenance_modal" class="modal">
  <div class="modal-box w-full max-w-2xl">
    <form action="/createmaintenance" method="POST">

        @csrf
      <!-- Header with icon -->
      <div class="flex items-center gap-2 mb-6">
        <i data-lucide="clipboard-list" class="w-6 h-6 text-primary"></i>
        <h3 class="font-bold text-lg">Assign Maintenance Task</h3>
      </div>
      
     
      <div class="form-control mb-4 flex flex-col">
        <label class="label">
          <span class="label-text flex items-center gap-1">
            <i data-lucide="align-left" class="w-4 h-4"></i>
            Room
          </span>
        </label>

        <select name="roomID" class="select">
            @forelse ($roomID as $roomsID)
            <option value="{{$roomsID->roomID}}">Room {{$roomsID->roomID}}</option>
            @empty
                <option disabled selected>No Rooms Found</option>
            @endforelse
            
         </select>
       
      </div>

      <!-- Maintenance Description -->
      <div class="form-control mb-4 flex flex-col">
        <label class="label">
          <span class="label-text flex items-center gap-1">
            <i data-lucide="align-left" class="w-4 h-4"></i>
            Maintenance Description
          </span>
        </label>
        <textarea name="maintenancedescription" class="textarea textarea-bordered h-24" placeholder="Describe the maintenance issue..." required>Leaky faucet in bathroom needs repair</textarea>
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
          <select name="maintenancestatus" class="select select-bordered w-full" required>
            <option>
              <span class="flex items-center gap-2">
                <i data-lucide="clock" class="w-4 h-4 text-warning"></i>
                Pending
              </span>
            </option>
            <option>
              <span class="flex items-center gap-2">
                <i data-lucide="wrench" class="w-4 h-4 text-info"></i>
                In Progress
              </span>
            </option>
            <option>
              <span class="flex items-center gap-2">
                <i data-lucide="check-circle" class="w-4 h-4 text-success"></i>
                Completed
              </span>
            </option>
          </select>
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
            <option>
              <span class="flex items-center gap-2">
                <i data-lucide="signal-low" class="w-4 h-4 text-info"></i>
                Low
              </span>
            </option>
            <option selected>
              <span class="flex items-center gap-2">
                <i data-lucide="signal-medium" class="w-4 h-4 text-warning"></i>
                Medium
              </span>
            </option>
            <option>
              <span class="flex items-center gap-2">
                <i data-lucide="signal-high" class="w-4 h-4 text-error"></i>
                High
              </span>
            </option>
            <option>
              <span class="flex items-center gap-2">
                <i data-lucide="alert-octagon" class="w-4 h-4 text-error"></i>
                Urgent
              </span>
            </option>
          </select>
        </div>
      </div>

      <!-- Assign To -->
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
            <option disabled selected>Select staff member</option>
            <option>John Smith (Plumber)</option>
            <option>Maria Garcia (Housekeeping)</option>
            <option>David Lee (Maintenance)</option>
          </select>
        </div>
      </div>

   
    

      <!-- Actions -->
      <div class="modal-action">
        <button type="submit" class="btn btn-primary gap-2">
          <i data-lucide="save" class="w-4 h-4"></i>
          Add Room For Maintenance
        </button>
        <button type="button" onclick="document.getElementById('create_maintenance_modal').close()" class="btn gap-2">
          <i data-lucide="x" class="w-4 h-4"></i>
          Cancel
        </button>
      </div>
    </form>
  </div>
  
  <!-- Modal backdrop -->
  <form method="dialog" class="modal-backdrop">
    <button>close</button>
  </form>
</dialog>

<script>
  // Initialize Lucide icons
  lucide.createIcons();
</script>