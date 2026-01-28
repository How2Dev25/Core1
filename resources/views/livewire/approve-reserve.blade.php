<div>
<div class="bg-white rounded-xl shadow-lg border border-gray-200 mt-5 p-6">
    <!-- Enhanced Header with Filters -->
    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4 mb-6">
        <div class="flex items-center gap-3">
            <div class="p-3 bg-gradient-to-br from-[#001f54] to-[#1a3470] rounded-xl shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <div>
                <h3 class="text-2xl font-bold text-gray-800">Reservation Management</h3>
                <p class="text-sm text-gray-600">Approve and manage guest reservations</p>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-3 w-full lg:w-auto">
            <!-- Status Filter -->
            <div class="relative">
                <select wire:model.live="statusFilter" 
                    class="appearance-none bg-white border border-gray-300 rounded-lg px-4 py-2 pr-8 text-sm focus:outline-none focus:ring-2 focus:ring-[#001f54] focus:border-transparent">
                    <option value="">All Statuses</option>
                    <option value="Pending">Pending</option>
                    <option value="Confirmed">Confirmed</option>
                    <option value="Checked Out">Checked Out</option>
                    <option value="Checked In">Checked In</option>
                    <option value="Cancelled">Cancelled</option>
                </select>
                <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </div>

            <div class="relative">
                <select wire:model.live="paymentFilter" 
                    class="appearance-none bg-white border border-gray-300 rounded-lg px-4 py-2 pr-8 text-sm focus:outline-none focus:ring-2 focus:ring-[#001f54] focus:border-transparent">
                    <option value="">All Payments</option>
                    <option value="Pending">Pending</option>
                    <option value="Partial">Partial</option>
                    <option value="Paid">Paid</option>
                </select>
                <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </div>

            <!-- Room Type Filter -->
            <div class="relative">
                <select wire:model.live="typeFilter" 
                    class="appearance-none bg-white border border-gray-300 rounded-lg px-4 py-2 pr-8 text-sm focus:outline-none focus:ring-2 focus:ring-[#001f54] focus:border-transparent">
                    <option value="">All Types</option>
                    <option value="Standard">Standard</option>
                    <option value="Deluxe">Deluxe</option>
                    <option value="Suite">Suite</option>
                    <option value="Executive">Executive</option>
                </select>
                <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </div>

            <!-- Search -->
            <div class="relative">
                <input type="text" wire:model.live.debounce.300ms="searchTerm" 
                    placeholder="Search by room or guest..."
                    class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#001f54] focus:border-transparent w-64">
                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-gray-400"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>

            <!-- Refresh Button -->
          
        </div>
    </div>

    <!-- Table View -->
    <div class="overflow-x-auto">
        <table class="table table-auto w-full">
            <thead>
                <tr class="bg-blue-900 text-white text-sm">
                    <th class="py-3 px-4 text-left">Room & Guest</th>
                    <th class="py-3 px-4 text-left">Booking Details</th>
                    <th class="py-3 px-4 text-left">Status</th>
                    <th class="py-3 px-4 text-left">Payment</th>
                    <th class="py-3 px-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reserverooms as $reserveroom)
                    <tr class="border-t border-gray-100 hover:bg-gray-50 transition-colors">
                        <td class="py-4 px-4">
                            <div class="flex items-center gap-3">
                                <div class="w-16 h-16 rounded-xl overflow-hidden border-2 border-[#001f54]/20">
                                    <img src="{{ asset($reserveroom->roomphoto) }}" 
                                         alt="Room #{{ $reserveroom->roomID }}" 
                                         class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-800">Room #{{ $reserveroom->roomID }}</div>
                                    <div class="text-sm text-gray-600">{{ $reserveroom->guestname }}</div>
                                    @if($reserveroom->early_checkin_time || $reserveroom->late_checkout_time)
                                        <div class="flex gap-2 mt-1">
                                            @if($reserveroom->early_checkin_time)
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-700">
                                                    🕐 {{ $reserveroom->early_checkin_time }}
                                                </span>
                                            @endif
                                            @if($reserveroom->late_checkout_time)
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-orange-100 text-orange-700">
                                                    🕕 {{ $reserveroom->late_checkout_time }}
                                                </span>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-4">
                            <div class="text-sm">
                                <div class="flex items-center gap-2 mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-[#001f54]" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7H3v12a2 2 0 002 2z" />
                                    </svg>
                                    <span class="font-medium">{{ \Carbon\Carbon::parse($reserveroom->reservation_checkin)->format('M d, Y') }}</span>
                                    <span class="mx-1 text-gray-400">→</span>
                                    <span class="font-medium">{{ \Carbon\Carbon::parse($reserveroom->reservation_checkout)->format('M d, Y') }}</span>
                                </div>
                                <div class="flex items-center gap-3 text-xs text-gray-500">
                                    <span class="flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        {{ $reserveroom->reservation_adults ?? 1 }}A {{ $reserveroom->reservation_children ?? 0 }}C
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                        </svg>
                                        {{ $reserveroom->roomtype }}
                                    </span>
                                </div>
                                @if($reserveroom->reservation_specialrequest)
                                    <div class="mt-2">
                                        <div class="flex flex-wrap gap-1">
                                            @php
        $specialRequests = explode(', ', $reserveroom->reservation_specialrequest);
                                            @endphp
                                            @foreach($specialRequests as $request)
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700 border border-gray-200">
                                                    {{ $request }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </td>
                        <td class="py-4 px-4">
                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium
                                @if(strtolower($reserveroom->reservation_bookingstatus) == 'pending') bg-yellow-100 text-yellow-800 border border-yellow-200
                                @elseif(strtolower($reserveroom->reservation_bookingstatus) == 'confirmed') bg-green-100 text-green-800 border border-green-200
                                @elseif(strtolower($reserveroom->reservation_bookingstatus) == 'checked in') bg-blue-100 text-blue-800 border border-blue-200
                                @elseif(strtolower($reserveroom->reservation_bookingstatus) == 'checked out') bg-orange-100 text-orange-800 border border-orange-200
                                @elseif(strtolower($reserveroom->reservation_bookingstatus) == 'cancelled') bg-red-100 text-red-800 border border-red-200
                                @endif
                            ">
                                {{ ucfirst($reserveroom->reservation_bookingstatus) }}
                            </span>
                        </td>
                        <td class="py-4 px-4">
                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium
                                @if(strtolower($reserveroom->payment_status) == 'pending') bg-yellow-100 text-yellow-800 border border-yellow-200
                                @elseif(strtolower($reserveroom->payment_status) == 'partial') bg-orange-100 text-orange-800 border border-orange-200
                                @elseif(strtolower($reserveroom->payment_status) == 'paid') bg-green-100 text-green-800 border border-green-200
                                @elseif(strtolower($reserveroom->payment_status) == 'failed') bg-red-100 text-red-800 border border-red-200
                                @else bg-gray-100 text-gray-800 border border-gray-200
                                @endif
                            ">
                                {{ ucfirst($reserveroom->payment_status) }}
                            </span>
                        </td>
                        <td class="py-4 px-4">
                            <div class="flex justify-end items-center gap-2">
                                <!-- View Details Button -->
                                <button onclick="details_modal_{{$reserveroom->reservationID}}.showModal()"
                                    class="p-2 text-gray-600 hover:text-[#001f54] hover:bg-[#001f54]/10 rounded-lg transition-colors"
                                    title="View Details">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </button>

                                <!-- More Actions Button -->
                                <button
                                    onclick="document.getElementById('actions-drawer-{{$reserveroom->reservationID}}').classList.toggle('translate-x-full')"
                                    class="p-2 text-gray-600 hover:text-[#001f54] hover:bg-[#001f54]/10 rounded-lg transition-colors"
                                    title="More Actions">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 12h.01M12 12h.01M19 12h.01" />
                                    </svg>
                                </button>

                                @if(strtolower($reserveroom->reservation_bookingstatus) === 'checked in')
                                <button onclick="document.getElementById('assign_keycard_{{$reserveroom->reservationID}}').showModal()"
                                    class="p-2 bg-[#001f54] text-white rounded-lg hover:bg-[#1a3470] transition-colors"
                                    title="Assign Keycard">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                                    </svg>
                                </button>
                                @endif

                                @if($reserveroom->payment_status === 'Paid' || $reserveroom->payment_status === 'Partial')
                                <button
                                    onclick="document.getElementById('confirm_receipt_{{$reserveroom->reservationID}}').showModal()"
                                    class="p-2 bg-[#001f54] text-white rounded-lg hover:bg-[#1a3470] transition-colors"
                                    title="Generate Receipt">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m4 
                                            4h4a2 2 0 002-2v-4a2 2 0 00-2-2h-4a2 2 0 00-2 2v4a2 2 0 002 2z" />
                                        </svg>
                                </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-10 text-center">
                            <div class="text-gray-400 mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                            </div>
                            <p class="text-gray-500">No reservations found matching your criteria</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $reserverooms->links() }}
    </div>

    <!-- Details Modals -->
    @foreach($reserverooms as $reserveroom)
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
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#001f54]" fill="none"
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
                                                                    <div class="flex justify-between">
                                                                        <span class="font-medium">Check-in:</span>
                                                                        <span>{{ \Carbon\Carbon::parse($reserveroom->reservation_checkin)->format('M d, Y') }}</span>
                                                                    </div>
                                                                    @if($reserveroom->early_checkin_time)
                                                                        <div class="flex justify-between">
                                                                            <span class="font-medium text-blue-600">Early Check-in:</span>
                                                                            <span class="text-blue-600">{{ $reserveroom->early_checkin_time }}</span>
                                                                        </div>
                                                                    @endif
                                                                    <div class="flex justify-between">
                                                                        <span class="font-medium">Check-out:</span>
                                                                        <span>{{ \Carbon\Carbon::parse($reserveroom->reservation_checkout)->format('M d, Y') }}</span>
                                                                    </div>
                                                                    @if($reserveroom->late_checkout_time)
                                                                        <div class="flex justify-between">
                                                                            <span class="font-medium text-orange-600">Late Check-out:</span>
                                                                            <span class="text-orange-600">{{ $reserveroom->late_checkout_time }}</span>
                                                                        </div>
                                                                    @endif
                                                                    <div class="flex justify-between">
                                                                        <span class="font-medium">Nights:</span>
                                                                        <span>{{ $nights }}</span>
                                                                    </div>
                                                                    <div class="flex justify-between">
                                                                        <span class="font-medium">Guests:</span>
                                                                        <span>{{ $reserveroom->reservation_adults ?? 1 }} Adults, {{ $reserveroom->reservation_children ?? 0 }} Children</span>
                                                                    </div>
                                                                    <div class="flex justify-between">
                                                                        <span class="font-medium">Room Type:</span>
                                                                        <span>{{ $reserveroom->roomtype }}</span>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Special Requests -->
                                                            @if($reserveroom->reservation_specialrequest)
                                                            <div>
                                                                <h4 class="font-semibold text-gray-700 mb-3 flex items-center gap-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#001f54]" fill="none" viewBox="0 0 24 24"
                                                                        stroke="currentColor">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                            d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                                                        <polyline points="7 10 12 15 17 10"></polyline>
                                                                        <line x1="12" y1="15" x2="12" y2="3"></line>
                                                                    </svg>
                                                                    Special Requests
                                                                </h4>
                                                                <div class="space-y-2">
                                                                    @php
            $specialRequests = explode(', ', $reserveroom->reservation_specialrequest);
                                                                    @endphp
                                                                    @foreach($specialRequests as $request)
                                                                        <div class="flex items-center gap-2 p-2 bg-gray-50 rounded-lg">
                                                                            @if(strtolower($request) == 'early check-in')
                                                                                <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                                                                            @elseif(strtolower($request) == 'late check-out')
                                                                                <span class="w-2 h-2 bg-orange-500 rounded-full"></span>
                                                                            @else
                                                                                <span class="w-2 h-2 bg-gray-500 rounded-full"></span>
                                                                            @endif
                                                                            <span class="text-sm">{{ ucfirst($request) }}</span>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                            @endif
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

        // restaurant orders breakdown
        $restaurantTotal = 0;
        $restaurantPaidTotal = 0;
        $restaurantUnpaidTotal = 0;

        if (isset($reserveroom->restaurant_orders) && count($reserveroom->restaurant_orders) > 0) {
            foreach ($reserveroom->restaurant_orders as $order) {
                $orderTotal = $order->unit_price * $order->quantity;
                $restaurantTotal += $orderTotal;

                if ($order->payment_resto_status == 'Paid') {
                    $restaurantPaidTotal += $orderTotal;
                } else {
                    $restaurantUnpaidTotal += $orderTotal;
                }
            }
        }

        // final grand total (room total + unpaid restaurant orders only)
        $grandTotal = $total + $restaurantUnpaidTotal;

        // Deposit & Balance
        $deposit = $reserveroom->deposit_amount ?? 0;
        $balance = $grandTotal - $deposit;
                                                            @endphp

                                                            <div class="bg-gray-50 p-4 rounded-lg">
                                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">

                                                                    <div class="space-y-2">
                                                                        <div class="flex justify-between">
                                                                            <span>Room Rate ({{ $nights }} nights):</span>
                                                                            <span>₱{{ number_format($reserveroom->roomprice * $nights, 2) }}</span>
                                                                        </div>

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
                                                                            <span>Points Spent:</span>
                                                                            <span>{{ $reserveroom->loyalty_points_used }} Points</span>
                                                                        </div>

                                                                        <div class="flex justify-between">
                                                                            <span>Loyalty Discount:</span>
                                                                            <span>₱{{ number_format($reserveroom->loyalty_discount, 2) }}</span>
                                                                        </div>

                                                                        <div class="flex justify-between font-semibold text-primary border-t pt-2 mt-2">
                                                                            <span>Room Total:</span>
                                                                            <span>₱{{ number_format($total, 2) }}</span>
                                                                        </div>
                                                                    </div>

                                                                    <div class="space-y-2">
                                                                        <!-- Restaurant Payment Breakdown -->
                                                                        @if($restaurantTotal > 0)
                                                                            <div class="bg-orange-50 p-3 rounded-lg border border-orange-200">
                                                                                <div class="flex justify-between items-center mb-2">
                                                                                    <span class="font-semibold text-orange-800">Restaurant Orders:</span>
                                                                                    <span class="font-bold text-orange-800">₱{{ number_format($restaurantTotal, 2) }}</span>
                                                                                </div>

                                                                                <div class="grid grid-cols-2 gap-2 text-xs">
                                                                                    <div class="flex justify-between">
                                                                                        <span class="text-green-600">✓ Paid:</span>
                                                                                        <span class="text-green-600 font-medium">₱{{ number_format($restaurantPaidTotal, 2) }}</span>
                                                                                    </div>
                                                                                    <div class="flex justify-between">
                                                                                        <span class="text-orange-600">○ Pending:</span>
                                                                                        <span class="text-orange-600 font-medium">₱{{ number_format($restaurantUnpaidTotal, 2) }}</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @else
                                                                            <div class="flex justify-between">
                                                                                <span>Restaurant Total:</span>
                                                                                <span>₱{{ number_format($restaurantTotal, 2) }}</span>
                                                                            </div>
                                                                        @endif

                                                                        <div class="flex justify-between font-bold text-lg border-t pt-2 mt-2">
                                                                            <span>Grand Total:</span>
                                                                            <span class="text-primary">₱{{ number_format($grandTotal, 2) }}</span>
                                                                        </div>

                                                                        @if($deposit > 0)
                                                                            <div class="flex justify-between text-green-600 font-semibold">
                                                                                <span>Deposit Paid:</span>
                                                                                <span>₱{{ number_format($deposit, 2) }}</span>
                                                                            </div>

                                                                            <div class="flex justify-between text-red-500 font-semibold">
                                                                                <span>Balance Remaining:</span>
                                                                                <span>₱{{ number_format($balance, 2) }}</span>
                                                                            </div>
                                                                        @endif

                                                                        <div class="flex justify-between text-sm border-t pt-2 mt-2">
                                                                            <span>Payment Status:</span>
                                                                            <span class="
                                                            @if(strtolower($reserveroom->payment_status) == 'pending') text-yellow-600 font-semibold
                                                            @elseif(strtolower($reserveroom->payment_status) == 'partial') text-orange-500 font-semibold
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


                                                        <!-- Restaurant Orders Section -->
                @if(isset($reserveroom->restaurant_orders) && count($reserveroom->restaurant_orders) > 0)
                                <div class="mt-5">
                                    <h4 class="font-semibold text-orange-800 mb-4 flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                        </svg>
                                        Restaurant Orders
                                    </h4>

                                    <!-- Payment Status Summary -->
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-4">
                                        @php
                    $paidOrders = collect($reserveroom->restaurant_orders)->where('payment_resto_status', 'Paid');
                    $unpaidOrders = collect($reserveroom->restaurant_orders)->where('payment_resto_status', '!=', 'Paid');
                    $paidTotal = $paidOrders->sum(function ($order) {
                        return $order->unit_price * $order->quantity;
                    });
                    $unpaidTotal = $unpaidOrders->sum(function ($order) {
                        return $order->unit_price * $order->quantity;
                    });
                                        @endphp

                                        <div class="bg-green-50 rounded-lg p-3 border border-green-200">
                                            <div class="flex items-center gap-2 text-green-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <span class="font-medium text-sm">Paid Orders</span>
                                            </div>
                                            <p class="text-lg font-bold text-green-800">{{ $paidOrders->count() }}</p>
                                            <p class="text-xs text-green-600">₱{{ number_format($paidTotal, 2) }}</p>
                                        </div>

                                        <div class="bg-orange-50 rounded-lg p-3 border border-orange-200">
                                            <div class="flex items-center gap-2 text-orange-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <span class="font-medium text-sm">Unpaid Orders</span>
                                            </div>
                                            <p class="text-lg font-bold text-orange-800">{{ $unpaidOrders->count() }}</p>
                                            <p class="text-xs text-orange-600">₱{{ number_format($unpaidTotal, 2) }}</p>
                                        </div>

                                        <div class="bg-blue-50 rounded-lg p-3 border border-blue-200">
                                            <div class="flex items-center gap-2 text-blue-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                                </svg>
                                                <span class="font-medium text-sm">Total Orders</span>
                                            </div>
                                            <p class="text-lg font-bold text-blue-800">{{ count($reserveroom->restaurant_orders) }}</p>
                                            <p class="text-xs text-blue-600">₱{{ number_format($paidTotal + $unpaidTotal, 2) }}</p>
                                        </div>
                                    </div>

                                    <!-- Individual Orders -->
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                        @foreach($reserveroom->restaurant_orders as $order)
                                                                            <div class="bg-white rounded-lg p-4 border {{ $order->payment_resto_status == 'Paid' ? 'border-green-200 bg-green-50' : 'border-orange-200' }} shadow-sm hover:shadow-md transition-shadow">
                                                                                <div class="flex items-start gap-3">
                                                                                    <!-- Food Image -->
                                                                                    <div class="w-14 h-14 rounded-lg overflow-hidden flex-shrink-0">
                                                                                        <img src="{{ asset($order->menu_photo ?? 'placeholder-food.jpg') }}" 
                                                                                             alt="{{ $order->description }}" 
                                                                                             class="w-full h-full object-cover"
                                                                                             onerror="this.src='/placeholder-food.jpg'">
                                                                                    </div>

                                                                                    <!-- Order Details -->
                                                                                    <div class="flex-1">
                                                                                        <div class="flex justify-between items-start mb-2">
                                                                                            <div>
                                                                                                <p class="font-medium text-gray-800 text-sm">{{ $order->description }}</p>
                                                                                                <p class="text-xs text-gray-600">{{ $order->quantity }} × ₱{{ number_format($order->unit_price, 2) }}</p>
                                                                                            </div>
                                                                                            <div class="text-right">
                                                                                                <p class="font-semibold {{ $order->payment_resto_status == 'Paid' ? 'text-green-600' : 'text-orange-600' }} text-sm">
                                                                                                    ₱{{ number_format($order->total_amount, 2) }}
                                                                                                </p>
                                                                                                <p class="text-xs text-gray-500">Inv #{{ $order->invoice_number }}</p>
                                                                                            </div>
                                                                                        </div>

                                                                                        <!-- Payment Status -->
                                                                                        <div class="flex justify-between items-center text-xs pt-2 border-t border-gray-100">
                                                                                            <span class="font-medium px-2 py-1 rounded-full text-xs {{ $order->payment_resto_status == 'Paid' ? 'bg-green-100 text-green-700' : 'bg-orange-100 text-orange-700' }}">
                                                                                                {{ $order->payment_resto_status == 'Paid' ? '✓ Paid' : '○ Pending' }}
                                                                                            </span>
                                                                                            <span class="text-gray-500">
                                                                                                {{ $order->payment_date ? date('M d, Y', strtotime($order->payment_date)) : 'Awaiting payment' }}
                                                                                            </span>
                                                                                        </div>

                                                                                        <!-- Action Button for Admin -->
                                                                                    <!-- In your restaurant orders section -->
                                                                                    @if($order->payment_resto_status != 'Paid')
                                                                                        <div class="mt-3 pt-2 border-t border-gray-100">
                                                                                            <button onclick="mark_as_paid_modal_{{ $order->BP_id }}.showModal()"
                                                                                                class="w-full px-3 py-2 bg-green-600 hover:bg-green-700 text-white text-xs font-medium rounded-lg flex items-center justify-center gap-2 transition-colors">
                                                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                                                </svg>
                                                                                                Mark as Paid
                                                                                            </button>
                                                                                        </div>
                                                                                    @endif

                                                                                    <!-- Modal for each order -->
                                                                                <dialog id="mark_as_paid_modal_{{ $order->BP_id }}" class="modal modal-bottom sm:modal-middle backdrop-blur-sm">
                                                <div class="modal-box max-w-3xl w-full p-0 bg-white shadow-2xl border border-gray-200 max-h-[95vh] flex flex-col overflow-hidden">

                                                    <!-- Fixed Header -->
                                                    <div class="flex-shrink-0 bg-gradient-to-r from-blue-900 to-blue-800 px-4 py-4 sm:p-6 text-white">
                                                        <div class="flex items-center justify-between gap-3">
                                                            <div class="flex items-center gap-2 sm:gap-3 flex-1 min-w-0">
                                                                <div class="bg-yellow-400/20 p-2 sm:p-3 rounded-full flex-shrink-0">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 sm:h-8 sm:w-8 text-yellow-400" fill="none"
                                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                    </svg>
                                                                </div>
                                                                <div class="min-w-0">
                                                                    <h3 class="text-lg sm:text-xl font-bold truncate">Confirm Payment</h3>
                                                                    <p class="text-xs sm:text-sm text-yellow-300/90">Mark this order as paid?</p>
                                                                </div>
                                                            </div>
                                                            <form method="dialog" class="flex-shrink-0">
                                                                <button class="btn btn-sm btn-circle bg-yellow-400/10 hover:bg-yellow-400/20 border-0 text-yellow-400 transition-all duration-300">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                                                    </svg>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>

                                                    <!-- Scrollable Content -->
                                                    <div class="flex-1 overflow-y-auto scrollbar-thin scrollbar-thumb-blue-900 scrollbar-track-gray-100 scrollbar-thumb-rounded-full scrollbar-track-rounded-full">
                                                        <div class="p-4 sm:p-6">

                                                            <!-- Order Details Grid -->
                                                            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6 mb-4 sm:mb-6">

                                                                <!-- Food Image -->
                                                                <div class="lg:col-span-1">
                                                                    <div class="aspect-square rounded-xl overflow-hidden border-4 border-blue-100 shadow-lg">
                                                                        <img src="{{ asset($order->menu_photo ?? 'storage/placeholder-food.jpg') }}"
                                                                            alt="{{ $order->menu_name ?? $order->description }}"
                                                                            class="w-full h-full object-cover transition-transform duration-300 hover:scale-105"
                                                                            onerror="this.src='{{ asset('images/placeholder-food.jpg') }}'">
                                                                    </div>
                                                                    <div class="mt-3 text-center bg-blue-50 rounded-lg p-2 border border-blue-200">
                                                                        <div class="text-xs text-blue-600">Order ID</div>
                                                                        <div class="text-sm font-bold text-blue-900">{{ $order->BP_id }}</div>
                                                                    </div>
                                                                </div>

                                                                <!-- Order Information -->
                                                                <div class="lg:col-span-2 space-y-3 sm:space-y-4">

                                                                    <!-- Food Name -->
                                                                    <div class="p-3 sm:p-4 bg-gradient-to-r from-blue-50 to-yellow-50 rounded-lg border border-blue-200">
                                                                        <h4 class="text-base sm:text-xl font-bold text-blue-900 mb-1 sm:mb-2">
                                                                            {{ $order->menu_name ?? $order->description }}
                                                                        </h4>
                                                                        @if($order->description)
                                                                            <p class="text-xs sm:text-sm text-blue-700">{{ $order->description }}</p>
                                                                        @endif
                                                                    </div>

                                                                    <!-- Order Details Cards -->
                                                                    <div class="grid grid-cols-2 gap-3 sm:gap-4">
                                                                        <div class="bg-white p-3 sm:p-4 rounded-lg border-2 border-blue-200 text-center hover:border-yellow-400 transition-colors group">
                                                                            <div class="flex items-center justify-center gap-2 mb-1 sm:mb-2">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                                                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                                                    stroke-linejoin="round" class="text-blue-700 group-hover:text-yellow-500 transition-colors">
                                                                                    <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                                                                                    <line x1="1" y1="10" x2="23" y2="10"></line>
                                                                                </svg>
                                                                                <p class="text-xs sm:text-sm text-blue-700 font-medium group-hover:text-yellow-600 transition-colors">Quantity</p>
                                                                            </div>
                                                                            <p class="text-xl sm:text-2xl font-bold text-blue-900 group-hover:text-yellow-600 transition-colors">
                                                                                {{ $order->order_quantity ?? $order->quantity ?? 1 }}
                                                                            </p>
                                                                        </div>
                                                                        <div class="bg-white p-3 sm:p-4 rounded-lg border-2 border-blue-200 text-center hover:border-yellow-400 transition-colors group">
                                                                            <div class="flex items-center justify-center gap-2 mb-1 sm:mb-2">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                                                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                                                    stroke-linejoin="round" class="text-blue-700 group-hover:text-yellow-500 transition-colors">
                                                                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                                                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                                                                </svg>
                                                                                <p class="text-xs sm:text-sm text-blue-700 font-medium group-hover:text-yellow-600 transition-colors">Unit Price</p>
                                                                            </div>
                                                                            <p class="text-xl sm:text-2xl font-bold text-blue-900 group-hover:text-yellow-600 transition-colors">
                                                                                ₱{{ number_format($order->menu_price ?? $order->unit_price ?? 0, 2) }}
                                                                            </p>
                                                                        </div>
                                                                    </div>

                                                                    <!-- Total Amount -->
                                                                    <div class="bg-gradient-to-br from-blue-50 via-blue-100 to-yellow-50 rounded-xl p-4 sm:p-5 border-2 border-yellow-400 shadow-sm">
                                                                        <div class="flex items-center justify-between">
                                                                            <div class="flex items-center gap-2">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                                                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                                                    stroke-linejoin="round" class="text-blue-900">
                                                                                    <circle cx="12" cy="12" r="10"></circle>
                                                                                    <path d="M12 6v6l4 2"></path>
                                                                                </svg>
                                                                                <p class="text-sm sm:text-base text-blue-900 font-semibold">Total Amount</p>
                                                                            </div>
                                                                            <p class="text-2xl sm:text-3xl font-black text-blue-900">
                                                                                ₱{{ number_format(($order->order_quantity ?? $order->quantity ?? 1) * ($order->menu_price ?? $order->unit_price ?? 0), 2) }}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Confirmation Warning Message -->
                                                            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-3 sm:p-4 mb-4 sm:mb-6 rounded-r-lg">
                                                                <div class="flex items-start gap-3">
                                                                    <div class="flex-shrink-0 mt-0.5">
                                                                        <svg class="h-5 w-5 text-yellow-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                                            fill="currentColor">
                                                                            <path fill-rule="evenodd"
                                                                                d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                                                                clip-rule="evenodd" />
                                                                        </svg>
                                                                    </div>
                                                                    <div class="flex-1 min-w-0">
                                                                        <p class="text-xs sm:text-sm text-yellow-800">
                                                                            <strong class="font-bold text-blue-900">Important Notice:</strong>
                                                                            Are you sure you want to mark this order as paid? This action cannot be undone. Please
                                                                            verify all order details before proceeding.
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Fixed Footer with Action Buttons -->
                                                    <div class="flex-shrink-0 bg-blue-50 border-t border-blue-200 px-4 py-4 sm:px-6 sm:py-5">
                                                        <div class="flex flex-col-reverse sm:flex-row justify-end gap-3">
                                                            <form method="dialog" class="w-full sm:w-auto">
                                                                <button class="btn btn-outline w-full sm:w-auto border-2 border-blue-300 hover:bg-blue-100 hover:border-blue-400 text-blue-700 hover:text-blue-800 transition-all duration-300">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                                                    </svg>
                                                                    Cancel
                                                                </button>
                                                            </form>
                                                            <form method="POST" action="/markaspaidResto/{{ $order->BP_id }}"
                                                                class="w-full sm:w-auto">
                                                                @csrf
                                                                @method('PUT')
                                                                <button type="submit"
                                                                    class="btn w-full sm:w-auto bg-blue-900 hover:bg-blue-800 border-0 text-white shadow-lg hover:shadow-xl transition-all duration-300 group">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 group-hover:text-yellow-300 transition-colors" fill="none" viewBox="0 0 24 24"
                                                                        stroke="currentColor">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                    </svg>
                                                                    <span class="group-hover:text-yellow-300 transition-colors">Yes, Mark as Paid</span>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Backdrop -->
                                                <form method="dialog" class="modal-backdrop">
                                                    <button>close</button>
                                                </form>
                                            </dialog>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                @else
                    <div class="bg-gray-50 rounded-xl p-4 mb-6 border border-gray-200">
                        <div class="text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-3 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2h6v2m-7 4h8a2 2 0 0 0 2-2v-6a2 2 0 0 0-2-2h-1V7a3 3 0 0 0-6 0v4H9a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2z" />
                            </svg>
                            <p class="text-gray-600 font-medium">No Restaurant Orders</p>
                            <p class="text-gray-500 text-sm">This guest hasn't ordered any food items yet.</p>
                        </div>
                    </div>
                @endif

                                                        <form action="/modifyreservation/{{$reserveroom->reservationID}}" method="POST" id="reservationForm">
                                                            @method('PUT')
                                                            @csrf

                                                            <!-- Room Information -->
                                                            <div
                                                                class="bg-gradient-to-br from-base-100 to-base-200 rounded-xl p-4 sm:p-6 mb-6 shadow-md border border-base-300 mt-5">
                                                                <h2 class="text-base sm:text-lg font-semibold text-gray-700 flex items-center gap-2 mb-4">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24"
                                                                        stroke="currentColor">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                                                    </svg>
                                                                    Room Information
                                                                </h2>

                                                                <div class="card bg-white shadow-xl hover:shadow-2xl transition-all duration-300 overflow-hidden">
                                                                    <div class="flex flex-col lg:flex-row">
                                                                        <figure class="lg:w-2/5 h-48 sm:h-56 lg:h-auto overflow-hidden">
                                                                            <img class="w-full h-full object-cover hover:scale-110 transition-transform duration-500"
                                                                                src="{{ asset($reserveroom->roomphoto) }}" alt="Room image">
                                                                        </figure>
                                                                        <div class="card-body p-4 sm:p-6 lg:w-3/5">
                                                                            <h2 class="card-title text-base sm:text-lg md:text-xl text-primary mb-3">
                                                                                Room #{{$reserveroom->roomID}} - {{$reserveroom->roomtype}}
                                                                            </h2>

                                                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-sm sm:text-base">
                                                                                <div class="flex items-center gap-2 bg-base-200 p-3 rounded-lg">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-primary flex-shrink-0"
                                                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                                            d="M4 8V4a1 1 0 011-1h4M4 8v8a2 2 0 002 2h8a2 2 0 002-2V8m0 0h4a1 1 0 011 1v4m0 0v4a1 1 0 01-1 1h-4" />
                                                                                    </svg>
                                                                                    <span class="font-medium">{{$reserveroom->roomsize}} sq.ft</span>
                                                                                </div>
                                                                                <div class="flex items-center gap-2 bg-base-200 p-3 rounded-lg">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-primary flex-shrink-0"
                                                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                                                                    </svg>
                                                                                    <span class="font-medium">{{$reserveroom->roommaxguest}} Guests</span>
                                                                                </div>
                                                                                <div class="flex items-center gap-2 bg-primary/10 p-3 rounded-lg sm:col-span-2">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-primary flex-shrink-0"
                                                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                                    </svg>
                                                                                    <span class="font-bold text-lg text-primary">₱{{$reserveroom->roomprice}}.00 <span
                                                                                            class="text-sm font-normal text-gray-600">per night</span></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Reservation Details -->
                                                            <div
                                                                class="bg-gradient-to-br from-base-100 to-base-200 rounded-xl p-4 sm:p-6 mb-6 shadow-md border border-base-300">
                                                                <h2 class="text-base sm:text-lg font-semibold text-gray-700 flex items-center gap-2 mb-4">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#001f54]" fill="none" viewBox="0 0 24 24"
                                                                        stroke="currentColor">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                                    </svg>
                                                                    Reservation Details
                                                                </h2>

                                                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                                                    <div class="form-control">
                                                                        <label class="label">
                                                                            <span class="label-text font-semibold text-gray-700">Check-In Date</span>
                                                                        </label>
                                                                        <input value="{{$reserveroom->reservation_checkin}}" type="date" name="reservation_checkin"
                                                                            class="input input-bordered w-full focus:ring-2 focus:ring-[#001f54] focus:border-[#001f54]" required />
                                                                    </div>

                                                                    <div class="form-control">
                                                                        <label class="label">
                                                                            <span class="label-text font-semibold text-gray-700">Check-Out Date</span>
                                                                        </label>
                                                                        <input type="date" value="{{$reserveroom->reservation_checkout}}" name="reservation_checkout"
                                                                            class="input input-bordered w-full focus:ring-2 focus:ring-[#001f54] focus:border-[#001f54]" required />
                                                                    </div>

                                                                    <div class="form-control">
                                                                        <label class="label">
                                                                            <span class="label-text font-semibold text-gray-700">Adults</span>
                                                                        </label>
                                                                        <input value="{{$reserveroom->reservation_adults ?? 1}}" type="number" name="reservation_adults" min="1"
                                                                            max="{{$reserveroom->roommaxguest}}" class="input input-bordered w-full focus:ring-2 focus:ring-[#001f54] focus:border-[#001f54]"
                                                                            required />
                                                                    </div>

                                                                    <div class="form-control">
                                                                        <label class="label">
                                                                            <span class="label-text font-semibold text-gray-700">Children</span>
                                                                        </label>
                                                                        <input value="{{$reserveroom->reservation_children ?? 0}}" type="number" name="reservation_children" min="0"
                                                                            max="{{$reserveroom->roommaxguest}}" class="input input-bordered w-full focus:ring-2 focus:ring-[#001f54] focus:border-[#001f54]"
                                                                            required />
                                                                    </div>

                                                                    <div class="form-control">
                                                                        <label class="label">
                                                                            <span class="label-text font-semibold text-gray-700">Early Check-in Time</span>
                                                                        </label>
                                                                        <select name="early_checkin_time" class="select select-bordered w-full focus:ring-2 focus:ring-[#001f54] focus:border-[#001f54]">
                                                                            <option value="">Standard (2-4 PM)</option>
                                                                            <option value="10:00 AM" {{ $reserveroom->early_checkin_time == '10:00 AM' ? 'selected' : '' }}>10:00 AM</option>
                                                                            <option value="11:00 AM" {{ $reserveroom->early_checkin_time == '11:00 AM' ? 'selected' : '' }}>11:00 AM</option>
                                                                            <option value="12:00 PM" {{ $reserveroom->early_checkin_time == '12:00 PM' ? 'selected' : '' }}>12:00 PM</option>
                                                                            <option value="1:00 PM" {{ $reserveroom->early_checkin_time == '1:00 PM' ? 'selected' : '' }}>1:00 PM</option>
                                                                        </select>
                                                                    </div>

                                                                    <div class="form-control">
                                                                        <label class="label">
                                                                            <span class="label-text font-semibold text-gray-700">Late Check-out Time</span>
                                                                        </label>
                                                                        <select name="late_checkout_time" class="select select-bordered w-full focus:ring-2 focus:ring-[#001f54] focus:border-[#001f54]">
                                                                            <option value="">Standard (10 AM-12 PM)</option>
                                                                            <option value="1:00 PM" {{ $reserveroom->late_checkout_time == '1:00 PM' ? 'selected' : '' }}>1:00 PM</option>
                                                                            <option value="2:00 PM" {{ $reserveroom->late_checkout_time == '2:00 PM' ? 'selected' : '' }}>2:00 PM</option>
                                                                            <option value="3:00 PM" {{ $reserveroom->late_checkout_time == '3:00 PM' ? 'selected' : '' }}>3:00 PM</option>
                                                                            <option value="4:00 PM" {{ $reserveroom->late_checkout_time == '4:00 PM' ? 'selected' : '' }}>4:00 PM</option>
                                                                        </select>
                                                                    </div>

                                                                    <div class="form-control sm:col-span-2 lg:col-span-3">
                                                                        <label class="label">
                                                                            <span class="label-text font-semibold text-gray-700">Special Requests</span>
                                                                        </label>
                                                                        @php
        $specialRequests = $reserveroom->reservation_specialrequest ? explode(', ', $reserveroom->reservation_specialrequest) : [];
                                                                        @endphp
                                                                        <div class="space-y-2">
                                                                            <div class="flex flex-wrap gap-2">
                                                                                <label class="flex items-center gap-2 cursor-pointer">
                                                                                    <input type="checkbox" name="special_requests[]" value="Early check-in" 
                                                                                        @if(in_array('Early check-in', $specialRequests)) checked @endif
                                                                                        class="checkbox checkbox-sm">
                                                                                    <span class="text-sm">Early check-in</span>
                                                                                </label>
                                                                                <label class="flex items-center gap-2 cursor-pointer">
                                                                                    <input type="checkbox" name="special_requests[]" value="Late check-out"
                                                                                        @if(in_array('Late check-out', $specialRequests)) checked @endif
                                                                                        class="checkbox checkbox-sm">
                                                                                    <span class="text-sm">Late check-out</span>
                                                                                </label>
                                                                                <label class="flex items-center gap-2 cursor-pointer">
                                                                                    <input type="checkbox" name="special_requests[]" value="Extra pillows"
                                                                                        @if(in_array('Extra pillows', $specialRequests)) checked @endif
                                                                                        class="checkbox checkbox-sm">
                                                                                    <span class="text-sm">Extra pillows</span>
                                                                                </label>
                                                                                <label class="flex items-center gap-2 cursor-pointer">
                                                                                    <input type="checkbox" name="special_requests[]" value="Room with view"
                                                                                        @if(in_array('Room with view', $specialRequests)) checked @endif
                                                                                        class="checkbox checkbox-sm">
                                                                                    <span class="text-sm">Room with view</span>
                                                                                </label>
                                                                                <label class="flex items-center gap-2 cursor-pointer">
                                                                                    <input type="checkbox" name="special_requests[]" value="Away from elevator"
                                                                                        @if(in_array('Away from elevator', $specialRequests)) checked @endif
                                                                                        class="checkbox checkbox-sm">
                                                                                    <span class="text-sm">Away from elevator</span>
                                                                                </label>
                                                                            </div>
                                                                            <input type="text" name="custom_special_request" placeholder="Add custom request..."
                                                                                class="input input-bordered w-full focus:ring-2 focus:ring-[#001f54] focus:border-[#001f54] text-sm">
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-control">
                                                                        <label class="label">
                                                                            <span class="label-text font-semibold text-gray-700">Booking Status</span>
                                                                        </label>
                                                                        <div class="relative">
                                                                            <input readonly type="text" value="{{$reserveroom->reservation_bookingstatus}}"
                                                                                class="input input-bordered w-full bg-base-200 font-semibold text-[#001f54] cursor-not-allowed" />
                                                                            <div class="absolute right-3 top-1/2 -translate-y-1/2">
                                                                                <div class="badge badge-[#001f54] badge-sm">Active</div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-control sm:col-span-2 lg:col-span-1">
                                                                        <label class="label">
                                                                            <span class="label-text font-semibold text-gray-700">Booked Via</span>
                                                                        </label>
                                                                        <input type="text" value="{{$reserveroom->bookedvia}}" name="bookedvia"
                                                                            class="input input-bordered w-full focus:ring-2 focus:ring-[#001f54] focus:border-[#001f54]" />
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Guest Information -->
                                                            <div
                                                                class="bg-gradient-to-br from-base-100 to-base-200 rounded-xl p-4 sm:p-6 mb-6 shadow-md border border-base-300">
                                                                <h2 class="text-base sm:text-lg font-semibold text-gray-700 flex items-center gap-2 mb-4">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24"
                                                                        stroke="currentColor">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                                    </svg>
                                                                    Guest Information
                                                                </h2>

                                                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                                                    <!-- Full Name -->
                                                                    <div class="form-control">
                                                                        <label class="label">
                                                                            <span class="label-text font-semibold text-gray-700">Full Name</span>
                                                                        </label>
                                                                        <input value="{{$reserveroom->guestname}}" type="text" name="guestname"
                                                                            class="input input-bordered focus:input-primary" placeholder="Juan Dela Cruz" required />
                                                                    </div>

                                                                    <!-- Birthday -->
                                                                    <div class="form-control">
                                                                        <label class="label">
                                                                            <span class="label-text font-semibold text-gray-700">Birthday</span>
                                                                        </label>
                                                                        <input value="{{$reserveroom->guestbirthday}}" id="guestbirthday" type="date" name="guestbirthday"
                                                                            class="input input-bordered focus:input-primary" required />
                                                                        <label class="label">
                                                                            <span id="ageError" class="label-text-alt text-error font-semibold hidden">Age must be 18 or
                                                                                above</span>
                                                                        </label>
                                                                    </div>

                                                                    <!-- Mobile Number -->
                                                                    <div class="form-control">
                                                                        <label class="label">
                                                                            <span class="label-text font-semibold text-gray-700">Mobile Number</span>
                                                                        </label>
                                                                        <input value="{{$reserveroom->guestphonenumber}}" type="tel" name="guestphonenumber"
                                                                            class="input input-bordered focus:input-primary" placeholder="+63 900 000 0000" required />
                                                                    </div>

                                                                    <!-- Email Address -->
                                                                    <div class="form-control sm:col-span-2 lg:col-span-1">
                                                                        <label class="label">
                                                                            <span class="label-text font-semibold text-gray-700">Email Address</span>
                                                                        </label>
                                                                        <input value="{{$reserveroom->guestemailaddress}}" type="email" name="guestemailaddress"
                                                                            class="input input-bordered focus:input-primary" placeholder="juan@example.com" required />
                                                                    </div>

                                                                    <!-- Contact Person -->
                                                                    <div class="form-control">
                                                                        <label class="label">
                                                                            <span class="label-text font-semibold text-gray-700">Contact Person</span>
                                                                        </label>
                                                                        <input value="{{$reserveroom->guestcontactperson}}" type="text" name="guestcontactperson"
                                                                            class="input input-bordered focus:input-primary" placeholder="Maria Dela Cruz" required />
                                                                    </div>

                                                                    <!-- Contact Person Number -->
                                                                    <div class="form-control">
                                                                        <label class="label">
                                                                            <span class="label-text font-semibold text-gray-700">Contact Person Number</span>
                                                                        </label>
                                                                        <input value="{{$reserveroom->guestcontactpersonnumber}}" type="tel" name="guestcontactpersonnumber"
                                                                            class="input input-bordered focus:input-primary" placeholder="+63 912 345 6789" required />
                                                                    </div>

                                                                    <!-- Payment Method -->
                                                                    <div class="form-control">
                                                                        <label class="label">
                                                                            <span class="label-text font-semibold text-gray-700">Payment Method</span>
                                                                        </label>
                                                                        <select name="payment_method" class="select select-bordered focus:select-primary" required>
                                                                            <option value="{{$reserveroom->payment_method}}" selected>{{$reserveroom->payment_method}}</option>
                                                                        </select>
                                                                    </div>

                                                                    <!-- Address -->
                                                                    <div class="form-control sm:col-span-2 lg:col-span-3">
                                                                        <label class="label">
                                                                            <span class="label-text font-semibold text-gray-700">Address</span>
                                                                        </label>
                                                                        <textarea name="guestaddress" class="textarea textarea-bordered focus:textarea-primary"
                                                                            placeholder="123 Barangay St., City, Province" rows="2"
                                                                            required>{{$reserveroom->guestaddress}}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="bg-gradient-to-br from-base-100 to-base-200 rounded-xl p-4 sm:p-6 mb-6 shadow-md border border-base-300">

                                                                <h2 class="text-base sm:text-lg font-semibold text-gray-700 flex items-center gap-2 mb-4">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24"
                                                                        stroke="currentColor">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                                    </svg>
                                                                    Valid ID
                                                                </h2>

                                                                <div id="imagePreviewContainer" class="mt-2">
                                                                    @if($reserveroom->reservation_validID)
                                                                        @php
            $file = $reserveroom->reservation_validID;
            $isImage = preg_match('/\.(jpg|jpeg|png|gif)$/i', $file);
                                                                        @endphp
                                                                        @if($isImage)
                                                                            <img src="{{ asset($file) }}" alt="Valid ID" class="max-h-96 w-full rounded-md" />
                                                                        @endif
                                                                    @else
                                                                        <div class="text-center text-gray-500">
                                                                            No valid ID uploaded
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <form method="dialog" class="modal-backdrop">
                                                        <button>close</button>
                                                    </form>
                                                </dialog>

                                                <!-- Actions Drawer -->
                                                <div id="actions-drawer-{{$reserveroom->reservationID}}"
                                                    class="fixed top-0 right-0 h-full w-64 bg-white shadow-lg transform translate-x-full transition-transform duration-300 ease-in-out z-50">
                                                    <div class="p-4 border-b relative">
                                                        <h4 class="font-bold">Actions for Booking #{{$reserveroom->bookingID}}</h4>
                                                        <button
                                                            onclick="document.getElementById('actions-drawer-{{$reserveroom->reservationID}}').classList.add('translate-x-full')"
                                                            class="absolute top-3 right-3 btn btn-xs btn-circle btn-ghost">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                                                stroke="currentColor" stroke-width="2">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                            </svg>
                                                        </button>
                                                    </div>

                                                    <div class="p-4 space-y-2 ">
                                                        <button onclick="confirm_reservation_{{$reserveroom->reservationID}}.showModal()"
                                                            class="btn btn-sm btn-block btn-primary justify-start gap-2 @if(in_array($reserveroom->reservation_bookingstatus, ['Confirmed', 'Checked in', 'Checked out'])) hidden @endif">
                                                            Confirm Reservation
                                                        </button>

                                                        @if($reserveroom->reservation_bookingstatus === 'Confirmed')
                                                            <button onclick="checkin_reservation_{{$reserveroom->reservationID}}.showModal()"
                                                                class="btn btn-sm btn-block btn-primary justify-start gap-2">
                                                                Check-In Guest
                                                            </button>
                                                        @endif

                                                        @if($reserveroom->reservation_bookingstatus === 'Checked in')
                                                            <button onclick="checkout_reservation_{{$reserveroom->reservationID}}.showModal()"
                                                                class="btn btn-sm btn-block btn-warning btn-info justify-start gap-2">
                                                                Check-Out Guest
                                                            </button>
                                                        @endif

                                                        @if($reserveroom->reservation_bookingstatus != 'Confirmed')
                                                            <button onclick="cancel_reservation_{{$reserveroom->reservationID}}.showModal()"
                                                                class="btn btn-sm btn-block btn-info justify-start gap-2 @if(in_array($reserveroom->reservation_bookingstatus, ['Confirmed', 'Checked in', 'Checked out'])) hidden @endif">
                                                                Cancel Reservation
                                                            </button>
                                                        @endif

                                                        <button onclick="delete_reservation_{{$reserveroom->reservationID}}.showModal()"
                                                            class="btn btn-sm btn-block btn-error justify-start gap-2">
                                                            Delete Reservation
                                                        </button>
                                                    </div>
                                                </div>
    @endforeach
</div>



<!-- Assign Keycard Modal -->
@foreach($reserverooms as $reserveroom)
<dialog id="assign_keycard_{{$reserveroom->reservationID}}" class="modal">
    <div class="modal-box">
        <h3 class="text-lg font-bold">Assign Keycard</h3>
        <p class="py-4">Assign a keycard to this reservation?</p>
        <div class="modal-action">
            <button type="button" onclick="document.getElementById('assign_keycard_{{$reserveroom->reservationID}}').close()" class="btn">
                No
            </button>
            <a href="/assignkeycard/{{$reserveroom->reservationID}}" class="btn" style="background-color: #001f54; color: white;">
                Yes, Assign
            </a>
        </div>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>
@endforeach

<!-- Generate Receipt Modal -->
@foreach($reserverooms as $reserveroom)
<dialog id="confirm_receipt_{{$reserveroom->reservationID}}" class="modal">
    <div class="modal-box">
        <h3 class="text-lg font-bold">Generate Receipt</h3>
        <p class="py-4">Are you sure you want to generate a receipt for this reservation?</p>
        <div class="modal-action">
            <form method="dialog">
                <button class="btn">Cancel</button>
            </form>
            <a href="/printreceipt/{{$reserveroom->reservationID}}" target="_blank" class="btn btn-primary" style="background-color: #001f54; color: white;">
                Yes, Generate
            </a>
        </div>
    </div>
</dialog>
@endforeach




</div>
</div>