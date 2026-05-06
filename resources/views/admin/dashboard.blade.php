@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-100">
        <nav class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <h1 class="text-2xl font-bold text-blue-600">⚙️ FarmGrid Admin</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <span>{{ Auth::user()->name }} (Admin)</span>
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
                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded bg-blue-100">📊 Dashboard</a>
                    <a href="{{ route('admin.farmers') }}" class="block px-4 py-2 rounded hover:bg-gray-100">👨‍🌾 Manage
                        Farmers</a>
                    <a href="{{ route('admin.schedules') }}" class="block px-4 py-2 rounded hover:bg-gray-100">⏰
                        Schedules</a>
                    <a href="{{ route('admin.complaints') }}" class="block px-4 py-2 rounded hover:bg-gray-100">🔧
                        Complaints</a>
                    <a href="{{ route('admin.reports') }}" class="block px-4 py-2 rounded hover:bg-gray-100">📈 Reports</a>
                </div>
            </aside>

            <main class="flex-1 p-8">
                <h2 class="text-3xl font-bold mb-8">Dashboard Overview</h2>

                <!-- Statistics Cards -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                    <!-- Total Farmers -->
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="text-gray-600 font-semibold">Total Farmers</h3>
                        <p class="text-3xl font-bold text-blue-600 mt-2">{{ $totalFarmers }}</p>
                    </div>

                    <!-- Pending Applications -->
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="text-gray-600 font-semibold">Pending Applications</h3>
                        <p class="text-3xl font-bold text-orange-600 mt-2">{{ $pendingApplications }}</p>
                        <a href="{{ route('admin.farmers') }}"
                            class="text-sm text-blue-600 hover:underline mt-2 inline-block">View →</a>
                    </div>

                    <!-- Total Complaints -->
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="text-gray-600 font-semibold">Total Complaints</h3>
                        <p class="text-3xl font-bold text-red-600 mt-2">{{ $totalComplaints }}</p>
                    </div>

                    <!-- Pending Complaints -->
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="text-gray-600 font-semibold">Pending Complaints</h3>
                        <p class="text-3xl font-bold text-yellow-600 mt-2">{{ $pendingComplaints }}</p>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white p-6 rounded-lg shadow mb-8">
                    <h3 class="text-lg font-semibold mb-4">Quick Actions</h3>
                    <div class="flex space-x-4">
                        <a href="{{ route('admin.schedule.create') }}"
                            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            ➕ Create Schedule
                        </a>
                        <a href="{{ route('admin.farmers') }}"
                            class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                            👁️ Review Applications
                        </a>
                        <a href="{{ route('admin.complaints') }}"
                            class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                            ⚡ Resolve Complaints
                        </a>
                    </div>
                </div>

                <!-- Active Schedules -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold mb-4">📅 Active Electricity Schedules</h3>
                    @if($schedules->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead class="border-b">
                                    <tr>
                                        <th class="pb-2">Zone</th>
                                        <th class="pb-2">Time Slot</th>
                                        <th class="pb-2">Status</th>
                                        <th class="pb-2">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($schedules->take(10) as $schedule)
                                        <tr class="border-b hover:bg-gray-50">
                                            <td class="py-2">{{ $schedule->zone }}</td>
                                            <td class="py-2">{{ $schedule->start_time }} - {{ $schedule->end_time }}</td>
                                            <td class="py-2">
                                                <span
                                                    class="px-2 py-1 rounded text-sm
                                                        {{ $schedule->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                                    {{ ucfirst($schedule->status) }}
                                                </span>
                                            </td>
                                            <td class="py-2">
                                                <a href="#" class="text-blue-600 hover:underline text-sm">Edit</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-600">No schedules created yet</p>
                    @endif
                </div>
            </main>
        </div>
    </div>
@endsection