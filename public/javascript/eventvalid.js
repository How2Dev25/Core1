
    const EventFormValidator = {
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
            validate: (value) => {
                const checkin = new Date(document.querySelector('[name="event_checkin"]').value);
                const checkout = new Date(value);
                return checkout > checkin;
            },
            message: "Event end date must be after start date"
        },
        event_numguest: {
            required: true,
            validate: (value) => {
                const guestCount = parseInt(value);
                return !isNaN(guestCount) && guestCount >= 1;
            },
            message: "Enter a valid number of guests (minimum 1)"
        },
        event_name: {
            required: true,
            validate: (value) => value.trim().length >= 3,
            message: "Event name must be at least 3 characters"
        },
        eventorganizer_name: {
            required: true,
            validate: (value) => value.trim().length >= 2,
            message: "Full name must be at least 2 characters"
        },
        eventorganizer_phone: {
            required: true,
            validate: () => {
                const hiddenInput = document.getElementById("organizerPhoneHidden");
                return hiddenInput && hiddenInput.value !== "";
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
            validate: () => {
                return document.querySelector('[name="event_paymentmethod"]:checked') !== null;
            },
            message: "Please select a payment method"
        }
    },

    // Track which fields have been validated to prevent duplicates
    validatedFields: new Set(),

    // Initialize validation
    init() {
        this.addIntlTelInputStyles();
        this.setupIntlTelInput();
        this.setupEventListeners();
        this.setupDateValidation();
        this.updateSubmitButton();
    },

    // Set up intlTelInput for mobile number
    setupIntlTelInput() {
        const options = {
            initialCountry: "ph",
            preferredCountries: ["ph", "us", "gb"],
            geoIpLookup: (callback) => {
                fetch("https://ipapi.co/json/")
                    .then(res => res.json())
                    .then(data => callback(data.country_code))
                    .catch(() => callback("ph"));
            },
            separateDialCode: true,
            nationalMode: false,
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
        };

        const phoneInput = document.getElementById('organizerPhone');
        if (!phoneInput) return;

        const hiddenInput = document.getElementById('organizerPhoneHidden');
        if (!hiddenInput) {
            console.error('Hidden input organizerPhoneHidden not found');
            return;
        }

        // Initialize intlTelInput
        window.organizerPhoneIti = intlTelInput(phoneInput, options);

        // Single validation handler
        const validatePhone = () => {
            // Check if the input has a value first
            if (!phoneInput.value || phoneInput.value.trim() === '') {
                hiddenInput.value = "";
                this.validateField(phoneInput);
                this.updateSubmitButton();
                return;
            }

            // Only validate if there's actual input
            if (window.organizerPhoneIti.isValidNumber()) {
                hiddenInput.value = window.organizerPhoneIti.getNumber();
                this.validateField(phoneInput);
            } else {
                hiddenInput.value = "";
                this.validateField(phoneInput);
            }
            this.updateSubmitButton();
        };

        // Validate on blur and country change
        phoneInput.addEventListener('blur', validatePhone);
        phoneInput.addEventListener('countrychange', () => {
            if (phoneInput.value && phoneInput.value.trim() !== '') {
                validatePhone();
            }
        });

        // Also validate on input to provide real-time feedback
        phoneInput.addEventListener('input', () => {
            // Clear previous errors while typing
            if (phoneInput.value && phoneInput.value.trim() !== '') {
                if (window.organizerPhoneIti.isValidNumber()) {
                    hiddenInput.value = window.organizerPhoneIti.getNumber();
                    // Clear any error display
                    const errorElement = phoneInput.closest('.form-control')?.querySelector('.field-error');
                    if (errorElement) {
                        errorElement.classList.add('hidden');
                        phoneInput.classList.remove('border-red-500');
                        phoneInput.classList.add('border-gray-200');
                    }
                }
                this.updateSubmitButton();
            }
        });
    },

    // Add custom styles for intlTelInput
    addIntlTelInputStyles() {
        const style = document.createElement('style');
        style.textContent = `
            /* Fix intl-tel-input flag alignment */
            .iti {
                width: 100%;
                display: block;
                position: relative;
            }
            
            .iti__flag-container {
                position: absolute;
                top: 0;
                bottom: 0;
                left: 0;
                display: flex;
                align-items: center;
                padding: 0;
            }
            
            .iti__selected-flag {
                display: flex;
                align-items: center;
                justify-content: center;
                height: 100%;
                padding: 0 0 0 12px;
                position: relative;
            }
            
            .iti__flag {
                margin: 0 !important;
                position: relative;
                top: 0 !important;
            }
            
            .iti__selected-dial-code {
                margin-left: 6px;
                color: #4b5563;
                font-weight: 500;
            }
            
            .iti__arrow {
                margin-left: 6px;
                margin-right: 8px;
                border-left: 4px solid transparent;
                border-right: 4px solid transparent;
                border-top: 4px solid #6b7280;
            }
            
            .iti__country-list {
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
                border-radius: 12px;
                border: 1px solid #e5e7eb;
                margin-top: 4px;
                max-height: 200px;
                overflow-y: auto;
            }
            
            .iti__country {
                padding: 8px 12px;
                display: flex;
                align-items: center;
            }
            
            .iti__country:hover {
                background-color: #f3f4f6;
            }
            
            .iti__country.iti__highlight {
                background-color: #e5e7eb;
            }
            
            .iti--allow-dropdown input {
                padding-left: 100px !important;
            }
            
            /* Match your form styling */
            .iti input[type="tel"] {
                width: 100%;
                height: 3rem;
                border-radius: 0.75rem;
                border: 2px solid #e5e7eb;
                padding: 0.75rem 1rem;
                transition: border-color 0.3s;
            }
            
            .iti input[type="tel"]:focus {
                border-color: #001f54;
                outline: none;
            }
            
            .iti input[type="tel"].border-red-500 {
                border-color: #ef4444 !important;
            }
        `;
        document.head.appendChild(style);
    },

    // Set up event listeners
    setupEventListeners() {
        // Get all form inputs except the phone input (handled separately)
        const fields = document.querySelectorAll('#eventBookingForm input:not(#organizerPhone), #eventBookingForm textarea, #eventBookingForm select');
        
        fields.forEach(field => {
            // Skip hidden inputs
            if (field.type === 'hidden') return;
            
            // Validate only on blur to avoid excessive validation
            field.addEventListener('blur', () => {
                this.validateField(field);
                this.updateSubmitButton();
            });
            
            // For date and number inputs, also validate on change
            if (field.type === 'date' || field.type === 'number') {
                field.addEventListener('change', () => {
                    this.validateField(field);
                    this.updateSubmitButton();
                });
            }
        });

        // Special handling for payment method radio buttons
        document.querySelectorAll('[name="event_paymentmethod"]').forEach(radio => {
            radio.addEventListener('change', () => {
                this.validateField(radio);
                this.updateSubmitButton();
            });
        });
    },

    // Set up date validation
    setupDateValidation() {
        const checkinInput = document.getElementById('eventCheckin');
        const checkoutInput = document.getElementById('eventCheckout');

        if (checkinInput) {
            checkinInput.addEventListener('change', () => {
                // Update checkout minimum date
                if (checkoutInput && checkinInput.value) {
                    const checkinDate = new Date(checkinInput.value);
                    checkinDate.setDate(checkinDate.getDate() + 1);
                    checkoutInput.min = checkinDate.toISOString().split('T')[0];
                }
                
                // Revalidate checkout if it has a value
                if (checkoutInput && checkoutInput.value) {
                    this.validateField(checkoutInput);
                }
                this.updateSubmitButton();
            });
        }
    },

    // Validate a single field
    validateField(field) {
        // For phone input, map to the correct rule name
        const fieldName = field.id === 'organizerPhone' ? 'eventorganizer_phone' : field.name;
        const rule = this.rules[fieldName];
        if (!rule) return true;

        let isValid = true;
        let message = "";

        // Special handling for phone field
        if (field.id === 'organizerPhone') {
            isValid = rule.validate();
            if (!isValid) {
                message = rule.message;
            }
        } else if (field.type === 'radio') {
            // For radio buttons, validate using the rule's validate function
            isValid = rule.validate();
            if (!isValid) {
                message = rule.message;
            }
        } else {
            // Check if field is required and empty
            if (rule.required) {
                if (!field.value || !field.value.trim()) {
                    isValid = false;
                    message = "This field is required";
                }
            }

            // Additional validation if field has value
            if (isValid && field.value && field.value.trim()) {
                isValid = rule.validate(field.value);
                message = typeof rule.message === 'function' ? rule.message(field.value) : rule.message;
            }
        }

        // Show/hide error
        this.showError(field, isValid, message);
        
        return isValid;
    },

    // Show or hide error message
    showError(field, isValid, message) {
        // Find the parent container (form-control)
        const parentContainer = field.closest('.form-control');
        if (!parentContainer) return;

        // Find or create error element
        let errorElement = parentContainer.querySelector('.field-error');
        
        if (!errorElement) {
            errorElement = document.createElement('div');
            errorElement.className = 'field-error text-red-500 text-sm mt-1 flex items-center gap-1';
            // Append after the input field
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
            field.classList.add('border-red-500');
            field.classList.remove('border-gray-200');
        } else {
            errorElement.classList.add('hidden');
            field.classList.remove('border-red-500');
            field.classList.add('border-gray-200');
        }
    },

    // Validate all fields
    validateAllFields() {
        let allValid = true;

        // Validate each field by checking the rules
        Object.keys(this.rules).forEach(fieldName => {
            let field = document.querySelector(`[name="${fieldName}"]`);
            
            // Special case for phone field
            if (fieldName === 'eventorganizer_phone') {
                field = document.getElementById('organizerPhone');
            }
            
            if (field) {
                const isValid = this.validateField(field);
                if (!isValid) allValid = false;
            }
        });

        return allValid;
    },

    // Update submit button state
    updateSubmitButton() {
        const submitButton = document.querySelector('button[onclick*="confirm_modal_bas"]');
        const isValid = this.validateAllFields();
        
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
    }
};

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    // Wait for intl-tel-input to load
    setTimeout(() => {
        EventFormValidator.init();
    }, 100);
});

// Add form submission validation
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('eventBookingForm');
    if (form) {
        form.addEventListener('submit', (e) => {
            if (!EventFormValidator.validateAllFields()) {
                e.preventDefault();
                alert('Please fill in all required fields correctly before submitting.');
                return false;
            }
        });
    }
});
