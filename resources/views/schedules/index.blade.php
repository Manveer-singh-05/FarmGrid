<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electricity Schedules - FarmGrid</title>
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
                        <a href="{{ route('register') }}" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-medium">Sign Up</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <div class="pt-24 pb-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-gray-900 mb-3">⚡ Active Electricity Schedules</h1>
            <p class="text-gray-500 text-lg">Zone-wise power supply timing for agricultural areas</p>
        </div>

        @if ($schedules->count() > 0)
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($schedules as $schedule)
                    <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-6 border border-gray-100">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-bold text-gray-800">{{ $schedule->zone }}</h3>
                            <span class="px-3 py-1 text-xs font-semibold rounded-full
                                @if($schedule->status === 'active') bg-green-100 text-green-700
                                @elseif($schedule->status === 'maintenance') bg-yellow-100 text-yellow-700
                                @else bg-red-100 text-red-700 @endif">
                                {{ ucfirst($schedule->status) }}
                            </span>
                        </div>

                        <div class="space-y-3">
                            <div class="flex items-center text-gray-600">
                                <span class="text-green-500 mr-2">🕐</span>
                                <span class="text-sm">Start: <strong class="text-gray-800">{{ \Carbon\Carbon::parse($schedule->start_time)->format('h:i A') }}</strong></span>
                            </div>
                            <div class="flex items-center text-gray-600">
                                <span class="text-red-400 mr-2">🕕</span>
                                <span class="text-sm">End: <strong class="text-gray-800">{{ \Carbon\Carbon::parse($schedule->end_time)->format('h:i A') }}</strong></span>
                            </div>
                            @if ($schedule->description)
                                <div class="pt-2 border-t border-gray-100">
                                    <p class="text-sm text-gray-500">{{ $schedule->description }}</p>
                                </div>
                            @endif
                        </div>

                        <a href="{{ route('schedules.show', $schedule->id) }}"
                            class="mt-4 block text-center py-2 bg-green-50 text-green-700 rounded-lg hover:bg-green-100 transition text-sm font-medium">
                            View Details →
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-20">
                <div class="text-6xl mb-4">⚡</div>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">No Active Schedules</h3>
                <p class="text-gray-500">There are currently no active electricity schedules. Please check back later.</p>
            </div>
        @endif
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-8 mt-16">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="text-sm">© {{ date('Y') }} FarmGrid. All rights reserved. | Smart Agricultural Electricity Distribution</p>
        </div>
    </footer>
</body>

</html>
