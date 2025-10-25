<div class="bg-white  mb-8">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 gap-3">
        <h2 class="text-lg font-semibold text-gray-900 text-center sm:text-left">
            Active Employees
        </h2>
        <a href="#" class="text-sm text-blue-600 hover:text-blue-700 font-medium text-center sm:text-right">
            View all →
        </a>
    </div>

    <div class="space-y-3">
        @forelse ($sessions as $session)
            @php
                // Browser Detection
                $agent = $session->user_agent ?? '';
                $browserIcon = 'fa-globe';
                $browser = 'Unknown';
                $browserColor = 'text-gray-500';

                if (stripos($agent, 'Edg') !== false || stripos($agent, 'Edge') !== false) {
                    $browser = 'Edge';
                    $browserIcon = 'fa-edge';
                    $browserColor = 'text-blue-600';
                } elseif (stripos($agent, 'Chrome') !== false && stripos($agent, 'Edg') === false) {
                    $browser = 'Chrome';
                    $browserIcon = 'fa-chrome';
                    $browserColor = 'text-yellow-500';
                } elseif (stripos($agent, 'Firefox') !== false) {
                    $browser = 'Firefox';
                    $browserIcon = 'fa-firefox-browser';
                    $browserColor = 'text-orange-500';
                } elseif (stripos($agent, 'Safari') !== false && stripos($agent, 'Chrome') === false) {
                    $browser = 'Safari';
                    $browserIcon = 'fa-safari';
                    $browserColor = 'text-blue-400';
                } elseif (stripos($agent, 'Opera') !== false || stripos($agent, 'OPR') !== false) {
                    $browser = 'Opera';
                    $browserIcon = 'fa-opera';
                    $browserColor = 'text-red-500';
                }

                // OS Detection
                $osIcon = 'fa-desktop';
                $os = 'Desktop';
                if (stripos($agent, 'Windows') !== false) {
                    $osIcon = 'fa-windows';
                    $os = 'Windows';
                } elseif (stripos($agent, 'Macintosh') !== false) {
                    $osIcon = 'fa-apple';
                    $os = 'macOS';
                } elseif (stripos($agent, 'Linux') !== false) {
                    $osIcon = 'fa-linux';
                    $os = 'Linux';
                } elseif (stripos($agent, 'Android') !== false) {
                    $osIcon = 'fa-android';
                    $os = 'Android';
                } elseif (stripos($agent, 'iPhone') !== false || stripos($agent, 'iPad') !== false) {
                    $osIcon = 'fa-apple';
                    $os = 'iOS';
                }

                // Role Styles
                $role = strtolower($session->role ?? '');
                switch ($role) {
                    case 'hotel admin':
                        $gradient = 'from-red-500 to-rose-600';
                        $badgeBg = 'bg-red-100';
                        $badgeText = 'text-red-700';
                        break;

                    case 'receptionist':
                        $gradient = 'from-blue-500 to-blue-700';
                        $badgeBg = 'bg-blue-100';
                        $badgeText = 'text-blue-700';
                        break;

                    case 'room manager':
                        $gradient = 'from-indigo-500 to-indigo-700';
                        $badgeBg = 'bg-indigo-100';
                        $badgeText = 'text-indigo-700';
                        break;

                    case 'room attendant':
                        $gradient = 'from-teal-500 to-cyan-600';
                        $badgeBg = 'bg-cyan-100';
                        $badgeText = 'text-cyan-700';
                        break;

                    case 'maintenance staff':
                        $gradient = 'from-yellow-500 to-amber-600';
                        $badgeBg = 'bg-amber-100';
                        $badgeText = 'text-amber-700';
                        break;

                    case 'hotel inventory manager':
                        $gradient = 'from-pink-500 to-fuchsia-600';
                        $badgeBg = 'bg-pink-100';
                        $badgeText = 'text-pink-700';
                        break;

                    case 'material custodian':
                        $gradient = 'from-lime-500 to-green-600';
                        $badgeBg = 'bg-lime-100';
                        $badgeText = 'text-lime-700';
                        break;

                    case 'hotel marketing officer':
                        $gradient = 'from-orange-500 to-yellow-600';
                        $badgeBg = 'bg-orange-100';
                        $badgeText = 'text-orange-700';
                        break;

                    case 'guest relationship head':
                        $gradient = 'from-purple-500 to-violet-600';
                        $badgeBg = 'bg-purple-100';
                        $badgeText = 'text-purple-700';
                        break;

                    default:
                        $gradient = 'from-gray-400 to-gray-600';
                        $badgeBg = 'bg-gray-100';
                        $badgeText = 'text-gray-700';
                        break;
                }

            @endphp

            <!-- Activity Card -->
            <div
                class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-b border-gray-100 last:border-0 hover:bg-gray-50 rounded-lg p-4 transition-all duration-200 group">

                <!-- Left: Avatar and Info -->
                <div class="flex items-center gap-3 w-full sm:w-auto">
                    <div class="relative flex-shrink-0">
                        <div
                            class="w-12 h-12 bg-gradient-to-br {{ $gradient }} rounded-full flex items-center justify-center text-white font-bold shadow-md ring-2 ring-white">
                            {{ strtoupper(substr($session->employee_name, 0, 2)) }}
                        </div>
                        <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 rounded-full border-2 border-white">
                        </div>
                    </div>

                    <div class="min-w-0 flex-1">
                        <div class="flex flex-col sm:flex-row sm:items-center gap-1">
                            <span class="text-sm font-semibold text-gray-900 truncate">
                                {{ $session->employee_name }}
                            </span>
                            <span class="px-2 py-0.5 text-xs font-medium rounded-full {{ $badgeBg }} {{ $badgeText }}">
                                {{ ucfirst($session->role ?? 'User') }}
                            </span>
                        </div>

                        <div class="flex flex-wrap items-center gap-2 mt-1 text-xs text-gray-500">
                            <div class="flex items-center gap-1.5 {{ $browserColor }}">
                                <i class="fa-brands {{ $browserIcon }}"></i>
                                <span class="text-gray-700">{{ $browser }}</span>
                            </div>
                            <span class="hidden sm:inline text-gray-300">•</span>
                            <div class="flex items-center gap-1.5 text-gray-500">
                                <i class="fa-brands {{ $osIcon }}"></i>
                                <span class="text-gray-700">{{ $os }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Time -->
                <div class="flex flex-col items-start sm:items-end w-full sm:w-auto">
                    <span class="text-xs text-gray-400 whitespace-nowrap">
                        {{ \Carbon\Carbon::createFromTimestamp($session->last_activity)->diffForHumans() }}
                    </span>
                    <div
                        class="flex items-center gap-1 text-xs text-green-600 opacity-0 group-hover:opacity-100 transition-opacity">
                        <div class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></div>
                        <span>Active</span>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-10">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3">
                    <i class="fa-regular fa-clock text-3xl text-gray-400"></i>
                </div>
                <p class="text-gray-500 text-sm font-medium">No recent activities</p>
                <p class="text-gray-400 text-xs mt-1">User sessions will appear here</p>
            </div>
        @endforelse
    </div>
</div>