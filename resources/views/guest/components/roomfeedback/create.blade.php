<dialog id="createFeedbackModal" class="modal">
  <div class="modal-box w-full max-w-sm sm:max-w-md md:max-w-lg lg:max-w-xl rounded-xl p-0 relative overflow-hidden">

    <!-- Scrollable content wrapper -->
    <div class="max-h-[75vh] overflow-y-auto p-4 sm:p-6 space-y-5">

      <!-- Header -->
      <div class="text-center mb-4">
        <div class="inline-flex items-center justify-center w-14 h-14 sm:w-16 sm:h-16 rounded-full mb-3"
          style="background-color: #001f54;">
          <i class="fa-solid fa-star text-xl sm:text-2xl" style="color: #F7B32B;"></i>
        </div>
        <h3 class="text-xl sm:text-2xl font-bold mb-1" style="color: #001f54;">Tell Us About Your Stay</h3>
        <p class="text-xs sm:text-sm text-gray-500">We appreciate your time in helping us serve you better.</p>
      </div>

      <!-- Form -->
      <form method="POST" action="/submitroomfeedback" enctype="multipart/form-data" class="space-y-5 mt-4">
        @csrf

        <!-- Select Room -->
        <div class="relative w-full">
          <input type="hidden" name="roomID" id="selectedRoom" required>

          <!-- Trigger button -->
          <button type="button" id="roomDropdownBtn" onclick="toggleRoomList()"
            class="btn w-full justify-between px-4 py-3 text-sm sm:text-base">
            Choose a room
            <i class="fa-solid fa-chevron-down ml-2"></i>
          </button>

          <!-- Dropdown list (inside modal, scrollable) -->
          <div id="roomList" class="absolute left-0 right-0 mt-2 hidden 
                      bg-white rounded-xl shadow-lg border 
                      max-h-[50vh] overflow-y-auto z-50">
            <ul class="divide-y divide-gray-100">
              @foreach($reserverooms as $room)
                <li>
                  <a href="javascript:void(0)"
                    onclick="selectRoom('{{ $room->roomID }}', '{{ $room->roomtype }}'); toggleRoomList();"
                    class="block p-3 hover:bg-gray-100 transition text-sm sm:text-base">
                    <span class="block font-semibold text-[#001f54]">
                      {{ $room->roomtype }} - #{{ $room->roomID }}
                    </span>
                    <span class="text-xs text-gray-500">
                      {{ \Carbon\Carbon::parse($room->reservation_created_at)->format('M d, Y h:i A') }}
                      ({{ \Carbon\Carbon::parse($room->reservation_created_at)->diffForHumans() }})
                    </span>
                  </a>
                </li>
              @endforeach
            </ul>
          </div>
        </div>

        <!-- Rating -->
        <div class="py-2">
          <label class="block text-sm font-medium text-gray-600 mb-3 text-center">
            How would you rate your stay?
          </label>
          <div class="flex justify-center gap-1 mb-2">
            @for ($i = 1; $i <= 5; $i++)
              <label class="cursor-pointer transform hover:scale-110 transition-transform duration-200">
                <input type="radio" name="roomrating" value="{{ $i }}" class="hidden peer" required
                  onchange="updateRatingText({{ $i }})">
                <i class="fa-regular fa-star text-2xl sm:text-3xl peer-checked:fa-solid" style="color: #F7B32B;"></i>
              </label>
            @endfor
          </div>
          <div class="text-center text-xs sm:text-sm text-gray-500 mt-1" id="rating-text">
            Tap a star to rate
          </div>
        </div>

        <!-- Feedback Text -->
        <div>
          <label class="block text-sm font-medium text-gray-600 mb-2">
            <i class="fa-solid fa-comment mr-1" style="color: #F7B32B;"></i> Your Feedback
          </label>
          <textarea name="roomfeedbackfeedback"
            class="w-full border border-gray-200 rounded-xl px-3 sm:px-4 py-2 sm:py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition text-sm sm:text-base"
            rows="4" placeholder="What did you enjoy most about your stay? Is there anything we could improve?"
            required></textarea>
          <div class="text-xs text-gray-500 text-right mt-1">Minimum 20 characters</div>
        </div>

        <!-- Photo Upload -->
        <div>
          <label class="block text-sm font-medium text-gray-600 mb-2">
            <i class="fa-solid fa-camera mr-1" style="color: #F7B32B;"></i> Add Photos (Optional)
          </label>

          <!-- Upload Button -->
          <div class="relative">
            <input type="file" id="photoInput" name="roomfeedbackphoto" accept="image/*"  class="hidden"
              onchange="handlePhotoUpload(event)">
            <label for="photoInput"
              class="flex items-center justify-center w-full px-4 py-3 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:border-blue-400 hover:bg-blue-50 transition text-sm sm:text-base">
              <i class="fa-solid fa-cloud-arrow-up mr-2 text-gray-400"></i>
              <span class="text-gray-600">Click to upload photos</span>
            </label>
          </div>
          <div class="text-xs text-gray-500 mt-1">Max 5 photos, up to 5MB each (JPG, PNG)</div>

          <!-- Photo Preview Grid -->
          <div id="photoPreviewContainer" class="hidden mt-3">
            <div id="photoPreviewGrid" class="grid grid-cols-3 sm:grid-cols-4 gap-2"></div>
          </div>
        </div>

        <!-- Buttons -->
        <div class="flex flex-col sm:flex-row justify-end gap-2 sm:gap-3 pt-2">
          <button type="button" onclick="createFeedbackModal.close(); resetForm();"
            class="btn w-full sm:w-auto px-4 sm:px-5 py-2.5 rounded-xl border border-gray-300 text-gray-700 hover:bg-gray-100 transition">
            Cancel
          </button>
          <button type="submit"
            class="btn btn-primary w-full sm:w-auto px-5 sm:px-6 py-2.5 rounded-xl shadow hover:shadow-md transition-all duration-300">
            Submit Feedback
          </button>
        </div>
      </form>
    </div>

    <!-- Modal backdrop -->
    <form method="dialog" class="modal-backdrop">
      <button>close</button>
    </form>
  </div>
</dialog>

<script>
  // Room selection functions
  function toggleRoomList() {
    document.getElementById('roomList').classList.toggle('hidden');
  }

  function selectRoom(roomID, roomType) {
    document.getElementById('selectedRoom').value = roomID;
    document.getElementById('roomDropdownBtn').innerHTML = roomType + ' - #' + roomID +
      '<i class="fa-solid fa-chevron-down ml-2"></i>';
  }

  // Rating text update
  function updateRatingText(rating) {
    const ratingTexts = {
      1: 'Poor - We can do better',
      2: 'Fair - Room for improvement',
      3: 'Good - Met expectations',
      4: 'Very Good - Above expectations',
      5: 'Excellent - Outstanding stay!'
    };
    document.getElementById('rating-text').textContent = ratingTexts[rating];
  }

  // Photo upload handling
  let selectedFiles = [];
  const MAX_FILES = 5;
  const MAX_FILE_SIZE = 5 * 1024 * 1024; // 5MB

    function handlePhotoUpload(event) {
    const file = event.target.files[0];
    if (!file) return;

    // Validate size (5MB)
    if (file.size > 5 * 1024 * 1024) {
      alert('Maximum file size is 5MB.');
    event.target.value = '';
    return;
    }

    // Validate type
    if (!file.type.startsWith('image/')) {
      alert('Invalid image file.');
    event.target.value = '';
    return;
    }

    const container = document.getElementById('photoPreviewContainer');
    const grid = document.getElementById('photoPreviewGrid');

    container.classList.remove('hidden');
    grid.innerHTML = '';

    const reader = new FileReader();
    reader.onload = function (e) {
      grid.innerHTML = `
        <div class="relative aspect-square rounded-lg overflow-hidden border border-gray-200">
          <img src="${e.target.result}" class="w-full h-full object-cover">
          <button type="button"
            onclick="removePhoto()"
            class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-600">
            <i class="fa-solid fa-xmark text-xs"></i>
          </button>
        </div>
      `;
    };

    reader.readAsDataURL(file);
  }

    function removePhoto() {
      document.getElementById('photoInput').value = '';
    document.getElementById('photoPreviewContainer').classList.add('hidden');
    document.getElementById('photoPreviewGrid').innerHTML = '';
  }

  function updatePhotoPreview() {
    const container = document.getElementById('photoPreviewContainer');
    const grid = document.getElementById('photoPreviewGrid');

    if (selectedFiles.length === 0) {
      container.classList.add('hidden');
      return;
    }

    container.classList.remove('hidden');
    grid.innerHTML = '';

    selectedFiles.forEach((file, index) => {
      const reader = new FileReader();

      reader.onload = function (e) {
        const photoDiv = document.createElement('div');
        photoDiv.className = 'relative group aspect-square rounded-lg overflow-hidden border border-gray-200';
        photoDiv.innerHTML = `
          <img src="${e.target.result}" 
               alt="Preview ${index + 1}" 
               class="w-full h-full object-cover">
          <button type="button"
                  onclick="removePhoto(${index})"
                  class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-200 hover:bg-red-600">
            <i class="fa-solid fa-xmark text-xs"></i>
          </button>
          <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/50 to-transparent p-1">
            <span class="text-white text-xs">${formatFileSize(file.size)}</span>
          </div>
        `;
        grid.appendChild(photoDiv);
      };

      reader.readAsDataURL(file);
    });

    // Update the file input with current files
    updateFileInput();
  }

  function removePhoto(index) {
    selectedFiles.splice(index, 1);
    updatePhotoPreview();
  }

  function updateFileInput() {
    const dataTransfer = new DataTransfer();
    selectedFiles.forEach(file => {
      dataTransfer.items.add(file);
    });
    document.getElementById('photoInput').files = dataTransfer.files;
  }

  function formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
  }

  function resetForm() {
    selectedFiles = [];
    document.getElementById('photoPreviewContainer').classList.add('hidden');
    document.getElementById('photoPreviewGrid').innerHTML = '';
    document.getElementById('rating-text').textContent = 'Tap a star to rate';
  }

  // Close dropdown when clicking outside
  document.addEventListener('click', function (event) {
    const roomList = document.getElementById('roomList');
    const dropdownBtn = document.getElementById('roomDropdownBtn');

    if (!roomList.contains(event.target) && !dropdownBtn.contains(event.target)) {
      roomList.classList.add('hidden');
    }
  });
</script>