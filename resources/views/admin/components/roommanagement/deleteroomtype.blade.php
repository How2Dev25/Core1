<dialog id="deleteRoomModal_{{$roomtype->roomtypesID}}" class="modal">
    <div class="modal-box max-w-sm text-center">
        <i data-lucide="alert-triangle" class="w-12 h-12 text-red-500 mx-auto mb-4"></i>
        <h3 class="font-bold text-lg">Delete Room Type</h3>
        <p class="text-gray-600 mt-2">Are you sure you want to delete this room type?</p>
        <form action="/deleteroomtype/{{$roomtype->roomtypesID}}" method="POST" class="flex justify-center gap-2 mt-6">
            <!-- hidden ID for backend -->
            @method('DELETE')
            @csrf
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg">Yes,
                Delete</button>
            <button type="button"
                onclick="document.getElementById('deleteRoomModal_{{$roomtype->roomtypesID}}').close()"
                class="bg-gray-200 px-4 py-2 rounded-lg">Cancel</button>
        </form>
    </div>
</dialog>