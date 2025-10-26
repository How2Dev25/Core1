<!-- Edit Facility Modal -->
<dialog id="edit_facility_modal_{{ $facility->facilityID }}" class="modal">
  <div class="modal-box max-w-3xl bg-white rounded-2xl shadow-xl">
    <h3 class="font-bold text-2xl text-blue-900 mb-4">Edit Facility</h3>

    <form method="POST" action="/facilitymodify/{{ $facility->facilityID }}" enctype="multipart/form-data"
      class="space-y-4">
      @csrf
      @method('PUT')

      <!-- Facility Name + Capacity -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-1">Facility Name</label>
          <input type="text" name="facility_name" value="{{ $facility->facility_name }}"
            class="input input-bordered w-full rounded-xl focus:border-yellow-400 focus:ring focus:ring-yellow-200"
            required>
        </div>
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-1">Capacity</label>
          <input type="number" name="facility_capacity" value="{{ $facility->facility_capacity }}"
            class="input input-bordered w-full rounded-xl focus:border-yellow-400 focus:ring focus:ring-yellow-200">
        </div>
      </div>

      <!-- Type -->
      <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Facility Type</label>

        <select id="facilityType_{{ $facility->facilityID }}" name="facility_type"
          class="select select-bordered w-full rounded-xl focus:border-yellow-400 focus:ring focus:ring-yellow-200">
          <option value="Event" {{ $facility->facility_type == 'Event' ? 'selected' : '' }}>Event</option>
          <option value="Conference" {{ $facility->facility_type == 'Conference' ? 'selected' : '' }}>Conference</option>
          <option value="Others" {{ !in_array($facility->facility_type, ['Event', 'Conference']) ? 'selected' : '' }}>
            Others</option>
        </select>

        <!-- Hidden input for "Others" -->
        <input id="otherFacility_{{ $facility->facilityID }}" type="text"
          name="{{ !in_array($facility->facility_type, ['Event', 'Conference']) ? 'facility_type' : '' }}"
          value="{{ !in_array($facility->facility_type, ['Event', 'Conference']) ? $facility->facility_type : '' }}"
          placeholder="Enter custom facility type"
          class="mt-2 w-full rounded-xl border border-gray-300 p-2 focus:border-yellow-400 focus:ring focus:ring-yellow-200 {{ !in_array($facility->facility_type, ['Event', 'Conference']) ? '' : 'hidden' }}">
      </div>

      <script>
        // Unique per modal to avoid conflicts
        const facilitySelect_{{ $facility->facilityID }} = document.getElementById('facilityType_{{ $facility->facilityID }}');
        const otherInput_{{ $facility->facilityID }} = document.getElementById('otherFacility_{{ $facility->facilityID }}');

        facilitySelect_{{ $facility->facilityID }}.addEventListener('change', () => {
          if (facilitySelect_{{ $facility->facilityID }}.value === 'Others') {
            otherInput_{{ $facility->facilityID }}.classList.remove('hidden');
            otherInput_{{ $facility->facilityID }}.focus();
            facilitySelect_{{ $facility->facilityID }}.removeAttribute('name');
            otherInput_{{ $facility->facilityID }}.setAttribute('name', 'facility_type');
          } else {
            otherInput_{{ $facility->facilityID }}.classList.add('hidden');
            otherInput_{{ $facility->facilityID }}.value = '';
            otherInput_{{ $facility->facilityID }}.removeAttribute('name');
            facilitySelect_{{ $facility->facilityID }}.setAttribute('name', 'facility_type');
          }
        });
      </script>
      <!-- Amenities -->
      <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Amenities</label>
        <div id="facility_amenities_wrapper_{{ $facility->facilityID }}" class="flex flex-col gap-2">
          @forelse($facility->facility_amenities ?? [] as $amenity)
            <div class="flex gap-2">
              <input type="text" name="facility_amenities[]" value="{{ $amenity }}"
                class="input input-bordered w-full rounded-xl focus:border-yellow-400 focus:ring focus:ring-yellow-200">
              <button type="button" onclick="this.parentNode.remove()" class="btn btn-sm btn-error">-</button>
            </div>
          @empty
            <!-- Show one empty input if no amenities exist -->
            <div class="flex gap-2">
              <input type="text" name="facility_amenities[]" placeholder="Enter an amenity"
                class="input input-bordered w-full rounded-xl focus:border-yellow-400 focus:ring focus:ring-yellow-200">
              <button type="button" onclick="this.parentNode.remove()" class="btn btn-sm btn-error">-</button>
            </div>
          @endforelse

          <!-- Add button -->
          <div>
            <button type="button" onclick="addFacilityAmenity({{ $facility->facilityID }})"
              class="btn btn-sm btn-primary mt-2">+ Add Amenity</button>
          </div>
        </div>
      </div>

      <!-- Facility Photo -->
      <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Facility Photo</label>
        <input type="file" name="facility_photo" id="edit_facility_photo_{{ $facility->facilityID }}" accept="image/*"
          class="file-input file-input-bordered w-full rounded-xl focus:border-yellow-400 focus:ring focus:ring-yellow-200"
          data-preview="edit_facility_photo_preview_{{ $facility->facilityID }}" onchange="previewFacilityPhoto(event)">
        <div class="mt-3 flex justify-center">
          <img id="edit_facility_photo_preview_{{ $facility->facilityID }}"
            src="{{ $facility->facility_photo ? asset($facility->facility_photo) : '' }}" alt="Photo Preview"
            class="{{ $facility->facility_photo ? '' : 'hidden' }} max-h-40 rounded-xl border border-gray-200 shadow-sm">
        </div>
      </div>

      <!-- Description -->
      <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Description</label>
        <textarea name="facility_description" rows="4"
          class="textarea textarea-bordered w-full rounded-xl focus:border-yellow-400 focus:ring focus:ring-yellow-200">{{ $facility->facility_description }}</textarea>
      </div>

      <!-- Action Buttons -->
      <div class="modal-action flex justify-end gap-3">
        <button type="button" class="btn rounded-xl"
          onclick="edit_facility_modal_{{ $facility->facilityID }}.close()">Cancel</button>
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
    </form>
  </div>
</dialog>
<script>
  function addModifyInput(wrapperId, name, placeholder) {
    const wrapper = document.getElementById(wrapperId);
    const div = document.createElement('div');
    div.classList.add('flex', 'gap-2', 'mt-1');
    div.innerHTML = `
    <input type="text" name="${name}" placeholder="${placeholder}" 
           class="input input-bordered w-full rounded-xl focus:border-yellow-400 focus:ring focus:ring-yellow-200">
    <button type="button" onclick="this.parentNode.remove()" class="btn btn-sm btn-error">-</button>
  `;
    wrapper.insertBefore(div, wrapper.lastElementChild); // insert before the + button
  }

  function addFacilityAmenity(id) {
    addModifyInput(`facility_amenities_wrapper_${id}`, 'facility_amenities[]', 'Enter an amenity');
  }

  function previewFacilityPhoto(event) {
    const input = event.target;
    const previewId = input.dataset.preview;
    const preview = document.getElementById(previewId);
    if (!preview) return;

    const file = input.files && input.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = e => {
        preview.src = e.target.result;
        preview.classList.remove('hidden');
      };
      reader.readAsDataURL(file);
    } else {
      preview.removeAttribute('src');
      preview.classList.add('hidden');
    }
  }

</script>