<div class="mb-5">
    <!-- Header -->
    <div class="mb-6 pb-4 border-b border-gray-200">
        <h3 class="font-bold text-2xl text-blue-900">Terms & Conditions</h3>
        <p class="text-gray-600">Soliera Hotel & Restaurant</p>
    </div>

    <!-- Content -->
    <ul class="space-y-6 list-disc pl-6">
        <li>
            <h4 class="font-semibold text-lg text-blue-900 mb-2">
                General Policy
            </h4>

            <ul class="mt-3 space-y-2 pl-5 list-none">
                <li>→ Guests must confirm their reservation on or before <strong>6:00 PM</strong> on the day of arrival.
                </li>

                    <li>→ <strong> –> Reservation Holding Policy:</strong> Pay-at-Hotel bookings are held for
                        only
                        <strong>24 hours</strong> from the time of reservation. Unconfirmed reservations will be
                        automatically
                        cancelled and the room will be released for other guests.
                    </li>
                <li>→ <strong>No-show policy:</strong> Failure to arrive without prior notice will result in a charge
                    equivalent to the first night’s stay.</li>
                <li>→ <strong>Minors policy:</strong> Minors are not allowed to check in without a parent or legal
                    guardian. This must be clearly stated and acknowledged upon booking.</li>
                <li>→ <strong>Pet-friendly policy:</strong> Pets are allowed only in designated rooms and must be
                    declared during reservation. Additional rules and charges may apply.</li>
                <li>→ <strong>Security deposit:</strong> A refundable security deposit of <strong>₱1,000</strong> is
                    required upon check-in and will be returned upon check-out, subject to room inspection.</li>
            </ul>
        </li>

        <li>
            <h4 class="font-semibold text-lg text-blue-900 mb-2">
                Booking & Cancellation
            </h4>
            <p class="text-gray-700 leading-relaxed">
                Cancellations must be made at least 24 hours prior to arrival to avoid charges.
                Late cancellations and no-shows will be charged accordingly.
            </p>
        </li>

        <li>
            <h4 class="font-semibold text-lg text-blue-900 mb-2">
                Data Privacy Act of 2012
            </h4>
            <p class="text-gray-700 leading-relaxed">
                In compliance with the <strong>Data Privacy Act of 2012 (Republic Act No. 10173)</strong>,
                Soliera Hotel & Restaurant ensures that all personal information collected is processed
                lawfully, securely, and only for legitimate purposes such as reservations, billing,
                and customer service.
            </p>
        </li>

        <li>
            <h4 class="font-semibold text-lg text-blue-900 mb-2">
                Consumer Protection
            </h4>
            <p class="text-gray-700 leading-relaxed">
                In accordance with the <strong>Consumer Act of the Philippines (Republic Act No. 7394)</strong>,
                guests are entitled to fair pricing, accurate information, and protection against
                deceptive or unfair trade practices.
            </p>
        </li>

        <li>
            <h4 class="font-semibold text-lg text-blue-900 mb-2">
                Electronic Commerce
            </h4>
            <p class="text-gray-700 leading-relaxed">
                Pursuant to the <strong>Electronic Commerce Act of 2000 (Republic Act No. 8792)</strong>,
                electronic reservations, payments, and communications made through this platform are
                legally binding and recognized.
            </p>
        </li>

        <li>
            <h4 class="font-semibold text-lg text-blue-900 mb-2">
                Guest Responsibilities
            </h4>
            <p class="text-gray-700 leading-relaxed">
                Guests are expected to comply with hotel policies, maintain proper conduct,
                and be responsible for any damages incurred during their stay.
            </p>
        </li>
    </ul>

    <div class="mt-6 flex items-center gap-3 text-left">
        <input type="checkbox" id="agreeTerms" class="checkbox checkbox-primary mt-1" onchange="toggleSubmitButton()" />
    
        <label for="agreeTerms" class="text-sm text-gray-700 cursor-pointer">
            I have read and agree to the <strong>Terms & Conditions</strong>
        </label>
    </div>
</div>

<script>
    function toggleSubmitButton() {
        const checkbox = document.getElementById('agreeTerms');
        const submitBtn = document.getElementById('submitBtn');

        if (checkbox.checked) {
            submitBtn.disabled = false;
            submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
        } else {
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
        }
    }

   
</script>