<dialog id="delete_modal_{{ $eventtype->eventtype_ID }}" class="modal">
  <div class="modal-box rounded-2xl">
    <h3 class="font-bold text-lg text-red-600 mb-2">Confirm Delete</h3>
    <p class="text-gray-600">Are you sure you want to delete <span class="font-semibold">{{ $eventtype->eventtype_name }}</span>?  
       This action cannot be undone.</p>

    <div class="modal-action">
      <!-- Cancel -->
      <button type="button" class="btn rounded-xl" 
              onclick="document.getElementById('delete_modal_{{ $eventtype->eventtype_ID }}').close()">Cancel</button>
      
      <!-- Confirm Delete -->
      <form action="/deleteecmtype/{{ $eventtype->eventtype_ID }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn bg-red-600 hover:bg-red-700 text-white rounded-xl">Delete</button>
      </form>
    </div>
  </div>
</dialog>