<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">

    <!-- Total Reservations -->
    <div
        class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-2xl transition-all duration-300 border-2 border-transparent hover:border-blue-400 hover:-translate-y-2 group cursor-pointer">
        <div class="flex items-start justify-between mb-4">
            <div class="p-3 bg-blue-900 rounded-xl shadow-lg group-hover:scale-110 transition-transform">
                <i class="fas fa-calendar-days text-2xl text-yellow-400"></i>
            </div>
            @php
                $diff = $guesttotalreservation - $previousReservations;
                $isPositive = $diff >= 0;
            @endphp
            <span
                class="text-xs font-semibold px-2 py-1 rounded-full {{ $isPositive ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                {{ $isPositive ? '+' : '' }}{{ $diff }}
            </span>
        </div>
        <h3 class="text-gray-600 text-sm font-medium mb-1">Total Reservations</h3>
        <p class="text-3xl font-bold text-gray-900">{{ $guesttotalreservation }}</p>
        <p class="text-xs text-gray-500 mt-2">vs last month</p>
    </div>

    <!-- Upcoming Events -->
    <div
        class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-2xl transition-all duration-300 border-2 border-transparent hover:border-purple-400 hover:-translate-y-2 group cursor-pointer">
        <div class="flex items-start justify-between mb-4">
            <div class="p-3 bg-blue-900 rounded-xl shadow-lg group-hover:scale-110 transition-transform">
                <i class="fa-solid fa-calendar-check text-2xl text-yellow-400"></i>
            </div>
            <span class="text-xs font-semibold px-2 py-1 rounded-full bg-purple-100 text-purple-700">
                Active
            </span>
        </div>
        <h3 class="text-gray-600 text-sm font-medium mb-1">Events</h3>
        <p class="text-3xl font-bold text-gray-900">{{ $totaleventreservation }}</p>
        <p class="text-xs text-gray-500 mt-2">Events Booked</p>
    </div>

    <!-- Recent Stay -->
    <div
        class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-2xl transition-all duration-300 border-2 border-transparent hover:border-amber-400 hover:-translate-y-2 group cursor-pointer">
        <div class="flex items-start justify-between mb-4">
            <div class="p-3 bg-blue-900 rounded-xl shadow-lg group-hover:scale-110 transition-transform">
                <i class="fas fa-clock text-2xl text-yellow-400"></i>
            </div>
        </div>
        <h3 class="text-gray-600 text-sm font-medium mb-1">Recent Stay</h3>
        <p class="text-xl font-bold text-gray-900">
            @if($recentstay)
                {{ \Carbon\Carbon::parse($recentstay->reservation_checkin)->format('M d') }} -
                {{ \Carbon\Carbon::parse($recentstay->reservation_checkout)->format('M d') }}
            @else
                No Recent Stay
            @endif
        </p>
        <p class="text-xs text-gray-500 mt-2">
            @if($recentstay)
                {{ \Carbon\Carbon::parse($recentstay->reservation_checkin)->format('Y') }}
            @else
                -
            @endif
        </p>
    </div>

    <!-- Loyalty Points -->
    <div
        class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-all duration-300 border-2 border-transparent hover:border-green-400 group">
        <div class="flex items-start justify-between mb-4">
            <div class="p-3 bg-blue-900 rounded-xl shadow-lg group-hover:scale-110 transition-transform">
                <i class="fas fa-coins text-2xl text-yellow-400"></i>
            </div>
            <span class="text-xs font-semibold px-2 py-1 rounded-full bg-blue-900 text-yellow-400">
                <i class="fas fa-arrow-up text-xs"></i>
            </span>
        </div>
        <h3 class="text-gray-600 text-sm font-medium mb-1">Loyalty Points</h3>
        <p class="text-3xl font-bold text-gray-900">
            {{ $myloyaltypoints ?? 0 }}
        </p>
        <p class="text-xs text-gray-500 mt-2">Ready to redeem</p>
    </div>

</div>