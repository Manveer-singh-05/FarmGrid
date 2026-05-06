@extends('layouts.main')

@section('main-content')
    <div class="space-y-6">
        <h2 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-400">Electricity
            Schedules</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($schedules as $schedule)
                <div class="glass-card p-6 hover:scale-105 transition-transform">
                    <h3 class="text-xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-400 mb-4">
                        {{ $schedule->zone }}</h3>
                    <div class="space-y-3 text-white/80 text-sm">
                        <div class="flex justify-between">
                            <span class="text-white/60">Day:</span>
                            <span class="font-semibold">{{ $schedule->day_of_week }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-white/60">Time:</span>
                            <span class="font-semibold">{{ $schedule->start_time }} - {{ $schedule->end_time }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-white/60">Allocation:</span>
                            <span class="font-semibold text-green-400">{{ $schedule->allocation_percentage }}%</span>
                        </div>
                        <p class="text-white/60 pt-2 text-xs">{{ $schedule->description }}</p>
                    </div>
                </div>
            @empty
                <div class="col-span-full glass-card p-8 text-center text-white/50">
                    No schedules available yet.
                </div>
            @endforelse
        </div>
    </div>
@endsection