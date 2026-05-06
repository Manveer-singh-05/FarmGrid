@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900">
        <!-- Navigation -->
        <nav class="glass-card border-b border-white/10 sticky top-0 z-50 backdrop-blur-lg">
            <div class="max-w-7xl mx-auto px-6 py-4">
                <div class="flex justify-between items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 group">
                        <div
                            class="w-10 h-10 bg-gradient-to-br from-green-400 to-cyan-400 rounded-lg flex items-center justify-center text-lg font-bold text-white group-hover:scale-110 transition-transform">
                            🌾
                        </div>
                        <h1
                            class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-400">
                            FarmGrid</h1>
                    </a>
                    <div class="flex items-center gap-6">
                        <span class="text-white/80 font-medium">{{ Auth::user()->name }}</span>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button class="btn-glass btn-blue px-4 py-2 text-sm">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <div class="flex max-w-7xl mx-auto gap-6 p-6">
            <!-- Sidebar -->
            <aside class="w-72 glass-card p-6 h-fit sticky top-24">
                <h2
                    class="text-lg font-bold text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-400 mb-6">
                    Menu</h2>
                @if(Auth::user()->role === 'farmer')
                    <div class="space-y-3">
                        <a href="{{ route('farmer.dashboard') }}"
                            class="block px-4 py-3 rounded-lg text-white/80 hover:text-white hover:bg-green-500/20 border border-white/10 hover:border-green-500/30 transition-all duration-300">
                            📊 Dashboard
                        </a>
                        <a href="{{ route('farmer.apply') }}"
                            class="block px-4 py-3 rounded-lg text-white/80 hover:text-white hover:bg-green-500/20 border border-white/10 hover:border-green-500/30 transition-all duration-300">
                            ✋ Apply for Connection
                        </a>
                        <a href="{{ route('farmer.schedules') }}"
                            class="block px-4 py-3 rounded-lg text-white/80 hover:text-white hover:bg-green-500/20 border border-white/10 hover:border-green-500/30 transition-all duration-300">
                            ⚡ Electricity Schedule
                        </a>
                        <a href="{{ route('farmer.complaints') }}"
                            class="block px-4 py-3 rounded-lg text-white/80 hover:text-white hover:bg-green-500/20 border border-white/10 hover:border-green-500/30 transition-all duration-300">
                            🔔 Complaints
                        </a>
                        <a href="{{ route('farmer.usage') }}"
                            class="block px-4 py-3 rounded-lg text-white/80 hover:text-white hover:bg-green-500/20 border border-white/10 hover:border-green-500/30 transition-all duration-300">
                            📈 Power Usage
                        </a>
                    </div>
                @elseif(Auth::user()->role === 'admin')
                    <div class="space-y-3">
                        <a href="{{ route('admin.dashboard') }}"
                            class="block px-4 py-3 rounded-lg text-white/80 hover:text-white hover:bg-blue-500/20 border border-white/10 hover:border-blue-500/30 transition-all duration-300">
                            📊 Dashboard
                        </a>
                        <a href="{{ route('admin.farmers') }}"
                            class="block px-4 py-3 rounded-lg text-white/80 hover:text-white hover:bg-blue-500/20 border border-white/10 hover:border-blue-500/30 transition-all duration-300">
                            👨‍🌾 Manage Farmers
                        </a>
                        <a href="{{ route('admin.schedules') }}"
                            class="block px-4 py-3 rounded-lg text-white/80 hover:text-white hover:bg-blue-500/20 border border-white/10 hover:border-blue-500/30 transition-all duration-300">
                            ⚡ Electricity Schedules
                        </a>
                        <a href="{{ route('admin.complaints') }}"
                            class="block px-4 py-3 rounded-lg text-white/80 hover:text-white hover:bg-blue-500/20 border border-white/10 hover:border-blue-500/30 transition-all duration-300">
                            📋 Complaints
                        </a>
                        <a href="{{ route('admin.reports') }}"
                            class="block px-4 py-3 rounded-lg text-white/80 hover:text-white hover:bg-blue-500/20 border border-white/10 hover:border-blue-500/30 transition-all duration-300">
                            📈 Reports
                        </a>
                    </div>
                @endif
            </aside>

            <!-- Main Content -->
            <main class="flex-1">
                @if(session('success'))
                    <div class="glass-card border-l-4 border-green-500 p-4 mb-6 bg-green-500/10">
                        <p class="text-green-300 font-medium">✓ {{ session('success') }}</p>
                    </div>
                @endif

                @if(session('error'))
                    <div class="glass-card border-l-4 border-red-500 p-4 mb-6 bg-red-500/10">
                        <p class="text-red-300 font-medium">✗ {{ session('error') }}</p>
                    </div>
                @endif

                @yield('main-content')
            </main>
        </div>
    </div>
@endsection