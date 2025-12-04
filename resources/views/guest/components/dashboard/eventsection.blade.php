<div class="bg-gradient-to-br from-white to-indigo-50 rounded-xl shadow-md overflow-hidden border border-indigo-100">
    <!-- Header -->
    <div class="p-4 bg-blue-900 relative overflow-hidden">
        <div class="relative flex items-center justify-between">
            <div class="flex items-center gap-2">
                <div class="p-2 bg-blue-900 rounded-lg shadow-lg ">
                    <i class="fa-solid fa-calendar-days text-yellow-400 text-sm"></i>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-white">Featured Events</h3>
                </div>
            </div>
            <div class="hidden lg:flex items-center gap-1">
                <button id="prevBtn"
                    class="p-1.5 bg-white/20 hover:bg-white/30 backdrop-blur-sm rounded-md transition-all duration-300 border border-white/30 shadow-sm group">
                    <i
                        class="fas fa-chevron-left text-yellow-400 text-xs group-hover:-translate-x-0.5 transition-transform"></i>
                </button>
                <button id="nextBtn"
                    class="p-1.5 bg-white/20 hover:bg-white/30 backdrop-blur-sm rounded-md transition-all duration-300 border border-white/30 shadow-sm group">
                    <i
                        class="fas fa-chevron-right text-yellow-400 text-xs group-hover:translate-x-0.5 transition-transform"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Carousel Content -->
    <div class="p-0">
        @if($events->isNotEmpty())
            <div class="relative">
                <!-- Carousel Container -->
                <div class="overflow-hidden">
                    <div id="carouselSlides" class="flex transition-transform duration-500 ease-out">
                        @foreach($events as $index => $event)
                            <div class="flex-shrink-0 w-full">
                                <div class="group relative overflow-hidden">
                                    <!-- Image Container - Covering entire carousel area -->
                                    <div class="relative h-64 w-full overflow-hidden">
                                        <img src="{{ asset(is_array($event->eventtype_photo) ? $event->eventtype_photo[0] : $event->eventtype_photo) }}"
                                            alt="{{ $event->eventtype_name }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />

                                        <!-- Gradient Overlay -->
                                        <div
                                            class="absolute inset-0 bg-gradient-to-t from-gray-900/90 via-gray-900/50 to-transparent">
                                        </div>

                                        <!-- Content Overlay -->
                                        <div class="absolute bottom-0 left-0 right-0 p-4">
                                           

                                            <!-- Event Details -->
                                         
                                            <!-- CTA Button - Colored -->
                                            <a href="/eventbookingguest/{{ $event->eventtype_ID }}"
                                                class="block w-full py-3 bg-yellow-400 text-blue-900  hover:bg-yellow-300  font-bold rounded-lg transition-all duration-300 flex items-center justify-center gap-2 group-hover:scale-105 shadow-lg">
                                                <i class="fas fa-calendar-check text-white"></i>
                                                <span class="text-sm">Reserve Now</span>
                                                <i
                                                    class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Mobile Navigation Buttons -->
                <div
                    class="flex lg:hidden justify-center mt-3 gap-2 absolute bottom-16 left-1/2 transform -translate-x-1/2 z-10">
                    <button id="prevBtnMobile"
                        class="p-2 bg-white/20 hover:bg-white/30 backdrop-blur-md border border-white/30 text-yellow-400 rounded-md transition-all duration-300 shadow-sm hover:scale-105">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button id="nextBtnMobile"
                        class="p-2 bg-white/20 hover:bg-white/30 backdrop-blur-md border border-white/30 text-yellow-400 rounded-md transition-all duration-300 shadow-sm hover:scale-105">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>

                <!-- Navigation Dots -->
                <div class="flex justify-center mt-3 gap-1 absolute bottom-4 left-1/2 transform -translate-x-1/2 z-10">
                    @foreach($events as $index => $event)
                        <button
                            class="carousel-dot h-1.5 rounded-full bg-white/50 hover:bg-yellow-400 transition-all duration-300"
                            data-index="{{ $index }}"></button>
                    @endforeach
                </div>

                <!-- Counter -->
                <div class="text-center mt-2 absolute top-4 right-4 z-10">
                    <div
                        class="inline-flex items-center gap-1 px-2 py-1 bg-black/50 backdrop-blur-sm rounded-full shadow-xs border border-white/20">
                        <span id="currentSlide" class="font-bold text-yellow-400 text-xs">1</span>
                        <span class="text-white/70 text-xs">/</span>
                        <span class="font-bold text-white text-xs">{{ $events->count() }}</span>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-8 p-4">
                <div
                    class="inline-flex items-center justify-center w-12 h-12 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-full mb-3 shadow-sm">
                    <i class="fas fa-calendar-times text-xl text-indigo-400"></i>
                </div>
                <h4 class="text-sm font-bold text-gray-800 mb-1">No Events Available</h4>
                <p class="text-gray-500 text-xs">Check back soon for upcoming events</p>
            </div>
        @endif
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const slides = document.getElementById('carouselSlides');
        const dots = document.querySelectorAll('.carousel-dot');
        const currentSlideEl = document.getElementById('currentSlide');
        const totalSlides = slides ? slides.children.length : 0;

        if (totalSlides === 0) return;

        let currentIndex = 0;
        let autoplayInterval;

        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const prevBtnMobile = document.getElementById('prevBtnMobile');
        const nextBtnMobile = document.getElementById('nextBtnMobile');

        function updateCarousel(index) {
            currentIndex = (index + totalSlides) % totalSlides;
            const slideWidth = slides.offsetWidth;
            slides.style.transform = `translateX(-${slideWidth * currentIndex}px)`;

            dots.forEach((dot, i) => {
                if (i === currentIndex) {
                    dot.classList.remove('bg-white/50', 'w-1.5');
                    dot.classList.add('bg-yellow-400', 'w-4');
                } else {
                    dot.classList.remove('bg-yellow-400', 'w-4');
                    dot.classList.add('bg-white/50', 'w-1.5');
                }
            });

            if (currentSlideEl) {
                currentSlideEl.textContent = currentIndex + 1;
            }
        }

        function nextSlide() {
            updateCarousel(currentIndex + 1);
        }

        function prevSlide() {
            updateCarousel(currentIndex - 1);
        }

        function startAutoplay() {
            stopAutoplay();
            autoplayInterval = setInterval(nextSlide, 5000);
        }

        function stopAutoplay() {
            if (autoplayInterval) {
                clearInterval(autoplayInterval);
            }
        }

        // Event listeners for dots
        dots.forEach(dot => {
            dot.addEventListener('click', () => {
                stopAutoplay();
                updateCarousel(parseInt(dot.dataset.index));
                startAutoplay();
            });
        });

        // Event listeners for buttons
        if (prevBtn) prevBtn.addEventListener('click', () => { stopAutoplay(); prevSlide(); startAutoplay(); });
        if (nextBtn) nextBtn.addEventListener('click', () => { stopAutoplay(); nextSlide(); startAutoplay(); });
        if (prevBtnMobile) prevBtnMobile.addEventListener('click', () => { stopAutoplay(); prevSlide(); startAutoplay(); });
        if (nextBtnMobile) nextBtnMobile.addEventListener('click', () => { stopAutoplay(); nextSlide(); startAutoplay(); });

        // Touch/Swipe support
        let touchStartX = 0;
        let touchEndX = 0;

        slides.addEventListener('touchstart', (e) => {
            touchStartX = e.changedTouches[0].screenX;
            stopAutoplay();
        });

        slides.addEventListener('touchend', (e) => {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
            startAutoplay();
        });

        function handleSwipe() {
            const swipeThreshold = 50;
            const diff = touchStartX - touchEndX;

            if (Math.abs(diff) > swipeThreshold) {
                if (diff > 0) {
                    nextSlide();
                } else {
                    prevSlide();
                }
            }
        }

        // Pause on hover
        slides.addEventListener('mouseenter', stopAutoplay);
        slides.addEventListener('mouseleave', startAutoplay);

        // Initialize
        updateCarousel(0);
        startAutoplay();

        // Handle window resize
        let resizeTimer;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(() => {
                updateCarousel(currentIndex);
            }, 250);
        });
    });
</script>