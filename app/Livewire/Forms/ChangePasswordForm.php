<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class ChangePasswordForm extends Form
{
    #[Validate('required|current_password')]
    public $old_password;

    #[Validate('required')]
    public $password;

    #[Validate('required|same:password')]
    public $password_confirmation;
}
