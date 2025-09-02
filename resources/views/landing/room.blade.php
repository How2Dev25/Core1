<section id="rooms" class="py-20 px-4 bg-gray-50">
  <div class="max-w-6xl mx-auto">
    <h2 class="text-4xl font-bold text-center mb-16" data-aos="fade-up">
      Our <span class="text-[#F7B32B]">Rooms & Suites</span>
    </h2>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
  
  <!-- Room Cards -->
  @forelse($rooms as $room)
  <div class="relative group rounded-2xl shadow-lg overflow-hidden bg-white hover:shadow-2xl transition-all duration-500"
       data-aos="fade-up" data-aos-delay="100">
    <img src="{{ asset($room->roomphoto) }}" 
         alt="{{ $room->roomtype }}"
         class="w-full h-[420px] object-cover transform group-hover:scale-110 transition-transform duration-500">
    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>
    <div class="absolute bottom-0 left-0 w-full p-6 text-white backdrop-blur-sm bg-white/10 rounded-t-2xl">
      <h3 class="text-2xl font-bold mb-2">{{ $room->roomtype }}</h3>
      <p class="text-sm text-gray-200 mb-4">{{ $room->roomfeatures }}</p>
      <span class="text-lg font-semibold text-amber-400">₱{{ $room->roomprice }}/night</span>
    </div>
  </div>
  @empty
  <div class="col-span-full text-center py-12">
    <h3 class="text-xl font-semibold text-gray-600">No rooms available at the moment.</h3>
    <p class="text-gray-400">Please check back later or try a different search.</p>
  </div>
  @endforelse

</div>


  
   

    </div>
  </div>
</section>
