<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UwbAnchor extends Model
{
    use HasFactory;

    protected $fillable = [
        'zone_id',
        'device_id',
        'name',
        'position_x',
        'position_y',
        'position_z',
        'status',
        'last_seen_at',
    ];

    protected $casts = [
        'position_x' => 'decimal:3',
        'position_y' => 'decimal:3',
        'position_z' => 'decimal:3',
        'last_seen_at' => 'datetime',
    ];

    /**
     * Zona de la mina donde está instalado el Anchor.
     */
    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }

    /**
     * Posiciones UWB relacionadas con este Anchor.
     */
    public function positions()
    {
        return $this->hasMany(UwbPosition::class);
    }
}