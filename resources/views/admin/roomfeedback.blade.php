<!DOCTYPE html>
<html lang="en" data-theme ="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    @vite('resources/css/app.css')
 
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <title>{{$title}} - Inventory And Stock</title>
</head>
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
<section class="w-full p-6 ">
  <!-- Header with Filters -->
  <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
    <div>
      <h2 class="text-2xl font-bold flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-square-text">
          <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
          <path d="M13 8H7"/>
          <path d="M17 12H7"/>
        </svg>
        Room Feedbacks
      </h2>
      <p class="text-sm text-gray-500">Manage and respond to guest feedback</p>
    </div>
    
    <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
      <div class="join">
        <input type="text" placeholder="Search feedback..." class="input input-bordered join-item w-full">
        <button class="btn btn-primary join-item">
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search">
            <circle cx="11" cy="11" r="8"/>
            <path d="m21 21-4.3-4.3"/>
          </svg>
        </button>
      </div>
      
      <select class="select select-bordered w-full sm:w-auto">
        <option disabled selected>Filter by</option>
        <option>All Feedback</option>
        <option>Positive</option>
        <option>Negative</option>
        <option>Needs Response</option>
        <option>Resolved</option>
      </select>
    </div>
  </div>

  <!-- Stats Cards -->
  <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
    <div class="stats bg-base-200 shadow">
      <div class="stat">
        <div class="stat-figure text-primary">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-messages-square">
            <path d="M14 9a2 2 0 0 1-2 2H6l-4 4V4c0-1.1.9-2 2-2h8a2 2 0 0 1 2 2z"/>
            <path d="M18 9h2a2 2 0 0 1 2 2v11l-4-4h-6a2 2 0 0 1-2-2v-1"/>
          </svg>
        </div>
        <div class="stat-title">Total Feedback</div>
        <div class="stat-value">248</div>
        <div class="stat-desc">+12% from last month</div>
      </div>
    </div>
    
    <div class="stats bg-base-200 shadow">
      <div class="stat">
        <div class="stat-figure text-secondary">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-smile">
            <circle cx="12" cy="12" r="10"/>
            <path d="M8 14s1.5 2 4 2 4-2 4-2"/>
            <line x1="9" x2="9.01" y1="9" y2="9"/>
            <line x1="15" x2="15.01" y1="9" y2="9"/>
          </svg>
        </div>
        <div class="stat-title">Positive</div>
        <div class="stat-value">186</div>
        <div class="stat-desc">75% of total</div>
      </div>
    </div>
    
    <div class="stats bg-base-200 shadow">
      <div class="stat">
        <div class="stat-figure text-error">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-frown">
            <circle cx="12" cy="12" r="10"/>
            <path d="M16 16s-1.5-2-4-2-4 2-4 2"/>
            <line x1="9" x2="9.01" y1="9" y2="9"/>
            <line x1="15" x2="15.01" y1="9" y2="9"/>
          </svg>
        </div>
        <div class="stat-title">Negative</div>
        <div class="stat-value">42</div>
        <div class="stat-desc">17% of total</div>
      </div>
    </div>
    
    <div class="stats bg-base-200 shadow">
      <div class="stat">
        <div class="stat-figure text-warning">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-alert-circle">
            <circle cx="12" cy="12" r="10"/>
            <line x1="12" x2="12" y1="8" y2="12"/>
            <line x1="12" x2="12.01" y1="16" y2="16"/>
          </svg>
        </div>
        <div class="stat-title">Pending</div>
        <div class="stat-value">20</div>
        <div class="stat-desc">8% need response</div>
      </div>
    </div>
  </div>

  <!-- Feedback Table -->
  <div class="overflow-x-auto bg-base-100 rounded-box shadow">
    <table class="table">
      <thead>
        <tr>
          <th>Guest</th>
          <th>Room</th>
          <th>Rating</th>
          <th>Feedback</th>
          <th>Date</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <!-- Feedback Item 1 -->
        <tr class="hover:bg-base-200">
          <td>
            <div class="flex items-center gap-3">
              <div class="avatar">
                <div class="mask mask-squircle w-10 h-10">
                  <img src="/images/guest1.jpg" alt="Guest Avatar">
                </div>
              </div>
              <div>
                <div class="font-bold">John Smith</div>
                <div class="text-sm opacity-50">VIP Member</div>
              </div>
            </div>
          </td>
          <td>Deluxe #304</td>
          <td>
            <div class="flex items-center gap-1">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star text-yellow-400">
                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
              </svg>
              <span>4.8</span>
            </div>
          </td>
          <td class="max-w-xs truncate">Excellent service and very clean room. Will definitely return!</td>
          <td>2023-11-15</td>
          <td>
            <span class="badge badge-success badge-sm gap-1">
              <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check">
                <path d="M20 6 9 17l-5-5"/>
              </svg>
              Resolved
            </span>
          </td>
          <td>
            <button class="btn btn-ghost btn-xs">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye">
                <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/>
                <circle cx="12" cy="12" r="3"/>
              </svg>
              View
            </button>
          </td>
        </tr>
        
        <!-- Feedback Item 2 (Negative) -->
        <tr class="hover:bg-base-200">
          <td>
            <div class="flex items-center gap-3">
              <div class="avatar placeholder">
                <div class="mask mask-squircle w-10 h-10 bg-neutral text-neutral-content">
                  <span>EM</span>
                </div>
              </div>
              <div>
                <div class="font-bold">Emma Johnson</div>
                <div class="text-sm opacity-50">New Guest</div>
              </div>
            </div>
          </td>
          <td>Standard #205</td>
          <td>
            <div class="flex items-center gap-1">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star text-yellow-400">
                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
              </svg>
              <span>2.3</span>
            </div>
          </td>
          <td class="max-w-xs truncate">The AC wasn't working properly and the bathroom needed cleaning...</td>
          <td>2023-11-18</td>
          <td>
            <span class="badge badge-warning badge-sm gap-1">
              <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-alert-circle">
                <circle cx="12" cy="12" r="10"/>
                <line x1="12" x2="12" y1="8" y2="12"/>
                <line x1="12" x2="12.01" y1="16" y2="16"/>
              </svg>
              Pending
            </span>
          </td>
          <td>
            <button class="btn btn-ghost btn-xs">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-square-plus">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                <line x1="9" x2="15" y1="10" y2="10"/>
                <line x1="12" x2="12" y1="7" y2="13"/>
              </svg>
              Respond
            </button>
          </td>
        </tr>
        
        <!-- Feedback Item 3 (Neutral) -->
        <tr class="hover:bg-base-200">
          <td>
            <div class="flex items-center gap-3">
              <div class="avatar">
                <div class="mask mask-squircle w-10 h-10">
                  <img src="/images/guest3.jpg" alt="Guest Avatar">
                </div>
              </div>
              <div>
                <div class="font-bold">Robert Chen</div>
                <div class="text-sm opacity-50">Business</div>
              </div>
            </div>
          </td>
          <td>Executive #401</td>
          <td>
            <div class="flex items-center gap-1">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star text-yellow-400">
                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
              </svg>
              <span>3.5</span>
            </div>
          </td>
          <td class="max-w-xs truncate">Good location but the WiFi was spotty. Breakfast could be improved.</td>
          <td>2023-11-20</td>
          <td>
            <span class="badge badge-info badge-sm gap-1">
              <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock">
                <circle cx="12" cy="12" r="10"/>
                <polyline points="12 6 12 12 16 14"/>
              </svg>
              In Progress
            </span>
          </td>
          <td>
            <button class="btn btn-ghost btn-xs">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye">
                <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/>
                <circle cx="12" cy="12" r="3"/>
              </svg>
              View
            </button>
          </td>
        </tr>
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
  @include('javascriptfix.soliera_js')

  <script src="{{asset('javascript/photouploadglobal.js')}}"></script>
  
</html>