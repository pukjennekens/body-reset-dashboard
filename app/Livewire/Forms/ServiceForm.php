<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Form;

class ServiceForm extends Form
{
    #[Rule('required|unique:services,name,{{service?->id}}')]
    public string $name;
    
    #[Rule('required|numeric|min:1')]
    public int $appointment_duration_minutes;
    
    #[Rule('required|numeric|min:1')]
    public int $appointment_overlap_minutes;
    
    #[Rule('required|regex:/^(\d){1,8}([\,](\d){0,2})?$/')]
    public $price;
}
