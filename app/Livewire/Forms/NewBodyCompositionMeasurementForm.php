<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Form;

class NewBodyCompositionMeasurementForm extends Form
{
    #[Rule('required|date')]
    public string $date = '';

    #[Rule('required|regex:/^(\d){1,8}([\,](\d){0,2})?$/')]
    public string $height = '';

    #[Rule('required|regex:/^(\d){1,8}([\,](\d){0,2})?$/')]
    public string $weight = '';

    #[Rule('required|regex:/^(\d){1,8}([\,](\d){0,2})?$/')]
    public string $bone_mass = '';

    #[Rule('required|regex:/^(\d){1,8}([\,](\d){0,2})?$/')]
    public string $muscle_mass = '';

    #[Rule('required|regex:/^(\d){1,8}([\,](\d){0,2})?$/')]
    public string $fat_percentage = '';

    #[Rule('required|regex:/^(\d){1,8}([\,](\d){0,2})?$/')]
    public string $water_percentage = '';

    #[Rule('required|regex:/^(\d){1,8}([\,](\d){0,2})?$/')]
    public string $metabolic_age = '';

    #[Rule('required|regex:/^(\d){1,8}([\,](\d){0,2})?$/')]
    public string $visceral_fat = '';

}
