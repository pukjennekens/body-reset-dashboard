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
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function creditOption()
    {
        return $this->belongsTo(CreditOption::class);
    }
}
