<dialog id="delete_modal_{{$event->eventID}}" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg">Delete Event</h3>
        <p class="py-4">Are you sure you want to delete "<span class="text-lg font-bold">{{$event->eventname}}</span>"? This action cannot be undone.</p>
        
        <div class="modal-action">
            <form method="POST" action="/deleteecm/{{$event->eventID}}">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-ghost" onclick="delete_modal_{{ $event->eventID }}.close()">Cancel</button> 
                <button type="submit" class="btn btn-error">Delete</button>
            </form>
        </div>
    </div>
    
    <!-- Clicking outside closes the modal -->
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>