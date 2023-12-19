<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Form;

class NewUserForm extends Form
{
    #[Rule('required')]
    public $name = ''; 

    #[Rule('required|email|unique:users,email')]
    public $email = '';

    #[Rule('required_if:role,user|date')]
    public $birth_date = '';

    #[Rule('required')]
    public $language = '';

    #[Rule('required_if:role,user')]
    public $phone_number = '';

    #[Rule('required_if:role,user')]
    public $street_name = '';

    #[Rule('required_if:role,user')]
    public $house_number = '';

    #[Rule('required_if:role,user')]
    public $postal_code = '';

    #[Rule('required_if:role,user')]
    public $city = '';

    #[Rule('required')]
    public $country = '';

    #[Rule('required_if:role,user')]
    public $province;
 
    #[Rule('required_if:role,user|numeric|exists:users,id')]
    public $trainer_user_id = '';

    #[Rule('required_if:role,user|numeric|exists:branches,id')]
    public $branch_id = '';

    #[Rule('required_if:role,user|in:admin,manager,trainer,user')]
    public $role = 'user';
}
