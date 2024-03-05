<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use Livewire\Attributes\Rule;

class AppointmentForm extends Form
{
    #[Rule('nullable|in:A,B,C,D')]
    public $module;

    #[Rule('nullable')]
    public $cardio;

    #[Rule('nullable')]
    public $notes;
}
