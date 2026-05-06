@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-100">
        <div class="max-w-6xl mx-auto px-4 py-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold">My Complaints</h2>
                <a href="{{ route('farmer.complaint.create') }}"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    + New Complaint
                </a>
            </div>

            <div class="bg-white rounded-lg shadow overflow-hidden">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Date</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Type</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Description</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Status</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($complaints as $complaint)
                            <tr class="border-t">
                                <td class="px-6 py-3">{{ $complaint->created_at->format('M d, Y') }}</td>
                                <td class="px-6 py-3">{{ ucfirst(str_replace('_', ' ', $complaint->complaint_type)) }}</td>
                                <td class="px-6 py-3">{{ substr($complaint->description, 0, 50) }}...</td>
                                <td class="px-6 py-3">
                                    <span
                                        class="px-3 py-1 rounded text-sm font-semibold {{ $complaint->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                        {{ ucfirst($complaint->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-3">
                                    <a href="{{ route('farmer.complaint.show', $complaint->id) }}"
                                        class="text-blue-600 hover:underline">View</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                    No complaints yet. <a href="{{ route('farmer.complaint.create') }}"
                                        class="text-blue-600 hover:underline">Create one</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection