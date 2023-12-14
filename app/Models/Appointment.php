<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    public $fillable = [
        'branch_id',
        'service_id',
        'user_id',
        'start',
        'end',
    ];

    protected $casts = [
        'start' => 'datetime',
        'end'   => 'datetime',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeBetween($query, $start, $end)
    {
        return $query
            ->where('start', '>=', $start)
            ->where('end', '<=', $end);
    }
}
