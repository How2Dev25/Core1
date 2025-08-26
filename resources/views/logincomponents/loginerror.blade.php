@if(session('loginError'))
    <div class="bg-red-950/30 border-l-4 border-red-500 rounded-lg p-4 mb-6 shadow-lg backdrop-blur-sm">
        <div class="flex items-start space-x-3">
            <!-- Error Icon -->
            <div class="flex-shrink-0">
                <svg class="w-6 h-6 mt-0.5" style="color: #F7B32B;" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
            </div>
            
            <!-- Error Content -->
            <div class="flex-1">
                <h4 class="text-red-300 font-semibold text-sm uppercase tracking-wide mb-1">
                    Authentication Error
                </h4>
                <p class="text-red-100 font-medium leading-relaxed">
                    {{ session('loginError') }}
                </p>
            </div>
            
            <!-- Close Button (Optional) -->
            <button type="button" class="flex-shrink-0 ml-auto text-red-400 hover:text-red-300 transition-colors duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
@endif