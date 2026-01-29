<div class="bg-white rounded-2xl  overflow-hidden">
    <!-- Header -->


    <!-- Carousel Content -->
    <div class="p-6">


        @if($events->isNotEmpty())
            <div class="relative">
                <!-- Carousel Container -->
                <div class="overflow-hidden rounded-xl">
                    <div id="carouselSlides" class="flex transition-transform duration-500 ease-in-out">
                        @foreach($events as $index => $event)
                            <div class="flex-shrink-0 w-full px-2">
                                <a href="#"
                                    class="group block relative rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300">
                                    <!-- Image -->
                                    <div class="relative h-80 overflow-hidden">
                                        <img src="{{ asset(is_array($event->eventtype_photo) ? $event->eventtype_photo[0] : $event->eventtype_photo) }}"
                                            alt="{{ $event->eventtype_name }}"
                                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />

                                        <!-- Gradient Overlay -->
                                        <div
                                            class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent">
                                        </div>

                                        <!-- Content Overlay -->
                                        <div class="absolute bottom-0 left-0 right-0 p-6">
                                            <div class="flex items-start justify-between mb-3">
                                                <div class="flex-1">
                                                   
                                                    <h4
                                                        class="text-2xl font-bold text-white mb-2 group-hover:text-yellow-400 transition-colors">
                                                        {{ $event->eventtype_name }}
                                                    </h4>
                                                  
                                                </div>
                                            </div>

                                            <!-- Event Details -->
                                           

                                            <!-- CTA Button -->
                                           
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Mobile Navigation Buttons -->
                <div class="flex sm:hidden justify-center mt-4 gap-3">
                    <button id="prevBtnMobile"
                        class="p-3 bg-blue-900 hover:bg-blue-800 text-yellow-400 rounded-lg transition-colors shadow-lg">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button id="nextBtnMobile"
                        class="p-3 bg-blue-900 hover:bg-blue-800 text-yellow-400 rounded-lg transition-colors shadow-lg">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>

                <!-- Navigation Dots -->
                <div class="flex justify-center mt-6 gap-2">
                    @foreach($events as $index => $event)
                        <button
                            class="carousel-dot w-2.5 h-2.5 rounded-full bg-gray-300 hover:bg-gray-400 transition-all duration-300"
                            data-index="{{ $index }}"></button>
                    @endforeach
                </div>

                <!-- Counter -->
                <div class="text-center mt-4">
                    <p class="text-sm text-gray-500">
                        <span id="currentSlide" class="font-bold text-blue-900">1</span>
                        <span class="mx-1">of</span>
                        <span class="font-bold text-blue-900">{{ $events->count() }}</span>
                    </p>
                </div>
            </div>
        @else
            <div class="text-center py-12">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-4">
                    <i class="fas fa-calendar-times text-4xl text-gray-400"></i>
                </div>
                <h4 class="text-lg font-semibold text-gray-700 mb-2">No Events Available</h4>
                <p class="text-gray-500 text-sm">Check back soon for upcoming events</p>
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
            // Ensure index is within bounds
            currentIndex = (index + totalSlides) % totalSlides;

            // Calculate transform
            const slideWidth = slides.offsetWidth;
            slides.style.transform = `translateX(-${slideWidth * currentIndex}px)`;

            // Update dots
            dots.forEach((dot, i) => {
                if (i === currentIndex) {
                    dot.classList.remove('bg-gray-300', 'w-2.5', 'h-2.5');
                    dot.classList.add('bg-blue-900', 'w-8', 'h-2.5');
                } else {
                    dot.classList.remove('bg-blue-900', 'w-8');
                    dot.classList.add('bg-gray-300', 'w-2.5', 'h-2.5');
                }
            });

            // Update counter
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
        if (prevBtn) {
            prevBtn.addEventListener('click', () => {
                stopAutoplay();
                prevSlide();
                startAutoplay();
            });
        }

        if (nextBtn) {
            nextBtn.addEventListener('click', () => {
                stopAutoplay();
                nextSlide();
                startAutoplay();
            });
        }

        if (prevBtnMobile) {
            prevBtnMobile.addEventListener('click', () => {
                stopAutoplay();
                prevSlide();
                startAutoplay();
            });
        }

        if (nextBtnMobile) {
            nextBtnMobile.addEventListener('click', () => {
                stopAutoplay();
                nextSlide();
                startAutoplay();
            });
        }

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