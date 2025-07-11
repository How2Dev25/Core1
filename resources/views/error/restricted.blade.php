<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:wght@700&family=Mate&family=Slabo+27px&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')

    <title>Document</title>
</head>
<body>
 
    <section class="bg-[#4a628a] min-h-screen flex items-center justify-center font-noto-serif px-4">
        <div class="card w-full max-w-md bg-base-100 shadow-xl rounded-box  transition-transform duration-300 hover:scale-[1.02]">
            <div class="card-body text-center p-10 space-y-4">
                
                <!-- Animated Lock Icon -->
                <div class="text-6xl text-secondarycolor mb-2 animate-pulse">
                    <i class='bx bx-lock-alt'></i>
                </div>
                
                <!-- Error Code -->
                <h1 class="text-7xl font-extrabold text-secondarycolor font-slabo">401</h1>
                
                <!-- Title -->
                <h2 class="text-2xl font-bold text-maincolor font-slabo">Unauthorized Access</h2>
                
                <!-- Description -->
                <p class="text-white font-mate text-sm px-2">
                    You don't have permission to access this page. Please log in or return to a safe page.
                </p>
                
                <!-- Go Back Button with Icon -->
                <a href="/logout" class="btn buttoncolor text-white rounded-box font-mate flex items-center justify-center gap-2 hover:gap-3 transition-all duration-200">
                    <i class='bx bx-arrow-back'></i>
                    Go Back
                </a>
            </div>
        </div>
    </section>
    
</body>
</html>