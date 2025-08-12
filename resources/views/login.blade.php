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
<body class="bg-base-200 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md">
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <h2 class="text-center text-2xl font-bold mb-4">Department Login</h2>

                {{-- Error Alert --}}
                @if ($errors->any())
                    <div class="alert alert-error mb-4">
                        <ul class="list-disc ml-4 text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Login Form --}}
                <form method="POST" action="/loginuser">
                    @csrf
                    <div class="form-control mb-3">
                        <label for="Dept_id" class="label">
                            <span class="label-text">Employee ID</span>
                        </label>
                        <input type="text" id="Dept_id" name="employee_id" value="{{ old('employee_id') }}" required class="input input-bordered w-full"/>
                    </div>

                    <div class="form-control mb-4">
                        <label for="password" class="label">
                            <span class="label-text">Password</span>
                        </label>
                        <input type="password" id="password" name="password" required class="input input-bordered w-full"/>
                    </div>

                    <button type="submit" class="btn btn-primary w-full">Login</button>
                </form>
            </div>
        </div>
    </div>

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
</body>
</html>
