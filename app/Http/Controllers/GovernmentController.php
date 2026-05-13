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
        // 1. Basic Stats (MySQL - very stable)
        try {
            $totalFarmers = Farmer::count();
            $approvedFarmers = Farmer::where('status', 'approved')->count();
            $totalComplaints = Complaint::count();
            $resolvedComplaints = Complaint::where('status', 'resolved')->count();
            $schedules = ElectricitySchedule::all();
        } catch (\Exception $e) {
            \Log::error("Gov Dashboard - Basic Stats Failure: " . $e->getMessage());
            $totalFarmers = 0;
            $approvedFarmers = 0;
            $totalComplaints = 0;
            $resolvedComplaints = 0;
            $schedules = collect();
        }
        
        // 2. Power Usage Totals (MongoDB)
        try {
            $totalPowerUsage = (float)(PowerUsage::sum('units_consumed') ?? 0);
        } catch (\Exception $e) {
            \Log::error("Gov Dashboard - Power Totals Failure: " . $e->getMessage());
            $totalPowerUsage = 0;
        }

        // 3. Monthly Trends (MongoDB - limited fetch for performance)
        try {
            $monthlyUsage = PowerUsage::latest()
                ->limit(1000)
                ->get()
                ->filter(fn($u) => !empty($u->billing_month))
                ->groupBy('billing_month')
                ->map(fn($items, $month) => (object)[
                    'total' => (float)($items->sum('units_consumed') ?? 0), 
                    'billing_month' => (string)$month
                ])
                ->values()
                ->take(12)
                ->reverse();
        } catch (\Exception $e) {
            \Log::error("Gov Dashboard - Monthly Trends Failure: " . $e->getMessage());
            $monthlyUsage = collect();
        }

        // 4. Daily Trends (MongoDB - range query for reliability)
        try {
            $fourteenDaysAgo = now()->subDays(14)->startOfDay();
            $dailyUsage = PowerUsage::where('created_at', '>=', $fourteenDaysAgo)
                ->get()
                ->groupBy(fn($u) => $u->created_at ? $u->created_at->format('Y-m-d') : 'unknown')
                ->map(fn($items, $date) => (object)[
                    'total' => (float)($items->sum('units_consumed') ?? 0), 
                    'date' => (string)$date
                ])
                ->values()
                ->sortBy('date')
                ->take(14);
        } catch (\Exception $e) {
            \Log::error("Gov Dashboard - Daily Trends Failure: " . $e->getMessage());
            $dailyUsage = collect();
        }

        // 5. Dynamic Alerts (MongoDB)
        $alerts = [];
        try {
            // High Usage Alert
            $highUsage = PowerUsage::orderBy('units_consumed', 'desc')->first();
            if ($highUsage && (float)$highUsage->units_consumed > 100) { // Lowered threshold for visibility
                $alerts[] = [
                    'type' => 'critical',
                    'title' => 'High Load Detected',
                    'description' => ($highUsage->farmer?->user?->name ?? 'A connection') . " recorded " . number_format((float)($highUsage->units_consumed ?? 0), 1) . " kWh.",
                    'time' => $highUsage->created_at ? $highUsage->created_at->diffForHumans() : 'Recently',
                    'color' => '#EF4444'
                ];
            }

            // Demand Spike Check
            $avgDaily = (float)(PowerUsage::avg('units_consumed') ?: 0);
            $startOfToday = now()->startOfDay();
            $todayUsage = (float)PowerUsage::where('created_at', '>=', $startOfToday)->sum('units_consumed');
            
            if ($todayUsage > ($avgDaily * 1.2) && $avgDaily > 0) {
                $spikePercent = round((($todayUsage / $avgDaily) - 1) * 100);
                $alerts[] = [
                    'type' => 'warning',
                    'title' => 'Demand Spike',
                    'description' => "Grid load is {$spikePercent}% higher today than historical average.",
                    'time' => 'Today',
                    'color' => '#F59E0B'
                ];
            }
        } catch (\Exception $e) {
            \Log::warning("Gov Dashboard - Alerts Processing Partial Failure: " . $e->getMessage());
        }

        // 6. Resolution Sync Alert (MySQL)
        try {
            $recentResolved = Complaint::where('status', 'resolved')->latest()->first();
            if ($recentResolved) {
                $alerts[] = [
                    'type' => 'success',
                    'title' => 'Resolution Sync',
                    'description' => "Issue #{$recentResolved->id} (" . ucfirst($recentResolved->issue_type ?? 'Issue') . ") successfully resolved.",
                    'time' => $recentResolved->updated_at ? $recentResolved->updated_at->diffForHumans() : 'Just now',
                    'color' => '#10B981'
                ];
            }
        } catch (\Exception $e) {
            // Ignore SQL failures for this minor alert
        }

        // Fallback alert if everything else empty
        if (empty($alerts) && $totalPowerUsage == 0) {
            $alerts[] = [
                'type' => 'info',
                'title' => 'Data Syncing',
                'description' => 'Usage telemetry is being synchronized from the regional grid.',
                'time' => 'Now',
                'color' => '#38BDF8'
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
        try {
            $farmers = Farmer::with('user')->paginate(15);
        } catch (\Exception $e) {
            $farmers = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 15);
        }
        return view('government.farmers', compact('farmers'));
    }

    /**
     * View all complaints for monitoring
     */
    public function complaints()
    {
        try {
            $complaints = Complaint::with(['farmer.user'])->paginate(15);
        } catch (\Exception $e) {
            $complaints = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 15);
        }
        return view('government.complaints', compact('complaints'));
    }

    /**
     * View power usage reports
     */
    public function powerUsage()
    {
        try {
            // Fetch paginated usage with farmer relation (safe check in Blade)
            $powerUsage = PowerUsage::with('farmer')->paginate(15);
            
            // Safe aggregations with null coalescing and logging
            $totalUsage = (float)(PowerUsage::sum('units_consumed') ?? 0);
            $avgUsage = (float)(PowerUsage::avg('units_consumed') ?: 0);
        } catch (\Throwable $t) {
            // Production logging for debugging sync/data issues
            \Log::error("Government Dashboard - Power Usage Analytics Failure: " . $t->getMessage(), [
                'trace' => $t->getTraceAsString()
            ]);

            // Robust fallbacks to prevent 500 errors
            $powerUsage = new \Illuminate\Pagination\LengthAwarePaginator(collect([]), 0, 15);
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
        try {
            $schedules = ElectricitySchedule::paginate(15);
        } catch (\Exception $e) {
            $schedules = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 15);
        }
        return view('government.schedules', compact('schedules'));
    }

    /**
     * View reports and analytics
     */
    public function reports()
    {
        // 1. Farmer & Complaint Stats (MySQL)
        try {
            $totalFarmers = Farmer::count();
            $approvedFarmers = Farmer::where('status', 'approved')->count();
            $pendingFarmers = Farmer::where('status', 'pending')->count();
            $rejectedFarmers = Farmer::where('status', 'rejected')->count();

            $totalComplaints = Complaint::count();
            $pendingComplaints = Complaint::where('status', 'pending')->count();
            $resolvedComplaints = Complaint::where('status', 'resolved')->count();
        } catch (\Exception $e) {
            \Log::error("Gov Reports - Basic Stats Failure: " . $e->getMessage());
            $totalFarmers = 0;
            $approvedFarmers = 0;
            $pendingFarmers = 0;
            $rejectedFarmers = 0;
            $totalComplaints = 0;
            $pendingComplaints = 0;
            $resolvedComplaints = 0;
        }

        // 2. Power Usage Analytics (MongoDB)
        try {
            $totalPowerUsage = (float)(PowerUsage::sum('units_consumed') ?? 0);
            $avgPowerUsage = (float)(PowerUsage::avg('units_consumed') ?: 0);
        } catch (\Exception $e) {
            \Log::error("Gov Reports - Power Analytics Failure: " . $e->getMessage());
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
