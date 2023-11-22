<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Form;

class NewGirthMeasurementForm extends Form
{
    #[Rule('required|date')]
    public string $date = '';

    #[Rule('required|regex:/^(\d){1,8}([\,](\d){0,2})?$/')]
    public string $chest = '';

    #[Rule('required|regex:/^(\d){1,8}([\,](\d){0,2})?$/')]
    public string $hips = '';

    #[Rule('required|regex:/^(\d){1,8}([\,](\d){0,2})?$/')]
    public string $thigh = '';

    #[Rule('required|regex:/^(\d){1,8}([\,](\d){0,2})?$/')]
    public string $under_breast = '';

    #[Rule('required|regex:/^(\d){1,8}([\,](\d){0,2})?$/')]
    public string $upper_arm = '';

    #[Rule('required|regex:/^(\d){1,8}([\,](\d){0,2})?$/')]
    public string $waist = '';
}
