@if(session('showwelcome'))
    <div class="card bg-gradient-to-r from-[#001f54] to-[#003366] text-primary-content shadow-2xl mb-8" id="welcomeCard"
        data-aos="fade-up" data-aos-duration="1000">
        <div class="card-body relative">
            <!-- Close (X) Button on Top Right -->
            <button class="absolute top-4 right-4 text-primary-content/70 hover:text-red-400 transition"
                onclick="dismissWelcome()">
                <i class="fa-solid fa-xmark w-6 h-6"></i>
            </button>

            <!-- Grid Layout -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 items-center">
                <!-- Avatar (Large & Centered Vertically) -->
                <div class="flex justify-center md:justify-start md:col-span-1">
                    @php
                        $user = Auth::user();
                        $photo = $user->additionalInfo->adminphoto ?? null;
                        $name = $user->employee_name ?? $user->name ?? 'AA';
                        $initials = strtoupper(substr(explode(' ', trim($name))[0], 0, 2));
                    @endphp

                    <div
                        class="avatar relative w-28 h-28 md:w-32 md:h-32 rounded-full overflow-hidden bg-blue-500 shadow-lg flex items-center justify-center">
                        @if($photo && file_exists(public_path($photo)))
                            <img src="{{ asset($photo) }}" alt="Profile Photo" class="w-full h-full object-cover">
                        @else
                            <span class="text-white font-bold text-lg md:text-xl">{{ $initials }}</span>
                        @endif
                    </div>
                </div>

                <!-- Welcome Text + Position/Role -->
                <div class="flex flex-col items-center md:items-start col-span-3">
                    <h2 class="text-2xl md:text-3xl font-bold mb-1 text-center md:text-left">
                        Welcome back, {{ Auth::user()->employee_name }}!
                    </h2>
                    <p class="text-base md:text-lg opacity-90 mt-1 text-center md:text-left">
                        We hope you're enjoying your work today
                    </p>

                    <!-- Badges -->
                    <div class="flex items-center gap-2 mt-3 justify-center md:justify-start flex-wrap">

                        <div class="badge badge-secondary">{{Auth::user()->role}}</div>

                        <div class="badge badge-outline badge-primary-content">
                            {{ Auth::user()->status ?? 'Active' }}
                        </div>
                    </div>

                    <!-- View My Profile Button -->
                    <div class="flex justify-center md:justify-start mt-6 w-full">
                        <a href="/adminprofile"
                            class="btn btn-primary flex items-center gap-2 px-4 py-2 text-sm md:text-base w-full md:w-auto">
                            <i class="fa-solid fa-user w-5 h-5"></i>
                            <span>View My Profile</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function dismissWelcome() {
            document.getElementById('welcomeCard').style.display = 'none';
        }
    </script>

@endif
{{-- greetings --}}