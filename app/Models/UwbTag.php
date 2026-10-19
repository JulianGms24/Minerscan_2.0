<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UwbTag extends Model
{
    use HasFactory;

    protected $fillable = [
        'worker_id',
        'device_id',
        'name',
        'status',
        'battery_level',
        'last_seen_at',
    ];

    protected $casts = [
        'battery_level' => 'integer',
        'last_seen_at' => 'datetime',
    ];

    /**
     * Trabajador al que pertenece este Tag UWB.
     */
    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }

    /**
     * Posiciones registradas por este Tag UWB.
     */
    public function positions()
    {
        return $this->hasMany(UwbPosition::class);
    }
}