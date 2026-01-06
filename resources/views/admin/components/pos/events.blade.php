<div class="events-slider-container relative select-none mt-5">
    <div class="flex items-center justify-between mb-8">
        <h2 class="text-3xl font-bold text-gray-800 flex items-center gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#001f54"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M8 2v3M16 2v3M3 10h18M5 10v10a1 1 0 001 1h12a1 1 0 001-1V10M7 14h.01M12 14h.01M17 14h.01" />
            </svg>
            Events
        </h2>
        <p class="text-gray-600 text-sm">Book your ideal event</p>
    </div>

    <div id="eventSlider" class="events-slider flex gap-4 overflow-x-auto scroll-smooth snap-x snap-mandatory px-2 pb-2"
        style="scrollbar-width: none; -ms-overflow-style: none;">

        @forelse ($ecmtype as $eventtype)
            <div class="group flex-shrink-0 w-72 snap-start">
                <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden">

                    <div class="relative h-44 overflow-hidden">
                        <img src="{{ asset($eventtype->eventtype_photo) }}" class="w-full h-full object-cover">
                        <div
                            class="absolute top-3 right-3 bg-purple-600 text-white px-3 py-1 rounded-full text-xs font-semibold">
                            ₱{{ number_format($eventtype->eventtype_price, 2) }}
                        </div>
                    </div>

                    <div class="p-4">
                        <h3 class="text-lg font-bold line-clamp-1">{{ $eventtype->eventtype_name }}</h3>
                        <p class="text-sm text-gray-600 line-clamp-2 h-10">{{ $eventtype->eventtype_description }}</p>

                        <div class="flex items-center gap-2 text-xs text-gray-600 mb-4">
                           
                            <span class="font-medium">{{ $eventtype->eventtype_capacity }} guests</span>
                        </div>

                    <button type="button" onclick="openEventModal({{ $eventtype->eventtype_ID }})"
                        class="w-full btn btn-primary text-white px-4 py-2 rounded-lg text-sm font-semibold">
                        Book Event
                    </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="w-full text-center py-10 font-medium">No events available</div>
        @endforelse

    </div>
</div>
<style>
    .events-slider::-webkit-scrollbar {
        display: none;
    }

    .events-slider.dragging {
        scroll-snap-type: none;
    }
      
</style>




@foreach  ($ecmtype as $eventtype)
    @include('admin.components.pos.eventmodal')
@endforeach

<script>
    // Event Modal Phone Input Handler
        const EventModalPhoneInputHandler = {
            // Store initialized instances per modal
            instances: new Map(),

            // Configuration for intlTelInput
            getOptions() {
                return {
                    initialCountry: "auto",
                    geoIpLookup: (callback) => {
                        fetch("https://ipapi.co/json/")
                            .then(res => res.json())
                            .then(data => callback(data.country_code))
                            .catch(() => callback("ph"));
                    },
                    separateDialCode: true,
                    nationalMode: false,
                    utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
                    preferredCountries: ["ph", "us", "gb"],
                };
            },

            // Initialize phone input for a specific modal
            initForModal(modal) {
                if (!modal) return;

                const modalId = modal.id;

                // Check if already initialized
                if (this.instances.has(modalId)) {
                    return this.instances.get(modalId);
                }

                // Find phone input field in this modal
                const phoneInput = modal.querySelector('[name="eventorganizer_phone"]');

                if (!phoneInput) {
                    console.warn(`Phone input not found in modal ${modalId}`);
                    return null;
                }

                // Create unique ID if it doesn't have one
                if (!phoneInput.id) {
                    phoneInput.id = `eventOrganizerPhone_${modalId}`;
                }

                // Initialize intlTelInput
                const phoneIti = window.intlTelInput(phoneInput, this.getOptions());

                // Store instance
                const instances = {
                    phoneIti,
                    phoneInput
                };

                this.instances.set(modalId, instances);

                // Set up validation handlers
                this.setupValidationHandlers(modal, instances);

                return instances;
            },

            // Set up validation handlers for phone input
            setupValidationHandlers(modal, instances) {
                const { phoneIti, phoneInput } = instances;

                // Helper function to validate and sync number
                const validateAndSync = (iti, input) => {
                    if (!input.value || input.value.trim() === '') {
                        // Empty field - show required error
                        input.classList.remove('border-gray-200', 'focus:border-[#001f54]');
                        input.classList.add('border-red-500', 'focus:border-red-500');

                        let errorElement = input.parentNode.querySelector('.field-error');
                        if (!errorElement) {
                            errorElement = document.createElement('div');
                            errorElement.className = 'field-error text-red-500 text-sm mt-1 flex items-center gap-1';
                            input.parentNode.appendChild(errorElement);
                        }

                        errorElement.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                    <span>This field is required</span>
                `;
                        errorElement.classList.remove('hidden');
                        return false;
                    }

                    if (iti.isValidNumber()) {
                        // Get the full international number (E.164 format)
                        const fullNumber = iti.getNumber();
                        input.setAttribute('data-full-number', fullNumber);

                        // Remove error styling
                        input.classList.remove('border-red-500', 'focus:border-red-500');
                        input.classList.add('border-gray-200', 'focus:border-[#001f54]');

                        // Hide error message
                        const errorElement = input.parentNode.querySelector('.field-error');
                        if (errorElement) {
                            errorElement.classList.add('hidden');
                        }

                        return true;
                    } else {
                        // Invalid number
                        input.classList.remove('border-gray-200', 'focus:border-[#001f54]');
                        input.classList.add('border-red-500', 'focus:border-red-500');

                        let errorElement = input.parentNode.querySelector('.field-error');
                        if (!errorElement) {
                            errorElement = document.createElement('div');
                            errorElement.className = 'field-error text-red-500 text-sm mt-1 flex items-center gap-1';
                            input.parentNode.appendChild(errorElement);
                        }

                        errorElement.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                    <span>Please enter a valid phone number</span>
                `;
                        errorElement.classList.remove('hidden');

                        return false;
                    }
                };

                // Phone validation on blur
                phoneInput.addEventListener('blur', () => {
                    phoneInput.dataset.touched = "true";
                    validateAndSync(phoneIti, phoneInput);
                });

                // Clear errors on country change
                phoneInput.addEventListener('countrychange', () => {
                    phoneInput.classList.remove('border-red-500', 'focus:border-red-500');
                    phoneInput.classList.add('border-gray-200', 'focus:border-[#001f54]');
                    const errorElement = phoneInput.parentNode.querySelector('.field-error');
                    if (errorElement) {
                        errorElement.classList.add('hidden');
                    }
                });

                // Real-time validation while typing (but only show errors after touch)
                phoneInput.addEventListener('input', () => {
                    if (phoneInput.dataset.touched === "true" && phoneInput.value && phoneInput.value.trim() !== '') {
                        if (phoneIti.isValidNumber()) {
                            const errorElement = phoneInput.parentNode.querySelector('.field-error');
                            if (errorElement) {
                                errorElement.classList.add('hidden');
                            }
                            phoneInput.classList.remove('border-red-500');
                            phoneInput.classList.add('border-gray-200');
                        }
                    }
                });

                // Validate on form submit
                const form = modal.querySelector('form');
                if (form) {
                    form.addEventListener('submit', (e) => {
                        const isValid = validateAndSync(phoneIti, phoneInput);

                        if (!isValid) {
                            e.preventDefault();
                            e.stopPropagation();
                            phoneInput.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        }
                    }, { capture: true });
                }
            },

            // Destroy instances for a modal (cleanup)
            destroyForModal(modalId) {
                const instances = this.instances.get(modalId);
                if (!instances) return;

                if (instances.phoneIti) {
                    instances.phoneIti.destroy();
                }

                this.instances.delete(modalId);
            },

            // Reset phone input for a modal
            resetForModal(modalId) {
                const instances = this.instances.get(modalId);
                if (!instances) return;

                if (instances.phoneInput) {
                    instances.phoneInput.value = '';
                    instances.phoneInput.dataset.touched = "false";
                    instances.phoneInput.classList.remove('border-red-500', 'focus:border-red-500');
                    instances.phoneInput.classList.add('border-gray-200', 'focus:border-[#001f54]');
                }

                const modal = document.getElementById(modalId);
                if (modal) {
                    const errorElement = modal.querySelector('[name="eventorganizer_phone"]')?.parentNode?.querySelector('.field-error');
                    if (errorElement) {
                        errorElement.classList.add('hidden');
                    }
                }
            }
        };

        // Event Modal Form Validator
        const EventModalFormValidator = {
            // Store validators per modal
            modalValidators: new Map(),

            // Validation rules for each field
            rules: {
                event_checkin: {
                    required: true,
                    validate: (value) => {
                        const today = new Date();
                        today.setHours(0, 0, 0, 0);
                        const checkin = new Date(value);
                        return checkin >= today;
                    },
                    message: "Event start date cannot be in the past"
                },
                event_checkout: {
                    required: true,
                    validate: (value, form) => {
                        const checkin = form.querySelector('[name="event_checkin"]')?.value;
                        if (!checkin) return false;
                        const checkinDate = new Date(checkin);
                        const checkoutDate = new Date(value);
                        return checkoutDate > checkinDate;
                    },
                    message: "Event end date must be after start date"
                },
                event_numguest: {
                    required: true,
                    validate: (value, form, modal) => {
                        const guestCount = parseInt(value);
                        const eventtypeId = modal.id.replace('bookeventtye_', '');
                        const capacityElement = document.getElementById(`eventCapacity_${eventtypeId}`);
                        const maxCapacity = capacityElement ? parseInt(capacityElement.textContent) : Infinity;

                        return !isNaN(guestCount) && guestCount >= 1 && guestCount <= maxCapacity;
                    },
                    message: (value, form, modal) => {
                        const eventtypeId = modal.id.replace('bookeventtye_', '');
                        const capacityElement = document.getElementById(`eventCapacity_${eventtypeId}`);
                        const maxCapacity = capacityElement ? parseInt(capacityElement.textContent) : 0;
                        const guestCount = parseInt(value);

                        if (isNaN(guestCount) || guestCount < 1) {
                            return "Enter a valid number of guests (minimum 1)";
                        }
                        if (guestCount > maxCapacity) {
                            return `Maximum capacity is ${maxCapacity} guests`;
                        }
                        return "";
                    }
                },
                event_name: {
                    required: true,
                    validate: (value) => value.trim().length >= 3,
                    message: "Event name must be at least 3 characters"
                },
                eventorganizer_name: {
                    required: true,
                    validate: (value) => {
                        const trimmed = value.trim();
                        return trimmed.length >= 2 && /^[a-zA-Z\s]+$/.test(trimmed);
                    },
                    message: "Enter a valid full name (letters only, minimum 2 characters)"
                },
                eventorganizer_phone: {
                    required: true,
                    validate: (value, form, modal) => {
                        const phoneInput = form.querySelector('[name="eventorganizer_phone"]');
                        if (!phoneInput) return false;

                        const instances = EventModalPhoneInputHandler.instances.get(modal.id);
                        if (!instances) return false;

                        if (!phoneInput.value || phoneInput.value.trim() === '') return false;

                        return instances.phoneIti.isValidNumber();
                    },
                    message: "Enter a valid mobile number"
                },
                eventorganizer_email: {
                    required: true,
                    validate: (value) => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value),
                    message: "Enter a valid email address"
                },
                event_paymentmethod: {
                    required: true,
                    validate: (value, form) => {
                        return form.querySelector('[name="event_paymentmethod"]:checked') !== null;
                    },
                    message: "Please select a payment method"
                },
                event_specialrequest: {
                    required: false,
                    validate: () => true,
                    message: ""
                },
                event_equipment: {
                    required: false,
                    validate: () => true,
                    message: ""
                }
            },

            // Initialize validation for a specific modal
            initForModal(modal) {
                const eventtypeId = modal.id.replace('bookeventtye_', '');
                const form = modal.querySelector(`#eventBookingForm_${eventtypeId}`);
                if (!form) return;

                // Check if already initialized
                if (this.modalValidators.has(modal.id)) {
                    return this.modalValidators.get(modal.id);
                }

                // Create validator instance for this modal
                const validator = {
                    modal: modal,
                    form: form,
                    eventtypeId: eventtypeId,
                    initialized: false
                };

                // Store the validator
                this.modalValidators.set(modal.id, validator);

                // Set up event listeners for this modal's form
                this.setupEventListeners(validator);

                // Set up price calculation
                this.setupPriceCalculation(validator);

                // Initial validation
                this.validateAllFields(validator);
                this.updateSubmitButton(validator);

                validator.initialized = true;

                return validator;
            },

            // Set up event listeners for validation
            setupEventListeners(validator) {
                if (!validator.form) return;

                // Listen to all input changes in this form
                validator.form.querySelectorAll('input:not([type="hidden"]), textarea, select').forEach(field => {
                    const handleValidation = () => {
                        this.validateField(field, validator);
                        this.updateSubmitButton(validator);
                    };

                    field.addEventListener('input', handleValidation);
                    field.addEventListener('change', handleValidation);
                    field.addEventListener('blur', () => {
                        field.dataset.touched = "true";
                        this.validateField(field, validator);
                        this.updateSubmitButton(validator);
                    });

                    // Store reference for cleanup
                    field._validationHandler = handleValidation;
                });

                // Special handling for date changes (for price calculation)
                const checkinInput = validator.form.querySelector('[name="event_checkin"]');
                const checkoutInput = validator.form.querySelector('[name="event_checkout"]');

                if (checkinInput) {
                    checkinInput.addEventListener('change', () => {
                        if (checkoutInput && checkinInput.value) {
                            const checkinDate = new Date(checkinInput.value);
                            checkinDate.setDate(checkinDate.getDate() + 1);
                            checkoutInput.min = checkinDate.toISOString().split('T')[0];
                        }

                        if (checkoutInput && checkoutInput.value) {
                            this.validateField(checkoutInput, validator);
                        }
                        this.calculatePrice(validator);
                    });
                }

                if (checkoutInput) {
                    checkoutInput.addEventListener('change', () => {
                        this.calculatePrice(validator);
                    });
                }

                // Add form submit handler
                validator.form.addEventListener('submit', (e) => {
                    if (!this.isValid(validator)) {
                        e.preventDefault();
                        e.stopPropagation();

                        // Scroll to first error
                        const firstError = validator.form.querySelector('.field-error:not(.hidden)');
                        if (firstError) {
                            firstError.scrollIntoView({
                                behavior: 'smooth',
                                block: 'center',
                                inline: 'nearest'
                            });
                        }

                        return false;
                    }
                }, { capture: true });
            },

            // Set up price calculation
            setupPriceCalculation(validator) {
                if (!validator.form) return;

                const guestInput = validator.form.querySelector('[name="event_numguest"]');
                if (guestInput) {
                    guestInput.addEventListener('input', () => {
                        this.calculatePrice(validator);
                    });
                }
            },

            // Calculate total price
            calculatePrice(validator) {
                const form = validator.form;
                const eventtypeId = validator.eventtypeId;

                const checkinInput = form.querySelector('[name="event_checkin"]');
                const checkoutInput = form.querySelector('[name="event_checkout"]');
                const guestInput = form.querySelector('[name="event_numguest"]');
                const priceElement = document.getElementById(`eventPrice_${eventtypeId}`);
                const capacityElement = document.getElementById(`eventCapacity_${eventtypeId}`);

                if (!checkinInput?.value || !checkoutInput?.value || !priceElement) return;

                // Calculate days
                const checkin = new Date(checkinInput.value);
                const checkout = new Date(checkoutInput.value);
                const diffTime = checkout - checkin;
                const days = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                // Get base price
                const priceText = priceElement.textContent.replace(/[₱,]/g, '');
                const basePrice = parseFloat(priceText) || 0;

                // Calculate additional person fee
                let additionalFee = 0;
                const guestCount = parseInt(guestInput?.value) || 0;
                const capacity = parseInt(capacityElement?.textContent) || 0;

                if (guestCount > capacity) {
                    const extraGuests = guestCount - capacity;
                    additionalFee = extraGuests * 100 * days; // ₱100 per extra guest per day
                }

                // Calculate total
                const subtotal = basePrice * Math.max(days, 0);
                const total = subtotal + additionalFee;

                // Update UI
                const numDaysElement = document.getElementById(`numDays_${eventtypeId}`);
                const additionalFeeElement = document.getElementById(`additionalPersonFee_${eventtypeId}`);
                const totalAmountElement = document.getElementById(`totalAmount_${eventtypeId}`);
                const totalPriceInput = document.getElementById(`eventTotalPrice_${eventtypeId}`);

                if (numDaysElement) numDaysElement.textContent = Math.max(days, 0);
                if (additionalFeeElement) additionalFeeElement.textContent = `₱${additionalFee.toFixed(2)}`;
                if (totalAmountElement) totalAmountElement.textContent = `₱${total.toFixed(2)}`;
                if (totalPriceInput) totalPriceInput.value = total.toFixed(2);
            },

            // Validate a single field
            validateField(field, validator) {
                const rule = this.rules[field.name];
                if (!rule) return true;

                let isValid = true;
                let message = "";

                // Check if field is required and empty
                if (rule.required && !field.value.trim()) {
                    isValid = false;
                    message = "This field is required";
                } else if (field.value && field.value.trim()) {
                    // Validate based on rule
                    isValid = rule.validate(field.value, validator.form, validator.modal);
                    message = typeof rule.message === 'function'
                        ? rule.message(field.value, validator.form, validator.modal)
                        : rule.message;
                }

                // Show/hide error
                this.showError(field, isValid, message);

                return isValid;
            },

            // Show or hide error message
            showError(field, isValid, message) {
                if (!field || !field.parentNode) return;

                // Find or create error element
                let errorElement = field.parentNode.querySelector('.field-error');

                if (!errorElement) {
                    errorElement = document.createElement('div');
                    errorElement.className = 'field-error text-red-500 text-sm mt-1 flex items-center gap-1';
                    field.parentNode.appendChild(errorElement);
                }

                // Update error element
                if (!isValid && message) {
                    errorElement.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>
                <span>${message}</span>
            `;
                    errorElement.classList.remove('hidden');
                    field.classList.remove('border-gray-200', 'focus:border-[#001f54]');
                    field.classList.add('border-red-500', 'focus:border-red-500');
                } else {
                    errorElement.classList.add('hidden');
                    field.classList.remove('border-red-500', 'focus:border-red-500');
                    field.classList.add('border-gray-200', 'focus:border-[#001f54]');
                }
            },

            // Validate all fields in the current form
            validateAllFields(validator) {
                if (!validator.form) return false;

                let allValid = true;

                // Validate each field
                Object.keys(this.rules).forEach(fieldName => {
                    const field = validator.form.querySelector(`[name="${fieldName}"]`);
                    if (field) {
                        const isValid = this.validateField(field, validator);
                        if (!isValid) allValid = false;
                    }
                });

                return allValid;
            },

            // Update submit button state
            updateSubmitButton(validator) {
                if (!validator.form) return;

                const submitButton = validator.form.querySelector('button[type="submit"]');
                const isValid = this.validateAllFields(validator);

                if (submitButton) {
                    if (isValid) {
                        // Enable button
                        submitButton.disabled = false;
                        submitButton.classList.remove('opacity-50', 'cursor-not-allowed');
                        submitButton.classList.add('hover:bg-[#1a3470]');
                    } else {
                        // Disable button
                        submitButton.disabled = true;
                        submitButton.classList.add('opacity-50', 'cursor-not-allowed');
                        submitButton.classList.remove('hover:bg-[#1a3470]');
                    }
                }
            },

            // Get form validation status
            isValid(validator) {
                return this.validateAllFields(validator);
            },

            // Clear all validation errors for the current form
            clearAllErrors(validator) {
                if (!validator.form) return;

                validator.form.querySelectorAll('.field-error').forEach(error => {
                    error.classList.add('hidden');
                });

                validator.form.querySelectorAll('input, textarea').forEach(field => {
                    field.classList.remove('border-red-500', 'focus:border-red-500');
                    field.classList.add('border-gray-200', 'focus:border-[#001f54]');
                    field.dataset.touched = "false";
                });
            },

            // Reset the form (for when modal closes)
            resetForm(modalId) {
                const validator = this.modalValidators.get(modalId);
                if (!validator || !validator.form) return;

                // Clear all errors
                this.clearAllErrors(validator);

                // Reset submit button to disabled state
                const submitButton = validator.form.querySelector('button[type="submit"]');
                if (submitButton) {
                    submitButton.disabled = true;
                    submitButton.classList.add('opacity-50', 'cursor-not-allowed');
                    submitButton.classList.remove('hover:bg-[#1a3470]');
                }

                // Reset form values
                validator.form.reset();

                // Reset price calculation
                const eventtypeId = validator.eventtypeId;
                const numDaysElement = document.getElementById(`numDays_${eventtypeId}`);
                const additionalFeeElement = document.getElementById(`additionalPersonFee_${eventtypeId}`);
                const totalAmountElement = document.getElementById(`totalAmount_${eventtypeId}`);
                const totalPriceInput = document.getElementById(`eventTotalPrice_${eventtypeId}`);

                if (numDaysElement) numDaysElement.textContent = '0';
                if (additionalFeeElement) additionalFeeElement.textContent = '₱0.00';
                if (totalAmountElement) totalAmountElement.textContent = '₱0.00';
                if (totalPriceInput) totalPriceInput.value = '0';
            },

            // Clean up event listeners
            cleanup(modalId) {
                const validator = this.modalValidators.get(modalId);
                if (!validator || !validator.form) return;

                // Clear event listeners to prevent memory leaks
                validator.form.querySelectorAll('input, textarea, select').forEach(field => {
                    if (field._validationHandler) {
                        field.removeEventListener('input', field._validationHandler);
                        field.removeEventListener('change', field._validationHandler);
                        field.removeEventListener('blur', field._validationHandler);
                        delete field._validationHandler;
                    }
                });

                // Remove from map
                this.modalValidators.delete(modalId);
            }
        };

        // Function to open modal and initialize validation
        function openEventModal(eventtypeId) {
            const modal = document.getElementById(`bookeventtye_${eventtypeId}`);
            if (modal) {
                modal.showModal();

                // Initialize validation and phone input after a short delay
                setTimeout(() => {
                    EventModalPhoneInputHandler.initForModal(modal);
                    EventModalFormValidator.initForModal(modal);
                }, 100);
            }
        }

        // Initialize when DOM is loaded
        document.addEventListener('DOMContentLoaded', () => {
            // Watch for modal openings (using MutationObserver for <dialog> elements)
            const observer = new MutationObserver((mutations) => {
                mutations.forEach((mutation) => {
                    if (mutation.type === 'attributes' && mutation.attributeName === 'open') {
                        const modal = mutation.target;
                        if (modal.open && modal.id.startsWith('bookeventtye_')) {
                            setTimeout(() => {
                                EventModalPhoneInputHandler.initForModal(modal);
                                EventModalFormValidator.initForModal(modal);
                            }, 50);
                        }
                    }
                });
            });

            // Observe all event modal dialogs
            document.querySelectorAll('dialog[id^="bookeventtye_"]').forEach(modal => {
                observer.observe(modal, { attributes: true });
            });

            // Handle modal close via buttons
            document.addEventListener('click', (e) => {
                // Check for close button
                const closeButton = e.target.closest('button[onclick*="close"]');
                if (closeButton) {
                    const modalIdMatch = closeButton.getAttribute('onclick')?.match(/bookeventtye_(\d+)/);
                    if (modalIdMatch) {
                        const modalId = `bookeventtye_${modalIdMatch[1]}`;
                        EventModalFormValidator.resetForm(modalId);
                        EventModalPhoneInputHandler.resetForModal(modalId);
                    }
                }

                // Check for modal open button
                const openButton = e.target.closest('button[onclick*="openEventModal"]');
                if (openButton) {
                    const modalIdMatch = openButton.getAttribute('onclick')?.match(/openEventModal\((\d+)\)/);
                    if (modalIdMatch) {
                        const modalId = `bookeventtye_${modalIdMatch[1]}`;
                        const modal = document.getElementById(modalId);
                        if (modal) {
                            setTimeout(() => {
                                EventModalPhoneInputHandler.initForModal(modal);
                                EventModalFormValidator.initForModal(modal);
                            }, 100);
                        }
                    }
                }
            });

            // Handle ESC key to reset
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') {
                    const openModal = document.querySelector('dialog[open][id^="bookeventtye_"]');
                    if (openModal) {
                        EventModalFormValidator.resetForm(openModal.id);
                        EventModalPhoneInputHandler.resetForModal(openModal.id);
                    }
                }
            });
        });
</script>

<script>
    // Optimized drag handler with throttling
        class EventSlider {
            constructor(sliderId) {
                this.slider = document.getElementById(sliderId);
                this.isDown = false;
                this.startX = 0;
                this.scrollLeft = 0;
                this.moved = false;

                this.init();
            }

            init() {
                // Single event listener using delegation
                this.slider.addEventListener('mousedown', this.handleMouseDown.bind(this));
                this.slider.addEventListener('touchstart', this.handleTouchStart.bind(this));

                // Use passive listeners for better performance
                document.addEventListener('mousemove', this.handleMouseMove.bind(this), { passive: false });
                document.addEventListener('mouseup', this.handleMouseUp.bind(this));
                document.addEventListener('touchmove', this.handleTouchMove.bind(this), { passive: false });
                document.addEventListener('touchend', this.handleTouchEnd.bind(this));
            }

            handleMouseDown(e) {
                this.isDown = true;
                this.slider.classList.add('dragging');
                this.startX = e.pageX - this.slider.offsetLeft;
                this.scrollLeft = this.slider.scrollLeft;
            }

            handleMouseMove(e) {
                if (!this.isDown) return;

                e.preventDefault();
                this.moved = true;

                const x = e.pageX - this.slider.offsetLeft;
                const walk = (x - this.startX) * 1.2;
                this.slider.scrollLeft = this.scrollLeft - walk;
            }

            handleMouseUp() {
                this.isDown = false;
                this.slider.classList.remove('dragging');
                setTimeout(() => this.moved = false, 50);
            }

            handleTouchStart(e) {
                this.isDown = true;
                this.startX = e.touches[0].clientX;
                this.scrollLeft = this.slider.scrollLeft;
            }

            handleTouchMove(e) {
                if (!this.isDown) return;

                this.moved = true;
                const x = e.touches[0].clientX;
                const walk = (x - this.startX) * 1.2;
                this.slider.scrollLeft = this.scrollLeft - walk;
            }

            handleTouchEnd() {
                this.isDown = false;
                setTimeout(() => this.moved = false, 50);
            }
        }

        // Initialize slider
        document.addEventListener('DOMContentLoaded', () => {
            new EventSlider('eventSlider');
        });
</script>