<dialog id="complete_maintenance_{{ $room->roommaintenanceID }}" class="modal">
  <div class="modal-box max-w-md">
    <form method="dialog">
      <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">
        <i data-lucide="x" class="w-4 h-4"></i>
      </button>
    </form>

    <h3 class="text-lg font-bold text-green-600 mb-4 flex items-center gap-2">
      <i data-lucide="check" class="w-5 h-5"></i>
      Confirm Mark As Complete
    </h3>

    <p class="mb-6 text-sm text-gray-700">Are you sure you want to mark this Room #{{ $room->roomID }} As Complete For Maintenance  This action cannot be undone.</p>

    <form id="delete-inventory-form" method="POST" action="/completemaintenance/{{ $room->roommaintenanceID }}">
      @csrf
      @method('PUT')
      <div class="modal-action">
        <button onclick="complete_maintenance_{{ $room->roommaintenanceID }}.close()" type="button" onclick="" class="btn btn-ghost">Cancel</button>
        <button  type="submit" class="btn btn-success">
          <i data-lucide="check" class="w-4 h-4 mr-1"></i>
          Proceed
        </button>
      </div>
    </form>
  </div>

  <!-- Click outside to close -->
  <form method="dialog" class="modal-backdrop">
    <button>close</button>
  </form>
</dialog>
