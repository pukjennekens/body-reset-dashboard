<?php

namespace App\Models;

use App\Casts\StringToFloatWithCommasCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'appointment_duration_minutes',
        'appointment_overlap_minutes',
        'price',
        'hidden',
    ];

    protected $casts = [
        'price' => StringToFloatWithCommasCast::class,
    ];

    /**
     * Get the branches for the service.
     */
    public function branches()
    {
        return $this->belongsToMany(Branch::class);
    }

    /**
     * Get the appointments for the service.
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
