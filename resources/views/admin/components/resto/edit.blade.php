<!-- Edit Menu Modal -->
<dialog id="editMenuModal-{{ $menu->menuID }}" class="modal">
  <div class="modal-box bg-white rounded-xl p-6 max-w-lg">
    <h3 class="text-xl font-bold text-blue-900 mb-4">Edit Menu</h3>

    <form action="/updatemenu/{{ $menu->menuID }}" method="POST" enctype="multipart/form-data" class="space-y-4">
      @csrf
      @method('PUT')

      <!-- Menu Name -->
      <div>
        <label class="block text-sm font-medium text-gray-700">Menu Name</label>
        <input name="menu_name" type="text" value="{{ $menu->menu_name }}" 
               class="w-full border rounded-lg px-3 py-2 mt-1 focus:ring-2 focus:ring-blue-500" required>
      </div>

      <!-- Menu Photo -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Menu Photo</label>
        <label for="edit_menu_photo-{{ $menu->menuID }}" 
               class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:border-blue-400 hover:bg-blue-50 transition">
          <svg class="w-10 h-10 text-gray-400 mb-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16l4-4a4 4 0 016 0l4 4m-2-2a2 2 0 104 0 2 2 0 00-4 0z" />
          </svg>
          <span class="text-sm text-gray-500">Click to change image</span>
          <input id="edit_menu_photo-{{ $menu->menuID }}" 
                 name="menu_photo" 
                 type="file" 
                 class="hidden" 
                 accept="image/*" 
                 onchange="previewEditMenuImage(event, '{{ $menu->menuID }}')">
        </label>

        <!-- Preview Area (Default: show existing photo if any) -->
        <div id="editMenuPreviewContainer-{{ $menu->menuID }}" class="mt-3 {{ $menu->menu_photo ? '' : 'hidden' }}">
          <img id="editMenuPreview-{{ $menu->menuID }}" 
               src="{{asset($menu->menu_photo)}}" 
               class="w-full h-64 object-cover rounded-xl shadow-md border" />
          <button type="button" 
                  onclick="removeEditMenuImage('{{ $menu->menuID }}')" 
                  class="mt-2 text-red-500 text-sm hover:underline">Remove</button>
        </div>
      </div>

      <!-- Description -->
      <div>
        <label class="block text-sm font-medium text-gray-700">Description</label>
        <textarea name="menu_description" class="w-full border rounded-lg px-3 py-2 mt-1 focus:ring-2 focus:ring-blue-500">{{ $menu->menu_description }}</textarea>
      </div>

      <!-- Price -->
      <div>
        <label class="block text-sm font-medium text-gray-700">Price</label>
        <input name="menu_price" type="number" step="0.01" value="{{ $menu->menu_price }}" 
               class="w-full border rounded-lg px-3 py-2 mt-1 focus:ring-2 focus:ring-blue-500" required>
      </div>

      <!-- Buttons -->
      <div class="flex justify-end gap-3 mt-6">
        <button type="button" onclick="document.getElementById('editMenuModal-{{ $menu->menuID }}').close()" class="px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-100">Cancel</button>
        <button type="submit" class="btn btn-primary">Save Changes</button>
      </div>
    </form>
  </div>
</dialog>
<script>
  function previewEditMenuImage(event, menuId) {
    const previewContainer = document.getElementById(`editMenuPreviewContainer-${menuId}`);
    const preview = document.getElementById(`editMenuPreview-${menuId}`);
    const file = event.target.files[0];

    if (file) {
      preview.src = URL.createObjectURL(file);
      previewContainer.classList.remove('hidden');
    }
  }

  function removeEditMenuImage(menuId) {
    const input = document.getElementById(`edit_menu_photo-${menuId}`);
    const previewContainer = document.getElementById(`editMenuPreviewContainer-${menuId}`);
    input.value = '';
    previewContainer.classList.add('hidden');
  }
</script>