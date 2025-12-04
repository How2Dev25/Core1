<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite('resources/css/app.css')

    <script src="https://unpkg.com/lucide@latest"></script>

    <title>{{$title}} - Select A Room</title>
</head>

<body>
    @include('booking.component.nav');

    <section class="container mx-auto px-4 py-8 mt-10">

        <div class="">
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
            <div class="space-y-6   pr-2">
                <!-- Section 1 -->
                <div class="card bg-blue-50 border border-blue-100">
                    <div class="card-body p-6">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 bg-blue-900 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-clock text-yellow-400"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg text-blue-900 mb-3">1. General Policy</h4>
                                <p class="text-gray-700 leading-relaxed">
                                    Guests are required to <strong>confirm their reservation on or before 6:00 PM</strong>
                                    on the day of arrival. Failure to confirm by this time may result in the automatic
                                    cancellation of the booking. Guests will be <em>notified prior to any cancellation</em>
                                    for proper acknowledgment.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            
                <!-- Section 2 -->
                <div class="card bg-blue-50 border border-blue-100">
                    <div class="card-body p-6">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 bg-blue-900 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-calendar-times text-yellow-400"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg text-blue-900 mb-3">2. Booking & Cancellation</h4>
                                <p class="text-gray-700 leading-relaxed">
                                    Cancellations must be made at least 24 hours prior to arrival to avoid charges. No-shows
                                    will be charged the first night's stay.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            
                <!-- Section 3 -->
                <div class="card bg-yellow-50 border border-yellow-200">
                    <div class="card-body p-6">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 bg-blue-900 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-shield-alt text-yellow-400"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg text-blue-900 mb-3">3. Data Privacy Act of 2012</h4>
                                <p class="text-gray-700 leading-relaxed">
                                    In compliance with the <strong>Data Privacy Act of 2012 (Republic Act No.
                                        10173)</strong>, Soliera Hotel & Restaurant is committed to protecting the personal
                                    information of our guests. All personal data provided will be <em>collected, processed,
                                        and stored securely</em> and will only be used for legitimate purposes such as
                                    reservations, billing, and customer service. Your information will not be shared with
                                    third parties without your consent, except when required by law.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            
                <!-- Section 4 - Consumer Protection -->
                <div class="card bg-yellow-50 border border-yellow-200">
                    <div class="card-body p-6">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 bg-blue-900 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-user-shield text-yellow-400"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg text-blue-900 mb-3">4. Consumer Protection</h4>
                                <p class="text-gray-700 leading-relaxed">
                                    In line with the <strong>Consumer Act of the Philippines (Republic Act No.
                                        7394)</strong>,
                                    Soliera Hotel & Restaurant upholds fair trade practices and ensures the safety and
                                    quality of its services.
                                    Guests have the right to accurate information, fair pricing, and protection against
                                    deceptive, unfair, or unconscionable sales practices.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            
                <!-- Section 5 - Electronic Commerce -->
                <div class="card bg-yellow-50 border border-yellow-200">
                    <div class="card-body p-6">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 bg-blue-900 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-laptop text-yellow-400"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg text-blue-900 mb-3">5. Electronic Commerce</h4>
                                <p class="text-gray-700 leading-relaxed">
                                    In accordance with the <strong>Electronic Commerce Act of 2000 (Republic Act No.
                                        8792)</strong>,
                                    Soliera Hotel & Restaurant recognizes the validity and enforceability of electronic
                                    transactions.
                                    Online reservations, payments, and communications conducted through our platform are
                                    considered legally binding and secure.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            
                <!-- Section 6 - Guest Responsibilities -->
                <div class="card bg-blue-50 border border-blue-100">
                    <div class="card-body p-6">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 bg-blue-900 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-user-check text-yellow-400"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg text-blue-900 mb-3">6. Guest Responsibilities</h4>
                                <p class="text-gray-700 leading-relaxed">
                                    Guests are expected to conduct themselves respectfully and follow hotel rules.
                                    Damages caused will be charged accordingly.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="mt-5">
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
            <div class="space-y-6 pr-2">
                <!-- Section 1 - Booking & Confirmation -->
                <div class="card bg-indigo-50 border border-indigo-100">
                    <div class="card-body p-6">
                        <div class="flex items-start gap-4">
                            <div
                                class="w-10 h-10 bg-gradient-to-br from-indigo-600 to-indigo-700 rounded-full flex items-center justify-center flex-shrink-0 shadow-md">
                                <i class="fas fa-clipboard-check text-white"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg text-indigo-900 mb-3">1. Event Booking & Confirmation Policy
                                </h4>
                                <p class="text-gray-700 leading-relaxed mb-2">
                                    All event bookings must be <strong>confirmed at least 72 hours prior to the scheduled
                                        date</strong>.
                                    Clients are required to submit final guest counts and special requirements <strong>48
                                        hours before the event</strong>.
                                </p>
                                <p class="text-gray-700 leading-relaxed">
                                    A <strong>non-refundable deposit of 30%</strong> is required upon booking confirmation.
                                    Failure to provide final confirmation may result in automatic cancellation with
                                    <em>prior notification to the client</em>.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            
                <!-- Section 2 - Cancellation & Rescheduling -->
                <div class="card bg-indigo-50 border border-indigo-100">
                    <div class="card-body p-6">
                        <div class="flex items-start gap-4">
                            <div
                                class="w-10 h-10 bg-gradient-to-br from-indigo-600 to-indigo-700 rounded-full flex items-center justify-center flex-shrink-0 shadow-md">
                                <i class="fas fa-calendar-times text-white"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg text-indigo-900 mb-3">2. Cancellation & Rescheduling Policy
                                </h4>
                                <ul class="text-gray-700 leading-relaxed space-y-2">
                                    <li>• <strong>30+ days before event:</strong> Full refund minus deposit</li>
                                    <li>• <strong>15-29 days before event:</strong> 50% refund of total booking</li>
                                    <li>• <strong>7-14 days before event:</strong> 25% refund of total booking</li>
                                    <li>• <strong>Less than 7 days:</strong> No refund, full payment required</li>
                                </ul>
                                <p class="text-gray-700 leading-relaxed mt-3">
                                    Rescheduling is allowed <strong>once without penalty</strong> if done at least 14 days
                                    prior to the original date.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            
                <!-- Section 3 - Payment Terms -->
                <div class="card bg-purple-50 border border-purple-100">
                    <div class="card-body p-6">
                        <div class="flex items-start gap-4">
                            <div
                                class="w-10 h-10 bg-gradient-to-br from-indigo-600 to-indigo-700 rounded-full flex items-center justify-center flex-shrink-0 shadow-md">
                                <i class="fas fa-credit-card text-white"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg text-indigo-900 mb-3">3. Payment Terms & Conditions</h4>
                                <p class="text-gray-700 leading-relaxed">
                                    <strong>30% deposit</strong> upon booking confirmation, <strong>40% payment</strong> one
                                    week before the event,
                                    and <strong>30% final payment</strong> on or before the event day. All payments must be
                                    settled before the event commences.
                                    Additional charges for services beyond the package will be billed separately.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            
                <!-- Section 4 - Venue & Equipment -->
                <div class="card bg-indigo-50 border border-indigo-100">
                    <div class="card-body p-6">
                        <div class="flex items-start gap-4">
                            <div
                                class="w-10 h-10 bg-gradient-to-br from-indigo-600 to-indigo-700 rounded-full flex items-center justify-center flex-shrink-0 shadow-md">
                                <i class="fas fa-building text-white"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg text-indigo-900 mb-3">4. Venue & Equipment Usage</h4>
                                <p class="text-gray-700 leading-relaxed">
                                    Clients are responsible for any <strong>damage to venue facilities, furniture, or
                                        equipment</strong> during the event.
                                    Setup and breakdown times are included in the booking period. External suppliers must be
                                    pre-approved by management.
                                    The venue must be used only for the <em>stated purpose</em> in the booking agreement.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            
                <!-- Section 5 - Data Privacy Act -->
                <div class="card bg-amber-50 border border-amber-200">
                    <div class="card-body p-6">
                        <div class="flex items-start gap-4">
                            <div
                                class="w-10 h-10 bg-gradient-to-br from-indigo-600 to-indigo-700 rounded-full flex items-center justify-center flex-shrink-0 shadow-md">
                                <i class="fas fa-shield-alt text-white"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg text-indigo-900 mb-3">5. Data Privacy Act of 2012 Compliance
                                </h4>
                                <p class="text-gray-700 leading-relaxed">
                                    In compliance with the <strong>Data Privacy Act of 2012 (Republic Act No.
                                        10173)</strong>,
                                    Soliera Hotel & Restaurant is committed to protecting the personal information of event
                                    organizers and attendees.
                                    All personal data provided will be <em>collected, processed, and stored securely</em>
                                    and will only be used for
                                    legitimate purposes such as event coordination, billing, catering arrangements, and
                                    guest services.
                                    Your information will not be shared with third parties without your consent, except when
                                    required by law.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            
                <!-- Section 6 - Consumer Protection -->
                <div class="card bg-amber-50 border border-amber-200">
                    <div class="card-body p-6">
                        <div class="flex items-start gap-4">
                            <div
                                class="w-10 h-10 bg-gradient-to-br from-indigo-600 to-indigo-700 rounded-full flex items-center justify-center flex-shrink-0 shadow-md">
                                <i class="fas fa-user-shield text-white"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg text-indigo-900 mb-3">6. Consumer Protection Rights</h4>
                                <p class="text-gray-700 leading-relaxed">
                                    In line with the <strong>Consumer Act of the Philippines (Republic Act No.
                                        7394)</strong>,
                                    Soliera Hotel & Restaurant upholds fair trade practices and ensures the safety and
                                    quality of its event services.
                                    Clients have the right to accurate information about event packages, fair and
                                    transparent pricing,
                                    and protection against deceptive, unfair, or unconscionable sales practices.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            
                <!-- Section 7 - Electronic Commerce -->
                <div class="card bg-amber-50 border border-amber-200">
                    <div class="card-body p-6">
                        <div class="flex items-start gap-4">
                            <div
                                class="w-10 h-10 bg-gradient-to-br from-indigo-600 to-indigo-700 rounded-full flex items-center justify-center flex-shrink-0 shadow-md">
                                <i class="fas fa-laptop text-white"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg text-indigo-900 mb-3">7. Electronic Commerce Act Compliance
                                </h4>
                                <p class="text-gray-700 leading-relaxed">
                                    In accordance with the <strong>Electronic Commerce Act of 2000 (Republic Act No.
                                        8792)</strong>,
                                    Soliera Hotel & Restaurant recognizes the validity and enforceability of electronic
                                    transactions.
                                    Online event bookings, digital contracts, electronic payments, and email communications
                                    conducted through
                                    our platform are considered legally binding and secure under Philippine law.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            
                <!-- Section 8 - Force Majeure -->
                <div class="card bg-indigo-50 border border-indigo-100">
                    <div class="card-body p-6">
                        <div class="flex items-start gap-4">
                            <div
                                class="w-10 h-10 bg-gradient-to-br from-indigo-600 to-indigo-700 rounded-full flex items-center justify-center flex-shrink-0 shadow-md">
                                <i class="fas fa-exclamation-triangle text-white"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg text-indigo-900 mb-3">8. Force Majeure & Unforeseen
                                    Circumstances</h4>
                                <p class="text-gray-700 leading-relaxed">
                                    In cases of <strong>natural disasters, government restrictions, pandemics, or other
                                        force majeure events</strong>,
                                    both parties will work together to reschedule the event. Full payment will be credited
                                    toward the new date.
                                    If rescheduling is not possible within 12 months, a <em>refund minus administrative
                                        costs</em> will be provided.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            
                <!-- Section 9 - Client & Attendee Responsibilities -->
                <div class="card bg-indigo-50 border border-indigo-100">
                    <div class="card-body p-6">
                        <div class="flex items-start gap-4">
                            <div
                                class="w-10 h-10 bg-gradient-to-br from-indigo-600 to-indigo-700 rounded-full flex items-center justify-center flex-shrink-0 shadow-md">
                                <i class="fas fa-users text-white"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg text-indigo-900 mb-3">9. Client & Attendee Responsibilities
                                </h4>
                                <p class="text-gray-700 leading-relaxed">
                                    Event organizers and attendees are expected to conduct themselves professionally and
                                    respectfully.
                                    The client is responsible for the behavior of all event attendees. Any violations of
                                    hotel policies,
                                    <strong>disturbances, or damages</strong> will be charged to the event organizer.
                                    Compliance with fire safety, capacity limits, and noise ordinances is mandatory.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            
                <!-- Section 10 - Liability Waiver -->
                <div class="card bg-indigo-50 border border-indigo-100">
                    <div class="card-body p-6">
                        <div class="flex items-start gap-4">
                            <div
                                class="w-10 h-10 bg-gradient-to-br from-indigo-600 to-indigo-700 rounded-full flex items-center justify-center flex-shrink-0 shadow-md">
                                <i class="fas fa-file-contract text-white"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg text-indigo-900 mb-3">10. Liability & Insurance</h4>
                                <p class="text-gray-700 leading-relaxed">
                                    Soliera Hotel & Restaurant is not liable for <strong>loss, theft, or damage to personal
                                        property</strong>
                                    brought to the venue. For large-scale events, clients are advised to secure event
                                    insurance.
                                    The venue maintains general liability coverage but clients are responsible for securing
                                    additional coverage as needed.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




    </section>

  
    @include('landing.footer')




</body>

<script type="module">
    import lucide from 'https://unpkg.com/lucide@latest/dist/esm/lucide.js';
    lucide.createIcons();
</script>


@include('javascriptfix.soliera_js')

<script src="{{asset('javascript/photouploadglobal.js')}}"></script>

</html>