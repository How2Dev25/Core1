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
          <section class="mt-2 px-4 max-w-7xl mx-auto">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
              <!-- Total Points Card -->
              <div
                class="relative overflow-hidden bg-gradient-to-br from-white to-blue-50 shadow-md border border-blue-100 rounded-xl transition-all duration-300 hover:shadow-xl hover:-translate-y-1 group">
                <div class="absolute top-0 right-0 w-32 h-32 bg-blue-900 rounded-bl-full opacity-5"></div>
                <div class="p-6 relative z-10">
                  <div class="flex items-start justify-between mb-4">
                    <div
                      class="p-3 rounded-xl bg-blue-900 text-yellow-400 shadow-lg group-hover:scale-110 transition-transform duration-300">
                      <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 3h12l4 6-10 13L2 9Z" />
                        <path d="M11 3 8 9l4 13 4-13-3-6" />
                        <path d="M2 9h20" />
                      </svg>
                    </div>
                    <div class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-semibold">Active</div>
                  </div>
                  <h3 class="text-sm font-medium text-gray-600 mb-1">Total Points</h3>
                  <p class="text-3xl font-bold text-blue-900 mb-1">{{$totalpoints}}</p>
                  <p class="text-xs text-gray-500">Across all customers</p>
                </div>
              </div>

              <!-- Active Members Card -->
              <div
                class="relative overflow-hidden bg-gradient-to-br from-white to-purple-50 shadow-md border border-purple-100 rounded-xl transition-all duration-300 hover:shadow-xl hover:-translate-y-1 group">
                <div class="absolute top-0 right-0 w-32 h-32 bg-purple-900 rounded-bl-full opacity-5"></div>
                <div class="p-6 relative z-10">
                  <div class="flex items-start justify-between mb-4">
                    <div
                      class="p-3 rounded-xl bg-blue-900 text-yellow-400 shadow-lg group-hover:scale-110 transition-transform duration-300">
                      <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                      </svg>
                    </div>
                    <div class="px-3 py-1 rounded-full bg-purple-100 text-purple-700 text-xs font-semibold">Live</div>
                  </div>
                  <h3 class="text-sm font-medium text-gray-600 mb-1">Active Members</h3>
                  <p class="text-3xl font-bold text-purple-900 mb-1">{{$activemembers}}</p>
                  <p class="text-xs text-gray-500">Enrolled participants</p>
                </div>
              </div>

              <!-- Total Rules Card -->
              <div
                class="relative overflow-hidden bg-gradient-to-br from-white to-green-50 shadow-md border border-green-100 rounded-xl transition-all duration-300 hover:shadow-xl hover:-translate-y-1 group">
                <div class="absolute top-0 right-0 w-32 h-32 bg-green-900 rounded-bl-full opacity-5"></div>
                <div class="p-6 relative z-10">
                  <div class="flex items-start justify-between mb-4">
                    <div
                      class="p-3 rounded-xl bg-blue-900 text-yellow-400 shadow-lg group-hover:scale-110 transition-transform duration-300">
                      <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="8" width="18" height="4" rx="1" />
                        <path d="M12 8v13" />
                        <path d="M19 12v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-7" />
                        <path d="M7.5 8a2.5 2.5 0 0 1 0-5A4.8 8 0 0 1 12 8a4.8 8 0 0 1 4.5-5 2.5 2.5 0 0 1 0 5" />
                      </svg>
                    </div>
                    <div class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">Rules</div>
                  </div>
                  <h3 class="text-sm font-medium text-gray-600 mb-1">Total Rules</h3>
                  <p class="text-3xl font-bold text-green-900 mb-1">{{$totalreward}}</p>
                  <p class="text-xs text-gray-500">Loyalty point rules</p>
                </div>
              </div>
            </div>

            <!-- Alerts -->
            @if(session('Added'))
              <div role="alert" class="flex items-center gap-3 p-4 mb-6 bg-green-50 border border-green-200 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600 flex-shrink-0" fill="none"
                  viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-green-800 font-medium">{{session('Added')}}</span>
              </div>
            @elseif(session('Updated'))
              <div role="alert" class="flex items-center gap-3 p-4 mb-6 bg-green-50 border border-green-200 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600 flex-shrink-0" fill="none"
                  viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-green-800 font-medium">{{session('Updated')}}</span>
              </div>
            @elseif(session('Deleted'))
              <div role="alert" class="flex items-center gap-3 p-4 mb-6 bg-green-50 border border-green-200 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600 flex-shrink-0" fill="none"
                  viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-green-800 font-medium">{{session('Deleted')}}</span>
              </div>
            @elseif(session('Expired'))
              <div role="alert" class="flex items-center gap-3 p-4 mb-6 bg-green-50 border border-green-200 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600 flex-shrink-0" fill="none"
                  viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-green-800 font-medium">{{session('Expired')}}</span>
              </div>
            @endif

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
              <!-- Rewards Section (2/3 width) -->
              <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-md border border-gray-200 p-6">
                  <div class="flex items-center justify-between mb-6">
                    <div>
                      <h2 class="text-xl font-bold text-gray-800">Loyalty Rewards</h2>
                      <p class="text-sm text-gray-500 mt-1">Manage room-based rewards</p>
                    </div>
                    <button onclick="create_lar.showModal()"
                      class="flex items-center gap-2 px-4 py-2 bg-blue-900 hover:bg-blue-800 text-white rounded-lg transition-colors duration-200 shadow-md hover:shadow-lg">
                      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 5v14M5 12h14" />
                      </svg>
                      <span class="font-medium">Add Reward</span>
                    </button>
                  </div>

                  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @forelse ($roompoints as $points)
                      <div
                        class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                        <!-- Room Image -->
                        <div class="relative h-40 overflow-hidden">
                          <img src="{{asset($points->roomphoto)}}" alt="Room" class="w-full h-full object-cover">
                          <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent"></div>
                          <div
                            class="absolute bottom-3 left-3 px-3 py-1 bg-blue-900 text-yellow-400 rounded-full text-xs font-semibold">
                            {{$points->roomtype}}
                          </div>
                        </div>

                        <!-- Card Content -->
                        <div class="p-4">
                          <div class="flex items-start justify-between mb-3">
                            <h3 class="font-semibold text-gray-800 text-sm leading-tight">Room #{{$points->roomID}}</h3>
                            @if($points->loyalty_status === 'Active')
                              <span
                                class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs font-medium">Active</span>
                            @elseif($points->loyalty_status === 'Expired')
                              <span class="px-2 py-1 bg-red-100 text-red-700 rounded-full text-xs font-medium">Expired</span>
                            @endif
                          </div>

                          <p class="text-xs text-gray-500 mb-2 line-clamp-2">{{$points->loyalty_description}}</p>

                          <div class="flex items-baseline gap-1 mb-4">
                            <span class="text-2xl font-bold text-blue-900">{{$points->loyalty_value}}</span>
                            <span class="text-sm text-gray-600 font-medium">Points</span>
                          </div>

                          <!-- Action Buttons -->
                          <div class="flex gap-2">
                            <button onclick="expire_reward_{{$points->loyaltyID}}.showModal()"
                              class="flex-1 px-3 py-2 border border-yellow-600 text-yellow-700 hover:bg-yellow-50 rounded-lg text-xs font-medium transition-colors duration-200">
                              Expire
                            </button>
                            <button onclick="delete_reward_{{$points->loyaltyID}}.showModal()"
                              class="flex-1 px-3 py-2 border border-red-600 text-red-700 hover:bg-red-50 rounded-lg text-xs font-medium transition-colors duration-200">
                              Delete
                            </button>
                            <button onclick="edit_lar_{{$points->loyaltyID}}.showModal()"
                              class="flex-1 px-3 py-2 bg-blue-900 hover:bg-blue-800 text-white rounded-lg text-xs font-medium transition-colors duration-200">
                              Edit
                            </button>
                          </div>
                        </div>
                      </div>
                    @empty
                      <div
                        class="col-span-2 text-center py-16 bg-gray-50 rounded-lg border-2 border-dashed border-gray-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-300 mb-4" fill="none"
                          viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-700 mb-2">No Loyalty Rewards</h3>
                        <p class="text-sm text-gray-500 mb-6">Create your first loyalty reward to get started</p>
                        <button onclick="create_lar.showModal()"
                          class="inline-flex items-center gap-2 px-6 py-3 bg-blue-900 hover:bg-blue-800 text-white rounded-lg font-medium transition-colors duration-200">
                          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 5v14M5 12h14" />
                          </svg>
                          Create First Reward
                        </button>
                      </div>
                    @endforelse
                  </div>
                </div>
              </div>

              <!-- Rules Section (1/3 width) -->
              <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-md border border-gray-200 p-6 sticky top-4">
                  <div class="flex items-center justify-between mb-6">
                    <div>
                      <h2 class="text-xl font-bold text-gray-800">Point Rules</h2>
                      <p class="text-sm text-gray-500 mt-1">Discount structure</p>
                    </div>
                    <button onclick="document.getElementById('add_rules').showModal()"
                      class="p-2 bg-blue-900 hover:bg-blue-800 text-white rounded-lg transition-colors duration-200 shadow-md">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 5v14M5 12h14" />
                      </svg>
                    </button>
                  </div>

                  <div class="space-y-3">
                    @forelse($rules as $rule)
                      <div
                        class="p-4 bg-gradient-to-br from-gray-50 to-blue-50 border border-gray-200 rounded-lg hover:shadow-md transition-all duration-200">
                        <div class="flex items-center justify-between mb-3">
                          <div class="flex items-baseline gap-2">
                            <span class="text-2xl font-bold text-blue-900">{{ $rule->points_required }}</span>
                            <span class="text-xs text-gray-600 font-medium">points</span>
                          </div>
                          <div class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-bold">
                            {{ rtrim(rtrim(number_format($rule->discount_percent, 2), '0'), '.') }}%
                          </div>
                        </div>
                        <div class="flex gap-2">
                          <button onclick="document.getElementById('edit_rules_{{$rule->loyaltyrulesID}}').show()"
                            class="flex-1 px-3 py-1.5 border border-blue-600 text-blue-700 hover:bg-blue-50 rounded-md text-xs font-medium transition-colors duration-200">
                            Edit
                          </button>
                          <button onclick="document.getElementById('delete_rule_{{$rule->loyaltyrulesID}}').show()"
                            class="flex-1 px-3 py-1.5 border border-red-600 text-red-700 hover:bg-red-50 rounded-md text-xs font-medium transition-colors duration-200">
                            Delete
                          </button>
                        </div>
                      </div>
                    @empty
                      <div class="text-center py-12 bg-gray-50 rounded-lg border-2 border-dashed border-gray-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-300 mb-3" fill="none"
                          viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        <p class="text-sm text-gray-500 mb-4">No rules yet</p>
                        <button onclick="document.getElementById('add_rules').showModal()"
                          class="inline-flex items-center gap-2 px-4 py-2 bg-blue-900 hover:bg-blue-800 text-white rounded-lg text-sm font-medium transition-colors duration-200">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 5v14M5 12h14" />
                          </svg>
                          Add Rule
                        </button>
                      </div>
                    @endforelse
                  </div>
                </div>
              </div>
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
    @include('admin.components.lar.addrules')

    @foreach ($rules as $rule)
      @include('admin.components.lar.editrules')
      @include('admin.components.lar.deleterule')
    @endforeach

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