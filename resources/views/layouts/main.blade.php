@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-100">
        <nav class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <a href="{{ route('dashboard') }}" class="flex items-center">
                            <h1 class="text-2xl font-bold text-green-600">🌾 FarmGrid</h1>
                        </a>
                    </div>
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-700">{{ Auth::user()->name }}</span>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button class="text-gray-600 hover:text-gray-900">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <div class="flex max-w-7xl mx-auto">
            <!-- Sidebar -->
            <aside class="w-64 bg-white shadow-md p-6">
                @if(Auth::user()->role === 'farmer')
                    <div class="space-y-4">
                        <a href="{{ route('farmer.dashboard') }}"
                            class="block px-4 py-2 rounded hover:bg-green-100">Dashboard</a>
                        <a href="{{ route('farmer.apply') }}" class="block px-4 py-2 rounded hover:bg-green-100">Apply for
                            Connection</a>
                        <a href="{{ route('farmer.schedules') }}" class="block px-4 py-2 rounded hover:bg-green-100">Electricity
                            Schedule</a>
                        <a href="{{ route('farmer.complaints') }}"
                            class="block px-4 py-2 rounded hover:bg-green-100">Complaints</a>
                        <a href="{{ route('farmer.usage') }}" class="block px-4 py-2 rounded hover:bg-green-100">Power Usage</a>
                    </div>
                @elseif(Auth::user()->role === 'admin')
                    <div class="space-y-4">
                        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded hover:bg-blue-100">Dashboard</a>
                        <a href="{{ route('admin.farmers') }}" class="block px-4 py-2 rounded hover:bg-blue-100">Manage
                            Farmers</a>
                        <a href="{{ route('admin.schedules') }}" class="block px-4 py-2 rounded hover:bg-blue-100">Electricity
                            Schedules</a>
                        <a href="{{ route('admin.complaints') }}"
                            class="block px-4 py-2 rounded hover:bg-blue-100">Complaints</a>
                        <a href="{{ route('admin.reports') }}" class="block px-4 py-2 rounded hover:bg-blue-100">Reports</a>
                    </div>
                @endif
            </aside>

            <!-- Main Content -->
            <main class="flex-1 p-8">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('main-content')
            </main>
        </div>
    </div>
@endsection