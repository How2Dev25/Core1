<!DOCTYPE html>
<html lang="en" data-theme ="{{$theme}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:wght@700&family=Mate&family=Slabo+27px&display=swap" rel="stylesheet">
    <title>{{$title}}</title>
</head>
<body>
  

<section class="flex  md:flex-row w-full min-h-screen max-md:flex-col-reverse ">
    <!-- Left Side with Image -->
    <div class="w-full md:w-1/2 maincolor flex items-center justify-center p-8">
        <div class="max-w-md text-center">
            <img src="{{asset('images/svgs/room.svg')}}" alt="Luxury Hotel Room" class="w-full h-auto mb-8">
            <h2 class="text-3xl text-white font-noto-serif mb-2">Experience Elegance</h2>
            <p class="text-[#BCC6CC] font-mate text-xl">Where Warmth Welcomes, And Flavor Shines</p>
        </div>
    </div>

    <!-- Right Side with Form -->
    <div class="w-full md:w-1/2 flex items-center justify-center flex-col p-6 bg-[#4a628a] ">
        <form class="w-full max-w-md bg-white p-8 rounded-[10px] shadow-lg flex flex-col gap-6">
            <!-- Header -->
            <div class="text-center mb-4">
                <h1 class="text-3xl font-bold  bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent font-noto-serif">SOLIERA</h1>
                <p class="text-[#2C3E50] font-mate mt-1">Hotel & Restaurant</p>
                <h2 class="text-xl font-semibold mt-4 text-[#2C3E50] font-mate">Welcome Back</h2>
            </div>
        
            <!-- Email Field -->
            <div class="flex flex-col w-full gap-1">
                <label class="text-[#2C3E50] font-slabo text-sm font-medium" for="email">Email</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <i class='bx bx-envelope text-[#BCC6CC]'></i>
                    </span>
                    <input id="email" class="input w-full pl-10 rounded-[10px] border-[#BCC6CC] focus:border-[#2C3E50] focus:ring-1 focus:ring-[#2C3E50] font-slabo py-3" 
                           type="email" required placeholder="mail@soliera.com" />
                </div>
                <div class="validator-hint text-xs text-[#BCC6CC] font-slabo mt-1">Enter valid email address</div>
            </div>
        
            <!-- Password Field -->
            <div class="flex flex-col w-full gap-1">
                <label class="text-[#2C3E50] font-slabo text-sm font-medium" for="password">Password</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <i class='bx bx-lock-alt text-[#BCC6CC]'></i>
                    </span>
                    <input id="password" 
                           class="input w-full pl-10 rounded-[10px] border-[#BCC6CC] focus:border-[#2C3E50] focus:ring-1 focus:ring-[#2C3E50] font-slabo py-3"
                           type="password" required placeholder="••••••••" />
                    <span class="password-toggle absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer" onclick="togglePassword(this)">
                        <i class='bx bx-hide text-[#BCC6CC]'></i>
                    </span>
                </div>
            </div>
        
            <!-- Remember Me & Forgot Password -->
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <input type="checkbox" id="remember" class="rounded-[4px] border-[#BCC6CC] text-[#2C3E50] focus:ring-[#2C3E50]">
                    <label for="remember" class="ml-2 text-sm text-[#2C3E50] font-slabo">Remember me</label>
                </div>
                <a href="#" class="text-sm text-[#2C3E50] hover:underline font-slabo">Forgot password?</a>
            </div>
        
            <!-- Login Button -->
            <button class="btn bg-[#2C3E50] hover:bg-[#1a2635] text-white border-none rounded-[10px] font-slabo py-3 mt-2">
                Login
            </button>
        
            <div class="divider divider-neutral text-black">OR </div>
            <!-- Register Links -->
            <div class="text-center space-y-2">
                <p class="text-sm text-[#2C3E50] font-slabo">Don't have an account?</p>
                <div class="flex flex-col gap-2 mt-2">
                    <a href="/guestregister" class="text-sm text-[#2C3E50] hover:underline font-medium font-slabo">
                        Register as Guest
                    </a>
                    <a href="/employeregister" class="text-sm text-[#2C3E50] hover:underline font-medium font-slabo">
                        Register as Employee
                    </a>
                </div>
            </div>
        </form>
        
       
    </div>
</section>




    <script src="{{asset('javascript/password.js')}}">
    </script>
</body>
</html>