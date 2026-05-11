<?php

namespace App\Http\Controllers;

use App\Models\Farmer;
use App\Models\ElectricitySchedule;
use App\Models\Complaint;
use App\Models\PowerUsage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FarmerController extends Controller
{
    /**
     * Show farmer dashboard
     */
    public function dashboard(Request $request)
    {
        $connections = Auth::user()->farmers;
        
        if ($connections->isEmpty()) {
            return redirect()->route('farmer.apply');
        }

        // Determine active connection
        $connectionId = $request->get('connection_id');
        $farmer = $connectionId 
            ? $connections->firstWhere('id', $connectionId) 
            : $connections->first();

        if (!$farmer) {
            $farmer = $connections->first();
        }

        $connectionIds = $connections->pluck('id')->toArray();
        $villages = $connections->pluck('village')->unique()->toArray();

        // Fetch schedules matching either the farmer_id OR the village zone for ANY owned connection
        // Using a more robust query for zone matching (case-insensitive and trimmed)
        $schedules = ElectricitySchedule::with('farmer')
            ->where(function($query) use ($connectionIds, $villages) {
                $query->whereIn('farmer_id', $connectionIds);
                foreach ($villages as $village) {
                    $query->orWhere('zone', 'LIKE', trim($village));
                }
            })
            ->latest()
            ->get();

        // Aggregate data for status cards (all connections)
        $allComplaints = Complaint::whereIn('farmer_id', $connectionIds)->latest()->get();
        $allPowerUsages = PowerUsage::whereIn('farmer_id', $connectionIds)->latest()->get();

        // For specific list views, we still respect the selected connection
        $complaints = $farmer->complaints()->latest()->get();
        $powerUsage = $farmer->powerUsages()->latest()->first();

        // --- POWER USAGE ANALYTICS ---

        // 1. Chart Data: Monthly (Last 6 Months)
        $monthlyUsage = PowerUsage::whereIn('farmer_id', $connectionIds)
            ->selectRaw('SUM(units_consumed) as total, billing_month')
            ->groupBy('billing_month')
            ->limit(6)
            ->get();

        // 2. Chart Data: Weekly (Last 4 Weeks)
        $weeklyUsage = PowerUsage::whereIn('farmer_id', $connectionIds)
            ->selectRaw("SUM(units_consumed) as total, strftime('%W', created_at) as week_no")
            ->groupBy('week_no')
            ->orderBy('week_no', 'DESC')
            ->limit(4)
            ->get()
            ->reverse();

        // 3. Chart Data: Daily (Last 7 Days)
        $dailyUsage = PowerUsage::whereIn('farmer_id', $connectionIds)
            ->selectRaw("SUM(units_consumed) as total, strftime('%Y-%m-%d', created_at) as date")
            ->groupBy('date')
            ->orderBy('date', 'DESC')
            ->limit(7)
            ->get()
            ->reverse();

        // 4. Usage Insights
        $currentMonth = now()->format('F Y');
        $lastMonth = now()->subMonth()->format('F Y');
        
        $currentMonthUsage = PowerUsage::whereIn('farmer_id', $connectionIds)
            ->where('billing_month', 'LIKE', '%' . now()->format('M') . '%')
            ->sum('units_consumed');
            
        $lastMonthUsage = PowerUsage::whereIn('farmer_id', $connectionIds)
            ->where('billing_month', 'LIKE', '%' . now()->subMonth()->format('M') . '%')
            ->sum('units_consumed');

        $usageChange = 0;
        if ($lastMonthUsage > 0) {
            $usageChange = (($currentMonthUsage - $lastMonthUsage) / $lastMonthUsage) * 100;
        }

        // 5. Analytics Cards
        $peakUsageValue = PowerUsage::whereIn('farmer_id', $connectionIds)->max('units_consumed') ?: 0;
        $avgUsageValue = PowerUsage::whereIn('farmer_id', $connectionIds)->avg('units_consumed') ?: 0;
        $totalUnits = PowerUsage::whereIn('farmer_id', $connectionIds)->sum('units_consumed');
        $carbonSaved = $totalUnits * 0.45; // 0.45kg CO2 saved per unit optimized

        // 6. AI Insights Logic
        $aiInsight = "Your usage is stable. Consider shifting heavy loads to off-peak hours for further savings.";
        if ($usageChange > 10) {
            $aiInsight = "Alert: Your usage increased by " . round($usageChange) . "% this month. We recommend auditing your irrigation pumps.";
        } elseif ($peakUsageValue > 100) {
            $aiInsight = "Peak usage detected. Shifting operations to 10 PM - 6 AM could reduce your bill by ~15%.";
        }

        return view('farmer.dashboard', compact(
            'farmer', 
            'connections',
            'schedules', 
            'complaints', 
            'allComplaints',
            'powerUsage',
            'monthlyUsage',
            'weeklyUsage',
            'dailyUsage',
            'currentMonthUsage',
            'lastMonthUsage',
            'usageChange',
            'peakUsageValue',
            'avgUsageValue',
            'totalUnits',
            'carbonSaved',
            'aiInsight'
        ));
    }

    /**
     * Show application form
     */
    public function create()
    {
        return view('farmer.apply');
    }

    /**
     * Store farmer application
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'village' => 'required|string',
            'land_area' => 'required|numeric|min:0.1',
            'connection_no' => 'required|unique:farmers,connection_no',
        ]);

        Farmer::create([
            'user_id' => Auth::id(),
            'village' => $validated['village'],
            'land_area' => $validated['land_area'],
            'connection_no' => $validated['connection_no'],
            'status' => 'pending',
        ]);

        return redirect()->route('farmer.dashboard')
            ->with('success', 'Application submitted successfully!');
    }

    /**
     * View electricity schedules
     */
    public function index(Request $request)
    {
        $connections = Auth::user()->farmers;
        if ($connections->isEmpty()) {
            return redirect()->route('farmer.apply');
        }

        $connectionIds = $connections->pluck('id')->toArray();
        $villages = $connections->pluck('village')->unique()->toArray();

        // Fetch schedules matching either the farmer_id OR the village zone
        $schedules = ElectricitySchedule::with('farmer')
            ->where(function($query) use ($connectionIds, $villages) {
                $query->whereIn('farmer_id', $connectionIds);
                foreach ($villages as $village) {
                    $query->orWhere('zone', 'LIKE', trim($village));
                }
            })
            ->latest()
            ->get();
        
        // Pick active connection for UI labels, but show all schedules
        $connectionId = $request->get('connection_id');
        $farmer = $connectionId 
            ? $connections->firstWhere('id', $connectionId) 
            : $connections->first();

        return view('farmer.schedules', compact('schedules', 'connections', 'farmer'));
    }

    /**
     * View complaints
     */
    public function show(string $id)
    {
        $connectionIds = Auth::user()->farmers->pluck('id')->toArray();
        $complaint = Complaint::whereIn('farmer_id', $connectionIds)->findOrFail($id);
        return view('farmer.complaint-detail', compact('complaint'));
    }

    /**
     * View power usage
     */
    public function usage(Request $request)
    {
        $connections = Auth::user()->farmers;
        if ($connections->isEmpty()) {
            return redirect()->route('farmer.apply');
        }

        $connectionId = $request->get('connection_id');
        $farmer = $connectionId 
            ? $connections->firstWhere('id', $connectionId) 
            : $connections->first();

        $usages = $farmer->powerUsages()->latest()->get();
        return view('farmer.usage', compact('usages', 'connections', 'farmer'));
    }

    /**
     * Update profile
     */
    public function updateProfile(Request $request)
    {
        $farmer = Auth::user()->farmers->first();
        if (!$farmer) return back()->with('error', 'No connection found.');

        $validated = $request->validate([
            'village' => 'required|string',
            'land_area' => 'required|numeric|min:0.1',
        ]);

        $farmer->update($validated);

        return back()->with('success', 'Profile updated successfully!');
    }

    /**
     * Update profile
     */
    public function update(Request $request, string $id)
    {
        $farmer = Auth::user()->farmers()->findOrFail($id);

        $validated = $request->validate([
            'village' => 'required|string',
            'land_area' => 'required|numeric|min:0.1',
        ]);

        $farmer->update($validated);

        return back()->with('success', 'Profile updated successfully!');
    }

    /**
     * Remove the specified resource.
     */
    public function destroy(string $id)
    {
        //
    }
}
