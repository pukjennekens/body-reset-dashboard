<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Form;

class NewGirthMeasurementForm extends Form
{
    #[Rule('required|date')]
    public string $date = '';

    #[Rule('required')]
    public string $chest = '';

    #[Rule('required')]
    public string $hips = '';

    #[Rule('required')]
    public string $thigh = '';

    #[Rule('required')]
    public string $under_breast = '';

    #[Rule('required')]
    public string $upper_arm = '';

    #[Rule('required')]
    public string $waist = '';
}
