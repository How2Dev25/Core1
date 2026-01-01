<dialog id="removePost_{{ $post->postID }}" class="modal">
    <div class="modal-box max-w-md bg-white p-0 overflow-hidden rounded-xl">
        <div class="p-6">
            <div class="text-center">
                <div class="mx-auto w-12 h-12 flex items-center justify-center bg-red-100 rounded-full mb-4">
                    <i class="fa-solid fa-trash text-red-600 text-xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Delete Post</h3>
                <p class="text-gray-600 mb-6">Are you sure you want to delete this post? This action cannot be undone.
                </p>

                <form action="/communityremove/{{ $post->postID }}" method="POST" class="flex gap-3">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="document.getElementById('removePost_{{ $post->postID }}').close()"
                        class="btn btn-ghost flex-1">Cancel</button>
                    <button type="submit" class="btn bg-red-600 hover:bg-red-700 text-white border-none flex-1">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>