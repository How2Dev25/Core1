<div
    class="relative bg-blue-900 rounded-xl p-6 text-white overflow-hidden loyalty-status-card">
    <!-- Decorative Background Elements -->
    <div class="absolute top-0 right-0 w-40 h-40 bg-white/5 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-32 h-32 bg-blue-500/10 rounded-full blur-2xl"></div>

    <!-- Content Container -->
    <div class="relative z-10">
        <!-- Header -->
        <div class="flex items-center justify-between mb-4">
            <div>
                <h3 class="text-lg font-semibold">Loyalty Status</h3>
                <p class="text-blue-100 text-sm">Earn points and enjoy exclusive benefits</p>
            </div>
            <div class="text-right">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-sm font-bold shadow-lg backdrop-blur-sm border border-white/20"
                    style="background-color: {{ $badgeColor }}30; color: {{ $badgeColor }}">
                    {{ $currentTier }}
                </div>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div
                class="bg-white/10 backdrop-blur-sm rounded-lg p-3 border border-white/20 hover:bg-white/15 transition-all duration-300">
                <div class="text-xs text-blue-100 mb-1">Points</div>
                <div class="text-2xl font-bold">{{ number_format($loyaltyPoints) }}</div>
            </div>
            <div
                class="bg-white/10 backdrop-blur-sm rounded-lg p-3 border border-white/20 hover:bg-white/15 transition-all duration-300">
                <div class="text-xs text-blue-100 mb-1">Total Spent</div>
                <div class="text-2xl font-bold">₱{{ number_format($totalSpent, 0) }}</div>
            </div>
        </div>

        <!-- Progress Bar -->
        @if($nextTier)
            <div class="mb-4 bg-white/10 backdrop-blur-sm rounded-lg p-3 border border-white/20">
                <div class="flex justify-between text-sm mb-2">
                    <span class="font-medium">Progress to {{ $nextTier }}</span>
                    <span class="font-bold">{{ number_format($progressPercentage, 0) }}%</span>
                </div>
                <div class="w-full bg-blue-800/50 rounded-full h-2 overflow-hidden">
                    <div class="bg-gradient-to-r from-white to-blue-200 h-2 rounded-full transition-all duration-500 shadow-lg"
                        style="width: {{ $progressPercentage }}%"></div>
                </div>
            </div>
        @endif

        <!-- Footer Actions -->
        <div class="flex justify-between items-center pt-3 border-t border-white/20">
            <a href="{{ route('loyalty.dashboard') }}"
                class="inline-flex items-center gap-1.5 text-white hover:text-blue-200 text-sm font-medium transition-colors duration-200 group">
                <span>View Details</span>
                <span class="transform group-hover:translate-x-1 transition-transform duration-200">→</span>
            </a>
            <div
                class="flex items-center gap-1.5 text-xs text-blue-100 bg-white/10 px-3 py-1.5 rounded-full border border-white/20">
                <span class="font-medium">{{ count($benefits) }} Active Benefits</span>
            </div>
        </div>
    </div>

    <style>
        .loyalty-status-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
        }
    </style>
</div>