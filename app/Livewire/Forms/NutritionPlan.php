<?php

namespace App\Livewire\Forms;

use LivewireUI\Modal\ModalComponent;
use App\Models\NutritionPlan as NutritionPlanModel;
use App\Models\Recipe;
use Illuminate\Support\Facades\Log;

use function Ramsey\Uuid\v1;

class NutritionPlan extends ModalComponent
{
    public NutritionPlanForm $form;

    public $nutritionPlan = null;

    public $recipies_monday    = [];
    public $recipies_tuesday   = [];
    public $recipies_wednesday = [];
    public $recipies_thursday  = [];
    public $recipies_friday    = [];
    public $recipies_saturday  = [];
    public $recipies_sunday    = [];

    public $recipies = [];

    public $userId = null;

    public function mount($id = null, $userId = null)
    {
        if(!$id && !$userId) {
            throw new \Exception('You must provide either an id or a userId');
        }

        $this->nutritionPlan = NutritionPlanModel::find($id) ?? new NutritionPlanModel();

        $this->recipies_monday    = $this->nutritionPlan->recipies_monday    ?: [];
        $this->recipies_tuesday   = $this->nutritionPlan->recipies_tuesday   ?: [];
        $this->recipies_wednesday = $this->nutritionPlan->recipies_wednesday ?: [];
        $this->recipies_thursday  = $this->nutritionPlan->recipies_thursday  ?: [];
        $this->recipies_friday    = $this->nutritionPlan->recipies_friday    ?: [];
        $this->recipies_saturday  = $this->nutritionPlan->recipies_saturday  ?: [];
        $this->recipies_sunday    = $this->nutritionPlan->recipies_sunday    ?: [];

        $recipies = Recipe::all();
        foreach ($recipies as $recipe) {
            $this->recipies[$recipe->id] = '[' . $recipe->meal_type . ']' . ' ' . $recipe->name;
        }

        $this->userId = $userId;
    }

    public function createNutritionPlan()
    {
        $this->validate();

        if ($this->nutritionPlan->id) {
            $this->nutritionPlan->update(array_merge(
                $this->form->toArray(),
                [
                    'recipies_monday'    => $this->recipies_monday,
                    'recipies_tuesday'   => $this->recipies_tuesday,
                    'recipies_wednesday' => $this->recipies_wednesday,
                    'recipies_thursday'  => $this->recipies_thursday,
                    'recipies_friday'    => $this->recipies_friday,
                    'recipies_saturday'  => $this->recipies_saturday,
                    'recipies_sunday'    => $this->recipies_sunday,
                    'creator_user_id'    => auth()->user()->id,
                    'user_id'            => $this->userId,
                ]
            ));
        } else {
            $this->nutritionPlan = NutritionPlanModel::create(array_merge(
                $this->form->toArray(),
                [
                    'recipies_monday'    => $this->recipies_monday,
                    'recipies_tuesday'   => $this->recipies_tuesday,
                    'recipies_wednesday' => $this->recipies_wednesday,
                    'recipies_thursday'  => $this->recipies_thursday,
                    'recipies_friday'    => $this->recipies_friday,
                    'recipies_saturday'  => $this->recipies_saturday,
                    'recipies_sunday'    => $this->recipies_sunday,
                    'creator_user_id'    => auth()->user()->id,
                    'user_id'            => $this->userId,
                ]
            ));
        }

        $this->dispatch('nutrition-plan-created', userId: auth()->user()->id);
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.forms.nutrition-plan');
    }
}
