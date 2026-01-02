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

                                @include('guest.components.forum.commentpost')

                            
                                 <!-- Add this after the ACTIONS BAR section -->

                                @include('guest.components.forum.comments')



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