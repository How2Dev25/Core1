<dialog id="delete_channel_modal_{{ $listings->channelListingID }}" class="modal modal-bottom sm:modal-middle">
    <div class="modal-box bg-gradient-to-br from-white to-red-50 border-2 border-red-500/20 shadow-2xl">
        <form method="dialog">
            <button
                class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2 hover:bg-red-500 hover:text-white transition-all">✕</button>
        </form>

        <div class="text-center py-6">
            <!-- Warning Icon with Animation -->
            <div class="relative inline-block mb-6">
                <div
                    class="w-24 h-24 mx-auto rounded-full bg-gradient-to-br from-red-100 to-red-200 flex items-center justify-center shadow-lg animate-pulse">
                    <div class="w-20 h-20 rounded-full bg-white flex items-center justify-center">
                        <i data-lucide="alert-triangle" class="w-12 h-12 text-red-600"></i>
                    </div>
                </div>
                <!-- Decorative circles -->
                <div class="absolute -top-1 -right-1 w-6 h-6 bg-red-500 rounded-full animate-ping opacity-75"></div>
            </div>

            <!-- Header -->
            <div class="mb-6 pb-4 border-b-2 border-red-500/10">
                <h3 class="text-2xl font-bold text-red-600 mb-2 flex items-center justify-center gap-2">
                    <i data-lucide="trash-2" class="w-6 h-6"></i>
                    Delete Channel {{ $listings->channelName}}
                </h3>
                <p class="text-red-600/80 text-sm font-medium">This action cannot be undone</p>
            </div>

            <!-- Warning Message -->
            <div class="bg-red-50 border-2 border-red-200 rounded-xl p-4 mb-6">
                <div class="flex items-start gap-3 text-left">
                    <i data-lucide="info" class="w-5 h-5 text-red-600 flex-shrink-0 mt-0.5"></i>
                    <div>
                        <p class="text-gray-700 font-medium mb-1">Are you absolutely sure?</p>
                        <p class="text-gray-600 text-sm">
                            This will permanently delete this channel and remove all associated data including:
                        </p>
                        <ul class="text-gray-600 text-sm mt-2 space-y-1">
                            <li class="flex items-center gap-2">
                                <i data-lucide="x" class="w-3 h-3 text-red-500"></i>
                                All listings
                            </li>
                            <li class="flex items-center gap-2">
                                <i data-lucide="x" class="w-3 h-3 text-red-500"></i>
                                Booking history
                            </li>
                            <li class="flex items-center gap-2">
                                <i data-lucide="x" class="w-3 h-3 text-red-500"></i>
                                Channel settings
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-3 justify-center pt-2">
                <button
                    class="btn bg-gray-100 text-gray-700 border-none hover:bg-gray-200 transition-all flex-1 max-w-[150px]"
                    onclick="delete_channel_modal_{{ $listings->channelListingID }}.close()">
                    <i data-lucide="x" class="w-4 h-4"></i>
                    Cancel
                </button>
                <form id="deleteChannelForm" method="POST" action="/deleteChannel/{{ $listings->channelListingID }}"
                    class="flex-1 max-w-[200px]">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="btn bg-red-600 text-white border-none hover:bg-red-700 transition-all hover:scale-105 w-full">
                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                        Delete Permanently
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Close modal when clicking on backdrop -->
    <form method="dialog" class="modal-backdrop bg-red-900/20 backdrop-blur-sm">
        <button>close</button>
    </form>
</dialog>

<script>
    // Initialize Lucide icons when DOM is ready
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    });
</script>

<style>
    @keyframes pulse {

        0%,
        100% {
            transform: scale(1);
            opacity: 1;
        }

        50% {
            transform: scale(1.05);
            opacity: 0.9;
        }
    }

    @keyframes ping {
        0% {
            transform: scale(1);
            opacity: 1;
        }

        75%,
        100% {
            transform: scale(2);
            opacity: 0;
        }
    }

    .animate-pulse {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }

    .animate-ping {
        animation: ping 1s cubic-bezier(0, 0, 0.2, 1) infinite;
    }
</style>