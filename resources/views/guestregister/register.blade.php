<!DOCTYPE html>
<html lang="en" data-theme = "{{$theme}}">
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
            <img src="{{asset('images/svgs/hotel.svg')}}" alt="Luxury Hotel Room" class="w-full h-auto mb-8">
            <h2 class="text-3xl text-white font-noto-serif mb-2">Experience Elegance</h2>
            <p class="text-[#BCC6CC] font-mate text-xl">Where Warmth Welcomes, And Flavor Shines</p>
        </div>
    </div>

    <!-- Right Side with Form -->
    <div class="w-full md:w-1/2 flex items-center bg-[#4a628a] justify-center p-6">
        <div class="w-full max-w-md bg-white p-8 rounded-[10px] shadow-lg">
            <!-- Form Header -->
            <div class="text-center mb-6">
                <h1 class="text-3xl font-bold  bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent font-noto-serif">SOLIERA</h1>
                <p class="text-[#2C3E50] font-mate mt-1">Hotel & Restaurant</p>
                <h2 class="text-xl font-semibold mt-4 text-[#2C3E50] font-mate">Guest Registration</h2>
            </div>

            <form class="space-y-6">
                <!-- Section 1: Personal Details -->
                <div class="border-b border-[#BCC6CC] pb-6">
                    <h3 class="text-lg font-semibold text-[#2C3E50] font-mate mb-4 flex items-center gap-2">
                        <i class='bx bx-user-circle text-[#2C3E50]'></i>
                        Personal Information
                    </h3>
                    
                    <!-- Photo Upload -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-[#2C3E50] font-slabo mb-2">Profile Photo</label>
                        <div class="flex items-center gap-5">
                          <!-- Preview Container -->
                          <div class="relative w-20 h-20 rounded-full bg-[#F2F4F7] border-2 border-dashed border-[#BCC6CC] flex items-center justify-center overflow-hidden group transition-shadow duration-200 hover:shadow-md">
                            <i class='bx bx-camera text-[#BCC6CC] text-2xl group-hover:hidden' id="photo-icon"></i>
                            <img id="photo-preview" class="hidden w-full h-full object-cover" />
                            <!-- Optional: Overlay on hover -->
                            <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center text-white text-xs font-medium rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                              Change
                            </div>
                          </div>
                      
                          <!-- Upload Button -->
                          <div class="flex flex-col gap-2">
                            <input type="file" id="photo-upload" accept="image/*" class="hidden" onchange="previewPhoto(this)">
                            <button type="button"
                              onclick="document.getElementById('photo-upload').click()"
                              class="text-sm bg-[#2C3E50] text-white px-4 py-2 rounded-[10px] font-slabo hover:bg-[#1a2635] transition">
                              Upload Photo
                            </button>
                            <span class="text-xs text-[#7f8c8d] font-slabo">Max size: 2MB | JPG/PNG</span>
                          </div>
                        </div>
                      </div>
                    
                    <div class="grid grid-cols-1 gap-4">
                        <div class="flex flex-col gap-1">
                            <label class="text-[#2C3E50] font-slabo text-sm font-medium">Name</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                    <i class='bx bx-user text-[#BCC6CC]'></i>
                                </span>
                                <input type="text" class="input w-full pl-10 rounded-[10px] border-[#BCC6CC] font-slabo py-2" required>
                            </div>
                        </div>
                      
                    </div>
                    
                    <div class="flex flex-col gap-1 mt-4">
                        <label class="text-[#2C3E50] font-slabo text-sm font-medium">Date of Birth</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <i class='bx bx-calendar text-[#BCC6CC]'></i>
                            </span>
                            <input type="date" class="input w-full pl-10 rounded-[10px] border-[#BCC6CC] font-slabo py-2" required>
                        </div>
                    </div>
                </div>

                <!-- Section 2: Contact Information -->
                <div class="border-b border-[#BCC6CC] pb-6">
                    <h3 class="text-lg font-semibold text-[#2C3E50] font-mate mb-4 flex items-center gap-2">
                        <i class='bx bx-phone text-[#2C3E50]'></i>
                        Contact Details
                    </h3>
                    
                    <div class="flex flex-col gap-1">
                        <label class="text-[#2C3E50] font-slabo text-sm font-medium">Email</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <i class='bx bx-envelope text-[#BCC6CC]'></i>
                            </span>
                            <input type="email" class="input w-full pl-10 rounded-[10px] border-[#BCC6CC] font-slabo py-2" required placeholder="mail@soliera.com">
                        </div>
                    </div>
                    
                    <div class="flex flex-col gap-1 mt-4">
                        <label class="text-[#2C3E50] font-slabo text-sm font-medium">Phone Number</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <i class='bx bx-mobile text-[#BCC6CC]'></i>
                            </span>
                            <input type="tel" class="input w-full pl-10 rounded-[10px] border-[#BCC6CC] font-slabo py-2" required>
                        </div>
                    </div>
                </div>

                <!-- Section 3: Account Security -->
                <div class="border-b border-[#BCC6CC] pb-6">
                    <h3 class="text-lg font-semibold text-[#2C3E50] font-mate mb-4 flex items-center gap-2">
                        <i class='bx bx-lock-alt text-[#2C3E50]'></i>
                        Account Security
                    </h3>
                    
                    <!-- Password -->
<div class="flex flex-col gap-1">
    <label for="password" class="text-[#2C3E50] font-slabo text-sm font-medium">Password</label>
    <div class="relative">
        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
            <i class='bx bx-key text-[#BCC6CC]'></i>
        </span>
        <input id="password" type="password" oninput="validatePasswords()" class="input w-full pl-10 rounded-[10px] border-[#BCC6CC] font-slabo py-2" required placeholder="••••••••">
        <span class="password-toggle absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer" onclick="togglePassword(this)">
            <i class='bx bx-hide text-[#BCC6CC]'></i>
        </span>
    </div>
</div>

<!-- Confirm Password -->
<div class="flex flex-col gap-1 mt-4">
    <label for="confirmPassword" class="text-[#2C3E50] font-slabo text-sm font-medium">Confirm Password</label>
    <div class="relative">
        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
            <i class='bx bx-key text-[#BCC6CC]'></i>
        </span>
        <input id="confirmPassword" type="password" oninput="validatePasswords()" class="input w-full pl-10 rounded-[10px] border-[#BCC6CC] font-slabo py-2" required placeholder="••••••••">
        <span class="password-toggle absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer" onclick="togglePassword(this)">
            <i class='bx bx-hide text-[#BCC6CC]'></i>
        </span>
    </div>
    <p id="passwordMatchMessage" class="text-xs font-slabo mt-1  text-[#e74c3c] hidden">Passwords do not match</p>
</div>
                    </div>
                <!-- Section 4: Terms and Agreement -->
                <div class="pb-4">
                    <div class="flex items-start">
                        <input type="checkbox" id="terms" class="mt-1 rounded-[4px] border-[#BCC6CC] text-[#2C3E50] focus:ring-[#2C3E50]">
                        <label for="terms" class="ml-2 text-sm text-[#2C3E50] font-slabo">
                            I agree to Soliera's <a href="#" class="text-[#2C3E50] underline">Terms of Service</a> and <a href="#" class="text-[#2C3E50] underline">Privacy Policy</a>
                        </label>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn bg-[#2C3E50] hover:bg-[#1a2635] text-white border-none rounded-[10px] font-slabo py-3 w-full">
                    Complete Registration
                </button>

                <div class="divider divider-neutral text-black">OR </div>

                <div class="text-center space-y-2">
                    <a href="/login" class="text-sm text-[#2C3E50] font-slabo">Already Have an Account</a>
                   
                </div>
            </form>
        </div>
    
</section>




    <script src="{{asset('javascript/password.js')}}">
    </script>

<script src="{{asset('javascript/photoupload.js')}}">
    </script>
</body>
</html>