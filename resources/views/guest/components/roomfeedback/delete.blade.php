
<dialog id="deleteFeedbackModal-{{ $myroomfeedback->roomfeedbackID }}" class="modal">
  <div class="modal-box w-full max-w-md md:max-w-lg rounded-xl p-5 md:p-6 relative overflow-visible">
    
    <!-- Header -->
    <div class="text-center mb-4">
      <div class="inline-flex items-center justify-center w-16 h-16 rounded-full mb-3" style="background-color: #001f54;">
        <i class="fa-solid fa-trash text-2xl" style="color: #F7B32B;"></i>
      </div>
      <h3 class="text-2xl font-bold mb-1" style="color: #001f54;">Delete Feedback</h3>
      <p class="text-sm text-gray-500">Are you sure you want to delete your feedback for this room?</p>
    </div>

    <!-- Room Info -->
    <div class="flex items-start gap-4 mb-4">
      <img src="{{ asset($myroomfeedback->roomphoto) }}" 
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

    <!-- Delete Confirmation -->
    <form method="POST" action="/deleteroomfeedback/{{$myroomfeedback->roomfeedbackID}}">
      @csrf
      @method('DELETE')

      <div class="flex justify-end gap-3 pt-2">
        <button type="button" 
                onclick="document.getElementById('deleteFeedbackModal-{{ $myroomfeedback->roomfeedbackID }}').close()" 
                class="btn px-5 py-2.5 rounded-xl border border-gray-300 text-gray-700 hover:bg-gray-100 transition">
          Cancel
        </button>
        <button type="submit" 
                class="btn bg-red-600 text-white px-6 py-2.5 rounded-xl shadow hover:bg-red-700 hover:shadow-md transition-all duration-300">
          Delete
        </button>
      </div>
    </form>
  </div>

  <!-- Modal backdrop -->
  <form method="dialog" class="modal-backdrop">
    <button>close</button>
  </form>
</dialog>
