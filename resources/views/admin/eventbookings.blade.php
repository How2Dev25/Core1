<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    @vite('resources/css/app.css')

    <script src="https://unpkg.com/lucide@latest"></script>

    <title>{{$title}} - Events And Conference</title>
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
                    <div class="pb-5 border-b border-base-300 animate-fadeIn">
                        <h1 class="text-2xl font-bold text-[#191970] bg-clip-text ">Event And Conference Bookings</h1>
                    </div>
                    {{-- Subsystem Name --}}


                    <!-- content -->
                    <livewire:event-reservations />

                    <!-- Lucide Icons -->
                    <script type="module">
                        import lucide from 'https://unpkg.com/lucide@latest/dist/esm/lucide.js';
                        lucide.createIcons();
                    </script>




                </main>
            </div>
        </div>





    </body>

@endauth

@livewireScripts
@include('javascriptfix.soliera_js')

<script>


    <script src="{{asset('javascript/photouploadglobal.js')}}"></script>

</html>