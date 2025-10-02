<!-- Add this modal at the bottom of your section, before the closing </section> tag -->
<dialog id="room_modal" class="modal">
  <div class="modal-box max-w-4xl">
    <form method="dialog">
      <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
    </form>
    <h3 class="font-bold text-lg mb-6">Add New Room</h3>

    <!-- Two options for room creation -->
    <div class="flex gap-4 mb-8">
      <!-- Manual Creation Button -->
      <button id="manual_create_btn" class="btn btn-primary flex-1" onclick="showManualForm()">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd"
            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
            clip-rule="evenodd" />
        </svg>
        Create Manually
      </button>

      <!-- AI Creation Button -->
      <button id="ai_create_btn" class="btn btn-accent flex-1" onclick="showAIPrompt()">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 24 24" fill="none"
          stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
        </svg>
        Create with AI
      </button>
    </div>

    <!-- Manual Form (shown by default) -->
    <form id="manual_form" action="/createroom" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Room Type -->
        <div class="form-control">
          <label class="label">
            <span class="label-text flex items-center gap-2">
              <i class="w-4 h-4" data-lucide="bed-double"></i>
              Room Type
            </span>
          </label>
          <select name="roomtype" class="select select-bordered w-full" required>
            <option value="" disabled selected>-- Select Room Type --</option>
            @forelse ($roomtypes as $roomtype)
              <option value="{{ $roomtype->roomtype_name }}">{{ $roomtype->roomtype_name}}</option>
            @empty
              <option disabled>No room types available</option>
            @endforelse
          </select>
        </div>

        <!-- Room Size -->
        <div class="form-control">
          <label class="label">
            <span class="label-text flex items-center gap-2">
              <i class="w-4 h-4" data-lucide="move"></i>
              Room Size (sqft)
            </span>
          </label>
          <input type="text" name="roomsize" class="input input-bordered w-full" placeholder="e.g. 300-400 sqft"
            required>
        </div>

        <!-- Max Guests -->
        <div class="form-control">
          <label class="label">
            <span class="label-text flex items-center gap-2">
              <i class="w-4 h-4" data-lucide="users"></i>
              Max Guests
            </span>
          </label>
          <input type="number" name="roommaxguest" min="1" class="input input-bordered w-full" placeholder="e.g. 2"
            required>
        </div>

        <!-- Room Price -->
        <div class="form-control">
          <label class="label">
            <span class="label-text flex items-center gap-2">
              <i class="w-4 h-4" data-lucide="banknote"></i>
              Price per Night (₱)
            </span>
          </label>
          <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2">₱</span>
            <input type="number" name="roomprice" min="0" step="0.01" class="input input-bordered w-full pl-8"
              placeholder="0.00" required>
          </div>
        </div>

        <!-- Room Features -->
        <!-- Room Features -->
        <div class="form-control md:col-span-2">
          <label class="label">
            <span class="label-text flex items-center gap-2">
              <i class="w-4 h-4" data-lucide="list-checks"></i>
              Features
            </span>
          </label>

          <div id="features-container" class="grid grid-cols-2 md:grid-cols-3 gap-2">
            <!-- Default checkboxes -->
            <div class="flex items-center gap-2 bg-gray-50 p-2 rounded">
              <label class="flex items-center gap-2 cursor-pointer flex-1">
                <input type="checkbox" name="roomfeatures[]" value="WiFi" class="checkbox checkbox-primary">
                WiFi
              </label>
              <button type="button" class="btn btn-error btn-xs" onclick="removeFeature(this)">
                <i data-lucide="x" class="w-3 h-3"></i>
              </button>
            </div>
            <div class="flex items-center gap-2 bg-gray-50 p-2 rounded">
              <label class="flex items-center gap-2 cursor-pointer flex-1">
                <input type="checkbox" name="roomfeatures[]" value="Air Conditioning" class="checkbox checkbox-primary">
                Air Conditioning
              </label>
              <button type="button" class="btn btn-error btn-xs" onclick="removeFeature(this)">
                <i data-lucide="x" class="w-3 h-3"></i>
              </button>
            </div>
            <div class="flex items-center gap-2 bg-gray-50 p-2 rounded">
              <label class="flex items-center gap-2 cursor-pointer flex-1">
                <input type="checkbox" name="roomfeatures[]" value="TV" class="checkbox checkbox-primary">
                TV
              </label>
              <button type="button" class="btn btn-error btn-xs" onclick="removeFeature(this)">
                <i data-lucide="x" class="w-3 h-3"></i>
              </button>
            </div>
            <div class="flex items-center gap-2 bg-gray-50 p-2 rounded">
              <label class="flex items-center gap-2 cursor-pointer flex-1">
                <input type="checkbox" name="roomfeatures[]" value="Mini Bar" class="checkbox checkbox-primary">
                Mini Bar
              </label>
              <button type="button" class="btn btn-error btn-xs" onclick="removeFeature(this)">
                <i data-lucide="x" class="w-3 h-3"></i>
              </button>
            </div>
          </div>

          <!-- Add custom feature dynamically -->
          <div class="mt-3 flex gap-2">
            <input type="text" id="new-feature-input" class="input input-bordered w-full"
              placeholder="Add custom feature">
            <button type="button" class="btn btn-outline btn-sm" onclick="addFeatureCheckbox()">
              <i class="w-4 h-4" data-lucide="plus"></i>
              Add
            </button>
          </div>
        </div>

        <!-- Room Description -->
        <div class="form-control md:col-span-2">
          <label class="label">
            <span class="label-text flex items-center gap-2">
              <i class="w-4 h-4" data-lucide="align-left"></i>
              Description
            </span>
          </label>
          <textarea name="roomdescription" class="textarea textarea-bordered w-full h-32"
            placeholder="Describe the room amenities and features..." required></textarea>
        </div>

        <!-- Room Photo -->
        <div class="form-control md:col-span-2">
          <label class="label">
            <span class="label-text flex items-center gap-2">
              <i class="w-4 h-4" data-lucide="image"></i>
              Room Photo
            </span>
          </label>
          <div class="flex flex-col gap-4">
            <input type="file" name="roomphoto" id="roomphoto_input" class="file-input file-input-bordered w-full"
              accept="image/*" onchange="previewImage(this)">
            <div id="image_preview" class="hidden mt-2">
              <div class="relative w-full max-w-xs">
                <img id="preview_img" class="rounded-lg border border-gray-200 w-full h-48 object-cover">
                <button type="button" onclick="removePreview()"
                  class="absolute -top-2 -right-2 btn btn-circle btn-xs btn-error">
                  <i class="w-4 h-4" data-lucide="x"></i>
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- Room Status -->

      </div>

      <div class="modal-action mt-6">
        <button type="submit" class="btn btn-primary gap-2">
          <i class="w-5 h-5" data-lucide="save"></i>
          Save Room
        </button>
        <button type="button" onclick="room_modal.close()" class="btn btn-ghost">
          Cancel
        </button>
      </div>
    </form>

    <!-- AI Prompt Form (hidden by default) -->
    <div id="ai_form" class="hidden">
      <div class="bg-blue-50 rounded-lg p-6 mb-6 border border-blue-100">
        <h4 class="text-lg font-semibold mb-4 text-blue-800">Describe Your Room</h4>
        <form action="/processRoomPrompt" method="POST">
          @csrf
          <div class="form-control">
            <textarea name="ai_prompt" class="textarea textarea-bordered h-24"
              placeholder="e.g. 'Add a large deluxe room for 3 guests with balcony and sea view priced at ₱2500 per night'"></textarea>
          </div>
          <button type="submit" class="btn btn-accent mt-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 24 24" fill="none"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
            </svg>
            Generate Room
          </button>
        </form>
      </div>

      <div class="bg-blue-100 p-4 rounded-lg mb-6">
        <h5 class="font-medium text-blue-800 mb-2">Example Prompts:</h5>
        <ul class="list-disc pl-5 text-blue-700">
          <li class="mb-1">"Add a medium family room for 4 people with WiFi and TV at ₱1800 per night"</li>
          <li class="mb-1">"Create a luxury suite with balcony for 2 guests priced at ₱3500"</li>
          <li>"Small single room with AC for business travelers, budget ₱1200"</li>
        </ul>
      </div>

      <!-- This will be shown after AI generation -->
      <form id="ai_generated_form" action="" method="POST" enctype="multipart/form-data"
        class="@if(!isset($aiData)) hidden @endif">
        @csrf
        @if(isset($aiData))
          <div class="alert alert-info mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none"
              viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>Review and edit the AI-generated details below</span>
          </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <!-- Room Type -->
          <div class="form-control">
            <label class="label">
              <span class="label-text">Room Type</span>
            </label>
            <select name="roomtype" class="select select-bordered" required>
              <option value="">Select Type</option>
              <option value="Standard" @if(isset($aiData) && $aiData['roomtype'] === 'Standard') selected @endif>Standard
              </option>
              <option value="Deluxe" @if(isset($aiData) && $aiData['roomtype'] === 'Deluxe') selected @endif>Deluxe
              </option>
              <option value="Suite" @if(isset($aiData) && $aiData['roomtype'] === 'Suite') selected @endif>Suite</option>
              <option value="Executive" @if(isset($aiData) && $aiData['roomtype'] === 'Executive') selected @endif>
                Executive</option>
            </select>
          </div>

          <!-- Room Size -->
          <div class="form-control">
            <label class="label">
              <span class="label-text">Room Size</span>
            </label>
            <input type="text" name="roomsize" class="input input-bordered" value="{{ $aiData['roomsize'] ?? '' }}"
              required>
          </div>

          <!-- Max Guests -->
          <div class="form-control">
            <label class="label">
              <span class="label-text">Max Guests</span>
            </label>
            <input type="number" name="roommaxguest" min="1" class="input input-bordered"
              value="{{ $aiData['roommaxguest'] ?? '' }}" required>
          </div>

          <!-- Room Price -->
          <div class="form-control">
            <label class="label">
              <span class="label-text">Price per Night (₱)</span>
            </label>
            <input type="number" name="roomprice" min="0" step="0.01" class="input input-bordered"
              value="{{ $aiData['roomprice'] ?? '' }}" required>
          </div>

          <!-- Room Features -->
          <div class="form-control md:col-span-2">
            <label class="label">
              <span class="label-text">Features (comma separated)</span>
            </label>
            <input type="text" name="roomfeatures" class="input input-bordered"
              value="{{ $aiData['roomfeatures'] ?? '' }}" required>
          </div>

          <!-- Room Description -->
          <div class="form-control md:col-span-2">
            <label class="label">
              <span class="label-text">Description</span>
            </label>
            <textarea name="roomdescription" class="textarea textarea-bordered h-24"
              required>{{ $aiData['roomdescription'] ?? '' }}</textarea>
          </div>

          <!-- Room Photo -->
          <div class="form-control">
            <label class="label">
              <span class="label-text">Room Photo</span>
            </label>
            <input type="file" name="roomphoto" class="file-input file-input-bordered">
          </div>

          <!-- Room Status -->
          <div class="form-control">
            <label class="label">
              <span class="label-text">Status</span>
            </label>
            <select name="roomstatus" class="select select-bordered" required>
              <option value="Available" @if(isset($aiData) && $aiData['roomstatus'] === 'available') selected @endif>
                Available</option>
              <option value="Occupied" @if(isset($aiData) && $aiData['roomstatus'] === 'occupied') selected @endif>
                Occupied</option>
              <option value="Maintenance" @if(isset($aiData) && $aiData['roomstatus'] === 'maintenance') selected @endif>
                Maintenance</option>
            </select>
          </div>
        </div>

        <div class="modal-action">
          <button type="submit" class="btn btn-primary">Save Room</button>
          <button type="button" onclick="showAIPrompt()" class="btn btn-ghost">Back</button>
        </div>
      </form>
    </div>
  </div>
</dialog>

<script>
  // Initialize Lucide icons
  lucide.createIcons();

  // Image preview functionality
  function previewImage(input) {
    const preview = document.getElementById('image_preview');
    const img = document.getElementById('preview_img');

    if (input.files && input.files[0]) {
      const reader = new FileReader();

      reader.onload = function (e) {
        img.src = e.target.result;
        preview.classList.remove('hidden');
      }

      reader.readAsDataURL(input.files[0]);
    }
  }

  function removePreview() {
    const preview = document.getElementById('image_preview');
    const input = document.getElementById('roomphoto_input');

    preview.classList.add('hidden');
    input.value = '';
  }

  function showManualForm() {
    document.getElementById('manual_form').classList.remove('hidden');
    document.getElementById('ai_form').classList.add('hidden');
    document.getElementById('ai_generated_form').classList.add('hidden');
    document.getElementById('manual_create_btn').classList.add('btn-primary');
    document.getElementById('manual_create_btn').classList.remove('btn-outline');
    document.getElementById('ai_create_btn').classList.add('btn-outline');
    document.getElementById('ai_create_btn').classList.remove('btn-accent');
  }

  function showAIPrompt() {
    document.getElementById('manual_form').classList.add('hidden');
    document.getElementById('ai_form').classList.remove('hidden');
    document.getElementById('ai_generated_form').classList.add('hidden');
    document.getElementById('ai_create_btn').classList.add('btn-accent');
    document.getElementById('ai_create_btn').classList.remove('btn-outline');
    document.getElementById('manual_create_btn').classList.add('btn-outline');
    document.getElementById('manual_create_btn').classList.remove('btn-primary');
  }

  // Show AI generated form if coming back from processing
  @if(isset($aiData))
    document.addEventListener('DOMContentLoaded', function () {
      showAIPrompt();
      document.getElementById('ai_generated_form').classList.remove('hidden');
    });
  @endif
</script>

<script>
    function addFeatureCheckbox() {
      const input = document.getElementById('new-feature-input');
      const value = input.value.trim();
      if (!value) return;

      const container = document.getElementById('features-container');

      // new wrapper div
      const div = document.createElement('div');
      div.classList.add('flex', 'items-center', 'gap-2', 'bg-gray-50', 'p-2', 'rounded');
      div.innerHTML = `
      <label class="flex items-center gap-2 cursor-pointer flex-1">
        <input type="checkbox" name="roomfeatures[]" value="${value}" class="checkbox checkbox-primary" checked>
        ${value}
      </label>
      <button type="button" class="btn btn-error btn-xs" onclick="removeFeature(this)">
        <i data-lucide="x" class="w-3 h-3"></i>
      </button>
    `;

      container.appendChild(div);
      input.value = ""; // clear input
      lucide.createIcons(); // refresh Lucide icons
    }

  function removeFeature(button) {
    button.parentElement.remove();
  }
</script>