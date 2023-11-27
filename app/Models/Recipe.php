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
        'user_id',
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

    /**
     * Get the meal type
     * @return string
     */
    public function getMealTypeAttribute($value)
    {
        if($value == 'breakfast') {
            return 'Ontbijt';
        } elseif($value == 'lunch') {
            return 'Lunch';
        } elseif($value == 'dinner') {
            return 'Diner';
        } elseif($value == 'snack') {
            return 'Snack';
        } else {
            return 'Onbekend';
        }
    }
}
