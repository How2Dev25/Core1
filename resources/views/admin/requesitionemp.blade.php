<!DOCTYPE html>
<html lang="en" data-theme ="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

 
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <title>{{$title}} - Request Manpower</title>
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
                <h1 class="text-2xl font-bold bg-white bg-clip-text text-[#191970]">Request Manpower</h1>
              </div>
                {{-- Subsystem Name --}}
                <section class="flex-1 p-6">

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-8">
                        <!-- Total Requests -->
                        <div class="stat bg-base-100 shadow rounded-box hover:shadow-lg transition-shadow duration-200">
                            <div class="stat-figure">
                                <div class="w-12 h-12 flex items-center justify-center rounded-full bg-blue-900">
                                    <i class="fas fa-file-alt text-yellow-400 text-xl"></i>
                                </div>
                            </div>
                            <div class="stat-title text-black">Total Requests</div>
                            <div class="stat-value text-black">{{ $totalreq }}</div>
                            <div class="stat-desc text-black">This month</div>
                        </div>

                        <!-- Pending -->
                        <div class="stat bg-base-100 shadow rounded-box hover:shadow-lg transition-shadow duration-200">
                            <div class="stat-figure">
                                <div class="w-12 h-12 flex items-center justify-center rounded-full bg-blue-900">
                                    <i class="fas fa-clock text-yellow-400 text-xl"></i>
                                </div>
                            </div>
                            <div class="stat-title text-black">Pending</div>
                            <div class="stat-value text-black">{{ $pendingreq }}</div>
                            <div class="stat-desc text-black">Awaiting HR</div>
                        </div>

                        <!-- Approved -->
                        <div class="stat bg-base-100 shadow rounded-box hover:shadow-lg transition-shadow duration-200">
                            <div class="stat-figure">
                                <div class="w-12 h-12 flex items-center justify-center rounded-full bg-blue-900">
                                    <i class="fas fa-check-circle text-yellow-400 text-xl"></i>
                                </div>
                            </div>
                            <div class="stat-title text-black">Approved</div>
                            <div class="stat-value text-black">{{ $approvereq }}</div>
                            <div class="stat-desc text-black">Sent to HR</div>
                        </div>

                        <!-- Rejected -->
                        <div class="stat bg-base-100 shadow rounded-box hover:shadow-lg transition-shadow duration-200">
                            <div class="stat-figure">
                                <div class="w-12 h-12 flex items-center justify-center rounded-full bg-blue-900">
                                    <i class="fas fa-times-circle text-yellow-400 text-xl"></i>
                                </div>
                            </div>
                            <div class="stat-title text-black">Rejected</div>
                            <div class="stat-value text-black">{{ $rejectreq }}</div>
                            <div class="stat-desc text-black">Returned</div>
                        </div>
                    </div>


                    <div class="mt-5">
                        <button onclick="document.getElementById('manpowerModal').showModal()" class="btn btn-primary">Request Manpower</button>
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
                            <div class="overflow-x-auto">
                                <table class="table ">
                                    <thead class="bg-blue-900 text-white">
                                        <tr>
                                            <th>#</th>
                                            <th>Department</th>
                                            <th>Position</th>
                                            <th>Number of People</th>
                                            <th>Reason</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    @forelse ($requestemp as $request)
                                        <tr>
                                            <th>{{ $request->request_id }}</th>
                                            <td>{{ $request->department }}</td>
                                            <td>{{ $request->position }}</td>
                                            <td>{{ $request->quantity }}</td>
                                            <td>{{ $request->reason }}</td>
                                            <td><span class="badge badge-warning">{{ $request->status }}</span></td>
                                            <td>{{ $request->created_at->diffForHumans() }}</td> 
                                            <td class="flex flex-col gap-2">
                                                <button onclick="document.getElementById('viewmanpower_{{ $request->requestempID }}').showModal()" class="btn btn-xs btn-outline">View</button>
                                                <button onclick="document.getElementById('removemanpower_{{ $request->requestempID }}').showModal()"  class="btn btn-xs btn-error">Delete</button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center text-gray-500 py-4">
                                                No manpower requests found.
                                            </td>
                                        </tr>
                                    @endforelse






                                    </tbody>
                                </table>
                            </div>


                        </div>
                        </div>
                </section>

    <!-- Initialize Lucide -->
    <script>
      lucide.createIcons();
    </script>


        {{-- modals --}}
    @foreach ($requestemp as $request )
    @include('admin.components.requesition.viewrequest')
    @include('admin.components.requesition.removerequest')
    @endforeach
    

        </div>











            </main>
          </div>
        </div>


        {{-- modals --}}

        @include('admin.components.requesition.addrequest')


       @livewireScripts
      @include('javascriptfix.soliera_js')
      </body>
@endauth


  
</html>