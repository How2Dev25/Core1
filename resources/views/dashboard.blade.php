<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Soliera Hotel - Department Login</title>
    
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @vite('resources/css/app.css')
</head>
@auth
    

<body class="bg-base-200 min-h-screen flex items-center justify-center">

   <section class="flex flex-col gap-2">
       <h1>{{Auth::user()->employee_name}}</h1>
       <h1>{{Auth::user()->dept_name}}</h1>
       <a href="/logout" class="btn btn-error btn-sm">log-out</a>
   </section>

    <script>
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('mainNav');
            const heroHeight = document.querySelector('.hero')?.offsetHeight || 0;
            if (window.scrollY > heroHeight * 0.8) {
                navbar?.classList.add('scrolled');
            } else {
                navbar?.classList.remove('scrolled');
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <script>
        AOS.init({
            duration: 1000,
            once: true
        });
    </script>
    @else
    <div class="">
        <h1>You are not in session</h1>
    </div>

    @endauth
</body>
</html>
