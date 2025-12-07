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

  <title>{{$title}} - Front Desk And Reception</title>
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
            <h1 class="text-2xl font-bold bg-white bg-clip-text text-[#191970]">Department Logs</h1>
          </div>
          {{-- Subsystem Name --}}

          <section class="flex-1 p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

              <!-- Total Logs -->
              <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
                <div class="flex items-center justify-between">
                  <div>
                    <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Total Logs</h3>
                    <p class="text-3xl font-bold text-gray-800 mt-2">{{$totallogs}}</p>
                    <div class="flex items-center mt-3">
                      <span class="text-sm font-medium text-gray-500">DeptLogs Records</span>
                    </div>
                  </div>
                  <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
                    <i class="fa-solid fa-database text-yellow-400 text-2xl"></i>
                  </div>
                </div>
              </div>

              <!-- Successful Logs -->
              <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
                <div class="flex items-center justify-between">
                  <div>
                    <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Successful Logs</h3>
                    <p class="text-3xl font-bold text-gray-800 mt-2">{{$successfullogs}}</p>
                    <div class="flex items-center mt-3">
                      <span class="text-sm font-medium text-gray-500">Logins & Activity</span>
                    </div>
                  </div>
                  <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
                    <i class="fa-solid fa-check-circle text-yellow-400 text-2xl"></i>
                  </div>
                </div>
              </div>

              <!-- Failed Logs -->
              <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
                <div class="flex items-center justify-between">
                  <div>
                    <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Failed Logs</h3>
                    <p class="text-3xl font-bold text-gray-800 mt-2">{{$failedlogs}}</p>
                    <div class="flex items-center mt-3">
                      <span class="text-sm font-medium text-gray-500">Attempts / Errors</span>
                    </div>
                  </div>
                  <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
                    <i class="fa-solid fa-times-circle text-yellow-400 text-2xl"></i>
                  </div>
                </div>
              </div>

            </div>

            <!-- Table -->
            <div class="mt-6 rounded-xl border border-gray-200 shadow-lg overflow-hidden">
              <!-- Header -->
              <div class="bg-blue-900 text-white px-6 py-4">
                <h2 class="text-lg font-semibold">Department Logs</h2>
              </div>

              <!-- Filters -->
              <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                <form method="GET" action="{{ url('/departmentlogs') }}" class="flex flex-wrap items-center gap-3">

                  <!-- Search -->
                  <div class="relative">
                    <i
                      class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                    <input type="text" name="search" value="{{ request('search') }}"
                      placeholder="Search employee or ID..." class="input input-bordered input-sm pl-9 w-64" />
                  </div>

                  <!-- Status -->
                  <select name="status" class="select select-bordered select-sm w-36">
                    <option value="">All Status</option>
                    <option value="Success" @selected(request('status') == 'Success')> Success</option>
                    <option value="Failed" @selected(request('status') == 'Failed')> Failed</option>
                  </select>

                  <!-- Type -->
                  <select name="type" class="select select-bordered select-sm w-36">
                    <option value="">All Types</option>
                    <option value="Login" @selected(request('type') == 'Login')> Login</option>
                    <option value="Logout" @selected(request('type') == 'Logout')> Logout</option>
                  </select>

                  <!-- Buttons -->
                  <div class="flex gap-2 ml-auto">
                    <button type="submit" class="btn btn-primary btn-sm">
                      <i class="fa-solid fa-filter mr-1"></i> Apply
                    </button>

                    @if(request('search') || request('status') || request('type'))
                      <a href="{{ url('/departmentlogs') }}" class="btn btn-ghost btn-sm">
                        <i class="fa-solid fa-rotate-left mr-1"></i> Clear
                      </a>
                    @endif
                  </div>
                </form>
              </div>

              <!-- Table -->
              <div class="overflow-x-auto">
                <table class="table w-full text-sm">
                  <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                    <tr>
                      <th class="px-4 py-3 text-left">Log ID</th>
                      <th class="px-4 py-3 text-left">Department</th>
                      <th class="px-4 py-3 text-left">Employee</th>
                      <th class="px-4 py-3 text-left">Role & Type</th>
                      <th class="px-4 py-3 text-left">Status</th>
                      <th class="px-4 py-3 text-left">Date</th>
                      <th class="px-4 py-3 text-left">Actions</th>
                    </tr>
                  </thead>
                  <tbody class="divide-y divide-gray-200">
                    @forelse ($deptlogs as $deptlog)
                      <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3 font-medium">#{{ $deptlog->dept_logs_id }}</td>
                        <td class="px-4 py-3">{{ $deptlog->dept_id }}</td>
                        <td class="px-4 py-3">
                          <div class="flex items-center gap-3">
                            <div class="avatar">
                              @php
                                $photo = $deptlog->deptAccount->additionalInfo->adminphoto ?? null;
                                $initials = strtoupper(substr($deptlog->employee_name, 0, 2));
                              @endphp

                              @if ($photo)
                                <div class="h-10 w-10 rounded-full overflow-hidden shadow-md">
                                  <img src="{{ asset($photo) }}" alt="Profile Photo" class="object-cover w-full h-full">
                                </div>
                              @else
                                <div class="h-10 w-10 rounded-full bg-blue-900 flex items-center justify-center shadow-md">
                                  <span class="text-white font-bold text-sm flex items-center justify-center w-full h-full">
                                    {{ $initials }}
                                  </span>
                                </div>
                              @endif
                            </div>

                            <div>
                              <div class="font-semibold text-gray-800">{{ $deptlog->employee_name }}</div>
                              <div class="text-xs text-gray-500">{{ $deptlog->employee_id }}</div>
                            </div>
                          </div>
                        </td>
                        <td class="px-4 py-3">
                          <div class="text-gray-700">{{ $deptlog->role }}</div>
                          <span class="badge badge-outline badge-sm mt-1">{{ $deptlog->log_type }}</span>
                        </td>
                        <td class="px-4 py-3">
                          @if ($deptlog->log_status === 'Success')
                            <span class="px-2 py-1 inline-flex items-center rounded-full text-white text-xs bg-green-500">
                              <i class="fa-solid fa-circle-check mr-1"></i> {{ $deptlog->log_status }}
                            </span>
                          @elseif ($deptlog->log_status === 'Failed')
                            <span class="px-2 py-1 inline-flex items-center rounded-full text-white text-xs bg-red-500">
                              <i class="fa-solid fa-circle-xmark mr-1"></i> {{ $deptlog->log_status }}
                            </span>
                          @else
                            <span class="px-2 py-1 inline-flex items-center rounded-full text-white text-xs bg-yellow-500">
                              <i class="fa-solid fa-triangle-exclamation mr-1"></i> {{ $deptlog->log_status }}
                            </span>
                          @endif
                        </td>
                        <td class="px-4 py-3">{{ $deptlog->date }}</td>
                        <td class="px-4 py-3">
                          <button class="btn btn-primary btn-xs"
                            onclick="document.getElementById('logModal_{{$deptlog->dept_logs_id}}').showModal()">
                            <i class="fa-solid fa-eye"></i>
                          </button>
                        </td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="7" class="py-10 text-center text-gray-500">
                          <div class="flex flex-col items-center justify-center space-y-2">
                            <i class="fa-solid fa-file-circle-xmark text-4xl text-gray-400"></i>
                            <p class="text-lg font-medium">No logs found</p>
                            <p class="text-sm text-gray-400">Activity logs will appear here once available.</p>
                          </div>
                        </td>
                      </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>

              <!-- Pagination -->
              <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                {{ $deptlogs->links('pagination::tailwind') }}
              </div>
            </div>

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


    @foreach ($deptlogs as $deptlog)
      @include('admin.components.deptlogs.view')

    @endforeach



    @livewireScripts
    @include('javascriptfix.soliera_js')
  </body>
@endauth



</html>