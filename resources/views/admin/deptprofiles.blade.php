<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


    <script src="https://unpkg.com/lucide@latest"></script>

    <title>{{$title}} - Employee Profile</title>
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



                <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 transition-slow ">
                    {{-- Subsystem Name --}}
                    <div class="pb-5 border-b border-base-300 animate-fadeIn">
                        <h1 class="text-2xl font-bold bg-white bg-clip-text text-[#191970]">Employee Profile</h1>
                    </div>
                    {{-- Subsystem Name --}}


                    <section class="w-full min-h-screen mt-5">
                        @if (session('success'))
                            <div id="success-message"
                                class="mb-6 bg-gradient-to-r from-green-500 to-green-600 text-white px-6 py-4 rounded-xl shadow-lg flex items-center space-x-4 animate-slide-down">
                                <div class="flex-shrink-0">
                                    <div
                                        class="w-12 h-12 bg-white rounded-full flex items-center justify-center animate-bounce-in">
                                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-bold text-lg">Success!</h4>
                                    <p class="text-green-100">{{ session('success') }}</p>
                                </div>
                                <button onclick="closeSuccessMessage()"
                                    class="flex-shrink-0 text-white hover:text-green-100 transition-colors">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        @endif
                        <!-- Profile Form -->
                    <div
                        class="bg-white rounded-3xl shadow-2xl overflow-hidden transform transition-all duration-300">
                        <!-- Header with improved gradient and animations -->
                        <div class="relative bg-gradient-to-br from-blue-900 via-blue-800 to-blue-950 px-8 py-12 overflow-hidden">
                            <!-- Animated background elements -->




                            <!-- Header content -->
                            <div class="relative z-10 flex items-center space-x-5">
                                <div
                                    class="bg-gradient-to-br from-yellow-400 to-yellow-500 p-3 rounded-2xl shadow-lg transform transition-transform hover:scale-110 hover:rotate-3 duration-300">
                                    <svg class="w-10 h-10 text-blue-900" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div>
                                    <h2 class="text-3xl font-bold text-white mb-1 tracking-tight">{{ $deptAccount->employee_name }}</h2>
                                    <p class="text-yellow-300 text-sm font-medium flex items-center gap-2">
                                        <span class="w-2 h-2 bg-yellow-400 rounded-full animate-pulse"></span>
                                        Employee Profile
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Profile Form -->
                        <form action="" method="POST" enctype="multipart/form-data" class="p-8 space-y-8">
                            <!-- Profile Photo Section with enhanced styling -->
                            <div
                                class="relative bg-gradient-to-br from-blue-50 via-yellow-50/30 to-blue-50 p-8 rounded-2xl border-2 border-blue-100 hover:border-yellow-400 transition-all duration-300 group">
                                <!-- Decorative corner accents -->
                                <div
                                    class="absolute top-0 left-0 w-16 h-16 border-t-4 border-l-4 border-yellow-400 rounded-tl-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                </div>
                                <div
                                    class="absolute bottom-0 right-0 w-16 h-16 border-b-4 border-r-4 border-blue-400 rounded-br-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                </div>

                                <div class="flex flex-col md:flex-row items-center md:space-x-8">
                                    <div class="relative mb-6 md:mb-0">
                                        <!-- Profile photo container with enhanced effects -->
                                        <div
                                            class="relative w-36 h-36 rounded-full overflow-hidden bg-gradient-to-br from-blue-800 to-blue-900 flex items-center justify-center ring-4 ring-yellow-400 shadow-xl transition-all duration-300 hover:ring-6 hover:ring-yellow-300 hover:shadow-2xl hover:scale-105">
                                        @php
                                            $user = $deptAccount;
                                            $photo = optional($user->additionalInfo)->adminphoto;
                                            $name = $user->employee_name ?? 'AA';
                                            $firstName = explode(' ', trim($name))[0] ?? '';
                                            $initials = strtoupper(substr($firstName, 0, 2));
                                        @endphp

                                            {{-- Profile image --}}
                                            <img id="preview-photo" src="{{ asset($photo) }}" alt="Profile Photo"
                                                class="w-full h-full object-cover transition-all duration-500 ease-in-out {{ $photo ? '' : 'hidden' }}">

                                            {{-- Placeholder initials --}}
                                            <span id="preview-placeholder"
                                                class="text-5xl font-bold text-yellow-400 {{ $photo ? 'hidden' : '' }}">
                                                {{ $initials }}
                                            </span>
                                        </div>

                                        <!-- Camera badge with improved styling -->

                                    </div>

                                    <!-- Profile info badges -->
                                    <div class="flex-1 text-center md:text-left">
                                        <div class="flex flex-wrap gap-3 justify-center md:justify-start">
                                            <span
                                                class="px-4 py-2 bg-blue-100 text-blue-800 rounded-full text-sm font-semibold shadow-sm hover:shadow-md transition-shadow">
                                                {{ $deptAccount->dept_name }}
                                            </span>
                                            <span
                                                class="px-4 py-2 bg-yellow-100 text-yellow-800 rounded-full text-sm font-semibold shadow-sm hover:shadow-md transition-shadow">
                                                {{ $deptAccount->role }}
                                            </span>
                                            <span
                                                class="px-4 py-2 bg-green-100 text-green-800 rounded-full text-sm font-semibold shadow-sm hover:shadow-md transition-shadow flex items-center gap-2">
                                                <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                                                {{ $deptAccount->status }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Department Info with improved styling -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Department Name -->
                                <div class="group">
                                    <label class="block text-sm font-bold text-blue-900 mb-3 flex items-center gap-2">
                                        <span class="w-1 h-4 bg-blue-600 rounded-full"></span>
                                        Department Name
                                    </label>
                                    <div class="relative">
                                        <input type="text" name="dept_name" value="{{ old('dept_name', $deptAccount->dept_name) }}"
                                            class="w-full px-4 py-3.5 border-2 border-gray-200 rounded-xl bg-gray-50 cursor-not-allowed text-gray-600 font-medium"
                                            readonly placeholder="Enter department name" required>
                                        <div class="absolute right-3 top-1/2 -translate-y-1/2">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <!-- Employee Name -->
                                <div class="group">
                                    <label class="block text-sm font-bold text-blue-900 mb-3 flex items-center gap-2">
                                        <span class="w-1 h-4 bg-blue-600 rounded-full"></span>
                                        Employee Name
                                    </label>
                                    <input disabled type="text" name="employee_name"
                                        value="{{ old('employee_name', $deptAccount->employee_name) }}"
                                        class="w-full px-4 py-3.5 border-2 border-gray-200 rounded-xl bg-gray-50 text-gray-600 font-medium cursor-not-allowed"
                                        placeholder="Enter employee name" required>
                                </div>

                                <!-- Employee ID -->
                                <div class="group">
                                    <label class="block text-sm font-bold text-blue-900 mb-3 flex items-center gap-2">
                                        <span class="w-1 h-4 bg-yellow-500 rounded-full"></span>
                                        Employee ID
                                    </label>
                                    <div class="relative">
                                        <input type="text" name="employee_id" value="{{ old('employee_id', $deptAccount->employee_id) }}"
                                            class="w-full px-4 py-3.5 border-2 border-gray-200 rounded-xl bg-gray-50 cursor-not-allowed text-gray-600 font-medium"
                                            readonly placeholder="Auto-generated employee ID">
                                        <div class="absolute right-3 top-1/2 -translate-y-1/2">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <!-- Employee Status -->
                                <div class="group">
                                    <label class="block text-sm font-bold text-blue-900 mb-3 flex items-center gap-2">
                                        <span class="w-1 h-4 bg-yellow-500 rounded-full"></span>
                                        Employee Status
                                    </label>
                                    <div class="relative">
                                        <input type="text" name="status" value="{{ old('employee_status', $deptAccount->status) }}"
                                            class="w-full px-4 py-3.5 border-2 border-gray-200 rounded-xl bg-gray-50 cursor-not-allowed text-gray-600 font-medium"
                                            readonly placeholder="e.g. Active">
                                        <div class="absolute right-3 top-1/2 -translate-y-1/2">
                                            <span class="flex h-3 w-3">
                                                <span
                                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                                <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="group">
                                    <label class="block text-sm font-bold text-blue-900 mb-3 flex items-center gap-2">
                                        <span class="w-1 h-4 bg-blue-600 rounded-full"></span>
                                        Email Address
                                    </label>
                                    <div class="relative">
                                        <input disabled type="email" name="email" value="{{ old('email', $deptAccount->email) }}"
                                            class="w-full px-4 py-3.5 pl-11 border-2 border-gray-200 rounded-xl bg-gray-50 text-gray-600 font-medium cursor-not-allowed"
                                            placeholder="employee@company.com">
                                        <div class="absolute left-3 top-1/2 -translate-y-1/2">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <!-- Role -->
                                <div class="group">
                                    <label class="block text-sm font-bold text-blue-900 mb-3 flex items-center gap-2">
                                        <span class="w-1 h-4 bg-yellow-500 rounded-full"></span>
                                        Role
                                    </label>
                                    <div class="relative">
                                        <input readonly type="text" name="role" value="{{ old('role', $deptAccount->role) }}"
                                            class="w-full px-4 py-3.5 pl-11 border-2 border-gray-200 rounded-xl bg-gray-50 cursor-not-allowed text-gray-600 font-medium"
                                            placeholder="e.g. Department Admin">
                                        <div class="absolute left-3 top-1/2 -translate-y-1/2">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Password Section placeholder -->
                            <!-- Buttons placeholder -->
                        </form>
                    </div>


            </div>
            </section>




            <style>
                @keyframes fadeIn {
                    from {
                        opacity: 0;
                        transform: translateY(-20px);
                    }

                    to {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }

                .animate-fade-in {
                    animation: fadeIn 0.6s ease-out;
                }

                .form-group {
                    transition: all 0.3s ease;
                }

                .form-group:hover {
                    transform: translateY(-2px);
                }

                input:focus,
                textarea:focus {
                    transform: scale(1.01);
                }




                .shadow-3xl {
                    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
                }
            </style>

            <script>
                // Preview uploaded photo with animation
                document.getElementById('adminphoto').addEventListener('change', function (e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            const preview = document.getElementById('preview-photo');
                            const placeholder = document.getElementById('preview-placeholder');
                            preview.src = e.target.result;
                            preview.classList.remove('hidden');
                            preview.style.opacity = '0';

                            setTimeout(() => {
                                preview.style.transition = 'opacity 0.5s ease-in';
                                preview.style.opacity = '1';
                            }, 10);

                            if (placeholder) {
                                placeholder.style.opacity = '0';
                                setTimeout(() => placeholder.classList.add('hidden'), 300);
                            }
                        }
                        reader.readAsDataURL(file);
                    }
                });

                // Add floating animation to form groups on scroll
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.style.opacity = '0';
                            entry.target.style.transform = 'translateY(20px)';
                            setTimeout(() => {
                                entry.target.style.transition = 'all 0.6s ease-out';
                                entry.target.style.opacity = '1';
                                entry.target.style.transform = 'translateY(0)';
                            }, 100);
                        }
                    });
                });

                document.querySelectorAll('.form-group').forEach(group => {
                    observer.observe(group);
                });
            </script>


            <script>
                function closeSuccessMessage() {
                    const message = document.getElementById('success-message');
                    if (message) {
                        message.classList.add('opacity-0', 'transition', 'duration-500'); // smooth fade out
                        setTimeout(() => message.remove(), 500); // remove from DOM after fade
                    }
                }

                // Optional: auto-close after 5 seconds
                setTimeout(closeSuccessMessage, 5000);
            </script>


            <!-- Initialize Lucide Icons -->
            <script>
                lucide.createIcons();
            </script>


            </main>





        </div>
        </div>


        {{-- modals --}}




        @livewireScripts
        @include('javascriptfix.soliera_js')
    </body>
@endauth



</html>