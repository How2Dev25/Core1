<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  @vite('resources/css/app.css')

  <script src="https://unpkg.com/lucide@latest"></script>

  <title>{{$title}} - My Reservation</title>
  @livewireStyles
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
                <h1 class="text-2xl font-bold bg-white bg-clip-text text-[#191970]">My Reservation</h1>
              </div>
              {{-- Subsystem Name --}}

              <section class="p-5">
                <div class="container mx-auto px-4 py-8">
                  <!-- === Reservation Stats Cards (Original) === -->
                  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <!-- Total Reservations -->
                    <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
                      <div class="flex items-center justify-between">
                        <div>
                          <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Total Reservations</h3>
                          <p class="text-3xl font-bold text-gray-800 mt-2">{{$totalreservation}}</p>
                        </div>
                        <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
                          <i class="fa-solid fa-bed text-yellow-400 text-2xl"></i>
                        </div>
                      </div>
                    </div>

                    <!-- Confirmed -->
                    <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
                      <div class="flex items-center justify-between">
                        <div>
                          <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Confirmed</h3>
                          <p class="text-3xl font-bold text-gray-800 mt-2">{{$approvereservation}}</p>
                        </div>
                        <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
                          <i class="fa-solid fa-circle-check text-yellow-400 text-2xl"></i>
                        </div>
                      </div>
                    </div>

                    <!-- Pending -->
                    <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
                      <div class="flex items-center justify-between">
                        <div>
                          <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Pending</h3>
                          <p class="text-3xl font-bold text-gray-800 mt-2">{{$pendingreservation}}</p>
                        </div>
                        <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
                          <i class="fa-solid fa-clock text-yellow-400 text-2xl"></i>
                        </div>
                      </div>
                    </div>

                    <!-- Cancelled -->
                    <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
                      <div class="flex items-center justify-between">
                        <div>
                          <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Cancelled</h3>
                          <p class="text-3xl font-bold text-gray-800 mt-2">{{$cancelledreservation}}</p>
                        </div>
                        <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
                          <i class="fa-solid fa-circle-xmark text-yellow-400 text-2xl"></i>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="container mx-auto px-4 py-8">
                    <div class="grid grid-cols-1 xl:grid-cols-2 2xl:grid-cols-3 gap-6">
                      @forelse ($reserverooms as $reserveroom)
                        <div class="bg-white border border-gray-100 rounded-xl sm:rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden group">
                          <!-- Room Image Header - Enhanced -->
                          <div class="relative h-48 sm:h-52 overflow-hidden">
                            <img src="{{$reserveroom->roomphoto}}" alt="Room Photo"
                              class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>

                            <!-- Room Type Badge -->
                            <div class="absolute top-3 right-3">
                              <div class="bg-yellow-400 text-blue-900 px-3 py-1 rounded-full text-xs font-bold shadow-lg backdrop-blur-sm">
                                {{$reserveroom->roomtype}}
                              </div>
                            </div>

                            <!-- Room Number -->
                            <div class="absolute bottom-3 left-3">
                              <h3 class="text-white text-xl sm:text-2xl font-bold drop-shadow-lg">Room {{$reserveroom->roomID}}</h3>
                            </div>

                            <!-- Door Lock Status - Top Left -->
                            @if($reserveroom->doorlockID)
                              <div class="absolute top-3 left-3">
                                <span id="door-status-{{$reserveroom->doorlockID}}" class="px-2 py-1 rounded-full text-xs font-semibold shadow-md backdrop-blur-sm
                                        {{$reserveroom->doorlockfrontdesk_status == 1 ? 'bg-green-500 text-white' : 'bg-red-500 text-white'}}">
                                  {{$reserveroom->doorlockfrontdesk_status == 1 ? 'UNLOCKED' : 'LOCKED'}}
                                </span>
                              </div>
                            @endif
                          </div>

                          <!-- Card Body - Enhanced -->
                          <div class="p-4 sm:p-5">
                            <!-- Status Badge -->
                            <div class="flex items-center justify-between mb-4">
                              <span class="text-sm font-medium text-gray-600">Status</span>
                              <span class="px-3 py-1 rounded-full text-xs font-semibold
                                  {{$reserveroom->reservation_bookingstatus == 'Confirmed' ? 'bg-green-100 text-green-700 border border-green-200' : ''}}
                                  {{$reserveroom->reservation_bookingstatus == 'Pending' ? 'bg-yellow-100 text-yellow-700 border border-yellow-200' : ''}}
                                  {{$reserveroom->reservation_bookingstatus == 'Cancelled' ? 'bg-red-100 text-red-700 border border-red-200' : ''}}">
                                {{$reserveroom->reservation_bookingstatus}}
                              </span>
                            </div>

                            <!-- Dates - Enhanced -->
                            <div class="grid grid-cols-2 gap-3 mb-4">
                              <div class="bg-blue-50 rounded-lg p-3 border border-blue-100">
                                <div class="flex items-center mb-1">
                                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                  </svg>
                                  <span class="text-xs text-blue-600 uppercase font-medium">Check-in</span>
                                </div>
                                <p class="text-blue-900 font-bold text-sm">
                                  {{ \Carbon\Carbon::parse($reserveroom->reservation_checkin)->format('M j, Y') }}
                                </p>
                              </div>

                              <div class="bg-orange-50 rounded-lg p-3 border border-orange-100">
                                <div class="flex items-center mb-1">
                                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                  </svg>
                                  <span class="text-xs text-orange-600 uppercase font-medium">Check-out</span>
                                </div>
                                <p class="text-orange-900 font-bold text-sm">
                                  {{ \Carbon\Carbon::parse($reserveroom->reservation_checkout)->format('M j, Y') }}
                                </p>
                              </div>
                            </div>

                            <!-- Additional Info - Enhanced -->
                            @php
                              $nights = \Carbon\Carbon::parse($reserveroom->reservation_checkin)->diffInDays(\Carbon\Carbon::parse($reserveroom->reservation_checkout));
                              $total = $reserveroom->total;
                              $bookedDate = date('M d, Y', strtotime($reserveroom->reservation_created_at));
                            @endphp

                            <div class="space-y-2 mb-4">
                              <!-- RFID if exists -->
                              @if($reserveroom->rfid)
                                <div class="flex items-center justify-between text-sm">
                                  <span class="text-gray-600 font-medium">RFID:</span>
                                  <span class="font-semibold text-gray-800 bg-gray-100 px-2 py-1 rounded border border-gray-200">{{$reserveroom->rfid}}</span>
                                </div>
                              @endif

                              <!-- Booking ID -->
                              <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-600 font-medium">Booking ID:</span>
                                <span class="font-medium text-gray-800 bg-blue-50 px-2 py-1 rounded border border-blue-200">#{{$reserveroom->bookingID}}</span>
                              </div>

                              <!-- Booked Date -->
                              <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-600 font-medium">Date Booked:</span>
                                <span class="font-medium text-gray-800">{{ $bookedDate }}</span>
                              </div>

                              <!-- Payment Status if available -->
                              @if(isset($reserveroom->payment_status))
                                <div class="flex items-center justify-between text-sm">
                                  <span class="text-gray-600 font-medium">Payment:</span>
                                  <span class="font-semibold px-2 py-1 rounded text-xs border
                                                @if($reserveroom->payment_status === 'Paid')
                                                  bg-green-100 text-green-700 border-green-200
                                                @elseif($reserveroom->payment_status === 'Partial')
                                                  bg-blue-100 text-blue-700 border-blue-200
                                                @elseif($reserveroom->payment_status === 'Pending')
                                                  bg-orange-100 text-orange-700 border-orange-200
                                                @else
                                                  bg-gray-100 text-gray-700 border-gray-200
                                                @endif
                                            ">
                                    {{ $reserveroom->payment_status }}
                                  </span>
                                </div>
                              @endif
                            </div>

                            <!-- Total Price - Enhanced -->
                            <div class="bg-gradient-to-r from-blue-900 to-blue-800 rounded-xl p-4 mb-4 border border-blue-700">
                              <div class="flex justify-between items-center">
                                <div>
                                  <p class="text-blue-100 text-xs mb-1">Total Amount</p>
                                  <p class="text-yellow-400 font-bold text-xl">₱{{ number_format($total, 2) }}</p>
                                </div>
                                <div class="text-right">
                                  <p class="text-blue-100 text-xs mb-1">{{ $nights }} {{ $nights == 1 ? 'Night' : 'Nights' }}</p>
                                  <p class="text-blue-100 text-sm font-medium">{{$reserveroom->payment_method}}</p>
                                </div>
                              </div>
                            </div>

                            <!-- Action Buttons - Enhanced -->
                            <div class="flex flex-wrap gap-2">
                              <!-- Details Button -->
                              <button onclick="document.getElementById('edit_reservation_{{$reserveroom->reservationID}}').showModal()"
                                class="flex-1 bg-[#001f54] hover:bg-[#003875] text-white px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center justify-center gap-1.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                Details
                              </button>

                              <!-- Cancel Button - Only if Pending -->
                              @if($reserveroom->reservation_bookingstatus == 'Pending')
                                <button onclick="cancel_reservation_{{$reserveroom->reservationID}}.showModal()"
                                  class="flex-1 bg-red-50 hover:bg-red-100 text-red-700 px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center justify-center gap-1.5 border border-red-200">
                                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                  </svg>
                                  Cancel
                                </button>
                              @endif
                            </div>
                          </div>
                        </div>
                @empty
                  <div class="col-span-full">
                    <div
                      class="p-12 bg-gradient-to-br from-gray-50 to-gray-100 border-2 border-dashed border-gray-300 rounded-2xl text-center">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto mb-4 text-gray-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                      </svg>
                      <h3 class="text-xl font-semibold text-gray-700 mb-2">No Reservations Found</h3>
                      <p class="text-gray-500">There are currently no reservations to display.</p>
                    </div>
                  </div>
                @endforelse
              </div>


                  </div>










                  {{-- content --}}
              </section>


              {{-- modals --}}
              <!-- Success Modal -->
    <dialog id="geminiSuccessModal" class="modal">
      <div class="modal-box max-w-md relative">
        <form method="dialog" class="absolute top-4 right-4">
          <button class="btn btn-sm btn-circle btn-ghost">&times;</button>
        </form>

        <div class="text-center p-6">
          <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
          </div>

          <h3 class="text-lg font-medium text-gray-900 mb-2">Booking Successful!</h3>
          <p class="text-sm text-gray-500 mb-6">{{ session('success') }}</p>
        </div>
      </div>

      <form method="dialog" class="modal-backdrop">
        <button>close</button>
      </form>
    </dialog>
  <script src="{{ asset('javascript/jquery-3.7.1.min.js') }}"></script>
  <script>
    $(document).ready(function () {
      function pollDoorlocks() {
        $('[id^="door-status-"]').each(function () {
          let badge = $(this);
          let doorlockID = badge.attr('id').split('-')[2];

          $.get('/api/doorlock-status/' + doorlockID, function (data) {
            if (data.success) {
             if (data.status == 1) {
                badge.text('UNLOCKED');
                badge.removeClass('bg-red-600 text-white');
                badge.addClass('bg-green-500 text-white');
              } else {
                badge.text('LOCKED');
                badge.removeClass('bg-green-500 text-white');
                badge.addClass('bg-red-600 text-white');
              }
            }
          });
        });
      }

      // Initial poll
      pollDoorlocks();

      // Poll every 3 seconds
      setInterval(pollDoorlocks, 3000);
    });
  </script>



              <!-- Initialize Lucide Icons -->
              <script>
                lucide.createIcons();
              </script>







            </main>
          </div>
        </div>

        <script>
          document.addEventListener('DOMContentLoaded', () => {
            @if(session('success'))
              const modal = document.getElementById('geminiSuccessModal');
              modal.showModal();

              // Auto-close after 4 seconds
              setTimeout(() => {
                modal.close();
              }, 4000);
            @endif
          });
        </script>



        {{-- modals --}}


        @foreach($reserverooms as $reserveroom)
          @include('admin.components.frontdesk.viewreserve')
          @include('admin.components.frontdesk.delete')
          @include('admin.components.frontdesk.confirm')
          @include('admin.components.frontdesk.checkin')
          @include('admin.components.frontdesk.checkout')
          @include('admin.components.frontdesk.cancel')
        @endforeach


        @livewireScripts
        @include('javascriptfix.soliera_js')




@endauth
</body>




</html>