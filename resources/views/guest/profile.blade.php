<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    @vite('resources/css/app.css')

    <script src="https://unpkg.com/lucide@latest"></script>

    <title>{{$title}} - Profile</title>
    @livewireStyles
</head>



@auth('guest')

    <style>
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
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
                    <div class="pb-5 border-b border-base-300 animate-fadeIn">
                        <h1 class="text-2xl font-bold bg-white bg-clip-text text-[#191970]">My Profile</h1>
                    </div>
                    {{-- Subsystem Name --}}


                    <section class="w-fullmin-h-screen mt-5">
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





                        <div class="max-w-5xl mx-auto">
                            <!-- Header with Animation -->

                            <!-- Profile Card -->
                            <div
                                class="bg-white rounded-2xl shadow-2xl overflow-hidden transform transition-all duration-300 hover:shadow-3xl">
                                <!-- Decorative Header -->
                                <div
                                    class="relative bg-gradient-to-r from-blue-900 via-blue-800 to-blue-900 px-8 py-12 overflow-hidden">
                                    <div
                                        class="absolute top-0 right-0 -mt-4 -mr-4 w-40 h-40 bg-yellow-400 rounded-full opacity-20">
                                    </div>
                                    <div
                                        class="absolute bottom-0 left-0 -mb-8 -ml-8 w-32 h-32 bg-yellow-400 rounded-full opacity-20">
                                    </div>
                                    <div class="relative z-10 flex items-center space-x-4">
                                        <svg class="w-12 h-12 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <div>
                                            <h2 class="text-2xl font-bold text-white">Personal Information</h2>
                                            <p class="text-blue-200">Keep your details up to date</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Profile Form -->
                                <form action="/guestupdate/{{ Auth::guard('guest')->user()->guestID }}" method="POST"
                                    enctype="multipart/form-data" class="p-8 space-y-8">
                                    @csrf
                                    @method('PUT')

                                    <!-- Photo Upload Section with Animation -->
                                    <div
                                        class="flex flex-col md:flex-row items-center md:space-x-8 p-6 bg-gradient-to-r from-blue-50 to-yellow-50 rounded-xl border-2 border-blue-100 transition-all duration-300 hover:border-yellow-400 hover:shadow-lg">
                                        <div class="relative group mb-4 md:mb-0">
                                            <div
                                                class="w-32 h-32 rounded-full overflow-hidden bg-gradient-to-br from-blue-900 to-blue-700 flex items-center justify-center ring-4 ring-yellow-400 transition-all duration-300 group-hover:ring-8 group-hover:scale-105">
                                                @if(Auth::guard('guest')->user()->guest_photo)
                                                    <img src="{{ asset(Auth::guard('guest')->user()->guest_photo) }}"
                                                        alt="Profile Photo" class="w-full h-full object-cover"
                                                        id="preview-photo">
                                                @else
                                                    <svg class="w-16 h-16 text-yellow-400" fill="currentColor"
                                                        viewBox="0 0 20 20" id="preview-placeholder">
                                                        <path fill-rule="evenodd"
                                                            d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    <img src="" alt="Profile Photo" class="w-full h-full object-cover hidden"
                                                        id="preview-photo">
                                                @endif
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
                                            <label class="block text-lg font-semibold text-blue-900 mb-2">Profile
                                                Photo</label>
                                            <p class="text-sm text-gray-600 mb-3">Upload your best photo for personalized
                                                service</p>
                                            <input type="file" name="guest_photo" id="guest_photo" accept="image/*"
                                                class="block w-full text-sm text-gray-700 file:mr-4 file:py-3 file:px-6 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-900 file:text-yellow-400 hover:file:bg-blue-800 file:transition-all file:duration-300 cursor-pointer">
                                            @error('guest_photo')
                                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Personal Information Grid -->
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <!-- Full Name -->
                                        <div class="form-group">
                                            <label for="guest_name"
                                                class="flex items-center text-sm font-semibold text-blue-900 mb-2">
                                                <svg class="w-5 h-5 mr-2 text-yellow-400" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                Full Name <span class="text-red-500 ml-1">*</span>
                                            </label>
                                            <input type="text" name="guest_name" id="guest_name"
                                                value="{{ old('guest_name', Auth::guard('guest')->user()->guest_name) }}"
                                                required placeholder="Enter your full name"
                                                class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:border-blue-900 transition-all duration-300 hover:border-blue-400">
                                            @error('guest_name')
                                                <p class="mt-1 text-sm text-red-600 flex items-center">
                                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>

                                        <!-- Email -->
                                        <div class="form-group">
                                            <label for="guest_email"
                                                class="flex items-center text-sm font-semibold text-blue-900 mb-2">
                                                <svg class="w-5 h-5 mr-2 text-yellow-400" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                                </svg>
                                                Email Address <span class="text-red-500 ml-1">*</span>
                                            </label>
                                            <input readonly type="email" name="guest_email" id="guest_email"
                                                value="{{ old('guest_email', Auth::guard('guest')->user()->guest_email) }}"
                                                required placeholder="your.email@example.com"
                                                class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:border-blue-900 transition-all duration-300 hover:border-blue-400">
                                            @error('guest_email')
                                                <p class="mt-1 text-sm text-red-600 flex items-center">
                                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>

                                        <!-- Mobile Number -->
                                        <div class="form-group">
                                            <label for="guest_mobile"
                                                class="flex items-center text-sm font-semibold text-blue-900 mb-2">
                                                <svg class="w-5 h-5 mr-2 text-yellow-400" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                                </svg>
                                                Mobile Number <span class="text-red-500 ml-1">*</span>
                                            </label>
                                            <input type="tel" name="guest_mobile" id="guest_mobile"
                                                value="{{ old('guest_mobile', Auth::guard('guest')->user()->guest_mobile) }}"
                                                required placeholder="+63 9XX XXX XXXX"
                                                class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:border-blue-900 transition-all duration-300 hover:border-blue-400">
                                            @error('guest_mobile')
                                                <p class="mt-1 text-sm text-red-600 flex items-center">
                                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>

                                        <!-- Birthday -->
                                        <div class="form-group">
                                            <label for="guest_birthday"
                                                class="flex items-center text-sm font-semibold text-blue-900 mb-2">
                                                <svg class="w-5 h-5 mr-2 text-yellow-400" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                Birthday <span class="text-red-500 ml-1">*</span>
                                            </label>
                                            <input type="date" name="guest_birthday" id="guest_birthday"
                                                value="{{ old('guest_birthday', Auth::guard('guest')->user()->guest_birthday) }}"
                                                required
                                                class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:border-blue-900 transition-all duration-300 hover:border-blue-400">
                                            @error('guest_birthday')
                                                <p class="mt-1 text-sm text-red-600 flex items-center">
                                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Address -->
                                    <div class="form-group">
                                        <label for="guest_address"
                                            class="flex items-center text-sm font-semibold text-blue-900 mb-2">
                                            <svg class="w-5 h-5 mr-2 text-yellow-400" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Address <span class="text-red-500 ml-1">*</span>
                                        </label>
                                        <textarea name="guest_address" id="guest_address" rows="3" required
                                            placeholder="Enter your complete address"
                                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:border-blue-900 transition-all duration-300 hover:border-blue-400 resize-none">{{ old('guest_address', Auth::guard('guest')->user()->guest_address) }}</textarea>
                                        @error('guest_address')
                                            <p class="mt-1 text-sm text-red-600 flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    <!-- Password Section -->
                                    <div class="pt-6 border-t-2 border-gray-200">
                                        <div class="flex items-center mb-4">
                                            <svg class="w-6 h-6 text-yellow-400 mr-3" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <div>
                                                <h3 class="text-lg font-bold text-blue-900">Security Settings</h3>
                                                <p class="text-sm text-gray-600">Update your password to keep your account
                                                    secure</p>
                                            </div>
                                        </div>

                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                                            <!-- New Password -->
                                            <div class="form-group">
                                                <label for="guest_password"
                                                    class="flex items-center text-sm font-semibold text-blue-900 mb-2">
                                                    <svg class="w-5 h-5 mr-2 text-yellow-400" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M18 8a6 6 0 01-7.743 5.743L10 14l-1 1-1 1H6v2H2v-4l4.257-4.257A6 6 0 1118 8zm-6-4a1 1 0 100 2 2 2 0 012 2 1 1 0 102 0 4 4 0 00-4-4z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    New Password
                                                </label>
                                                <input type="password" name="guest_password" id="guest_password"
                                                    placeholder="Leave blank to keep current"
                                                    class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:border-blue-900 transition-all duration-300 hover:border-blue-400">
                                                @error('guest_password')
                                                    <p class="mt-1 text-sm text-red-600 flex items-center">
                                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd"
                                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                        {{ $message }}
                                                    </p>
                                                @enderror
                                            </div>

                                            <!-- Confirm Password -->
                                            <div class="form-group">
                                                <label for="guest_password_confirmation"
                                                    class="flex items-center text-sm font-semibold text-blue-900 mb-2">
                                                    <svg class="w-5 h-5 mr-2 text-yellow-400" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    Confirm Password
                                                </label>
                                                <input type="password" name="guest_password_confirmation"
                                                    id="guest_password_confirmation" placeholder="Confirm new password"
                                                    class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:border-blue-900 transition-all duration-300 hover:border-blue-400">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Action Buttons -->
                                    <div
                                        class="flex flex-col sm:flex-row items-center justify-end space-y-3 sm:space-y-0 sm:space-x-4 pt-6 border-t-2 border-gray-200">
                                        <button type="button" onclick="window.history.back()"
                                            class="w-full sm:w-auto px-8 py-3 border-2 border-blue-900 rounded-lg text-blue-900 font-semibold hover:bg-blue-50 transition-all duration-300 transform hover:scale-105 flex items-center justify-center">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                            </svg>
                                            Cancel
                                        </button>
                                        <button type="submit"
                                            class="w-full sm:w-auto px-8 py-3 bg-gradient-to-r from-blue-900 to-blue-800 text-yellow-400 font-bold rounded-lg hover:from-blue-800 hover:to-blue-700 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center justify-center">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
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
                                <button class="btn btn-primary bg-blue-900 text-yellow-400 hover:bg-blue-800"
                                    id="confirmSave">Yes,
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

                        button {
                            position: relative;
                            overflow: hidden;
                        }

                        button::before {
                            content: '';
                            position: absolute;
                            top: 50%;
                            left: 50%;
                            width: 0;
                            height: 0;
                            border-radius: 50%;
                            background: rgba(255, 255, 255, 0.1);
                            transform: translate(-50%, -50%);
                            transition: width 0.6s, height 0.6s;
                        }

                        button:hover::before {
                            width: 300px;
                            height: 300px;
                        }

                        .shadow-3xl {
                            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
                        }
                    </style>

                    <script>
                        // Preview uploaded photo with animation
                        document.getElementById('guest_photo').addEventListener('change', function (e) {
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





        @livewireScripts
        @include('javascriptfix.soliera_js')
    </body>


@else


@endauth

<script src="{{asset('javascript/counting.js')}}"></script>

</html>