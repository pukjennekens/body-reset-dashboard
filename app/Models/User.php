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

        // Credit info
        'credits',
        'credits_expiration_date',

        // Trainer
        'trainer_user_id',

        // Branch
        'branch_id',
        'manager_branches',

        'role',

        'credits_reminder_sent',
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
        'email_verified_at'       => 'datetime',
        'password'                => 'hashed',
        'credits_expiration_date' => 'date',
        'manager_branches'        => 'array',
    ];

    /**
     * Get the body composition measurements for the user.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bodyCompositionMeasurements()
    {
        return $this->hasMany(BodyCompositionMeasurement::class);
    }

    /**
     * Get the girth measurements for the user.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function girthMeasurements()
    {
        return $this->hasMany(GirthMeasurement::class);
    }

    /**
     * Get the most recent body composition measurement for the user.
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function mostRecentBodyCompositionMeasurement()
    {
        return $this->bodyCompositionMeasurements()->orderBy('date', 'desc')->first();
    }

    /**
     * Get the most recent girth measurement for the user.
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function mostRecentGirthMeasurement()
    {
        return $this->girthMeasurements()->orderBy('date', 'desc')->first();
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

    /**
     * Get the users metabolic age
     * @return int|bool The users metabolic age or false if no metabolic age is found
     */
    public function getMetabolicAge()
    {
        $metabolicAge = $this->bodyCompositionMeasurements()->orderBy('date', 'desc')->first();

        if ($metabolicAge) return $metabolicAge->metabolic_age;

        return false;
    }

    /**
     * Get the users visceral fat
     * @return int|bool The users visceral fat or false if no visceral fat is found
     */
    public function getVisceralFat()
    {
        $visceralFat = $this->bodyCompositionMeasurements()->orderBy('date', 'desc')->first();

        if ($visceralFat) return $visceralFat->visceral_fat;

        return false;
    }

    /**
     * Get the users nutrition plans
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function nutritionPlans()
    {
        return $this->hasMany(NutritionPlan::class, 'user_id', 'id');
    }

    /**
     * Get the users credit orders
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function creditOrders()
    {
        return $this->hasMany(CreditOrder::class);
    }

    /**
     * Add credits to the user
     * @param int $credits The amount of credits to add
     * @return void
     */
    public function addCredits(int $credits)
    {
        $this->credits += $credits;
        $this->save();
    }

    /**
     * Get the users anamnesis
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function anamnesis()
    {
        return $this->hasOne(Anamnesis::class, 'user_id', 'id');
    }

    /**
     * Check if the user has a role
     * @param string|string[] $role The role(s) to check
     * @return bool
     */
    public function hasRole($role): bool
    {
        if (is_array($role)) {
            foreach ($role as $r) {
                if ($this->hasRole($r)) return true;
            }
            return false;
        }

        return $this->role === $role;
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }

    public function nextAppointment()
    {
        return $this->appointments()->where('start', '>', now())->orderBy('start', 'asc')->first();
    }

    public function getSubUsers()
    {
        return $this->where('trainer_user_id', $this->id)->orderBy('name')->get();
    }

    /**
     * On delete of the user, delete all related data
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($user) {
            $user->bodyCompositionMeasurements()->delete();
            $user->girthMeasurements()->delete();
            $user->nutritionPlans()->delete();
            $user->creditOrders()->delete();
            $user->anamnesis()->delete();
            $user->appointments()->delete();
        });
    }
}