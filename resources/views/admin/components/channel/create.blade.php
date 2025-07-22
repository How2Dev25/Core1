<dialog id="add_listing" class="modal">
  <div class="modal-box max-w-4xl">
    <div class="flex justify-between items-center mb-4">
      <h3 class="text-2xl font-bold flex items-center gap-2">
        <i data-lucide="plus-circle" class="w-6 h-6 text-primary"></i>
        Add Room to Listing
      </h3>
      <form method="dialog">
        <button class="btn btn-circle btn-ghost btn-sm">
          <i data-lucide="x" class="w-5 h-5"></i>
        </button>
      </form>
    </div>
    
    <form action="/createlisting" method="POST">
      @csrf
      <input type="hidden" name="roomID" id="selectedRoomID">
      
      <div class="bg-base-200 rounded-box p-5 mb-6">
        <h1 class="text-lg font-bold flex items-center gap-2 mb-3">
          <i data-lucide="list" class="w-5 h-5"></i>
          Available Rooms To List
        </h1>
        <div class="grid grid-cols-2 gap-5">
          @forelse ($rooms as $room)
            <div class="card bg-base-100 shadow-md hover:shadow-xl transition-all cursor-pointer group relative border-2 border-transparent hover:border-primary"
                 onclick="selectRoom(this, {{$room->roomID}})">
              <figure class="relative h-40 overflow-hidden rounded-t-box">
                <img class="w-full h-full object-cover group-hover:scale-105 transition-transform" 
                     src="{{ asset($room->roomphoto) }}" alt="Room image">
              </figure>
              <div class="card-body p-4">
                <div class="flex justify-between items-center">
                  <h2 class="card-title text-sm">Room #{{$room->roomID}} {{$room->roomtype}}</h2>
                  <span class="badge badge-primary badge-sm">{{$room->roomstatus}}</span>
                </div>
                <div class="flex items-center gap-1 text-xs text-base-content/60">
                  <i data-lucide="square" class="w-3 h-3"></i>
                  <span>{{$room->roomsize}} sq.ft</span>
                  <i data-lucide="users" class="w-3 h-3 ml-2"></i>
                  <span>{{$room->roommaxguest}} Guests</span>
                </div>
              </div>

              <!-- Selection Indicator -->
              <div class="absolute top-2 right-2 hidden z-10 bg-primary text-white rounded-full p-1 shadow-md selection-indicator">
                <i data-lucide="check" class="w-4 h-4"></i>
              </div>
            </div>
          @empty
            <div class="col-span-2 flex flex-col items-center justify-center py-12 text-center">
              <div class="p-4 rounded-full bg-base-200 mb-4">
                <i data-lucide="door-closed" class="w-12 h-12 text-base-content/40"></i>
              </div>
              <h3 class="text-lg font-medium mb-2">No rooms available</h3>
              <p class="text-base-content/60 max-w-md mx-auto mb-4">
                There are currently no rooms ready for listing. Add new rooms to get started.
              </p>
            </div>
          @endforelse
        </div>
      </div>

      <div class="grid grid-cols-1 gap-6 mb-6">
        <div class="form-control">
          <label class="label">
            <span class="label-text flex items-center gap-1">
              <i data-lucide="globe" class="w-4 h-4"></i>
              Channel
              <span class="text-error">*</span>
            </span>
          </label>
          <select name="channelName" class="select select-bordered w-full" required>
            <option disabled selected>Pick a Channel</option>
            <option value="Tarastay">Tarastay</option>
            <option value="Nestscape">Nestscape</option>
            <option value="Habistay">Habistay</option>
          </select>
        </div>
      </div>

      <div class="modal-action">
        <button onclick="add_listing.close()" type="button" class="btn btn-ghost">
          Cancel
        </button>
        <button type="submit" class="btn btn-primary gap-2">
          <i data-lucide="plus" class="w-5 h-5"></i>
          Add Listing
        </button>
      </div>
    </form>
  </div>

  <form method="dialog" class="modal-backdrop">
    <button>close</button>
  </form>
</dialog>

<!-- Lucide and Selection Script -->
<script>
  lucide.createIcons();

  function selectRoom(cardElement, roomID) {
    // Clear all previous selections
    document.querySelectorAll('#add_listing .card').forEach(card => {
      card.classList.remove('border-primary', 'border-2', 'bg-primary/10');
      const indicator = card.querySelector('.selection-indicator');
      if (indicator) indicator.classList.add('hidden');
    });

    // Highlight selected card
    cardElement.classList.add('border-primary', 'border-2', 'bg-primary/10');
    const selectedIndicator = cardElement.querySelector('.selection-indicator');
    if (selectedIndicator) selectedIndicator.classList.remove('hidden');

    // Set hidden input value
    document.getElementById('selectedRoomID').value = roomID;
  }
</script>
