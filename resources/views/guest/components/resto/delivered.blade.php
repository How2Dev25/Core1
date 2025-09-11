<dialog id="deliverordermodal-{{$carts->orderID}}" class="modal">
    <div class="modal-box bg-white rounded-xl p-6 max-w-md text-center">
        <div class="flex justify-center mb-4">
            <div class="w-12 h-12 flex items-center justify-center rounded-full bg-blue-900">
                <i data-lucide="check-circle" class="w-6 h-6 text-yellow-400"></i>
            </div>
        </div>

        <h3 class="text-lg font-bold text-gray-800">Has Your Order Arrived?</h3>
        <p class="text-sm text-gray-600 mt-2">
            Looks like <span class="font-semibold">{{ $carts->menu_name }}</span> already made its grand entrance to
            your room — the flavors are waiting for you.
        </p>

        <form action="/deliverorder/{{$carts->orderID}}" method="POST" class="mt-6 flex justify-center gap-3">
            @csrf
            @method('PUT')
            <button onclick="document.getElementById('deliverordermodal-{{$carts->orderID}}').close()" type="button"
                class="px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-100">
                Cancel
            </button>
            <button type="submit" class="px-4 py-2 rounded-lg bg-blue-900 text-white hover:bg-blue-700 shadow-md">
                Confirm
            </button>
        </form>
    </div>
</dialog>