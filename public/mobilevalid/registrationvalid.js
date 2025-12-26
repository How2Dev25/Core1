document.addEventListener("DOMContentLoaded", () => {

    const contactInput = document.querySelector("#contactPhone");
    const hiddenInput  = document.querySelector("#guest_mobile");
    const errorText    = document.querySelector("#phoneError");
    const exampleText  = document.querySelector("#phoneExample");

    const iti = intlTelInput(contactInput, {
        initialCountry: "auto",
        geoIpLookup: (callback) => {
            fetch("https://ipapi.co/json/")
                .then(res => res.json())
                .then(data => callback(data.country_code))
                .catch(() => callback("us"));
        },
        separateDialCode: true,
        nationalMode: false,
        utilsScript: "{{ asset('mobilevalid/utils.js') }}"
    });

    // 🔹 Show example number per country
    function updateExample() {
        const example = iti.getNumberPlaceholder();
        exampleText.textContent = example
            ? `Example: ${example}`
            : "";
    }

    // 🔹 Validate + sync hidden input
    function validatePhone() {
        if (contactInput.value.trim() === "") {
            errorText.classList.add("hidden");
            hiddenInput.value = "";
            return false;
        }

        if (iti.isValidNumber()) {
            hiddenInput.value = iti.getNumber(); // E.164
            errorText.classList.add("hidden");
            return true;
        }

        hiddenInput.value = "";
        errorText.classList.remove("hidden");
        return false;
    }

    // 🔹 Digit limit enforcement
    contactInput.addEventListener("input", () => {
        const maxLength = iti.getSelectedCountryData().example?.replace(/\D/g, "").length;
        if (maxLength && contactInput.value.replace(/\D/g, "").length > maxLength) {
            contactInput.value = contactInput.value.slice(0, contactInput.value.length - 1);
        }
        validatePhone();
    });

    // 🔹 Update example when country changes
    contactInput.addEventListener("countrychange", updateExample);

    // 🔹 Initial example
    updateExample();

    // 🔹 Validate before submit
    contactInput.closest("form")?.addEventListener("submit", (e) => {
        if (!validatePhone()) {
            e.preventDefault();
            contactInput.focus();
        }
    });

});
