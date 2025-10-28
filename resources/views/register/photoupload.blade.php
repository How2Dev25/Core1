<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Soliera Hotel - Registration</title>

  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  @vite('resources/css/app.css')
</head>

<body>

  @auth('guest')



    <section class="relative w-full min-h-screen">

      <!-- Background image with overlay -->
      <div class="absolute inset-0 bg-cover bg-center z-0"
        style="background-image: url('{{ asset('images/defaults/hotel3.jpg') }}');"></div>
      <div class="absolute inset-0 bg-black/40 z-10"></div>
      <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-black/70 z-10"></div>

      <!-- Content container -->
      <div class="relative z-10 w-full min-h-screen flex justify-center items-center  p-4">
        <div class="w-1/2 flex justify-center items-center max-md:hidden p-8">
          <div class="max-w-md space-y-10">
            <!-- Logo -->
            <div data-aos="zoom-in" data-aos-delay="100">
              <a href="/">
                <img class="w-full max-h-52 hover:scale-105 transition-transform"
                  src="{{asset('images/logo/logofinal.png')}}" alt="Soliera Hotel & Restaurant">
              </a>
            </div>

            <!-- Benefits Section -->
            <div class="space-y-6">

              <div class="space-y-4">


                <!-- Benefit 2 -->
                <div class="flex items-start gap-3" data-aos="fade-up" data-aos-delay="300">
                  <div class="p-2 bg-amber-400/10 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                      class="lucide lucide-zap text-amber-400">
                      <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2" />
                    </svg>
                  </div>
                  <div>
                    <h4 class="font-medium text-white">Faster Bookings</h4>
                    <p class="text-sm text-white/70">One-click reservations with saved preferences</p>
                  </div>
                </div>

                <!-- Benefit 3 -->
                <div class="flex items-start gap-3" data-aos="fade-up" data-aos-delay="350">
                  <div class="p-2 bg-amber-400/10 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                      class="lucide lucide-star text-amber-400">
                      <polygon
                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                    </svg>
                  </div>
                  <div>
                    <h4 class="font-medium text-white">Reward Points</h4>
                    <p class="text-sm text-white/70">Earn points for every stay that you can redeem</p>

                  </div>
                </div>

                <!-- Benefit 4 -->
                <div class="flex items-start gap-3" data-aos="fade-up" data-aos-delay="400">
                  <div class="p-2 bg-amber-400/10 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                      class="lucide lucide-bell-ring text-amber-400">
                      <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9" />
                      <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0" />
                      <path d="M4 2C2.8 3.7 2 5.7 2 8" />
                      <path d="M22 8c0-2.3-.8-4.3-2-6" />
                    </svg>
                  </div>
                  <div>
                    <h4 class="font-medium text-white">Personalized Alerts</h4>
                    <p class="text-sm text-white/70">Get notified about special events and promotions</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="w-1/2 flex justify-center items-center max-md:w-full">
          <div class="max-w-md w-full bg-white/10 backdrop-blur-lg p-6 rounded-xl shadow-2xl border border-white/20">
            <!-- Card Header -->
            <div class="mb-6 text-center flex justify-center items-center flex-col">
              <h2 class="text-2xl font-bold text-white">Photo Setup</h2>
              <p class="text-white/80 mt-1">Upload your profile picture</p>
            </div>

            <!-- Card Body -->
            <div>
              <form action="/upload-photo/{{Auth::guard('guest')->user()->guestID}}" method="POST"
                enctype="multipart/form-data">

                @method('PUT')
                <ul class="steps steps-horizontal lg:steps-horizontal w-full mb-5">
                  <li class="step step-primary text-white">Terms</li>
                  <li class="step step-primary text-white">Registration</li>
                  <li class="step step-primary text-white">Photo Setup</li>
                </ul>

                @csrf
                <div class="mb-6">
                  <!-- Photo Upload Area -->
                  <div class="flex flex-col items-center justify-center">
                    <!-- Image Preview -->
                    <div class="relative mb-4">
                      <div id="image-preview"
                        class="w-32 h-32 rounded-full bg-white/10 border-2 border-dashed border-white/30 flex items-center justify-center overflow-hidden">
                        <i class="fas fa-user text-4xl text-white/50" id="default-icon"></i>
                        <img id="preview-image" src="" alt="Preview" class="hidden w-full h-full object-cover">
                      </div>
                      <button type="button" id="remove-image"
                        class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center hidden">
                        <i class="fas fa-times text-xs"></i>
                      </button>
                    </div>

                    <!-- Upload Button -->
                    <label for="photo-upload" class="btn-primary btn-sm cursor-pointer p-3 rounded-md shadow-md">
                      <i class="fas fa-camera mr-2"></i> Choose Photo
                      <input id="photo-upload" type="file" class="hidden" accept="image/*" name="guest_photo" required>
                    </label>
                    <p class="text-white/60 text-sm mt-2">JPG or PNG, max 2MB</p>
                  </div>

                  <!-- Camera Options -->
                  <div class="mt-6">
                    <h3 class="text-white/90 text-sm font-medium mb-3 flex items-center">
                      <i class="fas fa-camera-retro mr-2"></i> Camera Options
                    </h3>
                    <div class="grid grid-cols-2 gap-3">
                      <button type="button" id="open-camera"
                        class="bg-white/5 border border-white/20 rounded-lg py-2 px-3 text-white/80 hover:bg-white/10 transition flex items-center justify-center">
                        <i class="fas fa-video mr-2"></i> Take Photo
                      </button>
                      <button type="button" id="retake-photo"
                        class="bg-white/5 border border-white/20 rounded-lg py-2 px-3 text-white/80 hover:bg-white/10 transition flex items-center justify-center hidden">
                        <i class="fas fa-redo mr-2"></i> Retake
                      </button>
                    </div>

                    <!-- Camera Feed (hidden by default) -->
                    <div id="camera-feed" class="mt-4 hidden">
                      <div class="relative bg-black rounded-lg overflow-hidden">
                        <video id="video" width="100%" autoplay playsinline class="w-full"></video>
                        <div class="absolute bottom-0 left-0 right-0 bg-black/50 p-2 flex justify-center">
                          <button type="button" id="capture-btn"
                            class="bg-white rounded-full w-12 h-12 flex items-center justify-center mx-auto">
                            <i class="fas fa-circle text-red-500 text-xl"></i>
                          </button>
                        </div>
                      </div>
                      <canvas id="canvas" class="hidden"></canvas>
                    </div>
                  </div>
                </div>

                <div class="flex justify-between">
                  <button type="button" onclick="document.getElementById('cancelForm').submit();"
                    class="font-medium text-blue-400 hover:text-blue-300 flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> Cancel
                  </button>

                  <button type="submit" class="btn-primary btn">
                    Complete Registration
                    <i class="fas fa-check ml-2"></i>
                  </button>
                </div>
              </form>

              <form id="cancelForm" action="/cancelreg/{{ auth::guard('guest')->user()->guestID }}" method="POST"
                style="display:none;">
                @csrf
                @method('DELETE')
              </form>
            </div>
          </div>

        </div>



      </div>


    </section>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <script>
      AOS.init({
        duration: 1000,
        once: true
      });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <script>
      AOS.init({
        duration: 1000,
        once: true
      });
    </script>

    <script>
      // Image Upload Preview
      const photoUpload = document.getElementById('photo-upload');
      const previewImage = document.getElementById('preview-image');
      const defaultIcon = document.getElementById('default-icon');
      const removeImage = document.getElementById('remove-image');
      const imagePreview = document.getElementById('image-preview');

      photoUpload.addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (file) {
          const reader = new FileReader();
          reader.onload = function (event) {
            previewImage.src = event.target.result;
            previewImage.classList.remove('hidden');
            defaultIcon.classList.add('hidden');
            removeImage.classList.remove('hidden');
          }
          reader.readAsDataURL(file);
        }
      });

      removeImage.addEventListener('click', function () {
        photoUpload.value = '';
        previewImage.src = '';
        previewImage.classList.add('hidden');
        defaultIcon.classList.remove('hidden');
        removeImage.classList.add('hidden');
      });

      // Camera Functionality
      const openCamera = document.getElementById('open-camera');
      const retakePhoto = document.getElementById('retake-photo');
      const cameraFeed = document.getElementById('camera-feed');
      const video = document.getElementById('video');
      const canvas = document.getElementById('canvas');
      const captureBtn = document.getElementById('capture-btn');
      let stream = null;

      openCamera.addEventListener('click', async function () {
        try {
          stream = await navigator.mediaDevices.getUserMedia({ video: true });
          video.srcObject = stream;
          cameraFeed.classList.remove('hidden');
          openCamera.classList.add('hidden');
          retakePhoto.classList.remove('hidden');
        } catch (err) {
          alert('Could not access the camera: ' + err.message);
        }
      });

      captureBtn.addEventListener('click', function () {
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);

        // Stop camera stream
        stream.getTracks().forEach(track => track.stop());

        // Show captured image
        previewImage.src = canvas.toDataURL('image/png');
        previewImage.classList.remove('hidden');
        defaultIcon.classList.add('hidden');
        removeImage.classList.remove('hidden');

        // Hide camera feed
        cameraFeed.classList.add('hidden');

        // Create a File object from the canvas
        canvas.toBlob(function (blob) {
          const file = new File([blob], "profile-photo.png", { type: "image/png" });
          const dataTransfer = new DataTransfer();
          dataTransfer.items.add(file);
          photoUpload.files = dataTransfer.files;
        }, 'image/png');
      });

      retakePhoto.addEventListener('click', function () {
        if (stream) {
          stream.getTracks().forEach(track => track.stop());
        }
        cameraFeed.classList.add('hidden');
        openCamera.classList.remove('hidden');
        retakePhoto.classList.add('hidden');
      });
    </script>

  @else

    <div class="">You Are not In Logged In</div>


  @endauth

</body>

</html>