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
                        <span class="text-gray-700">{{ Auth::user()->name }} (Admin)</span>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button class="text-red-600 hover:text-red-900">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <div class="flex max-w-7xl mx-auto">
            <aside class="w-64 bg-white shadow-md p-6 min-h-screen">
                <div class="space-y-2">
                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-100">📊 Dashboard</a>
                    <a href="{{ route('admin.farmers') }}" class="block px-4 py-2 rounded bg-blue-100 text-blue-800 font-semibold">👨‍🌾 Manage Farmers</a>
                    <a href="{{ route('admin.schedules') }}" class="block px-4 py-2 rounded hover:bg-gray-100">⏰ Schedules</a>
                    <a href="{{ route('admin.complaints') }}" class="block px-4 py-2 rounded hover:bg-gray-100">🔧 Complaints</a>
                    <a href="{{ route('admin.reports') }}" class="block px-4 py-2 rounded hover:bg-gray-100">📈 Reports</a>
                </div>
            </aside>

            <main class="flex-1 p-8">
                <div class="mb-6 flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">👨‍🌾 Farmer Applications</h2>
                        <p class="text-gray-500 mt-1">Review and manage all farmer connection requests</p>
                    </div>
                </div>

                @if (session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6">
                        ✅ {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6">
                        ❌ {{ session('error') }}
                    </div>
                @endif

                <div class="bg-white rounded-xl shadow overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-gray-50 border-b border-gray-200">
                                <tr>
                                    <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">#</th>
                                    <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Farmer Name</th>
                                    <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Village</th>
                                    <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Land Area</th>
                                    <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Connection No.</th>
                                    <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse ($farmers as $farmer)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4 text-sm text-gray-500">{{ $farmer->id }}</td>
                                        <td class="px-6 py-4 font-medium text-gray-800">{{ $farmer->user->name ?? 'N/A' }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-600">{{ $farmer->user->email ?? 'N/A' }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-600">{{ $farmer->village }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-600">{{ $farmer->land_area }} acres</td>
                                        <td class="px-6 py-4 text-sm font-mono text-gray-600">{{ $farmer->connection_no }}</td>
                                        <td class="px-6 py-4">
                                            <span class="px-3 py-1 text-xs font-semibold rounded-full
                                                @if($farmer->status === 'approved') bg-green-100 text-green-700
                                                @elseif($farmer->status === 'pending') bg-yellow-100 text-yellow-700
                                                @else bg-red-100 text-red-700 @endif">
                                                {{ ucfirst($farmer->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-2">
                                                @if ($farmer->status === 'pending')
                                                    <form action="{{ route('admin.farmer.approve', $farmer->id) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit"
                                                            class="px-3 py-1 bg-green-600 text-white text-xs rounded hover:bg-green-700 transition font-medium"
                                                            onclick="return confirm('Approve this farmer?')">
                                                            ✅ Approve
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('admin.farmer.reject', $farmer->id) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit"
                                                            class="px-3 py-1 bg-red-600 text-white text-xs rounded hover:bg-red-700 transition font-medium"
                                                            onclick="return confirm('Reject this farmer?')">
                                                            ❌ Reject
                                                        </button>
                                                    </form>
                                                @else
                                                    <span class="text-xs text-gray-400 italic">No actions</span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="px-6 py-12 text-center text-gray-400">
                                            <div class="text-4xl mb-2">👨‍🌾</div>
                                            <p>No farmer applications found.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if ($farmers->hasPages())
                        <div class="px-6 py-4 border-t border-gray-100">
                            {{ $farmers->links() }}
                        </div>
                    @endif
                </div>
            </main>
        </div>
    </div>
@endsection
