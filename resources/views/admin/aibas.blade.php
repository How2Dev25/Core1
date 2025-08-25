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

        <section class="w-full">
  <div class="w-full mx-auto">
    <div class="card bg-base-100 ">
      <div class="card-body p-8">
        <div class="flex items-center gap-3 mb-6">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bot text-primary">
            <path d="M12 8V4H8" />
            <rect width="16" height="12" x="4" y="8" rx="2" />
            <path d="M2 14h2" />
            <path d="M20 14h2" />
            <path d="M15 13v2" />
            <path d="M9 13v2" />
          </svg>
          <h2 class="text-3xl font-bold">AI Room Booking Assistant</h2>
        </div>

        <form action="/aireserve" method="post" id="aiForm">
            @csrf
          <div class="form-control flex flex-col gap-5">
            <label class="label">
              <span class="label-text text-lg">Describe your perfect stay</span>
            </label>
            <textarea 
               name="prompt" 
              id="prompt" 
              class="textarea w-full textarea-bordered h-32 text-lg" 
              placeholder="e.g. 'I need a luxury suite for our honeymoon with ocean view and private pool for 5 nights starting next Friday'"
            ></textarea>
            
            <div class="mt-2 text-sm text-gray-500">
              <p>Try examples:</p>
              <ul class="list-disc list-inside">
                <li>"Business room with workspace and fast WiFi for 2 nights"</li>
                <li>"Family suite for 4 people near the beach for a week in August"</li>
              </ul>
            </div>
          </div>

          <button type="submit" class="btn btn-primary mt-6 w-full">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search">
              <circle cx="11" cy="11" r="8" />
              <path d="m21 21-4.3-4.3" />
            </svg>
            Find Perfect Rooms
          </button>
        </form>

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