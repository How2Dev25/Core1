  <div wire:poll.5s = "fetchreservedrooms" class="card bg-white border border-gray-200 mt-5">
    
    <div class="card-body p-0">
      <div class="flex flex-col md:flex-row justify-between items-start md:items-center p-5 pb-0">
        <h3 class="text-xl font-bold text-gray-800">Reserved And Occupied Rooms</h3>
        
      </div>
      
      <div class="overflow-x-auto">
        <table class="table">
          <thead>
            <tr>
              <th class="bg-gray-50">Room No.</th>
              <th class="bg-gray-50">Type</th>
              <th class="bg-gray-50">Booking Status</th>
              <th class="bg-gray-50">Guest</th>
              <th class="bg-gray-50">Booked Via</th>
              <th class="bg-gray-50">Check-In</th>
              <th class="bg-gray-50">Check-Out</th>
              <th class="bg-gray-50 text-right">Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse($reserverooms as $reserveroom)
            <tr class="hover:bg-gray-50">
              <td>{{$reserveroom->roomID}}</td>
              <td>
                <div class="flex items-center gap-2">
                  <div class="badge badge-primary badge-xs"></div>
                  {{$reserveroom->roomtype}}
                </div>
              </td>
              <td>
              <span class="badge 
                        @if(strtolower($reserveroom->reservation_bookingstatus) == 'pending') badge-neutral
                        @elseif(strtolower($reserveroom->reservation_bookingstatus) == 'confirmed') badge-success
                        @elseif(strtolower($reserveroom->reservation_bookingstatus) == 'checked in') badge-primary
                         @elseif(strtolower($reserveroom->reservation_bookingstatus) == 'checked out') badge-warning
                        @elseif(strtolower($reserveroom->reservation_bookingstatus) == 'cancelled') badge-error
                        @endif
                    ">
                        {{ $reserveroom->reservation_bookingstatus }}
                    </span>
                </td>
              <td>{{$reserveroom->guestname}}</td>
               <td>{{$reserveroom->bookedvia}}</td>
              <td>{{$reserveroom->reservation_checkin}}</td>
              <td>{{$reserveroom->reservation_checkout}}</td>
              <td class="text-right">
                <button onclick="edit_reservation_{{$reserveroom->reservationID}}.showModal()" class="btn btn-primary btn-sm">
                  
                    Edit
                </button>
                <button  onclick="delete_reservation_{{$reserveroom->reservationID}}.showModal()" class="btn btn-error btn-sm">
                   
                    Remove</button>
              </td>
            </tr>
            @empty

            @endforelse
        
          </tbody>
        </table>
      </div>
      
     
    
    </div>
  </div>

  