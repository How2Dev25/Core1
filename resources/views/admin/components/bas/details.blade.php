    <dialog id="details_modal_{{$reserveroom->reservationID}}" class="modal">
            <div class="modal-box max-w-4xl">
                <form method="dialog">
                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                </form>
                <h3 class="font-bold text-lg mb-4">Reservation Details - Room #{{ $reserveroom->roomID }}</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Guest Information -->
                    <div>
                        <h4 class="font-semibold text-gray-700 mb-3 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-primary" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Guest Information
                        </h4>
                        <div class="space-y-2">
                            <p><span class="font-medium">Name:</span> {{ $reserveroom->guestname }}</p>
                            <p><span class="font-medium">Booking ID:</span> {{ $reserveroom->bookingID }}</p>
                            <p><span class="font-medium">Booked via:</span> {{ $reserveroom->bookedvia }}</p>
                            <p><span class="font-medium">Booked Date:</span>
                                {{ \Carbon\Carbon::parse($reserveroom->created_at)->format('M d, Y') }}</p>
                        </div>
                    </div>

                    <!-- Stay Information -->
                    <div>
                        <h4 class="font-semibold text-gray-700 mb-3 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-primary" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Stay Information
                        </h4>
                        <div class="space-y-2">
                            @php
$nights = \Carbon\Carbon::parse($reserveroom->reservation_checkin)
    ->diffInDays(\Carbon\Carbon::parse($reserveroom->reservation_checkout));
                            @endphp
                            <p><span class="font-medium">Check-in:</span>
                                {{ \Carbon\Carbon::parse($reserveroom->reservation_checkin)->format('M d, Y') }}</p>
                            <p><span class="font-medium">Check-out:</span>
                                {{ \Carbon\Carbon::parse($reserveroom->reservation_checkout)->format('M d, Y') }}</p>
                            <p><span class="font-medium">Nights:</span> {{ $nights }}</p>
                            <p><span class="font-medium">Room Type:</span> {{ $reserveroom->roomtype }}</p>
                        </div>
                    </div>
                </div>

                <!-- Pricing Breakdown -->
                <div class="mt-6">
                    <h4 class="font-semibold text-gray-700 mb-3 flex items-center gap-2">
                        <i class="fa-solid fa-peso-sign text-primary"></i>
                        Pricing Breakdown
                    </h4>

                    @php
$subtotal = $reserveroom->subtotal;
$vat = $reserveroom->vat;
$serviceFee = $reserveroom->serviceFee;
$total = $reserveroom->total;

// restaurant orders total
$restaurantTotal = 0;
if (isset($orders[$reserveroom->bookingID])) {
    foreach ($orders[$reserveroom->bookingID] as $order) {
        $restaurantTotal += $order->menu_price * $order->order_quantity;
    }
}

// final grand total
$grandTotal = $total + $restaurantTotal;
                    @endphp

                    <div class="bg-gray-50 p-4 rounded-lg">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span>Room Rate ({{ $nights }} nights):</span>
                                <span>₱{{ number_format($reserveroom->roomprice * $nights, 2) }}</span>
                            </div>
                        
                            {{-- Subtotal --}}
                            <div class="flex justify-between">
                                <span>Subtotal:</span>
                                <span>₱{{ number_format($subtotal, 2) }}</span>
                            </div>
                        
                            <div class="flex justify-between">
                                <span>Service Fee ({{$serviceFeedynamic}}):</span>
                                <span>₱{{ number_format($serviceFee, 2) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>VAT ({{$taxRatedynamic}}):</span>
                                <span>₱{{ number_format($vat, 2) }}</span>
                            </div>

                            <div class="flex justify-between">
                                <span>Points Spent :</span>
                                <span>{{$reserveroom->loyalty_points_used}} Points</span>
                            </div>
                            
                            <div class="flex justify-between">
                                <span>loyalty Discount:</span>
                                <span>₱{{$reserveroom->loyalty_discount}}</span>
                            </div>
                            
                            <div class="flex justify-between font-semibold text-primary border-t pt-2 mt-2">
                                <span>Room Total:</span>
                                <span>₱{{ number_format($total, 2) }}</span>
                            </div>
                        </div>
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span>Restaurant Total:</span>
                                    <span>₱{{ number_format($restaurantTotal, 2) }}</span>
                                </div>
                                <div class="flex justify-between font-bold text-lg border-t pt-2 mt-2">
                                    <span>Grand Total:</span>
                                    <span class="text-primary">₱{{ number_format($grandTotal, 2) }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span>Payment Status:</span>
                                    <span class="
                                                @if(strtolower($reserveroom->payment_status) == 'pending') text-yellow-600 font-semibold
                                                @elseif(strtolower($reserveroom->payment_status) == 'paid') text-green-600 font-semibold
                                                @elseif(strtolower($reserveroom->payment_status) == 'failed') text-red-600 font-semibold
                                                @else text-gray-600
                                                @endif
                                            ">
                                        {{ ucfirst($reserveroom->payment_status) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Restaurant Orders -->
                <div class="mt-6">
                    <h4 class="font-semibold text-gray-700 mb-3 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        Restaurant Orders
                    </h4>

                    @if(isset($orders[$reserveroom->bookingID]) && count($orders[$reserveroom->bookingID]) > 0)
                        <div class="border rounded-lg divide-y">
                            @foreach($orders[$reserveroom->bookingID] as $order)
                                @php
        $lineTotal = $order->menu_price * $order->order_quantity;
                                @endphp
                                <div class="p-3 flex items-center gap-4">
                                    <img src="{{ asset($order->menu_photo) }}" class="w-16 h-16 object-cover rounded">
                                    <div class="flex-1">
                                        <p class="font-medium">{{ $order->menu_name }}</p>
                                        <p class="text-sm text-gray-500">
                                            {{ $order->order_quantity }} × ₱{{ number_format($order->menu_price, 2) }}
                                        </p>
                                    </div>
                                    <div class="font-semibold">
                                        ₱{{ number_format($lineTotal, 2) }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-6 text-gray-500 bg-gray-50 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto mb-2 text-gray-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 17v-2h6v2m-7 4h8a2 2 0 0 0 2-2v-6a2 2 0 0 0-2-2h-1V7a3 3 0 0 0-6 0v4H9a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2z" />
                            </svg>
                            No restaurant orders for this booking.
                        </div>
                    @endif
                </div>
            </div>
            <form method="dialog" class="modal-backdrop">
                <button>close</button>
            </form>
        </dialog>