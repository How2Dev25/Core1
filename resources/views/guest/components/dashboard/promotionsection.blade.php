<div class="relative rounded-2xl shadow-lg overflow-hidden group">
    <!-- Background Image -->
    <img src="{{ $promos[0]->hotelpromophoto ?? 'default-promo.jpg' }}"
        alt="{{ $promos[0]->hotelpromoname ?? 'Promo' }}"
        class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-105">

    <!-- Overlay -->
    <div
        class="absolute inset-0 bg-gradient-to-t from-blue-900/90 via-blue-900/60 to-transparent p-6 flex flex-col justify-end text-white">
        <div class="mb-3">
            <div class="flex items-center gap-2 mb-2">
                <i class="fas fa-gift text-yellow-400 text-2xl"></i>
                <h3 class="text-xl font-bold">Special Offer</h3>
            </div>

            @if(isset($promos[0]))
                <h4 class="text-2xl font-bold mb-1">{{ $promos[0]->hotelpromoname }}</h4>
                <p class="text-sm text-white/90 mb-3">
                    {{ Str::limit($promos[0]->hotelpromodescription, 80) }}
                </p>
                <div class="flex items-center gap-2 text-xs text-yellow-300 mb-4">
                    <i class="fas fa-clock"></i>
                    <span>{{ $promos[0]->hotelpromodaterange }}</span>
                </div>
            @endif

            <button
                class="w-full py-2 bg-yellow-400 text-blue-900 font-semibold rounded-xl hover:bg-yellow-300 transition-all">
                View Details
            </button>
        </div>
    </div>
</div>