<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\Farmer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComplaintController extends Controller
{
    /**
     * Display farmer's complaints
     */
    public function index()
    {
        $farmer = Auth::user()->farmer;

        if (!$farmer) {
            return redirect()->route('farmer.apply')
                ->with('info', 'Please apply for a connection first before viewing complaints.');
        }

        $complaints = $farmer->complaints()->latest()->paginate(10);
        return view('farmer.complaints', compact('complaints'));
    }

    /**
     * Show complaint form
     */
    public function create()
    {
        return view('farmer.create-complaint');
    }

    /**
     * Store complaint
     */
    public function store(Request $request)
    {
        $farmer = Auth::user()->farmer;

        if (!$farmer) {
            return redirect()->route('farmer.apply')
                ->with('error', 'You must have an active connection to file a complaint.');
        }

        $validated = $request->validate([
            'complaint_type' => 'required|string|max:50',
            'priority' => 'required|in:low,medium,high',
            'description' => 'required|string|min:10|max:1000',
        ]);

        Complaint::create([
            'farmer_id' => $farmer->id,
            'issue_type' => $validated['complaint_type'],
            'priority' => $validated['priority'],
            'description' => $validated['description'],
            'status' => 'pending',
        ]);

        return redirect()->route('farmer.complaints')
            ->with('success', 'Complaint submitted successfully!');
    }

    /**
     * Show complaint details
     */
    public function show(string $id)
    {
        $complaint = Complaint::with('farmer.user')->findOrFail($id);

        // Check authorization
        if ($complaint->farmer_id !== Auth::user()->farmer->id && Auth::user()->role !== 'admin') {
            abort(403);
        }

        return view('farmer.complaint-detail', compact('complaint'));
    }

    /**
     * Edit complaint (only if pending)
     */
    public function edit(string $id)
    {
        $complaint = Complaint::findOrFail($id);

        if ($complaint->farmer_id !== Auth::user()->farmer->id) {
            abort(403);
        }

        if ($complaint->status !== 'pending') {
            return back()->with('error', 'Can only edit pending complaints!');
        }

        return view('farmer.edit-complaint', compact('complaint'));
    }

    /**
     * Update complaint
     */
    public function update(Request $request, string $id)
    {
        $complaint = Complaint::findOrFail($id);

        if ($complaint->farmer_id !== Auth::user()->farmer->id) {
            abort(403);
        }

        if ($complaint->status !== 'pending') {
            return back()->with('error', 'Can only update pending complaints!');
        }

        $validated = $request->validate([
            'complaint_type' => 'required|string|max:50',
            'priority' => 'required|in:low,medium,high',
            'description' => 'required|string|min:10|max:1000',
        ]);

        $complaint->update([
            'issue_type' => $validated['complaint_type'],
            'priority' => $validated['priority'],
            'description' => $validated['description'],
        ]);

        return redirect()->route('farmer.complaints')
            ->with('success', 'Complaint updated successfully!');
    }

    /**
     * Remove complaint (only if pending)
     */
    public function destroy(string $id)
    {
        $complaint = Complaint::findOrFail($id);

        if ($complaint->farmer_id !== Auth::user()->farmer->id) {
            abort(403);
        }

        if ($complaint->status !== 'pending') {
            return back()->with('error', 'Can only delete pending complaints!');
        }

        $complaint->delete();

        return redirect()->route('farmer.complaints')
            ->with('success', 'Complaint deleted successfully!');
    }
}
