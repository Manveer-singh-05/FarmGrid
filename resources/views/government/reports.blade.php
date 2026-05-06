@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-100">
        <nav class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <h1 class="text-2xl font-bold text-purple-600">🏛️ FarmGrid Government</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <span>{{ Auth::user()->name }} (Government)</span>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button class="text-red-600 hover:text-red-900">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <div class="flex max-w-7xl mx-auto">
            <aside class="w-64 bg-white shadow-md p-6">
                <div class="space-y-4">
                    <a href="{{ route('government.dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-100">📊
                        Dashboard</a>
                    <a href="{{ route('government.farmers') }}" class="block px-4 py-2 rounded hover:bg-gray-100">👨‍🌾
                        Farmers</a>
                    <a href="{{ route('government.complaints') }}" class="block px-4 py-2 rounded hover:bg-gray-100">🔧
                        Complaints</a>
                    <a href="{{ route('government.power-usage') }}" class="block px-4 py-2 rounded hover:bg-gray-100">⚡
                        Power Usage</a>
                    <a href="{{ route('government.schedules') }}" class="block px-4 py-2 rounded hover:bg-gray-100">⏰
                        Schedules</a>
                    <a href="{{ route('government.reports') }}" class="block px-4 py-2 rounded bg-purple-100">📈 Reports</a>
                </div>
            </aside>

            <main class="flex-1 p-8">
                <h2 class="text-3xl font-bold mb-8">Analytics & Reports</h2>

                <!-- Farmer Statistics -->
                <div class="mb-8">
                    <h3 class="text-2xl font-bold mb-4">Farmer Statistics</h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <div class="bg-white p-6 rounded-lg shadow">
                            <h4 class="text-gray-600 font-semibold">Total Farmers</h4>
                            <p class="text-3xl font-bold text-blue-600 mt-2">{{ $totalFarmers }}</p>
                        </div>

                        <div class="bg-white p-6 rounded-lg shadow">
                            <h4 class="text-gray-600 font-semibold">Approved</h4>
                            <p class="text-3xl font-bold text-green-600 mt-2">{{ $approvedFarmers }}</p>
                        </div>

                        <div class="bg-white p-6 rounded-lg shadow">
                            <h4 class="text-gray-600 font-semibold">Pending</h4>
                            <p class="text-3xl font-bold text-yellow-600 mt-2">{{ $pendingFarmers }}</p>
                        </div>

                        <div class="bg-white p-6 rounded-lg shadow">
                            <h4 class="text-gray-600 font-semibold">Rejected</h4>
                            <p class="text-3xl font-bold text-red-600 mt-2">{{ $rejectedFarmers }}</p>
                        </div>
                    </div>
                </div>

                <!-- Complaint Statistics -->
                <div class="mb-8">
                    <h3 class="text-2xl font-bold mb-4">Complaint Statistics</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-white p-6 rounded-lg shadow">
                            <h4 class="text-gray-600 font-semibold">Total Complaints</h4>
                            <p class="text-3xl font-bold text-red-600 mt-2">{{ $totalComplaints }}</p>
                        </div>

                        <div class="bg-white p-6 rounded-lg shadow">
                            <h4 class="text-gray-600 font-semibold">Pending</h4>
                            <p class="text-3xl font-bold text-orange-600 mt-2">{{ $pendingComplaints }}</p>
                        </div>

                        <div class="bg-white p-6 rounded-lg shadow">
                            <h4 class="text-gray-600 font-semibold">Resolved</h4>
                            <p class="text-3xl font-bold text-green-600 mt-2">{{ $resolvedComplaints }}</p>
                        </div>
                    </div>
                </div>

                <!-- Power Usage Statistics -->
                <div class="mb-8">
                    <h3 class="text-2xl font-bold mb-4">Power Usage Statistics</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-white p-6 rounded-lg shadow">
                            <h4 class="text-gray-600 font-semibold">Total Usage (Units)</h4>
                            <p class="text-3xl font-bold text-yellow-600 mt-2">{{ number_format($totalPowerUsage, 2) }}</p>
                        </div>

                        <div class="bg-white p-6 rounded-lg shadow">
                            <h4 class="text-gray-600 font-semibold">Average Usage (Units)</h4>
                            <p class="text-3xl font-bold text-orange-600 mt-2">{{ number_format($avgPowerUsage, 2) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Summary -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-xl font-bold mb-4">Summary Report</h3>
                    <ul class="space-y-2 text-gray-700">
                        <li>• <strong>Farmer Approval Rate:</strong>
                            {{ $totalFarmers > 0 ? number_format(($approvedFarmers / $totalFarmers) * 100, 2) : 0 }}%</li>
                        <li>• <strong>Complaint Resolution Rate:</strong>
                            {{ $totalComplaints > 0 ? number_format(($resolvedComplaints / $totalComplaints) * 100, 2) : 0 }}%
                        </li>
                        <li>• <strong>Total Farmers Under Monitoring:</strong> {{ $totalFarmers }}</li>
                        <li>• <strong>Total Power Consumption:</strong> {{ number_format($totalPowerUsage, 2) }} units</li>
                    </ul>
                </div>
            </main>
        </div>
    </div>
@endsection