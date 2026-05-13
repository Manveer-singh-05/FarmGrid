<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PowerUsage extends Model
{
    protected $connection = 'mongodb';

    protected $fillable = [
        'farmer_id',
        'units_consumed',
        'bill_amount',
        'meter_reading',
        'billing_month',
        'payment_status',
    ];

    protected $casts = [
        'farmer_id' => 'integer',
        'units_consumed' => 'decimal:2',
        'bill_amount' => 'decimal:2',
        'meter_reading' => 'decimal:2',
    ];

    /**
     * Get the farmer that owns the power usage.
     */
    public function farmer(): BelongsTo
    {
        return $this->belongsTo(Farmer::class);
    }

    /**
     * Get peak usage for a farmer
     */
    public static function getPeakUsage($farmerId)
    {
        return self::where('farmer_id', $farmerId)->max('units_consumed');
    }

    /**
     * Get average usage for a farmer
     */
    public static function getAverageUsage($farmerId)
    {
        return self::where('farmer_id', $farmerId)->avg('units_consumed');
    }
}
