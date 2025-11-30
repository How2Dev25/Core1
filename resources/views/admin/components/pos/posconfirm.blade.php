<dialog id="confirm-booking" class="modal">
    <div class="modal-box bg-white rounded-2xl p-0 max-w-md">
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
        <div class="p-6">
            <div class="flex items-center gap-3 mb-4">
                <div class="p-2 bg-green-100 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold">Submit Bookings</h3>
            </div>
            <p class="py-4 text-gray-600">Are you sure you want to proceed with these bookings?</p>
            <div class="modal-action">
                <form method="dialog" class="flex gap-3 w-full">
                    <button class="btn btn-outline flex-1">Cancel</button>
                    <button class="btn btn-primary flex-1 bg-blue-900 text-white">Proceed</button>
                </form>
            </div>
        </div>
    </div>
</dialog>