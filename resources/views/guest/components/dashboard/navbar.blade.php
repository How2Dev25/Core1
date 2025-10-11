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
        <!-- Notification Dropdown -->
        <div class="dropdown dropdown-end">
          <!-- Button -->
          <button id="notification-button" tabindex="0" class="btn btn-ghost btn-circle btn-sm relative">
            <i data-lucide="bell" class="w-5 h-5"></i>
            <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
          </button>

          <!-- Dropdown Content -->
          <ul tabindex="0"
            class="dropdown-content menu mt-3 z-[1] bg-[#001f54] rounded-xl shadow-2xl overflow-hidden w-80">

            <!-- Header -->
            <li class="px-4 py-3 border-b flex justify-between items-center sticky top-0 bg-[#001f54] z-10">
              <div class="flex items-center gap-2">
                <i data-lucide="bell" class="w-5 h-5 text-white"></i>
                <span class="font-semibold text-white">Notifications</span>
              </div>
              <button
                class="flex items-center gap-2 px-3 py-1.5 rounded-lg bg-red-50 text-sm text-red-500 hover:bg-red-100 hover:text-red-700 transition">
                <span class="flex items-center gap-1">
                  <i data-lucide="trash-2" class="w-4 h-4"></i>
                  Clear All
                </span>
              </button>
            </li>

            <!-- Notification Items Container -->
            <div class="max-h-96 overflow-y-auto space-y-2 p-2">

              <!-- New Reservation -->
              <li class="bg-white rounded-lg px-4 py-3 shadow-sm hover:shadow-md transition relative">
                <button class="absolute top-2 right-2 text-gray-400 hover:text-red-500">
                  <i data-lucide="x" class="w-4 h-4"></i>
                </button>
                <a class="flex items-start gap-3">
                  <div class="p-2 rounded-full bg-[#001f54]">
                    <i data-lucide="calendar-check" class="w-5 h-5 text-[#F7B32B]"></i>
                  </div>
                  <div class="flex-1">
                    <p class="font-medium text-gray-900 flex items-center gap-2">
                      New Reservation
                      <span class="text-xs px-2 py-0.5 bg-[#001f54] text-white rounded-full">New</span>
                    </p>
                    <p class="text-sm text-gray-600 mt-1">John Doe booked Deluxe Suite for 3 nights</p>
                    <p class="text-xs text-gray-500 mt-2 flex items-center gap-1">
                      <i data-lucide="clock" class="w-3 h-3"></i>
                      10 minutes ago
                    </p>
                  </div>
                </a>
              </li>

              <!-- Check-in Complete -->
              <li class="bg-white rounded-lg px-4 py-3 shadow-sm hover:shadow-md transition relative">
                <button class="absolute top-2 right-2 text-gray-400 hover:text-red-500">
                  <i data-lucide="x" class="w-4 h-4"></i>
                </button>
                <a class="flex items-start gap-3">
                  <div class="p-2 rounded-full bg-[#001f54]">
                    <i data-lucide="check-circle" class="w-5 h-5 text-[#F7B32B]"></i>
                  </div>
                  <div class="flex-1">
                    <p class="font-medium text-gray-900">Check-in Complete</p>
                    <p class="text-sm text-gray-600 mt-1">Room 302 has been checked in</p>
                    <p class="text-xs text-gray-500 mt-2 flex items-center gap-1">
                      <i data-lucide="clock" class="w-3 h-3"></i>
                      1 hour ago
                    </p>
                  </div>
                </a>
              </li>

              <!-- Maintenance Request (Urgent) -->
              <li class="bg-white rounded-lg px-4 py-3 shadow-sm hover:shadow-md transition relative">
                <button class="absolute top-2 right-2 text-gray-400 hover:text-red-500">
                  <i data-lucide="x" class="w-4 h-4"></i>
                </button>
                <a class="flex items-start gap-3">
                  <div class="p-2 rounded-full bg-[#001f54]">
                    <i data-lucide="alert-triangle" class="w-5 h-5 text-[#F7B32B]"></i>
                  </div>
                  <div class="flex-1">
                    <p class="font-medium text-gray-900 flex items-center gap-2">
                      Maintenance Request
                      <span class="text-xs px-2 py-0.5 bg-red-500 text-white rounded-full">Urgent</span>
                    </p>
                    <p class="text-sm text-gray-600 mt-1">AC not working in Room 215</p>
                    <p class="text-xs text-gray-500 mt-2 flex items-center gap-1">
                      <i data-lucide="clock" class="w-3 h-3"></i>
                      3 hours ago
                    </p>
                  </div>
                </a>
              </li>

              <!-- Guest Message -->
              <li class="bg-white rounded-lg px-4 py-3 shadow-sm hover:shadow-md transition relative">
                <button class="absolute top-2 right-2 text-gray-400 hover:text-red-500">
                  <i data-lucide="x" class="w-4 h-4"></i>
                </button>
                <a class="flex items-start gap-3">
                  <div class="p-2 rounded-full bg-[#001f54]">
                    <i data-lucide="message-circle" class="w-5 h-5 text-[#F7B32B]"></i>
                  </div>
                  <div class="flex-1">
                    <p class="font-medium text-gray-900">Guest Message</p>
                    <p class="text-sm text-gray-600 mt-1">Request for late checkout</p>
                    <p class="text-xs text-gray-500 mt-2 flex items-center gap-1">
                      <i data-lucide="clock" class="w-3 h-3"></i>
                      5 hours ago
                    </p>
                  </div>
                </a>
              </li>

              <!-- Security Alert (Urgent) -->
              <li class="bg-white rounded-lg px-4 py-3 shadow-sm hover:shadow-md transition relative">
                <button class="absolute top-2 right-2 text-gray-400 hover:text-red-500">
                  <i data-lucide="x" class="w-4 h-4"></i>
                </button>
                <a class="flex items-start gap-3">
                  <div class="p-2 rounded-full bg-[#001f54]">
                    <i data-lucide="alert-octagon" class="w-5 h-5 text-[#F7B32B]"></i>
                  </div>
                  <div class="flex-1">
                    <p class="font-medium text-gray-900 flex items-center gap-2">
                      Security Alert
                      <span class="text-xs px-2 py-0.5 bg-red-500 text-white rounded-full">Urgent</span>
                    </p>
                    <p class="text-sm text-gray-600 mt-1">Unauthorized access attempt</p>
                    <p class="text-xs text-gray-500 mt-2 flex items-center gap-1">
                      <i data-lucide="clock" class="w-3 h-3"></i>
                      1 day ago
                    </p>
                  </div>
                </a>
              </li>

              <!-- Payment Received -->
              <li class="bg-white rounded-lg px-4 py-3 shadow-sm hover:shadow-md transition relative">
                <button class="absolute top-2 right-2 text-gray-400 hover:text-red-500">
                  <i data-lucide="x" class="w-4 h-4"></i>
                </button>
                <a class="flex items-start gap-3">
                  <div class="p-2 rounded-full bg-[#001f54]">
                    <i data-lucide="credit-card" class="w-5 h-5 text-[#F7B32B]"></i>
                  </div>
                  <div class="flex-1">
                    <p class="font-medium text-gray-900">Payment Received</p>
                    <p class="text-sm text-gray-600 mt-1">₱450 for Room 204</p>
                    <p class="text-xs text-gray-500 mt-2 flex items-center gap-1">
                      <i data-lucide="clock" class="w-3 h-3"></i>
                      2 days ago
                    </p>
                  </div>
                </a>
              </li>
            </div>

            <!-- Footer -->
            <li class="px-4 py-2 border-t sticky bottom-0 bg-[#001f54]">
              <a class="text-center text-white  text-sm flex items-center justify-center gap-1">
                <i data-lucide="list" class="w-4 h-4"></i>
                <span>View All Notifications</span>
              </a>
            </li>
          </ul>
        </div>




        <!-- User Dropdown -->
        <div class="dropdown dropdown-end">
          <label tabindex="0" class="btn btn-ghost btn-circle avatar">
            <div class="w-8 rounded-full">
              <img src="{{asset(Auth::guard('guest')->user()->guest_photo)}}" alt="User Avatar" />
            </div>
          </label>
          <ul tabindex="0" class="dropdown-content menu mt-1 z-[100] w-52 bg-[#001f54] rounded-box shadow-xl">
            <!-- User Profile Section -->
            <li class="p-3 border-b ">
              <div class="bg-blue-700/50 rounded-md shadow-md flex items-center gap-3">
                <div class="avatar">
                  <div class="w-10 rounded-full">
                    <img src="{{asset(Auth::guard('guest')->user()->guest_photo)}}" alt="User Avatar"
                      class="dark:brightness-90" />
                  </div>
                </div>
                <div>
                  <p class="font-medium text-white">{{Auth::guard('guest')->user()->guest_name}}</p>
                  <p class="text-xs text-white">Guest</p>
                </div>
              </div>
            </li>

            <!-- Menu Items -->
            <li>
              <a href="/profileguest" class="flex items-center gap-2 px-4 py-2 text-white hover:bg-blue-700/50 transition-colors">
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
      <a href="/guestlogout" class="flex items-center gap-2 px-4 py-2 text-white hover:bg-blue-700/50 transition-colors">
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