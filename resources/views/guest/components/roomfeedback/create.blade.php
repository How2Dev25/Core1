<dialog id="createFeedbackModal" class="modal">
  <div class="modal-box w-full max-w-sm sm:max-w-md md:max-w-lg lg:max-w-xl rounded-xl p-0 relative overflow-hidden">

    <!-- Scrollable content wrapper -->
    <div class="max-h-[75vh] overflow-y-auto p-4 sm:p-6 space-y-5">

      <!-- Header -->
      <div class="text-center mb-4">
        <div class="inline-flex items-center justify-center w-14 h-14 sm:w-16 sm:h-16 rounded-full mb-3" style="background-color: #001f54;">
          <i class="fa-solid fa-star text-xl sm:text-2xl" style="color: #F7B32B;"></i>
        </div>
        <h3 class="text-xl sm:text-2xl font-bold mb-1" style="color: #001f54;">Tell Us About Your Stay</h3>
        <p class="text-xs sm:text-sm text-gray-500">We appreciate your time in helping us serve you better.</p>
      </div>

      <!-- Form -->
      <form method="POST" action="/submitroomfeedback" class="space-y-5 mt-4">
        @csrf

        <!-- Select Room -->
<div class="relative w-full">
  <input type="hidden" name="roomID" id="selectedRoom" required>

  <!-- Trigger button -->
  <button type="button"
          id="roomDropdownBtn"
          onclick="toggleRoomList()"
          class="btn w-full justify-between px-4 py-3 text-sm sm:text-base">
    Choose a room
    <i class="fa-solid fa-chevron-down ml-2"></i>
  </button>

  <!-- Dropdown list (inside modal, scrollable) -->
  <div id="roomList"
       class="absolute left-0 right-0 mt-2 hidden 
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

<script>
  function toggleRoomList() {
    document.getElementById('roomList').classList.toggle('hidden');
  }

  function selectRoom(roomID, roomType) {
    document.getElementById('selectedRoom').value = roomID;
    document.getElementById('roomDropdownBtn').innerHTML = roomType + ' - #' + roomID +
      '<i class="fa-solid fa-chevron-down ml-2"></i>';
  }
</script>

        <!-- Rating -->
        <div class="py-2">
          <label class="block text-sm font-medium text-gray-600 mb-3 text-center">
            How would you rate your stay?
          </label>
          <div class="flex justify-center gap-1 mb-2">
            @for ($i = 1; $i <= 5; $i++)
              <label class="cursor-pointer transform hover:scale-110 transition-transform duration-200">
                <input type="radio" name="roomrating" value="{{ $i }}" class="hidden peer" required>
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
          <textarea name="roomfeedbackfeedback" class="w-full border border-gray-200 rounded-xl px-3 sm:px-4 py-2 sm:py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition text-sm sm:text-base" rows="4" placeholder="What did you enjoy most about your stay? Is there anything we could improve?" required></textarea>
          <div class="text-xs text-gray-500 text-right mt-1">Minimum 20 characters</div>
        </div>

        <!-- Buttons -->
        <div class="flex flex-col sm:flex-row justify-end gap-2 sm:gap-3 pt-2">
          <button type="button" onclick="createFeedbackModal.close()" class="btn w-full sm:w-auto px-4 sm:px-5 py-2.5 rounded-xl border border-gray-300 text-gray-700 hover:bg-gray-100 transition">
            Cancel
          </button>
          <button type="submit" class="btn btn-primary w-full sm:w-auto px-5 sm:px-6 py-2.5 rounded-xl shadow hover:shadow-md transition-all duration-300">
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
