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
                    <a href="{{ route('government.farmers') }}" class="block px-4 py-2 rounded bg-purple-100">👨‍🌾
                        Farmers</a>
                    <a href="{{ route('government.complaints') }}" class="block px-4 py-2 rounded hover:bg-gray-100">🔧
                        Complaints</a>
                    <a href="{{ route('government.power-usage') }}" class="block px-4 py-2 rounded hover:bg-gray-100">⚡
                        Power Usage</a>
                    <a href="{{ route('government.schedules') }}" class="block px-4 py-2 rounded hover:bg-gray-100">⏰
                        Schedules</a>
                    <a href="{{ route('government.reports') }}" class="block px-4 py-2 rounded hover:bg-gray-100">📈
                        Reports</a>
                </div>
            </aside>

            <main class="flex-1 p-8">
                <h2 class="text-3xl font-bold mb-8">Farmers Information</h2>

                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-semibold">Name</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold">Contact</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold">Land Area</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold">Status</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold">Crop Type</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @forelse ($farmers as $farmer)
                                <tr>
                                    <td class="px-6 py-3">{{ $farmer->user->name }}</td>
                                    <td class="px-6 py-3">{{ $farmer->user->email }}</td>
                                    <td class="px-6 py-3">{{ $farmer->land_area }} acres</td>
                                    <td class="px-6 py-3">
                                        <span class="px-3 py-1 rounded-full text-sm font-semibold
                                                    @if($farmer->status === 'approved') bg-green-100 text-green-800
                                                    @elseif($farmer->status === 'pending') bg-yellow-100 text-yellow-800
                                                    @else bg-red-100 text-red-800
                                                    @endif">
                                            {{ ucfirst($farmer->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-3">{{ $farmer->crop_type }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-3 text-center text-gray-500">No farmers found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="p-4">
                        {{ $farmers->links() }}
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection