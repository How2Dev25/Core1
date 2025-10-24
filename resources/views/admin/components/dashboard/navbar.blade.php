@include('security.sessiontimeout')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<header class="bg-base-100 shadow-sm z-10 border-b border-base-300 dark:border-gray-700" data-theme="light">
  <div class="px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between h-16">
      <div class="flex items-center">
        <button onclick="toggleSidebar()"
          class="btn btn-ghost btn-sm hover:bg-base-300  transition-all hover:scale-105">
          <i data-lucide="menu" class="w-5 h-5"></i>
        </button>
      </div>
      <div class="flex items-center gap-4">
        <!-- Time Display -->
        <div class="animate-fadeIn">
          <span id="philippineTime" class="font-medium max-md:text-sm"></span>
        </div>

        <!-- Notification Dropdown -->
        <livewire:employee-notifications />



        <!-- User Dropdown -->
        <div class="dropdown dropdown-end">
          <label tabindex="0"
            class="btn btn-ghost btn-circle flex items-center justify-center bg-blue-500 rounded-full w-10 h-10">
            <span class="text-white font-bold text-sm leading-none">
              {{ strtoupper(substr(Auth::user()->employee_name, 0, 2)) }}
            </span>
          </label>

          <ul tabindex="0" class="dropdown-content menu mt-1 z-[100] w-52 bg-[#001f54] rounded-box shadow-xl">
            <!-- User Profile Section -->
            <li class="p-3 border-b">
              <div class="bg-blue-700/50 rounded-md shadow-md flex items-center gap-3">

                <!-- Avatar with initials -->
                <div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center">
                  <span class="text-white font-bold text-sm">
                    {{ strtoupper(substr(Auth::user()->employee_name, 0, 2)) }}
                  </span>
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
              <a class="flex items-center gap-2 px-4 py-2 text-white hover:bg-blue-700/50 transition-colors">
                <i data-lucide="user" class="w-4 h-4"></i>
                <span>Profile</span>
              </a>
            </li>
            <li>
              <a class="flex items-center gap-2 px-4 py-2 text-white hover:bg-blue-700/50 transition-colors">
                <i data-lucide="settings" class="w-4 h-4"></i>
                <span>Settings</span>
              </a>
            </li>
            <li class="">
              <a href="/employeelogout"
                class="flex items-center gap-2 px-4 py-2 text-white hover:bg-blue-700/50 transition-colors">
                <i data-lucide="log-out" class="w-4 h-4"></i>
                <span>Sign out</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</header>


<style>
  @media (max-width: 767px) {
    .dropdown-content {
      left: 50% !important;
      transform: translateX(-80%) !important;


    }
  }
</style>