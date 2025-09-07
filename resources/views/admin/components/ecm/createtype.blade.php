<!-- Create Event Type Modal -->
<dialog id="create_eventtype_modal" class="modal">
  <div class="modal-box max-w-4xl bg-white rounded-2xl shadow-xl p-6">
    <h3 class="font-bold text-2xl text-blue-900 mb-6">Create Event Type</h3>

    <form method="POST" action="/createecmtype" enctype="multipart/form-data" class="grid grid-cols-1 gap-6 md:grid-cols-2">
        @csrf

        <!-- Event Type Name -->
        <div class="col-span-2">
            <label class="block text-sm font-semibold text-gray-700 mb-1">Event Type Name</label>
            <input type="text" name="eventtype_name" placeholder="Enter event type name"
                   class="input input-bordered w-full rounded-xl focus:border-yellow-400 focus:ring focus:ring-yellow-200" required>
        </div>

        <!-- Event Type Photo -->
        <div class="col-span-2">
            <label class="block text-sm font-semibold text-gray-700 mb-1">Event Type Photo</label>
            <input type="file" name="eventtype_photo" id="create_eventtype_photo" accept="image/*"
                   class="file-input file-input-bordered w-full rounded-xl focus:border-yellow-400 focus:ring focus:ring-yellow-200"
                   onchange="previewCreateEventPhoto(event)">
            <div class="mt-3 flex justify-center">
                <img id="create_eventtype_photo_preview" src="" alt="Photo Preview"
                     class="hidden max-h-48 rounded-xl border border-gray-200 shadow-md object-cover">
            </div>
        </div>

        <!-- Price & Capacity -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Price</label>
            <input type="number" name="eventtype_price" placeholder="Enter price"
                   class="input input-bordered w-full rounded-xl focus:border-yellow-400 focus:ring focus:ring-yellow-200" required>
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Capacity</label>
            <input type="number" name="eventtype_capacity" placeholder="Maximum guests"
                   class="input input-bordered w-full rounded-xl focus:border-yellow-400 focus:ring focus:ring-yellow-200">
        </div>

        <!-- Facility / Room -->
        <div class="col-span-2">
            <label class="block text-sm font-semibold text-gray-700 mb-1">Facility / Room</label>
            <select name="facilityID" id="facility_select"
                    class="select select-bordered w-full rounded-xl focus:border-yellow-400 focus:ring focus:ring-yellow-200"
                    onchange="showFacilityPhoto()">
                <option value="">-- Select Facility --</option>
                @forelse ($facilities as $facility)
                  <option value="{{ $facility->facilityID }}" 
                          data-photo="{{ $facility->facility_photo ? asset($facility->facility_photo) : '' }}">
                    {{ $facility->facility_name }}
                  </option>
                @empty
                  <option disabled>No facilities available</option>
                @endforelse
            </select>
            <div class="mt-3 flex justify-center">
              <img id="facility_photo_preview" 
                   class="hidden max-h-48 rounded-xl border border-gray-200 shadow-md object-cover" 
                   alt="Facility Preview">
            </div>
        </div>

        <!-- Duration & Status -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Duration</label>
            <input type="text" name="eventtype_duration" placeholder="e.g. 3 hours"
                   class="input input-bordered w-full rounded-xl focus:border-yellow-400 focus:ring focus:ring-yellow-200">
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Status</label>
            <select name="eventtype_status" 
                    class="select select-bordered w-full rounded-xl focus:border-yellow-400 focus:ring focus:ring-yellow-200">
                <option value="Active" selected>Active</option>
                <option value="Inactive">Inactive</option>
            </select>
        </div>

        <!-- Description -->
        <div class="col-span-2">
            <label class="block text-sm font-semibold text-gray-700 mb-1">Description</label>
            <textarea name="eventtype_description" rows="4" placeholder="Write a short description..."
                      class="textarea textarea-bordered w-full rounded-xl focus:border-yellow-400 focus:ring focus:ring-yellow-200"></textarea>
        </div>

        <!-- Dynamic Sections -->
        @php
          $dynamicFields = [
            ['id'=>'amenities_wrapper','name'=>'eventtype_amenities[]','label'=>'Amenities','placeholder'=>'Enter an amenity'],
            ['id'=>'catering_wrapper','name'=>'eventtype_catering_options[]','label'=>'Catering Options','placeholder'=>'Enter catering option'],
            ['id'=>'theme_wrapper','name'=>'eventtype_theme_options[]','label'=>'Theme Options','placeholder'=>'Enter theme option'],
            ['id'=>'extra_wrapper','name'=>'eventtype_extra_services[]','label'=>'Extra Services','placeholder'=>'Enter extra service']
          ];
        @endphp

        @foreach($dynamicFields as $field)
        <div class="col-span-2">
            <label class="block text-sm font-semibold text-gray-700 mb-1">{{ $field['label'] }}</label>
            <div id="{{ $field['id'] }}" class="flex flex-col gap-2">
                <div class="flex gap-2">
                    <input type="text" name="{{ $field['name'] }}" placeholder="{{ $field['placeholder'] }}"
                           class="input input-bordered w-full rounded-xl focus:border-yellow-400 focus:ring focus:ring-yellow-200">
                    <button type="button" onclick="addInput('{{ $field['id'] }}','{{ $field['name'] }}','{{ $field['placeholder'] }}')" class="btn btn-sm">+</button>
                </div>
            </div>
        </div>
        @endforeach

        <!-- Action Buttons -->
        <div class="col-span-2 flex justify-end gap-3 mt-6">
            <button type="button" class="btn rounded-xl" onclick="create_eventtype_modal.close()">Cancel</button>
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
    </form>
  </div>
</dialog>

<!-- Scripts -->
<script>
  // Photo preview
  function previewCreateEventPhoto(event) {
    const input = event.target;
    const preview = document.getElementById('create_eventtype_photo_preview');
    if(input.files && input.files[0]){
      const reader = new FileReader();
      reader.onload = e => {
        preview.src = e.target.result;
        preview.classList.remove('hidden');
      }
      reader.readAsDataURL(input.files[0]);
    } else {
      preview.src = '';
      preview.classList.add('hidden');
    }
  }

  // Facility photo
  function showFacilityPhoto(){
    const select = document.getElementById('facility_select');
    const preview = document.getElementById('facility_photo_preview');
    const photoUrl = select.options[select.selectedIndex].dataset.photo;
    if(photoUrl){
      preview.src = photoUrl;
      preview.classList.remove('hidden');
    } else {
      preview.src = "";
      preview.classList.add('hidden');
    }
  }

  // Dynamic add/remove inputs
  function addInput(wrapperId, name, placeholder){
    const wrapper = document.getElementById(wrapperId);
    const div = document.createElement('div');
    div.classList.add('flex','gap-2','mt-1');
    div.innerHTML = `
      <input type="text" name="${name}" placeholder="${placeholder}" 
             class="input input-bordered w-full rounded-xl focus:border-yellow-400 focus:ring focus:ring-yellow-200">
      <button type="button" onclick="this.parentNode.remove()" class="btn btn-sm btn-error">-</button>
    `;
    wrapper.appendChild(div);
  }
</script>
