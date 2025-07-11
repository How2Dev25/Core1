<dialog id="room_modal" class="modal">
  <div class="modal-box max-w-4xl">
    <form method="dialog">
      <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
    </form>
    <h3 class="font-bold text-lg mb-6">Add New Room</h3>
    
  <form method="POST" action="/createroom" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-6">
  @csrf

  <!-- Room Details -->
  <div class="space-y-4">
    <div>
      <label class="label">Room Type</label>
      <select name="roomtype" class="select select-bordered w-full">
        <option disabled selected>Select type</option>
        <option value="Standard">Standard</option>
        <option value="Deluxe">Deluxe</option>
        <option value="Suite">Suite</option>
        <option value="Executive">Executive</option>
      </select>
    </div>

    <div>
      <label class="label">Floor</label>
      <input type="number" name="roomfloor" class="input input-bordered w-full" placeholder="Enter floor number">
    </div>

    <div>
      <label class="label">Max Guests</label>
      <input type="number" name="roommaxguest" class="input input-bordered w-full" placeholder="Number of guests">
    </div>

    <div>
      <label class="label">Room Status</label>
      <select name="roomstatus" class="select select-bordered w-full">
        <option disabled selected>Select status</option>
        <option value="Available">Available</option>
        <option value="Occupied">Occupied</option>
        <option value="Maintenance">Maintenance</option>
        <option value="Reserved">Reserved</option>
      </select>
    </div>
  </div>

  <!-- Room Features -->
  <div class="space-y-4">
    <div>
      <label class="label">Base Price (per night)</label>
      <div class="relative">
        <span class="absolute left-3 top-3 text-gray-500">$</span>
        <input type="number" name="roomprice" class="input input-bordered w-full pl-8" placeholder="e.g. 1000">
      </div>
    </div>

    <div>
      <label class="label">Room Size</label>
      <div class="relative">
        <input type="number" name="roomsize" class="input input-bordered w-full pr-12" placeholder="e.g. 25">
        <span class="absolute right-3 top-3 text-gray-500">sqft</span>
      </div>
    </div>

    <div>
      <label class="label" for="roomfeatures">
        <span class="label-text">Room Features</span>
      </label>
      <textarea
        name="roomfeatures"
        id="roomfeatures"
        class="textarea textarea-bordered w-full"
        placeholder="Example: Ocean View, Balcony, Mini Bar"
        rows="3"
      ></textarea>
    </div>

    <div>
      <label class="label">Room Photo</label>
      <input id="dropzone-file" type="file" name="roomphoto" class="file-input file-input-bordered w-full">
    </div>

    <div class="flex justify-center items-center">
      <img id="photo" class="w-full max-h-60 rounded-md shadow-md object-cover" src="{{ asset('images/defaults/default.jpg') }}" alt="Room preview">
    </div>
  </div>

  <!-- Description -->
  <div class="md:col-span-2">
    <label class="label">Room Description</label>
    <textarea name="roomdescription" class="textarea textarea-bordered w-full" rows="3" placeholder="Describe the room..."></textarea>
  </div>

  <!-- Buttons -->
  <div class="md:col-span-2 flex justify-end gap-3">
    <button type="button" class="btn btn-outline" onclick="room_modal.close()">Cancel</button>
    <button type="submit" class="btn btn-primary">Save Room</button>
  </div>
</form>

  </div>
</dialog>