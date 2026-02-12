<div class="mb-4">
  <div class="space-y-2">
    

    <div class="min-h-[78px] flex items-center justify-center">
      <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site') }}"></div>
    </div>
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