<dialog id="view_doorlock" class="modal">
    <div class="modal-box max-w-6xl">
        <h3 class="text-lg font-bold mb-4">Doorlock Assignments</h3>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="table w-full">
                <thead class="bg-blue-900 text-white">
                    <tr>
                        <th>Room</th>
                        <th>Guest Name</th>
                        <th>Guest ID</th>
                        <th>Booking ID</th>
                        <th>Doorlock ID</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($doorfrontdesk as $assignment)
                        <tr>
                            <td>Room {{ $assignment->roomID }}</td>
                            <td>{{ $assignment->guestname }}</td>
                            <td>{{ $assignment->guestID ?? 'N/A' }}</td>
                            <td>{{ $assignment->bookingID }}</td>
                            <td>{{ $assignment->doorlockID }}</td>
                            <td>
                                <span
                                    class="badge {{ $assignment->doorlockfrontdesk_status == '1' ? 'badge-success' : 'badge-error' }}">
                                    @if($assignment->doorlockfrontdesk_status == '1')
                                        Open
                                    @else
                                        Close
                                    @endif
                                </span>
                            </td>
                            <td>
                                <button
                                    onclick="document.getElementById('remove_assignment_{{ $assignment->doorlockfrontdeskID }}').showModal()"
                                    class="btn btn-xs btn-error">
                                    Remove
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">No assignments found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="modal-action">
            <form method="dialog">
                <button class="btn">Close</button>
            </form>
        </div>
    </div>
</dialog>

<!-- Remove Confirmation Modals -->
@foreach ($doorfrontdesk as $assignment)
    <dialog id="remove_assignment_{{ $assignment->doorlockfrontdeskID }}" class="modal">
        <div class="modal-box">
            <h3 class="text-lg font-bold mb-4">Remove Assignment</h3>
            <p class="py-4">Are you sure you want to remove this assignment?</p>

            <div class="bg-base-200 p-3 rounded-lg mb-4">
                <p><strong>Guest:</strong> {{ $assignment->guestname }}</p>
                <p><strong>Doorlock ID:</strong> {{ $assignment->doorlockID }}</p>
                <p><strong>Booking ID:</strong> {{ $assignment->bookingID }}</p>
            </div>

            <div class="modal-action">
                <form method="dialog">
                    <button class="btn">Cancel</button>
                </form>
                <form method="POST" action="/doorlock-assignments/{{ $assignment->doorlockfrontdeskID }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-error">Remove</button>
                </form>
            </div>
        </div>
    </dialog>
@endforeach