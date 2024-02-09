<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class RegistrationForm extends Form
{
    public $name;
    public $email;
    public $phone;
    public $birthday;
    public $language;
    public $street;
    public $house_number;
    public $postal_code;
    public $city;
    public $country;
    public $branch_id;
    public $goal;
    public $medical_operations;
    public $medications_or_supplements;
    public $fysical_complaints;
}
