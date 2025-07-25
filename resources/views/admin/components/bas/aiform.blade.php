<pre>
Checkin: {{ $checkin }}
Checkout: {{ $checkout }}
Guests: {{ $criteria['roommaxguest'] ?? 'null' }}
Special Request: {{ $prefilledRequest ?? 'none' }}
</pre>
<!DOCTYPE html>
<html lang="en" data-theme ="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    @vite('resources/css/app.css')
 
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <title>{{$title}} - Booking And Reservation</title>
      @livewireStyles
</head>
<body class="bg-base-100">
    <div class="flex h-screen overflow-hidden">
      <!-- Sidebar -->
     @include('admin.components.dashboard.sidebar')
  
      <!-- Main content -->
      <div class="flex flex-col flex-1 overflow-hidden">
        <!-- Navbar -->
         @include('admin.components.dashboard.navbar')
  
        <!-- Dashboard Content -->
        <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 transition-slow ">
            {{-- Subsystem Name --}}
          <div class="pb-5 border-b border-base-300 animate-fadeIn">
            <h1 class="text-2xl font-bold bg-white bg-clip-text text-[#191970]">Booking And Reservation - Gemini Assistance</h1>
          </div>
            {{-- Subsystem Name --}}

       <section class="w-full p-6">
  <form action="/createreservation" method="POST" id="reservationForm">
    @csrf
    <input type="hidden" name="roomID" id="selectedRoomID" value="{{ $room->roomID }}" />

    <!-- Selected Room Info -->
    <div class="bg-base-200 rounded-box p-5 mb-6 shadow-md">
      <h2 class="text-lg font-semibold flex items-center gap-2 mb-4">
        <i data-lucide="home" class="w-5 h-5"></i>
        Selected Room
      </h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div><strong>Type:</strong> {{ $room->roomtype }}</div>
        <div><strong>Max Guests:</strong> {{ $room->roommaxguest }}</div>
        <div class="md:col-span-2">
          <strong>Features:</strong> {{ $room->roomfeatures }}
        </div>
      </div>
    </div>


    <!-- Reservation Details -->
    <div class="bg-base-200 rounded-box p-5 mb-6 shadow-md">
      <h2 class="text-lg font-semibold flex items-center gap-2 mb-4">
        <i data-lucide="calendar" class="w-5 h-5"></i>
        Reservation Details
      </h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="form-control">
          <label class="label">
            <span class="label-text">Check-In Date</span>
          </label>
          <input type="date" name="reservation_checkin" class="input input-bordered"
                 value="{{ $checkin }}" required />
        </div>
        <div class="form-control">
          <label class="label">
            <span class="label-text">Check-Out Date</span>
          </label>
          <input type="date" name="reservation_checkout" class="input input-bordered"
                 value="{{ $checkout }}" required />
        </div>
        <div class="form-control">
          <label class="label">
            <span class="label-text">Number of Guests</span>
          </label>
          <input type="number" name="reservation_numguest" min="1" class="input input-bordered"
                 value="{{ $criteria['roommaxguest'] ?? 1 }}" required />
        </div>
        <div class="form-control">
          <label class="label">
            <span class="label-text">Special Requests</span>
          </label>
          <input type="text" name="reservation_specialrequest" class="input input-bordered"
                 placeholder="Early check-in, extra pillows..." value="{{ $special_request ?? '' }}" />
        </div>
      </div>
    </div>

    <!-- Guest Information -->
    <div class="bg-base-200 rounded-box p-5 mb-6 shadow-md">
      <div class="flex justify-between items-center mb-4">
        <h1 class="text-lg font-bold flex items-center gap-2">
          <i data-lucide="user-round" class="w-5 h-5 text-primary"></i>
          Guest Information
        </h1>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <x-text-input label="Full Name" icon="user" name="guestname" placeholder="Juan Dela Cruz" />
        <x-date-input label="Birthday" icon="calendar" name="guestbirthday" />
        <x-text-input label="Mobile Number" icon="phone" name="guestphonenumber" placeholder="+63 900 000 0000" />
        <x-text-input label="Email Address" icon="mail" name="guestemailaddress" type="email" placeholder="juan@example.com" />
        <div class="form-control md:col-span-2">
          <label class="label">
            <span class="label-text flex items-center gap-1">
              <i data-lucide="map-pin" class="w-4 h-4 text-primary"></i> Address
            </span>
          </label>
          <textarea name="guestaddress" class="textarea textarea-bordered" placeholder="123 Barangay St., City, Province" rows="2" required></textarea>
        </div>
        <x-text-input label="Contact Person" icon="user-check" name="guestcontactperson" placeholder="Maria Dela Cruz" />
        <x-text-input label="Contact Person Number" icon="phone-forwarded" name="guestcontactpersonnumber" placeholder="+63 912 345 6789" />
      </div>
    </div>

    <!-- Form Footer -->
    <div class="modal-action">
      <button type="button" onclick="history.back()" class="btn btn-ghost">
        Cancel
      </button>
      <button type="submit" class="btn btn-primary gap-2">
        <i data-lucide="check-circle" class="w-5 h-5"></i>
        Confirm Reservation
      </button>
    </div>
  </form>
</section>






 

<!-- Initialize Lucide Icons -->
<script>
  lucide.createIcons();
</script>

        


           
      
 
        </main>
      </div>
    </div>

   
    
    
   
   @livewireScripts
  @include('javascriptfix.soliera_js')
  </body>




  
</html>