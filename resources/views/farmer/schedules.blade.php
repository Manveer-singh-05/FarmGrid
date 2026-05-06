@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-100">
        <div class="max-w-6xl mx-auto px-4 py-8">
            <h2 class="text-2xl font-bold mb-6">Electricity Schedules</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($schedules as $schedule)
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-xl font-semibold text-blue-600">{{ $schedule->zone }}</h3>
                        <div class="mt-4 space-y-2 text-gray-700">
                            <p><strong>Day:</strong> {{ $schedule->day_of_week }}</p>
                            <p><strong>Time:</strong> {{ $schedule->start_time }} - {{ $schedule->end_time }}</p>
                            <p><strong>Allocation:</strong> {{ $schedule->allocation_percentage }}%</p>
                            <p class="text-sm">{{ $schedule->description }}</p>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full bg-white rounded-lg shadow p-6 text-center text-gray-500">
                        No schedules available yet.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection