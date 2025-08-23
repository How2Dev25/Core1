<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Soliera Hotel - 401 Guest</title>
    
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @vite('resources/css/app.css')
</head>
<body>
<section class="relative w-full h-screen">

  <!-- Background image with overlay -->
  <div class="absolute inset-0 bg-cover bg-center z-0" style="background-image: url('{{asset('images/defaults/rooms/1 standard/room1.png')}}');"></div>
    <div class="absolute inset-0 bg-black/40 z-10"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-black/70 z-10"></div>
  
  <!-- Content container -->
<div class="relative z-10 w-full h-full flex justify-center items-center p-4">

  
  <div class="w-full flex justify-center items-center max-md:w-full">
      <div class="max-w-md w-full bg-white/10 backdrop-blur-lg p-8 rounded-xl shadow-2xl border border-white/20">
    <!-- Card Header -->
    <div class="mb-6 text-center flex justify-center items-center flex-col">
      <div class="text-[#F7B32B] mb-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
        </svg>
      </div>
      <h2 class="text-2xl font-bold text-white">Unauthorized Access</h2>
      <p class="text-white/80 mt-2">Error 401: You don't have permission to view this page</p>
    </div>
    
    <!-- Card Body -->
    <div>
      <div class="mb-6 text-center">
        <p class="text-white/80">Please check your credentials or contact support if you believe this is an error.</p>
      </div>
      
      <!-- Action Buttons -->
      <div class="flex flex-col gap-4">
        <a href="/guestlogout" 
          class="w-full bg-[#F7B32B] hover:bg-[#E5A21F] text-white font-semibold py-3 px-4 rounded-lg transition-all duration-300 text-center">
          Return to Login
        </a>
       
      </div>
      
      <!-- Support information -->
      <div class="mt-8 pt-6 border-t border-white/20 text-center">
        <p class="text-white/60">Need assistance?</p>
        <p class="text-[#F7B32B] font-medium mt-1">+1 (234) 567-8900</p>
        <p class="text-white/60 mt-1">support@solierahotel.com</p>
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
