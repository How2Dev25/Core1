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
@auth('guest')

<style>
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: .5; }
        }
        .animate-spin {
            animation: spin 1s linear infinite;
        }
        .animate-pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        .loading-dots::after {
            content: '';
            animation: dots 1.5s steps(5, end) infinite;
        }
        @keyframes dots {
            0%, 20% { content: ''; }
            40% { content: '.'; }
            60% { content: '..'; }
            80%, 100% { content: '...'; }
        }
    </style>
<body class="bg-base-100">
    <div class="flex h-screen overflow-hidden">
      <!-- Sidebar -->
     @include('guest.components.dashboard.sidebar')
  
      <!-- Main content -->
      <div class="flex flex-col flex-1 overflow-hidden">
        <!-- Navbar -->
         @include('guest.components.dashboard.navbar')
  
        <!-- Dashboard Content -->
        <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 transition-slow ">
            {{-- Subsystem Name --}}
          <div class="pb-5 border-b border-base-300 animate-fadeIn flex items-center gap-3">
  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M12 2L13.09 8.26L20 9L13.09 9.74L12 16L10.91 9.74L4 9L10.91 8.26L12 2Z" fill="#4285F4"/>
    <path d="M12 2L13.09 8.26L20 9L13.09 9.74L12 16L10.91 9.74L4 9L10.91 8.26L12 2Z" fill="url(#gradient)" fill-opacity="0.3"/>
    <defs>
      <linearGradient id="gradient" x1="0%" y1="0%" x2="100%" y2="100%">
        <stop offset="0%" style="stop-color:#EA4335"/>
        <stop offset="25%" style="stop-color:#FBBC04"/>
        <stop offset="50%" style="stop-color:#34A853"/>
        <stop offset="75%" style="stop-color:#4285F4"/>
        <stop offset="100%" style="stop-color:#9C27B0"/>
      </linearGradient>
    </defs>
  </svg>
  <h1 class="text-2xl font-bold bg-white bg-clip-text text-[#191970]">
    Booking And Reservation - AI Assistance Powered By GEMINI
  </h1>
</div>
            {{-- Subsystem Name --}}

<section class="w-full ">
  <div class="w-full mx-auto">
    <div class="card ">
      <div class="card-body p-8">
        
        <!-- Header -->
        <div class="flex items-center gap-3 mb-6">
          <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#1E40AF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 8V4H8" />
            <rect width="16" height="12" x="4" y="8" rx="2" />
            <path d="M2 14h2" />
            <path d="M20 14h2" />
            <path d="M15 13v2" />
            <path d="M9 13v2" />
          </svg>
          <h2 class="text-3xl font-bold text-blue-900">AI Room Booking Assistant</h2>
        </div>

        <!-- Form -->
        <form action="/aireserve" method="post" id="aiForm">
          @csrf
          <div class="form-control flex flex-col gap-4">
            <label class="label">
              <span class="label-text text-lg font-semibold">Describe your perfect stay</span>
            </label>
            <textarea 
              name="prompt" 
              id="prompt" 
              class="textarea w-full textarea-bordered h-32 text-lg focus:border-blue-500 focus:ring focus:ring-blue-100"
              placeholder="e.g. 'I need a luxury suite for our honeymoon with ocean view and private pool for 5 nights starting next Friday'"
            ></textarea>
          </div>

          <!-- Sample Prompts -->
          <div class="mt-4 p-4 bg-blue-50 rounded-xl text-sm text-blue-900">
            <p class="font-semibold mb-2">Try sample prompts:</p>
       <ul class="list-disc list-inside space-y-1">
  <li>"Standard room with a table and WiFi for 2 nights from October 10 to October 12 – preferably in a quiet spot."</li>
  <li>"Suite for 4 people from August 5 to August 12 – would be great to have a few extra towels."</li>
  <li>"Deluxe room with a balcony and fan from September 5 to September 7 – hoping to get a couple of extra pillows."</li>
  <li>"Executive room for honeymoon from November 15 to November 22 – something simple to make it feel a bit special."</li>
</ul>
          </div>

          <!-- Submit Button -->
          <button type="submit" class="btn btn-primary mt-6 w-full flex items-center justify-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="11" cy="11" r="8" />
              <path d="m21 21-4.3-4.3" />
            </svg>
            Find Perfect Rooms
          </button>
        </form>

        <!-- Powered By -->
        <div class="mt-6 text-right text-sm text-gray-500 flex items-center justify-end gap-2">
          <span>Powered by</span>
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#4B5563" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2z" />
          </svg>
          <span class="font-semibold">Gemini</span>
        </div>

        <!-- Result Container -->
        <div id="result" class="mt-8 space-y-4"></div>

      </div>
    </div>
  </div>
</section>

        </main>

      </div>

    </div>

</body>

@endauth





 

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