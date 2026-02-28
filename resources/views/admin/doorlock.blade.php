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
                            <p class="text-3xl font-bold text-gray-800">{{ $totaldoorlock }}</p>
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
                                    <p class="text-xs text-gray-500">Keycards assigned to guest</p>
                                </div>
                            </div>
                            <p class="text-3xl font-bold text-gray-800">{{ $totalassigned }}</p>
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
                            <p class="text-3xl font-bold text-gray-800">{{  $totalActive }}</p>
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
                            <p class="text-3xl font-bold text-gray-800">{{  $totalinnactive }}</p>
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
        <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Door Lock Management</h2>
                <p class="text-gray-600 text-sm mt-1">Manage your RFID-enabled door locks</p>
            </div>
            <button onclick="roomModal.showModal()" class="btn btn-primary gap-2 w-full sm:w-auto">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add Doorlock
            </button>
        </div>

        <!-- Toast Notification (Hidden by default) -->
        <div id="copyToast" class="toast toast-top toast-end z-50 hidden">
            <div class="alert alert-success">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>RFID tag copied to clipboard!</span>
            </div>
        </div>

        <!-- Search and Filter Section -->
        <div class="bg-white rounded-xl  p-5 mb-6">
            <div class="flex flex-col lg:flex-row gap-4">
                <!-- Search Bar -->
                <div class="flex-1">
                    <div class="relative">
                        <input type="text" id="searchInput" placeholder="Search by Room ID, RFID, Guest Name or Booking ID..." 
                               class="input input-bordered w-full pl-10 pr-4 py-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>

                <!-- Filter Dropdowns -->
                <div class="flex flex-wrap gap-2">
                    <!-- Status Filter -->
                    <select id="statusFilter" class="select select-bordered select-sm w-full sm:w-auto">
                        <option value="all">All Status</option>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>

                    <!-- Assignment Filter -->
                    <select id="assignmentFilter" class="select select-bordered select-sm w-full sm:w-auto">
                        <option value="all">All Locks</option>
                        <option value="assigned">Assigned</option>
                        <option value="unassigned">Unassigned</option>
                    </select>

                    <!-- Sort By -->
                    <select id="sortFilter" class="select select-bordered select-sm w-full sm:w-auto">
                        <option value="latest">Latest First</option>
                        <option value="oldest">Oldest First</option>
                        <option value="room_asc">Room (A-Z)</option>
                        <option value="room_desc">Room (Z-A)</option>
                    </select>

                    <!-- Clear Filters Button -->
                    <button id="clearFilters" class="btn btn-sm btn-ghost gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Clear
                    </button>
                </div>
            </div>

            <!-- Active Filters Display -->
            <div id="activeFilters" class="flex flex-wrap gap-2 mt-3 min-h-[32px]">
                <!-- Active filters will be displayed here dynamically -->
            </div>
        </div>

        <!-- Stats Cards -->

        <!-- Results Count and Info -->
        <div class="flex justify-between items-center mb-4">
            <p id="resultsCount" class="text-sm text-gray-600">Showing <span id="visibleCount">0</span> of <span id="totalCount">{{ count($doorlocks) }}</span> door locks</p>
            <div class="flex gap-2">
                <button id="exportBtn" class="btn btn-sm btn-outline btn-primary gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    Export
                </button>
            </div>
        </div>

        <!-- Copy Function Script -->
        <script>
            function copyRFID(rfid, element) {
                navigator.clipboard.writeText(rfid).then(function() {
                    const toast = document.getElementById('copyToast');
                    toast.classList.remove('hidden');

                    const copyBtn = element.closest('.copy-btn');
                    if (copyBtn) {
                        copyBtn.classList.add('scale-125', 'bg-blue-600');
                        setTimeout(() => {
                            copyBtn.classList.remove('scale-125', 'bg-blue-600');
                        }, 200);
                    }

                    setTimeout(() => {
                        toast.classList.add('hidden');
                    }, 2000);
                }).catch(function(err) {
                    alert('Press Ctrl+C to copy the RFID tag');
                });
            }
        </script>

        <!-- Cards Grid -->
        <div id="doorlockGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($doorlocks as $doorlock)
              <div class="doorlock-card card bg-base-100 shadow-xl border border-gray-200 hover:shadow-2xl transition-all duration-300 hover:-translate-y-1 hover:border-blue-200 group"
                   data-room="{{ $doorlock->roomID }}"
                   data-rfid="{{ $doorlock->rfid }}"
                   data-guest="{{ $doorlock->guestname ?? '' }}"
                   data-booking="{{ $doorlock->bookingID ?? '' }}"
                   data-status="{{ $doorlock->doorlock_status }}"
                   data-assigned="{{ !empty($doorlock->guestname) ? 'assigned' : 'unassigned' }}"
                   data-created="{{ $doorlock->created_at }}">
                  <div class="card-body p-6">
                      <!-- Header with Status and Room Number Badge -->
                      <div class="flex items-start justify-between mb-4">
                          <div class="flex-1">
                              <div class="flex items-center gap-2">
                                  <div class="badge badge-lg bg-blue-100 text-blue-800 border-blue-300 font-bold">
                                      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                      </svg>
                                      Room
                                  </div>
                                  <h3 class="card-title text-xl font-bold text-gray-800">{{ $doorlock->roomID }}</h3>
                              </div>
                          </div>
                          <div class="badge {{ $doorlock->doorlock_status == 'Active' ? 'badge-success' : 'badge-error' }} badge-lg gap-2 shadow-sm">
                              <span class="w-2 h-2 rounded-full bg-white animate-pulse"></span>
                              {{ ucfirst($doorlock->doorlock_status) }}
                          </div>
                      </div>

                      <!-- RFID Section with Copy Button -->
                      <div class="bg-gradient-to-br from-blue-50 to-indigo-50 p-4 rounded-xl mb-4 border border-blue-100 group/copy">
                          <div class="flex items-start gap-3">
                              <div class="bg-blue-500 p-2 rounded-lg shadow-md">
                                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                                  </svg>
                              </div>
                              <div class="flex-1 min-w-0">
                                  <p class="text-xs font-semibold text-blue-700 uppercase tracking-wide mb-1">RFID Tag</p>
                                  <div class="flex items-center gap-2">
                                      <p class="font-mono text-sm font-bold text-gray-800 break-all truncate">{{ $doorlock->rfid }}</p>
                                      <button onclick="copyRFID('{{ $doorlock->rfid }}', this)" 
                                              class="copy-btn btn btn-xs btn-ghost btn-square text-blue-600 hover:text-blue-800 hover:bg-blue-100 transition-all duration-200"
                                              title="Copy RFID tag">
                                          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                          </svg>
                                      </button>
                                  </div>
                              </div>
                          </div>
                      </div>

                      <!-- Assignment Section -->
                      <div class="bg-gradient-to-br from-emerald-50 to-teal-50 p-4 rounded-xl mb-4 border border-emerald-100">
                          <div class="flex items-start gap-3">
                              <div class="bg-emerald-500 p-2 rounded-lg shadow-md">
                                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                  </svg>
                              </div>
                              <div class="flex-1 min-w-0">
                                  <p class="text-xs font-semibold text-emerald-700 uppercase tracking-wide mb-1 flex items-center gap-1">
                                      <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                      </svg>
                                      Assigned To
                                  </p>

                                  @if(!empty($doorlock->guestname))
                                    <p class="text-sm font-bold text-gray-800 flex items-center gap-1">
                                        <span class="avatar placeholder">
                                            <div class="bg-emerald-200 text-emerald-800 rounded-full w-5 h-5 text-xs flex items-center justify-center">
                                                {{ substr($doorlock->guestname, 0, 1) }}
                                            </div>
                                        </span>
                                        {{ $doorlock->guestname }}
                                    </p>
                                  @else
                                    <p class="text-sm italic text-gray-500 flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                        </svg>
                                        Not assigned
                                    </p>
                                  @endif

                                  @if(!empty($doorlock->bookingID))
                                    <div class="mt-2 flex items-center gap-1 text-xs bg-white/50 p-1.5 rounded-lg border border-emerald-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span class="text-gray-600">Booking:</span>
                                        <span class="font-mono font-semibold text-emerald-700">{{ $doorlock->bookingID }}</span>
                                    </div>
                                  @endif
                              </div>
                          </div>
                      </div>

                      <!-- Action Buttons -->
                      <div class="card-actions flex flex-wrap gap-2 mt-4">
                          @if(!is_null($doorlock->frontdesk_doorlockID))
                            <a target="_blank" href="/monitordoorlock/{{ $doorlock->frontdesk_doorlockID }}" 
                               class="btn btn-info btn-sm flex-1 gap-1 hover:scale-105 transition-transform">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2a4 4 0 014-4h4m0 0l-3-3m3 3l-3 3M3 3h6v6H3V3z" />
                                </svg>
                                <span class="hidden sm:inline">Monitor</span>
                            </a>
                          @endif

                          <button onclick="document.getElementById('editrfid_{{ $doorlock->doorlockID }}').showModal()"
                                  class="btn btn-primary btn-sm flex-1 gap-1 hover:scale-105 transition-transform">
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                              </svg>
                              <span class="hidden sm:inline">Edit</span>
                          </button>

                          <button onclick="document.getElementById('removerfid_{{ $doorlock->doorlockID }}').showModal()"
                                  class="btn btn-error btn-sm flex-1 gap-1 hover:scale-105 transition-transform">
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                              </svg>
                              <span class="hidden sm:inline">Delete</span>
                          </button>
                      </div>

                      @if($doorlock->updated_at)
                        <div class="mt-3 text-xs text-gray-400 flex items-center justify-end gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Updated {{ $doorlock->updated_at->diffForHumans() }}
                        </div>
                      @endif
                  </div>
              </div>
            @empty
              <div class="col-span-full">
                  <div class="card bg-base-100 shadow-lg border-2 border-dashed border-gray-300 hover:border-primary transition-colors duration-300">
                      <div class="card-body items-center text-center py-16">
                          <div class="bg-gradient-to-br from-gray-100 to-gray-200 p-4 rounded-full mb-4 group-hover:scale-110 transition-transform">
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                              </svg>
                          </div>
                          <h3 class="text-2xl font-bold text-gray-700 mb-2">No Doorlocks Found</h3>
                          <p class="text-gray-500 mb-6 max-w-md">Get started by adding your first door lock to begin managing access control seamlessly.</p>
                          <button onclick="roomModal.showModal()" class="btn btn-primary gap-2 btn-lg">
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                              </svg>
                              Add First Doorlock
                          </button>
                      </div>
                  </div>
              </div>
            @endforelse
        </div>

        <!-- No Results Message (Hidden by default) -->
        <div id="noResultsMessage" class="hidden col-span-full">
            <div class="card bg-base-100 shadow-lg border-2 border-dashed border-gray-300">
                <div class="card-body items-center text-center py-16">
                    <div class="bg-gray-100 p-4 rounded-full mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-700 mb-2">No Results Found</h3>
                    <p class="text-gray-500 mb-6">No door locks match your search criteria. Try adjusting your filters.</p>
                    <button id="clearFiltersFromNoResults" class="btn btn-primary gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Clear All Filters
                    </button>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        @if(method_exists($doorlocks, 'links'))
          <div class="mt-6">
              {{ $doorlocks->links() }}
          </div>
        @endif
    </div>

    <!-- Search and Filter JavaScript -->
    <script>
        (function() {
            // Get DOM elements
            const searchInput = document.getElementById('searchInput');
            const statusFilter = document.getElementById('statusFilter');
            const assignmentFilter = document.getElementById('assignmentFilter');
            const sortFilter = document.getElementById('sortFilter');
            const clearFiltersBtn = document.getElementById('clearFilters');
            const clearFiltersFromNoResults = document.getElementById('clearFiltersFromNoResults');
            const doorlockCards = document.querySelectorAll('.doorlock-card');
            const doorlockGrid = document.getElementById('doorlockGrid');
            const noResultsMessage = document.getElementById('noResultsMessage');
            const visibleCountSpan = document.getElementById('visibleCount');
            const totalCountSpan = document.getElementById('totalCount');
            const activeFiltersDiv = document.getElementById('activeFilters');
            const exportBtn = document.getElementById('exportBtn');

            // Set total count
            if (totalCountSpan) {
                totalCountSpan.textContent = doorlockCards.length;
            }

            // Update visible count
            function updateVisibleCount() {
                const visibleCards = document.querySelectorAll('.doorlock-card:not(.hidden)');
                if (visibleCountSpan) {
                    visibleCountSpan.textContent = visibleCards.length;
                }

                // Show/hide no results message
                if (doorlockCards.length > 0) {
                    if (visibleCards.length === 0) {
                        doorlockGrid.classList.add('hidden');
                        noResultsMessage.classList.remove('hidden');
                    } else {
                        doorlockGrid.classList.remove('hidden');
                        noResultsMessage.classList.add('hidden');
                    }
                }

                // Update active filters display
                updateActiveFilters();
            }

            // Update active filters display
            function updateActiveFilters() {
                const filters = [];

                if (searchInput.value.trim()) {
                    filters.push(`Search: "${searchInput.value}"`);
                }

                if (statusFilter.value !== 'all') {
                    filters.push(`Status: ${statusFilter.value}`);
                }

                if (assignmentFilter.value !== 'all') {
                    filters.push(`Assignment: ${assignmentFilter.value === 'assigned' ? 'Assigned' : 'Unassigned'}`);
                }

                if (sortFilter.value !== 'latest') {
                    let sortText = '';
                    switch(sortFilter.value) {
                        case 'oldest': sortText = 'Oldest First'; break;
                        case 'room_asc': sortText = 'Room (A-Z)'; break;
                        case 'room_desc': sortText = 'Room (Z-A)'; break;
                    }
                    filters.push(`Sort: ${sortText}`);
                }

                activeFiltersDiv.innerHTML = '';

                if (filters.length > 0) {
                    filters.forEach(filter => {
                        const badge = document.createElement('div');
                        badge.className = 'badge badge-outline badge-primary gap-1 py-3 px-3';
                        badge.innerHTML = `
                            ${filter}
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        `;

                        // Add click event to remove this filter
                        badge.querySelector('svg').addEventListener('click', function() {
                            if (filter.startsWith('Search:')) {
                                searchInput.value = '';
                            } else if (filter.startsWith('Status:')) {
                                statusFilter.value = 'all';
                            } else if (filter.startsWith('Assignment:')) {
                                assignmentFilter.value = 'all';
                            } else if (filter.startsWith('Sort:')) {
                                sortFilter.value = 'latest';
                            }
                            filterCards();
                        });

                        activeFiltersDiv.appendChild(badge);
                    });
                }
            }

            // Filter cards function
            function filterCards() {
                const searchTerm = searchInput.value.toLowerCase().trim();
                const statusValue = statusFilter.value;
                const assignmentValue = assignmentFilter.value;
                const sortValue = sortFilter.value;

                // Convert NodeList to array for sorting
                const cardsArray = Array.from(doorlockCards);

                // First, apply filters
                cardsArray.forEach(card => {
                    const room = card.dataset.room?.toLowerCase() || '';
                    const rfid = card.dataset.rfid?.toLowerCase() || '';
                    const guest = card.dataset.guest?.toLowerCase() || '';
                    const booking = card.dataset.booking?.toLowerCase() || '';
                    const status = card.dataset.status;
                    const assigned = card.dataset.assigned;

                    let showCard = true;

                    // Search filter
                    if (searchTerm) {
                        const searchableText = `${room} ${rfid} ${guest} ${booking}`;
                        if (!searchableText.includes(searchTerm)) {
                            showCard = false;
                        }
                    }

                    // Status filter
                    if (showCard && statusValue !== 'all') {
                        if (status !== statusValue) {
                            showCard = false;
                        }
                    }

                    // Assignment filter
                    if (showCard && assignmentValue !== 'all') {
                        if (assigned !== assignmentValue) {
                            showCard = false;
                        }
                    }

                    card.classList.toggle('hidden', !showCard);
                });

                // Then, apply sorting to visible cards
                const visibleCards = cardsArray.filter(card => !card.classList.contains('hidden'));

                visibleCards.sort((a, b) => {
                    switch(sortValue) {
                        case 'oldest':
                            return new Date(a.dataset.created) - new Date(b.dataset.created);
                        case 'room_asc':
                            return a.dataset.room.localeCompare(b.dataset.room, undefined, {numeric: true});
                        case 'room_desc':
                            return b.dataset.room.localeCompare(a.dataset.room, undefined, {numeric: true});
                        case 'latest':
                        default:
                            return new Date(b.dataset.created) - new Date(a.dataset.created);
                    }
                });

                // Reorder cards in the grid
                visibleCards.forEach(card => {
                    doorlockGrid.appendChild(card);
                });

                // Update visible count
                updateVisibleCount();
            }

            // Clear all filters
            function clearAllFilters() {
                searchInput.value = '';
                statusFilter.value = 'all';
                assignmentFilter.value = 'all';
                sortFilter.value = 'latest';
                filterCards();
            }

            // Event listeners
            if (searchInput) {
                let debounceTimer;
                searchInput.addEventListener('input', function() {
                    clearTimeout(debounceTimer);
                    debounceTimer = setTimeout(filterCards, 300);
                });
            }

            if (statusFilter) {
                statusFilter.addEventListener('change', filterCards);
            }

            if (assignmentFilter) {
                assignmentFilter.addEventListener('change', filterCards);
            }

            if (sortFilter) {
                sortFilter.addEventListener('change', filterCards);
            }

            if (clearFiltersBtn) {
                clearFiltersBtn.addEventListener('click', clearAllFilters);
            }

            if (clearFiltersFromNoResults) {
                clearFiltersFromNoResults.addEventListener('click', clearAllFilters);
            }

            // Export functionality
            if (exportBtn) {
                exportBtn.addEventListener('click', function() {
                    const visibleCards = document.querySelectorAll('.doorlock-card:not(.hidden)');
                    const data = [];

                    visibleCards.forEach(card => {
                        const room = card.dataset.room;
                        const rfid = card.dataset.rfid;
                        const guest = card.dataset.guest || 'Unassigned';
                        const booking = card.dataset.booking || 'N/A';
                        const status = card.dataset.status;

                        data.push({
                            Room: room,
                            RFID: rfid,
                            Guest: guest,
                            Booking: booking,
                            Status: status
                        });
                    });

                    // Convert to CSV
                    const csv = [
                        ['Room', 'RFID', 'Guest', 'Booking', 'Status'],
                        ...data.map(item => [item.Room, item.RFID, item.Guest, item.Booking, item.Status])
                    ].map(row => row.join(',')).join('\n');

                    // Download CSV
                    const blob = new Blob([csv], { type: 'text/csv' });
                    const url = window.URL.createObjectURL(blob);
                    const a = document.createElement('a');
                    a.href = url;
                    a.download = `doorlocks_export_${new Date().toISOString().split('T')[0]}.csv`;
                    a.click();
                });
            }

            // Initial filter to set correct count
            updateVisibleCount();

            // Add keyboard shortcut for search (Ctrl+F)
            document.addEventListener('keydown', function(e) {
                if ((e.ctrlKey || e.metaKey) && e.key === 'f') {
                    e.preventDefault();
                    searchInput.focus();
                }
            });
        })();
    </script>

    <!-- Add these styles -->
    <style>
        /* Search highlight animation */
        .doorlock-card {
            transition: all 0.3s ease;
        }

        .doorlock-card.hidden {
            display: none;
        }

        /* Filter badge hover effect */
        #activeFilters .badge:hover {
            background-color: #dbeafe;
            border-color: #3b82f6;
        }

        /* Smooth transitions */
        #doorlockGrid {
            transition: opacity 0.3s ease;
        }

        /* Loading state for search */
        #doorlockGrid.searching {
            opacity: 0.6;
            pointer-events: none;
        }
    </style>
                    <div class="divider my-8"></div>


                  <div class="container mx-auto px-4 py-6">
      <!-- Master OTP Section -->
      <div class="mb-8">
          <!-- Header with Search and Filter -->
          <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4 mb-6">
              <div class="flex items-center gap-2">
                  <div class="bg-purple-100 p-2 rounded-lg">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                      </svg>
                  </div>
                  <h3 class="text-xl font-bold text-gray-800">Master OTP Codes</h3>
                
              </div>

              <!-- Search and Filter Bar -->
              <div class="flex flex-col sm:flex-row gap-3 w-full lg:w-auto">
                  <div class="relative flex-1 lg:w-64">
                      <input type="text" id="masterRFIDSearch" placeholder="Search by name or RFID..." 
                             class="input input-bordered w-full pl-9 pr-4 py-2">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                      </svg>
                  </div>

                  <select id="masterRFIDStatusFilter" class="select select-bordered select-sm w-full sm:w-32">
                      <option value="all">All Status</option>
                      <option value="Active">Active</option>
                      <option value="Inactive">Inactive</option>
                  </select>

                  <select id="masterRFIDSortFilter" class="select select-bordered select-sm w-full sm:w-32">
                      <option value="latest">Latest</option>
                      <option value="oldest">Oldest</option>
                      <option value="name_asc">Name A-Z</option>
                      <option value="name_desc">Name Z-A</option>
                  </select>

                  <button id="clearMasterRFIDFilters" class="btn btn-sm btn-ghost gap-1">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                      </svg>
                      Clear
                  </button>
              </div>
          </div>

          <!-- Active Filters Display -->
          <div id="masterRFIDActiveFilters" class="flex flex-wrap gap-2 mb-4 min-h-[32px]">
              <!-- Active filters will be displayed here dynamically -->
          </div>

          <!-- Results Count -->
          <div class="flex justify-between items-center mb-4">
              <p id="masterRFIDResultsCount" class="text-sm text-gray-600">
                  Showing <span id="masterRFIDVisibleCount">0</span> of <span id="masterRFIDTotalCount">{{ count($masterRFID) }}</span> master RFID cards
              </p>
              <button id="exportMasterRFIDBtn" class="btn btn-primary">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                  </svg>
                  Export
              </button>
          </div>

          <!-- Master OTP Cards Grid -->
          <div id="masterRFIDGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
              @forelse ($masterRFID as $rfidmaster)
                <div class="master-rfid-card card bg-gradient-to-br from-purple-50 to-pink-50 border border-purple-200 shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-[1.02] group"
                     data-id="{{ $rfidmaster->masterRFID_ID }}"
                     data-name="{{ strtolower($rfidmaster->masterRFID_name) }}"
                     data-rfid="{{ strtolower($rfidmaster->masterRFID_rfid) }}"
                     data-status="{{ $rfidmaster->masterRFID_status }}"
                     data-created="{{ $rfidmaster->created_at }}">
                    <div class="card-body p-5">
                        <!-- Header with Icon and Status -->
                        <div class="flex justify-between items-start mb-3">
                            <div class="bg-purple-600 p-2 rounded-lg shadow-md group-hover:scale-110 transition-transform">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                                </svg>
                            </div>
                            <div class="badge {{ $rfidmaster->masterRFID_status == 'Active' ? 'badge-success' : 'badge-warning' }} badge-sm gap-1">
                                <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span>
                                {{ $rfidmaster->masterRFID_status }}
                            </div>
                        </div>

                        <!-- RFID Name -->
                        <h4 class="text-xl font-bold text-gray-800 mb-2 flex items-center gap-2">
                            <span class="bg-purple-200 text-purple-800 p-1 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l5 5a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-5-5A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                            </span>
                            <span class="rfid-name">{{ $rfidmaster->masterRFID_name }}</span>
                        </h4>

                        <!-- RFID Code Section with Copy Button -->
                        <div class="bg-white/80 backdrop-blur rounded-lg p-4 mb-4 border border-purple-100">
                            <div class="flex items-center justify-between mb-1">
                                <p class="text-xs font-semibold text-purple-700 uppercase tracking-wide flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                                    </svg>
                                    RFID Tag
                                </p>
                                <span class="text-xs text-gray-400">ID: #{{ $rfidmaster->masterRFID_ID }}</span>
                            </div>
                            <div class="flex items-center justify-between gap-2">
                                <p class="rfid-tag font-mono text-lg font-bold text-gray-800 tracking-wider truncate flex-1">{{ $rfidmaster->masterRFID_rfid }}</p>
                                <button onclick="copyMasterRFID('{{ $rfidmaster->masterRFID_rfid }}', this)" 
                                        class="copy-btn btn btn-sm btn-ghost btn-square text-purple-600 hover:text-purple-800 hover:bg-purple-100 transition-all duration-200"
                                        title="Copy RFID tag">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Additional Details Section -->
                        <div class="grid grid-cols-2 gap-2 mb-4">
                            <div class="bg-purple-100/50 p-2 rounded-lg">
                                <p class="text-xs text-purple-600 flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Created
                                </p>
                                <p class="text-sm font-semibold text-gray-700">{{ $rfidmaster->created_at ? $rfidmaster->created_at->format('M d, Y') : 'N/A' }}</p>
                            </div>
                            <div class="bg-purple-100/50 p-2 rounded-lg">
                                <p class="text-xs text-purple-600 flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Last Updated
                                </p>
                                <p class="text-sm font-semibold text-gray-700">{{ $rfidmaster->updated_at ? $rfidmaster->updated_at->format('M d, Y') : 'N/A' }}</p>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="card-actions flex gap-2 mt-2">
                            <button onclick="document.getElementById('editMasterRFID_{{ $rfidmaster->masterRFID_ID }}').showModal()"
                                    class="btn btn-sm btn-primary flex-1 gap-1 hover:scale-105 transition-transform">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit
                            </button>
                            <button onclick="document.getElementById('deleteMasterRFID_{{ $rfidmaster->masterRFID_ID }}').showModal()"
                                    class="btn btn-sm btn-error flex-1 gap-1 hover:scale-105 transition-transform">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
              @empty
                <!-- Empty State Message -->
                <div class="col-span-full">
                    <div class="card bg-base-100 shadow-lg border-2 border-dashed border-purple-200 hover:border-purple-300 transition-colors duration-300">
                        <div class="card-body items-center text-center py-16">
                            <div class="bg-gradient-to-br from-purple-100 to-pink-100 p-5 rounded-full mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-700 mb-2">No Master RFID Found</h3>
                            <p class="text-gray-500 mb-6 max-w-md">Get started by registering your first master RFID card for system access control.</p>
                            <button onclick="document.getElementById('masterRFIDModal').showModal()" 
                                    class="btn btn-primary bg-purple-600 hover:bg-purple-700 border-none gap-2 btn-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Register First Master RFID
                            </button>
                        </div>
                    </div>
                </div>
              @endforelse

              <!-- Add New Master RFID Card -->
              <button onclick="document.getElementById('masterRFIDModal').showModal()"
                  class="card border-2 border-dashed border-purple-200 bg-purple-50/30 hover:bg-purple-50 transition-all duration-300 cursor-pointer group">
                  <div class="card-body items-center justify-center p-5 min-h-[320px]">
                      <div class="bg-purple-100 p-4 rounded-full mb-3 group-hover:scale-110 transition-transform">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                          </svg>
                      </div>
                      <p class="text-lg font-medium text-purple-700">Add New Master RFID</p>
                      <p class="text-sm text-purple-500 text-center mt-2">Click to register a new master RFID card</p>
                  </div>
              </button>
          </div>

          <!-- No Results Message (Hidden by default) -->
          <div id="masterRFIDNoResults" class="hidden col-span-full mt-4">
              <div class="card bg-base-100 shadow-lg border-2 border-dashed border-gray-300">
                  <div class="card-body items-center text-center py-12">
                      <div class="bg-gray-100 p-4 rounded-full mb-4">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                          </svg>
                      </div>
                      <h3 class="text-xl font-bold text-gray-700 mb-2">No Results Found</h3>
                      <p class="text-gray-500 mb-4">No master RFID cards match your search criteria.</p>
                      <button id="clearMasterRFIDFiltersFromNoResults" class="btn btn-purple btn-sm gap-2">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                          </svg>
                          Clear All Filters
                      </button>
                  </div>
              </div>
          </div>

       
      
      </div>
  </div>

  <!-- Copy Function Script -->
  <script>
      function copyMasterRFID(rfid, element) {
          navigator.clipboard.writeText(rfid).then(function() {
              // Show toast notification
              const toast = document.createElement('div');
              toast.className = 'fixed top-4 right-4 bg-purple-600 text-white px-4 py-2 rounded-lg shadow-lg flex items-center gap-2 z-50 animate-slideIn';
              toast.innerHTML = `
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  <span>RFID tag copied to clipboard!</span>
              `;
              document.body.appendChild(toast);

              // Add animation to clicked button
              const copyBtn = element;
              copyBtn.classList.add('scale-125', 'bg-purple-200');
              setTimeout(() => {
                  copyBtn.classList.remove('scale-125', 'bg-purple-200');
              }, 200);

              // Remove toast after 2 seconds
              setTimeout(() => {
                  toast.remove();
              }, 2000);
          }).catch(function(err) {
              alert('Press Ctrl+C to copy the RFID tag: ' + rfid);
          });
      }
  </script>

  <!-- Master RFID Search and Filter Script -->
  <script>
      (function() {
          // Get DOM elements
          const searchInput = document.getElementById('masterRFIDSearch');
          const statusFilter = document.getElementById('masterRFIDStatusFilter');
          const sortFilter = document.getElementById('masterRFIDSortFilter');
          const clearFiltersBtn = document.getElementById('clearMasterRFIDFilters');
          const clearFiltersFromNoResults = document.getElementById('clearMasterRFIDFiltersFromNoResults');
          const masterRFIDCards = document.querySelectorAll('.master-rfid-card');
          const masterRFIDGrid = document.getElementById('masterRFIDGrid');
          const noResultsMessage = document.getElementById('masterRFIDNoResults');
          const visibleCountSpan = document.getElementById('masterRFIDVisibleCount');
          const totalCountSpan = document.getElementById('masterRFIDTotalCount');
          const activeFiltersDiv = document.getElementById('masterRFIDActiveFilters');
          const exportBtn = document.getElementById('exportMasterRFIDBtn');
          const activeCountBadge = document.getElementById('masterRFIDActiveCount');

          // Set total count
          if (totalCountSpan) {
              totalCountSpan.textContent = masterRFIDCards.length;
          }

          // Update visible count and active count badge
          function updateVisibleCount() {
              const visibleCards = document.querySelectorAll('.master-rfid-card:not(.hidden)');
              if (visibleCountSpan) {
                  visibleCountSpan.textContent = visibleCards.length;
              }

              // Update active count in badge
              if (activeCountBadge) {
                  const activeCards = document.querySelectorAll('.master-rfid-card:not(.hidden) .badge-success').length;
                  activeCountBadge.textContent = activeCards + ' Active';
              }

              // Show/hide no results message
              if (masterRFIDCards.length > 0) {
                  if (visibleCards.length === 0) {
                      if (masterRFIDGrid) masterRFIDGrid.classList.add('hidden');
                      if (noResultsMessage) noResultsMessage.classList.remove('hidden');
                  } else {
                      if (masterRFIDGrid) masterRFIDGrid.classList.remove('hidden');
                      if (noResultsMessage) noResultsMessage.classList.add('hidden');
                  }
              }

              // Update active filters display
              updateActiveFilters();
          }

          // Update active filters display
          function updateActiveFilters() {
              const filters = [];

              if (searchInput?.value.trim()) {
                  filters.push(`Search: "${searchInput.value}"`);
              }

              if (statusFilter?.value !== 'all') {
                  filters.push(`Status: ${statusFilter.value}`);
              }

              if (sortFilter?.value !== 'latest') {
                  let sortText = '';
                  switch(sortFilter.value) {
                      case 'oldest': sortText = 'Oldest First'; break;
                      case 'name_asc': sortText = 'Name (A-Z)'; break;
                      case 'name_desc': sortText = 'Name (Z-A)'; break;
                  }
                  filters.push(`Sort: ${sortText}`);
              }

              if (activeFiltersDiv) {
                  activeFiltersDiv.innerHTML = '';

                  if (filters.length > 0) {
                      filters.forEach(filter => {
                          const badge = document.createElement('div');
                          badge.className = 'badge badge-outline badge-purple gap-1 py-3 px-3';
                          badge.innerHTML = `
                              ${filter}
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                              </svg>
                          `;

                          // Add click event to remove this filter
                          badge.querySelector('svg').addEventListener('click', function() {
                              if (filter.startsWith('Search:')) {
                                  if (searchInput) searchInput.value = '';
                              } else if (filter.startsWith('Status:')) {
                                  if (statusFilter) statusFilter.value = 'all';
                              } else if (filter.startsWith('Sort:')) {
                                  if (sortFilter) sortFilter.value = 'latest';
                              }
                              filterCards();
                          });

                          activeFiltersDiv.appendChild(badge);
                      });
                  }
              }
          }

          // Filter cards function
          function filterCards() {
              const searchTerm = searchInput?.value.toLowerCase().trim() || '';
              const statusValue = statusFilter?.value || 'all';
              const sortValue = sortFilter?.value || 'latest';

              // Convert NodeList to array for sorting
              const cardsArray = Array.from(masterRFIDCards);

              // First, apply filters
              cardsArray.forEach(card => {
                  const name = card.dataset.name || '';
                  const rfid = card.dataset.rfid || '';
                  const status = card.dataset.status;

                  let showCard = true;

                  // Search filter
                  if (searchTerm) {
                      const searchableText = `${name} ${rfid}`;
                      if (!searchableText.includes(searchTerm)) {
                          showCard = false;
                      }
                  }

                  // Status filter
                  if (showCard && statusValue !== 'all') {
                      if (status !== statusValue) {
                          showCard = false;
                      }
                  }

                  card.classList.toggle('hidden', !showCard);
              });

              // Then, apply sorting to visible cards
              const visibleCards = cardsArray.filter(card => !card.classList.contains('hidden'));

              visibleCards.sort((a, b) => {
                  switch(sortValue) {
                      case 'oldest':
                          return new Date(a.dataset.created) - new Date(b.dataset.created);
                      case 'name_asc':
                          return a.dataset.name.localeCompare(b.dataset.name);
                      case 'name_desc':
                          return b.dataset.name.localeCompare(a.dataset.name);
                      case 'latest':
                      default:
                          return new Date(b.dataset.created) - new Date(a.dataset.created);
                  }
              });

              // Reorder cards in the grid
              if (masterRFIDGrid) {
                  visibleCards.forEach(card => {
                      masterRFIDGrid.appendChild(card);
                  });

                  // Make sure the "Add New" card is always last
                  const addCard = masterRFIDGrid.querySelector('button.card');
                  if (addCard) {
                      masterRFIDGrid.appendChild(addCard);
                  }
              }

              // Update visible count
              updateVisibleCount();
          }

          // Clear all filters
          function clearAllFilters() {
              if (searchInput) searchInput.value = '';
              if (statusFilter) statusFilter.value = 'all';
              if (sortFilter) sortFilter.value = 'latest';
              filterCards();
          }

          // Event listeners
          if (searchInput) {
              let debounceTimer;
              searchInput.addEventListener('input', function() {
                  clearTimeout(debounceTimer);
                  debounceTimer = setTimeout(filterCards, 300);
              });
          }

          if (statusFilter) {
              statusFilter.addEventListener('change', filterCards);
          }

          if (sortFilter) {
              sortFilter.addEventListener('change', filterCards);
          }

          if (clearFiltersBtn) {
              clearFiltersBtn.addEventListener('click', clearAllFilters);
          }

          if (clearFiltersFromNoResults) {
              clearFiltersFromNoResults.addEventListener('click', clearAllFilters);
          }

          // Export functionality
          if (exportBtn) {
              exportBtn.addEventListener('click', function() {
                  const visibleCards = document.querySelectorAll('.master-rfid-card:not(.hidden)');
                  const data = [];

                  visibleCards.forEach(card => {
                      const name = card.querySelector('.rfid-name')?.textContent || '';
                      const rfid = card.querySelector('.rfid-tag')?.textContent || '';
                      const status = card.dataset.status;
                      const id = card.dataset.id;

                      // Get dates from the card
                      const dateElements = card.querySelectorAll('.bg-purple-100\\/50 p.text-sm');
                      const created = dateElements[0]?.textContent || 'N/A';
                      const updated = dateElements[1]?.textContent || 'N/A';

                      data.push({
                          ID: id,
                          Name: name,
                          RFID: rfid,
                          Status: status,
                          Created: created,
                          Updated: updated
                      });
                  });

                  // Convert to CSV
                  const csv = [
                      ['ID', 'Name', 'RFID', 'Status', 'Created', 'Last Updated'],
                      ...data.map(item => [item.ID, item.Name, item.RFID, item.Status, item.Created, item.Updated])
                  ].map(row => row.join(',')).join('\n');

                  // Download CSV
                  const blob = new Blob([csv], { type: 'text/csv' });
                  const url = window.URL.createObjectURL(blob);
                  const a = document.createElement('a');
                  a.href = url;
                  a.download = `master_rfid_export_${new Date().toISOString().split('T')[0]}.csv`;
                  a.click();
              });
          }

          // Initial filter to set correct count
          updateVisibleCount();

          // Add keyboard shortcut for search (Ctrl+F)
          document.addEventListener('keydown', function(e) {
              if ((e.ctrlKey || e.metaKey) && e.key === 'f' && document.activeElement !== searchInput) {
                  e.preventDefault();
                  if (searchInput) searchInput.focus();
              }
          });
      })();
  </script>

  <style>
      @keyframes slideIn {
          from {
              transform: translateX(100%);
              opacity: 0;
          }
          to {
              transform: translateX(0);
              opacity: 1;
          }
      }

      .animate-slideIn {
          animation: slideIn 0.3s ease-out;
      }

      /* Search highlight animation */
      .master-rfid-card {
          transition: all 0.3s ease;
      }

      .master-rfid-card.hidden {
          display: none;
      }

      /* Filter badge hover effect */
      #masterRFIDActiveFilters .badge:hover {
          background-color: #f3e8ff;
          border-color: #9333ea;
      }

      /* Smooth transitions */
      #masterRFIDGrid {
          transition: opacity 0.3s ease;
      }

      /* Loading state for search */
      #masterRFIDGrid.searching {
          opacity: 0.6;
          pointer-events: none;
      }

      /* Custom badge-purple if not in DaisyUI */
      .badge-purple {
          background-color: #f3e8ff;
          border-color: #d8b4fe;
          color: #6b21a8;
      }
  </style>

                  </section>


                 @include('admin.components.doorlock.addrfid')
                  @include('admin.components.masterdoorlock.create')

                  @foreach ($masterRFID as $rfidmaster)
                    @include('admin.components.masterdoorlock.edit')
                    @include('admin.components.masterdoorlock.delete')
                  @endforeach



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