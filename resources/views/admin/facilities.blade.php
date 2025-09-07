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
    <button onclick="document.getElementById('create_facility_modal').showModal()" class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition-all">
      + Create Facility
    </button>
  </div>

  <!-- Facility Grid -->
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    
    <!-- Facility Card -->
    <div class="border border-gray-200 rounded-xl shadow-sm overflow-hidden hover:shadow-lg hover:-translate-y-1 transition-all">
      <!-- Facility Photo -->
      <img src="https://via.placeholder.com/400x200" alt="Facility Photo" class="w-full h-40 object-cover">
      
      <!-- Facility Info -->
      <div class="p-5 space-y-3">
        <div>
          <h3 class="text-lg font-semibold text-gray-800">Grand Ballroom</h3>
          <p class="text-sm text-gray-500">Type: Event | Capacity: 300</p>
        </div>

        <p class="text-sm text-gray-600">
          A luxurious ballroom suitable for weddings, galas, and large events.
        </p>

        <div class="flex flex-wrap gap-2 text-xs">
          <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded-full">Sound System</span>
          <span class="px-2 py-1 bg-green-100 text-green-700 rounded-full">Lighting</span>
          <span class="px-2 py-1 bg-purple-100 text-purple-700 rounded-full">Projector</span>
        </div>

        <div class="flex justify-between items-center pt-3 border-t text-sm">
          <span class="font-medium text-gray-700">Status:</span>
          <span class="px-2 py-1 rounded-lg text-white bg-green-600">Available</span>
        </div>
      </div>
    </div>

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
    @include('admin.components.ecm.createtype')
   
  
    @include('admin.components.ecm.createfacility')
  
 
  </body>

  @endauth

  
  @include('javascriptfix.soliera_js')

 <script>


  <script src="{{asset('javascript/photouploadglobal.js')}}"></script>
  
</html>