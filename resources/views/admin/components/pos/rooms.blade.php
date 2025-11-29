<div class="mt-12">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Point Of Sale</h2>
    </div>

    <!-- Rooms Cards Grid -->
<style>
    /* Prevent overflow when hovering */
    .room-card-container {
        overflow: hidden;
    }
</style>

<div class="room-card-container">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse ($rooms as $room)
            <button
                class="group bg-white rounded-lg shadow-md overflow-hidden hover:shadow-2xl transition-all duration-300 hover:scale-105 cursor-pointer">

                <!-- Room Photo -->
                <div class="h-36 w-full overflow-hidden relative">
                    <img src="{{ asset($room->roomphoto) }}" alt="Room Photo"
                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110 group-hover:brightness-90">

                    <!-- Overlay on hover -->
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    </div>

                    <!-- Room type appears on hover -->
                    <div
                        class="absolute bottom-2 left-2 right-2 text-white font-semibold text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300 transform translate-y-2 group-hover:translate-y-0">
                        {{ $room->roomtype }}
                    </div>
                </div>

                <!-- Price -->
                <div
                    class="p-3 text-center bg-gradient-to-b from-white to-gray-50 group-hover:from-blue-50 group-hover:to-blue-100 transition-colors duration-300">
                    <span class="text-lg font-bold text-blue-900 group-hover:text-blue-700 transition-colors duration-300">
                        ₱{{ number_format($room->roomprice, 2) }}
                    </span>
                    <span
                        class="text-xs text-gray-500 block mt-0.5 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        per night
                    </span>
                </div>

            </button>
        @empty
            <div class="col-span-full text-center py-10">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-gray-300 mx-auto mb-3" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <p class="text-gray-500 text-lg font-medium">No rooms available</p>
            </div>
        @endforelse
    </div>
</div>
</div>