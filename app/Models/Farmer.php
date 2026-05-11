<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use MongoDB\Laravel\Eloquent\HybridRelations;

class Farmer extends Model
{
    use HybridRelations;

    protected $fillable = [
        'user_id',
        'village',
        'land_area',
        'connection_no',
        'status',
    ];

    protected $casts = [
        'land_area' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function complaints(): HasMany
    {
        return $this->hasMany(Complaint::class);
    }

    public function powerUsages(): HasMany
    {
        return $this->hasMany(PowerUsage::class);
    }

    public function schedules(): HasMany
    {
        return $this->hasMany(ElectricitySchedule::class);
    }
}
