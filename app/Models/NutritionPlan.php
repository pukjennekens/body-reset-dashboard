<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NutritionPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'user_id',
        'creator_user_id',
        'remark',
        'remark_internal',
        'remark_monday',
        'remark_tuesday',
        'remark_wednesday',
        'remark_thursday',
        'remark_friday',
        'remark_saturday',
        'remark_sunday',
        'recipies_monday',
        'recipies_tuesday',
        'recipies_wednesday',
        'recipies_thursday',
        'recipies_friday',
        'recipies_saturday',
        'recipies_sunday',
    ];

    protected $casts = [
        'recipies_monday'    => 'array',
        'recipies_tuesday'   => 'array',
        'recipies_wednesday' => 'array',
        'recipies_thursday'  => 'array',
        'recipies_friday'    => 'array',
        'recipies_saturday'  => 'array',
        'recipies_sunday'    => 'array',
    ];

    /**
     * Get the user that owns the nutrition plan.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    /**
     * Get the user that created the nutrition plan.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_user_id')->withDefault();
    }
}
