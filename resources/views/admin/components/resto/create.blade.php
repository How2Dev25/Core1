<!-- Modal -->
<dialog id="addMenuModal" class="modal">
  <div class="modal-box bg-white rounded-xl p-6 max-w-lg">
    <h3 class="text-xl font-bold text-blue-900 mb-4">Add New Menu</h3>

    <!-- ✅ Form wrapped around everything -->
    <form action="/addmenu" method="POST" enctype="multipart/form-data" class="space-y-4">
      <!-- CSRF (Laravel) -->
      @csrf

      <!-- Menu Name -->
      <div>
        <label class="block text-sm font-medium text-gray-700">Menu Name</label>
        <input name="menu_name" type="text" class="w-full border rounded-lg px-3 py-2 mt-1 focus:ring-2 focus:ring-blue-500" placeholder="Enter menu name" required>
      </div>

      <!-- Menu Photo Upload with Preview -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Menu Photo</label>
        <label for="menu_photo" 
               class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:border-blue-400 hover:bg-blue-50 transition">
          <svg class="w-10 h-10 text-gray-400 mb-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16l4-4a4 4 0 016 0l4 4m-2-2a2 2 0 104 0 2 2 0 00-4 0z" />
          </svg>
          <span class="text-sm text-gray-500">Click to upload image</span>
          <input id="menu_photo" name="menu_photo" type="file" class="hidden" accept="image/*" onchange="previewMenuImage(event)" required>
        </label>

        <!-- Preview Area -->
        <div id="menuPreviewContainer" class="mt-3 hidden">
          <img id="menuPreview" class="w-full h-64 object-cover rounded-xl shadow-md border" />
          <button type="button" onclick="removeMenuImage()" class="mt-2 text-red-500 text-sm hover:underline">Remove</button>
        </div>
      </div>

      <!-- Description -->
      <div>
        <label class="block text-sm font-medium text-gray-700">Description</label>
        <textarea name="menu_description" class="w-full border rounded-lg px-3 py-2 mt-1 focus:ring-2 focus:ring-blue-500" placeholder="Enter description"></textarea>
      </div>

      <!-- Price -->
      <div>
        <label class="block text-sm font-medium text-gray-700">Price</label>
        <input name="menu_price" type="number" step="0.01" class="w-full border rounded-lg px-3 py-2 mt-1 focus:ring-2 focus:ring-blue-500" placeholder="₱0.00" required>
      </div>

      <!-- Buttons -->
      <div class="flex justify-end gap-3 mt-6">
        <button type="button" onclick="document.getElementById('addMenuModal').close()" class="px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-100">Cancel</button>
        <button type="submit" class="btn btn-primary">Add</button>
      </div>
    </form>
  </div>
</dialog>

<script>
  function previewMenuImage(event) {
    const previewContainer = document.getElementById('menuPreviewContainer');
    const preview = document.getElementById('menuPreview');
    const file = event.target.files[0];

    if (file) {
      preview.src = URL.createObjectURL(file);
      previewContainer.classList.remove('hidden');
    }
  }

  function removeMenuImage() {
    const input = document.getElementById('menu_photo');
    const previewContainer = document.getElementById('menuPreviewContainer');
    input.value = '';
    previewContainer.classList.add('hidden');
  }
</script>
