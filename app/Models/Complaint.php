<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Complaint extends Model
{
    protected $fillable = [
        'farmer_id',
        'issue_type',
        'description',
        'status',
        'admin_notes',
    ];

    public function farmer(): BelongsTo
    {
        return $this->belongsTo(Farmer::class);
    }

    /**
     * Get the user associated with this complaint (through farmer).
     * Enables eager loading: Complaint::with(['farmer.user']) or with(['user'])
     */
    public function user(): HasOneThrough
    {
        return $this->hasOneThrough(
            User::class,
            Farmer::class,
            'id',       // farmers.id
            'id',       // users.id
            'farmer_id',// complaints.farmer_id
            'user_id'   // farmers.user_id
        );
    }
}
