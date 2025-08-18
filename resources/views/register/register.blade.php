<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Soliera Hotel - Registration</title>
    
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @vite('resources/css/app.css')
</head>
<body>
    
   <section class="relative w-full min-h-screen">

  <!-- Background image with overlay -->
  <div class="absolute inset-0 bg-cover bg-center z-0" style="background-image: url('{{ asset('images/defaults/hotel3.jpg') }}');"></div>
    <div class="absolute inset-0 bg-black/40 z-10"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-black/70 z-10"></div>
  
  <!-- Content container -->
<div class="relative z-10 w-full min-h-screen flex justify-center items-center  p-4">
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
  
  <div class="w-1/2 flex justify-center items-center max-md:w-full">
  <div class="max-w-md w-full bg-white/10 backdrop-blur-lg p-6 rounded-xl shadow-2xl border border-white/20">
    <!-- Card Header -->
    <div class="mb-6 text-center flex justify-center items-center flex-col">
        <h2 class="text-2xl font-bold text-white">Complete Your Registration</h2>
        <p class="text-white/80 mt-1">Fill in your personal details</p>
    </div>
    
    <!-- Card Body -->
    <div>
        <form action="/register" method="POST">
            <ul class="steps steps-horizontal lg:steps-horizontal w-full mb-5">
                <li class="step step-primary text-white">Terms</li>
                <li class="step step-primary text-white">Registration</li>
                <li class="step text-white">Photo Setup</li>
            </ul>
            
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <!-- Name -->
                <div class="col-span-2">
                    <label class="block text-white/90 text-sm font-medium mb-2" for="name">
                        Full Name
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-user text-white/50"></i>
                        </div>
                        <input 
                            id="name" 
                            type="text" 
                            class="w-full pl-10 pr-3 py-3 bg-white/5 border border-white/20 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-transparent placeholder-white/50" 
                            placeholder="John Doe"
                            required
                            name="name"
                        >
                    </div>
                </div>
                
                <!-- Birthday -->
                <div>
                    <label class="block text-white/90 text-sm font-medium mb-2" for="birthday">
                        Birthday
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-birthday-cake text-white/50"></i>
                        </div>
                        <input 
                            id="birthday" 
                            type="date" 
                            class="w-full pl-10 pr-3 py-3 bg-white/5 border border-white/20 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-transparent placeholder-white/50" 
                            required
                            name="birthday"
                        >
                    </div>
                </div>
                
                <!-- Mobile Number -->
                <div>
                    <label class="block text-white/90 text-sm font-medium mb-2" for="mobile">
                        Mobile Number
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-phone-alt text-white/50"></i>
                        </div>
                        <input 
                            id="mobile" 
                            type="tel" 
                            class="w-full pl-10 pr-3 py-3 bg-white/5 border border-white/20 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-transparent placeholder-white/50" 
                            placeholder="+1 (555) 123-4567"
                            required
                            name="mobile"
                        >
                    </div>
                </div>
                
                <!-- Email -->
                <div class="col-span-2">
                    <label class="block text-white/90 text-sm font-medium mb-2" for="email">
                        Email Address
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-white/50"></i>
                        </div>
                        <input 
                            id="email" 
                            type="email" 
                            class="w-full pl-10 pr-3 py-3 bg-white/5 border border-white/20 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-transparent placeholder-white/50" 
                            placeholder="your@email.com"
                            required
                            name="email"
                        >
                    </div>
                </div>
                
                <!-- Address -->
                <div class="col-span-2">
                    <label class="block text-white/90 text-sm font-medium mb-2" for="address">
                        Address
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-home text-white/50"></i>
                        </div>
                        <input 
                            id="address" 
                            type="text" 
                            class="w-full pl-10 pr-3 py-3 bg-white/5 border border-white/20 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-transparent placeholder-white/50" 
                            placeholder="123 Main St, City, Country"
                            required
                            name="address"
                        >
                    </div>
                </div>
            </div>
            
            <!-- Submit Button -->
            <button 
                type="submit" 
                class="w-full btn-primary btn mt-4"
            >
                Continue 
                <i class="fas fa-arrow-right ml-2"></i>
            </button>
        </form>
        
        <!-- Back link -->
        <div class="mt-4 text-center">
            <a href="#" class="font-medium text-blue-400 hover:text-blue-300 flex items-center justify-center">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to previous step
            </a>
        </div>
    </div>
</div>
  </div>
  
 

</div>


   </section>

  
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
<script>
    AOS.init({
        duration: 1000,
        once: true
    });
</script>

<script>
function togglePasswordVisibility() {
  const passwordInput = document.getElementById('password');
  const eyeIcon = document.getElementById('eye-icon');
  const eyeSlashIcon = document.getElementById('eye-slash-icon');

  if (passwordInput.type === 'password') {
    passwordInput.type = 'text';
    eyeIcon.classList.add('hidden');
    eyeSlashIcon.classList.remove('hidden');
  } else {
    passwordInput.type = 'password';
    eyeIcon.classList.remove('hidden');
    eyeSlashIcon.classList.add('hidden');
  }
}


</script>




</body>
</html>
