<?php

namespace App\Livewire;

use App\Livewire\Forms\NutritionPlan;
use App\Models\Recipe;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class DeleteRecipe extends ModalComponent
{
    public Recipe $recipe;

    public function mount($id = null)
    {
        $this->recipe = Recipe::find($id);
    }

    public function cancel()
    {
        $this->closeModal();
    }

    public function deleteRecipe()
    {
        $nutritionPlans = DB::table('nutrition_plans')
            ->whereRaw('JSON_CONTAINS(recipies_monday, ?)', [json_encode(['recipeId' => (string)$this->recipe->id])])
            ->orWhereRaw('JSON_CONTAINS(recipies_tuesday, ?)', [json_encode(['recipeId' => (string)$this->recipe->id])])
            ->orWhereRaw('JSON_CONTAINS(recipies_wednesday, ?)', [json_encode(['recipeId' => (string)$this->recipe->id])])
            ->orWhereRaw('JSON_CONTAINS(recipies_thursday, ?)', [json_encode(['recipeId' => (string)$this->recipe->id])])
            ->orWhereRaw('JSON_CONTAINS(recipies_friday, ?)', [json_encode(['recipeId' => (string)$this->recipe->id])])
            ->orWhereRaw('JSON_CONTAINS(recipies_saturday, ?)', [json_encode(['recipeId' => (string)$this->recipe->id])])
            ->orWhereRaw('JSON_CONTAINS(recipies_sunday, ?)', [json_encode(['recipeId' => (string)$this->recipe->id])])
            ->get();

        if (count($nutritionPlans) > 0) {
            $this->addError('deletion', 'Dit recept wordt gebruikt in een of meerdere voedingsschema\'s en kan daarom niet verwijderd worden.');
            return;
        }

        $this->recipe->delete();
        $this->dispatch('recipe-deleted');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.delete-recipe');
    }
}
