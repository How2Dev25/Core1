<div class="relative rounded-2xl shadow-lg overflow-hidden">
    <!-- Carousel Container -->
    <div class="carousel-container relative h-64">
        @foreach($promos as $index => $promo)
            <div
                class="carousel-slide absolute inset-0 transition-opacity duration-700 {{ $index === 0 ? 'opacity-100' : 'opacity-0' }}">
                <!-- Background Image -->
                <img src="{{ $promo->hotelpromophoto ?? 'default-promo.jpg' }}"
                    alt="{{ $promo->hotelpromoname ?? 'Promo' }}" class="w-full h-64 object-cover">

                <!-- Overlay -->
                <div
                    class="absolute inset-0 bg-gradient-to-t from-blue-900/90 via-blue-900/60 to-transparent p-6 flex flex-col justify-end text-white">
                    <div class="mb-3">
                        <div class="flex items-center gap-2 mb-2 top-5 absolute ">
                            <i class="fas fa-gift text-yellow-400 text-2xl"></i>
                            <h3 class="text-xl font-bold">Special Offers</h3>
                        </div>

                        
                      
                       

                      
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Dot Indicators -->
    <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex gap-2 z-10">
        @foreach($promos as $index => $promo)
            <button
                class="carousel-dot w-2 h-2 rounded-full transition-all duration-300 {{ $index === 0 ? 'bg-yellow-400 w-6' : 'bg-white/50 hover:bg-white/75' }}"
                data-index="{{ $index }}">
            </button>
        @endforeach
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const slides = document.querySelectorAll('.carousel-slide');
        const dots = document.querySelectorAll('.carousel-dot');
        let currentSlide = 0;
        const totalSlides = slides.length;

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.classList.toggle('opacity-100', i === index);
                slide.classList.toggle('opacity-0', i !== index);
            });

            dots.forEach((dot, i) => {
                if (i === index) {
                    dot.classList.add('bg-yellow-400', 'w-6');
                    dot.classList.remove('bg-white/50', 'w-2');
                } else {
                    dot.classList.remove('bg-yellow-400', 'w-6');
                    dot.classList.add('bg-white/50', 'w-2');
                }
            });
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % totalSlides;
            showSlide(currentSlide);
        }

        // Auto-advance every 5 seconds
        let autoSlide = setInterval(nextSlide, 5000);

        // Manual dot navigation
        dots.forEach(dot => {
            dot.addEventListener('click', function () {
                clearInterval(autoSlide);
                currentSlide = parseInt(this.getAttribute('data-index'));
                showSlide(currentSlide);
                autoSlide = setInterval(nextSlide, 5000);
            });
        });
    });
</script>