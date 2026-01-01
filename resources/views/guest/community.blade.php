<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite('resources/css/app.css')

    <script src="https://unpkg.com/lucide@latest"></script>

    <title>{{$title}} -Forum</title>
    @livewireStyles
</head>
@auth('guest')

    <body class="bg-base-100">
        <div class="flex h-screen overflow-hidden">
            <!-- Sidebar -->
            @include('guest.components.dashboard.sidebar')

            <!-- Main content -->
            <div class="flex flex-col flex-1 overflow-hidden">
                <!-- Navbar -->
                @include('guest.components.dashboard.navbar')

                <!-- Dashboard Content -->
                <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 transition-slow ">
                    {{-- Subsystem Name --}}
                  
                    {{-- Subsystem Name --}}



                    <section class="flex-1  p-6">
       
                          <div class="flex flex-col lg:flex-row gap-6">
    <!-- Left Column (Posts) -->
    <div class="lg:w-8/12">

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
        <div class="bg-white border border-gray-300 rounded-lg mb-4 overflow-hidden">
    <div class="p-4">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 rounded-full overflow-hidden bg-gradient-to-r from-blue-600 to-blue-800 p-0.5">
                <div class="w-full h-full rounded-full bg-white p-0.5">
                    <img src="{{ asset(Auth::guard('guest')->user()->guest_photo ?? 'images/defaults/user.png') }}" 
                         alt="Your profile" 
                         class="w-full h-full rounded-full object-cover">
                </div>
            </div>
            <h3 class="font-medium text-gray-900">
                Welcome, {{ Auth::guard('guest')->user()->guest_name ?? 'Guest' }}
            </h3>
        </div>

        <button onclick="document.getElementById('createModal').showModal()" 
                class="w-full border border-gray-300 rounded-lg px-4 py-3 text-left hover:bg-gray-50 transition-colors mb-3">
            <div class="flex items-center gap-2 text-gray-600">
                <i class="fa-solid fa-pen-to-square text-lg"></i>
                <span class="font-medium">Create Post</span>
            </div>
            <p class="text-sm text-gray-500 mt-1 ml-7">
                Share your travel experience with the community
            </p>
        </button>

        <div class="flex items-center border-t border-gray-100 pt-3">
            <!-- Photo Upload -->
            <button onclick="document.getElementById('createModal').showModal()" 
                    class="flex items-center gap-2 px-3 py-2 hover:bg-gray-100 rounded-lg flex-1 justify-center transition-colors">
                <i class="fa-solid fa-image text-lg text-green-500"></i>
                <span class="text-sm text-gray-700 hidden sm:inline">Photo</span>
            </button>

            <!-- Video Upload -->
            <button onclick="document.getElementById('createModal').showModal()" 
                    class="flex items-center gap-2 px-3 py-2 hover:bg-gray-100 rounded-lg flex-1 justify-center transition-colors">
                <i class="fa-solid fa-video text-lg text-purple-500"></i>
                <span class="text-sm text-gray-700 hidden sm:inline">Video</span>
            </button>

            <!-- Poll -->
           
        </div>
    </div>
</div>

        <!-- Post 1 -->

        @include('guest.components.forum.posts')
       
      
    </div>

    <!-- Right Column (Sidebar) - Using flex-1 -->
    <div class="flex-1 lg:w-4/12 lg:sticky lg:top-6 lg:h-fit max-md:hidden">
        <div class="space-y-6">
            <!-- Your Recent Posts -->
            @include('guest.components.forum.recentpost')
         
            <!-- Advertisement 2 -->
          
        </div>
    </div>
</div>


            
        </div>
    </div>


  

        </section>



                    <!-- Initialize Lucide Icons -->
                    <script>
                        lucide.createIcons();
                    </script>







                </main>
            </div>
        </div>


       


        {{-- modals --}}

          <!-- Create Post Modal -->
       @include('guest.components.forum.create')
       
    <!-- Report Post Modal -->
    @foreach ($posts as $post)
             @include('guest.components.forum.report')
             @include('guest.components.forum.edit')
                @include('guest.components.forum.delete')
    @endforeach
       



        @livewireScripts
        @include('javascriptfix.soliera_js')




@endauth
</body>


<script>
        function toggleLike(btn) {
            const svg = btn.querySelector('svg');
            const countSpan = btn.querySelector('.like-count');
            let count = parseInt(countSpan.textContent);
            
            if (svg.getAttribute('fill') === 'currentColor') {
                svg.setAttribute('fill', 'none');
                btn.classList.remove('text-yellow-400');
                countSpan.textContent = count - 1;
            } else {
                svg.setAttribute('fill', 'currentColor');
                btn.classList.add('text-yellow-400');
                countSpan.textContent = count + 1;
            }
        }

    </script>
                



</html>