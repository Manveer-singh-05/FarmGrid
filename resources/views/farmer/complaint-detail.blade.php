@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-100">
        <div class="max-w-4xl mx-auto px-4 py-8">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex justify-between items-start mb-6">
                    <h2 class="text-2xl font-bold">Complaint Details</h2>
                    <span
                        class="px-4 py-2 rounded text-sm font-semibold {{ $complaint->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                        {{ ucfirst($complaint->status) }}
                    </span>
                </div>

                <div class="space-y-4 mb-6">
                    <div>
                        <h3 class="font-semibold text-gray-700">Complaint Type</h3>
                        <p class="text-gray-600">{{ ucfirst(str_replace('_', ' ', $complaint->complaint_type)) }}</p>
                    </div>

                    <div>
                        <h3 class="font-semibold text-gray-700">Description</h3>
                        <p class="text-gray-600">{{ $complaint->description }}</p>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <h3 class="font-semibold text-gray-700">Date Filed</h3>
                            <p class="text-gray-600">{{ $complaint->created_at->format('M d, Y H:i') }}</p>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-700">Priority</h3>
                            <p class="text-gray-600">{{ ucfirst($complaint->priority ?? 'Not Set') }}</p>
                        </div>
                    </div>

                    @if($complaint->admin_comment)
                        <div>
                            <h3 class="font-semibold text-gray-700">Admin Response</h3>
                            <p class="text-gray-600 bg-gray-50 p-3 rounded">{{ $complaint->admin_comment }}</p>
                        </div>
                    @endif
                </div>

                <div class="flex gap-4">
                    <a href="{{ route('farmer.complaint.edit', $complaint->id) }}"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Edit</a>
                    <form action="{{ route('farmer.complaint.destroy', $complaint->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700"
                            onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                    <a href="{{ route('farmer.complaints') }}"
                        class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection