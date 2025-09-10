<dialog id="deleteordermodal-{{$carts->cartID}}" class="modal">
    <div class="modal-box bg-white rounded-xl p-6 max-w-md text-center">
        <div class="flex justify-center mb-4">
            <div class="w-12 h-12 flex items-center justify-center rounded-full bg-red-100">
                <i data-lucide="alert-triangle" class="w-6 h-6 text-red-600"></i>
            </div>
        </div>

        <h3 class="text-lg font-bold text-gray-800">Delete Order?</h3>
        <p class="text-sm text-gray-600 mt-2">
            Are you sure you want to remove <span class="font-semibold">{{$carts->menu_name}}</span>?
            This action cannot be undone.
        </p>

        <form action="/deletecart/{{$carts->cartID}}" method="POST" class="mt-6 flex justify-center gap-3">
            @csrf
            @method('DELETE')
            <button onclick="document.getElementById('deleteordermodal-{{$carts->cartID}}').close()" type="button"
                class="px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-100">
                Cancel
            </button>
            <button type="submit" class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700 shadow-md">
                Delete
            </button>
        </form>
    </div>
</dialog>