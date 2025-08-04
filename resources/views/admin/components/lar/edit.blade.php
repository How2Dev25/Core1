<dialog id="edit_lar_{{$points->loyaltyID}}" class="modal">
  <div class="modal-box w-11/12 max-w-5xl">
    <h3 class="text-lg font-bold">Modify Loyalty Reward</h3>
    
    <form method="POST" action="/editlar/{{$points->loyaltyID}}" class="mt-6 space-y-4">
      @csrf
      @method('PUT')
      
      <!-- Room Selection -->
      <div class="form-control w-full">
        <label class="label" for="roomID">
          <span class="label-text">Change Room</span>
        </label>
        <select 
          id="roomID" 
          name="roomID" 
          class="select select-bordered w-full"
          required
        >
          <option disabled>Choose a room</option>
          <option selected value="{{$points->roomID}}">Room #{{$points->roomID}} - {{$points->roomtype}}</option>
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
          value="{{$points->loyalty_description}}"
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
          value="{{$points->loyalty_value}}"
        >
      </div>

      <!-- Form Actions -->
      <div class="modal-action">
        <button type="button" onclick="edit_lar_{{$points->loyaltyID}}.close()" class="btn btn-ghost">
          Cancel
        </button>
        <button type="submit" class="btn btn-primary">
          Save Changes
        </button>
      </div>
    </form>
  </div>

  <!-- Click outside to close -->
  <form method="dialog" class="modal-backdrop">
    <button>close</button>
  </form>
</dialog>