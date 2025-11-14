<!-- Edit Modal -->
<dialog id="edit_channel_modal_{{ $listings->channelListingID }}" class="modal modal-bottom sm:modal-middle">
    <div class="modal-box max-w-2xl bg-gradient-to-br from-white to-blue-50 border-2 border-blue-900/20 shadow-2xl">
        <!-- Header -->
        <div class="flex items-center gap-3 mb-6 pb-4 border-b-2 border-blue-900/10">
            <div class="bg-blue-900 p-2 rounded-lg">
                <i data-lucide="edit" class="w-6 h-6 text-yellow-400"></i>
            </div>
            <h3 class="font-bold text-2xl text-blue-900">Edit Channel</h3>
        </div>

        <form method="dialog">
            <button
                class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2 hover:bg-red-500 hover:text-white transition-all">✕</button>
        </form>

        <form action="/modifyChannel/{{ $listings->channelListingID }}" method="POST" enctype="multipart/form-data"
            class="space-y-6 mt-4">
            @csrf
            @method('PUT')

            <!-- Channel Photo Upload with Preview -->
            <div class="form-control">
                <label class="label">
                    <span class="label-text font-semibold text-blue-900 flex items-center gap-2">
                        <i data-lucide="image" class="w-4 h-4"></i>
                        Channel Photo
                    </span>
                </label>
                <div class="flex flex-col items-center space-y-4 bg-white p-6 rounded-xl border-2 border-blue-900/10">
                    <!-- Image Preview -->
                    <div class="relative group">
                        <div id="editImagePreview"
                            class="w-40 h-40 rounded-xl border-2 border-dashed border-blue-900/30 flex items-center justify-center bg-blue-50 overflow-hidden transition-all group-hover:border-yellow-400 group-hover:shadow-lg">
                            <img id="editPreviewImg" class="w-full h-full object-cover"
                                src="{{ asset($listings->channelPhoto) }}" alt="Channel preview">
                            <span class="text-blue-900/40 absolute">No image</span>
                        </div>

                        <button type="button" id="editRemoveImage"
                            class="absolute -top-2 -right-2 btn btn-xs btn-circle bg-red-500 text-white border-none hover:bg-red-600 hover:scale-110 transition-all {{ $listings->channelPhoto ? '' : 'hidden' }}">
                            <i data-lucide="x" class="w-3 h-3"></i>
                        </button>
                    </div>

                    <!-- File Input -->
                    <div class="w-full max-w-xs">
                        <input type="file" id="editChannelPhoto" name="channelPhoto"
                            class="file-input file-input-bordered file-input-primary w-full focus:border-yellow-400 focus:outline-none transition-all"
                            accept="image/*" />
                        <p class="text-xs text-blue-900/60 mt-2 flex items-center gap-1">
                            <i data-lucide="info" class="w-3 h-3"></i>
                            Supported: JPG, PNG, GIF. Max: 2MB
                        </p>
                    </div>
                </div>
            </div>

            <!-- Channel Name -->
            <div class="form-control">
                <label class="label">
                    <span class="label-text font-semibold text-blue-900 flex items-center gap-2">
                        <i data-lucide="tag" class="w-4 h-4"></i>
                        Channel Name
                    </span>
                </label>
                <input type="text" name="channelName" placeholder="Enter channel name"
                    class="input input-bordered w-full bg-white border-blue-900/20 focus:border-yellow-400 focus:outline-none transition-all"
                    value="{{ old('channelName', $listings->channelName) }}" required />
            </div>

            <!-- Channel Description -->
            <div class="form-control">
                <label class="label">
                    <span class="label-text font-semibold text-blue-900 flex items-center gap-2">
                        <i data-lucide="align-left" class="w-4 h-4"></i>
                        Channel Description
                    </span>
                </label>
                <textarea name="channelDescription" placeholder="Describe your channel..."
                    class="textarea textarea-bordered h-24 w-full bg-white border-blue-900/20 focus:border-yellow-400 focus:outline-none transition-all resize-none">{{ old('channelDescription', $listings->channelDescription) }}</textarea>
            </div>

          


            <!-- Submit Button -->
            <div class="modal-action pt-4 border-t-2 border-blue-900/10">
                <button type="button" class="btn bg-gray-100 text-blue-900 border-none hover:bg-gray-200 transition-all"
                    onclick="edit_channel_modal_{{ $listings->channelListingID }}.close()">
                    <i data-lucide="x" class="w-4 h-4"></i>
                    Cancel
                </button>
                <button type="submit"
                    class="btn bg-blue-900 text-yellow-400 border-none hover:bg-yellow-400 hover:text-blue-900 transition-all hover:scale-105">
                    <i data-lucide="check" class="w-4 h-4"></i>
                    Update Channel
                </button>
            </div>
        </form>
    </div>

    <!-- Close modal when clicking on backdrop -->
    <form method="dialog" class="modal-backdrop bg-blue-900/20 backdrop-blur-sm">
        <button>close</button>
    </form>
</dialog>

<script>
    // Edit Modal Photo Functionality
    document.addEventListener('DOMContentLoaded', function () {
        const editFileInput = document.getElementById('editChannelPhoto');
        const editPreview = document.getElementById('editPreviewImg');
        const editPreviewContainer = document.getElementById('editImagePreview');
        const editRemoveBtn = document.getElementById('editRemoveImage');

        // Initialize Lucide icons
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }

        // Preview image when new file is selected
        editFileInput.addEventListener('change', function (event) {
            const input = event.target;

            if (input.files && input.files[0]) {
                const file = input.files[0];
                const maxSize = 2 * 1024 * 1024; // 2MB in bytes

                // Validate file size
                if (file.size > maxSize) {
                    alert('File size must be less than 2MB');
                    input.value = '';
                    return;
                }

                const reader = new FileReader();

                reader.onload = function (e) {
                    // Update preview image
                    editPreview.src = e.target.result;
                    editPreview.style.display = 'block';

                    // Hide placeholder text
                    const span = editPreviewContainer.querySelector('span');
                    if (span) {
                        span.style.display = 'none';
                    }

                    // Show remove button
                    editRemoveBtn.classList.remove('hidden');
                }

                reader.readAsDataURL(file);
            }
        });

        // Remove image functionality
        editRemoveBtn.addEventListener('click', function () {
            // Clear file input
            editFileInput.value = '';

            // Reset to original image or show placeholder
            const originalImage = "{{ $listings->channelPhoto ? asset($listings->channelPhoto) : '' }}";

            if (originalImage) {
                // If there was an original image, show it
                editPreview.src = originalImage;
                editPreview.style.display = 'block';
            } else {
                // If no original image, show placeholder
                editPreview.style.display = 'none';
                const span = editPreviewContainer.querySelector('span');
                if (span) {
                    span.style.display = 'block';
                }
                editRemoveBtn.classList.add('hidden');
            }

            // Add a hidden input to indicate photo removal if needed
            const existingRemoveInput = document.getElementById('removePhotoFlag');
            if (!existingRemoveInput) {
                const removeInput = document.createElement('input');
                removeInput.type = 'hidden';
                removeInput.name = 'remove_photo';
                removeInput.value = '1';
                removeInput.id = 'removePhotoFlag';
                editFileInput.parentNode.appendChild(removeInput);
            }
        });

        // Reset form when modal closes
        const editModal = document.getElementById('edit_channel_modal_{{ $listings->channelListingID }}');
        if (editModal) {
            editModal.addEventListener('close', function () {
                // Reset file input but keep other form values
                editFileInput.value = '';

                // Remove any remove photo flag
                const removeFlag = document.getElementById('removePhotoFlag');
                if (removeFlag) {
                    removeFlag.remove();
                }

                // Reset preview to original state
                const originalImage = "{{ $listings->channelPhoto ? asset($listings->channelPhoto) : '' }}";
                if (originalImage) {
                    editPreview.src = originalImage;
                    editPreview.style.display = 'block';
                    editRemoveBtn.classList.remove('hidden');
                    const span = editPreviewContainer.querySelector('span');
                    if (span) {
                        span.style.display = 'none';
                    }
                } else {
                    editPreview.style.display = 'none';
                    editRemoveBtn.classList.add('hidden');
                    const span = editPreviewContainer.querySelector('span');
                    if (span) {
                        span.style.display = 'block';
                    }
                }
            });
        }
    });
</script>