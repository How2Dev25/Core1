
<dialog id="editFeedbackModal-{{ $myroomfeedback->roomfeedbackID }}" class="modal">
  <div class="modal-box w-full max-w-md md:max-w-lg rounded-xl p-5 md:p-6 relative overflow-visible">
      <div class="max-h-[80vh] overflow-y-auto p-5 md:p-6 space-y-5">
    <!-- Header -->
    <div class="text-center mb-4">
      <div class="inline-flex items-center justify-center w-16 h-16 rounded-full mb-3" style="background-color: #001f54;">
        <i class="fa-solid fa-pen-to-square text-2xl" style="color: #F7B32B;"></i>
      </div>
      <h3 class="text-2xl font-bold mb-1" style="color: #001f54;">Edit Your Feedback</h3>
      <p class="text-sm text-gray-500">Update your feedback for this room.</p>
    </div>

    <form method="POST" action="/updateroomfeedback/{{$myroomfeedback->roomfeedbackID}}" class="space-y-5 mt-6">
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
        <div class="flex justify-center gap-1 mb-2" id="rating-stars">
          @for ($i = 1; $i <= 5; $i++)
            <label class="cursor-pointer transform hover:scale-110 transition-transform duration-200">
              <input type="radio" 
                     name="roomrating" 
                     value="{{ $i }}" 
                     class="hidden peer"
                     {{ $myroomfeedback->roomrating == $i ? 'checked' : '' }}
                     required>
              <i class="fa-regular fa-star text-4xl peer-checked:fa-solid" style="color: #F7B32B;"></i>
            </label>
          @endfor
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

      <!-- Buttons -->
      <div class="flex justify-end gap-3 pt-2">
        <button type="button" onclick="document.getElementById('editFeedbackModal-{{ $myroomfeedback->roomfeedbackID }}').close()" 
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

