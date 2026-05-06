<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $schedule->zone }} - Schedule Details | FarmGrid</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 font-sans">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm fixed top-0 w-full z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="{{ url('/') }}" class="flex items-center space-x-2 hover:opacity-80 transition">
                    <div class="w-9 h-9 bg-gradient-to-br from-green-600 to-green-700 rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold">⚡</span>
                    </div>
                    <span class="text-xl font-bold text-gray-900">FarmGrid</span>
                </a>
                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-gray-600 hover:text-green-600 transition font-medium">Dashboard</a>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button class="text-gray-600 hover:text-red-600 transition font-medium">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900 font-medium">Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <div class="pt-24 pb-16 max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="mb-6 text-sm text-gray-500">
            <a href="{{ route('schedules.index') }}" class="hover:text-green-600 transition">All Schedules</a>
            <span class="mx-2">→</span>
            <span class="text-gray-800 font-medium">{{ $schedule->zone }}</span>
        </nav>

        <div class="bg-white rounded-2xl shadow p-8">
            <!-- Header -->
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">⚡ {{ $schedule->zone }}</h1>
                    <p class="text-gray-500 mt-1">Electricity Schedule Details</p>
                </div>
                <span class="px-4 py-2 text-sm font-semibold rounded-full
                    @if($schedule->status === 'active') bg-green-100 text-green-700
                    @elseif($schedule->status === 'maintenance') bg-yellow-100 text-yellow-700
                    @else bg-red-100 text-red-700 @endif">
                    {{ ucfirst($schedule->status) }}
                </span>
            </div>

            <!-- Details Grid -->
            <div class="grid grid-cols-2 gap-6 mb-8">
                <div class="bg-green-50 rounded-xl p-5">
                    <p class="text-xs font-semibold text-green-600 uppercase tracking-wider mb-1">Start Time</p>
                    <p class="text-2xl font-bold text-gray-900">{{ \Carbon\Carbon::parse($schedule->start_time)->format('h:i A') }}</p>
                </div>
                <div class="bg-red-50 rounded-xl p-5">
                    <p class="text-xs font-semibold text-red-500 uppercase tracking-wider mb-1">End Time</p>
                    <p class="text-2xl font-bold text-gray-900">{{ \Carbon\Carbon::parse($schedule->end_time)->format('h:i A') }}</p>
                </div>
            </div>

            @if ($schedule->description)
                <div class="bg-gray-50 rounded-xl p-5 mb-8">
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Description</p>
                    <p class="text-gray-700">{{ $schedule->description }}</p>
                </div>
            @endif

            <div class="border-t border-gray-100 pt-5 text-sm text-gray-400">
                Last updated: {{ $schedule->updated_at->diffForHumans() }}
            </div>
        </div>

        <div class="mt-6">
            <a href="{{ route('schedules.index') }}"
                class="inline-flex items-center text-green-600 hover:text-green-800 font-medium transition">
                ← Back to All Schedules
            </a>
        </div>
    </div>
</body>

</html>
