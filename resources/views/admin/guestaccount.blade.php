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
            <h1 class="text-2xl font-bold bg-white bg-clip-text text-[#191970]">Guest Accounts</h1>
          </div>
            {{-- Subsystem Name --}}
 <section class="flex-1 p-6">
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

    <!-- Total Guests -->
    <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Total Accounts</h3>
                <p class="text-3xl font-bold text-gray-800 mt-2">{{$totalguest}}</p>
            </div>
            <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
                <i class="fa-solid fa-hotel text-yellow-400 text-2xl"></i>
            </div>
        </div>
    </div>

    <!-- Guests Today / Checked-in Guests -->
    <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Checked In Guest</h3>
                <p class="text-3xl font-bold text-gray-800 mt-2">{{$checkinguest}}</p>
            </div>
            <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
                <i class="fa-solid fa-user-check text-yellow-400 text-2xl"></i>
            </div>
        </div>
    </div>

    <!-- Pending Bookings -->
    <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
    <div class="flex items-center justify-between">
        <div>
            <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Guest Pending Bookings</h3>
            <p class="text-3xl font-bold text-gray-800 mt-2">{{$pendingguest}}</p>
        </div>
        <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
            <i class="fa-solid fa-hourglass-half text-yellow-400 text-2xl"></i>
        </div>
    </div>
</div>

    <!-- Guests with Special Requests -->
   

</div>



<div class="overflow-x-auto mt-5 rounded-xl border border-gray-100 shadow-lg">
  <!-- Header -->
  <div class="bg-blue-900 text-white px-6 py-4 rounded-t-xl">
    <h2 class="text-lg font-semibold">Guest Accounts</h2>
  </div>

  <!-- Table -->
  <table class="table w-full">
    <thead class="bg-gray-100">
      <tr>
        <th>Guest Profile</th>
        <th>Email</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($guest as $guests)
      <tr class="hover:bg-gray-50 transition">
        <td>
          <div class="flex items-center gap-3">
            <img class="rounded-full w-12 h-12" src="{{ asset($guests->guest_photo) }}" alt="{{ $guests->guest_name }}">
            <div>
              <div class="font-bold">{{ $guests->guest_name }}</div>
              <div class="text-sm opacity-50">Guest</div>
            </div>
          </div>
        </td>
        <td>
          <div class="text-sm opacity-80">{{ $guests->guest_email }}</div>
        </td>
        <td>
          <span class="px-2 py-1 rounded-full text-white text-xs bg-green-500">Active</span>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  <!-- Pagination -->
  <div class="mt-4 px-6 py-3 bg-gray-50 flex justify-end rounded-b-xl">
    {{ $guest->links('pagination::tailwind') }}
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

   
    {{-- modals --}}


    
   
   @livewireScripts
  @include('javascriptfix.soliera_js')
  </body>
@endauth


  
</html>