<dialog id="confirm_reservation_{{$reserveroom->reservationID}}" class="modal">
  <div class="modal-box max-w-4xl p-0 overflow-hidden">

    <!-- Close -->
    <form method="dialog">
      <button class="btn btn-sm btn-circle btn-ghost absolute right-4 top-4 z-20 bg-white/80 backdrop-blur-sm">
        <i class="fas fa-times"></i>
      </button>
    </form>

    <div class="grid grid-cols-2 divide-x divide-gray-200">
      
      <!-- Left Column: Reservation Details & Price Summary -->
      <div class="p-6">
        <!-- Header -->
        <div class="flex items-start gap-3 mb-6">
          <div class="bg-[#F7B32B]/10 p-2 rounded-lg">
            <i class="fas fa-check-circle text-[#F7B32B] text-xl"></i>
          </div>
          <div>
            <h3 class="text-xl font-bold text-gray-900">Confirm Reservation</h3>
            <p class="text-sm text-gray-500 mt-1">Please select confirmation type</p>
          </div>
        </div>

        <!-- Reservation Details Card -->
        <div class="bg-gray-50 rounded-xl p-4 mb-6 border border-gray-200">
          <div class="grid grid-cols-1 gap-3">
            <div class="flex items-center gap-3">
              <i class="fas fa-tag text-gray-400 text-sm"></i>
              <div class="flex-1">
                <span class="text-sm text-gray-600">Reservation ID</span>
                <span class="block font-bold text-gray-900">{{$reserveroom->bookingID}}</span>
              </div>
            </div>
            <div class="flex items-center gap-3">
              <i class="fas fa-user text-gray-400 text-sm"></i>
              <div class="flex-1">
                <span class="text-sm text-gray-600">Guest Name</span>
                <span class="block font-bold text-gray-900">{{$reserveroom->guestname}}</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Price Summary -->
        <div class="bg-blue-50 rounded-xl p-5 border border-blue-200 mb-6">
          <h4 class="text-sm font-semibold text-gray-700 mb-4 flex items-center gap-2">
            <i class="fas fa-receipt text-blue-500"></i>
            Price Summary
          </h4>
          <div class="space-y-3">
            <div class="grid grid-cols-2 gap-4">
              <div class="text-sm text-gray-600">Subtotal</div>
              <div class="text-right font-medium text-gray-900">₱{{ number_format($reserveroom->subtotal, 2) }}</div>
              
              @if($reserveroom->vat > 0)
              <div class="text-sm text-gray-600">VAT</div>
              <div class="text-right font-medium text-gray-900">₱{{ number_format($reserveroom->vat, 2) }}</div>
              @endif
              
              @if($reserveroom->serviceFee > 0)
              <div class="text-sm text-gray-600">Service Fee</div>
              <div class="text-right font-medium text-gray-900">₱{{ number_format($reserveroom->serviceFee, 2) }}</div>
              @endif
              
              @if($reserveroom->loyalty_discount > 0)
              <div class="text-sm text-gray-600">Loyalty Discount</div>
              <div class="text-right font-medium text-red-600">-₱{{ number_format($reserveroom->loyalty_discount, 2) }}</div>
              @endif
            </div>
            
            <div class="border-t border-blue-200 pt-3 mt-2">
              <div class="grid grid-cols-2 gap-4">
                <div class="text-sm font-semibold text-gray-700">Total Amount</div>
                <div class="text-right text-lg font-bold text-blue-700">₱{{ number_format($reserveroom->total, 2) }}</div>
              </div>
            </div>
          </div>
        </div>

        <!-- Payment Method Info -->
        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
          <div class="flex items-center gap-3">
            <i class="fas fa-info-circle text-gray-400"></i>
            <p class="text-sm text-gray-600">
              Payment method: <span class="font-medium">{{$reserveroom->payment_method ?? 'To be selected'}}</span>
            </p>
          </div>
        </div>
      </div>

      <!-- Right Column: Payment Selection & Actions -->
      <div class="p-6 bg-gray-50/50">
        <div class="h-full flex flex-col">
          <h4 class="text-lg font-semibold text-gray-800 mb-6 flex items-center gap-2">
            <i class="fas fa-credit-card text-gray-500"></i>
            Select Payment Type
          </h4>

          <!-- Payment Selection Grid -->
          <div class="grid grid-cols-1 gap-4 mb-6 flex-1">
            <!-- Deposit Option -->
            <label class="block">
              <input type="radio" name="payment_status" value="Partial" 
                     form="confirmForm{{$reserveroom->reservationID}}"
                     class="hidden peer"
                     checked>
              
              <div class="p-4 bg-white border-2 border-gray-300 rounded-xl cursor-pointer 
                         hover:border-[#F7B32B] hover:shadow-md transition-all duration-200
                         peer-checked:border-[#F7B32B] peer-checked:bg-amber-50/30">
                
                <div class="flex items-center gap-3 mb-3">
                  <div class="w-10 h-10 rounded-full bg-amber-100 flex items-center justify-center">
                    <i class="fas fa-money-bill-wave text-amber-600 text-lg"></i>
                  </div>
                  <div class="flex-1">
                    <div class="font-semibold text-gray-900">Confirm with 50% Deposit</div>
                    <div class="text-xs text-gray-500">Partial payment received</div>
                  </div>
                  <i class="fas fa-check-circle text-[#F7B32B] text-xl opacity-0 peer-checked:opacity-100 transition-opacity"></i>
                </div>

                <!-- Deposit Calculation Grid -->
                <div class="ml-13">
                  <div class="grid grid-cols-2 gap-2 text-sm">
                    <div class="text-gray-600">Total Amount:</div>
                    <div class="text-right font-medium">₱{{ number_format($reserveroom->total, 2) }}</div>
                    
                    <div class="text-gray-600">Deposit (50%):</div>
                    <div class="text-right font-medium text-amber-600">₱{{ number_format($reserveroom->total * 0.5, 2) }}</div>
                    
                    <div class="col-span-2 border-t border-gray-200 pt-2 mt-1">
                      <div class="grid grid-cols-2">
                        <div class="font-medium text-gray-700">Remaining Balance:</div>
                        <div class="text-right font-bold text-blue-600">₱{{ number_format($reserveroom->total * 0.5, 2) }}</div>
                      </div>
                    </div>
                  </div>
                  <p class="text-xs text-amber-600 mt-2">
                    <i class="fas fa-clock mr-1"></i>
                    Balance due at check-out
                  </p>
                </div>
              </div>
            </label>

            <!-- Fully Paid Option -->
            <label class="block">
              <input type="radio" name="payment_status" value="Fully Paid" 
                     form="confirmForm{{$reserveroom->reservationID}}"
                     class="hidden peer">
              
              <div class="p-4 bg-white border-2 border-gray-300 rounded-xl cursor-pointer 
                         hover:border-emerald-500 hover:shadow-md transition-all duration-200
                         peer-checked:border-emerald-500 peer-checked:bg-emerald-50/30">
                
                <div class="flex items-center gap-3 mb-3">
                  <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center">
                    <i class="fas fa-wallet text-emerald-600 text-lg"></i>
                  </div>
                  <div class="flex-1">
                    <div class="font-semibold text-gray-900">Confirm as Fully Paid</div>
                    <div class="text-xs text-gray-500">Complete payment received</div>
                  </div>
                  <i class="fas fa-check-circle text-emerald-500 text-xl opacity-0 peer-checked:opacity-100 transition-opacity"></i>
                </div>

                <!-- Fully Paid Calculation Grid -->
                <div class="ml-13">
                  <div class="grid grid-cols-2 gap-2 text-sm">
                    <div class="text-gray-600">Total Amount:</div>
                    <div class="text-right font-medium">₱{{ number_format($reserveroom->total, 2) }}</div>
                    
                    <div class="text-gray-600">Amount to Pay:</div>
                    <div class="text-right font-medium text-emerald-600">₱{{ number_format($reserveroom->total, 2) }}</div>
                    
                    <div class="col-span-2 border-t border-gray-200 pt-2 mt-1">
                      <div class="grid grid-cols-2">
                        <div class="font-medium text-gray-700">Final Balance:</div>
                        <div class="text-right font-bold text-emerald-600">₱0.00</div>
                      </div>
                    </div>
                  </div>
                  <p class="text-xs text-emerald-600 mt-2">
                    <i class="fas fa-check-circle mr-1"></i>
                    No remaining balance
                  </p>
                </div>
              </div>
            </label>
          </div>

          <!-- Actions -->
          <form id="confirmForm{{$reserveroom->reservationID}}" method="POST"
                action="/reservationconfirm/{{$reserveroom->reservationID}}"
                class="pt-4 border-t border-gray-300">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-2 gap-3">
              <button type="button" onclick="confirm_reservation_{{$reserveroom->reservationID}}.close()"
                class="btn btn-outline hover:bg-gray-100 px-4 py-2">
                <i class="fas fa-times mr-2"></i>
                Cancel
              </button>

              <button type="submit"
                class="btn bg-[#F7B32B] border-[#F7B32B] hover:bg-[#e6a229] hover:border-[#e6a229] text-white px-4 py-2 shadow-sm">
                <i class="fas fa-check-circle mr-2"></i>
                Confirm Reservation
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

  </div>

  <!-- Backdrop -->
  <form method="dialog" class="modal-backdrop bg-black/50 backdrop-blur-sm">
    <button>close</button>
  </form>
</dialog>