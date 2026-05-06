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
                    <a href="{{ route('admin.farmers') }}" class="block px-4 py-2 rounded hover:bg-gray-100">👨‍🌾 Manage Farmers</a>
                    <a href="{{ route('admin.schedules') }}" class="block px-4 py-2 rounded bg-blue-100 text-blue-800 font-semibold">⏰ Schedules</a>
                    <a href="{{ route('admin.complaints') }}" class="block px-4 py-2 rounded hover:bg-gray-100">🔧 Complaints</a>
                    <a href="{{ route('admin.reports') }}" class="block px-4 py-2 rounded hover:bg-gray-100">📈 Reports</a>
                </div>
            </aside>

            <main class="flex-1 p-8">
                <div class="mb-6 flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">⏰ Electricity Schedules</h2>
                        <p class="text-gray-500 mt-1">Manage zone-wise power distribution schedules</p>
                    </div>
                    <a href="{{ route('admin.schedule.create') }}"
                        class="px-5 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-semibold shadow">
                        ➕ Create Schedule
                    </a>
                </div>

                @if (session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6">
                        ✅ {{ session('success') }}
                    </div>
                @endif

                <div class="bg-white rounded-xl shadow overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-gray-50 border-b border-gray-200">
                                <tr>
                                    <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Zone</th>
                                    <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Start Time</th>
                                    <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">End Time</th>
                                    <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Description</th>
                                    <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse ($schedules as $schedule)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4 font-semibold text-gray-800">{{ $schedule->zone }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-600">
                                            {{ \Carbon\Carbon::parse($schedule->start_time)->format('h:i A') }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-600">
                                            {{ \Carbon\Carbon::parse($schedule->end_time)->format('h:i A') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="px-3 py-1 text-xs font-semibold rounded-full
                                                @if($schedule->status === 'active') bg-green-100 text-green-700
                                                @elseif($schedule->status === 'maintenance') bg-yellow-100 text-yellow-700
                                                @else bg-red-100 text-red-700 @endif">
                                                {{ ucfirst($schedule->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate">
                                            {{ $schedule->description ?? '—' }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                <a href="{{ route('admin.schedule.edit', $schedule->id) }}"
                                                    class="text-blue-600 hover:text-blue-800 text-sm font-medium transition">
                                                    ✏️ Edit
                                                </a>
                                                <form action="{{ route('admin.schedule.delete', $schedule->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-red-500 hover:text-red-700 text-sm font-medium transition"
                                                        onclick="return confirm('Delete this schedule?')">
                                                        🗑️ Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-12 text-center text-gray-400">
                                            <div class="text-4xl mb-2">⏰</div>
                                            <p>No schedules created yet.</p>
                                            <a href="{{ route('admin.schedule.create') }}" class="text-green-600 hover:underline text-sm mt-2 inline-block">Create your first schedule →</a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if ($schedules->hasPages())
                        <div class="px-6 py-4 border-t border-gray-100">
                            {{ $schedules->links() }}
                        </div>
                    @endif
                </div>
            </main>
        </div>
    </div>
@endsection
