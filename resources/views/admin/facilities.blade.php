<!DOCTYPE html>
<html lang="en" data-theme ="light">
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
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
    <!-- Total Facilities -->
    <div class="border border-blue-100 bg-gradient-to-br from-blue-50 to-white rounded-xl p-5 shadow-sm hover:shadow-lg transition-all group">
      <div class="flex items-center gap-4">
        <div class="p-3 rounded-lg bg-blue-100 text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-colors">
          🏢
        </div>
        <div>
          <h3 class="text-sm font-semibold">Total Facilities</h3>
          <p class="text-2xl font-bold text-gray-800">12</p>
        </div>
      </div>
    </div>

    <!-- Available -->
    <div class="border border-green-100 bg-gradient-to-br from-green-50 to-white rounded-xl p-5 shadow-sm hover:shadow-lg transition-all group">
      <div class="flex items-center gap-4">
        <div class="p-3 rounded-lg bg-green-100 text-green-600 group-hover:bg-green-600 group-hover:text-white transition-colors">
          ✅
        </div>
        <div>
          <h3 class="text-sm font-semibold">Available</h3>
          <p class="text-2xl font-bold text-gray-800">8</p>
        </div>
      </div>
    </div>

    <!-- Occupied -->
    <div class="border border-yellow-100 bg-gradient-to-br from-yellow-50 to-white rounded-xl p-5 shadow-sm hover:shadow-lg transition-all group">
      <div class="flex items-center gap-4">
        <div class="p-3 rounded-lg bg-yellow-100 text-yellow-600 group-hover:bg-yellow-600 group-hover:text-white transition-colors">
          🕒
        </div>
        <div>
          <h3 class="text-sm font-semibold">Occupied</h3>
          <p class="text-2xl font-bold text-gray-800">3</p>
        </div>
      </div>
    </div>

    <!-- Under Maintenance -->
    <div class="border border-red-100 bg-gradient-to-br from-red-50 to-white rounded-xl p-5 shadow-sm hover:shadow-lg transition-all group">
      <div class="flex items-center gap-4">
        <div class="p-3 rounded-lg bg-red-100 text-red-600 group-hover:bg-red-600 group-hover:text-white transition-colors">
          🛠️
        </div>
        <div>
          <h3 class="text-sm font-semibold">Under Maintenance</h3>
          <p class="text-2xl font-bold text-gray-800">1</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Header with Create Button -->
  <div class="flex items-center justify-between">
    <h2 class="text-2xl font-bold text-gray-800">Facilities</h2>
    <button onclick="document.getElementById('create_facility_modal').showModal()" class="btn btn-primary">
      + Create Facility
    </button>
  </div>


  @if(session('success'))
  <div class="alert alert-success shadow-lg rounded-xl mb-4 mt-4">
    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
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
  <div class="border border-gray-200 rounded-xl shadow-sm overflow-hidden hover:shadow-lg hover:-translate-y-1 transition-all">
    <!-- Facility Photo -->
    <img src="{{ $facility->facility_photo ? asset($facility->facility_photo) : 'https://via.placeholder.com/400x200' }}"
         alt="Facility Photo"
         class="w-full h-40 object-cover">

    <!-- Facility Info -->
    <div class="p-5 space-y-3">
      <div>
        <h3 class="text-lg font-semibold text-gray-800">{{ $facility->facility_name }}</h3>
        <p class="text-sm text-gray-500">Type: {{ $facility->facility_type }} | Capacity: {{ $facility->facility_capacity ?? 'N/A' }}</p>
      </div>

      <!-- Description -->
      <p class="text-sm text-gray-600">
        {{ $facility->facility_description ?? 'No description available.' }}
      </p>

      <!-- Amenities -->
      @if(!empty($facility->facility_amenities))
        <div class="flex flex-wrap gap-2 text-xs">
          @foreach($facility->facility_amenities as $amenity)
            <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded-full">{{ $amenity }}</span>
          @endforeach
        </div>
      @endif

      <!-- Status -->
      <div class="flex justify-between items-center pt-3 border-t text-sm">
        <span class="font-medium text-gray-700">Status:</span>
        <span class="px-2 py-1 rounded-lg text-white {{ $facility->facility_status === 'Active' ? 'bg-green-600' : 'bg-red-600' }}">
          {{ $facility->facility_status ?? 'Inactive' }}
        </span>
      </div>

      <!-- Action Buttons -->
      <div class="flex justify-end gap-3 mt-4">
        <!-- Edit Button -->
        <button onclick="document.getElementById('edit_facility_modal_{{$facility->facilityID}}').showModal()"
          class="p-2 rounded-lg bg-blue-500 text-white hover:bg-blue-600 transition flex items-center gap-1">
          <i data-lucide="pencil" class="w-4 h-4"></i>
        </button>

        <!-- Delete Button -->
        <button onclick="document.getElementById('delete_modal_{{ $facility->facilityID }}').showModal()"
          class="p-2 rounded-lg bg-red-500 text-white hover:bg-red-600 transition flex items-center gap-1">
          <i data-lucide="trash-2" class="w-4 h-4"></i>
        </button>
      </div>
    </div>
  </div>

  <!-- DaisyUI Delete Confirmation Modal -->
 
@empty
  <div class="col-span-full flex flex-col items-center justify-center py-16 bg-gray-50 rounded-xl border border-dashed border-gray-300">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2h6v2m-6-6h.01M12 3C7.03 3 3 7.03 3 12c0 4.97 4.03 9 9 9s9-4.03 9-9c0-4.97-4.03-9-9-9z" />
    </svg>
    <h3 class="text-lg font-semibold text-gray-700 mb-2">No Facilities Found</h3>
    <p class="text-sm text-gray-500 mb-4 text-center max-w-md">You haven’t added any facilities yet. Create one to start managing event and conference spaces.</p>
    <button onclick="create_facility_modal.showModal()" class="btn btn-primary rounded-xl">
      + Create Facility
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
  
   
    @foreach ( $facilities as $facility )
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