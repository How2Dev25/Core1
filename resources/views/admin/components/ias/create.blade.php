<dialog id="inventory_modal" class="modal">
  <div class="modal-box w-11/12 max-w-3xl">
    <form method="dialog">
      <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">
        <i data-lucide="x" class="w-4 h-4"></i>
      </button>
    </form>
    
    <h3 class="font-bold text-lg flex items-center gap-2 mb-4">
      <i data-lucide="package-plus" class="w-5 h-5 text-primary"></i>
      New Inventory Item
    </h3>

    <form method="POST" action="/createinventory" enctype="multipart/form-data" class="space-y-4">
      @csrf
      
      <!-- 2 Column Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        
        <!-- Left Column -->
        <div class="space-y-3">
          <!-- Item Name -->
          <div class="form-control">
            <label class="label">
              <span class="label-text">Item Name</span>
            </label>

            <select id="categorySelect" name="core1_inventory_name" class="select select-bordered w-full" required>
              <option disabled selected>Add Delivered Item</option>
            
              @forelse ($deliveredStocks as $delivered)
                <option value="{{ $delivered->core1_request_items }}" data-stock="{{ $delivered->core1_request_needed }}">
                  {{ $delivered->core1_request_items }}
                </option>
              @empty
                <option disabled value="None">No Delivered Items</option>
              @endforelse
            </select>
          </div>
          
         
       
          
          <!-- Category -->
         <div class="form-control">
  <label class="label">
    <span class="label-text">Category</span>
  </label>
  <div class="flex gap-2">
    <select id="categorySelect" name="core1_inventory_category" class="select select-bordered w-full" required>
      <option disabled selected>Select category</option>
      <option>Linens</option>
      <option>Bath Amenities</option>
      <option>Cleaning Supplies</option>
      <option>Room Equipment</option>
    </select>
    <button type="button" class="btn btn-outline btn-primary" id="addCategoryBtn">Add</button>
  </div>
</div>

<!-- DaisyUI Modal -->
<input type="checkbox" id="addCategoryModal" class="modal-toggle" />
<div class="modal">
  <div class="modal-box">
    <h3 class="font-bold text-lg">Add New Category</h3>
    <input type="text" id="newCategoryInput" placeholder="Enter category name" class="input input-bordered w-full mt-4" />
    <div class="modal-action">
      <label for="addCategoryModal" class="btn btn-ghost">Cancel</label>
      <button class="btn btn-primary" id="saveCategoryBtn">Save</button>
    </div>
  </div>
</div>

<script>
  const addCategoryBtn = document.getElementById('addCategoryBtn');
  const saveCategoryBtn = document.getElementById('saveCategoryBtn');
  const categorySelect = document.getElementById('categorySelect');
  const newCategoryInput = document.getElementById('newCategoryInput');
  const addCategoryModalCheckbox = document.getElementById('addCategoryModal');

  // Open modal when "Add" button is clicked
  addCategoryBtn.addEventListener('click', () => {
    newCategoryInput.value = ''; // Clear input
    addCategoryModalCheckbox.checked = true;
  });

  // Save new category
  saveCategoryBtn.addEventListener('click', () => {
    const newCategory = newCategoryInput.value.trim();
    if (newCategory) {
      // Create new option and select it
      const option = document.createElement('option');
      option.textContent = newCategory;
      option.value = newCategory;
      option.selected = true;
      categorySelect.appendChild(option);

      // Close modal
      addCategoryModalCheckbox.checked = false;
    } else {
      alert('Please enter a category name.');
    }
  });
</script>
          
          <!-- Subcategory -->
          <div class="form-control">
            <label class="label">
              <span class="label-text">Subcategory</span>
            </label>
            <input type="text" name="core1_inventory_subcategory" placeholder="Optional" 
                   class="input input-bordered w-full">
          </div>
          
          <!-- Storage Location -->
          <div class="form-control">
            <label class="label">
              <span class="label-text">Storage Location</span>
            </label>
            <input type="text" name="core1_inventory_location" placeholder="Linen Closet A" 
                   class="input input-bordered w-full" required>
          </div>
          
          <!-- Shelf -->
          <div class="form-control">
            <label class="label">
              <span class="label-text">Shelf/Bin</span>
            </label>
            <input type="text" name="core1_inventory_shelf" placeholder="Shelf B3" 
                   class="input input-bordered w-full">
          </div>
        </div>
        
        <!-- Right Column -->
        <div class="space-y-3">
          <!-- Current Stock -->
          <div class="form-control">
            <label class="label">
              <span class="label-text">Current Stock</span>
            </label>
          <input readonly type="number" id="currentStock" name="core1_inventory_stocks" min="0" class="input input-bordered w-full"
            required>

            <script>
              document.getElementById('categorySelect').addEventListener('change', function () {
                const selectedOption = this.options[this.selectedIndex];
                const stock = selectedOption.getAttribute('data-stock');

                if (stock !== null) {
                  document.getElementById('currentStock').value = stock;
                }
              });
            </script>
          </div>
          
          <!-- Reorder Threshold -->
          <div class="form-control">
            <label class="label">
              <span class="label-text">Reorder Threshold</span>
            </label>
            <input type="number" name="core1_inventory_threshold" min="1" 
                   class="input input-bordered w-full" required>
          </div>
          
          <!-- Unit -->
          <div class="form-control">
            <label class="label">
              <span class="label-text">Unit</span>
            </label>
            <select name="core1_inventory_unit" class="select select-bordered w-full" required>
              <option disabled selected>Select unit</option>
              <option>pcs</option>
              <option>kg</option>
              <option>liters</option>
              <option>sets</option>
            </select>
          </div>
          
          <!-- Supplier -->
          <div class="form-control">
            <label class="label">
              <span class="label-text">Supplier</span>
            </label>
            <input type="text" name="core1_inventory_supplier" placeholder="Supplier Name" 
                   class="input input-bordered w-full">
          </div>
          
          <!-- Supplier Contact -->
          <div class="form-control">
            <label class="label">
              <span class="label-text">Supplier Contact</span>
            </label>
            <input type="text" name="core1_inventory_supplier_contact" placeholder="Phone/Email" 
                   class="input input-bordered w-full">
          </div>
          
          <!-- Cost -->
          <div class="form-control">
            <label class="label">
              <span class="label-text">Unit Cost</span>
            </label>
            <input type="number" name="core1_inventory_cost" min="0" step="0.01" 
                   placeholder="0.00" class="input input-bordered w-full">
          </div>
        </div>
      </div>
      
      <!-- Full Width Fields -->
      <div class="form-control">
        <label class="label">
          <span class="label-text">Description</span>
        </label>
        <textarea name="core1_inventory_description" class="textarea textarea-bordered h-24" 
                  placeholder="Item details..."></textarea>
      </div>
      
      <!-- Photo Upload Section -->
      <div class="form-control">
        <label class="label">
          <span class="label-text">Item Photo</span>
        </label>
        <div class="flex flex-col md:flex-row gap-4 items-center">
          <!-- Photo Preview -->
          <div class="avatar">
            <div class="w-24 h-24 rounded-lg bg-base-200 flex items-center justify-center">
              <img id="inventory-photo-preview" src="" alt="Preview" class="hidden object-cover w-full h-full rounded-lg">
              <i data-lucide="image" class="w-12 h-12 text-gray-400" id="photo-placeholder"></i>
            </div>
          </div>
          
          <!-- Upload Controls -->
          <div class="flex-1">
            <input type="file" 
                   name="core1_inventory_image" 
                   id="inventory-photo-input" 
                   accept="image/*" 
                   class="file-input file-input-bordered w-full"
                   onchange="previewPhoto(event)">
            <div class="text-xs mt-2 text-gray-500">Max 2MB (JPEG, PNG, JPG)</div>
          </div>
        </div>
      </div>
      
      <!-- Form Actions -->
      <div class="modal-action">
        <button type="button" onclick="inventory_modal.close()" class="btn btn-ghost">
          Cancel
        </button>
        <button type="submit" class="btn btn-primary">
          <i data-lucide="save" class="w-4 h-4 mr-2"></i>
          Save Item
        </button>
      </div>
    </form>
  </div>
  
  <!-- Click outside to close -->
  <form method="dialog" class="modal-backdrop">
    <button>close</button>
  </form>
</dialog>

<script>
  // Photo preview functionality
  function previewPhoto(event) {
    const input = event.target;
    const preview = document.getElementById('inventory-photo-preview');
    const placeholder = document.getElementById('photo-placeholder');
    
    if (input.files && input.files[0]) {
      const reader = new FileReader();
      
      reader.onload = function(e) {
        preview.src = e.target.result;
        preview.classList.remove('hidden');
        placeholder.classList.add('hidden');
      }
      
      reader.readAsDataURL(input.files[0]);
    } else {
      preview.src = '';
      preview.classList.add('hidden');
      placeholder.classList.remove('hidden');
    }
  }
</script>