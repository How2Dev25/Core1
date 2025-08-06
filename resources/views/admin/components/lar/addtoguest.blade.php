<dialog id="guest_lar_{{$points->loyaltyID}}" class="modal">
  <div class="modal-box w-11/12 max-w-5xl">
    <h3 class="text-lg font-bold">Add Reward To Guest</h3>
    
    <form method="POST" action="/guestadd/{{$points->loyaltyID}}" class="mt-6 space-y-4">
      @csrf
      <input type="hidden" name="loyaltyID" value="{{$points->loyaltyID}}">
      
      <!-- Option 1: Select by Guest ID -->
      <div class="form-control w-full">
        <label class="label">
          <span class="label-text">Select Guest</span>
        </label>
        <select name="guestID" class="select select-bordered w-full">
          <option value="1">1</option>
          <option value="1">2</option>
          <option value="1">3</option>
        </select>
        <div class="divider">OR</div>
      </div>

      <!-- Option 2: Enter Email -->
      <div class="form-control w-full">
        <label class="label">
          <span class="label-text">Enter Guest Email</span>
        </label>
        <input 
          type="email" 
          name="guestEmail" 
          placeholder="guest@example.com"
          class="input input-bordered w-full"
        >
      </div>

    

      <!-- Form Actions -->
      <div class="modal-action">
        <button type="button" onclick="guest_lar_{{$points->loyaltyID}}.close()" class="btn btn-ghost">
          Cancel
        </button>
        <button type="submit" class="btn btn-success">
          Assign Reward
        </button>
      </div>
    </form>
  </div>

  <!-- Click outside to close -->
  <form method="dialog" class="modal-backdrop">
    <button>close</button>
  </form>
</dialog>