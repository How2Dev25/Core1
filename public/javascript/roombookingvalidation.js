
const FormValidator = {
    // Validation rules for each field
    rules: {
        reservation_checkin: {
            required: true,
            validate: (value) => {
                const today = new Date();
                today.setHours(0, 0, 0, 0);
                const checkin = new Date(value);
                return checkin >= today;
            },
            message: "Check-in date cannot be in the past"
        },
        reservation_checkout: {
            required: true,
            validate: (value) => {
                const checkin = new Date(document.querySelector('[name="reservation_checkin"]').value);
                const checkout = new Date(value);
                return checkout > checkin;
            },
            message: "Check-out date must be after check-in date"
        },
        reservation_numguest: {
            required: true,
            validate: (value) => {
                const guestCount = parseInt(value);
                const selectedRoomMaxGuest = window.selectedRoomMaxGuest || 0;
                return !isNaN(guestCount) && guestCount >= 1 && guestCount <= (selectedRoomMaxGuest + 2);
            },
            message: (value) => {
                const guestCount = parseInt(value);
                const selectedRoomMaxGuest = window.selectedRoomMaxGuest || 0;
                if (isNaN(guestCount) || guestCount < 1) return "Enter valid number of guests";
                if (guestCount > selectedRoomMaxGuest + 2) return `Maximum ${selectedRoomMaxGuest + 2} guests allowed`;
                return "";
            }
        },
        guestname: {
            required: true,
            validate: (value) => value.trim().length >= 2,
            message: "Full name must be at least 2 characters"
        },
        guestbirthday: {
            required: true,
            validate: (value) => {
                const birthDate = new Date(value);
                const today = new Date();
                let age = today.getFullYear() - birthDate.getFullYear();
                const m = today.getMonth() - birthDate.getMonth();
                if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) age--;
                return age >= 18;
            },
            message: "You must be at least 18 years old"
        },
       guestphonenumber: {
  required: true,
  validate: () =>
    document.getElementById("guestPhoneHidden").value !== "",
  message: "Enter a valid mobile number"
},      
        guestemailaddress: {
            required: true,
            validate: (value) => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value),
            message: "Enter a valid email address"
        },
        guestaddress: {
            required: true,
            validate: (value) => value.trim().length >= 5,
            message: "Address must be at least 5 characters"
        },
        guestcontactperson: {
            required: true,
            validate: (value) => value.trim().length >= 2,
            message: "Contact person name is required"
        },
        guestcontactpersonnumber: {
  required: true,
  validate: () =>
    document.getElementById("contactPhoneHidden").value !== "",
  message: "Enter a valid contact number"
},
        reservation_validID: {
            required: true,
            validate: (input) => {
                if (!input.files || input.files.length === 0) return false;
                const file = input.files[0];
                const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'application/pdf'];
                const maxSize = 5 * 1024 * 1024; // 5MB
                return validTypes.includes(file.type) && file.size <= maxSize;
            },
            message: (input) => {
                if (!input.files || input.files.length === 0) return "Valid ID is required";
                const file = input.files[0];
                const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'application/pdf'];
                const maxSize = 5 * 1024 * 1024;
                
                if (!validTypes.includes(file.type)) return "Only JPG, PNG, PDF files allowed";
                if (file.size > maxSize) return "File size must be less than 5MB";
                return "";
            }
        }
    },

    // Initialize validation
    init() {
        // Store global room variables
        window.selectedRoomMaxGuest = window.selectedRoomMaxGuest || 0;
        
        // Set up event listeners for all form fields
        this.setupEventListeners();
        
        // Initial validation
        this.validateAllFields();
        
        // Override your existing selectRoom function to include validation
        this.overrideSelectRoom();
    },

    // Set up event listeners for validation
    setupEventListeners() {
        // Listen to all input changes
        document.querySelectorAll('input, textarea, select').forEach(field => {
            field.addEventListener('input', () => {
                this.validateField(field);
                this.updateSubmitButton();
            });
            
            field.addEventListener('change', () => {
                this.validateField(field);
                this.updateSubmitButton();
            });
            
            field.addEventListener('blur', () => {
                this.validateField(field);
                this.updateSubmitButton();
            });
        });

        // Special handling for file input
        const fileInput = document.querySelector('[name="reservation_validID"]');
        if (fileInput) {
            fileInput.addEventListener('change', () => {
                this.validateField(fileInput);
                this.updateSubmitButton();
            });
        }

        // Listen to room selection changes
        document.addEventListener('roomSelected', () => {
            this.validateField(document.querySelector('[name="reservation_numguest"]'));
            this.updateSubmitButton();
        });
    },

    // Override the existing selectRoom function to trigger validation
    overrideSelectRoom() {
        const originalSelectRoom = window.selectRoom;
        
        window.selectRoom = function(cardElement, roomID, roomPrice, roomMaxGuest) {
            // Call original function
            originalSelectRoom.call(this, cardElement, roomID, roomPrice, roomMaxGuest);
            
            // Update global variable
            window.selectedRoomMaxGuest = roomMaxGuest;
            
            // Trigger validation event
            document.dispatchEvent(new Event('roomSelected'));
        };
    },

    // Validate a single field
    validateField(field) {
        const rule = this.rules[field.name];
        if (!rule) return true;

        let isValid = true;
        let message = "";

        // Check if field is required and empty
        if (rule.required && !field.value.trim() && field.type !== 'file') {
            isValid = false;
            message = "This field is required";
        } else if (field.type === 'file') {
            // Special handling for file inputs
            isValid = rule.validate(field);
            message = typeof rule.message === 'function' ? rule.message(field) : rule.message;
        } else {
            // Validate based on rule
            isValid = rule.validate(field.value);
            message = typeof rule.message === 'function' ? rule.message(field.value) : rule.message;
        }

        // Show/hide error
        this.showError(field, isValid, message);
        
        return isValid;
    },

    // Show or hide error message
    showError(field, isValid, message) {
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
        
        // Check if room is selected
        if (!document.getElementById('selectedRoomID').value) {
            allValid = false;
            this.showRoomSelectionError();
        }

        // Validate each field
        Object.keys(this.rules).forEach(fieldName => {
            const field = document.querySelector(`[name="${fieldName}"]`);
            if (field) {
                const isValid = this.validateField(field);
                if (!isValid) allValid = false;
            }
        });

        return allValid;
    },

    // Show error for room selection
    showRoomSelectionError() {
        const roomSection = document.querySelector('.bg-white\\/95.backdrop-blur-md.rounded-3xl.p-6');
        let errorElement = roomSection.querySelector('.room-error');
        
        if (!errorElement) {
            errorElement = document.createElement('div');
            errorElement.className = 'room-error text-red-500 text-sm mt-2 flex items-center gap-1';
            roomSection.querySelector('.flex.items-center.gap-4.mb-4').appendChild(errorElement);
        }
        
        errorElement.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="12" y1="8" x2="12" y2="12"></line>
                <line x1="12" y1="16" x2="12.01" y2="16"></line>
            </svg>
            <span>Please select a room to continue</span>
        `;
    },

    // Update submit button state
    updateSubmitButton() {
        const submitButton = document.querySelector('button[onclick*="confirm_modal_bas2"]');
        const isValid = this.validateAllFields();
        
        if (submitButton) {
            if (isValid) {
                // Enable button
                submitButton.disabled = false;
                submitButton.classList.remove('btn-disabled', 'opacity-50', 'cursor-not-allowed');
                submitButton.classList.add('btn-primary');
                submitButton.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 6L9 17l-5-5"></path>
                    </svg>
                    Confirm Reservation
                `;
            } else {
                // Disable button
                submitButton.disabled = true;
                submitButton.classList.add('btn-disabled', 'opacity-50', 'cursor-not-allowed');
                submitButton.classList.remove('btn-primary');
                submitButton.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                    Complete All Required Fields
                `;
            }
        }
    },

    // Format mobile number to +63 format
    formatMobileNumber(field) {
        let value = field.value.trim();
        const cleaned = value.replace(/\D/g, '');
        
        if (value.startsWith('+63')) {
            // Already in correct format, ensure it has 10 digits after +63
            if (cleaned.length === 12) return value;
        } else if (value.startsWith('63') && !value.startsWith('+')) {
            // Convert 639XXXXXXXXX to +639XXXXXXXXX
            if (cleaned.length === 11) field.value = `+${cleaned}`;
        } else if (value.startsWith('0')) {
            // Convert 09XXXXXXXXX to +639XXXXXXXXX
            if (cleaned.length === 11) field.value = `+63${cleaned.substring(1)}`;
        } else if (value.match(/^9/)) {
            // Convert 9XXXXXXXXX to +639XXXXXXXXX
            if (cleaned.length === 10) field.value = `+63${cleaned}`;
        }
    }
};

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    // Add auto-formatting for mobile numbers on blur
    document.querySelectorAll('[name="guestphonenumber"], [name="guestcontactpersonnumber"]').forEach(field => {
        field.addEventListener('blur', () => {
            FormValidator.formatMobileNumber(field);
            FormValidator.validateField(field);
        });
        
        // Add placeholder text
        field.placeholder = "+639XXXXXXXXX or 09XXXXXXXXX";
    });
    
    // Initialize the form validator
    FormValidator.init();
    
    // Initial button state
    FormValidator.updateSubmitButton();
});
