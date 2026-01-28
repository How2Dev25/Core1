<dialog id="confirmorder" class="modal backdrop-blur-sm">
    <div class="modal-box max-w-4xl w-full p-0 bg-white shadow-2xl border border-gray-200 max-h-[95vh] flex flex-col">
        <!-- Fixed Header -->
        <div class="flex-shrink-0">
            <!-- Close Button -->
            <form method="dialog" class="absolute top-3 right-3 z-10 sm:top-4 sm:right-4">
                <button
                    class="btn btn-sm btn-circle bg-white hover:bg-gray-100 border-gray-300 hover:border-blue-900 transition-all duration-300 shadow-md hover:shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"
                        class="text-blue-900">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </form>

            <!-- Header Section -->
            <div class="relative bg-blue-900 px-4 py-4 sm:px-6 sm:py-5 text-center overflow-hidden">
                <!-- Decorative Elements -->
                <div class="absolute inset-0 opacity-10">
                    <div
                        class="absolute top-0 left-0 w-24 h-24 bg-yellow-400 rounded-full -translate-x-1/2 -translate-y-1/2">
                    </div>
                    <div
                        class="absolute bottom-0 right-0 w-28 h-28 bg-yellow-400 rounded-full translate-x-1/2 translate-y-1/2">
                    </div>
                </div>

                <!-- Icon -->
                <div class="relative mx-auto mb-2 sm:mb-3">
                    <div
                        class="mx-auto flex items-center justify-center h-12 w-12 sm:h-14 sm:w-14 rounded-xl bg-yellow-400 shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="text-blue-900 sm:w-7 sm:h-7">
                            <path
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                    </div>
                </div>

                <h3 class="text-lg sm:text-xl md:text-2xl font-bold text-white mb-1 tracking-tight">Confirm Your Order
                </h3>
                <p class="text-yellow-400 text-xs sm:text-sm font-medium">Review your items and payment method</p>
            </div>
        </div>

        <!-- Scrollable Content Section -->
        <div class="flex-1 overflow-y-auto custom-scrollbar">
            <div class="p-4 sm:p-6 md:p-8">

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6 mb-4 sm:mb-6">

                    <!-- Left Column: Order Summary -->
                    <div
                        class="bg-white rounded-xl sm:rounded-2xl shadow-lg border border-gray-200 overflow-hidden flex flex-col h-full lg:max-h-[500px]">
                        <div
                            class="flex-shrink-0 bg-gray-50 px-4 py-3 sm:px-6 sm:py-4 border-b border-gray-200 sticky top-0 z-10">
                            <h4 class="font-bold text-blue-900 text-base sm:text-lg flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="text-yellow-400 flex-shrink-0">
                                    <path d="M16 4h2a2 2 0 012 2v14a2 2 0 01-2 2H6a2 2 0 01-2-2V6a2 2 0 012-2h2"></path>
                                    <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                                </svg>
                                <span>Order Summary</span>
                            </h4>
                        </div>

                        <div id="orderSummary"
                            class="flex-1 overflow-y-auto custom-scrollbar p-3 sm:p-4 md:p-6 space-y-2 sm:space-y-3">
                            <!-- Order items will be populated here -->
                            <div class="text-center py-8 text-gray-400">
                                <div class="animate-pulse">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-12 h-12 sm:w-16 sm:h-16 mx-auto mb-3 text-gray-300" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                    </svg>
                                    <p class="text-xs sm:text-sm">Loading your order...</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Payment Options -->
                    <div
                        class="bg-white rounded-xl sm:rounded-2xl shadow-lg border border-gray-200 overflow-hidden flex flex-col h-full">
                        <div class="flex-shrink-0 bg-gray-50 px-4 py-3 sm:px-6 sm:py-4 border-b border-gray-200">
                            <div class="flex items-start gap-2 sm:gap-3">
                                <div
                                    class="flex-shrink-0 w-8 h-8 sm:w-10 sm:h-10 bg-blue-900 rounded-xl flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="text-yellow-400 sm:w-5 sm:h-5">
                                        <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                                        <line x1="1" y1="10" x2="23" y2="10"></line>
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-bold text-blue-900 text-base sm:text-lg">Payment Method</h4>
                                    <p class="text-xs sm:text-sm text-gray-600 mt-0.5 sm:mt-1">Choose payment option</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex-1 overflow-y-auto custom-scrollbar p-3 sm:p-4 md:p-6 space-y-3">
                            <!-- Pay Now Option -->
                            <label
                                class="group flex items-start sm:items-center gap-3 p-3 sm:p-4 bg-white rounded-lg sm:rounded-xl border-2 border-gray-200 hover:border-yellow-400 hover:bg-yellow-50/30 cursor-pointer transition-all duration-300 shadow-sm hover:shadow-md">
                                <input type="radio" name="payment_option" value="now" checked
                                    class="radio radio-warning mt-1 sm:mt-0 flex-shrink-0"
                                    onchange="updatePaymentOption('now')">
                                <div class="flex-1 min-w-0">
                                    <div class="flex flex-wrap items-center gap-2 mb-1">
                                        <span class="font-bold text-blue-900 text-sm sm:text-base">Pay Now</span>
                                        <span
                                            class="px-2 py-0.5 bg-yellow-400 text-blue-900 text-xs font-semibold rounded-full whitespace-nowrap">Recommended</span>
                                    </div>
                                    <div class="text-xs sm:text-sm text-gray-600">Complete payment immediately via
                                        online transaction</div>
                                </div>
                                <div class="flex-shrink-0 hidden sm:block">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="text-yellow-400">
                                        <polyline points="20 6 9 17 4 12"></polyline>
                                    </svg>
                                </div>
                            </label>

                            <!-- Pay at Checkout Option -->
                            <label
                                class="group flex items-start sm:items-center gap-3 p-3 sm:p-4 bg-white rounded-lg sm:rounded-xl border-2 border-gray-200 hover:border-blue-900 hover:bg-blue-50/30 cursor-pointer transition-all duration-300 shadow-sm hover:shadow-md">
                                <input type="radio" name="payment_option" value="checkout"
                                    class="radio radio-info mt-1 sm:mt-0 flex-shrink-0"
                                    onchange="updatePaymentOption('checkout')">
                                <div class="flex-1 min-w-0">
                                    <div class="font-bold text-blue-900 text-sm sm:text-base mb-1">Pay at Checkout</div>
                                    <div class="text-xs sm:text-sm text-gray-600">Add charges to your room bill and
                                        settle during hotel checkout</div>
                                </div>
                                <div class="flex-shrink-0 hidden sm:block">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="text-blue-900">
                                        <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"></path>
                                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                    </svg>
                                </div>
                            </label>

                            <!-- Additional Info Card -->
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 sm:p-4">
                                <div class="flex gap-2 sm:gap-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="text-blue-900 flex-shrink-0 mt-0.5">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="12" y1="16" x2="12" y2="12"></line>
                                        <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                    </svg>
                                    <div>
                                        <p class="text-xs sm:text-sm text-blue-900 font-medium mb-1">Secure Payment</p>
                                        <p class="text-xs text-gray-700">All transactions are encrypted and secure. Your
                                            payment information is protected.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Fixed Footer with Action Buttons -->
        <div class="flex-shrink-0 bg-gray-50 border-t border-gray-200 px-4 py-4 sm:px-6 sm:py-5">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <form method="dialog" class="w-full">
                    <button
                        class="btn btn-outline btn-lg w-full border-2 border-gray-300 hover:bg-gray-100 hover:border-blue-900 text-blue-900 transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                        <span>Cancel Order</span>
                    </button>
                </form>

                <div class="w-full">
                    <button onclick="submitForm()" type="button"
                        class="btn btn-lg w-full bg-blue-900 hover:bg-blue-800 border-0 text-white shadow-lg hover:shadow-xl transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"
                            class="text-yellow-400">
                            <path d="M20 6L9 17l-5-5"></path>
                        </svg>
                        <span>Confirm & Proceed</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</dialog>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

    #confirmorder {
        font-family: 'Inter', system-ui, -apple-system, sans-serif;
    }

    /* Custom Scrollbar with Theme Colors */
    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
        height: 6px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: #f3f4f6;
        border-radius: 10px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: linear-gradient(180deg, #1e3a8a, #3b82f6);
        border-radius: 10px;
        transition: background 0.3s;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(180deg, #1e40af, #2563eb);
    }

    /* Firefox scrollbar */
    .custom-scrollbar {
        scrollbar-width: thin;
        scrollbar-color: #1e3a8a #f3f4f6;
    }

    /* Fade in animation for order items */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(15px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .order-item-animate {
        animation: fadeInUp 0.4s ease-out forwards;
    }

    /* Shimmer effect for loading */
    @keyframes shimmer {
        0% {
            background-position: -1000px 0;
        }

        100% {
            background-position: 1000px 0;
        }
    }

    .shimmer {
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
        background-size: 1000px 100%;
        animation: shimmer 2s infinite;
    }

    /* Modal responsive sizing */
    .modal-box {
        margin: 1rem;
    }

    @media (max-width: 640px) {
        .modal-box {
            max-width: calc(100vw - 1rem) !important;
            margin: 0.5rem;
            max-height: calc(100vh - 1rem) !important;
        }
    }

    @media (min-width: 641px) and (max-width: 1023px) {
        .modal-box {
            max-width: 90vw !important;
            max-height: 90vh !important;
        }
    }

    @media (min-width: 1024px) {
        .modal-box {
            max-height: 90vh !important;
        }
    }

    /* Radio button animation */
    input[type="radio"]:checked {
        animation: radioCheck 0.3s ease-out;
    }

    @keyframes radioCheck {
        0% {
            transform: scale(0.8);
        }

        50% {
            transform: scale(1.1);
        }

        100% {
            transform: scale(1);
        }
    }

    /* Smooth scroll behavior */
    .custom-scrollbar {
        scroll-behavior: smooth;
    }

    /* Prevent layout shift on scroll */
    #orderSummary::-webkit-scrollbar {
        width: 6px;
    }

    /* Line clamp for text overflow */
    .line-clamp-1 {
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>

<script>
    let selectedPaymentOption = 'now';
    let orderData = [];

    function updatePaymentOption(option) {
        selectedPaymentOption = option;
        console.log('Payment option changed to:', option);

        // Add visual feedback
        document.querySelectorAll('input[name="payment_option"]').forEach(input => {
            const label = input.closest('label');
            if (input.value === option) {
                label.classList.add('ring-2', 'ring-offset-2');
                label.classList.add(option === 'now' ? 'ring-yellow-400' : 'ring-blue-900');
                setTimeout(() => {
                    label.classList.remove('ring-2', 'ring-offset-2', 'ring-yellow-400', 'ring-blue-900');
                }, 600);
            }
        });
    }

    function submitForm() {
        // Get the order data from the parent window
        if (window.parent && window.parent.orderData) {
            orderData = window.parent.orderData;
        }

        // Add payment option to order data
        orderData.payment_option = selectedPaymentOption;

        // Show loading state on button
        const confirmBtn = event.target;
        const originalHTML = confirmBtn.innerHTML;
        confirmBtn.disabled = true;
        confirmBtn.innerHTML = `
            <svg class="animate-spin h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span>Processing...</span>
        `;

        // Submit the form with payment option
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/order/submit';

        // Add CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]');
        if (csrfToken) {
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = csrfToken.getAttribute('content');
            form.appendChild(csrfInput);
        }

        // Add payment option as hidden input
        const paymentInput = document.createElement('input');
        paymentInput.type = 'hidden';
        paymentInput.name = 'payment_option';
        paymentInput.value = selectedPaymentOption;
        form.appendChild(paymentInput);

        // Add order data as hidden inputs
        Object.keys(orderData).forEach(key => {
            if (key !== 'payment_option') {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = key;
                input.value = Array.isArray(orderData[key]) ? orderData[key].join(',') : orderData[key];
                form.appendChild(input);
            }
        });

        document.body.appendChild(form);
        form.submit();
    }

    // Update order summary display with grid responsive layout
    function updateOrderSummary() {
        if (window.parent && window.parent.orderData) {
            const summaryDiv = document.getElementById('orderSummary');
            const orderData = window.parent.orderData;

            let summaryHTML = '';
            let total = 0;

            if (orderData.items && orderData.items.length > 0) {
                orderData.items.forEach((item, index) => {
                    const itemTotal = item.quantity * item.price;
                    total += itemTotal;

                    summaryHTML += `
                        <div class="order-item-animate grid grid-cols-[auto_1fr_auto] gap-2 sm:gap-3 md:gap-4 p-2 sm:p-3 md:p-4 bg-white rounded-lg sm:rounded-xl border border-gray-200 hover:border-yellow-400 hover:shadow-md transition-all duration-300" style="animation-delay: ${index * 0.1}s">
                            <!-- Image with quantity badge -->
                            <div class="relative flex-shrink-0">
                                <img src="${item.photo}" 
                                     alt="${item.name}" 
                                     class="w-14 h-14 sm:w-16 sm:h-16 md:w-20 md:h-20 rounded-lg sm:rounded-xl object-cover shadow-sm"
                                     onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 200 200%22%3E%3Crect fill=%22%23f3f4f6%22 width=%22200%22 height=%22200%22/%3E%3Cpath fill=%22%239ca3af%22 d=%22M100 40c-33.137 0-60 26.863-60 60s26.863 60 60 60 60-26.863 60-60-26.863-60-60-60zm0 108c-26.51 0-48-21.49-48-48s21.49-48 48-48 48 21.49 48 48-21.49 48-48 48z%22/%3E%3Ccircle fill=%22%239ca3af%22 cx=%22100%22 cy=%2280%22 r=%2215%22/%3E%3Cpath fill=%22%239ca3af%22 d=%22M100 105c-11.028 0-20 8.972-20 20h40c0-11.028-8.972-20-20-20z%22/%3E%3C/svg%3E'">
                                <div class="absolute -top-1 -right-1 sm:-top-2 sm:-right-2 bg-yellow-400 text-blue-900 text-xs font-bold rounded-full w-5 h-5 sm:w-6 sm:h-6 flex items-center justify-center shadow-md">
                                    ${item.quantity}
                                </div>
                            </div>
                            
                            <!-- Item details -->
                            <div class="flex flex-col justify-center min-w-0">
                                <div class="font-bold text-blue-900 text-xs sm:text-sm md:text-base line-clamp-2 mb-0.5 sm:mb-1">
                                    ${item.name}
                                </div>
                                <div class="flex items-center gap-1 sm:gap-2">
                                    <span class="text-xs text-gray-600">${item.quantity} ×</span>
                                    <span class="text-xs sm:text-sm font-semibold text-yellow-600">₱${item.price.toFixed(2)}</span>
                                </div>
                            </div>
                            
                            <!-- Price -->
                            <div class="flex items-center justify-end">
                                <div class="font-bold text-blue-900 text-sm sm:text-base md:text-lg whitespace-nowrap">₱${itemTotal.toFixed(2)}</div>
                            </div>
                        </div>
                    `;
                });

                summaryHTML += `
                    <div class="sticky bottom-0 bg-white border-t-2 border-dashed border-gray-300 pt-3 sm:pt-4 mt-3 sm:mt-4">
                        <div class="grid grid-cols-[1fr_auto] gap-4 bg-yellow-50 rounded-lg p-3 sm:p-4">
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-yellow-400 flex-shrink-0 sm:w-5 sm:h-5">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <path d="M12 6v6l4 2"></path>
                                </svg>
                                <span class="font-bold text-blue-900 text-sm sm:text-base md:text-lg">Total Amount</span>
                            </div>
                            <span class="font-black text-blue-900 text-lg sm:text-xl md:text-2xl whitespace-nowrap">₱${total.toFixed(2)}</span>
                        </div>
                    </div>
                `;
            } else {
                summaryHTML = `
                    <div class="text-center py-8 sm:py-12">
                        <div class="shimmer w-16 h-16 sm:w-20 sm:h-20 mx-auto mb-3 sm:mb-4 rounded-full"></div>
                        <p class="text-gray-500 font-medium text-xs sm:text-sm">Loading your order...</p>
                    </div>
                `;
            }

            summaryDiv.innerHTML = summaryHTML;
        }
    }

    // Initialize and update order summary
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('confirmorder');
        if (modal) {
            // Update when modal is shown
            modal.addEventListener('click', function (e) {
                if (e.target === modal || e.target.closest('button[onclick*="confirmorder"]')) {
                    setTimeout(updateOrderSummary, 100);
                }
            });

            // Observe modal visibility changes
            const observer = new MutationObserver(function (mutations) {
                mutations.forEach(function (mutation) {
                    if (mutation.attributeName === 'open' && modal.hasAttribute('open')) {
                        updateOrderSummary();
                    }
                });
            });

            observer.observe(modal, { attributes: true });
        }

        // Update on page load
        updateOrderSummary();
    });
</script>