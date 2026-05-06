@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-100">
        <nav class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <h1 class="text-2xl font-bold text-green-600">🌾 FarmGrid</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <span>{{ Auth::user()->name }}</span>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button class="text-red-600 hover:text-red-900">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <div class="flex max-w-7xl mx-auto">
            <aside class="w-64 bg-white shadow-md p-6">
                <div class="space-y-4">
                    <a href="{{ route('farmer.dashboard') }}" class="block px-4 py-2 rounded bg-green-100">📊 Dashboard</a>
                    <a href="{{ route('farmer.apply') }}" class="block px-4 py-2 rounded hover:bg-gray-100">📝 Apply for
                        Connection</a>
                    <a href="{{ route('farmer.schedules') }}" class="block px-4 py-2 rounded hover:bg-gray-100">⏰
                        Electricity Schedule</a>
                    <a href="{{ route('farmer.complaints') }}" class="block px-4 py-2 rounded hover:bg-gray-100">🔧
                        Complaints</a>
                    <a href="{{ route('farmer.usage') }}" class="block px-4 py-2 rounded hover:bg-gray-100">📈 Power
                        Usage</a>
                </div>
            </aside>

            <main class="flex-1 p-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <!-- Connection Status -->
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="text-lg font-semibold mb-2">Connection Status</h3>
                        @if($farmer)
                            <p class="text-2xl font-bold text-green-600">{{ ucfirst($farmer->status) }}</p>
                            <p class="text-sm text-gray-600 mt-2">Connection: {{ $farmer->connection_no }}</p>
                        @else
                            <p class="text-red-600"><a href="{{ route('farmer.apply') }}" class="underline">Apply for
                                    connection</a></p>
                        @endif
                    </div>

                    <!-- Active Complaints -->
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="text-lg font-semibold mb-2">Open Complaints</h3>
                        <p class="text-2xl font-bold text-orange-600">{{ $complaints->where('status', 'pending')->count() }}
                        </p>
                        <a href="{{ route('farmer.complaints') }}"
                            class="text-sm text-blue-600 hover:underline mt-2 inline-block">View all</a>
                    </div>

                    <!-- Current Usage -->
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="text-lg font-semibold mb-2">Current Month Usage</h3>
                        @if($powerUsage)
                            <p class="text-2xl font-bold text-blue-600">{{ $powerUsage->units_used }} kWh</p>
                            <p class="text-sm text-gray-600 mt-2">Bill: ₹{{ $powerUsage->bill_amount }}</p>
                        @else
                            <p class="text-gray-600">No data available</p>
                        @endif
                    </div>
                </div>

                <!-- Active Schedules -->
                <div class="bg-white p-6 rounded-lg shadow mb-8">
                    <h3 class="text-lg font-semibold mb-4">📅 Today's Electricity Schedule</h3>
                    @if($schedules->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead class="border-b">
                                    <tr>
                                        <th class="pb-2">Zone</th>
                                        <th class="pb-2">Start Time</th>
                                        <th class="pb-2">End Time</th>
                                        <th class="pb-2">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($schedules as $schedule)
                                        <tr class="border-b hover:bg-gray-50">
                                            <td class="py-2">{{ $schedule->zone }}</td>
                                            <td class="py-2">{{ $schedule->start_time }}</td>
                                            <td class="py-2">{{ $schedule->end_time }}</td>
                                            <td class="py-2">
                                                <span
                                                    class="px-2 py-1 rounded text-sm
                                                        {{ $schedule->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                    {{ ucfirst($schedule->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-600">No active schedules</p>
                    @endif
                </div>

                <!-- Recent Complaints -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold mb-4">🔧 Recent Complaints</h3>
                    @if($complaints->count() > 0)
                        <div class="space-y-3">
                            @foreach($complaints->take(5) as $complaint)
                                <div
                                    class="border-l-4 border-{{ $complaint->status === 'resolved' ? 'green' : 'orange' }}-500 pl-4 py-2">
                                    <div class="flex justify-between">
                                        <h4 class="font-semibold">{{ ucfirst(str_replace('_', ' ', $complaint->issue_type)) }}</h4>
                                        <span
                                            class="text-sm px-2 py-1 rounded
                                                {{ $complaint->status === 'resolved' ? 'bg-green-100 text-green-800' : 'bg-orange-100 text-orange-800' }}">
                                            {{ ucfirst($complaint->status) }}
                                        </span>
                                    </div>
                                    <p class="text-sm text-gray-600 mt-1">{{ substr($complaint->description, 0, 100) }}...</p>
                                </div>
                            @endforeach
                        </div>
                        <a href="{{ route('farmer.complaints') }}"
                            class="text-blue-600 hover:underline text-sm mt-4 inline-block">View all complaints →</a>
                    @else
                        <p class="text-gray-600">No complaints yet</p>
                    @endif
                </div>
            </main>
        </div>
    </div>
@endsection