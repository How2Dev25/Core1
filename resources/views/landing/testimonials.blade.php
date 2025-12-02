
 <section id="reviews" class="py-20" style="background-color: #f8f9fa;" data-aos="fade-up"> -
  <div class="max-w-6xl mx-auto px-4">
    <!-- Title -->
    <h2 class="text-3xl md:text-4xl font-bold text-center mb-12 md:mb-16 text-[#001f54]" 
        data-aos="fade-down" data-aos-delay="100">
      Guest <span class="text-[#F7B32B]">Reviews</span>
    </h2>

    <!-- Testimonials Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 md:gap-8 mb-16">
    @forelse($ratingcomments as $comment)
        <div class="card shadow-lg rounded-lg bg-white border-l-4 border-[#F7B32B]"
             data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
            <div class="card-body p-6">
                <!-- Rating -->
                <div class="mb-4 flex items-center gap-1">
                    @for($i = 1; $i <= 5; $i++)
                        <span class="text-xl {{ $i <= $comment->rating_rating ? 'text-[#F7B32B]' : 'text-gray-300' }}">★</span>
                    @endfor
                    <span class="ml-2 text-sm text-gray-600">{{ number_format($comment->rating_rating, 1) }}</span>
                </div>

                <!-- Text -->
                <p class="mb-6 text-gray-700 leading-relaxed italic">
                    {{ $comment->rating_description }}
                </p>

                <!-- Reviewer -->
                <div class="flex items-center">
                    <div class="w-12 h-12 md:w-14 md:h-14 rounded-full flex items-center justify-center text-white font-bold text-lg mr-4 bg-gradient-to-br from-[#001f54] to-[#003f88]">
                        {{ strtoupper(substr($comment->rating_name, 0, 2)) }}
                    </div>
                    <div>
                        <h4 class="font-bold text-base md:text-lg text-[#001f54]">
                            {{ $comment->rating_name }}
                        </h4>
                        <p class="text-sm text-gray-600">{{ $comment->rating_location }}</p>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-span-full text-center text-gray-500 italic">
            No reviews yet. Be the first to leave a rating!
        </div>
    @endforelse
</div>


    <!-- Review Form -->
    <div class="mb-16" data-aos="fade-up" data-aos-delay="500">
      <div class="bg-white rounded-lg shadow-lg border-2 border-[#F7B32B] overflow-hidden">
        <div class="bg-gradient-to-r from-[#001f54] to-[#003f88] p-6">
          <h3 class="text-2xl font-bold text-white text-center">Share Your Experience</h3>
          <p class="text-blue-100 text-center mt-2">Tell us about your stay and help others discover our place</p>
        </div>
        
        <form class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6" method="POST" action="/landingrating" id="reviewForm">

          @csrf
          <!-- Name and Location Row -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label for="reviewerName" class="block text-sm font-semibold text-[#001f54] mb-2">Your Name *</label>
              <input type="text" id="reviewerName" name="rating_name" required
                     class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-[#F7B32B] focus:outline-none transition-colors"
                     placeholder="Enter your full name">
            </div>
            <div>
              <label for="location" class="block text-sm font-semibold text-[#001f54] mb-2">Location</label>
              <input type="text" id="location" name="rating_location" required
                     class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-[#F7B32B] focus:outline-none transition-colors"
                     placeholder="City, Province">
            </div>
          </div>

          <!-- Rating -->
          <div>
            <label class="block text-sm font-semibold text-[#001f54] mb-2">Rating *</label>
            <div class="flex items-center gap-2">
              <div class="flex gap-1" id="starRating">
                <button type="button" class="star-btn text-3xl text-gray-300 hover:text-[#F7B32B] transition-colors" data-rating="1">★</button>
                <button type="button" class="star-btn text-3xl text-gray-300 hover:text-[#F7B32B] transition-colors" data-rating="2">★</button>
                <button type="button" class="star-btn text-3xl text-gray-300 hover:text-[#F7B32B] transition-colors" data-rating="3">★</button>
                <button type="button" class="star-btn text-3xl text-gray-300 hover:text-[#F7B32B] transition-colors" data-rating="4">★</button>
                <button type="button" class="star-btn text-3xl text-gray-300 hover:text-[#F7B32B] transition-colors" data-rating="5">★</button>
              </div>
              <span id="ratingText" class="text-sm text-gray-600 ml-2">Click to rate</span>
            </div>
            <input type="hidden" id="ratingValue" name="rating_rating" required>
          </div>

          <!-- Review Text -->
          <div>
            <label for="reviewText" class="block text-sm font-semibold text-[#001f54] mb-2">Your Review *</label>
            <textarea id="reviewText" name="rating_description" required rows="4"
                      class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-[#F7B32B] focus:outline-none transition-colors resize-vertical"
                      placeholder="Tell us about your experience... What did you love most about your stay?"></textarea>
          </div>

          <!-- Email  -->
          <div>
            <label for="email" class="block text-sm font-semibold text-[#001f54] mb-2">Email </label>
            <input type="email" id="email" name="rating_email"
                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-[#F7B32B] focus:outline-none transition-colors"
                   placeholder="your.email@example.com">
            <p class="text-xs text-gray-500 mt-1">We'll never share your email or use it for spam</p>
          </div>

          <!-- Submit Button -->
          <div class="text-center pt-4">
            <button type="submit" 
                    class="bg-gradient-to-r from-[#001f54] to-[#003f88] text-white font-bold py-4 px-8 rounded-lg hover:shadow-lg transform hover:scale-105 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed">
              <span id="submitText">Submit Review</span>
              <span id="submitLoader" class="hidden">Submitting...</span>
            </button>
          </div>
        </form>

        @if ($errors->any())
  <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4 text-red-700">
    <ul class="list-disc pl-5">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif


@if (session('success'))
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      document.getElementById('successModal').classList.remove('hidden');
    });
  </script>
@endif
      </div>
    </div>

    <!-- Stats -->
   <div class="text-center">
   <div class="flex flex-col md:flex-row items-center justify-center gap-6 md:gap-8 p-6 md:p-8 rounded-lg shadow-lg bg-white border-2 border-[#F7B32B]">
     
     <!-- Average Rating -->
     <div class="text-center">
       <div class="text-2xl md:text-3xl font-bold text-[#001f54]">
         {{ number_format($averageRating, 1) }}
       </div>
       <div class="flex justify-center gap-1 my-2 text-[#F7B32B] text-sm md:text-base">
         @for ($i = 1; $i <= 5; $i++)
           <span>{{ $i <= round($averageRating) ? '★' : '☆' }}</span>
         @endfor
       </div>
       <div class="text-xs md:text-sm text-gray-600">Average Rating</div>
     </div>
     
     <div class="hidden md:block w-px h-12 md:h-16 bg-[#F7B32B]"></div>
     
     <!-- Total Reviews -->
     <div class="text-center">
       <div class="text-2xl md:text-3xl font-bold text-[#001f54]">
         {{ number_format($totalReviews) }}
       </div>
       <div class="text-xs md:text-sm text-gray-600">Total Reviews</div>
     </div>
     
     <div class="hidden md:block w-px h-12 md:h-16 bg-[#F7B32B]"></div>
     
     <!-- Recommend Rate -->
     <div class="text-center">
       <div class="text-2xl md:text-3xl font-bold text-[#001f54]">
         {{ $recommendRate }}%
       </div>
       <div class="text-xs md:text-sm text-gray-600">Recommend Rate</div>
     </div>
   </div>
</div>
  </div>
</section>

<!-- Success Modal -->
<div id="successModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
  <div class="bg-white rounded-lg p-8 max-w-md mx-4 text-center">
    <div class="text-[#F7B32B] text-6xl mb-4">✓</div>
    <h3 class="text-2xl font-bold text-[#001f54] mb-2">Thank You!</h3>
    <p class="text-gray-600 mb-6">Your review has been submitted successfully. We appreciate your feedback!</p>
    <button onclick="closeModal()" class="bg-gradient-to-r from-[#001f54] to-[#003f88] text-white font-bold py-2 px-6 rounded-lg hover:shadow-lg transition-all">
      Close
    </button>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    // Initialize AOS
    AOS.init({
        duration: 800,
        once: true
    });

    // ⭐ Star Rating System
    let selectedRating = 0;
    const starButtons = document.querySelectorAll('.star-btn');
    const ratingValue = document.getElementById('ratingValue');
    const ratingText = document.getElementById('ratingText');

    const ratingTexts = {
        1: 'Poor',
        2: 'Fair',
        3: 'Good',
        4: 'Very Good',
        5: 'Excellent'
    };

    function highlightStars(rating) {
        starButtons.forEach((star, index) => {
            if (index < rating) {
                star.classList.remove('text-gray-300');
                star.classList.add('text-[#F7B32B]');
            } else {
                star.classList.remove('text-[#F7B32B]');
                star.classList.add('text-gray-300');
            }
        });
    }

    function updateStars() {
        highlightStars(selectedRating);
    }

    starButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            e.preventDefault();
            selectedRating = parseInt(button.dataset.rating);
            ratingValue.value = selectedRating;
            updateStars();
            ratingText.textContent = ratingTexts[selectedRating];
        });

        button.addEventListener('mouseenter', () => {
            const hoverRating = parseInt(button.dataset.rating);
            highlightStars(hoverRating);
        });
    });

    document.getElementById('starRating').addEventListener('mouseleave', () => {
        updateStars();
    });

    // 🚀 Form Submission with Loader then Real Submit
    document.getElementById('reviewForm').addEventListener('submit', function (e) {
        e.preventDefault();

        const form = this;
        const submitBtn = form.querySelector('button[type="submit"]');
        const submitText = document.getElementById('submitText');
        const submitLoader = document.getElementById('submitLoader');

        if (selectedRating === 0) {
            alert('Please select a rating');
            return;
        }

        // Show loading state
        submitBtn.disabled = true;
        submitText.classList.add('hidden');
        submitLoader.classList.remove('hidden');

        // Wait 1.5s to show loader, then submit form
        setTimeout(() => {
            form.submit();
        }, 1500);
    });

    // ✅ Success Modal (handled when backend redirects with session flash)
    function closeModal() {
        document.getElementById('successModal').classList.add('hidden');
    }

    document.getElementById('successModal').addEventListener('click', (e) => {
        if (e.target.id === 'successModal') {
            closeModal();
        }
    });

    window.closeModal = closeModal;
});
</script>
