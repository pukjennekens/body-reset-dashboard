<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Form;

class UserPersonalInfoForm extends Form
{
    #[Rule('required')]
    public string $name = '';

    #[Rule('required|email')]
    public string $email = '';

    #[Rule('required|date')]
    public string $birth_date = '';

    #[Rule('required|in:nl,en,fr')]
    public string $language = '';

    #[Rule('required')]
    public string $phone_number = '';

    #[Rule('required')]
    public string $street_name = '';

    #[Rule('required')]
    public string $house_number = '';

    #[Rule('required')]
    public string $postal_code = '';

    #[Rule('required')]
    public string $city = '';

    #[Rule('required|in:nl,be')]
    public string $country = '';

    #[Rule('required')]
    public string $province = '';

    #[Rule('required|numeric')]
    public string $credits = '';

    #[Rule('date|nullable')]
    public string $credits_expiration_date = '';
}
