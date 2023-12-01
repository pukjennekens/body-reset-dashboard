<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Form;

class BranchForm extends Form
{
    #[Rule('required')]
    public string $name;
    
    #[Rule('required')]
    public string $phone_number;
    
    #[Rule('required')]
    public string $street_name;
    
    #[Rule('required')]
    public string $house_number;
    
    #[Rule('required')]
    public string $postal_code;
    
    #[Rule('required')]
    public string $city;
    
    #[Rule('required|in:nl,be')]
    public string $country;
    
    #[Rule('required')]
    public string $province;
}
