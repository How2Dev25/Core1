<div class="relative shadow-lg overflow-hidden w-full">
    <!-- Carousel Container -->
    <div class="carousel-container relative min-h-[600px]">
        @foreach($promos as $index => $promo)
            <div
                class="carousel-slide absolute inset-0 transition-opacity duration-700 {{ $index === 0 ? 'opacity-100' : 'opacity-0' }}">
                <!-- Background Image -->
                <div class="absolute inset-0 overflow-hidden">
                    <img src="{{ $promo->hotelpromophoto ?? 'default-promo.jpg' }}"
                        alt="{{ $promo->hotelpromoname ?? 'Promo' }}" class="w-full h-full object-cover">
                </div>

                <!-- Overlay with improved visibility -->
                <div
                    class="absolute inset-0 bg-gradient-to-t from-blue-900/95 via-blue-900/70 to-blue-900/30 flex items-end">
                    <div class="w-full p-8 pb-20">
                        <div class="max-w-4xl mx-auto w-full">
                            <div class="flex items-center gap-3 mb-4 animate-fadeInUp">
                                <i class="fas fa-gift text-yellow-400 text-3xl drop-shadow-lg"></i>
                                <h3 class="text-2xl font-bold text-white drop-shadow-lg">Special Offer</h3>
                            </div>

                            <h4 class="text-5xl font-bold mb-4 text-white drop-shadow-lg animate-fadeInUp"
                                style="animation-delay: 0.1s;">
                                {{ $promo->hotelpromoname }}
                            </h4>

                            <p class="text-lg text-white mb-6 max-w-3xl leading-relaxed drop-shadow animate-fadeInUp"
                                style="animation-delay: 0.2s;">
                                {{ $promo->hotelpromodescription }}
                            </p>

                            <div class="flex items-center gap-3 text-base text-yellow-300 mb-8 animate-fadeInUp"
                                style="animation-delay: 0.3s;">
                                <i class="fas fa-clock drop-shadow"></i>
                                <span class="font-semibold drop-shadow">{{ $promo->hotelpromodaterange }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Navigation Arrows -->
   

    <!-- Dot Indicators -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 flex gap-3 z-10">
        @foreach($promos as $index => $promo)
            <button
                class="carousel-dot w-3 h-3 rounded-full transition-all duration-300 {{ $index === 0 ? 'bg-yellow-400 w-10' : 'bg-white/50 hover:bg-white/75' }}"
                data-index="{{ $index }}">
            </button>
        @endforeach
    </div>
</div>

<style>
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fadeInUp {
        animation: fadeInUp 0.8s ease-out forwards;
        opacity: 0;
    }

    .carousel-slide.opacity-100 .animate-fadeInUp {
        animation: fadeInUp 0.8s ease-out forwards;
    }

    .carousel-slide.opacity-0 .animate-fadeInUp {
        opacity: 0;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const slides = document.querySelectorAll('.carousel-slide');
        const dots = document.querySelectorAll('.carousel-dot');
        const prevBtn = document.querySelector('.carousel-prev');
        const nextBtn = document.querySelector('.carousel-next');
        let currentSlide = 0;
        const totalSlides = slides.length;
        let autoSlide;
        let isTransitioning = false;

        if (totalSlides === 0) return;

        function showSlide(index) {
            if (isTransitioning) return;
            isTransitioning = true;

            slides.forEach((slide, i) => {
                slide.classList.toggle('opacity-100', i === index);
                slide.classList.toggle('opacity-0', i !== index);
            });

            dots.forEach((dot, i) => {
                if (i === index) {
                    dot.classList.add('bg-yellow-400', 'w-10');
                    dot.classList.remove('bg-white/50', 'w-3');
                } else {
                    dot.classList.remove('bg-yellow-400', 'w-10');
                    dot.classList.add('bg-white/50', 'w-3');
                }
            });

            setTimeout(() => {
                isTransitioning = false;
            }, 700);
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % totalSlides;
            showSlide(currentSlide);
        }

        function prevSlide() {
            currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
            showSlide(currentSlide);
        }

        function resetAutoSlide() {
            clearInterval(autoSlide);
            autoSlide = setInterval(nextSlide, 5000);
        }

        // Auto-advance every 5 seconds
        autoSlide = setInterval(nextSlide, 5000);

        // Navigation buttons
        nextBtn.addEventListener('click', function () {
            nextSlide();
            resetAutoSlide();
        });

        prevBtn.addEventListener('click', function () {
            prevSlide();
            resetAutoSlide();
        });

        // Manual dot navigation
        dots.forEach(dot => {
            dot.addEventListener('click', function () {
                if (isTransitioning) return;
                currentSlide = parseInt(this.getAttribute('data-index'));
                showSlide(currentSlide);
                resetAutoSlide();
            });
        });

        // Keyboard navigation
        document.addEventListener('keydown', function (e) {
            if (e.key === 'ArrowLeft') {
                prevSlide();
                resetAutoSlide();
            } else if (e.key === 'ArrowRight') {
                nextSlide();
                resetAutoSlide();
            }
        });
    });
</script>