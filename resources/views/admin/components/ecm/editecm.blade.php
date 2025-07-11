<dialog id="edit_modal_{{$event->eventID}}" class="modal">
    <div class="modal-box">
     
      <form action="/editecm/{{$event->eventID}}" method="POST" enctype="multipart/form-data" class="max-w-3xl mx-auto p-6  rounded-xl">
        @csrf
        @method('PUT')
    
        <h2 class="text-2xl font-bold mb-6 text-center">Modify {{$event->eventname}}</h2>
    
        {{-- Event Photo --}}
        <div class="mb-4 flex justify-center items-center">
           <img id="editphoto" class="rounded-md shadow-md" src="{{asset($event->eventphoto)}}" alt="">
        </div>


        <div class="mb-4">
            <label class="label font-semibold">Event Photo</label>
            <input id="editdropzone-file" type="file" name="eventphoto" accept="image/*" class="file-input file-input-bordered w-full max-w-md" />
            <label class="label text-xs text-gray-500">Max size: 2MB</label>
        </div>
    
        {{-- Event Name --}}
        <div class="mb-4">
            <label class="label font-semibold">Event Name</label>
            <input type="text" value="{{$event->eventname}}" name="eventname" class="input input-bordered w-full" placeholder="e.g. Business Leadership Summit" required>
        </div>
    
        {{-- Event Type --}}
        <div class="mb-4">
            <label class="label font-semibold">Event Type</label>
            <select name="eventtype" class="select select-bordered w-full" required>
                <option value="">Select type</option>
                <option value="Conference" {{ $event->eventtype == 'Conference' ? 'selected' : '' }}>Conference</option>
                <option value="Wedding" {{ $event->eventtype == 'Wedding' ? 'selected' : '' }}>Wedding</option>
                <option value="Birthday" {{ $event->eventtype == 'Birthday' ? 'selected' : '' }}>Birthday</option>
                <option value="Corporate" {{ $event->eventtype == 'Corporate' ? 'selected' : '' }}>Corporate</option>
            </select>
        </div>
    
        {{-- Organizer Details --}}
        <div class="mb-4">
            <label class="label font-semibold">Organizer Name</label>
            <input type="text" value="{{$event->eventorganizername}}" name="eventorganizername" class="input input-bordered w-full" placeholder="e.g. John Doe" required>
        </div>
    
        <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="label font-semibold">Contact Email</label>
                <input type="email" value="{{$event->eventcontactemail}}" name="eventcontactemail" class="input input-bordered w-full" placeholder="email@example.com" required>
            </div>
            <div>
                <label class="label font-semibold">Contact Number</label>
                <input type="text" value="{{$event->eventcontactnumber}}" name="eventcontactnumber" class="input input-bordered w-full" placeholder="e.g. 0917xxxxxxx">
            </div>
        </div>
        
        {{-- Schedule --}}
        <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="label font-semibold">Event Date</label>
                <input type="date" value="{{$event->eventdate}}" name="eventdate" class="input input-bordered w-full" required>
            </div>

             {{-- Days --}}
      

            <div class="grid grid-cols-2 gap-2">
                <div>
                    <label class="label font-semibold">Start Time</label>
                    <input type="time" value="{{$event->event_time_start}}" name="event_time_start" class="input input-bordered w-full" required>
                </div>
                <div>
                    <label class="label font-semibold">End Time</label>
                    <input type="time" value="{{$event->event_time_end}}" name="event_time_end" class="input input-bordered w-full" required>
                </div>
            </div>
        </div>
        {{-- days --}}
        <div class="mb-4">
            <label class="label font-semibold">Event Days</label>
            <input type="number" value="{{$event->eventdays}}" name="eventdays" class="input input-bordered w-full" placeholder="e.g. 3">
        </div>
    
        {{-- Guests --}}
        <div class="mb-4">
            <label class="label font-semibold">Expected Guests</label>
            <input type="number" value="{{$event->eventexpectedguest}}" name="eventexpectedguest" class="input input-bordered w-full" placeholder="e.g. 100">
        </div>
       
    
        {{-- Room Booking Toggle --}}
        <div class="mb-4">
            <label class="label font-semibold">Need Room Bookings?</label>
            <select name="eventneedroombooking" class="select select-bordered w-full" required>
                <option value="No" {{ $event->eventneedroombooking == 'No' ? 'selected' : '' }}>No</option>
                <option value="Yes" {{ $event->eventneedroombooking == 'Yes' ? 'selected' : '' }}>Yes</option>
            </select>
        </div>
    
        {{-- Equipment --}}
        <div class="mb-4">
            <label class="label font-semibold">Room Equipments</label>
            <textarea name="eventequipment" class="textarea textarea-bordered w-full" rows="3" placeholder="e.g. Speakers, Microphones, Lights">{{$event->eventequipment}}</textarea>
        </div>
    
        {{-- Special Requests --}}
        <div class="mb-4">
            <label class="label font-semibold">Special Requests</label>
            <textarea name="eventspecialrequest" class="textarea textarea-bordered w-full" rows="3" placeholder="e.g. Arrange vegetarian catering, custom banners...">{{$event->eventspecialrequest}}</textarea>
        </div>
    
       
    
        {{-- Status --}}
        <div class="mb-4">
            <label class="label font-semibold">Event Status</label>
            <select name="eventstatus" class="select select-bordered w-full">
                <option value="Pending" {{ $event->eventstatus == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Approved" {{ $event->eventstatus == 'Approved' ? 'selected' : '' }}>Approved</option>
                <option value="Cancelled" {{ $event->eventstatus == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>
        {{-- Submit --}}
        <div class="text-center">
            <button type="submit" class="btn btn-primary w-full md:w-1/2">Submit Event</button>
        </div>
    </form>
    </div>
    <form method="dialog" class="modal-backdrop">
      <button>close</button>
    </form>
  </dialog>