<div class="dropdown dropdown-end" wire:poll.5s>
    <!-- Button -->
    <button id="notification-button"
    tabindex="0"
    class="btn btn-ghost btn-circle relative w-12 h-12 flex items-center justify-center hover:bg-[#001f54]/20 transition">
    <i class="fa-solid fa-bell text-lg"></i>

    @if($notifications->count() > 0)
    <span class="absolute top-1 right-1 flex items-center justify-center w-4 h-4 text-[10px] font-bold text-white bg-red-500 rounded-full border border-white">
        {{ $notifications->count() }}
    </span>
@endif
</button>

    <!-- Dropdown Content -->
    <ul tabindex="0" class="dropdown-content menu mt-3 z-[1] bg-[#001f54] rounded-xl shadow-2xl overflow-hidden w-80">
        <!-- Header -->
        <li class="px-4 py-3 border-b flex justify-between items-center sticky top-0 bg-[#001f54] z-10">
            <div class="flex items-center gap-2">
                <i class="fa-solid fa-bell text-[#F7B32B]"></i>
                <span class="font-semibold text-white">Notifications</span>
            </div>
            <button wire:click="clearAll"
                class="flex items-center gap-2 px-3 py-1.5 rounded-lg bg-red-50 text-sm text-red-500 hover:bg-red-100 hover:text-red-700 transition">
                <span class="flex items-center gap-1">
                    <i class="fa-solid fa-trash"></i>
                    Clear All
                </span>
            </button>
        </li>

        <!-- Notification Items -->
        <div class="max-h-96 overflow-y-auto space-y-2 p-2">
            @forelse($notifications as $notif)
                <li class="bg-white rounded-lg px-4 py-3 shadow-sm hover:shadow-md transition relative">
                    <button wire:click="removeNotification({{ $notif->notificationguestID }})"
                        class="absolute top-2 right-2 text-gray-400 hover:text-red-500">
                        <i class="fa-solid fa-xmark w-4 h-4"></i>
                    </button>
                    <a class="flex items-start gap-3">
                        <div class="p-2 rounded-full bg-[#001f54] text-[#F7B32B]">
                            @switch($notif->topic)
                                @case('Reservation')
                                    <i class="fa-solid fa-calendar-check"></i>
                                    @break
                                @case('Payment')
                                    <i class="fa-solid fa-credit-card"></i>
                                    @break
                                @case('Maintenance')
                                    <i class="fa-solid fa-triangle-exclamation"></i>
                                    @break
                                @case('Security')
                                    <i class="fa-solid fa-shield-halved"></i>
                                    @break
                                @default
                                    <i class="fa-solid fa-circle-info"></i>
                            @endswitch
                        </div>

                        <div class="flex-1">
                            <p class="font-medium text-gray-900 flex items-center gap-2">
                                {{ $notif->topic }}
                                @if($notif->status === 'new')
                                    <span class="text-xs px-2 py-0.5 bg-[#001f54] text-white rounded-full">New</span>
                                @elseif($notif->status === 'urgent')
                                    <span class="text-xs px-2 py-0.5 bg-red-500 text-white rounded-full">Urgent</span>
                                @endif
                            </p>
                            <p class="text-sm text-gray-600 mt-1">{{ $notif->message }}</p>
                            <p class="text-xs text-gray-500 mt-2 flex items-center gap-1">
                                <i class="fa-regular fa-clock"></i>
                                {{ $notif->created_at->diffForHumans() }}
                            </p>
                        </div>
                    </a>
                </li>
            @empty
                <li class="text-center py-8 flex flex-col items-center justify-center gap-2 text-gray-300">
                    <i class="fa-solid fa-inbox fa-3x"></i>
                    <p class="text-sm">No notifications found</p>
                </li>
            @endforelse

          @if (session()->has('success'))
    <div class="alert alert-success bg-white border-l-4 border-green-500 text-gray-800 p-4 mb-4 rounded shadow-sm">
        <div class="flex items-center">
            <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <span class="font-medium">Success!</span>
        </div>
        <p class="mt-1 ml-8">{{ session('success') }}</p>
    </div>
@endif

@if (session()->has('info'))
    <div class="alert alert-info bg-white border-l-4 border-blue-500 text-gray-800 p-4 mb-4 rounded shadow-sm">
        <div class="flex items-center">
            <svg class="w-5 h-5 text-blue-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
            </svg>
            <span class="font-medium">Info</span>
        </div>
        <p class="mt-1 ml-8">{{ session('info') }}</p>
    </div>
@endif

@if (session()->has('error'))
    <div class="alert alert-error bg-white border-l-4 border-red-500 text-gray-800 p-4 mb-4 rounded shadow-sm">
        <div class="flex items-center">
            <svg class="w-5 h-5 text-red-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
            </svg>
            <span class="font-medium">Error!</span>
        </div>
        <p class="mt-1 ml-8">{{ session('error') }}</p>
    </div>
@endif
        </div>

        <!-- Footer -->
        <li class="px-4 py-2 border-t sticky bottom-0 bg-[#001f54]">
            <a href="/notifications" class="text-center text-white text-sm flex items-center justify-center gap-1">
                <i class="fa-solid fa-list"></i>
                <span>View All Notifications</span>
            </a>
        </li>
    </ul>
</div>
