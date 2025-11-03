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
                            <div class="text-3xl font-bold counter count-up"
                                data-target="{{ $stats['total_available'] }}">{{ $stats['total_available'] }}</div>
                            <div class="text-sm opacity-80">Available Rooms</div>
                        </div>
                        <div class="border-yellow-400 border-2 rounded-2xl p-6 text-center">
                            <div class="text-3xl font-bold counter count-up"
                                data-target="{{ $stats['price_range']['min'] }}">{{ $stats['price_range']['min'] }}
                            </div>
                            <div class="text-lg opacity-80 font-bold">Starting Price </div>
                        </div>
                        <div class="border-yellow-400 border-2 rounded-2xl p-6 text-center">
                            <div class="text-3xl font-bold counter count-up"
                                data-target="{{ $stats['categories']->count() }}">{{ $stats['categories']->count() }}
                            </div>
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
                        <button wire:click="$toggle('showSuggested')" class="btn btn-primary">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            {{ $showSuggested ? 'Hide Suggestions' : 'Show Suggestions' }}
                        </button>
                    </div>

                    @if($showSuggested)
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                            @foreach($suggestedRooms as $index => $room)
                                <div class="group rounded-2xl p-6 bg-gradient-to-br from-white to-gray-50 shadow-lg hover:shadow-2xl opacity-0 translate-y-5 transition-all duration-500 ease-out hover:-translate-y-2 border border-gray-100"
                                    style="animation: fadeUp 0.5s ease-out forwards; animation-delay: {{ $index * 0.2 }}s">
                                    <!-- Room Header with Image -->
                                    <div class="flex items-center mb-5">
                                        <div
                                            class="relative w-20 h-20 rounded-2xl overflow-hidden flex-shrink-0 shadow-md ring-2 ring-gray-100 group-hover:ring-indigo-200 transition-all duration-300">
                                            <img src="{{ asset($room->roomphoto) }}" alt="Room {{ $room->roomID }}"
                                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                            <!-- Overlay gradient on hover -->
                                            <div
                                                class="absolute inset-0 bg-gradient-to-t from-indigo-600/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                            </div>
                                        </div>
                                        <div class="ml-4 flex-1">
                                            <div class="flex items-center gap-2">
                                                <h3 class="font-bold text-gray-900 text-lg">Room #{{ $room->roomID }}</h3>
                                                <span
                                                    class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-700">
                                                    Available
                                                </span>
                                            </div>
                                            <p class="text-sm text-gray-600 font-medium mt-0.5">{{ $room->roomtype }} Room</p>
                                        </div>
                                    </div>

                                    <!-- Room Features -->
                                    <div class="mb-5">
                                        <p class="text-sm text-gray-700 leading-relaxed line-clamp-2">
                                            {{ Str::limit($room->roomfeatures, 80) }}
                                        </p>
                                    </div>

                                    <!-- Price and Action -->
                                    <div class="pt-4 border-t border-gray-100">
                                        <div class="flex items-center justify-between mb-3">
                                            <div>
                                                <div class="text-xs text-gray-500 mb-0.5">Starting from</div>
                                                <span
                                                    class="text-xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                                                    ₱{{ number_format($room->roomprice) }}
                                                </span>
                                                <span class="text-sm text-gray-500">/night</span>
                                            </div>
                                            <div
                                                class="flex items-center gap-1.5 bg-amber-50 px-3 py-1.5 rounded-full border border-amber-200">
                                                <svg class="w-4 h-4 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                                <span
                                                    class="text-sm font-bold text-amber-700">{{ $room->loyalty_value ?? 0 }}</span>
                                                <span class="text-xs text-amber-600">pts</span>
                                            </div>
                                        </div>
                                        <a href="/roomdetails/{{ $room->roomID }}"
                                            class="w-full inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-sm font-semibold rounded-xl shadow-md hover:shadow-xl hover:from-indigo-700 hover:to-purple-700 transition-all duration-300 hover:scale-105 active:scale-95">
                                            Book Now
                                            <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <style>
                            @keyframes fadeUp {
                                from {
                                    opacity: 0;
                                    transform: translateY(20px);
                                }

                                to {
                                    opacity: 1;
                                    transform: translateY(0);
                                }
                            }

                            .line-clamp-2 {
                                display: -webkit-box;
                                -webkit-line-clamp: 2;
                                -webkit-box-orient: vertical;
                                overflow: hidden;
                            }
                        </style>
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
                                    <button wire:click="$set('category', '')"
                                        class="ml-2 text-blue-600 hover:text-blue-800">×</button>
                                </span>
                            @endif
                            @if($priceRange)
                                <span class="filter-badge">
                                    Price: {{ ucfirst(str_replace('-', ' - ₱', $priceRange)) }}
                                    <button wire:click="$set('priceRange', '')"
                                        class="ml-2 text-blue-600 hover:text-blue-800">×</button>
                                </span>
                            @endif
                            @if($maxGuests)
                                <span class="filter-badge">
                                    Guests: {{ $maxGuests }}+
                                    <button wire:click="$set('maxGuests', '')"
                                        class="ml-2 text-blue-600 hover:text-blue-800">×</button>
                                </span>
                            @endif
                            @if($category || $priceRange || $maxGuests || $search)
                                <button wire:click="clearFilters" class="text-red-600 hover:text-red-800 text-sm underline">
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
                                <input type="text" wire:model.debounce.500ms="search"
                                    placeholder="Room number, features, type..."
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <svg class="absolute right-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
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
                        Showing {{ $rooms->firstItem() ?? 0 }} - {{ $rooms->lastItem() ?? 0 }} of {{ $rooms->total() }}
                        rooms
                    </p>
                    <div class="flex items-center gap-2">
                        <span class="text-sm text-gray-500">View:</span>
                        <button class="p-2 bg-blue-100 text-blue-600 rounded-lg">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Room Cards Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse($rooms as $room)
                        <a href="/roomdetails/{{ $room->roomID }}"
                            class="group room-card block bg-white rounded-2xl shadow-lg hover:shadow-2xl border border-gray-200 hover:border-indigo-300 overflow-hidden transition-all duration-500 hover:-translate-y-2">

                            <!-- Room Image -->
                            <div class="relative h-56 overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200">
                                <img src="{{ asset($room->roomphoto) }}" alt="Room {{ $room->roomID }}"
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">

                                <!-- Gradient overlay on hover -->
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                </div>

                                <!-- Badges -->
                                <div class="absolute top-4 right-4 space-y-2">
                                    <span class="inline-block px-3 py-1.5 rounded-full text-xs font-bold shadow-lg backdrop-blur-sm
                            @if($room->roomtype == 'Standard') bg-blue-100/90 text-blue-800 ring-2 ring-blue-200
                            @elseif($room->roomtype == 'Deluxe') bg-purple-100/90 text-purple-800 ring-2 ring-purple-200
                            @elseif($room->roomtype == 'Suite') bg-green-100/90 text-green-800 ring-2 ring-green-200
                            @elseif($room->roomtype == 'Executive') bg-yellow-100/90 text-yellow-800 ring-2 ring-yellow-200
                            @endif">
                                        {{ $room->roomtype }}
                                    </span>
                                </div>

                                <!-- Price Overlay -->
                                <div class="absolute bottom-4 left-4">
                                    <div class="bg-white/95 backdrop-blur-md rounded-xl px-4 py-2.5 shadow-lg">
                                        <p class="text-xs text-gray-500 font-medium mb-0.5">From</p>
                                        <p class="text-xl font-bold text-gray-900">₱{{ number_format($room->roomprice) }}
                                        </p>
                                        <p class="text-xs text-gray-500">per night</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Card Content -->
                            <div class="p-6">
                                <div class="flex items-start justify-between mb-4">
                                    <h3 class="text-xl font-bold text-gray-900">Room #{{ $room->roomID }}</h3>
                                    <div class="flex items-center text-yellow-400">
                                        @for($i = 0; $i < 5; $i++)
                                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                                <path
                                                    d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                            </svg>
                                        @endfor
                                        <span class="ml-2 text-sm font-semibold text-gray-600">(4.8)</span>
                                    </div>
                                </div>

                                <!-- Room Details -->
                                <div class="grid grid-cols-2 gap-4 mb-4">
                                    <div class="flex items-center text-gray-600">
                                        <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3" />
                                        </svg>
                                        <span class="text-sm font-medium">{{ $room->roomsize ?? '-' }} sqft</span>
                                    </div>
                                    <div class="flex items-center text-gray-600">
                                        <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1z" />
                                        </svg>
                                        <span class="text-sm font-medium">{{ $room->roommaxguest }} Guests</span>
                                    </div>
                                </div>

                                <!-- Features -->
                                <p class="text-sm text-gray-600 leading-relaxed line-clamp-2 mb-4">
                                    {{ $room->roomfeatures }}
                                </p>

                                <!-- Loyalty Points Badge -->
                                <div class="mb-4 pb-4 border-b border-gray-100">
                                    <div
                                        class="inline-flex items-center gap-1.5 bg-amber-50 px-3 py-1.5 rounded-full border border-amber-200">
                                        <svg class="w-4 h-4 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <span class="text-xs text-amber-600">Earn</span>
                                        <span
                                            class="text-sm font-bold text-amber-700">{{ $room->loyalty_value ?? 0 }}</span>
                                        <span class="text-xs text-amber-600">points</span>
                                    </div>
                                </div>

                                <!-- Action Button -->
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <div class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></div>
                                        <span class="text-sm font-medium text-green-600">Available Now</span>
                                    </div>
                                    <div
                                        class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-sm font-semibold rounded-lg shadow-md group-hover:shadow-xl group-hover:from-indigo-700 group-hover:to-purple-700 transition-all duration-300">
                                        Book Now
                                        <svg class="w-4 h-4 ml-2 transition-transform group-hover:translate-x-1" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="col-span-full">
                            <div class="text-center py-16 px-4">
                                <div
                                    class="w-32 h-32 mx-auto mb-6 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center shadow-inner">
                                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                </div>
                                <h3 class="text-2xl font-bold text-gray-900 mb-3">No Rooms Found</h3>
                                <p class="text-gray-600 mb-8 max-w-md mx-auto leading-relaxed">
                                    We couldn't find any rooms matching your criteria. Try adjusting your filters or search
                                    terms.
                                </p>
                                <button wire:click="clearFilters"
                                    class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl hover:from-indigo-700 hover:to-purple-700 transition-all duration-300 hover:scale-105 active:scale-95">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
                                    Clear All Filters
                                </button>
                            </div>
                        </div>
                    @endforelse
                </div>

                <style>
                    .line-clamp-2 {
                        display: -webkit-box;
                        -webkit-line-clamp: 2;
                        -webkit-box-orient: vertical;
                        overflow: hidden;
                    }

                    @keyframes pulse {

                        0%,
                        100% {
                            opacity: 1;
                        }

                        50% {
                            opacity: 0.5;
                        }
                    }

                    .animate-pulse {
                        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
                    }
                </style>

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