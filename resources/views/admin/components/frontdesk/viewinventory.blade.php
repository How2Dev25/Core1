<dialog id="view_inventory" class="modal">
    <div class="modal-box max-w-4xl">
        <h3 class="text-lg font-bold mb-4">View Inventory And Stocks</h3>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
            <!-- Total Items - Blue Theme -->
            <div
                class="stats bg-white shadow-md hover:shadow-md transition-all duration-300 ease-in-out group hover:-translate-y-1">
                <div class="stat p-3">
                    <div class="flex items-center gap-2">
                        <div
                            class="p-2 rounded-lg bg-blue-900 text-yellow-400 group-hover:text-white transition-colors duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-package">
                                <path d="m7.5 4.27 9 5.15" />
                                <path
                                    d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z" />
                                <path d="m3.3 7 8.7 5 8.7-5" />
                                <path d="M12 22V12" />
                            </svg>
                        </div>
                        <div class="stat-title text-gray-600 group-hover:text-blue-800">Total Items</div>
                    </div>
                    <div class="stat-value text-blue-600 text-lg group-hover:text-blue-800">{{$totalItems}}</div>
                </div>
            </div>
        
            <!-- In Stock - Green Theme -->
            <div
                class="stats bg-white shadow-md hover:shadow-md transition-all duration-300 ease-in-out group hover:-translate-y-1">
                <div class="stat p-3">
                    <div class="flex items-center gap-2">
                        <div
                            class="p-2 rounded-lg bg-blue-900 text-yellow-400 group-hover:text-white transition-colors duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-check-circle">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                                <path d="m9 11 3 3L22 4" />
                            </svg>
                        </div>
                        <div class="stat-title text-gray-600 group-hover:text-green-800">In Stock</div>
                    </div>
                    <div class="stat-value text-green-600 text-lg group-hover:text-green-800">{{$instock}}</div>
                </div>
            </div>
        
            <!-- Low Stock - Amber Theme -->
            <div
                class="stats bg-white shadow-md hover:shadow-md transition-all duration-300 ease-in-out group hover:-translate-y-1">
                <div class="stat p-3">
                    <div class="flex items-center gap-2">
                        <div
                            class="p-2 rounded-lg bg-blue-900 text-yellow-400 group-hover:text-white transition-colors duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-alert-triangle">
                                <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z" />
                                <path d="M12 9v4" />
                                <path d="M12 17h.01" />
                            </svg>
                        </div>
                        <div class="stat-title text-gray-600 group-hover:text-amber-800">Low Stock</div>
                    </div>
                    <div class="stat-value text-amber-600 text-lg group-hover:text-amber-800">{{$lowstock}}</div>
                </div>
            </div>
        
            <!-- Out of Stock - Red Theme -->
            <div
                class="stats bg-white shadow-md hover:shadow-md transition-all duration-300 ease-in-out group hover:-translate-y-1">
                <div class="stat p-3">
                    <div class="flex items-center gap-2">
                        <div
                            class="p-2 rounded-lg bg-blue-900 text-yellow-400 group-hover:text-white transition-colors duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-x-circle">
                                <circle cx="12" cy="12" r="10" />
                                <path d="m15 9-6 6" />
                                <path d="m9 9 6 6" />
                            </svg>
                        </div>
                        <div class="stat-title text-gray-600 group-hover:text-red-800">Out of Stock</div>
                    </div>
                    <div class="stat-value text-red-600 text-lg group-hover:text-red-800">{{$nostock}}</div>
                </div>
            </div>
        </div>
 
        
<table class="table table-sm mt-5">
    <thead class="bg-blue-900 text-white">
        <tr>
            <th>Item</th>
            <th>Category</th>
            <th>Stock</th>
            <th>Threshold</th>
            <th>Unit</th>
        </tr>
    </thead>
    <tbody>
        <!-- Row 1 -->
        @forelse ($inventory as $inv)
            <tr>
                <td>
                    <div class="flex items-center gap-3">
                        <div class="avatar">
                            <div class="mask mask-squircle w-10 h-10">
                                <img src="{{asset($inv->core1_inventory_image)}}" alt="Bath Towels" />
                            </div>
                        </div>
                        <div>
                            <div class="font-bold">{{$inv->core1_inventory_name}}</div>
                            <div class="text-xs opacity-50">{{$inv->core1_inventory_code}}</div>
                        </div>
                    </div>
                </td>
                <td>
                    @php
    $badgeClasses = [
        'Linens' => 'badge-info',
        'Bath Amenities' => 'badge-primary',
        'Cleaning Supplies' => 'badge-warning',
        'Room Equipment' => 'badge-success',
        // Add more categories as needed
    ];

    $defaultClass = 'badge-secondary';
    $badgeClass = $badgeClasses[$inv->core1_inventory_category] ?? $defaultClass;
                    @endphp

                    <span class="badge badge-sm {{ $badgeClass }}">
                        {{ $inv->core1_inventory_category }}
                    </span>
                </td>
                <td>
                    <span class="font-bold @if($inv->core1_inventory_stocks == 0)
                        text-red-500
                      @elseif ($inv->core1_inventory_stocks <= $inv->core1_inventory_threshold)
                    text-orange-400
                  @endif">{{$inv->core1_inventory_stocks}}</span>
                </td>
                <td>{{$inv->core1_inventory_threshold}}</td>
                <td>{{$inv->core1_inventory_unit}}</td>
                
            </tr>
        @empty
        @endforelse




    </tbody>
</table>

        <div class="modal-action">
            <form method="dialog">
                <button class="btn">Close</button>
            </form>
        </div>
    </div>
</dialog>