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
            <h1 class="text-2xl font-bold bg-white bg-clip-text text-[#191970]">Department Accounts</h1>
          </div>
            {{-- Subsystem Name --}}

     <section class="flex-1 p-6">
         <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

    <!-- Total Employees -->
    <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Total Employees</h3>
                <p class="text-3xl font-bold text-gray-800 mt-2">{{$totalemployee}}</p>
                <div class="flex items-center mt-3">
                    <span class="text-sm font-medium text-gray-500">Core Staff</span>
                </div>
            </div>
            <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
                <i class="fa-solid fa-users text-yellow-400 text-2xl"></i>
            </div>
        </div>
    </div>

    <!-- Active Employees -->
    <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Active Employees</h3>
                <p class="text-3xl font-bold text-gray-800 mt-2">{{$activeemployee}}</p>
                <div class="flex items-center mt-3">
                    <span class="text-sm font-medium text-gray-500">Currently Working</span>
                </div>
            </div>
            <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
                <i class="fa-solid fa-user-check text-yellow-400 text-2xl"></i>
            </div>
        </div>
    </div>

    <!-- Inactive Employees -->
    <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Inactive Employees</h3>
                <p class="text-3xl font-bold text-gray-800 mt-2">{{$inactiveemployee}}</p>
                <div class="flex items-center mt-3">
                    <span class="text-sm font-medium text-gray-500">Not Active</span>
                </div>
            </div>
            <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
                <i class="fa-solid fa-user-slash text-yellow-400 text-2xl"></i>
            </div>
        </div>
    </div>

    <!-- Employees Pending Tasks -->
   

</div>



<div class="overflow-x-auto mt-5 rounded-xl border border-gray-100 shadow-lg">
  <!-- Header -->
  <div class="bg-blue-900 text-white px-6 py-4 rounded-t-xl">
    <h2 class="text-lg font-semibold">Department Employees</h2>
  </div>

  <!-- Table -->
  <table class="table w-full">
    <thead class="bg-gray-100">
      <tr>
        <th>Employee ID</th>
        <th>Department</th>
        <th>Employee</th>
        <th>Email & Role</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($employee as $employees)
      <tr class="hover:bg-gray-50 transition">
        <td class="font-medium">{{$employees->employee_id}}</td>
        <td>{{$employees->Dept_id}}</td>
        <td>
          <div class="flex items-center gap-3">
        <div class="avatar">
            <div class="h-12 w-12 rounded-full bg-blue-900 relative">
                <span class="absolute inset-0 flex items-center justify-center text-white font-bold text-lg">
                {{ strtoupper(substr($employees->employee_name, 0, 2)) }}
                </span>
            </div>
            </div>
            <div>
              <div class="font-bold">{{$employees->employee_name}}</div>
              <div class="text-sm opacity-50">{{$employees->Dept_id}}</div>
            </div>
          </div>
        </td>
        <td>
          <div class="text-sm opacity-80">{{$employees->email}}</div>
          <span class="badge badge-ghost badge-sm">{{$employees->role}}</span>
        </td>
        <td>
          <span class="px-2 py-1 rounded-full text-white text-xs 
            {{ $employees->status == 'Active' ? 'bg-green-500' : 'bg-red-500' }}">
            {{$employees->status}}
          </span>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
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