<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  @vite('resources/css/app.css')

  <script src="https://unpkg.com/lucide@latest"></script>

  <title>{{$title}} - Missing RFID</title>
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
            <h1 class="text-2xl font-bold text-[#191970] bg-clip-text ">Missing RFID</h1>
          </div>
          {{-- Subsystem Name --}}


          <!-- content -->
          <section class="p-4 md:p-8 mt-5 max-w-7xl mx-auto">

            <!-- Stats Cards -->
 <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">

    <!-- Total RFID -->
    <div
        class="relative overflow-hidden bg-gradient-to-br from-blue-50 to-white shadow-md border border-blue-200 rounded-xl transition-all duration-300 hover:shadow-xl hover:-translate-y-1 group">
        <div class="absolute top-0 right-0 w-24 h-24 bg-blue-600 rounded-bl-full opacity-5"></div>

        <div class="p-6 relative z-10">
            <div class="flex items-center gap-3 mb-4">
                <div
                    class="p-3 rounded-xl bg-blue-900 text-yellow-400 text-2xl shadow-md transition-all duration-300 group-hover:scale-110">
                    <i class="fa-solid fa-id-card"></i>
                </div>
                <div>
                    <h3 class="text-base font-semibold text-gray-800">Total RFID</h3>
                    <p class="text-xs text-gray-500">All issued RFIDs</p>
                </div>
            </div>
            <p class="text-3xl font-bold text-gray-800">{{ $totaldoorlock }}</p>
        </div>
    </div>

    <!-- Reported Missing -->
    <div
        class="relative overflow-hidden bg-gradient-to-br from-blue-50 to-white shadow-md border border-blue-200 rounded-xl transition-all duration-300 hover:shadow-xl hover:-translate-y-1 group">
        <div class="absolute top-0 right-0 w-24 h-24 bg-blue-600 rounded-bl-full opacity-5"></div>

        <div class="p-6 relative z-10">
            <div class="flex items-center gap-3 mb-4">
                <div
                    class="p-3 rounded-xl bg-blue-900 text-yellow-400 text-2xl shadow-md transition-all duration-300 group-hover:scale-110">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </div>
                <div>
                    <h3 class="text-base font-semibold text-gray-800">Reported Missing</h3>
                    <p class="text-xs text-gray-500">Lost or unreturned RFIDs</p>
                </div>
            </div>
            <p class="text-3xl font-bold text-gray-800">{{ $countmissing }}</p>
        </div>
    </div>

    <!-- Active RFID -->
    <div
        class="relative overflow-hidden bg-gradient-to-br from-blue-50 to-white shadow-md border border-blue-200 rounded-xl transition-all duration-300 hover:shadow-xl hover:-translate-y-1 group">
        <div class="absolute top-0 right-0 w-24 h-24 bg-blue-600 rounded-bl-full opacity-5"></div>

        <div class="p-6 relative z-10">
            <div class="flex items-center gap-3 mb-4">
                <div
                    class="p-3 rounded-xl bg-blue-900 text-yellow-400 text-2xl shadow-md transition-all duration-300 group-hover:scale-110">
                    <i class="fa-solid fa-signal"></i>
                </div>
                <div>
                    <h3 class="text-base font-semibold text-gray-800">Active RFID</h3>
                    <p class="text-xs text-gray-500">Currently active</p>
                </div>
            </div>
            <p class="text-3xl font-bold text-gray-800">{{  $totalassigned }}</p>
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




    <div class="overflow-x-auto">
<table class="table table-zebra w-full">
  <thead>
    <tr>
      <th>#</th>
      <th>Booking ID</th>
      <th>Guest Name</th>
      <th>Room</th>
      <th>Status</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    @forelse ($missingRFIDs as $rfid)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $rfid->bookingID }}</td>
        <td>{{ $rfid->guest_name }}</td>
        <td>Room {{ $rfid->roomName ?? $rfid->roomID }}</td>
        <td>
          <span class="badge badge-warning">
            {{ $rfid->missing_rfid_status ?? 'Missing' }}
          </span>
        </td>
        <td class="flex gap-2">
          <!-- View Button -->
          <button
            class="btn btn-sm btn-info"
            onclick="document.getElementById('viewModal{{ $rfid->missingRFID }}').showModal()">
            View
          </button>

          <!-- Remove RFID Button -->
          <button
            class="btn btn-sm btn-error"
            onclick="document.getElementById('removeModal{{ $rfid->missingRFID }}').showModal()">
            Remove RFID
          </button>
        </td>
      </tr>

      <!-- VIEW MODAL -->
      <dialog id="viewModal{{ $rfid->missingRFID }}" class="modal">
        <div class="modal-box">
          <h3 class="font-bold text-lg mb-4">Missing RFID Details</h3>
          <div class="space-y-2 text-sm">
            <p><strong>Booking ID:</strong> {{ $rfid->bookingID }}</p>
            <p><strong>Guest Name:</strong> {{ $rfid->guest_name }}</p>
            <p><strong>Room:</strong> {{ $rfid->roomName ?? $rfid->roomID }}</p>
            <p><strong>Status:</strong> {{ $rfid->missing_rfid_status ?? 'Missing' }}</p>
            <p><strong>Reported At:</strong> {{ $rfid->created_at }}</p>
          </div>
          <div class="modal-action">
            <form method="dialog">
              <button class="btn">Close</button>
            </form>
          </div>
        </div>
      </dialog>

      <!-- REMOVE RFID MODAL -->
      <dialog id="removeModal{{ $rfid->missingRFID }}" class="modal">
        <div class="modal-box">
          <h3 class="font-bold text-lg mb-4 text-red-600">Confirm Remove RFID</h3>
          <p class="mb-4">Are you sure you want to remove the RFID for <strong>{{ $rfid->guest_name }}</strong>?</p>

          <div class="modal-action flex gap-2">
            <!-- Cancel Button -->
            <button class="btn btn-outline" onclick="document.getElementById('removeModal{{ $rfid->missingRFID }}').close()">Cancel</button>

            <!-- Form to Remove -->
            <form action="removemissingrfid/{{ $rfid->doorlockfrontdeskID }}" method="POST">
              @csrf
              @method('PUT')
              <button type="submit" class="btn btn-error">Remove</button>
            </form>
          </div>
        </div>
      </dialog>

    @empty
      <tr>
        <td colspan="6" class="text-center text-gray-500 py-6">
          No missing RFID records found.
        </td>
      </tr>
    @endforelse
  </tbody>
</table>


</div>

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


  </body>

@endauth


@include('javascriptfix.soliera_js')

<script>


  <script src="{{asset('javascript/photouploadglobal.js')}}"></script>

</html>