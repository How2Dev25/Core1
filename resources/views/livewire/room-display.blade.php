<div class="relative">
<div class="min-h-screen">
  
  <!-- Loading Overlay -->

    <!-- Header Section -->
    <div class="bg-blue-900 rounded-md shadow-lg text-white py-12 mb-8">
        <div class="container mx-auto px-4">
            <div class="text-center">
                <h1 class="text-4xl text-yellow-400 md:text-5xl font-bold mb-4">
                    Find Your Perfect Room
                </h1>
                <p class="text-lg md:text-xl opacity-90 max-w-2xl mx-auto">
                    Discover luxury accommodations tailored to your needs. From cozy standards to premium suites.
                </p>
                
                <!-- Quick Stats -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8 max-w-4xl mx-auto">
    <div class="border-yellow-400 border-2 rounded-2xl p-6 text-center">
        <div class="text-3xl font-bold counter count-up" data-target="{{ $stats['total_available'] }}">{{ $stats['total_available'] }}</div>
        <div class="text-sm opacity-80">Available Rooms</div>
    </div>
    <div class="border-yellow-400 border-2 rounded-2xl p-6 text-center">
        <div class="text-3xl font-bold counter count-up" data-target="{{ $stats['price_range']['min'] }}">{{ $stats['price_range']['min'] }}</div>
        <div class="text-lg opacity-80 font-bold">Starting Price </div>
    </div>
    <div class="border-yellow-400 border-2 rounded-2xl p-6 text-center">
        <div class="text-3xl font-bold counter count-up" data-target="{{ $stats['categories']->count() }}">{{ $stats['categories']->count() }}</div>
        <div class="text-sm opacity-80">Room Categories</div>
    </div>
</div>

            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 pb-12">
        <!-- Suggested Rooms Section -->
          <div class="container mx-auto px-4 pb-12">
        <!-- Suggested Rooms Section -->
        <div class="mb-8">
            <div class="flex items-center justify-between mb-6 gap-2 max-md:flex-col">
                <h2 class="text-2xl font-bold text-gray-800">Suggested For You</h2>
                <button wire:click="$toggle('showSuggested')" 
                        class="btn btn-primary">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    {{ $showSuggested ? 'Hide Suggestions' : 'Show Suggestions' }}
                </button>
            </div>

          @if($showSuggested)
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    @foreach($suggestedRooms as $index => $room)
    <div 
        class="rounded-2xl p-6 bg-white shadow-lg opacity-0 translate-y-5 transition-all duration-700 ease-out"
        style="animation: fadeUp 0.5s ease-out forwards; animation-delay: {{ $index * 0.2 }}s"
    >
        <div class="flex items-center mb-4">
            <div class="w-16 h-16 rounded-xl overflow-hidden flex items-center justify-center">
                <img src="{{ asset($room->roomphoto) }}" 
                     alt="Room {{ $room->roomID }}" 
                     class="w-full h-full object-cover">
            </div>
            <div class="ml-4">
                <h3 class="font-bold text-gray-800">Room #{{ $room->roomID }}</h3>
                <p class="text-sm text-gray-600">{{ $room->roomtype }} Room</p>
            </div>
        </div>
        <p class="text-sm text-gray-700 mb-3">{{ Str::limit($room->roomfeatures, 80) }}</p>
        <div class="flex items-center justify-between">
            <span class="text-lg font-bold text-indigo-600">₱{{ number_format($room->roomprice) }}/night</span>
            <a href="/roomdetails/{{ $room->roomID }}" 
               class="btn btn-primary btn-sm">
                Book Now
            </a>
        </div>
    </div>
    @endforeach
</div>
@endif
        </div>

        <!-- Enhanced Filters Section -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6 mb-8">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 mb-6">
                <h3 class="text-2xl font-bold text-gray-800">Find Rooms</h3>
                
                <!-- Active filters display -->
                <div class="flex flex-wrap gap-2">
                    @if($category)
                        <span class="filter-badge">
                            Category: {{ $category }}
                            <button wire:click="$set('category', '')" class="ml-2 text-blue-600 hover:text-blue-800">×</button>
                        </span>
                    @endif
                    @if($priceRange)
                        <span class="filter-badge">
                            Price: {{ ucfirst(str_replace('-', ' - ₱', $priceRange)) }}
                            <button wire:click="$set('priceRange', '')" class="ml-2 text-blue-600 hover:text-blue-800">×</button>
                        </span>
                    @endif
                    @if($maxGuests)
                        <span class="filter-badge">
                            Guests: {{ $maxGuests }}+
                            <button wire:click="$set('maxGuests', '')" class="ml-2 text-blue-600 hover:text-blue-800">×</button>
                        </span>
                    @endif
                    @if($category || $priceRange || $maxGuests || $search)
                        <button wire:click="clearFilters" 
                                class="text-red-600 hover:text-red-800 text-sm underline">
                            Clear All
                        </button>
                    @endif
                </div>
            </div>

            <!-- Filter Controls -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                <!-- Search -->
                <div class="lg:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Search Rooms</label>
                    <div class="relative">
                        <input type="text" 
                               wire:model.debounce.500ms="search" 
                               placeholder="Room number, features, type..." 
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <svg class="absolute right-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" 
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                </div>

                <!-- Category -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                    <select wire:model="category" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">All Categories</option>
                        <option value="Standard">Standard</option>
                        <option value="Deluxe">Deluxe</option>
                        <option value="Suite">Suite</option>
                        <option value="Executive">Executive</option>
                    </select>
                </div>

                <!-- Price Range -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Price Range</label>
                    <select wire:model="priceRange" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Any Price</option>
                        <option value="under-2000">Under ₱2,000</option>
                        <option value="2000-5000">₱2,000 - ₱5,000</option>
                        <option value="5000-10000">₱5,000 - ₱10,000</option>
                        <option value="over-10000">Over ₱10,000</option>
                    </select>
                </div>

                <!-- Max Guests -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Min Guests</label>
                    <select wire:model="maxGuests" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Any Size</option>
                        <option value="1">1+ Guest</option>
                        <option value="2">2+ Guests</option>
                        <option value="4">4+ Guests</option>
                        <option value="6">6+ Guests</option>
                    </select>
                </div>
            </div>

            <!-- Sort Options -->
            <div class="flex flex-wrap gap-3 mt-6 pt-4 border-t border-gray-200">
                <span class="text-sm font-medium text-gray-700">Sort by:</span>
                <button wire:click="toggleSort('roomID')" 
                        class="text-sm px-3 py-1 rounded-lg transition-colors {{ $sortBy === 'roomID' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    Room ID {{ $sortBy === 'roomID' ? ($sortDirection === 'asc' ? '↑' : '↓') : '' }}
                </button>
                <button wire:click="toggleSort('roomprice')" 
                        class="text-sm px-3 py-1 rounded-lg transition-colors {{ $sortBy === 'roomprice' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    Price {{ $sortBy === 'roomprice' ? ($sortDirection === 'asc' ? '↑' : '↓') : '' }}
                </button>
                <button wire:click="toggleSort('roommaxguest')" 
                        class="text-sm px-3 py-1 rounded-lg transition-colors {{ $sortBy === 'roommaxguest' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    Capacity {{ $sortBy === 'roommaxguest' ? ($sortDirection === 'asc' ? '↑' : '↓') : '' }}
                </button>
            </div>
        </div>

        <!-- Results Summary -->
        <div class="flex items-center justify-between mb-6">
            <p class="text-gray-600">
                Showing {{ $rooms->firstItem() ?? 0 }} - {{ $rooms->lastItem() ?? 0 }} of {{ $rooms->total() }} rooms
            </p>
            <div class="flex items-center gap-2">
                <span class="text-sm text-gray-500">View:</span>
                <button class="p-2 bg-blue-100 text-blue-600 rounded-lg">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Room Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($rooms as $room)
                <a href="/roomdetails/{{ $room->roomID }}" 
                   class="room-card block bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden transition-all duration-300 hover:border-blue-300">
                    
                    <!-- Room Image -->
                    <div class="relative h-56 overflow-hidden">
                        <img src="{{ asset($room->roomphoto) }}" 
                             alt="Room {{ $room->roomID }}" 
                             class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
                        
                        <!-- Badges -->
                        <div class="absolute top-4 right-4 space-y-2">
                            <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold
                                @if($room->roomtype == 'Standard') bg-blue-100 text-blue-800
                                @elseif($room->roomtype == 'Deluxe') bg-purple-100 text-purple-800
                                @elseif($room->roomtype == 'Suite') bg-green-100 text-green-800
                                @elseif($room->roomtype == 'Executive') bg-yellow-100 text-yellow-800
                                @endif">
                                {{ $room->roomtype }}
                            </span>
                        </div>

                        <!-- Price Overlay -->
                        <div class="absolute bottom-4 left-4">
                            <div class="bg-white/90 backdrop-blur-sm rounded-xl px-3 py-2">
                                <p class="text-xs text-gray-500 mb-1">From</p>
                                <p class="text-lg font-bold text-gray-900">₱{{ number_format($room->roomprice) }}</p>
                                <p class="text-xs text-gray-500">per night</p>
                            </div>
                        </div>
                    </div>

                    <!-- Card Content -->
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-3">
                            <h3 class="text-xl font-bold text-gray-900">Room #{{ $room->roomID }}</h3>
                            <div class="flex items-center text-yellow-400">
                                @for($i = 0; $i < 5; $i++)
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                        <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                    </svg>
                                @endfor
                                <span class="ml-2 text-sm text-gray-600">(4.8)</span>
                            </div>
                        </div>
                        
                        <!-- Room Details -->
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div class="flex items-center text-gray-600">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3"/>
                                </svg>
                                <span class="text-sm">{{ $room->roomsize ?? '-' }} sqft</span>
                            </div>
                            <div class="flex items-center text-gray-600">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1z"/>
                                </svg>
                                <span class="text-sm">{{ $room->roommaxguest }} Guests</span>
                            </div>
                        </div>

                        <!-- Features -->
                        <p class="text-sm text-gray-600 line-clamp-2 mb-4">
                            {{ $room->roomfeatures }}
                        </p>

                        <!-- Action Button -->
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-gray-500">
                                Available Now
                            </div>
                            <div class="btn btn-primary">
                                Book Now
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-full">
                    <div class="text-center py-16 px-4">
                        <div class="w-32 h-32 mx-auto mb-6 bg-gray-100 rounded-full flex items-center justify-center">
                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                      d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">No Rooms Found</h3>
                        <p class="text-gray-600 mb-6 max-w-md mx-auto">
                            We couldn't find any rooms matching your criteria. Try adjusting your filters or search terms.
                        </p>
                        <button wire:click="clearFilters" 
                                class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                            Clear All Filters
                        </button>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($rooms->hasPages())
            <div class="mt-12 flex justify-center">
                <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-2">
                    {{ $rooms->links() }}
                </div>
            </div>
        @endif
    </div>
</div>
</div>
