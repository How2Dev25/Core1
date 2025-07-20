<dialog id="delete_maintenance_{{ $room->roommaintenanceID }}" class="modal">
  <div class="modal-box max-w-md">
    <form method="dialog">
      <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">
        <i data-lucide="x" class="w-4 h-4"></i>
      </button>
    </form>

    <h3 class="text-lg font-bold text-red-600 mb-4 flex items-center gap-2">
      <i data-lucide="trash-2" class="w-5 h-5"></i>
      Confirm Deletion
    </h3>

    <p class="mb-6 text-sm text-gray-700">Are you sure you want to remove this Maintenance? This action cannot be undone.</p>

    <form  method="POST" action="/deletemaintenance/{{ $room->roommaintenanceID }}">
      @csrf
      @method('DELETE')
      <div class="modal-action">
        <button onclick="delete_maintenance_{{ $room->roommaintenanceID }}.close()" type="button" onclick="" class="btn btn-ghost">Cancel</button>
        <button  type="submit" class="btn btn-error">
          <i data-lucide="trash" class="w-4 h-4 mr-1"></i>
          Delete
        </button>
      </div>
    </form>
  </div>

  <!-- Click outside to close -->
  <form method="dialog" class="modal-backdrop">
    <button>close</button>
  </form>
</dialog>
