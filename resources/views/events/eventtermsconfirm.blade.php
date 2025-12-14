<div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-200">
    <div class="flex items-center gap-3">
        <div
            class="w-12 h-12 bg-gradient-to-br from-indigo-600 to-indigo-700 rounded-full flex items-center justify-center shadow-lg">
            <i class="fas fa-calendar-check text-white text-xl"></i>
        </div>
        <div>
            <h3 class="font-bold text-2xl text-indigo-900">Event & Conference Terms</h3>
            <p class="text-gray-600">Soliera Hotel & Restaurant</p>
        </div>
    </div>
</div>

<!-- Content -->
<div class="max-h-[70vh] overflow-y-auto pr-2">
    <ul class="space-y-6 list-disc pl-6 text-gray-700">

        <li>
            <h4 class="font-semibold text-lg text-indigo-900 mb-2">
                Event Booking & Confirmation Policy
            </h4>
            <p>
                All event bookings must be confirmed at least <strong>72 hours</strong> prior to the scheduled date.
                Final guest counts and special requirements must be submitted <strong>48 hours</strong> before the
                event.
            </p>
            <p class="mt-2">
                A <strong>non-refundable 30% deposit</strong> is required upon confirmation.
                Failure to provide final confirmation may result in cancellation with prior notice.
            </p>
        </li>

        <li>
            <h4 class="font-semibold text-lg text-indigo-900 mb-2">
                Cancellation & Rescheduling Policy
            </h4>
            <ul class="list-none pl-4 space-y-1">
                <li>→ 30+ days before event: Full refund minus deposit</li>
                <li>→ 15–29 days before event: 50% refund</li>
                <li>→ 7–14 days before event: 25% refund</li>
                <li>→ Less than 7 days: No refund</li>
            </ul>
            <p class="mt-2">
                One reschedule is allowed without penalty if done at least 14 days before the event date.
            </p>
        </li>

        <li>
            <h4 class="font-semibold text-lg text-indigo-900 mb-2">
                Payment Terms
            </h4>
            <p>
                A 30% deposit is required upon booking, 40% payment one week before the event,
                and the remaining 30% on or before the event day. All charges must be settled prior to event
                commencement.
            </p>
        </li>

        <li>
            <h4 class="font-semibold text-lg text-indigo-900 mb-2">
                Venue & Equipment Usage
            </h4>
            <p>
                Clients are responsible for any damage to venue facilities, furniture, or equipment.
                External suppliers must be pre-approved by management.
            </p>
        </li>

        <li>
            <h4 class="font-semibold text-lg text-indigo-900 mb-2">
                Data Privacy Act of 2012
            </h4>
            <p>
                In compliance with Republic Act No. 10173, all personal information will be collected,
                processed, and stored securely for legitimate event-related purposes only.
            </p>
        </li>

        <li>
            <h4 class="font-semibold text-lg text-indigo-900 mb-2">
                Consumer Protection
            </h4>
            <p>
                In accordance with Republic Act No. 7394, clients are entitled to fair pricing,
                accurate information, and protection against unfair trade practices.
            </p>
        </li>

        <li>
            <h4 class="font-semibold text-lg text-indigo-900 mb-2">
                Electronic Commerce Act
            </h4>
            <p>
                Electronic bookings, payments, and communications are legally binding under Republic Act No. 8792.
            </p>
        </li>

        <li>
            <h4 class="font-semibold text-lg text-indigo-900 mb-2">
                Force Majeure
            </h4>
            <p>
                Events affected by natural disasters, pandemics, or government restrictions may be rescheduled.
                Payments will be credited toward a future date or refunded minus administrative costs if rescheduling is
                not possible.
            </p>
        </li>

        <li>
            <h4 class="font-semibold text-lg text-indigo-900 mb-2">
                Client & Attendee Responsibilities
            </h4>
            <p>
                Clients are responsible for attendee conduct, compliance with safety regulations,
                and any damages incurred during the event.
            </p>
        </li>

        <li>
            <h4 class="font-semibold text-lg text-indigo-900 mb-2">
                Liability & Insurance
            </h4>
            <p>
                Soliera Hotel & Restaurant is not liable for loss or damage to personal property.
                Clients are encouraged to secure appropriate event insurance.
            </p>
        </li>

    </ul>

    <div class="flex items-start gap-3 mb-6 text-left">
        <input type="checkbox" id="agreeTerms2" class="checkbox checkbox-primary mt-1" onchange="toggleSubmitBtn2()">
        <label for="agreeTerms2" class="text-sm text-gray-700 cursor-pointer">
            I have read and agree to the <strong>Terms & Conditions</strong>
        </label>
    </div>

</div>

<script>
    function toggleSubmitBtn2() {
        const checkbox = document.getElementById('agreeTerms2');
        const submitBtn = document.getElementById('submitBtn');

        submitBtn.disabled = !checkbox.checked;
    }
</script>