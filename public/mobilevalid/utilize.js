
        document.addEventListener("DOMContentLoaded", () => {

            const options = {
                initialCountry: "auto",
                geoIpLookup: (callback) => {
                    fetch("https://ipapi.co/json/")
                        .then(res => res.json())
                        .then(data => callback(data.country_code))
                        .catch(() => callback("us"));
                },
                separateDialCode: true, // shows select + code
                nationalMode: false,
                utilsScript:
                    "{{ asset('mobilevalid/utils.js') }}"
            };

            const guestPhone = intlTelInput(
                document.querySelector("#guestPhone"),
                options
            );

            const contactPhone = intlTelInput(
                document.querySelector("#contactPhone"),
                options
            );

            function syncNumber(iti, hiddenInput) {
                if (iti.isValidNumber()) {
                    hiddenInput.value = iti.getNumber(); // E.164 format
                    return true;
                }
                hiddenInput.value = "";
                return false;
            }

            document.getElementById("guestPhone").addEventListener("blur", () => {
                syncNumber(guestPhone, document.getElementById("guestPhoneHidden"));
            });

            document.getElementById("contactPhone").addEventListener("blur", () => {
                syncNumber(contactPhone, document.getElementById("contactPhoneHidden"));
            });

        });
    