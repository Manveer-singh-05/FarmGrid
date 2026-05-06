<?php

namespace App\Http\Controllers;

use App\Models\ElectricitySchedule;
use Illuminate\Http\Request;

class ElectricityScheduleController extends Controller
{
    /**
     * Display active schedules
     */
    public function index()
    {
        $schedules = ElectricitySchedule::where('status', 'active')->get();
        return view('schedules.index', compact('schedules'));
    }

    /**
     * Show the form for creating a new schedule (Admin only)
     */
    public function create()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
        return view('admin.create-schedule');
    }

    /**
     * Store a newly created schedule (Admin only)
     */
    public function store(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $validated = $request->validate([
            'zone' => 'required|string|max:100',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'description' => 'nullable|string|max:500',
        ]);

        ElectricitySchedule::create($validated);

        return redirect()->route('admin.schedules')
            ->with('success', 'Schedule created successfully!');
    }

    /**
     * Display the specified schedule
     */
    public function show(string $id)
    {
        $schedule = ElectricitySchedule::findOrFail($id);
        return view('schedules.show', compact('schedule'));
    }

    /**
     * Show the form for editing a schedule (Admin only)
     */
    public function edit(string $id)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $schedule = ElectricitySchedule::findOrFail($id);
        return view('admin.edit-schedule', compact('schedule'));
    }

    /**
     * Update the specified schedule (Admin only)
     */
    public function update(Request $request, string $id)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $schedule = ElectricitySchedule::findOrFail($id);

        $validated = $request->validate([
            'zone' => 'required|string|max:100',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'status' => 'required|in:active,inactive,maintenance',
            'description' => 'nullable|string|max:500',
        ]);

        $schedule->update($validated);

        return back()->with('success', 'Schedule updated successfully!');
    }

    /**
     * Remove the specified schedule (Admin only)
     */
    public function destroy(string $id)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $schedule = ElectricitySchedule::findOrFail($id);
        $schedule->delete();

        return back()->with('success', 'Schedule deleted successfully!');
    }
}
