<!DOCTYPE html>
<html lang="en" data-theme ="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite('resources/css/app.css')
 
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <title>{{$title}} - Room Feedbacks</title>
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
            <h1 class="text-2xl font-bold bg-white bg-clip-text text-[#191970]">Guest Relationship Management</h1>
          </div>
            {{-- Subsystem Name --}}

          {{-- content --}}

          <!-- Room Feedbacks CRM Section -->
<section class="flex-1 p-6">
  <!-- Stats Grid -->
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

    <!-- Total Feedback -->
    <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
      <div class="flex items-center justify-between">
        <div>
          <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Total Feedback</h3>
          <p class="text-3xl font-bold text-gray-800 mt-2">248</p>
          <div class="flex items-center mt-3">
            <span class="text-sm font-medium text-gray-500">+12% from last month</span>
          </div>
        </div>
        <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
          <i class="fa-solid fa-comments text-yellow-400 text-2xl"></i>
        </div>
      </div>
    </div>

    <!-- Positive Feedback -->
    <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
      <div class="flex items-center justify-between">
        <div>
          <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Positive</h3>
          <p class="text-3xl font-bold text-gray-800 mt-2">186</p>
          <div class="flex items-center mt-3">
            <span class="text-sm font-medium text-gray-500">75% of total</span>
          </div>
        </div>
        <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
          <i class="fa-solid fa-face-smile text-yellow-400 text-2xl"></i>
        </div>
      </div>
    </div>

    <!-- Negative Feedback -->
    <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
      <div class="flex items-center justify-between">
        <div>
          <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Negative</h3>
          <p class="text-3xl font-bold text-gray-800 mt-2">42</p>
          <div class="flex items-center mt-3">
            <span class="text-sm font-medium text-gray-500">17% of total</span>
          </div>
        </div>
        <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
          <i class="fa-solid fa-face-frown text-yellow-400 text-2xl"></i>
        </div>
      </div>
    </div>

    <!-- Pending Feedback -->
    <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
      <div class="flex items-center justify-between">
        <div>
          <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Pending</h3>
          <p class="text-3xl font-bold text-gray-800 mt-2">20</p>
          <div class="flex items-center mt-3">
            <span class="text-sm font-medium text-gray-500">Needs Response</span>
          </div>
        </div>
        <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
          <i class="fa-solid fa-circle-exclamation text-yellow-400 text-2xl"></i>
        </div>
      </div>
    </div>

  </div>

  <!-- Feedback Table -->
 <div class="overflow-x-auto mt-5 rounded-xl border border-gray-100 shadow-lg">
  <!-- Header -->
  <div class="bg-blue-900 text-white px-6 py-4 rounded-t-xl flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
    <div>
      <h2 class="text-lg font-semibold">Room Feedbacks</h2>
      <p class="text-sm opacity-80">Manage and respond to guest feedback</p>
    </div>
    <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
      <div class="flex border rounded-lg overflow-hidden">
        <input type="text" placeholder="Search feedback..." class="px-3 py-2 w-full outline-none">
        <button class="bg-yellow-400 text-blue-900 px-3 flex items-center justify-center">
          <i class="fa-solid fa-search"></i>
        </button>
      </div>
      <select class="border rounded-lg px-3 py-2">
        <option disabled selected>Filter by</option>
        <option>All Feedback</option>
        <option>Positive</option>
        <option>Negative</option>
        <option>Needs Response</option>
        <option>Resolved</option>
      </select>
    </div>
  </div>

  <!-- Table -->
  <table class="table w-full">
    <thead class="bg-gray-100">
      <tr>
        <th>Guest</th>
        <th>Room</th>
        <th>Rating</th>
        <th>Date</th>
        <th>Status</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse($myroomfeedbacks as $myroomfeedback)
      <tr class="hover:bg-gray-50">
        <td class="flex items-center gap-3">
          <img src="{{asset($myroomfeedback->guest_photo)}}" alt="avatar" class="w-10 h-10 rounded-full shadow-md">
          <span class="font-medium">{{$myroomfeedback->guest_name}}</span>
        </td>
        <td>{{$myroomfeedback->roomID}} {{$myroomfeedback->roomtype}}</td>
        <td>
          <div class="flex text-yellow-400">
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-regular fa-star"></i>
          </div>
        </td>
        <td>{{ \Carbon\Carbon::parse($myroomfeedback->roomfeedbackdate)->format('M d, Y') }}</td>
        <td>
         <span class="px-3 py-1 rounded-full text-xs font-medium
        @if($myroomfeedback->roomfeedbackstatus == 'Open')
          bg-yellow-100 text-yellow-700
        @elseif($myroomfeedback->roomfeedbackstatus == 'Closed')
          bg-green-100 text-green-700
        @else
          bg-gray-100 text-gray-600
        @endif">
        {{ $myroomfeedback->roomfeedbackstatus }}
      </span>
        </td>
        <td class="flex gap-2 justify-center items-center">
  <!-- Respond Button -->
  <button class="btn btn-primary btn-xs" >
    <i class="fa-solid fa-reply"></i>
  </button>

  <!-- Delete Button -->
  <button class="btn btn-error btn-xs">
    <i class="fa-solid fa-trash"></i>
  </button>
</td>
      </tr>
      @empty
      @endforelse
    </tbody>
  </table>
</div>


  <!-- Pagination -->
  <div class="flex justify-center mt-6">
    <div class="join">
      <button class="join-item btn btn-sm">«</button>
      <button class="join-item btn btn-sm btn-active">1</button>
      <button class="join-item btn btn-sm">2</button>
      <button class="join-item btn btn-sm">3</button>
      <button class="join-item btn btn-sm">4</button>
      <button class="join-item btn btn-sm">»</button>
    </div>
  </div>
</section>


<!-- Initialize Lucide Icons -->
<script src="https://unpkg.com/lucide@latest"></script>
<script>
  lucide.createIcons();
</script>
<!-- Initialize Lucide Icons -->
<script src="https://unpkg.com/lucide@latest"></script>
<script>
  lucide.createIcons();
</script>
  
           
      
 
        </main>
      </div>
    </div>

    {{-- modals --}}
 
   
  
 
  </body>

  @endauth
  @include('javascriptfix.soliera_js')

  {{-- recycable modals --}}
  

  <script src="{{asset('javascript/photouploadglobal.js')}}"></script>
  
</html>