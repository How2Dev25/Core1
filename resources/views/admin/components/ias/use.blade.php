<dialog id="stock_modal_{{$inv->core1_inventoryID}}" class="modal">
  <div class="modal-box max-w-md">
    <div class="flex justify-between items-start mb-4">
      <h3 class="text-xl font-bold">Stock Adjustment</h3>
      <form method="dialog">
        <button class="btn btn-circle btn-ghost btn-sm">
          <i data-lucide="x" class="w-5 h-5"></i>
        </button>
      </form>
    </div>
    
    <div class="flex gap-4 mb-6">
      <div class="shrink-0">
        <img src="{{asset($inv->core1_inventory_image)}}" alt="Stock Item" class="w-24 h-24 object-cover rounded-lg border">
      </div>
      <div>
        <h4 class="font-bold text-lg">{{$inv->core1_inventory_name}}</h4>
        <div class="grid grid-cols-2 gap-2 text-sm mt-2">
          <div>
            <span class="text-gray-500">Stock ID:</span>
            <span>{{$inv->core1_inventory_code}}</span>
          </div>
          <div>
            <span class="text-gray-500">Category:</span>
            <span>{{$inv->core1_inventory_category}}</span>
          </div>
          <div>
            <span class="text-gray-500">Unit:</span>
            <span>{{$inv->core1_inventory_unit}}</span>
          </div>
          <div>
            <span class="text-gray-500">Available:</span>
            <span class="font-bold 
  @if ($inv->core1_inventory_stocks == 0)
    text-red-500
  @elseif ($inv->core1_inventory_stocks <= $inv->core1_inventory_threshold)
    text-orange-400
  @endif">
  {{$inv->core1_inventory_stocks}}
</span>
          </div>
        </div>
      </div>
    </div>
    
    <form action="/usestocks/{{$inv->core1_inventoryID}}" method="POST">
        @csrf
        @method('PUT')
      <div class="form-control w-full mb-4">
        <label class="label">
          <span class="label-text">Quantity to Use</span>
          <span class="label-text-alt">Max: {{$inv->core1_inventory_threshold}}</span>
        </label>
        <input type="number" 
                name="useItem"
               min="1" 
               max="{{$inv->core1_inventory_threshold}}" 
               value="1"
               class="input input-bordered w-full"
               placeholder="Enter quantity">
      </div>
      
      <div class="modal-action">
        <button type="button" class="btn btn-ghost" onclick="stock_modal_{{$inv->core1_inventoryID}}.close()">
          Cancel
        </button>
        <button type="submit" class="btn btn-primary">
          <i data-lucide="check-circle" class="w-5 h-5 mr-1"></i>
          Confirm Usage
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
  // Initialize Lucide icons
  lucide.createIcons();
</script>