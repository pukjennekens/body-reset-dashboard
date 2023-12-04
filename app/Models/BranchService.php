<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class BranchService extends Pivot
{
    protected $table = 'branch_service';

    protected $fillable = [
        'branch_id',
        'service_id',

        'opening_hours_monday',
        'opening_hours_tuesday',
        'opening_hours_wednesday',
        'opening_hours_thursday',
        'opening_hours_friday',
        'opening_hours_saturday',
        'opening_hours_sunday',
        'opening_hours_holiday',
    ];

    protected $casts = [
        'opening_hours_monday'    => 'array',
        'opening_hours_tuesday'   => 'array',
        'opening_hours_wednesday' => 'array',
        'opening_hours_thursday'  => 'array',
        'opening_hours_friday'    => 'array',
        'opening_hours_saturday'  => 'array',
        'opening_hours_sunday'    => 'array',
        'opening_hours_holiday'   => 'array',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}