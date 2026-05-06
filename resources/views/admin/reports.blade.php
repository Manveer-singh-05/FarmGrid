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
                    <a href="{{ route('admin.complaints') }}" class="block px-4 py-2 rounded hover:bg-gray-100">🔧 Complaints</a>
                    <a href="{{ route('admin.reports') }}" class="block px-4 py-2 rounded bg-blue-100 text-blue-800 font-semibold">📈 Reports</a>
                </div>
            </aside>

            <main class="flex-1 p-8">
                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">📈 System Reports</h2>
                    <p class="text-gray-500 mt-1">Overview of FarmGrid system statistics</p>
                </div>

                <!-- Farmer Stats -->
                <h3 class="text-lg font-semibold text-gray-700 mb-4">👨‍🌾 Farmer Statistics</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-5 mb-8">
                    <div class="bg-white rounded-xl shadow p-5 text-center">
                        <p class="text-3xl font-bold text-blue-600">{{ $totalFarmers }}</p>
                        <p class="text-sm text-gray-500 mt-2 font-medium">Total Farmers</p>
                    </div>
                    <div class="bg-white rounded-xl shadow p-5 text-center">
                        <p class="text-3xl font-bold text-green-600">{{ $approvedFarmers }}</p>
                        <p class="text-sm text-gray-500 mt-2 font-medium">Approved</p>
                    </div>
                    <div class="bg-white rounded-xl shadow p-5 text-center">
                        @php $pending = $totalFarmers - $approvedFarmers; @endphp
                        <p class="text-3xl font-bold text-yellow-600">{{ $pending }}</p>
                        <p class="text-sm text-gray-500 mt-2 font-medium">Pending / Rejected</p>
                    </div>
                    <div class="bg-white rounded-xl shadow p-5 text-center">
                        @php $approvalRate = $totalFarmers > 0 ? round(($approvedFarmers / $totalFarmers) * 100) : 0; @endphp
                        <p class="text-3xl font-bold text-purple-600">{{ $approvalRate }}%</p>
                        <p class="text-sm text-gray-500 mt-2 font-medium">Approval Rate</p>
                    </div>
                </div>

                <!-- Complaint Stats -->
                <h3 class="text-lg font-semibold text-gray-700 mb-4">🔧 Complaint Statistics</h3>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-5 mb-8">
                    <div class="bg-white rounded-xl shadow p-5 text-center">
                        <p class="text-3xl font-bold text-gray-700">{{ $totalComplaints }}</p>
                        <p class="text-sm text-gray-500 mt-2 font-medium">Total Complaints</p>
                    </div>
                    <div class="bg-white rounded-xl shadow p-5 text-center">
                        <p class="text-3xl font-bold text-green-600">{{ $resolvedComplaints }}</p>
                        <p class="text-sm text-gray-500 mt-2 font-medium">Resolved</p>
                    </div>
                    <div class="bg-white rounded-xl shadow p-5 text-center">
                        @php $pendingComplaints = $totalComplaints - $resolvedComplaints; @endphp
                        <p class="text-3xl font-bold text-orange-500">{{ $pendingComplaints }}</p>
                        <p class="text-sm text-gray-500 mt-2 font-medium">Pending</p>
                    </div>
                </div>

                <!-- Complaint Resolution Bar -->
                @if ($totalComplaints > 0)
                    @php $resolutionRate = round(($resolvedComplaints / $totalComplaints) * 100); @endphp
                    <div class="bg-white rounded-xl shadow p-6 mb-8">
                        <div class="flex justify-between items-center mb-3">
                            <h4 class="font-semibold text-gray-700">Complaint Resolution Rate</h4>
                            <span class="text-sm font-bold text-green-600">{{ $resolutionRate }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-4">
                            <div class="bg-green-500 h-4 rounded-full transition-all"
                                style="width: {{ $resolutionRate }}%"></div>
                        </div>
                    </div>
                @endif

                <!-- Power Usage Stats -->
                <h3 class="text-lg font-semibold text-gray-700 mb-4">⚡ Power Usage</h3>
                <div class="bg-white rounded-xl shadow p-6">
                    <div class="flex items-center gap-6">
                        <div class="text-center">
                            <p class="text-3xl font-bold text-blue-600">{{ number_format($totalUsageRecords) }}</p>
                            <p class="text-sm text-gray-500 mt-2 font-medium">Total Usage Records</p>
                        </div>
                        <div class="flex-1 text-gray-500 text-sm">
                            <p>Usage records track monthly power consumption and billing for all approved farmers.
                               These records are added by admin after meter readings each month.</p>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection
