<section id="restaurant" class="py-20 bg-white relative overflow-hidden">
    <div class="absolute inset-0 bg-black/5 z-0"></div>
    <div class="max-w-7xl mx-auto px-4 relative z-10">
        <!-- Restaurant Intro -->
        <div class="text-center mb-16" data-aos="fade-up" data-aos-delay="100">
            <h2 class="text-4xl md:text-5xl font-bold mb-4">
                <span class="text-[#F7B32B]">Gourmet</span> Dining Experience
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Indulge in culinary excellence at Soliera's award-winning restaurants
            </p>
        </div>

        <!-- Restaurant Image + Details -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Restaurant Image -->
            <div class="relative w-full h-[600px] rounded-xl overflow-hidden shadow-2xl" data-aos="fade-right" data-aos-delay="200">
                <div class="absolute inset-0 bg-cover bg-center"
                     style="background-image: url('{{asset('images/defaults/rooms/resto/resto2.png')}}')">
                </div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                <div class="absolute bottom-0 left-0 p-8 text-white">
                    <h3 class="text-3xl font-bold">Soliera Restaurant</h3>
                    <p class="text-amber-300">Signature Fine Dining</p>
                </div>
            </div>

            <!-- Restaurant Details -->
            <div data-aos="fade-left" data-aos-delay="300">
                <div class="mb-8">
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Culinary Excellence</h3>
                    <p class="text-gray-600 mb-6">
                        Our Michelin-starred chefs create unforgettable dining experiences using locally-sourced ingredients and innovative techniques.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-amber-600 mt-0.5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-700">Breakfast buffet 6:30 AM - 10:30 AM</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-amber-600 mt-0.5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-700">Lunch service 12:00 PM - 3:00 PM</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-amber-600 mt-0.5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-700">Dinner service 6:00 PM - 11:00 PM</span>
                        </li>
                    </ul>
                </div>
                <a href="https://restaurant.soliera-hotel-restaurant.com/" class="btn btn-outline border-[#F7B32B] text-black hover:bg-[#F7B32B] hover:text-white px-8 py-3">
                    Make Reservation
                </a>
            </div>
        </div>

        <!-- Sample Foods & Menus -->
    <div class="mt-20" data-aos="fade-up" data-aos-delay="400">
  <h3 class="text-3xl font-bold text-center mb-12">
    Menu <span class="text-[#F7B32B]">Highlights</span>
  </h3>

  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
    
    <!-- Food Card 1 -->
    <div class="group bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-500"
         data-aos="zoom-in" data-aos-delay="100">
      <div class="relative overflow-hidden">
        <img src="{{asset('images/restaurant/Breakfast a la soliera/Ube Pancakes with Quezo de Bola Cream.png')}}" 
             alt="Ube Pancakes with Quezo de Bola Cream" 
             class="w-full h-48 object-cover transform group-hover:scale-110 transition-transform duration-500">
      </div>
      <div class="p-6 text-center">
        <h4 class="text-sm uppercase tracking-wide font-semibold text-[#F7B32B] mb-2">Breakfast a la Soliera</h4>
        <h3 class="text-lg font-bold text-gray-800 mb-2">Ube Pancakes</h3>
        <p class="text-gray-500 text-sm">with Quezo de Bola Cream</p>
      </div>
    </div>

    <!-- Food Card 2 -->
    <div class="group bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-500"
         data-aos="zoom-in" data-aos-delay="150">
      <div class="relative overflow-hidden">
        <img src="{{asset('images/restaurant/Dinner gastronomique/Beef Pares Osso Buco Style.png')}}" 
             alt="Beef Pares Osso Buco Style" 
             class="w-full h-48 object-cover transform group-hover:scale-110 transition-transform duration-500">
      </div>
      <div class="p-6 text-center">
        <h4 class="text-sm uppercase tracking-wide font-semibold text-[#F7B32B] mb-2">Dinner Gastronomique</h4>
        <h3 class="text-lg font-bold text-gray-800 mb-2">Beef Pares</h3>
        <p class="text-gray-500 text-sm">Osso Buco Style</p>
      </div>
    </div>

    <!-- Food Card 3 -->
    <div class="group bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-500"
         data-aos="zoom-in" data-aos-delay="200">
      <div class="relative overflow-hidden">
        <img src="{{asset('images/restaurant/Lunch Majectic Plates/Grilled Liempo with Tamarind Caramel.png')}}" 
             alt="Grilled Liempo with Tamarind Caramel" 
             class="w-full h-48 object-cover transform group-hover:scale-110 transition-transform duration-500">
      </div>
      <div class="p-6 text-center">
        <h4 class="text-sm uppercase tracking-wide font-semibold text-[#F7B32B] mb-2">Lunch Majestic Plates</h4>
        <h3 class="text-lg font-bold text-gray-800 mb-2">Grilled Liempo</h3>
        <p class="text-gray-500 text-sm">with Tamarind Caramel</p>
      </div>
    </div>

    <!-- Food Card 4 -->
    <div class="group bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-500"
         data-aos="zoom-in" data-aos-delay="250">
      <div class="relative overflow-hidden">
        <img src="{{asset('images/restaurant/SIGNATURE DESSERT SELECTION/Calamansi Tart with Burnt Meringue.png')}}" 
             alt="Calamansi Tart with Burnt Meringue" 
             class="w-full h-48 object-cover transform group-hover:scale-110 transition-transform duration-500">
      </div>
      <div class="p-6 text-center">
        <h4 class="text-sm uppercase tracking-wide font-semibold text-[#F7B32B] mb-2">Signature Dessert Selection</h4>
        <h3 class="text-lg font-bold text-gray-800 mb-2">Calamansi Tart</h3>
        <p class="text-gray-500 text-sm">with Burnt Meringue</p>
      </div>
    </div>

  </div>
</div>

    </div>
</section>
