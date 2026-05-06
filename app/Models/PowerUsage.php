<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PowerUsage extends Model
{
    protected $fillable = [
        'farmer_id',
        'units_used',
        'bill_amount',
        'month',
        'year',
    ];

    protected $casts = [
        'units_used' => 'decimal:2',
        'bill_amount' => 'decimal:2',
    ];

    public function farmer(): BelongsTo
    {
        return $this->belongsTo(Farmer::class);
    }
}
