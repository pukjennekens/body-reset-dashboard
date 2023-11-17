<?php

namespace App\Models;

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
        'date' => 'date',
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
