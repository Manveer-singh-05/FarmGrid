@extends('layouts.main')

@section('main-content')
    <div class="space-y-6">
        <!-- Statistics Cards -->

        <h2 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-400 mb-6">
            Dashboard Overview</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Farmers -->
            <div class="glass-card p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-white/70 font-semibold text-sm mb-2">Total Farmers</h3>
                        <p
                            class="text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-400">
                            {{ $totalFarmers }}</p>
                    </div>
                    <div class="text-5xl opacity-20">👨‍🌾</div>
                </div>
            </div>

            <!-- Pending Applications -->
            <div class="glass-card p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-white/70 font-semibold text-sm mb-2">Pending Applications</h3>
                        <p
                            class="text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-yellow-400">
                            {{ $pendingApplications }}</p>
                        <a href="{{ route('admin.farmers') }}"
                            class="text-blue-400 hover:text-blue-300 text-sm mt-2 inline-block">Review →</a>
                    </div>
                    <div class="text-5xl opacity-20">📋</div>
                </div>
            </div>

            <!-- Total Complaints -->
            <div class="glass-card p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-white/70 font-semibold text-sm mb-2">Total Complaints</h3>
                        <p
                            class="text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-red-400 to-pink-400">
                            {{ $totalComplaints }}</p>
                    </div>
                    <div class="text-5xl opacity-20">🔧</div>
                </div>
            </div>

            <!-- Pending Complaints -->
            <div class="glass-card p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-white/70 font-semibold text-sm mb-2">Pending Complaints</h3>
                        <p
                            class="text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-orange-400">
                            {{ $pendingComplaints }}</p>
                    </div>
                    <div class="text-5xl opacity-20">⚠️</div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="glass-card p-6">
            <h3 class="text-lg font-bold text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-400 mb-6">⚡
                Quick Actions</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="{{ route('admin.schedule.create') }}"
                    class="btn-glass btn-green px-6 py-3 font-semibold text-center">
                    ➕ Create Schedule
                </a>
                <a href="{{ route('admin.farmers') }}" class="btn-glass btn-green px-6 py-3 font-semibold text-center">
                    👁️ Review Applications
                </a>
                <a href="{{ route('admin.complaints') }}" class="btn-glass btn-blue px-6 py-3 font-semibold text-center">
                    🔧 Resolve Complaints
                </a>
            </div>
        </div>

        <!-- Active Schedules -->
        <div class="glass-card p-6">
            <h3 class="text-lg font-bold text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-400 mb-6">📅
                Active Electricity Schedules</h3>
            @if($schedules->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="border-b border-white/10">
                            <tr class="text-white/70 text-sm">
                                <th class="pb-4 font-semibold">Zone</th>
                                <th class="pb-4 font-semibold">Time Slot</th>
                                <th class="pb-4 font-semibold">Status</th>
                                <th class="pb-4 font-semibold">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($schedules->take(10) as $schedule)
                                <tr class="border-b border-white/5 hover:bg-white/5 transition-colors">
                                    <td class="py-4 text-white">{{ $schedule->zone }}</td>
                                    <td class="py-4 text-white/80">{{ $schedule->start_time }} - {{ $schedule->end_time }}</td>
                                    <td class="py-4">
                                        <span
                                            class="px-3 py-1 rounded-full text-sm font-semibold
                                                        {{ $schedule->status === 'active' ? 'bg-green-500/30 text-green-300 border border-green-500/50' : 'bg-gray-500/30 text-gray-300 border border-gray-500/50' }}">
                                            {{ ucfirst($schedule->status) }}
                                        </span>
                                    </td>
                                    <td class="py-4">
                                        <a href="#" class="text-blue-400 hover:text-blue-300 underline text-sm">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-white/50 text-center py-8">No schedules created yet</p>
            @endif
        </div>
    </div>
@endsection