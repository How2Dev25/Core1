 <dialog id="delete_modal_{{ $facility->facilityID}}" class="modal">
    <div class="modal-box">
      <h3 class="text-lg font-bold">Delete Facility</h3>
      <p class="py-4">Are you sure you want to delete <span class="font-semibold">{{ $facility->facility_name }}</span>? This action cannot be undone.</p>

      <div class="modal-action">
        <!-- Cancel Button -->
        <form method="dialog">
          <button class="btn">Cancel</button>
        </form>

        <!-- Delete Form -->
        <form action="/facilitydelete/{{ $facility->facilityID}}" method="POST">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn bg-red-500 text-white hover:bg-red-600">
            Yes, Delete
          </button>
        </form>
      </div>
    </div>
  </dialog>