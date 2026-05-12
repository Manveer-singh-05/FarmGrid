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
        
        try {
            $totalPowerUsage = (float)(PowerUsage::sum('units_consumed') ?? 0);

            // Monthly Trends Data (Last 12 Months)
            $monthlyUsage = PowerUsage::latest()
                ->limit(500)
                ->get()
                ->filter(fn($u) => !empty($u->billing_month))
                ->groupBy('billing_month')
                ->map(fn($items, $month) => ['total' => (float)($items->sum('units_consumed') ?? 0), 'billing_month' => (string)$month])
                ->values()
                ->take(12)
                ->reverse();

            // Daily Trends Data (Last 14 Days)
            $dailyUsage = PowerUsage::latest()
                ->limit(500)
                ->get()
                ->filter(fn($u) => $u->created_at instanceof \Carbon\Carbon)
                ->groupBy(fn($u) => $u->created_at->format('Y-m-d'))
                ->map(fn($items, $date) => ['total' => (float)($items->sum('units_consumed') ?? 0), 'date' => (string)$date])
                ->values()
                ->take(14)
                ->reverse();

            // Dynamic Alerts Logic
            $alerts = [];
            
            // 1. Voltage Drop Alert (Critical)
            $highUsage = PowerUsage::where('units_consumed', '>', 500)->latest()->first();
            if ($highUsage) {
                $alerts[] = [
                    'type' => 'critical',
                    'title' => 'Voltage Drop',
                    'description' => "High load detected: " . ($highUsage->farmer?->user?->name ?? 'Unknown') . " consumed " . number_format($highUsage->units_consumed ?? 0) . " kWh.",
                    'time' => $highUsage->created_at?->diffForHumans() ?? 'Unknown',
                    'color' => '#EF4444'
                ];
            }

            // 2. Demand Spike Alert (Warning)
            $avgDaily = (float)(PowerUsage::avg('units_consumed') ?: 0);
            $todayUsage = (float)PowerUsage::whereDate('created_at', now())->sum('units_consumed');
            if ($todayUsage > ($avgDaily * 1.5)) {
                $spikePercent = $avgDaily > 0 ? round((($todayUsage / $avgDaily) - 1) * 100) : 0;
                $alerts[] = [
                    'type' => 'warning',
                    'title' => 'Demand Spike',
                    'description' => "System-wide demand increased by {$spikePercent}% today.",
                    'time' => 'Today',
                    'color' => '#F59E0B'
                ];
            }
        } catch (\Exception $e) {
            $totalPowerUsage = 0;
            $monthlyUsage = collect();
            $dailyUsage = collect();
            $alerts = [[
                'type' => 'warning',
                'title' => 'Sync Delay',
                'description' => 'Real-time usage analytics are currently delayed.',
                'time' => 'Now',
                'color' => '#F59E0B'
            ]];
        }

        // 3. Resolution Sync (Success) - Recently resolved complaints (SQL - safe)
        $recentResolved = Complaint::where('status', 'resolved')->latest()->first();
        if ($recentResolved) {
            $alerts[] = [
                'type' => 'success',
                'title' => 'Resolution Sync',
                'description' => "Issue #{$recentResolved->id} (" . ucfirst($recentResolved->issue_type ?? 'Issue') . ") successfully resolved.",
                'time' => $recentResolved->updated_at?->diffForHumans() ?? 'Just now',
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
        try {
            $powerUsage = PowerUsage::with('farmer')->paginate(15);
            $totalUsage = (float)(PowerUsage::sum('units_consumed') ?? 0);
            $avgUsage = (float)(PowerUsage::avg('units_consumed') ?: 0);
        } catch (\Exception $e) {
            $powerUsage = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 15);
            $totalUsage = 0;
            $avgUsage = 0;
        }

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

        try {
            $totalPowerUsage = (float)(PowerUsage::sum('units_consumed') ?? 0);
            $avgPowerUsage = (float)(PowerUsage::avg('units_consumed') ?: 0);
        } catch (\Exception $e) {
            $totalPowerUsage = 0;
            $avgPowerUsage = 0;
        }

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
