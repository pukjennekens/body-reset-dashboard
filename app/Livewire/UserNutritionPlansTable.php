<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class UserNutritionPlansTable extends Component
{
    public User $user;
    public $nutritionPlans = [];

    public function mount($userId = null)
    {
        $this->user = User::find($userId);
        if(!$this->user) return;
        $this->nutritionPlans = $this->user->nutritionPlans->sortBy('date');
    }

    #[On('nutrition-plan-created')]
    #[On('nutrition-plan-updated')]
    #[On('nutrition-plan-deleted')]
    public function refreshNutritionPlans($userId)
    {
        $this->user = User::find($userId);
        $this->nutritionPlans = $this->user->nutritionPlans->sortBy('date');
    }

    public function render()
    {
        return view('livewire.user-nutrition-plans-table');
    }
}
