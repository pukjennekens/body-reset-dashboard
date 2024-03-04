<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Form;

class ResetPasswordForm extends Form
{
    #[Rule('required|email|exists:users,email')]
    public string $email = '';
}
