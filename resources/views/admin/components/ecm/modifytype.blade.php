<!-- Modify Event Type Modal -->
<dialog id="modify_eventtype_modal_{{ $eventtype->eventtype_ID }}" class="modal">
  <div class="modal-box max-w-4xl bg-white rounded-2xl shadow-xl">
    <h3 class="font-bold text-2xl text-blue-900 mb-4">Modify Event Type</h3>

    <form method="POST" action="/updateecmtype/{{ $eventtype->eventtype_ID }}" enctype="multipart/form-data" class="grid grid-cols-1 gap-4 md:grid-cols-2">
        @csrf
        @method('PUT')

        <!-- Event Type Name -->
        <div class="col-span-1 md:col-span-2">
            <label class="block text-sm font-semibold text-gray-700 mb-1">Event Type Name</label>
            <input type="text" name="eventtype_name" value="{{ $eventtype->eventtype_name }}"
                   class="input input-bordered w-full rounded-xl focus:border-yellow-400 focus:ring focus:ring-yellow-200" required>
        </div>

        <!-- Event Type Photo -->
        <div class="col-span-1 md:col-span-2">
            <label class="block text-sm font-semibold text-gray-700 mb-1">Event Type Photo</label>
            <input type="file" id="modify_eventtype_photo_{{ $eventtype->eventtype_ID }}"
                   data-preview="modify_eventtype_photo_preview_{{ $eventtype->eventtype_ID }}"
                   accept="image/*" onchange="previewModifyEventPhoto(event)"
                   name="eventtype_photo"
                   class="file-input file-input-bordered w-full rounded-xl focus:border-yellow-400 focus:ring focus:ring-yellow-200">

            <div class="mt-3 flex justify-center items-center w-full">
              <img id="modify_eventtype_photo_preview_{{ $eventtype->eventtype_ID }}"
                   class="modify-eventtype-photo-preview max-h-40 rounded-xl object-cover {{ $eventtype->eventtype_photo ? '' : 'hidden' }}"
                   src="{{ $eventtype->eventtype_photo ? asset($eventtype->eventtype_photo) : '' }}"
                   alt="preview">
            </div>
        </div>

        <!-- Price -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Price</label>
            <input type="number" name="eventtype_price" value="{{ $eventtype->eventtype_price }}"
                   class="input input-bordered w-full rounded-xl focus:border-yellow-400 focus:ring focus:ring-yellow-200" required>
        </div>

        <!-- Capacity -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Capacity</label>
            <input type="number" name="eventtype_capacity" value="{{ $eventtype->eventtype_capacity }}"
                   class="input input-bordered w-full rounded-xl focus:border-yellow-400 focus:ring focus:ring-yellow-200">
        </div>

        <!-- Facility -->
     <!-- Facility -->
<div class="col-span-1 md:col-span-2">
  <label class="block text-sm font-semibold text-gray-700 mb-1">Facility / Room</label>
  <select name="facilityID" 
          id="modify_facility_select_{{ $eventtype->eventtype_ID }}" 
          class="select select-bordered w-full rounded-xl focus:border-yellow-400 focus:ring focus:ring-yellow-200"
          onchange="showModifyFacilityPhoto({{ $eventtype->eventtype_ID }})">
      <option value="">-- Select Facility --</option>
      @foreach($facilities as $facility)
          <option value="{{ $facility->facilityID }}" 
                  data-photo="{{ $facility->facility_photo ? asset($facility->facility_photo) : '' }}"
                  {{ $eventtype->facilityID == $facility->facilityID ? 'selected' : '' }}>
              {{ $facility->facility_name }}
          </option>
      @endforeach
  </select>

  <!-- Facility photo preview -->
  <div id="modify_facility_photo_container_{{ $eventtype->eventtype_ID }}" class="mt-4 flex justify-center">
    <img id="modify_facility_photo_preview_{{ $eventtype->eventtype_ID }}" 
         class="hidden max-h-40 rounded-xl border border-gray-200 shadow-sm object-cover"
         src="{{ $eventtype->facility && $eventtype->facility->facility_photo ? asset($eventtype->facility->facility_photo) : '' }}"
         alt="Facility Preview">
  </div>
</div>

        <!-- Duration -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Duration</label>
            <input type="text" name="eventtype_duration" value="{{ $eventtype->eventtype_duration }}"
                   class="input input-bordered w-full rounded-xl focus:border-yellow-400 focus:ring focus:ring-yellow-200">
        </div>

        <!-- Status -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Status</label>
            <select name="eventtype_status" class="select select-bordered w-full rounded-xl focus:border-yellow-400 focus:ring focus:ring-yellow-200">
                <option value="Active" {{ $eventtype->eventtype_status == 'Active' ? 'selected' : '' }}>Active</option>
                <option value="Inactive" {{ $eventtype->eventtype_status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <!-- Description -->
        <div class="col-span-1 md:col-span-2">
            <label class="block text-sm font-semibold text-gray-700 mb-1">Description</label>
            <textarea name="eventtype_description" rows="4"
                      class="textarea textarea-bordered w-full rounded-xl focus:border-yellow-400 focus:ring focus:ring-yellow-200"
                      required>{{ $eventtype->eventtype_description }}</textarea>
        </div>

        <!-- Amenities -->
        <div class="col-span-1 md:col-span-2">
            <label class="block text-sm font-semibold text-gray-700 mb-1">Amenities</label>
            <div id="amenities_wrapper_{{ $eventtype->eventtype_ID }}" class="flex flex-col gap-2">
                @foreach($eventtype->eventtype_amenities ?? [] as $amenity)
                <div class="flex gap-2">
                    <input type="text" name="eventtype_amenities[]" value="{{ $amenity }}"
                           class="input input-bordered w-full rounded-xl focus:border-yellow-400 focus:ring focus:ring-yellow-200">
                    <button type="button" onclick="this.parentNode.remove()" class="btn btn-sm btn-error">-</button>
                </div>
                @endforeach
                <div class="flex gap-2">
                    <input type="text" name="eventtype_amenities[]" placeholder="Enter an amenity"
                           class="input input-bordered w-full rounded-xl focus:border-yellow-400 focus:ring focus:ring-yellow-200">
                    <button type="button" onclick="addModifyAmenity({{ $eventtype->eventtype_ID }})" class="btn btn-sm">+</button>
                </div>
            </div>
        </div>

        <!-- Catering Options -->
        <div class="col-span-1 md:col-span-2">
            <label class="block text-sm font-semibold text-gray-700 mb-1">Catering Options</label>
            <div id="catering_wrapper_{{ $eventtype->eventtype_ID }}" class="flex flex-col gap-2">
                @foreach($eventtype->eventtype_catering_options ?? [] as $catering)
                <div class="flex gap-2">
                    <input type="text" name="eventtype_catering_options[]" value="{{ $catering }}"
                           class="input input-bordered w-full rounded-xl focus:border-yellow-400 focus:ring focus:ring-yellow-200">
                    <button type="button" onclick="this.parentNode.remove()" class="btn btn-sm btn-error">-</button>
                </div>
                @endforeach
                <div class="flex gap-2">
                    <input type="text" name="eventtype_catering_options[]" placeholder="Enter catering option"
                           class="input input-bordered w-full rounded-xl focus:border-yellow-400 focus:ring focus:ring-yellow-200">
                    <button type="button" onclick="addModifyCatering({{ $eventtype->eventtype_ID }})" class="btn btn-sm">+</button>
                </div>
            </div>
        </div>

        <!-- Theme Options -->
        <div class="col-span-1 md:col-span-2">
            <label class="block text-sm font-semibold text-gray-700 mb-1">Theme Options</label>
            <div id="theme_wrapper_{{ $eventtype->eventtype_ID }}" class="flex flex-col gap-2">
                @foreach($eventtype->eventtype_theme_options ?? [] as $theme)
                <div class="flex gap-2">
                    <input type="text" name="eventtype_theme_options[]" value="{{ $theme }}"
                           class="input input-bordered w-full rounded-xl focus:border-yellow-400 focus:ring focus:ring-yellow-200">
                    <button type="button" onclick="this.parentNode.remove()" class="btn btn-sm btn-error">-</button>
                </div>
                @endforeach
                <div class="flex gap-2">
                    <input type="text" name="eventtype_theme_options[]" placeholder="Enter theme option"
                           class="input input-bordered w-full rounded-xl focus:border-yellow-400 focus:ring focus:ring-yellow-200">
                    <button type="button" onclick="addModifyTheme({{ $eventtype->eventtype_ID }})" class="btn btn-sm">+</button>
                </div>
            </div>
        </div>

        <!-- Extra Services -->
        <div class="col-span-1 md:col-span-2">
            <label class="block text-sm font-semibold text-gray-700 mb-1">Extra Services</label>
            <div id="extra_wrapper_{{ $eventtype->eventtype_ID }}" class="flex flex-col gap-2">
                @foreach($eventtype->eventtype_extra_services ?? [] as $extra)
                <div class="flex gap-2">
                    <input type="text" name="eventtype_extra_services[]" value="{{ $extra }}"
                           class="input input-bordered w-full rounded-xl focus:border-yellow-400 focus:ring focus:ring-yellow-200">
                    <button type="button" onclick="this.parentNode.remove()" class="btn btn-sm btn-error">-</button>
                </div>
                @endforeach
                <div class="flex gap-2">
                    <input type="text" name="eventtype_extra_services[]" placeholder="Enter extra service"
                           class="input input-bordered w-full rounded-xl focus:border-yellow-400 focus:ring focus:ring-yellow-200">
                    <button type="button" onclick="addModifyExtra({{ $eventtype->eventtype_ID }})" class="btn btn-sm">+</button>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="col-span-1 md:col-span-2 flex justify-end gap-3">
            <button type="button" class="btn rounded-xl"
                    onclick="document.getElementById('modify_eventtype_modal_{{ $eventtype->eventtype_ID }}').close()">Cancel</button>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
    </form>
  </div>
</dialog>

<script>
  // Photo preview
  function previewModifyEventPhoto(event){
      const input = event.target;
      const previewId = input.dataset.preview;
      const preview = document.getElementById(previewId);
      if(!preview) return;

      const file = input.files && input.files[0];
      if(file){
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

  // Dynamic add-one functions
  function addModifyAmenity(id){ addModifyInput(`amenities_wrapper_${id}`,'eventtype_amenities[]','Enter an amenity'); }
  function addModifyCatering(id){ addModifyInput(`catering_wrapper_${id}`,'eventtype_catering_options[]','Enter catering option'); }
  function addModifyTheme(id){ addModifyInput(`theme_wrapper_${id}`,'eventtype_theme_options[]','Enter theme option'); }
  function addModifyExtra(id){ addModifyInput(`extra_wrapper_${id}`,'eventtype_extra_services[]','Enter extra service'); }

  function addModifyInput(wrapperId,name,placeholder){
      const wrapper = document.getElementById(wrapperId);
      const div = document.createElement('div');
      div.classList.add('flex','gap-2','mt-1');
      div.innerHTML = `
        <input type="text" name="${name}" placeholder="${placeholder}" class="input input-bordered w-full rounded-xl focus:border-yellow-400 focus:ring focus:ring-yellow-200">
        <button type="button" onclick="this.parentNode.remove()" class="btn btn-sm btn-error">-</button>
      `;
      wrapper.appendChild(div);
  }
</script>

<script>
  function showModifyFacilityPhoto(eventtypeId){
    const select = document.getElementById('modify_facility_select_' + eventtypeId);
    const preview = document.getElementById('modify_facility_photo_preview_' + eventtypeId);
    const photoUrl = select.options[select.selectedIndex].dataset.photo;

    if(photoUrl){
      preview.src = photoUrl;
      preview.classList.remove('hidden');
    } else {
      preview.src = "";
      preview.classList.add('hidden');
    }
  }

  // Auto-show the selected facility photo on modal open
  document.addEventListener("DOMContentLoaded", function(){
    @foreach($eventtypes as $et)
      showModifyFacilityPhoto({{ $et->eventtype_ID }});
    @endforeach
  });
</script>