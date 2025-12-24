<dialog id="request_modal" class="modal">
  <div class="modal-box max-w-4xl p-0 overflow-hidden">
    <!-- Header with white background -->
    <div class="bg-white text-black p-5 border-b">
      <div class="flex justify-between items-start">
        <div class="flex items-center gap-3">
          <div class="p-2 rounded-lg bg-gray-100">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clipboard-list">
              <rect width="8" height="4" x="8" y="2" rx="1" ry="1"/>
              <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/>
              <path d="M12 11h4"/>
              <path d="M12 16h4"/>
              <path d="M8 11h.01"/>
              <path d="M8 16h.01"/>
            </svg>
          </div>
          <div>
            <h3 class="font-bold text-xl">Stock Request</h3>
            <p class="text-sm text-gray-600">Manage hotel inventory requests</p>
          </div>
        </div>
        <form method="dialog">
          <button class="btn btn-ghost btn-circle text-gray-500 hover:bg-gray-100">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x">
              <path d="M18 6 6 18"/>
              <path d="m6 6 12 12"/>
            </svg>
          </button>
        </form>
      </div>
    </div>

    <!-- Form Content -->
    <form method="POST" action="/createstockrequest" class="flex flex-col h-full">
      @csrf
      <div class="p-6 space-y-6 flex-grow">
        <!-- Request Details -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div class="form-control">
            <label class="label">
              <span class="label-text font-medium flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package">
                  <path d="m7.5 4.27 9 5.15"/>
                  <path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/>
                  <path d="m3.3 7 8.7 5 8.7-5"/>
                  <path d="M12 22V12"/>
                </svg>
                Category
              </span>
            </label>
            <select name="core1_request_category" class="select select-bordered w-full" required>
              <option disabled selected value="">Select category</option>
              <option value="linen">Linen & Bedding</option>
              <option value="toiletries">Toiletries</option>
              <option value="cleaning">Cleaning Supplies</option>
              <option value="amenities">Guest Amenities</option>
              <option value="maintenance">Maintenance Items</option>
            </select>
          </div>

          <div class="form-control flex-col">
            <label class="label">
              <span class="label-text font-medium flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                  class="lucide lucide-list-checks">
                  <path d="m3 17 2 2 4-4" />
                  <path d="m3 7 2 2 4-4" />
                  <path d="M13 6h8" />
                  <path d="M13 12h8" />
                  <path d="M13 18h8" />
                </svg>
                Request Item
              </span>
          
            </label>
            <input name="core1_request_items" class="input input-bordered w-full pl-10" required></input>
          </div>
        </div>

        <!-- Request Items -->
       

        <!-- Status, Priority, and Needed -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
          <div class="form-control">
            <label class="label">
              <span class="label-text font-medium flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-flag">
                  <path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"/>
                  <line x1="4" x2="4" y1="22" y2="15"/>
                </svg>
                Priority
              </span>
            </label>
            <select name="core1_request_priority" class="select select-bordered w-full" required>
              <option value="Low">Low</option>
              <option value="Medium" selected>Medium</option>
              <option value="High">High</option>
              <option value="Urgent">Urgent</option>
            </select>
          </div>
          
          <div class="form-control">
            <label class="label">
              <span class="label-text font-medium flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar-days">
                  <path d="M8 2v4"/>
                  <path d="M16 2v4"/>
                  <rect width="18" height="18" x="3" y="4" rx="2"/>
                  <path d="M3 10h18"/>
                  <path d="M8 14h.01"/>
                  <path d="M12 14h.01"/>
                  <path d="M16 14h.01"/>
                  <path d="M8 18h.01"/>
                  <path d="M12 18h.01"/>
                  <path d="M16 18h.01"/>
                </svg>
                Quantity Needed
              </span>
            </label>
            <div class="relative">
              <input type="number" name="core1_request_needed" class="input input-bordered w-full pl-10" placeholder="Enter quantity" min="1" required>
              <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-hash">
                  <line x1="4" x2="20" y1="9" y2="9"/>
                  <line x1="4" x2="20" y1="15" y2="15"/>
                  <line x1="10" x2="8" y1="3" y2="21"/>
                  <line x1="16" x2="14" y1="3" y2="21"/>
                </svg>
              </span>
            </div>
          </div>
        </div>
      </div>

      <!-- Footer with action buttons -->
      <div class="flex justify-end p-6 bg-gray-50 border-t">
        <div class="flex gap-3">
          <button type="button" class="btn btn-ghost" onclick="request_modal.close()">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x-circle">
              <circle cx="12" cy="12" r="10"/>
              <path d="m15 9-6 6"/>
              <path d="m9 9 6 6"/>
            </svg>
            Cancel
          </button>
          <button type="submit" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-save">
              <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
              <polyline points="17 21 17 13 7 13 7 21"/>
              <polyline points="7 3 7 8 15 8"/>
            </svg>
            Create Request
          </button>
        </div>
      </div>
    </form>
  </div>
  <form method="dialog" class="modal-backdrop">
    <button>close</button>
  </form>
</dialog>