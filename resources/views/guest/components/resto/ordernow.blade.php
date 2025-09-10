<!-- Order Modal -->
<dialog id="order_modal_{{ $menu->menuID }}" class="modal">
  <div class="modal-box max-w-xl bg-white rounded-2xl shadow-xl">
    <!-- Header -->
    <h3 class="font-bold text-xl text-gray-800 mb-4 flex items-center gap-2">
      <i data-lucide="utensils-crossed" class="w-5 h-5 text-[#F7B32B]"></i>
      Place Your Order
    </h3>

    <!-- Form -->
    <form action="/addtocart" method="POST" class="space-y-4">
      @csrf
      <input type="hidden" name="menuID" value="{{ $menu->menuID }}">

      <!-- Menu Photo -->
      <div class="w-full h-48 rounded-xl overflow-hidden mb-4">
        <img src="{{ asset($menu->menu_photo) }}" 
             alt="{{ $menu->menu_name }}" 
             class="w-full h-full object-cover">
      </div>

      <!-- Menu Details -->
      <div>
        <h4 class="text-lg font-semibold text-gray-900">{{ $menu->menu_name }}</h4>
        <p class="text-sm text-gray-600">{{ $menu->menu_description }}</p>
      </div>

      <!-- Quantity -->
      <div>
        <label for="quantity_{{ $menu->menuID }}" class="block text-sm font-medium text-gray-700">Quantity</label>
        <input type="number" name="order_quantity" id="quantity_{{ $menu->menuID }}" 
               class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500" 
               value="1" min="1" required>
      </div>

      <!-- Booking ID with Room Image -->
    <div>
    <label for="bookingID_{{ $menu->menuID }}" class="block text-sm font-medium text-gray-700">Checked In Room</label>
    <select name="bookingID" id="bookingID_{{ $menu->menuID }}" 
            class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500" required
            onchange="updateRoomImage_{{ $menu->menuID }}(this.value)">
      <option value="" disabled selected>Select Booking</option>
      @forelse ($checkinroom as $booking)
          <option value="{{ $booking->bookingID }}" data-image="{{ asset($booking->roomphoto) }}">
            {{$booking->roomID}} - {{$booking->roomtype}} - {{$booking->bookingID}}
          </option>
      @empty
          <option value="" disabled>No bookings available</option>
      @endforelse
    </select>

    <!-- Room Image Preview -->
    <div id="room_placeholder_{{ $menu->menuID }}" class="w-full h-40 rounded-xl border-2 border-dashed border-gray-300 flex items-center justify-center mt-2 text-gray-400">
        <i data-lucide="home" class="w-10 h-10"></i>
        <span class="ml-2">No room selected</span>
    </div>
    <img id="room_image_{{ $menu->menuID }}" src="" alt="Room Image" class="w-full h-40 object-cover rounded-xl mt-2 hidden">
</div>

      <!-- Personal Details -->
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-700">Full Name</label>
          <input type="text" name="orderguest_name" 
                 class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500" 
                 placeholder="Your Name" value="{{Auth::guard('guest')->user()->guest_name}}" required>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Email</label>
          <input type="email" name="orderguest_email" 
                 class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500" 
                 placeholder="you@example.com" value="{{Auth::guard('guest')->user()->guest_email}}"  required>
        </div>
        <div class="sm:col-span-2">
          <label class="block text-sm font-medium text-gray-700">Contact Number</label>
          <input type="text" name="orderguest_contact" 
                 class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500" 
                 placeholder="09xxxxxxxxx" value="{{Auth::guard('guest')->user()->guest_mobile}}" required>
        </div>
      </div>

      <!-- Action Buttons -->
      <div class="flex justify-end gap-3 pt-4 border-t border-gray-200">
        <button type="button" onclick="document.getElementById('order_modal_{{ $menu->menuID }}').close();" 
                class="px-4 py-2 rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-700">
          Cancel
        </button>
        <button type="submit" 
                class="btn btn-primary">
          Confirm Order
        </button>
      </div>
    </form>
  </div>
</dialog>

<script>
  function updateRoomImage_{{ $menu->menuID }}(bookingID) {
      const select = document.getElementById('bookingID_{{ $menu->menuID }}');
      const img = document.getElementById('room_image_{{ $menu->menuID }}');
      const placeholder = document.getElementById('room_placeholder_{{ $menu->menuID }}');
      const selectedOption = select.options[select.selectedIndex];
      const imageSrc = selectedOption.getAttribute('data-image');

      if(imageSrc) {
          img.src = imageSrc;
          img.classList.remove('hidden');
          placeholder.classList.add('hidden');
      } else {
          img.src = '';
          img.classList.add('hidden');
          placeholder.classList.remove('hidden');
      }
  }
</script>
