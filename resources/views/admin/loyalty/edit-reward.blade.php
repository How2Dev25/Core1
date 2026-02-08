<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://unpkg.com/lucide@latest"></script>
    <title>Edit Reward: {{ $reward->name }}</title>
    @livewireStyles
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
            <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 transition-slow">
                <!-- Page Header -->
                <div class="pb-5 border-b border-base-300 animate-fadeIn mb-6">
                    <div class="flex justify-between items-center">
                        <h1 class="text-2xl font-bold bg-white bg-clip-text text-[#191970]">
                          
                            Edit Reward: {{ $reward->name }}
                        </h1>
                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.loyalty.rewards') }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-arrow-left me-1"></i> Back to Rewards
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Reward Stats -->
                <div class="grid grid-cols-1 sm:grid-cols-4 gap-6 mb-6">
                    <!-- Redemptions -->
                    <div class="bg-white rounded-xl border border-transparent p-4 shadow-lg transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-purple-400 group">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wide group-hover:text-purple-700">
                                    Redemptions</h3>
                                <p class="text-2xl font-bold text-gray-900 mt-1">{{ $reward->redemption_count }}</p>
                                <span class="text-xs text-gray-500 group-hover:text-blue-600">Total Uses</span>
                            </div>
                            <div class="w-12 h-12 flex items-center justify-center bg-blue-900 rounded-xl group-hover:bg-blue-500 transition-colors duration-300">
                                <i class="fas fa-trophy text-yellow-400 text-xl group-hover:text-white"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Points Value -->
                    <div class="bg-white rounded-xl border border-transparent p-4 shadow-lg transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-yellow-400 group">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wide group-hover:text-yellow-700">
                                    Points Required</h3>
                                <p class="text-2xl font-bold text-gray-900 mt-1">{{ number_format($reward->points_required) }}</p>
                                <span class="text-xs text-gray-500 group-hover:text-blue-600">Cost</span>
                            </div>
                            <div class="w-12 h-12 flex items-center justify-center bg-blue-900 rounded-xl group-hover:bg-blue-500 transition-colors duration-300">
                                <i class="fas fa-coins text-yellow-400 text-xl group-hover:text-white"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Stock Status -->
                    <div class="bg-white rounded-xl border border-transparent p-4 shadow-lg transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-blue-400 group">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wide group-hover:text-blue-700">
                                    Stock</h3>
                                @if($reward->stock_quantity === -1)
                                    <p class="text-2xl font-bold text-gray-900 mt-1">∞</p>
                                    <span class="text-xs text-gray-500 group-hover:text-blue-600">Unlimited</span>
                                @else
                                    <p class="text-2xl font-bold text-gray-900 mt-1">{{ $reward->stock_quantity }}</p>
                                    <span class="text-xs text-gray-500 group-hover:text-blue-600">Available</span>
                                @endif
                            </div>
                            <div class="w-12 h-12 flex items-center justify-center bg-blue-900 rounded-xl group-hover:bg-blue-500 transition-colors duration-300">
                                <i class="fas fa-boxes text-yellow-400 text-xl group-hover:text-white"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="bg-white rounded-xl border border-transparent p-4 shadow-lg transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-green-400 group">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wide group-hover:text-green-700">
                                    Status</h3>
                                <p class="text-2xl font-bold text-gray-900 mt-1">
                                    {{ $reward->is_active ? 'Active' : 'Inactive' }}
                                </p>
                                <span class="text-xs text-gray-500 group-hover:text-green-600">
                                    @if($reward->expires_at && $reward->expires_at->isPast())
                                        Expired
                                    @else
                                        {{ $reward->expires_at ? 'Expires ' . $reward->expires_at->format('M d') : 'No expiry' }}
                                    @endif
                                </span>
                            </div>
                            <div class="w-12 h-12 flex items-center justify-center {{ $reward->is_active ? 'bg-blue-900' : 'bg-gray-400' }} rounded-xl group-hover:bg-blue-500 transition-colors duration-300">
                                <i class="fas fa-{{ $reward->is_active ? 'check-circle' : 'pause-circle' }} text-yellow-400 text-xl group-hover:text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Form Card -->
                <div class="bg-white rounded-xl border border-gray-200 shadow-lg overflow-hidden">
                    <!-- Header -->
                    <div class="bg-blue-900 text-white px-6 py-4">
                        <h2 class="text-lg font-semibold">
                            <i class="fas fa-edit me-2"></i>
                            Reward Details
                        </h2>
                    </div>

                    <!-- Form -->
                    <form action="{{ route('admin.loyalty.rewards.update', $reward) }}" method="POST" class="p-6">
                        @csrf
                        @method('PUT')

                        <!-- Basic Information -->
                        <div class="mb-8">
                            <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wider mb-4">
                                <i class="fas fa-info-circle me-2"></i>Basic Information
                            </h3>
                            
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                <!-- Reward Name -->
                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text font-medium">Reward Name *</span>
                                    </label>
                                    <input type="text" class="input input-bordered w-full" 
                                           id="name" name="name" 
                                           value="{{ $reward->name }}" 
                                           placeholder="Enter reward name" required>
                                </div>

                                <!-- Category -->
                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text font-medium">Category *</span>
                                    </label>
                                    <select class="select select-bordered w-full" id="category" name="category" required>
                                        <option value="">Select Category</option>
                                        @foreach($categories as $value => $label)
                                            <option value="{{ $value }}" {{ $reward->category == $value ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Description -->
                                <div class="form-control lg:col-span-2">
                                    <label class="label">
                                        <span class="label-text font-medium">Description *</span>
                                    </label>
                                    <textarea class="textarea textarea-bordered w-full h-32" 
                                              id="description" name="description" 
                                              placeholder="Enter detailed description" required>{{ $reward->description }}</textarea>
                                </div>

                                <!-- Image URL -->
                                <div class="form-control lg:col-span-2">
                                    <label class="label">
                                        <span class="label-text font-medium">Image URL</span>
                                    </label>
                                    <div class="flex items-center gap-3">
                                        <input type="url" class="input input-bordered w-full" 
                                               id="image_url" name="image_url" 
                                               value="{{ $reward->image_url }}" 
                                               placeholder="https://example.com/image.jpg">
                                        @if($reward->image_url)
                                            <div class="w-16 h-16 rounded-lg overflow-hidden border">
                                                <img src="{{ $reward->image_url }}" alt="Reward Image" 
                                                     class="w-full h-full object-cover">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pricing & Stock -->
                        <div class="mb-8">
                            <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wider mb-4">
                                <i class="fas fa-tag me-2"></i>Pricing & Stock
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                                <!-- Points Required -->
                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text font-medium">Points Required *</span>
                                    </label>
                                    <div class="relative">
                                        <i class="fas fa-coins absolute left-3 top-1/2 -translate-y-1/2 text-yellow-500"></i>
                                        <input type="number" class="input input-bordered w-full pl-10" 
                                               id="points_required" name="points_required" 
                                               value="{{ $reward->points_required }}" 
                                               min="1" required>
                                    </div>
                                </div>

                                <!-- Monetary Value -->
                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text font-medium">Monetary Value (₱)</span>
                                    </label>
                                    <div class="relative">
                                        <i class="fas fa-money-bill-wave absolute left-3 top-1/2 -translate-y-1/2 text-green-500"></i>
                                        <input type="number" class="input input-bordered w-full pl-10" 
                                               id="monetary_value" name="monetary_value" 
                                               value="{{ $reward->monetary_value }}" 
                                               step="0.01" min="0">
                                    </div>
                                </div>

                                <!-- Stock Quantity -->
                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text font-medium">Stock Quantity</span>
                                    </label>
                                    <div class="relative">
                                        <i class="fas fa-boxes absolute left-3 top-1/2 -translate-y-1/2 text-blue-500"></i>
                                        <input type="number" class="input input-bordered w-full pl-10" 
                                               id="stock_quantity" name="stock_quantity" 
                                               value="{{ $reward->stock_quantity }}">
                                    </div>
                                    <span class="text-xs text-gray-500 mt-1">-1 for unlimited stock</span>
                                </div>

                                <!-- Expires At -->
                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text font-medium">Expires At</span>
                                    </label>
                                    <div class="relative">
                                        <i class="fas fa-calendar-alt absolute left-3 top-1/2 -translate-y-1/2 text-red-500"></i>
                                        <input type="date" class="input input-bordered w-full pl-10" 
                                               id="expires_at" name="expires_at" 
                                               value="{{ $reward->expires_at ? $reward->expires_at->format('Y-m-d') : '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Terms & Conditions -->
                        <div class="mb-8">
                            <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wider mb-4">
                                <i class="fas fa-file-contract me-2"></i>Terms & Conditions
                            </h3>
                            
                            <div id="terms-container" class="space-y-3 mb-4">
                                @foreach($reward->terms_conditions ?? [] as $term)
                                    <div class="flex items-center gap-2">
                                        <div class="flex-1">
                                            <input type="text" class="input input-bordered w-full" 
                                                   name="terms_conditions[]" value="{{ $term }}" 
                                                   placeholder="Enter term or condition">
                                        </div>
                                        <button type="button" class="btn btn-error btn-sm" onclick="removeTerm(this)">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                @endforeach
                                @if(empty($reward->terms_conditions))
                                    <div class="flex items-center gap-2">
                                        <div class="flex-1">
                                            <input type="text" class="input input-bordered w-full" 
                                                   name="terms_conditions[]" placeholder="Enter term or condition">
                                        </div>
                                        <button type="button" class="btn btn-success btn-sm" onclick="addTerm()">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                @endif
                            </div>
                            
                            @if(!empty($reward->terms_conditions))
                                <button type="button" class="btn btn-outline btn-sm" onclick="addTerm()">
                                    <i class="fas fa-plus me-1"></i> Add Term
                                </button>
                            @endif
                        </div>

                        <!-- Admin Notes & Status -->
                        <div class="mb-8">
                            <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wider mb-4">
                                <i class="fas fa-cog me-2"></i>Settings
                            </h3>
                            
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                <!-- Admin Notes -->
                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text font-medium">Admin Notes</span>
                                    </label>
                                    <textarea class="textarea textarea-bordered w-full h-32" 
                                              id="admin_notes" name="admin_notes" 
                                              placeholder="Internal notes for administrators">{{ $reward->admin_notes }}</textarea>
                                </div>

                                <!-- Status & Info -->
                                <div class="space-y-4">
                                    <!-- Active Status -->
                                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl border">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-lg {{ $reward->is_active ? 'bg-green-100' : 'bg-gray-100' }} flex items-center justify-center">
                                                <i class="fas fa-{{ $reward->is_active ? 'check-circle' : 'pause-circle' }} {{ $reward->is_active ? 'text-green-600' : 'text-gray-600' }}"></i>
                                            </div>
                                            <div>
                                                <div class="font-medium text-gray-900">Active Status</div>
                                                <div class="text-sm text-gray-500">Make reward available for redemption</div>
                                            </div>
                                        </div>
                                        <input type="checkbox" class="toggle toggle-primary" 
                                               id="is_active" name="is_active" 
                                               {{ $reward->is_active ? 'checked' : '' }}>
                                    </div>

                                    <!-- Creation Info -->
                                    <div class="p-4 bg-gray-50 rounded-xl border">
                                        <div class="text-sm text-gray-600 space-y-2">
                                            <div class="flex items-center gap-2">
                                                <i class="fas fa-calendar-alt text-gray-400"></i>
                                                <span>Created: {{ $reward->created_at->format('M d, Y') }}</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <i class="fas fa-history text-gray-400"></i>
                                                <span>Last Updated: {{ $reward->updated_at->format('M d, Y') }}</span>
                                            </div>
                                            @if($reward->expires_at)
                                                <div class="flex items-center gap-2">
                                                    <i class="fas fa-clock text-gray-400"></i>
                                                    <span>
                                                        Expires: {{ $reward->expires_at->format('M d, Y') }}
                                                        @if($reward->expires_at->isPast())
                                                            <span class="text-red-500 ml-2">(Expired)</span>
                                                        @endif
                                                    </span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex flex-col sm:flex-row justify-between items-center gap-4 pt-6 border-t border-gray-200">
                            <div class="text-sm text-gray-600">
                                <i class="fas fa-exclamation-circle me-1"></i>
                                Fields marked with * are required
                            </div>
                            <div class="flex gap-3">
                                <a href="{{ route('admin.loyalty.rewards') }}" class="btn btn-ghost">
                                    <i class="fas fa-times me-1"></i> Cancel
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i> Update Reward
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>

    <script>
    function addTerm() {
        const container = document.getElementById('terms-container');
        const div = document.createElement('div');
        div.className = 'flex items-center gap-2';
        div.innerHTML = `
            <div class="flex-1">
                <input type="text" class="input input-bordered w-full" 
                       name="terms_conditions[]" placeholder="Enter term or condition">
            </div>
            <button type="button" class="btn btn-error btn-sm" onclick="removeTerm(this)">
                <i class="fas fa-minus"></i>
            </button>
        `;
        container.appendChild(div);
    }

    function removeTerm(button) {
        button.parentElement.remove();
    }
    </script>

    @livewireScripts
    @include('javascriptfix.soliera_js')
</body>
</html>