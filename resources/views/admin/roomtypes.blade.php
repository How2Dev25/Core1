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

    <title>{{$title}} - Room Types</title>
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
                        <h1 class="text-2xl font-bold bg-white bg-clip-text text-[#191970]">Room Types</h1>
                    </div>
                    {{-- Subsystem Name --}}

                    <section class="flex-1 p-6">
                        <!-- Cards -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            <!-- Total Room Types -->
                            <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="text-sm font-medium text-gray-600 uppercase">Total Room Types</h3>
                                        <p class="text-3xl font-bold text-gray-800 mt-2">8</p>
                                        <span class="text-sm text-gray-500">Across All Categories</span>
                                    </div>
                                    <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
                                        <i data-lucide="hotel" class="w-6 h-6 text-yellow-400"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Active Room Types -->
                            <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="text-sm font-medium text-gray-600 uppercase">Active</h3>
                                        <p class="text-3xl font-bold text-gray-800 mt-2">6</p>
                                        <span class="text-sm text-gray-500">Currently Available</span>
                                    </div>
                                    <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
                                        <i data-lucide="check-circle" class="w-6 h-6 text-yellow-400"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Inactive Room Types -->
                            <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="text-sm font-medium text-gray-600 uppercase">Inactive</h3>
                                        <p class="text-3xl font-bold text-gray-800 mt-2">2</p>
                                        <span class="text-sm text-gray-500">Not Available</span>
                                    </div>
                                    <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
                                        <i data-lucide="x-circle" class="w-6 h-6 text-yellow-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Header with Add Button -->
                        <div class="flex items-center justify-between mt-8 mb-4">
                            <h2 class="text-lg font-semibold text-gray-800">Room Types</h2>
                            <button onclick="document.getElementById('addRoomModal').showModal()"
                                class="bg-blue-900 text-white px-4 py-2 rounded-lg flex items-center gap-2">
                                <i data-lucide="plus" class="w-5 h-5"></i> Add Room Type
                            </button>
                        </div>

                        <!-- Table -->
                        @if (session('success'))
                            <div class="alert alert-success shadow-lg my-4 flex items-center gap-3 mt-5 mb-5">
                                <i class="fas fa-check-circle text-lg"></i>
                                <span>{{ session('success') }}</span>
                            </div>
                        @endif
                        <div class="overflow-x-auto rounded-xl border border-gray-100 shadow-lg">
                            <table class="table w-full">
                                <thead class="bg-blue-900 text-white">
                                    <tr>
                                        <th>Room Type</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($roomtypes as $roomtype)
                                        <tr class="hover:bg-gray-50">
                                            <td class="font-medium">{{ $roomtype->roomtype_name }}</td>
                                            <td class="font-medium text-gray-900">{{ $roomtype->roomtype_description }}</td>
                                            <td class="flex gap-2">
                                                <button
                                                    onclick="document.getElementById('editRoomModal_{{$roomtype->roomtypesID}}').showModal()"
                                                    class="p-2 rounded-lg bg-blue-100 hover:bg-blue-200 text-blue-600">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button
                                                    onclick="document.getElementById('deleteRoomModal_{{$roomtype->roomtypesID}}').showModal()"
                                                    class="p-2 rounded-lg bg-red-100 hover:bg-red-200 text-red-600">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center py-6 text-gray-500">
                                                <i class="fas fa-info-circle mr-2"></i>
                                                No room types available.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>





                        <!-- Delete Room Modal -->

                    </section>


                    <script>
                        lucide.createIcons();
                    </script>

                    <!-- Initialize Lucide -->
                    <script>
                        lucide.createIcons();
                    </script>


                    {{-- modals --}}



            </div>











            </main>
        </div>
        </div>


        {{-- modals --}}

        @include('admin.components.roommanagement.createroomtype')

        @foreach ($roomtypes as $roomtype)
            @include('admin.components.roommanagement.editroomtype')
            @include('admin.components.roommanagement.deleteroomtype')
        @endforeach




        @livewireScripts
        @include('javascriptfix.soliera_js')
    </body>
@endauth



</html>