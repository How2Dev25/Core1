<!-- Create Channel Modal -->
<dialog id="create_channel_modal" class="modal modal-bottom sm:modal-middle">
    <div class="modal-box max-w-2xl bg-gradient-to-br from-white to-blue-50 border-2 border-blue-900/20 shadow-2xl">
        <!-- Header -->
        <div class="flex items-center gap-3 mb-6 pb-4 border-b-2 border-blue-900/10">
            <div class="bg-blue-900 p-2 rounded-lg">
                <i data-lucide="plus-circle" class="w-6 h-6 text-yellow-400"></i>
            </div>
            <h3 class="font-bold text-2xl text-blue-900">Create New Channel</h3>
        </div>

        <form method="dialog">
            <button
                class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2 hover:bg-red-500 hover:text-white transition-all">✕</button>
        </form>

        <form action="/createChannel" method="POST" enctype="multipart/form-data" class="space-y-6 mt-4">
            @csrf

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
                        <div id="imagePreview"
                            class="w-40 h-40 rounded-xl border-2 border-dashed border-blue-900/30 flex items-center justify-center bg-blue-50 overflow-hidden transition-all group-hover:border-yellow-400 group-hover:shadow-lg hidden">
                            <img id="previewImg" class="w-full h-full object-cover" />
                        </div>
                        <div id="placeholder"
                            class="w-40 h-40 rounded-xl border-2 border-dashed border-blue-900/30 flex flex-col items-center justify-center bg-blue-50 transition-all hover:border-yellow-400 hover:shadow-lg cursor-pointer">
                            <i data-lucide="image-plus" class="w-12 h-12 text-blue-900/40 mb-2"></i>
                            <span class="text-blue-900/40 text-sm font-medium">Upload Image</span>
                        </div>
                        <!-- Remove Image Button -->
                        <button type="button" id="removeImage"
                            class="absolute -top-2 -right-2 btn btn-xs btn-circle bg-red-500 text-white border-none hover:bg-red-600 hover:scale-110 transition-all hidden">
                            <i data-lucide="x" class="w-3 h-3"></i>
                        </button>
                    </div>

                    <!-- File Input -->
                    <div class="w-full max-w-xs">
                        <input type="file" id="channelPhoto" name="channelPhoto"
                            class="file-input file-input-bordered file-input-primary w-full focus:border-yellow-400 focus:outline-none transition-all"
                            accept="image/*" onchange="previewImage(event)" />
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
                    required />
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
                    class="textarea textarea-bordered h-24 w-full bg-white border-blue-900/20 focus:border-yellow-400 focus:outline-none transition-all resize-none"></textarea>
            </div>

            <!-- Submit Button -->
            <div class="modal-action pt-4 border-t-2 border-blue-900/10">
                <button type="button" class="btn bg-gray-100 text-blue-900 border-none hover:bg-gray-200 transition-all"
                    onclick="create_channel_modal.close()">
                    <i data-lucide="x" class="w-4 h-4"></i>
                    Cancel
                </button>
                <button type="submit"
                    class="btn bg-blue-900 text-yellow-400 border-none hover:bg-yellow-400 hover:text-blue-900 transition-all hover:scale-105">
                    <i data-lucide="plus" class="w-4 h-4"></i>
                    Create Channel
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
    // Initialize Lucide icons when DOM is ready
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    });

    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('previewImg');
        const previewContainer = document.getElementById('imagePreview');
        const placeholder = document.getElementById('placeholder');
        const removeBtn = document.getElementById('removeImage');

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
                preview.src = e.target.result;
                previewContainer.classList.remove('hidden');
                placeholder.classList.add('hidden');
                removeBtn.classList.remove('hidden');
            }

            reader.readAsDataURL(file);
        }
    }

    // Remove image functionality
    document.getElementById('removeImage').addEventListener('click', function () {
        const input = document.getElementById('channelPhoto');
        const previewContainer = document.getElementById('imagePreview');
        const placeholder = document.getElementById('placeholder');
        const removeBtn = document.getElementById('removeImage');

        input.value = '';
        previewContainer.classList.add('hidden');
        placeholder.classList.remove('hidden');
        removeBtn.classList.add('hidden');
    });

    // Reset form when modal closes
    const createModal = document.getElementById('create_channel_modal');
    createModal.addEventListener('close', function () {
        // Reset the form
        const form = this.querySelector('form[action="/createChannel"]');
        if (form) {
            form.reset();
        }

        // Reset image preview
        const input = document.getElementById('channelPhoto');
        const previewContainer = document.getElementById('imagePreview');
        const placeholder = document.getElementById('placeholder');
        const removeBtn = document.getElementById('removeImage');

        input.value = '';
        previewContainer.classList.add('hidden');
        placeholder.classList.remove('hidden');
        removeBtn.classList.add('hidden');
    });
</script>