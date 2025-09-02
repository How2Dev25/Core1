<section id="promos-events" class="py-20 bg-[#f8f9fa]" data-aos="fade-up">
  <div class="max-w-6xl mx-auto px-4">
    <!-- Title -->
    <h2 class="text-3xl md:text-4xl font-bold text-center mb-6 text-[#001f54]" 
        data-aos="fade-down" data-aos-delay="100">
      Promos & <span class="text-[#F7B32B]">Events</span>
    </h2>
    <p class="text-center text-gray-600 mb-12 md:mb-16 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="200">
      Discover amazing deals and exciting events happening at our place. Don't miss out on these special opportunities!
    </p>

    <!-- Promos + Events Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 mb-16">
      
      @foreach($promos as $promo)
        <div class="bg-white rounded-lg shadow-lg border-l-4 border-[#F7B32B] overflow-hidden group hover:shadow-xl transition-all duration-300" 
             data-aos="fade-up" data-aos-delay="200">
          <div class="relative">
            <!-- Carousel -->
            <div class="carousel-container relative h-48 overflow-hidden">
              <div class="carousel-track flex transition-transform duration-500 ease-in-out" id="promo{{ $promo->id }}">
                <img src="{{ asset($promo->hotelpromophoto) }}" alt="{{ $promo->hotelpromoname }}" class="w-full h-48 object-cover flex-shrink-0">
              </div>
              <!-- Controls -->
              <button class="carousel-btn prev absolute left-2 top-1/2 -translate-y-1/2 bg-black bg-opacity-50 text-white rounded-full w-8 h-8 flex items-center justify-center hover:bg-opacity-75 transition-all" 
                      data-carousel="promo{{ $promo->id }}" data-direction="prev">‹</button>
              <button class="carousel-btn next absolute right-2 top-1/2 -translate-y-1/2 bg-black bg-opacity-50 text-white rounded-full w-8 h-8 flex items-center justify-center hover:bg-opacity-75 transition-all" 
                      data-carousel="promo{{ $promo->id }}" data-direction="next">›</button>
            </div>
            <!-- Badge -->
            <div class="absolute top-3 left-3 bg-gradient-to-r from-[#F7B32B] to-[#ffcc5c] text-white font-bold px-3 py-1 rounded-full text-sm">
              PROMO
            </div>
          </div>
          <div class="p-6">
            <h3 class="text-xl font-bold text-[#001f54] mb-2 group-hover:text-[#F7B32B] transition-colors">{{ $promo->hotelpromoname }}</h3>
            <p class="text-gray-600 mb-4 text-sm leading-relaxed">
              {{ $promo->hotelpromodescription }}
            </p>
            <div class="flex justify-between items-center">
              <div class="text-sm text-gray-500">
                <span class="block font-semibold">Valid Until:</span>
                <span>{{ $promo->hotelpromodaterange }}</span>
              </div>
              <button class="bg-gradient-to-r from-[#001f54] to-[#003f88] text-white px-4 py-2 rounded-lg text-sm font-semibold hover:shadow-lg transform hover:scale-105 transition-all">
                Learn More
              </button>
            </div>
          </div>
        </div>
      @endforeach

      @foreach($events as $event)
        <div class="bg-white rounded-lg shadow-lg border-l-4 border-[#F7B32B] overflow-hidden group hover:shadow-xl transition-all duration-300" 
             data-aos="fade-up" data-aos-delay="300">
          <div class="relative">
            <div class="carousel-container relative h-48 overflow-hidden">
              <div class="carousel-track flex transition-transform duration-500 ease-in-out" id="event{{ $event->id }}">
                <img src="{{ asset($event->eventphoto) }}" alt="{{ $event->eventname }}" class="w-full h-48 object-cover flex-shrink-0">
              </div>
              <button class="carousel-btn prev absolute left-2 top-1/2 -translate-y-1/2 bg-black bg-opacity-50 text-white rounded-full w-8 h-8 flex items-center justify-center hover:bg-opacity-75 transition-all" 
                      data-carousel="event{{ $event->id }}" data-direction="prev">‹</button>
              <button class="carousel-btn next absolute right-2 top-1/2 -translate-y-1/2 bg-black bg-opacity-50 text-white rounded-full w-8 h-8 flex items-center justify-center hover:bg-opacity-75 transition-all" 
                      data-carousel="event{{ $event->id }}" data-direction="next">›</button>
            </div>
            <div class="absolute top-3 left-3 bg-gradient-to-r from-red-500 to-red-600 text-white font-bold px-3 py-1 rounded-full text-sm">
              EVENT
            </div>
          </div>
          <div class="p-6">
            <h3 class="text-xl font-bold text-[#001f54] mb-2 group-hover:text-[#F7B32B] transition-colors">{{ $event->eventname }}</h3>
            <p class="text-gray-600 mb-4 text-sm leading-relaxed">
              Organized by {{ $event->eventorganizername }}
            </p>
            <div class="flex justify-between items-center">
              <div class="text-sm text-gray-500">
                <span class="block font-semibold">{{ $event->eventdate }}</span>
                <span class="block text-xs mt-1">{{ $event->event_time_start }} - {{ $event->event_time_end }}</span>
              </div>
              <button class="bg-gradient-to-r from-[#001f54] to-[#003f88] text-white px-4 py-2 rounded-lg text-sm font-semibold hover:shadow-lg transform hover:scale-105 transition-all">
                RSVP
              </button>
            </div>
          </div>
        </div>
      @endforeach

    </div>

 
 

    <!-- Stats -->
<div class="mt-16">
  <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 md:gap-8 max-w-4xl mx-auto">
    
    <!-- Active Promos -->
    <div class="flex flex-col items-center justify-center p-6 rounded-2xl shadow-md bg-white border-t-4 border-[#F7B32B] hover:shadow-xl transition-all duration-300">
      <div class="text-3xl md:text-4xl font-extrabold text-[#001f54]">{{ $promoCount }}+</div>
      <p class="mt-2 text-sm md:text-base text-gray-600">Active Promos</p>
    </div>

    <!-- Events -->
    <div class="flex flex-col items-center justify-center p-6 rounded-2xl shadow-md bg-white border-t-4 border-[#F7B32B] hover:shadow-xl transition-all duration-300">
      <div class="text-3xl md:text-4xl font-extrabold text-[#001f54]">{{ $eventCount }}+</div>
      <p class="mt-2 text-sm md:text-base text-gray-600">Events This Year</p>
    </div>

  </div>
</div>

  </div>
</section>


<script>
// Initialize AOS
AOS.init({
    duration: 800,
    once: true
});

// Carousel functionality
class Carousel {
    constructor(carouselId) {
        this.carousel = document.getElementById(carouselId);
        this.track = this.carousel;
        this.slides = this.track.children;
        this.currentSlide = 0;
        this.totalSlides = this.slides.length;
        
        // Find controls for this carousel
        this.prevBtn = document.querySelector(`[data-carousel="${carouselId}"][data-direction="prev"]`);
        this.nextBtn = document.querySelector(`[data-carousel="${carouselId}"][data-direction="next"]`);
        this.indicators = document.querySelectorAll(`[data-carousel="${carouselId}"].indicator`);
        
        this.init();
    }
    
    init() {
        // Add event listeners
        this.prevBtn.addEventListener('click', () => this.prevSlide());
        this.nextBtn.addEventListener('click', () => this.nextSlide());
        
        this.indicators.forEach((indicator, index) => {
            indicator.addEventListener('click', () => this.goToSlide(index));
        });
        
        // Auto-play
        this.startAutoPlay();
        
        // Pause on hover
        this.carousel.parentElement.addEventListener('mouseenter', () => this.pauseAutoPlay());
        this.carousel.parentElement.addEventListener('mouseleave', () => this.startAutoPlay());
    }
    
    updateCarousel() {
        const translateX = -this.currentSlide * 100;
        this.track.style.transform = `translateX(${translateX}%)`;
        
        // Update indicators
        this.indicators.forEach((indicator, index) => {
            if (index === this.currentSlide) {
                indicator.classList.add('active');
                indicator.classList.remove('bg-opacity-50');
                indicator.classList.add('bg-opacity-100');
            } else {
                indicator.classList.remove('active');
                indicator.classList.remove('bg-opacity-100');
                indicator.classList.add('bg-opacity-50');
            }
        });
    }
    
    nextSlide() {
        this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
        this.updateCarousel();
    }
    
    prevSlide() {
        this.currentSlide = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
        this.updateCarousel();
    }
    
    goToSlide(index) {
        this.currentSlide = index;
        this.updateCarousel();
    }
    
    startAutoPlay() {
        this.autoPlayInterval = setInterval(() => this.nextSlide(), 4000);
    }
    
    pauseAutoPlay() {
        clearInterval(this.autoPlayInterval);
    }
}

// Initialize carousels
document.addEventListener('DOMContentLoaded', () => {
    new Carousel('carousel1');
    new Carousel('carousel2');
    new Carousel('carousel3');
});

// Newsletter form
document.getElementById('newsletterForm').addEventListener('submit', (e) => {
    e.preventDefault();
    
    const submitBtn = e.target.querySelector('button[type="submit"]');
    const originalText = submitBtn.textContent;
    
    submitBtn.disabled = true;
    submitBtn.textContent = 'Subscribing...';
    
    // Simulate form submission
    setTimeout(() => {
        alert('Thank you for subscribing! You\'ll receive updates about our latest promos and events.');
        e.target.reset();
        
        submitBtn.disabled = false;
        submitBtn.textContent = originalText;
    }, 2000);
});
</script>