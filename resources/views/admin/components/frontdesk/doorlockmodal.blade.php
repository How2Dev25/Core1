<dialog id="view_doorlock" class="modal">
    <div class="modal-box max-w-7xl w-11/12 bg-base-100 p-6">
        <h3 class="text-2xl font-bold mb-6 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-900" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
            </svg>
            Doorlock Assignments
            <span class="badge badge-lg badge-primary ml-2">{{ $doorfrontdesk->count() }} Total</span>
        </h3>

        <!-- Card Grid View - Both Desktop and Mobile -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5 max-h-[70vh] overflow-y-auto px-1">
            @forelse ($doorfrontdesk as $assignment)
                <div
                    class="card bg-base-200/50 hover:bg-base-200 transition-all duration-200 shadow-md hover:shadow-lg border border-base-300">
                    <!-- Card Header with Room Number -->
                    <div class="bg-blue-900 text-white px-4 py-3 rounded-t-lg flex justify-between items-center">
                        <h4 class="font-bold text-lg flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Room {{ $assignment->roomID }}
                        </h4>
                        <span
                            class="badge {{ $assignment->doorlockfrontdesk_status == '1' ? 'badge-success' : 'badge-error' }} badge-sm">
                            @if($assignment->doorlockfrontdesk_status == '1')
                                Open
                            @else
                                Closed
                            @endif
                        </span>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body p-4">
                        <!-- Guest Info Section - Fixed Avatar Centering -->
                        <div class="flex items-center gap-3 mb-3 pb-2 border-b border-base-300">
                            <div class="flex items-center justify-center">
                                <div
                                    class="bg-blue-100 text-blue-800 rounded-full w-10 h-10 flex items-center justify-center overflow-hidden">
                                    <span
                                        class="text-lg font-medium leading-none">{{ substr($assignment->guestname, 0, 1) }}</span>
                                </div>
                            </div>
                            <div class="flex-1">
                                <div class="font-semibold text-base-content">{{ $assignment->guestname }}</div>
                                <div class="text-xs opacity-70">Guest ID: {{ $assignment->guestID ?? 'N/A' }}</div>
                            </div>
                        </div>

                        <!-- Assignment Details in Clean Grid -->
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between items-center">
                                <span class="opacity-70 flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-900" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4" />
                                    </svg>
                                    RFID:
                                </span>
                                <span
                                    class="font-mono font-medium bg-base-300 px-2 py-1 rounded text-xs">{{ $assignment->rfid }}</span>
                            </div>

                            <div class="flex justify-between items-center">
                                <span class="opacity-70 flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-900" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Booking:
                                </span>
                                <span class="badge badge-primary badge-outline">{{ $assignment->bookingID }}</span>
                            </div>

                            <div class="flex justify-between items-center">
                                <span class="opacity-70 flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-900" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                    Doorlock:
                                </span>
                                <span class="font-mono">{{ $assignment->doorlockID }}</span>
                            </div>

                            <div class="flex justify-between items-center pt-1">
                                <span class="opacity-70 flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-900" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Status:
                                </span>
                                <span
                                    class="badge {{ $assignment->doorlockfrontdesk_status == '1' ? 'badge-success' : 'badge-error' }} gap-1">
                                    <span
                                        class="w-1.5 h-1.5 rounded-full {{ $assignment->doorlockfrontdesk_status == '1' ? 'bg-success-content' : 'bg-error-content' }}"></span>
                                    @if($assignment->doorlockfrontdesk_status == '1')
                                        Open
                                    @else
                                        Closed
                                    @endif
                                </span>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="card-actions justify-end mt-4 pt-2 border-t border-base-300">
                            <button
                                onclick="document.getElementById('remove_assignment_{{ $assignment->doorlockfrontdeskID }}').showModal()"
                                class="btn btn-sm btn-error gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Remove
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full flex flex-col items-center justify-center py-16">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 opacity-30 mb-4 text-blue-900" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                    <p class="text-xl font-medium text-gray-500">No assignments found</p>
                    <p class="text-sm opacity-60 mt-1">Doorlock assignments will appear here</p>
                </div>
            @endforelse
        </div>

        <div class="modal-action mt-6">
            <form method="dialog">
                <button class="btn btn-neutral">Close</button>
            </form>
        </div>
    </div>
</dialog>

<!-- Remove Confirmation Modals - Fixed Avatar Centering -->
@foreach ($doorfrontdesk as $assignment)
    <dialog id="remove_assignment_{{ $assignment->doorlockfrontdeskID }}" class="modal">
        <div class="modal-box max-w-md bg-base-100">
            <h3 class="text-xl font-bold mb-4 flex items-center gap-2 text-error">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                Remove Assignment
            </h3>

            <p class="py-2 text-base-content/70">Are you sure you want to remove this assignment?</p>

            <div class="bg-base-200 p-4 rounded-lg mb-6 space-y-3">
                <div class="flex items-center gap-3 pb-2 border-b border-base-300">
                    <div class="flex items-center justify-center">
                        <div
                            class="bg-blue-100 text-blue-800 rounded-full w-8 h-8 flex items-center justify-center overflow-hidden">
                            <span class="text-md font-medium leading-none">{{ substr($assignment->guestname, 0, 1) }}</span>
                        </div>
                    </div>
                    <div>
                        <div class="font-semibold">{{ $assignment->guestname }}</div>
                        <div class="text-xs opacity-70">Booking #{{ $assignment->bookingID }}</div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-2 text-sm">
                    <div class="bg-base-100 p-2 rounded">
                        <span class="text-xs opacity-70 block">Room</span>
                        <span class="font-bold">Room {{ $assignment->roomID }}</span>
                    </div>
                    <div class="bg-base-100 p-2 rounded">
                        <span class="text-xs opacity-70 block">RFID</span>
                        <span class="font-mono">{{ $assignment->rfid }}</span>
                    </div>
                    <div class="bg-base-100 p-2 rounded">
                        <span class="text-xs opacity-70 block">Doorlock</span>
                        <span class="font-mono">{{ $assignment->doorlockID }}</span>
                    </div>
                    <div class="bg-base-100 p-2 rounded">
                        <span class="text-xs opacity-70 block">Status</span>
                        <span
                            class="badge {{ $assignment->doorlockfrontdesk_status == '1' ? 'badge-success' : 'badge-error' }} badge-xs">
                            {{ $assignment->doorlockfrontdesk_status == '1' ? 'Open' : 'Closed' }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="modal-action">
                <form method="dialog">
                    <button class="btn btn-ghost">Cancel</button>
                </form>
                <form method="POST" action="/doorlock-assignments/{{ $assignment->doorlockfrontdeskID }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-error">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Remove
                    </button>
                </form>
            </div>
        </div>
    </dialog>
@endforeach