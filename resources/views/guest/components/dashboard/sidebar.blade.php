<div
  class="bg-[#001f54] pt-5 pb-4 flex flex-col fixed md:relative h-full transition-all duration-300 ease-in-out shadow-xl transform -translate-x-full md:transform-none md:translate-x-0"
  id="sidebar">

  <!-- Sidebar Header -->
  <div class="flex items-center justify-between flex-shrink-0 px-4 mb-6 text-center">
    <h1 class="text-xl font-bold text-white items-center gap-2">
      <img id="sidebar-logo" src="{{asset('images/logo/logofinal.png')}}" alt="">
      <img id="sonly" class="hidden w-full h-25" src="{{asset('images/logo/sonly.png')}}" alt="">
    </h1>
  </div>

  <!-- Navigation Menu -->
  <div class="flex-1 flex flex-col overflow-y-auto">
    <nav class="flex-1 px-2 space-y-1">

      <!-- Section Label -->
      <div class="px-4 py-2">
        <span class="text-xs font-semibold uppercase tracking-wider text-blue-300 sidebar-text">Main Menu</span>
      </div>

      <!-- Dashboard -->
      <a href="/guestdashboard" class="block">
        <div
          class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all hover:bg-blue-600/50 text-white group">
          <div class="p-1.5 rounded-lg bg-blue-800/30 group-hover:bg-blue-700/50 transition-colors">
            <i class="fa-solid fa-house text-[#F7B32B] group-hover:text-white"></i>
          </div>
          <span class="ml-3 sidebar-text">Dashboard</span>
        </div>
      </a>

      <!-- My Reservations -->

      <div class="px-4 py-2">
        <span class="text-xs font-semibold uppercase tracking-wider text-blue-300 sidebar-text">Bookings</span>
      </div>

      <a href="/myreservation" class="block">
        <div
          class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all hover:bg-blue-600/50 text-white group">
          <div class="p-1.5 rounded-lg bg-blue-800/30 group-hover:bg-blue-700/50 transition-colors">
            <i class="fa-solid fa-calendar-check text-[#F7B32B] group-hover:text-white"></i>
          </div>
          <span class="ml-3 sidebar-text">My Reservations</span>
        </div>
      </a>

      <!-- Booking And Reservations -->
      <div class="collapse group">
        <input type="checkbox" class="peer" />
        <div
          class="collapse-title flex items-center justify-between px-4 py-3 text-sm font-medium rounded-lg transition-all peer-checked:bg-blue-600/50 text-white group">
          <div class="flex items-center">
            <div class="p-1.5 rounded-lg bg-blue-800/30 group-hover:bg-blue-700/50 transition-colors">
              <i class="fa-solid fa-calendar-days text-[#F7B32B] group-hover:text-white"></i>
            </div>
            <span class="ml-3 sidebar-text">Booking And Reservations</span>
          </div>
          <i
            class="fa-solid fa-chevron-down text-blue-200 transform transition-transform duration-200 peer-checked:rotate-90 dropdown-icon"></i>
        </div>
        <div class="collapse-content pl-14 pr-4 py-1 space-y-1">
          <a href="/showrooms"
            class="block px-3 py-2 text-sm rounded-lg transition-all hover:bg-blue-600/30 text-blue-100 hover:text-white">
            <span class="flex items-center gap-2">
              <i class="fa-solid fa-bed text-[#F7B32B]"></i> Room Reservation
            </span>
          </a>
          <a href="/aiguest"
            class="block px-3 py-2 text-sm rounded-lg transition-all hover:bg-blue-600/30 text-blue-100 hover:text-white">
            <span class="flex items-center gap-2">
              <i class="fa-solid fa-robot text-[#F7B32B]"></i> AI Assistance
            </span>
          </a>
        </div>
      </div>

      {{-- Events --}}

      <div class="collapse group">
        <input type="checkbox" class="peer" />
        <div
          class="collapse-title flex items-center justify-between px-4 py-3 text-sm font-medium rounded-lg transition-all peer-checked:bg-blue-600/50 text-white group">
          <div class="flex items-center">
            <div class="p-1.5 rounded-lg bg-blue-800/30 group-hover:bg-blue-700/50 transition-colors">
              <i class="fa-solid fa-calendar-days text-[#F7B32B] group-hover:text-white"></i>
            </div>
            <span class="ml-3 sidebar-text">Events And Conference Reservations</span>
          </div>
          <i
            class="fa-solid fa-chevron-down text-blue-200 transform transition-transform duration-200 peer-checked:rotate-90 dropdown-icon"></i>
        </div>
        <div class="collapse-content pl-14 pr-4 py-1 space-y-1">
          <a href="/bookeventguest"
            class="block px-3 py-2 text-sm rounded-lg transition-all hover:bg-blue-600/30 text-blue-100 hover:text-white">
            <span class="flex items-center gap-2">
              <i class="fa-solid fa-handshake-angle text-[#F7B32B]"></i> Book An Event
            </span>
          </a>
          <a href="/myeventbookings"
            class="block px-3 py-2 text-sm rounded-lg transition-all hover:bg-blue-600/30 text-blue-100 hover:text-white">
            <span class="flex items-center gap-2">
              <i class="fa-solid fa-ticket text-[#F7B32B]"></i> My Reservations
            </span>
          </a>
        </div>
      </div>

      <!-- Provide Feedback -->
      <div class="px-4 py-2">
        <span class="text-xs font-semibold uppercase tracking-wider text-blue-300 sidebar-text">Feedbacks</span>
      </div>

      <div class="collapse group">
        <input type="checkbox" class="peer" />
        <div
          class="collapse-title flex items-center justify-between px-4 py-3 text-sm font-medium rounded-lg transition-all peer-checked:bg-blue-600/50 text-white group">
          <div class="flex items-center">
            <div class="p-1.5 rounded-lg bg-blue-800/30 group-hover:bg-blue-700/50 transition-colors">
              <i class="fa-solid fa-users text-[#F7B32B] group-hover:text-white"></i>
            </div>
            <span class="ml-3 sidebar-text">Provide Feedback</span>
          </div>
          <i
            class="fa-solid fa-chevron-down text-blue-200 transform transition-transform duration-200 peer-checked:rotate-90 dropdown-icon"></i>
        </div>
        <div class="collapse-content pl-14 pr-4 py-1 space-y-1">
          <a href="/guestroomfeedback"
            class="block px-3 py-2 text-sm rounded-lg transition-all hover:bg-blue-600/30 text-blue-100 hover:text-white">
            <span class="flex items-center gap-2">
              <i class="fa-solid fa-star text-[#F7B32B]"></i> Room Feedbacks
            </span>
          </a>
         
        </div>
      </div>


      <div class="px-4 py-2">
        <span class="text-xs font-semibold uppercase tracking-wider text-blue-300 sidebar-text">Restaurant</span>
      </div>

      <!-- Restaurant -->
      <div class="collapse group">
        <input type="checkbox" class="peer" />
        <div
          class="collapse-title flex items-center justify-between px-4 py-3 text-sm font-medium rounded-lg transition-all peer-checked:bg-blue-600/50 text-white group">
          <div class="flex items-center">
            <div class="p-1.5 rounded-lg bg-blue-800/30 group-hover:bg-blue-700/50 transition-colors">
              <i class="fa-solid fa-utensils text-[#F7B32B] group-hover:text-white"></i>
            </div>
            <span class="ml-3 sidebar-text">Restaurant</span>
          </div>
          <i
            class="fa-solid fa-chevron-down text-blue-200 transform transition-transform duration-200 peer-checked:rotate-90 dropdown-icon"></i>
        </div>
        <div class="collapse-content pl-14 pr-4 py-1 space-y-1">
          <a href="/menuorder"
            class="block px-3 py-2 text-sm rounded-lg transition-all hover:bg-blue-600/30 text-blue-100 hover:text-white">
            <span class="flex items-center gap-2">
              <i class="fa-solid fa-list text-[#F7B32B]"></i> Order Menu
            </span>
          </a>
          <a href="/myorder"
            class="block px-3 py-2 text-sm rounded-lg transition-all hover:bg-blue-600/30 text-blue-100 hover:text-white">
            <span class="flex items-center gap-2">
              <i class="fa-solid fa-bowl-food text-[#F7B32B]"></i> My Orders
            </span>
          </a>
          <a href="/recentorders"
            class="block px-3 py-2 text-sm rounded-lg transition-all hover:bg-blue-600/30 text-blue-100 hover:text-white">
            <span class="flex items-center gap-2">
              <i class="fa-solid fa-clock text-[#F7B32B]"></i> Recent Orders
            </span>
          </a>
        </div>
      </div>

      <div class="px-4 py-2">
        <span class="text-xs font-semibold uppercase tracking-wider text-blue-300 sidebar-text">History</span>
      </div>


      <a href="/paymenthistoryguest" class="block">
        <div
          class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all hover:bg-blue-600/50 text-white group">
          <div class="p-1.5 rounded-lg bg-blue-800/30 group-hover:bg-blue-700/50 transition-colors">
            <i class="fas fa-file-alt text-[#F7B32B] group-hover:text-white"></i>
          </div>
          <span class="ml-3 sidebar-text">Payment History</span>
        </div>
      </a>





    </nav>
  </div>
</div>

<!-- Sidebar overlay for mobile -->
<div class="sidebar-overlay" onclick="toggleSidebar()"></div>

<style>
  /* Mobile styles */
  @media (max-width: 767px) {
    #sidebar {
      z-index: 40;
      width: 16rem;
      /* w-64 equivalent */
      left: 0;
      top: 0;
      bottom: 0;
      transition: transform 0.3s ease;
    }

    #sidebar.translate-x-0 {
      transform: translateX(0);
    }

    #sidebar.-translate-x-full {
      transform: translateX(-100%);
    }

    /* Optional overlay */
    .sidebar-overlay {
      position: fixed;
      top: 0;
      right: 0;
      bottom: 0;
      left: 0;
      background: rgba(0, 0, 0, 0.5);
      z-index: 30;
      display: none;
    }

    #sidebar.translate-x-0+.sidebar-overlay {
      display: block;
    }
  }

  /* Desktop styles */
  .w-20 .sidebar-text {
    display: none;
  }

  .w-20 .flex.items-center {
    justify-content: center;
    padding-left: 0.5rem;
    padding-right: 0.5rem;
  }

  .w-20 .collapse-title {
    padding-left: 0.5rem;
    padding-right: 0.5rem;
    justify-content: center;
  }

  .w-20 .collapse-content {
    display: none;
  }

  .w-20 .text-xs.uppercase {
    display: none;
  }

  .w-20 .p-1.5.rounded-lg {
    margin-right: 0;
  }

  #sidebar-logo {
    opacity: 0;
    transition: opacity 0.3s ease;
  }

  #sidebar.loaded #sidebar-logo {
    opacity: 1;
  }

  /* Position the hamburger bars */
  #line1,
  #line2,
  #line3 {
    transition: all 0.3s ease;
  }

  /* Default state */
  .line1 {
    transform: translateY(-6px);
  }

  .line2 {
    transform: translateY(0);
  }

  .line3 {
    transform: translateY(6px);
  }
</style>