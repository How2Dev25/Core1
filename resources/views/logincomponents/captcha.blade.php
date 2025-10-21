<div class="mb-6">
  <div
    class="group relative bg-gradient-to-br from-white/10 to-white/5 border border-white/20 rounded-xl p-6 backdrop-blur-md hover:border-white/30 transition-all duration-500 overflow-hidden">

    <!-- Animated background gradient -->
    <div
      class="absolute inset-0 bg-gradient-to-r from-blue-500/0 via-purple-500/5 to-pink-500/0 opacity-0 group-hover:opacity-100 transition-opacity duration-700">
    </div>

    <!-- Subtle shine effect on hover -->
    <div
      class="absolute inset-0 -translate-x-full group-hover:translate-x-full transition-transform duration-1000 bg-gradient-to-r from-transparent via-white/10 to-transparent">
    </div>

    <div class="relative flex items-center gap-4 justify-center">
      <div class="flex-1 text-center">
        <!-- Icon with pulse animation -->
        <div class="inline-flex items-center justify-center mb-3">
          <div class="relative">
            <div class="absolute inset-0 bg-blue-500/20 rounded-full blur-xl animate-pulse"></div>
            <svg class="w-8 h-8 text-white/70 relative" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
            </svg>
          </div>
        </div>

        <p class="text-white/60 text-sm mb-4 font-medium animate-fade-in">Verify you're human</p>

        <!-- reCAPTCHA container with scale animation -->
        <div class="inline-block transform transition-all duration-300 hover:scale-105">
          <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site') }}"></div>
        </div>
      </div>
    </div>

    <!-- Corner accents -->
    <div class="absolute top-0 left-0 w-20 h-20 border-t-2 border-l-2 border-white/10 rounded-tl-xl"></div>
    <div class="absolute bottom-0 right-0 w-20 h-20 border-b-2 border-r-2 border-white/10 rounded-br-xl"></div>
  </div>
</div>

<style>
  @keyframes fade-in {
    from {
      opacity: 0;
      transform: translateY(-10px);
    }

    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .animate-fade-in {
    animation: fade-in 0.6s ease-out;
  }
</style>




<script src="https://www.google.com/recaptcha/api.js" async defer></script>