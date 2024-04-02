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
        'hidden',
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

    /**
     * Get the appointments for the branch.
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    /**
     * Scope a query to only include non-hidden branches.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNotHidden($query)
    {
        return $query->where('hidden', false);
    }
}
