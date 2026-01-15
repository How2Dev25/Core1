<!-- Table -->
<div class="overflow-x-auto mt-5">
    <table class="table table-auto w-full">
        <thead>
            <tr class="bg-blue-900 text-white text-sm">
                <th class="py-3 px-4 text-left">Inventory</th>
                <th class="py-3 px-4 text-left">Booking ID</th>
                <th class="py-3 px-4 text-left">Quantity</th>
                <th class="py-3 px-4 text-left">Price</th>
                <th class="py-3 px-4 text-left">Status</th>
                <th class="py-3 px-4 text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($additionalBooking as $booking)
                <tr class="border-t border-gray-100 hover:bg-gray-50">
                    <td class="py-4 px-4 flex items-center gap-3">
                        <img src="{{ asset($booking->core1_inventory_image)}}"
                            class="w-12 h-12 object-cover rounded-lg">
                        <span class="font-medium">{{ $booking->core1_inventory_name}}</span>
                    </td>
                    <td class="py-4 px-4">{{ $booking->bookingID }}</td>
                    <td class="py-4 px-4">{{ $booking->additional_quantity}}</td>
                    <td class="py-4 px-4">₱{{ number_format($booking->additional_total, 2) }}</td>
                    <td class="py-4 px-4">
                        @if($booking->addon_status == 'Paid')
                            <span class="badge badge-success">Paid
                        @elseif($booking->addon_status == 'Unpaid')
                            <span class="badge badge-warning">Unpaid</span>
                        @else
                            <span class="badge badge-error">Cancelled</span>
                        @endif
                    </td>
                <td class="py-4 px-4 text-right">
                    <div class="flex gap-2 justify-end">
                        @if($booking->addon_status !== 'Paid')
                            <button class="btn btn-sm btn-success p-2" title="Mark As Paid"
                                onclick="document.getElementById('markAsPaidModal_{{ $booking->additionalbookingID }}').showModal()">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </button>
                        @endif

                        <button class="btn btn-sm btn-error p-2" title="Delete"
                            onclick="document.getElementById('deleteAddon_{{ $booking->additionalbookingID }}').showModal()">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4a1 1 0 011 1v1H9V4a1 1 0 011-1z" />
                            </svg>
                        </button>

                <button class="btn btn-sm btn-primary p-2" title="Generate Receipt"
                    onclick="document.getElementById('print_receipt_{{$booking->additionalbookingID}}').showModal()">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 4H7a2 2 0 01-2-2V6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v12a2 2 0 01-2 2z" />
                    </svg>
                </button>

                <dialog id="print_receipt_{{ $booking->additionalbookingID }}" class="modal">
                    <div class="modal-box max-w-2xl">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-bold">Generate Receipt</h3>
                            <form method="dialog">
                                <button class="btn btn-sm btn-circle btn-ghost">✕</button>
                            </form>
                        </div>

                        <p class="py-2">Are you sure you want to generate a receipt for this inventory item?</p>

                        <!-- Grid Layout for Details -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 my-4">
                            <!-- Item Image -->
                            <div class="col-span-1">
                                <div class="card  ">
                                    <figure class="p-4">
                                        @if($booking->core1_inventory_image)
                                            <img src="{{ asset($booking->core1_inventory_image) }}"
                                                alt="{{ $booking->core1_inventory_name }}" class="w-full h-32 object-cover rounded-lg">
                                        @else
                                            <div class="w-full h-32 flex items-center justify-center bg-gray-100 rounded-lg">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                        @endif
                                    </figure>
                                </div>
                            </div>

                            <!-- Item Details -->
                            <div class="col-span-2">
                                <div class="space-y-3">
                                    <div class="grid grid-cols-2 gap-2">
                                        <div class="space-y-1">
                                            <p class="text-sm font-medium text-gray-600">Item Name:</p>
                                            <p class="text-base font-semibold">{{ $booking->core1_inventory_name ?? 'N/A' }}</p>
                                        </div>
                                        <div class="space-y-1">
                                            <p class="text-sm font-medium text-gray-600">Item Code:</p>
                                            <p class="text-base font-semibold">{{ $booking->core1_inventory_code ?? 'N/A' }}</p>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-2 gap-2">
                                        <div class="space-y-1">
                                            <p class="text-sm font-medium text-gray-600">Quantity:</p>
                                            <p class="text-base font-semibold">
                                                {{ $booking->additional_quantity ?? 0 }} {{ $booking->core1_inventory_unit ?? 'pcs' }}
                                            </p>
                                        </div>
                                        <div class="space-y-1">
                                            <p class="text-sm font-medium text-gray-600">Unit Price:</p>
                                            <p class="text-base font-semibold">
                                                ₱{{ number_format($booking->core1_inventory_cost ?? 0, 2) }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="space-y-1">
                                        <p class="text-sm font-medium text-gray-600">Category:</p>
                                        <p class="text-base">{{ $booking->core1_inventory_category ?? 'N/A' }}</p>
                                    </div>

                                    <div class="space-y-1">
                                        <p class="text-sm font-medium text-gray-600">Location:</p>
                                        <p class="text-base">{{ $booking->core1_inventory_location ?? 'N/A' }}</p>
                                    </div>

                                    @if($booking->core1_inventory_description)
                                        <div class="space-y-1">
                                            <p class="text-sm font-medium text-gray-600">Description:</p>
                                            <p class="text-base text-gray-700">{{ $booking->core1_inventory_description }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Summary Section -->
                        <div class="bg-gray-50 p-4 rounded-lg mb-4">
                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <div>
                                        <p class="text-sm font-medium text-gray-600">Booking ID:</p>
                                        <p class="text-base font-semibold">{{ $booking->bookingID ?? $booking->additionalbookingID }}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-600">Reservation ID:</p>
                                        <p class="text-base font-semibold">{{ $booking->reservationID ?? 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <div>
                                        <p class="text-sm font-medium text-gray-600">Total Amount:</p>
                                        <p class="text-xl font-bold text-blue-600">
                                            ₱{{ number_format($booking->additional_total ?? 0, 2) }}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-600">Addon Status:</p>
                                        <span class="badge badge-sm 
                                            {{ $booking->addon_status == 'confirmed' ? 'badge-success' : 'badge-warning' }}">
                                            {{ $booking->addon_status ?? 'pending' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-action">
                            <form method="dialog">
                                <button class="btn">Cancel</button>
                            </form>
                            <a href="/printinventoryreceipt/{{ $booking->additionalbookingID }}" target="_blank"
                                class="btn btn-primary flex items-center gap-2" style="background-color: #001f54; color: white;">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                                </svg>
                                Yes, Generate Receipt
                            </a>
                        </div>
                    </div>

                    <form method="dialog" class="modal-backdrop">
                        <button>close</button>
                    </form>
                </dialog>
                    </div>
                </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-4">No additional bookings found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>


<!-- Delete Modal -->


<!-- Generate Receipt Modal with Preview -->

