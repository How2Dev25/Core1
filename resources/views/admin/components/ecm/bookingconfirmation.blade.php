<!-- Font Awesome -->

<!-- Modal -->
<dialog id="confirm_modal_bas" class="modal">
  <div class="modal-box w-full max-w-3xl max-h-[85vh] overflow-y-auto relative p-6">
    <!-- Close button -->
    <form method="dialog" class="absolute top-4 right-4">
      <button class="btn btn-sm btn-circle btn-ghost">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
          stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <line x1="18" y1="6" x2="6" y2="18"></line>
          <line x1="6" y1="6" x2="18" y2="18"></line>
        </svg>
      </button>
    </form>

    <!-- Header with Calendar Icon -->
    @include('events.eventtermsconfirm')
  </div>
</dialog>

<script>
  // Enable submit button when checkbox is checked
  function toggleSubmitBtn2() {
    const checkbox = document.getElementById('agreeTerms2');
    const submitBtn = document.getElementById('submitBtn');
    submitBtn.disabled = !checkbox.checked;
  }

  // Submit form safely
  function submitForm() {
    const form = document.getElementById('eventBookingForm');
    const checkbox = document.getElementById('agreeTerms2');

    if (!checkbox.checked) {
      alert("You must agree to the Terms & Conditions");
      return;
    }

    form.submit();
  }
</script>