@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-100">
        <nav class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <h1 class="text-2xl font-bold text-green-600">🌾 FarmGrid</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-700">{{ Auth::user()->name }}</span>
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
                    <a href="{{ route('farmer.dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-100">📊 Dashboard</a>
                    <a href="{{ route('farmer.apply') }}" class="block px-4 py-2 rounded hover:bg-gray-100">📝 Apply for Connection</a>
                    <a href="{{ route('farmer.schedules') }}" class="block px-4 py-2 rounded hover:bg-gray-100">⏰ Electricity Schedule</a>
                    <a href="{{ route('farmer.complaints') }}" class="block px-4 py-2 rounded bg-green-100 text-green-800 font-semibold">🔧 Complaints</a>
                    <a href="{{ route('farmer.usage') }}" class="block px-4 py-2 rounded hover:bg-gray-100">📈 Power Usage</a>
                </div>
            </aside>

            <main class="flex-1 p-8">
                <div class="mb-6 flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">✏️ Edit Complaint</h2>
                        <p class="text-gray-500 mt-1">Update your complaint details (only pending complaints can be edited)</p>
                    </div>
                    <a href="{{ route('farmer.complaints') }}"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition font-medium">
                        ← Back
                    </a>
                </div>

                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="bg-white rounded-xl shadow p-8 max-w-2xl">
                    <!-- Current Status -->
                    <div class="mb-6 p-4 bg-orange-50 border border-orange-200 rounded-lg">
                        <p class="text-sm text-orange-700">
                            <strong>Status:</strong>
                            <span class="ml-2 px-2 py-0.5 bg-orange-100 rounded-full text-xs font-semibold">{{ ucfirst($complaint->status) }}</span>
                        </p>
                    </div>

                    <form action="{{ route('farmer.complaint.update', $complaint->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PATCH')

                        <div>
                            <label for="issue_type" class="block text-sm font-semibold text-gray-700 mb-2">
                                🔧 Issue Type <span class="text-red-500">*</span>
                            </label>
                            <select id="issue_type" name="issue_type"
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500 @error('issue_type') border-red-400 @enderror"
                                required>
                                <option value="">-- Select Issue Type --</option>
                                <option value="no_electricity" {{ old('issue_type', $complaint->issue_type) === 'no_electricity' ? 'selected' : '' }}>⚡ No Electricity</option>
                                <option value="voltage_issue" {{ old('issue_type', $complaint->issue_type) === 'voltage_issue' ? 'selected' : '' }}>⚠️ Voltage Issue</option>
                                <option value="transformer_problem" {{ old('issue_type', $complaint->issue_type) === 'transformer_problem' ? 'selected' : '' }}>🔌 Transformer Problem</option>
                                <option value="line_fault" {{ old('issue_type', $complaint->issue_type) === 'line_fault' ? 'selected' : '' }}>📡 Line Fault</option>
                                <option value="other" {{ old('issue_type', $complaint->issue_type) === 'other' ? 'selected' : '' }}>❓ Other</option>
                            </select>
                            @error('issue_type')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                                📝 Description <span class="text-red-500">*</span>
                            </label>
                            <textarea id="description" name="description" rows="5"
                                placeholder="Describe your issue in detail (minimum 10 characters)"
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500 resize-none @error('description') border-red-400 @enderror"
                                required>{{ old('description', $complaint->description) }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center gap-4 pt-2">
                            <button type="submit"
                                class="px-8 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-semibold shadow-md">
                                💾 Update Complaint
                            </button>
                            <a href="{{ route('farmer.complaints') }}"
                                class="px-6 py-3 border border-gray-300 text-gray-600 rounded-lg hover:bg-gray-50 transition font-medium">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>
@endsection
