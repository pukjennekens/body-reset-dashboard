<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Form;

class NewCreditOptionForm extends Form
{
    #[Rule('required')]
    public string $name;
    
    #[Rule('required|regex:/^(\d){1,8}([\,](\d){0,2})?$/')]
    public string $price;
    
    #[Rule('required|integer')]
    public string $expiration_days;
    
    #[Rule('required|integer')]
    public string $credits;
    
    public string $is_active;
    
    #[Rule('required|integer')]
    public string $sort_order;
}
