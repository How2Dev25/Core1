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
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8 mt-5">

                        <!-- Total Reservations -->
                        <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Total
                                        Reservations</h3>
                                    <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totaleventreservation }}</p>

                                </div>
                                <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
                                    <i class="fa-solid fa-bed text-yellow-400 text-2xl"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Confirmed -->
                        <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Confirmed</h3>
                                    <p class="text-3xl font-bold text-gray-800 mt-2">{{ $confirmedeventreservation }}</p>

                                </div>
                                <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
                                    <i class="fa-solid fa-circle-check text-yellow-400 text-2xl"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Pending -->
                        <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Pending</h3>
                                    <p class="text-3xl font-bold text-gray-800 mt-2">{{ $pendingeventreservation }}</p>

                                </div>
                                <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
                                    <i class="fa-solid fa-clock text-yellow-400 text-2xl"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Cancelled -->
                        <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Cancelled</h3>
                                    <p class="text-3xl font-bold text-gray-800 mt-2">{{  $cancelledeventreservation }}</p>

                                </div>
                                <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
                                    <i class="fa-solid fa-circle-xmark text-yellow-400 text-2xl"></i>
                                </div>
                            </div>
                        </div>

                        

                    </div>


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