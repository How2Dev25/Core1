<dialog id="create_lar" class="modal">
  <div class="modal-box w-11/12 max-w-5xl">
    <h3 class="text-lg font-bold">Create Loyalty Reward</h3>
    
    <form method="POST" action="/createlar" class="mt-6 space-y-4">
      @csrf
      
      <!-- Room Selection -->
      <div class="form-control w-full">
        <label class="label" for="roomID">
          <span class="label-text">Select Room</span>
        </label>
        <select 
          id="roomID" 
          name="roomID" 
          class="select select-bordered w-full"
          required
        >
          <option disabled selected>Choose a room</option>
          @foreach($rooms as $room)
            <option value="{{ $room->roomID }}">Room #{{ $room->roomID }} - {{$room->roomtype}}</option>
          @endforeach
        </select>
      </div>

      <!-- Description Field -->
      <div class="form-control w-full">
        <label class="label" for="loyalty_description">
          <span class="label-text">Reward Description</span>
        </label>
        <input 
          type="text" 
          id="loyalty_description" 
          name="loyalty_description" 
          placeholder="Enter reward description"
          class="input input-bordered w-full"
          required
        >
      </div>

      <!-- Value Field -->
      <div class="form-control w-full">
        <label class="label" for="loyalty_value">
          <span class="label-text">Reward Value</span>
        </label>
        <input 
          type="number" 
          id="loyalty_value" 
          name="loyalty_value" 
          placeholder="Enter reward value"
          class="input input-bordered w-full"
          required
          step="0.01"
          min="0"
        >
      </div>

      <!-- Form Actions -->
      <div class="modal-action">
        <button type="button" onclick="create_lar.close()" class="btn btn-ghost">
          Cancel
        </button>
        <button type="submit" class="btn btn-primary">
          Create Reward
        </button>
      </div>
    </form>
  </div>

  <!-- Click outside to close -->
  <form method="dialog" class="modal-backdrop">
    <button>close</button>
  </form>
</dialog>