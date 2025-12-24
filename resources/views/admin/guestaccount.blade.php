<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  @vite('resources/css/app.css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


  <script src="https://unpkg.com/lucide@latest"></script>

  <title>{{$title}} - Front Desk And Reception</title>
  @livewireStyles
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
            <h1 class="text-2xl font-bold bg-white bg-clip-text text-[#191970]">Guest Accounts</h1>
          </div>
          {{-- Subsystem Name --}}
          <section class="flex-1 p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

              <!-- Total Guests -->
              <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
                <div class="flex items-center justify-between">
                  <div>
                    <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Total Accounts</h3>
                    <p class="text-3xl font-bold text-gray-800 mt-2">{{$totalguest}}</p>
                  </div>
                  <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
                    <i class="fa-solid fa-hotel text-yellow-400 text-2xl"></i>
                  </div>
                </div>
              </div>

              <!-- Guests Today / Checked-in Guests -->
              <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
                <div class="flex items-center justify-between">
                  <div>
                    <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Checked In Guest</h3>
                    <p class="text-3xl font-bold text-gray-800 mt-2">{{$checkinguest}}</p>
                  </div>
                  <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
                    <i class="fa-solid fa-user-check text-yellow-400 text-2xl"></i>
                  </div>
                </div>
              </div>

              <!-- Pending Bookings -->
              <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
                <div class="flex items-center justify-between">
                  <div>
                    <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Guest Pending Bookings</h3>
                    <p class="text-3xl font-bold text-gray-800 mt-2">{{$pendingguest}}</p>
                  </div>
                  <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
                    <i class="fa-solid fa-hourglass-half text-yellow-400 text-2xl"></i>
                  </div>
                </div>
              </div>

              <!-- Guests with Special Requests -->


            </div>



            <div class="overflow-x-auto mt-5 rounded-xl border border-gray-100 shadow-lg">
              <!-- Header -->
              <div class="bg-blue-900 text-white px-6 py-4 rounded-t-xl">
                <h2 class="text-lg font-semibold">Guest Accounts</h2>
              </div>

      @if(session('success'))
<div id="successAlert" class="fixed top-4 right-4 z-50 animate-slideIn">
    <div class="bg-white rounded-xl shadow-2xl border-l-4 border-green-500 p-4 min-w-[320px] max-w-md">
        <div class="flex items-start gap-3">
            <!-- Icon -->
            <div class="flex-shrink-0">
                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            
            <!-- Content -->
            <div class="flex-1 pt-0.5">
                <h4 class="font-bold text-gray-900 text-sm mb-1">Success!</h4>
                <p class="text-gray-600 text-sm">{{ session('success') }}</p>
                
                <!-- Progress bar -->
                <div class="mt-3 h-1 bg-gray-200 rounded-full overflow-hidden">
                    <div id="progressBar" class="h-full bg-green-500 rounded-full transition-all duration-[5000ms] ease-linear w-full"></div>
                </div>
            </div>
            
            <!-- Close button -->
            <button onclick="closeAlert()" class="flex-shrink-0 text-gray-400 hover:text-gray-600 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
</div>

<style>
@keyframes slideIn {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

@keyframes slideOut {
    from {
        transform: translateX(0);
        opacity: 1;
    }
    to {
        transform: translateX(100%);
        opacity: 0;
    }
}

.animate-slideIn {
    animation: slideIn 0.3s ease-out;
}

.animate-slideOut {
    animation: slideOut 0.3s ease-out;
}
</style>

<script>
function closeAlert() {
    const alert = document.getElementById('successAlert');
    alert.classList.add('animate-slideOut');
    setTimeout(() => {
        alert.remove();
    }, 300);
}

// Auto-dismiss after 5 seconds
document.addEventListener('DOMContentLoaded', function() {
    const progressBar = document.getElementById('progressBar');
    
    // Start progress bar animation
    setTimeout(() => {
        progressBar.style.width = '0%';
    }, 100);
    
    // Auto-close after 5 seconds
    setTimeout(() => {
        closeAlert();
    }, 5000);
});
</script>
      @endif

              <!-- Table -->
            <table class="table w-full">
              <thead class="bg-gray-100">
                <tr>
                  <th>Guest Profile</th>
                  <th>Email</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($guest as $guests)
                  <tr class="hover:bg-gray-50 transition">
                    <td>
                      <div class="flex items-center gap-3">
                        <img class="rounded-full w-12 h-12" src="{{ asset($guests->guest_photo) }}" alt="{{ $guests->guest_name }}">
                        <div>
                          <div class="font-bold">{{ $guests->guest_name }}</div>
                          <div class="text-sm opacity-50">Guest</div>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="text-sm opacity-80">{{ $guests->guest_email }}</div>
                    </td>
                    <td>
                      <span
                        class="px-2 py-1 rounded-full text-white text-xs {{ $guests->guest_status === 'Suspended' ? 'bg-red-500' : 'bg-green-500' }}">
                        {{ $guests->guest_status ?? 'Active' }}
                      </span>
                    </td>
                    <td class="flex gap-2 flex-col">
                      <button onclick="document.getElementById('view_profile_modal_{{ $guests->guestID }}').showModal()" class="btn btn-primary btn-sm">View Profile</button>

                      @if($guests->guest_status !== 'Suspended')
                        <button onclick="document.getElementById('suspend_modal_{{ $guests->guestID }}').showModal()" class="btn btn-warning btn-sm">Suspend</button>
                      @else
                        <button onclick="document.getElementById('unsuspend_modal_{{ $guests->guestID }}').showModal()" class="btn btn-success btn-sm">Unsuspend</button>
                      @endif

                      <button onclick="document.getElementById('remove_modal_{{ $guests->guestID }}').showModal()" class="btn btn-error btn-sm">Remove</button>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>


              <!-- Pagination -->
              <div class="mt-4 px-6 py-3 bg-gray-50 flex justify-end rounded-b-xl">
                {{ $guest->links('pagination::tailwind') }}
              </div>
            </div>



          </section>


          <!-- Graph Section -->




      </div>



    @foreach ($guest as $guests)
            <!-- View Profile Modal -->
            @include('admin.components.guestacc.view')

            <!-- Suspend Modal -->
            @include('admin.components.guestacc.suspend')

            <!-- Unsuspend Modal -->
            @include('admin.components.guestacc.unsuspend')

            <!-- Remove Modal -->
            @include('admin.components.guestacc.delete')

    @endforeach


      <!-- Initialize Lucide Icons -->
      <script>
        lucide.createIcons();
      </script>







      </main>
    </div>
    </div>


    {{-- modals --}}




    @livewireScripts
    @include('javascriptfix.soliera_js')
  </body>
@endauth



</html>