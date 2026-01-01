<dialog id="reportPost_{{ $post->postID }}" class="modal">
    <div class="modal-box bg-white">
        <form method="dialog">
            <button
                class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2 hover:bg-blue-50 text-blue-900">✕</button>
        </form>
        <h3 class="font-bold text-lg sm:text-xl mb-4 text-blue-900">Report Post</h3>

        <div class="form-control w-full mb-4">
            <label class="label">
                <span class="label-text text-blue-900 font-medium">Why are you reporting this post?</span>
            </label>
            <select class="select select-bordered w-full focus:border-yellow-400">
                <option disabled selected>Select a reason</option>
                <option>Spam</option>
                <option>Harassment</option>
                <option>Inappropriate content</option>
                <option>False information</option>
                <option>Other</option>
            </select>
        </div>

        <div class="form-control w-full mb-4">
            <label class="label">
                <span class="label-text text-blue-900 font-medium">Additional details (optional)</span>
            </label>
            <textarea class="textarea textarea-bordered h-24 focus:border-yellow-400"
                placeholder="Provide more information..."></textarea>
        </div>

        <div class="modal-action">
            <form method="dialog" class="flex flex-col sm:flex-row gap-2 w-full">
                <button
                    class="btn btn-ghost flex-1 border border-blue-900 text-blue-900 hover:bg-blue-50">Cancel</button>
                <button class="btn bg-red-600 hover:bg-red-700 text-white flex-1 border-none">Submit Report</button>
            </form>
        </div>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>