@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-100">
        <nav class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <h1 class="text-2xl font-bold text-green-600">⚡ FarmGrid Admin</h1>
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
                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-100">📊 Dashboard</a>
                    <a href="{{ route('admin.farmers') }}" class="block px-4 py-2 rounded hover:bg-gray-100">👨‍🌾 Farmers</a>
                    <a href="{{ route('admin.schedules') }}" class="block px-4 py-2 rounded bg-green-100 text-green-800 font-semibold">⏰ Schedules</a>
                    <a href="{{ route('admin.complaints') }}" class="block px-4 py-2 rounded hover:bg-gray-100">🔧 Complaints</a>
                    <a href="{{ route('admin.reports') }}" class="block px-4 py-2 rounded hover:bg-gray-100">📈 Reports</a>
                </div>
            </aside>

            <main class="flex-1 p-8">
                <div class="mb-6 flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">✏️ Edit Schedule</h2>
                        <p class="text-gray-500 mt-1">Modify schedule for <strong>{{ $schedule->zone }}</strong></p>
                    </div>
                    <a href="{{ route('admin.schedules') }}"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition font-medium">
                        ← Back to Schedules
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
                    <form action="{{ route('admin.schedule.update', $schedule->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PATCH')

                        <div>
                            <label for="farmer_id" class="block text-sm font-semibold text-gray-700 mb-2">
                                👤 Linked Farmer Connection <span class="text-gray-400 font-normal">(Optional)</span>
                            </label>
                            <select id="farmer_id" name="farmer_id"
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500 @error('farmer_id') border-red-400 @enderror">
                                <option value="">-- Universal Zone Schedule --</option>
                                @foreach($farmers as $farmer)
                                    <option value="{{ $farmer->id }}" {{ old('farmer_id', $schedule->farmer_id) == $farmer->id ? 'selected' : '' }}>
                                        {{ $farmer->user->name }} - {{ $farmer->connection_no }} ({{ $farmer->village }})
                                    </option>
                                @endforeach
                            </select>
                            @error('farmer_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="zone" class="block text-sm font-semibold text-gray-700 mb-2">
                                ⚡ Zone Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="zone" name="zone"
                                value="{{ old('zone', $schedule->zone) }}"
                                placeholder="e.g. Zone A, North District"
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500 @error('zone') border-red-400 @enderror"
                                required>
                            @error('zone')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label for="start_time" class="block text-sm font-semibold text-gray-700 mb-2">
                                    🕐 Start Time <span class="text-red-500">*</span>
                                </label>
                                <input type="time" id="start_time" name="start_time"
                                    value="{{ old('start_time', \Carbon\Carbon::parse($schedule->start_time)->format('H:i')) }}"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500 @error('start_time') border-red-400 @enderror"
                                    required>
                                @error('start_time')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="end_time" class="block text-sm font-semibold text-gray-700 mb-2">
                                    🕕 End Time <span class="text-red-500">*</span>
                                </label>
                                <input type="time" id="end_time" name="end_time"
                                    value="{{ old('end_time', \Carbon\Carbon::parse($schedule->end_time)->format('H:i')) }}"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500 @error('end_time') border-red-400 @enderror"
                                    required>
                                @error('end_time')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="day_of_week" class="block text-sm font-semibold text-gray-700 mb-2">
                                    📅 Active Day
                                </label>
                                <select id="day_of_week" name="day_of_week"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500">
                                    @foreach(['Daily', 'Weekdays', 'Weekends', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                                        <option value="{{ $day }}" {{ old('day_of_week', $schedule->day_of_week) == $day ? 'selected' : '' }}>{{ $day }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="allocation_percentage" class="block text-sm font-semibold text-gray-700 mb-2">
                                    📊 Allocation (%)
                                </label>
                                <input type="number" id="allocation_percentage" name="allocation_percentage"
                                    value="{{ old('allocation_percentage', $schedule->allocation_percentage) }}"
                                    min="0" max="100"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500"
                                    required>
                            </div>
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">
                                🔄 Status <span class="text-red-500">*</span>
                            </label>
                            <select id="status" name="status"
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500 @error('status') border-red-400 @enderror"
                                required>
                                <option value="active" {{ old('status', $schedule->status) === 'active' ? 'selected' : '' }}>✅ Active</option>
                                <option value="inactive" {{ old('status', $schedule->status) === 'inactive' ? 'selected' : '' }}>⛔ Inactive</option>
                                <option value="maintenance" {{ old('status', $schedule->status) === 'maintenance' ? 'selected' : '' }}>🔧 Maintenance</option>
                            </select>
                            @error('status')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                                📝 Description <span class="text-gray-400 font-normal">(optional)</span>
                            </label>
                            <textarea id="description" name="description" rows="4"
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500 resize-none">{{ old('description', $schedule->description) }}</textarea>
                        </div>

                        <div class="flex items-center gap-4 pt-2">
                            <button type="submit"
                                class="px-8 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-semibold shadow-md">
                                💾 Save Changes
                            </button>
                            <a href="{{ route('admin.schedules') }}"
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
