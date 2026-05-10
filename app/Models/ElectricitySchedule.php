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
}
