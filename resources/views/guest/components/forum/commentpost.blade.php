<div class="flex flex-col lg:flex-row gap-6">
    <!-- Left Column (Posts) -->
    <div class="w-full">
        @if(session('success'))
            <div id="success-alert"
                class="fixed top-5 right-5 z-50 bg-green-600 text-white px-4 py-3 rounded-lg shadow-lg flex items-center gap-2 backdrop-blur-sm border border-green-500/20">
                <i class="fa-solid fa-circle-check text-lg"></i>
                <span class="text-sm font-medium">
                    {{ session('success') }}
                </span>
                <div class="w-full bg-green-500/30 h-0.5 absolute bottom-0 left-0 progress-bar"></div>
            </div>

            <script>
                setTimeout(() => {
                    const alert = document.getElementById('success-alert');
                    if (alert) {
                        alert.style.opacity = '0';
                        setTimeout(() => alert.remove(), 300);
                    }
                }, 3000);
            </script>
        @endif

        <!-- POST CARD -->
        <div
            class="bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-all duration-300 mb-4 overflow-hidden">
            <div class="p-4 sm:p-5">

                <!-- HEADER - Improved -->
                <div class="flex items-start justify-between mb-3">
                    <div class="flex items-center gap-3">
                        <div class="relative">
                            <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-full overflow-hidden ring-2 ring-offset-2 
                                @if($post->post_role === 'Admin') ring-yellow-400 ring-offset-yellow-50
                                @else ring-blue-400 ring-offset-blue-50 @endif">
                                @if($post->post_role === 'Admin')
                                    <img src="{{ asset('images/logo/sonly.png') }}" alt="Soliera Hotel"
                                        class="w-full h-full object-cover">
                                @else
                                    <img src="{{ asset($post->guest_photo ?? 'images/defaults/user.png') }}" alt="User"
                                        class="w-full h-full object-cover">
                                @endif
                            </div>
                            @if($post->post_role === 'Admin')
                                <div
                                    class="absolute -bottom-1 -right-1 bg-yellow-400 w-5 h-5 rounded-full flex items-center justify-center">
                                    <i class="fa-solid fa-check text-xs text-white"></i>
                                </div>
                            @endif
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <h3 class="font-semibold text-sm sm:text-base 
                                    @if($post->post_role === 'Admin') text-yellow-700
                                    @else text-gray-900 @endif">
                                    @if($post->post_role === 'Admin')
                                        Soliera Hotel
                                    @else
                                        {{ $post->guest_name }}
                                    @endif
                                </h3>
                                @if($post->post_role === 'Admin')
                                    <span
                                        class="px-2 py-0.5 bg-yellow-50 text-yellow-700 text-xs font-medium rounded-full border border-yellow-200">
                                        Official
                                    </span>
                                @endif
                            </div>
                            <div class="flex items-center gap-2 mt-0.5">
                                <p class="text-xs text-gray-500">
                                    {{ $post->created_at->diffForHumans() }}
                                </p>
                                <span class="text-gray-300">•</span>
                                <span class="text-xs text-gray-500">
                                    {{ $post->created_at->format('M d, Y') }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- DROPDOWN - Improved -->
                   
                </div>

                <!-- CONTENT - Improved -->
                @if($post->post_content)
                    <div class="mb-4">
                        <p class="text-sm sm:text-base text-gray-800 leading-relaxed whitespace-pre-line">
                            {{ $post->post_content }}
                        </p>
                    </div>
                @endif

                <!-- MEDIA - Improved -->
                @if($post->post_image)
                    <div class="mb-4 rounded-xl overflow-hidden border border-gray-200">
                        <img src="{{ asset($post->post_image) }}"
                            class="w-full max-h-[500px] object-contain bg-gray-50 hover:scale-[1.005] transition-transform duration-300"
                            alt="Post image" loading="lazy">
                    </div>
                @endif

                @if($post->post_video)
                    <div class="mb-4 rounded-xl overflow-hidden border border-gray-200">
                        <video controls class="w-full max-h-[500px] bg-gray-900 rounded-xl"
                            poster="{{ asset('images/placeholder/video-thumbnail.jpg') }}">
                            <source src="{{ asset($post->post_video) }}">
                            Your browser does not support video.
                        </video>
                    </div>
                @endif

                <!-- ACTIONS BAR - Improved Reddit Style -->
                <div class="flex items-center gap-1 pt-3 border-t border-gray-100">
                    <!-- LIKE -->
                    @if(Auth::guard('guest')->check())
                        <button
                            class="like-btn group flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-red-50 transition-all duration-200"
                            data-postid="{{ $post->postID }}">
                            <div class="relative">
                                <i
                                    class="fa-heart {{ $post->isLikedBy(Auth::guard('guest')->user()->guestID) ? 'fa-solid text-red-500' : 'fa-regular text-gray-500 group-hover:text-red-400' }} text-lg transition-colors"></i>
                            </div>
                            <span
                                class="text-sm font-medium text-gray-700 group-hover:text-red-600 transition-colors like-count">
                                {{ $post->likesCount() }}
                            </span>
                        </button>
                    @else
                        <button class="group flex items-center gap-2 px-3 py-2 rounded-lg cursor-not-allowed opacity-50"
                            disabled>
                            <i class="fa-regular fa-heart text-gray-300 text-lg"></i>
                            <span class="text-sm font-medium text-gray-400 like-count">
                                {{ $post->likesCount() }}
                            </span>
                        </button>
                    @endif

                    <!-- COMMENT -->
                    <a href="{{ Auth::guard('guest')->check()
    ? route('redirectcommentguest', $post->postID)
    : (Auth::check() ? route('redirectcommentadmin', $post->postID) : '#') }}"
                        class="group flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-blue-50 transition-all duration-200">
                        <i
                            class="fa-regular fa-comment text-gray-500 group-hover:text-blue-500 text-lg transition-colors"></i>
                        <span class="text-sm font-medium text-gray-700 group-hover:text-blue-600 transition-colors">
                            {{ $post->comments_count ?? 0 }}
                        </span>
                    </a>

                    <!-- SHARE (Optional) -->

                </div>

                <!-- STATS BAR -->
                <div class="flex items-center justify-between text-xs text-gray-500 pt-2 mt-1 border-t border-gray-100">
                    <div class="flex items-center gap-4">
                        @if($post->likesCount() > 0)
                            <div class="flex items-center gap-1">
                                <span>{{ $post->likesCount() }} likes</span>
                            </div>
                        @endif
                        @if($post->comments_count > 0)
                            <span>{{ $post->comments_count }} comments</span>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add these styles for improved UI -->
<style>
    /* Smooth transitions */
    .transition-all {
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Card hover effect */
    .hover\:shadow-md {
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
    }

    /* Like button animation */
    .like-btn:active i {
        transform: scale(1.2);
    }

    /* Progress bar animation for success alert */
    .progress-bar {
        animation: progress 3s linear forwards;
    }

    @keyframes progress {
        from {
            width: 100%;
        }

        to {
            width: 0%;
        }
    }

    /* Dropdown backdrop blur */
    .backdrop-blur-sm {
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
    }

    /* Avatar ring animation */
    .relative:hover .ring-2 {
        animation: pulse 2s infinite;
    }

    @keyframes pulse {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0.7;
        }
    }

    /* Media hover effect */
    img:hover,
    video:hover {
        cursor: pointer;
    }

    /* Action buttons hover states */
    .hover\:bg-red-50:hover i {
        animation: heartBeat 0.5s ease;
    }

    @keyframes heartBeat {

        0%,
        100% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.1);
        }
    }

    /* Scrollbar styling */
    ::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }

    ::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #a8a8a8;
    }
</style>

<!-- Add this JavaScript for enhanced interactivity -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Like button functionality
        document.querySelectorAll('.like-btn').forEach(button => {
            button.addEventListener('click', function () {
                const postID = this.dataset.postid;
                const heartIcon = this.querySelector('i');
                const likeCount = this.querySelector('.like-count');
                const button = this;

                // Add click animation
                button.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    button.style.transform = '';
                }, 200);

                // Toggle like state
                if (heartIcon.classList.contains('fa-regular')) {
                    // Add animation class
                    heartIcon.classList.add('animate-pulse');

                    setTimeout(() => {
                        heartIcon.classList.remove('fa-regular', 'text-gray-500');
                        heartIcon.classList.add('fa-solid', 'text-red-500');
                        heartIcon.classList.remove('animate-pulse');
                        likeCount.textContent = parseInt(likeCount.textContent) + 1;
                        likeCount.classList.add('text-red-600');
                    }, 100);
                } else {
                    heartIcon.classList.remove('fa-solid', 'text-red-500');
                    heartIcon.classList.add('fa-regular', 'text-gray-500');
                    likeCount.textContent = parseInt(likeCount.textContent) - 1;
                    likeCount.classList.remove('text-red-600');
                }

                // AJAX call to save like
                fetch(`/posts/${postID}/like`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                }).then(response => {
                    if (!response.ok) {
                        // Revert UI if API call fails
                        if (heartIcon.classList.contains('fa-regular')) {
                            heartIcon.classList.remove('fa-regular', 'text-gray-500');
                            heartIcon.classList.add('fa-solid', 'text-red-500');
                            likeCount.textContent = parseInt(likeCount.textContent) + 1;
                        } else {
                            heartIcon.classList.remove('fa-solid', 'text-red-500');
                            heartIcon.classList.add('fa-regular', 'text-gray-500');
                            likeCount.textContent = parseInt(likeCount.textContent) - 1;
                        }
                    }
                    return response.json();
                });
            });
        });

        // Media click to enlarge
        document.querySelectorAll('img, video').forEach(media => {
            media.addEventListener('click', function () {
                if (this.tagName === 'IMG') {
                    const modal = document.createElement('div');
                    modal.className = 'fixed inset-0 bg-black/90 z-50 flex items-center justify-center p-4';
                    modal.innerHTML = `
                    <div class="relative max-w-7xl max-h-[90vh]">
                        <img src="${this.src}" 
                             class="max-w-full max-h-[90vh] object-contain rounded-lg"
                             alt="Enlarged image">
                        <button onclick="this.parentElement.parentElement.remove()"
                                class="absolute top-4 right-4 text-white bg-black/50 hover:bg-black/70 rounded-full p-2 transition-colors">
                            <i class="fa-solid fa-times text-xl"></i>
                        </button>
                    </div>
                `;
                    document.body.appendChild(modal);
                    modal.addEventListener('click', (e) => {
                        if (e.target === modal) modal.remove();
                    });
                }
            });
        });

        // Dropdown close on outside click
        document.addEventListener('click', function (e) {
            if (!e.target.closest('.dropdown')) {
                document.querySelectorAll('.dropdown ul').forEach(menu => {
                    if (menu.style.display === 'block') {
                        menu.style.display = 'none';
                    }
                });
            }
        });
    });
</script>

   