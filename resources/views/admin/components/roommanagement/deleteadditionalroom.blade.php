<dialog id="deleteadd_room_{{$roomphoto->roomphotoID}}" class="modal modal-middle">
  <div class="modal-box w-full max-w-5xl h-[90vh] p-0 overflow-hidden bg-white rounded-lg shadow-xl relative">

    <!-- Close Button (more prominent) -->
    <button type="button" onclick="this.closest('dialog').close()" 
            class="btn btn-sm btn-circle btn-ghost absolute top-4 right-4 z-50 bg-white/90 hover:bg-white text-gray-800 hover:text-error transition-all">
      <i data-lucide="x" class="w-5 h-5"></i>
    </button>

    <!-- Image Area (with loading state) -->
    <div class="w-full h-full flex items-center justify-center bg-gray-900 relative">
      <div class="absolute inset-0 flex items-center justify-center">
        <span class="loading loading-spinner loading-lg text-white/50"></span>
      </div>
      <img src="{{ asset($roomphoto->additionalroomphoto) }}" 
           alt="Room photo" 
           class="w-full h-full object-contain transition-opacity opacity-0"
           onload="this.classList.remove('opacity-0')">
    </div>

    <!-- Action Buttons (positioned absolutely over image) -->
    <div class="absolute bottom-4 right-4 flex gap-2 z-40">
      <!-- Delete Button (more prominent with confirmation) -->
      <form action="/deleteroomphoto/{{ $roomphoto->roomphotoID }}" method="POST" onsubmit="return confirm('Are you sure you want to permanently delete this photo?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-error btn-sm sm:btn-md shadow-lg hover:shadow-error/40 transition-all">
          <i data-lucide="trash-2" class="w-4 h-4 mr-1 sm:mr-2"></i> 
          <span class="hidden sm:inline">Delete Photo</span>
        </button>
      </form>
      
      <!-- Optional: Download Button -->
      <a href="{{ asset($roomphoto->additionalroomphoto) }}" download 
         class="btn btn-primary btn-sm sm:btn-md shadow-lg hover:shadow-primary/40 transition-all">
        <i data-lucide="download" class="w-4 h-4 mr-1 sm:mr-2"></i>
        <span class="hidden sm:inline">Download</span>
      </a>
    </div>

  </div>

  <!-- Backdrop (with fade effect) -->
  <form method="dialog" class="modal-backdrop bg-black/70 backdrop-blur-sm transition-opacity">
    <button type="button">close</button>
  </form>
</dialog>