<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'tips',
        'meal_type',
        'prepation_time',
        'number_of_people',
        'allergens',
        'ingredients',
        'steps',
    ];

    protected $casts = [
        'allergens'   => 'array',
        'ingredients' => 'array',
        'steps'       => 'array',
    ];

    /**
     * Get the user that owns the recipe.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
