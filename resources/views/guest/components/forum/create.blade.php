<dialog id="createModal" class="modal">
    <div class="modal-box max-w-lg bg-white">

        <!-- Close button -->
        <form method="dialog">
            <button
                class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2 hover:bg-blue-50 text-blue-900">✕</button>
        </form>

        <h3 class="font-bold text-lg sm:text-xl mb-4 text-blue-900">Create Post</h3>

        <!-- ✅ REAL POST FORM -->
        <form action="/communitypost" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Text -->
            <div class="form-control w-full mb-4">
                <textarea name="post_content" id="postText"
                    class="textarea resize-none textarea-bordered h-32 w-full focus:border-yellow-400"
                    placeholder="What's on your mind?"></textarea>
            </div>

            <!-- Image Preview -->
            <div id="imagePreview" class="hidden mb-4 relative">
                <img id="previewImg" class="w-full rounded-xl shadow-md" />
                <button type="button" onclick="removePreview('image')"
                    class="btn btn-sm btn-circle btn-error absolute top-2 right-2">✕</button>
            </div>

            <!-- Video Preview -->
            <div id="videoPreview" class="hidden mb-4 relative">
                <video id="previewVideo" class="w-full rounded-xl shadow-md" controls></video>
                <button type="button" onclick="removePreview('video')"
                    class="btn btn-sm btn-circle btn-error absolute top-2 right-2">✕</button>
            </div>

            <!-- Upload Buttons -->
            <div class="flex flex-col sm:flex-row gap-2 mb-4">
                <label
                    class="btn btn-sm sm:btn-md btn-outline border-blue-900 text-blue-900 hover:bg-blue-900 hover:text-white gap-2 flex-1">
                    <span>Image</span>
                    <input type="file" name="post_image" id="imageInput" class="hidden" accept="image/*"
                        onchange="handleImageUpload(event)" />
                </label>

                <label
                    class="btn btn-sm sm:btn-md btn-outline border-blue-900 text-blue-900 hover:bg-blue-900 hover:text-white gap-2 flex-1">
                    <span>Video</span>
                    <input type="file" name="post_video" id="videoInput" class="hidden" accept="video/*"
                        onchange="handleVideoUpload(event)" />
                </label>
            </div>

            <!-- Submit -->
            <button type="submit" class="btn bg-blue-900 hover:bg-blue-800 text-white w-full border-none">
                Post
            </button>
        </form>
    </div>

    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>


<script>
     function handleImageUpload(event) {
            const file = event.target.files[0];
            if (file) {
                // Hide video preview if showing
                document.getElementById('videoPreview').classList.add('hidden');
                document.getElementById('previewVideo').src = '';

                // Show image preview
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('previewImg').src = e.target.result;
                    document.getElementById('imagePreview').classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        }

        function handleVideoUpload(event) {
            const file = event.target.files[0];
            if (file) {
                // Hide image preview if showing
                document.getElementById('imagePreview').classList.add('hidden');
                document.getElementById('previewImg').src = '';

                // Show video preview
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('previewVideo').src = e.target.result;
                    document.getElementById('videoPreview').classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        }

        function removePreview(type) {
            if (type === 'image') {
                document.getElementById('imagePreview').classList.add('hidden');
                document.getElementById('previewImg').src = '';
                document.getElementById('imageInput').value = '';
            } else if (type === 'video') {
                document.getElementById('videoPreview').classList.add('hidden');
                document.getElementById('previewVideo').src = '';
                document.getElementById('videoInput').value = '';
            }
        }
</script>