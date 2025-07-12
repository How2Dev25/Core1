<dialog id="view_room_{{$roomphoto->roomphotoID}}" class="modal modal-middle">
  <div class="modal-box w-full max-w-5xl h-[80vh] p-0 overflow-hidden bg-white rounded-lg shadow-lg relative">

    <!-- Close Button -->
    <button type="button" onclick="this.closest('dialog').close()" 
            class="btn btn-sm btn-circle btn-ghost absolute top-4 right-4 z-10 bg-white/80 hover:bg-white">
      <i data-lucide="x" class="w-5 h-5"></i>
    </button>

    <!-- Image Area -->
    <div class="w-full h-full flex items-center justify-center bg-black">
      <img src="{{ asset($roomphoto->additionalroomphoto) }}" 
           alt="Room photo" 
           class="w-full h-full object-contain">
    </div>

  </div>

  <!-- Backdrop -->
  <form method="dialog" class="modal-backdrop bg-black/60">
    <button type="button">close</button>
  </form>
</dialog>
