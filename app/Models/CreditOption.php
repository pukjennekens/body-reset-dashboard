<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'expiration_days',
        'credits',
        'is_active',
        'sort_order',
    ];

    public function orders()
    {
        return $this->hasMany(CreditOrder::class);
    }

    public function validityPeriodString()
    {
        $before = 'Deze credits zijn ';
        $after  = ' geldig.';

        $months = floor($this->expiration_days / 30);
        $days   = $this->expiration_days % 30;

        $monthsString = $months > 0 ? $months . ' ' . ($months > 1 ? 'maanden' : 'maand') : '';
        $daysString   = $days > 0 ? $days . ' ' . ($days > 1 ? 'dagen' : 'dag') : '';

        if ($monthsString && $daysString) {
            return $before . $monthsString . ' en ' . $daysString . $after;
        }

        return $before . $monthsString . $daysString . $after;
    }
}
