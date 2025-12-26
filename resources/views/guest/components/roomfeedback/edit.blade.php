<dialog id="editFeedbackModal-{{ $myroomfeedback->roomfeedbackID }}" class="modal">
  <div class="modal-box w-full max-w-md md:max-w-lg rounded-xl p-0 relative overflow-hidden">
    <div class="max-h-[80vh] overflow-y-auto p-5 md:p-6 space-y-5">
      <!-- Header -->
      <div class="text-center mb-4">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full mb-3" style="background-color: #001f54;">
          <i class="fa-solid fa-pen-to-square text-2xl" style="color: #F7B32B;"></i>
        </div>
        <h3 class="text-2xl font-bold mb-1" style="color: #001f54;">Edit Your Feedback</h3>
        <p class="text-sm text-gray-500">Update your feedback for this room.</p>
      </div>

      <form method="POST" 
            action="/updateroomfeedback/{{$myroomfeedback->roomfeedbackID}}" 
            enctype="multipart/form-data"
            class="space-y-5 mt-6">
        @csrf
        @method('PUT')

        <!-- Room Info -->
        <input type="hidden" name="roomID" value="{{ $myroomfeedback->roomID }}">
        <div class="flex items-start gap-4">
          <img src="{{ $myroomfeedback->roomphoto }}" 
               alt="Room Image" 
               class="w-24 h-24 object-cover rounded-lg shadow-md border">
          <div>
            <p class="font-semibold text-lg text-[#001f54]">
              {{ $myroomfeedback->roomtype }} - #{{ $myroomfeedback->roomID }}
            </p>
            <p class="text-xs text-gray-500">
              Feedback created {{ \Carbon\Carbon::parse($myroomfeedback->roomfeedbackdate)->diffForHumans() }}
            </p>
          </div>
        </div>

        <!-- Rating -->
        <div class="py-2">
          <label class="block text-sm font-medium text-gray-600 mb-3 text-center">
            How would you rate your stay?
          </label>
          <div class="flex justify-center gap-1 mb-2" id="rating-stars-{{ $myroomfeedback->roomfeedbackID }}">
            @for ($i = 1; $i <= 5; $i++)
              <label class="cursor-pointer transform hover:scale-110 transition-transform duration-200">
                <input type="radio" 
                       name="roomrating" 
                       value="{{ $i }}" 
                       class="hidden peer"
                       {{ $myroomfeedback->roomrating == $i ? 'checked' : '' }}
                       onchange="updateEditRatingText({{ $i }}, {{ $myroomfeedback->roomfeedbackID }})"
                       required>
                <i class="fa-regular fa-star text-4xl peer-checked:fa-solid" style="color: #F7B32B;"></i>
              </label>
            @endfor
          </div>
          <div class="text-center text-sm text-gray-500 mt-1" id="edit-rating-text-{{ $myroomfeedback->roomfeedbackID }}">
            @php
              $ratingTexts = [
                1 => 'Poor - We can do better',
                2 => 'Fair - Room for improvement',
                3 => 'Good - Met expectations',
                4 => 'Very Good - Above expectations',
                5 => 'Excellent - Outstanding stay!'
              ];
            @endphp
            {{ $ratingTexts[$myroomfeedback->roomrating] ?? 'Tap a star to rate' }}
          </div>
        </div>

        <!-- Feedback Text -->
        <div>
          <label class="block text-sm font-medium text-gray-600 mb-2">
            <i class="fa-solid fa-comment mr-1" style="color: #F7B32B;"></i> Your Feedback
          </label>
          <textarea name="roomfeedbackfeedback" 
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition" 
                    rows="4" 
                    required>{{ $myroomfeedback->roomfeedbackfeedback }}</textarea>
          <div class="text-xs text-gray-500 text-right mt-1">Minimum 20 characters</div>
        </div>

        <!-- Photo Upload Section -->
        <div>
          <label class="block text-sm font-medium text-gray-600 mb-2">
            <i class="fa-solid fa-camera mr-1" style="color: #F7B32B;"></i> Update Photo (Optional)
          </label>

          <!-- Current Photo Display -->
          @if($myroomfeedback->roomfeedbackphoto)
          <div id="currentPhoto-{{ $myroomfeedback->roomfeedbackID }}" class="mb-3">
            <p class="text-xs text-gray-500 mb-2">Current Photo:</p>
            <div class="relative inline-block group">
              <img src="{{ $myroomfeedback->roomfeedbackphoto }}" 
                   alt="Current feedback photo" 
                   class="w-32 h-32 object-cover rounded-lg border border-gray-300 shadow-sm">
              <button type="button"
                      onclick="removeCurrentPhoto({{ $myroomfeedback->roomfeedbackID }})"
                      class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-7 h-7 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-200 hover:bg-red-600">
                <i class="fa-solid fa-xmark text-sm"></i>
              </button>
            </div>
            <input type="hidden" name="remove_photo" id="removePhotoFlag-{{ $myroomfeedback->roomfeedbackID }}" value="0">
          </div>
          @endif

          <!-- Upload Button -->
          <div class="relative">
            <input type="file" 
                   id="photoInputEdit-{{ $myroomfeedback->roomfeedbackID }}" 
                   name="roomfeedbackphoto" 
                   accept="image/*" 
                   class="hidden"
                   onchange="handleEditPhotoUpload(event, {{ $myroomfeedback->roomfeedbackID }})">
            <label for="photoInputEdit-{{ $myroomfeedback->roomfeedbackID }}" 
                   class="flex items-center justify-center w-full px-4 py-3 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:border-blue-400 hover:bg-blue-50 transition">
              <i class="fa-solid fa-cloud-arrow-up mr-2 text-gray-400"></i>
              <span class="text-gray-600 text-sm">
                @if($myroomfeedback->roomfeedbackphoto)
                  Click to replace photo
                @else
                  Click to upload photo
                @endif
              </span>
            </label>
          </div>
          <div class="text-xs text-gray-500 mt-1">Up to 5MB (JPG, PNG)</div>

          <!-- New Photo Preview -->
          <div id="newPhotoPreview-{{ $myroomfeedback->roomfeedbackID }}" class="hidden mt-3">
            <p class="text-xs text-gray-500 mb-2">New Photo:</p>
            <div class="relative inline-block group">
              <img id="newPhotoImg-{{ $myroomfeedback->roomfeedbackID }}" 
                   src="" 
                   alt="New photo preview" 
                   class="w-32 h-32 object-cover rounded-lg border border-gray-300 shadow-sm">
              <button type="button"
                      onclick="cancelNewPhoto({{ $myroomfeedback->roomfeedbackID }})"
                      class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-7 h-7 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-200 hover:bg-red-600">
                <i class="fa-solid fa-xmark text-sm"></i>
              </button>
            </div>
            <p id="newPhotoSize-{{ $myroomfeedback->roomfeedbackID }}" class="text-xs text-gray-500 mt-1"></p>
          </div>
        </div>

        <!-- Buttons -->
        <div class="flex justify-end gap-3 pt-2">
          <button type="button" 
                  onclick="closeEditModal({{ $myroomfeedback->roomfeedbackID }})" 
                  class="btn px-5 py-2.5 rounded-xl border border-gray-300 text-gray-700 hover:bg-gray-100 transition">
            Cancel
          </button>
          <button type="submit" 
                  class="btn btn-primary px-6 py-2.5 rounded-xl shadow hover:shadow-md transition-all duration-300">
            Update Feedback
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
  // Rating text update for edit modal
  function updateEditRatingText(rating, feedbackId) {
    const ratingTexts = {
      1: 'Poor - We can do better',
      2: 'Fair - Room for improvement',
      3: 'Good - Met expectations',
      4: 'Very Good - Above expectations',
      5: 'Excellent - Outstanding stay!'
    };
    document.getElementById(`edit-rating-text-${feedbackId}`).textContent = ratingTexts[rating];
  }

  // Photo upload handling for edit modal
  const MAX_FILE_SIZE_EDIT = 5 * 1024 * 1024; // 5MB

  function handleEditPhotoUpload(event, feedbackId) {
    const file = event.target.files[0];
    
    if (!file) return;

    // Validate file size
    if (file.size > MAX_FILE_SIZE_EDIT) {
      alert('File is too large. Maximum file size is 5MB.');
      event.target.value = '';
      return;
    }

    // Validate file type
    if (!file.type.startsWith('image/')) {
      alert('Please upload a valid image file.');
      event.target.value = '';
      return;
    }

    // Show preview
    const reader = new FileReader();
    reader.onload = function(e) {
      const previewContainer = document.getElementById(`newPhotoPreview-${feedbackId}`);
      const previewImg = document.getElementById(`newPhotoImg-${feedbackId}`);
      const sizeText = document.getElementById(`newPhotoSize-${feedbackId}`);
      
      previewImg.src = e.target.result;
      sizeText.textContent = `File size: ${formatFileSize(file.size)}`;
      previewContainer.classList.remove('hidden');

      // Hide current photo if exists
      const currentPhoto = document.getElementById(`currentPhoto-${feedbackId}`);
      if (currentPhoto) {
        currentPhoto.style.opacity = '0.5';
      }
    };
    reader.readAsDataURL(file);
  }

  function cancelNewPhoto(feedbackId) {
    // Clear file input
    const fileInput = document.getElementById(`photoInputEdit-${feedbackId}`);
    fileInput.value = '';

    // Hide preview
    const previewContainer = document.getElementById(`newPhotoPreview-${feedbackId}`);
    previewContainer.classList.add('hidden');

    // Restore current photo opacity
    const currentPhoto = document.getElementById(`currentPhoto-${feedbackId}`);
    if (currentPhoto) {
      currentPhoto.style.opacity = '1';
    }
  }

  function removeCurrentPhoto(feedbackId) {
    if (confirm('Are you sure you want to remove the current photo?')) {
      const currentPhoto = document.getElementById(`currentPhoto-${feedbackId}`);
      const removeFlag = document.getElementById(`removePhotoFlag-${feedbackId}`);
      
      if (currentPhoto) {
        currentPhoto.style.display = 'none';
      }
      if (removeFlag) {
        removeFlag.value = '1';
      }
    }
  }

  function formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
  }

  function closeEditModal(feedbackId) {
    // Reset any changes
    cancelNewPhoto(feedbackId);
    
    // Reset remove flag
    const removeFlag = document.getElementById(`removePhotoFlag-${feedbackId}`);
    if (removeFlag) {
      removeFlag.value = '0';
    }

    // Restore current photo
    const currentPhoto = document.getElementById(`currentPhoto-${feedbackId}`);
    if (currentPhoto) {
      currentPhoto.style.display = 'block';
      currentPhoto.style.opacity = '1';
    }

    // Close modal
    document.getElementById(`editFeedbackModal-${feedbackId}`).close();
  }
</script>