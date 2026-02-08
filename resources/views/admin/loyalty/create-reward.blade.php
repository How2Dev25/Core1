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
    <title>Create New Reward</title>
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
                          
                            Create New Reward
                        </h1>
                        <a href="{{ route('admin.loyalty.rewards') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-arrow-left me-1"></i> Back to Rewards
                        </a>
                    </div>
                </div>

                <!-- Quick Stats Preview -->
                <div class="grid grid-cols-1 sm:grid-cols-4 gap-6 mb-6">
                    <!-- Points Preview -->
                    <div class="bg-white rounded-xl border border-transparent p-4 shadow-lg transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-yellow-400 group">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wide group-hover:text-yellow-700">
                                    Points Cost</h3>
                                <p class="text-2xl font-bold text-gray-900 mt-1" id="points-preview">0</p>
                                <span class="text-xs text-gray-500 group-hover:text-blue-600">Required Points</span>
                            </div>
                            <div class="w-12 h-12 flex items-center justify-center bg-blue-900 rounded-xl group-hover:bg-blue-500 transition-colors duration-300">
                                <i class="fas fa-coins text-yellow-400 text-xl group-hover:text-white"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Stock Preview -->
                    <div class="bg-white rounded-xl border border-transparent p-4 shadow-lg transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-blue-400 group">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wide group-hover:text-blue-700">
                                    Stock</h3>
                                <p class="text-2xl font-bold text-gray-900 mt-1" id="stock-preview">Unlimited</p>
                                <span class="text-xs text-gray-500 group-hover:text-blue-600">Quantity</span>
                            </div>
                            <div class="w-12 h-12 flex items-center justify-center bg-blue-900 rounded-xl group-hover:bg-blue-500 transition-colors duration-300">
                                <i class="fas fa-boxes text-yellow-400 text-xl group-hover:text-white"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Value Preview -->
                    <div class="bg-white rounded-xl border border-transparent p-4 shadow-lg transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-green-400 group">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wide group-hover:text-green-700">
                                    Value</h3>
                                <p class="text-2xl font-bold text-gray-900 mt-1" id="value-preview">₱0.00</p>
                                <span class="text-xs text-gray-500 group-hover:text-blue-600">Monetary Value</span>
                            </div>
                            <div class="w-12 h-12 flex items-center justify-center bg-blue-900 rounded-xl group-hover:bg-blue-500 transition-colors duration-300">
                                <i class="fas fa-money-bill-wave text-yellow-400 text-xl group-hover:text-white"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Category Preview -->
                    <div class="bg-white rounded-xl border border-transparent p-4 shadow-lg transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-purple-400 group">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wide group-hover:text-blue-700">
                                    Category</h3>
                                <p class="text-2xl font-bold text-gray-900 mt-1" id="category-preview">-</p>
                                <span class="text-xs text-gray-500 group-hover:text-purple-600">Type</span>
                            </div>
                            <div class="w-12 h-12 flex items-center justify-center bg-blue-900 rounded-xl group-hover:bg-blue -500 transition-colors duration-300">
                                <i class="fas fa-tag text-yellow-400 text-xl group-hover:text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Form Card -->
                <div class="bg-white rounded-xl border border-gray-200 shadow-lg overflow-hidden">
                    <!-- Header -->
                    <div class="bg-blue-900 text-white px-6 py-4">
                        <h2 class="text-lg font-semibold">
                            <i class="fas fa-gift me-2"></i>
                            Reward Creation Form
                        </h2>
                    </div>

                    <!-- Form -->
                    <form action="{{ route('admin.loyalty.rewards.store') }}" method="POST" class="p-6">
                        @csrf

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
                                           placeholder="e.g., Free Breakfast, Room Upgrade, Spa Discount" required>
                                    <span class="label-text-alt text-gray-500">Name that guests will see</span>
                                </div>

                                <!-- Category -->
                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text font-medium">Category *</span>
                                    </label>
                                    <select class="select select-bordered w-full" id="category" name="category" required onchange="updateCategoryPreview()">
                                        <option value="">Select Category</option>
                                        @foreach($categories as $value => $label)
                                            <option value="{{ $value }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    <span class="label-text-alt text-gray-500">Type of reward</span>
                                </div>

                                <!-- Description -->
                                <div class="form-control lg:col-span-2">
                                    <label class="label">
                                        <span class="label-text font-medium">Description *</span>
                                    </label>
                                    <textarea class="textarea textarea-bordered w-full h-32" 
                                              id="description" name="description" 
                                              placeholder="Describe the reward in detail. What does the guest receive? Any special conditions?" required></textarea>
                                    <span class="label-text-alt text-gray-500">Detailed description for guests</span>
                                </div>

                                <!-- Image URL -->
                                <div class="form-control lg:col-span-2">
                                    <label class="label">
                                        <span class="label-text font-medium">Image URL</span>
                                    </label>
                                    <input type="url" class="input input-bordered w-full" 
                                           id="image_url" name="image_url" 
                                           placeholder="https://example.com/reward-image.jpg">
                                    <span class="label-text-alt text-gray-500">Optional image for visual appeal</span>
                                </div>
                            </div>
                        </div>

                        <!-- Pricing & Stock -->
                        <div class="mb-8">
                            <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wider mb-4">
                                <i class="fas fa-tag me-2"></i>Pricing & Stock Management
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
                                               min="1" required oninput="updatePointsPreview()">
                                    </div>
                                    <span class="label-text-alt text-gray-500">How many points needed?</span>
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
                                               step="0.01" min="0" oninput="updateValuePreview()">
                                    </div>
                                    <span class="label-text-alt text-gray-500">Estimated value in pesos</span>
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
                                               value="-1" oninput="updateStockPreview()">
                                    </div>
                                    <span class="label-text-alt text-gray-500">-1 for unlimited stock</span>
                                </div>

                                <!-- Expires At -->
                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text font-medium">Expires At</span>
                                    </label>
                                    <div class="relative">
                                        <i class="fas fa-calendar-alt absolute left-3 top-1/2 -translate-y-1/2 text-red-500"></i>
                                        <input type="date" class="input input-bordered w-full pl-10" 
                                               id="expires_at" name="expires_at">
                                    </div>
                                    <span class="label-text-alt text-gray-500">Optional expiry date</span>
                                </div>
                            </div>
                        </div>

                        <!-- Terms & Conditions -->
                        <div class="mb-8">
                            <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wider mb-4">
                                <i class="fas fa-file-contract me-2"></i>Terms & Conditions
                            </h3>
                            
                            <div class="mb-4">
                                <span class="text-sm text-gray-600 mb-2 block">
                                    Define clear terms for redemption. Guests must agree to these terms.
                                </span>
                            </div>
                            
                            <div id="terms-container" class="space-y-3 mb-4">
                                <div class="flex items-center gap-2">
                                    <div class="flex-1">
                                        <input type="text" class="input input-bordered w-full" 
                                               name="terms_conditions[]" 
                                               placeholder="e.g., Valid for one person only">
                                    </div>
                                    <button type="button" class="btn btn-success btn-sm" onclick="addTerm()">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="text-sm text-gray-500">
                                <i class="fas fa-lightbulb me-1"></i>
                                Add terms like blackout dates, advance notice requirements, or other restrictions.
                            </div>
                        </div>

                        <!-- Admin Notes -->
                        <div class="mb-8">
                            <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wider mb-4">
                                <i class="fas fa-cog me-2"></i>Administration
                            </h3>
                            
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text font-medium">Admin Notes</span>
                                </label>
                                <textarea class="textarea textarea-bordered w-full h-24" 
                                          id="admin_notes" name="admin_notes" 
                                          placeholder="Internal notes for administrators. Not visible to guests."></textarea>
                                <span class="label-text-alt text-gray-500">For internal use only</span>
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
                                    <i class="fas fa-plus-circle me-1"></i> Create Reward
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>

    <script>
    // Update preview functions
    function updatePointsPreview() {
        const points = document.getElementById('points_required').value || 0;
        document.getElementById('points-preview').textContent = parseInt(points).toLocaleString();
    }

    function updateStockPreview() {
        const stock = document.getElementById('stock_quantity').value;
        if (stock === '-1' || stock === '') {
            document.getElementById('stock-preview').textContent = 'Unlimited';
        } else {
            document.getElementById('stock-preview').textContent = stock;
        }
    }

    function updateValuePreview() {
        const value = document.getElementById('monetary_value').value || 0;
        document.getElementById('value-preview').textContent = '₱' + parseFloat(value).toFixed(2);
    }

    function updateCategoryPreview() {
        const select = document.getElementById('category');
        const selectedOption = select.options[select.selectedIndex];
        document.getElementById('category-preview').textContent = selectedOption.text || '-';
    }

    // Terms management
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
        if (document.querySelectorAll('#terms-container .flex').length > 1) {
            button.parentElement.remove();
        } else {
            // Clear the input if it's the last one
            const input = button.previousElementSibling.querySelector('input');
            input.value = '';
            input.focus();
        }
    }

    // Initialize previews
    document.addEventListener('DOMContentLoaded', function() {
        updatePointsPreview();
        updateStockPreview();
        updateValuePreview();
        updateCategoryPreview();
        
        // Attach event listeners
        document.getElementById('points_required').addEventListener('input', updatePointsPreview);
        document.getElementById('stock_quantity').addEventListener('input', updateStockPreview);
        document.getElementById('monetary_value').addEventListener('input', updateValuePreview);
        document.getElementById('category').addEventListener('change', updateCategoryPreview);
    });
    </script>

    @livewireScripts
    @include('javascriptfix.soliera_js')
</body>
</html>