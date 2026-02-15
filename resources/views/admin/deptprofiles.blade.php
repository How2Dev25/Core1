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

    <title>{{$title}} - Employee Profile</title>
    @livewireStyles
</head>
@auth


        <body class="bg-base-100">
            <div class="flex h-screen overflow-hidden">
                <!-- Sidebar -->
                @include('admin.components.dashboard.sidebar')






                <!-- Main content -->
                <div class="flex flex-col flex-1 overflow-hidden">
                    <!-- Navbar -->
                    @include('admin.components.dashboard.navbar')



                    <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 transition-slow ">
                        {{-- Subsystem Name --}}
                        <div class="pb-5 border-b border-base-300 animate-fadeIn">
                            <h1 class="text-2xl font-bold bg-white bg-clip-text text-[#191970]">Employee Profile</h1>
                        </div>
                        {{-- Subsystem Name --}}


                        <section class="w-full min-h-screen mt-5">
        @if (session('success'))
            <div id="success-message"
                class="mb-6 bg-gradient-to-r from-green-500 to-green-600 text-white px-6 py-4 rounded-xl shadow-lg flex items-center space-x-4 animate-slide-down">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center animate-bounce-in">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                </div>
                <div class="flex-1">
                    <h4 class="font-bold text-lg">Success!</h4>
                    <p class="text-green-100">{{ session('success') }}</p>
                </div>
                <button onclick="closeSuccessMessage()"
                    class="flex-shrink-0 text-white hover:text-green-100 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @endif

        <!-- Profile Form -->
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden transform transition-all duration-300">
            <!-- Header with improved gradient and animations -->
            <div class="relative bg-gradient-to-br from-blue-900 via-blue-800 to-blue-950 px-8 py-12 overflow-hidden">
                <!-- Animated background elements -->
                <div class="absolute top-0 right-0 w-64 h-64 bg-yellow-400 rounded-full filter blur-3xl opacity-20 animate-pulse"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-yellow-400 rounded-full filter blur-3xl opacity-20 animate-pulse delay-1000"></div>

                <!-- Header content -->
                <div class="relative z-10 flex items-center space-x-5">
                    <div class="bg-gradient-to-br from-yellow-400 to-yellow-500 p-3 rounded-2xl shadow-lg transform transition-transform hover:scale-110 hover:rotate-3 duration-300">
                        <svg class="w-10 h-10 text-blue-900" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-3xl font-bold text-white mb-1 tracking-tight">{{ $deptAccount->employee_name }}</h2>
                        <p class="text-yellow-300 text-sm font-medium flex items-center gap-2">
                            <span class="w-2 h-2 bg-yellow-400 rounded-full animate-pulse"></span>
                            Employee Profile
                        </p>
                    </div>
                </div>
            </div>

            <!-- Profile Form -->
            <form action="" method="POST" enctype="multipart/form-data" class="p-8 space-y-8">
                <!-- Profile Photo Section with enhanced styling -->
                <div class="relative bg-gradient-to-br from-blue-50 via-yellow-50/30 to-blue-50 p-8 rounded-2xl border-2 border-blue-100 hover:border-yellow-400 transition-all duration-300 group">
                    <!-- Decorative corner accents -->
                    <div class="absolute top-0 left-0 w-16 h-16 border-t-4 border-l-4 border-yellow-400 rounded-tl-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="absolute bottom-0 right-0 w-16 h-16 border-b-4 border-r-4 border-blue-400 rounded-br-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                    <div class="flex flex-col md:flex-row items-center md:space-x-8">
                        <div class="relative mb-6 md:mb-0">
                            <!-- Profile photo container with enhanced effects -->
                            <div class="relative w-36 h-36 rounded-full overflow-hidden bg-gradient-to-br from-blue-800 to-blue-900 flex items-center justify-center ring-4 ring-yellow-400 shadow-xl transition-all duration-300 hover:ring-6 hover:ring-yellow-300 hover:shadow-2xl hover:scale-105">
                                @php
                                    $user = $deptAccount;
                                    $photo = optional($user->additionalInfo)->adminphoto;
                                    $name = $user->employee_name ?? 'AA';
                                    $firstName = explode(' ', trim($name))[0] ?? '';
                                    $initials = strtoupper(substr($firstName, 0, 2));
                                @endphp

                                {{-- Profile image --}}
                                <img id="preview-photo" src="{{ asset($photo) }}" alt="Profile Photo"
                                    class="w-full h-full object-cover transition-all duration-500 ease-in-out {{ $photo ? '' : 'hidden' }}">

                                {{-- Placeholder initials --}}
                                <span id="preview-placeholder" class="text-5xl font-bold text-yellow-400 {{ $photo ? 'hidden' : '' }}">
                                    {{ $initials }}
                                </span>
                            </div>
                        </div>

                        <!-- Profile info badges -->
                        <div class="flex-1 text-center md:text-left">
                            <div class="flex flex-wrap gap-3 justify-center md:justify-start">
                                <span class="px-4 py-2 bg-blue-100 text-blue-800 rounded-full text-sm font-semibold shadow-sm hover:shadow-md transition-shadow">
                                    {{ $deptAccount->dept_name }}
                                </span>
                                <span class="px-4 py-2 bg-yellow-100 text-yellow-800 rounded-full text-sm font-semibold shadow-sm hover:shadow-md transition-shadow">
                                    {{ $deptAccount->role }}
                                </span>
                                <span class="px-4 py-2 bg-green-100 text-green-800 rounded-full text-sm font-semibold shadow-sm hover:shadow-md transition-shadow flex items-center gap-2">
                                    <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                                    {{ $deptAccount->status }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Department Info with improved styling -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Department Name -->
                    <div class="group">
                        <label class="block text-sm font-bold text-blue-900 mb-3 flex items-center gap-2">
                            <span class="w-1 h-4 bg-blue-600 rounded-full"></span>
                            Department Name
                        </label>
                        <div class="relative">
                            <input type="text" name="dept_name" value="{{ old('dept_name', $deptAccount->dept_name) }}"
                                class="w-full px-4 py-3.5 border-2 border-gray-200 rounded-xl bg-gray-50 cursor-not-allowed text-gray-600 font-medium"
                                readonly placeholder="Enter department name" required>
                            <div class="absolute right-3 top-1/2 -translate-y-1/2">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Employee Name -->
                    <div class="group">
                        <label class="block text-sm font-bold text-blue-900 mb-3 flex items-center gap-2">
                            <span class="w-1 h-4 bg-blue-600 rounded-full"></span>
                            Employee Name
                        </label>
                        <input disabled type="text" name="employee_name"
                            value="{{ old('employee_name', $deptAccount->employee_name) }}"
                            class="w-full px-4 py-3.5 border-2 border-gray-200 rounded-xl bg-gray-50 text-gray-600 font-medium cursor-not-allowed"
                            placeholder="Enter employee name" required>
                    </div>

                    <!-- Employee ID -->
                    <div class="group">
                        <label class="block text-sm font-bold text-blue-900 mb-3 flex items-center gap-2">
                            <span class="w-1 h-4 bg-yellow-500 rounded-full"></span>
                            Employee ID
                        </label>
                        <div class="relative">
                            <input type="text" name="employee_id" value="{{ old('employee_id', $deptAccount->employee_id) }}"
                                class="w-full px-4 py-3.5 border-2 border-gray-200 rounded-xl bg-gray-50 cursor-not-allowed text-gray-600 font-medium"
                                readonly placeholder="Auto-generated employee ID">
                            <div class="absolute right-3 top-1/2 -translate-y-1/2">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Employee Status -->
                    <div class="group">
                        <label class="block text-sm font-bold text-blue-900 mb-3 flex items-center gap-2">
                            <span class="w-1 h-4 bg-yellow-500 rounded-full"></span>
                            Employee Status
                        </label>
                        <div class="relative">
                            <input type="text" name="status" value="{{ old('employee_status', $deptAccount->status) }}"
                                class="w-full px-4 py-3.5 border-2 border-gray-200 rounded-xl bg-gray-50 cursor-not-allowed text-gray-600 font-medium"
                                readonly placeholder="e.g. Active">
                            <div class="absolute right-3 top-1/2 -translate-y-1/2">
                                <span class="flex h-3 w-3">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="group">
                        <label class="block text-sm font-bold text-blue-900 mb-3 flex items-center gap-2">
                            <span class="w-1 h-4 bg-blue-600 rounded-full"></span>
                            Email Address
                        </label>
                        <div class="relative">
                            <input disabled type="email" name="email" value="{{ old('email', $deptAccount->email) }}"
                                class="w-full px-4 py-3.5 pl-11 border-2 border-gray-200 rounded-xl bg-gray-50 text-gray-600 font-medium cursor-not-allowed"
                                placeholder="employee@company.com">
                            <div class="absolute left-3 top-1/2 -translate-y-1/2">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Role -->
                    <div class="group">
                        <label class="block text-sm font-bold text-blue-900 mb-3 flex items-center gap-2">
                            <span class="w-1 h-4 bg-yellow-500 rounded-full"></span>
                            Role
                        </label>
                        <div class="relative">
                            <input readonly type="text" name="role" value="{{ old('role', $deptAccount->role) }}"
                                class="w-full px-4 py-3.5 pl-11 border-2 border-gray-200 rounded-xl bg-gray-50 cursor-not-allowed text-gray-600 font-medium"
                                placeholder="e.g. Department Admin">
                            <div class="absolute left-3 top-1/2 -translate-y-1/2">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Activity Logs Section - Grid Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-1 gap-6 mt-8">

                <div class="bg-white rounded-3xl shadow-2xl overflow-hidden transform transition-all duration-300 hover:shadow-3xl">
                <div class="bg-gradient-to-br from-blue-900 via-blue-800 to-blue-950 px-6 py-5">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="bg-gradient-to-br from-yellow-400 to-yellow-500 p-2 rounded-xl">
                                <svg class="w-6 h-6 text-blue-900" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3 3a1 1 0 011 1v12a1 1 0 11-2 0V4a1 1 0 011-1zm7.707 3.293a1 1 0 010 1.414L9.414 9H17a1 1 0 110 2H9.414l1.293 1.293a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-white">Login History</h3>
                                <p class="text-blue-200 text-sm">Recent access logs and attempts</p>
                            </div>
                        </div>
                        <span class="px-4 py-2 bg-yellow-400 text-blue-900 rounded-xl text-sm font-bold shadow-lg">
                            {{ $loginLogs->total() }} Total
                        </span>
                    </div>
                </div>

                <div class="p-6">
                    @if($loginLogs->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Type</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Attempts</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Date & Time</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($loginLogs as $log)
                                        <tr class="hover:bg-blue-50 transition-colors duration-200 group">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if($log->log_status == 'SUCCESS')
                                                    <span class="px-3 py-1.5 bg-green-100 text-green-800 text-xs font-bold rounded-full">SUCCESS</span>
                                                @elseif($log->log_status == 'FAILED')
                                                    <span class="px-3 py-1.5 bg-red-100 text-red-800 text-xs font-bold rounded-full">FAILED</span>
                                                @else
                                                    <span class="px-3 py-1.5 bg-yellow-100 text-yellow-800 text-xs font-bold rounded-full">ATTEMPT</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-semibold text-gray-900">{{ ucfirst($log->log_type) ?? 'Login' }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-semibold text-gray-900">{{ $log->attempt_count }}/5</div>
                                                @if($log->failure_reason)
                                                    <div class="text-xs text-gray-500">{{ $log->failure_reason }}</div>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-semibold text-gray-900">{{ \Carbon\Carbon::parse($log->date)->format('M d, Y') }}</div>
                                                <div class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($log->date)->format('h:i A') }}</div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="mt-6">
                            {{ $loginLogs->links() }}
                        </div>
                    @else
                        <div class="text-center py-16">
                            <div class="bg-gradient-to-br from-blue-50 to-yellow-50 rounded-full w-24 h-24 flex items-center justify-center mx-auto mb-4">
                                <svg class="w-12 h-12 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <p class="text-gray-500 font-medium">No login history found</p>
                            <p class="text-sm text-gray-400 mt-1">Login attempts will appear here</p>
                        </div>
                    @endif
                </div>
            </div>
            <!-- Audit Trail Table Card -->
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden transform transition-all duration-300 hover:shadow-3xl">
                <div class="bg-gradient-to-br from-blue-900 via-blue-800 to-blue-950 px-6 py-5">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="bg-gradient-to-br from-yellow-400 to-yellow-500 p-2 rounded-xl">
                                <svg class="w-6 h-6 text-blue-900" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-white">Audit Trail</h3>
                                <p class="text-blue-200 text-sm">Recent activities and changes</p>
                            </div>
                        </div>
                        <span class="px-4 py-2 bg-yellow-400 text-blue-900 rounded-xl text-sm font-bold shadow-lg">
                            {{ $auditTrails->total() }} Total
                        </span>
                    </div>
                </div>

                <div class="p-6">
                    @if($auditTrails->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Action</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Module</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Activity</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Date & Time</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($auditTrails as $audit)
                                        <tr class="hover:bg-blue-50 transition-colors duration-200 group">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if($audit->action == 'CREATE')
                                                    <span class="px-3 py-1.5 bg-green-100 text-green-800 text-xs font-bold rounded-full">CREATE</span>
                                                @elseif($audit->action == 'UPDATE')
                                                    <span class="px-3 py-1.5 bg-yellow-100 text-yellow-800 text-xs font-bold rounded-full">UPDATE</span>
                                                @elseif($audit->action == 'DELETE')
                                                    <span class="px-3 py-1.5 bg-red-100 text-red-800 text-xs font-bold rounded-full">DELETE</span>
                                                @else
                                                    <span class="px-3 py-1.5 bg-blue-100 text-blue-800 text-xs font-bold rounded-full">{{ $audit->action }}</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-semibold text-gray-900">{{ $audit->modules_cover }}</div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-sm text-gray-700">{{ $audit->activity }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-semibold text-gray-900">{{ \Carbon\Carbon::parse($audit->date)->format('M d, Y') }}</div>
                                                <div class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($audit->date)->format('h:i A') }}</div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="mt-6">
                            {{ $auditTrails->links() }}
                        </div>
                    @else
                        <div class="text-center py-16">
                            <div class="bg-gradient-to-br from-blue-50 to-yellow-50 rounded-full w-24 h-24 flex items-center justify-center mx-auto mb-4">
                                <svg class="w-12 h-12 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <p class="text-gray-500 font-medium">No audit trail records found</p>
                            <p class="text-sm text-gray-400 mt-1">Activities will appear here once performed</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Login History Table Card -->
        
        </div>

        <!-- Security Summary Cards - Grid Layout -->
      

        <!-- Info Banner -->
        <div class="mt-8 bg-gradient-to-br from-blue-900 via-blue-800 to-blue-950 rounded-2xl p-6 shadow-xl">
            <div class="flex items-start space-x-4">
                <div class="bg-gradient-to-br from-yellow-400 to-yellow-500 p-2 rounded-xl">
                    <svg class="w-6 h-6 text-blue-900" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div>
                    <h4 class="text-yellow-400 font-bold mb-1">Privacy & Security</h4>
                    <p class="text-blue-200 text-sm">All activities are logged for security purposes. This employee's information is encrypted and securely stored.</p>
                </div>
            </div>
        </div>

        <script>
            function closeSuccessMessage() {
                document.getElementById('success-message').style.display = 'none';
            }

            // Auto-hide success message after 5 seconds
            setTimeout(function() {
                const successMessage = document.getElementById('success-message');
                if (successMessage) {
                    successMessage.style.display = 'none';
                }
            }, 5000);
        </script>
    </section>


                <style>
                    @keyframes fadeIn {
                        from {
                            opacity: 0;
                            transform: translateY(-20px);
                        }

                        to {
                            opacity: 1;
                            transform: translateY(0);
                        }
                    }

                    .animate-fade-in {
                        animation: fadeIn 0.6s ease-out;
                    }

                    .form-group {
                        transition: all 0.3s ease;
                    }

                    .form-group:hover {
                        transform: translateY(-2px);
                    }

                    input:focus,
                    textarea:focus {
                        transform: scale(1.01);
                    }




                    .shadow-3xl {
                        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
                    }
                </style>

                <script>
                    // Preview uploaded photo with animation
                    document.getElementById('adminphoto').addEventListener('change', function (e) {
                        const file = e.target.files[0];
                        if (file) {
                            const reader = new FileReader();
                            reader.onload = function (e) {
                                const preview = document.getElementById('preview-photo');
                                const placeholder = document.getElementById('preview-placeholder');
                                preview.src = e.target.result;
                                preview.classList.remove('hidden');
                                preview.style.opacity = '0';

                                setTimeout(() => {
                                    preview.style.transition = 'opacity 0.5s ease-in';
                                    preview.style.opacity = '1';
                                }, 10);

                                if (placeholder) {
                                    placeholder.style.opacity = '0';
                                    setTimeout(() => placeholder.classList.add('hidden'), 300);
                                }
                            }
                            reader.readAsDataURL(file);
                        }
                    });

                    // Add floating animation to form groups on scroll
                    const observer = new IntersectionObserver((entries) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                entry.target.style.opacity = '0';
                                entry.target.style.transform = 'translateY(20px)';
                                setTimeout(() => {
                                    entry.target.style.transition = 'all 0.6s ease-out';
                                    entry.target.style.opacity = '1';
                                    entry.target.style.transform = 'translateY(0)';
                                }, 100);
                            }
                        });
                    });

                    document.querySelectorAll('.form-group').forEach(group => {
                        observer.observe(group);
                    });
                </script>


                <script>
                    function closeSuccessMessage() {
                        const message = document.getElementById('success-message');
                        if (message) {
                            message.classList.add('opacity-0', 'transition', 'duration-500'); // smooth fade out
                            setTimeout(() => message.remove(), 500); // remove from DOM after fade
                        }
                    }

                    // Optional: auto-close after 5 seconds
                    setTimeout(closeSuccessMessage, 5000);
                </script>


                <!-- Initialize Lucide Icons -->
                <script>
                    lucide.createIcons();
                </script>


                </main>





            </div>
            </div>


            {{-- modals --}}




            @livewireScripts
            @include('javascriptfix.soliera_js')
        </body>
@endauth



</html>