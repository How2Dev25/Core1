<!-- Posts Container -->
<div class="space-y-1"> <!-- Reduced spacing between posts -->
    @forelse($posts as $post)
    <div class="bg-white border-t border-gray-200 first:border-t-0 hover:bg-gray-50 transition-colors">
        <div class="p-3 sm:p-4">

            <!-- HEADER -->
            <div class="flex items-start justify-between mb-2">
                <div class="flex items-center gap-2 sm:gap-3">
                    <div class="avatar">
                        <div class="w-8 sm:w-10 rounded-full">
                            <img src="{{ asset($post->guest_photo ?? 'images/defaults/user.png') }}"
                                 alt="User" class="rounded-full">
                        </div>
                    </div>
                    <div>
                        <h3 class="font-medium text-sm sm:text-base text-blue-900">
                            {{ $post->guest_name }}
                        </h3>
                        <p class="text-xs sm:text-sm text-gray-500">
                            {{ $post->created_at->diffForHumans() }}
                        </p>
                    </div>
                </div>

                <!-- DROPDOWN -->
                <div class="dropdown dropdown-end">
                    <label tabindex="0" class="btn btn-ghost btn-xs btn-circle hover:bg-gray-100">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="text-gray-500">
                            <circle cx="12" cy="12" r="1"/>
                            <circle cx="12" cy="5" r="1"/>
                            <circle cx="12" cy="19" r="1"/>
                        </svg>
                    </label>
                    <ul tabindex="0"
                        class="dropdown-content z-10 menu p-2 shadow bg-white rounded-md w-44">
                        <li>
                            <a onclick="document.getElementById('reportPost_{{ $post->postID }}').showModal()"
                               class="hover:bg-gray-100 text-sm">
                                Report Post
                            </a>
                        </li>
                        @if($post->guestID === Auth::guard('guest')->user()->guestID)
                         <li>
                            <a onclick="document.getElementById('modifyPost_{{ $post->postID }}').showModal()"
                               class="hover:bg-gray-100 text-sm">
                                Modify Post
                            </a>
                        </li>

                         <li>
                            <a onclick="document.getElementById('removePost_{{ $post->postID }}').showModal()"
                               class="hover:bg-gray-100 text-sm">
                                Remove Post
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>

            <!-- CONTENT -->
            @if($post->post_content)
                <p class="mb-3 text-sm sm:text-base text-gray-800 leading-normal">
                    {{ $post->post_content }}
                </p>
            @endif

            <!-- MEDIA -->
            @if($post->post_image)
                <div class="mb-3 rounded-lg overflow-hidden">
                    <img src="{{ asset($post->post_image) }}"
                         class="w-full max-h-96 object-contain bg-gray-100"
                         alt="Post image">
                </div>
            @endif

            @if($post->post_video)
                <div class="mb-3 rounded-lg overflow-hidden">
                    <video controls
                           class="w-full max-h-96 bg-gray-100">
                        <source src="{{ asset($post->post_video) }}">
                        Your browser does not support video.
                    </video>
                </div>
            @endif

            <!-- ACTIONS BAR - Reddit Style -->
          <div class="flex items-center gap-4 pt-3 border-t border-gray-100">
    <!-- LIKE -->
    <button class="flex items-center gap-2 px-3 py-1.5 rounded-lg hover:bg-gray-100 transition-colors">
        <i class="fa-regular fa-heart text-gray-500"></i>
        <span class="text-sm font-medium text-gray-700 hidden sm:inline">
            {{ $post->likes_count ?? 0 }}
        </span>
        <span class="text-sm font-medium text-gray-700 sm:hidden">
            {{ $post->likes_count ?? 0 }}
        </span>
    </button>

    <!-- COMMENT -->
    <button class="flex items-center gap-2 px-3 py-1.5 rounded-lg hover:bg-gray-100 transition-colors">
        <i class="fa-regular fa-comment text-gray-500"></i>
        <span class="text-sm font-medium text-gray-700 hidden sm:inline">
            {{ $post->comments_count ?? 0 }}
        </span>
        <span class="text-sm font-medium text-gray-700 sm:hidden">
            {{ $post->comments_count ?? 0 }}
        </span>
    </button>
</div>

        </div>
    </div>
    @empty
    <div class="bg-white border-t border-gray-200 p-8 text-center">
        <i class="fa-regular fa-message text-4xl text-gray-300 mb-3"></i>
        <h3 class="text-lg font-medium text-gray-500 mb-1">No posts yet</h3>
        <p class="text-gray-400">Be the first to share your experience! 👋</p>
    </div>
    @endforelse
</div>

<!-- PAGINATION - Reddit Style -->
@if($posts->hasPages())
<div class="mt-6">
    <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
        <div class="flex items-center justify-between p-4">
            <!-- Previous Button -->
            @if($posts->onFirstPage())
                <span class="px-4 py-2 text-gray-400 cursor-not-allowed">
                    <i class="fa-solid fa-chevron-left mr-2"></i> Previous
                </span>
            @else
                <a href="{{ $posts->previousPageUrl() }}" 
                   class="flex items-center px-4 py-2 text-blue-900 hover:bg-gray-50 rounded-lg">
                    <i class="fa-solid fa-chevron-left mr-2"></i> Previous
                </a>
            @endif

            <!-- Page Numbers -->
            <div class="flex items-center space-x-2">
                @foreach($posts->getUrlRange(1, $posts->lastPage()) as $page => $url)
                    @if($page == $posts->currentPage())
                        <span class="w-8 h-8 flex items-center justify-center bg-blue-900 text-white rounded-lg font-medium">
                            {{ $page }}
                        </span>
                    @elseif($page == 1 || $page == $posts->lastPage() || ($page >= $posts->currentPage() - 1 && $page <= $posts->currentPage() + 1))
                        <a href="{{ $url }}" 
                           class="w-8 h-8 flex items-center justify-center text-blue-900 hover:bg-gray-50 rounded-lg font-medium">
                            {{ $page }}
                        </a>
                    @elseif($page == $posts->currentPage() - 2 || $page == $posts->currentPage() + 2)
                        <span class="text-gray-400">...</span>
                    @endif
                @endforeach
            </div>

            <!-- Next Button -->
            @if($posts->hasMorePages())
                <a href="{{ $posts->nextPageUrl() }}" 
                   class="flex items-center px-4 py-2 text-blue-900 hover:bg-gray-50 rounded-lg">
                    Next <i class="fa-solid fa-chevron-right ml-2"></i>
                </a>
            @else
                <span class="px-4 py-2 text-gray-400 cursor-not-allowed">
                    Next <i class="fa-solid fa-chevron-right ml-2"></i>
                </span>
            @endif
        </div>
    </div>
</div>
@endif