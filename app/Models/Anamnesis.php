<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anamnesis extends Model
{
    use HasFactory;

    protected $fillable = [
        'gastrointestinal_issues',
        'kidney_or_liver_problems',
        'back_shoulder_joint_issues',
        'medications_or_supplements',
        'diabetes',
        'gout',
        'epilepsy',
        'cancer',
        'hypokalemia',
        'prostheses_pacemaker_implants',
        'electro_cardiograph_or_other_instruments',
        'varicose_veins',
        'arrhythmia',
        'skin_conditions',
        'recent_heart_attack',
        'regular_muscle_cramps',
        'anti_depressants',
        'user_id',
        'goal',
        'medical_operations',
        'fysical_complaints',
        'profession',
        'irregular_working_hours',
        'fysical_exercise',
        'hormonal_issues',
        'breastfeeding',
        'pregnant',
    ];

    protected $casts = [
        'electro_cardiograph_or_other_instruments' => 'boolean',
        'varicose_veins' => 'boolean',
        'arrhythmia' => 'boolean',
        'recent_heart_attack' => 'boolean',
        'regular_muscle_cramps' => 'boolean',
        'diabetes' => 'boolean',
        'gout' => 'boolean',
        'epilepsy' => 'boolean',
        'cancer' => 'boolean',
        'hypokalemia' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
