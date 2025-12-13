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

    <title>{{$title}} - Report Employee</title>
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
                            <h1 class="text-2xl font-bold bg-white bg-clip-text text-[#191970]">Report Employee</h1>
                        </div>
                        {{-- Subsystem Name --}}
                        <section class="flex-1 p-6">

                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-8">
                                <!-- Total Employees -->
                                <div class="stat bg-base-100 shadow rounded-box hover:shadow-lg transition-shadow duration-200">
                                    <div class="stat-figure">
                                        <div class="w-12 h-12 flex items-center justify-center rounded-full bg-blue-900">
                                            <i class="fas fa-users text-yellow-400 text-xl"></i>
                                        </div>
                                    </div>
                                    <div class="stat-title text-black">Total Employees</div>
                                    <div class="stat-value text-black">{{ $totalemp }}</div>
                                    <div class="stat-desc text-black">All staff</div>
                                </div>

                                <!-- AWOL Reports -->
                                <div class="stat bg-base-100 shadow rounded-box hover:shadow-lg transition-shadow duration-200">
                                    <div class="stat-figure">
                                        <div class="w-12 h-12 flex items-center justify-center rounded-full bg-blue-900">
                                            <i class="fas fa-exclamation-triangle text-yellow-400 text-xl"></i>
                                        </div>
                                    </div>
                                    <div class="stat-title text-black"> Reports</div>
                                    <div class="stat-value text-black">{{ $reportscount }}</div>
                                     <div class="stat-desc text-black">Total Reports</div>
                                </div>

                                <!-- Active -->
                                <div class="stat bg-base-100 shadow rounded-box hover:shadow-lg transition-shadow duration-200">
                                    <div class="stat-figure">
                                        <div class="w-12 h-12 flex items-center justify-center rounded-full bg-blue-900">
                                            <i class="fas fa-user-check text-yellow-400 text-xl"></i>
                                        </div>
                                    </div>
                                    <div class="stat-title text-black">Active</div>
                                    <div class="stat-value text-black">{{ $active }}</div>
                                    <div class="stat-desc text-black">On duty</div>
                                </div>

                                <!-- Pending HR Action -->
                                <div class="stat bg-base-100 shadow rounded-box hover:shadow-lg transition-shadow duration-200">
                                    <div class="stat-figure">
                                        <div class="w-12 h-12 flex items-center justify-center rounded-full bg-blue-900">
                                            <i class="fas fa-hourglass-half text-yellow-400 text-xl"></i>
                                        </div>
                                    </div>
                                    <div class="stat-title text-black">Pending HR Action</div>
                                    <div class="stat-value text-black">{{ $awaiting }}</div>
                                    <div class="stat-desc text-black">Awaiting review</div>
                                </div>
                            </div>


                            @if(session('success'))
                                <div id="successMessage" class="alert alert-success shadow-lg fixed top-5 right-5 w-96 z-50">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span>{{ session('success') }}</span>
                                    </div>
                                </div>
                            @endif

                            <script>
                                document.addEventListener('DOMContentLoaded', () => {
                                    const successMessage = document.getElementById('successMessage');
                                    if (successMessage) {
                                        setTimeout(() => {
                                            successMessage.classList.add('opacity-0', 'transition', 'duration-500');
                                            setTimeout(() => successMessage.remove(), 500); // remove after fade out
                                        }, 3000); // 3 seconds
                                    }
                                });
                            </script>


                            <div class="card bg-base-100 shadow-xl mt-8">
                                <div class="card-body">
                                    <div class=" mb-4">

                                        <button class="btn btn-error" onclick="employeeReportModal.showModal()">+ Report Employee</button>
                                    </div>


                                    <div class="overflow-x-auto">
                                        <h2 class="text-xl font-bold mb-4 text-error">
                                            Employee Report List
                                        </h2>

                                        <table class="table table-zebra w-full text-sm">
                                            <thead class="bg-blue-900 text-white">
                                                <tr>
                                                    <th>Report ID</th>
                                                    <th>Employee ID</th>
                                                    <th>Employee Name</th>
                                                    <th>Department</th>
                                                    <th>Position</th>
                                                    <th>Status</th>
                                                    <th>Date Reported</th>
                                                    <th class="text-center">Actions</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @forelse ($reports as $report)
                                                    <tr>
                                                        <td class="font-semibold text-primary">
                                                            {{ $report->report_code }}
                                                        </td>

                                                        <td>{{ $report->employee_id }}</td>

                                                        <td>{{ $report->employee_name }}</td>

                                                        <td>{{ $report->department }}</td>

                                                        <td>{{ $report->position }}</td>

                                                        <td>
                                                            <span class="badge
                                                                    {{ $report->status === 'Pending' ? 'badge-warning' : 'badge-success' }}">
                                                                {{ $report->status }}
                                                            </span>
                                                        </td>

                                                        <td>
                                                            {{ $report->created_at->diffForHumans() }}
                                                        </td>

                                                        <td class="flex gap-2 justify-center">
                                                            <button class="btn btn-xs btn-outline"
                                                                onclick="document.getElementById('viewreport_{{ $report->reportID }}').showModal()">
                                                                View
                                                            </button>

                                                            <button class="btn btn-xs btn-error"
                                                                onclick="document.getElementById('deletereport_{{ $report->reportID }}').showModal()">
                                                                Delete
                                                            </button>
                                                        </td>
                                                    </tr>


                                                @empty
                                                    <tr>
                                                        <td colspan="8" class="text-center text-gray-500 py-6">
                                                            No employee reports available.
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>



                </div>
                </section>

                <!-- Initialize Lucide -->
                <script>
                    lucide.createIcons();
                </script>


                {{-- modals --}}

                @foreach ($reports as $report)
                    @include('admin.components.requesition.viewreport')
                    @include('admin.components.requesition.removereport')
                @endforeach



            </div>











            </main>
            </div>
            </div>


            {{-- modals --}}

            @include('admin.components.requesition.addreport')


            @livewireScripts
            @include('javascriptfix.soliera_js')
        </body>
@endauth



</html>