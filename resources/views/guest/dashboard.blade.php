<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    @vite('resources/css/app.css')
    <script src="{{ asset('javascript/chart.js') }}"></script>


    <script src="https://unpkg.com/lucide@latest"></script>

    <title>{{$title}} - Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    @livewireStyles
</head>

<style>
    .carousel-container::-webkit-scrollbar {
        display: none;
    }

    .stat-gradient {
        background: linear-gradient(135deg, var(--tw-gradient-from), var(--tw-gradient-to));
    }

    .floating-animation {
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-10px);
        }
    }

    .card-hover {
        transition: all 0.3s ease;
    }

    .card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    /* Scroll Animation Classes */
    .scroll-animate {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.6s ease-out;
    }

    .scroll-animate.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .scroll-animate-left {
        opacity: 0;
        transform: translateX(-30px);
        transition: all 0.6s ease-out;
    }

    .scroll-animate-left.visible {
        opacity: 1;
        transform: translateX(0);
    }

    .scroll-animate-right {
        opacity: 0;
        transform: translateX(30px);
        transition: all 0.6s ease-out;
    }

    .scroll-animate-right.visible {
        opacity: 1;
        transform: translateX(0);
    }

    .scroll-animate-scale {
        opacity: 0;
        transform: scale(0.8);
        transition: all 0.6s ease-out;
    }

    .scroll-animate-scale.visible {
        opacity: 1;
        transform: scale(1);
    }

    /* Counter Animation */
    .counter {
        font-variant-numeric: tabular-nums;
    }
</style>

<body>


    @auth('guest')

        <section class="bg-base-100">
            <div class="flex h-screen overflow-hidden">
                <!-- Sidebar -->
                @include('guest.components.dashboard.sidebar')

                <!-- Main content -->
                <div class="flex flex-col flex-1 overflow-hidden">
                    <!-- Navbar -->
                    @include('guest.components.dashboard.navbar')

                    <!-- Dashboard Content -->
                    <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 ">

                        <!-- Welcome Banner -->
                        <div class="scroll-animate">
                            @include('guest.components.dashboard.welcomeguest')
                        </div>

                        <!-- Main Grid Layout -->
                        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

                            <!-- Left Column: Stats & Charts -->
                            <div class="lg:col-span-8 space-y-6">

                                <!-- Quick Stats Grid -->
                                <div class="scroll-animate-left">
                                    @include('guest.components.dashboard.metric')
                                </div>

                                {{-- room showcase --}}
                                <div class="scroll-animate-right">
                                    @include('guest.components.dashboard.roomshowcase')
                                </div>

                                <!-- Facilities Grid -->
                                <div class="scroll-animate-scale">
                                    @include('guest.components.dashboard.facilitysection')
                                </div>

                               
                                <!-- Reservation Trends Chart -->

                            </div>

                            <!-- Right Column: Events, Rooms & Promos -->
                            <div class="lg:col-span-4 space-y-6">
                                <!-- Loyalty Status -->
                                <div class="scroll-animate">
                                    <livewire:loyalty-status />
                                </div>

                                 <!-- Current Promotion -->
                                 <div class="scroll-animate-left">
                                     @include('guest.components.dashboard.promotionsection')
                                 </div>
                                <!-- Upcoming Events -->
                                <div class="scroll-animate-right">
                                    @include('guest.components.dashboard.eventsection')
                                </div>



                                <!-- Points Breakdown -->

                                <!-- Featured Room -->


                            </div>


                        </div>



                    </main>
                </div>
            </div>
            <!-- Chart.js Scripts -->
            <script>
                function dismissWelcome() {
                    document.getElementById('welcomeCard').style.display = 'none';
                }

                // Scroll Animation and Counter
                document.addEventListener('DOMContentLoaded', function() {
                    const observerOptions = {
                        threshold: 0.1,
                        rootMargin: '0px 0px -50px 0px'
                    };

                    // Track which counters have been animated
                    const animatedCounters = new Set();

                    const observer = new IntersectionObserver(function(entries) {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                entry.target.classList.add('visible');

                                // Start counter animation for elements with counter class
                                const counters = entry.target.querySelectorAll('.counter');
                                counters.forEach(counter => {
                                    const counterId = counter.getAttribute('data-target') + '-' + counter.textContent;
                                    if (!animatedCounters.has(counterId)) {
                                        animatedCounters.add(counterId);
                                        animateCounter(counter);
                                    }
                                });
                            }
                        });
                    }, observerOptions);

                    // Observe all scroll-animate elements
                    document.querySelectorAll('.scroll-animate, .scroll-animate-left, .scroll-animate-right, .scroll-animate-scale').forEach(el => {
                        observer.observe(el);
                    });

                    // Also check for counters that are already visible on page load
                    const initialCounters = document.querySelectorAll('.counter');
                    initialCounters.forEach(counter => {
                        const rect = counter.getBoundingClientRect();
                        const isVisible = rect.top < window.innerHeight && rect.bottom > 0;
                        if (isVisible) {
                            const counterId = counter.getAttribute('data-target') + '-' + counter.textContent;
                            if (!animatedCounters.has(counterId)) {
                                animatedCounters.add(counterId);
                                animateCounter(counter);
                            }
                        }
                    });
                });

                // Counter Animation Function
                function animateCounter(element) {
                    const target = parseInt(element.getAttribute('data-target'));
                    const duration = 2000; // 2 seconds
                    const step = target / (duration / 16); // 60fps
                    let current = 0;

                    const timer = setInterval(() => {
                        current += step;
                        if (current >= target) {
                            current = target;
                            clearInterval(timer);
                        }
                        element.textContent = Math.floor(current).toLocaleString();
                    }, 16);
                }
            </script>
            @livewireScripts
            @include('javascriptfix.soliera_js')
        </section>




    @endauth

</body>

</html>