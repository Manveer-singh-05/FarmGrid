@extends('layouts.main')

@section('main-content')
    <div class="space-y-6">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-400">
                    👨‍🌾 Farmer Applications</h2>
                <p class="text-white/60 mt-1">Review and manage all farmer connection requests</p>
            </div>
        </div>

        @if (session('success'))
            <div class="glass-card border-l-4 border-green-500 p-4 bg-green-500/10">
                <p class="text-green-300 font-medium">✓ {{ session('success') }}</p>
            </div>
        @endif
        @if (session('error'))
            <div class="glass-card border-l-4 border-red-500 p-4 bg-red-500/10">
                <p class="text-red-300 font-medium">✗ {{ session('error') }}</p>
            </div>
        @endif

        <div class="glass-card overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="border-b border-white/10 bg-white/5">
                        <tr class="text-white/70">
                            <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">#</th>
                            <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Farmer Name
                            </th>
                            <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Village</th>
                            <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Land Area
                            </th>
                            <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Connection
                                No.</th>
                            <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse ($farmers as $farmer)
                            <tr class="hover:bg-white/5 transition-colors">
                                <td class="px-6 py-4 text-sm text-white/50">{{ $farmer->id }}</td>
                                <td class="px-6 py-4 font-medium text-white">{{ $farmer->user->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4 text-sm text-white/70">{{ $farmer->user->email ?? 'N/A' }}</td>
                                <td class="px-6 py-4 text-sm text-white/70">{{ $farmer->village }}</td>
                                <td class="px-6 py-4 text-sm text-white/70">{{ $farmer->land_area }} acres</td>
                                <td class="px-6 py-4 text-sm font-mono text-white/70">{{ $farmer->connection_no }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full
                                                @if($farmer->status === 'approved') bg-green-500/30 text-green-300 border border-green-500/50
                                                @elseif($farmer->status === 'pending') bg-yellow-500/30 text-yellow-300 border border-yellow-500/50
                                                @else bg-red-500/30 text-red-300 border border-red-500/50 @endif">
                                        {{ ucfirst($farmer->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        @if ($farmer->status === 'pending')
                                            <form action="{{ route('admin.farmer.approve', $farmer->id) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                    class="px-3 py-1 btn-glass btn-green text-xs rounded font-medium"
                                                    onclick="return confirm('Approve this farmer?')">
                                                    ✓ Approve
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.farmer.reject', $farmer->id) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                    class="px-3 py-1 btn-glass inline-flex items-center justify-center gap-2 bg-gradient-to-r from-red-500 to-rose-500 hover:from-red-400 hover:to-rose-400 text-xs rounded font-medium"
                                                    onclick="return confirm('Reject this farmer?')">
                                                    ✗ Reject
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-xs text-white/40 italic">No actions</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-12 text-center text-white/40">
                                    <div class="text-5xl mb-2">👨‍🌾</div>
                                    <p>No farmer applications found.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($farmers->hasPages())
                <div class="px-6 py-4 border-t border-white/10">
                    {{ $farmers->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection