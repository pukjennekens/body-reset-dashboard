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
}
