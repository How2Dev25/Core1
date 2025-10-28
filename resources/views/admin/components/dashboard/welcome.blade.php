@if(session('showwelcome'))
    <div class="mb-6 animate-fadeIn" id="welcomeCard" data-aos="fade-up" data-aos-duration="1000">
        <div
            class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-[#001f54] via-[#003366] to-[#002855] shadow-2xl">
            <div
                class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC4wNSI+PHBhdGggZD0iTTM2IDE0YzMuMzEgMCA2LTIuNjkgNi02cy0yLjY5LTYtNi02LTYgMi42OS02IDYgMi42OSA2IDYgNnptMC0xMGMzLjMxIDAgNi0yLjY5IDYtNnMtMi42OS02LTYtNi02IDIuNjktNiA2IDIuNjkgNiA2IDZ6Ii8+PC9nPjwvZz48L3N2Zz4=')] opacity-20">
            </div>

            <div class="relative p-6 md:p-8">
                <button onclick="dismissWelcome()"
                    class="absolute top-4 right-4 text-white/70 hover:text-white transition-colors">
                    <i class="fas fa-times text-xl"></i>
                </button>

                <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-center">
                    <!-- Avatar Section -->
                    <div class="md:col-span-3 flex justify-center">
                        <div class="relative">
                            @php
                                $user = Auth::user();
                                $photo = $user->additionalInfo->adminphoto ?? null;
                                $name = $user->employee_name ?? $user->name ?? 'AA';
                                $initials = strtoupper(substr(explode(' ', trim($name))[0], 0, 2));
                            @endphp

                            <div
                                class="w-28 h-28 md:w-32 md:h-32 rounded-full ring-4 ring-yellow-400 ring-offset-4 ring-offset-[#003366] overflow-hidden shadow-xl flex items-center justify-center bg-blue-500">
                                @if($photo && file_exists(public_path($photo)))
                                    <img src="{{ asset($photo) }}" alt="Profile Photo" class="w-full h-full object-cover" />
                                @else
                                    <span class="text-white font-bold text-2xl">{{ $initials }}</span>
                                @endif
                            </div>
                            <div class="absolute -bottom-2 -right-2 bg-yellow-400 rounded-full p-2 shadow-lg">
                                <i class="fas fa-star text-blue-900"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Welcome Text -->
                    <div class="md:col-span-9 text-center md:text-left text-white">
                        <h2 class="text-3xl md:text-4xl font-bold mb-2">
                            Welcome back, {{ Auth::user()->employee_name }}!
                        </h2>

                        <p class="text-lg text-white/90 mb-4">
                            We hope you're enjoying your work today
                        </p>

                        <div class="flex flex-wrap gap-2 justify-center md:justify-start mb-4">
                            <span class="px-4 py-1.5 bg-yellow-400 text-blue-900 rounded-full text-sm font-semibold">
                                <i class="fas fa-user-shield mr-1"></i> {{ Auth::user()->role }}
                            </span>
                            <span
                                class="px-4 py-1.5 bg-white/20 backdrop-blur-sm text-white rounded-full text-sm font-semibold border border-white/30">
                                <i class="fas fa-circle-check mr-1"></i> {{ Auth::user()->status ?? 'Active' }}
                            </span>
                        </div>

                        <a href="/adminprofile"
                            class="inline-flex items-center gap-2 px-6 py-3 bg-yellow-400 hover:bg-yellow-500 text-blue-900 font-semibold rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                            <i class="fas fa-user-circle"></i>
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