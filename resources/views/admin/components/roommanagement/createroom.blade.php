<style>
  @keyframes slideUp {
    from {
      opacity: 0;
      transform: translateY(20px);
    }

    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  @keyframes fadeIn {
    from {
      opacity: 0;
    }

    to {
      opacity: 1;
    }
  }

  @keyframes scaleIn {
    from {
      opacity: 0;
      transform: scale(0.9);
    }

    to {
      opacity: 1;
      transform: scale(1);
    }
  }

  @keyframes shimmer {
    0% {
      background-position: -1000px 0;
    }

    100% {
      background-position: 1000px 0;
    }
  }

  .animate-slide-up {
    animation: slideUp 0.4s ease-out forwards;
  }

  .animate-fade-in {
    animation: fadeIn 0.3s ease-out forwards;
  }

  .animate-scale-in {
    animation: scaleIn 0.3s ease-out forwards;
  }

  .stagger-1 {
    animation-delay: 0.1s;
    opacity: 0;
  }

  .stagger-2 {
    animation-delay: 0.2s;
    opacity: 0;
  }

  .stagger-3 {
    animation-delay: 0.3s;
    opacity: 0;
  }

  .stagger-4 {
    animation-delay: 0.4s;
    opacity: 0;
  }

  .feature-item {
    transition: all 0.2s ease;
  }

  .feature-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
  }

  .input-group:focus-within {
    transform: scale(1.01);
    transition: transform 0.2s ease;
  }

  .preview-container {
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  }

  .preview-container.show {
    animation: scaleIn 0.4s ease-out forwards;
  }

  .file-input-hover:hover {
    border-color: #3b82f6;
    background-color: #eff6ff;
    transition: all 0.2s ease;
  }

  .modal-backdrop {
    backdrop-filter: blur(4px);
    animation: fadeIn 0.3s ease-out;
  }

  .btn-hover-lift {
    transition: all 0.2s ease;
  }

  .btn-hover-lift:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px -2px rgb(0 0 0 / 0.2);
  }
</style>

<!-- Enhanced Modal -->
<dialog id="room_modal" class="modal modal-backdrop">
  <div class="modal-box max-w-5xl w-full mx-4 max-h-[90vh] overflow-y-auto p-0">
    <!-- Header with gradient -->
    <div class="text-black p-6 rounded-t-lg">
      <form method="dialog">
        <button class="btn btn-sm btn-circle btn-ghost absolute right-4 top-4 hover:bg-white/20">
          <span class=" text-xl">✕</span>
        </button>
      </form>
      <div class="flex items-center gap-3 ">
        <div class="p-3 bg-white/20 rounded-lg backdrop-blur-sm">
          <i class="w-6 h-6" data-lucide="hotel"></i>
        </div>
        <div>
          <h3 class="font-bold text-2xl ">Add New Room</h3>
          <p class=" text-sm mt-1">Fill in the details to create a new room listing</p>
        </div>
      </div>
    </div>

    <!-- Form Content -->
    <form id="manual_form" action="/createroom" method="POST" enctype="multipart/form-data" class="p-6 lg:p-8">
      @csrf

      <!-- Room Photo Section - First for better UX -->
      <div class="form-control mb-8 animate-slide-up">
        <label class="label">
          <span class="label-text text-black font-semibold text-base flex items-center gap-2">
            <i class="w-5 h-5 text-blue-600" data-lucide="image"></i>
            Room Photo
          </span>
          <span class="label-text-alt text-gray-500">Recommended: 1200x800px</span>
        </label>

        <div class="relative">
          <label for="roomphoto_input" class="block">
            <div
              class="border-2 border-dashed border-gray-300 rounded-xl p-8 text-center cursor-pointer file-input-hover bg-gray-50 hover:bg-blue-50 transition-all duration-300">
              <div class="flex flex-col items-center gap-3">
                <div class="p-4 bg-blue-100 rounded-full">
                  <i class="w-8 h-8 text-blue-600" data-lucide="upload-cloud"></i>
                </div>
                <div>
                  <p class="font-medium text-gray-700">Click to upload or drag and drop</p>
                  <p class="text-sm text-gray-500 mt-1">PNG, JPG or WEBP (max. 5MB)</p>
                </div>
              </div>
            </div>
          </label>
          <input type="file" name="roomphoto" id="roomphoto_input" class="hidden" accept="image/*"
            onchange="previewImage(this)">
        </div>

        <!-- Enhanced Image Preview -->
        <div id="image_preview" class="hidden mt-6">
          <div class="relative preview-container bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200">
            <div class="aspect-video w-full bg-gray-100">
              <img id="preview_img" class="w-full h-full object-cover">
            </div>
            <div class="absolute top-4 right-4 flex gap-2">
              <button type="button" onclick="removePreview()"
                class="btn btn-circle btn-sm bg-red-500 hover:bg-red-600 text-white border-none shadow-lg btn-hover-lift">
                <i class="w-4 h-4" data-lucide="x"></i>
              </button>
            </div>
            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent p-4">
              <p class="text-white text-sm font-medium">Room Preview</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Room Details Grid -->
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Room Type -->
        <div class="form-control animate-slide-up stagger-1 input-group">
          <label class="label">
            <span class="label-text font-semibold flex items-center gap-2 text-gray-900">
              <i class="w-4 h-4 text-purple-600" data-lucide="bed-double"></i>
              Room Type
            </span>
          </label>
          <select name="roomtype"
            class="select select-bordered w-full focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all text-gray-900"
            required>
            <option value="" disabled selected>Select room type</option>
            @forelse ($roomtypes as $roomtype)
              <option value="{{ $roomtype->roomtype_name }}">{{ $roomtype->roomtype_name}}</option>
            @empty
              <option disabled>No room types available</option>
            @endforelse
          </select>
        </div>

        <!-- Room Size -->
        <div class="form-control animate-slide-up stagger-1 input-group">
          <label class="label">
            <span class="label-text font-semibold flex items-center gap-2 text-gray-900">
              <i class="w-4 h-4 text-orange-600" data-lucide="maximize"></i>
              Room Size (sqft)
            </span>
          </label>
          <input type="number" name="roomsize"
            class="input input-bordered w-full focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-all text-gray-900"
            placeholder="e.g. 300-400" required>
        </div>

        <!-- Max Guests -->
        <div class="form-control animate-slide-up stagger-2 input-group">
          <label class="label">
            <span class="label-text font-semibold flex items-center gap-2 text-gray-900">
              <i class="w-4 h-4 text-green-600" data-lucide="users"></i>
              Maximum Guests
            </span>
          </label>
          <input type="number" name="roommaxguest" min="1"
            class="input input-bordered w-full focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all text-gray-900"
            placeholder="e.g. 2" required>
        </div>

        <!-- Room Price -->
        <div class="form-control animate-slide-up stagger-2 input-group">
          <label class="label">
            <span class="label-text font-semibold flex items-center gap-2 text-gray-900">
              <i class="w-4 h-4 text-emerald-600" data-lucide="banknote"></i>
              Price per Night
            </span>
          </label>
          <div class="relative">
            <span class="absolute left-4 top-1/2 -translate-y-1/2 font-semibold text-gray-900">₱</span>
            <input type="number" name="roomprice" min="0" step="0.01"
              class="input input-bordered w-full pl-10 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition-all text-gray-900"
              placeholder="0.00" required>
          </div>
        </div>
      </div>

      <!-- Room Features -->
      <div class="form-control mt-8 animate-slide-up stagger-3">
        <label class="label">
          <span class="label-text font-semibold text-base flex items-center gap-2">
            <i class="w-5 h-5 text-indigo-600" data-lucide="sparkles"></i>
            Room Features & Amenities
          </span>
        </label>

        <div id="features-container" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
          <!-- Default checkboxes with enhanced styling -->
          <div
            class="feature-item flex items-center gap-3 bg-gradient-to-br from-blue-50 to-indigo-50 p-4 rounded-lg border border-blue-200">
            <label class="flex items-center gap-3 cursor-pointer flex-1">
              <input type="checkbox" name="roomfeatures[]" value="WiFi" class="checkbox checkbox-primary">
              <span class="font-medium text-gray-700">WiFi</span>
            </label>
            <button type="button" class="btn btn-ghost btn-xs text-red-500 hover:bg-red-100 rounded-full"
              onclick="removeFeature(this)">
              <i data-lucide="x" class="w-4 h-4"></i>
            </button>
          </div>

          <div
            class="feature-item flex items-center gap-3 bg-gradient-to-br from-cyan-50 to-blue-50 p-4 rounded-lg border border-cyan-200">
            <label class="flex items-center gap-3 cursor-pointer flex-1">
              <input type="checkbox" name="roomfeatures[]" value="Air Conditioning" class="checkbox checkbox-primary">
              <span class="font-medium text-gray-700">Air Conditioning</span>
            </label>
            <button type="button" class="btn btn-ghost btn-xs text-red-500 hover:bg-red-100 rounded-full"
              onclick="removeFeature(this)">
              <i data-lucide="x" class="w-4 h-4"></i>
            </button>
          </div>

          <div
            class="feature-item flex items-center gap-3 bg-gradient-to-br from-purple-50 to-pink-50 p-4 rounded-lg border border-purple-200">
            <label class="flex items-center gap-3 cursor-pointer flex-1">
              <input type="checkbox" name="roomfeatures[]" value="TV" class="checkbox checkbox-primary">
              <span class="font-medium text-gray-700">TV</span>
            </label>
            <button type="button" class="btn btn-ghost btn-xs text-red-500 hover:bg-red-100 rounded-full"
              onclick="removeFeature(this)">
              <i data-lucide="x" class="w-4 h-4"></i>
            </button>
          </div>

          <div
            class="feature-item flex items-center gap-3 bg-gradient-to-br from-amber-50 to-orange-50 p-4 rounded-lg border border-amber-200">
            <label class="flex items-center gap-3 cursor-pointer flex-1">
              <input type="checkbox" name="roomfeatures[]" value="Mini Bar" class="checkbox checkbox-primary">
              <span class="font-medium text-gray-700">Mini Bar</span>
            </label>
            <button type="button" class="btn btn-ghost btn-xs text-red-500 hover:bg-red-100 rounded-full"
              onclick="removeFeature(this)">
              <i data-lucide="x" class="w-4 h-4"></i>
            </button>
          </div>
        </div>

        <!-- Add custom feature -->
        <div class="mt-4 flex flex-col sm:flex-row gap-3">
          <input type="text" id="new-feature-input"
            class="text-black input input-bordered flex-1 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all"
            placeholder="Add custom feature (e.g., Balcony, Ocean View)">
          <button type="button" class="btn btn-primary gap-2 btn-hover-lift" onclick="addFeatureCheckbox()">
            <i class="w-4 h-4" data-lucide="plus"></i>
            Add Feature
          </button>
        </div>
      </div>

      <!-- Room Description -->
      <div class="form-control mt-8 animate-slide-up stagger-4">
        <label class="label">
          <span class="label-text text-black font-semibold text-base flex items-center gap-2">
            <i class="w-5 h-5" data-lucide="file-text"></i>
            Room Description
          </span>
          <span class="label-text-alt text-gray-500" id="char-count">0 / 500</span>
        </label>
        <textarea name="roomdescription"
          class="textarea text-black textarea-bordered w-full h-32 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 transition-all resize-none"
          placeholder="Describe the room amenities, features, and what makes it special..." maxlength="500"
          oninput="updateCharCount(this)" required></textarea>
      </div>

      <!-- Action Buttons -->
      <div class="flex flex-col sm:flex-row gap-3 mt-8 pt-6 border-t border-gray-200">
        <button type="submit" class="btn btn-primary flex-1 gap-2 btn-hover-lift text-lg py-3 h-auto">
          <i class="w-5 h-5" data-lucide="check-circle"></i>
          Save Room
        </button>
        <button type="button" onclick="room_modal.close()"
          class="btn btn-outline flex-1 gap-2 btn-hover-lift text-lg py-3 h-auto">
          <i class="w-5 h-5" data-lucide="x-circle"></i>
          Cancel
        </button>
      </div>
    </form>
  </div>
</dialog>

<script>
  // Initialize Lucide icons
  if (typeof lucide !== 'undefined') {
    lucide.createIcons();
  }

  // Character count for description
  function updateCharCount(textarea) {
    const count = textarea.value.length;
    const counter = document.getElementById('char-count');
    counter.textContent = `${count} / 500`;
    counter.classList.toggle('text-warning', count > 400);
    counter.classList.toggle('text-error', count > 480);
  }

  // Enhanced image preview with animation
  function previewImage(input) {
    const preview = document.getElementById('image_preview');
    const img = document.getElementById('preview_img');

    if (input.files && input.files[0]) {
      const file = input.files[0];

      // Validate file size (5MB max)
      if (file.size > 5 * 1024 * 1024) {
        alert('File size must be less than 5MB');
        input.value = '';
        return;
      }

      const reader = new FileReader();
      reader.onload = function (e) {
        img.src = e.target.result;
        preview.classList.remove('hidden');
        preview.classList.add('show');

        // Reinitialize icons
        if (typeof lucide !== 'undefined') {
          lucide.createIcons();
        }
      }
      reader.readAsDataURL(file);
    }
  }

  function removePreview() {
    const preview = document.getElementById('image_preview');
    const input = document.getElementById('roomphoto_input');

    preview.classList.add('hidden');
    preview.classList.remove('show');
    input.value = '';
  }

  // Enhanced add feature with random gradient
  function addFeatureCheckbox() {
    const input = document.getElementById('new-feature-input');
    const value = input.value.trim();
    if (!value) return;

    const container = document.getElementById('features-container');

    const gradients = [
      'from-rose-50 to-pink-50 border-rose-200',
      'from-blue-50 to-cyan-50 border-blue-200',
      'from-green-50 to-emerald-50 border-green-200',
      'from-yellow-50 to-amber-50 border-yellow-200',
      'from-purple-50 to-violet-50 border-purple-200',
      'from-indigo-50 to-blue-50 border-indigo-200'
    ];

    const randomGradient = gradients[Math.floor(Math.random() * gradients.length)];

    const div = document.createElement('div');
    div.classList.add('feature-item', 'flex', 'items-center', 'gap-3', 'bg-gradient-to-br', 'p-4', 'rounded-lg', 'border');
    div.classList.add(...randomGradient.split(' '));
    div.style.opacity = '0';
    div.style.transform = 'scale(0.9)';

    div.innerHTML = `
      <label class="flex items-center gap-3 cursor-pointer flex-1">
        <input type="checkbox" name="roomfeatures[]" value="${value}" class="checkbox checkbox-primary" checked>
        <span class="font-medium text-gray-700">${value}</span>
      </label>
      <button type="button" class="btn btn-ghost btn-xs text-red-500 hover:bg-red-100 rounded-full" onclick="removeFeature(this)">
        <i data-lucide="x" class="w-4 h-4"></i>
      </button>
    `;

    container.appendChild(div);

    // Animate in
    setTimeout(() => {
      div.style.transition = 'all 0.3s ease-out';
      div.style.opacity = '1';
      div.style.transform = 'scale(1)';
    }, 10);

    input.value = '';

    if (typeof lucide !== 'undefined') {
      lucide.createIcons();
    }
  }

  // Enhanced remove feature with animation
  function removeFeature(button) {
    const item = button.closest('.feature-item');
    item.style.transition = 'all 0.3s ease-out';
    item.style.opacity = '0';
    item.style.transform = 'scale(0.9)';

    setTimeout(() => {
      item.remove();
    }, 300);
  }

  // Add enter key support for adding features
  document.addEventListener('DOMContentLoaded', function () {
    const featureInput = document.getElementById('new-feature-input');
    if (featureInput) {
      featureInput.addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
          e.preventDefault();
          addFeatureCheckbox();
        }
      });
    }
  });
</script>