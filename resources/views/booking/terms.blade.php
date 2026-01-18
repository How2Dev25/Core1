<dialog id="terms_modal" class="modal">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <div class="modal-box w-11/12 max-w-4xl bg-white">
        <!-- Header -->
        <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-200">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-blue-900 rounded-full flex items-center justify-center">
                    <i class="fas fa-hotel text-yellow-400 text-xl"></i>
                </div>
                <div>
                    <h3 class="font-bold text-2xl text-blue-900">Terms & Conditions</h3>
                    <p class="text-gray-600">Soliera Hotel & Restaurant</p>
                </div>
            </div>

        </div>

        <!-- Content -->
        <ul class="space-y-6 list-disc pl-6">
            <li>
                <h4 class="font-semibold text-lg text-blue-900 mb-2">
                    General Policy
                </h4>

                <ul class="mt-3 space-y-2 pl-5 list-none">
                    <li>→ Guests must confirm their reservation on or before <strong>6:00 PM</strong> on the day of
                        arrival.</li>

                    <li>→ <strong>Reservation Holding Policy:</strong> Pay-at-Hotel bookings are held for
                        only
                        <strong>24 hours</strong> from the time of reservation. Unconfirmed reservations will be
                        automatically
                        cancelled and the room will be released for other guests.
                    </li>

                    <li>→ <strong>No-show policy:</strong> Failure to arrive without prior notice will result in a
                        charge
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

        <!-- Footer -->
        <div class="mt-8 pt-6 border-t border-gray-200">
            <!-- Checkbox Agreement -->
            <div class="flex items-start gap-3 mb-6">
                <input type="checkbox" id="agree_terms"
                    class="checkbox checkbox-sm border-blue-900 [--chkbg:theme(colors.blue.900)] [--chkfg:theme(colors.yellow.400)]"
                    onchange="toggleAcceptButton()">
                <label for="agree_terms" class="text-sm text-gray-700 leading-relaxed cursor-pointer">
                    I have read and agree to the Terms & Conditions of Soliera Hotel & Restaurant, including the Data
                    Privacy Act compliance and all hotel policies.
                </label>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-3 justify-end">
                <button id="accept_btn" class="btn bg-gray-400 text-gray-200 btn-sm cursor-not-allowed" disabled
                    onclick="acceptTerms()">
                    <i class="fas fa-check mr-2"></i>
                    I Accept
                </button>
            </div>
        </div>
    </div>



</dialog>

<!-- Button to show modal for demo purposes -->
<div class="text-center mt-8">
    <button class="btn bg-blue-900 hover:bg-blue-800 text-white" onclick="showTermsModal()">
        <i class="fas fa-file-contract mr-2"></i>
        Show Terms & Conditions
    </button>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('terms_modal');
        const checkbox = document.getElementById('agree_terms');
        const acceptBtn = document.getElementById('accept_btn');

        // Check if terms were already accepted this session
        const accepted = sessionStorage.getItem('termsAccepted');
        if (!accepted) {
            // Show modal after a brief delay if not accepted
            setTimeout(() => {
                modal.showModal();
                modal.dispatchEvent(new Event('show'));
            }, 500);
        }

        // Animate cards when modal shows
        modal.addEventListener('show', function () {
            const cards = modal.querySelectorAll('.card');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    card.style.transition = 'all 0.3s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });

        // Toggle accept button
        checkbox.addEventListener('change', () => {
            if (checkbox.checked) {
                acceptBtn.disabled = false;
                acceptBtn.className = 'btn bg-blue-900 hover:bg-blue-800 text-white btn-sm';
                acceptBtn.innerHTML = '<i class="fas fa-check mr-2 text-yellow-400"></i>I Accept';
            } else {
                acceptBtn.disabled = true;
                acceptBtn.className = 'btn bg-gray-400 text-gray-200 btn-sm cursor-not-allowed';
                acceptBtn.innerHTML = '<i class="fas fa-check mr-2"></i>I Accept';
            }
        });

        // Accept button logic
        window.acceptTerms = function () {
            modal.close();
            sessionStorage.setItem('termsAccepted', 'true'); // ✅ Save acceptance for this tab session
            console.log('Terms accepted!');
        };

        // Prevent closing modal by clicking outside
        document.addEventListener('click', function (event) {
            const modalBox = modal.querySelector('.modal-box');
            if (modal.open && !modalBox.contains(event.target)) {
                event.stopPropagation();
                modal.showModal(); // Keep it open
            }
        });
    });

    // Manually open modal (for testing)
    function showTermsModal() {
        const modal = document.getElementById('terms_modal');
        modal.showModal();
        modal.dispatchEvent(new Event('show'));
    }
</script>