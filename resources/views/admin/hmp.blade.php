<!DOCTYPE html>
<html lang="en" data-theme ="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    @vite('resources/css/app.css')
 
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <title>{{$title}} - Hotel Marketing And Promotion</title>
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
            <h1 class="text-2xl font-bold bg-white bg-clip-text text-[#191970]">Hotel Marketing And Promotion</h1>
          </div>
            {{-- Subsystem Name --}}

          {{-- content --}}
          <section class="w-full min-h-screen p-5">
            
            {{-- cards --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 max-w-6xl mx-auto">
                <!-- Card 1: Active Promotions -->
                <div class="card bg-white shadow-sm hover:shadow-md transition-shadow border border-gray-200 rounded-box">
                    <div class="card-body p-6">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="p-3 rounded-box bg-blue-100 text-blue-600">
                                <i class='bx bx-badge-check text-2xl'></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-700">Active Promotions</h3>
                                <p class="text-sm text-gray-500">Ongoing campaigns</p>
                            </div>
                        </div>
                        <p class="text-3xl font-bold text-gray-800 mb-2">12</p>
                        <div class="mt-2">
                            <span class="badge badge-sm badge-success gap-1">
                                <i class='bx bx-up-arrow-alt'></i> 5 new this week
                            </span>
                        </div>
                    </div>
                </div>
        
                <!-- Card 2: Total Bookings -->
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
        
                <!-- Card 3: Promo Revenue -->
                <div class="card bg-white shadow-sm hover:shadow-md transition-shadow border border-gray-200 rounded-box">
                    <div class="card-body p-6">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="p-3 rounded-box bg-purple-100 text-purple-600">
                                <i class='bx bx-credit-card text-2xl'></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-700">Promo Revenue</h3>
                                <p class="text-sm text-gray-500">From promotions</p>
                            </div>
                        </div>
                        <p class="text-3xl font-bold text-gray-800 mb-2">₱24,589</p>
                        <div class="text-sm text-purple-600 font-medium">
                            <i class='bx bx-trending-up'></i> 12% from last month
                        </div>
                    </div>
                </div>
        
                <!-- Card 4: Customer Engagement -->
                <div class="card bg-white shadow-sm hover:shadow-md transition-shadow border border-gray-200 rounded-box">
                    <div class="card-body p-6">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="p-3 rounded-box bg-amber-100 text-amber-600">
                                <i class='bx bx-chat text-2xl'></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-700">Engagement Rate</h3>
                                <p class="text-sm text-gray-500">Promo interactions</p>
                            </div>
                        </div>
                        <p class="text-3xl font-bold text-gray-800 mb-2">78%</p>
                        <progress class="progress progress-warning w-full" value="78" max="100"></progress>
                    </div>
                </div>
            </div>
            {{-- cards --}}
        
            <div class="mt-10 max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-6">
                {{-- table section --}}
                <div class="lg:col-span-2 bg-white p-6 rounded-box shadow-sm border border-gray-200">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">Marketing And Promotions Management</h2>
                        <div class="flex gap-3 w-full sm:w-auto">
                            <div class="relative flex-grow sm:flex-grow-0 sm:w-64">
                                <label class="input input-bordered flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 opacity-70">
                                        <path fill-rule="evenodd" d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z" clip-rule="evenodd" />
                                    </svg>
                                    {{-- search --}}
                                    <form action="/searchhmp" method="GET">
                                        @csrf
                                    <input name="searchhmp" type="text" class="grow" placeholder="Search promotions" />
                                    </form>
                                </label>
                            </div>
                            <button onclick = "createhmp.showModal()" class="btn btn-primary">
                                <i class='bx bx-plus'></i>
                                Add 
                            </button>
                        </div>
                    </div>
        
                    {{-- create modal --}}
                    @include('admin.components.hmp.createhmp')
                    {{--  --}}
        
                    <div class="overflow-x-auto">
                        <table class="table">
                         @include('admin.components.hmp.alerts')
                           
                            <thead>
                                <tr class="bg-gray-100 text-gray-700">
                                    <th class="font-semibold">#</th>
                                    <th class="font-semibold">Promo Name</th>
                                    <th class="font-semibold">Description</th>
                                    <th class="font-semibold">Status</th>
                                    <th class="font-semibold text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- row 1 -->
                                @forelse ($hmpdata as $hmp)
                                <tr class="hover:bg-gray-50">
                                    <td>{{$hmp->promoID}}</td>
                                    <td>
                                        <div class="font-medium">{{$hmp->hotelpromoname}}</div>
                                        <div class="text-sm text-gray-500">{{$hmp->hotelpromotag}}</div>
                                    </td>
                                    <td class="max-w-xs truncate">{{$hmp->hotelpromodescription}}</td>
                                    <td>
                                        @if ($hmp->hotelpromostatus == 'Active')
                                        <span class="badge badge-success badge-sm gap-1">
                                            <i class='bx bx-check-circle'></i> Active
                                        </span>
                                        @else
                                        <span class="badge badge-error badge-sm gap-1">
                                            <i class='bx  bx-x-circle'  ></i>  Expired
                                        </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="flex justify-end gap-2">
                                            <button  onclick="edit_modal_{{$hmp->promoID}}.showModal()" class="btn btn-sm btn-outline btn-info">
                                                <i class='bx bx-edit'></i>
                                              </button>
                                            <button onclick="delete_modal_{{ $hmp->promoID }}.showModal()" class="btn btn-sm btn-outline btn-error">
                                                <i class='bx bx-trash'></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                              
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-8">
                                        <div class="flex flex-col items-center justify-center text-gray-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-inbox">
                                                <polyline points="22 12 16 12 14 15 10 15 8 12 2 12"></polyline>
                                                <path d="M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"></path>
                                            </svg>
                                            <span class="mt-2 text-sm font-medium">No Data found</span>
                                        </div>
                                    </td>
                                </tr>
                                
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- table section --}}
        
                {{-- recent promotions sidebar --}}
               @include('admin.components.hmp.carousel')
                {{-- end recent promotions sidebar --}}
            </div>
        </section>
  
           
      
 
        </main>
      </div>
    </div>

    {{-- modals --}}
   @foreach ($hmpdata as $hmp )
   @include('admin.components.hmp.edithmp')
   @include('admin.components.hmp.deletehmp')
   @endforeach
      
  
 
  </body>
  @include('javascriptfix.soliera_js')

  <script src="{{asset('javascript/photouploadglobal.js')}}"></script>
  
</html>