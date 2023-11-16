<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Form;

class LoginForm extends Form
{
    #[Rule('required|email')]
    public string $email = '';

    #[Rule('required|min:8')]
    public string $password = '';
}
