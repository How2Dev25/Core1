<div class="bg-white rounded-2xl shadow-lg p-6">
    <div class="flex items-center gap-3 mb-6">
        <div class="p-2 bg-blue-900 rounded-xl">
            <i class="fas fa-concierge-bell text-yellow-400 text-xl"></i>
        </div>
        <div>
            <h3 class="text-xl font-bold text-gray-900">Hotel Facilities</h3>
            <p class="text-sm text-gray-500">Explore our amenities</p>
        </div>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">

        <!-- Facility Card -->

        @forelse ($facility as $facilities)
            <div
                class="group relative overflow-hidden rounded-xl bg-gray-50 hover:shadow-xl transition-all duration-300 cursor-pointer">
                <img src="{{ asset($facilities->facility_photo) }}" alt="{{ $facilities->facility_name }}"
                    class="w-full h-32 object-cover rounded-t-xl group-hover:scale-105 transition-transform duration-300">
                <div class="p-4">
                    <h4 class="font-semibold text-gray-900 mb-1">{{ $facilities->facility_name }}</h4>
                </div>
                <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity">
                    <span class="text-xs bg-blue-900 text-white px-2 py-1 rounded-full">View</span>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-10">
                <i class="fas fa-info-circle text-blue-900 text-3xl mb-3"></i>
                <p class="text-gray-500 text-sm">No facilities available at the moment.</p>
            </div>
        @endforelse







    </div>
</div>