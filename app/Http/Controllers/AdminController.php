<?php

namespace App\Http\Controllers;

use App\Models\Farmer;
use App\Models\ElectricitySchedule;
use App\Models\Complaint;
use App\Models\PowerUsage;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Admin Dashboard
     */
    public function dashboard()
    {
        $totalFarmers = Farmer::count();
        $pendingApplications = Farmer::where('status', 'pending')->count();
        $totalComplaints = Complaint::count();
        $pendingComplaints = Complaint::where('status', 'pending')->count();
        $schedules = ElectricitySchedule::all();

        return view('admin.dashboard', compact('totalFarmers', 'pendingApplications', 'totalComplaints', 'pendingComplaints', 'schedules'));
    }

    /**
     * View all farmers
     */
    public function farmers()
    {
        $farmers = Farmer::with('user')->paginate(15);
        return view('admin.farmers', compact('farmers'));
    }

    /**
     * Approve farmer application
     */
    public function approveFarmer($id)
    {
        $farmer = Farmer::findOrFail($id);
        $farmer->update(['status' => 'approved']);

        return back()->with('success', 'Farmer approved successfully!');
    }

    /**
     * Reject farmer application
     */
    public function rejectFarmer($id)
    {
        $farmer = Farmer::findOrFail($id);
        $farmer->update(['status' => 'rejected']);

        return back()->with('success', 'Farmer application rejected!');
    }

    /**
     * Manage electricity schedules
     */
    public function schedules()
    {
        $schedules = ElectricitySchedule::paginate(10);
        return view('admin.schedules', compact('schedules'));
    }

    /**
     * Create new schedule
     */
    public function createSchedule()
    {
        return view('admin.create-schedule');
    }

    /**
     * Store new schedule
     */
    public function storeSchedule(Request $request)
    {
        $validated = $request->validate([
            'zone' => 'required|string',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'description' => 'nullable|string',
        ]);

        ElectricitySchedule::create($validated);

        return redirect()->route('admin.schedules')
            ->with('success', 'Schedule created successfully!');
    }

    /**
     * Update schedule
     */
    public function updateSchedule(Request $request, $id)
    {
        $schedule = ElectricitySchedule::findOrFail($id);

        $validated = $request->validate([
            'zone' => 'required|string',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'status' => 'required|in:active,inactive,maintenance',
            'description' => 'nullable|string',
        ]);

        $schedule->update($validated);

        return back()->with('success', 'Schedule updated successfully!');
    }

    /**
     * Delete schedule
     */
    public function deleteSchedule($id)
    {
        $schedule = ElectricitySchedule::findOrFail($id);
        $schedule->delete();

        return back()->with('success', 'Schedule deleted successfully!');
    }

    /**
     * View all complaints
     */
    public function complaints()
    {
        $complaints = Complaint::with('farmer.user')->latest()->paginate(15);
        return view('admin.complaints', compact('complaints'));
    }

    /**
     * Resolve complaint
     */
    public function resolveComplaint(Request $request, $id)
    {
        $complaint = Complaint::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:in_progress,resolved,rejected',
            'admin_notes' => 'required|string',
        ]);

        $complaint->update($validated);

        return back()->with('success', 'Complaint updated successfully!');
    }

    /**
     * Generate reports
     */
    public function reports()
    {
        $totalFarmers = Farmer::count();
        $approvedFarmers = Farmer::where('status', 'approved')->count();
        $totalComplaints = Complaint::count();
        $resolvedComplaints = Complaint::where('status', 'resolved')->count();
        $totalUsageRecords = PowerUsage::count();

        return view('admin.reports', compact('totalFarmers', 'approvedFarmers', 'totalComplaints', 'resolvedComplaints', 'totalUsageRecords'));
    }
}
