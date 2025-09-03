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
    
    <title>{{$title}} - Inventory And Stock</title>
</head>
@auth('guest')
    

<body class="bg-base-100">
    <div class="flex h-screen overflow-hidden">
      <!-- Sidebar -->
     @include('guest.components.dashboard.sidebar')
  
      <!-- Main content -->
      <div class="flex flex-col flex-1 overflow-hidden">
        <!-- Navbar -->
         @include('guest.components.dashboard.navbar')
  
        <!-- Dashboard Content -->
        <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 transition-slow ">
            {{-- Subsystem Name --}}
          <div class="pb-5 border-b border-base-300 animate-fadeIn">
            <h1 class="text-2xl font-bold bg-white bg-clip-text text-[#191970]">Room Feedbacks</h1>
          </div>
            {{-- Subsystem Name --}}

          {{-- content --}}
            <section class="flex-1 p-4 md:p-6">
  <!-- Header -->
  <div class="text-center mb-10">
    <div class="inline-block p-3 rounded-full mb-4" style="background-color: #001f54;">
      <i class="fa-solid fa-comments text-2xl" style="color: #F7B32B;"></i>
    </div>
    <h2 class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-blue-900 to-blue-700 bg-clip-text text-transparent" style="color: #001f54;">We Value Your Feedback</h2>
    <p class="text-sm text-gray-600 mt-2 max-w-md mx-auto">Share your stay experience and help us improve our services for future guests.</p>
    <button onclick="document.getElementById('createFeedbackModal').showModal()" 
      class="btn btn-primary mt-6 rounded-full px-6 py-3 shadow-md hover:shadow-lg transition-all duration-300">
      <i class="fa-solid fa-pen mr-2" style="color: #001f54;"></i> Share Your Experience
    </button>
  </div>

  @if(session('success'))
    <div class="mb-4 px-4 py-3 rounded-lg bg-green-100 border border-green-300 text-green-800 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <i class="fa-solid fa-circle-check"></i>
            <span>{{ session('success') }}</span>
        </div>
        <button onclick="this.parentElement.remove()" class="text-green-600 hover:text-green-900">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
@endif

  <!-- Guest Feedback Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
  @forelse($myroomfeedbacks as $myroomfeedback)
 <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
    <!-- Guest Info -->
    <div class="flex items-center gap-3 mb-4">
      <div class="h-12 w-12 rounded-full flex items-center justify-center font-bold text-lg shadow-inner" style="background-color: #001f54; color: #F7B32B;">
        {{ strtoupper(substr($myroomfeedback->guest_name, 0, 2)) }}
      </div>
      <div>
        <h3 class="font-semibold text-gray-800">{{ $myroomfeedback->guest_name }}</h3>
        <p class="text-xs text-gray-500">Stayed in {{ $myroomfeedback->roomtype }} #{{ $myroomfeedback->roomID }}</p>
      </div>
    </div>

    <!-- Room Photo -->
    @if(!empty($myroomfeedback->roomphoto))
      <div class="mb-4">
        <img src="{{ asset( $myroomfeedback->roomphoto) }}" 
             alt="Room Photo" 
             class="w-full h-48 object-cover rounded-lg shadow">
      </div>
    @endif

    <!-- Rating -->
    <div class="flex items-center mb-3">
      @for ($i = 1; $i <= 5; $i++)
        <i class="{{ $i <= $myroomfeedback->roomrating ? 'fa-solid fa-star' : 'fa-regular fa-star' }}" style="color: #F7B32B;"></i>
      @endfor
      <span class="ml-2 text-gray-600 text-sm font-medium">{{ $myroomfeedback->roomrating }} / 5</span>
    </div>

    <!-- Feedback -->
    <p class="text-gray-700 text-sm mb-4 relative pl-4">
      <span class="absolute left-0 top-0 text-xl font-serif" style="color: #F7B32B;">"</span>
      {{ $myroomfeedback->roomfeedbackfeedback }}
    </p>

    <!-- Status -->
    <div class="mb-4">
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
    </div>

    <!-- Date -->
    <div class="text-xs text-gray-500 flex justify-between items-center mb-4">
      <span class="text-xs flex items-center" style="color: #001f54;">
        <i class="fa-solid fa-check-circle mr-1" style="color: #F7B32B;"></i> Verified Stay
      </span>
      <span>{{ \Carbon\Carbon::parse($myroomfeedback->roomfeedbackdate)->format('M d, Y') }}</span>
    </div>

    <!-- Action Buttons -->
    <!-- Action Buttons -->
<div class="flex justify-end gap-2">
  <button 
    class="px-3 py-1.5 rounded-lg text-xs font-medium bg-blue-100 text-blue-700 hover:bg-blue-200 transition">
    View
  </button>

  <button 
    class="px-3 py-1.5 rounded-lg text-xs font-medium bg-yellow-100 text-yellow-700 hover:bg-yellow-200 transition">
    Edit
  </button>

  <button 
    class="px-3 py-1.5 rounded-lg text-xs font-medium bg-red-100 text-red-700 hover:bg-red-200 transition">
    Delete
  </button>
</div>
  </div>

  @empty
    <!-- Place the empty state OUTSIDE the grid -->
</div> 

<div class="text-center py-12 rounded-2xl" style="background-color: rgba(0, 31, 84, 0.05);">
  <i class="fa-solid fa-comment-dots text-5xl mb-4" style="color: #001f54;"></i>
  <h3 class="text-xl font-semibold mb-2" style="color: #001f54;">No feedback yet</h3>
  <p class="text-gray-600 max-w-md mx-auto">Be the first to share your experience about your recent stay.</p>
</div>
  @endforelse


  <!-- Empty state (hidden by default) -->
  

  <!-- Create Feedback Modal -->
  @include('guest.components.roomfeedback.create')
</section>

<style>
  /* Custom styles for the rating interaction */
  #rating-stars input:checked ~ i {
    font-weight: 900 !important;
  }
  
  /* Style for primary button */
  

  /* Smooth transitions for modal */
  dialog[open] {
    animation: fadeIn 0.3s ease normal;
  }
  
  @keyframes fadeIn {
    from {
      opacity: 0;
      transform: translateY(-20px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
</style>

<script>
  // Add interactive rating text
  document.querySelectorAll('input[name="roomrating"]').forEach(star => {
    star.addEventListener('change', function() {
      const ratingText = document.getElementById('rating-text');
      const value = parseInt(this.value);
      
      const texts = [
        "Poor",
        "Fair",
        "Good",
        "Very Good",
        "Excellent"
      ];
      
      ratingText.textContent = texts[value - 1];
      ratingText.className = "text-center text-sm font-medium mt-1 " + 
        (value >= 4 ? "text-green-600" : value >= 3 ? "text-yellow-600" : "text-red-600");
    });
  });
</script>



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

  <script src="{{asset('javascript/photouploadglobal.js')}}"></script>
  
</html>