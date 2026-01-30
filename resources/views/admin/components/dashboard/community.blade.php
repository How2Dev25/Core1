<div class=" rounded-2xl  p-6">
    <div class="mb-8">
    <h2 class="text-lg font-semibold text-gray-900 text-center sm:text-left">
        Community Forum
    </h2>
</div>
    <div class="space-y-4">
        @forelse($myRecentPosts as $recentPost)
            <div class="border-l-4 border-blue-600 pl-3 p-2 rounded-r-lg hover:bg-blue-50 transition-colors">

                <!-- PROFILE -->
                <a href="" class="flex items-center gap-2 mb-1 group">
                    <img src="{{ $recentPost->post_role === 'Admin'
        ? asset('images/logo/sonly.png')
        : asset($recentPost->guest_photo ?? 'images/defaults/user.png') }}"
                        class="w-7 h-7 rounded-full object-cover border" alt="Profile">
                    <span class="text-sm font-semibold text-blue-900 group-hover:underline">
                        {{ $recentPost->post_role === 'Admin' ? 'Soliera Hotel' : $recentPost->guest_name }}
                    </span>
                </a>

                <!-- POST LINK -->
                <a href="{{ route('community') }}#post-{{ $recentPost->postID }}" class="block">

                    <p class="text-sm text-gray-700 font-medium line-clamp-3">
                        @if(!empty($recentPost->post_content))
                                    {{ \Illuminate\Support\Str::of($recentPost->post_content)
            ->explode('.')
            ->take(3)
            ->implode('.') }}.
                        @elseif(!empty($recentPost->post_image))
                            Posted an image
                        @elseif(!empty($recentPost->post_video))
                            Posted a video
                        @else
                            Posted an update
                        @endif
                    </p>

                    <p class="text-xs text-gray-500 mt-1">
                        {{ $recentPost->created_at->diffForHumans() }}
                        • {{ $recentPost->likes_count }} likes
                    </p>
                </a>
            </div>
        @empty
            <p class="text-sm text-gray-500 text-center">
                Be the first to post about Soliera Hotel
            </p>
        @endforelse


    </div>
</div>