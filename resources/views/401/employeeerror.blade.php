<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Soliera Hotel - 401 Employee</title>
    
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @vite('resources/css/app.css')
</head>
<body>
<section class="relative w-full min-h-screen flex items-center justify-center">

  <!-- Background image with overlay -->
  <div class="absolute inset-0 bg-cover bg-center z-0" style="background-image: url('{{asset('images/defaults/rooms/1 standard/room1.png')}}');"></div>
  <div class="absolute inset-0 bg-black/40 z-10"></div>
  <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-black/70 z-10"></div>
  
  <!-- Content container - centered with flex -->
  <div class="relative z-10 w-full flex justify-center items-center p-4">
    <div class="w-full max-w-4xl bg-white/10 backdrop-blur-lg p-8 rounded-xl shadow-2xl border border-white/20">
      <!-- Grid Layout -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        
        <!-- Icon Section -->
        <div class="md:col-span-1 flex flex-col items-center justify-center">
          <div class="text-[#F7B32B] mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
            </svg>
          </div>
          <h2 class="text-2xl font-bold text-white text-center">Access Restricted</h2>
          <p class="text-white/80 mt-2 text-center">Error 401: Unauthorized Access</p>
        </div>
        
        <!-- Content Section -->
        <div class="md:col-span-2">
          <!-- Message -->
          <div class="mb-6">
            <p class="text-white/80 text-lg">Your account does not have sufficient permissions to access this resource.</p>
          </div>
          
          <!-- Possible reasons -->
          <div class="bg-black/20 p-5 rounded-lg mb-6">
            <h3 class="font-medium mb-3 text-[#F7B32B] text-lg">Possible reasons:</h3>
            <ul class="text-white/80 text-md list-disc pl-5 space-y-2">
              <li>Your session may have expired</li>
              <li>You don't have the required role permissions</li>
              <li>You're attempting to access a restricted department resource</li>
              <li>Your account needs verification from administration</li>
            </ul>
          </div>
          
          <!-- Action Button and Support Info Side by Side -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
            <!-- Action Button -->
            <div>
              <a href="/employeelogin" 
                class="w-full bg-[#F7B32B] hover:bg-[#E5A21F] text-white font-semibold py-3 px-6 rounded-lg transition-all duration-300 text-center flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                Re-Authenticate
              </a>
            </div>
            
            <!-- Support information -->
            <div class="pt-4 border-t border-white/20 md:border-t-0 md:border-l md:pl-6 md:pt-0">
              <p class="text-white/60 text-sm">Employee support contact:</p>
              <p class="text-[#F7B32B] font-medium mt-1">hr@solierahotel.com</p>
              <p class="text-white/60 text-sm mt-1">Ext. 8700 from any hotel phone</p>
            </div>
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
