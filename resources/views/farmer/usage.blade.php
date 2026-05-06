@extends('layouts.main')

@section('main-content')
    <div class="space-y-6">
        <h2 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-400">Power Usage
            & Billing</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="glass-card p-6">
                <h3 class="text-white/70 font-semibold text-sm mb-2">Current Month Usage</h3>
                <p class="text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-400">--
                    kWh</p>
            </div>
            <div class="glass-card p-6">
                <h3 class="text-white/70 font-semibold text-sm mb-2">Current Bill Amount</h3>
                <p class="text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-emerald-400">
                    ₹--</p>
            </div>
            <div class="glass-card p-6">
                <h3 class="text-white/70 font-semibold text-sm mb-2">Last Payment</h3>
                <p class="text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-yellow-400">
                    --</p>
            </div>
        </div>

        <div class="glass-card overflow-hidden">
            <div class="px-6 py-4 border-b border-white/10">
                <h3 class="font-semibold text-white text-lg">Usage History</h3>
            </div>
            <table class="w-full">
                <thead class="border-b border-white/10 bg-white/5">
                    <tr class="text-white/70">
                        <th class="px-6 py-3 text-left text-sm font-semibold">Month</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Units (kWh)</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Amount (₹)</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($usages as $usage)
                        <tr class="border-b border-white/5 hover:bg-white/5 transition-colors">
                            <td class="px-6 py-3 text-white">{{ $usage->month }}</td>
                            <td class="px-6 py-3 text-white/80">{{ $usage->units }}</td>
                            <td class="px-6 py-3 text-white/80">₹{{ $usage->amount }}</td>
                            <td class="px-6 py-3">
                                <span
                                    class="px-3 py-1 rounded-full text-sm font-semibold {{ $usage->status === 'paid' ? 'bg-green-500/30 text-green-300 border border-green-500/50' : 'bg-red-500/30 text-red-300 border border-red-500/50' }}">
                                    {{ ucfirst($usage->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-white/50">
                                No usage data available yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection