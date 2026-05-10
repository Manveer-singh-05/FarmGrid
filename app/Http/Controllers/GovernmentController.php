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

        // Monthly Trends Data (Last 12 Months)
        $monthlyUsage = PowerUsage::selectRaw('SUM(units_consumed) as total, billing_month')
            ->groupBy('billing_month')
            ->orderByRaw('MIN(created_at) DESC')
            ->limit(12)
            ->get()
            ->reverse();

        // Daily Trends Data (Last 14 Days)
        $dailyUsage = PowerUsage::selectRaw('SUM(units_consumed) as total, DATE(created_at) as date')
            ->groupBy('date')
            ->orderBy('date', 'DESC')
            ->limit(14)
            ->get()
            ->reverse();

        // Dynamic Alerts Logic
        $alerts = [];
        
        // 1. Voltage Drop Alert (Critical) - High single usage or too many active schedules
        $highUsage = PowerUsage::where('units_consumed', '>', 500)->latest()->first();
        if ($highUsage) {
            $alerts[] = [
                'type' => 'critical',
                'title' => 'Voltage Drop',
                'description' => "High load detected: " . ($highUsage->farmer->user->name ?? 'Unknown') . " consumed {$highUsage->units_consumed} kWh.",
                'time' => $highUsage->created_at->diffForHumans(),
                'color' => '#EF4444'
            ];
        }

        // 2. Demand Spike Alert (Warning) - Recent usage surge
        $avgDaily = PowerUsage::avg('units_consumed') ?: 0;
        $todayUsage = PowerUsage::whereDate('created_at', now())->sum('units_consumed');
        if ($todayUsage > ($avgDaily * 1.5)) {
            $alerts[] = [
                'type' => 'warning',
                'title' => 'Demand Spike',
                'description' => "System-wide demand increased by " . round((($todayUsage / ($avgDaily ?: 1)) - 1) * 100) . "% today.",
                'time' => 'Today',
                'color' => '#F59E0B'
            ];
        }

        // 3. Resolution Sync (Success) - Recently resolved complaints
        $recentResolved = Complaint::where('status', 'resolved')->latest()->first();
        if ($recentResolved) {
            $alerts[] = [
                'type' => 'success',
                'title' => 'Resolution Sync',
                'description' => "Issue #{$recentResolved->id} (" . ucfirst($recentResolved->issue_type) . ") successfully resolved.",
                'time' => $recentResolved->updated_at->diffForHumans(),
                'color' => '#10B981'
            ];
        }

        return view('government.dashboard', compact(
            'totalFarmers',
            'approvedFarmers',
            'totalComplaints',
            'resolvedComplaints',
            'schedules',
            'totalPowerUsage',
            'monthlyUsage',
            'dailyUsage',
            'alerts'
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
