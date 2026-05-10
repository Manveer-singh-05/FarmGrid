<?php

namespace App\Http\Controllers;

use App\Models\Farmer;
use App\Models\ElectricitySchedule;
use App\Models\Complaint;
use App\Models\PowerUsage;
use App\Models\User;
use Illuminate\Http\Request;

class GovernmentController extends Controller
{
    /**
     * Government Dashboard
     */
    public function dashboard()
    {
        $totalFarmers = Farmer::count();
        $approvedFarmers = Farmer::where('status', 'approved')->count();
        $totalComplaints = Complaint::count();
        $resolvedComplaints = Complaint::where('status', 'resolved')->count();
        $schedules = ElectricitySchedule::all();
        $totalPowerUsage = PowerUsage::sum('units_consumed');

        return view('government.dashboard', compact(
            'totalFarmers',
            'approvedFarmers',
            'totalComplaints',
            'resolvedComplaints',
            'schedules',
            'totalPowerUsage'
        ));
    }

    /**
     * View all farmers for reporting
     */
    public function farmers()
    {
        $farmers = Farmer::with('user')->paginate(15);
        return view('government.farmers', compact('farmers'));
    }

    /**
     * View all complaints for monitoring
     */
    public function complaints()
    {
        $complaints = Complaint::with(['farmer.user'])->paginate(15);
        return view('government.complaints', compact('complaints'));
    }

    /**
     * View power usage reports
     */
    public function powerUsage()
    {
        $powerUsage = PowerUsage::with('farmer')->paginate(15);
        $totalUsage = PowerUsage::sum('units_consumed');
        $avgUsage = PowerUsage::avg('units_consumed');

        return view('government.power-usage', compact('powerUsage', 'totalUsage', 'avgUsage'));
    }

    /**
     * View electricity schedules
     */
    public function schedules()
    {
        $schedules = ElectricitySchedule::paginate(15);
        return view('government.schedules', compact('schedules'));
    }

    /**
     * View reports and analytics
     */
    public function reports()
    {
        $totalFarmers = Farmer::count();
        $approvedFarmers = Farmer::where('status', 'approved')->count();
        $pendingFarmers = Farmer::where('status', 'pending')->count();
        $rejectedFarmers = Farmer::where('status', 'rejected')->count();

        $totalComplaints = Complaint::count();
        $pendingComplaints = Complaint::where('status', 'pending')->count();
        $resolvedComplaints = Complaint::where('status', 'resolved')->count();

        $totalPowerUsage = PowerUsage::sum('units_consumed');
        $avgPowerUsage = PowerUsage::avg('units_consumed');

        return view('government.reports', compact(
            'totalFarmers',
            'approvedFarmers',
            'pendingFarmers',
            'rejectedFarmers',
            'totalComplaints',
            'pendingComplaints',
            'resolvedComplaints',
            'totalPowerUsage',
            'avgPowerUsage'
        ));
    }
}
