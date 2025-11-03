<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  @vite('resources/css/app.css')

  <script src="https://unpkg.com/lucide@latest"></script>

  <title>{{$title}} - Events And Conference</title>
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
            <h1 class="text-2xl font-bold text-[#191970] bg-clip-text ">Event And Conference Management</h1>
          </div>
          {{-- Subsystem Name --}}

         
          <!-- content -->
          <section class="p-4 md:p-8 mt-5 max-w-7xl mx-auto">

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
              <!-- Card 1 - Total Events -->
              <div
                class="relative overflow-hidden bg-gradient-to-br from-blue-50 to-white shadow-md border border-blue-100 rounded-xl transition-all duration-300 hover:shadow-xl hover:-translate-y-1 hover:border-blue-200 group">
                <div class="absolute top-0 right-0 w-24 h-24 bg-blue-600 rounded-bl-full opacity-5"></div>
                <div class="p-5 relative z-10">
                  <div class="flex items-center gap-3 mb-4">
                    <div
                      class="p-3 rounded-xl bg-blue-900 text-yellow-400 text-2xl shadow-lg group-hover:bg-blue-600 group-hover:scale-110 transition-all duration-300">
                      <i class="fa-solid fa-calendar"></i>
                    </div>
                    <div>
                      <h3 class="text-base font-semibold text-gray-800">Total Events</h3>
                      <p class="text-xs text-gray-500">All events</p>
                    </div>
                  </div>
                  <p class="text-3xl font-bold text-gray-800">12</p>
                </div>
              </div>

              <!-- Card 2 - Approved Events -->
              <div
                class="relative overflow-hidden bg-gradient-to-br from-green-50 to-white shadow-md border border-green-100 rounded-xl transition-all duration-300 hover:shadow-xl hover:-translate-y-1 hover:border-green-200 group">
                <div class="absolute top-0 right-0 w-24 h-24 bg-green-600 rounded-bl-full opacity-5"></div>
                <div class="p-5 relative z-10">
                  <div class="flex items-center gap-3 mb-4">
                    <div
                      class="p-3 rounded-xl bg-blue-900 text-yellow-400 text-2xl shadow-lg group-hover:bg-green-600 group-hover:scale-110 transition-all duration-300">
                      <i class="fa-solid fa-check-to-slot"></i>
                    </div>
                    <div>
                      <h3 class="text-base font-semibold text-gray-800">Approved Events</h3>
                      <p class="text-xs text-gray-500">Confirmed bookings</p>
                    </div>
                  </div>
                  <p class="text-3xl font-bold text-gray-800">7</p>
                </div>
              </div>

              <!-- Card 3 - Cancelled Events -->
              <div
                class="relative overflow-hidden bg-gradient-to-br from-amber-50 to-white shadow-md border border-amber-100 rounded-xl transition-all duration-300 hover:shadow-xl hover:-translate-y-1 hover:border-amber-200 group">
                <div class="absolute top-0 right-0 w-24 h-24 bg-amber-600 rounded-bl-full opacity-5"></div>
                <div class="p-5 relative z-10">
                  <div class="flex items-center gap-3 mb-4">
                    <div
                      class="p-3 rounded-xl bg-blue-900 text-yellow-400 text-2xl shadow-lg group-hover:bg-amber-600 group-hover:scale-110 transition-all duration-300">
                      <i class="fa-solid fa-ban"></i>
                    </div>
                    <div>
                      <h3 class="text-base font-semibold text-gray-800">Cancelled Events</h3>
                      <p class="text-xs text-gray-500">Cancelled bookings</p>
                    </div>
                  </div>
                  <p class="text-3xl font-bold text-gray-800">3</p>
                </div>
              </div>
            </div>

            <!-- Success Alert -->
            @if(session('success'))
              <div class="flex items-center gap-3 p-4 mb-6 bg-green-50 border border-green-200 rounded-lg shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600 flex-shrink-0" fill="none"
                  viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-green-800 font-medium">{{ session('success') }}</span>
              </div>
            @endif

            <!-- Event Types Section -->
            <div class="mb-8">
              <div class="bg-white  overflow-hidden rounded-md ">
                <!-- Section Header -->
                <div
                  class="bg-gradient-to-r from-blue-900 to-blue-700 px-6 py-5 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
                  <div>
                    <h3 class="text-xl font-bold text-white">Event Types</h3>
                    <p class="text-blue-100 text-sm mt-1">Manage your event packages</p>
                  </div>
                  <button onclick="document.getElementById('create_eventtype_modal').showModal()"
                    class="flex items-center gap-2 px-4 py-2 bg-yellow-400 hover:bg-yellow-300 text-blue-900 rounded-lg font-semibold text-sm transition-all duration-200 shadow-md hover:shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                      <path fill-rule="evenodd"
                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                        clip-rule="evenodd" />
                    </svg>
                    Add Event Type
                  </button>
                </div>

                <!-- Event Type Cards Grid -->
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                  @forelse($eventtypes as $eventtype)
                    <div
                      class="bg-white rounded-xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-200 hover:border-yellow-400 group">
                      <!-- Image Container -->
                      <div class="relative h-48 overflow-hidden">
                        <img src="{{ asset($eventtype->eventtype_photo) }}" alt="{{ $eventtype->eventtype_name }}"
                          class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">

                        <!-- Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-60">
                        </div>

                        <!-- Price Badge -->
                        <div
                          class="absolute top-3 right-3 bg-yellow-400 text-blue-900 px-3 py-1.5 rounded-full text-sm font-bold shadow-lg transform group-hover:scale-105 transition-transform duration-300">
                          ₱{{ number_format($eventtype->eventtype_price, 2) }}
                        </div>

                        <!-- Premium Badge -->
                        <div
                          class="absolute bottom-3 left-3 flex items-center gap-1 bg-white bg-opacity-90 px-2 py-1 rounded-full">
                          <svg class="w-3 h-3 fill-current text-yellow-500" viewBox="0 0 20 20">
                            <path
                              d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                          </svg>
                          <span class="text-xs text-gray-700 font-medium">Premium</span>
                        </div>

                        <!-- Shimmer Effect -->
                        <div
                          class="absolute inset-0 bg-gradient-to-r from-transparent via-white to-transparent opacity-20 -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-1000">
                        </div>
                      </div>

                      <!-- Card Content -->
                      <div class="p-5">
                        <!-- Title -->
                        <h4
                          class="text-lg font-bold text-gray-800 mb-2 line-clamp-1 group-hover:text-yellow-600 transition-colors duration-300">
                          {{ $eventtype->eventtype_name }}
                        </h4>

                        <!-- Description -->
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2 leading-relaxed">
                          {{ $eventtype->eventtype_description }}
                        </p>

                        <!-- Category Badge -->
                        <div class="mb-4">
                          <span
                            class="inline-block px-3 py-1 bg-blue-50 text-blue-700 text-xs font-medium rounded-full">Event
                            Package</span>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex gap-2 pt-4 border-t border-gray-100">
                          <button
                            onclick="document.getElementById('modify_eventtype_modal_{{ $eventtype->eventtype_ID }}').showModal()"
                            class="flex-1 flex items-center justify-center gap-1.5 px-3 py-2 text-blue-600 hover:text-white hover:bg-blue-600 rounded-lg transition-all duration-200 border border-blue-200 hover:border-blue-600 text-sm font-medium group/btn">
                            <svg xmlns="http://www.w3.org/2000/svg"
                              class="h-4 w-4 transition-transform group-hover/btn:rotate-12" fill="none" viewBox="0 0 24 24"
                              stroke="currentColor" stroke-width="2">
                              <path d="M12 20h9" />
                              <path d="M16.5 3.5a2.121 2.121 0 1 1 3 3L7 19l-4 1 1-4 12.5-12.5z" />
                            </svg>
                            Edit
                          </button>

                          <button type="button"
                            onclick="document.getElementById('delete_modal_{{ $eventtype->eventtype_ID }}').showModal()"
                            class="flex-1 flex items-center justify-center gap-1.5 px-3 py-2 text-red-600 hover:text-white hover:bg-red-600 rounded-lg transition-all duration-200 border border-red-200 hover:border-red-600 text-sm font-medium group/btn">
                            <svg xmlns="http://www.w3.org/2000/svg"
                              class="h-4 w-4 transition-transform group-hover/btn:scale-110" fill="none" viewBox="0 0 24 24"
                              stroke="currentColor" stroke-width="2">
                              <path d="M3 6h18" />
                              <path d="M19 6l-1 14H6L5 6" />
                              <path d="M10 11v6" />
                              <path d="M14 11v6" />
                              <path d="M9 6V4h6v2" />
                            </svg>
                            Delete
                          </button>

                          <a href="/eventbooking/{{ $eventtype->eventtype_ID }}"
                            class="flex-1 flex items-center justify-center gap-1.5 px-3 py-2 text-green-600 hover:text-white hover:bg-green-600 rounded-lg transition-all duration-200 border border-green-200 hover:border-green-600 text-sm font-medium group/btn">
                            <svg xmlns="http://www.w3.org/2000/svg"
                              class="h-4 w-4 transition-transform group-hover/btn:rotate-12" fill="none" viewBox="0 0 24 24"
                              stroke="currentColor" stroke-width="2">
                              <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                              <line x1="16" y1="2" x2="16" y2="6" />
                              <line x1="8" y1="2" x2="8" y2="6" />
                              <line x1="3" y1="10" x2="21" y2="10" />
                            </svg>
                            Book
                          </a>
                        </div>
                      </div>
                    </div>
                  @empty
                    <div
                      class="col-span-3 flex flex-col items-center justify-center text-center p-12 bg-gray-50 border-2 border-dashed border-gray-300 rounded-xl">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300 mb-4" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M9 17v-2h6v2m-7 4h8a2 2 0 002-2v-5a2 2 0 00-2-2h-2l-1-2h-2l-1 2H9a2 2 0 00-2 2v5a2 2 0 002 2z" />
                      </svg>
                      <h3 class="text-lg font-semibold text-gray-700 mb-2">No Event Types Yet</h3>
                      <p class="text-gray-500 text-sm mb-6">Start by creating your first event type.</p>
                      <button onclick="create_eventtype_modal.showModal()"
                        class="inline-flex items-center gap-2 px-6 py-3 bg-yellow-400 hover:bg-yellow-300 text-blue-900 font-bold rounded-xl transition-colors duration-200 shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                          <path fill-rule="evenodd"
                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                            clip-rule="evenodd" />
                        </svg>
                        Create Event Type
                      </button>
                    </div>
                  @endforelse
                </div>
              </div>
            </div>

            <!-- Event Reservations Section -->

          </section>

          <!-- Lucide Icons -->
          <script type="module">
            import lucide from 'https://unpkg.com/lucide@latest/dist/esm/lucide.js';
            lucide.createIcons();
          </script>




        </main>
      </div>
    </div>

    {{-- modals --}}
    @include('admin.components.ecm.createtype')

    @foreach ($eventtypes as $eventtype)
      @include('admin.components.ecm.deletetype')
      @include('admin.components.ecm.modifytype')
    @endforeach


  </body>

@endauth


@include('javascriptfix.soliera_js')

<script>


  <script src="{{asset('javascript/photouploadglobal.js')}}"></script>

</html>