<dialog id="approve_modal_{{$event->eventID}}" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg">Approve Event</h3>
        <p class="py-4">Are you sure you want to Approve "<span class="text-lg font-bold">{{$event->eventname}}</span>"? This action cannot be undone.</p>
        
        <div class="modal-action">
            <form method="POST" action="/approveecm/{{$event->eventID}}">
                @csrf
                @method('PUT')
                <button type="button" class="btn btn-ghost" onclick="approve_modal_{{ $event->eventID }}.close()">Cancel</button> 
                <button type="submit" class="btn btn-primary">Approve</button>
            </form>
        </div>
    </div>
    
    <!-- Clicking outside closes the modal -->
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>