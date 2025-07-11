<header class="bg-base-100 shadow-sm z-10 border-b border-base-300 ">
    <div class="px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16">
        <div class="flex items-center">
          <button onclick="toggleSidebar()" class="btn btn-ghost btn-sm hover:bg-base-300 transition-all hover:scale-105">
            <i data-lucide="menu" class="w-5 h-5"></i>
          </button>
          <div class="hidden md:block ml-4 animate-fadeIn">
            
          </div>
        </div>
       <div class="flex items-center gap-4">
<!-- Notification Dropdown -->
<div class="dropdown dropdown-end">
<button tabindex="0" class="p-2">
<div class="relative">
  <i data-lucide="bell" class="w-6 h-6"></i>
  <span class="absolute top-0 right-0 w-1.5 h-1.5 bg-red-500 rounded-full"></span>
</div>
</button>
<ul tabindex="0" class="dropdown-content menu mt-1 z-10 w-56 bg-white shadow border text-sm">
<li class="p-2 border-b flex justify-between">
  <span>Notifications</span>
  <button class="text-blue-500">Clear</button>
</li>
<!-- Notification items would go here -->
</ul>
</div>

<!-- User Dropdown -->
<div class="dropdown dropdown-end">
<label tabindex="0" class="p-2 cursor-pointer">
<div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center">
  <i data-lucide="user" class="w-2.5 h-2.5"></i>
</div>
</label>
<ul tabindex="0" class="dropdown-content menu mt-1 z-10 w-36 bg-white shadow border text-sm">
<li><a class="flex items-center px-2 py-1"><i data-lucide="user" class="w-2.5 h-2.5 mr-1"></i>Profile</a></li>
<li><a class="flex items-center px-2 py-1"><i data-lucide="settings" class="w-2.5 h-2.5 mr-1"></i>Settings</a></li>
<li><a class="flex items-center px-2 py-1"><i data-lucide="log-out" class="w-2.5 h-2.5 mr-1"></i>Sign out</a></li>
</ul>
</div>
</div>

      </div>
    </div>
  </header>