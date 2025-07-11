<div class="bg-white p-6 rounded-lg shadow-md relative overflow-hidden">
    <h2 class="text-xl font-bold text-gray-800 mb-4">Current Promotions</h2>
    
    <!-- Carousel Container -->
    <div class="relative group">
        <!-- Carousel Items -->
        <div class="carousel-container flex overflow-x-auto snap-x snap-mandatory scroll-smooth space-x-4 pb-4"
             style="scrollbar-width: none; -ms-overflow-style: none;">
            @forelse ($hmpdata as $hmp)
            <div class="carousel-item snap-start flex-shrink-0 w-64 transition-opacity duration-300">
                <div class="card bg-white shadow-sm hover:shadow-md transition-shadow h-full">
                    <figure class="relative aspect-video">
                        <img src="{{asset($hmp->hotelpromophoto)}}" 
                             alt="{{$hmp->hotelpromoname}}" 
                             class="w-full h-full object-cover rounded-t-lg">
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-3">
                            <h3 class="text-white font-semibold">{{$hmp->hotelpromoname}}</h3>
                            <p class="text-white/80 text-sm">{{$hmp->hotelpromotag}}</p>
                        </div>
                    </figure>
                    <div class="card-body p-4">
                        <p class="text-gray-600 text-sm line-clamp-2 mb-3">{{$hmp->hotelpromodescription}}</p>
                        <div class="flex justify-between items-center">
                            <span class="badge {{$hmp->hotelpromostatus == 'Active' ? 'badge-success' : 'badge-error'}}">
                                {{$hmp->hotelpromostatus}}
                            </span>
                            <span class="text-xs text-gray-500">
                                <i class='bx bx-calendar mr-1'></i> {{$hmp->hotelpromodaterange}}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="flex items-center justify-center w-full h-48 text-gray-400">
                <div class="text-center">
                    <i class='bx bx-image-alt text-4xl mb-2'></i>
                    <p>No promotions available</p>
                </div>
            </div>
            @endforelse
        </div>
        
        <!-- Navigation Buttons -->
        <button class="carousel-prev absolute left-2 top-1/2 -translate-y-1/2 btn btn-circle btn-sm btn-ghost bg-white/90 shadow opacity-0 group-hover:opacity-100 transition-opacity">
            <i class='bx bx-chevron-left'></i>
        </button>
        <button class="carousel-next absolute right-2 top-1/2 -translate-y-1/2 btn btn-circle btn-sm btn-ghost bg-white/90 shadow opacity-0 group-hover:opacity-100 transition-opacity">
            <i class='bx bx-chevron-right'></i>
        </button>
    </div>
    
    <!-- Indicator Dots -->
    @if(count($hmpdata) > 1)
    <div class="flex justify-center mt-4 space-x-2">
        @foreach($hmpdata as $index => $hmp)
        <button class="indicator-dot w-2 h-2 rounded-full bg-gray-300 transition-all duration-300 {{$index === 0 ? 'w-4 bg-primary' : ''}}"
                data-index="{{$index}}"></button>
        @endforeach
    </div>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const carousel = document.querySelector('.carousel-container');
    const items = document.querySelectorAll('.carousel-item');
    const prevBtn = document.querySelector('.carousel-prev');
    const nextBtn = document.querySelector('.carousel-next');
    const dots = document.querySelectorAll('.indicator-dot');
    let currentIndex = 0;
    let intervalId;
    const itemWidth = items[0]?.offsetWidth + 16; // 16px for gap
    
    if (items.length > 0) {
        // Auto-rotate function
        function startAutoRotate() {
            intervalId = setInterval(() => {
                currentIndex = (currentIndex + 1) % items.length;
                updateCarousel();
            }, 5000); // Change slide every 5 seconds
        }
        
        // Update carousel position
        function updateCarousel() {
            carousel.scrollTo({
                left: currentIndex * itemWidth,
                behavior: 'smooth'
            });
            updateDots();
        }
        
        // Update indicator dots
        function updateDots() {
            dots.forEach((dot, index) => {
                dot.classList.toggle('w-4', index === currentIndex);
                dot.classList.toggle('bg-primary', index === currentIndex);
                dot.classList.toggle('bg-gray-300', index !== currentIndex);
            });
        }
        
        // Navigation controls
        nextBtn?.addEventListener('click', () => {
            currentIndex = (currentIndex + 1) % items.length;
            updateCarousel();
            resetInterval();
        });
        
        prevBtn?.addEventListener('click', () => {
            currentIndex = (currentIndex - 1 + items.length) % items.length;
            updateCarousel();
            resetInterval();
        });
        
        // Dot navigation
        dots.forEach(dot => {
            dot.addEventListener('click', () => {
                currentIndex = parseInt(dot.dataset.index);
                updateCarousel();
                resetInterval();
            });
        });
        
        // Reset interval when user interacts
        function resetInterval() {
            clearInterval(intervalId);
            startAutoRotate();
        }
        
        // Pause on hover
        carousel.addEventListener('mouseenter', () => {
            clearInterval(intervalId);
        });
        
        carousel.addEventListener('mouseleave', () => {
            startAutoRotate();
        });
        
        // Start the auto-rotation
        startAutoRotate();
    }
});
</script>

<style>
.carousel-container::-webkit-scrollbar {
    display: none;
}
.indicator-dot {
    transition: width 0.3s ease, background-color 0.3s ease;
}
</style>