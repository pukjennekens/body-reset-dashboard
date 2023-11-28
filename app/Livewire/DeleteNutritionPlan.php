<?php

namespace App\Livewire;

use App\Models\NutritionPlan;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class DeleteNutritionPlan extends ModalComponent
{
    public NutritionPlan $nutritionPlan;

    public function mount($id = null)
    {
        $this->nutritionPlan = NutritionPlan::find($id);
    }

    public function cancel()
    {
        $this->closeModal();
    }

    public function deleteNutritionPlan()
    {
        $userId = $this->nutritionPlan->user->id;
        $this->nutritionPlan->delete();
        $this->dispatch('nutrition-plan-deleted', userId: $userId);
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.delete-nutrition-plan');
    }
}
