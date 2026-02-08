<nav class="navbar fixed bg-transparent top-0 z-50 h-24" id="mainNav">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between w-full">
            
            <!-- Left Navigation - Desktop -->
            <div class="hidden lg:flex flex-1 justify-start">
                <ul class="menu menu-horizontal gap-1">
                    <li><a href="#about" class="text-white hover:bg-[#F7B32B] hover:text-white font-semibold py-2 px-4 text-[0.95rem] rounded-lg transition-all duration-300 hover:shadow-lg hover:shadow-[#F7B32B]/20">About</a></li>
                    <li><a href="#rooms" class="text-white hover:bg-[#F7B32B] hover:text-white font-semibold py-2 px-4 text-[0.95rem] rounded-lg transition-all duration-300 hover:shadow-lg hover:shadow-[#F7B32B]/20">Rooms</a></li>
                    <li><a href="#restaurant" class="text-white hover:bg-[#F7B32B] hover:text-white font-semibold py-2 px-4 text-[0.95rem] rounded-lg transition-all duration-300 hover:shadow-lg hover:shadow-[#F7B32B]/20">Restaurant</a></li>
                    <li><a href="#promos-events" class="text-white hover:bg-[#F7B32B] hover:text-white font-semibold py-2 px-4 text-[0.95rem] rounded-lg transition-all duration-300 hover:shadow-lg hover:shadow-[#F7B32B]/20">Promos</a></li>
                </ul>
            </div>

            <!-- Mobile Menu Button - Left -->
            <div class="lg:hidden">
                <label for="mobile-drawer" class="btn btn-ghost text-white px-3 drawer-button hover:bg-[#F7B32B]/20">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </label>
            </div>

            <!-- Center Logo with Premium Emphasis -->
            <div class="flex-shrink-0 mx-4 top-10 relative lg:mx-8">
                <div class="relative group">
                    <!-- Glow effect -->
                    <div class="absolute -inset-2 bg-gradient-to-r from-[#F7B32B]/30 via-[#F7B32B]/50 to-[#F7B32B]/30 rounded-full blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    
                    <!-- Logo container with premium border -->
                    <div class="relative bg-white/10 backdrop-blur-sm rounded-full p-1 border-2 border-[#F7B32B]/40 shadow-2xl group-hover:border-[#F7B32B] transition-all duration-300">
                        <div class="bg-white rounded-full">
                            <img class="h-16 w-16 lg:h-20 lg:w-20 object-contain transform group-hover:scale-105 transition-transform duration-300" 
                                 src="{{asset('images/logo/sonly.png')}}" 
                                 alt="Hotel Premium Logo" />
                        </div>
                    </div>
                    
                    <!-- Decorative elements -->
                   
                </div>
            </div>

            <!-- Right Navigation - Desktop -->
            <div class="hidden lg:flex flex-1 justify-end">
                <ul class="menu menu-horizontal gap-1 mr-4">
                    <li><a href="#ameneties" class="text-white hover:bg-[#F7B32B] hover:text-white font-semibold py-2 px-4 text-[0.95rem] rounded-lg transition-all duration-300 hover:shadow-lg hover:shadow-[#F7B32B]/20">Amenities</a></li>
                    <li><a href="#reviews" class="text-white hover:bg-[#F7B32B] hover:text-white font-semibold py-2 px-4 text-[0.95rem] rounded-lg transition-all duration-300 hover:shadow-lg hover:shadow-[#F7B32B]/20">Reviews</a></li>
                    <li><a href="#contact" class="text-white hover:bg-[#F7B32B] hover:text-white font-semibold py-2 px-4 text-[0.95rem] rounded-lg transition-all duration-300 hover:shadow-lg hover:shadow-[#F7B32B]/20">Contact</a></li>
                </ul>
                
                <!-- Sign In Button - Desktop -->
                <a href="/loginguest" class="relative inline-flex items-center justify-center px-6 py-2.5 overflow-hidden font-semibold text-[#F7B32B] transition duration-300 ease-out border-2 border-[#F7B32B] rounded-lg shadow-lg shadow-[#F7B32B]/20 group hover:shadow-xl hover:shadow-[#F7B32B]/30">
                    <span class="absolute inset-0 flex items-center justify-center w-full h-full text-white duration-300 -translate-x-full bg-gradient-to-r from-[#F7B32B] to-[#E5A01F] group-hover:translate-x-0 ease">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                    </span>
                    <span class="absolute flex items-center justify-center w-full h-full text-[#F7B32B] transition-all duration-300 transform group-hover:translate-x-full ease font-semibold">Sign In</span>
                    <span class="relative invisible font-semibold">Sign In</span>
                </a>
            </div>

            <!-- Sign In Button - Mobile -->
            <div class="lg:hidden">
                <a href="/loginguest" class="relative inline-flex items-center justify-center px-4 py-2 overflow-hidden font-medium text-[#F7B32B] transition duration-300 ease-out border-2 border-[#F7B32B] rounded-lg shadow-md shadow-[#F7B32B]/20 group hover:shadow-lg hover:shadow-[#F7B32B]/30">
                    <span class="absolute inset-0 flex items-center justify-center w-full h-full text-white duration-300 -translate-x-full bg-gradient-to-r from-[#F7B32B] to-[#E5A01F] group-hover:translate-x-0 ease">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                    </span>
                    <span class="absolute flex items-center justify-center w-full h-full text-[#F7B32B] transition-all duration-300 transform group-hover:translate-x-full ease text-sm font-semibold">Sign In</span>
                    <span class="relative invisible text-sm font-semibold">Sign In</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Mobile Drawer Menu - Enhanced -->
    <input type="checkbox" id="mobile-drawer" class="drawer-toggle" />
    <div class="drawer-side z-40">
        <label for="mobile-drawer" class="drawer-overlay"></label>
        <div class="menu p-6 w-80 min-h-full bg-[#001f54] backdrop-blur-xl text-base-content shadow-2xl border-l border-[#F7B32B]/20">
            
            <!-- Close button with premium styling -->
            <div class="flex justify-between items-center mb-8">
                <div class="text-[#F7B32B] font-bold text-lg">Menu</div>
                <label for="mobile-drawer" class="btn btn-ghost btn-circle hover:bg-[#F7B32B]/20 hover:text-[#F7B32B]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </label>
            </div>

            <!-- Logo in mobile menu -->
            <div class="flex justify-center mb-8">
                <div class="relative">
                    <div class="bg-white/10 backdrop-blur-sm rounded-full p-1 border-2 border-[#F7B32B]/40 shadow-xl">
                        <div class="bg-white rounded-full p-2">
                            <img class="h-16 w-16 object-contain" 
                                 src="{{asset('images/logo/sonly.png')}}" 
                                 alt="Hotel Logo" />
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Menu items with premium styling -->
            <ul class="space-y-2 px-2">
                <li>
                    <a href="#about" class="flex items-center py-3 px-4 text-base font-semibold text-white hover:bg-gradient-to-r hover:from-[#F7B32B] hover:to-[#E5A01F] hover:text-white rounded-lg transition-all duration-300 hover:shadow-lg hover:shadow-[#F7B32B]/30 hover:translate-x-1">
                        <svg class="w-5 h-5 mr-3 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        About
                    </a>
                </li>
                <li>
                    <a href="#rooms" class="flex items-center py-3 px-4 text-base font-semibold text-white hover:bg-gradient-to-r hover:from-[#F7B32B] hover:to-[#E5A01F] hover:text-white rounded-lg transition-all duration-300 hover:shadow-lg hover:shadow-[#F7B32B]/30 hover:translate-x-1">
                        <svg class="w-5 h-5 mr-3 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        Rooms
                    </a>
                </li>
                <li>
                    <a href="#restaurant" class="flex items-center py-3 px-4 text-base font-semibold text-white hover:bg-gradient-to-r hover:from-[#F7B32B] hover:to-[#E5A01F] hover:text-white rounded-lg transition-all duration-300 hover:shadow-lg hover:shadow-[#F7B32B]/30 hover:translate-x-1">
                        <svg class="w-5 h-5 mr-3 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Restaurant
                    </a>
                </li>
                <li>
                    <a href="#promos-events" class="flex items-center py-3 px-4 text-base font-semibold text-white hover:bg-gradient-to-r hover:from-[#F7B32B] hover:to-[#E5A01F] hover:text-white rounded-lg transition-all duration-300 hover:shadow-lg hover:shadow-[#F7B32B]/30 hover:translate-x-1">
                        <svg class="w-5 h-5 mr-3 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Promos
                    </a>
                </li>
                <li>
                    <a href="#ameneties" class="flex items-center py-3 px-4 text-base font-semibold text-white hover:bg-gradient-to-r hover:from-[#F7B32B] hover:to-[#E5A01F] hover:text-white rounded-lg transition-all duration-300 hover:shadow-lg hover:shadow-[#F7B32B]/30 hover:translate-x-1">
                        <svg class="w-5 h-5 mr-3 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                        </svg>
                        Amenities
                    </a>
                </li>
                <li>
                    <a href="#reviews" class="flex items-center py-3 px-4 text-base font-semibold text-white hover:bg-gradient-to-r hover:from-[#F7B32B] hover:to-[#E5A01F] hover:text-white rounded-lg transition-all duration-300 hover:shadow-lg hover:shadow-[#F7B32B]/30 hover:translate-x-1">
                        <svg class="w-5 h-5 mr-3 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                        </svg>
                        Reviews
                    </a>
                </li>
                <li>
                    <a href="#contact" class="flex items-center py-3 px-4 text-base font-semibold text-white hover:bg-gradient-to-r hover:from-[#F7B32B] hover:to-[#E5A01F] hover:text-white rounded-lg transition-all duration-300 hover:shadow-lg hover:shadow-[#F7B32B]/30 hover:translate-x-1">
                        <svg class="w-5 h-5 mr-3 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        Contact
                    </a>
                </li>

                <!-- Divider -->
                <div class="divider my-6">
                    <div class="h-px bg-gradient-to-r from-transparent via-[#F7B32B]/30 to-transparent"></div>
                </div>

                <!-- Mobile Sign In Button (in drawer) -->
                <li>
                    <a href="/loginguest" class="relative inline-flex items-center justify-center w-full px-6 py-3 overflow-hidden font-semibold text-white bg-gradient-to-r from-[#F7B32B] to-[#E5A01F] rounded-lg shadow-lg shadow-[#F7B32B]/30 hover:shadow-xl hover:shadow-[#F7B32B]/50 transition-all duration-300 hover:scale-105 group">
                        <svg class="w-5 h-5 mr-2 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                        Sign In to Your Account
                    </a>
                </li>
            </ul>

            <!-- Premium footer in mobile menu -->
            <div class="mt-auto pt-8 text-center">
                <div class="text-white/40 text-xs font-medium">Premium Hotel Experience</div>
                <div class="flex justify-center gap-2 mt-3">
                    <div class="w-2 h-2 bg-[#F7B32B] rounded-full animate-pulse"></div>
                    <div class="w-2 h-2 bg-[#F7B32B] rounded-full animate-pulse delay-75"></div>
                    <div class="w-2 h-2 bg-[#F7B32B] rounded-full animate-pulse delay-150"></div>
                </div>
            </div>
        </div>
    </div>
</nav>

<style>
/* Premium navbar backdrop blur effect */
#mainNav {
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    background: linear-gradient(to bottom, rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.2));
}

/* Smooth scroll behavior */
html {
    scroll-behavior: smooth;
}

/* Animation delays */
.delay-75 {
    animation-delay: 75ms;
}

.delay-150 {
    animation-delay: 150ms;
}

/* Custom pulse animation for decorative dots */
@keyframes pulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: 0.5;
    }
}

/* Ensure navbar stays on top */
#mainNav {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
}

/* Mobile optimization */
@media (max-width: 1023px) {
    #mainNav {
        height: 80px;
    }
}

/* Tablet and desktop */
@media (min-width: 1024px) {
    #mainNav {
        height: 96px;
    }
}

/* Drawer overlay enhancement */
.drawer-overlay {
    background-color: rgba(0, 0, 0, 0.7);
    backdrop-filter: blur(4px);
}
</style>