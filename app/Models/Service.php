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
    ];

    protected $casts = [
        'price' => StringToFloatWithCommasCast::class,
    ];
}
