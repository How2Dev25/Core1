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
<!-- Service Requests & Concerns CRM Section -->
<section class="w-full p-6 ">
  <!-- Header with Tabs and Actions -->
  <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
    <div>
      <h2 class="text-2xl font-bold flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clipboard-list">
          <rect width="8" height="4" x="8" y="2" rx="1" ry="1"/>
          <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/>
          <path d="M12 11h4"/>
          <path d="M12 16h4"/>
          <path d="M8 11h.01"/>
          <path d="M8 16h.01"/>
        </svg>
        Service Requests & Concerns
      </h2>
      <p class="text-sm text-gray-500">Manage guest service tickets and reported issues</p>
    </div>
    
    <div class="flex gap-3">
     
      
      <button class="btn btn-primary">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus">
          <path d="M5 12h14"/>
          <path d="M12 5v14"/>
        </svg>
        New Ticket
      </button>
    </div>
  </div>

  <!-- Priority Stats -->
  <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
    <div class="stats bg-base-200 shadow">
      <div class="stat">
        <div class="stat-figure text-info">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-inbox">
            <polyline points="22 12 16 12 14 15 10 15 8 12 2 12"/>
            <path d="M5.45 5.11 2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"/>
          </svg>
        </div>
        <div class="stat-title">Total Open</div>
        <div class="stat-value">47</div>
        <div class="stat-desc">5 new today</div>
      </div>
    </div>
    
    <div class="stats bg-error text-error-content shadow">
      <div class="stat">
        <div class="stat-figure">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-alert-triangle">
            <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/>
            <path d="M12 9v4"/>
            <path d="M12 17h.01"/>
          </svg>
        </div>
        <div class="stat-title">High Priority</div>
        <div class="stat-value">12</div>
        <div class="stat-desc">Urgent attention needed</div>
      </div>
    </div>
    
    <div class="stats bg-warning text-warning-content shadow">
      <div class="stat">
        <div class="stat-figure">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock">
            <circle cx="12" cy="12" r="10"/>
            <polyline points="12 6 12 12 16 14"/>
          </svg>
        </div>
        <div class="stat-title">In Progress</div>
        <div class="stat-value">23</div>
        <div class="stat-desc">Being addressed</div>
      </div>
    </div>
    
    <div class="stats bg-success text-success-content shadow">
      <div class="stat">
        <div class="stat-figure">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-circle-2">
            <path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"/>
            <path d="m9 12 2 2 4-4"/>
          </svg>
        </div>
        <div class="stat-title">Resolved</div>
        <div class="stat-value">154</div>
        <div class="stat-desc">This month</div>
      </div>
    </div>
  </div>

  <!-- Service Requests Table -->
  <div class="overflow-x-auto bg-base-100 rounded-box shadow">
    <table class="table">
      <thead>
        <tr>
          <th>Ticket ID</th>
          <th>Guest/Room</th>
          <th>Request Type</th>
          <th>Description</th>
          <th>Priority</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <!-- High Priority Request -->
        <tr class="hover:bg-base-200">
          <td>#SR-2847</td>
          <td>
            <div class="flex items-center gap-3">
              <div class="avatar placeholder">
                <div class="mask mask-squircle w-10 h-10 bg-neutral text-neutral-content">
                  <span>TL</span>
                </div>
              </div>
              <div>
                <div class="font-bold">Thomas Lee</div>
                <div class="text-sm opacity-50">Suite #512</div>
              </div>
            </div>
          </td>
          <td>
            <div class="flex items-center gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-wrench">
                <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/>
              </svg>
              Maintenance
            </div>
          </td>
          <td class="max-w-xs truncate">Bathroom flooding - pipe leak under sink</td>
          <td>
            <span class="badge badge-error gap-1">
              <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-alert-triangle">
                <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/>
              </svg>
              High
            </span>
          </td>
          <td>
            <span class="badge badge-warning gap-1">
              <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock">
                <circle cx="12" cy="12" r="10"/>
                <polyline points="12 6 12 12 16 14"/>
              </svg>
              In Progress
            </span>
          </td>
          <td>
            <button class="btn btn-ghost btn-xs">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up-right-from-square">
                <path d="M21 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h6"/>
                <path d="m21 3-9 9"/>
                <path d="M15 3h6v6"/>
              </svg>
              Assign
            </button>
          </td>
        </tr>
        
        <!-- Medium Priority Request -->
        <tr class="hover:bg-base-200">
          <td>#SR-2846</td>
          <td>
            <div class="flex items-center gap-3">
              <div class="avatar">
                <div class="mask mask-squircle w-10 h-10">
                  <img src="/images/guest2.jpg" alt="Guest Avatar">
                </div>
              </div>
              <div>
                <div class="font-bold">Maria Garcia</div>
                <div class="text-sm opacity-50">Deluxe #307</div>
              </div>
            </div>
          </td>
          <td>
            <div class="flex items-center gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sparkles">
                <path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z"/>
                <path d="M5 3v4"/>
                <path d="M19 17v4"/>
                <path d="M3 5h4"/>
                <path d="M17 19h4"/>
              </svg>
              Amenities
            </div>
          </td>
          <td class="max-w-xs truncate">Request for extra towels and toiletries</td>
          <td>
            <span class="badge badge-warning gap-1">
              <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-alert-circle">
                <circle cx="12" cy="12" r="10"/>
                <line x1="12" x2="12" y1="8" y2="12"/>
                <line x1="12" x2="12.01" y1="16" y2="16"/>
              </svg>
              Medium
            </span>
          </td>
          <td>
            <span class="badge badge-info gap-1">
              <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-inbox">
                <polyline points="22 12 16 12 14 15 10 15 8 12 2 12"/>
                <path d="M5.45 5.11 2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"/>
              </svg>
              New
            </span>
          </td>
          <td>
            <button class="btn btn-ghost btn-xs">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-round-plus">
                <path d="M2 21a8 8 0 0 1 13.292-6"/>
                <circle cx="10" cy="8" r="5"/>
                <path d="M19 16v6"/>
                <path d="M22 19h-6"/>
              </svg>
              Assign
            </button>
          </td>
        </tr>
        
        <!-- Low Priority Request -->
        <tr class="hover:bg-base-200">
          <td>#SR-2845</td>
          <td>
            <div class="flex items-center gap-3">
              <div class="avatar placeholder">
                <div class="mask mask-squircle w-10 h-10 bg-neutral text-neutral-content">
                  <span>RS</span>
                </div>
              </div>
              <div>
                <div class="font-bold">Robert Smith</div>
                <div class="text-sm opacity-50">Standard #214</div>
              </div>
            </div>
          </td>
          <td>
            <div class="flex items-center gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-broom">
                <path d="m9.06 11.9 8.07-8.06a2.85 2.85 0 1 1 4.03 4.03l-8.06 8.08"/>
                <path d="M7.07 14.94c-1.66 0-3 1.35-3 3.02 0 1.33-2.5 1.52-2 2.02 1.08 1.1 2.49 2.02 4 2.02 2.2 0 4-1.8 4-4.04a3.01 3.01 0 0 0-3-3.02z"/>
              </svg>
              Housekeeping
            </div>
          </td>
          <td class="max-w-xs truncate">Room cleaning request - please change bedsheets</td>
          <td>
            <span class="badge badge-success gap-1">
              <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-info">
                <circle cx="12" cy="12" r="10"/>
                <path d="M12 16v-4"/>
                <path d="M12 8h.01"/>
              </svg>
              Low
            </span>
          </td>
          <td>
            <span class="badge badge-success gap-1">
              <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check">
                <path d="M20 6 9 17l-5-5"/>
              </svg>
              Completed
            </span>
          </td>
          <td>
            <button class="btn btn-ghost btn-xs">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-text">
                <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7z"/>
                <path d="M14 2v4a2 2 0 0 0 2 2h4"/>
                <path d="M10 9H8"/>
                <path d="M16 13H8"/>
                <path d="M16 17H8"/>
              </svg>
              Details
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- Pagination and Summary -->
  <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mt-6">
    <div class="text-sm text-gray-500">
      Showing <span class="font-medium">1</span> to <span class="font-medium">3</span> of <span class="font-medium">47</span> open requests
    </div>
    <div class="join">
      <button class="join-item btn btn-sm">«</button>
      <button class="join-item btn btn-sm btn-active">1</button>
      <button class="join-item btn btn-sm">2</button>
      <button class="join-item btn btn-sm">3</button>
      <button class="join-item btn btn-sm">...</button>
      <button class="join-item btn btn-sm">8</button>
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