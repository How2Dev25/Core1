@include('security.sessiontimeout')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<header class="bg-base-100 shadow-sm z-10 border-b border-base-300 dark:border-gray-700" data-theme="light">
  <div class="px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between h-16">
      <div class="flex items-center">
        <button id="hamburgerBtn" onclick="toggleSidebar()"
          class="btn btn-ghost btn-sm hover:bg-base-300 transition-all hover:scale-105 relative flex flex-col justify-center items-center w-10 h-10">
          <span class="bar line1 absolute w-5 h-0.5 bg-current rounded transition-all duration-300"></span>
          <span class="bar line2 absolute w-5 h-0.5 bg-current rounded transition-all duration-300"></span>
          <span class="bar line3 absolute w-5 h-0.5 bg-current rounded transition-all duration-300"></span>
        </button>
      </div>
      <div class="flex items-center gap-4">
        <!-- Session Timer -->
        <div class="animate-fadeIn">
          <div class="flex items-center gap-2 bg-base-100 px-3 py-2 ">
            <i class="fa-solid fa-clock text-blue-900 text-sm"></i>
            <div class="flex gap-2">
              <span class="text-xs text-gray-500 font-medium">Timeout / Idle</span>
              <span id="sessionTimer" class="text-sm font-bold text-blue-900">5:00</span>
            </div>
          </div>
        </div>

        <!-- Time Display -->
        <div class="animate-fadeIn">
          <span id="philippineTime" class="font-medium max-md:text-sm"></span>
        </div>

        <!-- Notification Dropdown -->
        <livewire:employee-notifications />



        <!-- User Dropdown -->
        <div class="dropdown dropdown-end">
          @php
            $user = Auth::user();
            $photo = $user->additionalInfo->adminphoto ?? null;
            $initials = strtoupper(substr($user->employee_name ?? 'AA', 0, 2));
          @endphp

          <label tabindex="0"
            class="btn btn-ghost btn-circle flex items-center justify-center bg-blue-500 rounded-full w-10 h-10 overflow-hidden">

            @if ($photo && file_exists(public_path($photo)))
              <img src="{{ asset($photo) }}" alt="Profile Photo" class="w-full h-full object-cover">
            @else
              <span class="text-white font-bold text-sm leading-none">
                {{ $initials }}
              </span>
            @endif
          </label>

          <ul tabindex="0" class="dropdown-content menu mt-1 z-[100] w-52 bg-[#001f54] rounded-box shadow-xl">
            <!-- User Profile Section -->
            <li class="p-3 border-b">
              <div class="bg-blue-700/50 rounded-md shadow-md flex items-center gap-3">

                <!-- Avatar with initials -->
                <div class="w-10 h-10 rounded-full overflow-hidden flex items-center justify-center bg-blue-500">
                  @if ($photo && file_exists(public_path($photo)))
                    <img src="{{ asset($photo) }}" alt="Profile Photo" class="w-full h-full object-cover">
                  @else
                    <span class="text-white font-bold text-sm">
                      {{ $initials }}
                    </span>
                  @endif
                </div>
                <!-- User Info -->
                <div>
                  <p class="font-medium text-white">{{ Auth::user()->employee_name }}</p>
                  <p class="text-xs text-white">{{ Auth::user()->role }}</p>
                </div>
              </div>
            </li>

            <!-- Menu Items -->
            <li>
              <a href="/adminprofile"
                class="flex items-center gap-2 px-4 py-2 text-white hover:bg-blue-700/50 transition-colors">
                <i class="fa-solid fa-user w-4 h-4"></i>
                <span>Profile</span>
              </a>
            </li>

            <li>
              <a class="flex items-center gap-2 px-4 py-2 text-white hover:bg-blue-700/50 transition-colors">
                <i class="fa-solid fa-gear w-4 h-4"></i>
                <span>Settings</span>
              </a>
            </li>

            <li>
              <a href="/employeelogout"
                class="flex items-center gap-2 px-4 py-2 text-white hover:bg-blue-700/50 transition-colors">
                <i class="fa-solid fa-right-from-bracket w-4 h-4"></i>
                <span>Sign out</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</header>

<!-- Session Timer Script -->
<script>
const sessionTimeoutDuration = 300000; // 5 minutes in milliseconds
let sessionTimer;
let sessionTimeRemaining = sessionTimeoutDuration;
let isSessionActive = true;

const sessionTimerEl = document.getElementById('sessionTimer');

function updateSessionDisplay() {
    if (!sessionTimerEl) return;
    
    const minutes = Math.floor(sessionTimeRemaining / 60000);
    const seconds = Math.floor((sessionTimeRemaining % 60000) / 1000);
    
    if (minutes > 0) {
        sessionTimerEl.textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;
        sessionTimerEl.className = 'text-sm font-bold text-blue-600';
    } else {
        sessionTimerEl.textContent = `${seconds}s`;
        sessionTimerEl.className = 'text-sm font-bold text-orange-600';
    }
}

function startSessionTimer() {
    clearInterval(sessionTimer);
    sessionTimeRemaining = sessionTimeoutDuration;
    isSessionActive = true;
    
    sessionTimer = setInterval(() => {
        sessionTimeRemaining -= 1000;
        
        if (sessionTimeRemaining <= 0) {
            clearInterval(sessionTimer);
            isSessionActive = false;
            // The warning will be shown by the sessiontimeout component
        } else {
            updateSessionDisplay();
        }
    }, 1000);
    
    updateSessionDisplay();
}

function resetSessionTimer() {
    startSessionTimer();
}

// Add event listeners for user activity
['mousemove', 'keydown', 'scroll', 'click'].forEach(event => {
    window.addEventListener(event, resetSessionTimer);
});

// Start the timer when page loads
document.addEventListener('DOMContentLoaded', () => {
    startSessionTimer();
});

// Make the reset function available globally for the session timeout component
window.resetSessionTimer = resetSessionTimer;
</script>

<style>
  @media (max-width: 767px) {
    .dropdown-content {
      left: 50% !important;
      transform: translateX(-80%) !important;


    }
  }
</style>