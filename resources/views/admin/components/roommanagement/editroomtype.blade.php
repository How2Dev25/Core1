<!-- Edit Room Modal -->
<dialog id="editRoomModal_{{$roomtype->roomtypesID}}" class="modal">
    <div class="modal-box max-w-lg">
        <h3 class="font-bold text-lg mb-4">Edit Room Type</h3>
        <form action="/modifyroomtype/{{$roomtype->roomtypesID}}" method="POST" class="space-y-4">
            @method('PUT')
            @csrf
            <!-- hidden ID for backend -->
            <div>
                <label class="block text-sm font-medium">Room Type Name</label>
                <input type="text" name="roomtype_name" required class="w-full border border-gray-300 rounded-lg p-2"
                    value="{{$roomtype->roomtype_name}}">
            </div>
            <div>
                <label class="block text-sm font-medium">Description</label>
                <textarea name="roomtype_description" required
                    class="w-full border border-gray-300 rounded-lg p-2">{{$roomtype->roomtype_description}}</textarea>
            </div>
            <div class="flex justify-end gap-2 mt-4">
                <button type="submit" class="bg-blue-900 text-white px-4 py-2 rounded-lg">Update</button>
                <button type="button"
                    onclick="document.getElementById('editRoomModal_{{$roomtype->roomtypesID}}').close()"
                    class="bg-gray-200 px-4 py-2 rounded-lg">Cancel</button>
            </div>
        </form>
    </div>
</dialog>