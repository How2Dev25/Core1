<dialog id="deletereport_{{ $report->reportID }}" class="modal">
    <div class="modal-box bg-white shadow-2xl border border-gray-200 rounded-2xl max-w-md">

        <div class="flex items-center gap-4 mb-6">
            <div class="w-14 h-14 bg-red-100 rounded-full flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-red-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z" />
                </svg>
            </div>
            <h3 class="font-bold text-xl text-red-600">
                Delete Report?
            </h3>
        </div>

        <p class="text-gray-600">
            Are you sure you want to delete this employee report?
            This action cannot be undone.
        </p>

        <form method="POST" action="removereport/{{ $report->reportID }}" class="flex gap-4 mt-6">
            @csrf
            @method('DELETE')

            <button type="button" class="btn btn-outline flex-1"
                onclick="deletereport_{{ $report->reportID }}.close()">Cancel</button>

            <button type="submit" class="btn bg-red-600 text-white flex-1">
                Confirm Delete
            </button>
        </form>

    </div>

    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>