  <dialog id="createFeedbackModal" class="modal">
    <div class="modal-box w-full max-w-md md:max-w-lg rounded-xl p-5 md:p-6 relative overflow-visible">
      <!-- Close button -->
      
      <!-- Header -->
      <div class="text-center mb-4">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full mb-3" style="background-color: #001f54;">
          <i class="fa-solid fa-star text-2xl" style="color: #F7B32B;"></i>
        </div>
        <h3 class="text-2xl font-bold mb-1" style="color: #001f54;">Tell Us About Your Stay</h3>
        <p class="text-sm text-gray-500">We appreciate your time in helping us serve you better.</p>
      </div>

      <form method="POST" action="/submitroomfeedback" class="space-y-5 mt-6">
        @csrf

        <!-- Select Room -->
<!-- Select Room -->
<div class="dropdown w-full">
  <input type="hidden" name="roomID" id="selectedRoom" required>

  <label tabindex="0" id="roomDropdownBtn" class="btn w-full justify-between">
    Choose a room
    <i class="fa-solid fa-chevron-down ml-2"></i>
  </label>

  <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-white rounded-xl w-full max-h-64 overflow-y-auto z-10">
    @foreach($reserverooms as $room)
      <li>
        <a href="javascript:void(0)" 
           onclick="selectRoom('{{ $room->roomID }}', '{{ $room->roomtype }}')">
          {{ $room->roomtype }} - #{{ $room->roomID }} <br>
          <span class="text-xs text-gray-500">
            {{ \Carbon\Carbon::parse($room->reservation_created_at)->format('M d, Y h:i A') }}
            ({{ \Carbon\Carbon::parse($room->reservation_created_at)->diffForHumans() }})
          </span>
        </a>
      </li>
    @endforeach
  </ul>
</div>

<script>
  function selectRoom(roomID, roomType) {
    // set hidden input value
    document.getElementById('selectedRoom').value = roomID;

    // update button text
    document.getElementById('roomDropdownBtn').innerHTML = roomType + ' - #' + roomID + 
      '<i class="fa-solid fa-chevron-down ml-2"></i>';
  }
</script>


        <!-- Rating -->
        <div class="py-2">
          <label class="block text-sm font-medium text-gray-600 mb-3 text-center">
            How would you rate your stay?
          </label>
          <div class="flex justify-center gap-1 mb-2" id="rating-stars">
            @for ($i = 1; $i <= 5; $i++)
              <label class="cursor-pointer transform hover:scale-110 transition-transform duration-200">
                <input type="radio" name="roomrating" value="{{ $i }}" class="hidden peer" required>
                <i class="fa-regular fa-star text-4xl peer-checked:fa-solid" style="color: #F7B32B;"></i>
              </label>
            @endfor
          </div>
          <div class="text-center text-xs text-gray-500 mt-1" id="rating-text">
            Tap a star to rate
          </div>
        </div>

        <!-- Feedback Text -->
        <div>
          <label class="block text-sm font-medium text-gray-600 mb-2">
            <i class="fa-solid fa-comment mr-1" style="color: #F7B32B;"></i> Your Feedback
          </label>
          <textarea name="roomfeedbackfeedback" class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition" rows="4" placeholder="What did you enjoy most about your stay? Is there anything we could improve?" required></textarea>
          <div class="text-xs text-gray-500 text-right mt-1">Minimum 20 characters</div>
        </div>

        <!-- Buttons -->
        <div class="flex justify-end gap-3 pt-2">
          <button type="button" onclick="createFeedbackModal.close()" class="btn px-5 py-2.5 rounded-xl border border-gray-300 text-gray-700 hover:bg-gray-100 transition">Cancel</button>
          <button type="submit" class="btn btn-primary px-6 py-2.5 rounded-xl shadow hover:shadow-md transition-all duration-300">
            Submit Feedback
          </button>
        </div>
      </form>
    </div>
    
    <!-- Modal backdrop -->
    <form method="dialog" class="modal-backdrop">
      <button>close</button>
    </form>
  </dialog>