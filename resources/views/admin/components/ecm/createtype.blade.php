<!-- Create Event Type Modal -->
<dialog id="create_eventtype_modal" class="modal">
  <div class="modal-box max-w-4xl bg-white rounded-2xl shadow-xl">
    <h3 class="font-bold text-2xl text-blue-900 mb-4">Create Event Type</h3>

    <form method="POST" action="/createecmtype" enctype="multipart/form-data" class="grid grid-cols-1 gap-4 md:grid-cols-2">
        @csrf

        <!-- Event Type Name -->
        <div class="col-span-1 md:col-span-2">
            <label class="block text-sm font-semibold text-gray-700 mb-1">Event Type Name</label>
            <input type="text" name="eventtype_name" placeholder="Enter event type name"
                   class="input input-bordered w-full rounded-xl focus:border-yellow-400 focus:ring focus:ring-yellow-200" required>
        </div>

        <!-- Event Type Photo -->
        <div class="col-span-1 md:col-span-2">
            <label class="block text-sm font-semibold text-gray-700 mb-1">Event Type Photo</label>
            <input type="file" name="eventtype_photo" id="create_eventtype_photo" accept="image/*"
                   class="file-input file-input-bordered w-full rounded-xl focus:border-yellow-400 focus:ring focus:ring-yellow-200"
                   onchange="previewCreateEventPhoto(event)">
            <div class="mt-3 flex justify-center">
                <img id="create_eventtype_photo_preview" src="" alt="Photo Preview"
                     class="hidden max-h-40 rounded-xl border border-gray-200 shadow-sm">
            </div>
        </div>

        <!-- Price -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Price</label>
            <input type="number" name="eventtype_price" placeholder="Enter price"
                   class="input input-bordered w-full rounded-xl focus:border-yellow-400 focus:ring focus:ring-yellow-200" required>
        </div>

        <!-- Capacity -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Capacity</label>
            <input type="number" name="eventtype_capacity" placeholder="Maximum guests"
                   class="input input-bordered w-full rounded-xl focus:border-yellow-400 focus:ring focus:ring-yellow-200">
        </div>

        <!-- Facility -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Facility / Room</label>
            <select name="facilityID" class="select select-bordered w-full rounded-xl focus:border-yellow-400 focus:ring focus:ring-yellow-200">
                <option value="">-- Select Facility --</option>
                  <option value="1">facility 1</option>
            </select>
        </div>

        <!-- Duration -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Duration</label>
            <input type="text" name="eventtype_duration" placeholder="e.g. 3 hours"
                   class="input input-bordered w-full rounded-xl focus:border-yellow-400 focus:ring focus:ring-yellow-200">
        </div>

        <!-- Status -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Status</label>
            <select name="eventtype_status" class="select select-bordered w-full rounded-xl focus:border-yellow-400 focus:ring focus:ring-yellow-200">
                <option value="Active" selected>Active</option>
                <option value="Inactive">Inactive</option>
            </select>
        </div>

        <!-- Description -->
        <div class="col-span-1 md:col-span-2">
            <label class="block text-sm font-semibold text-gray-700 mb-1">Description</label>
            <textarea name="eventtype_description" rows="4" placeholder="Write a short description..."
                      class="textarea textarea-bordered w-full rounded-xl focus:border-yellow-400 focus:ring focus:ring-yellow-200"></textarea>
        </div>

        <!-- Amenities -->
        <div class="col-span-1 md:col-span-2">
            <label class="block text-sm font-semibold text-gray-700 mb-1">Amenities</label>
            <div id="amenities_wrapper" class="flex flex-col gap-2">
                <div class="flex gap-2">
                    <input type="text" name="eventtype_amenities[]" placeholder="Enter an amenity"
                           class="input input-bordered w-full rounded-xl focus:border-yellow-400 focus:ring focus:ring-yellow-200">
                    <button type="button" onclick="addAmenity()" class="btn btn-sm">+</button>
                </div>
            </div>
        </div>

        <!-- Catering Options -->
        <div class="col-span-1 md:col-span-2">
            <label class="block text-sm font-semibold text-gray-700 mb-1">Catering Options</label>
            <div id="catering_wrapper" class="flex flex-col gap-2">
                <div class="flex gap-2">
                    <input type="text" name="eventtype_catering_options[]" placeholder="Enter catering option"
                           class="input input-bordered w-full rounded-xl focus:border-yellow-400 focus:ring focus:ring-yellow-200">
                    <button type="button" onclick="addCatering()" class="btn btn-sm">+</button>
                </div>
            </div>
        </div>

        <!-- Theme Options -->
        <div class="col-span-1 md:col-span-2">
            <label class="block text-sm font-semibold text-gray-700 mb-1">Theme Options</label>
            <div id="theme_wrapper" class="flex flex-col gap-2">
                <div class="flex gap-2">
                    <input type="text" name="eventtype_theme_options[]" placeholder="Enter theme option"
                           class="input input-bordered w-full rounded-xl focus:border-yellow-400 focus:ring focus:ring-yellow-200">
                    <button type="button" onclick="addTheme()" class="btn btn-sm">+</button>
                </div>
            </div>
        </div>

        <!-- Extra Services -->
        <div class="col-span-1 md:col-span-2">
            <label class="block text-sm font-semibold text-gray-700 mb-1">Extra Services</label>
            <div id="extra_wrapper" class="flex flex-col gap-2">
                <div class="flex gap-2">
                    <input type="text" name="eventtype_extra_services[]" placeholder="Enter extra service"
                           class="input input-bordered w-full rounded-xl focus:border-yellow-400 focus:ring focus:ring-yellow-200">
                    <button type="button" onclick="addExtra()" class="btn btn-sm">+</button>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="col-span-1 md:col-span-2 flex justify-end gap-3">
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

  // Dynamic add/remove
  function addAmenity(){addInput('amenities_wrapper','eventtype_amenities[]','Enter an amenity');}
  function addCatering(){addInput('catering_wrapper','eventtype_catering_options[]','Enter catering option');}
  function addTheme(){addInput('theme_wrapper','eventtype_theme_options[]','Enter theme option');}
  function addExtra(){addInput('extra_wrapper','eventtype_extra_services[]','Enter extra service');}

  function addInput(wrapperId, name, placeholder){
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
