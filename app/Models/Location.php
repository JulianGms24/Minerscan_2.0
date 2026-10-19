<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'worker_id',
        'zone_id',
        'latitude',
        'longitude',
        'accuracy',
        'is_inside_geofence',
        'recorded_at',
    ];

    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }

    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }
}