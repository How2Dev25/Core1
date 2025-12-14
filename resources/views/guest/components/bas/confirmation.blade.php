<!-- Toast container -->
<div id="toastContainer" class="fixed bottom-4 right-4 space-y-2 z-50"></div>

<dialog id="confirm_modal_bas2" class="modal">
  <div class="modal-box max-w-3xl max-h-[85vh] overflow-y-auto">
    <!-- Close button -->
    <form method="dialog" class="absolute top-4 right-4">
      <button class="btn btn-sm btn-circle btn-ghost">&times;</button>
    </form>

   
    <div class=" p-6">
      @include('booking.roombookingterms')

      <h3 class="text-lg font-medium text-gray-900 mb-2">Submit</h3>
      <p class="text-sm text-gray-500 mb-6">Are you sure you want to book this room?</p>

      <div class="flex justify-center gap-4">
        <form method="dialog" class="flex-1">
          <button class="btn btn-outline w-full">Cancel</button>
        </form>

        <div class="flex-1 relative">
          <button id="submitBtn" type="button" class="btn btn-primary w-full opacity-50 cursor-not-allowed transition " disabled
            onclick="submitReservation()">
            <span id="btnText">Yes</span>
            <svg id="btnSpinner" class="animate-spin ml-2 h-5 w-5 text-white hidden" xmlns="http://www.w3.org/2000/svg"
              fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
            </svg>
          </button>
        </div>
      </div>

      <div class="text-center mt-6">
        <p class="text-xs text-gray-400">Powered by <span class="font-semibold text-blue-500">Gemini AI</span></p>
      </div>
    </div>
  </div>

  
</dialog>

<script>
  function showToast(message, type = 'success') {
    const container = document.getElementById('toastContainer');
    const toast = document.createElement('div');
    toast.className = `toast fixed bottom-0 right-0 mb-2 mr-2 bg-${type === 'success' ? 'green' : 'red'}-500 text-white p-3 rounded shadow flex items-center justify-between transform translate-x-24 opacity-0 transition-all duration-300`;
    toast.textContent = message;
    container.appendChild(toast);
    requestAnimationFrame(() => {
      toast.classList.remove('translate-x-24', 'opacity-0');
      toast.classList.add('translate-x-0', 'opacity-100');
    });
    setTimeout(() => {
      toast.classList.add('translate-x-24', 'opacity-0');
      toast.addEventListener('transitionend', () => toast.remove());
    }, 4000);

    
  }

  async function submitReservation() {
    const form = document.getElementById('reservationForm');
    const confirmBtn = document.getElementById('submitBtn');
    const btnText = document.getElementById('btnText');
    const btnSpinner = document.getElementById('btnSpinner');

    confirmBtn.disabled = true;
    btnText.textContent = 'Processing...';
    btnSpinner.classList.remove('hidden');

    

    const formData = new FormData(form);

    try {
      const response = await fetch(form.action, {
        method: form.method,
        body: formData,
        headers: { 'Accept': 'application/json' }
      });

      const data = await response.json();

      if (response.ok) {
        document.getElementById('confirm_modal_bas2').close();

        // ✅ Stripe payment
        if (data.checkout_url) {
          window.location.href = data.checkout_url;
          return;
        }



        // ✅ Pay at Hotel
          if (data.redirect) {
          window.location.href = data.redirect;
          return;
        }
      } else {
        throw new Error(data.message || 'Failed to book room');
      }
    } catch (err) {
      showToast(`Error: ${err.message}`, 'error');
    } finally {
      confirmBtn.disabled = false;
      btnText.textContent = 'Yes';
      btnSpinner.classList.add('hidden');
    }
  }
</script>