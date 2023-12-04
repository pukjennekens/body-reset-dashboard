<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone_number',
        'street_name',
        'house_number',
        'postal_code',
        'city',
        'country',
        'province',
    ];

    /**
     * Get the country name.
     * @return string
     */
    public function getCountry(): string
    {
        return match ($this->country) {
            'nl'    => 'Nederland',
            'be'    => 'België',
            default => 'Onbekend',
        };
    }

    /**
     * Get the services for the branch.
     */
    public function services()
    {
        return $this->belongsToMany(Service::class);
    }
}
