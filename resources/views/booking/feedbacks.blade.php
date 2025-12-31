<!-- Guest Feedbacks Section -->
<div class="mb-8">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-[#001f54] mb-2">Guest Feedbacks</h2>
        <p class="text-sm text-gray-600">Recent reviews and comments from our guests</p>
    </div>

    <!-- Feedbacks List -->
    <div class="bg-white rounded-lg  divide-y  divide-gray-200 ">

        <!-- Single Comment -->

        @forelse ($feedbacks as $myroomfeedback)
            <div class="py-4 px-6  transition-colors duration-200">
                <div class="flex gap-4">
                    <!-- Static Guest Avatar (Image) -->
                    <div class="flex-shrink-0">
                        <img src="{{ asset($myroomfeedback->guest_photo) }}" alt="Guest Avatar"
                            class="h-10 w-10 rounded-full object-cover shadow-sm border-2 border-gray-200">
                    </div>

                    <!-- Comment Content -->
                    <div class="flex-1 min-w-0">
                        <!-- Header: Name, Room, Date -->
                        <div class="flex items-center gap-2 mb-1 flex-wrap">
                            <h3 class="font-semibold text-gray-900 text-sm">{{$myroomfeedback->guest_name}}</h3>
                            <span class="text-gray-400">·</span>
                            <span class="text-xs text-gray-500">
                                {{ \Carbon\Carbon::parse($myroomfeedback->roomfeedbacktimestamp)->diffForHumans() }}
                                •
                                {{ \Carbon\Carbon::parse($myroomfeedback->roomfeedbacktimestamp)->format('M d, Y') }}
                            </span>
                            <span class="flex items-center text-xs ml-1" style="color: #F7B32B;">
                                @if($myroomfeedback->guest_status == 'Verified')
                                    <i class="fa-solid fa-check-circle mr-1" style="color: #F7B32B;"></i>
                                @elseif($myroomfeedback->guest_status == 'Suspended')
                                    <i class="fa-solid fa-exclamation-circle mr-1 text-red-500"></i>
                                @endif
                                <span class="
                      @if($myroomfeedback->guest_status == 'Verified')
                        text-yellow-600
                      @elseif($myroomfeedback->guest_status == 'Suspended')
                        text-red-600
                      @else
                        text-gray-600
                      @endif
                    ">
                                    {{ $myroomfeedback->guest_status }}
                                </span>
                            </span>
                        </div>

                        <!-- Rating -->
                        <div class="flex items-center gap-1 mb-2">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="{{ $i <= $myroomfeedback->roomrating ? 'fa-solid fa-star' : 'fa-regular fa-star' }} text-xs"
                                    style="color: #F7B32B;"></i>
                            @endfor
                            <span class="text-gray-600 text-xs ml-1">{{ $myroomfeedback->roomrating }}/5</span>
                        </div>

                        <!-- Feedback Text -->
                        @if(!empty($myroomfeedback->roomfeedbackfeedback))
                            <p class="text-gray-700 text-sm mb-3 leading-relaxed">
                                {{ $myroomfeedback->roomfeedbackfeedback }}
                            </p>
                        @else
                            <p class="text-gray-400 text-sm italic mb-3">
                                No feedback message provided.
                            </p>
                        @endif

                        <!-- Feedback Photo -->
                    @if(!empty($myroomfeedback->roomfeedbackphoto))
                        <div class="mb-3 w-full ">
                            <img src="{{ asset($myroomfeedback->roomfeedbackphoto) }}" alt="Feedback Photo"
                                class="w-full max-w-xs sm:max-w-sm md:max-w-md h-auto rounded-lg border border-gray-200 object-contain">
                        </div>
                    @endif
                        <!-- Footer: Status & Actions -->


                        <!-- Hotel Response (Child Comment) -->
                        @if(!empty($myroomfeedback->roomfeedbackresponse))
                            <div class="mt-4 ml-0 pl-4 border-l-2 border-gray-200">
                                <div class="flex gap-3">
                                    <!-- Static Hotel Avatar (Image) -->
                                    <div class="flex-shrink-0">
                                        <img src="{{ asset('images/logo/sonly.png') }}" alt="Soliera Hotel"
                                            class="h-8 w-8 rounded-full object-cover shadow-sm border-2 border-yellow-400">
                                    </div>

                                    <!-- Response Content -->
                                    <div class="flex-1 min-w-0">
                                        <!-- Hotel Name & Badge -->
                                        <div class="flex items-center gap-2 mb-1">
                                            <h4 class="font-semibold text-gray-900 text-sm">Soliera Hotel</h4>
                                            <span
                                                class="px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-700">
                                                Official Response
                                            </span>
                                        </div>

                                        <!-- Response Text -->
                                        <p class="text-gray-700 text-sm leading-relaxed">
                                            {{ $myroomfeedback->roomfeedbackresponse }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-12 rounded-2xl" style="background-color: rgba(0, 31, 84, 0.05);">
                <i class="fa-solid fa-comment-dots text-5xl mb-4" style="color: #001f54;"></i>
                <h3 class="text-xl font-semibold mb-2" style="color: #001f54;">No feedback yet</h3>
                <p class="text-gray-600 max-w-md mx-auto">Be the first to share your experience about your recent stay.</p>
            </div>
        @endforelse


        <!-- Repeat for more comments... -->

    </div>
</div>
<!-- Guest Feedbacks Section -->