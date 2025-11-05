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
            <h1 class="text-2xl font-bold bg-white bg-clip-text text-[#191970]">Department Audit Trails And Transactions
            </h1>
          </div>
          {{-- Subsystem Name --}}

          <section class="flex-1 p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

              <!-- Total Logs -->
              <div
                class="bg-white rounded-xl border border-transparent p-6 shadow-lg transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-blue-500 group">
                <div class="flex items-center justify-between">
                  <div>
                    <h3
                      class="text-sm font-semibold text-gray-600 uppercase tracking-wide group-hover:text-blue-700 transition-colors">
                      Total Logs</h3>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalLogs }}</p>
                    <span class="text-sm text-gray-500 group-hover:text-blue-600 transition-colors">All Departments</span>
                  </div>
                  <div
                    class="w-16 h-16 flex items-center justify-center bg-blue-900 rounded-xl group-hover:bg-orange-500 transition-colors duration-300">
                    <i class="fa-solid fa-database text-yellow-400 text-3xl group-hover:text-white"></i>
                  </div>
                </div>
              </div>

              <!-- Front Desk -->
              <div
                class="bg-white rounded-xl border border-transparent p-6 shadow-lg transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-blue-400 group">
                <div class="flex items-center justify-between">
                  <div>
                    <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wide group-hover:text-blue-700">
                      Front Desk
                    </h3>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $moduleCounts['Front Desk And Reception'] ?? 0 }}
                    </p>
                    <span class="text-sm text-gray-500 group-hover:text-blue-600">Reception Logs</span>
                  </div>
                  <div
                    class="w-16 h-16 flex items-center justify-center bg-blue-900 rounded-xl group-hover:bg-orange-500 transition-colors duration-300">
                    <i class="fa-solid fa-desktop text-yellow-400 text-3xl group-hover:text-white"></i>
                  </div>
                </div>
              </div>

              <!-- Booking & Reservation -->
              <div
                class="bg-white rounded-xl border border-transparent p-6 shadow-lg transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-blue-400 group">
                <div class="flex items-center justify-between">
                  <div>
                    <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wide group-hover:text-blue-700">
                      Booking &
                      Reservation</h3>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $moduleCounts['Booking And Reservation'] ?? 0 }}
                    </p>
                    <span class="text-sm text-gray-500 group-hover:text-blue-600">Room Bookings</span>
                  </div>
                  <div
                    class="w-16 h-16 flex items-center justify-center bg-blue-900 rounded-xl group-hover:bg-orange-500 transition-colors duration-300">
                    <i class="fa-solid fa-calendar-check text-yellow-400 text-3xl group-hover:text-white"></i>
                  </div>
                </div>
              </div>

              <!-- Room Management -->
              <div
                class="bg-white rounded-xl border border-transparent p-6 shadow-lg transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-blue-400 group">
                <div class="flex items-center justify-between">
                  <div>
                    <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wide group-hover:text-blue-700">Room
                      Management</h3>
                    <p class="text-3xl font-bold text-gray-900 mt-2">
                      {{ $moduleCounts['Room Management And Service'] ?? 0 }}
                    </p>
                    <span class="text-sm text-gray-500 group-hover:text-blue-600">Room Logs</span>
                  </div>
                  <div
                    class="w-16 h-16 flex items-center justify-center bg-blue-900 rounded-xl group-hover:bg-orange-500 transition-colors duration-300">
                    <i class="fa-solid fa-door-open text-yellow-400 text-3xl group-hover:text-white"></i>
                  </div>
                </div>
              </div>

              <!-- Housekeeping -->
              <div
                class="bg-white rounded-xl border border-transparent p-6 shadow-lg transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-blue-400 group">
                <div class="flex items-center justify-between">
                  <div>
                    <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wide group-hover:text-blue-700">
                      Housekeeping
                    </h3>
                    <p class="text-3xl font-bold text-gray-900 mt-2">
                      {{ $moduleCounts['Housekeeping And Maintenance'] ?? 0 }}
                    </p>
                    <span class="text-sm text-gray-500 group-hover:text-blue-600">Cleaning & Repairs</span>
                  </div>
                  <div
                    class="w-16 h-16 flex items-center justify-center bg-blue-900 rounded-xl group-hover:bg-orange-500 transition-colors duration-300">
                    <i class="fa-solid fa-broom text-yellow-400 text-3xl group-hover:text-white"></i>
                  </div>
                </div>
              </div>

              <!-- Inventory & Stocks -->
              <div
                class="bg-white rounded-xl border border-transparent p-6 shadow-lg transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-blue-400 group">
                <div class="flex items-center justify-between">
                  <div>
                    <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wide group-hover:text-blue-700">
                      Inventory &
                      Stocks</h3>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $moduleCounts['Inventory And Stocks'] ?? 0 }}</p>
                    <span class="text-sm text-gray-500 group-hover:text-blue-600">Stock Records</span>
                  </div>
                  <div
                    class="w-16 h-16 flex items-center justify-center bg-blue-900 rounded-xl group-hover:bg-orange-500 transition-colors duration-300">
                    <i class="fa-solid fa-box-open text-yellow-400 text-3xl group-hover:text-white"></i>
                  </div>
                </div>
              </div>

              <!-- Events & Conference -->
              <div
                class="bg-white rounded-xl border border-transparent p-6 shadow-lg transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-blue-400 group">
                <div class="flex items-center justify-between">
                  <div>
                    <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wide group-hover:text-blue-700">
                      Events &
                      Conference</h3>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $moduleCounts['Event And Conference'] ?? 0 }}</p>
                    <span class="text-sm text-gray-500 group-hover:text-blue-600">Event Logs</span>
                  </div>
                  <div
                    class="w-16 h-16 flex items-center justify-center bg-blue-900 rounded-xl group-hover:bg-orange-500 transition-colors duration-300">
                    <i class="fa-solid fa-calendar-days text-yellow-400 text-3xl group-hover:text-white"></i>
                  </div>
                </div>
              </div>

              <!-- Hotel Marketing -->
              <div
                class="bg-white rounded-xl border border-transparent p-6 shadow-lg transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-blue-400 group">
                <div class="flex items-center justify-between">
                  <div>
                    <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wide group-hover:text-blue-700">
                      Hotel
                      Marketing</h3>
                    <p class="text-3xl font-bold text-gray-900 mt-2">
                      {{ $moduleCounts['Hotel Marketing And Promotion'] ?? 0 }}
                    </p>
                    <span class="text-sm text-gray-500 group-hover:text-blue-600">Promo Logs</span>
                  </div>
                  <div
                    class="w-16 h-16 flex items-center justify-center bg-blue-900 rounded-xl group-hover:bg-orange-500 transition-colors duration-300">
                    <i class="fa-solid fa-bullhorn text-yellow-400 text-3xl group-hover:text-white"></i>
                  </div>
                </div>
              </div>

              <!-- Channel Management -->
              <div
                class="bg-white rounded-xl border border-transparent p-6 shadow-lg transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-blue-400 group">
                <div class="flex items-center justify-between">
                  <div>
                    <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wide group-hover:text-blue-700">
                      Channel
                      Management</h3>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $moduleCounts['Channel Management'] ?? 0 }}</p>
                    <span class="text-sm text-gray-500 group-hover:text-blue-600">Channel Logs</span>
                  </div>
                  <div
                    class="w-16 h-16 flex items-center justify-center bg-blue-900 rounded-xl group-hover:bg-orange-500 transition-colors duration-300">
                    <i class="fa-solid fa-share-nodes text-yellow-400 text-3xl group-hover:text-white"></i>
                  </div>
                </div>
              </div>

              <!-- Guest Relationship -->
              <div
                class="bg-white rounded-xl border border-transparent p-6 shadow-lg transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-blue-400 group">
                <div class="flex items-center justify-between">
                  <div>
                    <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wide group-hover:text-blue-700">
                      Guest
                      Relationship</h3>
                    <p class="text-3xl font-bold text-gray-900 mt-2">
                      {{ $moduleCounts['Guest Relationship Management'] ?? 0 }}
                    </p>
                    <span class="text-sm text-gray-500 group-hover:text-blue-600">Feedback & Loyalty</span>
                  </div>
                  <div
                    class="w-16 h-16 flex items-center justify-center bg-blue-900 rounded-xl group-hover:bg-orange-500 transition-colors duration-300">
                    <i class="fa-solid fa-users text-yellow-400 text-3xl group-hover:text-white"></i>
                  </div>
                </div>
              </div>

            </div>




            <!-- Static Table -->
            <div class="mt-6 rounded-xl border border-gray-200 shadow-lg overflow-hidden">
              <!-- Header -->
              <div class="bg-blue-900 text-white px-6 py-4">
                <h2 class="text-lg font-semibold">Audit Trails and Transactions</h2>
              </div>

              <!-- Filters -->
              <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                <form method="GET" action="{{ url('/audittrails') }}" class="flex flex-wrap items-center gap-3">

                  <!-- Search -->
                  <div class="relative">
                    <i
                      class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                    <input type="text" name="search" value="{{ request('search') }}"
                      placeholder="Search employee, action, or module..."
                      class="input input-bordered input-sm pl-9 w-64" />
                  </div>

                  <!-- Category -->
                  <select name="filter" class="select select-bordered select-sm w-52">
                    <option value="">All Categories</option>
                    @foreach ($categories as $category)
                      <option value="{{ $category }}" @selected(request('filter') == $category)>
                        {{ $category }}
                      </option>
                    @endforeach
                  </select>

                  <!-- Buttons -->
                  <div class="flex gap-2 ml-auto">
                    <button type="submit" class="btn btn-primary btn-sm">
                      <i class="fa-solid fa-filter mr-1"></i> Apply
                    </button>

                    @if(request('search') || request('filter'))
                      <a href="{{ url('/audittrails') }}" class="btn btn-ghost btn-sm">
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
                      <th class="px-4 py-3 text-left">Module</th>
                      <th class="px-4 py-3 text-left">Employee</th>
                      <th class="px-4 py-3 text-left">Action</th>
                      <th class="px-4 py-3 text-left">Description</th>
                      <th class="px-4 py-3 text-left">Date</th>
                      <th class="px-4 py-3 text-left">Action</th>
                    </tr>
                  </thead>
                  <tbody class="divide-y divide-gray-200">
                    @forelse ($audittrails as $audit)
                      <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3 font-medium">#{{ $audit->at_id }}</td>
                        <td class="px-4 py-3">{{ $audit->modules_cover }}</td>
                        <td class="px-4 py-3">
                          <div class="flex items-center gap-3">
                            <div class="avatar">
                              @php
                                // Get the employee's photo from relationship (if exists)
                                $photo = $audit->deptAccount->additionalInfo->adminphoto ?? null;
                                // Generate initials if no photo
                                $initials = strtoupper(substr($audit->employee_name, 0, 2));
                              @endphp

                              @if ($photo)
                                <div class="h-10 w-10 rounded-full overflow-hidden shadow-md">
                                  <img src="{{ asset( $photo) }}" alt="Employee Photo"
                                    class="object-cover w-full h-full">
                                </div>
                              @else
                                <div class="h-10 w-10 rounded-full bg-blue-900 flex items-center justify-center shadow-md">
                                  <span class="text-white font-bold text-sm flex items-center justify-center w-full h-full">
                                    {{ $initials }}
                                  </span>
                                </div>
                              @endif
                            </div>

                            <div class="flex flex-col justify-center">
                              <div class="font-semibold text-gray-800 leading-tight">
                                {{ $audit->employee_name }}
                              </div>
                              <div class="text-xs text-gray-500">{{ $audit->employee_id }}</div>
                            </div>
                          </div>
                        </td>
                        <td class="px-4 py-3">{{ $audit->action }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ $audit->activity }}</td>
                        <td class="px-4 py-3">
                          {{ \Carbon\Carbon::parse($audit->date)->format('Y-m-d H:i') }}
                          <span class="text-xs text-gray-500 block">
                            ({{ \Carbon\Carbon::parse($audit->date)->diffForHumans() }})
                          </span>
                        </td>
                        <td>
                          <button class="btn btn-primary btn-xs"
                            onclick="document.getElementById('viewAuditModal_{{ $audit->at_id }}').showModal()">
                            <i class="fa-solid fa-eye"></i>
                          </button>
                        </td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="6" class="py-10 text-center text-gray-500">
                          <div class="flex flex-col items-center justify-center space-y-2">
                            <i class="fa-solid fa-file-circle-xmark text-4xl text-gray-400"></i>
                            <p class="text-lg font-medium">
                              No logs found {{ request('filter') ? 'for ' . request('filter') : '' }}
                            </p>
                            <p class="text-sm text-gray-400">Audit logs will appear here once available.</p>
                          </div>
                        </td>
                      </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>

              <!-- Pagination -->
              <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                {{ $audittrails->links('pagination::tailwind') }}
              </div>
            </div>




          </section>



          <!-- Graph Section -->




      </div>

      {{-- modals --}}

      @foreach ($audittrails as $audit)
        @include('admin.components.audit.view')
      @endforeach


      <!-- Initialize Lucide Icons -->
      <script>
        lucide.createIcons();
      </script>







      </main>
    </div>
    </div>




    @livewireScripts
    @include('javascriptfix.soliera_js')
  </body>
@endauth



</html>