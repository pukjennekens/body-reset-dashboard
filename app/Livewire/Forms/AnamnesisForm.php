<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Form;

class AnamnesisForm extends Form
{
    #[Rule('nullable|string|max:255')]
    public $gastrointestinal_issues;

    #[Rule('nullable|string|max:255')]
    public $kidney_or_liver_problems;

    #[Rule('nullable|string|max:255')]
    public $back_shoulder_joint_issues;

    #[Rule('nullable|string|max:255')]
    public $prostheses_pacemaker_implants;

    #[Rule('nullable|string|max:255')]
    public $skin_conditions;

    #[Rule('nullable|string|max:255')]
    public $anti_depressants;

    #[Rule('nullable|string|max:255')]
    public $medications_or_supplements;

    #[Rule('nullable|boolean')]
    public $electro_cardiograph_or_other_instruments;

    #[Rule('nullable|boolean')]
    public $varicose_veins;

    #[Rule('nullable|boolean')]
    public $arrhythmia;

    #[Rule('nullable|boolean')]
    public $recent_heart_attack;

    #[Rule('nullable|boolean')]
    public $regular_muscle_cramps;

    #[Rule('nullable|boolean')]
    public $diabetes;

    #[Rule('nullable|boolean')]
    public $gout;

    #[Rule('nullable|boolean')]
    public $epilepsy;

    #[Rule('nullable|boolean')]
    public $cancer;

    #[Rule('nullable|boolean')]
    public $hypokalemia;

    #[Rule('nullable|string|max:255')]
    public $goal;

    #[Rule('nullable|string|max:255')]
    public $medical_operations;

    #[Rule('nullable|string|max:255')]
    public $fysical_complaints;

    #[Rule('nullable|string|max:255')]
    public $profession;

    #[Rule('nullable|string|max:255')]
    public $irregular_working_hours;

    #[Rule('nullable|string|max:255')]
    public $fysical_exercise;

    #[Rule('nullable|string|max:255')]
    public $hormonal_issues;

    #[Rule('nullable|string|max:255')]
    public $breastfeeding;

    #[Rule('nullable|string|max:255')]
    public $pregnant;
}