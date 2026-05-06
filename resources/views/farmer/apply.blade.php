@extends('layouts.main')

@section('main-content')
    <div class="max-w-3xl">
        <div class="glass-card p-8 mb-6">
            <h2 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-400 mb-8">
                Apply for Electricity Connection</h2>

            <form action="{{ route('farmer.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="group">
                    <label class="glass-label">Village Name</label>
                    <input type="text" name="village" required class="glass-input">
                </div>

                <div class="group">
                    <label class="glass-label">Land Area (in acres)</label>
                    <input type="number" step="0.1" name="land_area" required class="glass-input">
                </div>

                <div class="group">
                    <label class="glass-label">Connection Number</label>
                    <input type="text" name="connection_no" required class="glass-input">
                </div>

                <div class="group">
                    <label class="glass-label">Water Source</label>
                    <select name="water_source" required class="glass-input">
                        <option value="" class="bg-slate-900 text-white">Select...</option>
                        <option value="tube_well" class="bg-slate-900 text-white">Tube Well</option>
                        <option value="borewell" class="bg-slate-900 text-white">Borewell</option>
                        <option value="canal" class="bg-slate-900 text-white">Canal</option>
                    </select>
                </div>

                <div class="flex gap-4 pt-6">
                    <button type="submit" class="btn-glass btn-green px-8 py-3 font-semibold">
                        ✓ Submit Application
                    </button>
                    <a href="{{ route('farmer.dashboard') }}"
                        class="btn-glass btn-blue px-8 py-3 font-semibold text-center">
                        ← Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection