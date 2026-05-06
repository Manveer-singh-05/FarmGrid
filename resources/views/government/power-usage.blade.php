@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-100">
        <nav class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <h1 class="text-2xl font-bold text-purple-600">🏛️ FarmGrid Government</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <span>{{ Auth::user()->name }} (Government)</span>
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
                    <a href="{{ route('government.dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-100">📊
                        Dashboard</a>
                    <a href="{{ route('government.farmers') }}" class="block px-4 py-2 rounded hover:bg-gray-100">👨‍🌾
                        Farmers</a>
                    <a href="{{ route('government.complaints') }}" class="block px-4 py-2 rounded hover:bg-gray-100">🔧
                        Complaints</a>
                    <a href="{{ route('government.power-usage') }}" class="block px-4 py-2 rounded bg-purple-100">⚡ Power
                        Usage</a>
                    <a href="{{ route('government.schedules') }}" class="block px-4 py-2 rounded hover:bg-gray-100">⏰
                        Schedules</a>
                    <a href="{{ route('government.reports') }}" class="block px-4 py-2 rounded hover:bg-gray-100">📈
                        Reports</a>
                </div>
            </aside>

            <main class="flex-1 p-8">
                <h2 class="text-3xl font-bold mb-8">Power Usage Reports</h2>

                <!-- Summary Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="text-gray-600 font-semibold">Total Usage</h3>
                        <p class="text-3xl font-bold text-yellow-600 mt-2">{{ number_format($totalUsage, 2) }} units</p>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="text-gray-600 font-semibold">Average Usage</h3>
                        <p class="text-3xl font-bold text-orange-600 mt-2">{{ number_format($avgUsage, 2) }} units</p>
                    </div>
                </div>

                <!-- Power Usage Table -->
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-semibold">Farmer</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold">Units Used</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold">Meter Reading (kWh)</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold">Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @forelse ($powerUsage as $usage)
                                <tr>
                                    <td class="px-6 py-3">{{ $usage->farmer->user->name ?? 'N/A' }}</td>
                                    <td class="px-6 py-3">{{ $usage->units_used }}</td>
                                    <td class="px-6 py-3">{{ $usage->meter_reading }}</td>
                                    <td class="px-6 py-3">{{ $usage->created_at->format('Y-m-d') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-3 text-center text-gray-500">No power usage records found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="p-4">
                        {{ $powerUsage->links() }}
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection