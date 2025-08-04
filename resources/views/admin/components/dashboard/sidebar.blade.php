<div class="bg-gradient-to-b from-blue-900 via-blue-800 to-blue-700 border-r border-blue-600 pt-5 pb-4 flex flex-col w-64 transition-all duration-300 ease-in-out shadow-xl" id="sidebar">
    <div class="flex items-center flex-shrink-0 px-4 animate-fadeIn">
      <h1 class="text-xl font-bold text-white">Soliera Hotel</h1>
    </div>
    <div class="mt-5 flex-1 flex flex-col overflow-y-auto">
      <nav class="flex-1 px-2 space-y-1">
        <!-- Dashboard -->
        <a href="">
        <div class="flex items-center px-4 py-3 text-sm font-medium rounded-lg sidebar-item hover:bg-blue-600 hover:bg-opacity-50 text-white">
          <i data-lucide="home" class="w-5 h-5 text-blue-200"></i>
          <span class="ml-3">Dashboard</span>
        </div>
        </a>
        
        <a href="/frontdesk">
        <div class="flex items-center px-4 py-3 text-sm font-medium rounded-lg sidebar-item hover:bg-blue-600 hover:bg-opacity-50 text-white">
            <i data-lucide="monitor" class="w-5 h-5 text-blue-200"></i>
            <span class="ml-3">Front Desk And Reception</span>
          </div>
        </a>

       
        <div class="collapse group">
          <input type="checkbox" class="peer" /> 
          <div class="collapse-title flex items-center justify-between px-4 py-3 text-sm font-medium rounded-lg peer-checked:bg-blue-600 peer-checked:bg-opacity-50 text-white sidebar-item">
            <div class="flex items-center">
              <i data-lucide="monitor-check" class="w-5 h-5 text-blue-200"></i>
              <span class="ml-3">Reservation And Booking</span>
            </div>
            <i data-lucide="chevron-right" class="w-4 h-4 text-blue-200 transform transition-transform duration-200 peer-checked:rotate-90"></i>
          </div>
          <div class="collapse-content pl-10 pr-4 py-1 space-y-1"> 
            <a href="/bas" class="block px-3 py-2 text-sm rounded-lg hover:bg-blue-600 hover:bg-opacity-30 text-blue-100 sidebar-item">Room Reservation</a>
            <a href="/aibas" class="block px-3 py-2 text-sm rounded-lg hover:bg-blue-600 hover:bg-opacity-30 text-blue-100 sidebar-item">AI Room Reservation Assistance</a>
          </div>
        </div>


        <div class="collapse group">
          <input type="checkbox" class="peer" /> 
          <div class="collapse-title flex items-center justify-between px-4 py-3 text-sm font-medium rounded-lg peer-checked:bg-blue-600 peer-checked:bg-opacity-50 text-white sidebar-item">
            <div class="flex items-center">
              <i data-lucide="message-circle-more" class="w-5 h-5 text-blue-200"></i>
              <span class="ml-3">Guest Relationship Management</span>
            </div>
            <i data-lucide="chevron-right" class="w-4 h-4 text-blue-200 transform transition-transform duration-200 peer-checked:rotate-90"></i>
          </div>
          <div class="collapse-content pl-10 pr-4 py-1 space-y-1"> 
            <a href="#" class="block px-3 py-2 text-sm rounded-lg hover:bg-blue-600 hover:bg-opacity-30 text-blue-100 sidebar-item">Room Feedbacks</a>
            <a href="#" class="block px-3 py-2 text-sm rounded-lg hover:bg-blue-600 hover:bg-opacity-30 text-blue-100 sidebar-item">Service Feedbacks</a>
          </div>
        </div>

        <div class="collapse group">
          <input type="checkbox" class="peer" /> 
          <div class="collapse-title flex items-center justify-between px-4 py-3 text-sm font-medium rounded-lg peer-checked:bg-blue-600 peer-checked:bg-opacity-50 text-white sidebar-item">
            <div class="flex items-center">
              <i data-lucide="hotel" class="w-5 h-5 text-blue-200"></i>
              <span class="ml-3">Room Management Service</span>
            </div>
            <i data-lucide="chevron-right" class="w-4 h-4 text-blue-200 transform transition-transform duration-200 peer-checked:rotate-90"></i>
          </div>
          <div class="collapse-content pl-10 pr-4 py-1 space-y-1"> 
            <a href="/roommanagement" class="block px-3 py-2 text-sm rounded-lg hover:bg-blue-600 hover:bg-opacity-30 text-blue-100 sidebar-item">Rooms</a>
            <a href="/servicemanagement" class="block px-3 py-2 text-sm rounded-lg hover:bg-blue-600 hover:bg-opacity-30 text-blue-100 sidebar-item">Assign Room Door Lock</a>
            
          </div>
        </div>

          <a href="">
        <div class="flex items-center px-4 py-3 text-sm font-medium rounded-lg sidebar-item hover:bg-blue-600 hover:bg-opacity-50 text-white">
            <i data-lucide="hotel" class="w-5 h-5 text-blue-200"></i>
            <span class="ml-3">Hotel Point Of Sale (POS)</span>
          </div>
        </a>
          
        <a href="/lar">
          <div class="flex items-center px-4 py-3 text-sm font-medium rounded-lg sidebar-item hover:bg-blue-600 hover:bg-opacity-50 text-white">
            <i data-lucide="gift" class="w-5 h-5 text-blue-200"></i>
            <span class="ml-3">Loyalty And Rewards</span>
          </div>
        </a>

        <a href="/ias">
          <div class="flex items-center px-4 py-3 text-sm font-medium rounded-lg sidebar-item hover:bg-blue-600 hover:bg-opacity-50 text-white">
            <i data-lucide="warehouse" class="w-5 h-5 text-blue-200"></i>
            <span class="ml-3">Inventory And Stock</span>
          </div>
        </a>

        <a href="/ecm">
          <div class="flex items-center px-4 py-3 text-sm font-medium rounded-lg sidebar-item hover:bg-blue-600 hover:bg-opacity-50 text-white">
            <i data-lucide="calendar" class="w-5 h-5 text-blue-200"></i>
            <span class="ml-3">Event And Conference</span>
          </div>
        </a>

        <a href="/hmp">
          <div class="flex items-center px-4 py-3 text-sm font-medium rounded-lg sidebar-item hover:bg-blue-600 hover:bg-opacity-50 text-white">
            <i data-lucide="megaphone" class="w-5 h-5 text-blue-200"></i>
            <span class="ml-3">Hotel Marketing And Promotion </span>
          </div>
        </a>

        <a href="/hmm">
          <div class="flex items-center px-4 py-3 text-sm font-medium rounded-lg sidebar-item hover:bg-blue-600 hover:bg-opacity-50 text-white">
            <i data-lucide="brush-cleaning" class="w-5 h-5 text-blue-200"></i>
            <span class="ml-3">Housekeeping And Maintenance</span>
          </div>
        </a>

        <a href="/channel">
          <div class="flex items-center px-4 py-3 text-sm font-medium rounded-lg sidebar-item hover:bg-blue-600 hover:bg-opacity-50 text-white">
            <i data-lucide="square-arrow-out-up-right" class="w-5 h-5 text-blue-200"></i>
            <span class="ml-3">Channel Management</span>
          </div>
        </a>
        
     
    
        
        
      
      </nav>
    </div>
  </div>