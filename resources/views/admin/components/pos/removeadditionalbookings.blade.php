<dialog id="removeinventorybooking_{{ $bookedRooms->additionalsID }}" class="modal">
    <div class="modal-box bg-white shadow-2xl border border-gray-200 rounded-2xl max-w-md mx-auto">
        <div class="flex items-center gap-4 mb-6">
            <div class="w-14 h-14 bg-red-100 rounded-full flex items-center justify-center shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-red-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z" />
                </svg>
            </div>
            <h3 class="font-bold text-xl text-red-600">Remove Additional?</h3>
        </div>

        <p class="py-4 text-gray-600 leading-relaxed">
            Are you sure you want to remove this additional {{ $bookedRooms->core1_inventory_name }} from POS? This
            action cannot be undone.
        </p>

        <form method="POST" action="/deleteadditionalbooked/{{ $bookedRooms->additionalsID }}" class="flex gap-4 mt-6">
            @csrf
            @method('DELETE')
            <button type="button" class="btn btn-outline btn-neutral flex-1 hover:bg-gray-100 transition-colors"
                onclick="document.getElementById('removeinventorybooking_{{ $bookedRooms->additionalsID }}').close()">Cancel</button>
            <button type="submit"
                class="btn bg-red-600 hover:bg-red-700 text-white flex-1 shadow-md hover:shadow-lg transition-all">Confirm
                Remove</button>
        </form>
    </div>

    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>