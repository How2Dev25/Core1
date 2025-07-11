<dialog id="delete_room_{{ $room->roomID }}" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg">Delete Room</h3>
        <p class="py-4">Are you sure you want to delete "<span class="text-lg font-bold">{{ $room->roomID }}</span>"? This action cannot be undone.</p>
        
        <div class="modal-action">
            <form method="POST" action="/deleteroom/{{$room->roomID}}">
                @csrf
                @method('DELETE')
            
                <div class="mb-2 mt-2 w-full flex justify-center items-center">
                    <img class="rounded-md shadow-md w-full" src="{{asset($room->roomphoto)}}" alt="">
                </div>
            
                <div class="flex justify-center gap-2 mt-4">
                    <button type="submit" class="btn btn-error">Delete</button>
                     <button type="button" class="btn btn-ghost" onclick="delete_room_{{ $room->roomID }}.close()">Cancel</button> 
                </div>
            </form>
        </div>
    </div>
    
    <!-- Clicking outside closes the modal -->
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>