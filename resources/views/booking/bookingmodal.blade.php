<dialog id="view_room" class="modal">
  <div class="modal-box max-w-4xl">
    <h3 class="text-lg font-bold mb-4">View Rooms</h3>

    <!-- Livewire Component with polling -->
    <livewire:room-landing />

    <div class="modal-action">
      <form method="dialog">
        <button class="btn">Close</button>
      </form>
    </div>
  </div>
</dialog>