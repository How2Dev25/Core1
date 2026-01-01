<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


    <script src="https://unpkg.com/lucide@latest"></script>

    <title>{{$title}} - Forum</title>
    @livewireStyles
</head>
@auth


    <body class="bg-base-100">
        <div class="flex h-screen overflow-hidden">
            <!-- Sidebar -->
            @include('admin.components.dashboard.sidebar')






            <!-- Main content -->
            <div class="flex flex-col flex-1 overflow-hidden">
                <!-- Navbar -->
                @include('admin.components.dashboard.navbar')








                <!-- Dashboard Content -->
                <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 transition-slow ">
                    {{-- Subsystem Name --}}

                    {{-- Subsystem Name --}}

                    <section class="flex-1  p-6">

                        <div class="flex flex-col lg:flex-row gap-6">
                            <!-- Left Column (Posts) -->
                            <div class="w-full">

                                @if(session('success'))
                                    <div id="success-alert"
                                        class="fixed top-5 right-5 z-50 bg-green-600 text-white px-4 py-3 rounded-lg shadow-lg flex items-center gap-2">
                                        <i class="fa-solid fa-circle-check"></i>
                                        <span class="text-sm font-medium">
                                            {{ session('success') }}
                                        </span>
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

                                <!-- Create Post Trigger -->
                               
                               

                             <!-- Posts Container -->
<div class="space-y-1"> <!-- Reduced spacing between posts -->
    <div class="bg-white border-t border-gray-200 first:border-t-0 hover:bg-gray-50 transition-colors">
        <div class="p-3 sm:p-4">

           
          <!-- HEADER -->
<div class="flex items-start justify-between mb-2">
    <div class="flex items-center gap-2 sm:gap-3">
        <div class="avatar">
            <div class="w-8 sm:w-10 rounded-full">
                @if($post->post_role === 'Admin')
                    <img src="{{ asset('images/logo/sonly.png') }}" 
                         alt="Soliera Hotel" class="rounded-full">
                @else
                    <img src="{{ asset($post->guest_photo ?? 'images/defaults/user.png') }}" 
                         alt="User" class="rounded-full">
                @endif
            </div>
        </div>
        <div>
            <h3 class="font-medium text-sm sm:text-base text-blue-900">
                @if($post->post_role === 'Admin')
                    Soliera Hotel
                @else
                    {{ $post->guest_name }}
                @endif
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
    <ul tabindex="0" class="dropdown-content z-10 menu p-2 shadow bg-white rounded-md w-44">
        <li>
            <a onclick="document.getElementById('reportPost_{{ $post->postID }}').showModal()"
               class="hover:bg-gray-100 text-sm">
                Report Post
            </a>
        </li>

        {{-- Check if viewer is a guest --}}
        @if(Auth::guard('guest')->check())
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
        @elseif(Auth::check()) {{-- If viewer is admin --}}
            @if($post->post_role === 'Admin')
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
                         class="w-full max-h-96 object-contain"
                         alt="Post image">
                </div>
            @endif

            @if($post->post_video)
                <div class="mb-3 rounded-lg overflow-hidden">
                    <video controls
                           class="w-full max-h-96 ">
                        <source src="{{ asset($post->post_video) }}">
                        Your browser does not support video.
                    </video>
                </div>
            @endif

            <!-- ACTIONS BAR - Reddit Style -->
  <div class="flex items-center gap-4 pt-3 border-t border-gray-100">
    <!-- LIKE -->
    @if(Auth::guard('guest')->check())
        <button class="like-btn flex items-center gap-2 px-3 py-1.5 rounded-lg hover:bg-gray-100 transition-colors"
                data-postid="{{ $post->postID }}">
            <i class="fa-heart {{ $post->isLikedBy(Auth::guard('guest')->user()->guestID) ? 'fa-solid text-red-500' : 'fa-regular text-gray-500' }}"></i>
            <span class="text-sm font-medium text-gray-700 hidden sm:inline like-count">
                {{ $post->likesCount() }}
            </span>
            <span class="text-sm font-medium text-gray-700 sm:hidden like-count">
                {{ $post->likesCount() }}
            </span>
        </button>
    @else
        {{-- Admin or non-guest users cannot like posts --}}
        <button class="flex items-center gap-2 px-3 py-1.5 rounded-lg cursor-not-allowed opacity-50">
            <i class="fa-regular fa-heart text-gray-300"></i>
            <span class="text-sm font-medium text-gray-400 hidden sm:inline">
                {{ $post->likesCount() }}
            </span>
            <span class="text-sm font-medium text-gray-400 sm:hidden">
                {{ $post->likesCount() }}
            </span>
        </button>
    @endif

    <!-- COMMENT -->
    <a href="{{ Auth::guard('guest')->check() 
            ? route('redirectcommentguest', $post->postID) 
            : (Auth::check() ? route('redirectcommentadmin', $post->postID) : '#') }}"
            target="_blank"
   class="flex items-center gap-2 px-3 py-1.5 rounded-lg hover:bg-gray-100 transition-colors">
    <i class="fa-regular fa-comment text-gray-500"></i>
    <span class="text-sm font-medium text-gray-700 hidden sm:inline">
        {{ $post->comments_count ?? 0 }}
    </span>
    <span class="text-sm font-medium text-gray-700 sm:hidden">
        {{ $post->comments_count ?? 0 }}
    </span>
</a>

</div>

        </div>
    </div>

</div>



                            </div>

                      
                        </div>



            </div>
        </div>




        </section>



        <!-- Graph Section -->




        </div>




        <!-- Initialize Lucide Icons -->
        <script>
            lucide.createIcons();
        </script>







        </main>
        </div>
        </div>


        <!-- Create Post Modal -->
      

        <!-- Report Post Modal -->
        


        @livewireScripts
        @include('javascriptfix.soliera_js')
    </body>
@endauth



</html>