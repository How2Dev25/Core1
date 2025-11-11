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
      @if(Auth::user()->role === 'Hotel Admin')
        <div class="px-4 py-2">
          <span class="text-xs font-semibold uppercase tracking-wider text-blue-300 sidebar-text">Main Menu</span>
        </div>

        <!-- Dashboard -->
        <a href="/employeedashboard" class="block">
          <div
            class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all hover:bg-blue-600/50 text-white group">
            <div class="p-1.5 rounded-lg bg-blue-800/30 group-hover:bg-blue-700/50 transition-colors flex items-center justify-center w-9 h-9">
              <i class="fas fa-home text-[#F7B32B] group-hover:text-white"></i>
            </div>
            <span class="ml-3 sidebar-text">Dashboard</span>
          </div>
        </a>
      @endif

      @if(Auth::user()->role === 'Hotel Admin')
        <div class="px-4 py-2">
          <span class="text-xs font-semibold uppercase tracking-wider text-blue-300 sidebar-text">User Management</span>
        </div>

        <div class="collapse group">
          <input type="checkbox" class="peer" />
          <div
            class="collapse-title flex items-center justify-between px-4 py-3 text-sm font-medium rounded-lg transition-all peer-checked:bg-blue-600/50 text-white group">
            <div class="flex items-center">
              <div class="p-1.5 rounded-lg bg-blue-800/30 group-hover:bg-blue-700/50 transition-colors flex items-center justify-center w-9 h-9">
                <i class="fas fa-users text-[#F7B32B] group-hover:text-white"></i>
              </div>
              <span class="ml-3 sidebar-text">Account Management</span>
            </div>
            <i
              class="fas fa-chevron-down w-4 h-4 text-blue-200 transform transition-transform duration-200 peer-checked:rotate-90 dropdown-icon"></i>
          </div>

          <div class="collapse-content pl-14 pr-4 py-1 space-y-1">
            <!-- Department Accounts -->
            <a href="/departmentaccount"
              class="block px-3 py-2 text-sm rounded-lg transition-all hover:bg-blue-600/30 text-blue-100 hover:text-white">
              <span class="flex items-center gap-2">
                <i class="fas fa-building w-4 h-4 text-[#F7B32B]"></i>
                Department Accounts
              </span>
            </a>

            <!-- Department Logs -->
            <a href="/departmentlogs"
              class="block px-3 py-2 text-sm rounded-lg transition-all hover:bg-blue-600/30 text-blue-100 hover:text-white">
              <span class="flex items-center gap-2">
                <i class="fas fa-file-alt w-4 h-4 text-[#F7B32B]"></i>
                Department Logs
              </span>
            </a>

            <!-- Audit Trails & Transactions -->
            <a href="/audittrails"
              class="block px-3 py-2 text-sm rounded-lg transition-all hover:bg-blue-600/30 text-blue-100 hover:text-white">
              <span class="flex items-center gap-2">
                <i class="fas fa-chart-line w-4 h-4 text-[#F7B32B]"></i>
                Audit Trails & Transactions
              </span>
            </a>

            <!-- Guest Accounts -->
            <a href="/guestaccount"
              class="block px-3 py-2 text-sm rounded-lg transition-all hover:bg-blue-600/30 text-blue-100 hover:text-white">
              <span class="flex items-center gap-2">
                <i class="fas fa-user w-4 h-4 text-[#F7B32B]"></i>
                Guest Accounts
              </span>
            </a>
          </div>
        </div>
      @endif

      <!-- Section Label -->
      @if(Auth::user()->role === 'Hotel Admin' || Auth::user()->role === 'Receptionist')
        <div class="px-4 py-2 mt-4">
          <span class="text-xs font-semibold uppercase tracking-wider text-blue-300 sidebar-text">Operations</span>
        </div>

        <!-- Front Desk -->
        <a href="/frontdesk" class="block">
          <div
            class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all hover:bg-blue-600/50 text-white group">
            <div class="p-1.5 rounded-lg bg-blue-800/30 group-hover:bg-blue-700/50 transition-colors flex items-center justify-center w-9 h-9">
              <i class="fas fa-desktop text-[#F7B32B] group-hover:text-white"></i>
            </div>
            <span class="ml-3 sidebar-text">Front Desk And Reception</span>
          </div>
        </a>

        <a href="/pointofsale" class="block">
          <div
            class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all hover:bg-blue-600/50 text-white group">
            <div class="p-1.5 rounded-lg bg-blue-800/30 group-hover:bg-blue-700/50 transition-colors flex items-center justify-center w-9 h-9">
              <i class="fas fa-shopping-bag text-[#F7B32B] group-hover:text-white"></i>
            </div>
            <span class="ml-3 sidebar-text">Point Of Sale</span>
          </div>
        </a>

        <!-- Reservation And Booking -->
        <div class="collapse group">
          <input type="checkbox" class="peer" />
          <div
            class="collapse-title flex items-center justify-between px-4 py-3 text-sm font-medium rounded-lg transition-all peer-checked:bg-blue-600/50 text-white group">
            <div class="flex items-center">
              <div class="p-1.5 rounded-lg bg-blue-800/30 group-hover:bg-blue-700/50 transition-colors flex items-center justify-center w-9 h-9">
                <i class="fas fa-calendar-check text-[#F7B32B] group-hover:text-white"></i>
              </div>
              <span class="ml-3 sidebar-text">Booking And Reservations</span>
            </div>
            <i
              class="fas fa-chevron-down w-4 h-4 text-blue-200 transform transition-transform duration-200 peer-checked:rotate-90 dropdown-icon"></i>
          </div>
          <div class="collapse-content pl-14 pr-4 py-1 space-y-1">
            <a href="/bas"
              class="block px-3 py-2 text-sm rounded-lg transition-all hover:bg-blue-600/30 text-blue-100 hover:text-white">
              <span class="flex items-center gap-2">
                <i class="fas fa-bed w-4 h-4 text-[#F7B32B]"></i>
                Room Reservation
              </span>
            </a>
          </div>
        </div>
      @endif

      <!-- Section Label -->
      @if(Auth::user()->role === 'Hotel Admin' || Auth::user()->role === 'Receptionist')
        <div class="px-4 py-2 mt-4">
          <span class="text-xs font-semibold uppercase tracking-wider text-blue-300 sidebar-text">Billing</span>
        </div>

        <div class="collapse group">
          <input type="checkbox" class="peer" />
          <div
            class="collapse-title flex items-center justify-between px-4 py-3 text-sm font-medium rounded-lg transition-all peer-checked:bg-blue-600/50 text-white group">
            <div class="flex items-center">
              <div class="p-1.5 rounded-lg bg-blue-800/30 group-hover:bg-blue-700/50 transition-colors flex items-center justify-center w-9 h-9">
                <i class="fas fa-credit-card text-[#F7B32B] group-hover:text-white"></i>
              </div>
              <span class="ml-3 sidebar-text">Billing and Payments</span>
            </div>
            <i
              class="fas fa-chevron-down w-4 h-4 text-blue-200 transform transition-transform duration-200 peer-checked:rotate-90 dropdown-icon"></i>
          </div>

          <div class="collapse-content pl-14 pr-4 py-1 space-y-1">
            
            <a href="/managefees"
              class="block px-3 py-2 text-sm rounded-lg transition-all hover:bg-blue-600/30 text-blue-100 hover:text-white">
              <span class="flex items-center gap-2">
                <i class="fas fa-cog w-4 h-4 text-[#F7B32B]"></i>
                Manage Fees
              </span>
            </a>

            <a href="/transactionhistoryadmin"
              class="block px-3 py-2 text-sm rounded-lg transition-all hover:bg-blue-600/30 text-blue-100 hover:text-white">
              <span class="flex items-center gap-2">
                <i class="fas fa-file-alt w-4 h-4 text-[#F7B32B]"></i>
                Transaction History
              </span>
            </a>
          </div>
        </div>
      @endif

      @if(
  Auth::user()->role === 'Hotel Admin' || Auth::user()->role === 'Guest Relationship Head'
  || Auth::user()->role === 'Receptionist'
)
        <div class="px-4 py-2 mt-4">
          <span class="text-xs font-semibold uppercase tracking-wider text-blue-300 sidebar-text">CRM</span>
        </div>
      @endif

      <!-- Guest Management -->
      @if(Auth::user()->role === 'Hotel Admin' || Auth::user()->role === 'Guest Relationship Head')
        <div class="collapse group">
          <input type="checkbox" class="peer" />
          <div
            class="collapse-title flex items-center justify-between px-4 py-3 text-sm font-medium rounded-lg transition-all peer-checked:bg-blue-600/50 text-white group">
            <div class="flex items-center">
              <div class="p-1.5 rounded-lg bg-blue-800/30 group-hover:bg-blue-700/50 transition-colors flex items-center justify-center w-9 h-9">
                <i class="fas fa-users text-[#F7B32B] group-hover:text-white"></i>
              </div>
              <span class="ml-3 sidebar-text ">Guest Relationship Management</span>
            </div>
            <i
              class="fas fa-chevron-down w-4 h-4 text-blue-200 transform transition-transform duration-200 peer-checked:rotate-90 dropdown-icon"></i>
          </div>
          <div class="collapse-content pl-14 pr-4 py-1 space-y-1">
            <a href="/roomfeedback"
              class="block px-3 py-2 text-sm rounded-lg transition-all hover:bg-blue-600/30 text-blue-100 hover:text-white">
              <span class="flex items-center gap-2">
                <i class="fas fa-star w-4 h-4 text-[#F7B32B]"></i>
                Room Feedbacks
              </span>
            </a>
            <a href="/servicefeedback"
              class="block px-3 py-2 text-sm rounded-lg transition-all hover:bg-blue-600/30 text-blue-100 hover:text-white">
              <span class="flex items-center gap-2">
                <i class="fas fa-heart w-4 h-4 text-[#F7B32B]"></i>
                Service Feedbacks
              </span>
            </a>
          </div>
        </div>
      @endif

      @if(Auth::user()->role === 'Hotel Admin' || Auth::user()->role === 'Receptionist')
        <a href="/lar" class="block">
          <div
            class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all hover:bg-blue-600/50 text-white group">
            <div class="p-1.5 rounded-lg bg-blue-800/30 group-hover:bg-blue-700/50 transition-colors flex items-center justify-center w-9 h-9">
              <i class="fas fa-award text-[#F7B32B] group-hover:text-white"></i>
            </div>
            <span class="ml-3 sidebar-text">Loyalty And Rewards</span>
          </div>
        </a>
      @endif

      <!-- Section Label -->
      @if(
  Auth::user()->role === 'Hotel Admin' || Auth::user()->role === 'Room Attendant'
  || Auth::user()->role === 'Room Manager' || Auth::user()->role === 'Maintenance Staff'
)
        <div class="px-4 py-2 mt-4">
          <span class="text-xs font-semibold uppercase tracking-wider text-blue-300 sidebar-text">Room Management</span>
        </div>
      @endif

      <!-- Room Management -->
      @if(
  Auth::user()->role === 'Hotel Admin' || Auth::user()->role === 'Room Attendant'
  || Auth::user()->role === 'Room Manager'
)
        <div class="collapse group">
          <input type="checkbox" class="peer" />
          <div
            class="collapse-title flex items-center justify-between px-4 py-3 text-sm font-medium rounded-lg transition-all peer-checked:bg-blue-600/50 text-white group">
            <div class="flex items-center">
              <div class="p-1.5 rounded-lg bg-blue-800/30 group-hover:bg-blue-700/50 transition-colors flex items-center justify-center w-9 h-9">
                <i class="fas fa-door-open text-[#F7B32B] group-hover:text-white"></i>
              </div>
              <span class="ml-3 sidebar-text">Room Management And Service</span>
            </div>
            <i
              class="fas fa-chevron-down w-4 h-4 text-blue-200 transform transition-transform duration-200 peer-checked:rotate-90 dropdown-icon"></i>
          </div>
          <div class="collapse-content pl-14 pr-4 py-1 space-y-1">
            @if(
    Auth::user()->role === 'Hotel Admin' || Auth::user()->role === 'Room Attendant'
    || Auth::user()->role === 'Room Manager'
  )
              <a href="/roommanagement"
                class="block px-3 py-2 text-sm rounded-lg transition-all hover:bg-blue-600/30 text-blue-100 hover:text-white">
                <span class="flex items-center gap-2">
                  <i class="fas fa-bed w-4 h-4 text-[#F7B32B]"></i>
                  Rooms
                </span>
              </a>
            @endif

            @if(Auth::user()->role === 'Hotel Admin' || Auth::user()->role === 'Receptionist')
              <a href="/servicemanagement"
                class="block px-3 py-2 text-sm rounded-lg transition-all hover:bg-blue-600/30 text-blue-100 hover:text-white">
                <span class="flex items-center gap-2">
                  <i class="fas fa-key w-4 h-4 text-[#F7B32B]"></i>
                  Door Locks
                </span>
              </a>
            @endif

            @if(
    Auth::user()->role === 'Hotel Admin' || Auth::user()->role === 'Room Attendant'
    || Auth::user()->role === 'Room Manager'
  )
              <a href="/roomtypesadmin"
                class="block px-3 py-2 text-sm rounded-lg transition-all hover:bg-blue-600/30 text-blue-100 hover:text-white">
                <span class="flex items-center gap-2">
                  <i class="fas fa-layer-group w-4 h-4 text-[#F7B32B]"></i>
                  Room Types
                </span>
              </a>
            @endif
          </div>
        </div>
      @endif

      @if(
  Auth::user()->role === 'Hotel Admin' || Auth::user()->role === 'Maintenance Staff'
  || Auth::user()->role === 'Room Manager' || Auth::user()->role === 'Room Attendant'
)
        <a href="/hmm" class="block">
          <div
            class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all hover:bg-blue-600/50 text-white group">
            <div class="p-1.5 rounded-lg bg-blue-800/30 group-hover:bg-blue-700/50 transition-colors flex items-center justify-center w-9 h-9">
              <i class="fas fa-broom text-[#F7B32B] group-hover:text-white"></i>
            </div>
            <span class="ml-3 sidebar-text">Housekeeping And Maintenance</span>
          </div>
        </a>
      @endif

      <!-- Section Label -->
      @if(
  Auth::user()->role === 'Hotel Admin' || Auth::user()->role === 'Material Custodian'
  || Auth::user()->role === 'Hotel Inventory Manager'
)
        <div class="px-4 py-2 mt-4">
          <span class="text-xs font-semibold uppercase tracking-wider text-blue-300 sidebar-text">Stocks Management</span>
        </div>

        <a href="/ias" class="block">
          <div
            class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all hover:bg-blue-600/50 text-white group">
            <div class="p-1.5 rounded-lg bg-blue-800/30 group-hover:bg-blue-700/50 transition-colors flex items-center justify-center w-9 h-9">
              <i class="fas fa-boxes text-[#F7B32B] group-hover:text-white"></i>
            </div>
            <span class="ml-3 sidebar-text">Inventory And Stock Management</span>
          </div>
        </a>
      @endif

      @if(
  Auth::user()->role === 'Hotel Admin' || Auth::user()->role === 'Receptionist' || Auth::user()->role === 'Hotel Marketing Officer'
)
        <div class="px-4 py-2 mt-4">
          <span class="text-xs font-semibold uppercase tracking-wider text-blue-300 sidebar-text">Marketing</span>
        </div>
      @endif

      @if(Auth::user()->role === 'Hotel Admin')
        <!-- Event & Conference Management -->
        <div class="collapse group">
          <input type="checkbox" class="peer" />
          <div
            class="collapse-title flex items-center justify-between px-4 py-3 text-sm font-medium rounded-lg transition-all peer-checked:bg-blue-600/50 text-white group">
            <div class="flex items-center">
              <div class="p-1.5 rounded-lg bg-blue-800/30 group-hover:bg-blue-700/50 transition-colors flex items-center justify-center w-9 h-9">
                <i class="fas fa-calendar-alt text-[#F7B32B] group-hover:text-white"></i>
              </div>
              <span class="ml-3 sidebar-text">Event & Conference</span>
            </div>
            <i
              class="fas fa-chevron-down w-4 h-4 text-blue-200 transform transition-transform duration-200 peer-checked:rotate-90 dropdown-icon"></i>
          </div>

          <div class="collapse-content pl-14 pr-4 py-1 space-y-1">
            <!-- Events -->
            <a href="/ecm"
              class="block px-3 py-2 text-sm rounded-lg transition-all hover:bg-blue-600/30 text-blue-100 hover:text-white">
              <span class="flex items-center gap-2">
                <i class="fas fa-calendar-day w-4 h-4 text-[#F7B32B]"></i>
                Events And Conference
              </span>
            </a>

            <a href="/eventbookings"
              class="block px-3 py-2 text-sm rounded-lg transition-all hover:bg-blue-600/30 text-blue-100 hover:text-white">
              <span class="flex items-center gap-2">
                <i class="fas fa-calendar-check w-4 h-4 text-[#F7B32B]"></i>
                Manage Bookings
              </span>
            </a>


            <!-- Facilities -->
            <a href="/facilities"
              class="block px-3 py-2 text-sm rounded-lg transition-all hover:bg-blue-600/30 text-blue-100 hover:text-white">
              <span class="flex items-center gap-2">
                <i class="fas fa-building w-4 h-4 text-[#F7B32B]"></i>
                Facilities
              </span>
            </a>
          </div>
        </div>
      @endif

      @if(
  Auth::user()->role === 'Hotel Admin' || Auth::user()->role === 'Hotel Marketing Officer'
)
        <a href="/hmp" class="block">
          <div
            class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all hover:bg-blue-600/50 text-white group">
            <div class="p-1.5 rounded-lg bg-blue-800/30 group-hover:bg-blue-700/50 transition-colors flex items-center justify-center w-9 h-9">
              <i class="fas fa-bullhorn text-[#F7B32B] group-hover:text-white"></i>
            </div>
            <span class="ml-3 sidebar-text">Hotel Marketing And Promotion</span>
          </div>
        </a>
      @endif

      @if(
  Auth::user()->role === 'Hotel Admin' || Auth::user()->role === 'Receptionist'
)
        <a href="/channel" class="block">
          <div
            class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all hover:bg-blue-600/50 text-white group">
            <div class="p-1.5 rounded-lg bg-blue-800/30 group-hover:bg-blue-700/50 transition-colors flex items-center justify-center w-9 h-9">
              <i class="fas fa-share-alt text-[#F7B32B] group-hover:text-white"></i>
            </div>
            <span class="ml-3 sidebar-text">Channel Management</span>
          </div>
        </a>
      @endif

      <!-- Section Label -->
      @if(Auth::user()->role === 'Hotel Admin')
        <div class="px-4 py-2 mt-4">
          <span class="text-xs font-semibold uppercase tracking-wider text-blue-300 sidebar-text">Integration</span>
        </div>

        <a href="/restoadmin" class="block">
          <div
            class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all hover:bg-blue-600/50 text-white group">
            <div class="p-1.5 rounded-lg bg-blue-800/30 group-hover:bg-blue-700/50 transition-colors flex items-center justify-center w-9 h-9">
              <i class="fas fa-utensils text-[#F7B32B] group-hover:text-white"></i>
            </div>
            <span class="ml-3 sidebar-text">Restaurant Menu</span>
          </div>
        </a>
      @endif
    </nav>
  </div>
</div>

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
#line1, #line2, #line3 {
  transition: all 0.3s ease;
}

/* Default state */
.line1 { transform: translateY(-6px); }
.line2 { transform: translateY(0); }
.line3 { transform: translateY(6px); }
</style>