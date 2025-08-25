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
@auth
    

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

       <!-- Suggested Rooms Section -->
  <section class="w-full mb-10">
    <h2 class="text-2xl font-bold mb-4 flex items-center gap-2">
      <i data-lucide="lightbulb" class="w-6 h-6 text-warning"></i>
      Suggested Rooms for You
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      @foreach($suggestions as $room)
      <div onclick="selectSuggestedRoom({{ $room->roomID }}, '{{ $room->roomtype }}', '{{ $room->roomprice }}', '{{ $room->roomfeatures }}', '{{ $room->roommaxguest }}', '{{ $checkin }}', '{{ $checkout }}')" class="card bg-base-100 shadow-xl hover:shadow-2xl transition cursor-pointer">
        <figure><img src="{{ asset($room->roomphoto) }}" alt="Room Image" class="h-48 object-cover w-full" /></figure>
        <div class="card-body">
          <h3 class="card-title">{{ $room->roomtype }}</h3>
          <p><strong>Features:</strong> {{ $room->roomfeatures }}</p>
          <p><strong>Max Guests:</strong> {{ $room->roommaxguest }}</p>
          <p><strong>Price:</strong> ₱{{ number_format($room->roomprice, 2) }}</p>
          <div class="card-actions justify-end">
            <button class="btn btn-outline btn-primary btn-sm">Select</button>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </section>

  <!-- Reservation Form Section -->
  <section class="w-full">
    <form action="/createreservation" method="POST" id="reservationForm">
      @csrf
      <input type="hidden" name="roomID" id="selectedRoomID" />

      <!-- Reservation Details -->
<div class="bg-base-200 rounded-box p-5 mb-6">
  <h2 class="text-lg font-semibold flex items-center gap-2 mb-4">
    <i data-lucide="calendar" class="w-5 h-5"></i>
    Reservation Details
  </h2>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <!-- Check-In Date -->
    <div class="form-control">
      <label class="label">
        <span class="label-text">Check-In Date</span>
      </label>
      <input 
        type="date" 
        name="reservation_checkin" 
        value="{{ isset($checkin) ? $checkin : '' }}" 
        class="input input-bordered" 
        required 
      />
    </div>

    <!-- Check-Out Date -->
    <div class="form-control">
      <label class="label">
        <span class="label-text">Check-Out Date</span>
      </label>
      <input 
        type="date" 
        name="reservation_checkout" 
        value="{{ isset($checkout) ? $checkout : '' }}" 
        class="input input-bordered" 
        required 
      />
    </div>

    <!-- Number of Guests -->
    <div class="form-control">
      <label class="label">
        <span class="label-text">Number of Guests</span>
      </label>
      <input 
        type="number" 
        name="reservation_numguest" 
        value="{{ isset($criteria['roommaxguest']) ? $criteria['roommaxguest'] : 1 }}" 
        min="1" 
        class="input input-bordered" 
        required 
      />
    </div>

    <!-- Special Requests -->
    <div class="form-control">
      <label class="label">
        <span class="label-text">Special Requests</span>
      </label>
      <input 
        type="text" 
        name="reservation_specialrequest" 
        value="{{ isset($prefilledRequest) ? $prefilledRequest : '' }}" 
        placeholder="Early check-in, extra pillows..." 
        class="input input-bordered" 
      />
    </div>
  </div>
</div>
      <!-- Guest Information -->
      <div class="bg-base-200 rounded-box p-5 mb-6">
        <div class="flex justify-between items-center mb-4">
          <h1 class="text-lg font-bold flex items-center gap-2">
            <i data-lucide="user-round" class="w-5 h-5 text-primary"></i>
            Guest Information
          </h1>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
          <!-- Full Name -->
          <div class="form-control">
            <label class="label">
              <span class="label-text font-medium flex items-center gap-1">
                <i data-lucide="user" class="w-4 h-4 text-primary"></i>
                Full Name
              </span>
            </label>
            <input type="text" name="guestname" class="input input-bordered" placeholder="Juan Dela Cruz" required />
          </div>

          <!-- Birthday -->
          <div class="form-control">
            <label class="label">
              <span class="label-text font-medium flex items-center gap-1">
                <i data-lucide="calendar" class="w-4 h-4 text-primary"></i>
                Birthday
              </span>
            </label>
            <input id="guestbirthday" type="date" name="guestbirthday" class="input input-bordered" required />
            <br>
            <span id="ageError" class="text-red-500 text-sm mt-2 hidden">Age must be 18 or above.</span>
          </div>

          <!-- Mobile Number -->
          <div class="form-control">
            <label class="label">
              <span class="label-text font-medium flex items-center gap-1">
                <i data-lucide="phone" class="w-4 h-4 text-primary"></i>
                Mobile Number
              </span>
            </label>
            <input type="tel" name="guestphonenumber" class="input input-bordered" placeholder="+63 900 000 0000" required />
          </div>

          <!-- Email Address -->
          <div class="form-control">
            <label class="label">
              <span class="label-text font-medium flex items-center gap-1">
                <i data-lucide="mail" class="w-4 h-4 text-primary"></i>
                Email Address
              </span>
            </label>
            <input type="email" name="guestemailaddress" class="input input-bordered" placeholder="juan@example.com" required />
          </div>

          <!-- Address -->
          <div class="form-control md:col-span-2 flex flex-col">
            <label class="label">
              <span class="label-text font-medium flex items-center gap-1">
                <i data-lucide="map-pin" class="w-4 h-4 text-primary"></i>
                Address
              </span>
            </label>
            <textarea name="guestaddress" class="textarea textarea-bordered" placeholder="123 Barangay St., City, Province" rows="2" required></textarea>
          </div>

          <!-- Contact Person -->
          <div class="form-control">
            <label class="label">
              <span class="label-text font-medium flex items-center gap-1">
                <i data-lucide="user-check" class="w-4 h-4 text-primary"></i>
                Contact Person
              </span>
            </label>
            <input type="text" name="guestcontactperson" class="input input-bordered" placeholder="Maria Dela Cruz" required />
          </div>

          <!-- Contact Person Number -->
          <div class="form-control">
            <label class="label">
              <span class="label-text font-medium flex items-center gap-1">
                <i data-lucide="phone-forwarded" class="w-4 h-4 text-primary"></i>
                Contact Person Number
              </span>
            </label>
            <input type="tel" name="guestcontactpersonnumber" class="input input-bordered" placeholder="+63 912 345 6789" required />
          </div>
        </div>
      </div>

      <!-- Form Footer -->
      <div class="flex justify-end gap-4">
        <a href="/" class="btn btn-ghost">
          Cancel
        </a>
        <button type="submit" class="btn btn-primary gap-2">
          <i data-lucide="check-circle" class="w-5 h-5"></i>
          Confirm Reservation
        </button>
      </div>
    </form>
  </section>








 

<!-- Initialize Lucide Icons -->
<!-- JavaScript to Fill Form on Card Click -->
<script>
  function selectSuggestedRoom(roomID) {
    document.getElementById('selectedRoomID').value = roomID;
    document.getElementById('reservationForm')?.scrollIntoView({ behavior: 'smooth' });
  }
</script>

<!-- Lucide Init -->
<script type="module">
  import lucide from 'https://unpkg.com/lucide@latest/dist/esm/lucide.js';
  lucide.createIcons();
</script>

        


           
      
 
        </main>
      </div>
    </div>

   
    
    
   
   @livewireScripts
  @include('javascriptfix.soliera_js')
  </body>


@endauth

  
</html>