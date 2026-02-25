<!-- Inventory Modal -->
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

    <!-- Display Success Message -->
    @if(session('success'))
      <div class="alert alert-success mb-4">
        <i data-lucide="check-circle" class="w-5 h-5"></i>
        <span>{{ session('success') }}</span>
      </div>
    @endif

    <!-- Display Error Messages -->
    @if($errors->any())
      <div class="alert alert-error mb-4">
        <i data-lucide="alert-circle" class="w-5 h-5"></i>
        <div>
          <h4 class="font-bold">Please fix the following errors:</h4>
          <ul class="list-disc list-inside mt-2">
            @foreach($errors->all() as $error)
              <li class="text-sm">{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      </div>
    @endif

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
            <select id="itemNameSelect" name="core1_inventory_name" class="select select-bordered w-full @error('core1_inventory_name') select-error @enderror" required>
              <option disabled selected>Add Delivered Item</option>
            
              @forelse ($deliveredStocks as $delivered)
                <option value="{{ $delivered->core1_request_items }}" 
                        data-stock="{{ $delivered->core1_request_needed }}"
                        data-description="{{ $delivered->core1_request_description ?? '' }}"
                        data-category="{{ $delivered->core1_request_category ?? '' }}"
                        data-subcategory="{{ $delivered->core1_request_subcategory ?? '' }}"
                        data-unit="{{ $delivered->core1_request_unit ?? 'pcs' }}"
                        data-supplier="{{ $delivered->core1_request_supplier ?? '' }}"
                        data-supplier-contact="{{ $delivered->core1_request_supplier_contact ?? '' }}"
                        data-cost="{{ $delivered->core1_request_cost ?? '' }}"
                        data-location="{{ $delivered->core1_request_location ?? '' }}"
                        data-shelf="{{ $delivered->core1_request_shelf ?? '' }}"
                        {{ old('core1_inventory_name') == $delivered->core1_request_items ? 'selected' : '' }}>
                  {{ $delivered->core1_request_items }}
                </option>
              @empty
                <option disabled value="None">No Delivered Items</option>
              @endforelse
            </select>
            @error('core1_inventory_name')
              <label class="label">
                <span class="label-text-alt text-error">{{ $message }}</span>
              </label>
            @enderror
          </div>
          
          <!-- Category -->
          <div class="form-control">
            <label class="label">
              <span class="label-text">Category</span>
            </label>
            <div class="flex gap-2">
              <select id="categorySelect" name="core1_inventory_category" class="select select-bordered w-full @error('core1_inventory_category') select-error @enderror" required>
                <option disabled selected>Select category</option>
                <option value="Linens" {{ old('core1_inventory_category') == 'Linens' ? 'selected' : '' }}>Linens</option>
                <option value="Bath Amenities" {{ old('core1_inventory_category') == 'Bath Amenities' ? 'selected' : '' }}>Bath Amenities</option>
                <option value="Cleaning Supplies" {{ old('core1_inventory_category') == 'Cleaning Supplies' ? 'selected' : '' }}>Cleaning Supplies</option>
                <option value="Room Equipment" {{ old('core1_inventory_category') == 'Room Equipment' ? 'selected' : '' }}>Room Equipment</option>
              </select>
              <button type="button" class="btn btn-outline btn-primary" id="addCategoryBtn">Add</button>
            </div>
            @error('core1_inventory_category')
              <label class="label">
                <span class="label-text-alt text-error">{{ $message }}</span>
              </label>
            @enderror
          </div>

          <!-- DaisyUI Modal for Add Category -->
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
          
          <!-- Subcategory -->
          <div class="form-control">
            <label class="label">
              <span class="label-text">Subcategory</span>
            </label>
            <input type="text" id="subcategoryInput" name="core1_inventory_subcategory" placeholder="Optional" 
                   value="{{ old('core1_inventory_subcategory') }}"
                   class="input input-bordered w-full @error('core1_inventory_subcategory') input-error @enderror">
            @error('core1_inventory_subcategory')
              <label class="label">
                <span class="label-text-alt text-error">{{ $message }}</span>
              </label>
            @enderror
          </div>
          
          <!-- Storage Location -->
          <div class="form-control">
            <label class="label">
              <span class="label-text">Storage Location</span>
            </label>
            <input type="text" id="locationInput" name="core1_inventory_location" placeholder="Linen Closet A" 
                   value="{{ old('core1_inventory_location') }}"
                   class="input input-bordered w-full @error('core1_inventory_location') input-error @enderror" required>
            @error('core1_inventory_location')
              <label class="label">
                <span class="label-text-alt text-error">{{ $message }}</span>
              </label>
            @enderror
          </div>
          
          <!-- Shelf -->
          <div class="form-control">
            <label class="label">
              <span class="label-text">Shelf/Bin</span>
            </label>
            <input type="text" id="shelfInput" name="core1_inventory_shelf" placeholder="Shelf B3" 
                   value="{{ old('core1_inventory_shelf') }}"
                   class="input input-bordered w-full @error('core1_inventory_shelf') input-error @enderror">
            @error('core1_inventory_shelf')
              <label class="label">
                <span class="label-text-alt text-error">{{ $message }}</span>
              </label>
            @enderror
          </div>
        </div>
        
        <!-- Right Column -->
        <div class="space-y-3">
          <!-- Current Stock -->
          <div class="form-control">
            <label class="label">
              <span class="label-text">Current Stock</span>
            </label>
            <input type="number" id="currentStock" name="core1_inventory_stocks" min="0" 
                   value="{{ old('core1_inventory_stocks') }}"
                   class="input input-bordered w-full @error('core1_inventory_stocks') input-error @enderror" readonly required>
            @error('core1_inventory_stocks')
              <label class="label">
                <span class="label-text-alt text-error">{{ $message }}</span>
              </label>
            @enderror
          </div>
          
          <!-- Reorder Threshold -->
          <div class="form-control">
            <label class="label">
              <span class="label-text">Reorder Threshold</span>
            </label>
            <input type="number" id="thresholdInput" name="core1_inventory_threshold" min="1" 
                   value="{{ old('core1_inventory_threshold') }}"
                   class="input input-bordered w-full @error('core1_inventory_threshold') input-error @enderror" required>
            @error('core1_inventory_threshold')
              <label class="label">
                <span class="label-text-alt text-error">{{ $message }}</span>
              </label>
            @enderror
          </div>
          
          <!-- Unit -->
          <div class="form-control">
            <label class="label">
              <span class="label-text">Unit</span>
            </label>
            <select id="unitSelect" name="core1_inventory_unit" class="select select-bordered w-full @error('core1_inventory_unit') select-error @enderror" required>
              <option disabled selected>Select unit</option>
              <option value="pcs" {{ old('core1_inventory_unit') == 'pcs' ? 'selected' : '' }}>pcs</option>
              <option value="kg" {{ old('core1_inventory_unit') == 'kg' ? 'selected' : '' }}>kg</option>
              <option value="liters" {{ old('core1_inventory_unit') == 'liters' ? 'selected' : '' }}>liters</option>
              <option value="sets" {{ old('core1_inventory_unit') == 'sets' ? 'selected' : '' }}>sets</option>
              <option value="bottles" {{ old('core1_inventory_unit') == 'bottles' ? 'selected' : '' }}>bottles</option>
              <option value="boxes" {{ old('core1_inventory_unit') == 'boxes' ? 'selected' : '' }}>boxes</option>
            </select>
            @error('core1_inventory_unit')
              <label class="label">
                <span class="label-text-alt text-error">{{ $message }}</span>
              </label>
            @enderror
          </div>
          
          <!-- Supplier -->
          <div class="form-control">
            <label class="label">
              <span class="label-text">Supplier</span>
            </label>
            <input type="text" id="supplierInput" name="core1_inventory_supplier" placeholder="Supplier Name" 
                   value="{{ old('core1_inventory_supplier') }}"
                   class="input input-bordered w-full @error('core1_inventory_supplier') input-error @enderror">
            @error('core1_inventory_supplier')
              <label class="label">
                <span class="label-text-alt text-error">{{ $message }}</span>
              </label>
            @enderror
          </div>
          
          <!-- Supplier Contact -->
          <div class="form-control">
            <label class="label">
              <span class="label-text">Supplier Contact</span>
            </label>
            <input type="text" id="supplierContactInput" name="core1_inventory_supplier_contact" placeholder="Phone/Email" 
                   value="{{ old('core1_inventory_supplier_contact') }}"
                   class="input input-bordered w-full @error('core1_inventory_supplier_contact') input-error @enderror">
            @error('core1_inventory_supplier_contact')
              <label class="label">
                <span class="label-text-alt text-error">{{ $message }}</span>
              </label>
            @enderror
          </div>
          
          <!-- Cost -->
          <div class="form-control">
            <label class="label">
              <span class="label-text">Unit Cost</span>
            </label>
            <input type="number" id="costInput" name="core1_inventory_cost" min="0" step="0.01" 
                   value="{{ old('core1_inventory_cost') }}"
                   placeholder="0.00" class="input input-bordered w-full @error('core1_inventory_cost') input-error @enderror">
            @error('core1_inventory_cost')
              <label class="label">
                <span class="label-text-alt text-error">{{ $message }}</span>
              </label>
            @enderror
          </div>
        </div>
      </div>
      
      <!-- Full Width Fields -->
      <div class="form-control">
        <label class="label">
          <span class="label-text">Description</span>
        </label>
        <textarea id="descriptionTextarea" name="core1_inventory_description" class="textarea textarea-bordered h-24 @error('core1_inventory_description') textarea-error @enderror" 
                  placeholder="Item details...">{{ old('core1_inventory_description') }}</textarea>
        @error('core1_inventory_description')
          <label class="label">
            <span class="label-text-alt text-error">{{ $message }}</span>
          </label>
        @enderror
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
                   class="file-input file-input-bordered w-full @error('core1_inventory_image') file-input-error @enderror"
                   onchange="previewPhoto(event)">
            <div class="text-xs mt-2 text-gray-500">Max 2MB (JPEG, PNG, JPG, GIF)</div>
            @error('core1_inventory_image')
              <label class="label">
                <span class="label-text-alt text-error">{{ $message }}</span>
              </label>
            @enderror
          </div>
        </div>
      </div>
      
      <!-- Form Actions -->
      <div class="modal-action">
        <button type="button" onclick="document.getElementById('inventory_modal').close()" class="btn btn-ghost">
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

<!-- JavaScript -->
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

  // Auto-populate all fields based on selected item
  document.addEventListener('DOMContentLoaded', function() {
    const itemSelect = document.getElementById('itemNameSelect');
    const currentStock = document.getElementById('currentStock');
    const descriptionInput = document.getElementById('descriptionTextarea');
    const categorySelect = document.getElementById('categorySelect');
    const subcategoryInput = document.getElementById('subcategoryInput');
    const unitSelect = document.getElementById('unitSelect');
    const supplierInput = document.getElementById('supplierInput');
    const supplierContactInput = document.getElementById('supplierContactInput');
    const costInput = document.getElementById('costInput');
    const locationInput = document.getElementById('locationInput');
    const shelfInput = document.getElementById('shelfInput');
    const thresholdInput = document.getElementById('thresholdInput');
    
    if (itemSelect) {
      itemSelect.addEventListener('change', function () {
        const selectedOption = this.options[this.selectedIndex];
        
        // Get all data attributes
        const stock = selectedOption.getAttribute('data-stock');
        const description = selectedOption.getAttribute('data-description');
        const category = selectedOption.getAttribute('data-category');
        const subcategory = selectedOption.getAttribute('data-subcategory');
        const unit = selectedOption.getAttribute('data-unit');
        const supplier = selectedOption.getAttribute('data-supplier');
        const supplierContact = selectedOption.getAttribute('data-supplier-contact');
        const cost = selectedOption.getAttribute('data-cost');
        const location = selectedOption.getAttribute('data-location');
        const shelf = selectedOption.getAttribute('data-shelf');
        
        // Update fields if values exist
        if (stock !== null) {
          currentStock.value = stock;
        }
        
        if (description) {
          descriptionInput.value = description;
        }
        
        if (category) {
          // Check if category exists in select, if not add it
          let categoryExists = false;
          for(let i = 0; i < categorySelect.options.length; i++) {
            if(categorySelect.options[i].value === category) {
              categorySelect.selectedIndex = i;
              categoryExists = true;
              break;
            }
          }
          
          if(!categoryExists && category) {
            const option = document.createElement('option');
            option.textContent = category;
            option.value = category;
            option.selected = true;
            categorySelect.appendChild(option);
          }
        }
        
        if (subcategory) {
          subcategoryInput.value = subcategory;
        }
        
        if (unit) {
          for(let i = 0; i < unitSelect.options.length; i++) {
            if(unitSelect.options[i].value === unit) {
              unitSelect.selectedIndex = i;
              break;
            }
          }
        }
        
        if (supplier) {
          supplierInput.value = supplier;
        }
        
        if (supplierContact) {
          supplierContactInput.value = supplierContact;
        }
        
        if (cost) {
          costInput.value = cost;
        }
        
        if (location) {
          locationInput.value = location;
        }
        
        if (shelf) {
          shelfInput.value = shelf;
        }
        
        // Set default threshold if not set (maybe 10 or based on some logic)
        if (!thresholdInput.value) {
          thresholdInput.value = 10; // Default threshold
        }
      });

      // Trigger change event if there's an old value
      @if(old('core1_inventory_name'))
        const oldValue = "{{ old('core1_inventory_name') }}";
        for(let i = 0; i < itemSelect.options.length; i++) {
          if(itemSelect.options[i].value === oldValue) {
            itemSelect.selectedIndex = i;
            itemSelect.dispatchEvent(new Event('change'));
            break;
          }
        }
      @endif
    }
  });

  // Add Category Modal functionality
  document.addEventListener('DOMContentLoaded', function() {
    const addCategoryBtn = document.getElementById('addCategoryBtn');
    const saveCategoryBtn = document.getElementById('saveCategoryBtn');
    const categorySelect = document.getElementById('categorySelect');
    const newCategoryInput = document.getElementById('newCategoryInput');
    const addCategoryModalCheckbox = document.getElementById('addCategoryModal');

    if (addCategoryBtn) {
      // Open modal when "Add" button is clicked
      addCategoryBtn.addEventListener('click', () => {
        newCategoryInput.value = ''; // Clear input
        addCategoryModalCheckbox.checked = true;
      });
    }

    if (saveCategoryBtn) {
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
    }

    // Clear modal when clicking outside
    const modalBackdrop = document.querySelector('#addCategoryModal + .modal .modal-backdrop button');
    if (modalBackdrop) {
      modalBackdrop.addEventListener('click', () => {
        addCategoryModalCheckbox.checked = false;
      });
    }
  });
</script>

<!-- Auto-open modal if there are errors -->
@if($errors->any())
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      document.getElementById('inventory_modal').showModal();
    });
  </script>
@endif