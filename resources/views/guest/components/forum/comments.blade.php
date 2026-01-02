<!-- COMMENT SECTION -->
<div class="py-6 px-6 border-t border-gray-200">
    <!-- Comment Form -->
    @if(Auth::guard('guest')->check() || Auth::check())
        <div class="mb-8">
            <div class="flex gap-4">
                <!-- User Avatar -->
                <div class="flex-shrink-0">
                    <img src="{{ Auth::guard('guest')->check()
            ? asset(Auth::guard('guest')->user()->guest_photo ?? 'images/defaults/user.png')
            : asset('images/logo/sonly.png') }}" alt="Your Avatar"
                        class="h-10 w-10 rounded-full object-cover shadow-sm border-2 border-gray-200">
                </div>

                <!-- Comment Input Area -->
                <div class="flex-1 min-w-0">
                    <!-- Header: Name and Status -->
                    <div class="flex items-center gap-2 mb-2 flex-wrap">
                        <h3 class="font-semibold text-gray-900 text-sm">
                            @if(Auth::guard('guest')->check())
                                {{ Auth::guard('guest')->user()->guest_name ?? 'Guest' }}
                            @elseif(Auth::check())
                                Soliera Hotel
                            @endif
                        </h3>
                        @if(Auth::guard('guest')->check() && Auth::guard('guest')->user()->guest_status == 'Verified')
                            <span class="flex items-center text-xs" style="color: #F7B32B;">
                                <i class="fa-solid fa-check-circle mr-1" style="color: #F7B32B;"></i>
                                <span class="text-yellow-600">Verified</span>
                            </span>
                        @endif
                    </div>

                    <!-- Comment Form -->
                    <form id="commentForm_{{ $post->postID }}" method="POST" action="/postcomment/{{ $post->postID }}" class="space-y-3" enctype="multipart/form-data">
                        @csrf
                        <!-- Textarea -->
                        <textarea name="comment_content" rows="1" placeholder="Add a comment..."
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none text-sm bg-white"></textarea>

                        <!-- Image Upload Section -->
                        <div class="space-y-3 hidden" id="imageUpload_{{ $post->postID }}">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600 font-medium">Add an image</span>
                                <button type="button"
                                    onclick="removeImage('{{ $post->postID }}')"
                                    class="text-gray-500 hover:text-gray-700 text-sm">
                                    <i class="fa-solid fa-times"></i> Cancel
                                </button>
                            </div>
                            
                            <!-- File Input -->
                            <input type="file" 
                                   name="comment_image" 
                                   accept="image/*"
                                   id="commentImage_{{ $post->postID }}"
                                   class="hidden"
                                   onchange="previewImage(event, '{{ $post->postID }}')">
                            
                            <!-- Upload Button -->
                            <label for="commentImage_{{ $post->postID }}"
                                   class="block cursor-pointer">
                                <div class="border-2 border-dashed border-gray-300 rounded-xl p-4 text-center hover:border-blue-400 hover:bg-blue-50 transition-all duration-200">
                                    <div class="flex flex-col items-center justify-center gap-1">
                                        <i class="fa-regular fa-image text-xl text-gray-400"></i>
                                        <div class="mt-1">
                                            <span class="text-xs font-medium text-gray-700">Click to upload image</span>
                                        </div>
                                    </div>
                                </div>
                            </label>
                            
                            <!-- Image Preview Container -->
                            <div id="imagePreview_{{ $post->postID }}" class="hidden">
                                <div class="relative rounded-lg overflow-hidden border border-gray-200 bg-gray-50">
                                    <img id="previewImage_{{ $post->postID }}" 
                                         class="w-full max-h-48 object-contain"
                                         alt="Image preview">
                                    <div class="absolute top-2 right-2">
                                        <button type="button"
                                                onclick="removeImage('{{ $post->postID }}')"
                                                class="bg-red-500 text-white p-1 rounded-full hover:bg-red-600 transition-colors shadow">
                                            <i class="fa-solid fa-trash text-xs"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <button type="button"
                                    onclick="toggleImageUpload('{{ $post->postID }}')"
                                    class="flex items-center gap-1 px-2 py-1.5 text-gray-500 hover:text-blue-600 hover:bg-blue-50 rounded text-sm transition-all duration-200">
                                    <i class="fa-regular fa-image text-sm"></i>
                                </button>
                                <button type="button"
                                    class="flex items-center gap-1 px-2 py-1.5 text-gray-500 hover:text-yellow-600 hover:bg-yellow-50 rounded text-sm transition-all duration-200">
                                    <i class="fa-regular fa-face-smile text-sm"></i>
                                </button>
                            </div>

                            <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                                Post
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    
 <!-- Comments List -->
<div class="space-y-4">
    <div class="flex items-center justify-between mb-4 pb-2 border-b">
        <h4 class="text-base font-semibold text-gray-900">
            <i class="fa-regular fa-comments mr-2 text-blue-500"></i>
            {{ $postcomments->count() ?? 0 }} Comments
        </h4>
    </div>

    @forelse($postcomments as $comment)
    <div class="group py-3 transition-all duration-200 hover:bg-gray-50 rounded-lg">
        <div class="flex gap-3">
            <!-- Commenter Avatar -->
            <div class="flex-shrink-0">
                <img src="{{ $comment->commenter_role === 'Admin' 
                    ? asset('images/logo/sonly.png') 
                    : ($comment->guest_photo ? asset($comment->guest_photo) : asset('images/defaults/user.png')) }}" 
                    alt="{{ $comment->commenter_role === 'Admin' ? 'Soliera Hotel' : $comment->guest_name }}"
                    class="h-8 w-8 rounded-full object-cover shadow-sm border-2 {{ $comment->commenter_role === 'Admin' ? 'border-yellow-400' : 'border-gray-200' }}">
            </div>

            <!-- Comment Content -->
            <div class="flex-1 min-w-0">
                <div class="flex items-start justify-between mb-1">
                    <div class="flex items-center gap-2 flex-wrap">
                        <h3 class="font-semibold text-gray-900 text-sm flex items-center gap-1">
                            {{ $comment->commenter_role === 'Admin' ? 'Soliera Hotel' : $comment->guest_name }}
                            
                            @if($comment->commenter_role === 'Admin')
                                <span class="px-1.5 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-700">
                                    Admin
                                </span>
                            @elseif($comment->guest_status === 'Verified')
                                <span class="flex items-center text-xs" style="color: #F7B32B;">
                                    <i class="fa-solid fa-check-circle" style="color: #F7B32B;"></i>
                                </span>
                            @endif
                        </h3>
                        <span class="text-xs text-gray-500">
                            {{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}
                            •
                            {{ \Carbon\Carbon::parse($comment->created_at)->format('M d, Y') }}
                        </span>
                    </div>
                    
                    <!-- Dropdown Menu -->
                  @if(Auth::guard('guest')->check() || Auth::check())
    <div class="relative">
        <button class="comment-menu-btn text-gray-400 hover:text-gray-600 opacity-0 group-hover:opacity-100 transition-opacity p-1">
            <i class="fa-solid fa-ellipsis-h text-sm"></i>
        </button>
        
        <div class="comment-dropdown hidden absolute right-0 mt-1 w-32 bg-white rounded-lg shadow-lg border border-gray-200 z-10 py-1">
            <!-- Delete for comment owner (Guest) -->
            @if(Auth::guard('guest')->check() && $comment->commenter_role === 'Guest' && $comment->commenterID == Auth::guard('guest')->user()->guestID)
                <button onclick="document.getElementById('deleteCommentModal_{{ $comment->postcommentID }}').showModal()" 
                        class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 flex items-center gap-2">
                    <i class="fa-regular fa-trash-can text-xs"></i>
                    Delete
                </button>
            <!-- Delete for admin comments (Admin only) -->
            @elseif(Auth::check() && $comment->commenter_role === 'Admin')
                <button onclick="document.getElementById('deleteCommentModal_{{ $comment->postcommentID }}').showModal()" 
                        class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 flex items-center gap-2">
                    <i class="fa-regular fa-trash-can text-xs"></i>
                    Delete
                </button>
            <!-- Delete for admin users (for guest comments) -->
            @elseif(Auth::check() && $comment->commenter_role === 'Guest')
                <button onclick="document.getElementById('deleteCommentModal_{{ $comment->postcommentID }}').showModal()" 
                        class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 flex items-center gap-2">
                    <i class="fa-regular fa-trash-can text-xs"></i>
                    Delete
                </button>
            @endif
        </div>
    </div>
@endif

<!-- Delete Comment Modal -->
<dialog id="deleteCommentModal_{{ $comment->postcommentID }}" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg">Delete Comment</h3>
        <p class="py-4">Are you sure you want to delete this comment? This action cannot be undone.</p>
        <div class="modal-action">
            <form method="dialog">
                <button class="btn btn-ghost">Cancel</button>
            </form>
            <form action="{{ route('deletecomment', ['postID' => $post->postID, 'commentID' => $comment->postcommentID]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-error text-white">
                    <i class="fa-regular fa-trash-can mr-2"></i>
                    Delete Comment
                </button>
            </form>
        </div>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>
                </div>

                <!-- Comment Text -->
                @if($comment->comment_content)
                <p class="text-gray-700 text-sm mb-2 leading-relaxed">
                    {{ $comment->comment_content }}
                </p>
                @endif

                <!-- Comment Image -->
                @if($comment->comment_image)
                <div class="mb-2">
                    <img src="{{ asset($comment->comment_image) }}" 
                         alt="Comment Image"
                         class="max-w-xs rounded-lg border border-gray-200 cursor-pointer hover:opacity-90 transition-opacity"
                         onclick="openLightbox(this.src, '{{ $comment->commenter_role === 'Admin' ? 'Soliera Hotel' : $comment->guest_name }}')">
                </div>
                @endif

                <!-- Actions -->
                <div class="flex items-center gap-3 text-xs">
                    <!-- Like Button (only for guests) -->
                    @if(Auth::guard('guest')->check())
                    <button class="like-btn flex items-center gap-1 text-gray-500 hover:text-blue-600"
                            data-commentid="{{ $comment->postcommentID }}">
                        <i class="fa-regular fa-thumbs-up"></i>
                        <span class="font-medium">{{ $comment->likes_count ?? 0 }}</span>
                    </button>
                    @else
                    <div class="flex items-center gap-1 text-gray-400">
                        <i class="fa-regular fa-thumbs-up"></i>
                        <span class="font-medium">{{ $comment->likes_count ?? 0 }}</span>
                    </div>
                    @endif
                    
                    <span class="text-gray-400">•</span>
                    <span class="text-gray-500">{{ $comment->views_count ?? 0 }} views</span>
                </div>
            </div>
        </div>
    </div>
    @empty
    <!-- No comments message -->
    <div class="text-center py-8">
        <i class="fa-regular fa-comment text-3xl text-gray-300 mb-2"></i>
        <p class="text-gray-500 text-sm">No comments yet. Be the first to comment!</p>
    </div>
    @endforelse
</div>
</div>

<!-- Lightbox Modal -->
<div id="lightboxModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-black/90 backdrop-blur-sm">
    <div class="relative max-w-6xl max-h-[90vh]">
        <img id="lightboxImage" class="max-w-full max-h-[90vh] object-contain rounded-lg shadow-2xl" alt="Enlarged image">
        <div class="absolute top-4 right-4">
            <button onclick="closeLightbox()"
                    class="text-white bg-black/50 hover:bg-black/70 rounded-full p-3 transition-all duration-200 hover:scale-110">
                <i class="fa-solid fa-times text-xl"></i>
            </button>
        </div>
    </div>
</div>

<style>
    /* Custom scrollbar */
    .space-y-4 {
        scrollbar-width: thin;
        scrollbar-color: #cbd5e1 #f1f5f9;
    }
    
    .space-y-4::-webkit-scrollbar {
        width: 6px;
    }
    
    .space-y-4::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 3px;
    }
    
    .space-y-4::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 3px;
    }
    
    /* Lightbox animation */
    #lightboxModal {
        animation: fadeIn 0.3s ease;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    /* Image upload hover effects */
    label[for^="commentImage_"]:hover {
        transform: translateY(-1px);
        box-shadow: 0 5px 15px -5px rgba(59, 130, 246, 0.1);
    }
    
    /* Like button animation */
    .like-btn:active i {
        animation: likeBounce 0.3s ease;
    }
    
    @keyframes likeBounce {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.2); }
    }
</style>

<script>
// Photo Preview Functions
function toggleImageUpload(postId) {
    const uploadSection = document.getElementById(`imageUpload_${postId}`);
    const previewSection = document.getElementById(`imagePreview_${postId}`);
    
    uploadSection.classList.toggle('hidden');
    
    // If showing upload, hide preview if exists
    if (!uploadSection.classList.contains('hidden') && previewSection) {
        previewSection.classList.add('hidden');
    }
}

function previewImage(event, postId) {
    const file = event.target.files[0];
    if (!file) return;
    
    const reader = new FileReader();
    const preview = document.getElementById(`previewImage_${postId}`);
    const previewContainer = document.getElementById(`imagePreview_${postId}`);
    
    // Read and display image
    reader.onload = function(e) {
        preview.src = e.target.result;
        previewContainer.classList.remove('hidden');
    }
    
    reader.readAsDataURL(file);
}

function removeImage(postId) {
    const input = document.getElementById(`commentImage_${postId}`);
    const previewContainer = document.getElementById(`imagePreview_${postId}`);
    const uploadSection = document.getElementById(`imageUpload_${postId}`);
    
    // Reset file input
    if (input) {
        input.value = '';
    }
    
    // Hide preview
    if (previewContainer) {
        previewContainer.classList.add('hidden');
    }
    
    // Hide upload section if empty
    uploadSection.classList.add('hidden');
}

// Lightbox Functions
function openLightbox(imageSrc, caption) {
    const modal = document.getElementById('lightboxModal');
    const image = document.getElementById('lightboxImage');
    
    image.src = imageSrc;
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    
    // Prevent body scroll
    document.body.style.overflow = 'hidden';
}

function closeLightbox() {
    const modal = document.getElementById('lightboxModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    document.body.style.overflow = '';
}

// Close lightbox on ESC key
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        closeLightbox();
    }
});

// Close lightbox on outside click
document.getElementById('lightboxModal')?.addEventListener('click', (e) => {
    if (e.target.id === 'lightboxModal') {
        closeLightbox();
    }
});

// Dropdown Menu Functions
document.addEventListener('DOMContentLoaded', function() {
    // Close all dropdowns when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.relative')) {
            document.querySelectorAll('.comment-dropdown').forEach(dropdown => {
                dropdown.classList.add('hidden');
            });
        }
    });
    
    // Toggle dropdown menu
    document.querySelectorAll('.comment-menu-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.stopPropagation();
            const dropdown = this.nextElementSibling;
            dropdown.classList.toggle('hidden');
            
            // Close other dropdowns
            document.querySelectorAll('.comment-dropdown').forEach(other => {
                if (other !== dropdown) {
                    other.classList.add('hidden');
                }
            });
        });
    });
});

// Auto-resize textarea
document.querySelectorAll('textarea[name="comment_content"]').forEach(textarea => {
    textarea.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + 'px';
    });
});

// Form validation before submit
document.querySelectorAll('form[action*="postcomment"]').forEach(form => {
    form.addEventListener('submit', function(e) {
        const textarea = this.querySelector('textarea[name="comment_content"]');
        const fileInput = this.querySelector('input[name="comment_image"]');
        
        // Check if both text and image are empty
        if (textarea.value.trim() === '' && (!fileInput || !fileInput.files[0])) {
            e.preventDefault();
            textarea.focus();
            textarea.classList.add('border-red-300', 'bg-red-50');
            
            // Show error message
            const errorDiv = document.createElement('div');
            errorDiv.className = 'mt-2 text-sm text-red-600';
            errorDiv.textContent = 'Please add a comment or upload an image';
            
            // Remove any existing error message
            const existingError = this.querySelector('.error-message');
            if (existingError) {
                existingError.remove();
            }
            
            errorDiv.classList.add('error-message');
            this.appendChild(errorDiv);
            
            // Remove error after 3 seconds
            setTimeout(() => {
                textarea.classList.remove('border-red-300', 'bg-red-50');
                errorDiv.remove();
            }, 3000);
            
            return false;
        }
        
        // Remove any existing error message
        const existingError = this.querySelector('.error-message');
        if (existingError) {
            existingError.remove();
        }
        
        // Show loading state
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin mr-2"></i>Posting...';
        submitBtn.disabled = true;
        
        // Re-enable button after 5 seconds if form submission fails
        setTimeout(() => {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }, 5000);
        
        // Allow form to submit normally to PHP
        return true;
    });
});

// Add animation keyframes
const style = document.createElement('style');
style.textContent = `
    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    .animate-slideIn {
        animation: slideIn 0.3s ease;
    }
`;
document.head.appendChild(style);
</script>