<dialog id="confirm_modal" class="modal">
  <div class="modal-box max-w-md">
    <form method="dialog" class="absolute top-4 right-4">
      <button class="btn btn-sm btn-circle btn-ghost">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <line x1="18" y1="6" x2="6" y2="18"></line>
          <line x1="6" y1="6" x2="18" y2="18"></line>
        </svg>
      </button>
    </form>
    
    <div class="text-center p-6">
      <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 mb-4">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
        </svg>
      </div>
      
      <h3 class="text-lg font-medium text-gray-900 mb-2">Confirm Changes</h3>
      <p class="text-sm text-gray-500 mb-6">Are you sure you want to save these changes?</p>
      
      <div class="flex justify-center gap-4">
        <form method="dialog" class="flex-1">
          <button class="btn btn-outline w-full">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1">
              <line x1="18" y1="6" x2="6" y2="18"></line>
              <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
            Cancel
          </button>
        </form>
        
        <div  class="flex-1">
         
          <button onclick="submitForm()" type="button" class="btn btn-primary w-full">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1">
              <path d="M20 6L9 17l-5-5"></path>
            </svg>
            Yes
          </button>
        </.>
      </div>
    </div>
  </div>
  
  <form method="dialog" class="modal-backdrop">
    <button>close</button>
  </form>
</dialog>

<script>
    function submitForm(){
        const roomprofile = document.getElementById('roomprofile');
      

         roomprofile.submit();
    }
    
</script>