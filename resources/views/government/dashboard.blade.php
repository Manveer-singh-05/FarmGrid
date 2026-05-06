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
                    <a href="{{ route('government.dashboard') }}" class="block px-4 py-2 rounded bg-purple-100">📊
                        Dashboard</a>
                    <a href="{{ route('government.farmers') }}" class="block px-4 py-2 rounded hover:bg-gray-100">👨‍🌾
                        Farmers</a>
                    <a href="{{ route('government.complaints') }}" class="block px-4 py-2 rounded hover:bg-gray-100">🔧
                        Complaints</a>
                    <a href="{{ route('government.power-usage') }}" class="block px-4 py-2 rounded hover:bg-gray-100">⚡
                        Power Usage</a>
                    <a href="{{ route('government.schedules') }}" class="block px-4 py-2 rounded hover:bg-gray-100">⏰
                        Schedules</a>
                    <a href="{{ route('government.reports') }}" class="block px-4 py-2 rounded hover:bg-gray-100">📈
                        Reports</a>
                </div>
            </aside>

            <main class="flex-1 p-8">
                <h2 class="text-3xl font-bold mb-8">Government Dashboard</h2>

                <!-- Statistics Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <!-- Total Farmers -->
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="text-gray-600 font-semibold">Total Farmers</h3>
                        <p class="text-3xl font-bold text-purple-600 mt-2">{{ $totalFarmers }}</p>
                    </div>

                    <!-- Approved Farmers -->
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="text-gray-600 font-semibold">Approved Farmers</h3>
                        <p class="text-3xl font-bold text-green-600 mt-2">{{ $approvedFarmers }}</p>
                    </div>

                    <!-- Total Power Usage -->
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="text-gray-600 font-semibold">Total Power Usage (Units)</h3>
                        <p class="text-3xl font-bold text-yellow-600 mt-2">{{ number_format($totalPowerUsage, 2) }}</p>
                    </div>

                    <!-- Total Complaints -->
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="text-gray-600 font-semibold">Total Complaints</h3>
                        <p class="text-3xl font-bold text-red-600 mt-2">{{ $totalComplaints }}</p>
                    </div>

                    <!-- Resolved Complaints -->
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="text-gray-600 font-semibold">Resolved Complaints</h3>
                        <p class="text-3xl font-bold text-blue-600 mt-2">{{ $resolvedComplaints }}</p>
                    </div>

                    <!-- Active Schedules -->
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="text-gray-600 font-semibold">Active Schedules</h3>
                        <p class="text-3xl font-bold text-indigo-600 mt-2">{{ count($schedules) }}</p>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-xl font-bold mb-4">Quick Links</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <a href="{{ route('government.farmers') }}"
                            class="p-4 border-2 border-purple-200 rounded hover:border-purple-500 transition">
                            <p class="font-semibold">View All Farmers</p>
                            <p class="text-sm text-gray-600">Monitor registered farmers</p>
                        </a>
                        <a href="{{ route('government.complaints') }}"
                            class="p-4 border-2 border-purple-200 rounded hover:border-purple-500 transition">
                            <p class="font-semibold">View Complaints</p>
                            <p class="text-sm text-gray-600">Monitor complaint status</p>
                        </a>
                        <a href="{{ route('government.reports') }}"
                            class="p-4 border-2 border-purple-200 rounded hover:border-purple-500 transition">
                            <p class="font-semibold">View Reports</p>
                            <p class="text-sm text-gray-600">Detailed analytics</p>
                        </a>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection