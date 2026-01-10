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
            <h1 class="text-2xl font-bold text-[#191970] bg-clip-text ">Event And Conference Management</h1>
          </div>
          {{-- Subsystem Name --}}

          {{-- content --}}
          <!-- content -->
          <section class="p-8 mt-5 max-w-screen-xl mx-auto space-y-10">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
              <!-- Total Facilities -->
              <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
                <div class="flex items-center justify-between">
                  <div>
                    <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Total Facilities</h3>
                    <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalfacility }}</p>
                    <div class="flex items-center mt-3">
                      <span class="text-sm font-medium text-gray-500">Soliera Hotel</span>
                    </div>
                  </div>
                  <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
                    <i class="fa-solid fa-building text-yellow-400 text-2xl"></i>
                  </div>
                </div>
              </div>

              <!-- Available -->
              <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
                <div class="flex items-center justify-between">
                  <div>
                    <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Available</h3>
                    <p class="text-3xl font-bold text-gray-800 mt-2">{{ $availablefacility }}</p>
                    <div class="flex items-center mt-3">
                      <span class="text-sm font-medium text-gray-500">Ready for use</span>
                    </div>
                  </div>
                  <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
                    <i class="fa-solid fa-check-circle text-yellow-400 text-2xl"></i>
                  </div>
                </div>
              </div>

              <!-- Occupied -->
              <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
                <div class="flex items-center justify-between">
                  <div>
                    <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Maintenance</h3>
                    <p class="text-3xl font-bold text-gray-800 mt-2">0</p>
                   
                  </div>
                  <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
                    <i class="fa-solid fa-clock text-yellow-400 text-2xl"></i>
                  </div>
                </div>
              </div>

              <!-- Under Maintenance -->
             
            </div>

            <!-- Header with Create Button -->
            <div class="flex items-center justify-between">
              <h2 class="text-2xl font-bold text-gray-800">Facilities</h2>
              <button onclick="document.getElementById('create_facility_modal').showModal()" class="btn btn-primary">
                + Add Facility
              </button>
            </div>


            @if(session('success'))
              <div class="alert alert-success shadow-lg rounded-xl mb-4 mt-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none"
                  viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2l4-4m6 2a9 9 0 11-18 0a9 9 0 0118 0z" />
                </svg>
                <span>{{ session('success') }}</span>
              </div>
            @endif

            <!-- Facility Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

              <!-- Facility Card -->
              @forelse($facilities as $facility)
                <div
                  class="border-2 border-blue-900/20 rounded-xl shadow-md overflow-hidden hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 bg-white">
                  <!-- Facility Photo with Overlay -->
                  <div class="relative">
                    <img
                      src="{{ $facility->facility_photo ? asset($facility->facility_photo) : 'https://via.placeholder.com/400x200' }}"
                      alt="Facility Photo" class="w-full h-48 object-cover">
                    <div class="absolute top-3 right-3">
                      <span
                        class="px-3 py-1 rounded-full text-xs font-bold shadow-lg {{ $facility->facility_status === 'Active' ? 'bg-yellow-400 text-blue-900' : 'bg-blue-900 text-yellow-400' }}">
                        {{ $facility->facility_status ?? 'Inactive' }}
                      </span>
                    </div>
                  </div>

                  <!-- Facility Info -->
                  <div class="p-6 space-y-4">
                    <div>
                      <h3 class="text-xl font-bold text-blue-900 mb-2">{{ $facility->facility_name }}</h3>
                      <div class="flex items-center gap-3 text-sm text-blue-900/70">
                        <span class="flex items-center gap-1">
                          <i class="fa-solid fa-building"></i>
                          {{ $facility->facility_type }}
                        </span>
                        <span class="flex items-center gap-1">
                          <i class="fa-solid fa-users"></i>
                          {{ $facility->facility_capacity ?? 'N/A' }}
                        </span>
                      </div>
                    </div>

                    <!-- Description -->
                    <p class="text-sm text-blue-900/80 leading-relaxed">
                      {{ $facility->facility_description ?? 'No description available.' }}
                    </p>

                    <!-- Amenities -->
                    @if(!empty($facility->facility_amenities))
                      <div class="flex flex-wrap gap-2 text-xs">
                        @foreach($facility->facility_amenities as $amenity)
                          <span class="px-3 py-1.5 bg-yellow-400 text-blue-900 rounded-full font-semibold">{{ $amenity }}</span>
                        @endforeach
                      </div>
                    @endif

                    <!-- Action Buttons -->
                    <div class="flex justify-end gap-3 pt-4 border-t-2 border-blue-900/10">
                      <!-- Edit Button -->
                      <button onclick="document.getElementById('edit_facility_modal_{{$facility->facilityID}}').showModal()"
                        class="px-4 py-2 rounded-lg bg-blue-900 text-yellow-400 hover:bg-blue-800 hover:scale-105 transition-all duration-200 flex items-center gap-2 font-semibold shadow-md">
                        <i class="fa-solid fa-pencil"></i>
                        <span>Edit</span>
                      </button>

                      <!-- Delete Button -->
                      <button onclick="document.getElementById('delete_modal_{{ $facility->facilityID }}').showModal()"
                        class="px-4 py-2 rounded-lg bg-yellow-400 text-blue-900 hover:bg-yellow-500 hover:scale-105 transition-all duration-200 flex items-center gap-2 font-semibold shadow-md">
                        <i class="fa-solid fa-trash"></i>
                        <span>Delete</span>
                      </button>
                    </div>
                  </div>
                </div>

              @empty
                <div
                  class="col-span-full flex flex-col items-center justify-center py-20 bg-gradient-to-br from-blue-900/5 to-yellow-400/5 rounded-xl border-2 border-dashed border-blue-900/30">
                  <div class="bg-yellow-400/20 p-6 rounded-full mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-blue-900" fill="none" viewBox="0 0 24 24"
                      stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                  </div>
                  <h3 class="text-2xl font-bold text-blue-900 mb-3">No Facilities Found</h3>
                  <p class="text-base text-blue-900/70 mb-6 text-center max-w-md leading-relaxed">
                    You haven't added any facilities yet. Create one to start managing event and conference spaces.
                  </p>
                  <button onclick="create_facility_modal.showModal()"
                    class="px-6 py-3 bg-yellow-400 text-blue-900 rounded-xl font-bold hover:bg-yellow-500 hover:scale-105 transition-all duration-200 shadow-lg flex items-center gap-2">
                    <i class="fa-solid fa-plus"></i>
                    Create Facility
                  </button>
                </div>
              @endforelse

            </div>
          </section>



          <!-- Lucide Icons -->
          <script type="module">
            import lucide from 'https://unpkg.com/lucide@latest/dist/esm/lucide.js';
            lucide.createIcons();
          </script>




        </main>
      </div>
    </div>

    {{-- modals --}}


    @foreach ($facilities as $facility)
      @include('admin.components.ecm.deletefacility')
      @include('admin.components.ecm.editfacility')
    @endforeach
    @include('admin.components.ecm.createfacility')


  </body>

@endauth


@include('javascriptfix.soliera_js')

<script>


  <script src="{{asset('javascript/photouploadglobal.js')}}"></script>

</html>