<?php

namespace App\Models;

use App\Casts\StringToFloatWithCommasCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BodyCompositionMeasurement extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'height',
        'weight',
        'bone_mass',
        'muscle_mass',
        'fat_percentage',
        'water_percentage',
        'metabolic_age',
        'visceral_fat',
    ];

    protected $casts = [
        'date'             => 'date',
        'height'           => StringToFloatWithCommasCast::class,
        'weight'           => StringToFloatWithCommasCast::class,
        'bone_mass'        => StringToFloatWithCommasCast::class,
        'muscle_mass'      => StringToFloatWithCommasCast::class,
        'fat_percentage'   => StringToFloatWithCommasCast::class,
        'water_percentage' => StringToFloatWithCommasCast::class,
        'metabolic_age'    => StringToFloatWithCommasCast::class,
        'visceral_fat'     => StringToFloatWithCommasCast::class,
    ];

    /**
     * Get the user that owns the body composition measurement.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
