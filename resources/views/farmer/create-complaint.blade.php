@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-100">
        <div class="max-w-4xl mx-auto px-4 py-8">
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-2xl font-bold mb-6">Report a Complaint</h2>

                <form action="{{ route('farmer.complaint.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Complaint Type</label>
                        <select name="complaint_type" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm border p-2">
                            <option value="">Select...</option>
                            <option value="no_electricity">No Electricity Supply</option>
                            <option value="low_voltage">Low Voltage</option>
                            <option value="transformer_issue">Transformer Problem</option>
                            <option value="line_fault">Line Fault</option>
                            <option value="billing_issue">Billing Issue</option>
                            <option value="meter_problem">Meter Problem</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" rows="5" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm border p-2"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Priority</label>
                        <select name="priority"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm border p-2">
                            <option value="low">Low</option>
                            <option value="medium" selected>Medium</option>
                            <option value="high">High</option>
                        </select>
                    </div>

                    <div class="flex gap-4">
                        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700">Submit
                            Complaint</button>
                        <a href="{{ route('farmer.complaints') }}"
                            class="bg-gray-300 text-gray-700 px-6 py-2 rounded-md hover:bg-gray-400">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection