<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Form;

class RecipeForm extends Form
{
    #[Rule('required')]
    public string $name;

    #[Rule('required')]
    public string $description;

    #[Rule('required')]
    public string $tips;

    #[Rule('required|in:breakfast,lunch,dinner,snack')]
    public string $meal_type;

    #[Rule('required|numeric')]
    public string $prepation_time;

    #[Rule('required|numeric')]
    public string $number_of_people;
}
