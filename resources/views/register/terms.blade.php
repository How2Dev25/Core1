<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Soliera Hotel - Terms And Condition</title>
    
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @vite('resources/css/app.css')
</head>

<body>
     <section class="relative w-full min-h-screen">

  <!-- Background image with overlay -->
  <div class="absolute inset-0 bg-cover bg-center z-0" style="background-image: url('{{ asset('images/defaults/hotel3.jpg') }}');"></div>
   <div class="absolute inset-0 bg-black/40 z-10"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-black/70 z-10"></div>
  
        {{--  --}}

     <main class="relative z-10 w-full min-h-screen flex flex-col lg:flex-row justify-center items-center p-4 bg-gradient-to-br from-primary/10 via-secondary/10 to-accent/10">

    <!-- Left Placeholder (for image/branding if needed) -->
   <div class="w-1/2 flex justify-center items-center max-md:hidden p-8">
  <div class="max-w-md space-y-10">
    <!-- Logo -->
    <div data-aos="zoom-in" data-aos-delay="100">
      <a href="/">
        <img class="w-full max-h-52 hover:scale-105 transition-transform" 
             src="{{asset('images/logo/logofinal.png')}}" 
             alt="Soliera Hotel & Restaurant">
      </a>
    </div>

    <!-- Benefits Section -->
    <div class="space-y-6">
     
      <div class="space-y-4">
       

        <!-- Benefit 2 -->
        <div class="flex items-start gap-3" data-aos="fade-up" data-aos-delay="300">
          <div class="p-2 bg-amber-400/10 rounded-lg">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-zap text-amber-400">
              <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/>
            </svg>
          </div>
          <div>
            <h4 class="font-medium text-white">Faster Bookings</h4>
            <p class="text-sm text-white/70">One-click reservations with saved preferences</p>
          </div>
        </div>

        <!-- Benefit 3 -->
        <div class="flex items-start gap-3" data-aos="fade-up" data-aos-delay="350">
          <div class="p-2 bg-amber-400/10 rounded-lg">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star text-amber-400">
              <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
            </svg>
          </div>
          <div>
            <h4 class="font-medium text-white">Reward Points</h4>
            <p class="text-sm text-white/70">Earn points for every stay that you can redeem</p>
          </div>
        </div>

        <!-- Benefit 4 -->
        <div class="flex items-start gap-3" data-aos="fade-up" data-aos-delay="400">
          <div class="p-2 bg-amber-400/10 rounded-lg">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bell-ring text-amber-400">
              <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/>
              <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/>
              <path d="M4 2C2.8 3.7 2 5.7 2 8"/>
              <path d="M22 8c0-2.3-.8-4.3-2-6"/>
            </svg>
          </div>
          <div>
            <h4 class="font-medium text-white">Personalized Alerts</h4>
            <p class="text-sm text-white/70">Get notified about special events and promotions</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
  

    <!-- Right Terms Section -->
   <div class="w-full lg:w-1/2  lg:p-12 max-w-md  bg-white/10 backdrop-blur-lg p-6 rounded-xl shadow-2xl border border-white/20">
  <!-- Title Section -->
    <div class="text-center mb-8 ">
        <h1 class="text-3xl font-bold mb-2 text-white flex items-center justify-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-text">
                <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/>
                <polyline points="14 2 14 8 20 8"/>
                <line x1="16" x2="8" y1="13" y2="13"/>
                <line x1="16" x2="8" y1="17" y2="17"/>
                <line x1="10" x2="8" y1="9" y2="9"/>
            </svg>
            Terms and Conditions
        </h1>
        <p class="text-white/80 flex items-center justify-center gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar-days">
                <path d="M8 2v4"/>
                <path d="M16 2v4"/>
                <rect width="18" height="18" x="3" y="4" rx="2"/>
                <path d="M3 10h18"/>
                <path d="M8 14h.01"/>
                <path d="M12 14h.01"/>
                <path d="M16 14h.01"/>
                <path d="M8 18h.01"/>
                <path d="M12 18h.01"/>
                <path d="M16 18h.01"/>
            </svg>
            Last updated: <span id="currentDate"></span>
        </p>
    </div>


      <ul class="steps steps-horizontal lg:steps-horizontal w-full mb-5">
  <li class="step step-primary text-white">Terms</li>
  <li class="step  text-white">Registration</li>
  <li class="step text-white">Photo Setup</li>

</ul>

    <!-- Terms Content Container -->
    <div class="max-w-2xl mx-auto bg-white/10 backdrop-blur-lg rounded-xl border border-white/20 shadow-lg overflow-hidden">
        <div class="h-80 overflow-y-auto p-4 space-y-3 custom-scrollbar">
            <!-- Hotel Accommodation -->
            <div class="collapse collapse-arrow bg-white/10 hover:bg-white/20 transition-colors rounded-lg border border-white/20">
                <input type="checkbox" class="peer"/> 
                <div class="collapse-title text-lg font-medium text-white flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-building">
                        <rect width="16" height="20" x="4" y="2" rx="2" ry="2"/>
                        <path d="M9 22v-4h6v4"/>
                        <path d="M8 6h.01"/>
                        <path d="M16 6h.01"/>
                        <path d="M12 6h.01"/>
                        <path d="M12 10h.01"/>
                        <path d="M12 14h.01"/>
                        <path d="M16 10h.01"/>
                        <path d="M16 14h.01"/>
                        <path d="M8 10h.01"/>
                        <path d="M8 14h.01"/>
                    </svg>
                    Hotel Accommodation
                </div>
                <div class="collapse-content text-white/80"> 
                    <ul class="list-disc pl-5 space-y-2 text-sm">
                        <li class="font-semibold text-white/80">The 6PM Rule: Reservations will be held until 6:00 PM on the scheduled day of arrival, Guest Must Confirm it before 6pm otherwise it will be cancelled.</li>
                    </ul>
                </div>
            </div>

            <!-- Restaurant Services -->
            <div class="collapse collapse-arrow bg-white/10 hover:bg-white/20 transition-colors rounded-lg border border-white/20">
                <input type="checkbox" class="peer"/> 
                <div class="collapse-title text-lg font-medium text-white flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-utensils">
                        <path d="M3 2v7c0 1.1.9 2 2 2h4a2 2 0 0 0 2-2V2"/>
                        <path d="M7 2v20"/>
                        <path d="M21 15V2v0a5 5 0 0 0-5 5v6c0 1.1.9 2 2 2h3Zm0 0v7"/>
                    </svg>
                    Restaurant Services
                </div>
                <div class="collapse-content text-white/80"> 
                    <ul class="list-disc pl-5 space-y-2 text-sm">
                        <li>Restaurant reservations are recommended, especially during peak hours and holidays.</li>
                        <li>Outside food and beverages are not allowed in the restaurant premises.</li>
                        <li>Proper attire is required. Management reserves the right to refuse service to anyone not adhering to the dress code.</li>
                        <li>Last orders are taken 30 minutes before closing time.</li>
                    </ul>
                </div>
            </div>

            <!-- Payments & Cancellations -->
            <div class="collapse collapse-arrow bg-white/10 hover:bg-white/20 transition-colors rounded-lg border border-white/20">
                <input type="checkbox" class="peer"/> 
                <div class="collapse-title text-lg font-medium text-white flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-line-linejoin="round" class="lucide lucide-credit-card">
                        <rect width="20" height="14" x="2" y="5" rx="2"/>
                        <line x1="2" x2="22" y1="10" y2="10"/>
                    </svg>
                    Payments & Cancellations
                </div>
                <div class="collapse-content text-white/80"> 
                    <ul class="list-disc pl-5 space-y-2 text-sm">
                        <li>All rates are subject to applicable government taxes and service charges.</li>
                        <li>Cancellations made 48 hours prior to arrival will not incur charges. Late cancellations or no-shows will be charged one night's room rate.</li>
                        <li>Group bookings (5 rooms or more) require a 50% non-refundable deposit at the time of reservation.</li>
                        <li>Refunds may take 7-14 business days to process.</li>
                    </ul>
                </div>
            </div>

            <!-- Data Privacy -->
            <div class="collapse collapse-arrow bg-white/10 hover:bg-white/20 transition-colors rounded-lg border border-white/20">
                <input type="checkbox" class="peer"/> 
                <div class="collapse-title text-lg font-medium text-white flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield-check">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10"/>
                        <path d="m9 12 2 2 4-4"/>
                    </svg>
                    Data Privacy (Republic Act No. 10173)
                </div>
                <div class="collapse-content text-white/80"> 
                    <ul class="list-disc pl-5 space-y-2 text-sm">
                        <li>We comply with the Data Privacy Act of 2012 (Republic Act No. 10173) of the Philippines.</li>
                        <li>Personal information collected is used solely for reservation, billing, and service improvement purposes.</li>
                        <li>We implement appropriate security measures to protect your personal data.</li>
                        <li>You have the right to access, correct, and request deletion of your personal data.</li>
                    </ul>
                </div>
            </div>

            <!-- General Policies -->
            <div class="collapse collapse-arrow bg-white/10 hover:bg-white/20 transition-colors rounded-lg border border-white/20">
                <input type="checkbox" class="peer"/> 
                <div class="collapse-title text-lg font-medium text-white flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-alert-triangle">
                        <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/>
                        <path d="M12 9v4"/>
                        <path d="M12 17h.01"/>
                    </svg>
                    General Policies
                </div>
                <div class="collapse-content text-white/80"> 
                    <ul class="list-disc pl-5 space-y-2 text-sm">
                        <li>Smoking is only allowed in designated areas. A cleaning fee of ₱5,000 will be charged for violations.</li>
                        <li>Pets are not allowed except for service animals with proper documentation.</li>
                        <li>The hotel is not responsible for lost or stolen items.</li>
                        <li>Damage to hotel property will result in appropriate charges.</li>
                        <li>Quiet hours are observed from 10:00 PM to 7:00 AM.</li>
                    </ul>
                </div>
            </div>

            <!-- Liability -->
            <div class="collapse collapse-arrow bg-white/10 hover:bg-white/20 transition-colors rounded-lg border border-white/20">
                <input type="checkbox" class="peer"/> 
                <div class="collapse-title text-lg font-medium text-white flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-alert-circle">
                        <circle cx="12" cy="12" r="10"/>
                        <line x1="12" x2="12" y1="8" y2="12"/>
                        <line x1="12" x2="12.01" y1="16" y2="16"/>
                    </svg>
                    Liability
                </div>
                <div class="collapse-content text-white/80 text-sm space-y-2"> 
                    <p>Soliera Hotel and Restaurant shall not be liable for any accident, injury, damage, loss, or delay that may occur to guests or their belongings during their stay, except when such incident is proven to be caused by the hotel's gross negligence.</p>
                    <p>By accepting these terms, you acknowledge that you have read, understood, and agreed to all the policies and conditions stated above.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Acceptance -->
    <div class="form-control mt-8 mb-6">
        <label class="label cursor-pointer justify-start gap-4 hover:bg-white/10 p-3 rounded-lg transition-colors">
            <input type="checkbox" id="acceptCheckbox" class="checkbox checkbox-primary border-white/50" />
            <span class="label-text text-lg text-white flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-circle">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                    <path d="m9 11 3 3L22 4"/>
                </svg>
                I agree to the Terms and Conditions
            </span>
        </label>
    </div>

    <!-- Submit Button -->
    <button id="submitBtn" class="btn btn-primary w-full text-lg gap-2 hover:shadow-lg transition-all" disabled>
        Proceed to Registration
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right">
            <path d="M5 12h14"/>
            <path d="m12 5 7 7-7 7"/>
        </svg>
    </button>
</div>
</main>




     </section>
</body>


<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
<script>
    AOS.init({
        duration: 1000,
        once: true
    });
</script>
<script>
    // Show current date
    document.getElementById("currentDate").textContent = new Date().toLocaleDateString();

    // Enable button only when checked
    const checkbox = document.getElementById("acceptCheckbox");
    const button = document.getElementById("submitBtn");

    checkbox.addEventListener("change", () => {
        button.disabled = !checkbox.checked;
    });
</script>


</html>
