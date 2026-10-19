<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UwbPosition extends Model
{
    use HasFactory;

    protected $fillable = [
        'worker_id',
        'uwb_tag_id',
        'zone_id',
        'position_x',
        'position_y',
        'position_z',
        'accuracy',
        'position_method',
        'recorded_at',
    ];

    protected $casts = [
        'position_x' => 'decimal:3',
        'position_y' => 'decimal:3',
        'position_z' => 'decimal:3',
        'accuracy' => 'decimal:3',
        'recorded_at' => 'datetime',
    ];

    /**
     * Trabajador al que corresponde esta posición.
     */
    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }

    /**
     * Tag UWB que generó esta posición.
     */
    public function uwbTag()
    {
        return $this->belongsTo(UwbTag::class);
    }

    /**
     * Zona donde se encontraba el trabajador.
     */
    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }
}