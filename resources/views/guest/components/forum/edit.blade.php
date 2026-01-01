<dialog id="modifyPost_{{ $post->postID }}" class="modal">
    <div class="modal-box max-w-2xl bg-white p-0 overflow-hidden rounded-xl max-h-[90vh]">

        <!-- Header -->
        <div class="border-b border-gray-200 px-6 py-4 sticky top-0 bg-white z-10">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900">Edit Post</h3>
                <button type="button" 
                        class="btn btn-sm btn-circle btn-ghost text-gray-500 hover:text-gray-700 hover:bg-gray-100"
                        onclick="closeEditModal('{{ $post->postID }}')">
                    ✕
                </button>
            </div>
        </div>

        <!-- Editable Form with Scroll -->
        <div class="overflow-y-auto max-h-[calc(90vh-73px)]">
            <form action="communityupdate/{{ $post->postID }}" method="POST" enctype="multipart/form-data" class="p-6" id="editForm{{ $post->postID }}">
                @csrf
                @method('PUT')
                <input type="hidden" name="postID" value="{{ $post->postID }}">

                <!-- Post Content -->
                <div class="form-control w-full mb-4">
                    <textarea name="post_content" 
                        class="textarea resize-none textarea-bordered h-32 w-full focus:border-blue-500 border-gray-300 rounded-lg"
                        placeholder="What's on your mind?">{{ $post->post_content }}</textarea>
                </div>

                <!-- Current Media Display -->
                @if($post->post_image || $post->post_video)
                <div class="mb-4 current-media" id="currentMedia{{ $post->postID }}">
                    <h4 class="text-sm font-medium text-gray-700 mb-2">Current Media:</h4>
                    <div class="flex items-center gap-2 mb-2">
                        <span class="text-sm text-gray-600">
                            {{ $post->post_image ? 'Image' : 'Video' }}
                        </span>
                        <button type="button" onclick="removeCurrentMedia('{{ $post->postID }}')" 
                                class="text-xs text-red-600 hover:text-red-700 font-medium">
                            Remove
                        </button>
                    </div>
                    <div class="relative rounded-lg overflow-auto max-h-[60vh] mb-2">
                        @if($post->post_image)
                            <img src="{{ asset($post->post_image) }}" 
                                 class="w-full h-auto object-contain rounded-lg" 
                                 id="currentImage{{ $post->postID }}" />
                        @elseif($post->post_video)
                            <video controls class="w-full h-auto rounded-lg" id="currentVideo{{ $post->postID }}">
                                <source src="{{ asset($post->post_video) }}" type="video/mp4">
                            </video>
                        @endif
                    </div>
                    <input type="hidden" name="keep_current_media" id="keepCurrentMedia{{ $post->postID }}" value="1">
                </div>
                @endif

                <!-- New Media Preview -->
                <div id="newMediaPreview{{ $post->postID }}" class="hidden mb-4">
                    <h4 class="text-sm font-medium text-gray-700 mb-2">New Media:</h4>
                    <div id="newMediaContent{{ $post->postID }}" class="relative rounded-lg overflow-auto max-h-[60vh] mb-2">
                        <!-- New media preview inserted here -->
                    </div>
                </div>

                <!-- Media Upload Options -->
                <div class="border border-dashed border-gray-300 rounded-lg p-4 mb-4">
                    <p class="text-sm text-gray-600 mb-3">Upload new media (optional):</p>
                    <div class="flex flex-col sm:flex-row gap-3">
                        <!-- Image Upload -->
                        <label class="flex-1">
                            <div class="flex flex-col items-center justify-center p-4 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                <i class="fa-solid fa-image text-2xl text-green-500 mb-2"></i>
                                <span class="text-sm font-medium text-gray-700">
                                    {{ $post->post_image ? 'Change Image' : 'Add Image' }}
                                </span>
                                <input type="file" name="post_image" class="hidden" accept="image/*" 
                                       onchange="handleEditImageUpload(event, '{{ $post->postID }}')" />
                            </div>
                        </label>

                        <!-- Video Upload -->
                        <label class="flex-1">
                            <div class="flex flex-col items-center justify-center p-4 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                <i class="fa-solid fa-video text-2xl text-purple-500 mb-2"></i>
                                <span class="text-sm font-medium text-gray-700">
                                    {{ $post->post_video ? 'Change Video' : 'Add Video' }}
                                </span>
                                <input type="file" name="post_video" class="hidden" accept="video/*" 
                                       onchange="handleEditVideoUpload(event, '{{ $post->postID }}')" />
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Extra space for scroll -->
                <div class="h-20"></div>
            </form>
        </div>

        <!-- Footer -->
        <div class="border-t border-gray-200 px-6 py-4 sticky bottom-0 bg-white">
            <div class="flex items-center justify-between gap-3">
                <button type="button" onclick="closeEditModal('{{ $post->postID }}')" 
                        class="btn btn-ghost text-gray-600 hover:text-gray-800 hover:bg-gray-100 flex-1">
                    Cancel
                </button>
                <button type="submit" form="editForm{{ $post->postID }}" 
                        class="btn bg-blue-600 hover:bg-blue-700 text-white border-none flex-1">
                    Save Changes
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Backdrop -->
    <form method="dialog" class="modal-backdrop">
        <button onclick="closeEditModal('{{ $post->postID }}')">close</button>
    </form>
</dialog>

<script>
function closeEditModal(postID) {
    document.getElementById(`modifyPost_${postID}`).close();
    resetEditForm(postID);
}

function resetEditForm(postID) {
    const modal = document.getElementById(`modifyPost_${postID}`);
    if (!modal) return;

    // Reset file inputs
    modal.querySelectorAll('input[type="file"]').forEach(input => input.value = '');
    
    // Hide new media
    const newMediaPreview = document.getElementById(`newMediaPreview${postID}`);
    const newMediaContent = document.getElementById(`newMediaContent${postID}`);
    if (newMediaPreview) newMediaPreview.classList.add('hidden');
    if (newMediaContent) newMediaContent.innerHTML = '';

    // Show current media if exists
    const currentMediaDiv = document.getElementById(`currentMedia${postID}`);
    if (currentMediaDiv) {
        currentMediaDiv.classList.remove('hidden');
        document.getElementById(`keepCurrentMedia${postID}`).value = '1';
    }
}

function removeCurrentMedia(postID) {
    const currentMediaDiv = document.getElementById(`currentMedia${postID}`);
    if (currentMediaDiv) currentMediaDiv.classList.add('hidden');
    document.getElementById(`keepCurrentMedia${postID}`).value = '0';
}

function removeNewMedia(postID) {
    const newMediaPreview = document.getElementById(`newMediaPreview${postID}`);
    const newMediaContent = document.getElementById(`newMediaContent${postID}`);
    if (newMediaPreview) newMediaPreview.classList.add('hidden');
    if (newMediaContent) newMediaContent.innerHTML = '';

    // Reset file inputs
    const modal = document.getElementById(`modifyPost_${postID}`);
    modal.querySelectorAll('input[type="file"]').forEach(input => input.value = '');

    // Show current media again
    const currentMediaDiv = document.getElementById(`currentMedia${postID}`);
    if (currentMediaDiv) {
        currentMediaDiv.classList.remove('hidden');
        document.getElementById(`keepCurrentMedia${postID}`).value = '1';
    }
}

function handleEditImageUpload(event, postID) {
    const file = event.target.files[0];
    if (!file) return;

    // Hide current media
    const currentMediaDiv = document.getElementById(`currentMedia${postID}`);
    if (currentMediaDiv) {
        currentMediaDiv.classList.add('hidden');
        document.getElementById(`keepCurrentMedia${postID}`).value = '0';
    }

    // Show new media
    const reader = new FileReader();
    reader.onload = function(e) {
        const newMediaPreview = document.getElementById(`newMediaPreview${postID}`);
        const newMediaContent = document.getElementById(`newMediaContent${postID}`);
        newMediaContent.innerHTML = '';

        const img = document.createElement('img');
        img.src = e.target.result;
        img.className = 'w-full h-auto object-contain rounded-lg';

        const removeBtn = document.createElement('button');
        removeBtn.type = 'button';
        removeBtn.className = 'absolute top-2 right-2 btn btn-sm btn-circle bg-red-500 text-white hover:bg-red-600';
        removeBtn.innerHTML = '✕';
        removeBtn.onclick = () => removeNewMedia(postID);

        newMediaContent.appendChild(img);
        newMediaContent.appendChild(removeBtn);
        newMediaPreview.classList.remove('hidden');
    };
    reader.readAsDataURL(file);
}

function handleEditVideoUpload(event, postID) {
    const file = event.target.files[0];
    if (!file) return;

    // Hide current media
    const currentMediaDiv = document.getElementById(`currentMedia${postID}`);
    if (currentMediaDiv) {
        currentMediaDiv.classList.add('hidden');
        document.getElementById(`keepCurrentMedia${postID}`).value = '0';
    }

    // Show new media
    const reader = new FileReader();
    reader.onload = function(e) {
        const newMediaPreview = document.getElementById(`newMediaPreview${postID}`);
        const newMediaContent = document.getElementById(`newMediaContent${postID}`);
        newMediaContent.innerHTML = '';

        const video = document.createElement('video');
        video.controls = true;
        video.className = 'w-full h-auto rounded-lg';
        const source = document.createElement('source');
        source.src = e.target.result;
        source.type = file.type;
        video.appendChild(source);

        const removeBtn = document.createElement('button');
        removeBtn.type = 'button';
        removeBtn.className = 'absolute top-2 right-2 btn btn-sm btn-circle bg-red-500 text-white hover:bg-red-600';
        removeBtn.innerHTML = '✕';
        removeBtn.onclick = () => removeNewMedia(postID);

        newMediaContent.appendChild(video);
        newMediaContent.appendChild(removeBtn);
        newMediaPreview.classList.remove('hidden');
    };
    reader.readAsDataURL(file);
}
</script>
