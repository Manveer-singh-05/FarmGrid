@extends('layouts.main')

@section('main-content')
    <div class="space-y-6">
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="glass-card p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-white/70 font-semibold text-sm mb-2">Connection Status</h3>
                        @if($farmer)
                            <p
                                class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-emerald-400">
                                {{ ucfirst($farmer->status) }}</p>
                            <p class="text-sm text-white/50 mt-2">{{ $farmer->connection_no }}</p>
                        @else
                            <a href="{{ route('farmer.apply') }}" class="text-blue-400 hover:text-blue-300 underline">Apply
                                now</a>
                        @endif
                    </div>
                    <div class="text-4xl">⚡</div>
                </div>
            </div>

            <div class="glass-card p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-white/70 font-semibold text-sm mb-2">Open Complaints</h3>
                        <p
                            class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-red-400">
                            {{ $complaints->where('status', 'pending')->count() }}</p>
                        <a href="{{ route('farmer.complaints') }}"
                            class="text-blue-400 hover:text-blue-300 text-sm mt-2 inline-block">View all →</a>
                    </div>
                    <div class="text-4xl">🔧</div>
                </div>
            </div>

            <div class="glass-card p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-white/70 font-semibold text-sm mb-2">Current Month Usage</h3>
                        @if($powerUsage)
                            <p
                                class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-400">
                                {{ $powerUsage->units_used }} kWh</p>
                            <p class="text-sm text-white/50 mt-2">Bill: ₹{{ $powerUsage->bill_amount }}</p>
                        @else
                            <p class="text-white/50">No data</p>
                        @endif
                    </div>
                    <div class="text-4xl">📊</div>
                </div>
            </div>
        </div>

        <!-- Electricity Schedule -->
        <div class="glass-card p-6">
            <h3 class="text-lg font-bold text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-400 mb-6">📅
                Today's Electricity Schedule</h3>
            @if($schedules->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="border-b border-white/10">
                            <tr class="text-white/70 text-sm">
                                <th class="pb-4 font-semibold">Zone</th>
                                <th class="pb-4 font-semibold">Start Time</th>
                                <th class="pb-4 font-semibold">End Time</th>
                                <th class="pb-4 font-semibold">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($schedules as $schedule)
                                <tr class="border-b border-white/5 hover:bg-white/5 transition-colors">
                                    <td class="py-4 text-white">{{ $schedule->zone }}</td>
                                    <td class="py-4 text-white/80">{{ $schedule->start_time }}</td>
                                    <td class="py-4 text-white/80">{{ $schedule->end_time }}</td>
                                    <td class="py-4">
                                        <span
                                            class="px-3 py-1 rounded-full text-sm font-semibold
                                                        {{ $schedule->status === 'active' ? 'bg-green-500/30 text-green-300 border border-green-500/50' : 'bg-red-500/30 text-red-300 border border-red-500/50' }}">
                                            {{ ucfirst($schedule->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-white/50 text-center py-8">No active schedules</p>
            @endif
        </div>

        <!-- Recent Complaints -->
        <div class="glass-card p-6">
            <h3 class="text-lg font-bold text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-400 mb-6">🔧
                Recent Complaints</h3>
            @if($complaints->count() > 0)
                <div class="space-y-3">
                    @foreach($complaints->take(5) as $complaint)
                        <div class="border-l-4 border-transparent bg-white/5 hover:bg-white/10 rounded-r-lg p-4 transition-colors
                                        {{ $complaint->status === 'resolved' ? 'border-l-green-500' : 'border-l-orange-500' }}">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <h4 class="font-semibold text-white">
                                        {{ ucfirst(str_replace('_', ' ', $complaint->issue_type)) }}</h4>
                                    <p class="text-sm text-white/60 mt-1">{{ substr($complaint->description, 0, 100) }}...</p>
                                </div>
                                <span
                                    class="text-sm px-3 py-1 rounded-full whitespace-nowrap ml-4
                                                {{ $complaint->status === 'resolved' ? 'bg-green-500/30 text-green-300' : 'bg-orange-500/30 text-orange-300' }}">
                                    {{ ucfirst($complaint->status) }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
                <a href="{{ route('farmer.complaints') }}"
                    class="text-blue-400 hover:text-blue-300 text-sm mt-4 inline-block">View all complaints →</a>
            @else
                <p class="text-white/50 text-center py-8">No complaints yet</p>
            @endif
        </div>
    </div>
@endsection