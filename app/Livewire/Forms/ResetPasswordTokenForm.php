<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Form;

class ResetPasswordTokenForm extends Form
{
    #[Rule('required|email')]
    public string $email = '';

    #[Rule('required|min:8|confirmed')]
    public string $password = '';

    #[Rule('required|min:8')]
    public string $password_confirmation = '';

    #[Rule('required')]
    public string $token = '';
}
