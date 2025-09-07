<!-- Create Facility Modal -->
<dialog id="create_facility_modal" class="modal">
  <div class="modal-box max-w-3xl bg-white rounded-2xl shadow-xl">
    <!-- Modal Header -->
    <h3 class="font-bold text-2xl text-blue-900 mb-4">Create Facility</h3>

    <!-- Form -->
    <form method="POST" action="/facilities" enctype="multipart/form-data" class="space-y-4">
      @csrf

      <!-- Grid Layout -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Facility Name -->
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-1">Facility Name</label>
          <input type="text" name="facility_name" placeholder="Enter facility name"
                 class="input input-bordered w-full rounded-xl focus:border-yellow-400 focus:ring focus:ring-yellow-200" required>
        </div>

        <!-- Capacity -->
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-1">Capacity</label>
          <input type="number" name="facility_capacity" placeholder="e.g. 150"
                 class="input input-bordered w-full rounded-xl focus:border-yellow-400 focus:ring focus:ring-yellow-200">
        </div>
      </div>

      <!-- Type -->
      <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Facility Type</label>
        <select name="facility_type"
                class="select select-bordered w-full rounded-xl focus:border-yellow-400 focus:ring focus:ring-yellow-200">
          <option value="Event">Event</option>
          <option value="Conference">Conference</option>
        </select>
      </div>

      <!-- Amenities (Dynamic Fields) -->
      <div>
        <label class="block text-sm font-semibold text-gray-700 mb-2">Amenities</label>
        <div id="facility_amenities_wrapper" class="space-y-2">
          <div class="flex gap-2">
            <input type="text" name="facility_amenities[]" placeholder="Enter an amenity"
                   class="input input-bordered w-full rounded-xl focus:border-yellow-400 focus:ring focus:ring-yellow-200">
            <button type="button" class="btn btn-success rounded-xl" onclick="addAmenity()">+</button>
          </div>
        </div>
      </div>

      <!-- Facility Photo -->
      <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Facility Photo</label>
        <input type="file" name="facility_photo" id="create_facility_photo" accept="image/*"
               class="file-input file-input-bordered w-full rounded-xl focus:border-yellow-400 focus:ring focus:ring-yellow-200"
               onchange="previewFacilityPhoto(event)">
        <!-- Preview -->
        <div class="mt-3 flex justify-center">
          <img id="create_facility_photo_preview" src="" alt="Photo Preview"
               class="hidden max-h-40 rounded-xl border border-gray-200 shadow-sm">
        </div>
      </div>

      <!-- Description -->
      <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Description</label>
        <textarea name="facility_description" rows="4" placeholder="Write a short description..."
                  class="textarea textarea-bordered w-full rounded-xl focus:border-yellow-400 focus:ring focus:ring-yellow-200"></textarea>
      </div>

      <!-- Action Buttons -->
      <div class="modal-action flex justify-end gap-3">
        <button type="button" class="btn rounded-xl" onclick="create_facility_modal.close()">Cancel</button>
        <button type="submit" class="btn btn-primary">Create</button>
      </div>
    </form>
  </div>
</dialog>

<!-- Scripts -->
<script>
  // Add new amenity input
  function addAmenity() {
    const wrapper = document.getElementById('facility_amenities_wrapper');
    const div = document.createElement('div');
    div.classList.add('flex', 'gap-2');

    div.innerHTML = `
      <input type="text" name="facility_amenities[]" placeholder="Enter an amenity"
             class="input input-bordered w-full rounded-xl focus:border-yellow-400 focus:ring focus:ring-yellow-200">
      <button type="button" class="btn btn-error rounded-xl" onclick="this.parentElement.remove()">-</button>
    `;

    wrapper.appendChild(div);
  }

  // Preview facility photo
  function previewFacilityPhoto(event) {
    const input = event.target;
    const preview = document.getElementById('create_facility_photo_preview');

    if (input.files && input.files[0]) {
      const reader = new FileReader();
      reader.onload = function(e) {
        preview.src = e.target.result;
        preview.classList.remove('hidden');
      }
      reader.readAsDataURL(input.files[0]);
    } else {
      preview.src = '';
      preview.classList.add('hidden');
    }
  }
</script>
