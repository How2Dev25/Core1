<div class="mt-12">
    <div class="flex items-center justify-between mb-8">
        <h2 class="text-3xl font-bold text-gray-800 flex items-center gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none"
                stroke="#001f54" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            Rooms
        </h2>
        <p class="text-gray-600 text-sm">Choose your perfect stay</p>
    </div>

    <!-- Rooms Cards Grid -->
    <style>
        /* Custom styles for enhanced hover effects */
        .room-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .room-card:hover {
            box-shadow: 0 20px 40px rgba(0, 31, 84, 0.15), 0 0 20px rgba(247, 179, 43, 0.1);
        }

        .room-image {
            aspect-ratio: 16 / 9;
            /* Consistent image ratio */
        }
    </style>
 
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($rooms as $room)
            <button onclick="document.getElementById('bookroom_{{ $room->roomID }}').showModal()"
                class="room-card bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 hover:border-blue-200 group cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                <!-- Room Photo -->
                <div class="room-image w-full overflow-hidden relative">
                    <img src="{{ asset($room->roomphoto) }}" alt="Photo of {{ $room->roomtype }} room"
                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110 group-hover:brightness-90">

                    <!-- Overlay on hover -->

                    <!-- Room type and name appear on hover -->
                    <div
                        class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 to-transparent p-4 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-400 transform translate-y-4 group-hover:translate-y-0">
                        <h3 class="text-lg font-bold">{{ $room->roomtype }}</h3>
                        @if(isset($room->roomname))
                            <p class="text-sm text-gray-200">{{ $room->roomname }}</p>
                        @endif
                    </div>
                </div>

                <!-- Price and Details -->
                <div
                    class="p-4 bg-gradient-to-b from-white to-gray-50 group-hover:from-blue-50 group-hover:to-blue-100 transition-colors duration-300">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                stroke="#001f54" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            <span class="text-sm text-gray-600">Starting from</span>
                        </div>
                        <span
                            class="text-xl font-bold text-[#001f54] group-hover:text-blue-700 group-hover:scale-105 transition-all duration-300">
                            ₱{{ number_format($room->roomprice, 2) }}
                        </span>
                    </div>
                    <p class="text-xs text-gray-500 mt-1 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        per night</p>
                </div>
            </button>
        @empty
            <div class="col-span-full text-center py-16 bg-gray-50 rounded-xl border-2 border-dashed border-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-20 h-20 text-gray-400 mx-auto mb-4" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <h3 class="text-xl font-semibold text-gray-600 mb-2">No Rooms Available</h3>
                <p class="text-gray-500 mb-4">We're sorry, but there are no rooms matching your criteria at the moment.</p>
                <button class="bg-[#001f54] text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors">Refresh
                    Search</button>
            </div>
        @endforelse
    </div>
</div>

@foreach ($rooms as $room)
    @include('admin.components.pos.roommodal')
@endforeach

<script>
    // Dynamic modal loading for rooms
    async function openRoomModal(roomId) {
        // Close any existing modal first
        document.querySelectorAll('dialog[open]').forEach(dialog => dialog.close());

        try {
            const response = await fetch(`/get-room-modal/${roomId}`);
            const modalHtml = await response.text();
            document.getElementById('modal-container').innerHTML = modalHtml;

            // Show the modal
            const modal = document.getElementById(`bookroom_${roomId}`);
            if (modal) modal.showModal();
        } catch (error) {
            console.error('Error loading modal:', error);
        }
    }

    // Update your room buttons
    document.addEventListener('click', (e) => {
        const roomBtn = e.target.closest('[data-room-id]');
        if (roomBtn) {
            const roomId = roomBtn.dataset.roomId;
            openRoomModal(roomId);
        }
    });
</script>