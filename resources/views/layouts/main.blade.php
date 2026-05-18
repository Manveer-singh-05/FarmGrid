@extends('layouts.app')

@section('content')
    <div class="min-h-screen"
        style="background: linear-gradient(135deg, #0f172a 0%, #1a2f50 100%); background-attachment: fixed; position: relative;">
        <!-- Background Glows -->
        <div style="position: fixed; top: 0; left: 0; right: 0; bottom: 0; pointer-events: none; z-index: 0;">
            <div
                style="position: absolute; top: -40%; right: 10%; width: 600px; height: 600px; background: radial-gradient(circle, rgba(56, 189, 248, 0.15) 0%, transparent 70%); border-radius: 50%; filter: blur(80px);">
            </div>
            <div
                style="position: absolute; bottom: -20%; left: 5%; width: 500px; height: 500px; background: radial-gradient(circle, rgba(16, 185, 129, 0.1) 0%, transparent 70%); border-radius: 50%; filter: blur(80px);">
            </div>
        </div>

        <!-- Navigation -->
        <nav class="sticky top-0 z-50 backdrop-blur-md"
            style="background: linear-gradient(135deg, rgba(20, 35, 60, 0.7) 0%, rgba(25, 50, 80, 0.6) 100%); border-bottom: 1px solid rgba(56, 189, 248, 0.25); box-shadow: 0 8px 32px rgba(37, 99, 235, 0.15);">
            <div class="max-w-7xl mx-auto px-6 py-4 relative z-10">
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-8">
                        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
                            <div style="width: 42px; height: 42px; background: linear-gradient(135deg, rgba(56, 189, 248, 0.2) 0%, rgba(34, 197, 94, 0.2) 100%); border: 1px solid rgba(56, 189, 248, 0.4); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 24px; box-shadow: 0 8px 32px rgba(56, 189, 248, 0.15); transition: all 0.3s ease; cursor: pointer;"
                                class="group-hover:scale-110">⚡</div>
                            <h1
                                style="font-size: 1.5rem; font-weight: 800; background: linear-gradient(135deg, #38BDF8 0%, #10B981 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                                FarmGrid</h1>
                        </a>
                        <div class="hidden md:block">
                            <h2 class="text-lg font-bold text-white"
                                style="text-shadow: 0 2px 10px rgba(56, 189, 248, 0.3);">
                                @yield('page-title', 'Dashboard')
                            </h2>
                            <p class="text-sm text-slate-300 mt-1">
                                @yield('page-subtitle', 'Smart Agricultural Electricity Distribution')
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center gap-6">
                        <!-- Notification Dropdown -->
                        <div class="relative group" x-data="{ notifOpen: false }" @click.outside="notifOpen = false">
                            <button @click="notifOpen = !notifOpen"
                                class="relative flex items-center justify-center p-2 rounded-xl transition-all duration-300 hover:bg-white/10"
                                style="border: 1px solid rgba(56, 189, 248, 0.2); backdrop-filter: blur(10px); height: 44px; width: 44px;"
                                onmouseover="this.style.boxShadow='0 0 20px rgba(56, 189, 248, 0.3)'; this.style.borderColor='rgba(56, 189, 248, 0.4)'"
                                onmouseout="this.style.boxShadow='none'; this.style.borderColor='rgba(56, 189, 248, 0.2)'">
                                <span style="color: #38BDF8; font-size: 1.2rem;">🔔</span>
                                @if(Auth::check() && Auth::user()->unreadNotifications->count() > 0)
                                    <span
                                        class="absolute -top-1 -right-1 min-w-[20px] h-5 px-1 bg-red-500 text-white text-xs rounded-full flex items-center justify-center font-bold">
                                        {{ Auth::user()->unreadNotifications->count() }}
                                    </span>
                                @endif
                            </button>
                            
                            <div x-show="notifOpen" x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                                class="absolute right-0 top-full mt-2 w-80 z-50" style="display: none;">
                                <div class="bg-slate-900/90 backdrop-blur-xl border border-slate-700/50 rounded-2xl shadow-2xl overflow-hidden">
                                    <div class="p-4 border-b border-slate-700/50 flex justify-between items-center bg-slate-800/50">
                                        <h3 class="text-white font-semibold">Notifications</h3>
                                        @if(Auth::check() && Auth::user()->unreadNotifications->count() > 0)
                                            <form action="{{ route('notifications.markAllRead') }}" method="POST">
                                                @csrf
                                                <button type="submit" class="text-xs text-sky-400 hover:text-sky-300 transition-colors">Mark all read</button>
                                            </form>
                                        @endif
                                    </div>
                                    <div class="max-h-80 overflow-y-auto custom-scrollbar" style="scrollbar-width: thin; scrollbar-color: rgba(56, 189, 248, 0.3) transparent;">
                                        @if(Auth::check() && Auth::user()->notifications->count() > 0)
                                            @foreach(Auth::user()->notifications()->latest()->take(10)->get() as $notification)
                                                <div class="p-4 border-b border-slate-700/50 hover:bg-white/5 transition-colors {{ is_null($notification->read_at) ? 'bg-sky-900/20' : '' }}">
                                                    <div class="flex justify-between items-start gap-3">
                                                        <div class="flex-1">
                                                            <div class="flex items-center gap-2 mb-1">
                                                                @if(($notification->data['type'] ?? '') === 'security')
                                                                    <span class="text-orange-400 text-sm">🔒</span>
                                                                @elseif(($notification->data['type'] ?? '') === 'billing')
                                                                    <span class="text-emerald-400 text-sm">💰</span>
                                                                @else
                                                                    <span class="text-sky-400 text-sm">⚡</span>
                                                                @endif
                                                                <p class="text-sm font-medium {{ is_null($notification->read_at) ? 'text-white' : 'text-slate-300' }}">
                                                                    {{ $notification->data['title'] ?? 'Notification' }}
                                                                </p>
                                                            </div>
                                                            <p class="text-xs text-slate-400 line-clamp-2">{{ $notification->data['message'] ?? '' }}</p>
                                                            <p class="text-[10px] text-slate-500 mt-2">{{ $notification->created_at->diffForHumans() }}</p>
                                                        </div>
                                                        @if(is_null($notification->read_at))
                                                            <form action="{{ route('notifications.read', $notification->id) }}" method="POST">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit" class="w-2 h-2 rounded-full bg-sky-400 mt-2 hover:scale-150 transition-transform" title="Mark as read"></button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="p-6 text-center">
                                                <div class="text-slate-500 mb-2 text-2xl">📭</div>
                                                <p class="text-sm text-slate-400">No new notifications</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Profile Dropdown -->
                        <div class="relative group" x-data="{ open: false }" @click.outside="open = false">
                            <button @click="open = !open"
                                class="flex items-center gap-3 p-2 rounded-xl transition-all duration-300 hover:bg-white/10"
                                style="border: 1px solid rgba(56, 189, 248, 0.2); backdrop-filter: blur(10px);"
                                onmouseover="this.style.boxShadow='0 0 20px rgba(56, 189, 248, 0.3)'; this.style.borderColor='rgba(56, 189, 248, 0.4)'"
                                onmouseout="this.style.boxShadow='none'; this.style.borderColor='rgba(56, 189, 248, 0.2)'">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center"
                                    style="background: linear-gradient(135deg, #38BDF8 0%, #10B981 100%);">
                                    <span
                                        class="text-white font-bold">{{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}</span>
                                </div>
                                <div class="block text-left">
                                    <p class="text-white font-semibold text-sm">{{ Auth::user()->name ?? 'User' }}</p>
                                    <p class="text-slate-300 text-xs">{{ Auth::user()->role === 'government' ? 'Government Official' : ucfirst(Auth::user()->role ?? 'user') }}</p>
                                </div>
                                <span class="text-slate-300 transition-transform duration-300"
                                    :class="{ 'rotate-180': open }">▼</span>
                            </button>
                            <div x-show="open" x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                                class="absolute right-0 top-full mt-2 w-48 z-50" style="display: none;">
                                <div
                                    class="bg-slate-900/90 backdrop-blur-xl border border-slate-700/50 rounded-2xl shadow-2xl p-2">
                                    <a href="{{ route('profile.edit') }}"
                                        class="flex items-center gap-3 p-3 rounded-xl hover:bg-white/10 text-white text-sm transition-colors">
                                        <span>👤</span> Profile
                                    </a>
                                    <div class="border-t border-slate-700/50 my-2"></div>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="flex items-center gap-3 p-3 rounded-xl hover:bg-red-500/20 text-red-300 text-sm w-full text-left transition-colors">
                                            <span>🚪</span> Logout
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex gap-4 relative z-10">
            <!-- Sidebar -->
            <aside style="width: 280px; flex-shrink: 0; position: sticky; top: 84px; height: fit-content;">
                <div
                    style="background: rgba(20, 35, 60, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(56, 189, 248, 0.25); border-radius: 24px; padding: 24px; box-shadow: 0 0 30px rgba(34, 197, 94, 0.15), 0 25px 80px rgba(37, 99, 235, 0.1), inset 0 1px 0 rgba(255, 255, 255, 0.1);">
                    <h2
                        style="font-size: 1.1rem; font-weight: 800; background: linear-gradient(135deg, #38BDF8 0%, #10B981 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; margin-bottom: 24px;">
                        Navigation</h2>
                    @if(Auth::user()->role === 'farmer')
                        <div style="display: flex; flex-direction: column; gap: 8px;">
                            <a href="{{ route('farmer.dashboard') }}"
                                style="display: block; padding: 12px 16px; border-radius: 12px; color: {{ request()->routeIs('farmer.dashboard') ? '#38BDF8' : '#cbd5e1' }}; text-decoration: none; transition: all 0.3s ease; border: 1px solid {{ request()->routeIs('farmer.dashboard') ? 'rgba(56, 189, 248, 0.5)' : 'rgba(56, 189, 248, 0.15)' }}; background: {{ request()->routeIs('farmer.dashboard') ? 'rgba(56, 189, 248, 0.1)' : 'transparent' }}; font-weight: {{ request()->routeIs('farmer.dashboard') ? '600' : '500' }}; box-shadow: {{ request()->routeIs('farmer.dashboard') ? '0 0 15px rgba(56, 189, 248, 0.2)' : 'none' }};"
                                onmouseover="this.style.background='rgba(56, 189, 248, 0.1)'; this.style.borderColor='rgba(56, 189, 248, 0.4)'; this.style.color='#38BDF8';"
                                onmouseout="this.style.background='{{ request()->routeIs('farmer.dashboard') ? 'rgba(56, 189, 248, 0.1)' : 'transparent' }}'; this.style.borderColor='rgba(56, 189, 248, 0.15)'; this.style.color='{{ request()->routeIs('farmer.dashboard') ? '#38BDF8' : '#cbd5e1' }}';">
                                📊 Dashboard
                            </a>
                            <a href="{{ route('farmer.apply') }}"
                                style="display: block; padding: 12px 16px; border-radius: 12px; color: {{ request()->routeIs('farmer.apply') ? '#38BDF8' : '#cbd5e1' }}; text-decoration: none; transition: all 0.3s ease; border: 1px solid {{ request()->routeIs('farmer.apply') ? 'rgba(56, 189, 248, 0.5)' : 'rgba(56, 189, 248, 0.15)' }}; background: {{ request()->routeIs('farmer.apply') ? 'rgba(56, 189, 248, 0.1)' : 'transparent' }}; font-weight: {{ request()->routeIs('farmer.apply') ? '600' : '500' }}; box-shadow: {{ request()->routeIs('farmer.apply') ? '0 0 15px rgba(56, 189, 248, 0.2)' : 'none' }};"
                                onmouseover="this.style.background='rgba(56, 189, 248, 0.1)'; this.style.borderColor='rgba(56, 189, 248, 0.4)'; this.style.color='#38BDF8';"
                                onmouseout="this.style.background='{{ request()->routeIs('farmer.apply') ? 'rgba(56, 189, 248, 0.1)' : 'transparent' }}'; this.style.borderColor='rgba(56, 189, 248, 0.15)'; this.style.color='{{ request()->routeIs('farmer.apply') ? '#38BDF8' : '#cbd5e1' }}';">
                                ✋ Apply Connection
                            </a>
                            <a href="{{ route('farmer.schedules') }}"
                                style="display: block; padding: 12px 16px; border-radius: 12px; color: {{ request()->routeIs('farmer.schedules') ? '#38BDF8' : '#cbd5e1' }}; text-decoration: none; transition: all 0.3s ease; border: 1px solid {{ request()->routeIs('farmer.schedules') ? 'rgba(56, 189, 248, 0.5)' : 'rgba(56, 189, 248, 0.15)' }}; background: {{ request()->routeIs('farmer.schedules') ? 'rgba(56, 189, 248, 0.1)' : 'transparent' }}; font-weight: {{ request()->routeIs('farmer.schedules') ? '600' : '500' }}; box-shadow: {{ request()->routeIs('farmer.schedules') ? '0 0 15px rgba(56, 189, 248, 0.2)' : 'none' }};"
                                onmouseover="this.style.background='rgba(56, 189, 248, 0.1)'; this.style.borderColor='rgba(56, 189, 248, 0.4)'; this.style.color='#38BDF8';"
                                onmouseout="this.style.background='{{ request()->routeIs('farmer.schedules') ? 'rgba(56, 189, 248, 0.1)' : 'transparent' }}'; this.style.borderColor='rgba(56, 189, 248, 0.15)'; this.style.color='{{ request()->routeIs('farmer.schedules') ? '#38BDF8' : '#cbd5e1' }}';">
                                ⚡ Schedule
                            </a>
                            <a href="{{ route('farmer.complaints') }}"
                                style="display: block; padding: 12px 16px; border-radius: 12px; color: {{ request()->routeIs('farmer.complaints') || request()->routeIs('farmer.complaint.create') || request()->routeIs('farmer.complaint.edit') || request()->routeIs('farmer.complaint.show') ? '#38BDF8' : '#cbd5e1' }}; text-decoration: none; transition: all 0.3s ease; border: 1px solid {{ request()->routeIs('farmer.complaints') || request()->routeIs('farmer.complaint.create') || request()->routeIs('farmer.complaint.edit') || request()->routeIs('farmer.complaint.show') ? 'rgba(56, 189, 248, 0.5)' : 'rgba(56, 189, 248, 0.15)' }}; background: {{ request()->routeIs('farmer.complaints') || request()->routeIs('farmer.complaint.create') || request()->routeIs('farmer.complaint.edit') || request()->routeIs('farmer.complaint.show') ? 'rgba(56, 189, 248, 0.1)' : 'transparent' }}; font-weight: {{ request()->routeIs('farmer.complaints') || request()->routeIs('farmer.complaint.create') || request()->routeIs('farmer.complaint.edit') || request()->routeIs('farmer.complaint.show') ? '600' : '500' }}; box-shadow: {{ request()->routeIs('farmer.complaints') || request()->routeIs('farmer.complaint.create') || request()->routeIs('farmer.complaint.edit') || request()->routeIs('farmer.complaint.show') ? '0 0 15px rgba(56, 189, 248, 0.2)' : 'none' }};"
                                onmouseover="this.style.background='rgba(56, 189, 248, 0.1)'; this.style.borderColor='rgba(56, 189, 248, 0.4)'; this.style.color='#38BDF8';"
                                onmouseout="this.style.background='{{ request()->routeIs('farmer.complaints') || request()->routeIs('farmer.complaint.create') || request()->routeIs('farmer.complaint.edit') || request()->routeIs('farmer.complaint.show') ? 'rgba(56, 189, 248, 0.1)' : 'transparent' }}'; this.style.borderColor='rgba(56, 189, 248, 0.15)'; this.style.color='{{ request()->routeIs('farmer.complaints') || request()->routeIs('farmer.complaint.create') || request()->routeIs('farmer.complaint.edit') || request()->routeIs('farmer.complaint.show') ? '#38BDF8' : '#cbd5e1' }}';">
                                🔧 Complaints
                            </a>
                            <a href="{{ route('farmer.usage') }}"
                                style="display: block; padding: 12px 16px; border-radius: 12px; color: {{ request()->routeIs('farmer.usage') ? '#38BDF8' : '#cbd5e1' }}; text-decoration: none; transition: all 0.3s ease; border: 1px solid {{ request()->routeIs('farmer.usage') ? 'rgba(56, 189, 248, 0.5)' : 'rgba(56, 189, 248, 0.15)' }}; background: {{ request()->routeIs('farmer.usage') ? 'rgba(56, 189, 248, 0.1)' : 'transparent' }}; font-weight: {{ request()->routeIs('farmer.usage') ? '600' : '500' }}; box-shadow: {{ request()->routeIs('farmer.usage') ? '0 0 15px rgba(56, 189, 248, 0.2)' : 'none' }};"
                                onmouseover="this.style.background='rgba(56, 189, 248, 0.1)'; this.style.borderColor='rgba(56, 189, 248, 0.4)'; this.style.color='#38BDF8';"
                                onmouseout="this.style.background='{{ request()->routeIs('farmer.usage') ? 'rgba(56, 189, 248, 0.1)' : 'transparent' }}'; this.style.borderColor='rgba(56, 189, 248, 0.15)'; this.style.color='{{ request()->routeIs('farmer.usage') ? '#38BDF8' : '#cbd5e1' }}';">
                                📈 Usage
                            </a>
                        </div>
                    @elseif(Auth::user()->role === 'admin')
                        <div style="display: flex; flex-direction: column; gap: 8px;">
                            <a href="{{ route('admin.dashboard') }}"
                                style="display: block; padding: 12px 16px; border-radius: 12px; color: {{ request()->routeIs('admin.dashboard') ? '#38BDF8' : '#cbd5e1' }}; text-decoration: none; transition: all 0.3s ease; border: 1px solid {{ request()->routeIs('admin.dashboard') ? 'rgba(56, 189, 248, 0.5)' : 'rgba(56, 189, 248, 0.15)' }}; background: {{ request()->routeIs('admin.dashboard') ? 'rgba(56, 189, 248, 0.1)' : 'transparent' }}; font-weight: {{ request()->routeIs('admin.dashboard') ? '600' : '500' }}; box-shadow: {{ request()->routeIs('admin.dashboard') ? '0 0 15px rgba(56, 189, 248, 0.2)' : 'none' }};"
                                onmouseover="this.style.background='rgba(56, 189, 248, 0.1)'; this.style.borderColor='rgba(56, 189, 248, 0.4)'; this.style.color='#38BDF8';"
                                onmouseout="this.style.background='{{ request()->routeIs('admin.dashboard') ? 'rgba(56, 189, 248, 0.1)' : 'transparent' }}'; this.style.borderColor='rgba(56, 189, 248, 0.15)'; this.style.color='{{ request()->routeIs('admin.dashboard') ? '#38BDF8' : '#cbd5e1' }}';">
                                📊 Dashboard
                            </a>
                            <a href="{{ route('admin.farmers') }}"
                                style="display: block; padding: 12px 16px; border-radius: 12px; color: {{ request()->routeIs('admin.farmers') ? '#38BDF8' : '#cbd5e1' }}; text-decoration: none; transition: all 0.3s ease; border: 1px solid {{ request()->routeIs('admin.farmers') ? 'rgba(56, 189, 248, 0.5)' : 'rgba(56, 189, 248, 0.15)' }}; background: {{ request()->routeIs('admin.farmers') ? 'rgba(56, 189, 248, 0.1)' : 'transparent' }}; font-weight: {{ request()->routeIs('admin.farmers') ? '600' : '500' }}; box-shadow: {{ request()->routeIs('admin.farmers') ? '0 0 15px rgba(56, 189, 248, 0.2)' : 'none' }};"
                                onmouseover="this.style.background='rgba(56, 189, 248, 0.1)'; this.style.borderColor='rgba(56, 189, 248, 0.4)'; this.style.color='#38BDF8';"
                                onmouseout="this.style.background='{{ request()->routeIs('admin.farmers') ? 'rgba(56, 189, 248, 0.1)' : 'transparent' }}'; this.style.borderColor='rgba(56, 189, 248, 0.15)'; this.style.color='{{ request()->routeIs('admin.farmers') ? '#38BDF8' : '#cbd5e1' }}';">
                                👨‍🌾 Farmers
                            </a>
                            <a href="{{ route('admin.schedules') }}"
                                style="display: block; padding: 12px 16px; border-radius: 12px; color: {{ request()->routeIs('admin.schedules') ? '#38BDF8' : '#cbd5e1' }}; text-decoration: none; transition: all 0.3s ease; border: 1px solid {{ request()->routeIs('admin.schedules') ? 'rgba(56, 189, 248, 0.5)' : 'rgba(56, 189, 248, 0.15)' }}; background: {{ request()->routeIs('admin.schedules') ? 'rgba(56, 189, 248, 0.1)' : 'transparent' }}; font-weight: {{ request()->routeIs('admin.schedules') ? '600' : '500' }}; box-shadow: {{ request()->routeIs('admin.schedules') ? '0 0 15px rgba(56, 189, 248, 0.2)' : 'none' }};"
                                onmouseover="this.style.background='rgba(56, 189, 248, 0.1)'; this.style.borderColor='rgba(56, 189, 248, 0.4)'; this.style.color='#38BDF8';"
                                onmouseout="this.style.background='{{ request()->routeIs('admin.schedules') ? 'rgba(56, 189, 248, 0.1)' : 'transparent' }}'; this.style.borderColor='rgba(56, 189, 248, 0.15)'; this.style.color='{{ request()->routeIs('admin.schedules') ? '#38BDF8' : '#cbd5e1' }}';">
                                ⚡ Schedules
                            </a>
                            <a href="{{ route('admin.complaints') }}"
                                style="display: block; padding: 12px 16px; border-radius: 12px; color: {{ request()->routeIs('admin.complaints') ? '#38BDF8' : '#cbd5e1' }}; text-decoration: none; transition: all 0.3s ease; border: 1px solid {{ request()->routeIs('admin.complaints') ? 'rgba(56, 189, 248, 0.5)' : 'rgba(56, 189, 248, 0.15)' }}; background: {{ request()->routeIs('admin.complaints') ? 'rgba(56, 189, 248, 0.1)' : 'transparent' }}; font-weight: {{ request()->routeIs('admin.complaints') ? '600' : '500' }}; box-shadow: {{ request()->routeIs('admin.complaints') ? '0 0 15px rgba(56, 189, 248, 0.2)' : 'none' }};"
                                onmouseover="this.style.background='rgba(56, 189, 248, 0.1)'; this.style.borderColor='rgba(56, 189, 248, 0.4)'; this.style.color='#38BDF8';"
                                onmouseout="this.style.background='{{ request()->routeIs('admin.complaints') ? 'rgba(56, 189, 248, 0.1)' : 'transparent' }}'; this.style.borderColor='rgba(56, 189, 248, 0.15)'; this.style.color='{{ request()->routeIs('admin.complaints') ? '#38BDF8' : '#cbd5e1' }}';">
                                📋 Complaints
                            </a>
                            <a href="{{ route('admin.usage') }}"
                                style="display: block; padding: 12px 16px; border-radius: 12px; color: {{ request()->routeIs('admin.usage') ? '#38BDF8' : '#cbd5e1' }}; text-decoration: none; transition: all 0.3s ease; border: 1px solid {{ request()->routeIs('admin.usage') ? 'rgba(56, 189, 248, 0.5)' : 'rgba(56, 189, 248, 0.15)' }}; background: {{ request()->routeIs('admin.usage') ? 'rgba(56, 189, 248, 0.1)' : 'transparent' }}; font-weight: {{ request()->routeIs('admin.usage') ? '600' : '500' }}; box-shadow: {{ request()->routeIs('admin.usage') ? '0 0 15px rgba(56, 189, 248, 0.2)' : 'none' }};"
                                onmouseover="this.style.background='rgba(56, 189, 248, 0.1)'; this.style.borderColor='rgba(56, 189, 248, 0.4)'; this.style.color='#38BDF8';"
                                onmouseout="this.style.background='{{ request()->routeIs('admin.usage') ? 'rgba(56, 189, 248, 0.1)' : 'transparent' }}'; this.style.borderColor='rgba(56, 189, 248, 0.15)'; this.style.color='{{ request()->routeIs('admin.usage') ? '#38BDF8' : '#cbd5e1' }}';">
                                ⚡ Electricity Usage
                            </a>
                            <a href="{{ route('admin.reports') }}"
                                style="display: block; padding: 12px 16px; border-radius: 12px; color: {{ request()->routeIs('admin.reports') ? '#38BDF8' : '#cbd5e1' }}; text-decoration: none; transition: all 0.3s ease; border: 1px solid {{ request()->routeIs('admin.reports') ? 'rgba(56, 189, 248, 0.5)' : 'rgba(56, 189, 248, 0.15)' }}; background: {{ request()->routeIs('admin.reports') ? 'rgba(56, 189, 248, 0.1)' : 'transparent' }}; font-weight: {{ request()->routeIs('admin.reports') ? '600' : '500' }}; box-shadow: {{ request()->routeIs('admin.reports') ? '0 0 15px rgba(56, 189, 248, 0.2)' : 'none' }};"
                                onmouseover="this.style.background='rgba(56, 189, 248, 0.1)'; this.style.borderColor='rgba(56, 189, 248, 0.4)'; this.style.color='#38BDF8';"
                                onmouseout="this.style.background='{{ request()->routeIs('admin.reports') ? 'rgba(56, 189, 248, 0.1)' : 'transparent' }}'; this.style.borderColor='rgba(56, 189, 248, 0.15)'; this.style.color='{{ request()->routeIs('admin.reports') ? '#38BDF8' : '#cbd5e1' }}';">
                                📈 Reports
                            </a>
                        </div>
                    @elseif(Auth::user()->role === 'government')
                        <div style="display: flex; flex-direction: column; gap: 8px;">
                            <a href="{{ route('government.dashboard') }}"
                                style="display: block; padding: 12px 16px; border-radius: 12px; color: {{ request()->routeIs('government.dashboard') ? '#38BDF8' : '#cbd5e1' }}; text-decoration: none; transition: all 0.3s ease; border: 1px solid {{ request()->routeIs('government.dashboard') ? 'rgba(56, 189, 248, 0.5)' : 'rgba(56, 189, 248, 0.15)' }}; background: {{ request()->routeIs('government.dashboard') ? 'rgba(56, 189, 248, 0.1)' : 'transparent' }}; font-weight: {{ request()->routeIs('government.dashboard') ? '600' : '500' }}; box-shadow: {{ request()->routeIs('government.dashboard') ? '0 0 15px rgba(56, 189, 248, 0.2)' : 'none' }};"
                                onmouseover="this.style.background='rgba(56, 189, 248, 0.1)'; this.style.borderColor='rgba(56, 189, 248, 0.4)'; this.style.color='#38BDF8';"
                                onmouseout="this.style.background='{{ request()->routeIs('government.dashboard') ? 'rgba(56, 189, 248, 0.1)' : 'transparent' }}'; this.style.borderColor='rgba(56, 189, 248, 0.15)'; this.style.color='{{ request()->routeIs('government.dashboard') ? '#38BDF8' : '#cbd5e1' }}';">
                                📊 Dashboard
                            </a>
                            <a href="{{ route('government.farmers') }}"
                                style="display: block; padding: 12px 16px; border-radius: 12px; color: {{ request()->routeIs('government.farmers') ? '#38BDF8' : '#cbd5e1' }}; text-decoration: none; transition: all 0.3s ease; border: 1px solid {{ request()->routeIs('government.farmers') ? 'rgba(56, 189, 248, 0.5)' : 'rgba(56, 189, 248, 0.15)' }}; background: {{ request()->routeIs('government.farmers') ? 'rgba(56, 189, 248, 0.1)' : 'transparent' }}; font-weight: {{ request()->routeIs('government.farmers') ? '600' : '500' }}; box-shadow: {{ request()->routeIs('government.farmers') ? '0 0 15px rgba(56, 189, 248, 0.2)' : 'none' }};"
                                onmouseover="this.style.background='rgba(56, 189, 248, 0.1)'; this.style.borderColor='rgba(56, 189, 248, 0.4)'; this.style.color='#38BDF8';"
                                onmouseout="this.style.background='{{ request()->routeIs('government.farmers') ? 'rgba(56, 189, 248, 0.1)' : 'transparent' }}'; this.style.borderColor='rgba(56, 189, 248, 0.15)'; this.style.color='{{ request()->routeIs('government.farmers') ? '#38BDF8' : '#cbd5e1' }}';">
                                👨‍🌾 Farmers
                            </a>
                            <a href="{{ route('government.power-usage') }}"
                                style="display: block; padding: 12px 16px; border-radius: 12px; color: {{ request()->routeIs('government.power-usage') ? '#38BDF8' : '#cbd5e1' }}; text-decoration: none; transition: all 0.3s ease; border: 1px solid {{ request()->routeIs('government.power-usage') ? 'rgba(56, 189, 248, 0.5)' : 'rgba(56, 189, 248, 0.15)' }}; background: {{ request()->routeIs('government.power-usage') ? 'rgba(56, 189, 248, 0.1)' : 'transparent' }}; font-weight: {{ request()->routeIs('government.power-usage') ? '600' : '500' }}; box-shadow: {{ request()->routeIs('government.power-usage') ? '0 0 15px rgba(56, 189, 248, 0.2)' : 'none' }};"
                                onmouseover="this.style.background='rgba(56, 189, 248, 0.1)'; this.style.borderColor='rgba(56, 189, 248, 0.4)'; this.style.color='#38BDF8';"
                                onmouseout="this.style.background='{{ request()->routeIs('government.power-usage') ? 'rgba(56, 189, 248, 0.1)' : 'transparent' }}'; this.style.borderColor='rgba(56, 189, 248, 0.15)'; this.style.color='{{ request()->routeIs('government.power-usage') ? '#38BDF8' : '#cbd5e1' }}';">
                                ⚡ Power Usage
                            </a>
                            <a href="{{ route('government.reports') }}"
                                style="display: block; padding: 12px 16px; border-radius: 12px; color: {{ request()->routeIs('government.reports') ? '#38BDF8' : '#cbd5e1' }}; text-decoration: none; transition: all 0.3s ease; border: 1px solid {{ request()->routeIs('government.reports') ? 'rgba(56, 189, 248, 0.5)' : 'rgba(56, 189, 248, 0.15)' }}; background: {{ request()->routeIs('government.reports') ? 'rgba(56, 189, 248, 0.1)' : 'transparent' }}; font-weight: {{ request()->routeIs('government.reports') ? '600' : '500' }}; box-shadow: {{ request()->routeIs('government.reports') ? '0 0 15px rgba(56, 189, 248, 0.2)' : 'none' }};"
                                onmouseover="this.style.background='rgba(56, 189, 248, 0.1)'; this.style.borderColor='rgba(56, 189, 248, 0.4)'; this.style.color='#38BDF8';"
                                onmouseout="this.style.background='{{ request()->routeIs('government.reports') ? 'rgba(56, 189, 248, 0.1)' : 'transparent' }}'; this.style.borderColor='rgba(56, 189, 248, 0.15)'; this.style.color='{{ request()->routeIs('government.reports') ? '#38BDF8' : '#cbd5e1' }}';">
                                📈 Reports
                            </a>
                            <a href="{{ route('government.complaints') }}"
                                style="display: block; padding: 12px 16px; border-radius: 12px; color: {{ request()->routeIs('government.complaints') ? '#38BDF8' : '#cbd5e1' }}; text-decoration: none; transition: all 0.3s ease; border: 1px solid {{ request()->routeIs('government.complaints') ? 'rgba(56, 189, 248, 0.5)' : 'rgba(56, 189, 248, 0.15)' }}; background: {{ request()->routeIs('government.complaints') ? 'rgba(56, 189, 248, 0.1)' : 'transparent' }}; font-weight: {{ request()->routeIs('government.complaints') ? '600' : '500' }}; box-shadow: {{ request()->routeIs('government.complaints') ? '0 0 15px rgba(56, 189, 248, 0.2)' : 'none' }};"
                                onmouseover="this.style.background='rgba(56, 189, 248, 0.1)'; this.style.borderColor='rgba(56, 189, 248, 0.4)'; this.style.color='#38BDF8';"
                                onmouseout="this.style.background='{{ request()->routeIs('government.complaints') ? 'rgba(56, 189, 248, 0.1)' : 'transparent' }}'; this.style.borderColor='rgba(56, 189, 248, 0.15)'; this.style.color='{{ request()->routeIs('government.complaints') ? '#38BDF8' : '#cbd5e1' }}';">
                                📋 Complaints
                            </a>
                            <a href="{{ route('government.schedules') }}"
                                style="display: block; padding: 12px 16px; border-radius: 12px; color: {{ request()->routeIs('government.schedules') ? '#38BDF8' : '#cbd5e1' }}; text-decoration: none; transition: all 0.3s ease; border: 1px solid {{ request()->routeIs('government.schedules') ? 'rgba(56, 189, 248, 0.5)' : 'rgba(56, 189, 248, 0.15)' }}; background: {{ request()->routeIs('government.schedules') ? 'rgba(56, 189, 248, 0.1)' : 'transparent' }}; font-weight: {{ request()->routeIs('government.schedules') ? '600' : '500' }}; box-shadow: {{ request()->routeIs('government.schedules') ? '0 0 15px rgba(56, 189, 248, 0.2)' : 'none' }};"
                                onmouseover="this.style.background='rgba(56, 189, 248, 0.1)'; this.style.borderColor='rgba(56, 189, 248, 0.4)'; this.style.color='#38BDF8';"
                                onmouseout="this.style.background='{{ request()->routeIs('government.schedules') ? 'rgba(56, 189, 248, 0.1)' : 'transparent' }}'; this.style.borderColor='rgba(56, 189, 248, 0.15)'; this.style.color='{{ request()->routeIs('government.schedules') ? '#38BDF8' : '#cbd5e1' }}';">
                                ⏰ Schedules
                            </a>
                        </div>
                    @endif
                </div>
            </aside>

            <!-- Main Content -->
            <main style="flex: 1;">
                @if(session('success'))
                    <div
                        style="background: rgba(34, 197, 94, 0.1); border: 1px solid rgba(34, 197, 94, 0.3); border-left: 4px solid #22c55e; border-radius: 12px; padding: 16px; margin-bottom: 24px; position: relative;">
                        <p style="color: #86efac; font-weight: 500;">✓ {{ session('success') }}</p>
                    </div>
                @endif

                @if(session('error'))
                    <div
                        style="background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.3); border-left: 4px solid #ef4444; border-radius: 12px; padding: 16px; margin-bottom: 24px; position: relative;">
                        <p style="color: #fca5a5; font-weight: 500;">✗ {{ session('error') }}</p>
                    </div>
                @endif

                @yield('main-content')
            </main>
        </div>
    </div>
@endsection