<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'latitude',
        'longitude',
        'position_x',
        'position_y',
        'position_z',
        'radius_meters',
    ];

    protected $casts = [
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'position_x' => 'decimal:3',
        'position_y' => 'decimal:3',
        'position_z' => 'decimal:3',
        'radius_meters' => 'integer',
    ];

    /**
     * Asistencias registradas en esta zona.
     */
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    /**
     * Ubicaciones de la estructura anterior GPS.
     */
    public function locations()
    {
        return $this->hasMany(Location::class);
    }

    /**
     * Anchors UWB instalados en esta zona.
     */
    public function uwbAnchors()
    {
        return $this->hasMany(UwbAnchor::class);
    }

    /**
     * Posiciones UWB registradas en esta zona.
     */
    public function uwbPositions()
    {
        return $this->hasMany(UwbPosition::class);
    }
}