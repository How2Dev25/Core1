<dialog id="reportPost_{{ $post->postID }}" class="modal">
    <div class="modal-box bg-white relative max-w-md">

        <!-- Close Button -->
        <button type="button"
            class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2 hover:bg-blue-50 text-blue-900"
            onclick="document.getElementById('reportPost_{{ $post->postID }}').close()">✕</button>

        <h3 class="font-bold text-lg sm:text-xl mb-4 text-blue-900">Report Post</h3>

        <!-- Report Form -->
        <form action="/communityreport/{{ $post->postID }}" method="POST" class="space-y-4">
            @csrf

            <!-- Reason Select -->
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text text-blue-900 font-medium">Why are you reporting this post?</span>
                </label>
                <select name="reportpost_reason" class="select select-bordered w-full focus:border-yellow-400" required>
                    <option disabled selected>Select a reason</option>
                    <option value="Spam">Spam</option>
                    <option value="Harassment">Harassment</option>
                    <option value="Inappropriate content">Inappropriate content</option>
                    <option value="False information">False information</option>
                    <option value="Other">Other</option>
                </select>
            </div>

            <!-- Additional Details -->
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text text-blue-900 font-medium">Additional details (optional)</span>
                </label>
                <textarea name="reportpost_details" class="textarea textarea-bordered w-full resize-none h-24 focus:border-yellow-400"
                    placeholder="Provide more information..."></textarea>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-2 w-full">
                <button type="button" class="btn btn-ghost flex-1 border border-blue-900 text-blue-900 hover:bg-blue-50"
                    onclick="document.getElementById('reportPost_{{ $post->postID }}').close()">
                    Cancel
                </button>
                <button type="submit" class="btn bg-red-600 hover:bg-red-700 text-white flex-1 border-none">
                    Submit Report
                </button>
            </div>
        </form>

    </div>

    <!-- Backdrop -->
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>