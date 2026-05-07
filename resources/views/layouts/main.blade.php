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
            style="background: linear-gradient(135deg, rgba(20, 35, 60, 0.6) 0%, rgba(25, 50, 80, 0.5) 100%); border-bottom: 1px solid rgba(56, 189, 248, 0.2); box-shadow: 0 8px 32px rgba(37, 99, 235, 0.1);">
            <div class="max-w-7xl mx-auto px-6 py-4 relative z-10">
                <div class="flex justify-between items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
                        <div style="width: 42px; height: 42px; background: linear-gradient(135deg, rgba(56, 189, 248, 0.2) 0%, rgba(34, 197, 94, 0.2) 100%); border: 1px solid rgba(56, 189, 248, 0.4); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 24px; box-shadow: 0 8px 32px rgba(56, 189, 248, 0.15); transition: all 0.3s ease; cursor: pointer;"
                            class="group-hover:scale-110">⚡</div>
                        <h1
                            style="font-size: 1.5rem; font-weight: 800; background: linear-gradient(135deg, #38BDF8 0%, #10B981 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                            FarmGrid</h1>
                    </a>
                    <div class="flex items-center gap-6">
                        <span style="color: #cbd5e1; font-weight: 500;">{{ Auth::user()->name }}</span>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button
                                style="background: linear-gradient(135deg, #38BDF8 0%, #10B981 100%); color: white; font-weight: 700; padding: 10px 20px; border-radius: 10px; border: none; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 0 20px rgba(34, 197, 94, 0.25); font-size: 0.9rem;"
                                onmouseover="this.style.boxShadow='0 15px 40px rgba(34, 197, 94, 0.35)'; this.style.transform='translateY(-2px)'"
                                onmouseout="this.style.boxShadow='0 0 20px rgba(34, 197, 94, 0.25)'; this.style.transform='translateY(0)'">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex gap-6 relative z-10">
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
                                style="display: block; padding: 12px 16px; border-radius: 12px; color: {{ request()->routeIs('farmer.complaints') || request()->routeIs('farmer.create-complaint') || request()->routeIs('farmer.edit-complaint') || request()->routeIs('farmer.complaint-detail') ? '#38BDF8' : '#cbd5e1' }}; text-decoration: none; transition: all 0.3s ease; border: 1px solid {{ request()->routeIs('farmer.complaints') || request()->routeIs('farmer.create-complaint') || request()->routeIs('farmer.edit-complaint') || request()->routeIs('farmer.complaint-detail') ? 'rgba(56, 189, 248, 0.5)' : 'rgba(56, 189, 248, 0.15)' }}; background: {{ request()->routeIs('farmer.complaints') || request()->routeIs('farmer.create-complaint') || request()->routeIs('farmer.edit-complaint') || request()->routeIs('farmer.complaint-detail') ? 'rgba(56, 189, 248, 0.1)' : 'transparent' }}; font-weight: {{ request()->routeIs('farmer.complaints') || request()->routeIs('farmer.create-complaint') || request()->routeIs('farmer.edit-complaint') || request()->routeIs('farmer.complaint-detail') ? '600' : '500' }}; box-shadow: {{ request()->routeIs('farmer.complaints') || request()->routeIs('farmer.create-complaint') || request()->routeIs('farmer.edit-complaint') || request()->routeIs('farmer.complaint-detail') ? '0 0 15px rgba(56, 189, 248, 0.2)' : 'none' }};"
                                onmouseover="this.style.background='rgba(56, 189, 248, 0.1)'; this.style.borderColor='rgba(56, 189, 248, 0.4)'; this.style.color='#38BDF8';"
                                onmouseout="this.style.background='{{ request()->routeIs('farmer.complaints') || request()->routeIs('farmer.create-complaint') || request()->routeIs('farmer.edit-complaint') || request()->routeIs('farmer.complaint-detail') ? 'rgba(56, 189, 248, 0.1)' : 'transparent' }}'; this.style.borderColor='rgba(56, 189, 248, 0.15)'; this.style.color='{{ request()->routeIs('farmer.complaints') || request()->routeIs('farmer.create-complaint') || request()->routeIs('farmer.edit-complaint') || request()->routeIs('farmer.complaint-detail') ? '#38BDF8' : '#cbd5e1' }}';">
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
                                style="display: block; padding: 12px 16px; border-radius: 12px; color: {{ request()->routeIs('admin.dashboard') ? '#06b6d4' : '#cbd5e1' }}; text-decoration: none; transition: all 0.3s ease; border: 1px solid {{ request()->routeIs('admin.dashboard') ? 'rgba(6, 182, 212, 0.5)' : 'rgba(56, 189, 248, 0.15)' }}; background: {{ request()->routeIs('admin.dashboard') ? 'rgba(6, 182, 212, 0.1)' : 'transparent' }}; font-weight: {{ request()->routeIs('admin.dashboard') ? '600' : '500' }}; box-shadow: {{ request()->routeIs('admin.dashboard') ? '0 0 15px rgba(6, 182, 212, 0.2)' : 'none' }};"
                                onmouseover="this.style.background='rgba(6, 182, 212, 0.1)'; this.style.borderColor='rgba(6, 182, 212, 0.4)'; this.style.color='#06b6d4';"
                                onmouseout="this.style.background='{{ request()->routeIs('admin.dashboard') ? 'rgba(6, 182, 212, 0.1)' : 'transparent' }}'; this.style.borderColor='rgba(56, 189, 248, 0.15)'; this.style.color='{{ request()->routeIs('admin.dashboard') ? '#06b6d4' : '#cbd5e1' }}';">
                                📊 Dashboard
                            </a>
                            <a href="{{ route('admin.farmers') }}"
                                style="display: block; padding: 12px 16px; border-radius: 12px; color: {{ request()->routeIs('admin.farmers') ? '#06b6d4' : '#cbd5e1' }}; text-decoration: none; transition: all 0.3s ease; border: 1px solid {{ request()->routeIs('admin.farmers') ? 'rgba(6, 182, 212, 0.5)' : 'rgba(56, 189, 248, 0.15)' }}; background: {{ request()->routeIs('admin.farmers') ? 'rgba(6, 182, 212, 0.1)' : 'transparent' }}; font-weight: {{ request()->routeIs('admin.farmers') ? '600' : '500' }}; box-shadow: {{ request()->routeIs('admin.farmers') ? '0 0 15px rgba(6, 182, 212, 0.2)' : 'none' }};"
                                onmouseover="this.style.background='rgba(6, 182, 212, 0.1)'; this.style.borderColor='rgba(6, 182, 212, 0.4)'; this.style.color='#06b6d4';"
                                onmouseout="this.style.background='{{ request()->routeIs('admin.farmers') ? 'rgba(6, 182, 212, 0.1)' : 'transparent' }}'; this.style.borderColor='rgba(56, 189, 248, 0.15)'; this.style.color='{{ request()->routeIs('admin.farmers') ? '#06b6d4' : '#cbd5e1' }}';">
                                👨‍🌾 Farmers
                            </a>
                            <a href="{{ route('admin.schedules') }}"
                                style="display: block; padding: 12px 16px; border-radius: 12px; color: {{ request()->routeIs('admin.schedules') ? '#06b6d4' : '#cbd5e1' }}; text-decoration: none; transition: all 0.3s ease; border: 1px solid {{ request()->routeIs('admin.schedules') ? 'rgba(6, 182, 212, 0.5)' : 'rgba(56, 189, 248, 0.15)' }}; background: {{ request()->routeIs('admin.schedules') ? 'rgba(6, 182, 212, 0.1)' : 'transparent' }}; font-weight: {{ request()->routeIs('admin.schedules') ? '600' : '500' }}; box-shadow: {{ request()->routeIs('admin.schedules') ? '0 0 15px rgba(6, 182, 212, 0.2)' : 'none' }};"
                                onmouseover="this.style.background='rgba(6, 182, 212, 0.1)'; this.style.borderColor='rgba(6, 182, 212, 0.4)'; this.style.color='#06b6d4';"
                                onmouseout="this.style.background='{{ request()->routeIs('admin.schedules') ? 'rgba(6, 182, 212, 0.1)' : 'transparent' }}'; this.style.borderColor='rgba(56, 189, 248, 0.15)'; this.style.color='{{ request()->routeIs('admin.schedules') ? '#06b6d4' : '#cbd5e1' }}';">
                                ⚡ Schedules
                            </a>
                            <a href="{{ route('admin.complaints') }}"
                                style="display: block; padding: 12px 16px; border-radius: 12px; color: {{ request()->routeIs('admin.complaints') ? '#06b6d4' : '#cbd5e1' }}; text-decoration: none; transition: all 0.3s ease; border: 1px solid {{ request()->routeIs('admin.complaints') ? 'rgba(6, 182, 212, 0.5)' : 'rgba(56, 189, 248, 0.15)' }}; background: {{ request()->routeIs('admin.complaints') ? 'rgba(6, 182, 212, 0.1)' : 'transparent' }}; font-weight: {{ request()->routeIs('admin.complaints') ? '600' : '500' }}; box-shadow: {{ request()->routeIs('admin.complaints') ? '0 0 15px rgba(6, 182, 212, 0.2)' : 'none' }};"
                                onmouseover="this.style.background='rgba(6, 182, 212, 0.1)'; this.style.borderColor='rgba(6, 182, 212, 0.4)'; this.style.color='#06b6d4';"
                                onmouseout="this.style.background='{{ request()->routeIs('admin.complaints') ? 'rgba(6, 182, 212, 0.1)' : 'transparent' }}'; this.style.borderColor='rgba(56, 189, 248, 0.15)'; this.style.color='{{ request()->routeIs('admin.complaints') ? '#06b6d4' : '#cbd5e1' }}';">
                                📋 Complaints
                            </a>
                            <a href="{{ route('admin.reports') }}"
                                style="display: block; padding: 12px 16px; border-radius: 12px; color: {{ request()->routeIs('admin.reports') ? '#06b6d4' : '#cbd5e1' }}; text-decoration: none; transition: all 0.3s ease; border: 1px solid {{ request()->routeIs('admin.reports') ? 'rgba(6, 182, 212, 0.5)' : 'rgba(56, 189, 248, 0.15)' }}; background: {{ request()->routeIs('admin.reports') ? 'rgba(6, 182, 212, 0.1)' : 'transparent' }}; font-weight: {{ request()->routeIs('admin.reports') ? '600' : '500' }}; box-shadow: {{ request()->routeIs('admin.reports') ? '0 0 15px rgba(6, 182, 212, 0.2)' : 'none' }};"
                                onmouseover="this.style.background='rgba(6, 182, 212, 0.1)'; this.style.borderColor='rgba(6, 182, 212, 0.4)'; this.style.color='#06b6d4';"
                                onmouseout="this.style.background='{{ request()->routeIs('admin.reports') ? 'rgba(6, 182, 212, 0.1)' : 'transparent' }}'; this.style.borderColor='rgba(56, 189, 248, 0.15)'; this.style.color='{{ request()->routeIs('admin.reports') ? '#06b6d4' : '#cbd5e1' }}';">
                                📈 Reports
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