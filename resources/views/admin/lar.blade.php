<!DOCTYPE html>
<html lang="en" data-theme ="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    @vite('resources/css/app.css')
 
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <title>{{$title}} - Loyalty And Rewards</title>
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
            <h1 class="text-2xl font-bold text-[#191970] bg-clip-text ">Loyalty And Rewards </h1>
          </div>
            {{-- Subsystem Name --}}
           
          {{-- content --}}

          <section class="mt-2"> 
           <div class="w-full grid grid-cols-3 gap-5 max-md:grid-cols-1">
               <div class="card bg-white shadow-sm hover:shadow-md transition-shadow border border-gray-200 rounded-box">
                    <div class="card-body p-6">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="p-3 rounded-box bg-green-100 text-green-600">
                                <i class='bx bx-calendar-check text-2xl'></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-700">Total Bookings</h3>
                                <p class="text-sm text-gray-500">This month</p>
                            </div>
                        </div>
                        <p class="text-3xl font-bold text-gray-800 mb-2">342</p>
                        <div class="radial-progress text-green-500" style="--value:75; --size:2.5rem; --thickness:4px;">75%</div>
                    </div>
                </div>

                 <div class="card bg-white shadow-sm hover:shadow-md transition-shadow border border-gray-200 rounded-box">
                    <div class="card-body p-6">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="p-3 rounded-box bg-green-100 text-green-600">
                                <i class='bx bx-calendar-check text-2xl'></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-700">Total Bookings</h3>
                                <p class="text-sm text-gray-500">This month</p>
                            </div>
                        </div>
                        <p class="text-3xl font-bold text-gray-800 mb-2">342</p>
                        <div class="radial-progress text-green-500" style="--value:75; --size:2.5rem; --thickness:4px;">75%</div>
                    </div>
                </div>

                 <div class="card bg-white shadow-sm hover:shadow-md transition-shadow border border-gray-200 rounded-box">
                    <div class="card-body p-6">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="p-3 rounded-box bg-green-100 text-green-600">
                                <i class='bx bx-calendar-check text-2xl'></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-700">Total Bookings</h3>
                                <p class="text-sm text-gray-500">This month</p>
                            </div>
                        </div>
                        <p class="text-3xl font-bold text-gray-800 mb-2">342</p>
                        <div class="radial-progress text-green-500" style="--value:75; --size:2.5rem; --thickness:4px;">75%</div>
                    </div>
                </div>
           </div>


           <div class="mt-2">
              <button class="btn btn-primary btn-sm ">
                  Add Rewards
              </button>

                
           </div>
          </section>

        

<!-- Initialize Lucide Icons -->
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