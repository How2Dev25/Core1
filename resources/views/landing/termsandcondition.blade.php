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
            <ul class="space-y-6 list-disc pl-6">
                <li>
                    <h4 class="font-semibold text-lg text-blue-900 mb-2">
                        General Policy
                    </h4>
            
                    <ul class="mt-3 space-y-2 pl-5 list-none">
                        <li>→ Guests must confirm their reservation on or before <strong>6:00 PM</strong> on the day of arrival.
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
        </div>

        {{-- events --}}
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