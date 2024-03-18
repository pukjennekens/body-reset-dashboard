<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class ProfileForm extends Form
{
    #[Validate('required|string|max:255')]
    public $name = '';

    #[Validate('required|string|max:255|email')]
    public $email = '';

    #[Validate('required|string|max:255')]
    public $phone_number = '';

    #[Validate('required|date')]
    public $birth_date = '';

    #[Validate('required|string|in:nl,en,fr')]
    public $language = '';
}
