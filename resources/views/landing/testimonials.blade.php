<section id="reviews" class="py-20" style="background-color: #f8f9fa;" data-aos="fade-up">
  <div class="max-w-7xl mx-auto px-4">
    <!-- Title -->
    <h2 class="text-3xl md:text-4xl font-bold text-center mb-12 md:mb-16 text-[#001f54]" data-aos="fade-down"
      data-aos-delay="100">
      Guest <span class="text-[#F7B32B]">Feedbacks</span>
    </h2>

    <!-- Feedbacks Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-16">

      @forelse ($feedbacks as $myroomfeedback)
        <!-- Feedback Card - Now Clickable -->
        <a href="/selectedroom/{{$myroomfeedback->roomID}}"
          class="block bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-lg transition-all duration-300 hover:-translate-y-1 cursor-pointer"
          data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">

          <!-- Room Image -->
          <div class="relative h-48 bg-gray-200">
            <img src="{{ asset($myroomfeedback->roomphoto) }}" alt="Room Photo" class="w-full h-full object-cover">
            <!-- Rating Badge Overlay -->
            <div
              class="absolute top-3 right-3 bg-white/95 backdrop-blur-sm px-3 py-1.5 rounded-full shadow-md flex items-center gap-1">
              <i class="fa-solid fa-star text-sm" style="color: #F7B32B;"></i>
              <span class="font-semibold text-sm text-gray-900">{{ $myroomfeedback->roomrating }}/5</span>
            </div>
            <!-- Room Type Badge -->
            <div class="absolute top-3 left-3 bg-[#001f54]/90 backdrop-blur-sm px-3 py-1 rounded-full">
              <span class="text-white text-xs font-semibold">{{ $myroomfeedback->roomtype }}</span>
            </div>
          </div>

          <!-- Card Content -->
          <div class="p-5">

            <!-- Room Info -->
            <div class="mb-4 pb-4 border-b border-gray-100">
              <h3 class="font-bold text-[#001f54] text-base mb-1">Room #{{ $myroomfeedback->roomID }}</h3>
             
            </div>

            <!-- Guest Info -->
            <div class="flex items-center gap-3 mb-4">
              <img src="{{ asset($myroomfeedback->guest_photo) }}" alt="{{ $myroomfeedback->guest_name }}"
                class="h-12 w-12 rounded-full object-cover border-2 border-gray-200">
              <div class="flex-1 min-w-0">
                <h4 class="font-semibold text-gray-900 text-sm truncate">{{ $myroomfeedback->guest_name }}</h4>
                <div class="flex items-center gap-1 text-xs">
                  @if($myroomfeedback->guest_status == 'Verified')
                    <i class="fa-solid fa-check-circle" style="color: #F7B32B;"></i>
                    <span class="text-yellow-600">Verified</span>
                  @elseif($myroomfeedback->guest_status == 'Suspended')
                    <i class="fa-solid fa-exclamation-circle text-red-500"></i>
                    <span class="text-red-600">Suspended</span>
                  @else
                    <span class="text-gray-600">{{ $myroomfeedback->guest_status }}</span>
                  @endif
                </div>
              </div>
            </div>

            <!-- Star Rating -->
            <div class="flex items-center gap-1 mb-3">
              @for ($i = 1; $i <= 5; $i++)
                <i class="{{ $i <= $myroomfeedback->roomrating ? 'fa-solid fa-star' : 'fa-regular fa-star' }} text-sm"
                  style="color: #F7B32B;"></i>
              @endfor
            </div>

            <!-- Feedback Text -->
            @if(!empty($myroomfeedback->roomfeedbackfeedback))
              <p class="text-gray-700 text-sm leading-relaxed mb-4 line-clamp-3">
                {{ $myroomfeedback->roomfeedbackfeedback }}
              </p>
            @else
              <p class="text-gray-400 text-sm italic mb-4">
                No feedback message provided.
              </p>
            @endif

            <!-- Footer: Date & Time -->
            <div class="pt-3 border-t border-gray-100">
              <div class="flex items-center justify-between text-xs text-gray-500">
                <span class="flex items-center gap-1">
                  <i class="fa-regular fa-clock"></i>
                  {{ \Carbon\Carbon::parse($myroomfeedback->roomfeedbacktimestamp)->diffForHumans() }}
                </span>
                <span>{{ \Carbon\Carbon::parse($myroomfeedback->roomfeedbacktimestamp)->format('M d, Y') }}</span>
              </div>
            </div>

          </div>
        </a>
      @empty
        <!-- Empty State -->
        <div class="col-span-full text-center py-12 rounded-2xl" style="background-color: rgba(0, 31, 84, 0.05);">
          <i class="fa-solid fa-comment-dots text-5xl mb-4" style="color: #001f54;"></i>
          <h3 class="text-xl font-semibold mb-2" style="color: #001f54;">No feedback yet</h3>
          <p class="text-gray-600 max-w-md mx-auto">Be the first to share your experience about your recent stay.</p>
        </div>
      @endforelse

    </div>
  </div>
</section>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    // Initialize AOS
    AOS.init({
      duration: 800,
      once: true
    });
  });
</script>