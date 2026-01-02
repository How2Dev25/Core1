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

    <title>{{$title}} - Forum</title>
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

                                @include('guest.components.forum.commentpost')


                                 <!-- Add this after the ACTIONS BAR section -->

                                @include('guest.components.forum.comments')



                             </section>



                        <!-- Initialize Lucide Icons -->
                        <script>
                            lucide.createIcons();
                        </script>







                    </main>
                </div>
            </div>





            {{-- modals --}}

        



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
                


<script>
document.querySelectorAll('.like-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const postID = this.dataset.postid;
        const icon = this.querySelector('i');
        const countEls = this.querySelectorAll('.like-count');
        const isLiked = icon.classList.contains('fa-solid'); // already liked
        const url = isLiked ? `/posts/${postID}/unlike` : `/posts/${postID}/like`;

        fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
        })
        .then(res => res.json())
        .then(data => {
            // Toggle heart
            icon.classList.toggle('fa-solid', !isLiked);
            icon.classList.toggle('fa-regular', isLiked);
            icon.classList.toggle('text-red-500', !isLiked);
            icon.classList.toggle('text-gray-500', isLiked);

            // Update like count
            countEls.forEach(el => el.textContent = data.likesCount);
        })
        .catch(err => console.error(err));
    });
});
</script>

</html>