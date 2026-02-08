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

    <div class="w-full flex justify-center items-center max-md:w-full">
      <div
        class="max-w-4xl w-full bg-white/10 backdrop-blur-lg rounded-xl shadow-2xl border border-white/20 overflow-hidden">

        <div class="grid md:grid-cols-2 gap-0">
          <!-- Left Side - Photo Setup Form -->
          <div class="p-6">
            <!-- Card Header -->
            <div class="mb-4 text-center">
              <h2 class="text-xl font-bold text-white">Photo Setup</h2>
              <p class="text-white/80 text-sm mt-1">Upload your profile picture</p>
            </div>

            <!-- Progress Steps -->
            <ul class="steps steps-horizontal w-full mb-4">
              <li class="step step-primary text-white text-xs">Terms</li>
              <li class="step step-primary text-white text-xs">Registration</li>
              <li class="step step-primary text-white text-xs">Photo Setup</li>
            </ul>

            <!-- Card Body -->
            <div>
              <form action="/upload-photo/{{Auth::guard('guest')->user()->guestID}}" method="POST"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <div class="mb-4">
                  <!-- Photo Upload Area -->
                  <div class="flex flex-col items-center justify-center">
                    <!-- Image Preview -->
                    <div class="relative mb-3">
                      <div id="image-preview"
                        class="w-28 h-28 rounded-full bg-white/10 border-2 border-dashed border-white/30 flex items-center justify-center overflow-hidden">
                        <i class="fas fa-user text-3xl text-white/50" id="default-icon"></i>
                        <img id="preview-image" src="" alt="Preview" class="hidden w-full h-full object-cover">
                      </div>
                      <button type="button" id="remove-image"
                        class="absolute -top-1 -right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center hidden">
                        <i class="fas fa-times text-xs"></i>
                      </button>
                    </div>

                    <!-- Upload Button -->
                    <label for="photo-upload"
                      class="btn-primary btn-sm cursor-pointer px-4 py-2 rounded-md shadow-md text-sm">
                      <i class="fas fa-camera mr-2"></i> Choose Photo
                      <input id="photo-upload" type="file" class="hidden" accept="image/*" name="guest_photo" required>
                    </label>
                    <p class="text-white/60 text-xs mt-2">JPG or PNG, max 2MB</p>
                  </div>

                  <!-- Camera Options -->
                  <div class="mt-4">
                    <h3 class="text-white/90 text-xs font-medium mb-2 flex items-center">
                      <i class="fas fa-camera-retro mr-2"></i> Camera Options
                    </h3>
                    <div class="grid grid-cols-2 gap-2">
                      <button type="button" id="open-camera"
                        class="bg-white/5 border border-white/20 rounded-lg py-2 px-3 text-white/80 text-xs hover:bg-white/10 transition flex items-center justify-center">
                        <i class="fas fa-video mr-2"></i> Take Photo
                      </button>
                      <button type="button" id="retake-photo"
                        class="bg-white/5 border border-white/20 rounded-lg py-2 px-3 text-white/80 text-xs hover:bg-white/10 transition flex items-center justify-center hidden">
                        <i class="fas fa-redo mr-2"></i> Retake
                      </button>
                    </div>

                    <!-- Camera Feed (hidden by default) -->
                    <div id="camera-feed" class="mt-3 hidden">
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

                <div class="flex justify-between items-center">
                  <button type="button" onclick="document.getElementById('cancelForm').submit();"
                    class="font-medium text-blue-400 hover:text-blue-300 flex items-center text-xs">
                    <i class="fas fa-arrow-left mr-2"></i> Cancel
                  </button>

                  <button type="submit" class="btn-primary btn py-2 text-sm">
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

          <!-- Right Side - Logo and Information -->
          <div class="bg-white/5 p-6 flex flex-col justify-center border-l border-white/10">
            <!-- Logo and Hotel Name -->
            <div class="mb-6 text-center">
              <div class="flex justify-center mb-3">
                <!-- Circular white background wrapper for logo -->
                <div class="bg-white rounded-full p-4 shadow-lg">
                  <img src="{{ asset('images/logo/sonly.png') }}" alt="Soliera Hotel Logo" class="h-24 w-24 object-contain">
                </div>
              </div>
              <h3 class="text-xl font-bold text-white mb-1">Soliera Hotel And Restaurant</h3>
              <p class="text-white/70 text-xs">Almost There!</p>
            </div>

            <!-- Divider -->
            <div class="relative mb-4">
              <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-white/20"></div>
              </div>
              <div class="relative flex justify-center text-xs">
                <span class="px-2 bg-white/5 text-white/50">
                  Final Step
                </span>
              </div>
            </div>

            <!-- Information Cards -->
            <div class="space-y-3">
              <div class="bg-white/10 rounded-lg p-3 border border-white/20">
                <div class="flex items-start space-x-3">
                  <svg class="h-5 w-5 text-blue-400 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                  </svg>
                  <div>
                    <h4 class="text-white font-semibold text-sm mb-1">Profile Picture</h4>
                    <p class="text-white/70 text-xs leading-relaxed">
                      Add a photo to personalize your account and help staff recognize you during check-in.
                    </p>
                  </div>
                </div>
              </div>

              <div class="bg-white/10 rounded-lg p-3 border border-white/20">
                <div class="flex items-start space-x-3">
                  <svg class="h-5 w-5 text-green-400 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                      d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                      clip-rule="evenodd" />
                  </svg>
                  <div>
                    <h4 class="text-white font-semibold text-sm mb-1">Quick Tips</h4>
                    <p class="text-white/70 text-xs leading-relaxed">
                      • Use good lighting<br>
                      • Face the camera directly<br>
                      • Remove sunglasses or hats<br>
                      • Keep background simple
                    </p>
                  </div>
                </div>
              </div>

             

              
            </div>

           
          </div>

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