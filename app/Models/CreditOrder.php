<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'credit_option_id',
        'payment_method',
        'status',
        'order_description',
        'currency',
        'price',
        'payment_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function creditOption()
    {
        return $this->belongsTo(CreditOption::class);
    }

    public function getStatusAttribute($value)
    {
        switch($value) {
            case 'open': $value = 'Open'; break;
            case 'canceled': $value = 'Geannuleerd'; break;
            case 'pending': $value = 'In afwachting'; break;
            case 'authorized': $value = 'Geautoriseerd'; break;
            case 'expired': $value = 'Verlopen'; break;
            case 'failed': $value = 'Mislukt'; break;
            case 'paid': $value = 'Betaald'; break;
        }

        if(!$value) $value = 'Nog niet bekend';

        return $value;
    }
}
