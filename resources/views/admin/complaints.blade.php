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
                    <a href="{{ route('admin.schedules') }}" class="block px-4 py-2 rounded hover:bg-gray-100">⏰ Schedules</a>
                    <a href="{{ route('admin.complaints') }}" class="block px-4 py-2 rounded bg-blue-100 text-blue-800 font-semibold">🔧 Complaints</a>
                    <a href="{{ route('admin.reports') }}" class="block px-4 py-2 rounded hover:bg-gray-100">📈 Reports</a>
                </div>
            </aside>

            <main class="flex-1 p-8">
                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">🔧 Complaint Management</h2>
                    <p class="text-gray-500 mt-1">Review and resolve farmer complaints</p>
                </div>

                @if (session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6">
                        ✅ {{ session('success') }}
                    </div>
                @endif

                <div class="space-y-4">
                    @forelse ($complaints as $complaint)
                        <div class="bg-white rounded-xl shadow p-6">
                            <div class="flex items-start justify-between mb-4">
                                <div>
                                    <div class="flex items-center gap-3 mb-1">
                                        <h3 class="font-bold text-gray-800">
                                            {{ ucfirst(str_replace('_', ' ', $complaint->issue_type)) }}
                                        </h3>
                                        <span class="px-2 py-0.5 text-xs font-semibold rounded-full
                                            @if($complaint->status === 'resolved') bg-green-100 text-green-700
                                            @elseif($complaint->status === 'in_progress') bg-blue-100 text-blue-700
                                            @elseif($complaint->status === 'rejected') bg-red-100 text-red-700
                                            @else bg-yellow-100 text-yellow-700 @endif">
                                            {{ ucfirst(str_replace('_', ' ', $complaint->status)) }}
                                        </span>
                                    </div>
                                    <p class="text-sm text-gray-500">
                                        By: <strong>{{ $complaint->farmer->user->name ?? 'Unknown' }}</strong>
                                        &nbsp;|&nbsp; Village: {{ $complaint->farmer->village ?? '—' }}
                                        &nbsp;|&nbsp; Filed: {{ $complaint->created_at->diffForHumans() }}
                                    </p>
                                </div>
                                <span class="text-xs text-gray-400">#{{ $complaint->id }}</span>
                            </div>

                            <p class="text-gray-700 text-sm mb-4 bg-gray-50 rounded-lg p-3">{{ $complaint->description }}</p>

                            @if ($complaint->admin_notes)
                                <div class="mb-4 p-3 bg-blue-50 border-l-4 border-blue-400 rounded-r-lg">
                                    <p class="text-xs font-semibold text-blue-600 uppercase mb-1">Admin Notes</p>
                                    <p class="text-sm text-blue-800">{{ $complaint->admin_notes }}</p>
                                </div>
                            @endif

                            @if ($complaint->status !== 'resolved' && $complaint->status !== 'rejected')
                                <form action="{{ route('admin.complaint.resolve', $complaint->id) }}" method="POST"
                                    class="border-t border-gray-100 pt-4 mt-4 flex flex-wrap gap-3 items-end">
                                    @csrf
                                    @method('PATCH')

                                    <div class="flex-1 min-w-48">
                                        <label class="block text-xs font-semibold text-gray-600 mb-1">Update Status</label>
                                        <select name="status" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                            <option value="in_progress" {{ $complaint->status === 'in_progress' ? 'selected' : '' }}>🔄 In Progress</option>
                                            <option value="resolved">✅ Resolved</option>
                                            <option value="rejected">❌ Rejected</option>
                                        </select>
                                    </div>

                                    <div class="flex-1 min-w-64">
                                        <label class="block text-xs font-semibold text-gray-600 mb-1">Admin Notes <span class="text-red-500">*</span></label>
                                        <input type="text" name="admin_notes"
                                            placeholder="Add notes for the farmer..."
                                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                            required>
                                    </div>

                                    <button type="submit"
                                        class="px-5 py-2 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700 transition font-medium">
                                        Update
                                    </button>
                                </form>
                            @endif
                        </div>
                    @empty
                        <div class="bg-white rounded-xl shadow p-12 text-center text-gray-400">
                            <div class="text-5xl mb-3">🎉</div>
                            <p class="font-semibold text-lg">No complaints found!</p>
                            <p class="text-sm mt-1">All issues have been resolved.</p>
                        </div>
                    @endforelse
                </div>

                @if ($complaints->hasPages())
                    <div class="mt-6">
                        {{ $complaints->links() }}
                    </div>
                @endif
            </main>
        </div>
    </div>
@endsection
