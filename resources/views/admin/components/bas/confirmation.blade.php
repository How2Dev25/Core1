<dialog id="confirm_modal_bas" class="modal">
  <div class="modal-box max-w-3xl max-h-[85vh] overflow-y-auto">
    <form method="dialog" class="absolute top-4 right-4">
      <button class="btn btn-sm btn-circle btn-ghost">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
          stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <line x1="18" y1="6" x2="6" y2="18"></line>
          <line x1="6" y1="6" x2="18" y2="18"></line>
        </svg>
      </button>
    </form>

    <div class="p-6">
     

      @include('booking.roombookingterms')

      <h3 class="text-lg font-medium text-gray-900 mb-2">Submit</h3>
      <p class="text-sm text-gray-500 mb-6">Are you sure you want book this room?</p>

      <div class="flex justify-center gap-4">
        <form method="dialog" class="flex-1">
          <button class="btn btn-outline w-full">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1">
              <line x1="18" y1="6" x2="6" y2="18"></line>
              <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
            Cancel
          </button>
        </form>

        <div class="flex-1">

        <button onclick="submitForm()" type="button" id="submitBtn"  class="btn btn-primary w-full opacity-50 cursor-not-allowed transition" disabled>
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1">
            <path d="M20 6L9 17l-5-5"></path>
          </svg>
          Yes
        </button>

        </div>
      </div>
    </div>

   
</dialog>

<script>
  function submitForm() {
      const roomprofile = document.getElementById('reservationForm');

      if (!document.getElementById('agreeTerms').checked) {
        return; // safety check
      }

      roomprofile.submit();
    }
</script>