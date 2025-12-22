<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    @vite('resources/css/app.css')
    <script src="{{ asset('javascript/chart.js') }}"></script>


    <script src="https://unpkg.com/lucide@latest"></script>

    <title>{{$title}} - Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    @livewireStyles
</head>

<style>
    .carousel-container::-webkit-scrollbar {
        display: none;
    }

    .stat-gradient {
        background: linear-gradient(135deg, var(--tw-gradient-from), var(--tw-gradient-to));
    }

    .floating-animation {
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-10px);
        }
    }

    .card-hover {
        transition: all 0.3s ease;
    }

    .card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
</style>

<body>


    @auth('guest')

        <section class="bg-base-100">
            <div class="flex h-screen overflow-hidden">
                <!-- Sidebar -->
                @include('guest.components.dashboard.sidebar')

                <!-- Main content -->
                <div class="flex flex-col flex-1 overflow-hidden">
                    <!-- Navbar -->
                    @include('guest.components.dashboard.navbar')

                    <!-- Dashboard Content -->
                    <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 ">

                        <!-- Welcome Banner -->
                        @include('guest.components.dashboard.welcomeguest')

                        <!-- Main Grid Layout -->
                        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

                            <!-- Left Column: Stats & Charts -->
                            <div class="lg:col-span-8 space-y-6">

                                <!-- Quick Stats Grid -->
                                @include('guest.components.dashboard.metric')

                                {{-- room showcase --}}
                                @include('guest.components.dashboard.roomshowcase')

                                <!-- Facilities Grid -->
                                @include('guest.components.dashboard.facilitysection')
                                <!-- Reservation Trends Chart -->

                            </div>

                            <!-- Right Column: Events, Rooms & Promos -->
                            <div class="lg:col-span-4 space-y-6">
                                 <!-- Current Promotion -->
                                 @include('guest.components.dashboard.promotionsection')
                                <!-- Upcoming Events -->
                                @include('guest.components.dashboard.eventsection')

                                <!-- Points Breakdown -->
                                @include('guest.components.dashboard.pointschart')
                                <!-- Featured Room -->


                            </div>
                        </div>

                        <div class="w-full">
                            @include('guest.components.dashboard.reservationtrend')
                        </div>

                    </main>
                </div>
            </div>
            <!-- Chart.js Scripts -->
            <script>
                function dismissWelcome() {
                    document.getElementById('welcomeCard').style.display = 'none';
                }
            </script>
            @livewireScripts
            @include('javascriptfix.soliera_js')
        </section>





    @endauth

</body>

</html>