<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Form;

class NewUserForm extends Form
{
    #[Rule('required')]
    public $name = ''; // 

    #[Rule('required|email')]
    public $email = ''; //

    #[Rule('required|date')]
    public $birth_date = ''; //

    #[Rule('required')]
    public $language = ''; //

    #[Rule('required')]
    public $phone_number = ''; //

    #[Rule('required')]
    public $street_name = ''; //

    #[Rule('required')]
    public $house_number = ''; //

    #[Rule('required')]
    public $postal_code = ''; //

    #[Rule('required')]
    public $city = ''; //

    #[Rule('required')]
    public $country = ''; // 

    #[Rule('required')]
    public $province; //
 
    #[Rule('required|numeric|exists:users,id')]
    public $trainer_user_id = '';

    #[Rule('required|numeric|exists:branches,id')]
    public $branch_id = '';

    #[Rule('required|numeric|in:admin,manager,trainer,user')]
    public $role = '';
}
