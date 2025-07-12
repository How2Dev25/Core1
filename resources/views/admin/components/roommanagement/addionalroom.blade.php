<dialog id="additional_room" class="modal">
  <div class="modal-box max-w-md p-0 overflow-hidden">
    <!-- Close Button - Now properly closes the modal -->
    <button type="button" onclick="window.additional_room.close()" class="btn btn-sm btn-circle btn-ghost absolute top-4 right-4 z-10">
      <i data-lucide="x" class="w-4 h-4"></i>
    </button>
    
    <!-- Modal Content -->
    <div class="flex flex-col">
      <!-- Header -->
      <div class="bg-primary p-6 text-center text-primary-content">
        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-primary-focus bg-opacity-20 mb-4">
          <i data-lucide="image-plus" class="w-6 h-6"></i>
        </div>
        <h3 class="text-lg font-medium mb-2">Add Room Photo</h3>
        <p class="text-sm opacity-80">Upload a high-quality image of your room</p>
      </div>
      
      <!-- Body -->
      <form id="photo-upload-form" action="/additonalroom" method="POST" enctype="multipart/form-data" class="p-6">
        @csrf
        
        <!-- Image Preview -->
        <div class="mb-4 relative group">
          <img id="room-photo-preview" src="{{ asset('images/defaults/default.jpg') }}" alt="Room preview" 
               class="w-full h-48 object-cover rounded-lg border-2 border-dashed border-gray-300 group-hover:border-primary transition-all">
          <div id="upload-overlay" class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
            <i data-lucide="upload" class="w-8 h-8 text-white"></i>
          </div>
          <input id="room-photo-input" name="additionalroomphoto" type="file" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
          <input type="text" name="roomID" value="{{$room->roomID}}" id="" hidden>
        </div>
        
        <div class="text-xs text-gray-500 mb-4 flex items-center">
          <i data-lucide="info" class="w-4 h-4 mr-1"></i>
          Recommended size: 1200×800 pixels (max 5MB)
        </div>
        
        <!-- Action Buttons -->
        <div class="flex justify-center gap-4">
          <button type="button" onclick="window.additional_room.close()" class="btn btn-outline w-full flex-1">
            <i data-lucide="x" class="w-4 h-4 mr-1"></i>
            Cancel
          </button>
          
          <button id="submit-photo-btn" type="submit" class="btn btn-primary w-full flex-1" disabled>
            <i data-lucide="check" class="w-4 h-4 mr-1"></i>
            Upload Photo
          </button>
        </div>
      </form>
    </div>
  </div>
  
  <!-- Backdrop - Now properly closes the modal -->
  <form method="dialog" class="modal-backdrop">
    <button type="button">close</button>
  </form>
</dialog>

<script>
  // Initialize dialog functionality
  document.addEventListener('DOMContentLoaded', function() {
    // Access the dialog element
    const modal = document.getElementById('additional_room');
    
    // Make it available globally (optional)
    window.additional_room = modal;
    
    // Initialize Lucide icons
    if (window.lucide) {
      lucide.createIcons();
    }

    // File input handling
    const fileInput = document.getElementById('room-photo-input');
    const previewImage = document.getElementById('room-photo-preview');
    const submitBtn = document.getElementById('submit-photo-btn');
    const uploadOverlay = document.getElementById('upload-overlay');
    
    fileInput.addEventListener('change', function(e) {
      const file = e.target.files[0];
      if (file) {
        const validTypes = ['image/jpeg', 'image/png', 'image/webp'];
        const maxSize = 5 * 1024 * 1024;
        
        if (!validTypes.includes(file.type)) {
          alert('Please upload a JPEG, PNG, or WebP image.');
          return;
        }
        
        if (file.size > maxSize) {
          alert('Image size exceeds 5MB limit.');
          return;
        }
        
        const reader = new FileReader();
        reader.onload = function(event) {
          previewImage.src = event.target.result;
          submitBtn.disabled = false;
        };
        reader.readAsDataURL(file);
      }
    });
    
    // Drag and drop functionality
    previewImage.addEventListener('dragover', (e) => {
      e.preventDefault();
      uploadOverlay.style.opacity = '1';
      previewImage.classList.add('border-primary');
    });
    
    previewImage.addEventListener('dragleave', () => {
      uploadOverlay.style.opacity = '0';
      previewImage.classList.remove('border-primary');
    });
    
    previewImage.addEventListener('drop', (e) => {
      e.preventDefault();
      uploadOverlay.style.opacity = '0';
      previewImage.classList.remove('border-primary');
      
      if (e.dataTransfer.files.length) {
        fileInput.files = e.dataTransfer.files;
        const event = new Event('change');
        fileInput.dispatchEvent(event);
      }
    });
  });
</script>