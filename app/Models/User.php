<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Notifications\ResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',

        // Personal info
        'birth_date',
        'language',
        'phone_number',
        'street_name',
        'house_number',
        'postal_code',
        'city',
        'country',
        'province',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the body composition measurements for the user.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bodyCompositionMeasurements()
    {
        return $this->hasMany(BodyCompositionMeasurement::class)->orderBy('date', 'asc');
    }

    /**
     * Get the girth measurements for the user.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function girthMeasurements()
    {
        return $this->hasMany(GirthMeasurement::class)->orderBy('date', 'asc');
    }

    /**
     * Get the users weight
     * @return float|bool The users weight or false if no weight is found
     */
    public function getWeight()
    {
        $weight = $this->bodyCompositionMeasurements()->orderBy('date', 'desc')->first();

        if ($weight) return $weight->weight;

        return false;
    }

    /**
     * Get the users height
     * @return float|bool The users height or false if no height is found
     */
    public function getLength()
    {
        $height = $this->bodyCompositionMeasurements()->orderBy('date', 'desc')->first();

        if ($height) return $height->height;

        return false;
    }
}
