@extends('layouts.main')

@section('main-content')
    <div class="max-w-3xl">
        <div class="glass-card p-8">
            <h2 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-400 mb-8">
                Report a Complaint</h2>

            <form action="{{ route('farmer.complaint.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="group">
                    <label class="glass-label">Complaint Type</label>
                    <select name="complaint_type" required class="glass-input">
                        <option value="" class="bg-slate-900 text-white">Select...</option>
                        <option value="no_electricity" class="bg-slate-900 text-white">No Electricity Supply</option>
                        <option value="low_voltage" class="bg-slate-900 text-white">Low Voltage</option>
                        <option value="transformer_issue" class="bg-slate-900 text-white">Transformer Problem</option>
                        <option value="line_fault" class="bg-slate-900 text-white">Line Fault</option>
                        <option value="billing_issue" class="bg-slate-900 text-white">Billing Issue</option>
                        <option value="meter_problem" class="bg-slate-900 text-white">Meter Problem</option>
                        <option value="other" class="bg-slate-900 text-white">Other</option>
                    </select>
                </div>

                <div class="group">
                    <label class="glass-label">Description</label>
                    <textarea name="description" rows="5" required class="glass-input resize-none"></textarea>
                </div>

                <div class="group">
                    <label class="glass-label">Priority</label>
                    <select name="priority" class="glass-input">
                        <option value="low" class="bg-slate-900 text-white">Low</option>
                        <option value="medium" selected class="bg-slate-900 text-white">Medium</option>
                        <option value="high" class="bg-slate-900 text-white">High</option>
                    </select>
                </div>

                <div class="flex gap-4 pt-6">
                    <button type="submit" class="btn-glass btn-green px-8 py-3 font-semibold">
                        ✓ Submit Complaint
                    </button>
                    <a href="{{ route('farmer.complaints') }}"
                        class="btn-glass btn-blue px-8 py-3 font-semibold text-center">
                        ← Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection