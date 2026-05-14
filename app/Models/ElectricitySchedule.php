<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ElectricitySchedule extends Model
{
    protected $fillable = [
        'farmer_id',
        'zone',
        'start_time',
        'end_time',
        'day_of_week',
        'allocation_percentage',
        'status',
        'description',
    ];

    protected $casts = [
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
    ];

    public function farmer()
    {
        return $this->belongsTo(Farmer::class);
    }

    /**
     * Check if the schedule is currently active based on system time and day.
     */
    public function getIsCurrentlyActiveAttribute(): bool
    {
        if (($this->status ?? '') !== 'active') return false;
        /*  if ($this->status !== 'active') return false;*/
        $now = now();
        
        // Day of week check
        if ($this->day_of_week && $this->day_of_week !== 'Daily') {
            $today = $now->format('l');
            if ($this->day_of_week === 'Weekdays' && in_array($today, ['Saturday', 'Sunday'])) return false;
            if ($this->day_of_week === 'Weekends' && !in_array($today, ['Saturday', 'Sunday'])) return false;
            if (!in_array($this->day_of_week, ['Daily', 'Weekdays', 'Weekends']) && $this->day_of_week !== $today) return false;
        }

        try {
            $rawStart = $this->getRawOriginal('start_time');
            $rawEnd = $this->getRawOriginal('end_time');
            
            if (!$rawStart || !$rawEnd) return false;

            // Use setTimeFromTimeString to safely normalize time-only strings to today's date in app timezone
            // This avoids issues with Carbon::parse() defaulting to different dates or timezones
            $start = $now->copy()->setTimeFromTimeString($rawStart);
            $end = $now->copy()->setTimeFromTimeString($rawEnd);

            // Handle overnight schedules (e.g., 22:00 to 02:00)
            if ($end->lt($start)) {
                if ($now->lt($start)) {
                    $start->subDay();
                } else {
                    $end->addDay();
                }
            }

            return $now->between($start, $end);
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Get the dynamic status of the schedule.
     */
    public function getDynamicStatusAttribute(): string
    {
        if ($this->status === 'maintenance') return 'maintenance';
        if ($this->status === 'inactive') return 'inactive';

        if ($this->is_currently_active) return 'active';

        $now = now();
        
        try {
            $rawStart = $this->getRawOriginal('start_time');
            if (!$rawStart) return 'inactive';

            $start = $now->copy()->setTimeFromTimeString($rawStart);
            
            // Basic upcoming check
            if ($now->lt($start)) {
                 // Check if it's for today
                 if ($this->day_of_week && $this->day_of_week !== 'Daily') {
                    $today = $now->format('l');
                    if ($this->day_of_week === 'Weekdays' && in_array($today, ['Saturday', 'Sunday'])) return 'inactive';
                    if ($this->day_of_week === 'Weekends' && !in_array($today, ['Saturday', 'Sunday'])) return 'inactive';
                    if (!in_array($this->day_of_week, ['Daily', 'Weekdays', 'Weekends']) && $this->day_of_week !== $today) return 'inactive';
                }
                return 'upcoming';
            }
        } catch (\Exception $e) {
            return 'inactive';
        }

        return 'completed';
    }
}
