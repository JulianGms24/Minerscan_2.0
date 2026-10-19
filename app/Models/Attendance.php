<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'worker_id',
        'zone_id',
        'check_in',
        'check_out',
        'status',
        'verification_method',
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