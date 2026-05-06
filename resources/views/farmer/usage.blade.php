@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-100">
        <div class="max-w-6xl mx-auto px-4 py-8">
            <h2 class="text-2xl font-bold mb-6">Power Usage & Billing</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-gray-600 font-semibold">Current Month Usage</h3>
                    <p class="text-3xl font-bold text-blue-600 mt-2">-- kWh</p>
                </div>
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-gray-600 font-semibold">Current Bill Amount</h3>
                    <p class="text-3xl font-bold text-green-600 mt-2">₹--</p>
                </div>
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-gray-600 font-semibold">Last Payment</h3>
                    <p class="text-3xl font-bold text-orange-600 mt-2">--</p>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="px-6 py-4 border-b">
                    <h3 class="font-semibold">Usage History</h3>
                </div>
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Month</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Units (kWh)</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Amount (₹)</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($usages as $usage)
                            <tr class="border-t">
                                <td class="px-6 py-3">{{ $usage->month }}</td>
                                <td class="px-6 py-3">{{ $usage->units }}</td>
                                <td class="px-6 py-3">₹{{ $usage->amount }}</td>
                                <td class="px-6 py-3">
                                    <span
                                        class="px-3 py-1 rounded text-sm font-semibold {{ $usage->status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ ucfirst($usage->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                                    No usage data available yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection