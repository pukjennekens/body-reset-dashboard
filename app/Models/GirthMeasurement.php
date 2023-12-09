<?php

namespace App\Models;

use App\Casts\StringToFloatWithCommasCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GirthMeasurement extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'chest',
        'hips',
        'thigh',
        'under_breast',
        'upper_arm',
        'waist',
    ];

    protected $casts = [
        'date'         => 'date',
        'chest'        => StringToFloatWithCommasCast::class,
        'hips'         => StringToFloatWithCommasCast::class,
        'thigh'        => StringToFloatWithCommasCast::class,
        'under_breast' => StringToFloatWithCommasCast::class,
        'upper_arm'    => StringToFloatWithCommasCast::class,
        'waist'        => StringToFloatWithCommasCast::class,
    ];

    /**
     * Get the user that owns the girth measurement.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
