<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Form;

class NewBodyCompositionMeasurementForm extends Form
{
    #[Rule('required|date')]
    public string $date = '';

    #[Rule('required|numeric')]
    public string $height = '';

    #[Rule('required|numeric')]
    public string $weight = '';

    #[Rule('required|numeric')]
    public string $bone_mass = '';

    #[Rule('required|numeric')]
    public string $muscle_mass = '';

    #[Rule('required|numeric')]
    public string $fat_percentage = '';

    #[Rule('required')]
    public string $water_percentage = '';

    #[Rule('required|numeric')]
    public string $metabolic_age = '';

    #[Rule('required|numeric')]
    public string $visceral_fat = '';

}
