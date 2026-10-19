<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;

    protected $fillable = [
    'first_name',
    'last_name',
    'role',
    'shift',
    'document_number',
    'phone',
    'eps',
    'arl',
    'emergency_contact_name',
    'emergency_contact_phone',
    'biometric_token',
    'is_active',
];

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function locations()
    {
        return $this->hasMany(Location::class);
    }
    public function uwbTag()
    {
        return $this->hasOne(UwbTag::class);
    }

    public function uwbPositions()
    {
        return $this->hasMany(UwbPosition::class);
    }
}