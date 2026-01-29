<div class="bg-white rounded-2xl overflow-hidden">
    <!-- Carousel Content -->
    <div class="p-6">
        @if($promos->isNotEmpty())
            <div class="relative">
                <!-- Carousel Container -->
                <div class="overflow-hidden rounded-xl">
                    <div id="promoCarouselSlides" class="flex transition-transform duration-500 ease-in-out">
                        @foreach($promos as $index => $promo)
                            <div class="flex-shrink-0 w-full px-2">
                                <div
                                    class="relative rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300">
                                    <!-- Image Only - Same height as events (h-80) -->
                                    <div class="relative h-80 overflow-hidden">
                                        <img src="{{ $promo->hotelpromophoto ?? 'default-promo.jpg' }}"
                                            alt="{{ $promo->hotelpromoname ?? 'Promo' }}"
                                            class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" />
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Mobile Navigation Buttons -->
                <div class="flex sm:hidden justify-center mt-4 gap-3">
                    <button id="promoPrevBtnMobile"
                        class="p-3 bg-blue-900 hover:bg-blue-800 text-yellow-400 rounded-lg transition-colors shadow-lg">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button id="promoNextBtnMobile"
                        class="p-3 bg-blue-900 hover:bg-blue-800 text-yellow-400 rounded-lg transition-colors shadow-lg">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>

                <!-- Navigation Dots -->
                <div class="flex justify-center mt-6 gap-2">
                    @foreach($promos as $index => $promo)
                        <button
                            class="promo-carousel-dot w-2.5 h-2.5 rounded-full bg-gray-300 hover:bg-gray-400 transition-all duration-300"
                            data-index="{{ $index }}"></button>
                    @endforeach
                </div>

                <!-- Counter -->
                <div class="text-center mt-4">
                    <p class="text-sm text-gray-500">
                        <span id="promoCurrentSlide" class="font-bold text-blue-900">1</span>
                        <span class="mx-1">of</span>
                        <span class="font-bold text-blue-900">{{ $promos->count() }}</span>
                    </p>
                </div>
            </div>
        @else
            <div class="text-center py-12">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-4">
                    <i class="fas fa-tags text-4xl text-gray-400"></i>
                </div>
                <h4 class="text-lg font-semibold text-gray-700 mb-2">No Promos Available</h4>
                <p class="text-gray-500 text-sm">Check back soon for special offers</p>
            </div>
        @endif
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const slides = document.getElementById('promoCarouselSlides');
        const dots = document.querySelectorAll('.promo-carousel-dot');
        const currentSlideEl = document.getElementById('promoCurrentSlide');
        const totalSlides = slides ? slides.children.length : 0;

        if (totalSlides === 0) return;

        let currentIndex = 0;
        let autoplayInterval;

        const prevBtnMobile = document.getElementById('promoPrevBtnMobile');
        const nextBtnMobile = document.getElementById('promoNextBtnMobile');

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

        // Event listeners for mobile buttons
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