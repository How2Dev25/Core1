<!DOCTYPE html>
<html lang="en" data-theme ="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

 
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <title>{{$title}} - Order From Soliera Restaurant</title>
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
            <h1 class="text-2xl font-bold bg-white bg-clip-text text-[#191970]">Restaurant Menu</h1>
          </div>
            {{-- Subsystem Name --}}

  <section class="flex-1 p-6">
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

   <!-- Total Menus -->
<div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
  <div class="flex items-center justify-between">
    <div>
      <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Total Menus</h3>
      <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalmenu }}</p>
      <div class="flex items-center mt-3">
        <span class="text-sm font-medium text-gray-500">Across All Categories</span>
      </div>
    </div>
    <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
      <i data-lucide="utensils" class="w-6 h-6 text-yellow-400"></i>
    </div>
  </div>
</div>

<!-- Active Menus -->
<div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
  <div class="flex items-center justify-between">
    <div>
      <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Active Menus</h3>
      <p class="text-3xl font-bold text-gray-800 mt-2">{{ $activemenu }}</p>
      <div class="flex items-center mt-3">
        <span class="text-sm font-medium text-gray-500">Currently Available</span>
      </div>
    </div>
    <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
      <i data-lucide="check-circle" class="w-6 h-6 text-yellow-400"></i>
    </div>
  </div>
</div>

<!-- Unavailable Menus -->
<div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
  <div class="flex items-center justify-between">
    <div>
      <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Unavailable</h3>
      <p class="text-3xl font-bold text-gray-800 mt-2">{{ $inactivemenu }}</p>
      <div class="flex items-center mt-3">
        <span class="text-sm font-medium text-gray-500">Out of Stock</span>
      </div>
    </div>
    <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
      <i data-lucide="x-circle" class="w-6 h-6 text-yellow-400"></i>
    </div>
  </div>
</div>
   
  </div>


@if(session('success'))
<div class="alert alert-success mb-4 flex justify-between items-center mt-5">
  <div class="flex items-center gap-2">
    <svg xmlns="http://www.w3.org/2000/svg" 
         class="stroke-current shrink-0 h-6 w-6" 
         fill="none" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
            d="M5 13l4 4L19 7" />
    </svg>
    <span>{{ session('success') }}</span>
  </div>
  <button onclick="this.closest('.alert').remove()" class="btn btn-xs btn-ghost">✕</button>
</div>
@endif

@if(session('error'))
<div class="alert alert-error mb-4 flex justify-between items-center mt-5">
  <div class="flex items-center gap-2">
    <svg xmlns="http://www.w3.org/2000/svg" 
         class="stroke-current shrink-0 h-6 w-6" 
         fill="none" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
            d="M6 18L18 6M6 6l12 12" />
    </svg>
    <span>{{ session('error') }}</span>
  </div>
  <button onclick="this.closest('.alert').remove()" class="btn btn-xs btn-ghost">✕</button>
</div>
@endif

  <!-- Header with Add Button -->
  <div class="flex items-center justify-between mt-8 mb-4">
    <h2 class="text-lg font-semibold text-gray-800">Restaurant Menus</h2>
    <button onclick="document.getElementById('addMenuModal').showModal()" 
            class="btn btn-primary">
      <i data-lucide="plus" class="w-5 h-5"></i> Add Menu
    </button>
  </div>

  <!-- Table -->
 <div class="overflow-x-auto rounded-xl border border-gray-100 shadow-lg">
  <table class="table w-full">
    <thead class="bg-blue-900 text-white">
      <tr>
        <th>Menu ID</th>
        <th>Photo</th>
        <th>Menu Name</th>
        <th>Description</th>
        <th>Price</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($menus as $menu)
        <tr class="hover:bg-gray-50 transition">
          <!-- Menu ID -->
          <td class="font-medium">{{ $menu->menuID }}</td>
          
          <!-- Menu Photo -->
          <td>
            <div class="h-12 w-12 rounded-lg overflow-hidden bg-gray-100">
              <img src="{{ asset($menu->menu_photo) }}" alt="{{ $menu->menu_name }}" class="h-full w-full object-cover">
            </div>
          </td>
          
          <!-- Menu Name -->
          <td class="font-semibold text-gray-800">{{ $menu->menu_name }}</td>
          
          <!-- Menu Description -->
          <td class="text-sm text-gray-600 max-w-xs truncate">{{ $menu->menu_description }}</td>
          
          <!-- Price -->
          <td class="font-medium text-gray-900">₱{{ number_format($menu->menu_price, 2) }}</td>
          
          <!-- Status -->
          <td>
            <span class="px-2 py-1 rounded-full text-white text-xs 
              {{ $menu->menu_status == 'Available' ? 'bg-green-500' : 'bg-red-500' }}">
              {{ $menu->menu_status }}
            </span>
          </td>
          
          <!-- Actions -->
          <td class="flex gap-2">
            <!-- Edit -->
            <button onclick="document.getElementById('editMenuModal-{{$menu->menuID}}').showModal()" 
                    class="p-2 rounded-lg bg-blue-100 hover:bg-blue-200 text-blue-600 transition">
              <i data-lucide="edit" class="w-4 h-4"></i>
            </button>
            
            <!-- Delete -->
         <!-- Delete Button (triggers modal) -->
<button type="button" 
        onclick="document.getElementById('deleteMenuModal-{{ $menu->menuID }}').showModal()" 
        class="p-2 rounded-lg bg-red-100 hover:bg-red-200 text-red-600 transition">
  <i data-lucide="trash-2" class="w-4 h-4"></i>
</button>

<!-- Delete Confirmation Modal -->


          </td>
        </tr>
    @empty
  <tr>
    <td colspan="7">
      <div class="flex flex-col items-center justify-center py-12 text-center">
        <!-- Icon -->
        <div class="w-16 h-16 rounded-full bg-blue-50 flex items-center justify-center mb-4">
          <i data-lucide="utensils" class="w-8 h-8 text-blue-600"></i>
        </div>
        <!-- Message -->
        <h3 class="text-lg font-semibold text-gray-700">No menu items yet</h3>
        <p class="text-sm text-gray-500 mt-1">Start by adding your first menu item to showcase your restaurant’s offerings.</p>
        <!-- CTA Button -->
        <button onclick="document.getElementById('addMenuModal').showModal()" 
                class="mt-4 px-4 py-2 bg-blue-900 text-white rounded-lg hover:bg-blue-700 flex items-center gap-2 transition">
          <i data-lucide="plus" class="w-4 h-4"></i> Add Menu
        </button>
      </div>
    </td>
  </tr>
      @endforelse
    </tbody>
  </table>
</div>

<div class="mt-4">
  {{ $menus->links('pagination::tailwind') }}
</div>





</section>

<!-- Initialize Lucide -->
<script>
  lucide.createIcons();
</script>


    {{-- modals --}}

    @include('admin.components.resto.create')

    @foreach ($menus as $menu)
        @include('admin.components.resto.edit')
        @include('admin.components.resto.delete')
    @endforeach
    


    </div>


 


        


           
      
 
        </main>
      </div>
    </div>

   
    {{-- modals --}}


    
   
   @livewireScripts
  @include('javascriptfix.soliera_js')
  </body>
@endauth


  
</html>