<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">


  @vite('resources/css/app.css')

  <script src="https://unpkg.com/lucide@latest"></script>

  <title>{{$title}} - Success</title>


</head>



<style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

  body {
    font-family: 'Poppins', sans-serif;
    background-color: #f8fafc;
  }

  .confetti {
    position: fixed;
    width: 10px;
    height: 10px;
    opacity: 0;
    z-index: 10;
  }

  .checkmark {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: block;
    stroke-width: 5;
    stroke: #fff;
    stroke-miterlimit: 10;
    box-shadow: 0 0 20px rgba(76, 175, 80, 0.3);
    animation: fill 0.4s ease-in-out 0.4s forwards, scale 0.3s ease-in-out 0.9s both;
  }

  .checkmark-circle {
    stroke-dasharray: 166;
    stroke-dashoffset: 166;
    stroke-width: 5;
    stroke-miterlimit: 10;
    stroke: #4CAF50;
    fill: none;
    animation: stroke 0.6s cubic-bezier(0.650, 0.000, 0.450, 1.000) forwards;
  }

  .checkmark-check {
    transform-origin: 50% 50%;
    stroke-dasharray: 48;
    stroke-dashoffset: 48;
    animation: stroke 0.3s cubic-bezier(0.650, 0.000, 0.450, 1.000) 0.8s forwards;
  }

  @keyframes stroke {
    100% {
      stroke-dashoffset: 0;
    }
  }

  @keyframes scale {

    0%,
    100% {
      transform: none;
    }

    50% {
      transform: scale3d(1.1, 1.1, 1);
    }
  }

  @keyframes fill {
    100% {
      box-shadow: inset 0px 0px 0px 50px #4CAF50;
    }
  }
</style>


<body>


  @include('booking.component.nav')
  <div id="confirmation-section" class="">
    <section class="bg-gray-50 min-h-screen flex items-center justify-center p-4 mt-10">
      <div
        class="max-w-6xl w-full mt-10 bg-white/95 backdrop-blur-md rounded-2xl shadow-xl overflow-hidden border border-white/20">

        <!-- Header -->
        <div class="bg-gradient-to-r from-[#001f54] to-[#1a3470] p-6 text-white text-center relative">
          <h1 class="text-2xl md:text-3xl font-bold">Booking Success!</h1>
          <p class="text-white/80 text-sm md:text-lg">Thank you for choosing us for your stay</p>
        </div>

        <!-- Grid Content -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 p-6">

          <!-- Left Column: Booking Details -->
          <div class="space-y-6">
            <div class="bg-gradient-to-br from-gray-50 to-blue-50 rounded-xl p-6 border shadow">
              <h2 class="text-xl font-bold text-[#001f54] mb-4">Booking Details</h2>
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="bg-white p-4 rounded-lg border shadow-sm">
                  <p class="text-sm text-gray-500">Booking ID</p>
                  <p class="font-bold text-[#001f54]">#{{ $reservation->bookingID }}</p>
                </div>
                <div class="bg-white p-4 rounded-lg border shadow-sm">
                  <p class="text-sm text-gray-500">Room</p>
                  <p class="font-bold text-[#001f54]">#{{ $reservation->roomID }}</p>
                </div>
                <div class="bg-white p-4 rounded-lg border shadow-sm">
                  <p class="text-sm text-gray-500">Check-in</p>
                  <p class="font-bold text-green-600">
                    {{ \Carbon\Carbon::parse($reservation->reservation_checkin)->format('M d, Y') }}
                  </p>
                </div>
                <div class="bg-white p-4 rounded-lg border shadow-sm">
                  <p class="text-sm text-gray-500">Check-out</p>
                  <p class="font-bold text-orange-600">
                    {{ \Carbon\Carbon::parse($reservation->reservation_checkout)->format('M d, Y') }}
                  </p>
                </div>
                <div class="bg-white p-4 rounded-lg border shadow-sm sm:col-span-2">
                  <p class="text-sm text-gray-500">Guest Name</p>
                  <p class="font-bold text-blue-600">{{ $reservation->guestname }}</p>
                </div>
                <div class="bg-white p-4 rounded-lg border shadow-sm sm:col-span-2">
                  <p class="text-sm text-gray-500">Booked Date</p>
                  <p class="font-bold text-[#001f54]">
                    {{ \Carbon\Carbon::parse($reservation->created_at)->format('M d, Y') }}
                  </p>
                </div>
              </div>
            </div>

            <!-- Next Steps -->
            <div class="bg-gradient-to-r from-amber-50 to-yellow-50 rounded-xl p-6 border shadow">
              <h2 class="text-xl font-bold text-amber-800 mb-4">What's Next?</h2>
              <ul class="space-y-3 text-sm text-gray-700">
                <li>✅ Check your email for details</li>
                <li>✅ Present your Booking ID at check-in</li>
                <li>✅ Contact us if you need help</li>
              </ul>
            </div>
          </div>

          <!-- Right Column: Payment Summary -->
          <div class="space-y-6">
            @php
              $checkin = \Carbon\Carbon::parse($reservation->reservation_checkin);
              $checkout = \Carbon\Carbon::parse($reservation->reservation_checkout);

              // Ensure checkout is after check-in
              if ($checkout->lt($checkin)) {
                $checkout = $checkin->copy()->addDay();
              }

              $nights = $checkin->diffInDays($checkout);

              $subtotal = $reservation->subtotal;
              $vat = $reservation->vat;
              $serviceFee = $reservation->serviceFee;
              $total = $reservation->total;
            @endphp

            <div class="bg-white rounded-xl p-6 shadow border">
              <h2 class="text-xl font-bold text-[#001f54] mb-4">Payment Summary</h2>
              <div class="space-y-3 text-sm">
                <div class="flex justify-between">
                  <p>Subtotal ({{ $nights }} night{{ $nights > 1 ? 's' : '' }})</p>
                  <p class="font-bold">₱{{ number_format($subtotal, 2) }}</p>
                </div>
                <div class="flex justify-between text-orange-600">
                  <p>VAT ({{$taxRatedynamic}})</p>
                  <p class="font-bold">₱{{ number_format($vat, 2) }}</p>
                </div>
                <div class="flex justify-between text-blue-600">
                  <p>Service Fee ({{$serviceFeedynamic}})</p>
                  <p class="font-bold">₱{{ number_format($serviceFee, 2) }}</p>
                </div>
                <hr>
                <div class="flex justify-between text-lg font-bold text-[#001f54]">
                  <p>Total</p>
                  <p>₱{{ number_format($total, 2) }}</p>
                </div>
              </div>
            </div>

            <!-- Actions -->
            <div class="flex flex-col sm:flex-row gap-4">
              <a href="/" class="btn btn-primary w-full">Back to Home</a>
            </div>
          </div>

        </div>
      </div>
    </section>


  </div>

  @include('landing.footer')
</body>

<script src="https://cdn.jsdelivr.net/npm/dom-to-image-more@2.6.0/dist/dom-to-image-more.min.js"></script>

<!-- Your script -->


@include('javascriptfix.soliera_js')

<script src="{{asset('javascript/photouploadglobal.js')}}"></script>




</html>