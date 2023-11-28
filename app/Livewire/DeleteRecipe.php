<?php

namespace App\Livewire;

use App\Models\Recipe;
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
        $this->recipe->delete();
        $this->dispatch('recipe-deleted');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.delete-recipe');
    }
}
