@extends('layouts.main')

@section('main-content')
    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <h2 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-400">My Complaints</h2>
            <a href="{{ route('farmer.complaint.create') }}"
                class="btn-glass btn-green px-6 py-3 font-semibold">
                + New Complaint
            </a>
        </div>

        <div class="glass-card overflow-hidden">
            <table class="w-full">
                <thead class="border-b border-white/10 bg-white/5">
                    <tr class="text-white/70">
                        <th class="px-6 py-4 text-left text-sm font-semibold">Date</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Type</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Description</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Status</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($complaints as $complaint)
                        <tr class="border-b border-white/5 hover:bg-white/5 transition-colors">
                            <td class="px-6 py-4 text-white">{{ $complaint->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4 text-white/80">{{ ucfirst(str_replace('_', ' ', $complaint->complaint_type)) }}</td>
                            <td class="px-6 py-4 text-white/70">{{ substr($complaint->description, 0, 50) }}...</td>
                            <td class="px-6 py-4">
                                <span
                                    class="px-3 py-1 rounded-full text-sm font-semibold {{ $complaint->status === 'pending' ? 'bg-yellow-500/30 text-yellow-300 border border-yellow-500/50' : 'bg-green-500/30 text-green-300 border border-green-500/50' }}">
                                    {{ ucfirst($complaint->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('farmer.complaint.show', $complaint->id) }}"
                                    class="text-blue-400 hover:text-blue-300 underline">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-white/50">
                                No complaints yet. <a href="{{ route('farmer.complaint.create') }}"
                                    class="text-blue-400 hover:text-blue-300 underline">Create one</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection