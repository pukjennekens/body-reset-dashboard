<?php

namespace App\Livewire\Forms;

use Illuminate\Support\Facades\Log;
use Livewire\Component;
use App\Models\Recipe as RecipeModel;
use LivewireUI\Modal\ModalComponent;

class Recipe extends ModalComponent
{
    public RecipeForm $form;
    public $allergens = array();

    public $allergensOptions = [
        'gluten'         => 'Gluten',
        'crustaceans'    => 'Schaaldieren',
        'eggs'           => 'Eieren',
        'fish'           => 'Vis',
        'peanuts'        => 'Pinda\'s',
        'soybeans'       => 'Soja',
        'milk'           => 'Melk',
        'nuts'           => 'Noten',
        'celery'         => 'Selderij',
        'mustard'        => 'Mosterd',
        'sesame'         => 'Sesam',
        'sulfur_dioxide' => 'Sulfieten',
        'lupin'          => 'Lupines',
        'molluscs'       => 'Weekdieren',
    ];

    public $ingredients = [];
    public $steps       = [];

    public $recipe;

    public function mount($id = null)
    {
        $this->recipe = RecipeModel::find($id);

        Log::debug('Recipe: ', [$this->recipe]);

        if($this->recipe) {
            $this->ingredients = $this->recipe->ingredients;
            $this->steps       = $this->recipe->steps;
        }
    }

    public function createRecipe()
    {
        $this->validate();

        if (empty($this->ingredients)) {
            $this->addError('ingredients', 'Ingrediënten zijn verplicht.');
            return;
        }

        if (empty($this->steps)) {
            $this->addError('steps', 'Stappen zijn verplicht.');
            return;
        }

        // Save the recipe
        if ($this->recipe) {
            $this->recipe->update(array_merge(
                $this->form->toArray(),
                [
                    'allergens'   => $this->allergens,
                    'ingredients' => $this->ingredients,
                    'steps'       => $this->steps,
                    'user_id'     => auth()->user()->id,
                ]
            ));
        } else {
            $this->recipe = RecipeModel::create(array_merge(
                $this->form->toArray(),
                [
                    'allergens'   => $this->allergens,
                    'ingredients' => $this->ingredients,
                    'steps'       => $this->steps,
                    'user_id'     => auth()->user()->id,
                ]
            ));

            $this->form->name             = '';
            $this->form->description      = '';
            $this->form->tips             = '';
            $this->form->meal_type        = 'breakfast';
            $this->form->prepation_time   = '';
            $this->form->number_of_people = '';
            $this->ingredients = [];
            $this->steps       = [];
            $this->allergens   = [];
        }

        $this->closeModal();
        $this->dispatch('recipe-created', id: $this->recipe->id);
    }

    public function render()
    {
        return view('livewire.forms.recipe', [
            'recipe' => $this->recipe ?? new RecipeModel(),
        ]);
    }
}
