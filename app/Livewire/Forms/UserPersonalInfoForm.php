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

    #[Rule('required_if:role,user|date')]
    public string $birth_date = '';

    #[Rule('required|in:nl,en,fr')]
    public string $language = '';

    #[Rule('required_if:role,user')]
    public string $phone_number = '';

    #[Rule('required_if:role,user')]
    public string $street_name = '';

    #[Rule('required_if:role,user')]
    public string $house_number = '';

    #[Rule('required_if:role,user')]
    public string $postal_code = '';

    #[Rule('required_if:role,user')]
    public string $city = '';

    #[Rule('required|in:nl,be')]
    public string $country = '';

    #[Rule('required_if:role,user')]
    public string $province = '';

    #[Rule('required_if:role,user|numeric')]
    public string $credits = '';

    #[Rule('date|required_if:role,user')]
    public string $credits_expiration_date = '';

    #[Rule('required_if:role,user|exists:users,id')]
    public $trainer_user_id = '';

    #[Rule('required_if:role,user|exists:branches,id')]
    public $branch_id = '';

    #[Rule('required_if:role,user|numeric|in:admin,manager,trainer,user')]
    public $role = '';
}
