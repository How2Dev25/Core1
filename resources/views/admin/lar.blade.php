<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  @vite('resources/css/app.css')

  <script src="https://unpkg.com/lucide@latest"></script>
  @livewireStyles

  <title>{{$title}} - Loyalty And Rewards</title>
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
            <h1 class="text-2xl font-bold text-[#191970] bg-clip-text ">Loyalty And Rewards </h1>
          </div>
          {{-- Subsystem Name --}}

          {{-- content --}}

          <section class="mt-2">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
              <!-- Total Points Card -->
              <div class="card bg-white shadow-sm border border-gray-200 rounded-box
              transition-all duration-300 ease-in-out
              hover:shadow-lg hover:-translate-y-1 hover:border-blue-200
              hover:bg-gradient-to-br hover:from-white hover:to-blue-500
              group ">
                <div class="card-body p-6">
                  <div class="flex items-center gap-4 mb-4">
                    <div class="p-3 rounded-box bg-blue-100 text-blue-600
                     group-hover:bg-blue-600 group-hover:text-white
                     transition-colors duration-300">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-gem">
                        <path d="M6 3h12l4 6-10 13L2 9Z" />
                        <path d="M11 3 8 9l4 13 4-13-3-6" />
                        <path d="M2 9h20" />
                      </svg>
                    </div>
                    <div>
                      <h3 class="text-lg font-semibold text-gray-700 group-hover:text-blue-800 transition-colors">Total
                        Points</h3>
                      <p class="text-sm text-gray-500 group-hover:text-blue-600 transition-colors">All customers</p>
                    </div>
                  </div>
                  <p class="text-3xl font-bold text-gray-800 mb-2 group-hover:text-blue-900 transition-colors">
                    {{$totalpoints}}</p>
                  <div class="radial-progress text-blue-500 group-hover:text-blue-600 transition-colors"
                    style="--value:82; --size:2.5rem; --thickness:4px;">82%</div>
                </div>
              </div>

              <!-- Active Members Card -->
              <div class="card border border-gray-200 rounded-box 
              transition-all duration-300 ease-in-out
              hover:shadow-lg hover:-translate-y-1 hover:border-purple-200
              hover:bg-gradient-to-br hover:from-white hover:to-purple-500
              group">
                <div class="card-body p-6">
                  <div class="flex items-center gap-4 mb-4">
                    <div class="p-3 rounded-box bg-purple-100 text-purple-600 
                     group-hover:bg-purple-600 group-hover:text-white 
                     transition-colors duration-300">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-users">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                      </svg>
                    </div>
                    <div>
                      <h3 class="text-lg font-semibold text-gray-700 group-hover:text-purple-800 transition-colors">Active
                        Members</h3>
                      <p class="text-sm text-gray-500 group-hover:text-purple-600 transition-colors">This month</p>
                    </div>
                  </div>
                  <p class="text-3xl font-bold text-gray-800 mb-2 group-hover:text-purple-900 transition-colors">1,842</p>
                  <div class="radial-progress text-purple-500 group-hover:text-purple-600 transition-colors"
                    style="--value:68; --size:2.5rem; --thickness:4px;">68%</div>
                </div>
              </div>

              <!-- Redemptions Card -->
              <div class="card bg-white shadow-sm border border-gray-200 rounded-box
              transition-all duration-300 ease-in-out
              hover:shadow-lg hover:-translate-y-1 hover:border-green-200
              hover:bg-gradient-to-br hover:from-white hover:to-green-500
              group">
                <div class="card-body p-6">
                  <div class="flex items-center gap-4 mb-4">
                    <div class="p-3 rounded-box bg-green-100 text-green-600
                     group-hover:bg-green-600 group-hover:text-white
                     transition-colors duration-300">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-gift">
                        <rect x="3" y="8" width="18" height="4" rx="1" />
                        <path d="M12 8v13" />
                        <path d="M19 12v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-7" />
                        <path d="M7.5 8a2.5 2.5 0 0 1 0-5A4.8 8 0 0 1 12 8a4.8 8 0 0 1 4.5-5 2.5 2.5 0 0 1 0 5" />
                      </svg>
                    </div>
                    <div>
                      <h3 class="text-lg font-semibold text-gray-700 group-hover:text-green-800 transition-colors">Total
                        Rewards</h3>
                      <p class="text-sm text-gray-500 group-hover:text-green-600 transition-colors">Total of Loyalties And
                        Rewards</p>
                    </div>
                  </div>
                  <p class="text-3xl font-bold text-gray-800 mb-2 group-hover:text-green-900 transition-colors">
                    {{$totalreward}}</p>
                  <div class="radial-progress text-green-500 group-hover:text-green-600 transition-colors"
                    style="--value:75; --size:2.5rem; --thickness:4px;">75%</div>
                </div>
              </div>
            </div>


            <div class="mt-5">
              <button onclick="create_lar.showModal()" class="btn btn-primary btn-sm ">
                Add Rewards
              </button>
            </div>

            {{-- alerts --}}

            @if(session('Added'))
              <div role="alert" class="alert alert-success mt-2 mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                  viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{session('Added')}}</span>
              </div>
            @elseif(session('Updated'))
              <div role="alert" class="alert alert-success mt-2 mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                  viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{session('Updated')}}</span>
              </div>
            @elseif(session('Deleted'))
              <div role="alert" class="alert alert-success mt-2 mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                  viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{session('Deleted')}}</span>
              </div>
            @elseif(session('Expired'))
              <div role="alert" class="alert alert-success mt-2 mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                  viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{session('Expired')}}</span>
              </div>
            @endif

            {{-- alerts --}}

            <div class="container grid grid-cols-3 max-md:grid-cols-1 gap-2 mx-auto p-4 max-w-6xl">


              <!-- Single Compact Reward Card -->

              @forelse ($roompoints as $points)
                <div
                  class="card bg-white shadow-sm hover:shadow-md transition-shadow duration-200 border border-gray-100 w-full max-w-xs mx-auto sm:max-w-sm">
                  <!-- Room Image -->
                  <figure class="h-36 relative">
                    <img src="{{asset($points->roomphoto)}}" alt="Deluxe Room"
                      class="w-full h-full object-cover rounded-t-lg">
                    <!-- Room Type Badge -->
                    <div class="absolute bottom-2 left-2 badge badge-primary badge-xs">
                      {{$points->roomtype}}
                    </div>
                  </figure>

                  <!-- Card Content -->
                  <div class="p-3">
                    <!-- Status & Title -->
                    <div class="flex justify-between items-center mb-1">
                      <h3 class="font-semibold text-sm">LOYALTY REWARD For Room #{{$points->roomID}} {{$points->roomtype}}
                      </h3>
                      @if($points->loyalty_status === 'Active')
                        <span class="badge badge-success badge-xs">
                          Active
                        </span>
                      @elseif($points->loyalty_status === 'Expired')
                        <span class="badge badge-error badge-xs">
                          Expired
                        </span>
                      @endif
                    </div>

                    <!-- Reward Details -->
                    <div class="space-y-1 mb-2">
                      <p class="text-xs text-gray-500">Description</p>
                      <p class="text-sm line-clamp-2">{{$points->loyalty_description}}</p>

                      <p class="text-xs text-gray-500 mt-1">Value</p>
                      <p class="text-lg font-bold text-blue-600">{{$points->loyalty_value}} Points</p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-end space-x-2 mt-2">
                      <button onclick="expire_reward_{{$points->loyaltyID}}.showModal()"
                        class="btn btn-xs btn-outline btn-warning">
                        Expire
                      </button>
                      <button onclick="delete_reward_{{$points->loyaltyID}}.showModal()"
                        class="btn btn-xs btn-outline btn-error">
                        Delete
                      </button>

                      <button onclick="edit_lar_{{$points->loyaltyID}}.showModal()"
                        class="btn btn-xs btn-outline btn-primary">
                        Edit
                      </button>

                    </div>
                  </div>
                </div>

              @empty
                <div class="w-full text-center py-12 bg-gray-50 rounded-lg border border-dashed border-gray-200">
                  <div class="max-w-md mx-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none"
                      viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="mt-2 text-lg font-medium text-gray-900">No loyalty rewards found</h3>
                    <p class="mt-1 text-sm text-gray-500">Create your first loyalty reward to get started.</p>
                    <div class="mt-6">
                      <button onclick="create_lar.showModal()" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                          stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Create Reward
                      </button>
                    </div>
                  </div>
                </div>

              @endforelse
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
    @include('admin.components.lar.create')

    @foreach ($roompoints as $points)
      @include('admin.components.lar.delete')
      @include('admin.components.lar.edit')
      @include('admin.components.lar.expire')

    @endforeach


    @livewireScripts
  </body>

@endauth
@include('javascriptfix.soliera_js')

<script src="{{asset('javascript/photouploadglobal.js')}}"></script>

</html>