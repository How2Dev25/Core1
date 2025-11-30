<div class="mt-12">
<div class="flex items-center justify-between mb-8">
    <h2 class="text-3xl font-bold text-gray-800 flex items-center gap-3">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#001f54"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 5v14M5 12h14" /> <!-- plus icon -->
        </svg>
        Additionals
    </h2>
    <p class="text-gray-600 text-sm">Add optional services or extras</p>
</div>

    <!-- Inventory Cards Grid -->
    <style>
        /* Custom styles for enhanced hover effects */
        .inventory-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .inventory-card:hover {
            box-shadow: 0 20px 40px rgba(0, 31, 84, 0.15), 0 0 20px rgba(247, 179, 43, 0.1);
        }

        .inventory-image {
            aspect-ratio: 16 / 9;
            /* Consistent image ratio */
        }
    </style>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($inventories as $inventory)
            <button onclick="document.getElementById('selectinventory_{{ $inventory->core1_inventoryID }}').showModal()"
                class="inventory-card bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 hover:border-blue-200 group cursor-pointer">
                <!-- Inventory Photo -->
                <div class="inventory-image w-full overflow-hidden relative">
                    <img src="{{ asset($inventory->core1_inventory_image) }}"
                        alt="Photo of {{ $inventory->core1_inventory_name }}"
                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110 group-hover:brightness-90">

                    <!-- Overlay on hover -->
                    <div
                        class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 to-transparent p-4 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-400 transform translate-y-4 group-hover:translate-y-0">
                        <h3 class="text-lg font-bold">{{ $inventory->core1_inventory_name }}</h3>
                        <p class="text-sm text-gray-200">Code: {{ $inventory->core1_inventory_code }}</p>
                    </div>
                </div>

                <!-- Cost and Details -->
                <div
                    class="p-4 bg-gradient-to-b from-white to-gray-50 group-hover:from-blue-50 group-hover:to-blue-100 transition-colors duration-300">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="text-sm text-gray-600">Cost</span>
                        </div>
                        <span
                            class="text-xl font-bold text-[#001f54] group-hover:text-blue-700 group-hover:scale-105 transition-all duration-300">
                            ₱{{ number_format($inventory->core1_inventory_cost, 2) }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between mt-2">
                        <span class="text-sm text-gray-600">Stocks</span>
                        <span class="text-sm font-semibold text-gray-800">{{ $inventory->core1_inventory_stocks }}
                            {{ $inventory->core1_inventory_unit }}</span>
                    </div>
                    <p class="text-xs text-gray-500 mt-1 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        per unit</p>
                </div>
            </button>
        @empty
            <div class="col-span-full text-center py-16 bg-gray-50 rounded-xl border-2 border-dashed border-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-20 h-20 text-gray-400 mx-auto mb-4" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M20.59 9.69l-7.38-7.38a2 2 0 00-2.82 0L2.41 9.69a2 2 0 00-.41 2.41l7.38 7.38a2 2 0 002.82 0l7.38-7.38a2 2 0 00-.41-2.41z" />
                    <path d="M9 3l7 7-7 7" />
                </svg>
                <h3 class="text-xl font-semibold text-gray-600 mb-2">No Inventory Available</h3>
                <p class="text-gray-500 mb-4">We're sorry, but there are no items in your inventory at the moment.</p>
                <button class="bg-[#001f54] text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors">Refresh
                    Inventory</button>
            </div>
        @endforelse
    </div>
</div>