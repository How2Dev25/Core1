<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  @vite('resources/css/app.css')

  <script src="https://unpkg.com/lucide@latest"></script>

  <title>{{$title}} - Door Lock</title>
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
            <h1 class="text-2xl font-bold text-[#191970] bg-clip-text ">Door Lock Integration</h1>
          </div>
          {{-- Subsystem Name --}}


          <!-- content -->
          <section class="p-4 md:p-8 mt-5 max-w-7xl mx-auto">

            <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">

            <!-- Card 1 - Total Keycard -->
            <div
                class="relative overflow-hidden bg-gradient-to-br from-blue-50 to-white shadow-md border border-blue-200 rounded-xl transition-all duration-300 hover:shadow-xl hover:-translate-y-1 group">
                <div class="absolute top-0 right-0 w-24 h-24 bg-blue-600 rounded-bl-full opacity-5"></div>

                <div class="p-6 relative z-10">
                    <div class="flex items-center gap-3 mb-4">
                        <div
                            class="p-3 rounded-xl bg-blue-900 text-yellow-400 text-2xl shadow-md transition-all duration-300 group-hover:scale-110">
                            <i class="fa-solid fa-key"></i>
                        </div>
                        <div>
                            <h3 class="text-base font-semibold text-gray-800">Total Keycard</h3>
                            <p class="text-xs text-gray-500">All keycards</p>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-gray-800">120</p>
                </div>
            </div>

            <!-- Card 2 - Assigned Keycard -->
            <div
                class="relative overflow-hidden bg-gradient-to-br from-blue-50 to-white shadow-md border border-blue-200 rounded-xl transition-all duration-300 hover:shadow-xl hover:-translate-y-1 group">
                <div class="absolute top-0 right-0 w-24 h-24 bg-blue-600 rounded-bl-full opacity-5"></div>

                <div class="p-6 relative z-10">
                    <div class="flex items-center gap-3 mb-4">
                        <div
                            class="p-3 rounded-xl bg-blue-900 text-yellow-400 text-2xl shadow-md transition-all duration-300 group-hover:scale-110">
                            <i class="fa-solid fa-id-badge"></i>
                        </div>
                        <div>
                            <h3 class="text-base font-semibold text-gray-800">Assigned Keycard</h3>
                            <p class="text-xs text-gray-500">Keycards assigned to room</p>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-gray-800">74</p>
                </div>
            </div>

            <!-- Card 3 - Active Keycard -->
            <div
                class="relative overflow-hidden bg-gradient-to-br from-blue-50 to-white shadow-md border border-blue-200 rounded-xl transition-all duration-300 hover:shadow-xl hover:-translate-y-1 group">
                <div class="absolute top-0 right-0 w-24 h-24 bg-blue-600 rounded-bl-full opacity-5"></div>

                <div class="p-6 relative z-10">
                    <div class="flex items-center gap-3 mb-4">
                        <div
                            class="p-3 rounded-xl bg-blue-900 text-yellow-400 text-2xl shadow-md transition-all duration-300 group-hover:scale-110">
                            <i class="fa-solid fa-unlock"></i>
                        </div>
                        <div>
                            <h3 class="text-base font-semibold text-gray-800">Active Keycard</h3>
                            <p class="text-xs text-gray-500">Currently active</p>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-gray-800">58</p>
                </div>
            </div>

            <!-- Card 4 - Inactive Keycard -->
            <div
                class="relative overflow-hidden bg-gradient-to-br from-blue-50 to-white shadow-md border border-blue-200 rounded-xl transition-all duration-300 hover:shadow-xl hover:-translate-y-1 group">
                <div class="absolute top-0 right-0 w-24 h-24 bg-blue-600 rounded-bl-full opacity-5"></div>

                <div class="p-6 relative z-10">
                    <div class="flex items-center gap-3 mb-4">
                        <div
                            class="p-3 rounded-xl bg-blue-900 text-yellow-400 text-2xl shadow-md transition-all duration-300 group-hover:scale-110">
                            <i class="fa-solid fa-lock"></i>
                        </div>
                        <div>
                            <h3 class="text-base font-semibold text-gray-800">Inactive Keycard</h3>
                            <p class="text-xs text-gray-500">Disabled or inactive</p>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-gray-800">16</p>
                </div>
            </div>

        </div>


            <!-- Success Alert -->
            @if(session('success'))
              <div class="flex items-center gap-3 p-4 mb-6 bg-green-50 border border-green-200 rounded-lg shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600 flex-shrink-0" fill="none"
                  viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-green-800 font-medium">{{ session('success') }}</span>
              </div>
            @endif

           


          <div class="mt-5">
          <div class="container mx-auto px-4 py-6">
            <!-- Header Section -->
            <div class="mb-6 flex justify-between items-center">
              <div>
                <h2 class="text-2xl font-bold text-gray-800">Door Lock Management</h2>
                <p class="text-gray-600 text-sm mt-1">Manage your RFID-enabled door locks</p>
              </div>
              <button onclick="roomModal.showModal()" class="btn btn-primary gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add Doorlock
              </button>
            </div>

            <!-- Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
              @forelse ($doorlocks as $doorlock)
                <div class="card bg-base-100 shadow-xl border border-gray-200 hover:shadow-2xl transition-shadow duration-300">
                  <div class="card-body p-6">
                    <!-- Header with Status -->
                    <div class="flex items-start justify-between mb-4">
                      <div class="flex-1">
                        <h3 class="card-title text-xl font-bold text-gray-800">Room {{ $doorlock->roomID }}</h3>
                        <p class="text-sm text-gray-500 mt-1">Lock ID: #{{ $doorlock->doorlockID }}</p>
                      </div>
                      <div
                        class="badge {{ $doorlock->doorlock_status == 'Active' ? 'badge-success' : 'badge-error' }} badge-lg gap-2">
                        <span class="w-2 h-2 rounded-full bg-white"></span>
                        {{ ucfirst($doorlock->doorlock_status) }}
                      </div>
                    </div>

                    <!-- RFID Section -->
                    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 p-4 rounded-xl mb-4 border border-blue-100">
                      <div class="flex items-start gap-3">
                        <div class="bg-blue-500 p-2 rounded-lg">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                          </svg>
                        </div>
                        <div class="flex-1">
                          <p class="text-xs font-semibold text-blue-700 uppercase tracking-wide mb-1">RFID Tag</p>
                          <p class="font-mono text-base font-bold text-gray-800 break-all">{{ $doorlock->rfid }}</p>
                        </div>
                      </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="card-actions flex gap-2 mt-4">
                      <button onclick="document.getElementById('editrfid_{{ $doorlock->doorlockID }}').showModal()"
                        class="btn btn-primary btn-sm flex-1 gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                          stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit
                      </button>
                      <button onclick="document.getElementById('removerfid_{{ $doorlock->doorlockID }}').showModal()"
                        class="btn btn-error btn-sm flex-1 gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                          stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Delete
                      </button>
                    </div>
                  </div>
                </div>
              @empty
                <div class="col-span-full">
                  <div class="card bg-base-100 shadow-lg border-2 border-dashed border-gray-300">
                    <div class="card-body items-center text-center py-16">
                      <div class="bg-gray-100 p-4 rounded-full mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24"
                          stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                      </div>
                      <h3 class="text-xl font-bold text-gray-700 mb-2">No Doorlocks Found</h3>
                      <p class="text-gray-500 mb-6">Add your first doorlock to get started managing access</p>
                      <button class="btn btn-primary gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                          stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Add First Doorlock
                      </button>
                    </div>
                  </div>
                </div>
              @endforelse
            </div>
          </div>
          </div>

          </section>


         @include('admin.components.doorlock.addrfid')

         @foreach ($doorlocks as $doorlock)
            @include('admin.components.doorlock.editrfid')
            @include('admin.components.doorlock.removerfid')
         @endforeach

          <!-- Lucide Icons -->
          <script type="module">
            import lucide from 'https://unpkg.com/lucide@latest/dist/esm/lucide.js';
            lucide.createIcons();
          </script>




        </main>
      </div>
    </div>

    {{-- modals --}}


  </body>

@endauth


@include('javascriptfix.soliera_js')

<script>


  <script src="{{asset('javascript/photouploadglobal.js')}}"></script>

</html>