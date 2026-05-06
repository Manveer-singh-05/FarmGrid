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
    public function dashboard()
    {
        $farmer = Auth::user()->farmer;
        if (!$farmer) {
            return redirect()->route('farmer.apply');
        }

        $schedules = ElectricitySchedule::all();
        $complaints = $farmer->complaints()->latest()->get();
        $powerUsage = $farmer->powerUsages()->latest()->first();

        return view('farmer.dashboard', compact('farmer', 'schedules', 'complaints', 'powerUsage'));
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
    public function index()
    {
        $schedules = ElectricitySchedule::where('status', 'active')->get();
        return view('farmer.schedules', compact('schedules'));
    }

    /**
     * View complaints
     */
    public function show(string $id)
    {
        $farmer = Auth::user()->farmer;
        $complaint = $farmer->complaints()->findOrFail($id);
        return view('farmer.complaint-detail', compact('complaint'));
    }

    /**
     * View power usage
     */
    public function usage()
    {
        $farmer = Auth::user()->farmer;
        if (!$farmer) {
            return redirect()->route('farmer.apply');
        }

        $usages = $farmer->powerUsages()->latest()->get();
        return view('farmer.usage', compact('usages'));
    }

    /**
     * Update profile
     */
    public function updateProfile(Request $request)
    {
        $farmer = Auth::user()->farmer;

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
        $farmer = Auth::user()->farmer;

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
