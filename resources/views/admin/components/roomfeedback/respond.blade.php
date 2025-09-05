<dialog id="viewFeedbackModal-{{ $myroomfeedback->roomfeedbackID }}" class="modal">
  <div class="modal-box w-full max-w-md md:max-w-lg rounded-xl p-0 relative overflow-hidden">

    <!-- Scrollable content wrapper -->
    <div class="max-h-[80vh] overflow-y-auto p-5 md:p-6 space-y-5">

      <!-- Header -->
      <div class="text-center mb-4">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full mb-3" style="background-color: #001f54;">
          <i class="fa-solid fa-pen-to-square text-2xl" style="color: #F7B32B;"></i>
        </div>
        <h3 class="text-2xl font-bold mb-1" style="color: #001f54;">View Feedback</h3>
        <p class="text-sm text-gray-500">Guest feedback and your response.</p>
      </div>

      <!-- Guest & Room Info (Grid layout) -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-start">
        <!-- Guest -->
        <div class="flex items-center gap-3">
          <img src="{{ $myroomfeedback->guest_photo }}" 
               alt="Guest Photo"
               class="w-16 h-16 rounded-full object-cover shadow border">
          <div>
            <p class="font-semibold text-[#001f54] text-base">
              {{ $myroomfeedback->guest_name ?? 'Guest User' }}
            </p>
            <p class="text-xs text-gray-500">Guest</p>
          </div>
        </div>

        <!-- Room -->
        <div class="flex items-start gap-3">
          <img src="{{ $myroomfeedback->roomphoto }}" 
               alt="Room Image" 
               class="w-16 h-16 object-cover rounded-lg shadow border">
          <div>
            <p class="font-semibold text-[#001f54] text-base">
              {{ $myroomfeedback->roomtype }} - #{{ $myroomfeedback->roomID }}
            </p>
            <p class="text-xs text-gray-500">
              Feedback created {{ \Carbon\Carbon::parse($myroomfeedback->roomfeedbackdate)->diffForHumans() }}
            </p>
          </div>
        </div>
      </div>

      <!-- Rating -->
      <div class="py-2">
        <label class="block text-sm font-medium text-gray-600 mb-3 text-center">
          Rating
        </label>
        <div class="flex justify-center gap-1 mb-2">
          @for ($i = 1; $i <= 5; $i++)
            <i class="fa-star text-2xl {{ $myroomfeedback->roomrating >= $i ? 'fa-solid' : 'fa-regular' }}" style="color: #F7B32B;"></i>
          @endfor
        </div>
      </div>

      <!-- Feedback Text -->
      <div>
        <label class="block text-sm font-medium text-gray-600 mb-2">
          <i class="fa-solid fa-comment mr-1" style="color: #F7B32B;"></i> Guest Feedback
        </label>
        <div class="p-4 border border-gray-200 rounded-xl bg-gray-50 text-sm text-gray-700">
          {{ $myroomfeedback->roomfeedbackfeedback }}
        </div>
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

      <!-- Reply Form (Admin side) -->
      <form action="/feedbackrespond/{{$myroomfeedback->roomfeedbackID}}" method="POST" class="mt-4 space-y-3">
        @csrf
        @method('PUT')
        <textarea name="roomfeedbackresponse" rows="3" 
                  class="w-full border border-gray-300 rounded-lg p-3 text-sm focus:ring-2 focus:ring-[#001f54]" 
                  placeholder="Write your reply..."></textarea>
        <button type="submit" 
                class="btn btn-primary w-full">
          Send Reply
        </button>
      </form>

    </div> <!-- end scrollable wrapper -->

    <!-- Footer buttons (fixed at bottom) -->
    <div class="flex justify-end gap-3 border-t px-5 py-3 bg-white">
      <button type="button" onclick="document.getElementById('viewFeedbackModal-{{ $myroomfeedback->roomfeedbackID }}').close()" 
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
