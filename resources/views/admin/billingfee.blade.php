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

    <title>{{$title}} - Billing Fee</title>
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
                        <h1 class="text-2xl font-bold bg-white bg-clip-text text-[#191970]">Billing Fee</h1>
                    </div>
                    {{-- Subsystem Name --}}

                    <section class="flex-1 p-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                            <!-- Current Service Fee -->
                            <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Current
                                            Service Fee</h3>
                                        <p class="text-3xl font-bold text-gray-800 mt-2">{{$servicefee}}%</p>
                                        <span class="text-sm font-medium text-gray-500 mt-3 block">Applied to all
                                            bookings</span>
                                    </div>
                                    <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
                                        <i class="fa-solid fa-hand-holding-dollar text-yellow-400 text-2xl"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Tax Rate -->
                            <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Tax Rate</h3>
                                        <p class="text-3xl font-bold text-gray-800 mt-2">{{$taxrate}}%</p>
                                        <span class="text-sm font-medium text-gray-500 mt-3 block">Applied to total
                                            amount</span>
                                    </div>
                                    <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
                                        <i class="fa-solid fa-receipt text-yellow-400 text-2xl"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Additional Person Fee -->
                            <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Additional
                                            Person Fee</h3>
                                        <p class="text-3xl font-bold text-gray-800 mt-2">₱{{$additionalpersonfee}}</p>
                                        <span class="text-sm font-medium text-gray-500 mt-3 block">Per extra guest</span>
                                    </div>
                                    <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
                                        <i class="fa-solid fa-user-plus text-yellow-400 text-2xl"></i>
                                    </div>
                                </div>
                            </div>

                        </div>

                        @if(session('success'))
                            <div role="alert" class="alert alert-success mb-2 mt-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>{{session('success')}}</span>
                            </div>
                        @endif

                        <!-- Table Section -->
                        <div class="mt-6 rounded-xl border border-gray-200 shadow-lg overflow-hidden">
                            <!-- Header -->
                            <div class="bg-blue-900 text-white px-6 py-4 flex justify-between items-center">
                                <h2 class="text-lg font-semibold">Billing Fee</h2>
                                <button class="btn btn-primary "
                                    onclick="document.getElementById('addFeeModal').showModal()">
                                    <i class="fa-solid fa-plus mr-1"></i> Add New Fee
                                </button>
                            </div>

                            <!-- Table -->
                            <div class="overflow-x-auto">
                                <table class="table w-full text-sm">
                                    <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                                        <tr>
                                            <th class="px-4 py-3 text-left">#</th>
                                            <th class="px-4 py-3 text-left">Fee Name</th>
                                            <th class="px-4 py-3 text-left">Amount / Rate</th>
                                            <th class="px-4 py-3 text-left">Description</th>
                                            <th class="px-4 py-3 text-left">Date Updated</th>
                                            <th class="px-4 py-3 text-left">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @forelse($feedata as $fee)
                                            <tr class="hover:bg-gray-50 transition">
                                                <td class="px-4 py-3 font-medium">#{{$fee->dynamic_billingID }}</td>
                                                <td class="px-4 py-3 font-semibold text-gray-800">
                                                    {{ $fee->dynamic_name }}
                                                </td>
                                                <td class="px-4 py-3">
                                                    {{$fee->dynamic_price}}
                                                </td>
                                                <td class="px-4 py-3 text-gray-600">
                                                    {{ $fee->dynamic_billing_description ?? 'No description provided.' }}
                                                </td>
                                                <td class="px-4 py-3 text-gray-500 text-xs">
                                                    {{ \Carbon\Carbon::parse($fee->updated_at)->format('M d, Y') }}
                                                </td>
                                                <td class="px-4 py-3">
                                                    <button class="btn btn-primary btn-xs"
                                                        onclick="document.getElementById('editFeeModal_{{$fee->dynamic_billingID}}').showModal()">
                                                        <i class="fa-solid fa-pen"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center py-6 text-gray-500">No fee records found.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>



                        <!-- Edit Fee Modal -->


                    </section>





            </div>




            <!-- Initialize Lucide Icons -->
            <script>
                lucide.createIcons();
            </script>







            </main>
        </div>
        </div>


        {{-- modals --}}
        @include('admin.components.billing.create')

        @foreach ($feedata as $fee)
            @include('admin.components.billing.edit')
        @endforeach


        @livewireScripts
        @include('javascriptfix.soliera_js')
    </body>
@endauth



</html>