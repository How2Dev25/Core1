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

    <title>{{$title}} - Dashboard</title>
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
                        <h1 class="text-2xl font-bold bg-white bg-clip-text text-[#191970]">My Profile</h1>
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
                            class="bg-white rounded-2xl shadow-2xl overflow-hidden transform transition-all duration-300 hover:shadow-3xl">
                            <!-- Header -->
                            <div
                                class="relative bg-gradient-to-r from-blue-900 via-blue-800 to-blue-900 px-8 py-10 overflow-hidden">
                                <div class="absolute top-0 right-0 w-40 h-40 bg-yellow-400 rounded-full opacity-20"></div>
                                <div class="absolute bottom-0 left-0 w-32 h-32 bg-yellow-400 rounded-full opacity-20"></div>
                                <div class="relative z-10 flex items-center space-x-4">
                                    <svg class="w-12 h-12 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <div>
                                        <h2 class="text-2xl font-bold text-white">Department Profile</h2>
                                        <p class="text-blue-200">Manage your department account information</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Profile Form -->
                            <form action="{{ route('department.profile.update') }}" method="POST"
                                enctype="multipart/form-data" class="p-8 space-y-8">
                                @csrf
                                @method('PUT')

                                <!-- Profile Photo -->
                                <div
                                    class="flex flex-col md:flex-row items-center md:space-x-8 bg-gradient-to-r from-blue-50 to-yellow-50 p-6 rounded-xl border-2 border-blue-100 hover:border-yellow-400 transition-all duration-300">
                                    <div class="relative group mb-4 md:mb-0">
                                        <div
                                            class="group w-32 h-32 rounded-full overflow-hidden bg-blue-800 flex items-center justify-center ring-4 ring-yellow-400 transition-all duration-300 hover:ring-8 hover:scale-105">

                                            @php
                                                $user = Auth::user();
                                                $photo = $user->additionalInfo->adminphoto ?? null;
                                                $name = $user->employee_name ?? 'AA';
                                                $firstName = explode(' ', trim($name))[0] ?? '';
                                                $initials = strtoupper(substr($firstName, 0, 2));
                                            @endphp

                                            {{-- Profile image (always present but maybe hidden) --}}
                                            <img id="preview-photo" src="{{ asset($photo) }} " alt="Profile Photo"
                                                class="w-full h-full object-cover transition-opacity duration-500 ease-in-out {{ $photo ? '' : 'hidden' }}">

                                            {{-- Placeholder initials --}}
                                            <span id="preview-placeholder"
                                                class="text-4xl font-bold text-yellow-400 {{ $photo ? 'hidden' : '' }}">
                                                {{ $initials }}
                                            </span>
                                        </div>
                                        <div class="absolute bottom-0 right-0 bg-yellow-400 p-2 rounded-full shadow-lg">
                                            <svg class="w-5 h-5 text-blue-900" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </div>
                                    </div>

                                    <div class="flex-1 text-center md:text-left">
                                        <label class="block text-lg font-semibold text-blue-900 mb-2">Profile Photo</label>
                                        <p class="text-sm text-gray-600 mb-3">Upload your department admin photo</p>
                                        <input type="file" name="adminphoto" id="adminphoto" accept="image/*"
                                            class="block w-full text-sm text-gray-700 file:mr-4 file:py-3 file:px-6 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-900 file:text-yellow-400 hover:file:bg-blue-800 transition-all duration-300 cursor-pointer">
                                    </div>
                                </div>

                                <!-- Department Info -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Department Name -->
                                    <div>
                                        <label class="block text-sm font-semibold text-blue-900 mb-2">Department
                                            Name</label>
                                        <input type="text" name="dept_name"
                                            value="{{ old('dept_name', Auth::user()->dept_name) }}"
                                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg bg-gray-100 cursor-not-allowed"
                                            readonly placeholder="Enter department name" required>
                                    </div>

                                    <!-- Employee Name -->
                                    <div>
                                        <label class="block text-sm font-semibold text-blue-900 mb-2">Employee Name</label>
                                        <input type="text" name="employee_name"
                                            value="{{ old('employee_name', Auth::user()->employee_name) }}"
                                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:border-blue-900 transition-all duration-300"
                                            placeholder="Enter employee name" required>
                                    </div>

                                    <!-- Employee ID -->
                                    <div>
                                        <label class="block text-sm font-semibold text-blue-900 mb-2">Employee ID</label>
                                        <input type="text" name="employee_id"
                                            value="{{ old('employee_id', Auth::user()->employee_id) }}"
                                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg bg-gray-100 cursor-not-allowed"
                                            readonly placeholder="Auto-generated employee ID">
                                    </div>

                                    <!-- Employee Status -->
                                    <div>
                                        <label class="block text-sm font-semibold text-blue-900 mb-2">Employee
                                            Status</label>
                                        <input type="text" name="status"
                                            value="{{ old('employee_status', Auth::user()->status) }}"
                                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg bg-gray-100 cursor-not-allowed"
                                            readonly placeholder="e.g. Active">
                                    </div>

                                    <!-- Email -->
                                    <div>
                                        <label class="block text-sm font-semibold text-blue-900 mb-2">Email</label>
                                        <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}"
                                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:border-blue-900 transition-all duration-300">
                                    </div>

                                    <!-- Role -->
                                    <div>
                                        <label class="block text-sm font-semibold text-blue-900 mb-2">Role</label>
                                        <input readonly type="text" name="role"
                                            value="{{ old('role', Auth::user()->role) }}"
                                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg bg-gray-100 cursor-not-allowed"
                                            placeholder="e.g. Department Admin">
                                    </div>
                                </div>

                                <!-- Password Section -->
                                <div class="pt-6 border-t border-gray-200">
                                    <h3 class="text-lg font-bold text-blue-900 mb-4 flex items-center">
                                        <svg class="w-5 h-5 mr-2 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Security Settings
                                    </h3>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label class="block text-sm font-semibold text-blue-900 mb-2">New
                                                Password</label>
                                            <input type="password" name="password"
                                                class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:border-blue-900 transition-all duration-300"
                                                placeholder="Leave blank to keep current">
                                        </div>

                                        <div>
                                            <label class="block text-sm font-semibold text-blue-900 mb-2">Confirm
                                                Password</label>
                                            <input type="password" name="password_confirmation"
                                                class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:border-blue-900 transition-all duration-300"
                                                placeholder="Confirm new password">
                                        </div>
                                    </div>
                                </div>

                                <!-- Buttons -->
                                <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                                    <button type="button" onclick="window.history.back()"
                                        class="px-6 py-3 border-2 border-blue-900 text-blue-900 font-semibold rounded-lg hover:bg-blue-50 transition-all duration-300">
                                        Cancel
                                    </button>
                                    <button type="submit"
                                        class="px-8 py-3 bg-gradient-to-r from-blue-900 to-blue-800 text-yellow-400 font-bold rounded-lg hover:from-blue-800 hover:to-blue-700 transition-all duration-300 shadow-lg hover:shadow-xl">
                                        Save Changes
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Info Banner -->
                        <div class="mt-8 bg-blue-900 rounded-xl p-6 shadow-lg">
                            <div class="flex items-start space-x-4">
                                <svg class="w-6 h-6 text-yellow-400 flex-shrink-0 mt-1" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                        clip-rule="evenodd" />
                                </svg>
                                <div>
                                    <h4 class="text-yellow-400 font-semibold mb-1">Privacy & Security</h4>
                                    <p class="text-blue-100 text-sm">Your information is encrypted and securely stored.
                                        We never share your personal details with third parties.</p>
                                </div>
                            </div>
                        </div>
            </div>
            </section>

            <!-- Confirmation Modal (DaisyUI) -->
            <dialog id="confirmModal" class="modal">
                <div class="modal-box">
                    <h3 class="font-bold text-lg text-blue-900">Confirm Profile Update</h3>
                    <p class="py-4 text-gray-600">
                        Are you sure you want to save these changes to your profile?
                    </p>
                    <div class="modal-action">
                        <button class="btn" id="cancelConfirm">Cancel</button>
                        <button class="btn btn-primary bg-blue-900 text-yellow-400 hover:bg-blue-800" id="confirmSave">Yes,
                            Save</button>
                    </div>
                </div>
            </dialog>

            <script>
                const form = document.querySelector("form");
                const modal = document.getElementById("confirmModal");
                const confirmSave = document.getElementById("confirmSave");
                const cancelConfirm = document.getElementById("cancelConfirm");

                form.addEventListener("submit", function (e) {
                    e.preventDefault();
                    modal.showModal();
                });

                cancelConfirm.addEventListener("click", function () {
                    modal.close();
                });

                confirmSave.addEventListener("click", function () {
                    modal.close();
                    form.submit();
                });
            </script>

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