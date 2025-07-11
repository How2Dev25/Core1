<!DOCTYPE html>
<html lang="en" data-theme ="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    @vite('resources/css/app.css')
 
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <title>{{$title}} - Room Management</title>
</head>
<body class="bg-base-100">
    <div class="flex h-screen overflow-hidden">
      <!-- Sidebar -->
     @include('admin.components.dashboard.sidebar')
  
      <!-- Main content -->
      <div class="flex flex-col flex-1 overflow-hidden">
        <!-- Navbar -->
         @include('admin.components.dashboard.navbar')
  
        <!-- Dashboard Content -->
        <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 transition-slow ">
            {{-- Subsystem Name --}}
          <div class="pb-5 border-b border-base-300 animate-fadeIn">
            <h1 class="text-2xl font-bold text-[#191970] bg-clip-text ">Room Management</h1>
          </div>
            {{-- Subsystem Name --}}

          {{-- content --}}
        
 <section class="container mx-auto px-4 py-10">
    <!-- Header -->
    <div class="flex justify-between items-center mb-10">
        <h1 class="text-3xl font-bold text-gray-800">Room Profile</h1>
        <span class="px-4 py-2 rounded-full bg-green-100 text-green-800 text-sm font-semibold">
            {{ $room->roomstatus }}
        </span>
    </div>

    <!-- Layout Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Section -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Main Photo -->
            <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                <img id="photo" src="{{ asset($room->roomphoto) }}" alt="Room Image" class="w-full h-96 object-cover">
            </div>

            <!-- Upload Field -->
           
            <!-- Additional Photos -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                @foreach ([
                    'https://source.unsplash.com/random/300x200/?hotel,bathroom',
                    'https://source.unsplash.com/random/300x200/?hotel,view',
                    'https://source.unsplash.com/random/300x200/?hotel,bed'
                ] as $src)
                    <div class="bg-white rounded-xl shadow overflow-hidden hover:scale-105 transition">
                        <img src="{{ $src }}" alt="Room" class="w-full h-32 object-cover">
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Right Section -->
        <div class="bg-white rounded-2xl shadow-md p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">Room Information</h2>

            <form action="/modifyroom/{{$room->roomID}}" method="POST" enctype="multipart/form-data" class="space-y-5">
                <!-- Room Type -->
                @csrf
                @method('PUT')

                 <div class="bg-white rounded-xl shadow-md p-4">
                <label for="roomphoto" class="block text-sm font-medium text-gray-700 mb-2">Upload New Room Photo</label>
                <input type="file" name="roomphoto" id="dropzone-file"
                    class="block w-full text-sm text-gray-500
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-md file:border-0
                        file:text-sm file:font-semibold
                        file:bg-blue-50 file:text-blue-700
                        hover:file:bg-blue-100">
                <p class="mt-2 text-xs text-gray-500">JPG, PNG, Max 5MB</p>
            </div>



                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Room Type</label>
                    <select name="roomtype" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                        @foreach (['Standard', 'Deluxe', 'Suite', 'Executive'] as $type)
                            <option value="{{ $type }}" @if($room->roomtype === $type) selected @endif>{{ $type }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Room Size -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Room Size (sqft)</label>
                    <input name="roomsize" type="number" value="{{ $room->roomsize }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md">
                </div>

                <!-- Max Guests -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Max Guests</label>
                    <input name="roommaxguest" type="number" value="{{ $room->roommaxguest }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md">
                </div>

                <!-- Price -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Price per night ($)</label>
                    <input name="roomprice" type="number" value="{{ $room->roomprice }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md">
                </div>

                <!-- Room Status -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="roomstatus" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                        @foreach (['available', 'occupied', 'maintenance', 'reserved'] as $status)
                            <option value="{{ $status }}" @if($room->roomstatus === $status) selected @endif>
                                {{ ucfirst($status) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Features -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Features</label>
                    <textarea name="roomfeatures"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md h-24">{{ $room->roomfeatures }}</textarea>
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea name="roomdescription"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md h-32">{{ $room->roomdescription }}</textarea>
                </div>

                <!-- Actions -->
                <div class="pt-4 flex justify-end space-x-3">
                    <button type="button"
                        class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100 transition">
                        Cancel
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

  
          


          
          
          <!-- Lucide Icons -->
          <script type="module">
            import lucide from 'https://unpkg.com/lucide@latest/dist/esm/lucide.js';
            lucide.createIcons();
          </script>
  
           
      
 
        </main>
      </div>
    </div>

    {{-- modals --}}

   
 
  
 
  </body>
  @include('javascriptfix.soliera_js')

  <script src="{{asset('javascript/photouploadglobal.js')}}"></script>
  
</html>