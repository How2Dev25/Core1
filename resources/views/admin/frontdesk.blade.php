<!DOCTYPE html>
<html lang="en" data-theme ="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    @vite('resources/css/app.css')
 
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <title>{{$title}} - Front Desk And Reception</title>
      @livewireStyles
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
            <h1 class="text-2xl font-bold bg-white bg-clip-text text-[#191970]">Front Desk And Reception</h1>
          </div>
            {{-- Subsystem Name --}}

            <section class="p-5">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10 mt-5">
              <!-- Card 1 -->
              <div class="card bg-gradient-to-br from-blue-50 to-white border border-blue-100">
                <div class="card-body p-5">
                  <div class="flex items-center gap-4">
                    <div class="p-3 rounded-lg bg-blue-100 text-blue-600">
                      <i data-lucide = "book-check"></i>
                    </div>
                    <div>
                      <h3 class="text-lg font-semibold">Total Reservation</h3>
                    </div>
                  </div>
                    <livewire:total-reservation />
                </div>
              </div>
          
              <!-- Card 2 Available Room -->
              <div class="card bg-gradient-to-br from-green-50 to-white border border-green-100">
                <div class="card-body p-5">
                  <div class="flex items-center gap-4">
                    <div class="p-3 rounded-lg bg-green-100 text-green-600">
                        <i data-lucide="hotel"></i>
                    </div>
                    <div>
                      <h3 class="text-lg font-semibold">Available Rooms</h3>
                     
                    </div>
                  </div>
                 <livewire:available-rooms />
                </div>
              </div>
          
              <!-- Card 3 -->
              <div class="card bg-gradient-to-br from-purple-50 to-white border border-purple-100">
                <div class="card-body p-5">
                  <div class="flex items-center gap-4">
                    <div class="p-3 rounded-lg bg-purple-100 text-purple-600">
                     <i data-lucide="book-open-check"></i>
                    </div>
                    <div>
                      <h3 class="text-lg font-semibold">Occupied Rooms</h3>
                    </div>
                  </div>
                  <livewire:occupied-rooms />
                </div>
              </div>
          
              <!-- Card 4 -->
              <div class="card bg-gradient-to-br from-amber-50 to-white border border-amber-100">
                <div class="card-body p-5">
                  <div class="flex items-center gap-4">
                    <div class="p-3 rounded-lg bg-amber-100 text-amber-600">
                        <i data-lucide="square-arrow-out-up-right"></i>
                    </div>
                    <div>
                      <h3 class="text-lg font-semibold">Channels Booking</h3>
                    
                    </div>
                  </div>
                <livewire:channels-booking />
                </div>
              </div>
            </div>


            <div class="">
                <button onclick="add_booking.showModal()" class="btn btn-primary btn-sm">
                  <i data-lucide="plus"></i>
                  View Available Rooms
                </button>
            </div>

            


             <livewire:approve-reserve />


            



  <div class="card bg-white border border-gray-200 mt-5">
    <div class="card-body p-0">
      <div class="flex flex-col md:flex-row justify-between items-start md:items-center p-5 pb-0">
        <h3 class="text-xl font-bold text-gray-800">Occupied Rooms</h3>
        <div class="flex gap-2 mt-3 md:mt-0">
          <select class="select select-bordered select-sm">
            <option>All Status</option>
            <option>Available</option>
            <option>Occupied</option>
            <option>Maintenance</option>
          </select>
          <input type="text" placeholder="Search room numbers..." class="input input-bordered input-sm">
        </div>
      </div>
      
      <div class="overflow-x-auto">
        <table class="table">
          <thead>
            <tr>
              <th class="bg-gray-50">Room No.</th>
              <th class="bg-gray-50">Type</th>
              <th class="bg-gray-50">Status</th>
              <th class="bg-gray-50">Guest</th>
              <th class="bg-gray-50">Check-In</th>
              <th class="bg-gray-50">Check-Out</th>
              <th class="bg-gray-50 text-right">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr class="hover:bg-gray-50">
              <td>305</td>
              <td>
                <div class="flex items-center gap-2">
                  <div class="badge badge-primary badge-xs"></div>
                  Deluxe
                </div>
              </td>
              <td><span class="badge badge-success">Occupied</span></td>
              <td>John Smith</td>
              <td>Jun 15, 2025</td>
              <td>Jun 18, 2025</td>
              <td class="text-right">
                <button class="btn btn-ghost btn-xs text-info">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                  </svg>
                </button>
              </td>
            </tr>
            <tr class="hover:bg-gray-50">
              <td>402</td>
              <td>
                <div class="flex items-center gap-2">
                  <div class="badge badge-secondary badge-xs"></div>
                  Suite
                </div>
              </td>
              <td><span class="badge badge-success">Occupied</span></td>
              <td>Sarah Johnson</td>
              <td>Jun 12, 2025</td>
              <td>Jun 20, 2025</td>
              <td class="text-right">
                <button class="btn btn-ghost btn-xs text-info">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                  </svg>
                </button>
              </td>
            </tr>
            <tr class="hover:bg-gray-50">
              <td>112</td>
              <td>
                <div class="flex items-center gap-2">
                  <div class="badge badge-accent badge-xs"></div>
                  Standard
                </div>
              </td>
              <td><span class="badge badge-warning">Maintenance</span></td>
              <td>-</td>
              <td>-</td>
              <td>-</td>
              <td class="text-right">
                <button class="btn btn-ghost btn-xs text-info">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                  </svg>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      
   
    
    </div>
  </div>

          {{-- content --}}
</section>


{{-- modals --}}

 

<!-- Initialize Lucide Icons -->
<script>
  lucide.createIcons();
</script>

        


           
      
 
        </main>
      </div>
    </div>

   
    
    
   
   @livewireScripts
  @include('javascriptfix.soliera_js')
  </body>


  <script src="{{asset('javascript/photouploadglobal.js')}}"></script>
  
</html>