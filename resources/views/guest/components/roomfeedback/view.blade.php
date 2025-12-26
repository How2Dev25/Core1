<dialog id="viewFeedbackModal-{{ $myroomfeedback->roomfeedbackID }}" class="modal">
  <div class="modal-box w-full max-w-md md:max-w-lg rounded-xl p-0 relative overflow-hidden">

    <!-- Scrollable content wrapper -->
    <div class="max-h-[80vh] overflow-y-auto p-5 md:p-6 space-y-5">

      <!-- Header -->
      <div class="text-center mb-4">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full mb-3"
          style="background-color: #001f54;">
          <i class="fa-solid fa-eye text-2xl" style="color: #F7B32B;"></i>
        </div>
        <h3 class="text-2xl font-bold mb-1" style="color: #001f54;">View Feedback</h3>
        <p class="text-sm text-gray-500">Here's your feedback and the hotel's response.</p>
      </div>

      <!-- Room Info -->
      <div class="flex items-start gap-4">
        <img src="{{ $myroomfeedback->roomphoto }}" alt="Room Image"
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
          Rating
        </label>
        <div class="flex justify-center gap-1 mb-2">
          @for ($i = 1; $i <= 5; $i++)
            <i class="fa-star text-4xl {{ $myroomfeedback->roomrating >= $i ? 'fa-solid' : 'fa-regular' }}"
              style="color: #F7B32B;"></i>
          @endfor
        </div>
      </div>

      <!-- Feedback Text -->
      <div>
        <label class="block text-sm font-medium text-gray-600 mb-2">
          <i class="fa-solid fa-comment mr-1" style="color: #F7B32B;"></i> Your Feedback
        </label>
        <div class="p-4 border border-gray-200 rounded-xl bg-gray-50 text-sm text-gray-700">
          {{ $myroomfeedback->roomfeedbackfeedback }}
        </div>
      </div>

      <!-- Feedback Photo -->
      <div>
        <label class="block text-sm font-medium text-gray-600 mb-2">
          <i class="fa-solid fa-camera mr-1" style="color: #F7B32B;"></i> Photo
        </label>
        @if(!empty($myroomfeedback->roomfeedbackphoto))
          <div class="relative group">
            <img src="{{ $myroomfeedback->roomfeedbackphoto }}" alt="Feedback photo"
              class="w-full max-w-sm mx-auto rounded-lg shadow-md border border-gray-200 cursor-pointer hover:shadow-lg transition"
              onclick="openImageModal('{{ $myroomfeedback->roomfeedbackphoto }}', {{ $myroomfeedback->roomfeedbackID }})">
            <div
              class="absolute inset-0  bg-opacity-0 group-hover:bg-opacity-10 transition-all duration-200 rounded-lg flex items-center justify-center">
              <i
                class="fa-solid fa-search-plus text-white text-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-200"></i>
            </div>
          </div>
        
        @else
          <div
            class="p-4 border border-gray-200 rounded-xl bg-gray-50 text-sm text-gray-500 flex items-center justify-center gap-2">
            <i class="fa-regular fa-image text-lg" style="color: #cbd5e1;"></i>
            <span>No photo attached to this feedback.</span>
          </div>
        @endif
      </div>

      <!-- Hotel Staff Response -->
      <div class="mt-6">
        <label class="block text-sm font-medium text-gray-600 mb-2">
          <i class="fa-solid fa-reply mr-1" style="color: #F7B32B;"></i> Hotel Response
        </label>
        @if(!empty($myroomfeedback->roomfeedbackresponse))
          <div class="p-4 border border-gray-200 rounded-xl bg-gray-50 text-sm text-gray-700">
            {{ $myroomfeedback->roomfeedbackresponse }}
          </div>
        @else
          <div class="p-4 border border-gray-200 rounded-xl bg-gray-50 text-sm text-gray-500 flex items-center gap-2">
            <i class="fa-regular fa-envelope-open text-lg" style="color: #F7B32B;"></i>
            <span>No response yet from the hotel staff.</span>
          </div>
        @endif
      </div>

    </div> <!-- end scrollable wrapper -->

    <!-- Footer buttons (fixed at bottom) -->
    <div class="flex justify-end gap-3 border-t px-5 py-3 bg-white">
      <button type="button"
        onclick="document.getElementById('viewFeedbackModal-{{ $myroomfeedback->roomfeedbackID }}').close()"
        class="btn px-5 py-2.5 rounded-xl border border-gray-300 text-gray-700 hover:bg-gray-100 transition">
        Close
      </button>
    </div>
  </div>

  <!-- Modal backdrop -->
  <form method="dialog" class="modal-backdrop">
    <button>close</button>
  </form>
</dialog>

<!-- Image Preview Modal -->
<dialog id="imagePreviewModal-{{ $myroomfeedback->roomfeedbackID }}" class="modal">
  <div class="modal-box max-w-4xl w-full p-0 bg-transparent shadow-none">
    <div class="relative">
      <!-- Close button -->
      <button type="button"
        onclick="document.getElementById('imagePreviewModal-{{ $myroomfeedback->roomfeedbackID }}').close()"
        class="absolute -top-10 right-0 text-white hover:text-gray-300 transition z-10">
        <i class="fa-solid fa-xmark text-3xl"></i>
      </button>

      <!-- Image -->
      <img id="previewImage-{{ $myroomfeedback->roomfeedbackID }}" src="" alt="Full size preview"
        class="w-full h-auto rounded-lg shadow-2xl">
    </div>
  </div>

  <!-- Modal backdrop -->
  <form method="dialog" class="modal-backdrop bg-black bg-opacity-75">
    <button>close</button>
  </form>
</dialog>

<script>
  function openImageModal(imageUrl, feedbackId) {
    const modal = document.getElementById(`imagePreviewModal-${feedbackId}`);
    const image = document.getElementById(`previewImage-${feedbackId}`);

    if (modal && image) {
      image.src = imageUrl;
      modal.showModal();
    }
  }
</script>