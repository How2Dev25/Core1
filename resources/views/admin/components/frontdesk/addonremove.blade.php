<dialog id="deleteAddon_{{ $booking->additionalbookingID }}" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg mb-4 text-error">Remove Addons</h3>
        <p class="py-4">Are you sure you want to delete this additional Addons? This action cannot be undone.</p>

        <div class="bg-red-50 p-4 rounded-lg mb-4 border border-red-200">
            <div class="grid grid-cols-2 gap-2 text-sm">
                <div class="font-semibold">Booking ID: {{ $booking->bookingID}} </div>
                <div class="font-semibold">Inventory: {{ $booking->core1_inventory_name }}</div>
                <div class="font-semibold">Quantity: {{ $booking->additional_quantity }} </div>
                <div class="font-semibold">Total Price: {{ $booking->additional_total }} </div>
                
            </div>
        </div>

        <form method="POST" action="/addonRemove/{{$booking->additionalbookingID }}">
            @csrf
            @method('DELETE')
            <div class="modal-action">
                <button type="button" class="btn btn-ghost" onclick="document.getElementById('deleteAddon_{{ $booking->additionalbookingID }}').close()">Cancel</button>
                <button type="submit" class="btn btn-error">Remove Addon</button>
            </div>
        </form>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>